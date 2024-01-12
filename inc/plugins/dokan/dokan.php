<?php
/**
 * Dokan Compatibility File
 *
 * @package Botiga
 */

/**
 * Dequeue dokan scripts and styles on pages where it's not needed
 */
function botiga_dokan_dequeue_scripts() {
    if( dokan_is_store_page() || dokan_is_store_listing() || dokan_is_seller_dashboard() || is_account_page() ) {
        return false;
    }
    
    wp_dequeue_style( 'dokan-style' );
    wp_dequeue_style( 'dokan-fontawesome' );
    
    wp_dequeue_script( 'dokan-popup' );
    wp_dequeue_script( 'dokan-i18n-jed' );
    wp_dequeue_script( 'dokan-sweetalert2' );
    wp_dequeue_script( 'dokan-util-helper' );
    wp_dequeue_script( 'dokan-login-form-popup' );
}
add_action( 'wp_enqueue_scripts', 'botiga_dokan_dequeue_scripts', 12 );

/**
 * Enqueue scripts and styles.
 */
function botiga_dokan_enqueue_scripts() {
    if( ! dokan_is_store_page() && ! dokan_is_store_listing() && ! dokan_is_seller_dashboard() && ! is_account_page() ) {
        return false;
    }
    wp_enqueue_style( 'botiga-dokan', get_template_directory_uri() . '/assets/css/dokan.min.css', array(), BOTIGA_VERSION );
}
add_action( 'wp_enqueue_scripts', 'botiga_dokan_enqueue_scripts', 11 );

/**
 * Identify dokan store list page
 */
function botiga_dokan_body_class( $classes ) {
    if( dokan_is_store_listing() ) {
        $classes[] = 'is-dokan-store-listing';
    }

    return $classes;
}
add_filter( 'body_class', 'botiga_dokan_body_class' );

/**
 * Single Product Element (Vendor Info)
 * Extend customizer options with new vendor info box
 */
function botiga_dokan_customizer_single_product_elements( $elements ) {
    $elements[ 'botiga_dokan_vendor_infobox' ] = esc_html__( 'Vendor Info', 'botiga' );

    return $elements;
}
add_filter( 'botiga_single_product_elements', 'botiga_dokan_customizer_single_product_elements' );

/**
 * Single Product Element (Vendor Info)
 * Hook into this filter to extend the defaults from single products elements (needed due to sanitization)
 */
function botiga_dokan_default_single_product_components( $components ) {
    $components[] = 'botiga_dokan_vendor_infobox';

    return $components;
}
add_filter( 'botiga_default_single_product_components', 'botiga_dokan_default_single_product_components' );

/**
 * Vendor Info Box Output
 */
function botiga_dokan_vendor_infobox() { 
    global $product;

    $vendor_id = get_post_field( 'post_author', $product->get_id() );
    $vendor    = dokan()->vendor->get( $vendor_id );
    $shop_data = $vendor->get_shop_info();

    ?>

    <div class="botiga-vendor-infobox">
        <h3 class="botiga-vendor-infobox--title"><?php echo esc_html__( 'Vendor', 'botiga' ); ?></h3>
        <div class="botiga-vendor-infobox--avatar">
            <img class="botiga-vendor-infobox--avatar-image" src="<?php echo esc_url( $vendor->get_avatar() ); ?>" />
            <strong class="botiga-vendor-infobox--avatar-name"><?php echo esc_html( $vendor->get_name() ); ?></strong>
        </div>
        <?php if( isset( $shop_data[ 'address' ] ) ) : ?>
        <div class="botiga-vendor-infobox--data">
            <span class="botiga-vendor-infobox--data-title">
                <?php botiga_get_svg_icon( 'icon-location', true ); ?>
                <span><?php echo esc_html__( 'Address', 'botiga' ); ?></span>
            </span>
            <div class="botiga-vendor-infobox--data-content">
                <p><?php echo esc_html( botiga_dokan_get_vendor_address( $vendor_id ) ); ?></p>
            </div>
        </div>
        <?php endif; ?>
        <?php if( isset( $shop_data[ 'phone' ] ) ) : ?>
        <div class="botiga-vendor-infobox--data">
            <span class="botiga-vendor-infobox--data-title">
            <?php botiga_get_svg_icon( 'icon-phone2', true ); ?>
                <span><?php echo esc_html__( 'Contact', 'botiga' ); ?></span>
            </span>
            <div class="botiga-vendor-infobox--data-content">
                <p><?php echo esc_html( $shop_data[ 'phone' ] ); ?></p>
            </div>
        </div>
        <?php endif; ?>
        <a href="<?php echo esc_url( dokan_get_store_url( $vendor_id ) ); ?>" class="botiga-vendor-infobox--cta"><?php echo esc_html__( 'See All Products', 'botiga' ); ?></a>
        <?php if( ! is_user_logged_in() ) : ?>
            <div class="botiga-vendor-infobox--register">
                <p><?php echo esc_html__( 'Become a vendor?', 'botiga' ); ?></p>
                <a href="<?php echo esc_url(  wc_get_page_permalink( 'myaccount' ) ); ?>" class="botiga-vendor-infobox--link"><?php echo esc_html__( 'Register Now', 'botiga' ); ?></a>
            </div>
        <?php endif; ?>
    </div>

    <?php
}

/**
 * Get the vendor formated address
 */
function botiga_dokan_get_vendor_address( $vendor_id ) {
    $vendor = dokan()->vendor->get( $vendor_id );

    $shop_data = $vendor->get_shop_info();

    $address = '';
    if( isset( $shop_data[ 'address' ] ) ) {
        if( isset( $shop_data[ 'address' ][ 'street_1' ] ) ) {
            $address .= $shop_data[ 'address' ][ 'street_1' ] . ', ';
        }

        if( isset( $shop_data[ 'address' ][ 'city' ] ) ) {
            $address .= $shop_data[ 'address' ][ 'city' ] . ', ';
        }

        if( isset( $shop_data[ 'address' ][ 'country' ] ) ) {
            $address .= $shop_data[ 'address' ][ 'country' ];
        }
    }

    return $address;
}

/**
 * Remove default woocommerce breadcrumb from vendor pages
 */
function botiga_dokan_remove_woocommerce_breadcrumb() {
    if( dokan_is_store_page() ) {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    }
}
add_action( 'wp', 'botiga_dokan_remove_woocommerce_breadcrumb' );

/**
 * Add vendor profile link to botiga header login register dropdown
 */
function botiga_dokan_header_login_register_vendor_profile_link( $output ) {
    if( ! is_user_logged_in() ) {
        return '';
    }

    if( ! dokan_is_user_seller( dokan_get_current_user_id() ) ) {
        return '';
    }
    
    $output .= '<a href="'. esc_url( dokan_get_navigation_url() ) .'">'. esc_html__( 'Vendor Dashboard', 'botiga' ) .'</a>';

    return $output;
}
add_filter( 'botiga_header_login_register_before_logout_dropdown_item', 'botiga_dokan_header_login_register_vendor_profile_link' );

/**
 * Custom CSS
 */
function botiga_dokan_custom_css( $css ) {

    // Buttons
    $css .= Botiga_Custom_CSS::get_color_css( 'button_color', '', 'input[type=\'submit\'].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme' );
    $css .= Botiga_Custom_CSS::get_color_css( 'button_color_hover', '', 'input[type=\'submit\'].dokan-btn-theme:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover, input[type=\'submit\'].dokan-btn-theme:focus, a.dokan-btn-theme:focus, .dokan-btn-theme:focus', true );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'button_background_color', '', 'input[type=\'submit\'].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'button_background_color_hover', '', 'input[type=\'submit\'].dokan-btn-theme:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover, input[type=\'submit\'].dokan-btn-theme:focus, a.dokan-btn-theme:focus, .dokan-btn-theme:focus', true );
    $css .= Botiga_Custom_CSS::get_border_color_css( 'button_background_color', '', 'input[type=\'submit\'].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme' );
    $css .= Botiga_Custom_CSS::get_border_color_css( 'button_background_color_hover', '', 'input[type=\'submit\'].dokan-btn-theme:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover, input[type=\'submit\'].dokan-btn-theme:focus, a.dokan-btn-theme:focus, .dokan-btn-theme:focus', true );
    $css .= Botiga_Custom_CSS::get_top_bottom_padding_css( 'button_top_bottom_padding', $defaults = array( 'desktop' => 13, 'tablet' => 13, 'mobile' => 13 ), 'input[type=\'submit\'].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme' );
    $css .= Botiga_Custom_CSS::get_left_right_padding_css( 'button_left_right_padding', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), 'input[type=\'submit\'].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme' );

    // Forms
    $css .= Botiga_Custom_CSS::get_color_css( 'color_forms_text', '#212121', '.dokan-form-control' );
    $css .= Botiga_Custom_CSS::get_border_color_css( 'color_forms_text', '#eee', '.dokan-form-control' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'color_forms_background', '', '.dokan-form-control' );
    $css .= '.dokan-form-control { padding: 13px; }';

    // Listing Filter
    $css .= Botiga_Custom_CSS::get_color_css( 'button_background_color', '', '#dokan-store-listing-filter-wrap .right .toggle-view .active' );
    
    // Vendor Dashboard
    $css .= Botiga_Custom_CSS::get_background_color_css( 'button_background_color', '', '.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover, .dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover' );
    
    // Single Product Vendor Info Box
    $defaults   = botiga_get_default_single_product_components();
    $components = get_theme_mod( 'single_product_elements_order', $defaults );
    if( in_array( 'botiga_dokan_vendor_infobox', $components ) ) {
        $css .= Botiga_Custom_CSS::get_background_color_css( 'content_cards_background', '', '.botiga-vendor-infobox' );

        $css .= '
            .botiga-vendor-infobox {
                padding: 21px;
                border-radius: 4px;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--title {
                font-size: 1.3rem;
                color: #212121;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                margin: 0 0 25px;
                padding-bottom: 12px;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--avatar {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                    -ms-flex-align: center;
                        align-items: center;
                margin-bottom: 20px;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--avatar .botiga-vendor-infobox--avatar-image {
                width: 100%;
                max-width: 50px;
                height: auto;
                border-radius: 100%;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--avatar .botiga-vendor-infobox--avatar-name {
                font-size: 1.1rem;
                font-weight: 400;
                margin-left: 12px;
                color: #212121;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--data .botiga-vendor-infobox--data-title {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                    -ms-flex-align: center;
                        align-items: center;
                color: #212121;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--data .botiga-vendor-infobox--data-title > svg {
                margin-right: 12px;
                max-width: 15px;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--data .botiga-vendor-infobox--data-title > svg path {
                fill: #212121;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--data .botiga-vendor-infobox--data-content {
                padding-top: 10px;
                margin-top: 10px;
                border-top: 1px solid rgba(0, 0, 0, 0.1);
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--data .botiga-vendor-infobox--data-content p {
                color: #212121;
                margin-bottom: 0;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--data + .botiga-vendor-infobox--data {
                margin-top: 30px;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--cta {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                border: 2px solid #212121;
                -webkit-box-pack: center;
                    -ms-flex-pack: center;
                        justify-content: center;
                -webkit-box-align: center;
                    -ms-flex-align: center;
                        align-items: center;
                padding: 13px;
                margin-top: 30px;
                background-color: transparent;
                color: #212121;
                border-radius: 3px;
                font-weight: 600;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--register {
                margin-top: 15px;
                color: #212121;
                text-align: center;
                font-weight: 600;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--register p {
                opacity: 0.8;
                margin: 0;
            }
            
            .botiga-vendor-infobox .botiga-vendor-infobox--register .botiga-vendor-infobox--link {
                display: block;
                color: #212121;
                text-decoration: none;
            }
        ';
    }

    return $css;
}
add_filter( 'botiga_custom_css_output', 'botiga_dokan_custom_css' );
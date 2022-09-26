<?php
/**
 * Theme update functions
 * 
 * to do: use version compare
 *
 */

/**
 * Migrate woocommerce options
 */
function botiga_migrate_woo_catalog_columns_and_rows() {
    $flag = get_theme_mod( 'botiga_migrate_woo_catalog_columns_and_rows_flag', false );

    if ( true === $flag ) {
        return;
    }

    $woocommerce_catalog_columns = get_option( 'woocommerce_catalog_columns', 4 );
    set_theme_mod( 'shop_woocommerce_catalog_columns_desktop', $woocommerce_catalog_columns );

    $woocommerce_catalog_rows = get_option( 'woocommerce_catalog_rows', 4 );
    set_theme_mod( 'shop_woocommerce_catalog_rows', $woocommerce_catalog_rows );

    //Set flag
    set_theme_mod( 'botiga_migrate_woo_catalog_columns_and_rows_flag', true );
}
add_action( 'init', 'botiga_migrate_woo_catalog_columns_and_rows' );

/**
 * Migrate header options
 */
function botiga_migrate_header_mobile_icons() {
    $flag = get_theme_mod( 'botiga_migrate_header_mobile_icons_flag', false );

    if ( true === $flag ) {
        return;
    }
    
    $default_components = botiga_get_default_header_components();

    $header_components = get_theme_mod( 'header_components', $default_components['l1'] );

    $header_components_mobile = array_map(function ( $value ) {
        return $value === 'woocommerce_icons' ? 'mobile_woocommerce_icons' : $value;
    }, $header_components );
    set_theme_mod( 'header_components_mobile', $header_components_mobile );

    $header_components_offcanvas = array_map(function ( $value ) {
        return $value === 'woocommerce_icons' ? 'mobile_offcanvas_woocommerce_icons' : $value;
    }, $header_components );
    set_theme_mod( 'header_components_offcanvas', $header_components_offcanvas );

    //Set flag
    set_theme_mod( 'botiga_migrate_header_mobile_icons_flag', true );
}
add_action( 'init', 'botiga_migrate_header_mobile_icons' );

/**
 * Header/Footer Builder
 * Enable HF module for new users. 
 * Existing users (from update) will be asked if they want to use new header builder 
 * or continue with old header system.
 * 
 * @since 1.1.9
 */
function botiga_hf_enable_to_new_users( $old_theme_name ) {
	$old_theme_name = strtolower( $old_theme_name );
	if( !get_option( 'botiga-update-hf' ) && strpos( $old_theme_name, 'botiga' ) === FALSE ) {
		update_option( 'botiga-update-hf', true );

        $all_modules = get_option( 'botiga-modules' );
		$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

		update_option( 'botiga-modules', array_merge( $all_modules, array( 'hf-builder' => true ) ) );
	}
}
add_action('after_switch_theme', 'botiga_hf_enable_to_new_users');

/**
 * Header/Footer Update Notice
 * 
 * @since 1.1.9
 * 
 */
function botiga_hf_update_notice_1_1_9() {

    if ( get_option( 'botiga-update-hf-dismiss' ) ) {
        return;
    }
    
    if ( !get_option( 'botiga-update-hf' ) ) { ?>

    <div class="notice notice-success thd-theme-dashboard-notice-success is-dismissible">
        <h3><?php esc_html_e( 'Botiga Header/Footer Update', 'botiga'); ?></h3>
        <p>
            <?php esc_html_e( 'This version of Botiga comes with a new Header and Footer Builder. Activate it by clicking on the button below and you can access new options.', 'botiga' ); ?>
        </p>
        <p>
            <?php esc_html_e( 'Note 1: This upgrade is optional, there is no need to do it if you are happy with your current header and footer.', 'botiga' ); ?>
        </p>         
        <p>
            <?php esc_html_e( 'Note 2: Your current header and footer customizations will be lost and you will have to use the new options to customize your header and footer.', 'botiga' ); ?>
        </p>   
        <p>
            <?php esc_html_e( 'Note 3: Please take a full backup of your website before upgrading.', 'botiga' ); ?>
        </p>            
        <p>
            <?php 
            /* translators: 1: documentation link. */
            echo sprintf( esc_html__( 'Want to see the new header and footer builder before upgrading? Check out our %s.', 'botiga' ), '<a target="_blank" href="https://docs.athemes.com/article/pro-header-builder/">documentation</a>' ); ?>
        </p>
        <a href="#" class="button botiga-update-hf" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-update-hf-nonce' ) ); ?>" style="margin-top: 15px;"><?php esc_html_e( 'Update theme header and footer', 'botiga' ); ?></a>
        <a href="#" class="button botiga-update-hf-dismiss" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-update-hf-dismiss-nonce' ) ); ?>" style="margin-top: 15px;"><?php esc_html_e( 'Continue to use the old header and footer system', 'botiga' ); ?></a> 
    </div>
    <?php }
}
add_action( 'admin_notices', 'botiga_hf_update_notice_1_1_9' );

/**
 * Header update ajax callback
 * 
 * @since 1.1.9
 */
function botiga_hf_update_notice_1_1_9_callback() {
	check_ajax_referer( 'botiga-update-hf-nonce', 'nonce' );

	update_option( 'botiga-update-hf', true );

    $all_modules = get_option( 'botiga-modules' );
    $all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

    update_option( 'botiga-modules', array_merge( $all_modules, array( 'hf-builder' => true ) ) );

	wp_send_json( array(
		'success' => true
	) );
}
add_action( 'wp_ajax_botiga_hf_update_notice_1_1_9_callback', 'botiga_hf_update_notice_1_1_9_callback' );

/**
 * Header update ajax callback
 * 
 * @since 1.1.9
 */
function botiga_hf_update_dismiss_notice_1_1_9_callback() {
	check_ajax_referer( 'botiga-update-hf-dismiss-nonce', 'nonce' );

	update_option( 'botiga-update-hf-dismiss', true );

	wp_send_json( array(
		'success' => true
	) );
}
add_action( 'wp_ajax_botiga_hf_update_dismiss_notice_1_1_9_callback', 'botiga_hf_update_dismiss_notice_1_1_9_callback' );

/**
 * Migrate 'header transparent' and 'header image' old display conditions to the new.
 * Migrate scroll to top offsets.
 * 
 * @since 1.2.1
 */
function botiga_migrate_1_2_1_options() {
    $flag = get_theme_mod( 'botiga_migrate_1_2_1_options_flag', false );

    if ( true === $flag ) {
        return;
    }

    // Scroll To Top Offsets
    set_theme_mod( 'scrolltop_side_offset_desktop', get_theme_mod( 'scrolltop_side_offset', 30 ) );
    set_theme_mod( 'scrolltop_bottom_offset_desktop', get_theme_mod( 'scrolltop_bottom_offset', 30 ) );

    // Header Transparent
    $header_transparent_display_on = get_theme_mod( 'header_transparent_display_on', 'front-page' );
    $values = explode( ',', $header_transparent_display_on );
    $new_value = array();

    foreach( $values as $val ) {

        if( $val === 'pages' ) {
            $val = 'single-page';
        }

        if( $val === 'blog-archive' ) {
            $val = 'post-archives';
        }

        if( $val === 'blog-posts' ) {
            $val = 'single-post';
        }

        if( $val === 'post-search' ) {
            $val = 'search';
        }

        $new_value[] = array(
            'type'      => 'include',
            'condition' => $val,
            'id'        => null
        );
    }

    set_theme_mod( 'header_transparent_display_on', json_encode( $new_value ) );

    // Header Image
    $show_header_image_only_home = get_theme_mod( 'show_header_image_only_home', 0 );
    if( $show_header_image_only_home ) {
        set_theme_mod( 'header_image_display_conditions', json_encode( array(
            array(
                'type'      => 'include',
                'condition' => 'front-page',
                'id'        => null
            )
        ) ) );
    } else {
        set_theme_mod( 'header_image_display_conditions', json_encode( array(
            array(
                'type'      => 'include',
                'condition' => 'all',
                'id'        => null
            )
        ) ) );
    }

    //Set flag
    set_theme_mod( 'botiga_migrate_1_2_1_options_flag', true );
}
add_action( 'init', 'botiga_migrate_1_2_1_options' );
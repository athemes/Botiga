<?php
/**
 * Single Product Tabs
 *
 * @package Botiga
 */

/**
 * Enqueue CSS and JS
 */
function botiga_single_product_tabs_enqueue_scripts() {
    if( ! is_product() ) {
        return;
    }

    $single_product_tabs_layout = get_theme_mod( 'single_product_tabs_layout', 'style6' );
    $single_product_tabs_layout = 'style6';
    if( $single_product_tabs_layout !== 'style6' ) {
        return;
    }
}
add_action( 'wp_enqueue_scripts', 'botiga_single_product_tabs_enqueue_scripts', 10 );

/**
 * WC Hooks 
 */
function botiga_single_product_tabs_wc_hooks() {

	//Single product
	if ( is_product() ) {
		$single_tabs = get_theme_mod( 'single_product_tabs', 1 );

		//Content class
		add_filter( 'botiga_content_class', 'botiga_single_product_tabs_wc_single_layout' );

		//Product tabs
		$tabs_position = get_theme_mod( 'single_product_tabs_position', 'default' );

		if ( ! $single_tabs || $tabs_position !== 'default' ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );

			if( $tabs_position === 'product-summary' ) {
				add_action( 'woocommerce_single_product_summary', 'botiga_single_product_tabs_output', 55 );
			}
		}
	}

}
add_action( 'wp', 'botiga_single_product_tabs_wc_hooks' );

/**
 * Woocommerce tabs titles
 */
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_false' );

/**
 * Layout single product
 */
function botiga_single_product_tabs_wc_single_layout( $class ) {
	$single_product_tabs_layout    = get_theme_mod( 'single_product_tabs_layout', 'style1' );
	$single_product_tabs_alignment = get_theme_mod( 'single_product_tabs_alignment', 'left' );
	$tabs_position 				   = get_theme_mod( 'single_product_tabs_position', 'default' );

	$class .= ' botiga-tabs-' . $single_product_tabs_layout . ' botiga-tabs-align-' . $single_product_tabs_alignment . ' botiga-tabs-position-' . $tabs_position;

    return $class;
}

/**
 * Tabs Accordion Style
 */
function botiga_single_product_tabs_output() { 
    $single_product_tabs_layout = get_theme_mod( 'single_product_tabs_layout', 'style6' );
    $single_product_tabs_layout = 'style6';

    if( $single_product_tabs_layout !== 'style6' ) {
        woocommerce_output_product_data_tabs();
    } else {
        botiga_single_product_tabs_as_accordion_output();
    } 
}

function botiga_single_product_tabs_as_accordion_output() {

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

    if ( ! empty( $product_tabs ) ) : ?>

        <div class="botiga-accordion">
            <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                <div class="botiga-accordion__item">
                    <a href="#botiga-accordion-<?php echo esc_attr( $key ); ?>" class="botiga-accordion__toggle" data-botiga-collapse>
                        <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
                    </a>
                    <div id="botiga-accordion-<?php echo esc_attr( $key ); ?>" class="botiga-accordion__body botiga-collapse">
                        <div class="botiga-accordion__body-content botiga-collapse__content">
                            <?php
                            if ( isset( $product_tab['callback'] ) ) {
                                call_user_func( $product_tab['callback'], $key, $product_tab );
                            } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_product_after_tabs' ); ?>
        </div>

    <?php endif; ?>

    <?php
}
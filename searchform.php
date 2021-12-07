<?php
/**
 * The search form template
 * @package Botiga
 */

$botiga_unique_id = wp_unique_id( 'search-form-' );

$botiga_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>
<?php if ( !class_exists( 'WooCommerce' ) ) : ?>
<form role="search" <?php echo $botiga_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $botiga_unique_id ); ?>"><?php _e( 'Search&hellip;', 'botiga' ); // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction ?></label>
	<input type="search" id="<?php echo esc_attr( $botiga_unique_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'botiga' ); ?>"/>
	<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'botiga' ); ?>"><i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-search', true ); ?></i></button>
</form>
<?php else : ?>
<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $botiga_unique_id ) ? esc_attr( $botiga_unique_id ) : 0; ?>"><?php esc_html_e( 'Search for:', 'botiga' ); ?></label>
	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $botiga_unique_id ) ? esc_attr( $botiga_unique_id ) : 0; ?>" class="search-field wc-search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'botiga' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'botiga' ); ?>"><i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-search', true ); ?></i></button>
	<input type="hidden" name="post_type" value="product" />
</form>
<?php endif; ?>
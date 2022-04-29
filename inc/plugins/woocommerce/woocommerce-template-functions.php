<?php
/**
 * WooCommerce template functions
 *
 * @package Botiga
 */

/**
 * Default single product components
 */
function botiga_get_default_single_product_components() {
	$components = array(
		'woocommerce_template_single_title',
		'woocommerce_template_single_rating',
		'woocommerce_template_single_price',
		'woocommerce_template_single_excerpt',
		'woocommerce_template_single_add_to_cart',
		'botiga_divider_output',
		'woocommerce_template_single_meta',
	);

	if( 'layout1' !== get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ) ) {
		$components[] = 'botiga_single_wishlist_button';
	}

	return apply_filters( 'botiga_default_single_product_components', $components );
}

/**
 * Single product elements
 */
function botiga_single_product_elements() {

	$elements = array(
		'woocommerce_template_single_title' 	  => esc_html__( 'Product Title', 'botiga' ),
		'woocommerce_template_single_rating' 	  => esc_html__( 'Rating', 'botiga' ),
		'woocommerce_template_single_price'		  => esc_html__( 'Price', 'botiga' ),
		'woocommerce_template_single_excerpt' 	  => esc_html__( 'Short Description', 'botiga' ),
		'woocommerce_template_single_add_to_cart' => esc_html__( 'Add to Cart', 'botiga' ),
		'botiga_divider_output'                   => esc_Html__( 'Divider', 'botiga' ),
		'woocommerce_template_single_meta' 		  => esc_html__( 'Meta', 'botiga' )
	);

	if( 'layout1' !== get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ) ) {
		$elements['botiga_single_wishlist_button'] = esc_html__( 'Wishlist Button', 'botiga' );
	}

	return apply_filters( 'botiga_single_product_elements', $elements );
}

/**
 * Map and replace default woo template functions with quick view functions
 */
function botiga_get_quick_view_summary_components( $components = array() ) {
	$components = array_map( function( $component ){
		$suffix = str_replace( 'woocommerce_template_single_', '', $component );

		if( $component === "woocommerce_template_single_$suffix" ) {
			return "botiga_quick_view_summary_$suffix";
		}

		return $component;
	}, $components );

	return apply_filters( 'botiga_quick_view_product_components', $components );
}

/**
 * Divider output
 */
function botiga_divider_output() {
	echo '<hr class="divider">';
}

/**
 * Botiga output for simple product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_simple_add_to_cart( $product, $hook_prefix = '' ) {
	if ( ! $product->is_purchasable() ) {
		return;
	}
	
	echo wc_get_stock_html( $product ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	
	if ( $product->is_in_stock() ) : ?>
	
		<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>
	
		<form class="cart" action="<?php echo esc_url( apply_filters( "botiga_{$hook_prefix}_add_to_cart_form_action", $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
			<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); ?>
	
			<?php
			do_action( "botiga_{$hook_prefix}_before_add_to_cart_quantity" );

			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_min", $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_max", $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( absint( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity()
				)
			);
	
			do_action( "botiga_{$hook_prefix}_after_add_to_cart_quantity" );
			?>
	
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	
			<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>
		</form>
	
		<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_form" ); ?>
	
	<?php endif;
}

/**
 * Botiga output for grouped product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_grouped_add_to_cart( $product, $hook_prefix = '' ) {
	$products = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );

	if ( $products ) :
		$post               = get_post( $product->get_id() );
		$grouped_product    = $product;
		$grouped_products   = $products;
		$quantites_required = false;

		do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>

		<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( "botiga_{$hook_prefix}_add_to_cart_form_action", $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
			<table cellspacing="0" class="woocommerce-grouped-product-list group_table">
				<tbody>
					<?php
					$quantites_required      = false;
					$previous_post           = $post;
					$grouped_product_columns = apply_filters(
						"botiga_{$hook_prefix}_grouped_product_columns",
						array(
							'quantity',
							'label',
							'price',
						),
						$product
					);
					$show_add_to_cart_button = false;

					do_action( "botiga_{$hook_prefix}_grouped_product_list_before", $grouped_product_columns, $quantites_required, $product );

					foreach ( $grouped_products as $grouped_product_child ) {
						$post_object        = get_post( $grouped_product_child->get_id() );
						$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
						$post               = $post_object;
						setup_postdata( $post );

						if ( $grouped_product_child->is_in_stock() ) {
							$show_add_to_cart_button = true;
						}

						echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';

						// Output columns for each product.
						foreach ( $grouped_product_columns as $column_id ) {
							do_action( "botiga_{$hook_prefix}_grouped_product_list_before_" . $column_id, $grouped_product_child );

							switch ( $column_id ) {
								case 'quantity':
									ob_start();

									if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
										woocommerce_template_loop_add_to_cart();
									} elseif ( $grouped_product_child->is_sold_individually() ) {
										echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
									} else {
										do_action( "botiga_{$hook_prefix}_before_add_to_cart_quantity" );

										woocommerce_quantity_input(
											array(
												'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
												'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : '', // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
												'min_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_min", 0, $grouped_product_child ),
												'max_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_max", $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
												'placeholder' => '0',
											)
										);

										do_action( "botiga_{$hook_prefix}_after_add_to_cart_quantity" );
									}

									$value = ob_get_clean();
									break;
								case 'label':
									$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
									$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( "botiga_{$hook_prefix}_grouped_product_list_link", $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
									$value .= '</label>';
									break;
								case 'price':
									$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
									break;
								default:
									$value = '';
									break;
							}

							echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( "botiga_{$hook_prefix}_grouped_product_list_column_" . $column_id, $value, $grouped_product_child ) . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

							do_action( "botiga_{$hook_prefix}_grouped_product_list_after_" . $column_id, $grouped_product_child );
						}

						echo '</tr>';
					}
					$post = $previous_post;
					setup_postdata( $post );

					do_action( "botiga_{$hook_prefix}_grouped_product_list_after", $grouped_product_columns, $quantites_required, $product );
					?>
				</tbody>
			</table>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

			<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

				<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); ?>

				<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

				<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>

			<?php endif; ?>
		</form>

		<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_form" ); ?>
	
	<?php endif;
}

/**
 * Botiga output for variable product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_variable_add_to_cart( $product, $hook_prefix = '' ) {
	// Get Available variations?
	$get_variations = count( $product->get_children() ) <= apply_filters( "botiga_{$hook_prefix}_ajax_variation_threshold", 30, $product );

	$available_variations = $get_variations ? $product->get_available_variations() : false;
	$attributes           = $product->get_variation_attributes();
	$selected_attributes  = $product->get_default_attributes();

	$attribute_keys  = array_keys( $attributes );
	$variations_json = wp_json_encode( $available_variations );
	$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

	do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>

	<form class="variations_form cart" action="<?php echo esc_url( apply_filters( "botiga_{$hook_prefix}_add_to_cart_form_action", $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
		<?php do_action( "botiga_{$hook_prefix}_before_variations_form" ); ?>

		<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php echo esc_html( apply_filters( "botiga_{$hook_prefix}_out_of_stock_message", __( 'This product is currently out of stock and unavailable.', 'botiga' ) ) ); ?></p>
		<?php else : ?>
			<table class="variations" cellspacing="0">
				<tbody>
					<?php foreach ( $attributes as $attribute_name => $options ) : ?>
						<tr>
							<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></label></td>
							<td class="value">
								<?php
									wc_dropdown_variation_attribute_options(
										array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
										)
									);
									echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( "botiga_{$hook_prefix}_reset_variations_link", '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'botiga' ) . '</a>' ) ) : '';
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<div class="single_variation_wrap">
				<?php
					/**
					 * Hook: woocommerce_before_single_variation.
					 */
					do_action( "botiga_{$hook_prefix}_before_single_variation" ); ?>

					<div class="woocommerce-variation single_variation"></div>
					<div class="woocommerce-variation-add-to-cart variations_button">
						<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?> 

						<?php
						do_action( "botiga_{$hook_prefix}_before_add_to_cart_quantity" );

						woocommerce_quantity_input(
							array(
								'min_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_min", $product->get_min_purchase_quantity(), $product ),
								'max_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_max", $product->get_max_purchase_quantity(), $product ),
								'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
							)
						);

						do_action( "botiga_{$hook_prefix}_after_add_to_cart_quantity" );
						?>

						<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

						<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>

						<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
						<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
						<input type="hidden" name="variation_id" class="variation_id" value="0" />
					</div>


					<?php
					/**
					 * Hook: woocommerce_after_single_variation.
					 */
					do_action( 'botiga_quick_view_after_single_variation' );
				?>
			</div>
		<?php endif; ?>

		<?php do_action( 'botiga_quick_view_after_variations_form' ); ?>
	</form>

	<?php
	do_action( 'botiga_quick_view_after_add_to_cart_form' );
}


/**
 * Botiga output for external product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_external_add_to_cart( $product, $hook_prefix = '' ) {
	if ( ! $product->add_to_cart_url() ) {
		return;
	}

	$product_url = $product->add_to_cart_url();
	$button_text = $product->single_add_to_cart_text();

	do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>

	<form class="cart" action="<?php echo esc_url( $product_url ); ?>" method="get">
		<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $button_text ); ?></button>

		<?php wc_query_string_form_fields( $product_url ); ?>

		<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>
	</form>

	<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_form" );
}

/**
 * Botiga output for product price.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_single_product_price( $hook_prefix = '' ) {
	global $product; ?>

	<p class="<?php echo esc_attr( apply_filters( "botiga_{$hook_prefix}_product_price_class", 'price' ) ); ?>"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

<?php
}

/**
 * Single product elements HTML output
 */
function botiga_single_product_html() {
	$html = get_theme_mod( 'botiga_single_product_html_content', '' );

	echo '<div class="html-content">';
		echo wp_kses_post( $html );
	echo '</div>';
}

/**
 * Single product elements Shortcode output
 */
function botiga_single_product_shortcode() {
	$shortcode = get_theme_mod( 'botiga_single_product_shortcode_content', '' );

	echo '<div class="shortcode-content">';
		echo do_shortcode( $shortcode );
	echo '</div>';
}
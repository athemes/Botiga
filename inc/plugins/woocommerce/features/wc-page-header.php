<?php
/**
 * Shop Page Header
 *
 * @package Botiga
 */

/**
 * Page header
 */
function botiga_woocommerce_page_header() {
	if ( !is_shop() && !is_product_category() && !is_product_tag() && !is_product_taxonomy() ) {
		return;
	}

	$shop_archive_header_style                     = get_theme_mod( 'shop_archive_header_style', 'style1' );
	$shop_archive_header_style_alignment           = $shop_archive_header_style !== 'style2' ? get_theme_mod( 'shop_archive_header_style_alignment', 'center' ) : 'left';
	$shop_archive_header_style_show_categories     = get_theme_mod( 'shop_archive_header_style_show_categories', 0 );
	$shop_archive_header_style_show_sub_categories = get_theme_mod( 'shop_archive_header_style_show_sub_categories', 0 );
	$shop_page_title                               = get_theme_mod( 'shop_page_title', 1 );
	$shop_page_description                         = get_theme_mod( 'shop_page_description', 1 );
	$shop_breadcrumbs                              = get_theme_mod( 'shop_breadcrumbs', 1 );

	// Do not show page header if Elementor is active and has a theme builder template assigned to the shop archive location
	if( class_exists( 'Botiga_Elementor_Helpers' ) && Botiga_Elementor_Helpers::elementor_has_location( 'archive' ) ) {
		return;
	}

	//Remove elements
	add_filter( 'woocommerce_show_page_title', '__return_false' );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );

	// Categories
	$categories = 0;
	if( is_shop() ) {
		$args = array(
			'taxonomy' => 'product_cat',
			'fields'   => 'id=>name',
			'parent'   => 0,
			'hide_empty' => true,
		);

		/**
		 * Hook 'botiga_shop_page_header_cats_query_args'
		 *
		 * @since 1.0.0
		 */
		$categories = get_terms( apply_filters( 'botiga_shop_page_header_cats_query_args', $args ) ); 
	}

	// Sub Categories
	$sub_categories = 0;
	if( is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		$category = get_category( $GLOBALS['wp_query']->get_queried_object() );
		$args = array(
			'taxonomy' => 'product_cat',
			'parent'   => isset( $category->term_id ) ? $category->term_id : 0,
			'fields'   => 'id=>name',
			'hide_empty' => true,
		);

		/**
		 * Hook 'botiga_shop_page_header_sub_cats_query_args'
		 *
		 * @since 1.0.0
		 */
		$sub_categories = get_terms( apply_filters( 'botiga_shop_page_header_sub_cats_query_args', $args ) ); 
	}

	// Return early to don't display the wc page header if all the options are disabled
	if( 
		! $shop_page_title && 
		! $shop_page_description && 
		! $shop_breadcrumbs && 
		( ! $shop_archive_header_style_show_categories || $shop_archive_header_style_show_categories && empty( $categories ) ) && 
		( ! $shop_archive_header_style_show_sub_categories || $shop_archive_header_style_show_sub_categories && empty( $sub_categories ) )
	) {
		return;
	}

	?>
		<header class="woocommerce-page-header woocommerce-page-header-<?php echo esc_attr( $shop_archive_header_style ); ?> woocommerce-page-header-alignment-<?php echo esc_attr( $shop_archive_header_style_alignment ); ?>">
			<div class="container">
				<?php 
				/**
				 * Hook 'botiga_show_woo_page_header_breadcrumbs'
				 *
				 * @since 1.0.0
				 */
				if ( $shop_breadcrumbs && apply_filters( 'botiga_show_woo_page_header_breadcrumbs', true )) { ?>
					<?php woocommerce_breadcrumb(); ?>
					</div>
					<div class="container">
				<?php
				}

				/**
				 * Hook 'botiga_before_shop_archive_title'
				 *
				 * @since 1.0.0
				 */
				do_action( 'botiga_before_shop_archive_title' );

				if ( ( $shop_page_title && ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) ) || !is_shop() && !is_product_category() && !is_product_tag() && !is_product_taxonomy() ) {

					/**
					 * Hook 'botiga_shop_page_title_html_tag'
					 *
					 * @since 1.0.0
					 */
					$title_html_tag = apply_filters( 'botiga_shop_page_title_html_tag', 'h1' );

					printf(
						'<%1$s class="woocommerce-products-header__title page-title" %2$s>%3$s</%1$s>',
						tag_escape( $title_html_tag ),
						botiga_schema( 'headline', false ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						esc_html( woocommerce_page_title( false ) )
					);
				}

				if( ( $shop_page_description && ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) ) || !is_shop() && !is_product_category() && !is_product_tag() && !is_product_taxonomy() ) {
					woocommerce_taxonomy_archive_description();
					woocommerce_product_archive_description();
				}
				
				if( $shop_archive_header_style_show_categories ) {
					botiga_shop_page_header_category_links( $categories );
				}

				if( $shop_archive_header_style_show_sub_categories && ( is_product_category() || is_product_tag() || is_product_taxonomy() ) ) {
					botiga_shop_page_header_sub_category_links( $sub_categories );
				} ?>
				
			</div>
		</header>
	<?php
}
add_action( 'botiga_page_header', 'botiga_woocommerce_page_header' );

/**
 * Display shop page header category buttons/links on the main shop page
 * 
 */
function botiga_shop_page_header_category_links( $categories ) {
	if( ! is_shop() ) {
		return;
	}

	ob_start(); 
	
	?>

	<?php if( Botiga_Modules::is_module_active( 'hf-builder' ) ) : ?>
	</div>
	<?php endif; ?>
	
	<div class="container">

		<?php       
		if( count( $categories ) > 0 ) : ?>
			<div class="categories-wrapper">
				<?php  
				foreach( $categories as $cat_id => $cat_name ) {
					$cat_link = get_term_link( $cat_id );

					/**
					 * Hook 'botiga_shop_page_header_category_inner_item_after_name'
					 *
					 * @since 1.0.0
					 */
					echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) . esc_html( apply_filters( 'botiga_shop_page_header_category_inner_item_after_name', '', $cat_id ) ) .'</a>';
				} ?>
			</div>
		<?php endif; ?>
	</div>

	<?php
	$output = ob_get_clean();
	
	/**
	 * Hook 'botiga_shop_page_header_category_links_output'
	 *
	 * @since 1.0.0
	 */
	echo apply_filters( 'botiga_shop_page_header_category_links_output', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Display shop page header category buttons/links on sub categories pages 
 * 
 */
function botiga_shop_page_header_sub_category_links( $sub_categories ) {
	if( ! is_product_category() && ! is_product_tag() && ! is_product_taxonomy() ) {
		return;
	}

	ob_start(); 
	
	?>

	<div class="container">

		<?php 
		if( count( $sub_categories ) > 0 ) : ?>
			<div class="categories-wrapper">
				<?php 
				foreach( $sub_categories as $cat_id => $cat_name ) {
					$cat_link = get_term_link( $cat_id );

					/**
					 * Hook 'botiga_shop_page_header_category_inner_item_after_name'
					 *
					 * @since 1.0.0
					 */
					echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) . esc_html( apply_filters( 'botiga_shop_page_header_category_inner_item_after_name', '', $cat_id ) ) .'</a>';
				} ?>
			</div>
		<?php endif; ?>
	</div>

	<?php

	$output = ob_get_clean();
	
	/**
	 * Hook 'botiga_shop_page_header_sub_category_links_output'
	 *
	 * @since 1.0.0
	 */
	echo apply_filters( 'botiga_shop_page_header_sub_category_links_output', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
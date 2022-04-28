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
	if ( !is_shop() && !is_product_category() && !is_product_tag() ) {
		return;
	}

	$shop_archive_header_style 					   = get_theme_mod( 'shop_archive_header_style', 'style1' );
	$shop_archive_header_style_alignment 		   = $shop_archive_header_style !== 'style2' ? get_theme_mod( 'shop_archive_header_style_alignment', 'center' ) : 'left';
	$shop_archive_header_style_show_categories 	   = get_theme_mod( 'shop_archive_header_style_show_categories', 0 );
	$shop_archive_header_style_show_sub_categories = get_theme_mod( 'shop_archive_header_style_show_sub_categories', 0 );
	$shop_page_title           					   = get_theme_mod( 'shop_page_title', 1 );
	$shop_page_description           			   = get_theme_mod( 'shop_page_description', 1 );
	$shop_breadcrumbs 							   = get_theme_mod( 'shop_breadcrumbs', 1 );

	//Remove elements
	add_filter( 'woocommerce_show_page_title', '__return_false' );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );

	if( ! $shop_page_title && ! $shop_page_description && ! $shop_breadcrumbs && ! $shop_archive_header_style_show_categories && ! $shop_archive_header_style_show_sub_categories ) {
		return;
	}
	?>
		<header class="woocommerce-page-header woocommerce-page-header-<?php echo esc_attr( $shop_archive_header_style ); ?> woocommerce-page-header-alignment-<?php echo esc_attr( $shop_archive_header_style_alignment ); ?>">
			<div class="container">
				<?php 
				if ( $shop_breadcrumbs ) { ?>
					<?php woocommerce_breadcrumb(); ?>
					</div>
					<div class="container">
				<?php
				}
				if ( ( $shop_page_title && ( is_shop() || is_product_category() || is_product_tag() ) ) || !is_shop() && !is_product_category() && !is_product_tag() ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif;

				if( ( $shop_page_description && ( is_shop() || is_product_category() || is_product_tag() ) ) || !is_shop() && !is_product_category() && !is_product_tag() ) {
					woocommerce_taxonomy_archive_description();
					woocommerce_product_archive_description();
				}
				if( is_shop() && $shop_archive_header_style_show_categories ) : ?>
					</div>
					<div class="container">

						<?php 
						$args = array(
							'taxonomy' => 'product_cat',
							'fields'   => 'id=>name',
							'parent'   => 0
						);
						$categories = get_terms( $args ); 
						
						if( count( $categories ) > 0 ) : ?>
							<div class="categories-wrapper">
								<?php  
								foreach( $categories as $cat_id => $cat_name ) {
									$cat_link = get_term_link( $cat_id );
									echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) .'</a>';
								} ?>
							</div>
						<?php endif; ?>
					<!-- </div> -->
				<?php endif; ?>
				<?php if( $shop_archive_header_style_show_sub_categories && ( is_product_category() || is_product_tag() ) ) : ?>
					</div>
					<div class="container">

						<?php 
						$category = get_category( $GLOBALS['wp_query']->get_queried_object() );
						$args = array(
							'taxonomy' => 'product_cat',
							'parent'   => $category->term_id,
							'fields'   => 'id=>name'
						);
						$categories = get_terms( $args ); 
						
						if( count( $categories ) > 0 ) : ?>
							<div class="categories-wrapper">
								<?php 
								foreach( $categories as $cat_id => $cat_name ) {
									$cat_link = get_term_link( $cat_id );
									echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) .'</a>';
								} ?>
							</div>
						<?php endif; ?>
					<!-- </div> -->
				<?php endif; ?>
			</div>
		</header>
	<?php
}
add_action( 'botiga_page_header', 'botiga_woocommerce_page_header' );
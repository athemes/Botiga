<?php
/**
 * Template part for displaying ajax search categories item content.
 *
 * @package Botiga
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Hook 'botiga_before_ajax_search_categories_item'
 *
 * @since 2.2.4
 */
do_action( 'botiga_before_ajax_search_categories_item' );

$category_item = $args['category'];

?>

<a class="botiga-ajax-search__item botiga-ajax-search__item-category" href="<?php echo esc_url( get_term_link( $category_item->term_id ) ); ?>">
	<div class="botiga-ajax-search__item-info">
		<h3><?php echo esc_html( $category_item->name ); ?></h3>
	</div>
</a>

<?php 
/**
 * Hook 'botiga_after_ajax_search_categories_item'
 *
 * @since 2.2.4
 */
do_action( 'botiga_after_ajax_search_categories_item' ); ?>
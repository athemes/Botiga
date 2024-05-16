<?php
/**
 * Template part for displaying ajax search categories content.
 *
 * @package Botiga
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$terms = $args['terms'];

/**
 * Hook 'botiga_before_ajax_search_categories'
 *
 * @since 1.0.0
 */
do_action( 'botiga_before_ajax_search_categories' );

?>

<h2 class="botiga-ajax-search__heading-title"><?php echo esc_html__( 'Categories', 'botiga' ); ?></h2>
<hr class="botiga-ajax-search__divider">
<div class="botiga-ajax-search-categories">

	<?php foreach( $terms as $category ) : 
		botiga_get_template_part( 'template-parts/search/content', 'ajax-search-categories-item', array( 'category' => $category ) );
	endforeach; ?>

</div>

<?php 
/**
 * Hook 'botiga_after_ajax_search_categories'
 *
 * @since 1.0.0
 */
do_action( 'botiga_after_ajax_search_categories' ); ?>
<?php
/**
 * Template part for displaying ajax search categories wrapper.
 * 
 * This template can be overridden by copying it to yourtheme/template-parts/search/content-ajax-search-categories.php.
 *
 * HOWEVER, on occasion Botiga will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 *
 * @package Botiga\Templates
 * @version 2.2.4
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
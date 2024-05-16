<?php
/**
 * Template part for displaying ajax search products loop end.
 *
 * @package Botiga
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$search_link_mounted = $args['search_link_mounted'];
$query = $args['query'];

?>

<div class="botiga-ajax-search__see-all">
    <a href="<?php echo esc_url( $search_link_mounted ); ?>" class="botiga-ajax-search__see-all-link">
        <?php 
        /* Translators: 1. Search results quantity */
        echo esc_html( sprintf( __( 'See all products (%s)', 'botiga' ), $query->post_count ) ); ?>
        <span class="bas-arrow">→</span>
    </a>
</div>
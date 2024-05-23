<?php
/**
 * Template part for displaying ajax search see all button.
 * 
 * This template can be overridden by copying it to yourtheme/template-parts/search/content-ajax-search-see-all-button.php.
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
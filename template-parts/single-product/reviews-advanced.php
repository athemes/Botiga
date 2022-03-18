<?php
/**
 * Template part for displaying reviews advanced content
 *
 * @package Botiga
 */

global $_product;
$product_id = $_product->get_id();

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$review_count = $_product->get_review_count();
$average      = $_product->get_average_rating();

// Dropdown sort
$orderby      = isset( $_GET['orderby'] ) ? $_GET['orderby'] : 'newest'; 

// Reviews bars rating
$bars_data = botiga_get_advanced_reviews_bars_rating_data( $product_id ); ?>

<section id="reviews" class="botiga-adv-reviews products">
    <h2 id="reviews-stars" class="text-center"><?php echo esc_html__( 'Why people love our products', 'botiga-pro' ); ?></h2>
    <p class="text-center"><?php echo esc_html__( 'High-quality, ethically sourced products at affordable prices', 'botiga-pro' ); ?></p>

    <div class="botiga-adv-reviews-header">
        <div class="row justify-content-between">
            <div class="col-12 col-md-auto">
                <div class="botiga-adv-reviews-rating-wrapper">
                    <strong class="botiga-adv-reviews-rating"><?php echo esc_html( $average ); ?></strong>
                    <div class="star-rating botiga-star-rating-style2" role="img" aria-label="Rated <?php echo esc_attr( $average ); ?> out of 5">
                        <span style="width: <?php echo ( ( $average / 5 ) * 100 ); ?>%;">
                            Rated %s out of 5 based on customer ratings.
                            <?php 
                            /* translators: %s is average rating value */
                            echo sprintf( esc_html__( 'Rated %s out of 5 based on customer ratings.', 'botiga' ), $average ); ?>
                        </span>
                    </div>
                </div>
                <p class="botiga-adv-reviews-total">
                    <?php 
                    /* translators: %s is review count */
                    echo sprintf( esc_html__( '%s Reviews', 'botiga' ), $review_count ); ?>
                </p>
                <div class="botiga-star-rating-bars">
                    <div class="botiga-star-rating-bar-item">
                        <p class="item-rating"><?php echo esc_html__( '5 Stars', 'botiga' ); ?></p>
                        <div class="item-bar">
                            <div class="item-bar-inner" style="width: <?php echo esc_attr( $bars_data[ '5-stars-percent' ] ); ?>%;"></div>
                        </div>
                        <p class="item-qty">
                            <?php 
                            /* translators: %s is stars quantity */
                            echo sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '5-stars' ] ); ?>
                        </p>
                    </div>
                    <div class="botiga-star-rating-bar-item">
                        <p class="item-rating"><?php echo esc_html__( '4 Stars', 'botiga' ); ?></p>
                        <div class="item-bar">
                            <div class="item-bar-inner" style="width: <?php echo esc_attr( $bars_data[ '4-stars-percent' ] ); ?>%;"></div>
                        </div>
                        <p class="item-qty">
                            <?php 
                            /* translators: %s is stars quantity */
                            echo sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '4-stars' ] ); ?>
                        </p>  
                    </div>
                    <div class="botiga-star-rating-bar-item">
                        <p class="item-rating"><?php echo esc_html__( '3 Stars', 'botiga' ); ?></p>
                        <div class="item-bar">
                            <div class="item-bar-inner" style="width: <?php echo esc_attr( $bars_data[ '3-stars-percent' ] ); ?>%;"></div>
                        </div>
                        <p class="item-qty">
                            <?php 
                            /* translators: %s is stars quantity */
                            echo sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '3-stars' ] ); ?>
                        </p>  
                    </div>
                    <div class="botiga-star-rating-bar-item">
                        <p class="item-rating"><?php echo esc_html__( '2 Stars', 'botiga' ); ?></p>
                        <div class="item-bar">
                            <div class="item-bar-inner" style="width: <?php echo esc_attr( $bars_data[ '2-stars-percent' ] ); ?>%;"></div>
                        </div>
                        <p class="item-qty">
                            <?php 
                            /* translators: %s is stars quantity */
                            echo sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '2-stars' ] ); ?>
                        </p>  
                    </div>
                    <div class="botiga-star-rating-bar-item">
                        <p class="item-rating"><?php echo esc_html__( '1 Stars', 'botiga' ); ?></p>
                        <div class="item-bar">
                            <div class="item-bar-inner" style="width: <?php echo esc_attr( $bars_data[ '1-stars-percent' ] ); ?>%;"></div>
                        </div>
                        <p class="item-qty">
                            <?php 
                            /* translators: %s is stars quantity */
                            echo sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '1-stars' ] ); ?>
                        </p>  
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-auto d-flex flex-direction-column">
                <a href="#" class="button botiga-adv-review-write-button"><?php echo esc_html__( 'Write a Review', 'botiga' ); ?></a>
                <form class="botiga-reviews-orderby-form" method="get" action="<?php echo esc_url( get_the_permalink( $product_id ) ); ?>#reviews-stars">
                    <select class="botiga-reviews-orderby" name="orderby" onChange="this.parentNode.submit();">
                        <option value="newest"<?php echo selected( $orderby, 'newest' ); ?>><?php echo esc_html__( 'Newest', 'botiga' ); ?></option>
                        <option value="oldest"<?php echo selected( $orderby, 'oldest' ); ?>><?php echo esc_html__( 'Oldest', 'botiga' ); ?></option>
                        <option value="top-rated"<?php echo selected( $orderby, 'top-rated' ); ?>><?php echo esc_html__( 'Top rated', 'botiga' ); ?></option>
                        <option value="low-rated"<?php echo selected( $orderby, 'low-rated' ); ?>><?php echo esc_html__( 'Low rated', 'botiga' ); ?></option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="botiga-adv-reviews-body">

        <?php if ( comments_open( $product_id ) ) : 
            $paged = get_query_var( 'cpage' );

            $pages = count( get_comments( array(
                'post_id' => $product_id,
                'fields' => 'ids'
            ) ) );

            $pages = $pages / get_option( 'comments_per_page' );

            // Get comments args
            $args = array(
                'post_id'  => $product_id,
                'number'   => get_option( 'comments_per_page' ),
                'paged'    => empty( $paged ) ? 1 : $paged
            );

            // Orderby
            switch ( $orderby ) {
                case 'newest':
                    $args[ 'order' ]   = 'DESC';
                    $args[ 'orderby' ] = 'comment_date_gmt';
                    break;

                case 'oldest':
                    $args[ 'order' ]   = 'ASC';
                    $args[ 'orderby' ] = 'comment_date_gmt';
                    break;

                case 'top-rated':
                    $args[ 'order' ]      = 'DESC';
                    $args[ 'orderby' ]    = 'meta_value_num';
                    $args[ 'meta_key' ]    = 'rating';
                    break;
                
                case 'low-rated':
                    $args[ 'order' ]      = 'ASC';
                    $args[ 'orderby' ]    = 'meta_value_num';
                    $args[ 'meta_key' ]    = 'rating';
                    break;
            }

            $comments = get_comments( apply_filters( 'botiga_wc_reviews_advanced_sorting_args', $args ) ); ?>

            <div id="comments">
                <?php if ( count( $comments ) > 0 ) : ?>
                    <div class="botiga-reviews-list-wrapper">
                        
                        <?php foreach( $comments as $comment ) : ?>
                            <div id="comment-<?php echo esc_attr( $comment->comment_ID ); ?>" class="botiga-reviews-list-item">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center">

                                            <?php 
                                            $comment_rating_value = get_comment_meta( $comment->comment_ID, 'rating', true ); ?>

                                            <div class="star-rating botiga-star-rating-style2" role="img" aria-label="Rated <?php echo esc_attr( $comment_rating_value ); ?>.00 out of 5">
                                                <span style="width: <?php echo ( ( $comment_rating_value / 5 ) * 100 ); ?>%;">
                                                    Rated <?php echo esc_html( $comment_rating_value ); ?>.00</strong> out of 5 based on customer ratings.
                                                    <?php  ?>
                                                </span>
                                            </div>
                                            <strong class="botiga-review-author">
                                                <?php echo esc_html( get_comment_author( $comment ) ); ?>
                                            </strong>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <time class="botiga-review-date" datetime="<?php echo esc_attr( get_comment_date( 'c', $comment ) ); ?>"><?php echo esc_html( get_comment_date( 'F j, Y', $comment ) ); ?></time>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="botiga-review-content">
                                            <?php comment_text( $comment ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php else : ?>
                    <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
                <?php endif; ?>
            </div>

        <?php endif; ?>

    </div>
    <?php if ( count( $comments ) > 0 ) {
        echo '<div class="botiga-adv-reviews-footer text-center">';
        
            if ( $pages > 1 && get_option( 'page_comments' ) ) {
                $nav_type = get_theme_mod( 'shop_single_adv_reviews_nav', 'default' );

                if( $nav_type === 'default' ) {
                    echo '<nav class="woocommerce-pagination botiga-adv-reviews-pagination">';
                        botiga_paginate_advanced_reviews_links(
                            apply_filters(
                            'botiga_advanced_reviews_pagination_args',
                                array(
                                    'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
                                    'next_text' => is_rtl() ? '&larr;' : '&rarr;',
                                    'type'      => 'list',
                                )
                            ),
                            $pages,
                            $product_id
                        );
                    echo '</nav>';

                    do_action( 'botiga_after_shop_reviews_adv_pagination' );
                }
            }

        echo '</div>';
    } ?>
</section>


<?php
/**
 * Template part for displaying reviews advanced content
 *
 * @package Botiga
 */
// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
global $product;
$_product = $product;
$product_id   = $_product->get_id();
$review_count = $_product->get_review_count();
$average      = $_product->get_average_rating();

// Dropdown sort
$default_sorting   = get_theme_mod( 'single_product_reviews_advanced_default_sorting', 'newest' );
$sort_orderby      = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : $default_sorting; 

// Reviews bars rating
$bars_data = botiga_get_advanced_reviews_bars_rating_data( $product_id ); ?>

<section id="reviews" class="botiga-adv-reviews products">
    <h2 id="reviews-stars" class="text-center"><?php echo esc_html__( 'Why people love our products', 'botiga' ); ?></h2>
    <p class="text-center"><?php echo esc_html__( 'High-quality, ethically sourced products at affordable prices', 'botiga' ); ?></p>

    <div class="botiga-adv-reviews-header">
        <div class="row justify-content-between<?php echo ( $bars_data[ 'total' ] === 0 ) ? ' align-items-center' : ''; ?>">
            <div class="col-12 col-md-auto">

                <?php if( wc_review_ratings_enabled() && $bars_data[ 'total' ] > 0 ) : ?>
                <div class="botiga-adv-reviews-rating-wrapper">
                    <strong class="botiga-adv-reviews-rating"><?php echo esc_html( $average ); ?></strong>
                    <div class="star-rating botiga-star-rating-style2" role="img" aria-label="Rated <?php echo esc_attr( $average ); ?> out of 5">
                        <span style="width: <?php echo esc_attr( ( ( $average / 5 ) * 100 ) ); ?>%;">
                            <?php 
                            /* translators: %s is average rating value */
                            $rating_text = sprintf( __( 'Rated %s out of 5 based on customer ratings.', 'botiga' ), $average );
                            echo esc_html( $rating_text ); ?>
                        </span>
                    </div>
                </div>
                <?php endif; ?>
                
                <p class="botiga-adv-reviews-total">
                    <?php 
                    if( $review_count > 0 ) {
                        /* translators: %s is review count */
                        $review_count_text = sprintf( _nx( '%s Review', '%s Reviews', $review_count, 'review count', 'botiga' ), number_format_i18n( $review_count ) );
                        echo esc_html( $review_count_text );
                    } else {
                        echo esc_html__( 'Be the first to leave a review.', 'botiga' );
                    } ?>
                </p>

                <?php if( wc_review_ratings_enabled() && $bars_data[ 'total' ] > 0 ) : ?>
                <div class="botiga-star-rating-bars">
                    <div class="botiga-star-rating-bar-item">
                        <p class="item-rating"><?php echo esc_html__( '5 Stars', 'botiga' ); ?></p>
                        <div class="item-bar">
                            <div class="item-bar-inner" style="width: <?php echo esc_attr( $bars_data[ '5-stars-percent' ] ); ?>%;"></div>
                        </div>
                        <p class="item-qty">
                            <?php 
                            /* translators: %s is stars quantity */
                            $five_star_text = sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '5-stars' ] );
                            echo esc_html( $five_star_text ); ?>
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
                            $four_star_text = sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '4-stars' ] );
                            echo esc_html( $four_star_text ); ?>
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
                            $three_star_text = sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '3-stars' ] );
                            echo esc_html( $three_star_text ); ?>
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
                            $two_star_text = sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '2-stars' ] );
                            echo esc_html( $two_star_text ); ?>
                        </p>  
                    </div>
                    <div class="botiga-star-rating-bar-item">
                        <p class="item-rating"><?php echo esc_html__( '1 Star', 'botiga' ); ?></p>
                        <div class="item-bar">
                            <div class="item-bar-inner" style="width: <?php echo esc_attr( $bars_data[ '1-stars-percent' ] ); ?>%;"></div>
                        </div>
                        <p class="item-qty">
                            <?php 
                            /* translators: %s is stars quantity */
                            $one_star_text = sprintf( esc_html__( '(%s)', 'botiga' ), $bars_data[ '1-stars' ] );
                            echo esc_html( $one_star_text ); ?>
                        </p>  
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <div class="col-12 col-md-auto d-flex flex-direction-column">
                <a href="#" class="button botiga-adv-review-write-button"><?php echo esc_html__( 'Write a Review', 'botiga' ); ?></a>

                <?php if( $review_count > 0 ) : ?>
                <form class="botiga-reviews-orderby-form" method="get" action="<?php echo esc_url( get_the_permalink( $product_id ) ); ?>#reviews-stars">
                    <label for="botiga-reviews-orderby" class="screen-reader-text"><?php echo esc_html__( 'Sort by', 'botiga' ); ?></label>
                    <select id="botiga-reviews-orderby" class="botiga-reviews-orderby" name="orderby" onChange="this.parentNode.submit();">
                        <option value="newest"<?php echo selected( $sort_orderby, 'newest' ); ?>><?php echo esc_html__( 'Newest', 'botiga' ); ?></option>
                        <option value="oldest"<?php echo selected( $sort_orderby, 'oldest' ); ?>><?php echo esc_html__( 'Oldest', 'botiga' ); ?></option>
                        <option value="top-rated"<?php echo selected( $sort_orderby, 'top-rated' ); ?>><?php echo esc_html__( 'Top rated', 'botiga' ); ?></option>
                        <option value="low-rated"<?php echo selected( $sort_orderby, 'low-rated' ); ?>><?php echo esc_html__( 'Low rated', 'botiga' ); ?></option>
                    </select>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="botiga-adv-reviews-body">

        <?php if ( comments_open( $product_id ) ) : 
            // Get comments args
            $args = array(
                'post_id'  => $product_id,
                'number'   => get_option( 'page_comments' ) ? get_option( 'comments_per_page' ) : ''
            );

            // Pagination?
            $cpages = 0;
            if( get_option( 'page_comments' ) ) {
                $cpaged = get_query_var( 'cpage' );

                $cpages = count( get_comments( array(
                    'post_id' => $product_id,
                    'fields' => 'ids'
                ) ) );
    
                $cpages = $cpages / get_option( 'comments_per_page' );

                $args[ 'paged' ] = empty( $cpaged ) ? 1 : $cpaged;
            }

            // Orderby
            switch ( $sort_orderby ) {
                case 'newest':
                    $args[ 'order' ]   = 'DESC';
                    $args[ 'orderby' ] = 'comment_date_gmt';
                    break;

                case 'oldest':
                    $args[ 'order' ]   = 'ASC';
                    $args[ 'orderby' ] = 'comment_date_gmt';
                    break;

                case 'top-rated':
                    $args[ 'order' ]    = 'DESC';
                    $args[ 'orderby' ]  = 'meta_value_num';
                    $args[ 'meta_key' ] = 'rating';
                    break;
                
                case 'low-rated':
                    $args[ 'order' ]    = 'ASC';
                    $args[ 'orderby' ]  = 'meta_value_num';
                    $args[ 'meta_key' ] = 'rating';
                    break;
            }

            $comments = get_comments( apply_filters( 'botiga_wc_reviews_advanced_sorting_args', $args ) ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>

            <div id="comments">
                <?php if ( count( $comments ) > 0 ) : ?>
                    <div class="botiga-reviews-list-wrapper">
                        
                        <?php foreach( $comments as $comment ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                            if ( '1' === $comment->comment_approved ) : ?>

                                <div id="comment-<?php echo esc_attr( $comment->comment_ID ); ?>" class="botiga-reviews-list-item">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="d-flex align-items-center">

                                                <?php 
                                                $comment_rating_value = get_comment_meta( $comment->comment_ID, 'rating', true ); ?>

                                                <?php if( wc_review_ratings_enabled() ) : ?>
                                                    <div class="star-rating botiga-star-rating-style2" role="img" aria-label="Rated <?php echo esc_attr( $comment_rating_value ); ?>.00 out of 5">
                                                        <span style="width: <?php echo esc_attr( ( ( intval( $comment_rating_value ) / 5 ) * 100 ) ); ?>%;">
                                                            <?php 
                                                            /* translators: %s is average rating value */
                                                            $comment_rating_text = sprintf( __( 'Rated %s out of 5 based on customer ratings.', 'botiga' ), $comment_rating_value );
                                                            echo esc_html( $comment_rating_text ); ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <strong class="botiga-review-author">
                                                    <?php echo esc_html( get_comment_author( $comment ) ); ?>

                                                    <?php
                                                    /**
                                                     * Verified owner
                                                     */
                                                    $verified = wc_review_is_from_verified_owner( $comment->comment_ID );
                                                    if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
                                                        echo '<em class="woocommerce-review__verified verified">'. esc_attr__( ' — verified owner', 'botiga' ) . '</em> ';
                                                    } ?>
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3 botiga-review-date-wrapper">
                                            <time class="botiga-review-date" datetime="<?php echo esc_attr( get_comment_date( apply_filters( 'botiga_advanced_reviews_time_format', get_option( 'time_format' ) ), $comment ) ); ?>"><?php echo esc_html( get_comment_date( apply_filters( 'botiga_advanced_reviews_date_format', get_option( 'date_format' ) ), $comment ) ); ?></time>
                                        </div>
                                        <div class="col-12">
                                            <div class="botiga-review-content">
                                                <?php
                                                // We need to include the $comment variable here because some extra plugins like Germanized for WooCommerce use it.
                                                $comment = $comment; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

                                                do_action( 'woocommerce_review_before_comment_text', $comment ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Ensure compatibility with WooCommerce plugins

                                                comment_text( $comment ); 
                                                                                    
                                                do_action( 'woocommerce_review_after_comment_text', $comment ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Ensure compatibility with WooCommerce plugins
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php elseif( isset( $_GET['unapproved'] ) && $comment->comment_ID === $_GET['unapproved'] ) : ?>

                                <div id="comment-<?php echo esc_attr( $comment->comment_ID ); ?>" class="botiga-reviews-list-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center">

                                                <?php 
                                                $comment_rating_value = get_comment_meta( $comment->comment_ID, 'rating', true ); ?>

                                                <?php if( wc_review_ratings_enabled() ) : ?>
                                                    <div class="star-rating botiga-star-rating-style2" role="img" aria-label="Rated <?php echo esc_attr( $comment_rating_value ); ?>.00 out of 5">
                                                        <span style="width: <?php echo esc_attr( ( ( $comment_rating_value / 5 ) * 100 ) ); ?>%;">
                                                            <?php 
                                                            /* translators: %s is average rating value */
                                                            $comment_rating_text = sprintf( __( 'Rated %s out of 5 based on customer ratings.', 'botiga' ), $comment_rating_value );
                                                            echo esc_html( $comment_rating_text ); ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>

                                                <strong class="botiga-review-author">
                                                    <?php echo esc_html( get_comment_author( $comment ) ); ?>

                                                    <?php
                                                    /**
                                                     * Verified owner
                                                     */
                                                    $verified = wc_review_is_from_verified_owner( $comment->comment_ID );
                                                    if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
                                                        echo '<em class="woocommerce-review__verified verified">'. esc_attr__( ' — verified owner', 'botiga' ) . '</em> ';
                                                    } ?>
                                                </strong>
                                            </div>
                                            <br>
                                            <em><?php echo esc_html__( 'Your review is awaiting approval.', 'botiga' ); ?></em>
                                        </div>
                                    </div>
                                </div>

                            <?php endif;
                        endforeach; ?>

                    </div>

                <?php else : ?>
                    <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'botiga' ); ?></p>
                <?php endif; ?>
            </div>

        <?php endif; ?>

    </div>
    <?php if ( isset( $comments ) && count( $comments ) > 0 ) {
        echo '<div class="botiga-adv-reviews-footer text-center">';
        
            if ( $cpages > 1 && get_option( 'page_comments' ) ) {
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
                        $cpages,
                        $product_id
                    );
                echo '</nav>';

                do_action( 'botiga_after_shop_reviews_adv_pagination' );
            }

        echo '</div>';
    } ?>
</section>
<?php // @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Botiga
 */

if ( ! function_exists( 'botiga_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function botiga_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'botiga_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function botiga_posted_by() {
		global $post;
		$author = $post->post_author;
		$show_avatar = get_theme_mod( 'show_avatar', 0 );

		$byline = '<span class="author vcard">';
		if ( $show_avatar ) {
			$byline .= get_avatar( get_the_author_meta( 'email', $author ) , 16 );
		}
		$byline .= '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'botiga_post_categories' ) ) :
	function botiga_post_categories() {
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'botiga' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}		
	}
endif;

if ( ! function_exists( 'botiga_entry_comments' ) ) :
	function botiga_entry_comments() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( '0 comments', 'botiga' ), esc_html__( '1 comment', 'botiga' ), esc_html__( '% comments', 'botiga' ) );
			echo '</span>';
		}		
	}
endif;


if ( ! function_exists( 'botiga_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function botiga_entry_footer() {

		$single_post_show_tags = get_theme_mod( 'single_post_show_tags', 1 );

		if ( !$single_post_show_tags ) {
			return;
		}

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'botiga' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'botiga' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'botiga_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function botiga_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'botiga-large'); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
	function wp_body_open() {
		do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
	}
endif;

if ( ! function_exists( 'botiga_single_post_meta' ) ) :
	/**
	 * Single post meta
	 */
	function botiga_single_post_meta( $location ) {
		
		$elements 				= get_theme_mod( 'single_post_meta_elements', array( 'botiga_posted_on', 'botiga_posted_by' ) );
		$archive_meta_delimiter = get_theme_mod( 'archive_meta_delimiter', 'none' );

		echo '<div class="entry-meta ' . esc_attr( $location ) . ' delimiter-' . esc_attr( $archive_meta_delimiter ) . '">';
		foreach( $elements as $element ) {
			call_user_func( $element );
		}			
		echo '</div>';		
	}
endif;

/**
 * Single post navigation
 */
function botiga_single_post_navigation() {

	$single_post_show_post_nav = get_theme_mod( 'single_post_show_post_nav', 1 );

	if ( !$single_post_show_post_nav ) {
		return;
	}

	the_post_navigation(
		array(
			'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'botiga' ) . '</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'botiga' ) . '</span> <span class="nav-title">%title</span>',
		)
	);
}
add_action( 'botiga_after_single_post_content', 'botiga_single_post_navigation', 11 );

/**
 * Post author bio
 */
function botiga_post_author_bio() {

	$single_post_show_author_box = get_theme_mod( 'single_post_show_author_box', 0 );

	if ( !$single_post_show_author_box ) {
		return;
	}

	?>
	<div class="single-post-author">
		<div class="author-avatar vcard">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>
		</div>

		<div class="author-content">
			<h3 class="author-name">
				<?php
					printf(
						/* translators: %s: Author name */
						esc_html__( 'By %s', 'botiga' ),
						esc_html( get_the_author() )
					);
				?>
			</h3>		
			<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php
					printf(
						/* translators: %s: Author name */
						__( 'See all posts by %s <span aria-hidden="true">&rarr;</span>', 'botiga' ),// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						esc_html( get_the_author() )
					);
				?>
			</a>
		</div>
	</div>
	<?php
}
add_action( 'botiga_after_single_post_content', 'botiga_post_author_bio', 21 );

/**
 * Related posts
 */
function botiga_related_posts() {

	$single_post_show_related_posts = get_theme_mod( 'single_post_show_related_posts', 0 );

	if ( !$single_post_show_related_posts ) {
		return;
	}

    $post_id 	= get_the_ID();
    $cat_ids 	= array();
    $categories = get_the_category( $post_id );

    if(	!empty($categories) && !is_wp_error( $categories ) ):
        foreach ( $categories as $category ):
            array_push( $cat_ids, $category->term_id );
        endforeach;
    endif;

    $query_args = array( 
        'category__in'   	=> $cat_ids,
        'post__not_in'    	=> array( $post_id ),
        'posts_per_page'  	=> '3',
     );

    $related_cats_post = new WP_Query( $query_args );

    if( $related_cats_post->have_posts()) :
		echo '<div class="botiga-related-posts">';
			echo '<div class="row">';
			while( $related_cats_post->have_posts() ): $related_cats_post->the_post(); ?>
				<div class="col-md-4">
					<div class="related-post">
						<?php 
							botiga_post_thumbnail();
							botiga_posted_on();
							the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
						?>
					</div>
				</div>
			<?php endwhile;
			echo '</div>';
		echo '</div>';

        wp_reset_postdata();
     endif;

}
add_action( 'botiga_after_single_post_content', 'botiga_related_posts', 31 );

/**
 * Post comments
 */
function botiga_single_post_comments() {
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
add_action( 'botiga_after_single_post_content', 'botiga_single_post_comments', 41 );


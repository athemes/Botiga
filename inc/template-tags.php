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
		$time_string = '<time class="entry-date published updated" datetime="%1$s" ' . botiga_get_schema( 'published_date' ) . '>%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s" ' . botiga_get_schema( 'published_date' ) . '>%2$s</time><time class="updated" datetime="%3$s"' . botiga_get_schema( 'modified_date' ) . '>%4$s</time>';
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

		$byline = '<span class="author vcard" '. botiga_get_schema( 'author' ) .'>';
		if ( $show_avatar ) {
			$byline .= get_avatar( get_the_author_meta( 'email', $author ) , 16 );
		}
		$byline .= '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" '. botiga_get_schema( 'author_url' ) .'>' . esc_html( get_the_author() ) . '</a></span>';

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

if ( ! function_exists( 'botiga_post_reading_time' ) ) :
	function botiga_post_reading_time() {
		global $post;

		/**
		 * Hook 'botiga_post_reading_time_words_per_minute'
		 *
		 * @since 1.0.0
		 */
		$words_per_min = apply_filters( 'botiga_post_reading_time_words_per_minute', 300 );

		$words = str_word_count(wp_strip_all_tags($post->post_content));
		$m     = $words / $words_per_min;
		$mins  = ( $m < 1 ? '1' : ceil($m) );

		/* translators: 1: time. */
		$time  = sprintf( _n( '%1$s min read', '%1$s mins read', $mins, 'botiga' ), $mins );

		echo '<span class="reading-time">';
			echo esc_html( $time ); 
		echo '</span>';
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
			$blog_single_layout = get_theme_mod( 'blog_single_layout', 'layout1' );
			switch ( $blog_single_layout ) {
				case 'layout1':
					$thumbnail_size = 'botiga-large';
					break;
				
				case 'layout2':
					$thumbnail_size = 'botiga-extra-large';
					break;

				case 'layout3':
					$thumbnail_size = 'full';
					break;
			} ?>

			<div class="post-thumbnail" <?php botiga_schema( 'thumbnail' ); ?>>
				<?php the_post_thumbnail( $thumbnail_size ); ?>
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
		do_action( 'wp_body_open' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound, WooCommerce.Commenting.CommentHooks.MissingHookComment
	}
endif;

if ( ! function_exists( 'botiga_single_post_meta' ) ) :
	/**
	 * Single post meta
	 */
	function botiga_single_post_meta( $location ) {
		
		$elements               = get_theme_mod( 'single_post_meta_elements', array( 'botiga_posted_on', 'botiga_posted_by' ) );
		$archive_meta_delimiter = get_theme_mod( 'archive_meta_delimiter', 'none' );

		echo '<div class="entry-meta ' . esc_attr( $location ) . ' delimiter-' . esc_attr( $archive_meta_delimiter ) . '">';
		foreach( $elements as $element ) {
			if( function_exists( $element ) ) {
				call_user_func( $element );
			}
		}           
		echo '</div>';      
	}
endif;

if ( ! function_exists( 'botiga_single_post_share_box' ) ) :
	/**
	 * Single post share box
	 */
	function botiga_single_post_share_box() {
		$enable = get_theme_mod( 'single_post_share_box', 0 );

		if ( !$enable ) {
			return;
		}

		global $post;

		$post_url       = rawurlencode( esc_url( get_permalink($post->ID) ) );
		$post_title     = rawurlencode( $post->post_title );
		$sharing_title  = get_theme_mod( 'single_post_share_box_title', esc_html__( 'SHARE:', 'botiga' ) );

		$enabled_networks = get_theme_mod( 'single_post_share_box_networks', array( 'facebook', 'twitter', 'linkedin' ) );

		$networks = array(
			'facebook'  => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://www.facebook.com/sharer.php?u={url}' ) ),
				'tooltip'   => esc_html__( 'Facebook', 'botiga' ),
			),
			'twitter'   => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://twitter.com/intent/tweet?url={url}&text={title}' ) ),
				'tooltip'   => esc_html__( 'Twitter', 'botiga' ),
			),
			'linkedin'  => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://www.linkedin.com/sharing/share-offsite/?url={url}' ) ),
				'tooltip'   => esc_html__( 'LinkedIn', 'botiga' ),
			),
			'reddit'    => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://reddit.com/submit?url={url}&title={title}' ) ),
				'tooltip'   => esc_html__( 'Reddit', 'botiga' ),
			),
			'whatsapp'  => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://api.whatsapp.com/send/?text={{url}}' ) ),
				'tooltip'   => esc_html__( 'WhatsApp', 'botiga' ),
			),
			'pinterest'     => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'http://pinterest.com/pin/create/link/?url={url}' ) ),
				'tooltip'   => esc_html__( 'Pinterest', 'botiga' ),
			),
			'telegram'  => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://t.me/share/url?url={url}&text={title}' ) ),
				'tooltip'   => esc_html__( 'Telegram', 'botiga' ),
			),
			'weibo'     => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'http://service.weibo.com/share/share.php?url={url}&appkey=&title={title}&pic=&ralateUid=' ) ),
				'tooltip'   => esc_html__( 'Weibo', 'botiga' ),
			),
			'vk'    => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'http://vk.com/share.php?url={url}&title={title}&comment={text}' ) ),
				'tooltip'   => esc_html__( 'VK', 'botiga' ),
			),
			'ok'    => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl={url}' ) ),
				'tooltip'   => esc_html__( 'OK', 'botiga' ),
			),      
			'xing'  => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'https://www.xing.com/spi/shares/new?url={url}' ) ),
				'tooltip'   => esc_html__( 'Xing', 'botiga' ),
			),      
			'mail'  => array(
				'url'       => str_replace( '{title}', $post_title, str_replace( '{url}', $post_url, 'mailto:?subject=' . $post->post_title . '&body={url}' ) ),
				'tooltip'   => esc_html__( 'Mail', 'botiga' ),
			),
			'copyclipboard' => array(
				'url'       => $post_url,
				'tooltip'   => esc_html__( 'Copy Link', 'botiga' ),
			),
		); ?>

		<div class="botiga-share-box">
			<div class="row">
				<?php if( $sharing_title ) : ?>
					<div class="col-auto">
						<strong><?php echo esc_html( $sharing_title ); ?></strong>
					</div>
				<?php endif; ?>
				<div class="col-auto">
					<div class="botiga-share-box-items-wrapper">

						<?php foreach ( $enabled_networks as $network ) : 
							if( $network !== 'copyclipboard' ) : ?>
								<div class="botiga-share-box-item">
									<a href="<?php echo esc_url( $networks[ $network ]['url'] ); ?>" title="<?php echo esc_attr( $networks[ $network ][ 'tooltip' ] ); ?>" target="_blank" data-botiga-tooltip="<?php echo esc_attr( $networks[ $network ][ 'tooltip' ] ); ?>">
										<?php botiga_get_svg_icon( 'icon-'. $network, true ); ?>
									</a>
								</div>
							<?php else : ?>
								<div class="botiga-share-box-item">
									<a href="#" title="<?php echo esc_attr( $networks[ $network ][ 'tooltip' ] ); ?>" onclick="botiga.copyLinkToClipboard.init(event, this);" data-botiga-tooltip="<?php echo esc_attr( $networks[ $network ][ 'tooltip' ] ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path>
										</svg>
									</a>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>

					</div>	
				</div>
			</div>
		</div>

		<?php
	}
	add_action( 'botiga_after_single_post_content', 'botiga_single_post_share_box', 10 );
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

	$single_post_show_author_box  = get_theme_mod( 'single_post_show_author_box', 0 );
	$single_post_author_box_align = get_theme_mod( 'single_post_author_box_align', 'center' );

	if ( !$single_post_show_author_box ) {
		return;
	}

	?>
	<div class="single-post-author single-post-author-<?php echo esc_attr( $single_post_author_box_align ); ?>">
		<div class="author-avatar vcard">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>
		</div>

		<div class="author-content">
			<h3 class="author-name" <?php botiga_schema( 'author' ); ?>>
				<?php
					printf(
						/* translators: %s: Author name */
						esc_html__( 'By %s', 'botiga' ),
						esc_html( get_the_author() )
					);
				?>
			</h3>		
			<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" <?php botiga_schema( 'author_url' ); ?>>
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

	$single_post_show_related_posts           = get_theme_mod( 'single_post_show_related_posts', 0 );
	$single_post_related_posts_number         = get_theme_mod( 'single_post_related_posts_number', 3 );
	$single_post_related_posts_columns_number = get_theme_mod( 'single_post_related_posts_columns_number', 3 );
	$single_post_related_posts_slider         = get_theme_mod( 'single_post_related_posts_slider', 0 );
	$single_post_related_posts_slider_nav     = get_theme_mod( 'single_post_related_posts_slider_nav', 'always-show' );

	if ( !$single_post_show_related_posts ) {
		return;
	}

    $post_id    = get_the_ID();
    $cat_ids    = array();
    $categories = get_the_category( $post_id );

    if( !empty($categories) && !is_wp_error( $categories ) ):
        foreach ( $categories as $category ):
            array_push( $cat_ids, $category->term_id );
        endforeach;
    endif;

    $query_args = array( 
        'category__in'      => $cat_ids,
        'post__not_in'      => array( $post_id ),
        'posts_per_page'    => $single_post_related_posts_number,
    );

    $related_cats_post = new WP_Query( $query_args );

	$wrapper_atts = array();
	$wrapper_classes = array( 'botiga-related-posts' );

	if( $single_post_related_posts_slider && $single_post_related_posts_number > $single_post_related_posts_columns_number ) {
		wp_enqueue_script( 'botiga-carousel' );

		$wrapper_classes[] = 'botiga-carousel botiga-carousel-nav2';

		if( $single_post_related_posts_slider_nav === 'always-show' ) {
			$wrapper_classes[] = 'botiga-carousel-nav2-always-show';
		}

		$wrapper_atts[] = 'data-per-page="'. absint( $single_post_related_posts_columns_number ) .'"';
	}

	// Mount related posts wrapper class
	$wrapper_atts[] = 'class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

	// Columns class
	$column_class = botiga_get_column_class( $single_post_related_posts_columns_number );

    if( $related_cats_post->have_posts()) :
		echo '<div '. implode( ' ', $wrapper_atts ) .'>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
			echo '<div class="row'. ( $single_post_related_posts_slider ? ' botiga-carousel-stage' : '' ) .'">';
			while( $related_cats_post->have_posts() ): $related_cats_post->the_post(); ?>
				<div class="<?php echo esc_attr( $column_class ); ?>">
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

/**
 * Prints the page content.
 * 
 */
if ( ! function_exists( 'botiga_page_content' ) ) :
	function botiga_page_content() {

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
	}
	add_action( 'botiga_do_page_content', 'botiga_page_content' );
endif;

/**
 * Prints the single post content.
 * 
 */
if ( ! function_exists( 'botiga_single_content' ) ) :
	function botiga_single_content() {

		while ( have_posts() ) :
			the_post();

			/**
			 * Hook 'botiga_before_single_post_content'
			 *
			 * @since 1.0.0
			 */
			do_action( 'botiga_before_single_post_content' );

			get_template_part( 'template-parts/content', 'single' );

			/**
			 * Hook 'botiga_after_single_post_content'
			 *
			 * @since 1.0.0
			 */
			do_action( 'botiga_after_single_post_content' );

		endwhile; // End of the loop.
	}
	add_action( 'botiga_do_single_content', 'botiga_single_content' );
endif;

/**
 * Prints the archive pages content.
 * 
 */
if ( ! function_exists( 'botiga_archive_content' ) ) :
	function botiga_archive_content() { 
		
		?>

		<?php if ( have_posts() ) : 
			/**
			 * Hook 'botiga_blog_layout_class'
			 *
			 * @since 1.0.0
			 */
			$blog_layout_class = apply_filters( 'botiga_blog_layout_class', 'layout3' );
			?>
			<div class="posts-archive <?php echo esc_attr( $blog_layout_class ); ?>" <?php botiga_masonry_data(); ?>>
				<div class="row">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile; ?>
				</div>
			</div>
		<?php	
		the_posts_pagination( array(
			'mid_size'  => 1,
			'prev_text' => '&#x2190;',
			'next_text' => '&#x2192;',
		) );

		/**
		 * Hook 'botiga_after_the_posts_pagination'
		 *
		 * @since 1.0.0
		 */
		do_action( 'botiga_after_the_posts_pagination' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		?>

		<?php
	}
	add_action( 'botiga_do_archive_content', 'botiga_archive_content' );
endif;

/**
 * Prints the 404 page content.
 */
if ( ! function_exists( 'botiga_404_page_content' ) ) :
	function botiga_404_page_content() { ?>
		
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title" <?php botiga_schema( 'headline' ); ?>><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'botiga' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content" <?php botiga_schema( 'entry_content' ); ?>>
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'botiga' ); ?></p>

				<div class="search404">
					<?php
					get_search_form();
					?>
				</div>

				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<div class="products404">
						<h2 class="bt-h3"><?php esc_html_e( 'Most Popular', 'botiga' ); ?></h2>
						<?php echo do_shortcode('[products limit="4" columns="4" orderby="popularity"]'); ?>
					</div>					
				<?php endif; ?>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

		<?php
	}
	add_action( 'botiga_404_content', 'botiga_404_page_content' );
endif;
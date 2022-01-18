<?php
/**
 * Posts archive class
 *
 * @package Botiga
 */


if ( !class_exists( 'Botiga_Posts_Archive' ) ) :
	Class Botiga_Posts_Archive {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			
			add_action( 'wp', array( $this, 'filters' ) );
			add_action( 'botiga_loop_post', array( $this, 'post_markup' ) );
			add_filter( 'botiga_blog_layout_class', array( $this, 'blog_layout' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		}

		public function enqueue() {
			if ( 'layout5' === $this->blog_layout() ) {
				wp_enqueue_script('jquery');
				wp_enqueue_script('jquery-masonry');
			}
		}

		/**
		 * Filters
		 */
		public function filters() {
			if ( is_singular() || is_404() || ( class_exists( 'Woocommerce' ) && is_woocommerce() ) ) {
				return;
			}

			$sidebar = get_theme_mod( 'sidebar_archives', 0 );
			if ( 0 == $sidebar ) {
				add_filter( 'botiga_content_class', function() { return 'no-sidebar'; } );
				add_filter( 'botiga_sidebar', '__return_false' );
			}

			add_filter( 'post_class', array( $this, 'post_classes' ) );
		}

		public function post_classes( $classes ) {
			$text_align = get_theme_mod( 'archive_text_align', 'center' );
			$columns 	= get_theme_mod( 'archives_grid_columns', '3' );
			$columns	= 'col-lg-' . 12/$columns . ' col-md-' . 12/$columns;
			$classes[] 	= 'post-align-' . esc_attr( $text_align );

			$vertical_align = get_theme_mod( 'archives_list_vertical_alignment', 'middle' );
			$classes[] = 'post-vertical-align-' . esc_attr( $vertical_align );


			if ( 'layout3' === $this->blog_layout() || 'layout5' === $this->blog_layout() ) {
				$classes[] = $columns;
			} else {
				$classes[] = 'col-md-12';
			}

			return $classes;
		}

		/**
		* Blog layout
		*/
		public function blog_layout() {
			$layout = get_theme_mod( 'blog_layout', 'layout3' );

			if( ! $layout || $layout === 'Right'  ) {
				$layout = 'layout3';
			}

			return $layout;
		}

		/**
		 * Default meta elements
		 */
		public function default_meta_elements() {
			return array( 'post_date' );
		}

		/**
		 * Create the archive posts
		 */
		public function post_markup() {

			$layout 			= $this->blog_layout();
			$image_placement 	= get_theme_mod( 'archive_list_image_placement', 'left' );
			$meta_position 		= get_theme_mod( 'archive_meta_position', 'above-title' );

			switch ( $layout ) {
				case 'layout3':
				case 'layout5':
					$this->post_image();
					if ( 'above-title' === $meta_position ) {
						$this->post_meta();
					}
					$this->post_title();
					$this->post_excerpt();
					if ( 'below-excerpt' === $meta_position ) {
						$this->post_meta();
					}

					break;

				case 'layout1':	
					$this->post_image();
					if ( 'above-title' === $meta_position ) {
						$this->post_meta();
					}
					$this->post_title();
					$this->post_excerpt();	
					if ( 'below-excerpt' === $meta_position ) {
						$this->post_meta();
					}

					break;

				case 'layout2':	
					if ( 'above-title' === $meta_position ) {
						$this->post_meta();
					}
					$this->post_title();
					$this->post_image();
					$this->post_excerpt();	
					if ( 'below-excerpt' === $meta_position ) {
						$this->post_meta();
					}

					break;	
					
				case 'layout4':	
				case 'layout6':
					echo '<div class="list-image image-' . esc_attr( $image_placement ) . '">';
					$this->post_image();
					echo '</div>';

					echo '<div class="list-content">';
					if ( 'above-title' === $meta_position ) {
						$this->post_meta();
					}
					$this->post_title();
					$this->post_excerpt();
					if ( 'below-excerpt' === $meta_position ) {
						$this->post_meta();
					}					
					echo '</div>';	
					
					break;						
			}
		}

		/**
		 * Post image
		 */
		public function post_image() {
			botiga_post_thumbnail();
		}

		/**
		 * Post meta
		 */
		public function post_meta() {

			$elements 				= get_theme_mod( 'archive_meta_elements', $this->default_meta_elements() );
			$archive_meta_delimiter = get_theme_mod( 'archive_meta_delimiter', 'none' );

			if ( 'post' !== get_post_type() || empty( $elements ) ) {
				return;
			}

			echo '<div class="entry-meta delimiter-' . esc_attr( $archive_meta_delimiter ) . '">';
			foreach( $elements as $element ) {
				call_user_func( array( $this, $element ) );
			}			
			echo '</div>';
		}	
		
		/**
		 * Post title
		 */
		public function post_title() {
			?>

			<header class="entry-header">
				<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>
			</header><!-- .entry-header -->
			<?php
		}	

		/**
		 * Post excerpt
		 */
		public function post_excerpt() {
			$excerpt 	= get_theme_mod( 'show_excerpt', 1 );
			$read_more 	= get_theme_mod( 'read_more_link', 0 );

			if ( !$excerpt ) {
				return;
			}
			
			echo '<div class="entry-content">';
			the_excerpt();

			if ( $read_more ) {
				echo '<a title="' . esc_attr( strip_tags( get_the_title() ) ) . '" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read more', 'botiga' ) . '</a>';
			}
			echo '</div>';
		}
		
		/**
		 * Post date
		 */
		public function post_date() {
			botiga_posted_on();
		}

		/**
		 * Post author
		 */
		public function post_author() {
			botiga_posted_by();
		}	
		
		/**
		 * Post categories
		 */
		public function post_categories() {
			botiga_post_categories();
		}

		/**
		 * Post comments
		 */
		public function post_comments() {
			botiga_entry_comments();
		}		
	}

	/**
	 * Initialize class
	 */
	Botiga_Posts_Archive::get_instance();

endif;
<?php
/**
 * Footer class
 *
 * @package Botiga
 */

if ( !class_exists( 'Botiga_Footer' ) ) :
	Class Botiga_Footer {

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
			add_action( 'botiga_footer', array( $this, 'footer_widgets' ), 9 );
			add_action( 'botiga_footer', array( $this, 'footer_markup' ) );
			add_action( 'botiga_footer_after', array( $this, 'scroll_to_top') );
		}

		/**
		 * Widgets
		 */
		public function footer_widgets() {
			$container 	= get_theme_mod( 'footer_container', 'container' );
			$layout 	= get_theme_mod( 'footer_widgets', 'col3' );
			$alignment 	= get_theme_mod( 'footer_widgets_alignment', 'top' );
			$visibility = get_theme_mod( 'footer_widgets_visibility', 'all' );

			if ( !is_active_sidebar( 'footer-1' ) || 'disabled' === $layout ) {
				return;
			}

			switch ($layout) {

				case 'col4':
				case 'col4-bigleft':
				case 'col4-bigright':	
					$columns 	= 'col-3';
					$column_no  = 4;
					break;

				case 'col3':
				case 'col3-bigleft':
				case 'col3-bigright':
					$columns = 'col-4';
					$column_no  = 3;
					break;

				case 'col2':
				case 'col2-bigleft':
				case 'col2-bigright':
					$columns = 'col-6';
					$column_no  = 2;
					break;

				default:
					$columns = 'col-12';
					$column_no  = 1;
					break;
			}

			?>
			<div class="footer-widgets visibility-<?php echo esc_attr( $visibility ); ?>">
				<div class="<?php echo esc_attr( $container ); ?>">
					<div class="footer-widgets-grid <?php echo esc_attr( $layout ); ?> align-<?php echo esc_attr( $alignment ); ?>">
					<?php for ( $i = 1; $i <= $column_no; $i++ ) { ?>
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
						<div class="widget-column">
							<?php dynamic_sidebar( 'footer-' . $i); ?>
						</div>
						<?php endif; ?>	
					<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Markup for the footer
		 */
		public function footer_markup() {
			$container 	= get_theme_mod( 'footer_credits_container', 'container' );
			?>
			<footer id="colophon" class="site-footer">
				<div class="<?php echo esc_attr( $container ); ?>">
					<div class="site-info">
						<div class="row">
							<div class="col-md-6">
								<?php botiga_social_profile( 'social_profiles_footer' ); ?>
							</div>
							<div class="col-md-6">
								<div class="botiga-credits">
									<?php echo wp_kses_post( $this->footer_credits() ); ?>
								</div>
							</div>
						</div>
					</div>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
			<?php
		}

		/**
		 * Credits
		 */
		public function footer_credits() {

			/* translators: %1$1s, %2$2s theme copyright tags*/
			$credits 	= get_theme_mod( 'footer_credits', sprintf( esc_html__( '%1$1s. Proudly powered by %2$2s', 'botiga' ), '{copyright} {year} {site_title}', '{theme_author}' ) );

			$tags 		= array( '{theme_author}', '{site_title}', '{copyright}', '{year}' );
			$replace 	= array( '<a rel="nofollow" href="https://athemes.com/theme/botiga/">' . esc_html__( 'Botiga', 'botiga' ) . '</a>', get_bloginfo( 'name' ), '&copy;', date('Y') );

			$credits 	= str_replace( $tags, $replace, $credits );

			return $credits;
		}

		/**
		 * Back to top icon
		 */
		public function scroll_to_top() {
			$enable = get_theme_mod( 'enable_scrolltop', 1 );

			if ( !$enable ) {
				return;
			}

			$type 		= get_theme_mod( 'scrolltop_type', 'icon' );			
			$text 		= get_theme_mod( 'scrolltop_text', esc_html__( 'Back to top', 'botiga' ) );	
			$icon		= get_theme_mod( 'scrolltop_icon', 'icon1' );
			$visibility = get_theme_mod( 'scrolltop_visibility', 'all' );
			$position 	= get_theme_mod( 'scrolltop_position', 'right' );

			echo '<div class="back-to-top visibility-' . esc_attr( $visibility ) . ' position-' . esc_attr( $position ) . '">';
			if ( 'text' === $type ) {
				echo '<span>' . esc_html( $text ) . '</span>';
			}
			echo 	'<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-btt-' . $icon, false ) . '</i>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
		}
	}

	/**
	 * Initialize class
	 */
	Botiga_Footer::get_instance();

endif;
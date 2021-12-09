<?php
/**
 * Header class class
 *
 * @package Botiga
 */

if ( !class_exists( 'Botiga_Top_Bar' ) ) :
	Class Botiga_Top_Bar {

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
			add_action( 'botiga_header', array( $this, 'topbar_markup' ), 5 );
		}

		/**
		 * Desktop header markup
		 */
		public function topbar_markup() {
			$enable 	= get_theme_mod( 'enable_top_bar', 0 );

			if ( !$enable ) {
				return;
			}

			$container 	= get_theme_mod( 'topbar_container', 'container-fluid' );
			$visibility = get_theme_mod( 'topbar_visibility', 'desktop-only' );
			$delimiter 	= get_theme_mod( 'topbar_delimiter', 'none' );
			?>

			<div class="top-bar visibility-<?php echo esc_attr( $visibility ); ?>">
				<div class="<?php echo esc_attr( $container ); ?>">
					<div class="top-bar-inner">
						<div class="row valign">

							<?php if( ! $this->elements_empty( 'left' ) ) : ?>
								<div class="<?php echo esc_attr( $this->get_column_class( 'left' ) ); ?> header-elements delimiter-<?php echo esc_attr( $delimiter ); ?>">
									<?php $this->render_components( 'left' ); ?>
								</div>
							<?php endif; ?>
							<?php if( ! $this->elements_empty( 'right' ) ) : ?>
								<div class="<?php echo esc_attr( $this->get_column_class( 'right' ) ); ?> header-elements delimiter-<?php echo esc_attr( $delimiter ); ?>">
									<?php $this->render_components( 'right' ); ?>
								</div>
							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Get topbar components
		 */
		public function get_topbar_components( $location ) {
			$defaults 	= botiga_get_default_topbar_components();
			$components = get_theme_mod( 'topbar_components_' . $location, $defaults[$location] );

			return $components;
		}

		/**
		 * Check if specified elements area is empty/hidden
		 */
		public function elements_empty( $location ) {
			$components = $this->get_topbar_components( $location );

			if( count( $components ) === 0 ) {
				return true;
			}

			return false;
		}

		/**
		 * Render header components
		 */
		public function render_components( $location ) {
			$components = $this->get_topbar_components( $location );

			foreach ( $components as $component ) {
				call_user_func( array( $this, $component ) );
			}
		}

		/**
		 * Get column class
		 */
		public function get_column_class( $location ) {
			$center_content = get_theme_mod( 'center_top_bar_contents', 0 );

			if( 'left' === $location ) {
				$components = $this->get_topbar_components( 'right' );
			}

			if( 'right' === $location ) {
				$components = $this->get_topbar_components( 'left' );
			}
			
			if( count( $components ) === 0 && ! $center_content ) {
				if( 'right' === $location ) {
					return 'col-12 justify-content-end';
				}

				return 'col-12';
			}

			return 'col';
		}

		/**
		 * Contact info
		 */
		public function contact_info() {
			$email 	= get_theme_mod( 'topbar_contact_mail', esc_html__( 'office@example.org', 'botiga' ) );
			$phone	= get_theme_mod( 'topbar_contact_phone', esc_html__( '111222333', 'botiga' ) );

			?>
				<div class="header-item top-bar-contact">
					<?php if ( $email ) : ?>
						<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-mail', true ); ?></i><?php echo esc_html( antispambot( $email ) ); ?></a>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<a href="tel:<?php echo esc_attr( $phone ); ?>"><i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-phone', true ); ?></i><?php echo esc_html( $phone ); ?></a>
					<?php endif; ?>					
				</div>
			<?php
		}	
		
		/**
		 * Text
		 */
		public function text() {
			$text = get_theme_mod( 'topbar_text', esc_html__( 'Your text here', 'botiga' ) );
			?>
			<div class="header-item top-bar-text">
				<?php echo wp_kses_post( $text ); ?>
			</div>
			<?php
		}

		/**
		 * Social
		 */
		public function social() {
			echo '<div class="header-item top-bar-social">';
				botiga_social_profile( 'social_profiles_topbar' );
			echo '</div>';
		}

		/**
		 * Secondary menu
		 */
		public function secondary_nav() {
			if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'secondary' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary') ); ?>
			<?php else: ?>				
			<nav class="header-item top-bar-secondary-navigation secondary-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location'=> 'secondary',
					'menu_id'       => 'secondary',
					'fallback_cb'	=> false,
					'depth'			=> 1
				) );
				?>
			</nav>
			<?php endif;
		}

		/**
		 * HTML
		 */
		public function html() {
			$topbar_html_content = get_theme_mod( 'topbar_html_content', '' );

			if( ! $topbar_html_content ) {
				return '';
			}

			echo '<div class="header-item top-bar-html">';
				echo wp_kses_post( $topbar_html_content ); 
			echo '</div>';
		}

		/**
		 * Shortcode
		 */
		public function shortcode() {
			$topbar_shortcode_content  = get_theme_mod( 'topbar_shortcode_content' );

			if( ! $topbar_shortcode_content ) {
				return '';
			}

			echo '<div class="header-item top-bar-shortcode">';
				echo do_shortcode( $topbar_shortcode_content ); 
			echo '</div>';
		}
	}

	/**
	 * Initialize class
	 */
	Botiga_Top_Bar::get_instance();

endif;
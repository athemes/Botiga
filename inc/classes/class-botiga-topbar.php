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
							<div class="col header-elements delimiter-<?php echo esc_attr( $delimiter ); ?>">
								<?php $this->render_components( 'left' ); ?>
							</div>
							<div class="col header-elements delimiter-<?php echo esc_attr( $delimiter ); ?>">
								<?php $this->render_components( 'right' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Render header components
		 */
		public function render_components( $location ) {
			$defaults 	= botiga_get_default_topbar_components();
			$components = get_theme_mod( 'topbar_components_' . $location, $defaults[$location] );
			foreach ( $components as $component ) {
				call_user_func( array( $this, $component ) );
			}
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
			<div class="header-item">
				<?php echo wp_kses_post( $text ); ?>
			</div>
			<?php
		}

		/**
		 * Social
		 */
		public function social() {
			echo '<div class="header-item">';
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
			<nav class="header-item secondary-navigation">
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
	}

	/**
	 * Initialize class
	 */
	Botiga_Top_Bar::get_instance();

endif;
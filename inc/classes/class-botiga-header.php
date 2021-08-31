<?php
/**
 * Header class class
 *
 * @package Botiga
 */

if ( !class_exists( 'Botiga_Header' ) ) :
	Class Botiga_Header {

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
			add_action( 'botiga_header', array( $this, 'header_markup' ) );
			add_action( 'botiga_header', array( $this, 'header_mobile_markup' ) );
			add_action( 'botiga_header', array( $this, 'header_image' ) );
		}

		/**
		 * Core header image
		 */
		public function header_image() {
			$show_header_image_only_home = get_theme_mod( 'show_header_image_only_home', 0 );

			// output
			$output = '<div class="header-image">';
				$output .= get_header_image_tag();
			$output .= '</div>';

			if( $show_header_image_only_home ) {
				if( is_front_page() ) {
					echo wp_kses_post( $output );
				}

				return;
			}

			echo wp_kses_post( $output );
		}

		/**
		 * Desktop header markup
		 */
		public function header_markup() {
			$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			?>

			<?php call_user_func( array( $this, $layout ) ); ?>
			<div class="search-overlay"></div>
			<?php
		}

		/**
		 * Mobile header markup
		 */		
		public function header_mobile_markup() {
			$layout = get_theme_mod( 'header_layout_mobile', 'header_mobile_layout_1' );
			?>

			<div class="botiga-offcanvas-menu">
				<div class="mobile-header-item">
					<div class="row">
						<div class="col">
							<?php $this->logo(); ?>
						</div>
						<div class="col align-right">
							<a class="mobile-menu-close" href="#"><i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i></a>
						</div>
					</div>
				</div>
				<div class="mobile-header-item">
					<?php $this->menu(); ?>
				</div>
				<div class="mobile-header-item">
					<?php $this->render_components( 'offcanvas' ); ?>
				</div>				
			</div>
			
			<?php call_user_func( array( $this, $layout ) ); ?>
			<div class="search-overlay"></div>
			<?php
		}
		
		/**
		 * Desktop: header layout 1
		 */
		public function header_layout_1() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="site-header-inner">
							<div class="row valign">
								<div class="col-md-5">
									<?php $this->menu(); ?>
								</div>
								<div class="col-md-2">
									<?php $this->logo(); ?>
								</div>
								<div class="col-md-5 header-elements">
									<?php $this->render_components( 'l1' ); ?>
								</div>							
							</div>
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}

		/**
		 * Desktop: header layout 2
		 */
		public function header_layout_2() {
			$layout 		= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 		= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= empty( get_theme_mod( 'main_header_menu_position' ) ) ? 'right' : get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="site-header-inner">
							<div class="row valign">
								<div class="header-col">
									<?php $this->logo(); ?>
								</div>
								<div class="header-col menu-col menu-<?php echo esc_attr( $menu_position ); ?>">
									<?php $this->menu(); ?>
								</div>							
								<div class="header-col header-elements">
									<?php $this->render_components( 'l1' ); ?>
								</div>							
							</div>
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}
		
		/**
		 * Desktop: header layout 3
		 */
		public function header_layout_3() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= empty( get_theme_mod( 'main_header_menu_position' ) ) ? 'center' : get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="top-header-row">
							<div class="row valign">
								<div class="col-md-4 header-elements header-elements-left">
									<?php $this->render_components( 'l3left' ); ?>
								</div>
								<div class="col-md-4">
									<?php $this->logo(); ?>
								</div>							
								<div class="col-md-4 header-elements">
									<?php $this->render_components( 'l3right' ); ?>
								</div>							
							</div>
						</div>	
					</div>	
					<?php $this->search_form(); ?>
				</header>
				<div class="bottom-header-row bottom-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="bottom-header-inner">
							<div class="row">
								<div class="col-md-12 menu-col menu-<?php echo esc_attr( $menu_position ); ?>">
									<?php $this->menu(); ?>
								</div>
							</div>
						</div>
					</div>	
				</div>				
			<?php
		}
		
		/**
		 * Desktop: header layout 4
		 */
		public function header_layout_4() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="top-header-row">
							<div class="row valign">
								<div class="col-md-4">
									<?php $this->logo(); ?>
								</div>
								<div class="col-md-8 header-elements">
									<?php $this->render_components( 'l4top' ); ?>
								</div>							
						
							</div>
						</div>	
					</div>	
					<?php $this->search_form(); ?>
				</header>
				<div class="bottom-header-row bottom-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="bottom-header-inner">
							<div class="row row-menu menu-<?php echo esc_attr( $menu_position ); ?>">
								<div class="col">
									<?php $this->menu(); ?>
								</div>
								<div class="col-md-auto header-elements">
									<?php $this->render_components( 'l4bottom' ); ?>
								</div>									
							</div>
						</div>
					</div>	
				</div>				
			<?php
		}	
		
		/**
		 * Desktop: header layout 5
		 */
		public function header_layout_5() {
			$layout 	= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$container 	= get_theme_mod( 'header_container', 'container-fluid' );
			$menu_position 	= get_theme_mod( 'main_header_menu_position' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="top-header-row">
							<div class="row valign">
								<div class="col-md-4 header-elements header-elements-left">
									<?php $this->render_components( 'l5topleft' ); ?>
								</div>
								<div class="col-md-4">
									<?php $this->logo(); ?>
								</div>							
								<div class="col-md-4 header-elements">
									<?php $this->render_components( 'l5topright' ); ?>
								</div>							
							</div>
						</div>	
					</div>		
					<?php $this->search_form(); ?>
				</header>
				<div class="bottom-header-row bottom-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="bottom-header-inner">
							<div class="row row-menu menu-<?php echo esc_attr( $menu_position ); ?>">
								<div class="col">
									<?php $this->menu(); ?>
								</div>
								<div class="col-md-auto header-elements">
									<?php $this->render_components( 'l5bottom' ); ?>
								</div>									
							</div>
						</div>
					</div>	
				</div>				
			<?php
		}			


		/**
		 * Mobile: layout 1
		 */		
		public function header_mobile_layout_1() {
			$container = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead-mobile" class="site-header mobile-header">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="row valign">
							<div class="col-4">
								<?php $this->logo(); ?>
							</div>
							<div class="col-8 header-elements valign align-right">
								<?php $this->render_components( 'mobile' ); ?>
								<?php $this->trigger(); ?>
							</div>						
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}	

		/**
		 * Mobile: layout 2
		 */		
		public function header_mobile_layout_2() {
			$container = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead-mobile" class="site-header mobile-header">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="row valign">
							<div class="col-4 header-elements valign">
								<?php $this->render_components( 'mobile' ); ?>
							</div>							
							<div class="col-4 align-center">
								<?php $this->logo(); ?>
							</div>
							<div class="col-4 align-right">
								<?php $this->trigger(); ?>
							</div>						
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}	

		/**
		 * Mobile: layout 3
		 */		
		public function header_mobile_layout_3() {
			$container = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead-mobile" class="site-header mobile-header">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="row valign">
							<div class="col-4">
								<?php $this->trigger(); ?>
							</div>														
							<div class="col-4 align-center">
								<?php $this->logo(); ?>
							</div>
							<div class="col-4 header-elements valign align-right">
								<?php $this->render_components( 'mobile' ); ?>
							</div>						
						</div>
					</div>
					<?php $this->search_form(); ?>
				</header>
			<?php
		}			
				
		/**
		 * Render header components
		 */
		public function render_components( $location ) {
			$defaults 	= botiga_get_default_header_components();
			$components = get_theme_mod( 'header_components_' . $location, $defaults[$location] );

			foreach ( $components as $component ) {
				call_user_func( array( $this, $component ) );
			}
		}

		/**
		 * Social icons
		 */
		public function social() {
			botiga_social_profile( 'social_profiles_header' );
		}

		/**
		 * Main navigation
		 */
		public function menu() {
			if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'primary' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
			<?php else: ?>	
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<?php endif;
		}

		/**
		 * Button
		 */
		public function button() {
			$text 	= get_theme_mod( 'header_button_text', esc_html__( 'Click me', 'botiga' ) );
			$url	= get_theme_mod( 'header_button_link', '#' );
			$newtab = get_theme_mod( 'header_button_newtab', 0 );
			$open	= '';
			if ( $newtab ) {
				$open = 'target="_blank"';
			}

			?>
				<a <?php echo esc_html( $open ); ?> class="button header-item" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $text ); ?></a>
			<?php
		}

		/**
		 * Contact info
		 */
		public function contact_info() {
			$email 	= get_theme_mod( 'header_contact_mail', esc_html__( 'office@example.org', 'botiga' ) );
			$phone	= get_theme_mod( 'header_contact_phone', esc_html__( '111222333', 'botiga' ) );

			?>
				<div class="header-item header-contact">
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
		 * Woocommerce icons
		 */
		function woocommerce_icons() {

			if ( !class_exists( 'WooCommerce' ) ) {
				return;
			}
			
			echo botiga_woocommerce_header_cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}		

		/**
		 * Search icon
		 */
		public function search() {
			?>
				<a href="#" class="header-search header-item">
					<i class="ws-svg-icon icon-search active"><?php botiga_get_svg_icon( 'icon-search', true ); ?></i>
					<i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i>
				</a>
			<?php
		}

		/**
		 * Search form
		 */
		public function search_form() {
			?>
			<div class="header-search-form">
			<?php
				if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
					echo do_shortcode('[wcas-search-form]');
				} else {
					get_search_form();
				}
			?>
			</div>
			<?php
		}

		/**
		 * Site branding
		*/		
		public function logo() {
			?>
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$botiga_description = get_bloginfo( 'description', 'display' );
				if ( $botiga_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $botiga_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<?php
		}

		/**
		 * Mobile menu trigger
		 */
		public function trigger() { ?>
			<?php $icon = get_theme_mod( 'mobile_menu_icon', 'mobile-icon2' ); ?>
			<a href="#" class="menu-toggle">
				<i class="ws-svg-icon"><?php botiga_get_svg_icon( $icon, true ); ?></i>
			</a>
			<?php
		}

		/**
		 * Sticky mode
		 */
		public function sticky() {
			$enabled 	= get_theme_mod( 'enable_sticky_header', 0 );
			$type 		= get_theme_mod( 'sticky_header_type', 'always' );
			$sticky		= '';

			if ( $enabled ) {
				$sticky = 'sticky-header sticky-' . esc_html( $type );
			}

			return $sticky;
		}

	}

	/**
	 * Initialize class
	 */
	Botiga_Header::get_instance();

endif;
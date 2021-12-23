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
		 * Desktop: header layout 6
		 */
		public function header_layout_6() {
			$layout 			= get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$vertical_alignment = get_theme_mod( 'main_header_vertical_alignment_l6', 'center' );
			$content_alignment  = get_theme_mod( 'main_header_content_alignment_l6', 'left' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?>">
					<div class="botiga-desktop-offcanvas botiga-desktop-offcanvas-show vertical-align-<?php echo esc_attr( $vertical_alignment ); ?> content-align-<?php echo esc_attr( $content_alignment ); ?>">
						<div class="row">
							<div class="col-12">
								<?php $this->logo(); ?>
							</div>
							<div class="col-12">
								<?php $this->menu(); ?>
							</div>
							<div class="col-12 header-elements">
								<?php $this->render_components( 'l1' ); ?>
							</div>
						</div>	
					</div>
					<?php $this->search_form(); ?>
				</header>			
			<?php
		}

		/**
		 * Desktop: header layout 7
		 */
		public function header_layout_7() {
			$layout 						   = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$desk_offcanvas_vertical_alignment = get_theme_mod( 'desktop_offcanvas_vertical_align', 'center' );
			$desk_offcanvas_content_alignment  = get_theme_mod( 'desktop_offcanvas_link_align', 'center' );
			$container 						   = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="site-header-inner">
							<div class="row valign">
								<div class="col-md-5 header-elements">
									<?php $this->render_components( 'l7left' ); ?>
								</div>
								<div class="col-md-2 text-align-center">
									<?php $this->logo(); ?>
								</div>
								<div class="col-md-5 header-elements">
									<?php $this->render_components( 'l7right' ); ?>
								</div>							
							</div>
						</div>
					</div>
					<?php $this->search_form(); ?>
					<div class="botiga-desktop-offcanvas vertical-align-<?php echo esc_attr( $desk_offcanvas_vertical_alignment ); ?> content-align-<?php echo esc_attr( $desk_offcanvas_content_alignment ); ?>">
						<a class="desktop-menu-close" href="#"><i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i></a>
						<div class="row">
							<div class="col-12">
								<?php $this->logo(); ?>
							</div>
							<div class="col-12">
								<?php $this->menu(); ?>
							</div>
							<div class="col-12 header-elements">
								<?php $this->render_components( 'desktop_offcanvas' ); ?>
							</div>
						</div>	
					</div>
				</header>
			<?php
		}

		/**
		 * Desktop: header layout 8
		 */
		public function header_layout_8() {
			$layout 						   = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
			$desk_offcanvas_vertical_alignment = get_theme_mod( 'desktop_offcanvas_vertical_align', 'center' );
			$desk_offcanvas_content_alignment  = get_theme_mod( 'desktop_offcanvas_link_align', 'center' );
			$container 						   = get_theme_mod( 'header_container', 'container-fluid' );
			?>
				<header id="masthead" class="site-header <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $this->sticky() ); ?>">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="site-header-inner">
							<div class="row valign">
								<div class="col-md-4">
									<?php $this->logo(); ?>
								</div>
								<div class="col-md-8 header-elements">
									<?php $this->render_components( 'l7right' ); ?>
								</div>							
							</div>
						</div>
					</div>
					<?php $this->search_form(); ?>
					<div class="botiga-desktop-offcanvas vertical-align-<?php echo esc_attr( $desk_offcanvas_vertical_alignment ); ?> content-align-<?php echo esc_attr( $desk_offcanvas_content_alignment ); ?>">
						<a class="desktop-menu-close" href="#"><i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i></a>
						<div class="row">
							<div class="col-12">
								<?php $this->logo(); ?>
							</div>
							<div class="col-12">
								<?php $this->menu(); ?>
							</div>
							<div class="col-12 header-elements">
								<?php $this->render_components( 'desktop_offcanvas' ); ?>
							</div>
						</div>	
					</div>
				</header>
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
						<div class="row valign flex-nowrap">
							<div class="col-sm-6 col-md-4 col-grow-mobile">
								<?php $this->logo(); ?>
							</div>
							<div class="col-auto col-sm-6 col-md-8 col-grow-mobile header-elements valign align-right">
								<?php $this->render_components( 'mobile' ); ?>
								<?php if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'primary' ) ) : ?>
									<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
								<?php else: ?>	
									<?php $this->trigger(); ?>
								<?php endif; ?>
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
						<div class="row valign flex-nowrap">
							<div class="col-md-4 header-elements valign">
								<?php $this->render_components( 'mobile' ); ?>
							</div>							
							<div class="col-md-4 align-center">
								<?php $this->logo(); ?>
							</div>
							<div class="col-md-4 align-right">
								<?php if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'primary' ) ) : ?>
									<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
								<?php else: ?>	
									<?php $this->trigger(); ?>
								<?php endif; ?>
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
						<div class="row valign flex-nowrap">
							<div class="col-md-4">
								<?php if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'primary' ) ) : ?>
									<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
								<?php else: ?>	
									<?php $this->trigger(); ?>
								<?php endif; ?>
							</div>														
							<div class="col-md-4 align-center">
								<?php $this->logo(); ?>
							</div>
							<div class="col-md-4 header-elements valign align-right">
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
		 * HTML
		 */
		public function html() {
			$header_html_content = get_theme_mod( 'header_html_content', '' );

			if( ! $header_html_content ) {
				return '';
			}

			echo '<div class="header-item header-html">';
				echo wp_kses_post( $header_html_content ); 
			echo '</div>';
		}

		/**
		 * Shortcode
		 */
		public function shortcode() {
			$header_shortcode_content  = get_theme_mod( 'header_shortcode_content' );

			if( ! $header_shortcode_content ) {
				return '';
			}

			echo '<div class="header-item header-shortcode">';
				echo do_shortcode( $header_shortcode_content ); 
			echo '</div>';
		}

		/**
		 * Login/Register
		 */
		public function login_register() {
			$output = '';

			if( ! class_exists( 'Woocommerce' ) ) {
				return '';
			}

			if( is_user_logged_in() ) {
				$show_welcome_message = get_theme_mod( 'login_register_show_welcome_message', 0 );
				if( ! $show_welcome_message ) {
					return;
				}

				$current_user = wp_get_current_user();

				/* translators: 1: display name. */
				$welcome_message_text = get_theme_mod( 'login_register_welcome_message_text', sprintf( esc_html__( 'Welcome %s', 'botiga' ), '{display_name}' ) );
				$welcome_message_text = str_replace(
					array( '{user_firstname}', '{user_lastname}', '{user_email}', '{user_login}', '{display_name}' ),
					array($current_user->user_firstname, $current_user->user_lastname, $current_user->user_email, $current_user->user_login, $current_user->display_name ),
					$welcome_message_text
				);
				
				$output .= '<a href="'. esc_url( wc_get_page_permalink( 'myaccount' ) ) .'">' . esc_html( $welcome_message_text ) . '</a>'; 
				$output .= '<nav>';
					$output .= '<a href="'. esc_url( wc_get_page_permalink( 'myaccount' ) ) .'">'. esc_html__( 'Dashboard', 'botiga' ) .'</a>';
					$output .= '<a href="'. esc_url( wc_get_endpoint_url( 'orders' ) ) .'">'. esc_html__( 'Orders', 'botiga' ) .'</a>';
					$output .= '<a href="'. esc_url( wc_get_endpoint_url( 'downloads' ) ) .'">'. esc_html__( 'Downloads', 'botiga' ) .'</a>';
					$output .= '<a href="'. esc_url( wc_get_endpoint_url( 'edit-address' ) ) .'">'. esc_html__( 'Addresses', 'botiga' ) .'</a>';
					$output .= '<a href="'. esc_url( wc_get_endpoint_url( 'edit-account' ) ) .'">'. esc_html__( 'Account Details', 'botiga' ) .'</a>';
					$output .= '<a href="'. esc_url( wc_logout_url() ) .'">'. esc_html__( 'Logout', 'botiga' ) .'</a>';
				$output .= '</nav>';
			} else {
				$login_register_link_text = get_theme_mod( 'login_register_link_text', esc_html__( 'Login', 'botiga' ) );
				$login_register_popup     = get_theme_mod( 'login_register_popup', 0 );

				$link_classes = array( 'botiga-login-register-link' );
				
				if( $login_register_popup ) {
					$link_classes[] = 'has-popup';
				}

				$output .= '<a href="'. esc_url( wc_get_page_permalink( 'myaccount' ) ) .'" data-popup-id="loginRegisterPopup" class="'. esc_attr( implode( ' ', $link_classes ) ) .'">'. esc_html( $login_register_link_text ) .'</a>';
			}

			echo '<div class="header-item header-login-register">';
				echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
			echo '</div>';
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
		 * Desktop menu trigger
		 */
		public function hamburger_btn() { ?>
			<a href="#" class="desktop-menu-toggle header-item">
				<i class="ws-svg-icon"><?php botiga_get_svg_icon( 'mobile-icon2', true ); ?></i>
			</a>
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
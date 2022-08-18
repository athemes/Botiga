<?php
/**
 * Modules.
 *
 * @package Botiga
 */

if ( ! class_exists( 'Botiga_Modules' ) ) {

	class Botiga_Modules {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'activate_modules' ) );
		}

		/**
		 * All modules registered in Botiga
		 */
		public static function get_modules() {
			$modules = array(
				array(
					'slug'			=> 'hf-builder',
					'name'          => esc_html__( 'Header & Footer Builder', 'botiga' ),
					'type'          => 'free',
					'link' 			=> admin_url( '/customize.php?autofocus[section]=botiga_section_hb_wrapper' ),
					'link_label'	=> esc_html__( 'Customize', 'botiga' ),
					'activate_uri' 	=> '&amp;activate_module_hf-builder', //param is added in dashboard class
					'text'			=> __( 'Drag and drop header/footer builder.', 'botiga' ) . '<div><a target="_blank" href="https://docs.athemes.com/article/447-header-builder-pro">' . __( 'Documentation article', 'botiga' ) . '</a></div>',
				)	
			);
		
			return apply_filters( 'botiga_modules', $modules );
		}

		/**
		 * Check if a specific module is activated
		 */
		public static function is_module_active( $module ) {

			$all_modules = get_option( 'botiga-modules' );
			$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

			if ( array_key_exists( $module, $all_modules ) && true === $all_modules[$module] ) {
				return true;
			}
		
			return false;
		}

		/**
		 * Activate modules on click
		 */
		public function activate_modules() {
			$modules = $this->get_modules();

            $all_modules = get_option( 'botiga-modules' );
			$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

            foreach ( $modules as $module ) {
				if ( isset( $_GET['activate_module_' . $module['slug'] ] ) ) {
					if ( '1' == $_GET['activate_module_' . $module['slug'] ] ) {
						update_option( 'botiga-modules', array_merge( $all_modules, array( $module['slug'] => true ) ) );
					} elseif ( '0' == $_GET['activate_module_' . $module['slug'] ] ) {
						update_option( 'botiga-modules', array_merge( $all_modules, array( $module['slug'] => false ) ) );
					}

					wp_redirect( admin_url( '/themes.php?page=theme-dashboard' ) );
				}
			}
		}
	}	
    
    new Botiga_Modules();
}
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

			if ( ! isset( $_GET['activate-module'] ) && ! isset( $_GET['deactivate-module'] ) ) {
				return;
			}

      $all_modules = get_option( 'botiga-modules' );
			$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

			if ( isset( $_GET['activate-module'] ) ) {

				$module = sanitize_text_field( wp_unslash( $_GET['activate-module'] ) );

				update_option( 'botiga-modules', array_merge( $all_modules, array( $module => true ) ) );

			}

			if ( isset( $_GET['deactivate-module'] ) ) {

				$module = sanitize_text_field( wp_unslash( $_GET['deactivate-module'] ) );

				update_option( 'botiga-modules', array_merge( $all_modules, array( $module => false ) ) );

			}

			$section = ( isset( $_GET['section'] ) ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : '';
			$section = ( ! empty( $section ) ) ? array( 'section' => $section ) : array();

			wp_redirect( add_query_arg( array( 'page' => 'botiga-dashboard', $section ), admin_url( 'themes.php' ) ) );

		}
	}	
    
    new Botiga_Modules();
}
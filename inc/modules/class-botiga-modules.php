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
			add_action( 'admin_init', array( $this, 'modules_default_status' ) );
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

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( ! isset( $_GET['activate-module'] ) && ! isset( $_GET['deactivate-module'] ) ) {
				return;
			}

     		$all_modules = get_option( 'botiga-modules' );
			$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( isset( $_GET['activate-module'] ) ) {
				$module = sanitize_text_field( wp_unslash( $_GET['activate-module'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

				update_option( 'botiga-modules', array_merge( $all_modules, array( $module => true ) ) );

			}

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( isset( $_GET['deactivate-module'] ) ) {
				$module = sanitize_text_field( wp_unslash( $_GET['deactivate-module'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

				update_option( 'botiga-modules', array_merge( $all_modules, array( $module => false ) ) );

			}

			$args    = array( 'page' => 'botiga-dashboard' );
			$tab     = ( isset( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$section = ( isset( $_GET['section'] ) ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			if ( ! empty( $section ) ) {
				$args = array_merge( $args, array( 'section' => $section ) );
			}


			if ( ! empty( $tab ) ) {
				$args = array_merge( $args, array( 'tab' => $tab ) );
			}

			// Update Custom CSS
			$custom_css = Botiga_Custom_CSS::get_instance();
			$custom_css->update_custom_css_file();

			wp_safe_redirect( add_query_arg( $args, admin_url( 'admin.php' ) ) );
			exit;
		}

		/**
		 * Enable/disable default modules
		 * 
		 * Always enable/disable these modules for new users
		 * This will happen only when the module slug is not present in the 'botiga-modules' option
		 * If the condition matches, the theme will force the respective module to be enabled
		 * 
		 */
		public function modules_default_status() {
			/**
			 * Hook 'botiga_modules_default_status'
			 *
			 * @since 1.0.0
			 */
			$modules_default_status = apply_filters( 'botiga_modules_default_status', array(
				'hf-builder'         => true,
				'local-google-fonts' => true,
				'adobe-typekit'      => true,
			) );

			$all_modules = get_option( 'botiga-modules' );
			if( $all_modules ) {
				foreach( $modules_default_status as $module => $status ) {
					if( ! isset( $all_modules[ $module ] ) ) {
						update_option( 'botiga-modules', array_merge( $all_modules, array( $module => $status ) ) );
					}
				}
			}
		}
	}   
    
    new Botiga_Modules();
}
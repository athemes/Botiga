<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 */
final class Botiga_Customize_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	private function setup_actions() {

		if( defined( 'BOTIGA_AWL_ACTIVE' ) ) {
			return;
		}

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/upsell/section-pro.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

		// Register custom section types.
		$manager->register_section_type( 'Botiga_Customize_Upsell_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Botiga_Customize_Upsell_Section_Pro(
				$manager,
				'botiga_upsell',
				array(
					'pro_text' => esc_html__( 'View Pro Features',  'botiga' ),
					'pro_url'  => botiga_upgrade_link( 'theme_customizer', 'View Pro Features Button' ),
					'priority' => -999,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'botiga-upsell-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upsell/customize-controls.js', array( 'customize-controls' ), BOTIGA_VERSION, false );
	}
}

// Doing this customizer thang!
Botiga_Customize_Upsell::get_instance();

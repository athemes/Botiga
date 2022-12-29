<?php
/**
 * Adobe Typekit
 *
 * @package Botiga
 */

if ( ! Botiga_Modules::is_module_active( 'adobe-typekit' ) ) {
	return;
}

/**
 * Adobe typekit customize options.
 */
function botiga_adobe_typekit_options( $wp_customize ) {
    require get_template_directory() . '/inc/modules/adobe-typekit/customizer/options.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
}
add_action( 'customize_register', 'botiga_adobe_typekit_options', 999 );

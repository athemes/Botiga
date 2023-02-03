<?php

/**
 *
 * Settings
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if  ( empty( $this->settings['settings'] ) ) {
	return;
}

?>

<div class="botiga-dashboard-content">

	<div class="botiga-dashboard-row">

		<div class="botiga-dashboard-settings">

			<div class="botiga-dashboard-settings-tabs">

				<?php

					if (!has_action('botiga_pro_license_form')) {
						unset($this->settings['settings']['general']);
					}

					$num = 0; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
					$tab = (isset($_GET['tab'])) ? sanitize_text_field(wp_unslash($_GET['tab'])) : key(array_slice($this->settings['settings'], 0, 1)); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

					foreach ( $this->settings['settings'] as $tab_key => $tab_title ) { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

						$tab_link   = add_query_arg(array('tab' => $tab_key)); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
						$tab_active = (($tab && $tab === $tab_key) || (!$tab && $num === 0)) ? 'active' : ''; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

						echo sprintf('<a href="%s" class="botiga-dashboard-settings-tab %s">%s</a>', esc_url($tab_link), esc_attr($tab_active), esc_html($tab_title));

						$num++;

					}

				?>

			</div>

			<div class="botiga-dashboard-settings-contents">

				<?php if ($tab === 'general') : ?>
					<?php do_action( 'botiga_pro_license_form' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>
				<?php endif; ?>

				<?php if ($tab === 'performance') : ?>
					<div class="botiga-dashboard-box botiga-dashboard-settings-box">
						<div class="botiga-dashboard-settings-row">
							<div class="botiga-dashboard-settings-column-left">
								<div class="botiga-dashboard-box-title"><?php esc_html_e('Load Google Fonts', 'botiga'); ?></div>
								<div class="botiga-dashboard-box-content"><?php esc_html_e('Activate this option to load the Google fonts locally.', 'botiga'); ?></div>
							</div>
							<div class="botiga-dashboard-settings-column-right">
								<div class="botiga-dashboard-box-link">
									<?php if (Botiga_Modules::is_module_active('local-google-fonts')) : ?>
										<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'settings', 'tab' => 'performance', 'deactivate-module' => 'local-google-fonts'), admin_url('themes.php'))); ?>" class="button button-warning botiga-dashboard-deactivate-button">
											<?php esc_html_e('Deactivate', 'botiga'); ?>
										</a>
									<?php else : ?>
										<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'settings', 'tab' => 'performance', 'activate-module' => 'local-google-fonts'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-activate-button">
											<?php esc_html_e('Activate', 'botiga'); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>

			</div>

		</div>

	</div>

</div>
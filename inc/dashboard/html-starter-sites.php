<?php

/**
 *
 * Starter Sites
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$theme = wp_get_theme(); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="botiga-dashboard-content">

  <?php if ( in_array( $this->get_plugin_status( $this->settings['starter_plugin_path'] ), array( 'inactive', 'not_installed' ) ) ) : ?>

		<div class="botiga-dashboard-row">

			<div class="botiga-dashboard-starter-sites">

				<div class="botiga-dashboard-starter-sites-locked">
					<div class="botiga-dashboard-starter-sites-notice">
						<div class="botiga-dashboard-starter-sites-notice-text"><?php esc_html_e('In order to be able to import any starter sites for Botiga you need to have the aThemes demo importer plugin active.', 'botiga'); ?></div>
						<?php if ('not_installed' === $this->get_plugin_status($this->settings['starter_plugin_path'])) : ?>
							<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'starter-sites'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-plugin-ajax-button" data-type="install" data-path="<?php echo esc_attr($this->settings['starter_plugin_path']); ?>" data-slug="<?php echo esc_attr($this->settings['starter_plugin_slug']); ?>"><?php esc_html_e('Install and Activate', 'botiga'); ?></a>
						<?php else : ?>
							<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'starter-sites'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-plugin-ajax-button" data-type="activate" data-path="<?php echo esc_attr($this->settings['starter_plugin_path']); ?>" data-slug="<?php echo esc_attr($this->settings['starter_plugin_slug']); ?>"><?php esc_html_e('Activate', 'botiga'); ?></a>
						<?php endif; ?>
					</div>
				</div>

				<?php foreach ($this->settings['demos'] as $demo) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound 
				?>
					<div class="botiga-dashboard-box">
						<div class="botiga-dashboard-box-image">
							<figure>
								<img src="<?php echo esc_url($demo['thumbnail']); ?>" />
							</figure>
						</div>
						<div class="botiga-dashboard-box-link">
							<a href="#" target="_blank" class="button button-primary"><?php esc_html_e('Import', 'botiga'); ?></a>
							<a href="#" target="_blank" class="button button-secondary"><?php esc_html_e('Preview', 'botiga'); ?></a>
						</div>
					</div>
				<?php endforeach; ?>

			</div>

		</div>

	<?php else : ?>

		<div class="botiga-dashboard-row">
			<?php
			if (has_action('atss_starter_sites')) {
				do_action('atss_starter_sites'); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			} else {
				wp_redirect(add_query_arg(array('page' => 'starter-sites'), admin_url('themes.php')));
			}
			?>
		</div>

	<?php endif; ?>

	<div class="botiga-dashboard-row">
		<?php require get_template_directory() . '/inc/dashboard/part-support.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound 
		?>
	</div>

</div>

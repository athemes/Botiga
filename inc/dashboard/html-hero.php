<?php

/**
 *
 * Hero
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $pagenow;

$screen = get_current_screen(); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

$user = wp_get_current_user(); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="botiga-dashboard-hero">

	<div class="botiga-dashboard-hero-content">

		<div class="botiga-dashboard-hero-hello">
			<?php esc_html_e('Hello, ', 'botiga'); ?>
			<?php echo esc_html($user->display_name); ?>
			<?php esc_html_e('👋🏻', 'botiga'); ?>
		</div>

		<div class="botiga-dashboard-hero-title">
			<?php echo wp_kses_post($this->settings['hero_title']); ?>
			<?php if ($this->settings['has_pro']) { ?>
				<sup class="botiga-dashboard-hero-badge botiga-dashboard-hero-badge-pro">pro</sup>
			<?php } else { ?>
				<sup class="botiga-dashboard-hero-badge botiga-dashboard-hero-badge-free">free</sup>
			<?php } ?>
		</div>

		<div class="botiga-dashboard-hero-desc">
			<?php echo wp_kses_post($this->settings['hero_desc']); ?>
		</div>

		<?php if ('themes.php' === $pagenow && 'themes' === $screen->base) : ?>

			<div class="botiga-dashboard-hero-actions">

				<?php if ('inactive' === $this->get_plugin_status($this->settings['starter_plugin_path'])) : ?>

					<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'starter-sites'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-plugin-ajax-button" data-type="install" data-path="<?php echo esc_attr($this->settings['starter_plugin_path']); ?>" data-slug="<?php echo esc_attr($this->settings['starter_plugin_slug']); ?>">
						<?php esc_html_e('Start Building Your Website', 'botiga'); ?>
					</a>

				<?php else : ?>

					<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'starter-sites'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-hero-button">
						<?php esc_html_e('Starter Sites', 'botiga'); ?>
					</a>

					<a href="<?php echo esc_url(add_query_arg('page', $this->settings['menu_slug'], admin_url('themes.php'))); ?>" class="button button-secondary">
						<?php esc_html_e('Theme Dashboard', 'botiga'); ?>
					</a>

				<?php endif; ?>

			</div>

			<?php if ('active' !== $this->get_plugin_status($this->settings['starter_plugin_path'])) : ?>
				<div class="botiga-dashboard-hero-notion">
					<?php esc_html_e('Clicking “Get Started” button will install and activate the Botiga starter plugin.', 'botiga'); ?>
				</div>
			<?php endif; ?>

		<?php else : ?>

			<div class="botiga-dashboard-hero-tabs">
				<?php

				$num = 0; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

				$section = (isset($_GET['section'])) ? sanitize_text_field(wp_unslash($_GET['section'])) : ''; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

				foreach ($this->settings['tabs'] as $tab_key => $tab_title) { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

					if ($this->settings['has_pro'] && $tab_key === 'free-vs-pro') {
						continue;
					}

					$tab_link   = add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => $tab_key), admin_url('themes.php')); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
					$tab_active = (($section && $section === $tab_key) || (!$section && $num === 0)) ? 'active' : ''; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

					echo sprintf('<a href="%s" class="botiga-dashboard-hero-tab %s">%s</a>', esc_url($tab_link), esc_attr($tab_active), esc_html($tab_title));

					$num++;
				}

				?>
			</div>

		<?php endif; ?>

	</div>

	<div class="botiga-dashboard-hero-image">
		<img src="<?php echo esc_url($this->settings['hero_image']); ?>">
	</div>

</div>
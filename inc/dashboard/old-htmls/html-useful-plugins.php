<?php

/**
 *
 * Useful Plugins
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-content">

	<div class="botiga-dashboard-row">

		<div class="botiga-dashboard-useful-plugins">

			<?php foreach ($this->settings['plugins'] as $plugin) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound 
			?>

				<div class="botiga-dashboard-box">

					<div class="botiga-dashboard-box-image">
						<figure>
							<img src="<?php echo esc_url($plugin['banner']); ?>" alt="<?php echo esc_attr($plugin['title']); ?>" />
						</figure>
					</div>

					<div class="botiga-dashboard-box-plugin-title">
						<figure>
							<img src="<?php echo esc_url($plugin['icon']); ?>" alt="<?php echo esc_attr($plugin['title']); ?>" />
						</figure>
						<?php echo esc_html($plugin['title']); ?>
					</div>

					<div class="botiga-dashboard-box-content">
						<?php echo wp_kses_post($plugin['desc']); ?>
					</div>

					<div class="botiga-dashboard-box-link">
						<?php if ('not_installed' === $this->get_plugin_status($plugin['path'])) : ?>
							<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'useful-plugins'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-plugin-ajax-button" data-type="install" data-path="<?php echo esc_attr($plugin['path']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>"><?php esc_html_e('Install', 'botiga'); ?></a>
						<?php elseif ('inactive' === $this->get_plugin_status($plugin['path'])) : ?>
							<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'useful-plugins'), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-plugin-ajax-button" data-type="activate" data-path="<?php echo esc_attr($plugin['path']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>"><?php esc_html_e('Activate', 'botiga'); ?></a>
						<?php else : ?>
							<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'useful-plugins'), admin_url('themes.php'))); ?>" class="button button-warning botiga-dashboard-plugin-ajax-button" data-type="deactivate" data-path="<?php echo esc_attr($plugin['path']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>"><?php esc_html_e('Deactivate', 'botiga'); ?></a>
						<?php endif; ?>
						<a href="<?php echo esc_url(sprintf('https://wordpress.org/plugins/%s/', $plugin['slug'])); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('More Details', 'botiga'); ?></a>
					</div>

				</div>

			<?php endforeach; ?>

		</div>

	</div>

</div>
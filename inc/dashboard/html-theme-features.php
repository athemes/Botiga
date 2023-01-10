<?php

/**
 *
 * Theme Features
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-content">

	<div class="botiga-dashboard-row">

		<div class="botiga-dashboard-theme-features">

			<?php foreach ($this->settings['features'] as $feature) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
			?>

				<?php $box_locked_class = ($feature['type'] === 'pro' && !$this->settings['has_pro']) ? ' botiga-dashboard-box-locked' : ''; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound 
				?>

				<div class="botiga-dashboard-box<?php echo esc_attr($box_locked_class) ?>">

					<div class="botiga-dashboard-box-badge botiga-dashboard-box-badge-<?php echo esc_attr($feature['type']); ?>"><?php echo esc_html($feature['type']); ?></div>

					<div class="botiga-dashboard-box-title">
						<?php echo esc_html($feature['title']); ?>
					</div>

					<div class="botiga-dashboard-box-content">
						<?php echo wp_kses_post($feature['desc']); ?>
					</div>

					<div class="botiga-dashboard-box-footer">

						<div class="botiga-dashboard-box-link">
							<?php if (isset($feature['module']) && ($feature['type'] === 'free' || $this->settings['has_pro'])) : ?>
								<?php if (Botiga_Modules::is_module_active($feature['module'])) : ?>
									<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'theme-features', 'deactivate-module' => $feature['module']), admin_url('themes.php'))); ?>" class="button button-warning botiga-dashboard-deactivate-button">
										<?php esc_html_e('Deactivate', 'botiga'); ?>
									</a>
								<?php else : ?>
									<a href="<?php echo esc_url(add_query_arg(array('page' => $this->settings['menu_slug'], 'section' => 'theme-features', 'activate-module' => $feature['module']), admin_url('themes.php'))); ?>" class="button button-primary botiga-dashboard-activate-button">
										<?php esc_html_e('Activate', 'botiga'); ?>
									</a>
								<?php endif; ?>
							<?php endif; ?>
							<?php if (isset($feature['link_url']) && isset($feature['link_label'])) : ?>
								<?php $button_disabled_class = (isset($feature['module']) && !Botiga_Modules::is_module_active($feature['module'])) ? ' button-disabled' : ''; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
								?>
								<a href="<?php echo esc_url($feature['link_url']); ?>" target="_blank" class="button button-secondary<?php echo esc_attr($button_disabled_class); ?>"><?php echo esc_html($feature['link_label']); ?></a>
							<?php endif; ?>
						</div>

						<div class="botiga-dashboard-box-info">
							<?php if( !empty( $feature[ 'docs_link' ] ) ) : ?>
								<div class="botiga-dashboard-docs-link-wrapper">
									<a href="<?php echo esc_url( $feature[ 'docs_link' ] ); ?>" target="_blank" class="botiga-dashboard-docs-link button-info" title="<?php echo esc_attr__( 'Documentation', 'botiga' ); ?>">
										<i class="dashicons dashicons-editor-help"></i>
									</a>
								</div>
							<?php endif; ?>
							<?php if (!empty($feature['info']) && ($feature['type'] === 'free' || $this->settings['has_pro'])) : ?>
								<div class="botiga-dashboard-modal">
									<a href="#" class="button-info botiga-dashboard-modal-button"><i class="dashicons dashicons-info" title="<?php echo esc_attr__( 'Learn more', 'botiga' ); ?>"></i></a>
									<div class="botiga-dashboard-modal-overlay">
										<div class="botiga-dashboard-modal-content">
											<div class="botiga-dashboard-modal-close"><i class="dashicons dashicons-no-alt"></i></div>
											<?php echo wp_kses_post($feature['info']); ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>

					</div>

				</div>

			<?php endforeach; ?>

		</div>

	</div>

</div>
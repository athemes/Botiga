<?php

/**
 *
 * Support
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-row">

	<div class="botiga-dashboard-column">

		<?php $support_box_class = ($this->settings['has_pro']) ? 'botiga-dashboard-box-pro-support' : 'botiga-dashboard-box-support'; // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
		?>

		<div class="botiga-dashboard-box <?php echo sanitize_html_class($support_box_class) ?>">

			<div class="botiga-dashboard-box-row">

				<div class="botiga-dashboard-box-column">

					<div class="botiga-dashboard-box-title"><?php esc_html_e('Need help? We\'re here for you!', 'botiga'); ?></div>
					<div class="botiga-dashboard-box-content">
						<?php esc_html_e('Have a question? Hit a bug? Get the help you need, when you need it from our friendly support staff.', 'botiga'); ?>
					</div>
					<div class="botiga-dashboard-box-link">
						<a href="<?php echo esc_url($this->settings['support_link']); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('Get Support', 'botiga'); ?></a>
					</div>

				</div>

				<?php if (!$this->settings['has_pro']) : ?>
					<div class="botiga-dashboard-box-column botiga-dashboard-home-priority-support">
						<div class="botiga-dashboard-box-title"><?php esc_html_e('Premium Support', 'botiga'); ?><span class="botiga-dashboard-box-badge">pro</span></div>
						<div class="botiga-dashboard-box-content">
							<?php esc_html_e('Get direct support from our developers via email. We aim to answer all premium support requests within 24 hours.', 'botiga'); ?>
						</div>
						<div class="botiga-dashboard-box-link">
							<a href="<?php echo esc_url($this->settings['support_pro_link']); ?>" target="_blank" class="button button-pro-support"><?php esc_html_e('Get Premium Support with Botiga Pro', 'botiga'); ?></a>
						</div>
					</div>
				<?php endif; ?>

			</div>

		</div>

	</div>

</div>
<?php
/**
 * Dashboard HTML Body
 * 
 * @package Botiga
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Hook 'botiga_before_dashboard_body_html'
 * 
 * @since 2.2.4
 */
do_action( 'botiga_before_dashboard_body_html' );

/**
 * Hook 'botiga_do_not_load_default_dashboard_body_html'
 * Filter to prevent rendering the dashboard body HTML.
 * 
 * @since 2.2.4
 */
if ( apply_filters( 'botiga_remove_default_dashboard_body_html', false ) ) {
	return;
}

?>

<div class="botiga-dashboard-container">
	<?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>

	<div class="botiga-dashboard-row bt-p-relative bt-zindex-2">
		<div class="botiga-dashboard-column">
			<?php require get_template_directory() . '/inc/dashboard/html-tabs-nav-items.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
		</div>
	</div>
	<div class="botiga-dashboard-row">
		<div class="botiga-dashboard-column">
			<?php 
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$section = ( isset( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';

			foreach( $this->settings[ 'tabs' ] as $nav_tab_id => $nav_tab_title ) : 
				$nav_tab_active = (($nav_tab && $nav_tab === $nav_tab_id) || (!$section && $nav_tab_id === 'home')) ? ' active' : '';

				?>	
				<div class="botiga-dashboard-tab-content-wrapper" data-tab-wrapper-id="main">					
					<div class="botiga-dashboard-tab-content<?php echo esc_attr( $nav_tab_active ); ?>" data-tab-content-id="<?php echo esc_attr( $nav_tab_id ); ?>">
						<?php require get_template_directory() . '/inc/dashboard/html-'. $nav_tab_id .'.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php
/**
 * Theme activation.
 *
 * @package Botiga
 */

/**
 * Theme Dashboard [Free VS Pro]
 */
function botiga_free_vs_pro_html() {
	ob_start();
	?>
	<div class="thd-heading"><?php esc_html_e( 'Differences between Botiga and Botiga Pro', 'botiga' ); ?></div>
	<div class="thd-description"><?php esc_html_e( 'Here are some of the differences between Botiga and Botiga Pro:', 'botiga' ); ?></div>

	<table class="thd-table-compare">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Feature', 'botiga' ); ?></th>
				<th><?php esc_html_e( 'Botiga', 'botiga' ); ?></th>
				<th><?php esc_html_e( 'Botiga Pro', 'botiga' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php esc_html_e( 'Access to all Google Fonts', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Responsive', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Native AMP support', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Sticky menu', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Multiple blog layouts', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>


			<tr>
				<td><?php esc_html_e( 'Type of starter sites', 'botiga' ); ?></td>
				<td><span class="thd-badge">Free</span></td>
				<td><span class="thd-badge">Premium</span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Starter sites', 'botiga' ); ?></td>
				<td><span class="thd-badge">5</span></td>
				<td><span class="thd-badge">16</span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Header support for shortcodes', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Transparent menu bar', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Footer credits', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'WooCommerce support', 'botiga' ); ?></td>
				<td><span class="thd-badge">Basic</span></td>
				<td><span class="thd-badge">Extended</span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Cart and account icons in the menu', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>	
			<tr>
				<td><?php esc_html_e( 'Sidebar minicart', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>						
			<tr>
				<td><?php esc_html_e( 'Hooks system', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Custom Elementor widgets', 'botiga' ); ?></td>
				<td><span class="thd-badge">5</span></td>
				<td><span class="thd-badge">9</span></td>
			</tr>
		</tbody>
	</table>

	<div class="thd-separator"></div>

	<h4>
		<a href="https://docs.athemes.com/article/226-differences-between-botiga-and-botiga-pro" target="_blank">
			<?php esc_html_e( 'Full list of differences between Botiga and Botiga Pro', 'botiga' ); ?>
		</a>
	</h4>

	<div class="thd-separator"></div>

	<p>
		<a href="https://athemes.com/theme/botiga-pro/?utm_source=theme_table&utm_medium=button&utm_campaign=Botiga" class="thd-button button">
			<?php esc_html_e( 'Get Botiga Pro Today', 'botiga' ); ?>
		</a>
	</p>
	<?php
	return ob_get_clean();
}

/**
 * Theme Dashboard Settings
 *
 * @param array $settings The settings.
 */
function botiga_dashboard_settings( $settings ) {

	// Starter.
	$settings['starter_plugin_slug'] = 'athemes-starter-sites';

	// Hero.
	$settings['hero_title']       = esc_html__( 'Welcome to Botiga', 'botiga' );
	$settings['hero_themes_desc'] = esc_html__( 'Botiga is now installed and ready to use. Click on Starter Sites to get off to a flying start with one of our pre-made templates, or go to Theme Dashboard to get an overview of everything.', 'botiga' );
	$settings['hero_desc']        = esc_html__( 'Botiga is now installed and ready to go. To help you with the next step, we\'ve gathered together on this page all the resources you might need. We hope you enjoy using Botiga.', 'botiga' );
	$settings['hero_image']       = get_template_directory_uri() . '/theme-dashboard/images/welcome-banner@2x.png';

	// Tabs.
	$settings['tabs'] = array(
		array(
			'name'    => esc_html__( 'Theme Features', 'botiga' ),
			'type'    => 'features',
			'visible' => array( 'free', 'pro' ),
			'data'    => array(
				array(
					'name'          => esc_html__( 'Change Site Title or Logo', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=title_tagline',
				),
				array(
					'name'          => esc_html__( 'Header Options', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => '/wp-admin/customize.php?autofocus[panel]=botiga_header_panel',
				),
				array(
					'name'          => esc_html__( 'Color Options', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => '/wp-admin/customize.php?autofocus[panel]=botiga_colors_panel',
				),
				array(
					'name'          => esc_html__( 'Font Options', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_fonts',
				),
				array(
					'name'          => esc_html__( 'Blog Options', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=blog_options',
				),
				array(
					'name'          => esc_html__( 'Footer Credits', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_footer_credits',
				),
				array(
					'name'          => esc_html__( 'Footer Contact', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_footer_contact',
				),
				array(
					'name'          => esc_html__( 'Front Page Section Titles', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_fp_titles',
				),
				array(
					'name'          => esc_html__( 'Single Employees', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_single_employees',
				),
				array(
					'name'          => esc_html__( 'Single Projects', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_single_projects',
				),
				array(
					'name'          => esc_html__( 'Header Contact Info', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_contact_info',
				),
				array(
					'name'          => esc_html__( 'Buttons', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_buttons',
				),
				array(
					'name'          => esc_html__( 'Extra Widget Area', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_extra_widget_area',
				),
				array(
					'name'          => esc_html__( 'Google Maps', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => '/wp-admin/customize.php?autofocus[section]=botiga_pro_maps',
				),
			),
		),
		array(
			'name'    => esc_html__( 'Free vs PRO', 'botiga' ),
			'type'    => 'html',
			'visible' => array( 'free' ),
			'data'    => botiga_free_vs_pro_html(),
		),
		array(
			'name'    => esc_html__( 'Performance', 'botiga' ),
			'type'    => 'performance',
			'visible' => array( 'free', 'pro' ),
		),
	);

	// Documentation.
	$settings['documentation_link'] = 'https://docs.athemes.com/category/8-botiga';

	// Promo.
	$settings['promo_title']  = esc_html__( 'Upgrade to Pro', 'botiga' );
	$settings['promo_desc']   = esc_html__( 'Take Botiga to a whole other level by upgrading to the Pro version.', 'botiga' );
	$settings['promo_button'] = esc_html__( 'Discover Botiga Pro', 'botiga' );
	$settings['promo_link']   = 'https://athemes.com/theme/botiga-pro/?utm_source=theme_info&utm_medium=link&utm_campaign=Botiga';

	// Review.
	$settings['review_link']       = 'https://wordpress.org/support/theme/botiga/reviews/';
	$settings['suggest_idea_link'] = 'https://athemes.circle.so/c/give-feedback';

	// Support.
	$settings['support_link']     = 'https://forums.athemes.com/';
	$settings['support_pro_link'] = 'https://athemes.com/theme/botiga-pro/?utm_source=theme_info&utm_medium=link&utm_campaign=Botiga';

	// Community.
	$settings['community_link'] = 'https://community.athemes.com/';

	$theme = wp_get_theme();
	// Changelog.
	$settings['changelog_version'] = $theme->version;
	$settings['changelog_link']    = 'https://athemes.com/changelog/botiga/';
	
	//Has pro
	$settings['has_pro'] = false;

	return $settings;
}
add_filter( 'thd_register_settings', 'botiga_dashboard_settings' );

/**
 * Starter Settings
 *
 * @param array $settings The settings.
 */
function botiga_demos_settings( $settings ) {

	$settings['categories'] = array(
		'business' 	=> 'Business',
		'portfolio' => 'Portfolio',
		'ecommerce' => 'eCommerce',
		'event' 	=> 'Events',
	);	

	$settings['builders'] = array(
		'elementor' => 'Elementor',
	);		

	// Pro.
	$settings['pro_label'] = esc_html__( 'Get Botiga Pro', 'botiga' );
	$settings['pro_link']  = 'https://athemes.com/theme/botiga-pro/?utm_source=theme_table&utm_medium=button&utm_campaign=Botiga';

	return $settings;
}
add_filter( 'atss_register_demos_settings', 'botiga_demos_settings' );

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
				<td><?php esc_html_e( 'Color Palettes', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Typography Controls', 'botiga' ); ?></td>
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
				<td><?php esc_html_e( 'Multiple header layouts', 'botiga' ); ?></td>
				<td>5</td>
				<td>8</td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Product Swatch', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Wishlist', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Shop Header Styles', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Single Product Gallery Styles', 'botiga' ); ?></td>
				<td>3</td>
				<td>7</td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Single Product Sticky Add to Cart', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Single Product Tab Styles', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'New Shop Sidebar Positions', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Distraction Free Checkout', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Fixed Totals Box in Cart & Checkout Pages', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Single Blog Post Reading Time', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Single Blog Post Author Profile Info', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Single Blog Post Share Box', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Single Blog Related Posts Slider', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'New Footer Copyright Bar Elements - Payment Icons, Navigation Menu, HTML and Shortcode', 'botiga' ); ?></td>
				<td><span class="thd-badge thd-badge-warning"><i class="dashicons dashicons-no-alt"></i></span></td>
				<td><span class="thd-badge thd-badge-success"><i class="dashicons dashicons-saved"></i></span></td>
			</tr>
		</tbody>
	</table>

	<div class="thd-separator"></div>

	<h4>
		<a href="https://athemes.com/botiga-upgrade#see-all-features" target="_blank">
			<?php esc_html_e( 'Full list of differences between Botiga and Botiga Pro', 'botiga' ); ?>
		</a>
	</h4>

	<div class="thd-separator"></div>

	<p>
		<a href="https://athemes.com/botiga-upgrade?utm_source=theme_table&utm_medium=button&utm_campaign=Botiga#pro" class="thd-button thd-button-success button">
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
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=title_tagline' ),
				),
				array(
					'name'          => esc_html__( 'Typography', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[panel]=botiga_panel_typography' ),
				),	
				array(
					'name'          => esc_html__( 'Color Options', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=colors' ),
				),		
				array(
					'name'          => esc_html__( 'Main Header', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_main_header' ),
				),
				array(
					'name'          => esc_html__( 'Mobile Header', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_mobile_header' ),
				),		
				array(
					'name'          => esc_html__( 'Footer Copyright', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_footer_credits' ),
				),		
				array(
					'name'          => esc_html__( 'Blog Archives', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_blog_archives' ),
				),	
				array(
					'name'          => esc_html__( 'Single Posts', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_blog_singles' ),
				),	
				array(
					'name'          => esc_html__( 'Button Options', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_buttons' ),
				),				
				array(
					'name'          => esc_html__( 'Product Catalog', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=woocommerce_product_catalog' ),
				),	
				array(
					'name'          => esc_html__( 'Single Products', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_single_product' ),
				),
				array(
					'name'          => esc_html__( 'Cart Layout', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_shop_cart' ),
				),		
				array(
					'name'          => esc_html__( 'Checkout Options', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=woocommerce_checkout' ),
				),			
				array(
					'name'          => esc_html__( 'Scroll to Top', 'botiga' ),
					'type'          => 'free',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_scrolltotop' ),
				),
				array(
					'name'          => esc_html__( 'Wishlist', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_wishlist' ),
				),
				array(
					'name'          => esc_html__( 'Product Swatch', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_single_product&control=customize-control-accordion_single_product_swatch' ),
				),
				array(
					'name'          => esc_html__( 'More Header Layouts', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_main_header' ),
				),
				array(
					'name'          => esc_html__( 'Shop Header Styles', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=woocommerce_product_catalog&control=customize-control-accordion_shop_layout' ),
				),
				array(
					'name'          => esc_html__( 'More Single Product Gallery Styles', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_single_product&control=customize-control-accordion_single_product_layout' ),
				),
				array(
					'name'          => esc_html__( 'Single Product Sticky Add to Cart', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_single_product&control=customize-control-accordion_single_product_sticky_add_to_cart' ),
				),
				array(
					'name'          => esc_html__( 'Single Product Tab Styles', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_single_product&control=customize-control-accordion_single_product_tabs' ),
				),
				array(
					'name'          => esc_html__( 'More Sidebar Layouts', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=woocommerce_product_catalog&control=customize-control-accordion_shop_layout' ),
				),
				array(
					'name'          => esc_html__( 'Distraction Free Checkout', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=woocommerce_checkout' ),
				),
				array(
					'name'          => esc_html__( 'More Footer Copyright Elements', 'botiga' ),
					'type'          => 'pro',
					'customize_uri' => admin_url( '/customize.php?autofocus[section]=botiga_section_footer_credits' ),
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
	$settings['documentation_link'] = 'https://docs.athemes.com/collection/318-botiga';

	// Upgrade to Pro.
	$settings['upgrade_pro']   = 'https://athemes.com/botiga-upgrade?utm_source=theme_info&utm_medium=link&utm_campaign=Botiga';

	// Promo.
	$settings['promo_title']  = esc_html__( 'Upgrade to Pro', 'botiga' );
	$settings['promo_desc']   = esc_html__( 'Take Botiga to a whole other level by upgrading to the Pro version.', 'botiga' );
	$settings['promo_button'] = esc_html__( 'Discover Botiga Pro', 'botiga' );
	$settings['promo_link']   = 'https://athemes.com/botiga-upgrade?utm_source=theme_info&utm_medium=link&utm_campaign=Botiga';

	// Review.
	$settings['review_link']       = 'https://wordpress.org/support/theme/botiga/reviews/';
	$settings['suggest_idea_link'] = 'https://athemes.com/feature-request/';

	// Support.
	$settings['support_link']     = 'https://wordpress.org/support/theme/botiga/';
	$settings['support_pro_link'] = 'https://athemes.com/botiga-upgrade?utm_source=theme_support&utm_medium=button&utm_campaign=Botiga';

	// Community.
	$settings['community_link'] = 'https://www.facebook.com/groups/athemes/';

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
	$settings['pro_link']  = 'https://athemes.com/theme/botiga?utm_source=theme_table&utm_medium=button&utm_campaign=Botiga#pro';

	return $settings;
}
add_filter( 'atss_register_demos_settings', 'botiga_demos_settings' );

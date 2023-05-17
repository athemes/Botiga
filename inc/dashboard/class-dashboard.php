<?php
/**
 *
 * Dashboard
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Dashboard class.
 */
class Botiga_Dashboard
{

    /**
     * The settings of page.
     *
     * @var array $settings The settings.
     */
    public $settings = array();

    /**
     * Constructor.
     */
    public function __construct()
    {

        if (defined('BOTIGA_AWL_ACTIVE')) {
            return;
        }

        add_filter('woocommerce_enable_setup_wizard', '__return_false');

        add_action('init', array($this, 'set_settings'));
        add_action('admin_menu', array($this, 'add_menu_page'));
        add_action('admin_notices', array($this, 'html_notice'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));

        add_action('wp_ajax_botiga_plugin', array($this, 'ajax_plugin'));
        add_action('wp_ajax_botiga_dismissed_handler', array($this, 'ajax_dismissed_handler'));

        add_action('switch_theme', array($this, 'reset_notices'));
        add_action('after_switch_theme', array($this, 'reset_notices'));

    }

    /**
     * Settings
     *
     * @param array $settings The settings.
     */
    public function set_settings()
    {
        $this->settings = apply_filters('botiga_dashboard_settings', array());
    }

    /**
     * Add menu page
     */
    public function add_menu_page()
    {

        add_submenu_page('themes.php', esc_html__('Theme Dashboard', 'botiga'), esc_html__('Theme Dashboard', 'botiga'), 'manage_options', $this->settings['menu_slug'], array($this, 'html_dashboard'), 1); // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page

    }

    /**
     * This function will register scripts and styles for admin dashboard.
     *
     * @param string $page Current page.
     */
    public function admin_enqueue_scripts($hook)
    {

        if (!in_array($hook, array('themes.php', 'appearance_page_botiga-dashboard'))) {
            return;
        }

        wp_enqueue_style('botiga-dashboard', get_template_directory_uri() . '/assets/css/admin/botiga-dashboard.min.css', array(), BOTIGA_VERSION);

        if (is_rtl()) {
            wp_enqueue_style('botiga-dashboard-rtl', get_template_directory_uri() . '/assets/css/admin/botiga-dashboard-rtl.min.css', array(), BOTIGA_VERSION);
        }

        wp_enqueue_script('botiga-dashboard', get_template_directory_uri() . '/assets/js/admin/botiga-dashboard.min.js', array('jquery'), BOTIGA_VERSION, true);

        wp_localize_script('botiga-dashboard', 'botiga_dashboard', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('nonce'),
            'i18n' => array(
                'installing' => esc_html__('Installing...', 'botiga'),
                'activating' => esc_html__('Activating...', 'botiga'),
                'deactivating' => esc_html__('Deactivating...', 'botiga'),
                'redirecting' => esc_html__('Redirecting...', 'botiga'),
                'activated' => esc_html__('Activated', 'botiga'),
                'deactivated' => esc_html__('Deactivated', 'botiga'),
                'failed_message' => esc_html__('Something went wrong, contact support.', 'botiga'),
            ),
        ));
    }

    /**
     * Get plugin status.
     *
     * @param string $plugin_path Plugin path.
     */
    public function get_plugin_status($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('is_plugin_active_for_network')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_path)) {
            return 'not_installed';
        } elseif (in_array($plugin_path, (array) get_option('active_plugins', array()), true) || is_plugin_active_for_network($plugin_path)) {
            return 'active';
        } else {
            return 'inactive';
        }

    }

    /**
     * Get plugin data.
     *
     * @param string $plugin_path Plugin path.
     */
    public function get_plugin_data($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        return get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin_path);

    }

    /**
     * Install a plugin.
     *
     * @param string $plugin_slug Plugin slug.
     */
    public function install_plugin($plugin_slug)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('plugins_api')) {
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }
        if (!class_exists('WP_Upgrader')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        if (false === filter_var($plugin_slug, FILTER_VALIDATE_URL)) {
            $api = plugins_api(
                'plugin_information',
                array(
                    'slug' => $plugin_slug,
                    'fields' => array(
                        'short_description' => false,
                        'sections' => false,
                        'requires' => false,
                        'rating' => false,
                        'ratings' => false,
                        'downloaded' => false,
                        'last_updated' => false,
                        'added' => false,
                        'tags' => false,
                        'compatibility' => false,
                        'homepage' => false,
                        'donate_link' => false,
                    ),
                )
            );

            $download_link = $api->download_link;
        } else {
            $download_link = $plugin_slug;
        }

        // Use AJAX upgrader skin instead of plugin installer skin.
        // ref: function wp_ajax_install_plugin().
        $upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());

        $install = $upgrader->install($download_link);

        if (false === $install) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Activate a plugin.
     *
     * @param string $plugin_path Plugin path.
     */
    public function activate_plugin($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return false;
        }

        if (!function_exists('activate_plugin')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        $activate = activate_plugin($plugin_path, '', false, true);

        if (is_wp_error($activate)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Deactivate a plugin.
     *
     * @param string $plugin_path Plugin path.
     */
    public function deactivate_plugin($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return false;
        }

        if (!function_exists('deactivate_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        $deactivate = deactivate_plugins($plugin_path);

        if (is_wp_error($deactivate)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Ajax plugin.
     */
    public function ajax_plugin()
    {

        check_ajax_referer('nonce', 'nonce');

        $plugin_type = (isset($_POST['type'])) ? sanitize_text_field(wp_unslash($_POST['type'])) : '';
        $plugin_slug = (isset($_POST['slug'])) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
        $plugin_path = (isset($_POST['path'])) ? sanitize_text_field(wp_unslash($_POST['path'])) : '';

        if (!current_user_can('install_plugins') || empty($plugin_slug) || empty($plugin_type)) {
            wp_send_json_error(esc_html__('Insufficient permissions to install the plugin.', 'botiga'));
        }

        if ($plugin_type === 'install' || $plugin_type === 'activate') {

            if ('not_installed' === $this->get_plugin_status($plugin_path)) {

                $this->install_plugin($plugin_slug);
                $this->activate_plugin($plugin_path);

            } else if ('inactive' === $this->get_plugin_status($plugin_path)) {

                $this->activate_plugin($plugin_path);

            }

            if ('active' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        } else if ($plugin_type === 'deactivate') {

            $this->deactivate_plugin($plugin_path);

            if ('inactive' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        }

        wp_send_json_error(esc_html__('Failed to initialize or activate importer plugin.', 'botiga'));

    }

    /**
     * Dismissed handler
     */
    public function ajax_dismissed_handler()
    {

        check_ajax_referer('nonce', 'nonce');

        if (isset($_POST['notice'])) {
            set_transient(sanitize_text_field(wp_unslash($_POST['notice'])), true, 0);
            wp_send_json_success();
        }

        wp_send_json_error();

    }

    /**
     * Purified from the database information about notification.
     */
    public function reset_notices()
    {
        delete_transient(sprintf('%s_hero_notice', get_template()));
    }

    /**
     * HTML Dashboard
     */
    public function html_dashboard() {
		?>
      	<div class="botiga-dashboard botiga-dashboard-wrap">
			<div class="botiga-dashboard-top-bar">
				<a href="#" class="botiga-dashboard-top-bar-logo">
					<svg width="96" height="24" viewBox="0 0 96 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M23.4693 1.32313L8.45381 14.3107L0.67962 4.82163L23.4693 1.32313Z" fill="#335EEA"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M23.2942 1.17329L8.23868 14.112L16.0129 23.601L23.2942 1.17329Z" fill="#BECCF9"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M54.4276 12.8764C54.4276 10.7582 52.94 9.55047 51.2709 9.55047C49.6019 9.55047 48.8399 10.8325 48.8399 10.8325V4.53369H46.6629V18.5807H48.8399V12.7835C48.8399 12.7835 49.4205 11.6315 50.5453 11.6315C51.4886 11.6315 52.2506 12.1703 52.2506 13.4338V18.5807H54.4276V12.8764ZM39.9463 18.5807V7.6924H36.4449V5.57421H45.6247V7.6924H42.1233V18.5807H39.9463ZM36.604 12.8392C36.604 10.8325 35.1527 9.55047 32.6854 9.55047C30.8894 9.55047 29.2929 10.3494 29.2929 10.3494L30.0004 12.1889C30.0004 12.1889 31.3248 11.5386 32.5766 11.5386C33.3385 11.5386 34.427 11.9102 34.427 13.0622V13.5639C34.427 13.5639 33.6107 12.9321 32.0323 12.9321C30.1637 12.9321 28.658 14.1585 28.658 15.8493C28.658 17.7259 30.1456 18.8036 31.7602 18.8036C33.7014 18.8036 34.5903 17.4658 34.5903 17.4658V18.5807H36.604V12.8392ZM34.427 15.9236C34.427 15.9236 33.7376 16.9456 32.4314 16.9456C31.7602 16.9456 30.8713 16.7412 30.8713 15.8121C30.8713 14.8645 31.7965 14.5672 32.4677 14.5672C33.6469 14.5672 34.427 15.0132 34.427 15.0132V15.9236ZM59.7836 9.55047C62.142 9.55047 64.1195 11.4271 64.1195 14.1399C64.1195 14.3071 64.1195 14.6416 64.1013 14.976H57.6791C57.8424 15.7564 58.7314 16.7598 60.092 16.7598C61.5978 16.7598 62.4504 15.8679 62.4504 15.8679L63.5389 17.5401C63.5389 17.5401 62.1783 18.8036 60.092 18.8036C57.4796 18.8036 55.4659 16.7598 55.4659 14.177C55.4659 11.5943 57.2982 9.55047 59.7836 9.55047ZM61.9425 13.3595H57.6792C57.7517 12.5791 58.3867 11.5758 59.7836 11.5758C61.2168 11.5758 61.9062 12.5977 61.9425 13.3595ZM72.3963 11.0926C72.3987 11.0875 73.1253 9.55047 75.1357 9.55047C76.8773 9.55047 78.1472 10.7954 78.1472 12.9136V18.5807H75.9702V13.4896C75.9702 12.2818 75.5167 11.6315 74.4282 11.6315C73.2852 11.6315 72.741 12.7649 72.741 12.7649V18.5807H70.564V13.4896C70.564 12.2818 70.1104 11.6315 69.0219 11.6315C67.879 11.6315 67.3347 12.7649 67.3347 12.7649V18.5807H65.1577V9.77343H67.1896V11.0555C67.1896 11.0555 67.9697 9.55047 69.7294 9.55047C71.7947 9.55047 72.3946 11.0884 72.3963 11.0926ZM87.8391 14.1399C87.8391 11.4271 85.8616 9.55047 83.5032 9.55047C81.0178 9.55047 79.1855 11.5943 79.1855 14.177C79.1855 16.7598 81.1992 18.8036 83.8116 18.8036C85.8979 18.8036 87.2585 17.5401 87.2585 17.5401L86.17 15.8679C86.17 15.8679 85.3174 16.7598 83.8116 16.7598C82.451 16.7598 81.562 15.7564 81.3988 14.976H87.8209C87.8391 14.6416 87.8391 14.3071 87.8391 14.1399ZM81.3988 13.3595H85.6621C85.6258 12.5977 84.9364 11.5758 83.5032 11.5758C82.1063 11.5758 81.4713 12.5791 81.3988 13.3595ZM89.5486 15.5892L88.3331 17.2057C88.3331 17.2057 89.6937 18.8036 92.2154 18.8036C94.4106 18.8036 95.9708 17.5959 95.9708 16.0909C95.9708 14.2699 94.7553 13.6939 93.0499 13.3223C91.5986 13.0065 91.0181 12.8764 91.0181 12.3376C91.0181 11.7987 91.7619 11.5014 92.5783 11.5014C93.7393 11.5014 94.719 12.2632 94.719 12.2632L95.8075 10.6281C95.8075 10.6281 94.5194 9.55047 92.5783 9.55047C90.2198 9.55047 88.8773 10.9254 88.8773 12.3004C88.8773 13.9727 90.365 14.7159 92.0703 15.0875C93.3765 15.3662 93.7756 15.4777 93.7756 16.0537C93.7756 16.5925 93.0318 16.8527 92.1429 16.8527C90.6915 16.8527 89.5486 15.5892 89.5486 15.5892Z" fill="#101517"/>
					</svg>
				</a>
				<div class="botiga-dashboard-top-bar-infos">
					<div class="botiga-dashboard-top-bar-info-item">
						<div class="botiga-dashboard-theme-version">
							<strong>2.0.7</strong>
							<span class="botiga-dashboard-badge">FREE</span>
						</div>
					</div>
					<div class="botiga-dashboard-top-bar-info-item">
						<a href="#" class="botiga-dashboard-theme-website" target="_blank">
							Website
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M13.6 2.40002H7.20002L8.00002 4.00002H11.264L6.39202 8.88002L7.52002 10.008L12 5.53602V8.00002L13.6 8.80002V2.40002ZM9.60002 9.60002V12H4.00002V6.40002H7.20002L8.80002 4.80002H2.40002V13.6H11.2V8.00002L9.60002 9.60002Z" fill="#3858E9"/>
							</svg>
						</a>
					</div>
				</div>
			</div>

			<?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
        
			<div class="botiga-dashboard-container">
				<div class="botiga-dashboard-row bt-p-relative">
					<div class="botiga-dashboard-column">
						<?php require get_template_directory() . '/inc/dashboard/html-tabs-nav-items.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
					</div>
				</div>
				<div class="botiga-dashboard-row">
					<div class="botiga-dashboard-column">
						<?php 
						$section = ( isset( $_GET['section'] ) ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : '';

						foreach( $this->settings[ 'tabs' ] as $tab_id => $tab_title ) : 
							$tab_active = (($section && $section === $tab_id) || (!$section && $tab_id === 'home')) ? ' active' : '';

							?>	
                            <div class="botiga-dashboard-tab-content-wrapper" data-tab-wrapper-id="main">					
                                <div class="botiga-dashboard-tab-content<?php echo esc_attr( $tab_active ); ?>" data-tab-content-id="<?php echo esc_attr( $tab_id ); ?>">
                                    <?php require get_template_directory() . '/inc/dashboard/html-'. $tab_id .'.php'; ?>
                                </div>
                            </div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
      	</div>
    <?php
	}

    /**
     * HTML Notice
     */
    public function html_notice()
    {

        global $pagenow;

        $screen = get_current_screen();

        if ('themes.php' === $pagenow && 'themes' === $screen->base) {

            $transient = sprintf('%s_hero_notice', get_template());

            if (!get_transient($transient)) {
                ?>
          <div class="botiga-dashboard botiga-dashboard-notice">
            <div class="botiga-dashboard-dismissable dashicons dashicons-dismiss" data-notice="<?php echo esc_attr($transient); ?>"></div>
            <?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
          </div>
        <?php
}

        }

    }

}

new Botiga_Dashboard();

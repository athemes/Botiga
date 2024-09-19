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
    public function __construct() {
        if ( defined('BOTIGA_AWL_ACTIVE') ) {
            return;
        }

        // Display conditions ajax callback needs to be loaded before. 
        if( defined( 'BOTIGA_PRO_VERSION' ) ) {
            add_action( 'wp_ajax_templates_builder_display_conditions_select_ajax', array( $this, 'templates_builder_display_conditions_select_ajax' ) );
        }

        if( ! is_admin() ) {
            return;
        }

        if( $this->is_themes_page() || $this->is_botiga_dashboard_page() ) {
            add_action('init', array( $this, 'set_settings' ));
            add_action('admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
        }

        if( $this->is_botiga_dashboard_page() ) {
            add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );

            if( defined( 'BOTIGA_PRO_VERSION' ) ) {
                add_action( 'admin_footer', array( $this, 'templates_builder_display_conditions_script_template' ) );
            }
        }

        add_filter('woocommerce_enable_setup_wizard', '__return_false');

        add_action('admin_menu', array( $this, 'add_menu_page' ));
        add_action('admin_footer', array( $this, 'add_admin_footer_internal_scripts' ));
        add_action('admin_notices', array( $this, 'html_notice' ));
        
        add_action('wp_ajax_botiga_notifications_read', array( $this, 'ajax_notifications_read' ));

        add_action('wp_ajax_botiga_plugin', array( $this, 'ajax_plugin' ));
        add_action('wp_ajax_botiga_dismissed_handler', array( $this, 'ajax_dismissed_handler' ));

        add_action( 'wp_ajax_botiga_option_switcher_handler', array( $this, 'ajax_option_switcher_handler' ) );
        
        add_action( 'wp_ajax_botiga_module_activation_handler', array( $this, 'ajax_module_activation_handler' ) );
        add_action( 'wp_ajax_botiga_module_activation_all_handler', array( $this, 'ajax_module_activation_all_handler' ) );

        $is_legacy_tb = get_option( 'botiga-legacy-templates-builder', false ) == true;
        if( defined( 'BOTIGA_PRO_VERSION' ) && ! $is_legacy_tb ) {
            add_action( 'wp_ajax_botiga_template_builder_data', array( $this, 'ajax_template_builder_data' ) );
            add_action( 'wp_ajax_insert_template_part_callback', array( $this, 'insert_template_part_callback' ) );
            add_action( 'wp_ajax_edit_template_part_callback', array( $this, 'edit_template_part_callback' ) );
        }

        add_action('switch_theme', array( $this, 'reset_notices' ));
        add_action('after_switch_theme', array( $this, 'reset_notices' ));
    }
    
    /**
     * Check if is the themes.php page
     * 
     */
    public function is_themes_page() {
        global $pagenow;
        return $pagenow === 'themes.php';
    }

    /**
     * Check if is the theme dashboard page
     * 
     */
    public function is_botiga_dashboard_page() {
        global $pagenow;

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        return $pagenow === 'admin.php' && ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === 'botiga-dashboard' );
    }

    /**
     * Settings
     *
     * @param array $settings The settings.
     */
    public function set_settings() {

        /**
         * Hook 'botiga_dashboard_settings'
         *
         * @since 1.0.0
         */
        $this->settings = apply_filters('botiga_dashboard_settings', array());
    }

    /**
     * Add menu page
     */
    public function add_menu_page() {
        $is_legacy_tb = get_option( 'botiga-legacy-templates-builder', false ) == true;
        $is_templates_builder_v3 = get_option( 'botiga_templates_builder_v3', 'yes' ) === 'yes';

        // Add main 'Botiga' page
        add_menu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_menu_page
            esc_html__('Botiga', 'botiga'), 
            esc_html__('Botiga', 'botiga'), 
            'manage_options', 
            isset( $this->settings['menu_slug'] ) ? $this->settings['menu_slug'] : 'botiga-dashboard', 
            array( $this, 'html_dashboard' ),
            get_template_directory_uri() . '/assets/img/admin/botiga-icon.svg',
            58.9
        );

        // Add 'Theme Dashboard' page
        add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
            'botiga-dashboard',
            esc_html__('Theme Dashboard', 'botiga'),
            esc_html__('Theme Dashboard', 'botiga'),
            'manage_options',
            get_admin_url() . 'admin.php?page=botiga-dashboard',
            '',
            0
        );

        // Add 'Customize' link
        $customize_url = add_query_arg( 'return', rawurlencode( remove_query_arg( wp_removable_query_args(), isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' ) ), 'customize.php' );
        add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
            'botiga-dashboard',
            esc_html__('Customize', 'botiga'),
            esc_html__('Customize', 'botiga'),
            'manage_options',
            esc_url( $customize_url ),
            '',
            1
        );

        // Add 'Starter Sites' link
        add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
            'botiga-dashboard',
            esc_html__('Starter Sites', 'botiga'),
            esc_html__('Starter Sites', 'botiga'),
            'manage_options',
            get_admin_url() . 'admin.php?page=botiga-dashboard&tab=starter-sites',
            '',
            2
        );

        // Add 'Templates Builder' link
        if ( ! $is_legacy_tb ) {
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'botiga-dashboard',
                esc_html__('Templates Builder', 'botiga'),
                esc_html__('Templates Builder', 'botiga'),
                'manage_options',
                $is_templates_builder_v3 ? get_admin_url() . 'admin.php?page=botiga-dashboard&tab=templates-builder' : get_admin_url() . 'admin.php?page=botiga-dashboard&tab=builder',
                '',
                3
            );
        }

        // Add 'Product Filters' link
        add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
            'botiga-dashboard',
            esc_html__('Product Filters', 'botiga'),
            esc_html__('Product Filters', 'botiga'),
            'manage_options',
            get_admin_url() . 'admin.php?page=botiga-dashboard&tab=products-filter',
            '',
            4
        );

        // Add 'Upgrade' link
        if( ! defined( 'BOTIGA_PRO_VERSION' ) ) {
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'botiga-dashboard',
                esc_html__('Upgrade to Pro', 'botiga'),
                esc_html__('Upgrade to Pro', 'botiga'),
                'manage_options',
                'https://athemes.com/botiga-upgrade?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Botiga',
                '',
                5
            );
        }
    }

    /**
     * Admin footer style.
     * 
     * @return void
     */
    public function add_admin_footer_internal_scripts() {
        ?>
        <style>
            #adminmenu .toplevel_page_botiga-dashboard .wp-submenu a[href="admin.php?page=botiga-dashboard"] {
                display: none;
            }
            #adminmenu .toplevel_page_botiga-dashboard .wp-submenu a[href="https://athemes.com/botiga-upgrade?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Botiga"] {
                background-color: green;
                color: #FFF;
            }
        </style>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                const botigaUpsellMenuItem = document.querySelector( '#adminmenu .toplevel_page_botiga-dashboard .wp-submenu a[href="https://athemes.com/botiga-upgrade?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Botiga"]' );

                if ( ! botigaUpsellMenuItem ) {
                    return;
                }

                botigaUpsellMenuItem.addEventListener( 'click', function( e ){
                    e.preventDefault();

                    const href = this.getAttribute( 'href' );
                    window.open( href, '_blank' );
                } );
            });
        </script>
        <?php
    }

    /**
     * This function will register scripts and styles for admin dashboard.
     *
     * @param string $page Current page.
     */
    public function admin_enqueue_scripts( $hook ) {
        wp_enqueue_style('botiga-dashboard', get_template_directory_uri() . '/assets/css/admin/botiga-dashboard.min.css', array(), BOTIGA_VERSION);

        if (is_rtl()) {
            wp_enqueue_style('botiga-dashboard-rtl', get_template_directory_uri() . '/assets/css/admin/botiga-dashboard-rtl.min.css', array(), BOTIGA_VERSION);
        }

        wp_enqueue_script('botiga-dashboard', get_template_directory_uri() . '/assets/js/admin/botiga-dashboard.min.js', array( 'jquery', 'wp-util', 'jquery-ui-sortable' ), BOTIGA_VERSION, true);

        wp_enqueue_script( 'botiga-select2-js', get_template_directory_uri() . '/assets/vendor/select2/select2.full.min.js', array( 'jquery' ), '4.0.6', true );
		wp_enqueue_style( 'botiga-select2-css', get_template_directory_uri() . '/assets/vendor/select2/select2.min.css', array(), '4.0.6', 'all' );

        wp_enqueue_style('wp-components');

        wp_localize_script('botiga-dashboard', 'botiga_dashboard', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce( 'nonce-bt-dashboard' ),
            'i18n' => array(
                'activate' => esc_html__('Activate', 'botiga'),
                'deactivate' => esc_html__('Deactivate', 'botiga'),
                'installing' => esc_html__('Installing...', 'botiga'),
                'activating' => esc_html__('Activating...', 'botiga'),
                'deactivating' => esc_html__('Deactivating...', 'botiga'),
                'loading' => esc_html__('Loading...', 'botiga'),
                'saving' => esc_html__('Saving...', 'botiga'),
                'saved' => esc_html__('Saved!', 'botiga'),
                'unsaved_changes' => esc_html__('You have unsaved changes.', 'botiga'),
                'save' => esc_html__('Save', 'botiga'),
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
        } elseif (in_array($plugin_path, (array) get_option('active_plugins', array())) || is_plugin_active_for_network($plugin_path)) {
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
     * Ajax notifications.
     */
    public function ajax_notifications_read() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        $latest_notification_date = ( isset( $_POST[ 'latest_notification_date' ] ) ) ? sanitize_text_field( wp_unslash( $_POST[ 'latest_notification_date' ] ) ) : false;
        update_user_meta( get_current_user_id(), 'botiga_dashboard_notifications_latest_read', $latest_notification_date );

        wp_send_json_success();
    }

    /**
     * Ajax plugin.
     */
    public function ajax_plugin() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        $plugin_type = (isset($_POST['type'])) ? sanitize_text_field(wp_unslash($_POST['type'])) : '';
        $plugin_slug = (isset($_POST['slug'])) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
        $plugin_path = (isset($_POST['path'])) ? sanitize_text_field(wp_unslash($_POST['path'])) : '';

        if ( ! current_user_can('install_plugins') || empty($plugin_slug) || empty($plugin_type) ) {
            wp_send_json_error( esc_html__( 'Insufficient permissions to install the plugin.', 'botiga' ) );
        }

        if ($plugin_type === 'install' || $plugin_type === 'activate') {

            if ('not_installed' === $this->get_plugin_status($plugin_path)) {

                $this->install_plugin($plugin_slug);
                $this->activate_plugin($plugin_path);

            } elseif ('inactive' == $this->get_plugin_status($plugin_path)) {

                $this->activate_plugin($plugin_path);

            }

            if ('active' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        } elseif ($plugin_type == 'deactivate') {

            $this->deactivate_plugin($plugin_path);

            if ('inactive' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        }

        wp_send_json_error(esc_html__('Failed to initialize or activate the plugin.', 'botiga'));
    }

    /**
     * Dismissed handler
     */
    public function ajax_dismissed_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if (isset($_POST['notice'])) {
            set_transient(sanitize_text_field(wp_unslash($_POST['notice'])), true, 0);
            wp_send_json_success();
        }

        wp_send_json_error();
    }

    /**
     * Purified from the database information about notification.
     */
    public function reset_notices() {
        delete_transient(sprintf('%s_hero_notice', get_template()));
    }

    /**
     * Option switcher handler.
     */
    public function ajax_option_switcher_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $option_id = ( isset( $_POST[ 'optionId' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['optionId'] ) ) : '';
        $activate  = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? 'yes' : 'no';

        if ( empty( $option_id ) ) {
            wp_send_json_error();
        }

        update_option( $option_id, $activate );

        wp_send_json_success();
    }

    /**
     * Activate/Deactivate Module Ajax
     */
    public function ajax_module_activation_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $module   = ( isset( $_POST[ 'module' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['module'] ) ) : '';
        $activate = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? true : false;

        if ( empty( $module ) ) {
            wp_send_json_error();
        }

        $modules = get_option( 'botiga-modules', array() );
        $modules[ $module ] = $activate;

        update_option( 'botiga-modules', $modules );

        if ( $activate ) {

            /**
             * Hook 'botiga_admin_module_activated'.
             * Fires after a module is activated.
             * 
             * @param string $module Module ID.
             * 
             * @since 2.2.1
             */
            do_action( 'botiga_admin_module_activated', $module );
        } else {

            /**
             * Hook 'botiga_admin_module_deactivated'.
             * Fires after a module is deactivated.
             * 
             * @param string $module Module ID.
             * 
             * @since 2.2.1
             */
            do_action( 'botiga_admin_module_deactivated', $module );
        }

        wp_send_json_success();
    }

    /**
     * Activate/Deactivate All Modules Ajax
     */
    public function ajax_module_activation_all_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $activate = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? true : false;

        // Get a list with all modules id's
        $all_modules_ids = botiga_get_modules_ids();

        // Get current modules active/disabled list
        $current_modules = get_option( 'botiga-modules', array() );

        $modules = array();
        foreach( $all_modules_ids as $module_id ) {

            // Skip some modules
            if( in_array( $module_id, array( 'hf-builder', 'schema-markup', 'adobe-typekit' ) ) ) {
                $modules[ $module_id ] = $current_modules[ $module_id ];
            } else {
                $modules[ $module_id ] = $activate;
            }

        }

        // Update modules option
        update_option( 'botiga-modules', $modules );

        if ( $activate ) {

            /**
             * Hook 'botiga_admin_all_modules_activated'.
             * Fires after all modules are activated.
             * 
             * @param array $modules Modules list.
             * 
             * @since 2.2.1
             */
            do_action( 'botiga_admin_all_modules_activated', $modules );
        } else {

            /**
             * Hook 'botiga_admin_all_modules_deactivated'.
             * Fires after all modules are deactivated.
             * 
             * @param array $modules Modules list.
             * 
             * @since 2.2.1
             */
            do_action( 'botiga_admin_all_modules_deactivated', $modules );
        }
        

        wp_send_json_success();
    }

    /**
     * Admin Footer Text
     */
    public function admin_footer_text() {
        $text = sprintf(
			/* translators: %s: https://wordpress.org/ */
			__( 'Thank you for creating your website with <a href="%s" class="botiga-dashboard-footer-link" target="_blank">Botiga</a>.', 'botiga' ),
			'https://athemes.com/theme/botiga/'
		);

        return $text;
    }

    /**
     * Check if the latest notification is read
     */
    public function latest_notification_is_read() {
        if( ! isset( $this->settings[ 'notifications' ] ) || empty( $this->settings[ 'notifications' ] ) ) {
            return false;
        }
        
        $user_id                     = get_current_user_id();
        $user_read_meta              = get_user_meta( $user_id, 'botiga_dashboard_notifications_latest_read', true );

        $last_notification_date      = strtotime( is_string( $this->settings[ 'notifications' ][0]->post_date ) ? $this->settings[ 'notifications' ][0]->post_date : '' );
        $last_notification_date_ondb = $user_read_meta ? strtotime( $user_read_meta ) : false;

        if( ! $last_notification_date_ondb ) {
            return false;
        }

        if( $last_notification_date > $last_notification_date_ondb ) {
            return false;
        }

        return true;
    }

    /**
     * Templates builder
     */
    public function ajax_template_builder_data() {
        check_ajax_referer('nonce-bt-dashboard', 'nonce');

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        $data = isset( $_POST[ 'data' ] ) ? $this->sanitize_array_deep($_POST['data']) : array();
    
        update_option('botiga_template_builder_data', $data);
    
        wp_send_json_success($data);
    } 

    /**
     * Sanitize array deep.
     */
    private function sanitize_array_deep( $array_data ) {
        return array_map( array( $this, 'sanitize_recursive' ), $array_data );
    }
    
    /**
     * Sanitize recursive.
     */
    private function sanitize_recursive( $value ) {
        if ( is_array( $value ) ) {
            return $this->sanitize_array_deep( $value );
        } else {
            return sanitize_text_field( wp_unslash( $value ) );
        }
    }

    /**
     * Insert a new template
     */
    public function insert_template_part_callback() {
        check_ajax_referer('nonce-bt-dashboard', 'nonce');

		if ( ! isset( $_POST['key'] ) ) {
			wp_send_json_error();
		}

		$post_name      = isset( $_POST['key'] ) && isset( $_POST['part_type'] ) ? sanitize_text_field( wp_unslash( $_POST['key'] ) ) . '-' . sanitize_text_field( wp_unslash( $_POST['part_type'] ) ) : '';
        $page_builder   = isset( $_POST['page_builder'] ) ? sanitize_text_field( wp_unslash( $_POST['page_builder'] ) ) : '';

		$post_title = '';
		$args       = array(
			'post_type'              => 'athemes_hf',
			'name'                   => $post_name,
			'post_status'            => 'publish',
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'posts_per_page'         => 1,
		);

		$post = get_posts( $args );

		if ( empty( $post ) ) {

			$key            = sanitize_text_field( wp_unslash( $_POST['key'] ) );

			$post_title     = __( 'Botiga Template Part - ', 'botiga' ) . str_replace( 'botiga-template-', '', $key ) . '-' . sanitize_text_field( wp_unslash( $_POST['part_type'] ) );

            $params = array(
				'post_content' => '',
				'post_type'    => 'athemes_hf',
				'post_title'   => $post_title,
				'post_name'    => $post_name,
				'post_status'  => 'publish',
			);

            if( $page_builder == 'elementor' ) {
                $params['meta_input'] = array(
                    '_elementor_edit_mode' => 'builder',
                    '_wp_page_template'    => 'elementor_canvas',
                );
            }

			$post_id = wp_insert_post( $params );

		} else { // edit post.
			$post_id    = $post[0]->ID;
			$post_title = $post[0]->post_title;
		}

        $action = $page_builder == 'elementor' ? 'elementor' : 'edit';

		$edit_url = get_admin_url() . 'post.php?post=' . $post_id . '&action=' . $action;

		$result = array(
			'url'   => $edit_url,
			'id'    => $post_id,
			'title' => $post_title,
            'author' => get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) ),
            'author_image' => get_avatar_url( get_the_author_meta( 'ID', get_post_field( 'post_author', $post_id ) ), array( 'size' => 32 ) ),
            'date' => get_the_date( '', $post_id ),
            'preview_url' => get_permalink( $post_id ),
		);

		wp_send_json_success( $result );
	}    

    /**
     * Edit template
     */
    public function edit_template_part_callback() {
        check_ajax_referer('nonce-bt-dashboard', 'nonce');

        if ( ! isset( $_POST['key'] ) ) {
            wp_send_json_error();
        }

        $post_id = sanitize_text_field( wp_unslash( $_POST['key'] ) );

        $post = get_post( $post_id );

        if ( empty( $post ) ) {
            wp_send_json_error();
        }

        $action = 'edit';

        if( class_exists( 'Elementor\Plugin' ) && Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor() ) {
            $action = 'elementor';
        }

        $edit_url = get_admin_url() . 'post.php?post=' . $post_id . '&action=' . $action;

        $result = array(
            'url'   => $edit_url,
            'id'    => $post_id,
            'title' => $post->post_title,
        );

        wp_send_json_success( $result );
    }

    /**
     * Get athemes templates CPT
     */
    public function get_template_parts() {
        $args = array(
            'numberposts'   => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_numberposts
            'post_type'     => 'athemes_hf',
        );  

        $posts = get_posts( $args );

        $parts = array();

        if ( ! empty( $posts ) ) {
            foreach ( $posts as $post ) {
                $parts[ $post->ID ] = $post->post_title;
            }
        }

        return $parts;
    }

    /**
     * Existing parts select
     */
    public function existing_parts_select( $parts = array() ) {
        $html = '<div class="existing-parts-wrapper">';
        
        if ( empty( $parts ) ) {
            $html .= '<div>' . esc_html__( 'No templates found.', 'botiga' ) . '</div>';
        } else {
            $html .= '<select class="existing-parts-select">';
            $html .= '<option value="">' . esc_html__( 'Select existing', 'botiga' ) . '</option>';
    
            foreach ( $parts as $id => $title ) {
    
                $page_builder = 'editor';
                if ( class_exists( 'Elementor\Plugin' ) && Elementor\Plugin::$instance->documents->get( $id )->is_built_with_elementor() ) {
                    $page_builder = 'elementor';
                }
                
                $html .= '<option data-page-builder="' . $page_builder . '" value="' . $id . '">' . $title . '</option>';
            }
    
            $html .= '</select>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * Templates builder display conditions script template.
     * 
     */
    public function templates_builder_display_conditions_script_template() {
        botiga_display_conditions_script_template();
    }

    /**
     * Templates Buidler Display conditions ajax callback
     * 
     */
    public function templates_builder_display_conditions_select_ajax() {
        $term   = ( isset( $_GET['term'] ) ) ? sanitize_text_field( wp_unslash( $_GET['term'] ) ) : '';
        $nonce  = ( isset( $_GET['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
        $source = ( isset( $_GET['source'] ) ) ? sanitize_text_field( wp_unslash( $_GET['source'] ) ) : '';

        if ( ! empty( $term ) && ! empty( $source ) && ! empty( $nonce ) && wp_verify_nonce( $nonce, 'nonce-bt-dashboard' ) ) {
            $options = botiga_get_display_conditions_select_options( $term, $source );

            wp_send_json_success( $options );
        } else {
            wp_send_json_error();
        }
    }

    /**
     * HTML Dashboard
     */
    public function html_dashboard() {
        require get_template_directory() . '/inc/dashboard/html-dashboard.php';
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

<?php
/**
 *
 * Dashboard
 * @package Dashboard
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Dashboard class.
 */
class Botiga_Dashboard {

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

    if ( defined( 'BOTIGA_AWL_ACTIVE' ) ) {
      return;
    }

    add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

    add_action( 'init', array( $this, 'set_settings' ) );
    add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
    add_action( 'admin_notices', array( $this, 'html_notice' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

    add_action( 'wp_ajax_botiga_plugin', array( $this, 'ajax_plugin' ) );
    add_action( 'wp_ajax_botiga_dismissed_handler', array( $this, 'ajax_dismissed_handler' ) );

    add_action( 'switch_theme', array( $this, 'reset_notices' ) );
    add_action( 'after_switch_theme', array( $this, 'reset_notices' ) );

  }

  /**
   * Settings
   *
   * @param array $settings The settings.
   */
  public function set_settings() {
    $this->settings = apply_filters( 'botiga_dashboard_settings', array() ); 
  }

  /**
   * Add menu page
   */
  public function add_menu_page() {

    add_submenu_page( 'themes.php', esc_html__( 'Theme Dashboard', 'botiga' ), esc_html__( 'Theme Dashboard', 'botiga' ), 'manage_options', $this->settings['menu_slug'], array( $this, 'html_dashboard' ), 1 ); // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page

  }

  /**
   * This function will register scripts and styles for admin dashboard.
   *
   * @param string $page Current page.
   */
  public function admin_enqueue_scripts( $hook ) {

    if ( ! in_array( $hook, array( 'themes.php', 'appearance_page_botiga-dashboard' ) ) ) {
      return;
    }

    wp_enqueue_style( 'botiga-dashboard', get_template_directory_uri() . '/assets/css/admin/botiga-dashboard.min.css', array(), BOTIGA_VERSION );

    if ( is_rtl() ) {
      wp_enqueue_style( 'botiga-dashboard-rtl', get_template_directory_uri() . '/assets/css/admin/botiga-dashboard-rtl.min.css', array(), BOTIGA_VERSION );
    }

    wp_enqueue_script( 'botiga-dashboard', get_template_directory_uri() . '/assets/js/admin/botiga-dashboard.min.js', array( 'jquery' ), BOTIGA_VERSION, true );

    wp_localize_script( 'botiga-dashboard', 'botiga_dashboard', array(
      'ajax_url'         => admin_url( 'admin-ajax.php' ),
      'nonce'            => wp_create_nonce( 'nonce' ),
      'i18n'             => array(
        'installing'     => esc_html__( 'Installing...', 'botiga' ),
        'activating'     => esc_html__( 'Activating...', 'botiga' ),
        'deactivating'   => esc_html__( 'Deactivating...', 'botiga' ),
        'redirecting'    => esc_html__( 'Redirecting...', 'botiga' ),
        'activated'      => esc_html__( 'Activated', 'botiga' ),
        'deactivated'    => esc_html__( 'Deactivated', 'botiga' ),
        'failed_message' => esc_html__( 'Something went wrong, contact support.', 'botiga' ),
      ),
    ) );
  }

  /**
   * Get plugin status.
   *
   * @param string $plugin_path Plugin path.
   */
  public function get_plugin_status( $plugin_path ) {

    if ( ! current_user_can( 'install_plugins' ) ) {
      return;
    }

    if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_path ) ) {
      return 'not_installed';
    } elseif ( in_array( $plugin_path, (array) get_option( 'active_plugins', array() ), true ) || is_plugin_active_for_network( $plugin_path ) ) {
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
  public function get_plugin_data( $plugin_path ) {

    if ( ! current_user_can( 'install_plugins' ) ) {
      return;
    }

    if ( ! function_exists( 'get_plugin_data' ) ) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    return get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_path );

  }

  /**
   * Install a plugin.
   *
   * @param string $plugin_slug Plugin slug.
   */
  public function install_plugin( $plugin_slug ) {

    if ( ! current_user_can( 'install_plugins' ) ) {
      return;
    }

    if ( ! function_exists( 'plugins_api' ) ) {
      require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }
    if ( ! class_exists( 'WP_Upgrader' ) ) {
      require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    if ( false === filter_var( $plugin_slug, FILTER_VALIDATE_URL ) ) {
      $api = plugins_api(
        'plugin_information',
        array(
          'slug'   => $plugin_slug,
          'fields' => array(
            'short_description' => false,
            'sections'          => false,
            'requires'          => false,
            'rating'            => false,
            'ratings'           => false,
            'downloaded'        => false,
            'last_updated'      => false,
            'added'             => false,
            'tags'              => false,
            'compatibility'     => false,
            'homepage'          => false,
            'donate_link'       => false,
          ),
        )
      );

      $download_link = $api->download_link;
    } else {
      $download_link = $plugin_slug;
    }

    // Use AJAX upgrader skin instead of plugin installer skin.
    // ref: function wp_ajax_install_plugin().
    $upgrader = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );

    $install = $upgrader->install( $download_link );

    if ( false === $install ) {
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
  public function activate_plugin( $plugin_path ) {

    if ( ! current_user_can( 'install_plugins' ) ) {
      return false;
    }

    if ( ! function_exists( 'activate_plugin' ) ) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    $activate = activate_plugin( $plugin_path, '', false, true );

    if ( is_wp_error( $activate ) ) {
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
  public function deactivate_plugin( $plugin_path ) {

    if ( ! current_user_can( 'install_plugins' ) ) {
      return false;
    }

    if ( ! function_exists( 'deactivate_plugins' ) ) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    $deactivate = deactivate_plugins( $plugin_path );

    if ( is_wp_error( $deactivate ) ) {
      return false;
    } else {
      return true;
    }
  }

  /**
   * Ajax plugin.
   */
  public function ajax_plugin() {

    check_ajax_referer( 'nonce', 'nonce' );

    $plugin_type = ( isset( $_POST['type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';
    $plugin_slug = ( isset( $_POST['slug'] ) ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';
    $plugin_path = ( isset( $_POST['path'] ) ) ? sanitize_text_field( wp_unslash( $_POST['path'] ) ) : '';

    if ( ! current_user_can( 'install_plugins' ) || empty( $plugin_slug ) || empty( $plugin_type ) ) {
      wp_send_json_error( esc_html__( 'Insufficient permissions to install the plugin.', 'botiga' ) );
    }

    if ( $plugin_type === 'install' || $plugin_type === 'activate' ) {

      if ( 'not_installed' === $this->get_plugin_status( $plugin_path ) ) {

        $this->install_plugin( $plugin_slug );
        $this->activate_plugin( $plugin_path );

      } else if ( 'inactive' === $this->get_plugin_status( $plugin_path ) ) {

        $this->activate_plugin( $plugin_path );

      }

      if ( 'active' === $this->get_plugin_status( $plugin_path ) ) {
        wp_send_json_success();
      }

    } else if ( $plugin_type === 'deactivate' ) {

      $this->deactivate_plugin( $plugin_path );

      if ( 'inactive' === $this->get_plugin_status( $plugin_path ) ) {
        wp_send_json_success();
      }

    }

    wp_send_json_error( esc_html__( 'Failed to initialize or activate importer plugin.', 'botiga' ) );

  }

  /**
   * Dismissed handler
   */
  public function ajax_dismissed_handler() {

    check_ajax_referer( 'nonce', 'nonce' );

    if ( isset( $_POST['notice'] ) ) {
      set_transient( sanitize_text_field( wp_unslash( $_POST['notice'] ) ), true, 0 );
      wp_send_json_success();
    }

    wp_send_json_error();

  }

  /**
   * Purified from the database information about notification.
   */
  public function reset_notices() {
    delete_transient( sprintf( '%s_hero_notice', get_template() ) );
  }

  /**
   * HTML Dashboard
   */
  public function html_dashboard() {
    ?>
      <div class="botiga-dashboard botiga-dashboard-wrap">
        <?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
        <div class="botiga-dashboard-container">
          <?php

            $section = ( isset( $_GET['section'] ) ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : '';

            switch ( $section ) {

              default:
                require get_template_directory() . '/inc/dashboard/html-home.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
              break;

              case 'starter-sites':
                require get_template_directory() . '/inc/dashboard/html-starter-sites.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
              break;

              case 'theme-features':
                require get_template_directory() . '/inc/dashboard/html-theme-features.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
              break;

              case 'settings':
                require get_template_directory() . '/inc/dashboard/html-settings.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
              break;

              case 'useful-plugins':
                require get_template_directory() . '/inc/dashboard/html-useful-plugins.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
              break;

              case 'free-vs-pro':
                require get_template_directory() . '/inc/dashboard/html-free-vs-pro.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
              break;

            }

          ?>
        </div>
      </div>
    <?php
  }

  /**
   * HTML Notice
   */
  public function html_notice() {

    global $pagenow;

    $screen = get_current_screen();

    if ( 'themes.php' === $pagenow && 'themes' === $screen->base ) {

      $transient = sprintf( '%s_hero_notice', get_template() );

      if ( ! get_transient( $transient ) ) {
        ?>
          <div class="botiga-dashboard botiga-dashboard-notice">
            <div class="botiga-dashboard-dismissable dashicons dashicons-dismiss" data-notice="<?php echo esc_attr( $transient ); ?>"></div>
            <?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
          </div>
        <?php
      }

    }

  }

}

new Botiga_Dashboard();

<?php
/**
 * Botiga Pro Upsell Notice
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the botiga pro upsell notice.
 *
 */
class Botiga_Pro_Upsell_Notice {

	/**
	 * Constructor
	 */
	public function __construct() {

		if( defined( 'BOTIGA_AWL_ACTIVE' ) ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_notices', array( $this, 'notice_markup' ), 20 );
        add_action( 'admin_init', array( $this, 'dimiss_notice' ), 0 );
		add_action( 'switch_theme', array( $this, 'notice_data_remove' ) );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'botiga-notices', get_template_directory_uri() . '/assets/css/admin/botiga-notices.min.css', array(), BOTIGA_VERSION, 'all' );
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function notice_markup() {
		$user_id                  = get_current_user_id();
		$dismissed_notice         = get_user_meta( $user_id, 'botiga_pro_upsell_notice_dismiss', true ) ? true : false;

		if( defined( 'BOTIGA_PRO_VERSION' ) ) {
			return;
		}

		if ( $dismissed_notice ) {
			return;
		}

		// Display Conditions
		global $hook_suffix;
		
		if( ! in_array( $hook_suffix, array( 'woocommerce_page_wc-settings', 'index.php', 'plugins.php', 'edit.php', 'plugin-install.php' ) ) ) {
			return;
		}

		if( $hook_suffix === 'edit.php' && ! isset( $_GET[ 'post_type' ] ) ) {
			return;
		}

		if( $hook_suffix === 'edit.php' && ( isset( $_GET[ 'post_type' ] ) && $_GET[ 'post_type' ] !== 'product' ) ) {
			return;
		}

		?>

		<div class="botiga-notice botiga-notice-with-thumbnail notice" style="position:relative;">
			<h3><?php echo esc_html__( 'One theme fully integrated with 35+ plugins features', 'botiga' ); ?></h3>

			<p>
				<?php
					echo esc_html__(
						'Our all-in-one plugin (that extends Botiga theme) is packed with features to help you boost sales and grow your business. Join the thousands of satisfied entrepreneurs who have already taken their website to the next level with Botiga Pro. Don\'t wait - start achieving your website goals today!', 'botiga'
					);
				?>
			</p>

			<a href="https://athemes.com/botiga-upgrade?utm_source=theme_notice&utm_medium=button&utm_campaign=Botiga" class="botiga-btn botiga-btn-secondary" target="_blank"><?php esc_html_e( 'Update To Pro Version', 'botiga' ); ?></a>
			
			<a class="notice-dismiss" href="?botiga_pro_upsell_notice_dismiss=1" style="text-decoration:none;"></a>
		</div>
		<?php
	}

    /**
	 * Dismiss notice permanently
	 */
	public function dimiss_notice() {
		if ( isset( $_GET['botiga_pro_upsell_notice_dismiss'] ) && '1' == $_GET['botiga_pro_upsell_notice_dismiss'] ) {
			add_user_meta( get_current_user_id(), 'botiga_pro_upsell_notice_dismiss', 'true', true );
		}
	}

	/**
	 * Delete data on theme switch
	 */
	public function notice_data_remove() {
		$get_all_users = get_users();

		foreach ( $get_all_users as $user ) {
			$dismissed_notice = get_user_meta( $user->ID, 'botiga_pro_upsell_notice_dismiss', true );

			if ( $dismissed_notice ) {
				delete_user_meta( $user->ID, 'botiga_pro_upsell_notice_dismiss' );
			}
		}
	}
}

new Botiga_Pro_Upsell_Notice();
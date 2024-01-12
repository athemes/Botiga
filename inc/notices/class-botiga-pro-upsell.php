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

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if( $hook_suffix === 'edit.php' && ! isset( $_GET[ 'post_type' ] ) ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if( $hook_suffix === 'edit.php' && ( isset( $_GET[ 'post_type' ] ) && $_GET[ 'post_type' ] !== 'product' ) ) {
			return;
		}

		?>

		<div class="botiga-notice botiga-notice-with-thumbnail notice" style="position:relative;">
			<h3><?php echo esc_html__( 'Earn More with Your Botiga Store! 💰', 'botiga' ); ?></h3>

			<p>
				<?php
					echo esc_html__(
						'Botiga Pro offers 40+ conversion-boosting features created specifically for the Botiga theme. Wishlists, size charts, advanced reviews, variation swatches, gallery styles, and many more! Join the thousands of happy entrepreneurs who have already taken their Botiga store to the next level.', 'botiga'
					);
				?>
			</p>

			<a href="https://athemes.com/botiga-upgrade?utm_source=theme_notice&utm_medium=button&utm_campaign=Botiga" class="botiga-btn botiga-btn-secondary" target="_blank"><?php esc_html_e( 'Upgrade To Botiga Pro', 'botiga' ); ?></a>
			
			<a class="notice-dismiss" href="?botiga_pro_upsell_notice_dismiss=1" style="text-decoration:none;"></a>
		</div>
		<?php
	}

    /**
	 * Dismiss notice permanently
	 */
	public function dimiss_notice() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended, Universal.Operators.StrictComparisons.LooseEqual
		$notice_dismiss = isset( $_GET['botiga_pro_upsell_notice_dismiss'] ) && '1' == $_GET['botiga_pro_upsell_notice_dismiss'];
		if ( $notice_dismiss ) { 
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

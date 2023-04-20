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

		add_action( 'admin_notices', array( $this, 'notice_markup' ), 0 );
        add_action( 'admin_init', array( $this, 'dimiss_notice' ), 0 );
		add_action( 'switch_theme', array( $this, 'notice_data_remove' ) );
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function notice_markup() {
		$user_id                  = get_current_user_id();
		$current_user             = wp_get_current_user();
		$dismissed_notice         = get_user_meta( $user_id, 'botiga_pro_upsell_notice_dismiss', true ) ? true : false;

		if ( $dismissed_notice ) {
			return;
		}

		?>

		<div class="notice notice-success" style="position:relative;">
			<p>
				<?php
				printf(
				    /* Translators: %1$s current user display name. */
					esc_html__(
						'Hey, %1$s! You\'ve been using Botiga for more than two weeks now and we hope you\'re happy with it. If you have a few minutes, we would love to get a 5 star review from you.', 'botiga'
					),
					'<strong>' . esc_html( $current_user->display_name ) . '</strong>'
				);
				?>
			</p>

			<p>
				<a href="https://wordpress.org/support/theme/botiga/reviews/?filter=5#new-post" class="btn button-primary" target="_blank"><?php esc_html_e( 'asdsad', 'botiga' ); ?></a>
			</p>

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
<?php
/**
 * Botiga campaign notice
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the theme review notice after certain period.
 *
 */
class Botiga_Campaign_Notice {

    /**
     * End date target.
     *
     * @var string
     */
    private $end_date_target = '2025-04-21';
    
	/**
	 * Constructor
	 */
	public function __construct() {
		if( defined( 'BOTIGA_AWL_ACTIVE' ) ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'add_inline_style' ) );
		add_action( 'admin_notices', array( $this, 'review_notice_markup' ), 0 );
		add_action( 'admin_init', array( $this, 'dismiss_notice_handler' ), 0 );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'botiga-notices', get_template_directory_uri() . '/assets/css/admin/botiga-notices.min.css', array(), BOTIGA_VERSION, 'all' );
	}

    /**
     * Add inline style.
     * 
     * @return void
     */
    public function add_inline_style() {
        $css = "
            .toplevel_page_botiga-dashboard #wpbody-content>.updated.botiga-campaign-notice, 
            .toplevel_page_botiga-dashboard #wpbody-content>.notice.botiga-campaign-notice {
                display: block !important;
                margin: -1px -1px 0px -20px;
            }

            .botiga-campaign-notice {
                position: relative !important;
                background: url(". esc_url( get_template_directory_uri() . '/assets/img/admin/easter-background.jpg' ) .");
                background-size: cover;
                background-position: center;
                padding: 30px 30px 0px !important;
                border-left: 0;
            }

            @media(min-width: 1270px) {
                .botiga-campaign-notice {
                    padding: 45px 61px 40px !important;
                }
            }

            .botiga-campaign-notice h3 {
                color: #212121;
                font-size: 42px;
                font-weight: 700;
                line-height: 1.1;
                margin-bottom: 40px;
            }

            @media(min-width: 576px) {
                .botiga-campaign-notice h3 {
                    min-width: 425px;
                    max-width: 25%;
                    line-height: 0.8;
                }   
            }

            .botiga-campaign-notice h3 span {
                position: relative;
                top: 12px;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                color: #68B43A;
            }

            .botiga-campaign-notice-thumbnail {
                max-width: 100%;
                height: auto;
                margin-top: 30px;
            }

            @media(min-width: 1270px) {
                .botiga-campaign-notice-thumbnail {
                    position: absolute;
                    right: 40px;
                    bottom: 0;
                    max-width: 553px;
                    margin-top: 0;
                }
            }

            @media(min-width: 1300px) {
                .botiga-campaign-notice-thumbnail {
                    max-width: 663px;
                }
            }

            .botiga-campaign-notice-percent {
                position: relative;
                max-width: 118px;
                top: -2px;
            }

            .botiga-campaign-notice .botiga-btn {
                font-size: 19px;
                padding: 19px 41px;
                border-radius: 7px;
            }

            .botiga-campaign-notice .notice-dismiss,
            .botiga-campaign-notice .notice-dismiss:before {
                color: #212121;
            }

            .botiga-campaign-notice .notice-dismiss:active:before, 
            .botiga-campaign-notice .notice-dismiss:focus:before, 
            .botiga-campaign-notice .notice-dismiss:hover:before {
                color: #757575;
            }
        ";

        wp_add_inline_style( 'botiga-notices', $css );
    }

    /**
	 * Is notice dismissed?.
	 * 
     * @return bool
	 */
	public function is_dismissed() {
		$user_id = get_current_user_id();

        return get_user_meta( $user_id, 'botiga_disable_easter2025_notice', true ) ? true : false;
	}

    /**
	 * Has end date passed.
	 * 
	 * @return bool
	 */
	public function has_end_date_passed() {
		if ( empty( $this->end_date_target ) ) {
			return false;
		}

		$end_date = strtotime( $this->end_date_target );
		$current_date = time();

		return $current_date > $end_date;
	}

	/**
	 * Show HTML markup if conditions meet.
     * 
     * @return void
	 */
	public function review_notice_markup() {
		$dismissed = $this->is_dismissed();
        $has_end_date_passed = $this->has_end_date_passed();

        if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( $dismissed || $has_end_date_passed ) {
			return;
		}

        // Display Conditions
		global $hook_suffix;

        if( ! in_array( $hook_suffix, array( 'toplevel_page_botiga-dashboard' ), true ) ) {
			return;
		}
		
		?>
        
        <div class="botiga-notice notice botiga-campaign-notice" style="position:relative;">
			<h3><?php echo wp_kses_post( sprintf(
                /* Translators: 1. Image url. */
                __( 'Botiga Easter Sale: Up to <span><img src="%1$s" class="botiga-campaign-notice-percent" alt="Up to 30 Percent Off!" /> Off!</span>', 'botiga' ),
                get_template_directory_uri() . '/assets/img/admin/30-percent-green.png'
            ) ); ?></h3>

            <a href="https://athemes.com/pricing/?utm_source=theme_notice&utm_content=easter-notice&utm_medium=button&utm_campaign=Botiga#botiga-pro" class="botiga-btn botiga-btn-primary" target="_blank"><?php esc_html_e( 'Give Me This Deal', 'botiga' ); ?></a>

            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/admin/people-easter.png' ); ?>" alt="<?php echo esc_attr__( 'Ready to join 130,000+ WordPress creators who\'ve found their perfect match?', 'botiga' ); ?>" class="botiga-campaign-notice-thumbnail" />

			<a class="notice-dismiss" href="?page=botiga-dashboard&nag_botiga_disable_campaign_notice=0" style="text-decoration:none;"></a>             
		</div>

		<?php
	}

	/**
	 * Disable review notice permanently
	 */
	public function dismiss_notice_handler() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended, Universal.Operators.StrictComparisons.LooseEqual
		if ( isset( $_GET['nag_botiga_disable_campaign_notice'] ) && '0' == $_GET['nag_botiga_disable_campaign_notice'] ) {
			add_user_meta( get_current_user_id(), 'botiga_disable_easter2025_notice', 'true', true );
		}
	}
}

new Botiga_Campaign_Notice();

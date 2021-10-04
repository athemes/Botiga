<?php
/**
 * Create page control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Create_Page_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-create-page-control';
	public $page_title = '';
	public $page_meta_key = '';
	public $page_meta_value = '';
	public $option_name = '';

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
		$page_id = get_option( $this->option_name );
		if( $page_id && post_exists( get_the_title( $page_id ) ) && get_post_status( $page_id ) === 'publish' ) {
			echo wp_kses_post( 
				/* translators: 1: link to edit page */
				sprintf( 
					__( 'Your page is created!<br>Click <a href="%s" target="_blank">here</a> if you want to edit the page.<br><br>If you want to show a link to this page, assign the page to a menu by clicking <a href="#" data-goto="nav_menus" data-type="panel">here</a>', 'botiga' ), 
				esc_url( get_admin_url() . 'post.php?post='. $page_id .'&action=edit' )
				) 
			);
		} else {
			echo '<div class="botiga-create-page-control-create-message">';
				/* translators: 1: page name */	
				echo sprintf( __( 'Seems you dont\' have a <strong>%s</strong> page created yet. Click in the below button to create the page.', 'botiga' ), esc_html( $this->page_title ) );
				echo '<br><br>';
			echo '</div>';
			echo '<div class="botiga-create-page-control-success-message" style="display: none;">';
				echo wp_kses_post( sprintf( __( 'Page created with success!<br>Click <a href="%s" target="_blank">here</a> if you want to edit the page.<br><br>If you want to show a link to this page, assign the page to a menu by clicking <a href="#" data-goto="nav_menus" data-type="panel">here</a>', 'botiga' ), esc_url( get_admin_url() . 'post.php?post=&action=edit' ) ) );
			echo '</div>';
			echo wp_kses_post( sprintf( 
				__( '<a href="#" class="botiga-create-page-control-button button" data-page-title="%s" data-page-meta-key="%s" data-page-meta-value="%s" data-option-name="%s" data-nonce="%s" data-creating-text="%s" data-created-text="%s">Create Page</a>', 'botiga' ),
				esc_attr( $this->page_title ),
				esc_attr( $this->page_meta_key ),
				esc_attr( $this->page_meta_value ),
				esc_attr( $this->option_name ),
				esc_attr( wp_create_nonce( 'customize-create-page-control-nonce' ) ),
				esc_attr__( 'Creating...', 'botiga' ),
				esc_attr__( 'Created!', 'botiga' )
			) );
		}
	?>
		
	<?php
	}
}

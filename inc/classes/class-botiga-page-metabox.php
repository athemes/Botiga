<?php
/**
 * Single page metabox
 *
 * @package Botiga
 */


function botiga_page_metabox_init() {
    new Botiga_Page_Metabox();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'botiga_page_metabox_init' );
    add_action( 'load-post-new.php', 'botiga_page_metabox_init' );
}

class Botiga_Page_Metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
		
		$types = get_post_types(
			array(
				'public' => true,
			)
		);

        if ( in_array( $post_type, $types ) && ( 'attachment' !== $post_type ) ) {
			add_meta_box(
				'botiga_single_page_metabox'
				,__( 'Botiga Page Options', 'botiga' )
				,array( $this, 'render_meta_box_content' )
				,$types
				,'side'
				,'low'
			);
        }
	}

	public function save( $post_id ) {
	
		// Check if our nonce is set.
		if ( ! isset( $_POST['botiga_single_page_box_nonce'] ) )
			return $post_id;

		$nonce = sanitize_key( wp_unslash( $_POST['botiga_single_page_box_nonce'] ) );

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'botiga_single_page_box' ) )
			return $post_id;


		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;


		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	
		//Page builder mode
		$activate_page_builder_mode = ( isset( $_POST['botiga_page_builder_mode'] ) && '1' === $_POST['botiga_page_builder_mode'] ) ? 1 : 0;
		update_post_meta( $post_id, '_botiga_page_builder_mode', $activate_page_builder_mode );	

		//Sidebar layout
		$sidebar_layout_choices = array( 'customizer', 'sidebar-left', 'sidebar-right', 'no-sidebar' );
		$sidebar_layout 		= $this->sanitize_selects( sanitize_key( $_POST['botiga_sidebar_layout'] ), $sidebar_layout_choices ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated
		update_post_meta( $post_id, '_botiga_sidebar_layout', $sidebar_layout );

		//Disable transparent header
		$disable_header_transparent = ( isset( $_POST['botiga_disable_header_transparent'] ) && '1' === $_POST['botiga_disable_header_transparent'] ) ? 1 : 0;
		update_post_meta( $post_id, '_botiga_disable_header_transparent', $disable_header_transparent );	

		//Hide page title
		$hide_page_title = ( isset( $_POST['botiga_hide_page_title'] ) && '1' === $_POST['botiga_hide_page_title'] ) ? 1 : 0;
		update_post_meta( $post_id, '_botiga_hide_page_title', $hide_page_title );	
	}

	public function render_meta_box_content( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'botiga_single_page_box', 'botiga_single_page_box_nonce' );

		// Render content in specific post types
		$this->render_meta_box_content_all_pts( $post );

		// Render generic content in all post types
		$this->render_meta_box_content_specific_pts( $post );
	}

	/**
	 * Render generic content in all post types
	 */
	public function render_meta_box_content_all_pts( $post ) {
		$disable_header_transparent = get_post_meta( $post->ID, '_botiga_disable_header_transparent', true ); ?>

		<p>
			<label><input type="checkbox" name="botiga_disable_header_transparent" value="1" <?php checked( $disable_header_transparent, 1 ); ?> /><?php esc_html_e( 'Disable transparent header', 'botiga' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Render content in specific post types
	 */
	public function render_meta_box_content_specific_pts( $post ) {
		if( get_post_type() === 'product' ) {
			return;
		}

		$page_builder_mode 	= get_post_meta( $post->ID, '_botiga_page_builder_mode', true );
		$sidebar_layout		= get_post_meta( $post->ID, '_botiga_sidebar_layout', true ); 
		$hide_page_title	= get_post_meta( $post->ID, '_botiga_hide_page_title', true ); ?>

		<p>
			<label><input type="checkbox" name="botiga_page_builder_mode" value="1" <?php checked( $page_builder_mode, 1 ); ?> /><?php esc_html_e( 'Page builder mode', 'botiga' ); ?></label>
			<div style="display:block;"><?php echo esc_html__( 'This mode activates a simplified canvas for building custom pages with either the WP editor or a page builder plugin.', 'botiga' ); ?></div>
		</p>
		<p>
			<label for="botiga_sidebar_layout"><?php esc_html_e( 'Sidebar layout', 'botiga' ); ?></label>	
			<select style="max-width:200px;" name="botiga_sidebar_layout">
				<option value="customizer" <?php selected( $sidebar_layout, 'customizer' ); ?>><?php esc_html_e( 'Default', 'botiga' ); ?></option>
				<option value="sidebar-left" <?php selected( $sidebar_layout, 'sidebar-left' ); ?>><?php esc_html_e( 'Left', 'botiga' ); ?></option>
				<option value="sidebar-right" <?php selected( $sidebar_layout, 'sidebar-right' ); ?>><?php esc_html_e( 'Right', 'botiga' ); ?></option>
				<option value="no-sidebar" <?php selected( $sidebar_layout, 'no-sidebar' ); ?>><?php esc_html_e( 'Disable sidebar for this page', 'botiga' ); ?></option>
			</select>
		</p>
		<?php 
		if( get_post_type() === 'page' ) : ?>
			<p>
				<label><input type="checkbox" name="botiga_hide_page_title" value="1" <?php checked( $hide_page_title, 1 ); ?> /><?php esc_html_e( 'Hide page title', 'botiga' ); ?></label>
			</p>
	<?php
		endif;
	}

	/**
	 * Function to sanitize selects
	 */
	public function sanitize_selects( $input, $choices ) {

		$input = sanitize_key( $input );

		return ( in_array( $input, $choices ) ? $input : '' );
	}
}
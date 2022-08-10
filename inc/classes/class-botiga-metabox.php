<?php
/**
 * Metabox
 *
 * @package Botiga
 */
class Botiga_Metabox {

	public static $options = array();

	public function __construct() {
		add_action( 'load-post.php', array( $this, 'init_metabox' ) );
		add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
	}

	public function init_metabox() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_metabox_scripts' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ) );
	}

	public function enqueue_metabox_scripts() {
		wp_enqueue_style( 'botiga-metabox-styles', get_template_directory_uri() . '/assets/css/metabox.min.css', BOTIGA_VERSION );
		wp_enqueue_script( 'botiga-metabox-scripts', get_template_directory_uri() . '/assets/js/metabox.min.js', array( 'jquery' ), BOTIGA_VERSION, true );
	}

	public function metabox_options() {

		//
		// Begin: General Options
		$this->add_section( 'general', array(
			'title' => esc_html__( 'General', 'botiga' ),
		) );

		$this->add_field( '_botiga_hide_page_title', array(
			'post_type' => array( 'page' ),
			'section'   => 'general',
			'type'      => 'switcher',
			'title'     => esc_html__( 'Hide Page Title', 'botiga' ),
		) );

		$this->add_field( '_botiga_disable_header_transparent', array(
			'section' => 'general',
			'type'    => 'switcher',
			'title'   => esc_html__( 'Disable Transparent Header', 'botiga' ),
		) );

		$this->add_field( '_botiga_page_builder_mode', array(
			'post_type' => array( 'post', 'page' ),
			'section'   => 'general',
			'type'      => 'switcher',
			'title'     => esc_html__( 'Page Builder Mode', 'botiga' ),
			'subtitle'  => esc_html__( 'This mode activates a simplified canvas for building custom pages with either the WP editor or a page builder plugin.', 'botiga' ),
		) );
		// End: General Options
		//

		//
		// Begin: Sidebar Options
		$this->add_section( 'sidebar', array(
			'post_type' => array( 'post', 'page' ),
			'title'     => esc_html__( 'Sidebar', 'botiga' ),
		) );

		$this->add_field( '_botiga_sidebar_layout', array(
			'section' => 'sidebar',
			'type'    => 'choices',
			'title'   => esc_html__( 'Sidebar Layout', 'botiga' ),
			'options'         => array(
				'customizer'    => array(
					'label'       => esc_html__( 'Default', 'botiga' ),
					'image'       => '%s/assets/img/meta-sidebar-default.svg',
				),
				'sidebar-left'  => array(
					'label'       => esc_html__( 'Left', 'botiga' ),
					'image'       => '%s/assets/img/meta-sidebar-left.svg',
				),
				'sidebar-right' => array(
					'label'       => esc_html__( 'Right', 'botiga' ),
					'image'       => '%s/assets/img/meta-sidebar-right.svg',
				),
				'no-sidebar'    => array(
					'label'       => esc_html__( 'No Sidebar', 'botiga' ),
					'image'       => '%s/assets/img/meta-sidebar-none.svg',
				),
			),
		) );
		// End: Sidebar Options
		//

		do_action( 'botiga_metabox_options', self::$options );

		self::$options = apply_filters( 'botiga_metabox_options_filter', self::$options );

		//
		// Set priority order
		//
  		self::$options = wp_list_sort( self::$options, array( 'priority' => 'ASC' ), 'ASC', true );

		foreach ( self::$options as $key => $value ) {
    		self::$options[ $key ]['fields'] = wp_list_sort( $value['fields'], array( 'priority' => 'ASC' ), 'ASC', true );
		}

		return self::$options;

	}

	public function add_section( $id, $args ) {

		if ( ! empty( $args['post_type'] ) && ! in_array( get_post_type(), $args['post_type'] ) ) {
			return;
		}

		$args = wp_parse_args( $args, array(
			'title'    => '',
			'fields'   => array(),
			'priority' => ( count( self::$options ) + 1 ) * 10,
		) );

		self::$options[ $id ] = $args;

	}

	public function add_field( $id, $args ) {

		if ( ( ! empty( $args['post_type'] ) && ! in_array( get_post_type(), $args['post_type'] ) ) || empty( self::$options[ $args['section'] ] ) ) {
			return;
		}

		$args = wp_parse_args( $args, array(
			'priority' => ( count( self::$options[ $args['section'] ]['fields'] ) + 1 ) * 10,
		) );

		self::$options[ $args['section'] ]['fields'][ $id ] = $args;

	}

	public function add_metabox( $post_type ) {

		if ( $post_type === 'attachment' ) {
			return;
		}

		$types = get_post_types( array(
			'public' => true,
		) );

		if ( ! in_array( $post_type, $types ) ) {
			return;
		}

		switch ( $post_type ) {

			case 'post':
				$metabox_title = esc_html__( 'Botiga Post Options', 'botiga' );
			break;

			case 'page':
				$metabox_title = esc_html__( 'Botiga Page Options', 'botiga' );
			break;

			case 'product':
				$metabox_title = esc_html__( 'Botiga Product Options', 'botiga' );
			break;

		}

		$metabox_title = apply_filters( 'botiga_metabox_title', $metabox_title, $post_type );

		add_meta_box( 'botiga_metabox', $metabox_title, array( $this, 'render_metabox_content' ), $types, 'normal', 'low' );

	}

	public function render_metabox_content( $post ) {

		$options = $this->metabox_options();

		$post_type = get_post_type( $post );

		wp_nonce_field( 'botiga_metabox', 'botiga_metabox_nonce' );

		echo '<div class="botiga-metabox">';

			echo '<div class="botiga-metabox-tabs">';

				$num = 0;

				foreach ( $options as $option ) {

					$active = ( $num === 0 ) ? ' active' : '';

					echo '<a href="#" class="botiga-metabox-tab'. esc_attr( $active ) .'">'. esc_html( $option['title'] ) .'</a>';

					$num++;

				}

			echo '</div>';

			echo '<div class="botiga-metabox-contents">';

				$num = 0;

				foreach ( $options as $option ) {

					$active = ( $num === 0 ) ? ' active' : '';

					echo '<div class="botiga-metabox-content'. esc_attr( $active ) .'">';

						echo '<h4 class="botiga-metabox-content-title">'. esc_html( $option['title'] ) .'</h4>';

						if ( ! empty( $option['fields'] ) ) {

							foreach ( $option['fields'] as $field_id => $field ) {

								echo '<div class="botiga-metabox-field botiga-metabox-field-'. esc_attr( $field['type'] ).'">';

									if ( ! empty( $field['title'] ) || ! empty( $field['subtitle'] ) ) {

										echo '<div class="botiga-metabox-field-title">';

											if ( ! empty( $field['title'] ) ) {
												echo '<h4>'. esc_html( $field['title'] ) .'</h4>';
											}

											if ( ! empty( $field['subtitle'] ) ) {
												echo '<small class="botiga-metabox-field-subtitle">'. esc_html( $field['subtitle'] ) .'</small>';
											}

										echo '</div>';

									}

									echo '<div class="botiga-metabox-field-content">';

										$meta    = get_post_meta( $post->ID, $field_id );
										$default = ( isset( $field['default'] ) ) ? $field['default'] : null;
										$value   = ( isset( $meta[0] ) ) ? $meta[0] : $default;

										$this->get_field( $field_id, $field, $value );

										if ( ! empty( $field['desc'] ) ) {
											echo '<div class="botiga-metabox-field-description">'. esc_html( $field['desc'] ) .'</div>';
										}

									echo '</div>';

								echo '</div>';

							}

						}

					echo '</div>';

					$num++;

				}

			echo '</div>';

		echo '</div>';

	}

	public function save_metabox( $post_id ) {

		if ( ! isset( $_POST['botiga_metabox_nonce'] ) ) {
			return $post_id;
		}

		$nonce = sanitize_key( wp_unslash( $_POST['botiga_metabox_nonce'] ) );

		if ( ! wp_verify_nonce( $nonce, 'botiga_metabox' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}

		$options = $this->metabox_options();

		if ( empty( $options ) ) {
			return $post_id;
		}

		foreach ( $options as $option ) {

			if ( ! empty( $option['fields'] ) ) {

				foreach ( $option['fields'] as $field_id => $field ) {

					if ( in_array( $field['type'], array( 'content' ) ) ) {
						continue;
					}

					$value = ( isset( $_POST[ $field_id ] ) ) ? wp_unslash( $_POST[ $field_id ] ) : null; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

					$value = $this->sanitize( $field, $value );

					update_post_meta( $post_id, $field_id, $value );

				}

			}

		}

	}

	public function sanitize( $field, $value ) {

		switch ( $field['type'] ) {

			case 'text':
				return sanitize_text_field( $value );
			break;

			case 'textarea':
				return sanitize_textarea_field( $value );
			break;

			case 'checkbox':
			case 'switcher':
				return ( $value === '1' ) ? 1 : 0;
			break;

			case 'number':
				return absint( $value );
			break;

			case 'select':
			case 'choices':
				return ( in_array( $value, array_keys( $field['options'] ) ) ) ? sanitize_key( $value ) : '';
			break;

		}

		return $value;

	}

	public function get_field( $field_id, $field, $value ) {

		switch ( $field['type'] ) {

			case 'text':
				echo '<input type="text" name="'. esc_attr( $field_id ) .'" value="'. esc_attr( $value ) .'" />';
			break;

			case 'number':
				echo '<input type="number" name="'. esc_attr( $field_id ) .'" value="'. esc_attr( $value ) .'" />';
			break;

			case 'textarea':
				echo '<textarea name="'. esc_attr( $field_id ) .'">'. esc_textarea( $value ) .'</textarea>';
			break;

			case 'checkbox':
			case 'switcher':

				$field = wp_parse_args( $field, array(
					'label' => '',
				) );

				echo '<label>';

					echo '<input type="checkbox" name="'. esc_attr( $field_id ) .'" value="1"'. checked( $value, true, false ) .' />';

					if ( $field['type'] === 'switcher' ) {
						echo '<i></i>';
					}

					if ( ! empty( $field['label'] ) ) {
						echo '<span>'. esc_html( $field['label'] ) .'</span>';
					}

				echo '</label>';

			break;

			case 'select':

				echo '<select name="'. esc_attr( $field_id ) .'">';

					foreach ( $field['options'] as $key => $option ) {
						echo '<option value="'. esc_attr( $key ) .'"'. selected( $key, $value, false ) .'>'. esc_html( $option ) .'</option>';
					}

				echo '</select>';

			break;

			case 'choices':

				echo '<div class="botiga-metabox-field-choices-images">';

				foreach ( $field['options'] as $key => $option ) {

					echo '<label>';
					echo '<input type="radio" name="'. esc_attr( $field_id ) .'" value="'. esc_attr( $key ) .'"'. checked( $value, $key, false ) .' />';
					echo '<figure><img src="'. esc_url( sprintf( $option['image'], get_stylesheet_directory_uri() ) ) .'" title="'. esc_attr( $option['label'] ) .'" alt="'. esc_attr( $option['label'] ) .'" /></figure>';
					echo '</label>';

				}

				echo '</div>';

			break;

			case 'content':

				echo '<div class="botiga-metabox-field-content">'. wp_kses_post( $field['content'] ) .'</div>';

			break;

		}

	}

}

new Botiga_Metabox();
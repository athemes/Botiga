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
		add_action( 'wp_ajax_botiga_select_ajax', array( $this, 'botiga_select_ajax' ) );
	}

	public function init_metabox() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_metabox_scripts' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ) );
	}

	public function botiga_select_ajax() {

		$term   = ( isset( $_GET['term'] ) ) ? sanitize_text_field( wp_unslash( $_GET['term'] ) ) : '';
		$nonce  = ( isset( $_GET['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
		$source = ( isset( $_GET['source'] ) ) ? sanitize_text_field( wp_unslash( $_GET['source'] ) ) : '';

		if ( ! empty( $term ) && ! empty( $source ) && ! empty( $nonce ) && wp_verify_nonce( $nonce, 'botiga_metabox' ) ) {

			$options = array();

			switch ( $source ) {

				case 'post':
				case 'product':
					
        	$query = new WP_Query( array(
		        's'              => $term,
						'post_type'      => $source,
		        'post_status'    => 'publish',
            'posts_per_page' => 25,
          	'order'          => 'DESC',
					) );

	        if ( ! empty( $query->posts ) ) {
	          foreach( $query->posts as $post ) {
							$options[] = array(
								'id'   => $post->ID,
								'text' => $post->post_title,
							);
	        	}
	        }
		
				break;
				
			}

			wp_send_json_success( $options );
	
		} else {

			wp_send_json_error();

		}

	}

	public function enqueue_metabox_scripts() {

		wp_enqueue_code_editor(
			array(
			'type'       => 'text/html',
			'codemirror' => array(
				'indentUnit' => 2,
				'tabSize'    => 2,
			),
		) );
	
		wp_enqueue_script( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
		wp_enqueue_style( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.min.css', array(), '4.0.13', 'all' );

		wp_enqueue_style( 'botiga-metabox-styles', get_template_directory_uri() . '/assets/css/metabox.min.css', BOTIGA_VERSION );
		wp_enqueue_script( 'botiga-metabox-scripts', get_template_directory_uri() . '/assets/js/metabox.min.js', array( 'jquery', 'jquery-ui-sortable' ), BOTIGA_VERSION, true );
		
		wp_localize_script( 'botiga-metabox-scripts', 'botiga_metabox', array(
			'ajaxurl'   => admin_url( 'admin-ajax.php' ),
			'ajaxnonce' => wp_create_nonce( 'botiga_metabox' ),
		) );

	}

	public function metabox_options() {

		//
		// Begin: General Options
		$this->add_section( 'general', array(
			'title'   => esc_html__( 'General', 'botiga' ),
			'exclude' => array( 'size_chart', 'linked_variation' ),
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
			'post_type' => array( 'post', 'page', 'product' ),
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

		if ( ! empty( $args['exclude'] ) && in_array( get_post_type(), $args['exclude'] ) ) {
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

		$metabox_title = 'Botiga Options';

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

			case 'size_chart':
				$metabox_title = esc_html__( 'Botiga Size Chart Options', 'botiga' );
			break;

			case 'linked_variation':
				$metabox_title = esc_html__( 'Botiga Linked Variation Options', 'botiga' );
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

			$has_tabs = ( ! empty( array_filter( array_column( $options, 'title' ) ) ) ) ? true : false;

			if ( ! empty( $has_tabs ) ) {

				echo '<div class="botiga-metabox-tabs">';

					$num = 0;

					foreach ( $options as $option ) {

						if ( ! empty( $option['title'] ) ) {
							
							$active = ( $num === 0 ) ? ' active' : '';
							
							echo '<a href="#" class="botiga-metabox-tab'. esc_attr( $active ) .'">'. esc_html( $option['title'] ) .'</a>';
							
							$num++;
						
						}

					}

				echo '</div>';

			}

			echo '<div class="botiga-metabox-contents">';

				$num = 0;

				foreach ( $options as $option ) {

					$active = ( $num === 0 ) ? ' active' : '';

					echo '<div class="botiga-metabox-content'. esc_attr( $active ) .'">';

						if ( ! empty( $option['title'] ) ) {
							echo '<h4 class="botiga-metabox-content-title">'. esc_html( $option['title'] ) .'</h4>';
						}

						if ( ! empty( $option['fields'] ) ) {

							foreach ( $option['fields'] as $field_id => $field ) {

								$separator = ( ! empty( $field['separator'] ) ) ? $field['separator'] : 'after';

								$classes   = array();
								$classes[] = 'botiga-metabox-field';
								$classes[] = 'botiga-metabox-field-separator-'. $separator;
								$classes[] = 'botiga-metabox-field-'. $field['type'];

								if ( ! empty( $field['class'] ) ) {
									$classes[] = $field['class'];
								}

								if ( ! empty( $field['inline'] ) ) {
									$classes[] = 'botiga-metabox-field-inline';
								}

								if ( ! empty( $field['depend'] ) ) {

									$depend_meta = get_post_meta( $post->ID, $field['depend'], true );

									if ( empty( $depend_meta ) ) {
										$classes[] = 'botiga-metabox-field-hidden';
									}
								
									echo '<div class="'. esc_attr( join( ' ', $classes ) ) .'" data-depend-on="'. esc_attr( $field['depend'] ) .'">';
								
								} else {

									echo '<div class="'. esc_attr( join( ' ', $classes ) ) .'">';

								}

									if ( isset( $field['title'] ) || isset( $field['subtitle'] ) ) {

										echo '<div class="botiga-metabox-field-title">';

											if ( ! empty( $field['title'] ) ) {
												echo '<h4>'. wp_kses_post( $field['title'] ) .'</h4>';
											}

											if ( ! empty( $field['subtitle'] ) ) {
												echo '<small class="botiga-metabox-field-subtitle">'. wp_kses_post( $field['subtitle'] ) .'</small>';
											}

										echo '</div>';

									}

									echo '<div class="botiga-metabox-field-content">';

										$meta    = get_post_meta( $post->ID, $field_id );
										$default = ( isset( $field['default'] ) ) ? $field['default'] : null;
										$value   = ( isset( $meta[0] ) ) ? $meta[0] : $default;

										$this->get_field( $field_id, $field, $value );

										if ( ! empty( $field['desc'] ) ) {
											echo '<div class="botiga-metabox-field-description">'. wp_kses_post( $field['desc'] ) .'</div>';
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
			case 'sidebar-select':
			case 'size-chart-select':
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

			case 'select-ajax':
				return ( is_array( $value ) && ! empty( $value ) ) ? array_filter( array_map( 'sanitize_text_field', $value ) ) : array();
			break;

			case 'wc-attributes':
				return ( is_array( $value ) && ! empty( $value ) ) ? array_filter( array_map( 'sanitize_text_field', $value ) ) : array();
			break;

			case 'repeater':
			case 'uploads':
				return ( is_array( $value ) && ! empty( $value ) ) ? array_filter( array_map( 'sanitize_text_field', $value ) ) : array();
			break;

			case 'size-chart':
				return ( is_array( $value ) && ! empty( $value ) ) ? array_filter( map_deep( $value, 'sanitize_text_field' ) ) : array();
			break;

			case 'wp-editor':
				return wp_kses_post( $value );
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

			case 'select-ajax':
				
				$field = wp_parse_args( $field, array(
					'source' => 'post',
				) );

				$ids = ( is_array( $value ) && ! empty( $value ) ) ? $value : (array) $value;

				echo '<select name="'. esc_attr( $field_id ) .'[]" multiple data-source="'. esc_attr( $field['source'] ) .'">';

					if ( ! empty( $ids ) ) {

						foreach ( $ids as $id ) {

							switch ( $field['source'] ) {

								case 'post':
								case 'product':
		
									$post = get_post( $id );

									if ( ! empty( $post ) ) {
										echo '<option value="'. esc_attr( $post->ID ) .'" selected>'. esc_html( $post->post_title ) .'</option>';
									}

								break;

							}
						
						}

					}

				echo '</select>';

			break;

			case 'wc-attributes':

				$attributes = wp_list_pluck( wc_get_attribute_taxonomies(), 'attribute_label', 'attribute_id' );
			
				$values = ( is_array( $value ) && ! empty( $value ) ) ? $value : array();

				if ( ! empty( $attributes ) ) {

					echo '<div class="botiga-metabox-field-attributes">';

						echo '<ul class="botiga-sortable">';

							$selected_attributes = array();

							foreach ( $values as $id ) {
								if ( isset( $attributes[ $id ] ) ) {
									$selected_attributes[ $id ] = $attributes[ $id ];
									unset( $attributes[ $id ] );
								}
							}

							$attributes = array_replace( $selected_attributes, $attributes );

							foreach ( $attributes as $attribute_id => $attribute_label ) {

								$checked = ( in_array( $attribute_id, $values ) ) ? ' checked' : '';

								echo '<li class="botiga-sortable-item">';
								echo '<label>';
								echo '<input type="checkbox" name="'. esc_attr( $field_id ) .'[]" value="'. esc_attr( $attribute_id ) .'"'. esc_attr( $checked ) .' />';
								echo '<span>'. esc_html( $attribute_label ) .'</span>';
								echo '</label>';
								echo '<span class="botiga-sortable-move dashicons dashicons-menu"></span>';
								echo '</li>';

							}
						
						echo '</ul>';
				
					echo '</div>';

				}

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

				echo wp_kses_post( $field['content'] );

			break;

			case 'repeater':

				$field = wp_parse_args( $field, array(
					'button' => '',
				) );

				echo '<div class="botiga-metabox-field-repeater-content">';

					$values = ( is_array( $value ) && ! empty( $value ) ) ? $value : array();

					echo '<ul class="botiga-metabox-field-repeater-list">';

						echo '<li class="botiga-metabox-field-repeater-list-item hidden">';
						echo '<input type="text" name="" value="" data-name="'. esc_attr( $field_id ) .'[]" />';
						echo '<span class="botiga-metabox-field-repeater-move dashicons dashicons-menu"></span>';
						echo '<span class="botiga-metabox-field-repeater-remove dashicons dashicons-trash"></span>';
						echo '</li>';

						foreach ( $values as $key => $value ) {
							echo '<li class="botiga-metabox-field-repeater-list-item">';
							echo '<input type="text" name="'. esc_attr( $field_id ) .'[]" value="'. esc_attr( $value ) .'" />';
							echo '<span class="botiga-metabox-field-repeater-move dashicons dashicons-menu"></span>';
							echo '<span class="botiga-metabox-field-repeater-remove dashicons dashicons-trash"></span>';
							echo '</li>';
						}
	
					echo '</ul>';

					echo '<button class="botiga-metabox-field-repeater-add button button-primary">'. esc_html( $field['button'] ) .'</button>';

				echo '</div>';

			break;

			case 'media':

        $placeholder  = wc_placeholder_img_src( 'thumbnail' );
        $hidden_class = ( empty( $value ) ) ? ' hidden' : '';

        if ( ! empty( $value ) ) {
            $attachment = wp_get_attachment_image_src( $value, 'thumbnail' );
            $thumbnail  = ( is_array( $attachment ) && ! empty( $attachment[0] ) ) ? $attachment[0] : $placeholder;
        } else {
            $thumbnail = $placeholder;
        }

        echo '<div class="botiga-metabox-field-media-content">';

	        echo '<figure class="botiga-metabox-field-media-preview">';
	        	echo '<img src="'. esc_url( $thumbnail ) .'" data-placeholder="'. esc_url( $placeholder ) .'" />';
					echo '</figure>';

					echo '<div class="botiga-metabox-field-media-button">';
						echo '<a href="#" class="botiga-metabox-field-media-upload button">'. esc_html__( 'Upload/Add Image', 'botiga' ) .'</a>';
						echo '<a href="#" class="botiga-metabox-field-media-remove botiga-button-remove button'. esc_attr( $hidden_class ) .'">'. esc_html__( 'Remove Image', 'botiga' ) .'</a>';
						echo '<input type="hidden" name="'. esc_attr( $field_id ) .'" value="'. esc_attr( $value ) .'" class="botiga-metabox-field-media-input" />';
					echo '</div>';
				
				echo '</div>';

			break;

			case 'uploads':

				$field = wp_parse_args( $field, array(
					'button'  => '',
					'library' => 'image',
				) );

				echo '<div class="botiga-metabox-field-uploads-content">';

					$values = ( is_array( $value ) && ! empty( $value ) ) ? $value : array();

					echo '<ul class="botiga-metabox-field-uploads-list" data-library="'. esc_attr( $field['library'] ) .'">';

						echo '<li class="botiga-metabox-field-uploads-list-item hidden">';
						echo '<input type="text" name="" value="" data-name="'. esc_attr( $field_id ) .'[]" />';
						echo '<button class="botiga-metabox-field-uploads-upload button">'. esc_html__( 'Upload', 'botiga' ) .'</button>';
						echo '<span class="botiga-metabox-field-uploads-move dashicons dashicons-menu"></span>';
						echo '<span class="botiga-metabox-field-uploads-remove dashicons dashicons-trash"></span>';
						echo '</li>';

						foreach ( $values as $key => $value ) {
							echo '<li class="botiga-metabox-field-uploads-list-item">';
							echo '<input type="text" name="'. esc_attr( $field_id ) .'[]" value="'. esc_attr( $value ) .'" />';
							echo '<button class="botiga-metabox-field-uploads-upload button">'. esc_html__( 'Upload', 'botiga' ) .'</button>';
							echo '<span class="botiga-metabox-field-uploads-move dashicons dashicons-menu"></span>';
							echo '<span class="botiga-metabox-field-uploads-remove dashicons dashicons-trash"></span>';
							echo '</li>';
						}
	
					echo '</ul>';

					echo '<button class="botiga-metabox-field-uploads-add button button-primary">'. esc_html( $field['button'] ) .'</button>';

				echo '</div>';

			break;

			case 'size-chart':

				$field = wp_parse_args( $field, array(
					'button' => '',
				) );

				echo '<div class="botiga-metabox-field-size-chart-content">';
					echo '<ul>';
						echo '<li class="hidden">';
							echo '<table>';
								echo '<thead>';
									echo '<tr>';
										echo '<td colspan="100%">';
											echo '<label>';
											echo '<strong>'. esc_html__( 'Size Name', 'botiga' ) .':</strong>';
											echo '<input type="text" value="" data-name="'. esc_attr( $field_id ) .'[0][name]" />';
											echo '</label>';
										echo '</td>';
									echo '</tr>';
								echo '</thead>';
								echo '<tbody>';
									echo '<tr>';
										for ( $a = 0; $a < 4 ; $a++ ) { 
											echo '<td><div class="botiga-buttons"><a href="#" class="botiga-add-col">+</a><a href="#" class="botiga-del-col">-</a></div></td>';
										}
										echo '<td><a href="#" class="botiga-duplicate" title="'. esc_attr__( 'Duplicate', 'botiga' ) .'">'. botiga_get_svg_icon( 'icon-duplicate' ) .'</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo '</tr>';
									for ( $b = 0; $b < 4 ; $b++ ) { 
										echo '<tr>';
											for ( $c =0 ; $c < 4 ; $c++ ) { 
												echo '<td><input type="text" value="" data-name="'. esc_attr( $field_id ) .'[0][sizes][0][0]" /></td>';
											}
											echo '<td><div class="botiga-buttons"><a href="#" class="botiga-add-row">+</a><a href="#" class="botiga-del-row">-</a></div></td>';
										echo '</tr>';
									}
								echo '</tbody>';
								echo '<tfoot>';
									echo '<tr>';
										echo '<td colspan="100%">';
											echo '<a href="#" class="botiga-remove button button-primary">'. esc_html__( 'Remove', 'botiga' ) .'</a>';
										echo '</td>';
									echo '</tr>';
								echo '</tfoot>';
							echo '</table>';
						echo '</li>';
						$tabs = ( is_array( $value ) && ! empty( $value ) ) ? $value : array();
						if ( ! empty( $tabs ) ) {
							foreach ( $tabs as $tab_key => $tab ) {
								$name  = ( ! empty( $tab['name'] ) ) ? $tab['name'] : '';
								$sizes = ( ! empty( $tab['sizes'] ) ) ? $tab['sizes'] : array();
								echo '<li>';
									echo '<table>';
										echo '<thead>';
											echo '<tr>';
												echo '<td colspan="100%">';
													echo '<label>';
													echo '<strong>'. esc_html__( 'Size Name', 'botiga' ) .':</strong>';
													echo '<input type="text" value="'. esc_attr( $name ) .'" name="'. esc_attr( $field_id .'['. $tab_key .'][name]' ) .'" />';
													echo '</label>';
												echo '</td>';
											echo '</tr>';
										echo '</thead>';
										echo '<tbody>';
											foreach ( $sizes as $row_key => $rows ) {
												if ( $row_key === 0 ) {
													echo '<tr>';
														for ( $i = 0; $i < count( $rows ); $i++ ) { 
															echo '<td><div class="botiga-buttons"><a href="#" class="botiga-add-col">+</a><a href="#" class="botiga-del-col">-</a></div></td>';
														}
													echo '<td><a href="#" class="botiga-duplicate" title="'. esc_attr__( 'Duplicate', 'botiga' ) .'">'. botiga_get_svg_icon( 'icon-duplicate' ) .'</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
													echo '</tr>';
												}
												echo '<tr>';
													foreach ( $rows as $col_key => $col ) {
														echo '<td><input type="text" name="'. esc_attr( $field_id .'['. $tab_key .'][sizes]['. $row_key .']['. $col_key .']' ) .'" value="'. esc_attr( $col ) .'" /></td>';
													}
													echo '<td><div class="botiga-buttons"><a href="#" class="botiga-add-row">+</a><a href="#" class="botiga-del-row">-</a></div></td>';
												echo '</tr>';
											}
										echo '</tbody>';
										echo '<tfoot>';
											echo '<tr>';
												echo '<td colspan="100%">';
													echo '<a href="#" class="botiga-remove button button-primary">'. esc_html__( 'Remove', 'botiga' ) .'</a>';
												echo '</td>';
											echo '</tr>';
										echo '</tfoot>';
									echo '</table>';
								echo '</li>';
							}
						}
					echo '</ul>';
					echo '<button class="botiga-add button button-primary">'. esc_html__( 'Add Size Chart', 'botiga' ) .'</button>';
				echo '</div>';

			break;

			case 'size-chart-select':

				$options = array();
				
			  $posts = get_posts( array(
					'post_type'   => 'size_chart',
			    'post_status' => 'publish',
			  ) );

			  if ( ! is_wp_error( $posts ) && ! empty( $posts ) ) {
			    foreach ( $posts as $_post ) {
			      $options[ $_post->ID ] = $_post->post_title;
			    }
			  }

				echo '<select name="'. esc_attr( $field_id ) .'">';
					echo '<option value="">'. esc_html__( 'Select a size chart', 'botiga' ) .'</option>';
					foreach ( $options as $key => $option ) {
						echo '<option value="'. esc_attr( $key ) .'"'. selected( $key, $value, false ) .'>'. esc_html( $option ) .'</option>';
					}
				echo '</select>';

			break;

			case 'sidebar-select':

				$options = array();
				
				global $wp_registered_sidebars;
				
				if ( ! empty( $wp_registered_sidebars ) ) {
					foreach ( $wp_registered_sidebars as $sidebar ) {
						$options[ $sidebar['id'] ] = $sidebar['name'];
					}
				}

				echo '<select name="'. esc_attr( $field_id ) .'">';
					echo '<option value="">'. esc_html__( 'Default', 'botiga' ) .'</option>';
					foreach ( $options as $key => $option ) {
						echo '<option value="'. esc_attr( $key ) .'"'. selected( $key, $value, false ) .'>'. esc_html( $option ) .'</option>';
					}
				echo '</select>';

			break;
			
			case 'wp-editor':

				$field = wp_parse_args( $field, array(
					'height' => 150,
				) );

				wp_editor( $value, $field_id, array(
					'editor_height' => $field['height'],
				) );

			break;

			case 'code-editor':
				echo '<textarea name="'. esc_attr( $field_id ) .'">'. esc_textarea( $value ) .'</textarea>';
			break;

		}

	}

}

new Botiga_Metabox();
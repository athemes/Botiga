<?php
/**
 * Select2 Control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Select2_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-select2-control';
	public $choices = '';
	public $select2_options = '';
	public $multiple = '';
	public $posttype = '';
	public $posttype_args = array();
	public $posttype_empty_first_value = '';

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue() {
		wp_enqueue_script( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
		wp_enqueue_style( 'botiga-select2', get_template_directory_uri() . '/vendor/select2/select2.min.css', array(), '4.0.13', 'all' );
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

		$choices 		 = $this->choices; 
		$select2_options = $this->select2_options; 
		$multiple        = $this->multiple; 
		$posttype        = $this->posttype; 

		if( $posttype ) {
			$defaults = array( 
				'post_type' => 'page',
				'posts_per_page' => -1 
			);
			$args = wp_parse_args( $this->posttype_args, $defaults );

			$choices = array();

			if( isset( $this->posttype_empty_first_value ) ) {
				$choices[''] = $this->posttype_empty_first_value;
			}

			$posts = get_posts( $args );
			foreach( $posts as $post ) {
				$choices[$post->ID] = $post->post_title;
			}
		}

		?>

		<div class="customize-control-title"><?php echo esc_html( $this->label ); ?></div>

		<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-botiga-select2" <?php $this->link(); ?> />

		<select class="botiga-select2" control-name="<?php echo esc_attr( $this->id ); ?>" data-select2-options='<?php echo esc_attr( $select2_options ); ?>'<?php echo ( $multiple ) ? ' multiple' : ''; ?>>
			<?php foreach( $choices as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>"<?php selected( $value, $this->value(), true ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>

		<?php if( $multiple && strpos( $this->value(), ',' ) !== FALSE ) : 
			$values = explode( ',', $this->value() ); 
			
			$values = array_map( function( $val ){
				return "'$val'";
			}, $values );
			
			?>
			<script type="text/javascript">
				(function( $ ){
					'use strict';

					const select2 = $( '.botiga-select2[control-name="<?php echo esc_js( $this->id ); ?>"]' );
					select2.select2().val( [ <?php echo implode( ', ', esc_js( $values ) ); ?> ] ).trigger( 'change.select2' );
				})(jQuery);
			</script>
			
		<?php endif; ?>

		<?php

	}
}

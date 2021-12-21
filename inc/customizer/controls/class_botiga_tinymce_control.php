<?php
/**
 * TinyMCE control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_TinyMCE_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-tinymce';
	
	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue(){
		wp_enqueue_editor();
	}
	/**
	 * Pass our TinyMCE toolbar string to JavaScript
	 */
	public function to_json() {
		parent::to_json();
		$this->json['botigatb1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link';
		$this->json['botigatb2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : 'formatselect outdent indent | blockquote charmap';
		$this->json['botigamb'] = isset( $this->input_attrs['mediaButtons'] ) && ( $this->input_attrs['mediaButtons'] === true ) ? true : false;
		$this->json['force_p_newlines '] = true;
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content(){
	?>
		<div class="tinymce-control">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if( !empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
			<textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_html( $this->value() ); ?></textarea>
		</div>
	<?php
	}
}

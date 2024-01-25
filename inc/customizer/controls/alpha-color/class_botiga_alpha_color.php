<?php
/**
 * Alpha color control
 *
 * @package Botiga
 */

class Botiga_Alpha_Color extends WP_Customize_Control {

	public $type = 'botiga-alpha-color';

	public $remove_bordertop = false;

	public function enqueue() {
		wp_enqueue_script( 'botiga-pickr', get_template_directory_uri() . '/assets/vendor/pickr/pickr.min.js', array( 'jquery' ), '1.8.2', true );
	}

	public function render_content() {
		?>
			<div class="botiga-color-control<?php echo ( $this->remove_bordertop ) ? ' border-top-none' : ''; ?>">
				<?php if ( $this->label ) { ?>
					<div class="botiga-color-title"><?php echo esc_html( $this->label ); ?></div>
				<?php } ?>
				<div class="botiga-color-picker" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" style="background-color: <?php echo esc_attr( $this->value() ); ?>;"></div>
				<input type="text" value="<?php echo esc_attr( $this->value() ); ?>" class="botiga-color-input" <?php $this->link(); ?> />
			</div>
		<?php 
	}
}

class Botiga_Alpha_Color_Border_Bottom extends Botiga_Alpha_Color {
	public $type = 'botiga-alpha-color botiga-alpha-color-border-bottom';
}
<?php
/**
 * Color group control
 *
 * @package Botiga
 */

class Botiga_Color_Group extends WP_Customize_Control {

	public $type = 'botiga-color-group-control';

	public function enqueue() {
		wp_enqueue_script( 'botiga-pickr', get_template_directory_uri() . '/vendor/pickr/pickr.min.js', array( 'jquery' ), '1.8.2', true );
	}

	public function render_content() {
		?>
			<div class="botiga-color-group">
				<?php if ( $this->label ) { ?>
					<div class="botiga-color-title"><?php echo esc_html( $this->label ); ?></div>
				<?php } ?>
				<div class="botiga-color-controls">
					<div class="botiga-color-control" data-control-id="<?php echo esc_attr( $this->id . '_default' ); ?>">
						<div class="botiga-color-tooltip"><?php echo esc_html__( 'Normal', 'botiga' ); ?></div>
						<div class="botiga-color-picker" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" style="background-color: <?php echo esc_attr( $this->value( 'default' ) ); ?>;"></div>
						<input type="text" name="<?php echo esc_attr( $this->id . '_default' ); ?>" value="<?php echo esc_attr( $this->value( 'default' ) ); ?>" class="botiga-color-input" <?php $this->link( 'default' ); ?> />
					</div>
					<div class="botiga-color-control" data-control-id="<?php echo esc_attr( $this->id . '_hover' ); ?>">
						<div class="botiga-color-tooltip"><?php echo esc_html__( 'Hover', 'botiga' ); ?></div>
						<div class="botiga-color-picker" data-default-color="<?php echo esc_attr( $this->settings['hover']->default ); ?>" style="background-color: <?php echo esc_attr( $this->value( 'hover' ) ); ?>;"></div>
						<input type="text" name="<?php echo esc_attr( $this->id . '_hover' ); ?>" value="<?php echo esc_attr( $this->value( 'hover' ) ); ?>" class="botiga-color-input" <?php $this->link( 'hover' ); ?> />
					</div>
				</div>
			</div>
		<?php 
	}

}
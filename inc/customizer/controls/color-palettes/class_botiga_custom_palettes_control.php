<?php
/**
 * Color palettes control
 *
 * @package Botiga
 */

class Botiga_Custom_Palettes_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-custom-palettes-control';

	/**
	 * Render the control in the customizer
	 */
	public function render_content(){
		?>
			<div class="custom-palettes-wrapper">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<div class="custom-palettes">
					<?php for ( $i = 1; $i < 9 ; $i++ ) { 
						$val = $this->value( 'custom_color' . $i ) ? $this->value( 'custom_color' . $i ) : $this->settings['custom_color' . $i]->default; ?>
						<div class="botiga-color-control">
							<div class="botiga-color-picker" data-default-color="<?php echo esc_attr( $this->settings['custom_color' . $i]->default ); ?>" style="background-color: <?php echo esc_attr( $this->value( 'custom_color' . $i ) ); ?>;"></div>
							<input type="text" value="<?php echo esc_attr( $this->value( 'custom_color' . $i ) ); ?>" class="botiga-color-input" <?php $this->link( 'custom_color' . $i ); ?> />
						</div>
					<?php } ?>
				</div>
			</div>
		<?php
	}
}
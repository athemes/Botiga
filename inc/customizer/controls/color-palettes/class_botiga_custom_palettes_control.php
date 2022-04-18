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

						<input data-color-val="<?php echo esc_attr( $this->value( 'custom_color' . $i ) ); ?>" value="<?php echo esc_attr( $this->value( 'custom_color' . $i ) ); ?>" class="alpha-color-control" type="text" data-show-opacity="true" data-palette="true" data-default-color="<?php echo esc_attr( $this->settings['custom_color' . $i]->default ); ?>" style="background-color: <?php echo esc_attr( $val ); ?>;" <?php $this->link( 'custom_color' . $i ); ?>  />

					<?php } ?>
				</div>
			</div>
		<?php
	}
}
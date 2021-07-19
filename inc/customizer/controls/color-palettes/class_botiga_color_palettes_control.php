<?php
/**
 * Color palettes control
 *
 * @package Botiga
 */

class Botiga_Color_Palettes_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-color-palettes-control';

	/**
	 * Render the control in the customizer
	 */
	public function render_content(){
		?>
			<div class="text_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<?php $saved_values = $this->choices[ $this->value() ]; ?>
				<div class="radio-button-label palette-label saved-palette">
					<span style="display: flex;">
					<?php foreach ( $saved_values as $value ) { ?>
						<div style="width:20%;height:25px;margin: 0 2px;background-color: <?php echo esc_attr( $value ); ?>"></div>
					<?php } ?>
					</span>	
				</div>	

				<div class="radio-buttons palette-radio-buttons" data-palettes='<?php echo json_encode( $this->choices ); ?>'>
					<?php foreach ( $this->choices as $key => $values ) { ?>						
						<label class="radio-button-label palette-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<span class="palette" style="display: flex;">
							<?php foreach ( $values as $value ) { ?>
								<div style="width:20%;height:25px;margin: 0 2px;background-color: <?php echo esc_attr( $value ); ?>"></div>
							<?php } ?>
							</span>	
						</label>
					<?php	} ?>
				</div>
			</div>
		<?php
	}
}
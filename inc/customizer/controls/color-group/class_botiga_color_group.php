<?php
/**
 * Color group control
 *
 * @package Botiga
 */

class Botiga_Color_Group extends WP_Customize_Control {

	public $type = 'botiga-color-group-control';

	public $remove_bordertop = false;

	public function enqueue() {
		wp_enqueue_script( 'botiga-pickr', get_template_directory_uri() . '/assets/vendor/pickr/pickr.min.js', array( 'jquery' ), '1.8.2', true );
	}

	public function render_content() {
		?>
			<div class="botiga-color-group<?php echo ( $this->remove_bordertop ) ? ' border-top-none' : ''; ?>">
				<?php if ( $this->label ) { ?>
					<div class="botiga-color-title"><?php echo esc_html( $this->label ); ?></div>
				<?php } ?>
				<div class="botiga-color-controls">
					<?php foreach ( array_keys( $this->settings ) as $key => $value ) : ?>
						<div class="botiga-color-control" data-control-id="<?php echo esc_attr( $this->settings[ $value ]->id ); ?>">
							<div class="botiga-color-tooltip">
								<?php
									if ( $key === 0 ) {
										esc_html_e( 'Normal', 'botiga' );
									} else {
										esc_html_e( 'Hover', 'botiga' );
									}
								?>
							</div>
							<div class="botiga-color-picker" data-default-color="<?php echo esc_attr( $this->settings[ $value ]->default ); ?>" style="background-color: <?php echo esc_attr( $this->value( $value ) ); ?>;"></div>
							<input type="text" name="<?php echo esc_attr( $this->settings[ $value ]->id ); ?>" value="<?php echo esc_attr( $this->value( $value ) ); ?>" class="botiga-color-input" <?php $this->link( $value ); ?> />
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php 
	}
}
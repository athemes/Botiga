<?php
/**
 * Radio buttons control
 *
 * @package Botiga
 */

class Botiga_Radio_Buttons extends WP_Customize_Control {

	public $type = 'botiga-radio-buttons';

	public $cols;

	public $desc_position = 'before-buttons';

	public $is_responsive;

	public function render_content() {

		$allowed_tags = array(
			'div' => array(
				'style' => array(),
			),
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'd'      => true,
			),
			'rect'    => array(
				'x'      => true,
				'y'      => true,
				'width'  => true,
				'height' => true,
				'transform' => true,
			),          
		);

		$responsive = '';
		if ( !$this->is_responsive ) {
			$responsive = 'noresponsive';
		}
		?>
		<div class="botiga-control-wrapper">
			<div class="text_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) && $this->desc_position === 'before-buttons' ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<?php if ( $this->is_responsive ) : ?>
					<ul class="botiga-devices-preview">
						<?php if( isset( $this->settings[ 'desktop' ] ) ) : ?>
						<li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
						<?php endif; ?>
						<?php if( isset( $this->settings[ 'tablet' ] ) ) : ?>
						<li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
						<?php endif; ?>
						<?php if( isset( $this->settings[ 'mobile' ] ) ) : ?>
						<li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>

				<div class="radio-buttons responsive-control-desktop active <?php echo esc_attr( $responsive ); ?>">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); echo $this->is_responsive ? '_desktop' : ''; ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->is_responsive ? $this->link( 'desktop' ) : $this->link(); ?> <?php checked( esc_attr( $key ), $this->is_responsive ? $this->value( 'desktop' ) : $this->value() ); ?>/>
							<span><?php echo wp_kses( $value, $allowed_tags ); ?></span>
						</label>
					<?php	} ?>
				</div>
				<?php if ( $this->is_responsive ) : ?>
					<?php if( isset( $this->settings[ 'tablet' ] ) ) : ?>
						<div class="radio-buttons responsive-control-tablet<?php echo ( ! isset( $this->settings[ 'mobile' ] ) ? ' show-mobile' : '' ); ?>">
						<?php foreach ( $this->choices as $key => $value ) { ?>
							<label class="radio-button-label">
								<input type="radio" name="<?php echo esc_attr( $this->id . '_tablet' ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link( 'tablet' ); ?> <?php checked( esc_attr( $key ), $this->value( 'tablet' ) ); ?>/>
								<span><?php echo wp_kses( $value, $allowed_tags ); ?></span>
							</label>
						<?php	} ?>
						</div>
					<?php endif; ?>
					<?php if( isset( $this->settings[ 'mobile' ] ) ) : ?>
						<div class="radio-buttons responsive-control-mobile">
						<?php foreach ( $this->choices as $key => $value ) { ?>
							<label class="radio-button-label">
								<input type="radio" name="<?php echo esc_attr( $this->id . '_mobile' ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link( 'mobile' ); ?> <?php checked( esc_attr( $key ), $this->value( 'mobile' ) ); ?>/>
								<span><?php echo wp_kses( $value, $allowed_tags ); ?></span>
							</label>
						<?php	} ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php if( !empty( $this->description ) && $this->desc_position === 'after-buttons' ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
<?php
class Botiga_Responsive_Slider extends WP_Customize_Control {
	
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-responsive-slider';

	public $is_responsive;

	public $title_font_size = 'small';

	public $title_weight = 'bold';

	public $title_text_transform = 'uppercase';

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

		if( isset( $this->title_font_size ) ) {
			$title_font_size = $this->title_font_size;
		}
		
		if( isset( $this->title_weight ) ) {
			$title_weight = $this->title_weight;
		}

		if( isset( $this->title_text_transform ) ) {
			$title_text_transform = $this->title_text_transform;
		}

		if ( isset( $this->input_attrs['step'] ) ) {
			$step = $this->input_attrs['step'];
		} else {
			$step = 1;
		}

		if ( isset( $this->input_attrs['unit'] ) ) {
			$unit = $this->input_attrs['unit'];
		} else {
			$unit = 'px';
		}

		$responsive = '';
		if ( !$this->is_responsive ) {
			$responsive = 'noresponsive';
		}

		?>
		<div class="botiga-control-wrapper">
			<div class="range-slider-wrapper responsive-control-range">
				<div class="device-heading">				
					<div class="customize-control-title customize-control-title-font-size-<?php echo esc_attr( $title_font_size ); ?> customize-control-title-weight-<?php echo esc_attr( $title_weight ); ?> customize-control-title-text-transform-<?php echo esc_attr( $title_text_transform ); ?>"><?php echo esc_html( $this->label ); ?></div>
					<?php if ( $this->is_responsive ) : ?>
					<ul class="botiga-devices-preview">
						<li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
						<li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
						<li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
					</ul>
					<?php endif; ?>
				</div>				
				<div class="range-slider responsive-control-desktop active <?php echo esc_attr( $responsive ); ?>">
					<input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value( 'size_desktop' ) ); ?>" <?php $this->link( 'size_desktop' ); ?> min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<input class="range-slider__value" type="number" value="<?php echo esc_attr( $this->value( 'size_desktop' ) ); ?>" <?php $this->link( 'size_desktop' ); ?> min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<span class="range-slider__unit"><?php echo esc_html( $unit ); ?></span>
				</div>
				<?php if ( $this->is_responsive ) : ?>
				<div class="range-slider responsive-control-tablet">
					<input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value( 'size_tablet' ) ); ?>" <?php $this->link( 'size_tablet' ); ?> min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<input class="range-slider__value" type="number" value="<?php echo esc_attr( $this->value( 'size_tablet' ) ); ?>" <?php $this->link( 'size_tablet' ); ?> min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<span class="range-slider__unit"><?php echo esc_html( $unit ); ?></span>
				</div>
				<div class="range-slider responsive-control-mobile">
					<input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value( 'size_mobile' ) ); ?>" <?php $this->link( 'size_mobile' ); ?> min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<input class="range-slider__value" type="number" value="<?php echo esc_attr( $this->value( 'size_mobile' ) ); ?>" <?php $this->link( 'size_mobile' ); ?> min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo absint( $this->input_attrs['max'] ); ?>" step="<?php echo esc_attr( $step ); ?>">
					<span class="range-slider__unit"><?php echo esc_html( $unit ); ?></span>
				</div>		
				<?php endif; ?>	
				<?php if ( $this->description ) : ?>
					<p class="customize-control-description"><?php echo esc_html( $this->description ); ?></p>
				<?php endif; ?>									
			</div>
		</div>
		<?php
	}
}
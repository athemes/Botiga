<?php
/**
 * Radio images control
 *
 * @package Botiga
 */

class Botiga_Radio_Images extends WP_Customize_Control {

	public $type = 'botiga-radio-image';

	public $desc_below = false;

	public $class = '';

	public $cols = 4;

	public $is_responsive;

	public function render_content() {

		$responsive = $this->is_responsive ? '' : 'noresponsive';
		$desktop = $this->is_responsive ? '_desktop' : '';

		if ( empty( $this->choices ) )
			return; ?>

		<?php if ( !empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( !empty( $this->description ) && !$this->desc_below ) : ?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>

		<div class="botiga-control-wrapper">
			<?php if ( $this->is_responsive ) : ?>
				<ul class="botiga-devices-preview alt-position">
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

			<div id="<?php echo esc_attr( "input_{$this->id}{$desktop}" ); ?>" class="botiga-radio-images-wrapper responsive-control-desktop active botiga-radio-images-col-<?php echo esc_attr( $this->cols ); ?> <?php echo esc_attr( $this->class ); ?> <?php echo esc_attr( $responsive ); ?>">
				<?php foreach ( $this->choices as $value => $args ) : ?>

					<label for="<?php echo esc_attr( "{$this->id}{$desktop}-{$value}" ); ?>"<?php echo ( isset( $args[ 'is_pro' ] ) && $args[ 'is_pro' ] ) ? ' class="is-pro"' : ''; ?>>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}{$desktop}" ); ?>" id="<?php echo esc_attr( "{$this->id}{$desktop}-{$value}" ); ?>" <?php $this->is_responsive ? $this->link( 'desktop' ) : $this->link(); ?> <?php checked( $this->is_responsive ? $this->value( 'desktop' ) : $this->value(), $value ); ?> /> 
						<span class="screen-reader-text"><?php echo esc_html( $args['label'] ); ?></span>
						<figure><img src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" title="<?php echo esc_attr( $args['label'] ); ?>" alt="<?php echo esc_attr( $args['label'] ); ?>" /></figure>
						<span class="label-tooltip"><?php echo esc_html( $args['label'] ); ?></span>
					</label>

				<?php endforeach; ?>

			</div><!-- .image -->

			<script type="text/javascript">
				jQuery( document ).ready( function() {
					jQuery( '#<?php echo esc_attr( "input_{$this->id}{$desktop}" ); ?>' ).buttonset();
					jQuery( '#<?php echo esc_attr( "input_{$this->id}{$desktop}" ); ?>' ).find( 'label' ).removeClass( 'ui-button' );
				} );
			</script>

			<?php if ( $this->is_responsive ) : ?>
				<?php if( isset( $this->settings[ 'tablet' ] ) ) : ?>

					<div id="<?php echo esc_attr( "input_{$this->id}_tablet" ); ?>" class="botiga-radio-images-wrapper responsive-control-tablet<?php echo ( ! isset( $this->settings[ 'mobile' ] ) ? ' show-mobile' : '' ); ?>">
						<?php foreach ( $this->choices as $value => $args ) : ?>

							<label for="<?php echo esc_attr( "{$this->id}_tablet-{$value}" ); ?>">
								<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}_tablet" ); ?>" id="<?php echo esc_attr( "{$this->id}_tablet-{$value}" ); ?>" <?php $this->link( 'tablet' ); ?> <?php checked( $this->value( 'tablet' ), $value ); ?> /> 
								<span class="screen-reader-text"><?php echo esc_html( $args['label'] ); ?></span>
								<figure><img src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" title="<?php echo esc_attr( $args['label'] ); ?>" alt="<?php echo esc_attr( $args['label'] ); ?>" /></ class="img-cont">
								<span class="label-tooltip"><?php echo esc_html( $args['label'] ); ?></span>
							</label>

						<?php endforeach; ?>
					</div><!-- .image -->

					<script type="text/javascript">
						jQuery( document ).ready( function() {
							jQuery( '#<?php echo esc_attr( "input_{$this->id}_tablet" ); ?>' ).buttonset();
							jQuery( '#<?php echo esc_attr( "input_{$this->id}_tablet" ); ?>' ).find( 'label' ).removeClass( 'ui-button' );
						} );
					</script>

				<?php endif; ?>
				<?php if( isset( $this->settings[ 'mobile' ] ) ) : ?>

					<div id="<?php echo esc_attr( "input_{$this->id}_mobile" ); ?>" class="botiga-radio-images-wrapper responsive-control-mobile">
						<?php foreach ( $this->choices as $value => $args ) : ?>

							<label for="<?php echo esc_attr( "{$this->id}_mobile-{$value}" ); ?>">
								<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}_mobile" ); ?>" id="<?php echo esc_attr( "{$this->id}_mobile-{$value}" ); ?>" <?php $this->link( 'mobile' ); ?> <?php checked( $this->value( 'mobile' ), $value ); ?> /> 
								<span class="screen-reader-text"><?php echo esc_html( $args['label'] ); ?></span>
								<figure><img src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" title="<?php echo esc_attr( $args['label'] ); ?>" alt="<?php echo esc_attr( $args['label'] ); ?>" /></figure>
								<span class="label-tooltip"><?php echo esc_html( $args['label'] ); ?></span>
							</label>

						<?php endforeach; ?>
					</div><!-- .image -->

					<script type="text/javascript">
						jQuery( document ).ready( function() {
							jQuery( '#<?php echo esc_attr( "input_{$this->id}_mobile" ); ?>' ).buttonset();
							jQuery( '#<?php echo esc_attr( "input_{$this->id}_mobile" ); ?>' ).find( 'label' ).removeClass( 'ui-button' );
						} );
					</script>

				<?php endif; ?>
			<?php endif; ?>

			<?php if ( !empty( $this->description ) && $this->desc_below ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</div>

	<?php }

	/**
	 * Loads the jQuery UI Button script and hooks our custom styles in.
	 *
	 * @since  3.0.0
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );
	}

	/**
	 * Outputs custom styles to give the selected image a visible border.
	 */
	public function print_styles() { ?>

		<style type="text/css" id="hybrid-customize-botiga-radio-image-css">
			.customize-control-botiga-radio-image .botiga-radio-images-wrapper.ui-helper-clearfix:before,
			.customize-control-botiga-radio-image .botiga-radio-images-wrapper.ui-helper-clearfix:after { content: none !important; }
			.customize-control-botiga-radio-image img { border: 1px solid transparent;border-radius:3px;width:100%;display:block;transition: opacity 0.2s;}
			.customize-control-botiga-radio-image .img-cont {margin:5px;}
			<?php if ( $this->cols === 3 ) : ?>
				.customize-control-botiga-radio-image #<?php echo esc_attr( "input_{$this->id}" ); ?> label { float:left; width: 33.3333%;}
			<?php elseif ( $this->cols === 2 ) : ?>
				.customize-control-botiga-radio-image #<?php echo esc_attr( "input_{$this->id}" ); ?> label { float:left; width: 50%;}
			<?php else : ?>
				.customize-control-botiga-radio-image #<?php echo esc_attr( "input_{$this->id}" ); ?> label { float:left; width: 25%;}
			<?php endif; ?>
			.customize-control-botiga-radio-image img:hover { opacity:1; }
			.customize-control-botiga-radio-image .ui-icon { display: none; }
			.customize-control-botiga-radio-image .ui-state-active { border: none; background: transparent; }
			.customize-control-botiga-radio-image .ui-state-active img { border-color: #317CB5;opacity:1; }
			.customize-control-botiga-radio-image .ui-state-active .img-cont {position:relative;}
			.customize-control-botiga-radio-image .ui-state-active .img-cont:after { content:'';background:rgba(49, 124, 181, 0.1);top:0;left:0;position:absolute;width:100%;height:100%; }
		</style>
	<?php }
}
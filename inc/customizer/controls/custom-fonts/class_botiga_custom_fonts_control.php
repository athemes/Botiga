<?php
/**
 * Custom fonts control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Custom_Fonts_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-custom-fonts-control';

	public $title = '';

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

			$values = ( ! empty( $this->value() ) ) ? json_decode( $this->value(), true ) : array();
			$values = ( ! empty( $values ) ) ? $values : array( array() );

		?>
		<div class="botiga-custom-fonts-control">

			<?php if( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			<?php } ?>

			<?php if( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php } ?>

			<div class="botiga-custom-font-items">
				<div class="botiga-custom-font-item hidden">
					<a href="#" class="botiga-custom-font-remove"><i class="dashicons dashicons-trash"></i></a>
					<div class="botiga-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font Name', 'botiga' ); ?></label>
						<div class="botiga-custom-font-item-inner">
							<input type="text" name="name" class="botiga-custom-font-item-input" />
						</div>
					</div>
					<div class="botiga-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .woff2', 'botiga' ); ?></label>
						<div class="botiga-custom-font-item-inner">
							<input type="text" name="woff2" class="botiga-custom-font-item-input" />
							<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/woff2"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
						</div>
					</div>
					<div class="botiga-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .woff', 'botiga' ); ?></label>
						<div class="botiga-custom-font-item-inner">
							<input type="text" name="woff" class="botiga-custom-font-item-input" />
							<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/woff"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
						</div>
					</div>
					<div class="botiga-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .ttf', 'botiga' ); ?></label>
						<div class="botiga-custom-font-item-inner">
							<input type="text" name="ttf" class="botiga-custom-font-item-input" />
							<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/ttf"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
						</div>
					</div>
					<div class="botiga-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .eot', 'botiga' ); ?></label>
						<div class="botiga-custom-font-item-inner">
							<input type="text" name="eot" class="botiga-custom-font-item-input" />
							<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/eot"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
						</div>
					</div>
					<div class="botiga-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .otf', 'botiga' ); ?></label>
						<div class="botiga-custom-font-item-inner">
							<input type="text" name="otf" class="botiga-custom-font-item-input" />
							<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/otf"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
						</div>
					</div>
					<div class="botiga-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .svg', 'botiga' ); ?></label>
						<div class="botiga-custom-font-item-inner">
							<input type="text" name="svg" class="botiga-custom-font-item-input" />
							<a href="#" class="button button-primary botiga-custom-font-upload" data-type="image/svg+xml"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
						</div>
					</div>
				</div>
				<?php if ( ! empty( $values ) ) : ?>
					<?php foreach ( $values as $value ) : ?>
						<div class="botiga-custom-font-item">
							<a href="#" class="botiga-custom-font-remove"><i class="dashicons dashicons-trash"></i></a>
							<div class="botiga-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font Name', 'botiga' ); ?></label>
								<div class="botiga-custom-font-item-inner">
									<?php $name = ( ! empty( $value['name'] ) ) ? $value['name'] : ''; ?>
									<input type="text" name="name" class="botiga-custom-font-item-input" value="<?php echo esc_attr( $name ); ?>" />
								</div>
							</div>
							<div class="botiga-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .woff2', 'botiga' ); ?></label>
								<div class="botiga-custom-font-item-inner">
									<?php $woff2 = ( ! empty( $value['woff2'] ) ) ? $value['woff2'] : ''; ?>
									<input type="text" name="woff2" class="botiga-custom-font-item-input" value="<?php echo esc_url( $woff2 ); ?>" />
									<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/woff2"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
								</div>
							</div>
							<div class="botiga-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .woff', 'botiga' ); ?></label>
								<div class="botiga-custom-font-item-inner">
									<?php $woff = ( ! empty( $value['woff'] ) ) ? $value['woff'] : ''; ?>
									<input type="text" name="woff" class="botiga-custom-font-item-input" value="<?php echo esc_url( $woff ); ?>" />
									<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/woff"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
								</div>
							</div>
							<div class="botiga-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .ttf', 'botiga' ); ?></label>
								<div class="botiga-custom-font-item-inner">
									<?php $ttf = ( ! empty( $value['ttf'] ) ) ? $value['ttf'] : ''; ?>
									<input type="text" name="ttf" class="botiga-custom-font-item-input" value="<?php echo esc_url( $ttf ); ?>" />
									<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/ttf"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
								</div>
							</div>
							<div class="botiga-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .eot', 'botiga' ); ?></label>
								<div class="botiga-custom-font-item-inner">
									<?php $eot = ( ! empty( $value['eot'] ) ) ? $value['eot'] : ''; ?>
									<input type="text" name="eot" class="botiga-custom-font-item-input" value="<?php echo esc_url( $eot ); ?>" />
									<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/eot"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
								</div>
							</div>
							<div class="botiga-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .otf', 'botiga' ); ?></label>
								<div class="botiga-custom-font-item-inner">
									<?php $otf = ( ! empty( $value['otf'] ) ) ? $value['otf'] : ''; ?>
									<input type="text" name="otf" class="botiga-custom-font-item-input" value="<?php echo esc_url( $otf ); ?>" />
									<a href="#" class="button button-primary botiga-custom-font-upload" data-type="font/otf"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
								</div>
							</div>
							<div class="botiga-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .svg', 'botiga' ); ?></label>
								<div class="botiga-custom-font-item-inner">
									<?php $svg = ( ! empty( $value['svg'] ) ) ? $value['svg'] : ''; ?>
									<input type="text" name="svg" class="botiga-custom-font-item-input" value="<?php echo esc_url( $svg ); ?>" />
									<a href="#" class="button button-primary botiga-custom-font-upload" data-type="image/svg+xml"><?php esc_html_e( 'Upload', 'botiga' ); ?></a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="botiga-custom-font-footer">
				<a href="#" class="button botiga-custom-font-add"><?php esc_html_e( 'Add New Font', 'botiga' ); ?></a>
			</div>

			<textarea id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="botiga-custom-font-textarea hidden" <?php $this->link(); ?>><?php echo wp_kses( $this->value(), array() ); ?></textarea>

		</div>
		<?php
	}
}

<?php
/**
 * Text control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Text_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-text-control';

	public $link_title = '';

	public $link = '';

	public $controls_general;

	public $controls_design;

	public $rm_desc_mt = false;

	public $check_white_label = false;

	public $white_label_desc = '';

	
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
		if( $this->check_white_label && defined( 'BOTIGA_AWL_ACTIVE' ) ) {
			if( $this->white_label_desc ) {
				$this->description = $this->white_label_desc;
				$this->link_title  = '';
				$this->link        = '';
			} else {
				return '';
			}
		} ?>

		<?php if( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
		<?php endif; ?>
		<?php if( ! empty( $this->description ) ) : ?>
			<span class="customize-control-description<?php echo ( $this->rm_desc_mt ? ' bt-mt-0' : '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"><?php echo $this->description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<?php else : ?>
			<span class="customize-control-description-empty" style="display: block; margin-top: -8px;"></span>
		<?php endif; ?>
		<?php if( ! empty( $this->link_title ) && !empty( $this->link ) ) : ?>
			<a href="<?php echo esc_url( $this->link ); ?>" target="_blank"><?php echo $this->link_title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		<?php endif; ?>
	<?php
	}
}

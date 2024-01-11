<?php
/**
 * Botiga Customizer Panel Upsell
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Panel_Upsell extends WP_Customize_Panel {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-panel-upsell';

    /**
	 * An Underscore (JS) template for rendering this section.
	 *
	 * Class variables for this section class are available in the `data` JS object;
	 * export custom variables by overriding WP_Customize_Section::json().
	 *
	 * @since 4.3.0
	 *
	 * @see WP_Customize_Section::print_template()
	 */
	protected function render_template() {
		?>
        <li id="accordion-panel-{{ data.id }}" class="accordion-section control-section control-panel control-panel-{{ data.type }}">
			<h3 class="accordion-section-title" tabindex="0">
				{{ data.title }}
				<span class="screen-reader-text"><?php echo esc_html__( 'Press return or enter to open this panel', 'botiga' ); ?></span>
                <span class="botiga-pro-badge"><?php echo esc_html__( 'PRO', 'botiga' ); ?></span>
				<span class="botiga-pro-lock-icon">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pro-lock.svg" loading="lazy" alt="<?php echo esc_attr__( 'Botiga Pro', 'botiga' ); ?>" />
				</span>
			</h3>
			<ul class="accordion-sub-container control-panel-content"></ul>
		</li>
		<?php
	}
}

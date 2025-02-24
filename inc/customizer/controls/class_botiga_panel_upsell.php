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
	 * Feature slug.
	 * The slug of the feature.
	 * 
	 * @var string
	 */
	public $feature_slug = '';

	public function __construct( $wp_customize, $id, $args = array(), $options = array() ) {
		parent::__construct( $wp_customize, $id, $args );

        $this->feature_slug = isset( $args['feature_slug'] ) ? esc_attr( $args['feature_slug'] ) : '';
	}

	public function json() {
		$array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden' ) );
		$array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
		$array['feature_slug'] = $this->feature_slug;
		$array['content'] = $this->get_content();
		$array['active'] = $this->active();
		$array['instanceNumber'] = $this->instance_number;

		return $array;
	}

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
        <li id="accordion-panel-{{ data.id }}" class="accordion-section control-section control-panel control-panel-{{ data.type }}" data-feature="{{ data.feature_slug }}">
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

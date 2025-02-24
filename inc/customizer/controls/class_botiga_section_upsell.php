<?php
/**
 * Botiga Customizer Section Upsell
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Section_Upsell extends WP_Customize_Section {
		
	/**
	 * Type.
	 * The type of control being rendered.
	 * 
	 * @var string
	 */
	public $type = 'botiga-section-upsell';

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
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}" data-feature="{{ data.feature_slug }}">
			<h3 class="accordion-section-title" tabindex="0">
				{{ data.title }}
				<span class="screen-reader-text"><?php echo esc_html__( 'Press return or enter to open this section', 'botiga' ); ?></span>
                <span class="botiga-pro-badge"><?php echo esc_html__( 'PRO', 'botiga' ); ?></span>
				<span class="botiga-pro-lock-icon">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pro-lock.svg" loading="lazy" alt="<?php echo esc_attr__( 'Botiga Pro', 'botiga' ); ?>" />
				</span>
			</h3>
			<ul class="accordion-section-content">
				<li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
					<div class="customize-section-title">
						<button class="customize-section-back" tabindex="-1">
							<span class="screen-reader-text"><?php echo esc_html__( 'Back', 'botiga' ); ?></span>
						</button>
						<h3>
							<span class="customize-action">
								{{{ data.customizeAction }}}
							</span>
							{{ data.title }}
						</h3>
						<# if ( data.description && data.description_hidden ) { #>
							<button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"><span class="screen-reader-text"><?php echo esc_html__( 'Help', 'botiga' ); ?></span></button>
							<div class="description customize-section-description">
								{{{ data.description }}}
							</div>
						<# } #>

						<div class="customize-control-notifications-container"></div>
					</div>

					<# if ( data.description && ! data.description_hidden ) { #>
						<div class="description customize-section-description">
							{{{ data.description }}}
						</div>
					<# } #>
				</li>
			</ul>
		</li>
		<?php
	}
}

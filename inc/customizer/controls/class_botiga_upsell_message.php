<?php
/**
 * Create page control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Upsell_Message extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type          = 'botiga-upsell-features';
	public $title         = '';
	public $sub_title     = '';
	public $display_thumb = false;
	public $features_list = array();
	public $features_list_last_item_text = array();
	public $button_text   = '';
	public $button_link   = 'https://athemes.com/botiga-upgrade?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga';
	public $all_features_link = 'https://athemes.com/theme/botiga/?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga#see-all-features';

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );

		$this->button_text = esc_html__( 'Upgrade to Botiga Pro', 'botiga' );

		if ( empty( $this->sub_title ) ) {
			$this->sub_title = esc_html__( 'You\'ll unlock:', 'botiga' );
		}

		if ( empty( $this->features_list_last_item_text ) ) {
			$this->features_list_last_item_text = array(
				'text_before_link' => '...',
				'link_text'        => esc_html__( 'and many other premium features', 'botiga' ),
			);
		}
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
		if( defined( 'BOTIGA_AWL_ACTIVE' ) ) {
			return '';
		}
		?>
		<div class="botiga-upsell-feature-wrapper">
			<?php if( $this->display_thumb ) : ?>
				<div class="botiga-upsell-feature-thumb">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/admin/customizer-upsell-thumbnail.png' ); ?>" alt="<?php esc_attr_e( 'Botiga Pro', 'botiga' ); ?>" />
				</div>
			<?php endif; ?>
			<?php if( ! empty( $this->title ) ) : ?>
				<strong><?php echo esc_html( $this->title ); ?></strong>
			<?php endif; ?>
			<?php if( ! empty( $this->sub_title ) ) : ?>
				<p class="botiga-upsell-features-list-title"><?php echo esc_html( $this->sub_title ); ?></p>
			<?php endif; ?>
			<?php if( ! empty( $this->features_list ) ) : ?>
				<ul class="botiga-upsell-features-list">
					<?php foreach( $this->features_list as $feature ) : ?>
						<li>
							<svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.5 13.5C10.0899 13.5 13 10.5899 13 7C13 3.41015 10.0899 0.5 6.5 0.5C2.91015 0.5 0 3.41015 0 7C0 10.5899 2.91015 13.5 6.5 13.5ZM9.04966 4.45032C9.2612 4.66185 9.2612 5.00482 9.04966 5.21635L7.26606 7L9.04966 8.78367C9.2612 8.99521 9.2612 9.33812 9.04966 9.54966C8.83812 9.7612 8.49521 9.7612 8.28367 9.54966L6.5 7.76606L4.71635 9.54966C4.50482 9.7612 4.16185 9.7612 3.95032 9.54966C3.73879 9.33812 3.73879 8.99521 3.95032 8.78367L5.73394 7L3.95032 5.21635C3.73879 5.00482 3.73879 4.66185 3.95032 4.45032C4.16185 4.23879 4.50482 4.23879 4.71635 4.45032L6.5 6.23394L8.28367 4.45032C8.49521 4.23879 8.83812 4.23879 9.04966 4.45032Z" fill="#3858E9"/>
								<rect x="2.16602" y="2.66602" width="7.22222" height="7.94444" fill="#3858E9"/>
								<path d="M8.95783 4.71165L8.84116 4.62887L8.75294 4.74148L6.11936 8.10318L4.81026 7.1649L4.6941 7.08165L4.60533 7.19363L4.21644 7.6842L4.11851 7.80773L4.24676 7.89941L6.1912 9.28935L6.3079 9.37277L6.39644 9.25991L9.50755 5.2945L9.60471 5.17066L9.47634 5.07958L8.95783 4.71165Z" fill="white" stroke="white" stroke-width="0.3"/>
							</svg>
							<?php echo esc_html( $feature ); ?>
						</li>
					<?php endforeach; ?>

					<li>
						<svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6.5 13.5C10.0899 13.5 13 10.5899 13 7C13 3.41015 10.0899 0.5 6.5 0.5C2.91015 0.5 0 3.41015 0 7C0 10.5899 2.91015 13.5 6.5 13.5ZM9.04966 4.45032C9.2612 4.66185 9.2612 5.00482 9.04966 5.21635L7.26606 7L9.04966 8.78367C9.2612 8.99521 9.2612 9.33812 9.04966 9.54966C8.83812 9.7612 8.49521 9.7612 8.28367 9.54966L6.5 7.76606L4.71635 9.54966C4.50482 9.7612 4.16185 9.7612 3.95032 9.54966C3.73879 9.33812 3.73879 8.99521 3.95032 8.78367L5.73394 7L3.95032 5.21635C3.73879 5.00482 3.73879 4.66185 3.95032 4.45032C4.16185 4.23879 4.50482 4.23879 4.71635 4.45032L6.5 6.23394L8.28367 4.45032C8.49521 4.23879 8.83812 4.23879 9.04966 4.45032Z" fill="#3858E9"/>
							<rect x="2.16602" y="2.66602" width="7.22222" height="7.94444" fill="#3858E9"/>
							<path d="M8.95783 4.71165L8.84116 4.62887L8.75294 4.74148L6.11936 8.10318L4.81026 7.1649L4.6941 7.08165L4.60533 7.19363L4.21644 7.6842L4.11851 7.80773L4.24676 7.89941L6.1912 9.28935L6.3079 9.37277L6.39644 9.25991L9.50755 5.2945L9.60471 5.17066L9.47634 5.07958L8.95783 4.71165Z" fill="white" stroke="white" stroke-width="0.3"/>
						</svg>
						<?php 
						/* translators: %1$s: link to Botiga Pro, %2$s: link text */
						printf(
							'%1$s <a href="%2$s" target="_blank">%3$s</a>',
							$this->features_list_last_item_text[ 'text_before_link' ], // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$this->all_features_link, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$this->features_list_last_item_text[ 'link_text' ] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						);
						?>
					</li>
				</ul>
			<?php endif; ?>
			<a href="<?php echo esc_url( $this->button_link ); ?>" role="button" class="botiga-upsell-button" target="_blank">
				<?php echo esc_html( $this->button_text ); ?>
			</a>
		</div>
	<?php
	}
}

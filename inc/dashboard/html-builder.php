<?php

/**
 * Templates Builder (builder page)
 * 
 * @package Botiga
 */

if ( ! defined('ABSPATH') ) {
	exit; // Exit if accessed directly.
}

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$existing_parts = $this->get_template_parts();

$parts = array( 
	'content' => __( 'Content', 'botiga' )
);

//disabled links in free
$disabled = ! $this->settings['has_pro'] || $this->settings['has_pro'] && ( class_exists( 'Botiga_Modules' ) && ! Botiga_Modules::is_module_active( 'templates' ) ) ? 'style="pointer-events:none;"' : '';

?>
<div class="botiga-dashboard-row">
	<div class="botiga-dashboard-column">
		<div class="botiga-dashboard-card botiga-dashboard-card-top-spacing botiga-dashboard-card-tabs-divider">

		<div class="template-builder-wrapper">
			<?php if ( ! $this->settings['has_pro'] ) : ?>
				<div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
					<div class="alert-icon"><?php echo botiga_get_svg_icon( 'icon-warning' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<p class="bt-text-color-grey"><?php echo esc_html__( 'Please note this feature is available only in Botiga Pro', 'botiga' ); ?></p>
					<a href="<?php echo esc_url( $this->settings['upgrade_pro'] ); ?>" class="botiga-dashboard-external-link" target="_blank">
						<?php echo esc_html__( 'Upgrade Now', 'botiga' ); ?>
						<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#3858E9"/>
						</svg>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( $this->settings['has_pro'] && ( class_exists( 'Botiga_Modules' ) && ! Botiga_Modules::is_module_active( 'templates' ) ) ) : ?>
				<div class="botiga-dashboard-alert botiga-dashboard-alert-warning botiga-dashboard-alert-with-icon botiga-dashboard-alert-with-upsell-link">
					<div class="alert-icon"><?php echo botiga_get_svg_icon( 'icon-warning' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<p class="bt-text-color-grey"><?php echo esc_html__( 'Please note that to use this feature you need to activate the Templates Builder module.', 'botiga' ); ?></p>
					<a href="#" class="botiga-dashboard-link botiga-dashboard-link-success botiga-dashboard-module-activation botiga-dashboard-external-link" data-module-id="templates" data-module-activate="true" data-module-after-activation-redirect="<?php echo esc_url( get_admin_url() . 'admin.php?page=botiga-dashboard&tab=builder' ); ?>">
						<?php echo esc_html__( 'Activate Templates Builder', 'botiga' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<ol>
				<li class="bt-text-color-grey"><?php esc_html_e( 'Replace theme-built pages like shop archive, single product, search page, 404, order thank you, etc. with your custom layout.', 'botiga' ); ?></li>
				<li class="bt-text-color-grey"><?php esc_html_e( 'You can create multiple templates and assign them to specific pages.', 'botiga' ); ?></li>
			</ol>
			<hr>
			<!-- <p class="tutorial-video bt-text-color-grey"><span class="dashicons dashicons-editor-help"></span> <?php esc_html_e( 'Need help?', 'botiga' ); ?> <a class="botiga-dashboard-external-link" target="_blank" href="https://youtu.be/MhKdxFeFOd8"><?php esc_html_e( 'Watch a quick tutorial video.', 'botiga' ); ?></a></p> -->
			<div id="template-builder" style="<?php echo $this->settings['has_pro'] && ( class_exists( 'Botiga_Modules' ) && ! Botiga_Modules::is_module_active( 'templates' ) ) ? 'pointer-events: none; opacity: 0.6;' : ''; ?>">
				<?php 
				$templates = array();
				$custom_templates = get_option( 'botiga_template_builder_data' );

				if ( !is_array( $custom_templates ) && empty( $custom_templates ) ) {
					$templates['global'] = array(
						'id' 			=> 'global',
						'template_name' => 'Global',
						'conditions' 	=> '',
						'header' 		=> '',
						'page_title' 	=> '',
						'content' 		=> '',
						'footer' 		=> '',
					);
				} else {
					$templates = $custom_templates;
				}

				if ( !empty( $templates ) ) : ?>
					<?php foreach ( $templates as $key => $template ) : ?>

						<?php            
						$conditions = ( isset( $template['conditions'] ) ) ? json_decode($template['conditions'], true ) : array();

						$labels = array();

						if ( ! empty( $conditions ) ) {
							foreach ( $conditions as $value ) {
								if ( ! empty( $value['id'] ) ) {
									$labels[ $value['id'] ] = botiga_get_display_condition_value_text( $value );
								}
							}
						}

						$settings = array(
							'values' => $conditions,
							'labels' => $labels,
						);
						?>
						<div class="template-item" data-id="<?php echo esc_attr( $template['id'] ); ?>">

							<div class="template-name">
								
								<?php if ( 'global' !== $template['id'] ) : ?>
								<input type="text" name="template_name" value="<?php echo isset( $template['template_name'] ) ? esc_attr( $template['template_name'] ) : ''; ?>" placeholder="<?php esc_attr_e( 'Template Name', 'botiga' ); ?>">
								<?php else : ?>
								<h4 style="margin-top:12px;margin-bottom:0;"><?php echo esc_html__('Global Template', 'botiga'); ?></h4>
								<?php endif; ?>

								<div class="template-options" style="display: <?php echo ( isset( $template['id'] ) && 'global' == $template['id'] ) ? 'none' : 'block'; ?>">
									<div class="botiga-display-conditions-control" data-condition-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>">
										<a href="#" title="<?php esc_attr_e( 'Display conditions', 'botiga' ); ?>" class="botiga-display-conditions-modal-toggle"><span class="dashicons dashicons-admin-generic"></span><span style="min-width:120px;margin-left:-60px;" class="tooltip"><?php esc_html_e( 'Display conditions', 'botiga' ); ?></span></a>
										<div class="botiga-display-conditions-modal">
										<!-- Modal content goes here -->
										</div>
										<input class="botiga-display-conditions-textarea" type="hidden" name="conditions" value="<?php echo isset( $template['conditions'] ) ? esc_attr( $template['conditions'] ) : ''; ?>">
									</div>
									<a href="#" title="<?php esc_attr_e( 'Duplicate', 'botiga' ); ?>" class="duplicate-template"><span class="dashicons dashicons-admin-page"></span><span class="tooltip"><?php esc_html_e( 'Duplicate', 'botiga' ); ?></span></a>
									<a href="#" title="<?php esc_attr_e( 'Delete', 'botiga' ); ?>" class="delete-template"><span class="dashicons dashicons-trash"></span><span class="tooltip"><?php esc_html_e( 'Delete', 'botiga' ); ?></span></a>
								</div>                    
							</div>

							<?php 
							foreach ( $parts as $type => $part ) : ?>
							<div class="template-part <?php echo esc_attr( $type ); ?>" data-page-builder="<?php echo !empty( $template[$type . '_builder'] ) ? $template[$type . '_builder'] : ''; ?>" data-part-type="<?php echo esc_attr( $type ); ?>" data-part-active="<?php echo !empty( $template[$type] ) ? 'active' : 'inactive'; ?>">
								<div class="template-part-inner">
									<span class="part-title">
										<span class="not-selected" style="display:<?php echo !empty( $template[$type] ) ? 'none' : 'block'; ?>;"><?php echo sprintf( __( 'Select %s', 'botiga' ), $part ); ?></span>
										<span class="selected" style="display:<?php echo !empty( $template[$type] ) ? 'block' : 'none'; ?>;"><span class="dashicons dashicons-yes-alt"></span><?php echo sprintf( __( '%s Selected', 'botiga' ), $part ); ?></span>
									</span>
									<div class="part-options" style="display:none;">
										<span class="select-existing"><?php esc_html_e( 'Select Existing', 'botiga' ); ?></span>
										<span class="select-page-builder"><?php esc_html_e( 'Create New', 'botiga' ); ?></span>
										<span class="edit-part"><?php esc_html_e( 'Edit', 'botiga' ); ?></span>
										<span class="reset"><?php esc_html_e( 'Reset', 'botiga' ); ?></span>
									</div>

									<input class="part-id" type="hidden" name="<?php echo esc_attr( $type ); ?>" value="<?php echo isset( $template[$type] ) ? esc_attr( $template[$type] ) : ''; ?>">
								</div>
								<div class="part-options-toggle">
									<span class="dashicons dashicons-ellipsis"></span>
								</div>
								<?php echo $this->existing_parts_select( $existing_parts ); ?>
								<div class="page-builder-wrapper" style="display:none;">
									<span class="page-builder-title"><?php esc_html_e( 'Choose your builder:', 'botiga' ); ?></span>
									<?php if ( class_exists( 'Elementor\Plugin' ) ) : ?>
									<span class="elementor"><span <?php echo $disabled; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="create-new" data-page-builder="elementor"><?php botiga_get_svg_icon( 'icon-elementor', true ); ?><?php esc_html_e( 'Elementor', 'botiga' ); ?></span></span>
									<?php endif; ?>
									<span class="editor"><span <?php echo $disabled; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="create-new" data-page-builder="editor"><?php botiga_get_svg_icon( 'icon-wordpress', true ); ?><?php esc_html_e( 'WordPress Editor', 'botiga' ); ?></span></span>
								</div>						
							</div>
							<?php endforeach; ?>
						</div>                
					<?php endforeach; ?>
				<?php endif; //check if templates is empty ?>

				<div class="add-new-template-wrapper">
					<span id="add-new-template"><span class="dashicons dashicons-plus-alt2"></span><?php esc_html_e( 'Add Template', 'botiga' ); ?></span>
				</div>

			</div>
			
			<div class="buttons" style="display:flex;">
				<button class="button button-primary" id="save-templates" <?php echo $disabled; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php esc_html_e( 'Save', 'botiga' ); ?></button>
			</div>

			<div class="botiga-elementor-iframe-wrapper" style="display:none;">
				<iframe class="botiga-elementor-iframe"></iframe>
				<a href="#" class="botiga-editor-close"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></a>
			</div>			

			</div>
		</div>
	</div>
</div>
<?php // @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>

<?php
/**
 * Footer Customizer options
 *
 * @package Botiga
 */

/**
 * New controls need to also be specified in the tabs controls
 */

/**
 * Footer
 */
$wp_customize->add_panel(
	'botiga_panel_footer',
	array(
		'title'         => esc_html__( 'Footer', 'botiga'),
		'priority'      => 31,
	)
);

/**
 * Footer widgets
 */
$wp_customize->add_section(
	'botiga_section_footer_widgets',
	array(
		'title'      => esc_html__( 'Footer widgets', 'botiga'),
		'panel'      => 'botiga_panel_footer',
	)
);

$wp_customize->add_setting(
	'botiga_footer_widgets_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_footer_widgets_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_footer_widgets',
			'controls_general'		=> json_encode( array( '#customize-control-footer_widgets_visibility', '#customize-control-footer_widgets_alignment', '#customize-control-footer_widget_sections', '#customize-control-footer_widgets', '#customize-control-footer_container', '#customize-control-footer_divider_1', '#customize-control-footer_divider_2') ),
			'controls_design'		=> json_encode( array( '#customize-control-footer_widgets_links_hover_color', '#customize-control-footer_widgets_links_color', '#customize-control-footer_widgets_text_color', '#customize-control-footer_widgets_title_color', '#customize-control-footer_widgets_title_size', '#customize-control-footer_divider_5', '#customize-control-footer_widgets_divider_width', '#customize-control-footer_widgets_divider_color', '#customize-control-footer_widgets_divider_size', '#customize-control-footer_divider_3', '#customize-control-footer_divider_4', '#customize-control-footer_widgets_divider', '#customize-control-footer_widgets_column_spacing', '#customize-control-footer_widgets_background', '#customize-control-footer_widgets_padding' ) ),
		)
	)
);

//Layout
$wp_customize->add_setting(
	'footer_widgets',
	array(
		'default'           => 'col2',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'footer_widgets',
		array(
			'label'    => esc_html__( 'Footer widgets layout', 'botiga' ),
			'section'  => 'botiga_section_footer_widgets',
			'cols' 		=> 3,
			'choices'  => array(
				'disabled' => array(
					'label' => esc_html__( 'Disabled', 'botiga' ),
					'url'   => '%s/assets/img/disabled.svg'
				),				
				'col1' => array(
					'label' => esc_html__( '1 column', 'botiga' ),
					'url'   => '%s/assets/img/fl1.svg'
				),
				'col2' => array(
					'label' => esc_html__( '2 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl2.svg'
				),		
				'col2-bigleft' => array(
					'label' => esc_html__( '2 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl3.svg'
				),				
				'col2-bigright' => array(
					'label' => esc_html__( '2 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl4.svg'
				),
				'col3' => array(
					'label' => esc_html__( '3 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl5.svg'
				),	
				'col3-bigleft' => array(
					'label' => esc_html__( '3 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl6.svg'
				),
				'col3-bigright' => array(
					'label' => esc_html__( '3 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl7.svg'
				),	
				'col4' => array(
					'label' => esc_html__( '4 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl8.svg'
				),	
				'col4-bigleft' => array(
					'label' => esc_html__( '4 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl9.svg'
				),
				'col4-bigright' => array(
					'label' => esc_html__( '4 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl10.svg'
				),
			)
		)
	)
); 

$wp_customize->add_setting( 'footer_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_1',
		array(
			'section' 		=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_container',
	array(
		'default' 			=> 'container',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'footer_container',
	array(
		'label' 		=> esc_html__( 'Container type', 'botiga' ),
		'section' => 'botiga_section_footer_widgets',
		'choices' => array(
			'container' 		=> esc_html__( 'Contained', 'botiga' ),
			'container-fluid' 	=> esc_html__( 'Full-width', 'botiga' ),
		)
	)
) );

$wp_customize->add_setting( 'footer_widgets_alignment',
	array(
		'default' 			=> 'top',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'footer_widgets_alignment',
	array(
		'label' 		=> esc_html__( 'Vertical alignment', 'botiga' ),
		'section' => 'botiga_section_footer_widgets',
		'choices' => array(
			'top' 		=> esc_html__( 'Top', 'botiga' ),
			'middle' 	=> esc_html__( 'Middle', 'botiga' ),
			'bottom' 	=> esc_html__( 'Bottom', 'botiga' ),
		)
	)
) );

$wp_customize->add_setting( 'footer_widgets_visibility', array(
	'sanitize_callback' => 'botiga_sanitize_select',
	'default' 			=> 'all',
) );

$wp_customize->add_control( 'footer_widgets_visibility', array(
	'type' 		=> 'select',
	'section' 	=> 'botiga_section_footer_widgets',
	'label' 	=> esc_html__( 'Visibility', 'botiga' ),
	'choices' => array(
		'all' 			=> esc_html__( 'Show on all devices', 'botiga' ),
		'desktop-only' 	=> esc_html__( 'Desktop only', 'botiga' ),
		'mobile-only' 	=> esc_html__( 'Mobile/tablet only', 'botiga' ),
	),
) );

$wp_customize->add_setting( 'footer_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_2',
		array(
			'section' 		=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widget_sections',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'footer_widget_sections',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">' . esc_html__( 'Footer widget areas', 'botiga' ) . '</span><a class="footer-widget-area-link footer-widget-area-link-1" href="javascript:wp.customize.section( \'sidebar-widgets-footer-1\' ).focus();">' . esc_html__( 'Widget area 1', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a><a class="footer-widget-area-link footer-widget-area-link-2" href="javascript:wp.customize.section( \'sidebar-widgets-footer-2\' ).focus();">' . esc_html__( 'Widget area 2', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a><a class="footer-widget-area-link footer-widget-area-link-3" href="javascript:wp.customize.section( \'sidebar-widgets-footer-3\' ).focus();">' . esc_html__( 'Widget area 3', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a><a class="footer-widget-area-link footer-widget-area-link-4" href="javascript:wp.customize.section( \'sidebar-widgets-footer-4\' ).focus();">' . esc_html__( 'Widget area 4', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section' 		=> 'botiga_section_footer_widgets',
		)
	)
);

//Styling
$wp_customize->add_setting(
	'footer_widgets_background',
	array(
		'default'           => '#f5f5f5',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_widgets_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_widgets_title_color',
		array(
			'label'         	=> esc_html__( 'Widget titles color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_text_color',
	array(
		'default'           => '#404040',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_widgets_text_color',
		array(
			'label'         	=> esc_html__( 'Widget text color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_links_color',
	array(
		'default'           => '#404040',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_widgets_links_color',
		array(
			'label'         	=> esc_html__( 'Links color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_links_hover_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_widgets_links_hover_color',
		array(
			'label'         	=> esc_html__( 'Links color (hover)', 'botiga' ),
			'section'       	=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_divider_3',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_3',
		array(
			'section' 		=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_divider',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'footer_widgets_divider',
		array(
			'label'         	=> esc_html__( 'Enable top divider', 'botiga' ),
			'section'       	=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_divider_size', array(
	'sanitize_callback' => 'absint',
	'default' 			=> 1,
	'transport'			=> 'postMessage'
) );

$wp_customize->add_control( 'footer_widgets_divider_size', array(
	'type' 				=> 'number',
	'section' 			=> 'botiga_section_footer_widgets',
	'label' 			=> esc_html__( 'Divider size', 'botiga' ),
	'active_callback' 	=> 'botiga_callback_footer_widgets_divider'
) );

$wp_customize->add_setting(
	'footer_widgets_divider_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_widgets_divider_color',
		array(
			'label'         	=> esc_html__( 'Divider color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_widgets',
			'active_callback' 	=> 'botiga_callback_footer_widgets_divider'
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_divider_width',
	array(
		'default' 			=> 'contained',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'footer_widgets_divider_width',
	array(
		'label' 	=> esc_html__( 'Divider width', 'botiga' ),
		'section' 	=> 'botiga_section_footer_widgets',
		'choices' 	=> array(
			'contained' 	=> esc_html__( 'Contained', 'botiga' ),
			'fullwidth' 	=> esc_html__( 'Full-width', 'botiga' ),
		),
		'active_callback' 	=> 'botiga_callback_footer_widgets_divider'
	)
) );

$wp_customize->add_setting( 'footer_divider_4',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_4',
		array(
			'section' 		=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_padding_desktop', array(
	'default'   		=> 70,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'footer_widgets_padding_tablet', array(
	'default'   		=> 40,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'footer_widgets_padding_mobile', array(
	'default'   		=> 40,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'footer_widgets_padding',
	array(
		'label' 		=> esc_html__( 'Vertical section padding', 'botiga' ),
		'section' 		=> 'botiga_section_footer_widgets',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'footer_widgets_padding_desktop',
			'size_tablet' 		=> 'footer_widgets_padding_tablet',
			'size_mobile' 		=> 'footer_widgets_padding_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		)		
	)
) );

$wp_customize->add_setting( 'footer_widgets_column_spacing_desktop', array(
	'default'   		=> 30,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'footer_widgets_column_spacing',
	array(
		'label' 		=> esc_html__( 'Column spacing', 'botiga' ),
		'section' 		=> 'botiga_section_footer_widgets',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'footer_widgets_column_spacing_desktop',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		)
	)
) );

$wp_customize->add_setting( 'footer_divider_5',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_5',
		array(
			'section' 		=> 'botiga_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_title_size_desktop', array(
	'default'   		=> 20,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'footer_widgets_title_size_tablet', array(
	'default'   		=> 20,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'footer_widgets_title_size_mobile', array(
	'default'   		=> 20,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'footer_widgets_title_size',
	array(
		'label' 		=> esc_html__( 'Widget titles size', 'botiga' ),
		'section' 		=> 'botiga_section_footer_widgets',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'footer_widgets_title_size_desktop',
			'size_tablet' 		=> 'footer_widgets_title_size_tablet',
			'size_mobile' 		=> 'footer_widgets_title_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		)		
	)
) );


/**
 * Footer credits
 */
$wp_customize->add_section(
	'botiga_section_footer_credits',
	array(
		'title'      => esc_html__( 'Copyright area', 'botiga'),
		'panel'      => 'botiga_panel_footer',
	)
);
$wp_customize->add_setting(
	'botiga_footer_credits_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_footer_credits_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_footer_credits',
			'controls_general'		=> json_encode( array( '#customize-control-footer_copyright_layout','#customize-control-footer_divider_9', '#customize-control-footer_divider_8', '#customize-control-footer_credits_container','#customize-control-footer_content_alignment','#customize-control-footer_copyright_elements', '#customize-control-footer_credits','#customize-control-footer_credits_position', '#customize-control-social_profiles_footer','#customize-control-social_profiles_footer_position') ),
			'controls_design'		=> json_encode( array( '#customize-control-footer_credits_divider', '#customize-control-footer_credits_divider_size', '#customize-control-footer_credits_divider_color', '#customize-control-footer_credits_divider_width', '#customize-control-footer_divider_7', '#customize-control-footer_divider_6', '#customize-control-footer_credits_padding_bottom', '#customize-control-footer_credits_padding', '#customize-control-footer_credits_text_color','#customize-control-footer_credits_links_color','#customize-control-footer_credits_links_color_hover', '#customize-control-footer_credits_background' ) ),
		)
	)
);

$wp_customize->add_setting(
	'footer_copyright_layout',
	array(
		'default'           => 'col2',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'footer_copyright_layout',
		array(
			'label'    => esc_html__( 'Copyright Bar Layout', 'botiga' ),
			'section'  => 'botiga_section_footer_credits',
			'cols' 		=> 2,
			'choices'  => array(
				'col1' => array(
					'label' => esc_html__( '1 column', 'botiga' ),
					'url'   => '%s/assets/img/fl1.svg'
				),
				'col2' => array(
					'label' => esc_html__( '2 columns', 'botiga' ),
					'url'   => '%s/assets/img/fl2.svg'
				)
			)
		)
	)
);

$wp_customize->add_setting( 'footer_credits_container',
	array(
		'default' 			=> 'container',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'footer_credits_container',
	array(
		'label' 		=> esc_html__( 'Container type', 'botiga' ),
		'section' => 'botiga_section_footer_credits',
		'choices' => array(
			'container' 		=> esc_html__( 'Contained', 'botiga' ),
			'container-fluid' 	=> esc_html__( 'Full-width', 'botiga' ),
		),
		'priority' => 20
	)
) );

$wp_customize->add_setting( 'footer_content_alignment',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'footer_content_alignment',
	array(
		'label' 		  => esc_html__( 'Content Alignment', 'botiga' ),
		'section' 		  => 'botiga_section_footer_credits',
		'active_callback' => 'botiga_callback_footer_copyright_alignment',
		'choices' 		  => array(
			'left' 	 => esc_html__( 'Left', 'botiga' ),
			'center' => esc_html__( 'Center', 'botiga' ),
			'right'  => esc_html__( 'Right', 'botiga' )
		),
		'priority' => 20
	)
) );

$wp_customize->add_setting( 
	'footer_copyright_elements', 
	array(
		'default'  			=> array( 
			'footer_credits', 
			'footer_social_profiles'
		),
		'sanitize_callback'	=> 'botiga_sanitize_footer_copyright_elements'
	) 
);
$wp_customize->add_control( 
	new \Kirki\Control\Sortable( 
		$wp_customize, 
		'footer_copyright_elements', 
		array(
			'label'   => esc_html__( 'Elements', 'botiga' ),
			'section' => 'botiga_section_footer_credits',
			'choices' => array(
				'footer_credits'         => esc_html__( 'Credits', 'botiga' ),
				'footer_social_profiles' => esc_html__( 'Social Profiles', 'botiga' )
			),
			'priority' => 20
		) 
	) 
);

$wp_customize->add_setting( 'footer_divider_8',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_8',
		array(
			'section' 		=> 'botiga_section_footer_credits',
			'priority' 		=> 30
		)
	)
);

$wp_customize->add_setting(
	'footer_credits',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => sprintf( esc_html__( '%1$1s. Proudly powered by %2$2s', 'botiga' ), '{copyright} {year} {site_title}', '{theme_author}' ),// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		'transport' => 'postMessage'
	)       
);
$wp_customize->add_control( 'footer_credits', array(
	'label'       	  => esc_html__( 'Footer credits', 'botiga' ),
	'description' 	  => esc_html__( 'You can use the following tags: {copyright}, {year}, {site_title}, {theme_author}', 'botiga' ),
	'type'        	  => 'textarea',
	'section'         => 'botiga_section_footer_credits',
	'active_callback' => function(){ return botiga_callback_footer_copyright_elements( 'footer_credits' ); },
	'priority'    	  => 40
) );

$wp_customize->add_setting( 
	'footer_credits_position',
	array(
		'default' 			=> 'right',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( 
	new Botiga_Radio_Buttons( 
		$wp_customize, 
		'footer_credits_position',
		array(
			'label' 	      => esc_html__( 'Position', 'botiga' ),
			'section' 	      => 'botiga_section_footer_credits',
			'active_callback' => function(){ return botiga_callback_footer_copyright_elements( 'footer_credits', true ); },
			'choices'         => array(
				'left'   => esc_html__( 'Left', 'botiga' ),
				'right'  => esc_html__( 'Right', 'botiga' ),
			),
			'priority' => 40
		)
	) 
);

$wp_customize->add_setting( 'footer_divider_9',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_9',
		array(
			'section' 		  => 'botiga_section_footer_credits',
			'active_callback' => function(){ return botiga_callback_footer_copyright_elements( 'footer_credits' ); },
			'priority' 		  => 50
		)
	)
);

$wp_customize->add_setting( 'social_profiles_footer',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'botiga_sanitize_urls',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control( new Botiga_Repeater_Control( $wp_customize, 'social_profiles_footer',
	array(
		'label' 		  => esc_html__( 'Social profile', 'botiga' ),
		'section' 		  => 'botiga_section_footer_credits',
		'active_callback' => function(){ return botiga_callback_footer_copyright_elements( 'footer_social_profiles' ); },
		'button_labels'   => array(
			'add' => esc_html__( 'Add new', 'botiga' ),
		),
		'priority'        => 60
	)
) );

$wp_customize->add_setting( 
	'social_profiles_footer_position',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( 
	new Botiga_Radio_Buttons( 
		$wp_customize, 
		'social_profiles_footer_position',
		array(
			'label' 	      => esc_html__( 'Position', 'botiga' ),
			'section' 	      => 'botiga_section_footer_credits',
			'active_callback' => function(){ return botiga_callback_footer_copyright_elements( 'footer_social_profiles', true ); },
			'choices'         => array(
				'left'   => esc_html__( 'Left', 'botiga' ),
				'right'  => esc_html__( 'Right', 'botiga' ),
			),
			'priority' => 60
		)
	) 
);

//Styling
$wp_customize->add_setting(
	'footer_credits_background',
	array(
		'default'           => '#f5f5f5',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_credits_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_credits',
			'priority' 			=> 70
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_credits_text_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_credits',
			'priority' 			=> 80
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_links_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_credits_links_color',
		array(
			'label'         	=> esc_html__( 'Links color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_credits',
			'priority' 			=> 80
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_links_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_credits_links_color_hover',
		array(
			'label'         	=> esc_html__( 'Links color hover', 'botiga' ),
			'section'       	=> 'botiga_section_footer_credits',
			'priority' 			=> 80
		)
	)
);

$wp_customize->add_setting( 'footer_divider_6',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_6',
		array(
			'section' 		=> 'botiga_section_footer_credits',
			'priority' 		=> 90
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_divider',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'footer_credits_divider',
		array(
			'label'         	=> esc_html__( 'Enable top divider', 'botiga' ),
			'section'       	=> 'botiga_section_footer_credits',
			'priority' 			=> 100
		)
	)
);

$wp_customize->add_setting( 'footer_credits_divider_size', array(
	'sanitize_callback' => 'absint',
	'default' 			=> 1,
	'transport' 		=> 'postMessage'
) );

$wp_customize->add_control( 'footer_credits_divider_size', array(
	'type' 				=> 'number',
	'section' 			=> 'botiga_section_footer_credits',
	'label' 			=> esc_html__( 'Divider size', 'botiga' ),
	'active_callback' 	=> 'botiga_callback_footer_credits_divider',
	'priority' 			=> 110
) );

$wp_customize->add_setting(
	'footer_credits_divider_color',
	array(
		'default'           => 'rgba(33,33,33,0.1)',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_credits_divider_color',
		array(
			'label'         	=> esc_html__( 'Divider color', 'botiga' ),
			'section'       	=> 'botiga_section_footer_credits',
			'active_callback' 	=> 'botiga_callback_footer_credits_divider',
			'priority' 			=> 120
		)
	)
);

$wp_customize->add_setting( 'footer_credits_divider_width',
	array(
		'default' 			=> 'contained',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'footer_credits_divider_width',
	array(
		'label' 	=> esc_html__( 'Divider width', 'botiga' ),
		'section' 	=> 'botiga_section_footer_credits',
		'choices' 	=> array(
			'contained' 	=> esc_html__( 'Contained', 'botiga' ),
			'fullwidth' 	=> esc_html__( 'Full-width', 'botiga' ),
		),
		'active_callback' 	=> 'botiga_callback_footer_credits_divider',
		'priority' 			=> 130
	)
) );

$wp_customize->add_setting( 'footer_divider_7',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'footer_divider_7',
		array(
			'section' 		=> 'botiga_section_footer_credits',
			'priority' 		=> 140
		)
	)
);

$wp_customize->add_setting( 'footer_credits_padding_desktop', array(
	'default'   		=> 30,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'footer_credits_padding',
	array(
		'label' 		=> esc_html__( 'Top padding', 'botiga' ),
		'section' 		=> 'botiga_section_footer_credits',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'footer_credits_padding_desktop',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority' => 150		
	)
) );

$wp_customize->add_setting( 'footer_credits_padding_bottom_desktop', array(
	'default'   		=> 60,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'footer_credits_padding_bottom',
	array(
		'label' 		=> esc_html__( 'Bottom padding', 'botiga' ),
		'section' 		=> 'botiga_section_footer_credits',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'footer_credits_padding_bottom_desktop',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority' => 160	
	)
) );
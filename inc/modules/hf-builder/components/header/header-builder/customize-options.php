<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Options
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_transparent',
        'header_transparent_display_rules_title',
        'header_transparent_display_on',
        'header_container',
        'enable_sticky_header',
        'sticky_header_type'
    ),
    'style'   => array()
);

/**
 * Tabs (Layout / Design)
 * 
 */
$wp_customize->add_setting(
    'botiga_section_hb_wrapper__header_builder_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_wrapper__header_builder_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_wrapper',
            'controls_general'		=> json_encode(
				array_merge(
					array(
						'#customize-control-botiga_section_hb_wrapper__header_builder_goto_sections',
						'#customize-control-header_transparent_hb_rows',
						'#customize-control-botiga_section_hb_wrapper__header_builder_sticky_row'
					),
					array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
				)
            ),
            'controls_design'		=> json_encode(
				array(
					'#customize-control-botiga_section_hb_wrapper__header_builder_background_color',
					'#customize-control-botiga_section_hb_wrapper__header_builder_background_image',
					'#customize-control-botiga_section_hb_wrapper__header_builder_background_size',
					'#customize-control-botiga_section_hb_wrapper__header_builder_background_position',
					'#customize-control-botiga_section_hb_wrapper__header_builder_background_repeat',
					'#customize-control-botiga_section_hb_wrapper__header_builder_padding'
				)
            ),
            'priority' 				=> 10
        )
    )
);

/**
 * Layout (Tab Content)
 * 
 */

// Header Section Shortcuts
$wp_customize->add_setting( 'botiga_section_hb_wrapper__header_builder_goto_sections',
	array(
		'default'             => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_hb_wrapper__header_builder_goto_sections',
		array(
			'description' 	=> '
				<span class="customize-control-title" style="font-style: normal;">Global Header</span>
				<div class="customize-section-shortcuts">
					<a class="botiga-to-widget-area-link" href="javascript:wp.customize.section( \'botiga_section_hb_presets\' ).focus();">' . esc_html__( 'Header Layouts', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="botiga-to-widget-area-link" href="javascript:wp.customize.section( \'botiga_section_hb_above_header_row\' ).focus();">' . esc_html__( 'Top Row', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="botiga-to-widget-area-link" href="javascript:wp.customize.section( \'botiga_section_hb_main_header_row\' ).focus();">' . esc_html__( 'Main Row', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="botiga-to-widget-area-link" href="javascript:wp.customize.section( \'botiga_section_hb_below_header_row\' ).focus();">' . esc_html__( 'Bottom Row', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="botiga-to-widget-area-link" href="javascript:wp.customize.section( \'botiga_section_hb_mobile_offcanvas\' ).focus();">' . esc_html__( 'Mobile Header', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
				</div>
			',
			'section' 		=> 'botiga_section_hb_wrapper',
            'priority' 		=> 20
		)
	)
);

// Header Transparent - Apply transparent header to
$wp_customize->add_setting(
	'header_transparent_hb_rows',
	array(
		'default'           => 'main-row',
		'sanitize_callback' => 'botiga_sanitize_select2'
	)
);
$wp_customize->add_control(
	new Botiga_Select2_Control(
		$wp_customize,
		'header_transparent_hb_rows',
		array(
			'label'           => esc_html__( 'Apply Transparent Header To', 'botiga' ),
			'section'         => 'botiga_section_hb_wrapper',
			'select2_options' => '{ "selectionCssClass": "botiga-select2" }',
			'multiple'        => true,
			'choices'         => array(
				'main-row' 		=> __( 'Main Row', 'botiga' ),
				'top-row' 		=> __( 'Top Row', 'botiga' ),
				'bottom-row'  	=> __( 'Bottom Row', 'botiga' )
			),
			'active_callback' => 'botiga_header_transparent_enabled',
			'priority'		  => 25
		)
	)
);

// Sticky Header Row
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_sticky_row', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default' 			=> 'main-header-row'
	) 
);
$wp_customize->add_control( 
	'botiga_section_hb_wrapper__header_builder_sticky_row', 
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Header Row To Sticky', 'botiga' ),
		'choices'         => array(
            'all' 	            => esc_html__( 'All Rows', 'botiga' ),
			'main-header-row' 	=> esc_html__( 'Main Header Row', 'botiga' ),
            'below-header-row' 	=> esc_html__( 'Bottom Header Row', 'botiga' )
		),
        'section' 	      => 'botiga_section_hb_wrapper',
        'active_callback' => 'botiga_sticky_header_enabled',
        'priority'        => 35
	) 
);

/**
 * Design (Tab Content)
 * 
 */

// Background Color
$wp_customize->add_setting(
	'botiga_section_hb_wrapper__header_builder_background_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_hb_wrapper__header_builder_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_wrapper',
			'priority'			=> 35
		)
	)
);

// Background Image
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_background_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new WP_Customize_Media_Control( 
		$wp_customize, 
		'botiga_section_hb_wrapper__header_builder_background_image',
		array(
			'label'           => __( 'Background Image', 'botiga' ),
			'section'         => 'botiga_section_hb_wrapper',
			'mime_type'       => 'image',
			'priority'	      => 35
		)
	)
);

// Background Size
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_background_size',
	array(
		'default'           => 'cover',
		'sanitize_callback' => 'botiga_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'botiga_section_hb_wrapper__header_builder_background_size',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Size', 'botiga' ),
		'choices'         => array(
			'cover'   => esc_html__( 'Cover', 'botiga' ),
			'contain' => esc_html__( 'Contain', 'botiga' )
		),
		'section' 	      => 'botiga_section_hb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Background Position
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_background_position',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'botiga_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'botiga_section_hb_wrapper__header_builder_background_position',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Position', 'botiga' ),
		'choices'         => array(
			'top'    => esc_html__( 'Top', 'botiga' ),
			'center' => esc_html__( 'Center', 'botiga' ),
			'bottom' => esc_html__( 'Bottom', 'botiga' )
		),
		'section' 	      => 'botiga_section_hb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Background Repeat
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_background_repeat',
	array(
		'default'           => 'no-repeat',
		'sanitize_callback' => 'botiga_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'botiga_section_hb_wrapper__header_builder_background_repeat',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Repeat', 'botiga' ),
		'choices'         => array(
			'no-repeat' => esc_html__( 'No Repeat', 'botiga' ),
			'repeat'    => esc_html__( 'Repeat', 'botiga' )
		),
		'section' 	      => 'botiga_section_hb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Padding
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_padding_desktop',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'botiga_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_padding_tablet',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'botiga_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_padding_mobile',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'botiga_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	new Botiga_Dimensions_Control( 
		$wp_customize, 
		'botiga_section_hb_wrapper__header_builder_padding',
		array(
			'label'           	=> __( 'Padding', 'botiga' ),
			'section'         	=> 'botiga_section_hb_wrapper',
			'sides'             => array(
				'top'    => true,
				'right'  => true,
				'bottom' => true,
				'left'   => true
			),
			'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
			'link_values_toggle' => true,
			'is_responsive'   	 => true,
			'settings'        	 => array(
				'desktop' => 'botiga_section_hb_wrapper__header_builder_padding_desktop',
				'tablet'  => 'botiga_section_hb_wrapper__header_builder_padding_tablet',
				'mobile'  => 'botiga_section_hb_wrapper__header_builder_padding_mobile'
			),
			'priority'	      	 => 35
		)
	)
);

/**
 * Layout / Design
 * Is not assigned to any tab, so it will display in both tabs
 * 
 */

// Divider
$wp_customize->add_setting(
	'botiga_section_hb_wrapper__header_builder_divider1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Divider_Control(
		$wp_customize,
		'botiga_section_hb_wrapper__header_builder_divider1',
		array(
			'section' 		=> 'botiga_section_hb_wrapper',
			'priority' 		=> 40
		)
	)
);

// Available Header Components Area
$wp_customize->add_setting( 'botiga_section_hb_wrapper__header_builder_available_components',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_hb_wrapper__header_builder_available_components',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Available Components', 'botiga' ) .'</span><div class="bhfb-available-components botiga-header-builder-available-components botiga-bhfb-area"></div>',
			'section' 		=> 'botiga_section_hb_wrapper',
            'priority' 		=> 40
		)
	)
);

// Available Header Mobile Components Area
$wp_customize->add_setting( 'botiga_section_hb_wrapper__header_builder_available_mobile_components',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_hb_wrapper__header_builder_available_mobile_components',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Available Components', 'botiga' ) .'</span><div class="bhfb-available-components botiga-header-builder-available-mobile-components botiga-bhfb-area"></div>',
			'section' 		=> 'botiga_section_hb_wrapper',
            'priority' 		=> 40
		)
	)
);

// Upsell
if( ! defined( 'BOTIGA_AWL_ACTIVE' ) && ! defined( 'BOTIGA_PRO_VERSION' ) ) {
	$wp_customize->add_setting( 'botiga_section_hb_wrapper__header_builder_upsell',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'esc_attr'
		)
	);
	$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_hb_wrapper__header_builder_upsell',
			array(
				'description' 	=> '<div class="bhfb-customizer-sidebar-upsell"><p>'. esc_html__( 'Extend your header with more components.', 'botiga' ) .'</p><a class="bhfb-upsell-button" target="_blank" href="https://athemes.com/botiga-upgrade?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga">'. esc_html__( 'Get Botiga Pro!', 'botiga' ) .'</a></div>',
				'section' 		=> 'botiga_section_hb_wrapper',
				'priority' 		=> 40
			)
		)
	);
}

// Move existing options.
$priority = 25;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }

		if( $option_name === 'header_transparent' ) {
			$wp_customize->get_control( $option_name )->description = esc_html__( 'The header stays over the content. You need to manually change the background color from each header builder row to be transparent.', 'botiga' );
		}

        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_wrapper';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

/**
 * Header Presets Section
 * 
 */
$wp_customize->add_section(
    'botiga_section_hb_presets',
    array(
        'title'      => esc_html__( 'Header Layouts', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

$choices = botiga_header_layouts();
$wp_customize->add_setting(
	'botiga_section_hb_presets__header_preset_layout',
	array(
		'default'           => 'header_layout_1',
		'sanitize_callback' => 'sanitize_key',
        'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'botiga_section_hb_presets__header_preset_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'botiga_section_hb_presets',
			'cols'		=> 2,
			'choices'  	=> $choices,
			'priority'	=> 20
		)
	)
);

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
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

// Header Presets
$wp_customize->add_setting( 'botiga_section_hb_wrapper__header_builder_goto_presets',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_hb_wrapper__header_builder_goto_presets',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;"></span><a class="to-widget-area-link" href="javascript:wp.customize.section( \'botiga_section_hb_presets\' ).focus();">' . esc_html__( 'Header Presets', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
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
		'sanitize_callback' => 'sanitize_text_field'
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
            'all' 	            => esc_html__( 'All', 'botiga' ),
			'main-header-row' 	=> esc_html__( 'Main Header Row', 'botiga' ),
            'below-header-row' 	=> esc_html__( 'Bottom Header Row', 'botiga' )
		),
        'section' 	      => 'botiga_section_hb_wrapper',
        'active_callback' => 'botiga_sticky_header_enabled',
        'priority'        => 35
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
        'title'      => esc_html__( 'Header Presets', 'botiga' ),
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
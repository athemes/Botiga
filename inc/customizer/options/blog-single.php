<?php
/**
 * Blog Customizer options
 *
 * @package Botiga
 */

/**
 * Single posts
 */
$wp_customize->add_section(
	'botiga_section_blog_singles',
	array(
		'title'         => esc_html__( 'Single posts', 'botiga'),
		'priority'      => 11,
		'panel'         => 'botiga_panel_blog',
	)
);

$wp_customize->add_setting(
	'botiga_blog_single_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_blog_single_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_blog_singles',
			'controls_general'		=> json_encode( array( '#customize-control-sidebar_single_post','#customize-control-sidebar_single_post_position','#customize-control-blog_single_divider_1','#customize-control-single_post_header_title','#customize-control-single_post_header_alignment','#customize-control-single_post_header_spacing','#customize-control-blog_single_divider_2','#customize-control-single_post_image_title','#customize-control-single_post_show_featured','#customize-control-single_post_image_placement','#customize-control-single_post_image_spacing','#customize-control-blog_single_divider_3','#customize-control-single_post_meta_title','#customize-control-single_post_meta_position','#customize-control-single_post_meta_elements','#customize-control-single_post_meta_spacing','#customize-control-blog_single_divider_4','#customize-control-single_post_elements_title','#customize-control-single_post_show_tags','#customize-control-single_post_show_author_box','#customize-control-single_post_show_post_nav','#customize-control-single_post_show_related_posts', '#customize-control-single_post_author_box_align' ) ),
			'controls_design'		=> json_encode( array( '#customize-control-single_post_title_size', '#customize-control-single_post_title_color', '#customize-control-single_posts_divider_1', '#customize-control-single_post_meta_size', '#customize-control-single_post_meta_color' ) ),
		)
	)
);

$wp_customize->add_setting(
	'sidebar_single_post',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'sidebar_single_post',
		array(
			'label'         	=> esc_html__( 'Enable sidebar', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);

$wp_customize->add_setting( 'sidebar_single_post_position',
	array(
		'default' 			=> 'sidebar-right',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'sidebar_single_post_position',
	array(
		'label' 	=> esc_html__( 'Sidebar position', 'botiga' ),
		'section' 	=> 'botiga_section_blog_singles',
		'choices' 	=> array(
			'sidebar-left' 		=> esc_html__( 'Left', 'botiga' ),
			'sidebar-right' 	=> esc_html__( 'Right', 'botiga' ),
		),
		'active_callback' 	=> 'botiga_callback_sidebar_single_post'
	)
) );

$wp_customize->add_setting( 'blog_single_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'blog_single_divider_1',
		array(
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);

//Header
$wp_customize->add_setting( 'single_post_header_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'single_post_header_title',
		array(
			'label'			=> esc_html__( 'Header', 'botiga' ),
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);

$wp_customize->add_setting( 'single_post_header_alignment',
	array(
		'default' 			=> 'middle',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'single_post_header_alignment',
	array(
		'label' 	=> esc_html__( 'Header alignment', 'botiga' ),
		'section' 	=> 'botiga_section_blog_singles',
		'choices' 	=> array(
			'left' 		=> esc_html__( 'Left', 'botiga' ),
			'middle' 	=> esc_html__( 'Middle', 'botiga' ),
		),
	)
) );

$wp_customize->add_setting( 'single_post_header_spacing', array(
	'default'   		=> 40,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'single_post_header_spacing',
	array(
		'label' 		=> esc_html__( 'Header spacing', 'botiga' ),
		'section' 		=> 'botiga_section_blog_singles',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'single_post_header_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 60,
			'step'  => 1
		),
	)
) );

$wp_customize->add_setting( 'blog_single_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'blog_single_divider_2',
		array(
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);


//Image
$wp_customize->add_setting( 'single_post_image_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'single_post_image_title',
		array(
			'label'			=> esc_html__( 'Image', 'botiga' ),
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);

$wp_customize->add_setting(
	'single_post_show_featured',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_post_show_featured',
		array(
			'label'         	=> esc_html__( 'Show featured image', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);

$wp_customize->add_setting( 'single_post_image_placement',
	array(
		'default' 			=> 'below',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'single_post_image_placement',
	array(
		'label' 	=> esc_html__( 'Image placement', 'botiga' ),
		'section' 	=> 'botiga_section_blog_singles',
		'choices' 	=> array(
			'below' 	=> esc_html__( 'Below', 'botiga' ),
			'above' 	=> esc_html__( 'Above', 'botiga' ),
		),
	)
) );

$wp_customize->add_setting( 'single_post_image_spacing', array(
	'default'   		=> 38,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'single_post_image_spacing',
	array(
		'label' 		=> esc_html__( 'Image spacing', 'botiga' ),
		'section' 		=> 'botiga_section_blog_singles',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'single_post_image_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 60,
			'step'  => 1
		),
	)
) );

$wp_customize->add_setting( 'blog_single_divider_3',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'blog_single_divider_3',
		array(
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);

//Meta
$wp_customize->add_setting( 'single_post_meta_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'single_post_meta_title',
		array(
			'label'			=> esc_html__( 'Meta', 'botiga' ),
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);

$wp_customize->add_setting( 'single_post_meta_position',
	array(
		'default' 			=> 'above-title',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'single_post_meta_position',
	array(
		'label' 	=> esc_html__( 'Position', 'botiga' ),
		'section' 	=> 'botiga_section_blog_singles',
		'choices' 	=> array(
			'above-title' 	=> esc_html__( 'Above title', 'botiga' ),
			'below-title' 	=> esc_html__( 'Below title', 'botiga' ),
		),
	)
) );

$wp_customize->add_setting( 'single_post_meta_elements', array(
	'default'  			=> array( 'botiga_posted_on', 'botiga_posted_by' ),
	'sanitize_callback'	=> 'botiga_sanitize_single_meta_elements'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'single_post_meta_elements', array(
	'label'   		=> esc_html__( 'Meta elements', 'botiga' ),
	'section' => 'botiga_section_blog_singles',
	'choices' => array(
		'botiga_posted_on' 			=> esc_html__( 'Post date', 'botiga' ),
		'botiga_posted_by' 			=> esc_html__( 'Post author', 'botiga' ),
		'botiga_post_categories'	=> esc_html__( 'Post categories', 'botiga' ),
		'botiga_entry_comments' 	=> esc_html__( 'Post comments', 'botiga' ),
	),
) ) );

$wp_customize->add_setting( 'single_post_meta_spacing', array(
	'default'   		=> 8,
	'sanitize_callback' => 'absint',
	'transport'			=> 'postMessage',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'single_post_meta_spacing',
	array(
		'label' 		=> esc_html__( 'Spacing', 'botiga' ),
		'section' 		=> 'botiga_section_blog_singles',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'single_post_meta_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 60,
			'step'  => 1
		),
	)
) );

$wp_customize->add_setting( 'blog_single_divider_4',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'blog_single_divider_4',
		array(
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);

//Elements
$wp_customize->add_setting( 'single_post_elements_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'single_post_elements_title',
		array(
			'label'			=> esc_html__( 'Elements', 'botiga' ),
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);
$wp_customize->add_setting(
	'single_post_show_tags',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_post_show_tags',
		array(
			'label'         	=> esc_html__( 'Post tags', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);
$wp_customize->add_setting(
	'single_post_show_author_box',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_post_show_author_box',
		array(
			'label'         	=> esc_html__( 'Author box', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);
$wp_customize->add_setting( 'single_post_author_box_align',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'single_post_author_box_align',
	array(
		'label'   => esc_html__( 'Author box alignment', 'botiga' ),
		'section' => 'botiga_section_blog_singles',
		'choices' => array(
			'left' 		=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
			'center' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
			'right' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>',
		),
		'active_callback' => 'botiga_callback_single_post_show_author_box'
	)
) );
$wp_customize->add_setting(
	'single_post_show_post_nav',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_post_show_post_nav',
		array(
			'label'         	=> esc_html__( 'Post navigation', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);
$wp_customize->add_setting(
	'single_post_show_related_posts',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_post_show_related_posts',
		array(
			'label'         	=> esc_html__( 'Related posts', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);

/**
 * Styling
 */
$wp_customize->add_setting( 'single_post_title_size_desktop', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'single_post_title_size_tablet', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'single_post_title_size_mobile', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'single_post_title_size',
	array(
		'label' 		=> esc_html__( 'Post title size', 'botiga' ),
		'section' 		=> 'botiga_section_blog_singles',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'single_post_title_size_desktop',
			'size_tablet' 		=> 'single_post_title_size_tablet',
			'size_mobile' 		=> 'single_post_title_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		)		
	)
) );

$wp_customize->add_setting(
	'single_post_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'single_post_title_color',
		array(
			'label'         	=> esc_html__( 'Title color', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);


$wp_customize->add_setting( 'single_posts_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'single_posts_divider_1',
		array(
			'section' 		=> 'botiga_section_blog_singles',
		)
	)
);

$wp_customize->add_setting( 'single_post_meta_size_desktop', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'single_post_meta_size_tablet', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'single_post_meta_size_mobile', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'single_post_meta_size',
	array(
		'label' 		=> esc_html__( 'Meta size', 'botiga' ),
		'section' 		=> 'botiga_section_blog_singles',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'single_post_meta_size_desktop',
			'size_tablet' 		=> 'single_post_meta_size_tablet',
			'size_mobile' 		=> 'single_post_meta_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		)		
	)
) );

$wp_customize->add_setting(
	'single_post_meta_color',
	array(
		'default'           => '#666666',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'single_post_meta_color',
		array(
			'label'         	=> esc_html__( 'Meta color', 'botiga' ),
			'section'       	=> 'botiga_section_blog_singles',
		)
	)
);
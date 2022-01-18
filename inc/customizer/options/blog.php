<?php
/**
 * Blog Customizer options
 *
 * @package Botiga
 */

$wp_customize->add_panel( 'botiga_panel_blog', array(
	'priority'       => 19,
	'capability'     => 'edit_theme_options',
	'title'          => esc_html__( 'Blog', 'botiga' ),
) );

/**
 * Archives
 */
$wp_customize->add_section(
	'botiga_section_blog_archives',
	array(
		'title'         => esc_html__( 'Blog archives', 'botiga'),
		'priority'      => 11,
		'panel'         => 'botiga_panel_blog',
	)
);

$wp_customize->add_setting(
	'botiga_blog_archive_tabs',
	array(
		'default'           => '',
		'sanitize_callback'	=> 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_blog_archive_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_blog_archives',
			'controls_general'		=> json_encode( array( '#customize-control-show_avatar', '#customize-control-archives_list_vertical_alignment','#customize-control-archive_featured_image_size','#customize-control-archive_list_image_placement','#customize-control-archives_grid_columns', '#customize-control-blog_layout','#customize-control-sidebar_archives','#customize-control-sidebar_archives_position','#customize-control-blog_divider_1','#customize-control-archive_featured_image_title','#customize-control-archive_featured_image_spacing','#customize-control-blog_divider_2','#customize-control-archive_text_title','#customize-control-archive_text_align','#customize-control-archive_title_spacing','#customize-control-show_excerpt','#customize-control-excerpt_length','#customize-control-read_more_link','#customize-control-read_more_spacing','#customize-control-blog_divider_3','#customize-control-archive_meta_title','#customize-control-archive_meta_position','#customize-control-archive_meta_elements','#customize-control-archive_meta_spacing','#customize-control-archive_meta_delimiter' ) ),
			'controls_design'		=> json_encode( array( '#customize-control-loop_post_text_size', '#customize-control-loop_post_text_color','#customize-control-loop_post_meta_size', '#customize-control-loop_post_meta_color','#customize-control-loop_post_title_size', '#customize-control-loop_post_title_color', '#customize-control-loop_posts_divider_1', '#customize-control-loop_posts_divider_2' ) ),
			'priority'      		=> 10
		)
	)
);

//Layout
$wp_customize->add_setting(
	'blog_layout',
	array(
		'default'           => 'layout3',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'blog_layout',
		array(
			'label'    => esc_html__( 'Blog layout', 'botiga' ),
			'section'  => 'botiga_section_blog_archives',
			'cols' 		=> 2,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( '1 column', 'botiga' ),
					'url'   => '%s/assets/img/bl1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( '2 columns', 'botiga' ),
					'url'   => '%s/assets/img/bl2.svg'
				),		
				'layout3' => array(
					'label' => esc_html__( '2 columns', 'botiga' ),
					'url'   => '%s/assets/img/bl3.svg'
				),				
				'layout4' => array(
					'label' => esc_html__( '2 columns', 'botiga' ),
					'url'   => '%s/assets/img/bl4.svg'
				),
				'layout5' => array(
					'label' => esc_html__( '3 columns', 'botiga' ),
					'url'   => '%s/assets/img/bl5.svg'
				),	
				'layout6' => array(
					'label' => esc_html__( '3 columns', 'botiga' ),
					'url'   => '%s/assets/img/bl6.svg'
				),
			),
			'priority'	=> 20
		)
	)
); 

$wp_customize->add_setting(
	'sidebar_archives',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'sidebar_archives',
		array(
			'label'         	=> esc_html__( 'Enable sidebar', 'botiga' ),
			'section'       	=> 'botiga_section_blog_archives',
			'priority'      	=> 30
		)
	)
);

$wp_customize->add_setting( 'sidebar_archives_position',
	array(
		'default' 			=> 'sidebar-right',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'sidebar_archives_position',
	array(
		'label' 	=> esc_html__( 'Sidebar position', 'botiga' ),
		'section' 	=> 'botiga_section_blog_archives',
		'choices' 	=> array(
			'sidebar-left' 		=> esc_html__( 'Left', 'botiga' ),
			'sidebar-right' 	=> esc_html__( 'Right', 'botiga' ),
		),
		'active_callback' 	=> 'botiga_callback_sidebar_archives',
		'priority'      	=> 40
	)
) );

$wp_customize->add_setting( 'archives_grid_columns',
	array(
		'default' 			=> '3',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'archives_grid_columns',
	array(
		'label' 	=> esc_html__( 'Columns', 'botiga' ),
		'section' 	=> 'botiga_section_blog_archives',
		'choices' 	=> array(
			'2' 		=> esc_html__( '2', 'botiga' ),
			'3' 		=> esc_html__( '3', 'botiga' ),
			'4' 		=> esc_html__( '4', 'botiga' ),
		),
		'active_callback' 	=> 'botiga_callback_grid_archives',
		'priority'      	=> 50
	)
) );


$wp_customize->add_setting( 'blog_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'blog_divider_1',
		array(
			'section' 		=> 'botiga_section_blog_archives',
			'priority'		=> 60
		)
	)
);

//Featured image
$wp_customize->add_setting( 'archive_featured_image_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'archive_featured_image_title',
		array(
			'label'			=> esc_html__( 'Featured image', 'botiga' ),
			'section' 		=> 'botiga_section_blog_archives',
			'priority'      => 70
		)
	)
);

$wp_customize->add_setting( 'archive_list_image_placement',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'archive_list_image_placement',
	array(
		'label' 	=> esc_html__( 'Image placement', 'botiga' ),
		'section' 	=> 'botiga_section_blog_archives',
		'choices' 	=> array(
			'left' 		=> esc_html__( 'Left', 'botiga' ),
			'right' 	=> esc_html__( 'Right', 'botiga' ),
		),
		'active_callback' 	=> 'botiga_callback_list_archives',
		'priority'	=> 80
	)
) );

$wp_customize->add_setting( 'archive_featured_image_size_desktop', array(
	'default'   		=> 30,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'archive_featured_image_size',
	array(
		'label' 		=> esc_html__( 'Image size', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'archive_featured_image_size_desktop',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 60,
			'step'  => 1
		),
		'active_callback' 	=> 'botiga_callback_list_general_archives',
		'priority'		=> 90
	)
) );


$wp_customize->add_setting( 'archive_featured_image_spacing_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'archive_featured_image_spacing',
	array(
		'label' 		=> esc_html__( 'Spacing', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'archive_featured_image_spacing_desktop',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 60,
			'step'  => 1
		),
		'priority'		=> 100
	)
) );

$wp_customize->add_setting( 'blog_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'blog_divider_2',
		array(
			'section' 		=> 'botiga_section_blog_archives',
			'priority'     	=> 110
		)
	)
);

$wp_customize->add_setting( 'archive_text_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'archive_text_title',
		array(
			'label'			=> esc_html__( 'Text', 'botiga' ),
			'section' 		=> 'botiga_section_blog_archives',
			'priority'		=> 120
		)
	)
);

$wp_customize->add_setting( 'archive_text_align',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'archive_text_align',
	array(
		'label'   => esc_html__( 'Text alignment', 'botiga' ),
		'section' => 'botiga_section_blog_archives',
		'choices' => array(
			'left' 		=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
			'center' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
			'right' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>',
		),
		'priority' => 130
	)
) );

$wp_customize->add_setting( 'archives_list_vertical_alignment',
	array(
		'default' 			=> 'middle',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'archives_list_vertical_alignment',
	array(
		'label' 	=> esc_html__( 'Vertical alignment', 'botiga' ),
		'section' 	=> 'botiga_section_blog_archives',
		'choices' 	=> array(
			'top' 		=> esc_html__( 'Top', 'botiga' ),
			'middle' 	=> esc_html__( 'Middle', 'botiga' ),
			'bottom' 	=> esc_html__( 'Bottom', 'botiga' ),
		),
		'active_callback' 	=> 'botiga_callback_list_general_archives',
		'priority'	=> 140
	)
) );

$wp_customize->add_setting( 'archive_title_spacing', array(
	'default'   		=> 16,
	'sanitize_callback' => 'absint',
	'transport'			=> 'postMessage',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'archive_title_spacing',
	array(
		'label' 		=> esc_html__( 'Title spacing', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'archive_title_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 60,
			'step'  => 1
		),
		'priority'		=> 150
	)
) );

$wp_customize->add_setting(
	'show_excerpt',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'show_excerpt',
		array(
			'label'         	=> esc_html__( 'Show excerpt', 'botiga' ),
			'section'       	=> 'botiga_section_blog_archives',
			'priority'      	=> 160
		)
	)
);

$wp_customize->add_setting( 'excerpt_length', array(
	'default'   		=> 30,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'excerpt_length',
	array(
		'label' 		=> esc_html__( 'Excerpt length', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'excerpt_length',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 120,
			'step'  => 1
		),
		'active_callback' => 'botiga_callback_excerpt',
		'priority'		=> 170
	)
) );

$wp_customize->add_setting(
	'read_more_link',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'read_more_link',
		array(
			'label'         	=> esc_html__( 'Read more link', 'botiga' ),
			'section'       	=> 'botiga_section_blog_archives',
			'active_callback'   => 'botiga_callback_excerpt',
			'priority'      	=> 180
		)
	)
);


$wp_customize->add_setting( 'blog_divider_3',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'blog_divider_3',
		array(
			'section' 		=> 'botiga_section_blog_archives',
			'priority'		=> 190
		)
	)
);
//Meta
$wp_customize->add_setting( 'archive_meta_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'archive_meta_title',
		array(
			'label'			=> esc_html__( 'Meta', 'botiga' ),
			'section' 		=> 'botiga_section_blog_archives',
			'priority'		=> 200
		)
	)
);

$wp_customize->add_setting( 'archive_meta_position',
	array(
		'default' 			=> 'above-title',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'archive_meta_position',
	array(
		'label' 	=> esc_html__( 'Position', 'botiga' ),
		'section' 	=> 'botiga_section_blog_archives',
		'choices' 	=> array(
			'above-title' 		=> esc_html__( 'Above title', 'botiga' ),
			'below-excerpt' 	=> esc_html__( 'Below excerpt', 'botiga' ),
		),
		'priority'	=> 210
	)
) );

$wp_customize->add_setting( 'archive_meta_elements', array(
	'default'  			=> array( 'post_date' ),
	'sanitize_callback'	=> 'botiga_sanitize_blog_meta_elements'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'archive_meta_elements', array(
	'label'   		=> esc_html__( 'Meta elements', 'botiga' ),
	'section' => 'botiga_section_blog_archives',
	'choices' => array(
		'post_date' 		=> esc_html__( 'Post date', 'botiga' ),
		'post_author' 		=> esc_html__( 'Post author', 'botiga' ),
		'post_categories'	=> esc_html__( 'Post categories', 'botiga' ),
		'post_comments' 	=> esc_html__( 'Post comments', 'botiga' ),
	),
	'priority'	=> 220
) ) );

$wp_customize->add_setting(
	'show_avatar',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'show_avatar',
		array(
			'label'         	=> esc_html__( 'Show author avatar', 'botiga' ),
			'section'       	=> 'botiga_section_blog_archives',
			'active_callback' 	=> 'botiga_callback_author_avatar',
			'priority'      	=> 230
		)
	)
);


$wp_customize->add_setting( 'archive_meta_spacing', array(
	'default'   		=> 8,
	'sanitize_callback' => 'absint',
	'transport'			=> 'postMessage',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'archive_meta_spacing',
	array(
		'label' 		=> esc_html__( 'Spacing', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'archive_meta_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 60,
			'step'  => 1
		),
		'priority'		=> 240
	)
) );

$wp_customize->add_setting( 'archive_meta_delimiter',
	array(
		'default' 			=> 'none',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'archive_meta_delimiter',
	array(
		'label' 	=> esc_html__( 'Delimiter style', 'botiga' ),
		'section' 	=> 'botiga_section_blog_archives',
		'choices' 	=> array(
			'none' 		=> esc_html__( 'None', 'botiga' ),
			'dot' 		=> '&middot;',
			'vertical' 	=> '&#124;',
			'horizontal'=> '&#x23AF;'
		),
		'priority'	=> 250
	)
) );

/**
 * Styling
 */
$wp_customize->add_setting( 'loop_post_title_size_desktop', array(
	'default'   		=> 18,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'loop_post_title_size_tablet', array(
	'default'   		=> 18,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'loop_post_title_size_mobile', array(
	'default'   		=> 18,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'loop_post_title_size',
	array(
		'label' 		=> esc_html__( 'Post title size', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'loop_post_title_size_desktop',
			'size_tablet' 		=> 'loop_post_title_size_tablet',
			'size_mobile' 		=> 'loop_post_title_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority'		=> 260
	)
) );

$wp_customize->add_setting(
	'loop_post_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'loop_post_title_color',
		array(
			'label'         	=> esc_html__( 'Title color', 'botiga' ),
			'section'       	=> 'botiga_section_blog_archives',
			'priority'      	=> 270
		)
	)
);


$wp_customize->add_setting( 'loop_posts_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'loop_posts_divider_1',
		array(
			'section' 		=> 'botiga_section_blog_archives',
			'priority'		=> 280
		)
	)
);

$wp_customize->add_setting( 'loop_post_meta_size_desktop', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'loop_post_meta_size_tablet', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'loop_post_meta_size_mobile', array(
	'default'   		=> 14,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'loop_post_meta_size',
	array(
		'label' 		=> esc_html__( 'Meta size', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'loop_post_meta_size_desktop',
			'size_tablet' 		=> 'loop_post_meta_size_tablet',
			'size_mobile' 		=> 'loop_post_meta_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority'		=> 290
	)
) );

$wp_customize->add_setting(
	'loop_post_meta_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'loop_post_meta_color',
		array(
			'label'         	=> esc_html__( 'Meta color', 'botiga' ),
			'section'       	=> 'botiga_section_blog_archives',
			'priority'      	=> 300
		)
	)
);

$wp_customize->add_setting( 'loop_posts_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'loop_posts_divider_2',
		array(
			'section' 		=> 'botiga_section_blog_archives',
			'priority'		=> 310
		)
	)
);

$wp_customize->add_setting( 'loop_post_text_size_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'loop_post_text_size_tablet', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'loop_post_text_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'loop_post_text_size',
	array(
		'label' 		=> esc_html__( 'Excerpt size', 'botiga' ),
		'section' 		=> 'botiga_section_blog_archives',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'loop_post_text_size_desktop',
			'size_tablet' 		=> 'loop_post_text_size_tablet',
			'size_mobile' 		=> 'loop_post_text_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority'		=> 320
	)
) );

$wp_customize->add_setting(
	'loop_post_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'loop_post_text_color',
		array(
			'label'         	=> esc_html__( 'Excerpt color', 'botiga' ),
			'section'       	=> 'botiga_section_blog_archives',
			'priority'      	=> 330
		)
	)
);
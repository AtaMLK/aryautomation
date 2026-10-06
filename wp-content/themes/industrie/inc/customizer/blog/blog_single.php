<?php
function industrie_blog_single_style_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_blog_single_style_setting' , array(
        'title'      => esc_html__( 'Blog Single', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_blog_setting'
    ) );


	//Start
	$industrie_customizer->add_setting( 'industrie_blog_single_sidebar_setting', array(
		'default'           => 'blog_single_no_sidebar',
		'transport'	        => 'postMessage',
	) );
	$industrie_customizer->add_control( 'industrie_blog_single_sidebar_setting', array(
		'label'   => esc_html__( 'Sidebar Setting', 'industrie' ),
		'section' => 'industrie_blog_single_style_setting',
		'type'    => 'select',
		'choices' => array(
			'blog_single_no_sidebar' => esc_html__( 'Full Width', 'industrie' ),
			'2left' => esc_html__( 'Left Sidebar', 'industrie' ),
			'2right'  => esc_html__( 'Right Sidebar', 'industrie' ),
		),
	) );
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'blog_single_hr_00', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_single_hr_00', 
			array(
				'settings'		=> 'blog_single_hr_00',
				'section'  		=> 'industrie_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Author
	$industrie_customizer->add_setting( 'industrie_blog_single_hide_author', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_blog_single_hide_author',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Author','industrie'),
				'description' => esc_html__('You can show or hide Author','industrie'),
				'section' => 'industrie_blog_single_style_setting'
			)
		)
	);
	//End Hide Author

	//Start separator
	$industrie_customizer->add_setting(
		'blog_single_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_single_hr_1', 
			array(
				'settings'		=> 'blog_single_hr_1',
				'section'  		=> 'industrie_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Date
	$industrie_customizer->add_setting( 'industrie_blog_single_hide_comment', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_blog_single_hide_comment',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Comment','industrie'),
				'description' => esc_html__('You can show or hide comment','industrie'),
				'section' => 'industrie_blog_single_style_setting'
			)
		)
	);
	//End Hide Date

	//Start separator
	$industrie_customizer->add_setting(
		'blog_single_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_single_hr_2', 
			array(
				'settings'		=> 'blog_single_hr_2',
				'section'  		=> 'industrie_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Published
	$industrie_customizer->add_setting( 'industrie_blog_single_hide_published', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_blog_single_hide_published',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Published','industrie'),
				'description' => esc_html__('You can show or hide published','industrie'),
				'section' => 'industrie_blog_single_style_setting'
			)
		)
	);
	//End Hide Published

	//Start separator
	$industrie_customizer->add_setting(
		'blog_single_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_single_hr_3', 
			array(
				'settings'		=> 'blog_single_hr_3',
				'section'  		=> 'industrie_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Category
	$industrie_customizer->add_setting( 'industrie_blog_single_hide_categiry', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_blog_single_hide_categiry',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Category','industrie'),
				'description' => esc_html__('You can show or hide categiry','industrie'),
				'section' => 'industrie_blog_single_style_setting'
			)
		)
	);
	//End Hide Category

	//Start separator
	$industrie_customizer->add_setting(
		'blog_single_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_single_hr_4', 
			array(
				'settings'		=> 'blog_single_hr_4',
				'section'  		=> 'industrie_blog_single_style_setting',
			)
		)
	);
	//End separator
}
<?php
function industrie_blog_page_style_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_blog_page_style_setting' , array(
        'title'      => esc_html__( 'Blog Page', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_blog_setting'
    ) );

	//Start default Page Banner
	$industrie_customizer->add_setting(
		'industrie_blog_page_bg', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_blog_page_bg',
			array(
			'label'      => esc_html__( 'Blog Page Image', 'industrie' ),
			'section'    => 'industrie_blog_page_style_setting',
			'settings'   => 'industrie_blog_page_bg',
			)
		)   
	);
	//End default Page Banner

	//Start separator
	$industrie_customizer->add_setting(
		'blog_page_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_page_hr_0', 
			array(
				'settings'		=> 'blog_page_hr_0',
				'section'  		=> 'industrie_blog_page_style_setting',
			)
		)
	);
	//End separator
	

	//Start Background Color
	$industrie_customizer->add_setting (
        'industrie_blog_page_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_blog_page_bg_color',
            array(
                'label'      => esc_html__('Body Backgroud Color','industrie'),
                'description'      => esc_html__('Pick body background color','industrie'),
                'section'    => 'industrie_blog_page_style_setting',
                'settings'   => 'industrie_blog_page_bg_color',
            )
        )
    );
	//End Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'blog_page_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_page_hr_1', 
			array(
				'settings'		=> 'blog_page_hr_1',
				'section'  		=> 'industrie_blog_page_style_setting',
			)
		)
	);
	//End separator


	//Start
	$industrie_customizer->add_setting( 'industrie_blog_page_sidebar_setting', array(
		'default'           => 'blog_no_sidebar',
		'transport'	        => 'postMessage',
	) );
	$industrie_customizer->add_control( 'industrie_blog_page_sidebar_setting', array(
		'label'   => esc_html__( 'Sidebar Setting', 'industrie' ),
		'section' => 'industrie_blog_page_style_setting',
		'type'    => 'select',
		'choices' => array(
			'blog_no_sidebar' => esc_html__( 'Full Width', 'industrie' ),
			'blog_left_sidebar' => esc_html__( 'Left Sidebar', 'industrie' ),
			'blog_right_sidebar'  => esc_html__( 'Right Sidebar', 'industrie' ),
		),
	) );
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'blog_page_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_page_hr_4', 
			array(
				'settings'		=> 'blog_page_hr_4',
				'section'  		=> 'industrie_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Author
	$industrie_customizer->add_setting( 'industrie_blog_page_hide_author', 
	array(
		'default'           => 0,
	)
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_blog_page_hide_author',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Author','industrie'),
				'description' => esc_html__('If you want to hide author click ON button','industrie'),
				'section' => 'industrie_blog_page_style_setting'
			)
		)
	);
	//End Hide Author

	//Start separator
	$industrie_customizer->add_setting(
		'blog_page_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_page_hr_5', 
			array(
				'settings'		=> 'blog_page_hr_5',
				'section'  		=> 'industrie_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Date
	$industrie_customizer->add_setting( 'industrie_blog_page_hide_date', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_blog_page_hide_date',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Date','industrie'),
				'description' => esc_html__('If you want to hide date click ON button','industrie'),
				'section' => 'industrie_blog_page_style_setting'
			)
		)
	);
	//End Hide Date

	//Start separator
	$industrie_customizer->add_setting(
		'blog_page_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_page_hr_6', 
			array(
				'settings'		=> 'blog_page_hr_6',
				'section'  		=> 'industrie_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Date
	$industrie_customizer->add_setting( 'industrie_blog_page_hide_categiry', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_blog_page_hide_categiry',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Category','industrie'),
				'description' => esc_html__('If you want to hide categoy click ON button','industrie'),
				'section' => 'industrie_blog_page_style_setting'
			)
		)
	);
	//End Hide Date

	//Start separator
	$industrie_customizer->add_setting(
		'blog_page_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_page_hr_7', 
			array(
				'settings'		=> 'blog_page_hr_7',
				'section'  		=> 'industrie_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Blog Page Custom Title
	$industrie_customizer->add_setting(
		'industrie_blog_page_custom_read_more',
		array(
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('industrie_blog_page_custom_read_more', array(
        'section'	=> 'industrie_blog_page_style_setting',
        'label'		=> esc_html__( 'Blog Read More Text', 'industrie' ),
        'description' => esc_html__( 'Enter Blog Read More Here', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_blog_page_custom_read_more'
    ));
	//End Blog Page Custom Title

	//Start separator
	$industrie_customizer->add_setting(
		'blog_page_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_page_hr_8', 
			array(
				'settings'		=> 'blog_page_hr_8',
				'section'  		=> 'industrie_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting( 'industrie_blog_page_btn_setting', array(
	 	'default'           => 'rs-default',
	 	'transport'	        => 'postMessage',
	));

	$industrie_customizer->add_control( 'industrie_blog_page_btn_setting', array(
	 	'label'   => esc_html__( 'Button Setting', 'industrie' ),
	 	'section' => 'industrie_blog_page_style_setting',
	 	'type'    => 'select',
	 	'choices' => array(
	 		'rs-default' => esc_html__( 'Default Style', 'industrie' ),
	 		'rs-border' => esc_html__( 'Border Style', 'industrie' ),
	 		'rs-flat' => esc_html__( 'Flat Style', 'industrie' )
	 	),
	));
	//End
}
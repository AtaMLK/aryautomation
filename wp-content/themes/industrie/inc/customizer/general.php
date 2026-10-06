<?php
function industrie_general_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section(
		'industrie_general_section',
		array(
			'title'    => esc_html__( 'General Settings', 'industrie' ),
			'priority' => $priority,
			'panel'    => 'industrie_options_panel'
		)
	);


	//Start separator
	$industrie_customizer->add_setting(
		'separator_14', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_14', 
			array(
				'settings'		=> 'separator_14',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start default header logo
	$industrie_customizer->add_setting(
		'industrie_default_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_default_logo',
			array(
			'label'      => esc_html__( 'Upload Default Logo', 'industrie' ),
			'section'    => 'industrie_general_section',
			'settings'   => 'industrie_default_logo',
			)
		)   
	);
	//End default logo

	//Start separator
	$industrie_customizer->add_setting(
		'separator_15', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_15', 
			array(
				'settings'		=> 'separator_15',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start separator
	$industrie_customizer->add_setting(
		'separator_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_3', 
			array(
				'settings'		=> 'separator_3',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Logo Height
	$industrie_customizer->add_setting(
		'industrie_logo_height',
		array(
			'default' => esc_html__( '', 'industrie' ),
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('industrie_logo_height', array(
        'section'	=> 'industrie_general_section',
        'label'		=> esc_html__( 'Logo Height', 'industrie' ),
        'description' => esc_html__( 'Logo max height example(50px)', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_logo_height'
    ));
	//End Logo Height

	//Start separator
	$industrie_customizer->add_setting(
		'separator_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_4', 
			array(
				'settings'		=> 'separator_4',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Sticky Menu
	$industrie_customizer->add_setting( 'industrie_enable_sticky_menu', 
	array(
			'default'    => '0',
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_enable_sticky_menu',
			array(
				'type' => 'switch',
				'label' => esc_html__('Sticky Menu','industrie'),
				'description' => esc_html__('You can show or hide sticky menu here','industrie'),
				'section' => 'industrie_general_section'
			)
		)
	);
	//End Sticky Menu

	//Start separator
	$industrie_customizer->add_setting(
		'separator_9', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_9', 
			array(
				'settings'		=> 'separator_9',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Sticky logo
	$industrie_customizer->add_setting(
		'industrie_sticky_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_sticky_logo',
			array(
			'label'      => esc_html__( 'Upload Your Sticky Logo', 'industrie' ),
			'section'    => 'industrie_general_section',
			'settings'   => 'industrie_sticky_logo',
			)
		)   
	);
	//End Sticky logo

	//Start separator
	$industrie_customizer->add_setting(
		'separator_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_7', 
			array(
				'settings'		=> 'separator_7',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Sticky Logo Height
	$industrie_customizer->add_setting(
		'industrie_sticky_logo_height',
		array(
			'default' => esc_html__( '25px', 'industrie' ),
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('industrie_sticky_logo_height', array(
        'section'	=> 'industrie_general_section',
        'label'		=> esc_html__( 'Sticky Logo Height', 'industrie' ),
        'description' => esc_html__( 'Sticky Logo max height example(20px)', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_sticky_logo_height'
    ));
	//End Sticky Logo Height

	//Start separator
	$industrie_customizer->add_setting(
		'separator_180', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_180', 
			array(
				'settings'		=> 'separator_180',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Footer logo
	$industrie_customizer->add_setting(
		'industrie_footer_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_footer_logo',
			array(
			'label'      => esc_html__( 'Upload Your Footer Logo', 'industrie' ),
			'section'    => 'industrie_general_section',
			'settings'   => 'industrie_footer_logo',
			)
		)   
	);
	//End Footer logo

	//Start separator
	$industrie_customizer->add_setting(
		'separator_181', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_181', 
			array(
				'settings'		=> 'separator_181',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Footer Logo Height
	$industrie_customizer->add_setting(
		'industrie_footer_logo_height',
		array(
			'default' => esc_html__( '50px', 'industrie' ),
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('industrie_footer_logo_height', array(
        'section'	=> 'industrie_general_section',
        'label'		=> esc_html__( 'Footer Logo Height', 'industrie' ),
        'description' => esc_html__( 'Footer Logo max height example(50px)', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_footer_logo_height'
    ));
	//End Footer Logo Height

	//Start separator
	$industrie_customizer->add_setting(
		'separator_80', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_80', 
			array(
				'settings'		=> 'separator_80',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	// Header Auto Margin Off Start
	$industrie_customizer->add_setting( 'industrie_header_auto_margin_top_off', 
	array(
		'default'    => '0',
		) 
	);
	
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_header_auto_margin_top_off',
			array(
				'type' => 'switch',
				'label' => esc_html__('Disable Header Auto Margin','industrie'),
				'description' => esc_html__('You can disable or header auto margin for transparent here','industrie'),
				'section' => 'industrie_general_section'
			)
		)
	);
	// Header Auto Margin Off End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_8', 
			array(
				'settings'		=> 'separator_8',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start favicon
	$industrie_customizer->add_setting(
		'industrie_favicon', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_favicon',
			array(
			'label'      => esc_html__( 'Upload Favicon', 'industrie' ),
			'section'    => 'industrie_general_section',
			'settings'   => 'industrie_favicon',
			)
		)   
	);
	//End favicon

	//Start separator
	$industrie_customizer->add_setting(
		'separator_10', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_10', 
			array(
				'settings'		=> 'separator_10',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Show off Canvas
	$industrie_customizer->add_setting( 'industrie_enable_go_to_top', 
	array(
		'default'    => '0',
		) 
	);
	
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_enable_go_to_top',
			array(
				'type' => 'switch',
				'label' => esc_html__('Go to Top','industrie'),
				'description' => esc_html__('You can show or hide here','industrie'),
				'section' => 'industrie_general_section'
			)
		)
	);
	//End Show off Canvas


	//Start Go to Top Background Color
	$industrie_customizer->add_setting (
        'industrie_scroll_top_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_scroll_top_bg_color',
            array(
                'label'      => esc_html__('Go to Top Background Color','industrie'),
                'section'    => 'industrie_general_section',
                'settings'   => 'industrie_scroll_top_bg_color',
            )
        )
    );
	//End Go to Top Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'separator_11', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_11', 
			array(
				'settings'		=> 'separator_11',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Go to Top Background Color
	$industrie_customizer->add_setting (
        'industrie_scroll_top__color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_scroll_top__color',
            array(
                'label'      => esc_html__('Go to Top Color','industrie'),
                'section'    => 'industrie_general_section',
                'settings'   => 'industrie_scroll_top__color',
            )
        )
    );
	//End Go to Top Background Color


	//Start separator
	$industrie_customizer->add_setting(
		'separator_13', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_13', 
			array(
				'settings'		=> 'separator_13',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Go to Top Background Color
	$industrie_customizer->add_setting (
        'industrie_scroll_top_bg_color_hover'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_scroll_top_bg_color_hover',
            array(
                'label'      => esc_html__('Go to Top Background Color (Hover)','industrie'),
                'section'    => 'industrie_general_section',
                'settings'   => 'industrie_scroll_top_bg_color_hover',
            )
        )
    );
	//End Go to Top Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'separator_12', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_12', 
			array(
				'settings'		=> 'separator_12',
				'section'  		=> 'industrie_general_section',
			)
		)
	);
	//End separator

	//Start Go to Top Background Color
	$industrie_customizer->add_setting (
        'industrie_scroll_top__color_hover'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_scroll_top__color_hover',
            array(
                'label'      => esc_html__('Go to Top Color (Hover)','industrie'),
                'section'    => 'industrie_general_section',
                'settings'   => 'industrie_scroll_top__color_hover',
            )
        )
    );
	//End Go to Top Background Color
}
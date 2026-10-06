<?php
function industrie_page_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_page_setting' , array(
        'title'      => esc_html__( 'Page Setting', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	//Start
	$industrie_customizer->add_setting(
		'industrie_page_default_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_page_default_logo',
			array(
			'label'      => esc_html__( 'Upload Page Logo', 'industrie' ),
			'section'    => 'industrie_page_setting',
			'settings'   => 'industrie_page_default_logo',
			)
		)   
	);
	//End

	//Start Sticky Menu
	$industrie_customizer->add_setting( 'industrie_page_enable_sticky_menu', 
	array(
			'default'    => '0',
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_page_enable_sticky_menu',
			array(
				'type' => 'switch',
				'label' => esc_html__('Sticky Menu','industrie'),
				'description' => esc_html__('You can show or hide sticky menu here','industrie'),
				'section' => 'industrie_page_setting'
			)
		)
	);
	//End Sticky Menu

	//Start
    $industrie_customizer->add_setting(
        'industrie_page_header_menu_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_header_menu_bg_color',
            array(
                'label' => esc_html__('Header Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_page_setting',
                'settings' => 'industrie_page_header_menu_bg_color',
            )
        )
    );
    //End

	//Start
    $industrie_customizer->add_setting(
        'industrie_page_header_menu_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_header_menu_color',
            array(
                'label' => esc_html__('Header Menu Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_page_setting',
                'settings' => 'industrie_page_header_menu_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'page_hr_0', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'page_hr_0', 
			array(
				'settings'		=> 'page_hr_0',
				'section'  		=> 'industrie_page_setting',
			)
		)
	);
	//End separator

	//Start
    $industrie_customizer->add_setting(
        'industrie_page_header_menu_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_header_menu_hover_color',
            array(
                'label' => esc_html__('Header Menu Hover Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_page_setting',
                'settings' => 'industrie_page_header_menu_hover_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'page_hr_1', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'page_hr_1', 
			array(
				'settings'		=> 'page_hr_1',
				'section'  		=> 'industrie_page_setting',
			)
		)
	);
	//End separator

	//Start
    $industrie_customizer->add_setting(
        'industrie_page_header_menu_active_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_header_menu_active_color',
            array(
                'label' => esc_html__('Header Menu Active Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_page_setting',
                'settings' => 'industrie_page_header_menu_active_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'page_hr_2', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'page_hr_2', 
			array(
				'settings'		=> 'page_hr_2',
				'section'  		=> 'industrie_page_setting',
			)
		)
	);
	//End separator

	//Start Color
	$industrie_customizer->add_setting (
        'industrie_page_sign_in_text_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_sign_in_text_color',
            array(
                'label'      => esc_html__('Text Color','industrie'),
                'description'      => esc_html__('Select Text Color','industrie'),
                'section'    => 'industrie_page_setting',
                'settings'   => 'industrie_page_sign_in_text_color',
            )
        )
    );
	//End Color

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_page_sign_in_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_sign_in_text_hover_color',
            array(
                'label'      => esc_html__('Hover Color','industrie'),
                'description'      => esc_html__('Select Hover Color','industrie'),
                'section'    => 'industrie_page_setting',
                'settings'   => 'industrie_page_sign_in_text_hover_color',
            )
        )
    );
	//End Color

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_page_download_border_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_download_border_color',
            array(
                'label'      => esc_html__('Button Border Color','industrie'),
                'description'      => esc_html__('Select Button Border Color','industrie'),
                'section'    => 'industrie_page_setting',
                'settings'   => 'industrie_page_download_border_color',
            )
        )
    );
	//End Color

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_page_download_text_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_download_text_color',
            array(
                'label'      => esc_html__('Button Link Color','industrie'),
                'description'      => esc_html__('Select text Color','industrie'),
                'section'    => 'industrie_page_setting',
                'settings'   => 'industrie_page_download_text_color',
            )
        )
    );
	//End Color

    //Start Color
    $industrie_customizer->add_setting (
        'industrie_page_download_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_download_text_hover_color',
            array(
                'label'      => esc_html__('Button Link Hover Color','industrie'),
                'description'      => esc_html__('Select Text Hover Color','industrie'),
                'section'    => 'industrie_page_setting',
                'settings'   => 'industrie_page_download_text_hover_color',
            )
        )
    );
    //End Color

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_page_download_btn_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_page_download_btn_hover_color',
            array(
                'label'      => esc_html__('Button Hover Color','industrie'),
                'description'      => esc_html__('Select Button Hover Color','industrie'),
                'section'    => 'industrie_page_setting',
                'settings'   => 'industrie_page_download_btn_hover_color',
            )
        )
    );
	//End Color
}
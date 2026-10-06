<?php
function industrie_header_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_header_setting' , array(
        'title'      => esc_html__( 'Header Settings', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	//Start
    $industrie_customizer->add_setting(
        'industrie_header_sign_in_text',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_header_sign_in_text', array(
        'section' => 'industrie_header_setting',
        'label'   => esc_html__('Sign In', 'industrie'),
        'type'    => 'text',
        'setting' => 'industrie_header_sign_in_text',
    ));
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_0', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_0', 
			array(
				'settings'		=> 'header_hr_0',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$industrie_customizer->add_setting (
        'industrie_header_sign_in_text_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_header_sign_in_text_color',
            array(
                'label'       => esc_html__('Text Color','industrie'),
                'description' => esc_html__('Select Text Color','industrie'),
                'section'     => 'industrie_header_setting',
                'settings'    => 'industrie_header_sign_in_text_color',
            )
        )
    );
	//End Color

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_1', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_1', 
			array(
				'settings'		=> 'header_hr_1',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$industrie_customizer->add_setting (
        'industrie_header_sign_in_text_hover_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_header_sign_in_text_hover_color',
            array(
                'label'       => esc_html__('Hover Color','industrie'),
                'description' => esc_html__('Select Hover Color','industrie'),
                'section'     => 'industrie_header_setting',
                'settings'    => 'industrie_header_sign_in_text_hover_color',
            )
        )
    );
	//End Color

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_2', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_2', 
			array(
				'settings'		=> 'header_hr_2',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start
    $industrie_customizer->add_setting(
        'industrie_header_sign_in_link',
        array(
			'default' => esc_html__( '#', 'industrie' ),
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_header_sign_in_link', array(
        'section' => 'industrie_header_setting',
        'label'   => esc_html__('Sign In Link', 'industrie'),
        'type'    => 'text',
        'setting' => 'industrie_header_sign_in_link',
    ));
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_3', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_3', 
			array(
				'settings'		=> 'header_hr_3',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting( 'industrie_header_sign_in_link_new_tab', 
	array(
		'default'    => '1',
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_header_sign_in_link_new_tab',
			array(
				'type'        => 'switch',
				'label'       => esc_html__('Open New Tab','industrie'),
				'description' => esc_html__('Open the link document in a new window or tab','industrie'),
				'section'     => 'industrie_header_setting'
			)
		)
	);
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_4', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_4', 
			array(
				'settings'		=> 'header_hr_4',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start
    $industrie_customizer->add_setting(
        'industrie_header_download_text',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_header_download_text', array(
        'section' => 'industrie_header_setting',
        'label'   => esc_html__('Download', 'industrie'),
        'type'    => 'text',
        'setting' => 'industrie_header_download_text',
    ));
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_5', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_5', 
			array(
				'settings'		=> 'header_hr_5',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$industrie_customizer->add_setting (
        'industrie_header_download_border_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_header_download_border_color',
            array(
                'label'      => esc_html__('Border Color','industrie'),
                'description'      => esc_html__('Select Button Border Color','industrie'),
                'section'    => 'industrie_header_setting',
                'settings'   => 'industrie_header_download_border_color',
            )
        )
    );
	//End Color

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_6', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_6', 
			array(
				'settings'		=> 'header_hr_6',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$industrie_customizer->add_setting (
        'industrie_header_download_text_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_header_download_text_color',
            array(
                'label'      => esc_html__('Text Color','industrie'),
                'description'      => esc_html__('Select text Color','industrie'),
                'section'    => 'industrie_header_setting',
                'settings'   => 'industrie_header_download_text_color',
            )
        )
    );
	//End Color

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_7', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_7', 
			array(
				'settings'		=> 'header_hr_7',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$industrie_customizer->add_setting (
        'industrie_header_download_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_header_download_text_hover_color',
            array(
                'label'      => esc_html__('Text Hover Color','industrie'),
                'description'      => esc_html__('Select Text Hover Color','industrie'),
                'section'    => 'industrie_header_setting',
                'settings'   => 'industrie_header_download_text_hover_color',
            )
        )
    );
	//End Color

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_8', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_8', 
			array(
				'settings'		=> 'header_hr_8',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$industrie_customizer->add_setting (
        'industrie_header_download_btn_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_header_download_btn_hover_color',
            array(
                'label'      => esc_html__('Button Hover Color','industrie'),
                'description'      => esc_html__('Select Button Hover Color','industrie'),
                'section'    => 'industrie_header_setting',
                'settings'   => 'industrie_header_download_btn_hover_color',
            )
        )
    );
	//End Color

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_9', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_9', 
			array(
				'settings'		=> 'header_hr_9',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start
    $industrie_customizer->add_setting(
        'industrie_header_download_link',
        array(
            'default' => esc_html__( '#', 'industrie' ),
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_header_download_link', array(
        'section' => 'industrie_header_setting',
        'label' => esc_html__('Download Link', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_header_download_link',
    ));
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_10', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_10', 
			array(
				'settings'		=> 'header_hr_10',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Show Top Bar
	$industrie_customizer->add_setting( 'industrie_header_download_link_new_tab', 
	array(
		'default'    => '1',
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_header_download_link_new_tab',
			array(
				'type' => 'switch',
				'label' => esc_html__('Open New Tab','industrie'),
				'description' => esc_html__('Open the link document in a new window or tab','industrie'),
				'section' => 'industrie_header_setting'
			)
		)
	);
	//End Show Top Bar

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_11', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_11', 
			array(
				'settings'		=> 'header_hr_11',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Meta Text Alignment
	$industrie_customizer->add_setting( 'industrie_header_width', array(
		'default'           => 'container',
		'transport'	        => 'postMessage',
	) );
	$industrie_customizer->add_control( 'industrie_header_width', array(
		'label'   => esc_html__( 'Header Area Width', 'industrie' ),
		'section' => 'industrie_header_setting',
		'type'    => 'select',
		'choices' => array(
			'container' => esc_html__( 'Container', 'industrie' ),
			'container-fluid' => esc_html__( 'Container Fluid', 'industrie' ),
			),
	));
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'header_hr_12', 
		array(
			'default'           => '',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'header_hr_12', 
			array(
				'settings'		=> 'header_hr_12',
				'section'  		=> 'industrie_header_setting',
			)
		)
	);
	//End separator

	//Start Header Bg Color
	$industrie_customizer->add_setting (
        'industrie_style_header_bg_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_style_header_bg_color',
            array(
                'label'      => esc_html__('Header Bg Color','industrie'),
                'description'      => esc_html__('Select Header Bg Color','industrie'),
                'section'    => 'industrie_header_setting',
                'settings'   => 'industrie_style_header_bg_color',
            )
        )
    );
	//End Header Bg Color
}
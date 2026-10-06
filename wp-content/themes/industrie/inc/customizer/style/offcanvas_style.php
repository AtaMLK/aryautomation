<?php
function industrie_offcanvas_style_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_offcanvas_setting' , array(
        'title'      => esc_html__( 'Offcanvas Settings', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	//Start enabal
    $industrie_customizer->add_setting('industrie_enable_offcanvas',
		array(
			'default' => 0
		)
    );
    $industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_enable_offcanvas',
			array(
				'type' => 'switch',
				'label' => esc_html__('Show OFF Canvas', 'industrie'),
				'description' => esc_html__('You can show or hide offcanvas', 'industrie'),
				'section' => 'industrie_offcanvas_setting',
			)
		)
    );
    //End enabal

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_00', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_00', 
			array(
				'settings'		=> 'offcanvas_hr_00',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start default header logo
	$industrie_customizer->add_setting(
		'industrie_offcanvas_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_offcanvas_logo',
			array(
			'label'      => esc_html__( 'Offcanvas Logo', 'industrie' ),
			'section'    => 'industrie_offcanvas_setting',
			'settings'   => 'industrie_offcanvas_logo',
			)
		)   
	);
	//End default logo

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_0', 
			array(
				'settings'		=> 'offcanvas_hr_0',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start container size
    $industrie_customizer->add_setting(
        'industrie_offcanvas_logo_height',
        array(
			'default'   => '50px',
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_offcanvas_logo_height', array(
        'section'     => 'industrie_offcanvas_setting',
        'label'       => esc_html__('Logo Height', 'industrie'),
        'description' => esc_html__('Logo max height example(50px)', 'industrie'),
        'type'        => 'text',
        'setting'     => 'industrie_offcanvas_logo_height',
    ));
    //End container size

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_1', 
			array(
				'settings'		=> 'offcanvas_hr_1',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Email Address
    $industrie_customizer->add_setting(
        'industrie_offcanvas_email_address',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_offcanvas_email_address', array(
        'section'     => 'industrie_offcanvas_setting',
        'label'       => esc_html__('Email Address', 'industrie'),
        'description' => esc_html__('Offcanvas email address', 'industrie'),
        'type'        => 'text',
        'setting'     => 'industrie_offcanvas_email_address',
    ));
    //End Email Address

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_email', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_email', 
			array(
				'settings'		=> 'offcanvas_hr_email',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Phone Number
    $industrie_customizer->add_setting(
        'industrie_offcanvas_phone_number',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_offcanvas_phone_number', array(
        'section'     => 'industrie_offcanvas_setting',
        'label'       => esc_html__('Phone Number', 'industrie'),
        'description' => esc_html__('Offcanvas phone number', 'industrie'),
        'type'        => 'text',
        'setting'     => 'industrie_offcanvas_phone_number',
    ));
    //End Phone Number

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_phone', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_phone', 
			array(
				'settings'		=> 'offcanvas_hr_phone',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Address
	$industrie_customizer->add_setting('industrie_offcanvas_address', array(
		'transport'		=> 'refresh',
	));
	$industrie_customizer->add_control('industrie_offcanvas_address', array(
		'section'	    => 'industrie_offcanvas_setting',
		'label'			=> esc_html__( 'Address', 'industrie' ),
		'description'	=> esc_html__('Offcanvas address', 'industrie'),
		'type'		    => 'textarea',
		'setting'	    => 'industrie_offcanvas_address'	
	));
	//End Address

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_address', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_address', 
			array(
				'settings'		=> 'offcanvas_hr_address',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_offcanvas_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_offcanvas_bg_color',
            array(
                'label'       => esc_html__('Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_offcanvas_setting',
                'settings'    => 'industrie_offcanvas_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_3', 
			array(
				'settings'		=> 'offcanvas_hr_3',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_offcanvas_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_offcanvas_text_color',
            array(
                'label'       => esc_html__('Text Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_offcanvas_setting',
                'settings'    => 'industrie_offcanvas_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_2', 
			array(
				'settings'		=> 'offcanvas_hr_2',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_offcanvas_social_icon_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_offcanvas_social_icon_color',
            array(
                'label'       => esc_html__('Social Icon Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_offcanvas_setting',
                'settings'    => 'industrie_offcanvas_social_icon_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_4', 
			array(
				'settings'		=> 'offcanvas_hr_4',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
	$industrie_customizer->add_setting(
		'industrie_offcanvas_button_color'
	);
	$industrie_customizer->add_control(
		new WP_Customize_Color_Control(
			$industrie_customizer,
			'industrie_offcanvas_button_color',
			array(
				'label'       => esc_html__('Social Button Color', 'industrie'),
				'description' => esc_html__('Pick color', 'industrie'),
				'section'     => 'industrie_offcanvas_setting',
				'settings'    => 'industrie_offcanvas_button_color',
			)
		)
	);
	//End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_5', 
			array(
				'settings'		=> 'offcanvas_hr_5',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_offcanvas_button_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_offcanvas_button_hover_color',
            array(
                'label'       => esc_html__('Button hover Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_offcanvas_setting',
                'settings'    => 'industrie_offcanvas_button_hover_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_6', 
			array(
				'settings'		=> 'offcanvas_hr_6',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_offcanvas_hamburger_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_offcanvas_hamburger_bg_color',
            array(
                'label'       => esc_html__('Hamburger Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_offcanvas_setting',
                'settings'    => 'industrie_offcanvas_hamburger_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_7', 
			array(
				'settings'		=> 'offcanvas_hr_7',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_offcanvas_hamburger_icon_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_offcanvas_hamburger_icon_color',
            array(
                'label'       => esc_html__('Hamburger Icon Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_offcanvas_setting',
                'settings'    => 'industrie_offcanvas_hamburger_icon_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'offcanvas_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'offcanvas_hr_8', 
			array(
				'settings'		=> 'offcanvas_hr_8',
				'section'  		=> 'industrie_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_offcanvas_hamburger_clode_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_offcanvas_hamburger_clode_color',
            array(
                'label'       => esc_html__('Hamburger Close Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_offcanvas_setting',
                'settings'    => 'industrie_offcanvas_hamburger_clode_color',
            )
        )
    );
    //End Body Background Color
}
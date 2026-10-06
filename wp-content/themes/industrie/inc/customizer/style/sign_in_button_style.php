<?php
function industrie_sign_in_button_style_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_sign_in_button_setting' , array(
        'title'      => esc_html__( 'Sign In Button Style', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sign_in_button_bg_color',
            array(
                'label' => esc_html__('Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sign_in_button_setting',
                'settings' => 'industrie_sign_in_button_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_0', 
			array(
				'settings'		=> 'button_hr_0',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_border_color_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sign_in_button_border_color_color',
            array(
                'label' => esc_html__('Border Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sign_in_button_setting',
                'settings' => 'industrie_sign_in_button_border_color_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_1', 
			array(
				'settings'		=> 'button_hr_1',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_icon_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sign_in_button_icon_bg_color',
            array(
                'label' => esc_html__('Icon Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sign_in_button_setting',
                'settings' => 'industrie_sign_in_button_icon_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_2', 
			array(
				'settings'		=> 'button_hr_2',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_hover_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sign_in_button_hover_bg_color',
            array(
                'label' => esc_html__('Hover Background', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sign_in_button_setting',
                'settings' => 'industrie_sign_in_button_hover_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_3', 
			array(
				'settings'		=> 'button_hr_3',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_hover_border_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sign_in_button_hover_border_color',
            array(
                'label' => esc_html__('Hover Border Colo', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sign_in_button_setting',
                'settings' => 'industrie_sign_in_button_hover_border_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_4', 
			array(
				'settings'		=> 'button_hr_4',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sign_in_button_text_color',
            array(
                'label' => esc_html__('Text Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sign_in_button_setting',
                'settings' => 'industrie_sign_in_button_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_5', 
			array(
				'settings'		=> 'button_hr_5',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_hover_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sign_in_button_hover_text_color',
            array(
                'label' => esc_html__('Hover Text Colo', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sign_in_button_setting',
                'settings' => 'industrie_sign_in_button_hover_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_6', 
			array(
				'settings'		=> 'button_hr_6',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start container size
    $industrie_customizer->add_setting(
        'industrie_sign_in_button_border_radius',
        array(
			'default'           => '62px',
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_sign_in_button_border_radius', array(
        'section' => 'industrie_sign_in_button_setting',
        'label' => esc_html__('Button Border Radius', 'industrie'),
        'description' => esc_html__('Border Radius example(5px)', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_sign_in_button_border_radius',
    ));
    //End container size

	//Start separator
	$industrie_customizer->add_setting(
		'button_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_hr_7', 
			array(
				'settings'		=> 'button_hr_7',
				'section'  		=> 'industrie_sign_in_button_setting',
			)
		)
	);
	//End separator
}
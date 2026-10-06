<?php
function industrie_button_style_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_button_setting' , array(
        'title'      => esc_html__( 'Button Settings', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	//Start Background Color
    $industrie_customizer->add_setting(
        'industrie_button_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_button_bg_color',
            array(
                'label' => esc_html__('Button Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_button_setting',
                'settings' => 'industrie_button_bg_color',
            )
        )
    );
    //End Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_style_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_style_hr_0', 
			array(
				'settings'		=> 'button_style_hr_0',
				'section'  		=> 'industrie_button_setting',
			)
		)
	);
	//End separator

	//Start Background Color
    $industrie_customizer->add_setting(
        'industrie_button_bg_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_button_bg_hover_color',
            array(
                'label' => esc_html__('Button Hover Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_button_setting',
                'settings' => 'industrie_button_bg_hover_color',
            )
        )
    );
    //End Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_style_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_style_hr_1', 
			array(
				'settings'		=> 'button_style_hr_1',
				'section'  		=> 'industrie_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_button_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_button_text_color',
            array(
                'label' => esc_html__('Button Text Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_button_setting',
                'settings' => 'industrie_button_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_style_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_style_hr_2', 
			array(
				'settings'		=> 'button_style_hr_2',
				'section'  		=> 'industrie_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_button_hover_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_button_hover_text_color',
            array(
                'label' => esc_html__('Button Text Hover Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_button_setting',
                'settings' => 'industrie_button_hover_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'button_style_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'button_style_hr_3', 
			array(
				'settings'		=> 'button_style_hr_3',
				'section'  		=> 'industrie_button_setting',
			)
		)
	);
	//End separator

	//Start container size
    $industrie_customizer->add_setting(
        'industrie_button_border_radius',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_button_border_radius', array(
        'section' => 'industrie_button_setting',
        'label' => esc_html__('Button Border Radius', 'industrie'),
        'description' => esc_html__('Border Radius example(5px)', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_button_border_radius',
    ));
    //End container size
}
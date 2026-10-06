<?php
function industrie_mouse_pointer_panel($industrie_customizer, $priority)
{
    $industrie_customizer->add_section('industrie_mouse_pt_setting', array(
        'title' => esc_html__('Mouse Pointer Setting', 'industrie'),
        'priority' => $priority,
        'panel' => 'industrie_options_panel',
    ));

    //Start enabal global setting
    $industrie_customizer->add_setting('industrie_mouse_pt_enabel_pointer',
        array(
            'default' => '1',
            'sanitize_callback' => 'industrie_sanitize_integer',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Customize_Switch_Control(
            $industrie_customizer,
            'industrie_mouse_pt_enabel_pointer',
            array(
                'type' => 'switch',
                'label' => esc_html__('Show Pointer', 'industrie'),
                'description' => esc_html__('You can show or hide Mouse Pointer', 'industrie'),
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End enabal global setting

    //Start separator
    $industrie_customizer->add_setting(
        'mouse_pt_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'mouse_pt_hr_0',
            array(
                'settings' => 'mouse_pt_hr_0',
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_mouse_pt_pointer_border_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_mouse_pt_pointer_border_color',
            array(
                'label' => esc_html__('Pointer Border', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_mouse_pt_setting',
                'settings' => 'industrie_mouse_pt_pointer_border_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'mouse_pt_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'mouse_pt_hr_1',
            array(
                'settings' => 'mouse_pt_hr_1',
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End separator

	//Start container size
    $industrie_customizer->add_setting(
        'industrie_mouse_pt_border_width',
        array(
            'default' => esc_html__('2', 'industrie'),
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_mouse_pt_border_width', array(
        'section' => 'industrie_mouse_pt_setting',
        'label' => esc_html__('Border Width', 'industrie'),
        'description' => esc_html__('Enter Pointer Border Width', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_mouse_pt_border_width',
    ));
    //End container size

    //Start separator
    $industrie_customizer->add_setting(
        'mouse_pt_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'mouse_pt_hr_2',
            array(
                'settings' => 'mouse_pt_hr_2',
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_mouse_pt_pointer_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_mouse_pt_pointer_bg_color',
            array(
                'label' => esc_html__('Pointer Background', 'industrie'),
                'description' => esc_html__('Enter Pointer Background color', 'industrie'),
                'section' => 'industrie_mouse_pt_setting',
                'settings' => 'industrie_mouse_pt_pointer_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'mouse_pt_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'mouse_pt_hr_4',
            array(
                'settings' => 'mouse_pt_hr_4',
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End separator	

	//Start container size
	$industrie_customizer->add_setting(
		'industrie_mouse_pt_diameter',
		array(
			'default' => esc_html__('40', 'industrie'),
			'transport' => 'refresh',
		)
	);

	$industrie_customizer->add_control('industrie_mouse_pt_diameter', array(
		'section' => 'industrie_mouse_pt_setting',
		'label' => esc_html__('Diameter', 'industrie'),
		'description' => esc_html__('Enter Pointer diameter Size', 'industrie'),
		'type' => 'text',
		'setting' => 'industrie_mouse_pt_diameter',
	));
	//End container size

    //Start separator
    $industrie_customizer->add_setting(
        'mouse_pt_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'mouse_pt_hr_5',
            array(
                'settings' => 'mouse_pt_hr_5',
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End separator	

	//Start container size
    $industrie_customizer->add_setting(
        'industrie_mouse_pt_pointer_speed',
        array(
            'default' => esc_html__('4', 'industrie'),
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_mouse_pt_pointer_speed', array(
        'section' => 'industrie_mouse_pt_setting',
        'label' => esc_html__('Pointer Speed', 'industrie'),
        'description' => esc_html__('Enter Pointer Scale Size', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_mouse_pt_pointer_speed',
    ));
    //End container size

    //Start separator
    $industrie_customizer->add_setting(
        'mouse_pt_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'mouse_pt_hr_6',
            array(
                'settings' => 'mouse_pt_hr_6',
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End separator

	//Start container size
    $industrie_customizer->add_setting(
        'industrie_mouse_pt_hover_scale',
        array(
            'default' => esc_html__('1.3', 'industrie'),
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_mouse_pt_hover_scale', array(
        'section' => 'industrie_mouse_pt_setting',
        'label' => esc_html__('Hover Scale', 'industrie'),
        'description' => esc_html__('Enter Pointer Scale Size', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_mouse_pt_hover_scale',
    ));
    //End container size

    //Start separator
    $industrie_customizer->add_setting(
        'mouse_pt_hr_7',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'mouse_pt_hr_7',
            array(
                'settings' => 'mouse_pt_hr_7',
                'section' => 'industrie_mouse_pt_setting',
            )
        )
    );
    //End separator

}

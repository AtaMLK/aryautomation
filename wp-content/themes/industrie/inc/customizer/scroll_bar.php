<?php
function industrie_scroll_bar_panel($industrie_customizer, $priority)
{
    $industrie_customizer->add_section('industrie_scroll_bar_setting', array(
        'title'    => esc_html__('Scroll Bar Setting', 'industrie'),
        'priority' => $priority,
        'panel'    => 'industrie_options_panel',
    ));

    //Start enabal global setting
    $industrie_customizer->add_setting('industrie_scroll_bar_enabel',
        array(
            'default' => '1',
            'sanitize_callback' => 'industrie_sanitize_integer',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Customize_Switch_Control(
            $industrie_customizer,
            'industrie_scroll_bar_enabel',
            array(
                'type'        => 'switch',
                'label'       => esc_html__('Show ScrollBar', 'industrie'),
                'description' => esc_html__('You can show or hide ScrollBar', 'industrie'),
                'section'     => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End enabal global setting

    //Start separator
    $industrie_customizer->add_setting(
        'scroll_bar_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'scroll_bar_hr_0',
            array(
                'settings' => 'scroll_bar_hr_0',
                'section'  => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_scroll_bar_color',
        array(
            'default' => '#6722B5',
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_scroll_bar_color',
            array(
                'label'       => esc_html__('ScrollBar Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section'     => 'industrie_scroll_bar_setting',
                'settings'    => 'industrie_scroll_bar_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'scroll_bar_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'scroll_bar_hr_1',
            array(
                'settings' => 'scroll_bar_hr_1',
                'section'  => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_scroll_bar_rail_bg',
        array(
            'default' => '#000000',
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_scroll_bar_rail_bg',
            array(
                'label'       => esc_html__('Rail Background', 'industrie'),
                'description' => esc_html__('Enter Rail Background color', 'industrie'),
                'section'     => 'industrie_scroll_bar_setting',
                'settings'    => 'industrie_scroll_bar_rail_bg',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'scroll_bar_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'scroll_bar_hr_3',
            array(
                'settings' => 'scroll_bar_hr_3',
                'section'  => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $industrie_customizer->add_setting(
        'industrie_scroll_bar_cursor_width',
        array(
            'default' => esc_html__('14', 'industrie'),
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_scroll_bar_cursor_width', array(
        'section'     => 'industrie_scroll_bar_setting',
        'label'       => esc_html__('Cursor Width', 'industrie'),
        'description' => esc_html__('Enter Cursor Width', 'industrie'),
        'type'        => 'text',
        'setting'     => 'industrie_scroll_bar_cursor_width',
    ));
    //End container size

    //Start separator
    $industrie_customizer->add_setting(
        'scroll_bar_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'scroll_bar_hr_4',
            array(
                'settings' => 'scroll_bar_hr_4',
                'section' => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $industrie_customizer->add_setting(
        'industrie_scroll_bar_cursor_min_width',
        array(
            'default' => esc_html__('120', 'industrie'),
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_scroll_bar_cursor_min_width', array(
        'section'     => 'industrie_scroll_bar_setting',
        'label'       => esc_html__('Cursor Min Height', 'industrie'),
        'description' => esc_html__('Enter Cursor Min Height', 'industrie'),
        'type'        => 'text',
        'setting'     => 'industrie_scroll_bar_cursor_min_width',
    ));
    //End container size

    //Start separator
    $industrie_customizer->add_setting(
        'scroll_bar_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'scroll_bar_hr_5',
            array(
                'settings' => 'scroll_bar_hr_5',
                'section' => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $industrie_customizer->add_setting(
        'industrie_scroll_bar_cursor_scroll_speed',
        array(
            'default' => esc_html__('60', 'industrie'),
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_scroll_bar_cursor_scroll_speed', array(
        'section'     => 'industrie_scroll_bar_setting',
        'label'       => esc_html__('Scroll Speed', 'industrie'),
        'description' => esc_html__('Enter Scroll Speed', 'industrie'),
        'type'        => 'text',
        'setting'     => 'industrie_scroll_bar_cursor_scroll_speed',
    ));
    //End container size

    //Start separator
    $industrie_customizer->add_setting(
        'scroll_bar_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'scroll_bar_hr_6',
            array(
                'settings' => 'scroll_bar_hr_6',
                'section' => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $industrie_customizer->add_setting(
        'industrie_scroll_bar_cursor_scroll_step',
        array(
            'default' => esc_html__('110', 'industrie'),
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_scroll_bar_cursor_scroll_step', array(
        'section'     => 'industrie_scroll_bar_setting',
        'label'       => esc_html__('Mouse Scroll Step', 'industrie'),
        'description' => esc_html__('Enter Mouse Scroll Step', 'industrie'),
        'type'        => 'text',
        'setting'     => 'industrie_scroll_bar_cursor_scroll_step',
    ));
    //End container size

    //Start separator
    $industrie_customizer->add_setting(
        'scroll_bar_hr_7',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'scroll_bar_hr_7',
            array(
                'settings' => 'scroll_bar_hr_7',
                'section'  => 'industrie_scroll_bar_setting',
            )
        )
    );
    //End separator

}

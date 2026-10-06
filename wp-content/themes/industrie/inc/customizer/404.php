<?php
function industrie_404_panel($industrie_customizer, $priority)
{
    $industrie_customizer->add_section('industrie_404_setting',
        array(
            'title'       => esc_html__('404 Page Settings', 'industrie'),
            'panel'       => 'industrie_options_panel',
            'priority'    => $priority,
            'capability'  => 'edit_theme_options',
            'description' => esc_html__('Allows you to customize 404 page.', 'industrie'),
        )
    );

    //404
    $industrie_customizer->add_setting('industrie_404_title', array(
        'default'   => esc_html__('404', 'industrie'),
        'transport' => 'refresh',
    ));
    $industrie_customizer->add_control('industrie_404_title', array(
        'label'       => esc_html__('Title', 'industrie'),
        'description' => esc_html__('Enter title for 404 page', 'industrie'),
        'section'     => 'industrie_404_setting',
        'type'        => 'text',
        'setting'     => 'industrie_404_title',
    ));

    //Start separator
    $industrie_customizer->add_setting(
        '404_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            '404_hr_0',
            array(
                'settings' => '404_hr_0',
                'section'  => 'industrie_404_setting',
            )
        )
    );
    //End separator

    //404
    $industrie_customizer->add_setting('industrie_404_text', array(
        'default'   => esc_html__('Page Not Found', 'industrie'),
        'transport' => 'refresh',
    ));
    $industrie_customizer->add_control('industrie_404_text', array(
        'label'       => esc_html__('Text', 'industrie'),
        'description' => esc_html__('Enter text for 404 page', 'industrie'),
        'section'     => 'industrie_404_setting',
        'type'        => 'text',
        'setting'     => 'industrie_404_text',
    ));
    //End

    //Start separator
    $industrie_customizer->add_setting(
        '404_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            '404_hr_1',
            array(
                'settings' => '404_hr_1',
                'section'  => 'industrie_404_setting',
            )
        )
    );
    //End separator

    //404
    $industrie_customizer->add_setting('industrie_404_home_button_label', array(
        'default'   => esc_html__('Back to Homepage', 'industrie'),
        'transport' => 'refresh',
    ));
    $industrie_customizer->add_control('industrie_404_home_button_label', array(
        'label'       => esc_html__('Back to Home Button Label', 'industrie'),
        'description' => esc_html__('Enter label for "Back to Home" button', 'industrie'),
        'section'     => 'industrie_404_setting',
        'type'        => 'text',
        'setting'     => 'industrie_404_home_button_label',
    ));
    //End

    //Start separator
    $industrie_customizer->add_setting(
        '404_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            '404_hr_2',
            array(
                'settings' => '404_hr_2',
                'section'  => 'industrie_404_setting',
            )
        )
    );
    //End separator

    //Start default header logo
    $industrie_customizer->add_setting(
        'industrie_404_page_bg',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Image_Control(
            $industrie_customizer,
            'industrie_404_page_bg',
            array(
                'label'    => esc_html__('Upload 404 Page Bg', 'industrie'),
                'section'  => 'industrie_404_setting',
                'settings' => 'industrie_404_page_bg',
            )
        )
    );
    //End default logo

    //Start separator
    $industrie_customizer->add_setting(
        'team_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'team_hr_3',
            array(
                'settings' => 'team_hr_3',
                'section'  => 'industrie_404_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_404_text_color',
        array(
            'default' => '#FFFFFF',
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_404_text_color',
            array(
                'label'       => esc_html__('Text Color', 'industrie'),
                'description' => esc_html__('Text Color', 'industrie'),
                'section'     => 'industrie_404_setting',
                'settings'    => 'industrie_404_text_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'team_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'team_hr_4',
            array(
                'settings' => 'team_hr_4',
                'section'  => 'industrie_404_setting',
            )
        )
    );
    //End separator

    //Start Color
    $industrie_customizer->add_setting(
        'industrie_404_btn_bg_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_404_btn_bg_color',
            array(
                'label'       => esc_html__('Button Background Color', 'industrie'),
                'description' => esc_html__('choose button background color', 'industrie'),
                'section'     => 'industrie_404_setting',
                'settings'    => 'industrie_404_btn_bg_color',
            )
        )
    );
    //End Color

    //Start separator
    $industrie_customizer->add_setting(
        'team_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'team_hr_5',
            array(
                'settings' => 'team_hr_5',
                'section'  => 'industrie_404_setting',
            )
        )
    );
    //End separator

    //Start Color
    $industrie_customizer->add_setting(
        'industrie_404_btn_text_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_404_btn_text_color',
            array(
                'label'       => esc_html__('Button Text Color', 'industrie'),
                'description' => esc_html__('Choose button text color', 'industrie'),
                'section'     => 'industrie_404_setting',
                'settings'    => 'industrie_404_btn_text_color',
            )
        )
    );
    //End Color

    //Start separator
    $industrie_customizer->add_setting(
        'team_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'team_hr_6',
            array(
                'settings' => 'team_hr_6',
                'section'  => 'industrie_404_setting',
            )
        )
    );
    //End separator

}

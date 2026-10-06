<?php
function industrie_sticky_style_panel($industrie_customizer, $priority)
{
    $industrie_customizer->add_section('industrie_sticky_style_setting', array(
        'title' => esc_html__('Sticky Menu Settings', 'industrie'),
        'priority' => $priority,
        'panel' => 'industrie_options_panel',
    ));

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_bg_color',
            array(
                'label' => esc_html__('Sticky Menu Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_0',
            array(
                'label' => esc_html__('Menu', 'industrie'),
                'settings' => 'sticky_menu_hr_0',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_text_color',
            array(
                'label' => esc_html__('Menu Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_text_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_1',
            array(
                'settings' => 'sticky_menu_hr_1',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_text_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_text_hover_color',
            array(
                'label' => esc_html__('Menu Hover Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_text_hover_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_2',
            array(
                'settings' => 'sticky_menu_hr_2',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_text_archive_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_text_archive_color',
            array(
                'label' => esc_html__('Menu Active Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_text_archive_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_3',
            array(
                'settings' => 'sticky_menu_hr_3',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_dropdown_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_dropdown_bg_color',
            array(
                'label' => esc_html__('Dropdown Menu Background Color', 'industrie'),
                'description' => esc_html__('Pick bg color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_dropdown_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_4',
            array(
                'settings' => 'sticky_menu_hr_4',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_dropdown_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_dropdown_text_color',
            array(
                'label' => esc_html__('Dropdown Menu Color', 'industrie'),
                'description' => esc_html__('Pick text color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_dropdown_text_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_5',
            array(
                'settings' => 'sticky_menu_hr_5',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_dropdown_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_dropdown_hover_color',
            array(
                'label' => esc_html__('Dropdown Menu Hover Color', 'industrie'),
                'description' => esc_html__('Pick text color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_dropdown_hover_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_6',
            array(
                'settings' => 'sticky_menu_hr_6',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start
    $industrie_customizer->add_setting(
        'industrie_sticky_menu_dropdown_hover_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_menu_dropdown_hover_bg_color',
            array(
                'label' => esc_html__('Dropdown Menu Hover Background Color', 'industrie'),
                'description' => esc_html__('Pick text color', 'industrie'),
                'section' => 'industrie_sticky_style_setting',
                'settings' => 'industrie_sticky_menu_dropdown_hover_bg_color',
            )
        )
    );
    //End

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_7',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_7',
            array(
                'settings' => 'sticky_menu_hr_7',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_sticky_sign_in_text_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_sign_in_text_color',
            array(
                'label'      => esc_html__('Text Color','industrie'),
                'description'      => esc_html__('Select Text Color','industrie'),
                'section'    => 'industrie_sticky_style_setting',
                'settings'   => 'industrie_sticky_sign_in_text_color',
            )
        )
    );
	//End Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_8',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_8',
            array(
                'settings' => 'sticky_menu_hr_8',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_sticky_sign_in_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_sign_in_text_hover_color',
            array(
                'label'      => esc_html__('Hover Color','industrie'),
                'description'      => esc_html__('Select Hover Color','industrie'),
                'section'    => 'industrie_sticky_style_setting',
                'settings'   => 'industrie_sticky_sign_in_text_hover_color',
            )
        )
    );
	//End Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_9',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_9',
            array(
                'settings' => 'sticky_menu_hr_9',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_sticky_download_border_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_download_border_color',
            array(
                'label'      => esc_html__('Button Border Color','industrie'),
                'description'      => esc_html__('Select Button Border Color','industrie'),
                'section'    => 'industrie_sticky_style_setting',
                'settings'   => 'industrie_sticky_download_border_color',
            )
        )
    );
	//End Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_10',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_10',
            array(
                'settings' => 'sticky_menu_hr_10',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_sticky_download_text_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_download_text_color',
            array(
                'label'      => esc_html__('Button Link Color','industrie'),
                'description'      => esc_html__('Select text Color','industrie'),
                'section'    => 'industrie_sticky_style_setting',
                'settings'   => 'industrie_sticky_download_text_color',
            )
        )
    );
	//End Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_11',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_11',
            array(
                'settings' => 'sticky_menu_hr_11',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
    $industrie_customizer->add_setting (
        'industrie_sticky_download_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_download_text_hover_color',
            array(
                'label'      => esc_html__('Button Link Hover Color','industrie'),
                'description'      => esc_html__('Select Text Hover Color','industrie'),
                'section'    => 'industrie_sticky_style_setting',
                'settings'   => 'industrie_sticky_download_text_hover_color',
            )
        )
    );
    //End Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_12',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_12',
            array(
                'settings' => 'sticky_menu_hr_12',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator
    
    //Start Color
	$industrie_customizer->add_setting (
        'industrie_sticky_download_btn_bg_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_download_btn_bg_color',
            array(
                'label'      => esc_html__('Button Background Color','industrie'),
                'description'      => esc_html__('Select Button Hover Color','industrie'),
                'section'    => 'industrie_sticky_style_setting',
                'settings'   => 'industrie_sticky_download_btn_bg_color',
            )
        )
    );
	//End Color

    //Start separator
    $industrie_customizer->add_setting(
        'sticky_menu_hr_13',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'sticky_menu_hr_13',
            array(
                'settings' => 'sticky_menu_hr_13',
                'section' => 'industrie_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$industrie_customizer->add_setting (
        'industrie_sticky_download_btn_hover_color',
        array(
            'default'     => ''
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_sticky_download_btn_hover_color',
            array(
                'label'      => esc_html__('Button Background Hover Color','industrie'),
                'description'      => esc_html__('Select Button Hover Color','industrie'),
                'section'    => 'industrie_sticky_style_setting',
                'settings'   => 'industrie_sticky_download_btn_hover_color',
            )
        )
    );
	//End Color
}

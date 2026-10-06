<?php
function industrie_portfolio_panel($industrie_customizer, $priority){
    $industrie_customizer->add_section('industrie_portfolio_setting', array(
        'title'    => esc_html__('Portfolio Settings', 'industrie'),
        'priority' => $priority,
        'panel'    => 'industrie_options_panel',
    ));

    //Start enabal
    $industrie_customizer->add_setting('industrie_enable_portfolio_page_banner',
    array(
        'default' => 0
    )
    );
    $industrie_customizer->add_control(
    new industrie_Customize_Switch_Control(
        $industrie_customizer,
        'industrie_enable_portfolio_page_banner',
        array(
            'type'        => 'switch',
            'label'       => esc_html__('Show Portfolio Page Banner', 'industrie'),
            'description' => esc_html__('You can select banner show or hide', 'industrie'),
            'section'     => 'industrie_portfolio_setting',
        )
    )
    );
    //End enabal

    //Start separator
    $industrie_customizer->add_setting(
    'portfolio_hr_00',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $industrie_customizer->add_control(
    new industrie_Separator_Control(
        $industrie_customizer,
        'portfolio_hr_00',
        array(
            'settings' => 'portfolio_hr_00',
            'section' => 'industrie_portfolio_setting',
        )
    )
    );
    //End separator

    //Start enabal
    $industrie_customizer->add_setting('industrie_enable_portfolio_breadcrumb',
    array(
        'default' => 0
    )
    );
    $industrie_customizer->add_control(
    new industrie_Customize_Switch_Control(
        $industrie_customizer,
        'industrie_enable_portfolio_breadcrumb',
        array(
            'type'        => 'switch',
            'label'       => esc_html__('Show Breadcrumb', 'industrie'),
            'description' => esc_html__('You want to show breadcrumb click ON', 'industrie'),
            'section'     => 'industrie_portfolio_setting',
        )
    )
    );
    //End enabal

    //Start separator
    $industrie_customizer->add_setting(
    'portfolio_hr_0',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $industrie_customizer->add_control(
    new industrie_Separator_Control(
        $industrie_customizer,
        'portfolio_hr_0',
        array(
            'settings' => 'portfolio_hr_0',
            'section' => 'industrie_portfolio_setting',
        )
    )
    );
    //End separator

    //Start default header logo
    $industrie_customizer->add_setting(
    'industrie_portfolio_banner_image',
    array(
        'transport' => 'refresh',
    )
    );
    $industrie_customizer->add_control(
    new WP_Customize_Image_Control(
        $industrie_customizer,
        'industrie_portfolio_banner_image',
        array(
            'label'    => esc_html__('Portfolio Single Page Banner Image', 'industrie'),
            'section'  => 'industrie_portfolio_setting',
            'settings' => 'industrie_portfolio_banner_image',
        )
    )
    );
    //End default logo

    //Start separator
    $industrie_customizer->add_setting(
    'portfolio_hr_1',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $industrie_customizer->add_control(
    new industrie_Separator_Control(
        $industrie_customizer,
        'portfolio_hr_1',
        array(
            'settings' => 'portfolio_hr_1',
            'section' => 'industrie_portfolio_setting',
        )
    )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
    'industrie_portfolio_bg_color'
    );
    $industrie_customizer->add_control(
    new WP_Customize_Color_Control(
        $industrie_customizer,
        'industrie_portfolio_bg_color',
        array(
            'label'       => esc_html__('Sinlge Portfolio Body Backgroud Color', 'industrie'),
            'description' => esc_html__('Pick body background color', 'industrie'),
            'section'     => 'industrie_portfolio_setting',
            'settings'    => 'industrie_portfolio_bg_color',
        )
    )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
    'portfolio_hr_2',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $industrie_customizer->add_control(
    new industrie_Separator_Control(
        $industrie_customizer,
        'portfolio_hr_2',
        array(
            'settings' => 'portfolio_hr_2',
            'section' => 'industrie_portfolio_setting',
        )
    )
    );
    //End separator

    //Start Logo Height
    $industrie_customizer->add_setting(
    'industrie_portfolio_banner_title',
    array(
        'transport' => 'refresh',
    )
    );
    $industrie_customizer->add_control('industrie_portfolio_banner_title', array(
    'section' => 'industrie_portfolio_setting',
    'label'   => esc_html__('Portfolio Single Banner Title', 'industrie'),
    'type'    => 'text',
    'setting' => 'industrie_portfolio_banner_title',
    ));
    //End Logo Height

    //Start separator
    $industrie_customizer->add_setting(
    'portfolio_hr_04',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $industrie_customizer->add_control(
    new industrie_Separator_Control(
        $industrie_customizer,
        'portfolio_hr_04',
        array(
            'settings' => 'portfolio_hr_04',
            'section' => 'industrie_portfolio_setting',
        )
    )
    );
    //End separator

    //Start
    $industrie_customizer->add_setting(
    'industrie_portfolio_banner_text',
    array(
        'transport' => 'refresh',
    )
    );
    $industrie_customizer->add_control('industrie_portfolio_banner_text', array(
    'section' => 'industrie_portfolio_setting',
    'label'   => esc_html__('Portfolio Single Banner Text', 'industrie'),
    'type'    => 'textarea',
    'setting' => 'industrie_portfolio_banner_text',
    ));
    //End
}

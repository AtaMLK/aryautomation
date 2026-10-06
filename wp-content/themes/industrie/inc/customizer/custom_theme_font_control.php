<?php
function industrie_custom_fonts_panel($industrie_customizer, $priority)
{
    $industrie_customizer->add_section('industrie_custom_fonts_panel', array(
        'title'    => esc_html__('Custom Fonts Settings', 'industrie'),
        'priority' => $priority,
        'panel'    => 'industrie_options_panel',
    ));

    $font_weight = [
        'normal' => esc_html__('Normal', 'industrie' ),
        '300' => esc_html__('300', 'industrie' ),
        '400' => esc_html__('400', 'industrie' ),
        '500' => esc_html__('500', 'industrie' ),
        '600' => esc_html__('600', 'industrie' ),
        '700' => esc_html__('700', 'industrie' ),
        '800' => esc_html__('800', 'industrie' ),
        '900' => esc_html__('900', 'industrie' ),
    ];

    //Start
    $industrie_customizer->add_setting(
        'industrie_custom_font_file', 
        array(
        'transport'     => 'refresh'
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Upload_Control(
        $industrie_customizer,
        'industrie_custom_font_file',
            array(
            'label'      => esc_html__( 'Upload Body Font Here', 'industrie' ),
            'section'    => 'industrie_custom_fonts_panel',
            'settings'   => 'industrie_custom_font_file',
            )
        )   
    );
    //End

    //Start
    $industrie_customizer->add_setting( 'industrie_custom_body_font_weight', array(
        'default' => 'normal'
    ));

    $industrie_customizer->add_control( 'industrie_custom_body_font_weight', array(
        'type'        => 'select',
        'label'       => esc_html__( 'Font Weight', 'industrie' ),
        'description' => __( 'Select font Weight', 'industrie' ),
        'section'     => 'industrie_custom_fonts_panel',
        'choices'     => $font_weight
    ));
    //End

    //Start separator
    $industrie_customizer->add_setting(
        'separator_1', 
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer, 
            'separator_15', 
            array(
                'settings'      => 'separator_1',
                'section'       => 'industrie_custom_fonts_panel',
            )
        )
    );
    //End separator

    //Start
    $industrie_customizer->add_setting(
        'industrie_title_custom_font_file', 
        array(
        'transport'     => 'refresh'
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Upload_Control(
        $industrie_customizer,
        'industrie_title_custom_font_file',
            array(
            'label'      => esc_html__( 'Upload Heading Font Here', 'industrie' ),
            'section'    => 'industrie_custom_fonts_panel',
            'settings'   => 'industrie_title_custom_font_file',
            )
        )   
    );
    //End

    //Start
    $industrie_customizer->add_setting( 'industrie_custom_title_font_weight', array(
        'default' => 'normal'
    ));
    
    $industrie_customizer->add_control( 'industrie_custom_title_font_weight', array(
        'type'        => 'select',
        'label'       => esc_html__( 'Font Weight', 'industrie' ),
        'description' => __( 'Select font Weight', 'industrie' ),
        'section'     => 'industrie_custom_fonts_panel',
        'choices'     => $font_weight
    ));
    //End
}

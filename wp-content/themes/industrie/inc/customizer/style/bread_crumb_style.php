<?php
function industrie_breadcrumb_style_panel($industrie_customizer, $priority)
{
    $industrie_customizer->add_section('industrie_breadcrumb_style_setting', array(
        'title' => esc_html__('Breadcrumb Settings', 'industrie'),
        'priority' => $priority,
        'panel' => 'industrie_options_panel',
    ));

    //Start Hide
	$industrie_customizer->add_setting( 'industrie_page_hide_banner', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_page_hide_banner',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Banner','industrie'),
				'description' => esc_html__('You can show or hide ','industrie'),
				'section' => 'industrie_breadcrumb_style_setting'
			)
		)
	);
	//End Hide

    //Start separator
    $industrie_customizer->add_setting(
        'breadcrumb_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'breadcrumb_hr_0',
            array(
                'settings' => 'breadcrumb_hr_0',
                'section' => 'industrie_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Hide
	$industrie_customizer->add_setting( 'industrie_page_hide_breadcrumb', 
	array(
		'default'    => 0,
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_page_hide_breadcrumb',
			array(
				'type' => 'switch',
				'label' => esc_html__('Show Breadcrumb','industrie'),
				'description' => esc_html__('You want to show breadcrumb click ON','industrie'),
				'section' => 'industrie_breadcrumb_style_setting'
			)
		)
	);
	//End Hide

    //Start separator
    $industrie_customizer->add_setting(
        'breadcrumb_hr_110',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'breadcrumb_hr_110',
            array(
                'settings' => 'breadcrumb_hr_110',
                'section' => 'industrie_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $industrie_customizer->add_setting(
        'industrie_breadcrumb_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_breadcrumb_bg_color',
            array(
                'label' => esc_html__('Backgroud Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_breadcrumb_style_setting',
                'settings' => 'industrie_breadcrumb_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $industrie_customizer->add_setting(
        'breadcrumb_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'breadcrumb_hr_1',
            array(
                'settings' => 'breadcrumb_hr_1',
                'section' => 'industrie_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start default Page Banner
	$industrie_customizer->add_setting(
		'industrie_page_banner', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_page_banner',
			array(
			'label'      => esc_html__( 'Page Banner', 'industrie' ),
			'section'    => 'industrie_breadcrumb_style_setting',
			'settings'   => 'industrie_page_banner',
			)
		)   
	);
	//End default Page Banner

    //Start separator
    $industrie_customizer->add_setting(
        'breadcrumb_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'breadcrumb_hr_2',
            array(
                'settings' => 'breadcrumb_hr_2',
                'section' => 'industrie_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Blog Page Custom Title
	$industrie_customizer->add_setting(
		'industrie_page_custom_title',
		array(
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('industrie_page_custom_title', array(
        'section'	=> 'industrie_breadcrumb_style_setting',
        'label'		=> esc_html__( 'Page Custom Title', 'industrie' ),
        'description' => esc_html__( 'Enter Page Title Here', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_page_custom_title'
    ));
	//End Blog Page Custom Title

    //Start separator
    $industrie_customizer->add_setting(
        'breadcrumb_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'breadcrumb_hr_3',
            array(
                'settings' => 'breadcrumb_hr_3',
                'section' => 'industrie_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Blog Page Custom Description
	$industrie_customizer->add_setting(
		'industrie_page_custom_description',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $industrie_customizer->add_control('industrie_page_custom_description', array(
        'section'	=> 'industrie_breadcrumb_style_setting',
        'label'		=> esc_html__( 'Page Banner Description', 'industrie' ),
        'description' => esc_html__( 'Enter Page Description Here', 'industrie' ),
        'type'		=> 'textarea',
        'setting'	=> 'industrie_page_custom_description'
    ));
	//End Blog Page Custom Description

}

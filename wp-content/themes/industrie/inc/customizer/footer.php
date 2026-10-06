<?php
function industrie_footer_panel( $industrie_customizer, $prioriity ){
    $industrie_customizer->add_section( 'industrie_footer_options', 
    array(
        'title'       => esc_html__( 'Footer Settings', 'industrie' ),
        'panel'		  =>'industrie_options_panel',			
        'priority'    => $prioriity,
        'capability'  => 'edit_theme_options', 
    ) 
    );

    //Start default footer BG
	$industrie_customizer->add_setting(
		'industrie_footer_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_footer_logo',
			array(
			'label'      => esc_html__( 'Upload Default Logo', 'industrie' ),
			'section'    => 'industrie_footer_options',
			'settings'   => 'industrie_footer_logo',
			)
		)   
	);
	//End default footer BG

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_0', 
			array(
				'settings'		=> 'footer_hr_0',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

    //Start Footer Background Color
	$industrie_customizer->add_setting (
        'industrie_footer_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_bg_color',
            array(
                'label'      => esc_html__('Footer Background Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_bg_color',
            )
        )
    );
	//End Footer Background Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_1', 
			array(
				'settings'		=> 'footer_hr_1',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Text Color
	$industrie_customizer->add_setting (
        'industrie_footer_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_text_color',
            array(
                'label'      => esc_html__('Footer Text Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_text_color',
            )
        )
    );
	//End Footer Text Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_2', 
			array(
				'settings'		=> 'footer_hr_2',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Title Color
	$industrie_customizer->add_setting (
        'industrie_footer_title_color',
		array(
			'transport'		=> 'refresh'
			)
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_title_color',
            array(
                'label'      => esc_html__('Footer Title Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_title_color',
            )
        )
    );
	//End Footer Title Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_3', 
			array(
				'settings'		=> 'footer_hr_3',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Link Color
	$industrie_customizer->add_setting (
        'industrie_footer_link_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_link_color',
            array(
                'label'      => esc_html__('Footer Link Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_link_color',
            )
        )
    );
	//End Footer Link Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_4', 
			array(
				'settings'		=> 'footer_hr_4',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Link Hover Color
	$industrie_customizer->add_setting (
        'industrie_footer_link_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_link_hover_color',
            array(
                'label'      => esc_html__('Footer Link Hover Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_link_hover_color',
            )
        )
    );
	//End Footer Link Hover Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_5', 
			array(
				'settings'		=> 'footer_hr_5',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Button BG Color
	$industrie_customizer->add_setting (
        'industrie_footer_button_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_button_text_color',
            array(
                'label'      => esc_html__('Footer Button Text Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_button_text_color',
            )
        )
    );
	//End Footer Button BG Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_6', 
			array(
				'settings'		=> 'footer_hr_6',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Button BG Color
	$industrie_customizer->add_setting (
        'industrie_footer_button_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_button_bg_color',
            array(
                'label'      => esc_html__('Footer Button Background Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_button_bg_color',
            )
        )
    );
	//End Footer Button BG Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_7', 
			array(
				'settings'		=> 'footer_hr_7',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Button Hover Color
	$industrie_customizer->add_setting (
        'industrie_footer_button_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_footer_button_hover_color',
            array(
                'label'      => esc_html__('Footer Button Hover Color','industrie'),
                'section'    => 'industrie_footer_options',
                'settings'   => 'industrie_footer_button_hover_color',
            )
        )
    );
	//End Footer Button Hover Color

	//Start separator
	$industrie_customizer->add_setting(
		'footer_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_8', 
			array(
				'settings'		=> 'footer_hr_8',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

    //Start footer logo size
	 $industrie_customizer->add_setting(
		'industrie_footer_logo_size',
		array(
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('industrie_footer_logo_size', array(
        'section'	=> 'industrie_footer_options',
        'label'		=> esc_html__( 'Logo Size', 'industrie' ),
        'description'=> esc_html__( 'Logo max height example(50px)', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_footer_logo_size'
    ));
	//End footer logo size

    //Start separator
	$industrie_customizer->add_setting(
		'footer_hr_10', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_10', 
			array(
				'settings' => 'footer_hr_10',
				'section'  => 'industrie_footer_options',
			)
		)
	);
	//End separator

    //footer Link
    $industrie_customizer->add_setting('footer_link', array(
        'default'		=> '#',
        'transport'		=> 'refresh',
    ));
    $industrie_customizer->add_control('footer_link', array(
        'section' 		=> 'industrie_footer_options',
        'label'		 	=> esc_html__( 'Custom Link', 'industrie' ),
        'type'		  	=> 'text',
        'setting' 		=> 'footer_link'
    ));

    //Start separator
	$industrie_customizer->add_setting(
		'footer_hr_11', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'footer_hr_11', 
			array(
				'settings'		=> 'footer_hr_11',
				'section'  		=> 'industrie_footer_options',
			)
		)
	);
	//End separator

	//footer copyright
	$industrie_customizer->add_setting('industrie_footer_copyright', array(
		'transport'		=> 'refresh',
	));
	$industrie_customizer->add_control('industrie_footer_copyright', array(
		'section'	=> 'industrie_footer_options',
		'label'		=> esc_html__( 'Copyright', 'industrie' ),
		'type'		=> 'textarea',
		'setting'	=> 'industrie_footer_copyright'	
	));

}

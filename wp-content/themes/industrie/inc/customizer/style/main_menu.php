<?php
function industrie_main_menu_style_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_main_menu_setting' , array(
        'title'      => esc_html__( 'Main Menu Settings', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_text_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_text_color',
            array(
                'label' => esc_html__('Menu Text Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_text_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_0', 
			array(
				'settings'		=> 'main_menu_hr_0',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_hover_color',
            array(
                'label' => esc_html__('Menu Hover Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_hover_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_2', 
			array(
				'settings'		=> 'main_menu_hr_2',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_active_color',
        array(
            'default' => '#FFFFFF',
        )
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_active_color',
            array(
                'label' => esc_html__('Menu Active Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_active_color',
            )
        )
    );
    //End


    //Start separator
    $industrie_customizer->add_setting(
    	'main_menu_hr_1', 
    	array(
    		'default'           => '',
    		'sanitize_callback' => 'esc_html',
    	)
    );
    $industrie_customizer->add_control(
    	new industrie_Separator_Control(
    		$industrie_customizer, 
    		'main_menu_hr_1', 
    		array(
    			'settings'		=> 'main_menu_hr_1',
    			'section'  		=> 'industrie_main_menu_setting',
    		)
    	)
    );
    //End separator 


	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_dropdown_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_dropdown_color',
            array(
                'label' => esc_html__('Menu Dropdown Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_dropdown_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_3', 
			array(
				'settings'		=> 'main_menu_hr_3',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_dropdown_active_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_dropdown_active_color',
            array(
                'label' => esc_html__('Menu Dropdown Active Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_dropdown_active_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_4', 
			array(
				'settings'		=> 'main_menu_hr_4',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_dropdown_hover_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_dropdown_hover_color',
            array(
                'label' => esc_html__('Menu Dropdown Hover Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_dropdown_hover_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_5', 
			array(
				'settings'		=> 'main_menu_hr_5',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_dropdown_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_dropdown_bg_color',
            array(
                'label' => esc_html__('Menu Dropdown Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_dropdown_bg_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_6', 
			array(
				'settings'		=> 'main_menu_hr_6',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_dropdown_hover_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_dropdown_hover_bg_color',
            array(
                'label' => esc_html__('Menu Dropdown Hover Background Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_dropdown_hover_bg_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_07', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_07', 
			array(
				'settings'		=> 'main_menu_hr_07',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $industrie_customizer->add_setting(
        'industrie_main_menu_dropdown_border_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_main_menu_dropdown_border_color',
            array(
                'label' => esc_html__('Menu Dropdown Border Color', 'industrie'),
                'description' => esc_html__('Pick color', 'industrie'),
                'section' => 'industrie_main_menu_setting',
                'settings' => 'industrie_main_menu_dropdown_border_color',
            )
        )
    );
    //End

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_7', 
			array(
				'settings'		=> 'main_menu_hr_7',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 
	
	//Start container size
    $industrie_customizer->add_setting(
        'industrie_main_menu_lr_gap',
        array(
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_main_menu_lr_gap', array(
        'section' => 'industrie_main_menu_setting',
        'label' => esc_html__('Menu Item Left/Right Gap', 'industrie'),
		'description' => esc_html__('For example 10px', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_main_menu_lr_gap',
    ));
    //End container size

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_8', 
			array(
				'settings'		=> 'main_menu_hr_8',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 
	
	//Start container size
    $industrie_customizer->add_setting(
        'industrie_main_menu_top_gap',
        array(
            'transport' => 'refresh',
        )
    );

    $industrie_customizer->add_control('industrie_main_menu_top_gap', array(
        'section' => 'industrie_main_menu_setting',
        'label' => esc_html__('Menu Item Top Gap', 'industrie'),
		'description' => esc_html__('For example 10px', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_main_menu_top_gap',
    ));
    //End container size

	//Start separator
	$industrie_customizer->add_setting(
		'main_menu_hr_9', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'main_menu_hr_9', 
			array(
				'settings'		=> 'main_menu_hr_9',
				'section'  		=> 'industrie_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start container size
    $industrie_customizer->add_setting(
        'industrie_main_menu_bottom_gap',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_main_menu_bottom_gap', array(
        'section' => 'industrie_main_menu_setting',
        'label' => esc_html__('Menu Item Bottom Gap', 'industrie'),
		'description' => esc_html__('For example 10px', 'industrie'),
        'type' => 'text',
        'setting' => 'industrie_main_menu_bottom_gap',
    ));
    //End container size

}
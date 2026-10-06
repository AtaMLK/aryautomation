<?php
function industrie_preloader_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_preloader_setting' , array(
        'title'      => esc_html__( 'Preloader Setting', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

    //Start Show Top Bar
	$industrie_customizer->add_setting( 'industrie_enable_preloader', 
	array(
		'default'    		=> '0', 
		) 
	);
	
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_enable_preloader',
			array(
				'type' 			=> 'switch',
				'label' 		=> esc_html__( 'Show Preloader','industrie' ),
				'description' 	=> esc_html__( 'You can show or hide preloader','industrie' ),
				'section' 		=> 'industrie_preloader_setting'
			)
		)
	);
	//End Show Top Bar

	//Start separator
	$industrie_customizer->add_setting(
		'separator_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_0', 
			array(
				'settings'		=> 'separator_0',
				'section'  		=> 'industrie_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Background Color
	$industrie_customizer->add_setting (
        'industrie_preloader_bg_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_preloader_bg_color',
            array(
                'label'      => esc_html__('Preloader Background Color','industrie'),
                'section'    => 'industrie_preloader_setting',
                'settings'   => 'industrie_preloader_bg_color',
            )
        )
    );
	//End Preloader Background Color

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
			'separator_1', 
			array(
				'settings'		=> 'separator_1',
				'section'  		=> 'industrie_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Border Color
	$industrie_customizer->add_setting (
        'industrie_preloader_border_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_preloader_border_color',
            array(
                'label'      => esc_html__('Preloader Border Color','industrie'),
                'section'    => 'industrie_preloader_setting',
                'settings'   => 'industrie_preloader_border_color',
            )
        )
    );
	//End Preloader Border Color

	//Start separator
	$industrie_customizer->add_setting(
		'separator_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_2', 
			array(
				'settings'		=> 'separator_2',
				'section'  		=> 'industrie_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Animate Circle Color
	$industrie_customizer->add_setting (
        'industrie_preloader_animate_circle_color'
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_preloader_animate_circle_color',
            array(
                'label'      => esc_html__('Preloader Animate Circle Color','industrie'),
                'section'    => 'industrie_preloader_setting',
                'settings'   => 'industrie_preloader_animate_circle_color',
            )
        )
    );
	//End Preloader Animate Circle Color

	//Start separator
	$industrie_customizer->add_setting(
		'separator_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_3', 
			array(
				'settings'		=> 'separator_3',
				'section'  		=> 'industrie_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Image
	$industrie_customizer->add_setting(
		'industrie_preloader_image', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_preloader_image',
			array(
			'label'      => esc_html__( 'Preloader Image', 'industrie' ),
			'section'    => 'industrie_preloader_setting',
			'settings'   => 'industrie_preloader_image',
			)
		)   
	);
	//End Preloader Image
}
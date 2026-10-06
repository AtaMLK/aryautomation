<?php
function industrie_mobile_sidebar_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_mobile_sidebar_setting' , array(
        'title'      => esc_html__( 'Sidebar Setting', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	// GSAP Control Start
	$industrie_customizer->add_setting( 'mobile_sidebar_logo_enable_disable', 
	array(
		'default'    => '0',
		) 
	);
	
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'mobile_sidebar_logo_enable_disable',
			array(
				'type' => 'switch',
				'label' => esc_html__('Sidebar Logo','industrie'),
				'description' => esc_html__('You can enable or disable sidebar logo here','industrie'),
				'section' => 'industrie_mobile_sidebar_setting'
			)
		)
	);
	// GSAP Control End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_30', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_30', 
			array(
				'settings'		=> 'separator_30',
				'section'  		=> 'industrie_mobile_sidebar_setting',
			)
		)
	);
	//End separator

	//Start Mobile Menu Logo Image
	$industrie_customizer->add_setting(
		'industrie_mobile_sidebar_logo_image', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$industrie_customizer->add_control(
		new WP_Customize_Image_Control(
		$industrie_customizer,
		'industrie_mobile_sidebar_logo_image',
			array(
			'label'      => esc_html__( 'Logo', 'industrie' ),
			'section'    => 'industrie_mobile_sidebar_setting',
			'settings'   => 'industrie_mobile_sidebar_logo_image',
			)
		)   
	);
	//End Mobile Menu Logo Image

	//Start separator
	$industrie_customizer->add_setting(
		'separator_31', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_31', 
			array(
				'settings'		=> 'separator_31',
				'section'  		=> 'industrie_mobile_sidebar_setting',
			)
		)
	);
	//End separator

	//Start Mobile Menu Logo Height
	$industrie_customizer->add_setting(
		'industrie_mobile_sidebar_logo_image_height',
		array(
			'default' => esc_html__( '30px', 'industrie' ),
			'transport'		=> 'refresh',
		)
	);

	$industrie_customizer->add_control('industrie_mobile_sidebar_logo_image_height', array(
        'section'	=> 'industrie_mobile_sidebar_setting',
        'label'		=> esc_html__( 'Logo Height', 'industrie' ),
        'description' => esc_html__( 'Logo height example(30px)', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_mobile_sidebar_logo_image_height'
    ));
	//End Mobile Menu Logo Height

	//Start separator
	$industrie_customizer->add_setting(
		'separator_32', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_32', 
			array(
				'settings'		=> 'separator_32',
				'section'  		=> 'industrie_mobile_sidebar_setting',
			)
		)
	);
	//End separator

	//Start Mobile Menu Logo Margin Bottom
	$industrie_customizer->add_setting(
		'industrie_mobile_sidebar_logo_margin_bottom',
		array(
			'default' => esc_html__( '20px', 'industrie' ),
			'transport'		=> 'refresh',
		)
	);

	$industrie_customizer->add_control('industrie_mobile_sidebar_logo_margin_bottom', array(
        'section'	=> 'industrie_mobile_sidebar_setting',
        'label'		=> esc_html__( 'Logo Margin Bottom', 'industrie' ),
        'description' => esc_html__( 'Logo Margin Bottom example(20px)', 'industrie' ),
        'type'		=> 'text',
        'setting'	=> 'industrie_mobile_sidebar_logo_margin_bottom'
    ));
	//End Mobile Menu Logo Margin Bottom

	//Start separator
	$industrie_customizer->add_setting(
		'separator_33', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_33', 
			array(
				'settings'		=> 'separator_33',
				'section'  		=> 'industrie_mobile_sidebar_setting',
			)
		)
	);
	//End separator

	//Start Mobile Sidebar Menu Text Normal Color
	$industrie_customizer->add_setting (
        'industrie_mobile_sidebar_menu_normal_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_mobile_sidebar_menu_normal_color',
            array(
                'label'       => esc_html__('Menu Normal Color','industrie'),
                'description' => esc_html__('Pic Color','industrie'),
                'section'     => 'industrie_mobile_sidebar_setting',
                'settings'    => 'industrie_mobile_sidebar_menu_normal_color',
            )
        )
    );
	//End Mobile Sidebar Menu Text Normal Color

	//Start separator
	$industrie_customizer->add_setting(
		'separator_34', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_34', 
			array(
				'settings'		=> 'separator_34',
				'section'  		=> 'industrie_mobile_sidebar_setting',
			)
		)
	);
	//End separator

	//Start Mobile Sidebar Menu Text Hover Color
	$industrie_customizer->add_setting (
        'industrie_mobile_sidebar_menu_hover_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_mobile_sidebar_menu_hover_color',
            array(
                'label'       => esc_html__('Menu Hover Color','industrie'),
                'description' => esc_html__('Pic Color','industrie'),
                'section'     => 'industrie_mobile_sidebar_setting',
                'settings'    => 'industrie_mobile_sidebar_menu_hover_color',
            )
        )
    );
	//End Mobile Sidebar Menu Text Hover Color

	//Start separator
	$industrie_customizer->add_setting(
		'separator_35', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_35', 
			array(
				'settings'		=> 'separator_35',
				'section'  		=> 'industrie_mobile_sidebar_setting',
			)
		)
	);
	//End separator

	//Start Mobile Sidebar Menu Text Active Color
	$industrie_customizer->add_setting (
        'industrie_mobile_sidebar_menu_active_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_mobile_sidebar_menu_active_color',
            array(
                'label'       => esc_html__('Menu Active Color','industrie'),
                'description' => esc_html__('Pic Color','industrie'),
                'section'     => 'industrie_mobile_sidebar_setting',
                'settings'    => 'industrie_mobile_sidebar_menu_active_color',
            )
        )
    );
	//End Mobile Sidebar Menu Text Active Color
}
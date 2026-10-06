<?php
function industrie_style_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_style_setting' , array(
        'title'      => esc_html__( 'Theme Style Settings', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );


	//Start Body Background Color
	$industrie_customizer->add_setting (
        'industrie_style_primary_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_style_primary_color',
            array(
                'label'       => esc_html__('Theme Primary Color','industrie'),
                'description' => esc_html__('Pic Color','industrie'),
                'section'     => 'industrie_style_setting',
                'settings'    => 'industrie_style_primary_color',
            )
        )
    );

    //Start separator
    $industrie_customizer->add_setting(
    	'style_hr_21', 
    	array(
    		'default'           => '',
    		'sanitize_callback' => 'esc_html',
    	)
    );
    $industrie_customizer->add_control(
    	new industrie_Separator_Control(
    		$industrie_customizer, 
    		'style_hr_21', 
    		array(
    			'settings'		=> 'style_hr_21',
    			'section'  		=> 'industrie_style_setting',
    		)
    	)
    );
    //End separator

	//Start Secondaer Color
	$industrie_customizer->add_setting (
        'industrie_theme_style_secondaer_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_theme_style_secondaer_color',
            array(
                'label'       => esc_html__('Theme Secondary Color','industrie'),
                'description' => esc_html__('Pic Color','industrie'),
                'section'     => 'industrie_style_setting',
                'settings'    => 'industrie_theme_style_secondaer_color',
            )
        )
    );
	//End Secondaer Color

    //Start separator
    $industrie_customizer->add_setting(
    	'style_hr_22', 
    	array(
    		'default'           => '',
    		'sanitize_callback' => 'esc_html',
    	)
    );
    $industrie_customizer->add_control(
    	new industrie_Separator_Control(
    		$industrie_customizer, 
    		'style_hr_22', 
    		array(
    			'settings'		=> 'style_hr_22',
    			'section'  		=> 'industrie_style_setting',
    		)
    	)
    );
    //End separator

    //Start Blog Page Title Color
	$industrie_customizer->add_setting (
        'industrie_blog_and_single_title_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_blog_and_single_title_color',
            array(
                'label'       => esc_html__('Blog, Single, Product Page Title Color','industrie'),
                'description' => esc_html__('Pic Color','industrie'),
                'section'     => 'industrie_style_setting',
                'settings'    => 'industrie_blog_and_single_title_color',
            )
        )
    );
	//End  Blog Page Title Color
    
    //Start separator
    $industrie_customizer->add_setting(
    	'style_hr_23', 
    	array(
    		'default'           => '',
    		'sanitize_callback' => 'esc_html',
    	)
    );
    $industrie_customizer->add_control(
    	new industrie_Separator_Control(
    		$industrie_customizer, 
    		'style_hr_23', 
    		array(
    			'settings'		=> 'style_hr_23',
    			'section'  		=> 'industrie_style_setting',
    		)
    	)
    );
    //End separator

    //Start Blog Page Button Color
	$industrie_customizer->add_setting (
        'industrie_bloge_page_button_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_bloge_page_button_color',
            array(
                'label'       => esc_html__('Blog Page Button Color','industrie'),
                'description' => esc_html__('Pic Color','industrie'),
                'section'     => 'industrie_style_setting',
                'settings'    => 'industrie_bloge_page_button_color',
            )
        )
    );
	//End  Blog Page Title Color
}
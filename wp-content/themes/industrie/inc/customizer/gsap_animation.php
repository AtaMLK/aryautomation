<?php
function industrie_gsap_animation_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_gsap_animation_setting' , array(
        'title'      => esc_html__( 'GSAP Animation Setting', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	// GSAP Control Start
	$industrie_customizer->add_setting( 'gsap_animation_enable_disable', 
	array(
		'default'    => '0',
		) 
	);
	
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'gsap_animation_enable_disable',
			array(
				'type' => 'switch',
				'label' => esc_html__('GSAP Animation','industrie'),
				'description' => esc_html__('You can enable or disable GSAP Animation here','industrie'),
				'section' => 'industrie_gsap_animation_setting'
			)
		)
	);
	// GSAP Control End

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
				'section'  		=> 'industrie_gsap_animation_setting',
			)
		)
	);
	//End separator

	// GSAP Control Start
	$industrie_customizer->add_setting( 'gsap_custom_cursor_enable_disable', 
	array(
		'default'    => '0',
		) 
	);
	
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'gsap_custom_cursor_enable_disable',
			array(
				'type' => 'switch',
				'label' => esc_html__('Custom Cursor','industrie'),
				'description' => esc_html__('You can enable or disable custom cursor. If GSAP Animation is on then it will work.','industrie'),
				'section' => 'industrie_gsap_animation_setting'
			)
		)
	);
	// GSAP Control End
}
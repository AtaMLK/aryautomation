<?php
function switch_control($industrie_customizer){
    	//Start enabal global setting
	$industrie_customizer->add_setting( 'industrie_enable_global', 
	array(
		'default'    => '1', 
		'sanitize_callback' => 'industrie_sanitize_integer'
		) 
	);
	$industrie_customizer->add_control(
		new industrie_Customize_Switch_Control(
			$industrie_customizer,
			'industrie_enable_global',
			array(
				'type' => 'switch',
				'label' => esc_html__('Enable Global Settings','industrie'),
				'description' => esc_html__('If you enable global settings all option will be work only theme option','industrie'),
				'section' => 'industrie_general_section'
			)
		)
	);
	//End enabal global setting
}
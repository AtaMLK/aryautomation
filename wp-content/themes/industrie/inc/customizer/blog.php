<?php
function industrie_blog_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_blog_setting' , array(
        'title'      => esc_html__( 'Blog Setting', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	//Start separator
	$industrie_customizer->add_setting(
		'blog_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'blog_hr_1', 
			array(
				'settings'		=> 'blog_hr_1',
				'section'  		=> 'industrie_blog_setting',
			)
		)
	);
	//End separator
}
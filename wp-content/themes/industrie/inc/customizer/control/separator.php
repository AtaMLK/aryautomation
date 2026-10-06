<?php
function industrie_separator( $industrie_customizer, $section_id, $setting_id ){
    $industrie_customizer->add_setting(
		$setting_id, 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			$setting_id, 
			array(
				'settings'		=> 'blog_page_hr_3',
				'section'  		=> $section_id,
			)
		)
	);
}
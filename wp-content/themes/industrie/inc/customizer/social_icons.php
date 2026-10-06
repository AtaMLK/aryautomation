<?php
function industrie_social_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_social_setting', 
		array(
			'title'       => esc_html__( 'Social Icons', 'industrie' ),
			'panel'		  =>'industrie_options_panel',			
			'priority'    => $priority, 
			'capability'  => 'edit_theme_options',
			'description' => esc_html__('Allows you to customize social icons.', 'industrie'), 
		) 
	);

    // Facebook
    $industrie_customizer->add_setting( 'industrie_facebook' , array(
        'transport'   => 'refresh',
    ) );
    $industrie_customizer->add_control('industrie_facebook', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Facebook', 'industrie' ),
        'setting'		=> 'industrie_facebook'
    ));		
    // Twitter
    $industrie_customizer->add_setting( 'industrie_twitter' , array(
    'transport'   => 'refresh',
    ) );
    $industrie_customizer->add_control('industrie_twitter', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Twitter', 'industrie' ),
        'setting'		=> 'industrie_twitter'
    ));
    // instagram
    $industrie_customizer->add_setting('industrie_instagram', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_instagram', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Instagram', 'industrie' ),
        'setting'		=> 'industrie_instagram'
    ));
    // soundcloud
    $industrie_customizer->add_setting('industrie_soundcloud', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_soundcloud', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Soundcloud', 'industrie' ),
        'setting'		=> 'industrie_soundcloud'
    ));
    //  YouTube
    $industrie_customizer->add_setting('industrie_youtube', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_youtube', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'YouTube', 'industrie' ),
        'setting'		=> 'industrie_youtube'
    ));
    // linkedin
    $industrie_customizer->add_setting('industrie_linkedin', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_linkedin', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Linkedin', 'industrie' ),
        'setting'		=> 'industrie_linkedin'
    ));
    // vimeo
    $industrie_customizer->add_setting('industrie_vimeo', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_vimeo', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Vimeo', 'industrie' ),
        'setting'		=> 'industrie_vimeo'
    ));
    //  pinterest-p
    $industrie_customizer->add_setting('industrie_pinterest', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_pinterest', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Pinterest', 'industrie' ),
        'setting'		=> 'industrie_pinterest'
    ));
    // tumblr
    $industrie_customizer->add_setting('industrie_tumblr', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_tumblr', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Tumblr', 'industrie' ),
        'setting'		=> 'industrie_tumblr'
    ));
    // flickr
    $industrie_customizer->add_setting('industrie_flickr', array(
        'transport'		=> 'refresh'
    ));
    $industrie_customizer->add_control('industrie_flickr', array(
        'section'		=> 'industrie_social_setting',
        'label'			=> esc_html__( 'Flickr', 'industrie' ),
        'setting'		=> 'industrie_flickr'
    ));
}
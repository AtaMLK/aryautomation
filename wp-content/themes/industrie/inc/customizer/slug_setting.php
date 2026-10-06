<?php
function industrie_team_panel($industrie_customizer, $priority){
    $industrie_customizer->add_section('industrie_slug_setting', array(
        'title'    => esc_html__('Post Type URL Change Settings', 'industrie'),
        'priority' => $priority,
        'panel'    => 'industrie_options_panel',
    ));

    //Start Portfolio Slug
    $industrie_customizer->add_setting(
        'industrie_portfolio_slug',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_portfolio_slug', array(
        'section' => 'industrie_slug_setting',
        'label'   => esc_html__('Portfolio Slug Change', 'industrie'),
        'type'    => 'text',
        'setting' => 'industrie_portfolio_slug',
    ));
    //End Portfolio Slug


    //Start Team Slug
    $industrie_customizer->add_setting(
        'industrie_team_slug',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_team_slug', array(
        'section' => 'industrie_slug_setting',
        'label'   => esc_html__('Team Slug Change', 'industrie'),
        'type'    => 'text',
        'setting' => 'industrie_team_slug',
    ));
    //End Team Slug

    //Start Testimonial Slug
    $industrie_customizer->add_setting(
        'industrie_service_slug',
        array(
            'transport' => 'refresh',
        )
    );
    $industrie_customizer->add_control('industrie_service_slug', array(
        'section' => 'industrie_slug_setting',
        'label'   => esc_html__('Service Slug Change', 'industrie'),
        'type'    => 'text',
        'setting' => 'industrie_service_slug',
    ));
    //End Testimonial Slug

}

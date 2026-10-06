<?php
function industrie_typography_panel( $industrie_customizer, $priority ){
    $industrie_customizer->add_section( 'industrie_typography_setting' , array(
        'title'      => esc_html__( 'Typography Settings', 'industrie' ),
        'priority'   => $priority,
        'panel'		 => 'industrie_options_panel'
    ) );

	$rs_custom_fonts = get_terms([
		'taxonomy'   => 'rs_custom_fonts',
		'hide_empty' => false,
	]);


	$rs_custom_font_key = [];
	$rs_custom_font_val = [];
	if( is_array( $rs_custom_fonts ) ){
		foreach( $rs_custom_fonts as $rs_custom_font ){
			array_push( $rs_custom_font_key, $rs_custom_font->name );
			array_push( $rs_custom_font_val, $rs_custom_font->name );
		}
	}

	
	$font_choices_custom = array_combine( array_map(function($el) use ($rs_custom_font_val) {
		return $rs_custom_font_val[$el];
	}, array_keys($rs_custom_font_key)), array_values($rs_custom_font_key));


	if( is_array( $rs_custom_fonts ) && !empty( $rs_custom_fonts ) ){
		array_unshift( $font_choices_custom, esc_html__( 'Custom Font', 'industrie') );
	}
	

	$font_choices_google = [
		'google'              => esc_html__( 'Google Fonts', 'industrie'),
		'Space Grotesk'     => esc_html__( 'Space Grotesk', 'industrie'),
		'Open Sans'           => esc_html__( 'Open Sans', 'industrie'),
		'Oswald'              => esc_html__( 'Oswald', 'industrie'),
		'Playfair Display'    => esc_html__( 'Playfair Display', 'industrie'),
		'Montserrat'          => esc_html__( 'Montserrat', 'industrie'),
		'Nunito Sans'         => esc_html__( 'Nunito Sans', 'industrie'),
		'Inter'               => esc_html__( 'Inter', 'industrie'),
		'Rajdhani'              => esc_html__( 'Rajdhani', 'industrie'),
		'Comfortaa'           => esc_html__( 'Comfortaa', 'industrie'),
		'Raleway'             => esc_html__( 'Raleway', 'industrie'),
		'Droid Sans'          => esc_html__( 'Droid Sans', 'industrie'),
		'Lato'                => esc_html__( 'Lato', 'industrie'),
		'Arvo'                => esc_html__( 'Arvo', 'industrie'),
		'Lora'                => esc_html__( 'Lora', 'industrie'),
		'Poppins'             => esc_html__( 'Poppins', 'industrie'),
		'Merriweather'        => esc_html__( 'Merriweather', 'industrie'),
		'Oxygen'              => esc_html__( 'Oxygen', 'industrie'),
		'PT Serif'            => esc_html__( 'PT Serif', 'industrie'),
		'PT Sans'             => esc_html__( 'PT Sans', 'industrie'),
		'PT Sans Narrow'      => esc_html__( 'PT Sans Narrow', 'industrie'),
		'Public Sans'         => esc_html__( 'Public Sans', 'industrie'),
		'Cabin'               => esc_html__( 'Cabin', 'industrie'),
		'Fjalla One'          => esc_html__( 'Fjalla One', 'industrie'),
		'Francois One'        => esc_html__( 'Francois One', 'industrie'),
		'Josefin Sans'        => esc_html__( 'Josefin Sans', 'industrie'),
		'Libre Baskerville'   => esc_html__( 'Libre Baskerville', 'industrie'),
		'Arimo'               => esc_html__( 'Arimo', 'industrie'),
		'Ubuntu'              => esc_html__( 'Ubuntu', 'industrie'),
		'Bitter'              => esc_html__( 'Bitter', 'industrie'),
		'Droid Serif'         => esc_html__( 'Droid Serif', 'industrie'),
		'Roboto'              => esc_html__( 'Roboto', 'industrie'),
		'Open Sans Condensed' => esc_html__( 'Open Sans Condensed', 'industrie'),
		'Roboto Condensed'    => esc_html__( 'Roboto Condensed', 'industrie'),
		'Roboto Slab'         => esc_html__( 'Roboto Slab', 'industrie'),
		'Yanone Kaffeesatz'   => esc_html__( 'Yanone Kaffeesatz', 'industrie'),
		'Rokkitt'             => esc_html__( 'Rokkitt', 'industrie'),
		'Saira Condensed'     => esc_html__( 'Saira Condensed', 'industrie'),
		'Oxanium'             => esc_html__( 'Oxanium', 'industrie'),
		'Source Code Pro'     => esc_html__( 'Source Code Pro', 'industrie'),
		'Rozha One'     => esc_html__( 'Rozha One', 'industrie'),
	]; 

	$font_choices = array_merge( $font_choices_custom, $font_choices_google );

	$font_weight = [
		'300' => esc_html__('300', 'industrie' ),
		'400' => esc_html__('400', 'industrie' ),
		'500' => esc_html__('500', 'industrie' ),
		'600' => esc_html__('600', 'industrie' ),
		'700' => esc_html__('700', 'industrie' ),
		'800' => esc_html__('800', 'industrie' ),
		'900' => esc_html__('900', 'industrie' ),
	];

	//Start
	$industrie_customizer->add_setting(
		'ty_header_0',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_header_0', 
			array(
				'label'			=> esc_html__( 'Header Typography', 'industrie' ),
				'settings'		=> 'ty_header_0',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_header_01', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_header_01', 
			array(
				'settings'		=> 'separator_header_01',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting( 'industrie_header_font');
	$industrie_customizer->add_control( 'industrie_header_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __('Select your desired font for the header.', 'industrie'),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_header_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$industrie_customizer->add_control('industrie_header_font_size', array(
		'section'		=> 'industrie_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'industrie' ),
		'description'	=> esc_html__( 'Header font size (15px)', 'industrie' ),
		'type'			=> 'text',
		'setting'	    => 'industrie_header_font_size'
	));
	//End

	//Start
	$industrie_customizer->add_setting( 'header_industrie_fonts_info', array(
			'default' => '400'
		)
	);
	$industrie_customizer->add_control( 'header_industrie_fonts_info', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'industrie' ),
			'description' => __( 'Select Header font Weight', 'industrie' ),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'ty_body_0',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_body_0', 
			array(
				'label'			=> esc_html__( 'Body Typography', 'industrie' ),
				'settings'		=> 'ty_body_0',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_body_01', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_body_01', 
			array(
				'settings'		=> 'separator_body_01',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting( 'industrie_body_font', array(
		'industrie_body_font',
		array(
			'transport'		=> 'refresh',
		)
	) );
	$industrie_customizer->add_control( 'industrie_body_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __( 'Select your desired font for the body.', 'industrie' ),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_body_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$industrie_customizer->add_control('industrie_body_font_size', array(
		'section'		=> 'industrie_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'industrie' ),
		'description'	=> esc_html__( 'Body font size (15px)', 'industrie' ),
		'type'			=> 'text',
		'setting'	    => 'industrie_body_font_size'
	));
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_fonts_info', array(
			'default' => '400'
		)
	);
	$industrie_customizer->add_control( 'industrie_fonts_info', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'industrie' ),
			'description' => __( 'Select Body font Weight', 'industrie' ),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_ty_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_ty_1', 
			array(
				'settings'		=> 'separator_ty_1',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting(
		'ty_heading_0',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_heading_0', 
			array(
				'label'			=> esc_html__( 'Heading Typography', 'industrie' ),
				'settings'		=> 'ty_heading_0',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_heading_font', array(
		'default' => esc_html__( 'Nunito Sans', 'industrie' )
	) );
	$industrie_customizer->add_control( 'industrie_heading_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'All Heading Font', 'industrie' ),
			'description' => __( 'Select your desired font for the heading.', 'industrie' ),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'ty_heading_1',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_heading_1', 
			array(
				'label'			=> esc_html__( 'H1 Typography', 'industrie' ),
				'settings'		=> 'ty_heading_1',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_h1_font');
	$industrie_customizer->add_control( 'industrie_h1_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __('Select your heading font family', 'industrie'),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	 //Start
	 $industrie_customizer->add_setting(
		'industrie_h1_font_size',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $industrie_customizer->add_control('industrie_h1_font_size', array(
        'section'		=> 'industrie_typography_setting',
        'label'			=> esc_html__( 'Font Size', 'industrie' ),
        'description'	=> esc_html__( 'Global H1 font size (55px)', 'industrie' ),
        'type'			=> 'text',
        'setting'	    => 'industrie_h1_font_size'
    ));
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h1_font_weight',
	);
	$industrie_customizer->add_control( 'industrie_h1_font_weight', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'industrie' ),
			'description' => __( 'Select h1 font weight', 'industrie' ),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h1_line_height',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $industrie_customizer->add_control('industrie_h1_line_height', array(
        'section'		=> 'industrie_typography_setting',
        'label'			=> esc_html__( 'Font Line Height', 'industrie' ),
        'description'	=> esc_html__( 'Global H1 font line height (30px)', 'industrie' ),
        'type'			=> 'text',
        'setting'	    => 'industrie_h1_line_height'
    ));

 	$industrie_customizer->add_setting (
        'industrie_style_h1_color',
    );
    $industrie_customizer->add_control(
        new WP_Customize_Color_Control(
            $industrie_customizer,
            'industrie_style_h1_color',
            array(
                'label'       => esc_html__('H1 Color','industrie'),
                'description' => esc_html__('Select Color','industrie'),
                'section'     => 'industrie_typography_setting',
                'settings'    => 'industrie_style_h1_color',
            )
        )
    );
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_ty_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_ty_2', 
			array(
				'settings'		=> 'separator_ty_2',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting(
		'ty_heading_2',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_heading_2', 
			array(
				'label'			=> esc_html__( 'H2 Typography', 'industrie' ),
				'settings'		=> 'ty_heading_2',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_h2_font');
	$industrie_customizer->add_control( 'industrie_h2_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __('Select your heading font family', 'industrie'),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h2_font_size',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $industrie_customizer->add_control('industrie_h2_font_size', array(
        'section'		=> 'industrie_typography_setting',
        'label'			=> esc_html__( 'Font Size', 'industrie' ),
        'description'	=> esc_html__( 'Global H2 font size (55px)', 'industrie' ),
        'type'			=> 'text',
        'setting'	    => 'industrie_h2_font_size'
    ));
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h2_font_weight',
		array(
			'transport'		=> 'refresh',
		)
	);
	$industrie_customizer->add_control( 'industrie_h2_font_weight', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'industrie' ),
			'description' => __( 'Select h2 font weight', 'industrie' ),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h2_line_height',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $industrie_customizer->add_control('industrie_h2_line_height', array(
        'section'		=> 'industrie_typography_setting',
        'label'			=> esc_html__( 'Font Line Height', 'industrie' ),
        'description'	=> esc_html__( 'Global H2 font line height (30px)', 'industrie' ),
        'type'			=> 'text',
        'setting'	    => 'industrie_h2_line_height'
    ));

	$industrie_customizer->add_setting (
       'industrie_style_h2_color',
   	);
   	$industrie_customizer->add_control(
       new WP_Customize_Color_Control(
           $industrie_customizer,
           'industrie_style_h2_color',
           array(
               'label'       => esc_html__('H2 Color','industrie'),
               'description' => esc_html__('Select Color','industrie'),
               'section'     => 'industrie_typography_setting',
               'settings'    => 'industrie_style_h2_color',
           )
       )
   	);
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_ty_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_ty_3', 
			array(
				'settings'		=> 'separator_ty_3',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting(
		'ty_heading_3',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_heading_3', 
			array(
				'label'			=> esc_html__( 'H3 Typography', 'industrie' ),
				'settings'		=> 'ty_heading_3',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_h3_font');
	$industrie_customizer->add_control( 'industrie_h3_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __('Select your heading font family', 'industrie'),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h3_font_size',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $industrie_customizer->add_control('industrie_h3_font_size', array(
        'section'		=> 'industrie_typography_setting',
        'label'			=> esc_html__( 'Font Size', 'industrie' ),
        'description'	=> esc_html__( 'Global H3 font size (55px)', 'industrie' ),
        'type'			=> 'text',
        'setting'	    => 'industrie_h3_font_size'
    ));
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h3_font_weight',
	);
	$industrie_customizer->add_control( 'industrie_h3_font_weight', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'industrie' ),
			'description' => __( 'Select h3 font weight', 'industrie' ),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h3_line_height',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $industrie_customizer->add_control('industrie_h3_line_height', array(
        'section'		=> 'industrie_typography_setting',
        'label'			=> esc_html__( 'Font Line Height', 'industrie' ),
        'description'	=> esc_html__( 'Global H3 font line height (30px)', 'industrie' ),
        'type'			=> 'text',
        'setting'	    => 'industrie_h3_line_height'
    ));

	$industrie_customizer->add_setting (
       'industrie_style_h3_color',
   	);
   	$industrie_customizer->add_control(
       new WP_Customize_Color_Control(
           $industrie_customizer,
           'industrie_style_h3_color',
           array(
               'label'       => esc_html__('H3 Color','industrie'),
               'description' => esc_html__('Select Color','industrie'),
               'section'     => 'industrie_typography_setting',
               'settings'    => 'industrie_style_h3_color',
           )
       )
   	);
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_ty_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_ty_4', 
			array(
				'settings'		=> 'separator_ty_4',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting(
		'ty_heading_4',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_heading_4', 
			array(
				'label'			=> esc_html__( 'H4 Typography', 'industrie' ),
				'settings'		=> 'ty_heading_4',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_h4_font');
	$industrie_customizer->add_control( 'industrie_h4_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __('Select your heading font family', 'industrie'),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h4_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$industrie_customizer->add_control('industrie_h4_font_size', array(
		'section'		=> 'industrie_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'industrie' ),
		'description'	=> esc_html__( 'Global H4 font size (55px)', 'industrie' ),
		'type'			=> 'text',
		'setting'	    => 'industrie_h4_font_size'
	));
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h4_font_weight',
	);
	$industrie_customizer->add_control( 'industrie_h4_font_weight', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Font Weight', 'industrie' ),
		'description' => __( 'Select h4 font weight', 'industrie' ),
		'section'     => 'industrie_typography_setting',
		'choices'     => $font_weight
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h4_line_height',
		array(
			'transport'		=> 'refresh',
		)
		);
		$industrie_customizer->add_control('industrie_h4_line_height', array(
		'section'		=> 'industrie_typography_setting',
		'label'			=> esc_html__( 'Font Line Height', 'industrie' ),
		'description'	=> esc_html__( 'Global H4 font line height (30px)', 'industrie' ),
		'type'			=> 'text',
		'setting'	    => 'industrie_h4_line_height'
	));

	$industrie_customizer->add_setting (
       'industrie_style_h4_color',
   	);
   	$industrie_customizer->add_control(
       new WP_Customize_Color_Control(
           $industrie_customizer,
           'industrie_style_h4_color',
           array(
               'label'       => esc_html__('H4 Color','industrie'),
               'description' => esc_html__('Select Color','industrie'),
               'section'     => 'industrie_typography_setting',
               'settings'    => 'industrie_style_h4_color',
           )
       )
   	);
	//End

	//Start separator
	$industrie_customizer->add_setting(
		'separator_ty_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_ty_5', 
			array(
				'settings'		=> 'separator_ty_5',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator	

	//Start
	$industrie_customizer->add_setting(
		'ty_heading_5',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_heading_5', 
			array(
				'label'			=> esc_html__( 'H5 Typography', 'industrie' ),
				'settings'		=> 'ty_heading_5',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_h5_font');
	$industrie_customizer->add_control( 'industrie_h5_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __('Select your heading font family', 'industrie'),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h5_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$industrie_customizer->add_control('industrie_h5_font_size', array(
		'section'		=> 'industrie_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'industrie' ),
		'description'	=> esc_html__( 'Global H5 font size (32px)', 'industrie' ),
		'type'			=> 'text',
		'setting'	    => 'industrie_h5_font_size'
	));
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h5_font_weight',
	);
	$industrie_customizer->add_control( 'industrie_h5_font_weight', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Font Weight', 'industrie' ),
		'description' => __( 'Select h5 font weight', 'industrie' ),
		'section'     => 'industrie_typography_setting',
		'choices'     => $font_weight
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h5_line_height',
		array(
			'transport'		=> 'refresh',
		)
		);
		$industrie_customizer->add_control('industrie_h5_line_height', array(
		'section'		=> 'industrie_typography_setting',
		'label'			=> esc_html__( 'Font Line Height', 'industrie' ),
		'description'	=> esc_html__( 'Global H5 font line height (30px)', 'industrie' ),
		'type'			=> 'text',
		'setting'	    => 'industrie_h5_line_height'
	));

	$industrie_customizer->add_setting (
       'industrie_style_h5_color',
   	);
   	$industrie_customizer->add_control(
       new WP_Customize_Color_Control(
           $industrie_customizer,
           'industrie_style_h5_color',
           array(
               'label'       => esc_html__('H5 Color','industrie'),
               'description' => esc_html__('Select Color','industrie'),
               'section'     => 'industrie_typography_setting',
               'settings'    => 'industrie_style_h5_color',
           )
       )
   	);
	//End
	
	//Start separator
	$industrie_customizer->add_setting(
		'separator_ty_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$industrie_customizer->add_control(
		new industrie_Separator_Control(
			$industrie_customizer, 
			'separator_ty_6', 
			array(
				'settings'		=> 'separator_ty_6',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$industrie_customizer->add_setting(
		'ty_heading_6',
	);
	$industrie_customizer->add_control(
		new industrie_Heading_Control(
			$industrie_customizer, 
			'ty_heading_6', 
			array(
				'label'			=> esc_html__( 'H6 Typography', 'industrie' ),
				'settings'		=> 'ty_heading_6',
				'section'  		=> 'industrie_typography_setting',
			)
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting( 'industrie_h6_font');
	$industrie_customizer->add_control( 'industrie_h6_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'industrie' ),
			'description' => __('Select your heading font family', 'industrie'),
			'section'     => 'industrie_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h6_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$industrie_customizer->add_control('industrie_h6_font_size', array(
		'section'		=> 'industrie_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'industrie' ),
		'description'	=> esc_html__( 'Global H6 font size (25px)', 'industrie' ),
		'type'			=> 'text',
		'setting'	    => 'industrie_h6_font_size'
	));
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h6_font_weight',
	);
	$industrie_customizer->add_control( 'industrie_h6_font_weight', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Font Weight', 'industrie' ),
		'description' => __( 'Select h6 font weight', 'industrie' ),
		'section'     => 'industrie_typography_setting',
		'choices'     => $font_weight
		)
	);
	//End

	//Start
	$industrie_customizer->add_setting(
		'industrie_h6_line_height',
		array(
			'transport'		=> 'refresh',
		)
	);
	$industrie_customizer->add_control('industrie_h6_line_height', array(
	'section'		=> 'industrie_typography_setting',
	'label'			=> esc_html__( 'Font Line Height', 'industrie' ),
	'description'	=> esc_html__( 'Global H6 font line height (30px)', 'industrie' ),
	'type'			=> 'text',
	'setting'	    => 'industrie_h6_line_height'
	));

	$industrie_customizer->add_setting (
       'industrie_style_h6_color',
   	);
   	$industrie_customizer->add_control(
       	new WP_Customize_Color_Control(
           $industrie_customizer,
           'industrie_style_h6_color',
           	array(
               'label'       => esc_html__('H6 Color','industrie'),
               'description' => esc_html__('Select Color','industrie'),
               'section'     => 'industrie_typography_setting',
               'settings'    => 'industrie_style_h6_color',
           	)
       	)
   	);
	//End
}
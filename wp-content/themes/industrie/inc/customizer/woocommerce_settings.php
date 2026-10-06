<?php
function industrie_woocommerce_panel($industrie_customizer, $priority)
{
    $industrie_customizer->add_section('industrie_shop_setting', array(
        'title'    => esc_html__('Woocommerce Settings', 'industrie'),
        'priority' => $priority,
        'panel'    => 'industrie_options_panel',
    ));

    //Start
    $industrie_customizer->add_setting( 'industrie_woo_product_type', array(
        'default'           => 'default_style',
        'transport'         => 'postMessage',
    ) );
    $industrie_customizer->add_control( 'industrie_woo_product_type', array(
        'label'   => esc_html__( 'Product Style', 'industrie' ),
        'section' => 'industrie_shop_setting',
        'type'    => 'select',
        'choices' => array(
            'default_style'  => esc_html__( 'Default Style', 'industrie' ),
            'catalog_style'    => esc_html__( 'Catalog Without Price Style', 'industrie' ),
            'catalog_price_style'    => esc_html__( 'Catalog With Price Style', 'industrie' ),
        ),
    ) );
    //End

    //Start separator
    $industrie_customizer->add_setting(
        'woocommerce_hr_01',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'woocommerce_hr_01',
            array(
                'settings' => 'woocommerce_hr_01',
                'section' => 'industrie_shop_setting',
            )
        )
    );
    //End separator
    
    //Start
    $industrie_customizer->add_setting( 'industrie_shop_page_sidebar_setting', array(
        'default'           => 'shop_no_sidebar',
        'transport'         => 'postMessage',
    ) );
    $industrie_customizer->add_control( 'industrie_shop_page_sidebar_setting', array(
        'label'   => esc_html__( 'Sidebar Setting', 'industrie' ),
        'section' => 'industrie_shop_setting',
        'type'    => 'select',
        'choices' => array(
            'shop_no_sidebar'    => esc_html__( 'Full Wide', 'industrie' ),
            'shop_left_sidebar'  => esc_html__( 'Left Sidebar', 'industrie' ),
            'shop_right_sidebar' => esc_html__( 'Right Sidebar', 'industrie' ),
        ),
    ) );
    //End

    //Start separator
    $industrie_customizer->add_setting(
        'woocommerce_hr_02',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'woocommerce_hr_02',
            array(
                'settings' => 'woocommerce_hr_02',
                'section' => 'industrie_shop_setting',
            )
        )
    );
    //End separator

    //Start
	 $industrie_customizer->add_setting(
		'wc_num_product',
		array(
			'default' => esc_html__( '9', 'industrie' ),
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('wc_num_product', array(
        'section'	    => 'industrie_shop_setting',
        'label'		     => esc_html__( 'Number of Products', 'industrie' ),
        'description' => esc_html__( 'Show number of products per page', 'industrie' ),
        'type'		      => 'text',
        'setting'	    => 'wc_num_product'
    ));
	//End

    //Start separator
    $industrie_customizer->add_setting(
        'woocommerce_hr_03',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'woocommerce_hr_03',
            array(
                'settings' => 'woocommerce_hr_03',
                'section' => 'industrie_shop_setting',
            )
        )
    );
    //End separator

    //Start
	 $industrie_customizer->add_setting(
		'wc_num_product_per_row',
		array(
			'default' => esc_html__( '3', 'industrie' ),
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('wc_num_product_per_row', array(
        'section'	    => 'industrie_shop_setting',
        'label'		     => esc_html__( 'Number of Row', 'industrie' ),
        'description' => esc_html__( 'Show number of prodcts per row', 'industrie' ),
        'type'		      => 'text',
        'setting'	    => 'wc_num_product_per_row'
    ));
	//End

    //Start separator
    $industrie_customizer->add_setting(
        'woocommerce_hr_04',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $industrie_customizer->add_control(
        new industrie_Separator_Control(
            $industrie_customizer,
            'woocommerce_hr_04',
            array(
                'settings' => 'woocommerce_hr_04',
                'section' => 'industrie_shop_setting',
            )
        )
    );
    //End separator

    //Start
	 $industrie_customizer->add_setting(
		'wc_btn_txt',
		array(
			'transport'		=> 'refresh',
		)
	 );

	 $industrie_customizer->add_control('wc_btn_txt', array(
        'section'	    => 'industrie_shop_setting',
        'label'		     => esc_html__( 'Button Text', 'industrie' ),
        'description' => esc_html__( 'Default: "Add to cart", you can change it here.', 'industrie' ),
        'type'		      => 'text',
        'setting'	    => 'wc_btn_txt'
    ));
	//End
}
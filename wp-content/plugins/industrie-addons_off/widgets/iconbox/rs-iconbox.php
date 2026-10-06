<?php
/**
 * Elementor RS Iconbox Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */



use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;


defined( 'ABSPATH' ) || die();
class Rsaddon_Elementor_pro_RSIcon_Box_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rs-iconbox';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS Icon Box', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'rs-badge';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'rsaddon_category' ];
    }
	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function register_controls() {

		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__( 'Icon Box Global', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rsaddon' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_control(
			'vertical_alignment',
			[
				'label'   => esc_html__( 'Vertical/Horizontal', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'vertical',		
				'options' => [					
					'vertical' => esc_html__( 'Vertical', 'rsaddon'),
					'horizontal' => esc_html__( 'Horizontal', 'rsaddon'),
								
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
            'markup_box_horizontal_align',
            [
                'label' => esc_html__( 'Box  (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__( 'Inline', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
				'default' => 'block',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'markup_box_vertical_align',
            [
                'label' => esc_html__( 'Vertical Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'rsaddon' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
				'default' => 'flex-start',
				'condition' => [
					'markup_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner' => 'align-items: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'markup_flex_box_h_align',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
				'default' => 'flex-start',
				'condition' => [
					'markup_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'markup_box_column_align',
            [
                'label' => esc_html__( 'Column Direction', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Row', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'rsaddon' ),
                        'icon' => 'eicon-wrap',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Column', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-v',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'rsaddon' ),
                        'icon' => 'eicon-wrap',
                    ],
                ],
				'default' => 'row',
				'condition' => [
					'markup_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();



		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
					'image' => esc_html__( 'Image', 'rsaddon'),
								
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => 'icon',
				],	
			]
		);

		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
			]
		);		
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title & Description', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
	
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Box Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Box Title',
				'placeholder' => esc_html__( 'Box Title', 'rsaddon' ),
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'rsaddon'),
					'yes' => esc_html__( 'Yes', 'rsaddon'),					

				],
			]
		);
		$this->add_control(
		    'title_tag',
		    [
		        'label' => esc_html__( 'Title HTML Tag', 'rsaddon' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'h1'  => [
		                'title' => esc_html__( 'H1', 'rsaddon' ),
		                'icon' => 'eicon-editor-h1'
		            ],
		            'h2'  => [
		                'title' => esc_html__( 'H2', 'rsaddon' ),
		                'icon' => 'eicon-editor-h2'
		            ],
		            'h3'  => [
		                'title' => esc_html__( 'H3', 'rsaddon' ),
		                'icon' => 'eicon-editor-h3'
		            ],
		            'h4'  => [
		                'title' => esc_html__( 'H4', 'rsaddon' ),
		                'icon' => 'eicon-editor-h4'
		            ],
		            'h5'  => [
		                'title' => esc_html__( 'H5', 'rsaddon' ),
		                'icon' => 'eicon-editor-h5'
		            ],
		            'h6'  => [
		                'title' => esc_html__( 'H6', 'rsaddon' ),
		                'icon' => 'eicon-editor-h6'
		            ]
		        ],
		        'default' => 'h2',
		        'toggle' => false,
		    ]
		);
		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Box Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Box Text',
				'separator' => 'before',
			]			
		);

		$this->end_controls_section();	

		//Icon/Image
		$this->start_controls_section(
		    '_section_media_style',
		    [
		        'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
            'icon_image_horizontal_align',
            [
                'label' => esc_html__( 'Icon  (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__( 'Inline', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
				'default' => 'block',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .icon-area' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'icon_image_box_vertical_align',
            [
                'label' => esc_html__( 'Vertical Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'rsaddon' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
				'default' => 'flex-start',
				'condition' => [
					'icon_image_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .icon-area' => 'align-items: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'flex_box_h_align',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
				'default' => 'flex-start',
				'condition' => [
					'icon_image_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .icon-area' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
		    'svg_icon_width',
		    [
		        'label' => esc_html__( 'Svg Icon Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area svg' => 'width: {{SIZE}}{{UNIT}} !important;',
		        ],
		        // 'condition' => [
		        //     'icon_type' => 'icon'
		        // ]
		    ]
		);
		$this->add_responsive_control(
		    'svg_icon_height',
		    [
		        'label' => esc_html__( 'Svg Icon height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area svg' => 'height: {{SIZE}}{{UNIT}} !important;',
		        ],
		        // 'condition' => [
		        //     'icon_type' => 'icon'
		        // ]
		    ]
		);
		$this->add_responsive_control(
		    'svg_wrappericon_width',
		    [
		        'label' => esc_html__( 'Wrapper width', 'rsaddon'),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px' ],
		        'show_label' => true,
		       	'selectors' => [
		       	    '{{WRAPPER}} .icon-area' => 'flex: 0 0 {{SIZE}}{{UNIT}} !important;',
		       	],
		    ]
		);
		$this->add_responsive_control(
		    'svg_icon_wrapper_height',
		    [
		        'label' => esc_html__( 'Wrapper Height', 'rsaddon'),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px' ],
		        'show_label' => true,
		       	'selectors' => [
		       	    '{{WRAPPER}} .icon-area' => 'height: {{SIZE}}{{UNIT}} !important;',
		       	],
		    ]
		);
		$this->add_control(
		    'svg_icon_color',
		    [
		        'label' => esc_html__( 'Svg Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .icon-area svg' => 'fill: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);
		$this->add_responsive_control(
		    'icon_image_width',
		    [
		        'label' => esc_html__( 'Image Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px' ],
		        'show_label' => true,
		        'selectors' => [
		           	'{{WRAPPER}} .icon-area img' => 'width: {{SIZE}}{{UNIT}};',                   
		        ],
		        'condition' => [
		            'icon_type' => 'image',
		        ]
		    ]
		);
		$this->add_responsive_control(
		    'icon_image_height',
		    [
		        'label' => esc_html__( 'Image Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px' ],
		        'show_label' => true,
		        'selectors' => [
		            '{{WRAPPER}} .icon-area img' => 'height: {{SIZE}}{{UNIT}};',                   
		        ],
		        'condition' => [
		            'icon_type' => 'image',
		            
		        ]
		    ]
		);
		$this->add_control(
		    'icon_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .box-inner:hover .icon-area' => 'color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
			'clip_path',
			[
				'label' => esc_html__( 'Clip Path ON/OFF?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Title & Description', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);
		$this->add_control(
		    'title_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'rsaddon' ),
		        'separator' => 'before'
		    ]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-iconbox-area .box-inner .iconbox-title .title',
		    ]
		);
		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title, {{WRAPPER}}  .rs-iconbox-area .box-inner .text-area .iconbox-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner:hover .text-area .iconbox-title .title, {{WRAPPER}}  .rs-iconbox-area .box-inner:hover .text-area .iconbox-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		$this->add_responsive_control(
            'title_area_margin',
            [
                'label' => esc_html__( 'Title Area Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
		    'description_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Description', 'rsaddon' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area p',
		    ]
		);
		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area p' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'link_color',
		    [
		        'label' => esc_html__( 'link Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area p a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		$this->add_control(
		    'link_hover_color',
		    [
		        'label' => esc_html__( 'Link Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area p a:hover' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'description_margin',
		    [
		        'label' => esc_html__( 'Description Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		       'selectors' => [
		           '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		       ],
		    ]
		);
		$this->end_controls_section();
		
	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

			$this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'title' );

            $this->add_inline_editing_attributes( 'text', 'basic' );
            $this->add_render_attribute( 'text', 'class' );	

            $animation = !empty($settings['hover_animation'])? 'elementor-animation-'.$settings['hover_animation'].'':'';
            $animation_box = !empty($animation) ? 'rs-animation-yes' : '';

			$clip_path = $settings['clip_path'];
			$clip_path_css = '';
			if($clip_path == 'yes') {
				$clip_path_css = 'clip-path-enable';
			}
		?>
		<div class="rs-iconbox-area <?php echo esc_attr($animation_box);?>">
		    <div class="box-inner">
    	    	<?php if( !empty($settings['selected_icon']['value']) || !empty($settings['selected_image']['url'])){?>
    	    		<div class="icon-area <?php echo esc_attr( $animation ); ?> <?php echo $clip_path_css;?>">
    		    		<?php if(!empty($settings['selected_icon']['value'])) : ?>
    						<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
    		    		<?php endif; ?>
    		    		<?php if(!empty($settings['selected_image']['url'])) :?>
							<?php if(!empty($settings['title_link']['url'])) { ?>
    		    			<a href="<?php echo esc_url($settings['title_link']['url']);?>">
							<?php } ?>
							<img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="image" />
							<?php if(!empty($settings['title_link']['url'])) { ?></a>
								<?php } ?>
    		    		<?php endif;?>
    	    		</div>
    	    	<?php }?>      
			    <div class="text-area">
			    	<?php if(!empty($settings['title'])){ ?>
				    	<div class="iconbox-title">			
				    		<<?php echo esc_html($settings['title_tag']);?> <?php echo esc_attr($this->print_render_attribute_string('title')); ?>> 
							<?php if(!empty($settings['title_link']['url'])) { ?>
								<a href="<?php echo esc_url($settings['title_link']['url']);?>">
							<?php } ?>
							<?php echo esc_html($settings['title']);?>
							<?php if(!empty($settings['title_link']['url'])) { ?>
							</a>
						<?php } ?>
						</<?php echo esc_html($settings['title_tag']);?>>
				    	</div>
			    	<?php } ?>	
			    	<?php if(!empty($settings['text'])) : ?>
			    		<p <?php echo esc_attr($this->print_render_attribute_string('text')); ?>>  <?php echo wp_kses_post($settings['text']);?></p>	
			    	<?php endif; ?>	
			    </div>
			</div>
		</div>	
	<?php
	}
}

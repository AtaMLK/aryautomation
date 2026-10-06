<?php
/**
 * Elementor rsgallery Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Team_Grid_Widget extends \Elementor\Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve rsgallery widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rsteam';
	}		
	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RS Team Grid', 'rsaddon' );
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
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
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
        return [ 'rsaddon_category' ];
    }
	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'team_grid_source',
			[
				'label'   => esc_html__( 'Select Team Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',				
				'options' => [
					'custom' => esc_html__('Custom', 'rsaddon'),
					'dynamic' => esc_html__('Dynamic', 'rsaddon')					
				],	
				'separator' => 'before',										
			]
		);
		$this->add_control(
			'team_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => esc_html__('Style 1', 'rsaddon'),
					'style2' => esc_html__('Style 2', 'rsaddon'),
					'style3' => esc_html__('Style 3', 'rsaddon'),
				],
				'separator' => 'before',										
			]
		);
		$this->add_control(
			'team_category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],	
			]

		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Team Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],
			]
		);
		$this->add_control(
			'team_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 4,			
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],
							
			]
		);
		$this->add_control(
			'memeber_image',
			[
				'label' => esc_html__( 'Member Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'custom',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'dynamic',
				],
            ]
        ); 
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Name', 'rsaddon' ),                
                'type' => Controls_Manager::TEXT,
                'default' => 'Elements Name',
                'placeholder' => esc_html__( 'Type Member Name', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
			]

        );
		$this->add_control(
			'team_link',
			[
				'label' => esc_html__('Single Link', 'rsaddon'),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'team_grid_source' => 'custom',
				],           
			]
		); 
        $this->add_control(
            'designation',
            [
                'label' => esc_html__( 'Designation', 'rsaddon' ),               
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Developer', 'rsaddon' ),
                'separator' => 'before',
                'placeholder' => esc_html__( 'Type Member Designation', 'rsaddon' ),
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'phone',
            [
                'label' => esc_html__( 'Phone', 'rsaddon' ),               
                'type' => Controls_Manager::TEXT,                
                'separator' => 'before',                
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'email',
            [
                'label' => esc_html__( 'Email Address', 'rsaddon' ),                
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Email Address', 'rsaddon' ),
                'separator' => 'before',               
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'bio',
            [
                'label' => esc_html__( 'Short Bio', 'rsaddon' ),                
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( '', 'rsaddon' ),
                'rows' => 5,
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'popup_description',
            [
                'label' => esc_html__( 'Description', 'rsaddon' ),                
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here.',
                'placeholder' => esc_html__( '', 'rsaddon' ),
                'rows' => 10,
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
		
        $this->add_control(
			'team_grid_popup_style',
			[
				'label'   => esc_html__( 'Show Popup', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',				
				'options' => [
					'popup'   => 'Popup Style',
					'default' => 'Default Style'				
				],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],											
			]
		);   

		$this->add_control(
			'team_ordering',
			[
				'label'   => esc_html__( 'Ordering', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 4,			
				'options' => [
					'desc' => esc_html__( 'Desc', 'rsaddon' ),
					'asc' => esc_html__( 'Asc', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
		);

		$this->add_responsive_control(
			'team_item_gap',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-team-grid .team-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'team_item_left_gap',
			[
				'label' => esc_html__( 'Item Left Gap', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-team-grid .team-item' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'team_item_right_gap',
			[
				'label' => esc_html__( 'Item Right Gap', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-team-grid .team-item' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'phone_contact_on_off',
			[
				'label' => esc_html__('Phone ON/OFF', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'team_grid_style' => ['style8'],
				],
			]
		);
		$this->add_control(
			'clip_path',
			[
				'label' => esc_html__('Clip Path ON/OFF?', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__( 'Social Profiles', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
 		$repeater = new Repeater();
 		$repeater->add_control(
 		    'link',
 		    [
 		        'label' => esc_html__('Enter Link', 'rsaddon'),
 		        'type' => Controls_Manager::URL,                
 		    ]
 		); 
		 $repeater->add_control(
			'social_profile',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);
		$this->add_control(
			'social_icon_list',
			[
				'label' => esc_html__( 'Social Icons', 'elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
					],
				],
				
			]
		);
        $this->add_control(
			'image_spacing_custom',
			[
				'label'      => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'separator'  => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .team-item-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
					'team_grid_source' => 'dynamic',
				],
			]
		);  
		$this->end_controls_section();

		$this->start_controls_section(
			'section_team_global_style',
			[
				'label' => esc_html__( 'Global Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'team_grid_style' => 'style6',
				],
			]
		);
		$this->add_responsive_control(
		    'team_global_tem_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'team_global_tem_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'team_global_tem_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-team-grid .team-item',
			]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'team_global_tem_border',
		        'selector' => '{{WRAPPER}} .rs-team-grid .team-item',
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'team_global_tem_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .rs-team-grid .team-item',
		    ]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_name_style',
			[
				'label' => esc_html__( 'Name Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .team-content .team-name a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .team-content .team-name a:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );
		$this->add_control(
            'team_highlight_color',
            [
                'label' => esc_html__( 'Highlight Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-content h3.team-name a span' => 'color: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => 
                    '{{WRAPPER}} .rs-team-grid .team-item .team-content .team-name',
			]
		);
		$this->add_responsive_control(
		    'item_title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item .team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_designation_style',
			[
				'label' => esc_html__( 'Designation Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style1 .team-item .team-content .team-title' => 'color: {{VALUE}};',
                ],           
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => esc_html__( 'Designation Typography', 'rsaddon' ),
				'selector' => 
                    '{{WRAPPER}} .team-content span.team-title,{{WRAPPER}} .rs-team-grid .team-item .team-inner-wrap .team-content span.team-title',
			]
		);
		$this->add_responsive_control(
		    'designation_margin',
		    [
		        'label' => esc_html__( 'Designation Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item .team-title, {{WRAPPER}} .rs-team-grid .team-item .team-content-inner .team-content .inner-ctn .team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__( 'Image Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
		    'image_border_radius',
		    [
		        'label' => esc_html__( ' Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		           
		        ],
		    ]
		);
		$this->end_controls_section();

		// Social Icon Style
		$this->start_controls_section(
			'social_icon_style',
			[
				'label' => esc_html__( 'Social Icon Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'social_wrapper_bg_color',
            [
                'label' => esc_html__( 'Wrapper Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons' => 'background: {{VALUE}};',
                ],
				'condition' => ['team_grid_style' => ['style1','style2']]
            ]
        );

		$this->add_responsive_control(
		    'social_icon_border_radius',
		    [
		        'label' => esc_html__( 'Wrapper Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => ['team_grid_style' => ['style1','style2']]
		    ]
		);


		$this->add_responsive_control(
            'social_svgicon_width',
            [
                'label' => esc_html__('Svg Icon Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons .social-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-grid-style3 .team-item .social-icons .social-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'social_svgicon_height',
            [
                'label' => esc_html__('Svg Icon Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons .social-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-grid-style3 .team-item .social-icons .social-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'Social_icon_margin',
            [
                'label' => esc_html__( 'Icon Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ], 
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'social_icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ], 
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'social_icon_font_size',
            [
                'label' => esc_html__( 'Font Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
					'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons a i' => 'font-size: {{SIZE}}{{UNIT}};',                 
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon i' => 'font-size: {{SIZE}}{{UNIT}};',                 
                ],
            ]
        );

		$this->add_responsive_control(
		    'soicon_border_radius',
		    [
		        'label' => esc_html__( 'Social Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => ['team_grid_style' => 'style3']
		    ]
		);

		$this->add_responsive_control(
            'social_svgicon_top_pos',
            [
                'label' => esc_html__('Social Top Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons' => 'top: {{SIZE}}{{UNIT}};bottom:unset;',
                ],
				'condition' => ['team_grid_style' => ['style1','style2']]
            ]
        );
		$this->add_responsive_control(
            'social_svgicon_bottom_pos',
            [
                'label' => esc_html__('Social Bottom Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons' => 'bottom: {{SIZE}}{{UNIT}};top:unset;',
                ],
				'condition' => ['team_grid_style' => ['style1','style2']]
            ]
        );
		$this->add_responsive_control(
            'social_svgicon_hover_bottom_pos',
            [
                'label' => esc_html__('Social Hover Bottom Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style2 .team-item:hover .image-wrap .social-icons' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
				'condition' => ['team_grid_style' => 'style2']
            ]
        );

		$this->add_responsive_control(
            'social_svgicon_left_pos',
            [
                'label' => esc_html__('Social Left Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons' => 'left: {{SIZE}}{{UNIT}};right:unset;',
                ],
				'condition' => ['team_grid_style' => ['style1','style2']]
            ]
        );

		$this->add_responsive_control(
            'social_svgicon_right_pos',
            [
                'label' => esc_html__('Social Right Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .image-wrap .social-icons' => 'right: {{SIZE}}{{UNIT}};left:unset;',
                ],
				'condition' => ['team_grid_style' => ['style1','style2']]
            ]
        );

		$this->add_responsive_control(
            'social_width_width',
            [
                'label' => esc_html__('Social Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'social_height',
            [
                'label' => esc_html__('Social Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'social_margin_top',
            [
                'label' => esc_html__('Social Margin Top', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
				'condition' => ['team_grid_style' => 'style3']
            ]
        );

		$this->start_controls_tabs( '_tabs_social' );
		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );  

		$this->add_control(
            'social_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icon i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .social-icon svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );
		$this->add_control(
            'social_icon_bgcolor',
            [
                'label' => esc_html__( 'Icon BG Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'social_border_normal',
		        'selector' => '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );
		$this->add_control(
            'social_icon_hover_color',
            [
                'label' => esc_html__( 'Hover Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icon i:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .social-icon:hover i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .team-grid-style3 .team-item .social-icons .social-icon:hover i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .social-icon svg:hover' => 'fill: {{VALUE}} !important;',
                    '{{WRAPPER}} .social-icon:hover svg' => 'fill: {{VALUE}} !important;',
                    '{{WRAPPER}} .team-grid-style3 .team-item .social-icons .social-icon:hover svg' => 'fill: {{VALUE}} !important;',
                ],
            ]
        ); 
		$this->add_control(
            'social_icon_hover_bgcolor',
            [
                'label' => esc_html__( 'Icon Hover BG Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'social_border_hover',
		        'selector' => '{{WRAPPER}} .rs-team-grid .team-item .social-icons .social-icon:hover',
		    ]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//Popup Style Setting
		$this->start_controls_section(
			'section_popup_style',
			[
				'label' => esc_html__( 'Popup Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'team_grid_popup_style' => 'popup',
				]
			]
		);
		$this->add_control(
            'popup_title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,                              
            ]
        );
        $this->add_control(
            'popup_designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );
        $this->add_control(
            'popup_content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );	
        $this->add_control(
            'popup_phn_email_color',
            [
                'label' => esc_html__( 'Phone and Email Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );		
        $this->add_control(
            'popup_icon_color',
            [
                'label' => esc_html__( 'Close Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
        );
        $this->add_control(
            'popup_icon_bg_color',
            [
                'label' => esc_html__( 'Close Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
        );
        $this->add_control(
            'popup_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
        );
		$this->add_control(
            'popup_social_icon_color',
            [
                'label' => esc_html__( 'Social Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
        );
        $this->add_control(
            'social_popup_icon_bg_color',
            [
                'label' => esc_html__( 'Social Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
        );
		$this->add_control(
            'popup_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,                              
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[
				'label' => esc_html__( 'Content Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'content_max_width',
            [
                'label' => esc_html__('Content Max Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .team-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'content_bottom_pos',
            [
                'label' => esc_html__('Content Bottom Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .team-content' => 'bottom: {{SIZE}}{{UNIT}};top:unset;',
                ],
            ]
        );
		$this->add_responsive_control(
		    'item_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item .team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		
		$this->add_responsive_control(
		    'item_tem_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],

		    ]
		);
		
		$this->add_responsive_control(
		    'team_wrapper_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-grid .team-item .team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_box___shadow',
				'label' => esc_html__( 'Box Shadow', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-team-grid .team-item .team-content',
			]
		);

		$this->add_control(
            'contetn_hover_line_bg_color',
            [
                'label' => esc_html__( 'Hover LIne BG Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-grid .team-item .team-content:after' => 'background: {{VALUE}} !important;',
                ],
				'condition' => ['team_grid_style' => ['style2','style1']]
            ]
        );
		
		$this->start_controls_tabs( '_tabs_content' );

		$this->start_controls_tab(
            'style_normal_contenttab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );  
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'team_content_background',
				'label' => esc_html__( 'Content Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-team-grid .team-item .team-content',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border__',
				'selector' => '{{WRAPPER}} .rs-team-grid .team-item .team-content',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab2',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'team_content_hover_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-team-grid .team-item .team-content:hover',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border__hover',
				'selector' => '{{WRAPPER}} .rs-team-grid .team-item .team-content:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display(); 

		$social_popup_icon_bg_color = $settings['social_popup_icon_bg_color'] ?? '';
		$popup_border_color = $settings['popup_border_color'] ?? '';
		$popup_icon_color = $settings['popup_icon_color'] ?? '';
		$popup_icon_bg_color = $settings['popup_icon_bg_color'] ?? '';

		$popup_title_color = !empty( $settings['popup_title_color']) ? 'style="color: '.$settings['popup_title_color'].'"' : '';
		$popup_social_icon_color = $settings['popup_social_icon_color'] ?? '';
		$popup_designation_color = !empty( $settings['popup_designation_color']) ? 'style="color: '.$settings['popup_designation_color'].'"' : '';
		$popup_content_color = !empty( $settings['popup_content_color']) ? 'style="color: '.$settings['popup_content_color'].'"' : '';
		$popup_phn_email_color = !empty( $settings['popup_phn_email_color']) ? 'style="color: '.$settings['popup_phn_email_color'].'"' : '';
		$popup_background = !empty( $settings['popup_background']) ? 'style="background: '.$settings['popup_background'].'"' : '';


		$clip_path = $settings['clip_path'];
		$clip_path_css = '';
		if ($clip_path == 'yes') {
			$clip_path_css = 'clip-path-enable';
		}
		
		if($settings['team_grid_source'] == 'dynamic'){

			if('style1' == $settings['team_grid_style']){
				include plugin_dir_path(__FILE__)."/style1.php";
			}
			elseif('style2' == $settings['team_grid_style']){
				include plugin_dir_path(__FILE__)."/style2.php";
			}
			else {
				include plugin_dir_path(__FILE__)."/style3.php";
			}
		}else{ ?>


			<div class="rs-team-grid rs-team team-grid-<?php echo esc_html($settings['team_grid_style']);?>  <?php echo esc_html($settings['team_grid_popup_style']);?> rsaddon_pro_box <?php echo $clip_path_css;?>">
				<?php 
					$unique = rand(2012,3554120);
					$teamtarget = $settings['team_link']['is_external'] ? 'target=_blank' : '';
				?>
				<div class="team-item">
					<div class="team-inner-wrap">
						<div class="image-wrap">
							<a href="<?php echo esc_url($settings['team_link']['url']); ?>" <?php echo esc_attr($teamtarget); ?>>
								<?php if ( $settings['memeber_image']['url'] ) : ?>
			                       <img src="<?php echo esc_url($settings['memeber_image']['url']);?>"  alt="<?php echo esc_url($settings['memeber_image']['url']);?>" />
			                    <?php endif; ?>
							</a>
							<?php if('style1' == $settings['team_grid_style'] || 'style2' == $settings['team_grid_style']){ ?>
							<?php if ( !empty(is_array( $settings['social_icon_list'] )) ) : ?>
						  		
								  <div class="social-icons">	
									  <?php foreach ( $settings['social_icon_list'] as $index => $item ) :

										  $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
										  $link         = !empty($item['link']['URL']) ? $item['link']['URL'] : '';
									  ?>
															  
										  <a href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
											  <?php \Elementor\Icons_Manager::render_icon( $item['social_profile'], [ 'aria-hidden' => 'true' ] ); ?>
										  </a>			
									  
										 <?php  endforeach; ?>   
									 </div>
						  <?php endif; ?>	
						  <?php } ?>
						</div>

						<div class="team-content">
							<div class="member-desc">								
								<?php if($settings['title']):?>
						       		<h3 class="team-name"><a href="<?php echo esc_url($settings['team_link']['url']); ?>" <?php echo esc_attr($teamtarget); ?>><?php echo esc_html($settings['title']);?></a></h3>
						        <?php endif; 

								if($settings['designation']) : ?>
									<span class="team-title"><?php echo esc_html($settings['designation']);?></span>
								<?php endif ; ?>
							</div>
							<?php if($settings['bio']): ?>
						        	<p class="team-desc"><?php echo esc_html($settings['bio']);?></p>
			                  	<?php endif; ?>		
								  <?php if('style3' == $settings['team_grid_style']){ ?>
							<?php if ( !empty(is_array( $settings['social_icon_list'] )) ) : ?>
						  		
								  <div class="social-icons">	
									  <?php foreach ( $settings['social_icon_list'] as $index => $item ) :

										  $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
										  $link         = !empty($item['link']['URL']) ? $item['link']['URL'] : '';
									  ?>
															  
										  <a href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
											  <?php \Elementor\Icons_Manager::render_icon( $item['social_profile'], [ 'aria-hidden' => 'true' ] ); ?>
										  </a>			
									  
										 <?php  endforeach; ?>   
									 </div>
						  <?php endif; ?>	
						  <?php } ?>						  	
						  		
						</div>
			  		</div>
			  	</div>

			</div>
		<?php 

		}		
	}

	public function getCategories(){
        $cat_list = [];
         	if ( post_type_exists( 'teams' ) ) { 
          	$terms = get_terms( array(
             	'taxonomy'    => 'team-category',
             	'hide_empty'  => true            
         	) );           
         
  
	        foreach($terms as $post) {
	        	$cat_list[$post->slug]  = [$post->name];
	        }
    	}  
        return $cat_list;
    }
}
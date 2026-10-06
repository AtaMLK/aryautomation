<?php
/**
 * Elementor rsteam Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Team_Slider_Pro_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve rsteam widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rsteam-slider';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve rsteam widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS Team Slider', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsteam widget icon.
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
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'primary_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Scheme', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Scheme', 'rsaddon'),				
					'secondary_scheme' => esc_html__('Secondary Scheme', 'rsaddon'),
					'gradient_scheme' => esc_html__('Gradient Scheme', 'rsaddon')				
				],											
			]
		);

		$this->add_control(
			'team_slider_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'default' => 'Default 1',
					'style1' => 'Style 1',
					'style2' => 'Style 2',
					'style3' => 'Style 3',
					'style4' => 'Style 4',
					'style5' => 'Style 5',
					'style6' => 'Style 6',
					'style7' => 'Style 7',
					'style8' => 'Style 8',
					'style9' => 'Style 9',
					'style10' => 'Style 10',
					'style11' => 'Style 11',
				],
			]
		);


		$this->add_control(
			'team_link_condition',
			[
				'label'   => esc_html__( 'Link Enable / Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'enable',				
				'options' => [
					'enable' => 'Enable',
					'disable' => 'Disable',
				],											
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
			]

		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Team Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'rsaddon' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'separator_text',
			[
				'label' => esc_html__( 'Separator Text ', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( ' / ', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
					'team_slider_style'	=> 'style11'
				],
			]
		);
		$this->add_control(
			'col_lg',
			[
				'label'   => esc_html__( 'Desktops > 1199px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3,
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
			
		);
		$this->add_control(
			'col_md',
			[
				'label'   => esc_html__( 'Desktops > 991px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3,			
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),						
				],
				'separator' => 'before',
							
			]
			
		);
		$this->add_control(
			'col_sm',
			[
				'label'   => esc_html__( 'Tablets > 767px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 2,			
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'col_xs',
			[
				'label'   => esc_html__( 'Tablets < 768px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 1,			
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slides_ToScroll',
			[
				'label'   => esc_html__( 'Slide To Scroll', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 2,			
				'options' => [
					'1' => esc_html__( '1 Item', 'rsaddon' ),
					'2' => esc_html__( '2 Item', 'rsaddon' ),
					'3' => esc_html__( '3 Item', 'rsaddon' ),
					'4' => esc_html__( '4 Item', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
			
		);

		

		$this->add_control(
			'slider_dots',
			[
				'label'   => esc_html__( 'Navigation Dots', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 'false',
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_nav',
			[
				'label'   => esc_html__( 'Navigation Nav', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 'false',			
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 'false',			
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_autoplay_speed',
			[
				'label'   => esc_html__( 'Autoplay Slide Speed', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3000,			
				'options' => [
					'1000' => esc_html__( '1 Seconds', 'rsaddon' ),
					'2000' => esc_html__( '2 Seconds', 'rsaddon' ),	
					'3000' => esc_html__( '3 Seconds', 'rsaddon' ),	
					'4000' => esc_html__( '4 Seconds', 'rsaddon' ),	
					'5000' => esc_html__( '5 Seconds', 'rsaddon' ),	
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_stop_on_hover',
			[
				'label'   => esc_html__( 'Stop on Hover', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',				
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_interval',
			[
				'label'   => esc_html__( 'Autoplay Interval', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3000,			
				'options' => [
					'5000' => esc_html__( '5 Seconds', 'rsaddon' ),	
					'4000' => esc_html__( '4 Seconds', 'rsaddon' ),	
					'3000' => esc_html__( '3 Seconds', 'rsaddon' ),	
					'2000' => esc_html__( '2 Seconds', 'rsaddon' ),	
					'1000' => esc_html__( '1 Seconds', 'rsaddon' ),		
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_loop',
			[
				'label'   => esc_html__( 'Loop', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_centerMode',
			[
				'label'   => esc_html__( 'Center Mode', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),
				],
				'separator' => 'before',
							
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
            ]
        );  


        $this->add_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],		
				

				'selectors' => [
                    '{{WRAPPER}} .team-item-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		); 
  
				
		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Team Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'team_alignments',
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
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .team-item' => 'text-align: {{VALUE}}'
                ],
            ]
        );
        $this->add_responsive_control(
		    'team_item_padding',
		    [
		        'label' => esc_html__( 'Team Item Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-slider .team-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'team_item_inner__padding',
		    [
		        'label' => esc_html__( 'Team Inner Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-slider .team-item .team-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'team_item_inner__margin',
		    [
		        'label' => esc_html__( 'Team Inner Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-slider .team-item .team-inner-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .team-name a' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .member-desc .team-name a' => 'color: {{VALUE}};',
                ],
				'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .team-name a:hover, {{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a:hover, {{WRAPPER}} .rs-team-slider.team-slider-style11 .team-item .team-content-inner .team-content .inner-ctn .team-name a:hover' => 'color: {{VALUE}};',
                ],          
            ]
        );
		$this->add_control(
            'team_highlight_color',
            [
                'label' => esc_html__( 'Highlight Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content h3.team-name a span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .member-desc .team-name a span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style1 .team-item .team-content h3.team-name a span' => 'color: {{VALUE}};',
                ],
				'separator' => 'before'
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .team-content .team-name, {{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .member-desc .team-name a, {{WRAPPER}} .team-slider-style4 .team-item .team-content .team-name a, {{WRAPPER}} .team-slider-style2 .team-item-wrap .team-img .team-content .team-name a, {{WRAPPER}} .team-slider-style1 .team-item .team-content h3.team-name a,{{WRAPPER}} .team-slider-style10 .team-item .team-content h3.team-name a',
			]
		);
		$this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-content .team-name, {{WRAPPER}} .rs-team.team-slider-style11  .inner-ctn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style10 .team-item .team-inner-wrap .team-content span.team-title' => 'color: {{VALUE}};',

                ],                
            ]
        );

         $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => esc_html__( 'Designation Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .team-content .team-title, {{WRAPPER}} .team-slider-style4 .team-item .team-content .team-title,{{WRAPPER}} .team-slider-style10 .team-item .team-inner-wrap .team-content span.team-title',
			]
		);
        $this->add_control(
            'content_hover_bg',
            [
                'label' => esc_html__( 'Content Hover Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content' => 'background: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'content_hover_text_color',
            [
                'label' => esc_html__( 'Content Hover Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-inner-wrap:hover .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .member-desc .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .social-icons a i' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content .team-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec .team-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-text' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'content_top_border_color',
            [
                'label' => esc_html__( 'Content Top Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-text::before' => 'background: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'content_bottom_border_color',
            [
                'label' => esc_html__( 'Content Bottom Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content::before' => 'background: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec::before' => 'background: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'image_corner_border_color',
            [
                'label' => esc_html__( 'Image Corner Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style3 .team-img::before' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img::after' => 'border-top-color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_responsive_control(
		    'title_margin_for_s_seven',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		         'condition' => [
                	'team_slider_style' => 'style7',
                ],
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-slider-style7 .team-item .team-content h3.team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_control(
			'grid_part_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Grid Part', 'rsaddon' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
		    'grid_border_radius',
		    [
		        'label' => esc_html__( 'Grid Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-item-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'item_padding_area',
		    [
		        'label' => esc_html__( 'Team Area Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team .team-item .team-item-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'item_margin_area',
		    [
		        'label' => esc_html__( 'Team Area Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team .team-item .team-item-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'item_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .team-inner-wrap',
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .team-item-wrap,{{WRAPPER}} .team-slider-style10 .team-item .team-inner-wrap .image-wrap:before, {{WRAPPER}} .team-slider-style11 .team-item .team-inner-wrap .image-wrap:before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_box_shadow_hover',
				'label' => esc_html__( 'Hover Box Shadow', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .team-item-wrap:hover',
			]
		);
        $this->add_control(
			'image_background_animation_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Background Animation', 'rsaddon' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_background_animation',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
                	'team_slider_style' => 'style7',
                ],
				'selector' => '{{WRAPPER}} .rs-team-slider.team-slider-style7 .image-wrap .image-inner:after',
			]
		);
		$this->add_responsive_control(
			'image_background_position_y',
			[
				'label' => esc_html__( 'Background Animation Vertical Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'condition' => [
                	'team_slider_style' => 'style7',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style7 .image-wrap .image-inner:after' => 'top: {{SIZE}}{{UNIT}}',
                ],
			]
		);
		$this->add_responsive_control(
			'image_background_position_x',
			[
				'label' => esc_html__( 'Background Animation Horizontal Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'condition' => [
                	'team_slider_style' => 'style7',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style7 .image-wrap .image-inner:after' => 'right: {{SIZE}}{{UNIT}}',
                ],
			]
		);
		// Image Part Style
        $this->add_control(
			'image_part_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Image Part', 'rsaddon' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
		    'image_border_radius',
		    [
		        'label' => esc_html__( 'Image Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-slider-style7 .team-item .image-inner, {{WRAPPER}} .team-inner-wrap .image-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		        ],
				'condition' => [
					'team_slider_style!' => 'style8',
				]
		    ]
		);
		$this->add_responsive_control(
			'img_width_for_style_nine',
			[
				'label' => esc_html__( 'Image Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'condition' => [
                	'team_slider_style' => 'style9',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style9 .team-inner-wrap .image-wrap img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_part_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .team-item .image-wrap',
				'condition' => [
					'team_slider_style' => 'style8',
				]
			]
		);
		$this->add_responsive_control(
		    'image_part_padding',
		    [
		        'label' => esc_html__( 'Image Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-item .image-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'team_slider_style' => 'style8',
				]
		    ]
		);
		$this->add_responsive_control(
		    'img_tag_border_radius',
		    [
		        'label' => esc_html__( 'Img Tag Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-item .image-wrap .img-inner-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		        ],
				'condition' => [
					'team_slider_style' => 'style8',
				]
		    ]
		);
		$this->add_responsive_control(
		    'image_wrap_border_radius',
		    [
		        'label' => esc_html__( 'Image Wrapper Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-item .image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		        ],
				'condition' => [
					'team_slider_style' => 'style8',
				]
		    ]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_part_border',
				'selector' => '{{WRAPPER}} .team-item .image-wrap .img-inner-wrap',
				'condition' => [
					'team_slider_style' => 'style8',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_part_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .team-item .image-wrap .img-inner-wrap',
				'condition' => [
					'team_slider_style' => 'style8',
				]
			]
		);
		$this->add_control(
			'_image_overlay_heading8',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Image Overlayer', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
					'team_slider_style' => 'style8',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_overlay8',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap:after',
				'condition' => [
					'team_slider_style' => 'style8',
				],
			]
		);

		// Icon Part Style
        $this->add_control(
			'icon_part_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon Part', 'rsaddon' ),
				'separator' => 'before',
			]
		);

        $this->add_control(
            'icon_section_bg',
            [
                'label' => esc_html__( 'Icon Section Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style1',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-content i.fi-rr-share, {{WRAPPER}} div.team-content .social-icons1, {{WRAPPER}} .team-slider-style1 .team-item .image-wrap .social-icons1' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style1 .team-item .image-wrap .social-icons1:after' => 'border-top-color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_responsive_control(
			'icon_font_size',
			[
				'label' => esc_html__( 'Icon Font Size', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 15,
				],				

				'selectors' => [
                     '{{WRAPPER}} .social-icons1 a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-social a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-social a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-item .social-icons a i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
			]
		);
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .social-icons1 a i, {{WRAPPER}} .team-content i.fi-rr-share, {{WRAPPER}} .social-icons1 a i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .team-social a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-item .team-content .social-icons a' => 'color: {{VALUE}};',
                ],
				'condition' => [
                	'team_slider_style!' => ['style8'],
                ]            
            ]
        );
        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons1 a i' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-social a i' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .social-icons a i' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .social-icons a i' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a i' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-item .team-content .social-icons a' => 'background: {{VALUE}};',
                ],
				'condition' => [
                	'team_slider_style!' => ['style8'],
                ]
            ]
        );

		$this->add_control(
            'icon_wrapper_bg_color',
            [
                'label' => esc_html__( 'Social Wrapper Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-slider .team-content-inner .team-content .plus_team .social-icons1' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .social-icons1 a:hover i, {{WRAPPER}} .social-icons1 a i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social a i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-item .team-content .social-icons a:hover' => 'color: {{VALUE}};',
                ],
				'condition' => [
                	'team_slider_style!' => ['style8'],
                ]
            ]
        );

		$this->add_control(
            'icon_hover_bg_color',
            [
                'label' => esc_html__( 'Icon Hover Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons1 a i:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-social a i:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .social-icons a i:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .social-icons a i:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a i:hover' => 'background: {{VALUE}};',
                ],
				'condition' => [
                	'team_slider_style!' => ['style8'],
                ]
            ]
        );

		$this->add_responsive_control(
			'social_icon_postion',
			[
				'label' => esc_html__( 'Social Icons Position ', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => ['style10','style11'],
				],
				'selectors' => [
                    '{{WRAPPER}} .team-slider-style10 .team-content-inner .team-content .plus_team .social-icons1,' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
                    '{{WRAPPER}} .team-slider-style11 .team-content-inner .team-content .plus_team .social-icons1,' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;'
                ],
			]
		);


		$this->add_control(
			'social_share_icon_bg',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Share Icon Background', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'share_social_bg_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .team-item .team-inner-wrap .team-content .plus_team i.ri-share-line',
			]
		);
		$this->add_responsive_control(
			'social_share_icon_width',
			[
				'label' => esc_html__( 'Social Share Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'selectors' => [
                    '{{WRAPPER}} .team-item .team-inner-wrap .team-content .plus_team i.ri-share-line' => 'width: {{SIZE}}{{UNIT}}',
                ],
			]
		);
		$this->add_responsive_control(
			'social_share_icon_height',
			[
				'label' => esc_html__( 'Social Share Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'selectors' => [
                    '{{WRAPPER}} .team-item .team-inner-wrap .team-content .plus_team i.ri-share-line' => 'height: {{SIZE}}{{UNIT}};border-radius:50%;display:flex;align-items:center;justify-content:center;',
                ],
			]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'social_shapre_typography',
		        'label' => esc_html__( 'Social Shape Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .team-item .team-inner-wrap .team-content .plus_team i.ri-share-line, {{WRAPPER}} .team-slider-style11 .social-icons1 a i',
		        
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'social_share_border_color',
		        'selector' => '{{WRAPPER}} .team-slider-style10 .team-content-inner .team-content .plus_team, {{WRAPPER}} .rs-team-slider.team-slider-style11 .team-item .team-content-inner .team-content .plus_team .social-icons1 a',
				'condition' => [
                	'team_slider_style' => ['style10','style11'],
                ]
		    ]
		);

		$this->add_control(
            'share_icon_colorsocial',
            [
                'label' => esc_html__( 'Social Share Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-inner-wrap .team-content .plus_team i.ri-share-line' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-team-slider.team-slider-style11 .team-item .team-content-inner .team-content .plus_team .social-icons1 a i:before' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'share_icon_hover_sharecolor_social',
            [
                'label' => esc_html__( 'Social Share Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-inner-wrap .team-content .plus_team i.ri-share-line:hover' => 'color: {{VALUE}};',
                    
                ],
            ]
        );
		
        $this->add_control(
            'share_icon_hover_color_social',
            [
                'label' => esc_html__( 'Social Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-slider .team-content .plus_team .social-icons1 a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-team-slider.team-slider-style11 .team-item .team-content-inner .team-content .plus_team .social-icons1 a:hover i::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'social_icons_wrapper_width',
			[
				'label' => esc_html__( 'Social Icons Wrapper Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => ['style1', 'style2'],
                	'team_slider_style!' => ['style8'],
                ],
				'selectors' => [
                    '{{WRAPPER}} .team-content .plus_team .social-icons1' => 'width: {{SIZE}}{{UNIT}}',
                ],
			]
		);

		// Social Icon Style 8 Start
		$this->add_control(
            'icon_color8',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a' => 'color: {{VALUE}};',
                ],
				'condition' => [
                	'team_slider_style' => ['style8'],
                ]            
            ]
        );
		$this->add_control(
            'icon_color_hover8',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a:hover' => 'color: {{VALUE}};',
                ],
				'condition' => [
                	'team_slider_style' => ['style8'],
                ]
            ]
        );
		$this->add_control(
            'icon_bg_color8',
            [
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a' => 'background: {{VALUE}};',
                ],
				'condition' => [
                	'team_slider_style' => ['style8'],
                ]
            ]
        );
		$this->add_control(
            'icon_hover_bg_color8',
            [
                'label' => esc_html__( 'Icon Hover Bg', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a:hover' => 'background: {{VALUE}};'
                ],
				'condition' => [
                	'team_slider_style' => ['style8'],
                ]
            ]
        );
        $this->add_responsive_control(
			'social_icons_width8',
			[
				'label' => esc_html__( 'Icons Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => ['style8'],
                ],
				'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a' => 'width: {{SIZE}}{{UNIT}}; text-align: center;',
                ],
			]
		);
        $this->add_responsive_control(
			'social_icons_height',
			[
				'label' => esc_html__( 'Icons Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => ['style8'],
                ],
				'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a' => 'height: {{SIZE}}{{UNIT}}; display: flex; align-items: center; justify-content: center;',
                ],
			]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'social_icon_border8',
		        'selector' => '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a',
				'condition' => [
                	'team_slider_style' => ['style8'],
                ]
		    ]
		);
		$this->add_control(
            'social_icon_hover_border_color8',
            [
                'label' => esc_html__( 'Hover Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a:hover' => 'border-color: {{VALUE}};'
                ],
				'condition' => [
                	'team_slider_style' => ['style8'],
                ]
            ]
        );
		$this->add_responsive_control(
			'social_icon_position_y',
			[
				'label' => esc_html__( 'Icons Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => ['style8'],
				],
				'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .team-item-wrap .image-wrap .img-inner-wrap .team-social' => 'top: {{SIZE}}{{UNIT}}; transform: translateY(-{{SIZE}}{{UNIT}}); bottom: unset;',
                ],
			]
		);
		$this->add_responsive_control(
			'social_icon_position_y_hover',
			[
				'label' => esc_html__( 'Icons Position Y (Hover)', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => ['style8'],
				],
				'selectors' => [
                    '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .team-item-wrap:hover .image-wrap .img-inner-wrap .team-social' => 'top: {{SIZE}}{{UNIT}}; transform: translateY(-{{SIZE}}{{UNIT}}); bottom: unset;',
                ],
			]
		);
		$this->add_responsive_control(
		    'social_icon_spacing8',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
                	'team_slider_style' => ['style8'],
				],
		    ]
		);
		$this->add_responsive_control(
		    'social_icon_border_radius8',
		    [
		        'label' => esc_html__( 'Icon Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-slider.team-slider-style8 .team-item .image-wrap .img-inner-wrap .team-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
                	'team_slider_style' => ['style8'],
				],
		    ]
		);
		// Social Icon Style 8 End

        $this->add_responsive_control(
			'social_icons_position_x',
			[
				'label' => esc_html__( 'Icons Position X', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => 'style1',
                ],
				'selectors' => [
                    '{{WRAPPER}} .team-content .plus_team .social-icons1' => 'right: {{SIZE}}{{UNIT}}',
                ],
			]
		);

        $this->add_responsive_control(
			'social_icons_position_y',
			[
				'label' => esc_html__( 'Icons Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
                	'team_slider_style' => 'style1',
                	'team_slider_style!' => 'style8',
                ],
				'selectors' => [
                    '{{WRAPPER}} .team-content .plus_team .social-icons1' => 'bottom: {{SIZE}}{{UNIT}}',
                ],
			]
		);

		$this->add_responsive_control(
		    'social_icons_wrapper_padding',
		    [
		        'label' => esc_html__( 'Social Icons Wrapper Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'condition' => [
                	'team_slider_style' => 'style1',
                ],
		        'selectors' => [
		            '{{WRAPPER}} .team-content .plus_team .social-icons1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'social_icon_borderd',
		        'selector' => '{{WRAPPER}} .team-item .social-icons a i',
				'condition' => [
                	'team_slider_style!' => ['style8'],
                ]
		    ]
		);

        $this->add_responsive_control(
			'social_button_position_x',
			[
				'label' => esc_html__( 'Social Button Position X', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'show_label' => true,
				'separator' => 'before',
				'condition' => [
                	'team_slider_style' => 'style1',
                ],
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'selectors' => [
                    '{{WRAPPER}} .team-item .social-icons a i' => 'right: {{SIZE}}{{UNIT}}',
                ],
			]
		);
        $this->add_responsive_control(
			'social_button_position_y',
			[
				'label' => esc_html__( 'Social Button Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'condition' => [
                	'team_slider_style' => 'style1',
                ],
				'size_units' => [ 'px', '%' ],
				'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'selectors' => [
                    '{{WRAPPER}} .team-content .plus_team i.fi-rr-share' => 'top: {{SIZE}}{{UNIT}}',
                ],
			]
		);
		$this->add_responsive_control(
		    'social_icon_border_radius',
		    [
		        'label' => esc_html__( 'Social Icon Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-item .social-icons a i, {{WRAPPER}} .rs-team-slider.team-slider-style11 .team-item .team-content-inner .team-content ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'team_slider_style!' => 'style8',
				]
		    ]
		);
		$this->add_responsive_control(
		    'social_icon_margin',
		    [
		        'label' => esc_html__( 'Social Icons Part Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .social-icons, {{WRAPPER}} .rs-team-slider.team-slider-style11 .team-item .team-content-inner .team-content .plus_team .social-icons1 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'team_slider_style!' => 'style8',
				]
		    ]
		);
        // Content Part Style
		$this->add_control(
			'content_part_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Content Part', 'rsaddon' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
		    'content_wrapper',
		    [
		        'label' => esc_html__( 'Content Wrapper', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}}  .team-content-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'team_slider_style' => 'style11',
				]
		    ]
		);
		$this->add_responsive_control(
		    'content_padding',
		    [
		        'label' => esc_html__( 'Content Part Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-item .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'content_part_b_r',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}}  .team-item  .team-content ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'team_slider_style' => 'style11',
				]
		    ]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'label' => esc_html__( 'Content Box Shadow', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .team-item .team-content',
			]
		);
		$this->add_control(
		    'content_top_hover_border_color',
		    [
		        'label' => esc_html__( 'Content Top Hover Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-team-slider.team-slider-style11 .team-item .team-content-inner .team-content::after' => 'background: {{VALUE}};',  
		        ],
		        'condition' => [
                	'team_slider_style' => 'style11',
                ],                
		    ]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .team-item .team-content',
				
			]
		);
		$this->add_control(
		    'background_title_image',
		    [
		    	'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Image Background', 'rsaddon' ),
				'condition' => [
                	'team_slider_style' => 'style7',
                ],
		        'separator' => 'before', 
		    ]
		);
		$this->add_responsive_control(
		    'image_padding_area',
		    [
		        'label' => esc_html__( 'Image Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-slider-style7 .team-item .image-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
                	'team_slider_style' => 'style7',
                ],
		    ]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_image',
				'label' => esc_html__( 'Image Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .team-slider-style7 .team-item .image-wrap',
				'condition' => [
                	'team_slider_style' => 'style7',
                ],
			]
		);
		$this->add_control(
		    'item_background_title',
		    [
		    	'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Item Background', 'rsaddon' ),
		        'separator' => 'before', 
		    ]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'item_background',
				'label' => esc_html__( 'Item Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .team-item-wrap,{{WRAPPER}} .team-slider-style10 .team-item .team-inner-wrap .image-wrap:before,{{WRAPPER}} .team-slider-style11 .team-item .team-inner-wrap .image-wrap:before' ,
			]
		);
		$this->add_control(
		    'social_icons_style',
		    [
		    	'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Social Icon Section', 'rsaddon' ),
		        'separator' => 'before', 
		    ]
		);
		$this->add_responsive_control(
			'si_section_alignment',
			[
				'label'   => esc_html__( 'Section Inline', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => 'Block',
					'inline-block' => 'Inline',
					
				],
				'selectors' => [
					'{{WRAPPER}} .social-icons, {{WRAPPER}} .team-social' => 'display: {{VALUE}};',
				]
			]
		);
		$this->add_control(
		    'social_icon_color_for_style_seven',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a i' => 'color: {{VALUE}};',  
		        ],
		        'condition' => [
                	'team_slider_style' => 'style7',
                ],                
		    ]
		);
		$this->add_control(
		    'social_icon_hover_color_for_style_seven',
		    [
		        'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a:hover i' => 'color: {{VALUE}};',  
		        ],
		        'condition' => [
                	'team_slider_style' => 'style7',
                ],                
		    ]
		);
		$this->add_responsive_control(
		    'si_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .social-icons, {{WRAPPER}} .team-social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'si_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .social-icons, {{WRAPPER}} .team-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'si_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .social-icons, {{WRAPPER}} .team-social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'si_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .social-icons, {{WRAPPER}} .team-social',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
		    'social_icon_style_section',
		    [
		        'label' => esc_html__( 'Social Icon Style', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		        'condition'	=> [
		        	'team_slider_style!' => 'style11',
		        ]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'social_icon_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
				{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a i',
		        
		    ]
		);
		$this->add_responsive_control(
		    'social_icon_border_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
					{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'social_icon_border_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
					{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
		    ]
		);
		$this->add_responsive_control(
            'social_icon_gap',
            [
                'label' => esc_html__( 'Gap Between Icons', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ 'px', '%' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .social-icons,
					{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons' => 'gap: {{SIZE}}{{UNIT}};',                   
                ]
            ]
        );
		$this->add_responsive_control(
		    'social_icon_border_radius_one',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
					{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
		    ]
		);
		$this->start_controls_tabs( '_social_icons_tabs_section' );

				$this->start_controls_tab(
					'social_icon_tab_normal_color',
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
							'{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
							{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a' => 'color: {{VALUE}};',
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'social_icon_border',
						'selector' => '{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
						{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'social_icon_bg_color',
						'label' => esc_html__( 'Icon Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
						{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a',
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'social_icon_tab_hover_color',
					[
						'label' => esc_html__( 'Hover', 'rsaddon' ),
					]
				);
				$this->add_control(
					'social_icon_hover_color',
					[
						'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rsaddon-unique-slider .social-icons a:hover,
							{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a:hover' => 'color: {{VALUE}};',
						]
					]
				);
				$this->add_control(
					'social_icon_hover_border_color',
					[
						'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rsaddon-unique-slider .social-icons a:hover,
							{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a:hover' => 'border-color: {{VALUE}};',
						]
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'social_icon_hover_bg_color',
						'label' => esc_html__( 'Icon Hover Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .rsaddon-unique-slider .social-icons a:hover,
						{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a:hover',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'social_icon_box_shadow',
					'selector' => '{{WRAPPER}} .rsaddon-unique-slider .social-icons a,
					{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .image-wrap .social-icons a',
				]
			);

			$this->add_control(
				'hr1',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
					'condition' => ['team_slider_style' => 'default']
				]
			);
			$this->add_control(
				'social_icon_trigger_button_heading',
				[
					'type' => Controls_Manager::HEADING,
					'label' => esc_html__( 'Icon Trigger Button', 'rsaddon' ),
					'condition' => ['team_slider_style' => 'default']
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'social_icon_trigger_button_typography',
					'label' => esc_html__( 'Typography', 'rsaddon' ),
					'selector' => '{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .team-content .social-trigger-btn',
					'condition' => ['team_slider_style' => 'default']
				]
			);
			$this->add_control(
				'social_icon_trigger_button_color',
				[
					'label' => esc_html__( 'Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .team-content .social-trigger-btn' => 'color: {{VALUE}};',
					],
					'condition' => ['team_slider_style' => 'default']
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'social_icon_trigger_button_bg_color',
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'types' => [ 'classic', 'gradient'],
					'selector' => '{{WRAPPER}} .team-slider-default .slider-for .team-inner-wrap .team-content .social-trigger-btn',
					'condition' => ['team_slider_style' => 'default']
				]
			);
		$this->end_controls_section();

		// Bullet Style Start
		$this->start_controls_section(
			'section_slider_style_dots_ontrol',
			[
				'label' => esc_html__('Dots Control', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_dots' => 'true'
				]
			]
		);
		
		$this->add_control(
			'bullet_wrapper_box_style',
			[
				'label' => esc_html__('Dots Wrapper Box', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'bullet_wrapper_box_bg',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots',
			]
		);
		$this->add_responsive_control(
			'bullet_wrapper_box_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_wrapper_box_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_wrapper_box_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'_hr',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'bullet_item_options',
			[
				'label' => esc_html__('Bullet Item Style', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs('_tabs_slider_dots');

		// Normal Bullet Start
		$this->start_controls_tab(
			'slider_dots_normal_tab',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);
		$this->add_control(
			'navigation_dot_inner_color',
			[
				'label' => esc_html__( 'Inner Dot Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'slider_dots_style' => '2',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_inner_dot_height_custom',
			[
				'label' => esc_html__('Inner Dot Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bullet_inner_dot_normal_width_custom',
			[
				'label' => esc_html__('Inner Dot Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_inner_dot_border_radius',
			[
				'label' => esc_html__('Inner Dot Radius', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'navigation_dot_icon_background',
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button',
			]
		);

		$this->add_responsive_control(
			'bullet_height_custom',
			[
				'label' => esc_html__('Bullet Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bullet_normal_width_custom',
			[
				'label' => esc_html__('Bullet Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bullet_border_radius_custom',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'bullet_border_custom',
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'bullet_shadow_custom',
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button'
			]
		);

		$this->end_controls_tab();
		// Normal Bullet End

		// Active Bullet Start
		$this->start_controls_tab(
			'slider_dots_active_tab',
			[
				'label' => esc_html__('Active', 'rsaddon'),
			]
		);
		$this->add_control(
			'navigation_dot_inner_color_active',
			[
				'label' => esc_html__( 'Inner Dot Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'slider_dots_style' => '2',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
					{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_inner_dot_height_custom_active',
			[
				'label' => esc_html__('Inner Dot Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
					{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bullet_inner_dot_active_width_custom',
			[
				'label' => esc_html__('Inner Dot Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
					{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'navigation_dot_icon_background_active',
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover, {{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button',
			]
		);

		$this->add_responsive_control(
			'bullet_active_width_custom',
			[
				'label' => esc_html__('Bullet Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_active_height_custom',
			[
				'label' => esc_html__('Bullet Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_active_scale_custom',
			[
				'label' => esc_html__('Bullet Scale', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'transform: scale({{SIZE}})',
				],
			]
		);

		$this->add_control(
			'navigation_dot_active_border_color',
			[
				'label' => esc_html__('Border Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'border-color: {{VALUE}};',

				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		// Active Bullet End
		$this->add_responsive_control(
			'bullet_spacing_custom',
			[
				'label' => esc_html__('Top Gap', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 25,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_spacing_custom_position',
			[
				'label' => esc_html__('Top Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'show_label' => true,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots' => 'top: {{SIZE}}{{UNIT}}; bottom:unset;',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_spacing_custom_position_bottom',
			[
				'label' => esc_html__('Bottom Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'show_label' => true,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
			]
		);
		$this->end_controls_section();
		// Bullet Style End

		$this->start_controls_section(
		    'section_arrow_style',
		    [
		        'label' => esc_html__( 'Arrow Style', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		        'condition' => [
                	'slider_nav' => 'true',
                ],
		    ]
		);
		$this->add_control(
		    'arrow_color',
		    [
		        'label' => esc_html__( 'Arrow Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:before, {{WRAPPER}} .rsaddon-unique-slider .slick-arrow i' => 'color: {{VALUE}};',  
		        ],                
		    ]
		);
		$this->add_control(
		    'arrow_bg_color',
		    [
		        'label' => esc_html__( 'Arrow Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'background: {{VALUE}};',  
		        ],                
		    ]
		);
		$this->add_control(
		    'arrow_hover_color',
		    [
		        'label' => esc_html__( 'Arrow Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover:before, {{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover i' => 'color: {{VALUE}};',  
		        ],                
		    ]
		);

		$this->add_control(
		    'arrow_hover_bg_color',
		    [
		        'label' => esc_html__( 'Arrow Hover Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover' => 'background: {{VALUE}};',  
		        ],                
		    ]
		);

		$this->add_responsive_control(
		    'arrow_font_size',
		    [
		        'label' => esc_html__( 'Arrow Font Size', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => 0,
		                'max' => 5000,
		            ],
		        ],
		       
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:before, {{WRAPPER}} .rsaddon-unique-slider .slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		        
		    ]
		);
		$this->add_responsive_control(
		    'arrow_opacity_normal',
		    [
		        'label' => esc_html__( 'Arrow Opacity', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1,
						'step' => 0.1,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-arrow' => 'opacity: {{SIZE}};',
		        ],
		        
		    ]
		);
		$this->add_responsive_control(
		    'arrow_opacity_hoverl',
		    [
		        'label' => esc_html__( 'Arrow Opacity (Hover)', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1,
						'step' => 0.1,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider:hover .slick-arrow' => 'opacity: {{SIZE}};',
		        ],
		        
		    ]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ars_border_color',
				'selector' => '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-arrow',
			]
		);
		$this->add_control(
		    'ars_border_color_hover',
		    [
		        'label' => esc_html__( 'Border Color (Hover)', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-arrow:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'testimonial_arrow_box_shadow',
		        'selector' => '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow',
		    ]
		);
		$this->add_responsive_control(
		    'arrow_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
			'arrow_width',
			[
				'label' => esc_html__( 'Arrow Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev, {{WRAPPER}} .rs-addon-slider .slick-next' => 'width: {{SIZE}}{{UNIT}}; display: flex; justify-content: center;',
				]
			]
		);
        $this->add_responsive_control(
			'arrow_height',
			[
				'label' => esc_html__( 'Arrow Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev, {{WRAPPER}} .rs-addon-slider .slick-next' => 'height: {{SIZE}}{{UNIT}}; display: flex; align-items: center;',
				]
			]
		);
        
        $this->add_control(
			'arrow_options',
			[
				'label' => esc_html__( 'Arrow Position', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'arrow_position_maker',
			[
				'label' => esc_html__( 'Arrow Position Style', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'custom' => esc_html__( 'Custom', 'rsaddon' ),
				],
			]
		);

		$this->add_responsive_control(
			'arrow_prev_x_select',
			[
				'label' => esc_html__( 'Prev Position X', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'left' => esc_html__( 'Left', 'rsaddon' ),
					'right' => esc_html__( 'Right', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_left_position',
			[
				'label' => esc_html__( 'Prev Left Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}} !important; right: unset !important;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'left',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_right_position',
			[
				'label' => esc_html__( 'Prev Right Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}} !important; left: unset !important;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'right',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);

		$this->add_responsive_control(
			'arrow_prev_y_select',
			[
				'label' => esc_html__( 'Prev Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'top' => esc_html__( 'Top', 'rsaddon' ),
					'bottom' => esc_html__( 'Bottom', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_top_position',
			[
				'label' => esc_html__( 'Prev Top Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}} !important; bottom: unset !important;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'top',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_bottom_position',
			[
				'label' => esc_html__( 'Prev Bottom Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'bottom: {{SIZE}}{{UNIT}} !important; top: unset !important;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'bottom',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);

		$this->add_responsive_control(
			'arrow_next_x_select',
			[
				'label' => esc_html__( 'Next Position X', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'left' => esc_html__( 'Left', 'rsaddon' ),
					'right' => esc_html__( 'Right', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_left_position',
			[
				'label' => esc_html__( 'Next Left Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'left: {{SIZE}}{{UNIT}} !important; right: unset !important;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'left',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_next_right_position',
			[
				'label' => esc_html__( 'Next Right Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'right: {{SIZE}}{{UNIT}} !important; left: unset !important;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'right',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);
		
		$this->add_responsive_control(
			'arrow_next_y_select',
			[
				'label' => esc_html__( 'Next Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'top' => esc_html__( 'Top', 'rsaddon' ),
					'bottom' => esc_html__( 'Bottom', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_top_position',
			[
				'label' => esc_html__( 'Next Top Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'top: {{SIZE}}{{UNIT}} !important; bottom: unset !important;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'top',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_next_bottom_position',
			[
				'label' => esc_html__( 'Next Bottom Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'bottom: {{SIZE}}{{UNIT}} !important; top: unset !important;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'bottom',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);
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
				
		$slidesToShow    = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
		$autoplaySpeed   = $settings['slider_autoplay_speed'];
		$interval        = $settings['slider_interval'];
		$slidesToScroll  = $settings['slides_ToScroll'];
		$slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
		$pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
		$sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
		$sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';		
		$infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
		$centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
		$col_lg          = $settings['col_lg'];
		$col_md          = $settings['col_md'];
		$col_sm          = $settings['col_sm'];
		$col_xs          = $settings['col_xs'];

		if ( is_rtl() ):
           $rtl= 'true';
		else:
           $rtl= 'false';
		endif;

		$unique = rand(2012,35120);
		$slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');

		$popup_slider_title_color = !empty( $settings['popup_slider_title_color']) ? 'style="color: '.$settings['popup_slider_title_color'].'"' : '';
		$popup_slider_dgn_color = !empty( $settings['popup_slider_dgn_color']) ? 'style="color: '.$settings['popup_slider_dgn_color'].'"' : '';
		$popup_slider_content_color = !empty( $settings['popup_slider_dgn_color']) ? 'style="color: '.$settings['popup_slider_dgn_color'].'"' : '';
		$popup_slider_info_color = !empty( $settings['popup_slider_info_color']) ? 'style="color: '.$settings['popup_slider_info_color'].'"' : '';
		$popup_slider_background = !empty( $settings['popup_slider_background']) ? 'style="background: '.$settings['popup_slider_background'].'"' : '';

		//Icon Style
		$icon_style='';
		if(!empty($settings['popup_slider_icon_color']) && empty($settings['popup_slider_icon_bg_color'])){
			$icon_style = 'style="color: '.$settings['popup_slider_icon_color'].'"';				
		}
		if(!empty($settings['popup_slider_icon_bg_color'])){
			$icon_style = ($settings['popup_slider_icon_bg_color']) ? ' style="background: '.$settings['popup_slider_icon_bg_color'].'"' : '';
		}

		if(!empty($settings['popup_slider_icon_color']) && !empty($settings['popup_slider_icon_bg_color'])){
			$icon_style = 'style="background: '.$settings['popup_slider_icon_bg_color'].'; color: '.$settings['popup_slider_icon_color'].'"';				
		}
		
		if('disable' == $settings['team_link_condition']){
			$disable_link = "#";
		} 

		?>	

		<div class="rsaddon-unique-slider rs-team-slider color_<?php echo esc_html($settings['choose_color_scheme']); ?> rs-team team-slider-<?php echo esc_attr($settings['team_slider_style']); ?>">

			<?php if('default' !== $settings['team_slider_style']):?>
			<div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider" >
				 <?php 

				 	if('style1' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style1.php";
					}

					elseif('style2' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style2.php";
					}

					elseif('style3' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style3.php";
					}

					elseif('style4' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style4.php";
					}

					elseif('style5' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style5.php";
					}
					elseif('style6' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style6.php";
					}
					elseif('style7' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style7.php";
					}
					elseif('style8' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style8.php";
					}
					elseif('style9' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style9.php";
					}
					elseif('style10' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style10.php";
					}
					elseif('style11' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style11.php";
					}
				?>
			</div>
			<?php endif; ?>
			<?php if('default' == $settings['team_slider_style']):?> 
				<div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="slider-for" >
				<?php 
					$cat = $settings['team_category'];
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					if(empty($cat)){
						$best_wp = new wp_Query(array(
								'post_type'      => 'teams',
								'posts_per_page' => $settings['per_page'],
								'paged'          => $paged					
						));	  
					}   
					else{
						$best_wp = new wp_Query(array(
								'post_type'      => 'teams',
								'posts_per_page' => $settings['per_page'],
								'paged'          => $paged,
								'tax_query'      => array(
							        array(
										'taxonomy' => 'team-category',
										'field'    => 'slug', //can be set to ID
										'terms'    => $cat //if field is ID you can reference by cat/term number
							        ),
							    )
						));	  
					}

					while($best_wp->have_posts()): $best_wp->the_post();

					    $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';			
					    $content = get_the_content();									   
						//retrive social icon values			
						$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
						$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
						$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
						$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
						$show_phone  = get_post_meta( get_the_ID(), 'phone', true );
						$show_email  = get_post_meta( get_the_ID(), 'email', true );
						
						$fb   ='';
						$tw   ='';
						$gp   ='';
						$ldin ='';

						if($facebook!=''){
							$fb='<a href="'.$facebook.'" class="social-icon"><i class="fab fa-facebook-f"></i></a> ';
						}
						if($twitter!=''){
							$tw='<a href="'.$twitter.'" class="social-icon"><i class="fab fa-twitter"></i></a>';
						}
						if($google_plus!=''){
							$gp='<a href="'.$google_plus.'" class="social-icon"><i class="fab fa-instagram"></i></a> ';
						}
						if($linkedin!=''){
							$ldin='<a href="'.$linkedin.'" class="social-icon"><i class="fab fa-linkedin-in"></i></a>';
						}
					?>
					<div class="team-item">
						<div class="team-inner-wrap">
							<div class="image-wrap">
								<a href="<?php 

								if('enable' == $settings['team_link_condition']){
									the_permalink(); 
								}else{
									echo $disable_link;
								}?>">
									<?php the_post_thumbnail($settings['thumbnail_size']); ?>
								</a> 
								<?php if( $fb || $gp || $tw || $ldin ): ?>
									<div class="social-icons social-trigger-btn">
										<?php echo wp_kses_post($fb);
										echo wp_kses_post($gp);
										echo wp_kses_post($tw);
										echo wp_kses_post($ldin);
										?>
									</div>
								<?php endif; ?>
							</div>	
							<div class="team-content">
								<div class="team-member-info">
									<h3 class="team-name">
										<a class="pointer-events" href="<?php 
									if('enable' == $settings['team_link_condition']){
										the_permalink(); 
									}else{
										echo $disable_link;
									}?>"><?php the_title();?></a>
									</h3>
									<span class="team-title"><?php echo esc_html( $designation );?></span>
								</div>
								<div class="social-trigger-btn">
									<i class="ri-add-line"></i>
								</div>
							</div>					
						</div>
					</div>

					<?php
					endwhile;
					wp_reset_query();  
					?>  
			</div>
			<div class="slider-nav rs-slide-nav">
			<?php 
				$cat = $settings['team_category'];
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				if(empty($cat)){
					$best_wp = new wp_Query(array(
							'post_type'      => 'teams',
							'posts_per_page' => $settings['per_page'],
							'paged'          => $paged					
					));	  
				}   
				else{
					$best_wp = new wp_Query(array(
							'post_type'      => 'teams',
							'posts_per_page' => $settings['per_page'],
							'paged'          => $paged,
							'tax_query'      => array(
						        array(
									'taxonomy' => 'team-category',
									'field'    => 'slug', //can be set to ID
									'terms'    => $cat //if field is ID you can reference by cat/term number
						        ),
						    )
					));	  
				}

				while($best_wp->have_posts()): $best_wp->the_post(); ?>
					<div class="image-list">
						<?php the_post_thumbnail($settings['thumbnail_size']); ?>   
					</div>	
				<?php
				endwhile;
				wp_reset_query(); ?> 
			</div>
			<?php endif; ?>

		<div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
	
		
	</div>
	<?php if('style8' == $settings['team_slider_style']):?>
		<script type="text/javascript"> 
			jQuery(document).ready(function(){
				jQuery( '.rs-addon-slider' ).each(function( index ) {        
				var slider_id       = jQuery(this).attr('id'); 
				var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
			
				if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
				jQuery('#'+slider_id).not('.slick-initialized').slick({
				slidesToShow    : parseInt(slider_conf.col_lg),
				centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
				dots            : (slider_conf.sliderDots)  == "true" ? true : false,
				arrows          : (slider_conf.sliderNav) == "true" ? true : false,
				autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
				slidesToScroll  : parseInt(slider_conf.slidesToScroll),
				centerPadding   : '15px',
				autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
				pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
				loop : false,
				rtl: <?php echo $rtl; ?>,
				responsive: [{
					breakpoint: 1200,
					settings: {
						slidesToShow: parseInt(slider_conf.col_md),
					}
				}, 
				{
					breakpoint: 992,
					settings: {
						slidesToShow: parseInt(slider_conf.col_sm),
					}
				}, 
				{
					breakpoint: 768,

					settings: {
						arrows: false,
						slidesToShow: parseInt(slider_conf.col_xs),
					}
				}, ]
				});
			}
		
			});
			jQuery(
				'.team-slider-style8 .slick-prev, .team-slider-style8 .slick-next').wrapAll('<div class="custom-nav"></div>'
			);
			jQuery(
				'.team-slider-style8 .slick-prev').html('<svg width="13" height="14" viewBox="0 0 13 14" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 7.8125H13V6.1875H6.5V0.5L0 7L6.5 13.5V7.8125Z" fill="white"/></svg> Prev'
			);
			jQuery(
				'.team-slider-style8 .slick-next').html('Next <svg width="13" height="14" viewBox="0 0 13 14" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 7.8125H0V6.1875H6.5V0.5L13 7L6.5 13.5V7.8125Z" fill="#fff"/></svg>'
			);
		});
		</script>
    <?php endif; ?>
	<?php if(('default' !== $settings['team_slider_style']) && ('style8' !== $settings['team_slider_style'])):?>
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			jQuery( '.rs-addon-slider' ).each(function( index ) {        
	        var slider_id       = jQuery(this).attr('id'); 
	        var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
	       
	        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            jQuery('#'+slider_id).not('.slick-initialized').slick({
            slidesToShow    : parseInt(slider_conf.col_lg),
            centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
            dots            : (slider_conf.sliderDots)  == "true" ? true : false,
            arrows          : (slider_conf.sliderNav) == "true" ? true : false,
            autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
            slidesToScroll  : parseInt(slider_conf.slidesToScroll),
            centerPadding   : '15px',
            autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
            pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
            loop : false,
            rtl: <?php echo $rtl; ?>,

            responsive: [{
                breakpoint: 1200,
                 rtl: <?php echo $rtl; ?>,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_md),
                }
            }, 
            {
                breakpoint: 992,
                 rtl: <?php echo $rtl; ?>,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_sm),
                }
            }, 
            {
                breakpoint: 768,
                 rtl: <?php echo $rtl; ?>,
                settings: {
                    arrows: false,
                    
                    dots: true,
                    slidesToShow: parseInt(slider_conf.col_xs),
                }
            }, ]
            });
        }
	   
		});
	});
    </script>
    <?php endif; ?>

    <?php if('default' == $settings['team_slider_style']):?> 
        <script type="text/javascript"> 
            jQuery(document).ready(function(){
                jQuery( '.slider-for' ).each(function( index ) { 
                var slider_id       = jQuery(this).attr('id');     
                var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
                var sliderfor = jQuery('.slider-for');
                if(sliderfor.length){
                    jQuery('.slider-for').slick({
                        slidesToShow    : parseInt(slider_conf.col_lg),
                        slidesToScroll  : parseInt(slider_conf.slidesToScroll),
                        arrows  : (slider_conf.sliderNav) == "true" ? true : false,
                        centerMode : (slider_conf.centerMode)  == "true" ? true : false,
                        fade: true,
                        asNavFor: '.slider-nav',
                        rtl: <?php echo $rtl; ?>,
                        
                        responsive: [{
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: parseInt(slider_conf.col_md),
                            }
                        }, 
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: parseInt(slider_conf.col_sm),
                            }
                        }, 
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                slidesToShow: parseInt(slider_conf.col_xs),
                            }
                        }, ]
                    });
                }
                var slidernav = jQuery('.slider-nav');
                if(slidernav.length){
                    jQuery('.slider-nav').slick({
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        asNavFor: '.slider-for',
                        dots    : (slider_conf.sliderDots)  == "true" ? true : false,
                        arrows  : false,
                        vertical: false,
                        centerMode : (slider_conf.centerMode)  == "true" ? true : false,
                        centerPadding: '0',
                        focusOnSelect: true,
                        directionNav: true,
                        fade: false,
                        rtl: <?php echo $rtl; ?>,
                        vertical: true,
                        responsive: [{
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 2,
                        		slidesToScroll: 1,
                            }
                        }, 
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2,
                        		slidesToScroll: 1,
                            }
                        }, 
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                slidesToShow: parseInt(slider_conf.col_xs),
                            }
                        }, ]
                    });
                }

				var timeoutId;
				jQuery(".social-trigger-btn").on("mouseenter", function() {
					clearTimeout(timeoutId);
					timeoutId = setTimeout(function() {
						if (jQuery(".team-inner-wrap").length) {
						jQuery(".team-inner-wrap").addClass("highlight");
						}
					}, 0);
				});

				jQuery(".social-trigger-btn").on("mouseleave", function() {
					clearTimeout(timeoutId);
					timeoutId = setTimeout(function() {
						if (jQuery(".team-inner-wrap").length) {
						jQuery(".team-inner-wrap").removeClass("highlight");
						}
					}, 900);
				});
            });
        });
        </script>
    <?php endif; ?>

	<?php 
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
}?>
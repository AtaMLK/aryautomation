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
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();


class Rsaddon_Portfolio_pro_Filter_Widget extends \Elementor\Widget_Base {

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
		return 'rsportfolio-filter';
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
		return __( 'RS Portfolio Filter', 'rsaddon' );
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
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Color', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Color', 'rsaddon'),				
					'secondary_scheme' => esc_html__('Secondary Color', 'rsaddon')				
				],											
			]
		);
		$this->add_control(
			'portfolio_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2',
					'3' => 'Style 3',				
					'4' => 'Style 4',				
					'5' => 'Style 5',				
					'6' => 'Style 6',				
					'7' => 'Style 7',				
					'8' => 'Style 8',				
					'9' => 'Style 9',				
				],											
			]
		);
		$this->add_control(
			'portfolio_category',
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
				'label' => esc_html__( 'Project Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => -1,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_filter',
			[
				'label'   => esc_html__( 'Show Filter', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter_show',	
				'condition' => [
                	'portfolio_grid_style!' =>  '8'
                ],
                'separator' => 'before',
				'options' => [
					'filter_show' => 'Show',
					'filter_hide' => 'Hide',
				],
			]
		);
		$this->add_control(
			'arrow_on_off',
			[
				'label' => esc_html__( 'Arrow Enable?', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['portfolio_grid_style' => '9']
			]
		);
		$this->add_control(
			'cat_show_off',
			[
				'label' => esc_html__( 'Category Show?', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['portfolio_grid_style' => '9']
			]
		);
		$this->add_control(
			'content_show_off',
			[
				'label' => esc_html__( 'Content Show?', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['portfolio_grid_style' => '9']
			]
		);
		$this->add_control(
			'overlay_on_off',
			[
				'label' => esc_html__( 'Hover Overlay Enable?', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['portfolio_grid_style' => '9']
			]
		);
		$this->add_control(
			'categorie_position',
			[
				'label'   => esc_html__( 'Categorie Position', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',	
				'condition' => [
                	'portfolio_grid_style' => ['6']
                ],
                'separator' => 'before',
				'options' => [
					'top' => 'Top',
					'bottom' => 'Bottom',
				],
			]
		);
		$this->add_control(
			'filter_title',
			[
				'label' => esc_html__( 'Filter Default Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
                'condition' => [
                	'portfolio_grid_style!' =>  '8'
                ],	
				'separator' => 'before',
			]
		);
		$this->add_control(
			'portfolio_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'1' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
			]
		);
		$this->add_control(
			'portfolio_link_icon',
			[
				'label'   => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',				
				'options' => [
					'style1' => 'Icon',
					'style2' => 'Image',				
				],											
			]
		);

		$this->add_control(
		    'selected_icon',
		    [
		        'label' => __( 'Icon', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		            'value' => 'fas fa-plus',
		            'library' => 'reguler',
		        ],
		        'condition' => [
		            'portfolio_grid_style' => ['2', '1', '7'],
		        ],
		        'condition' => [
		            'portfolio_link_icon' => ['style1'],
					
		        ]
		    ]
		);

		$this->add_control(
			'selected_icon_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				'separator' => 'before',
				'condition' => [
				    'portfolio_link_icon' => ['style2'],
				]
			]
		);

		$this->add_responsive_control(
		    'selected_icon_image_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a img, {{WRAPPER}} .rs-portfolio-style2 .portfolio-content a img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition' => [
		            'portfolio_link_icon' => ['style2'],
		        ]
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
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .portfolio-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		);
		$this->add_responsive_control(
			'item_spacing__',
			[
				'label' => esc_html__( 'Item Spacing', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                    '{{WRAPPER}} .portfolio-filter .portfolio-item .portfolio-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                    '{{WRAPPER}} .portfolio-filter .portfolio-item .portfolio-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );
        $this->add_control(
			'gap_conditon',
			[
				'label' => esc_html__( 'left Right Gap', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					''   => 'Yes',
					'no-gutters' => 'No'				
				],	
				'default' => '',
			]
		); 
		$this->add_responsive_control(
            'background_border_radius',
            [
                'label' => esc_html__( 'Background Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style1 .portfolio-details, {{WRAPPER}} .portfolio-item, {{WRAPPER}} .portfolio-item .portfolio-content:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );
		$this->add_control(
			'grid_popup',
			[
				'label'   => esc_html__( 'Show Popup', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'popup',				
				'options' => [
					'popup'   => 'Popup Style',
					'default' => 'Default Style'				
				],
				'separator' => 'before',
													
			]
		);  
		
		$this->add_control(
			'cat_show_hide',
			[
				'label' => esc_html__( 'Content Category Enable', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['portfolio_grid_style' => '6']
			]
		);
		$this->add_control(
			'content_word_show',
			[
				'label' => esc_html__( 'Content Limit', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '13', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
                    'portfolio_grid_style' => '9',
                ]
			]
		);

				
		$this->end_controls_section();

		
        $this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a' => 'color: {{VALUE}};',                   

                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );
        $this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .p-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .rs-portfolios9 .portfolio-item .portfolio-content .p-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .p-title > a',                    
			]
		);
		 $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => esc_html__( 'Category Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .portfolio-item .p-category, {{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content .p-category',
			]
		);
        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-category a, {{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content .p-category a, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-category a,{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-item .p-category a' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-category a:hover, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-category a:hover,{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-item .p-category a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );
		$this->add_responsive_control(
		    'category_margin',
		    [
		        'label' => esc_html__( 'category Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .p-category, {{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content .p-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Content Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-portfolio-style6 .portfolio-item .portfolio-inner p, {{WRAPPER}} .portfolio-item .portfolio-inner p.desc',
			]
		);
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style6 .portfolio-item .portfolio-inner p, {{WRAPPER}} .portfolio-item .portfolio-inner p.desc' => 'color: {{VALUE}};',

                ],                
            ]
        );

		$this->add_responsive_control(
		    'content_margin',
		    [
		        'label' => esc_html__( 'Content Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style6 .portfolio-item .portfolio-inner p, {{WRAPPER}} .portfolio-item .portfolio-inner p.desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_bg',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .portfolio-content .portfolio-inner,{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .portfolio-content',
                'condition' => [
				    'portfolio_grid_style' => ['3'],
				]
            ]
        );

        $this->add_control(
			'padding_title_bg_',
			[
				'label' => esc_html__( 'Title area padding', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
		    'title_item_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .portfolio-content .portfolio-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'item_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details, {{WRAPPER}} .portfolio-item .portfolio-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
			'title_area_left_spacing',
			[
				'label' => esc_html__( 'Title Area Left Spacing', 'textdomain' ),
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
					'{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-item .portfolio-content' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'portfolio_grid_style'=>'9',
				],
			]
		);
        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Gradiant Overlay', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .portfolio-content:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-item.yes:before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'image_overlay_title',
			[
				'label' => esc_html__( 'Image Gradiant Overlay', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'=>[
					'portfolio_grid_style'=>'9',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_overlay_gradiant',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-item.yes:before',
                'condition'=>[
					'portfolio_grid_style'=>'9',
				],

            ]
        ); 

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gradient_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .portfolio-item, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item:before, {{WRAPPER}} .portfolio-content:before, {{WRAPPER}} .rs-portfolio-style7 .content-overlay:before, {{WRAPPER}} .rs-portfolio-style6 .portfolio-item .portfolio-content:before,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-content',

            ]
        ); 

        $this->add_responsive_control(
            'align_item',
            [
                'label' => esc_html__( 'Alignment Filter Menu', 'rsaddon' ),
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
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item .portfolio-content' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'selector' => '{{WRAPPER}} .portfolio-item .portfolio-details'
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			'menu_style',
			[
				'label' => esc_html__( 'Menu Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_filter' => 'filter_show',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
			]
		);
		$this->add_responsive_control(
			'menu_block_or_inline',
			[
				'label' => esc_html__( 'Menu Wrapper Block & Inline Block', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'block' => [
						'title' => esc_html__( 'Block', 'textdomain' ),
						'icon' => 'eicon-editor-close',
					],
					'inline-block' => [
						'title' => esc_html__( 'Inline', 'textdomain' ),
						'icon' => 'eicon-check',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style9 .portfolio-filter' => 'display: {{VALUE}};',
				],
				'condition'=>[
					'portfolio_grid_style'=>'9',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'portfolio_filter_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-portfolio-style6 .portfolio-filter, {{WRAPPER}} .rs-portfolio-style9 .portfolio-filter',

            ]
        );
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'portfolio_filter_box_shadow',
                'selector' => '{{WRAPPER}} .rs-portfolio-style6 .portfolio-filter, {{WRAPPER}} .rs-portfolio-style9 .portfolio-filter'
            ]
        );
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'before_portfolio_filter_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .portfolio-filter button:before',

            ]
        );
        $this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'nav_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

		$this->add_control(
            'menu_color',
            [
                'label' => esc_html__( 'Menu Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter button' => 'color: {{VALUE}};',                   
                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'menu_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .portfolio-filter button',

            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'nav_hover_tab',
            [
                'label' => esc_html__( 'Acive', 'rsaddon' ),
            ]
        );

		$this->add_control(
            'menu_active_color',
            [
                'label' => esc_html__( 'Menu Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                	'{{WRAPPER}} .portfolio-filter button:hover' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .portfolio-filter button.active' => 'color: {{VALUE}};',                   
                ],                
            ]
        );

		

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'menu_active_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .portfolio-filter button:hover, {{WRAPPER}} .portfolio-filter button.active',

            ]
        );

        $this->add_control(
            'menu_active_dots_color',
            [
                'label' => esc_html__( 'Menu Active Dots Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                	'{{WRAPPER}} .portfolio-filter button:before' => 'background: {{VALUE}};',                   
                ],                
            ]
        );

		$this->add_responsive_control(
		    'dot_active_width',
		    [
		        'label' => esc_html__( 'Dots Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter .portfolio-filter button.active:before' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'dot_active_height',
		    [
		        'label' => esc_html__( 'Dots Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter .portfolio-filter button.active:before' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_control(
            'dots_opacity',
            [
                'label' => esc_html__( 'Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter .portfolio-filter button.active:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'dots_position',
            [
                'label'      => esc_html__( 'Dots Position Y', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter .portfolio-filter button.active:before' => 'bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();


        $this->add_responsive_control(
		    'menu_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'menu_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .portfolio-filter button',                    
			]
		);

		$this->add_responsive_control(
		    'menu_filter_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
            'align_filter',
            [
                'label' => esc_html__( 'Alignment Filter Menu', 'rsaddon' ),
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .rs-portfolio-style6' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
            ]
        );

		$this->add_responsive_control(
		    'tab_menu_filter_margin',
		    [
		        'label' => esc_html__( 'Item Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'portfolio_filter_Gap',
		    [
		        'label' => esc_html__( 'Filter Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style6 .grid' => 'margin-top: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'menu_max_width',
		    [
		        'label' => esc_html__( 'Menu Max Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px','%' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'max-width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'read_more_style',
			[
				'label' => esc_html__( 'Button Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                	'portfolio_grid_style' =>  '6'
                ],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .portfolio-read-more',

            ]
        );

		$this->add_control(
            'button_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-read-more svg path' => 'fill: {{VALUE}};',                   

                ],                
            ]
        );

		$this->add_control(
			'arrowbutton_hover_color',
			[
				'label' => esc_html__( 'Arrow Hover Style', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hover_button_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .portfolio-read-more:hover',

            ]
        );

		$this->add_control(
            'hover_button_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-read-more:hover svg path' => 'fill: {{VALUE}};',                   

                ],                
            ]
        );

		$this->end_controls_section();

		//Popup Style Setting
		$this->start_controls_section(
			'section_portfolio_grid_style',
			[
				'label' => esc_html__( 'Popup Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'popup_port_title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,                              
            ]
        );
        $this->add_control(
            'popup_port_content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );	
        $this->add_control(
            'popup_port_info_color',
            [
                'label' => esc_html__( 'Project Information Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );		
        $this->add_control(
            'popup_port_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
            
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'rs_arrow_style',
			[
				'label' => esc_html__( 'Arrow Icon Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .p-icon i, {{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a, {{WRAPPER}} .rs-portfolio-style7 .content-overlay a, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon a, {{WRAPPER}} .rs-portfolio-style2 .portfolio-content a, {{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-read-more i' => 'color: {{VALUE}};',                    
                    '{{WRAPPER}} .portfolio-filter .portfolio-read-more svg path' => 'fill: {{VALUE}};',                    
                ],              
            ]
            
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .p-icon, {{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon, {{WRAPPER}} .rs-portfolio-style7 .content-overlay a.link7,{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-read-more',
            ]
        );
  
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a, {{WRAPPER}} .rs-portfolio-style7 .content-overlay a, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon, {{WRAPPER}} .rs-portfolio-style3 .portfolio-item .p-icon i:before,{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-read-more i',                    
			]
		);

		$this->add_control(
			'iconhover__title_bg',
			[
				'label' => esc_html__( 'Icon Hover Bg Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
            'rs_arrow_hover_background',
            [
                'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',   
				'selectors' => [
                    '{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-read-more:hover' => 'background: {{VALUE}};',                   

                ], 
				'condition' => ['portfolio_grid_style' => '9']              
            ]
            
        );

		$this->add_control(
            'rs_arrow_hover_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,   
				'selectors' => [
                    '{{WRAPPER}} .portfolio-filter.rs-portfolio-style9 .portfolio-read-more:hover i' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .portfolio-filter .portfolio-read-more:hover svg path' => 'fill: {{VALUE}};',                   

                ], 
				'condition' => ['portfolio_grid_style' => '9']               
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

	$popup_port_title_color = !empty( $settings['popup_port_title_color']) ? 'style="color: '.$settings['popup_port_title_color'].'"' : '';
	$popup_port_content_color = !empty( $settings['popup_port_content_color']) ? 'style="color: '.$settings['popup_port_content_color'].'"' : '';
	$popup_port_info_color = !empty( $settings['popup_port_info_color']) ? 'style="color: '.$settings['popup_port_info_color'].'"' : '';
	$popup_port_background = !empty( $settings['popup_port_background']) ? 'style="background: '.$settings['popup_port_background'].'"' : '';

	$taxonomy ="";

	?>
		<div class="portfolio-filter rs-portfolio-style<?php echo esc_attr($settings['portfolio_grid_style']); ?> rsaddon_pro_box rs-portfolios<?php echo esc_attr($settings['portfolio_grid_style']); ?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>">

			<?php if('filter_show' == $settings['show_filter']){?>
				<div class="portfolio-filter">
				    <button class="active" data-filter="*"><?php echo esc_html($settings['filter_title']);?></button>

				    <?php $taxonomy = "portfolio-category";
					    $select_cat = $settings['portfolio_category'];
	                    foreach ($select_cat as $catid) {
	                    
	                    $term = get_term_by('slug', $catid, $taxonomy);
	                    $term_name  =  $term->name;
	                    $term_slug  =  $term->slug;
                    ?>
		            	<button data-filter=".filter_<?php echo esc_html($term_slug);?>"><?php echo esc_html($term_name);?></button>
		            <?php  } ?>

				</div>
			<?php } ?>
			
			

			
			<div class="row grid <?php echo esc_html($settings['gap_conditon']);?>">

			    <?php 			

					if('1' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style1.php";
					}

					if('2' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style2.php";
					}

					if('3' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style3.php";
					}

					if('4' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style4.php";
					}

					if('5' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style5.php";
					}

					if('6' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style6.php";
					}

					if('7' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style7.php";
					}
					if('9' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style9.php";
					}
					
				?>
			</div>


		</div>
	
	<?php	

	}
	public function getCategories(){
        $cat_list = [];
         	if ( post_type_exists( 'portfolios' ) ) { 
          	$terms = get_terms( array(
             	'taxonomy'    => 'portfolio-category',
             	'hide_empty'  => true            
         	) );           
         
  
	        foreach($terms as $post) {
	        	$cat_list[$post->slug]  = [$post->name];
	        }
    	}  
        return $cat_list;
    }
}
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
use Elementor\Group_Control_Text_Stroke;
use Elementor\Utils;
use Elementor\Group_Control_Border;

defined( 'ABSPATH' ) || die();

class Rsaddon_Portfolio_pro_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rsportfolio';
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
		return __( 'RS Portfolio Grid', 'rsaddon' );
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
		
		$post_dropdown[0] = 'Select Portfolio';
		$wp_portfolio_query = new wp_Query(array(
			'post_type'      => 'portfolios',
			'posts_per_page' => '-1',
		));

		if ($wp_portfolio_query->have_posts()) :
			while ($wp_portfolio_query->have_posts()) : $wp_portfolio_query->the_post();
				$id    = get_the_ID($wp_portfolio_query->ID);
				$title = get_the_title($wp_portfolio_query->ID);
				$post_dropdown[$id] = $title;
			endwhile;
			wp_reset_query();
		endif;

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				],
			]
		);

		$this->add_control(
			'portfolio_is_manual_selection',
			[
				'label' => esc_html__('Select Portfolio by:', 'prelements'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'yes'       => esc_html__('Selected Portfolio', 'prelements'),
					''        => esc_html__('Category Portfolio', 'prelements'),
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
				'condition' => ['portfolio_is_manual_selection' => ''],
				'multiple' => true,	
				'separator' => 'before',		
			]

		);
		$this->add_control(
			'select_portfolio_item',
			[
				'label'   => esc_html__('Select Portfolio', 'prelements'),
				'type'    => Controls_Manager::SELECT2,
				'default' => 0,
				'options' => [] + $post_dropdown,
				'multiple' => true,
				'condition' => ['portfolio_is_manual_selection' => 'yes'],
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
            'pre_posts_sort',
            [
                'label'   => esc_html__( 'Post Order', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'ASC', 'rsaddon' ),
                    'DESC' => esc_html__( 'DESC', 'rsaddon' ),
                ],
                'default' => 'DESC',
            ]
        );
		$this->add_control(
			'portfolio_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => '4',			
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
			]
		);
		$this->add_control(
			'portfolio_md_columns',
			[
				'label'   => esc_html__( 'Medium Device Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',				
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
			]
		);
		$this->add_control(
			'portfolio_sm_columns',
			[
				'label'   => esc_html__( 'Mobile Device Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
			]
		);
		$this->add_control(
            'icon_image_show_hide',
            [
                'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
				
            ]
        );
		$this->add_control(
			'portfolio_link_icon',
			[
				'label'   => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => 'Icon',
					'style2' => 'Image',				
				],
				'condition'=>[
					'icon_image_show_hide'=> 'yes'
				]										
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
		            'portfolio_grid_style' =>  '1',
		            'portfolio_link_icon' => 'style1',
		        ],
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
            ]
        );  
		$this->add_responsive_control(
		    'show_count',
		    [
		        'label' => esc_html__( 'Show Count Number', 'rsaddon' ),
		        'type' => \Elementor\Controls_Manager::SWITCHER,
		        'label_on' => esc_html__( 'Show', 'rsaddon' ),
		        'label_off' => esc_html__( 'Hide', 'rsaddon' ),
		        'return_value' => 'yes',
		        'default' => 'yes',
		        'separator' => 'before',
				'condition' => [
					'portfolio_grid_style' => '4',
				],
		    ]
		);
		$this->add_responsive_control(
		    'show_button',
		    [
		        'label' => esc_html__( 'Show Button', 'rsaddon' ),
		        'type' => \Elementor\Controls_Manager::SWITCHER,
		        'label_on' => esc_html__( 'Show', 'rsaddon' ),
		        'label_off' => esc_html__( 'Hide', 'rsaddon' ),
		        'return_value' => 'yes',
		        'default' => 'no',
		        'separator' => 'before',
		    ]
		);
		$this->add_control(
			'read_more_text',
			[
				'label'       => esc_html__( 'Button Text', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'View More',
				'placeholder' => esc_html__( 'View More', 'rsaddon' ),
				'condition' => [
					'show_button' => 'yes',
				],
				'separator'   => 'before',
			]
		);

		$this->add_control(
		    'read_more_icon',
		    [
		        'label' => __( 'Read More Icon', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		            'value' => 'fas fa-plus',
		            'library' => 'reguler',
		        ],
		        'condition' => [
					'show_button' => 'yes',
		        ],
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
		    'item_gap_margin',
		    [
		        'label' => esc_html__( 'Item Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
		            '{{WRAPPER}} .portfolio-inner-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'item_paddding',
		    [
		        'label' => esc_html__( 'Item Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
				
		$this->end_controls_section();

		// Count Number Style Start
		$this->start_controls_section(
			'section_count_style',
			[
				'label' => esc_html__( 'Count Number Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                	'portfolio_grid_style' => '4',
					'show_count' => 'yes',
                ],
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'cunt_number_typography',
					'selector' => '{{WRAPPER}} .portfolio-item .portfolio-details .count_number',
				]
			);
			$this->add_control(
				'cunt_number_color',
				[
					'label' => esc_html__( 'Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .portfolio-item .portfolio-details .count_number' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Text_Stroke::get_type(),
				[
					'name' => 'cunt_number_text_stroke',
					'selector' => '{{WRAPPER}} .portfolio-item .portfolio-details .count_number',
				]
			);
			$this->add_responsive_control(
				'cunt_number_margin',
				[
					'label' => esc_html__( 'Margin', 'rsaddon' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .portfolio-item .portfolio-details .count_number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Count Number Style End

		$this->start_controls_section(
			'section_item_style',
			[
				'label' => esc_html__( 'Image Overlay Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                	'portfolio_grid_style' => ['2','3']
                ],
			]
		);
		$this->add_control(
			'overlay_color_bg',
			[
				'label' => esc_html__('Overlay Background', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'portfolio_overlay_color',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item:before',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a' => 'color: {{VALUE}} !important;',                   

                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a:hover' => 'color: {{VALUE}} !important;',                    
                ],                
            ]
        );
		$this->add_control(
			'titleoverlay_color_bg',
			[
				'label' => esc_html__('Title HOver Overlay Color', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_overlay_color',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-title a:hover',
				'condition' => [
                	'portfolio_grid_style' => '2'
                ],
			]
		);
        $this->add_control(
		    'title_bg',
		    [
		        'label' => esc_html__( 'Title Bg Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a' => 'background: {{VALUE}};',                   

		        ],                
		    ]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .p-title, {{WRAPPER}} .portfolio-item .portfolio-details .p-title a,{{WRAPPER}} .portfolio-item .portfolio-content .p-title a',               
			]
		);
	    $this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
		            '{{WRAPPER}} .portfolio-item .portfolio-content .p-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
		        ],
		    ]
		);
		$this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Title Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-item .portfolio-content .p-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
		    'title_border_radius',
		    [
		        'label' => esc_html__( 'Title Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_controls_section();
		
        $this->start_controls_section(
			'section_category_style',
			[
				'label' => esc_html__( 'Category Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
       
		$this->add_control(
		    'category_color',
		    [
		        'label' => esc_html__( 'Category Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .p-category a, {{WRAPPER}} .p-category' => 'color: {{VALUE}} !important;',
		        ],
		    ]
		);
		$this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-category a:hover' => 'color: {{VALUE}} !important;',                    
                ],              
            ]
            
        ); 
		$this->add_control(
		    'category_bg_color',
		    [
		        'label' => esc_html__( 'Category BG Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .p-category a' => 'background: {{VALUE}};',
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-category a' => 'background: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'category_bg_hover_color',
		    [
		        'label' => esc_html__( 'Category Hover BG Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .p-category a:hover' => 'background: {{VALUE}};',
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-category a:hover' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => esc_html__( 'Category Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .p-category a, {{WRAPPER}} .p-title > .p-category > a,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-details .p-category a',                   
			]
		);
       
        $this->add_responsive_control(
		    'cat_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-details .p-category, {{WRAPPER}} .p-title .p-category a,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-category a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'cat_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-details .p-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'cat_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-details .p-category a,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
			'cat_wrapper_options',
			[
				'label' => esc_html__( 'Wrapper Options', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cat_border',
				'selector' => '{{WRAPPER}} .portfolio-item .p-category',
			]
		);

        $this->end_controls_section();
		$this->start_controls_section(
		    '_icon_image_style',
		    [
		        'label' => esc_html__( 'Icon/Image Style', 'prelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'icon_image_show_hide'=> 'yes',
					'portfolio_grid_style' => '1'
				]	
		    ]
		);
		$this->add_control(
		    'title_icon_coloor',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons svg path' => 'fill: {{VALUE}};',                                   
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons i' => 'color: {{VALUE}};',                                                  
		        ],                
		    ]
		);

		$this->add_control(
		    'title_icon_bg',
		    [
		        'label' => esc_html__( 'Icon Bg Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons' => 'background-color: {{VALUE}}!important;',                                
		        ],                
		    ]
		);
		
		$this->add_control(
		    'title_icon_hover_coloor',
		    [
		        'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons:hover svg path' => 'fill: {{VALUE}};',                                   
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons:hover i' => 'color: {{VALUE}};',                                   

		        ],                
		    ]
		);
		$this->add_control(
		    'title_icon_bg_hover',
		    [
		        'label' => esc_html__( 'Icon Bg Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [                             
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons:hover' => 'background-color: {{VALUE}}!important;',                   

		        ],                
		    ]
		);
		
		$this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
		    'content_top_pos',
		    [
		        'label' => esc_html__( 'Top Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .portfolio-details' => 'top: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item.rsportfolio-grid-style1 .portfolio-details' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);
		$this->add_responsive_control(
		    'content_bottom_pos',
		    [
		        'label' => esc_html__( 'Bottom Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .portfolio-details' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
		            '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item.rsportfolio-grid-style1 .portfolio-details' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
		        ],
		        'separator' => 'before',
		    ]
		);
		$this->add_responsive_control(
		    'content_hover_bottom_pos',
		    [
		        'label' => esc_html__( 'Hover Bottom Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item:hover .portfolio-details' => 'bottom: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);
		$this->add_responsive_control(
		    'content_left_pos',
		    [
		        'label' => esc_html__( 'Left Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .portfolio-details' => 'left: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item.rsportfolio-grid-style1 .portfolio-details' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);
		$this->add_responsive_control(
		    'content_hover_left_pos',
		    [
		        'label' => esc_html__( 'Hover Left Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item:hover .portfolio-details' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);
		$this->add_responsive_control(
			'content_pading',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rsaddon_pro_box .portfolio-item .portfolio-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rsaddon_pro_box .portfolio-item .portfolio-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .portfolio-details',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'show_button' => 'yes',
                ]
		    ]
		);

		$this->add_responsive_control(
		    'button_top_pos',
		    [
		        'label' => esc_html__( 'Button Top Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon' => 'top: {{SIZE}}{{UNIT}};bottom:unset;',
		        ],
		        'separator' => 'before',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
		    ]
		);
		$this->add_responsive_control(
		    'button_bottom_pos',
		    [
		        'label' => esc_html__( 'Button Bottom Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon' => 'bottom: {{SIZE}}{{UNIT}};top:unset;',
		        ],
		        'separator' => 'before',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
		    ]
		);
		$this->add_responsive_control(
		    'button_left_pos',
		    [
		        'label' => esc_html__( 'Button Left Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon' => 'left: {{SIZE}}{{UNIT}};right:unset;',
		        ],
		        'separator' => 'before',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
		    ]
		);

		$this->add_responsive_control(
		    'button_right_pos',
		    [
		        'label' => esc_html__( 'Button Right Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon' => 'right: {{SIZE}}{{UNIT}};left:unset;',
		        ],
		        'separator' => 'before',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
		    ]
		);

		$this->add_responsive_control(
		    'button_right_hoverpos',
		    [
		        'label' => esc_html__( 'Button Right Hover Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item:hover .p-icon' => 'right: {{SIZE}}{{UNIT}};left:unset;',
		        ],
		        'separator' => 'before',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
		    ]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__( 'Button Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],		

				'selectors' => [
                    '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn' => 'width: {{SIZE}}{{UNIT}};display:flex;align-items:center;justify-content:center;',
                ],
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
			]
		); 
		$this->add_responsive_control(
			'button_height',
			[
				'label' => esc_html__( 'Button Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],			
				'selectors' => [
                    '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn' => 'height: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
			]
		);
		$this->add_responsive_control(
			'button_icon_width',
			[
				'label' => esc_html__( 'Button Icon Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],		

				'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .p-icon a.prs_btn em' => 'width: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'portfolio_grid_style' => '4'
				]
			]
		); 
		$this->add_responsive_control(
			'button_icon_height',
			[
				'label' => esc_html__( 'Button Icon Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],			
				'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .p-icon a.prs_btn em' => 'height: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'portfolio_grid_style' => '4'
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn',
		    ]
		);
		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => esc_html__( 'Button Icon Size', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],			
				'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .p-icon a.prs_btn em svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .p-icon a.prs_btn em i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'portfolio_grid_style' => '4'
				]
			]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );        
        
		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn svg path' => 'fill: {{VALUE}};',
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn svg' => 'fill: {{VALUE}};',
		        ], 
		    ]
		);
		$this->add_control(
		    'btn_icon_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn svg path' => 'fill: {{VALUE}};',
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn i' => 'color: {{VALUE}};',
		        ], 
				'condition' => [
					'portfolio_grid_style' => '4'
				]
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]			
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_icon_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .p-icon a.prs_btn em',
				'condition' => [
					'portfolio_grid_style' => '4'
				]			
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
		    ]
		);


		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
				'condition' => [
					'portfolio_grid_style!' => '4'
				]	
		    ]
		);
		$this->add_control(
		    'button_icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .p-icon a.prs_btn em' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
				'condition' => [
					'portfolio_grid_style' => '4'
				]	
		    ]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
			]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button__box_shadow',
		        'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]	
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
		    'btn_text_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover svg path' => 'fill: {{VALUE}};',
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_icon_hover_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover svg path' => 'fill: {{VALUE}};',
		            '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover i' => 'color: {{VALUE}};',
		        ], 
				'condition' => [
					'portfolio_grid_style' => '4'
				]
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_background_hover',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]			
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_icon_background_hover',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .p-icon a.prs_btn:hover em',
				'condition' => [
					'portfolio_grid_style' => '4'
				]			
			]
		);
		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border_hover',
		        'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .rsaddon_pro_box .portfolio-item .p-icon a.prs_btn:hover',
				'condition' => [
					'portfolio_grid_style!' => '4'
				]
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

	?>
		<div class="rs-portfolio-style<?php echo esc_attr($settings['portfolio_grid_style']); ?> rsaddon_pro_box">
			<div class="row">
				<?php
					if('1' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style1.php";
					}
					elseif('2' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style2.php";
					}
					elseif('3' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style3.php";
					}
					elseif('4' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style4.php";
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
}?>
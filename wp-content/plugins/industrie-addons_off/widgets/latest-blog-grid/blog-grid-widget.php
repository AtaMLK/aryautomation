<?php
/**
 * Latest Blog Grid Widget.
 *
 * Prelements Elementor widget that retrieve all blog post into slider style.
 *
 * @since 1.0.0
*/
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_latest_Blog_Grid_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Prelements Blog Slider widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'prelements-blog-gird';
    }       

    /**
     * Get widget title.
     *
     * Retrieve Prelements Blog Grid widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'RS Latest Blog Grid', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Prelements Blog Slider widget icon.
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
     * Retrieve the list of categories the Prelements Blog Slider widget belongs to.
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
     * Register Prelements Blog Slider widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {       

        $category_dropdown[0] = 'Select Category';
        
        $terms  = get_terms( array( 'taxonomy' => "category", 'fields' => 'id=>name' ) );       
        foreach ( $terms as $id => $name ) {
            $category_dropdown[$id] = $name;
        } 

        $post_dropdown[0] = 'Select Post';
        $prelements_query = new wp_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => '-1',                                         
        )); 

        if ( $prelements_query->have_posts() ):
            while($prelements_query->have_posts()): $prelements_query->the_post();       
                $id    = get_the_ID($prelements_query->ID);
                $title = get_the_title($prelements_query->ID);
                $post_dropdown[$id] = $title;
            endwhile;
            wp_reset_query(); 
        endif;  

       
        //Default Settings Here
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__( 'Default Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'latest_blog_slider_style',
            [
                'label'   => esc_html__( 'Select Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'defaultlayout',              
                'options' => [
                    'defaultlayout' => 'Default',
                    'style1' => 'Blog Grid Style',
                    'style2' => 'Blog List Style',
                    'style3' => 'Blog List Style 2',
                    'style4' => 'Transparent Style'
                ],
            ]
        );
        
        $this->add_control(
            'pre_blog_posts_is_manual_selection',
            [
                'label' => esc_html__( 'Select posts by:', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'recent'    => esc_html__( 'Recent Post', 'rsaddon' ),
                    'yes'       => esc_html__( 'Selected Post', 'rsaddon' ),
                    ''        => esc_html__( 'Category Post', 'rsaddon' ),
                ],
            ]
        );
        $this->add_control(
            'category',
            [
                'label'   => esc_html__( 'Category', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT2, 
                'default' => 0,                 
                'options' => $this->getCategories(),
                'multiple' => true, 
                'condition' => [ 'pre_blog_posts_is_manual_selection' => '' ],      
            ]
        );
        $this->add_control(
            'select_posts',
            [
                'label'   => esc_html__( 'Select Posts', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT2, 
                'default' => 0,         
                'options' => [      
                        
                ]+ $post_dropdown,
                'multiple' => true, 
                'condition' => [ 'pre_blog_posts_is_manual_selection' => 'yes' ],      
            ]
        );

        $this->add_control(
            'pre_blog_posts_offset',
            [
                'label'     => esc_html__( 'Offset', 'rsaddon' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 20,
                'default'   => 0,
            ]
        );

        $this->add_control(
            'pre_posts_order_by',
            [
                'label'   => esc_html__( 'Order by', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'date'          => esc_html__( 'Date', 'rsaddon' ),
                    'title'         => esc_html__( 'Title', 'rsaddon' ),
                    'author'        => esc_html__( 'Author', 'rsaddon' ),
                    'modified'      => esc_html__( 'Modified', 'rsaddon' ),
                    'comment_count' => esc_html__( 'Comments', 'rsaddon' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'pre_posts_sort',
            [
                'label'   => esc_html__( 'Order', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'ASC', 'rsaddon' ),
                    'DESC' => esc_html__( 'DESC', 'rsaddon' ),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'latest_blog_item_column',
            [
                'label'   => esc_html__( 'Select Column', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 4,              
                'options' => [
                    12 => 'Column 1',
                    6 => 'Column 2',
                    4 => 'Column 3',
                    3 => 'Column 4'
                ],
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label' => esc_html__( 'Item Limit', 'rsaddon' ),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( '6', 'rsaddon' ),
                'condition' => [ 'pre_blog_posts_is_manual_selection!' => 'yes' ], 
            ]
        );

        $this->add_control(
            'read__time',
            [
                'label'       => esc_html__('Read Time Text', 'rsaddon'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => ['latest_blog_slider_style!' => ['style4']]
            ]
        );

        $this->add_control(
            'read__time_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'color: {{VALUE}};',

                ], 
                'condition' => ['latest_blog_slider_style!' => ['style4']]              
            ]
        );

        $this->end_controls_section();


         //Thumbnail Settings Here
        $this->start_controls_section(
            '_images_settings',
            [
                'label' => esc_html__( 'Thumbnail Settings', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'blog_image_show_hide',
            [
                'label' => esc_html__( 'Show Thumbnail', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
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
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
			'clip_path',
			[
				'label' => esc_html__( 'Clip Path ON/OFF?', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'unset' => [
						'title' => esc_html__( 'OFF', 'rsaddon' ),
						'icon' => 'eicon-close',
					],
					'' => [
						'title' => esc_html__( 'ON', 'rsaddon' ),
						'icon' => 'eicon-check',
					],
				],
				'default' => '',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .pre-blog-item .blog-inner-wraps .pre-image-wrap,
                    {{WRAPPER}} .pre-blog-item .blog-inner-wrap' => 'clip-path: {{VALUE}} !important;',
				],
			]
		);

        $this->add_responsive_control(
			'transform_scale_normal',
			[
				'label' => esc_html__( 'Scale ( Normal )', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -3,
						'max' => 3,
                        'step' => 0.1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs--thum img' => 'transform: scale({{SIZE}});',
				],
			]
		);
        $this->add_responsive_control(
			'transform_scale_hover',
			[
				'label' => esc_html__( 'Scale ( Hover )', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -3,
						'max' => 3,
                        'step' => 0.1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover .pre-image-wrap .rs--thum img' => 'transform: scale({{SIZE}});',
				],
			]
		);

        $this->end_controls_section();


        //Title Settings Here
        $this->start_controls_section(
            '_title_settings',
            [
                'label' => esc_html__( 'Title Settings', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'blog_title_show_hide',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],                
            ]
        );
        $this->add_control(
            'blog_title_word_show',
            [
                'label' => esc_html__( 'Word Limit', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '200', 'rsaddon' ),
                'condition' => [
                    'blog_title_show_hide' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();

        //Meta Settings Here
        $this->start_controls_section(
            '_meta_settings',
            [
                'label' => esc_html__( 'Meta Settings', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'blog_meta_show_hide',
            [
                'label' => esc_html__( 'Show Meta', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],                
            ]
        );
       
       $this->add_control(
           'blog_cate_show_hide',
           [
               'label' => esc_html__( 'Show Category', 'rsaddon' ),
               'type' => Controls_Manager::SWITCHER,
               'default' => 'yes',
               'options' => [
                   'label_on' => esc_html__( 'Show', 'rsaddon' ),
                   'label_off' => esc_html__( 'Hide', 'rsaddon' ),
               ],                
           ]
       );

        $this->end_controls_section();


        //Content Settings Here
        $this->start_controls_section(
            '_content_settings',
            [
                'label' => esc_html__( 'Description Settings', 'rsaddon' ),
            ]
        );  

        $this->add_control(
            'blog_content_show_hide',
            [
                'label' => esc_html__( 'Show Description', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],                
            ]
        );

        $this->add_control(
            'blog_word_show',
            [
                'label' => esc_html__( 'Description Limit', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '20', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
                    'blog_content_show_hide' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        //Default Style Here
        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Default Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap',
                
            ]
        );      

        $this->add_responsive_control(
            '_blog__spacing',
            [
                'label' => esc_html__( 'Blog Item Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_item_padding',
            [
                'label' => esc_html__( 'Blog Item Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Item Shadow', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'default_blog_item_border',
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap',
            ]
        );

        $this->add_control(
            'blog_item_border_radiuss',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Content Part Style Here
        $this->start_controls_section(
            'section_content_part_style',
            [
                'label' => esc_html__( 'Content Part Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_part_background',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content',
                    
                ]
            );
            $this->add_responsive_control(
                '_blog__item_padding',
                [
                    'label' => esc_html__( 'Blog Item Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content,
                        {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'content_part_border_radiuss',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_part_border',
                    'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content',
                ]
            );

            // Content Part Position Maker Start
            $this->add_control(
                'content_part_position_maker',
                [
                    'label' => esc_html__( 'Content Position Maker', 'rsaddon' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->start_popover();
                $this->add_responsive_control(
                    'content_part_position',
                    [
                        'label' => esc_html__( 'Position', 'rsaddon' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'rsaddon' ),
                            'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
                            'relative'  => esc_html__( 'Relative', 'rsaddon' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'content_part_p_top',
                    [
                        'label' => esc_html__( 'Top', 'rsaddon' ),
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
                        'condition' => [
                            'content_part_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'content_part_p_right',
                    [
                        'label' => esc_html__( 'Right', 'rsaddon' ),
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
                        'condition' => [
                            'content_part_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'content_part_p_bottom',
                    [
                        'label' => esc_html__( 'Bottom', 'rsaddon' ),
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
                        'condition' => [
                            'content_part_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'content_part_p_left',
                    [
                        'label' => esc_html__( 'Left', 'rsaddon' ),
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
                        'condition' => [
                            'content_part_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();
            // Content Part Position Maker End
        $this->end_controls_section();

        //Category Style Here
        $this->start_controls_section(
            'section_category_style',
            [
                'label' => esc_html__( 'Category Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( '_tabs_cate' );

            $this->start_controls_tab(
            '_blog_cate_normal',
            [
                'label' => esc_html__( 'Normal', 'prelements' ),
            ]
            );

            $this->add_control(
                'blog_cat_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate' => 'color: {{VALUE}};',

                    ],               
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'blog_cat_bg_gradiant_color',
                    'types' => [ 'classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cate_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => 
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate',
                ]
            );

            $this->add_responsive_control(
                'cats_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'cats_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate,
                        {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cats_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'cats_box_shadow',
                    'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate',
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                '_blog_btn_cate_hover',
                [
                    'label' => esc_html__( 'Hover', 'prelements' ),
                ]
            );

            $this->add_control(
                'blog_cat_color_hover',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate:hover, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate:hover' => 'color: {{VALUE}};',

                    ],               
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'blog_cat_bg_gradiant_color_hover',
                    'types' => [ 'classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate:hover, {{WRAPPER}} .prelements-blog-grid .blog_style_style3 .pre-blog-item .pre-blog-content .rs-cate:hover',
                ]
            );

            $this->end_controls_tab();
            $this->end_controls_tabs(); 
            // Category Position Maker Start
            $this->add_control(
                'cat_position_maker',
                [
                    'label' => esc_html__( 'Category Position Maker', 'rsaddon' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->start_popover();
                $this->add_responsive_control(
                    'cat_position',
                    [
                        'label' => esc_html__( 'Position', 'rsaddon' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'rsaddon' ),
                            'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
                            'relative'  => esc_html__( 'Relative', 'rsaddon' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-cate' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'cat_p_top',
                    [
                        'label' => esc_html__( 'Top', 'rsaddon' ),
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
                        'condition' => [
                            'cat_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-cate' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'cat_p_right',
                    [
                        'label' => esc_html__( 'Right', 'rsaddon' ),
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
                        'condition' => [
                            'cat_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-cate' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'cat_p_bottom',
                    [
                        'label' => esc_html__( 'Bottom', 'rsaddon' ),
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
                        'condition' => [
                            'cat_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-cate' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'cat_p_left',
                    [
                        'label' => esc_html__( 'Left', 'rsaddon' ),
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
                        'condition' => [
                            'cat_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-cate' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();
            // Category Position Maker End
        $this->end_controls_section();


        //Thumbnail Style Here
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__( 'Thumbnail Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs--thum img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_thumbnail_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'image_min_height',
			[
				'label' => esc_html__( 'Image Min Height', 'textdomain' ),
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
					'{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prelements-blog-grid .blog_style_style4 .blog-inner-wraps .pre-image-wrap img' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        //Meta Style Here
        $this->start_controls_section(
            'section_meta_style',
            [
                'label' => esc_html__( 'Meta Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'blog_meta_typography',
				'selector' => '{{WRAPPER}} .pre-blog-meta li',
			]
		);
        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta, {{WRAPPER}} .prelements-blog-grid .blog_style_style4 .blog-inner-wraps .pre-blog-content .pre-blog-meta' => 'color: {{VALUE}};',

                ],               
            ]
        );

        $this->add_control(
            'blog__dots_color',
            [
                'label' => esc_html__( 'Dots Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta li:last-child::before, {{WRAPPER}} .prelements-blog-grid .blog_style_style4 .blog-inner-wraps .pre-blog-content .pre-blog-meta li:last-child::before' => 'background: {{VALUE}};',
                ],            
            ]
        );

        $this->add_responsive_control(
            'blog_meta_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta, {{WRAPPER}} .prelements-blog-grid .blog_style_style4 .blog-inner-wraps .pre-blog-content .pre-blog-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
 
        $this->end_controls_section();

        //Title Style Here
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
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3 a, {{WRAPPER}} .prelements-blog-grid .blog_style_style4 .blog-inner-wraps .pre-blog-content h3 a' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3 a:hover, {{WRAPPER}} .prelements-blog-grid .blog_style_style4 .blog-inner-wraps .pre-blog-content h3 a:hover' => 'color: {{VALUE}};',
                ],                
            ]            
        );

        $this->add_control(
            'title_hover_line_color',
            [
                'label' => esc_html__( 'Line Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3 a' => 'background-image: linear-gradient(to bottom, {{VALUE}} 0%, {{VALUE}} 100%);',
                ],           
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3',
            ]
        );

        $this->add_responsive_control(
            'titles_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        //Content Style Here
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Excerpt Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-content, {{WRAPPER}} .prelements-blog-grid .blog_style_style4 .blog-inner-wraps .pre-blog-content .pre-content' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-content',
            ]
        );

        $this->add_responsive_control(
            'blog_content_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();

        //Bottom Style Here
        $this->start_controls_section(
            'section_bottom_part',
            [
                'label' => esc_html__( 'Bottom Part Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'blog_btm_show_hide',
            [
                'label' => esc_html__( 'Show Bottom Part', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],                
            ]
        );
        
        $this->add_responsive_control(
            'blog_btm_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_btm_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'bottom_border',
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part',
            ]
        );
    
        $this->end_controls_section();

        //Bottom Style Here
        $this->start_controls_section(
            'section_btn_style',
            [
                'label' => esc_html__( 'Button Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_blog_btn_normal',
            [
                'label' => esc_html__( 'Normal', 'prelements' ),
            ]
        );

        $this->add_control(
            'btn_icon_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part li i' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_btn_color',
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part li i',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_blog_btn_button_hover',
            [
                'label' => esc_html__( 'Hover', 'prelements' ),
            ]
        );

        $this->add_control(
            'btn_icon_color_hover',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover .pre-blog-content .blog-btn-part li i' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_btn_color_hover',
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover .pre-blog-content .blog-btn-part li i',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();        
        $this->end_controls_section();

        //end slider settings   
    }

    /**
     * Render Prelements Blog Slider widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();        
        $unique = rand(100,31120);

        ?>

            <div class="prelements-blog-grid">
            <!-- Default Old Style -->           
            <div class="row blog_style_<?php echo esc_html($settings['latest_blog_slider_style']);?>">
                <?php 
                    if('style1' == $settings['latest_blog_slider_style']){
                        include plugin_dir_path(__FILE__)."/style1.php";
                    } 
                    elseif ('style2' == $settings['latest_blog_slider_style']){                        
                        include plugin_dir_path(__FILE__)."/style2.php";
                    }
                    elseif ('style3' == $settings['latest_blog_slider_style']){                        
                        include plugin_dir_path(__FILE__)."/style3.php";
                    }
                    elseif ('style4' == $settings['latest_blog_slider_style']){                        
                        include plugin_dir_path(__FILE__)."/style4.php";
                    } 
                    else {                        
                        include plugin_dir_path(__FILE__)."/style1.php";
                    }
                ?>                 
            </div>           
            <!-- End Default Old Style -->
            </div> 
        <?php
    }
    public function getCategories(){
        $cat_list = [];
            if ( post_type_exists( 'post' ) ) { 
            $terms = get_terms( array(
                'taxonomy'    => 'category',
                'hide_empty'  => true            
            ) );           
         
    
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }
}
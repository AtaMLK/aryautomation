<?php
/**
 * Latest Blog Slider Widget.
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

class Rsaddon_Elementor_Pro_latest_Blog_Slider_Widget extends \Elementor\Widget_Base {

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
        return 'prelements-blog-slider';
    }       

    /**
     * Get widget title.
     *
     * Retrieve Prelements Blog Slider widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'RS Latest Blog Slider', 'rsaddon' );
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
                    'style2' => 'Blog List Style'
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
                'label_block' => true
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
					'{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wraps .pre-image-wrap,
                    {{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap' => 'clip-path: {{VALUE}} !important;',
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
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap',
                
            ]
        );      

        $this->add_responsive_control(
            '_blog__spacing',
            [
                'label' => esc_html__( 'Blog Item Spacing', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_blog__item_padding',
            [
                'label' => esc_html__( 'Blog Item Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        //Category Style Here
        $this->start_controls_section(
            'section_category_style',
            [
                'label' => esc_html__( 'Category Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_tabs_button_cate' );

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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate' => 'color: {{VALUE}};',

                ],               
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_cat_bg_gradiant_color',
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cate_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate',
            ]
        );

        $this->add_responsive_control(
            'cats_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate:hover' => 'color: {{VALUE}};',

                ],               
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_cat_bg_gradiant_color_hover',
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .rs-cate:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs(); 
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta' => 'color: {{VALUE}};',

                ],               
            ]
        );

        $this->add_control(
            'blog__dots_color',
            [
                'label' => esc_html__( 'Dots Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta li:last-child::before' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3 a' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3 a:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-content' => 'color: {{VALUE}};',

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

        //start slider settings
        $this->start_controls_section(
            'section_slider_settings',
            [
                'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_responsive_control(
            'blog_left_right_spacing',
            [
                'label' => esc_html__( 'Item Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                '{{WRAPPER}} .prelements-addon-slider .blog-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Margin Left', 'rsaddon' ),
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
                    '{{WRAPPER}} .prelements-unique-slider .pre-blog-item' => 'margin-left:{{SIZE}}{{UNIT}};',                   
                ],
                'separator' => 'before',
            ]
        ); 
        $this->add_responsive_control(
            'item_gap_right_custom',
            [
                'label' => esc_html__( 'Item Margin Right', 'rsaddon' ),
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
                    '{{WRAPPER}} .prelements-unique-slider .pre-blog-item' => 'margin-right:{{SIZE}}{{UNIT}};',                    
                ],
                'separator' => 'before',
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
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dots_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-addon-slider .slick-dots li button, {{WRAPPER}} .prelements-unique-slider ul.slick-dots li button',
                'condition' => [
                    'slider_dots' => 'true'
                ],
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dots_normal_border',
				'selector' => '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid ul.slick-dots li button, {{WRAPPER}} .prelements-unique-slider ul.slick-dots li button',
                'condition' => [
                    'slider_dots' => 'true'
                ],
			]
		);
        // Active
        $this->add_control(
			'dot_active_options',
			[
				'label' => esc_html__( 'Dot Active Options', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'slider_dots' => 'true'
                ],
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dots_bg_active',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-unique-slider ul.slick-dots li.slick-active button, {{WRAPPER}} .prelements-addon-slider .slick-dots li.slick-active button, {{WRAPPER}} .prelements-unique-slider ul.slick-dots li button:hover',
                'condition' => [
                    'slider_dots' => 'true'
                ],
			]
		);
        $this->add_control(
            'dots_active_border',
            [
                'label' => esc_html__( 'Dots Active Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid ul.slick-dots li.slick-active:before' => 'border: 1px solid {{VALUE}};',
                    '{{WRAPPER}} .prelements-unique-slider ul.slick-dots li.slick-active button' => 'border: 1px solid {{VALUE}};'
                ],
                'condition' => [
                    'slider_dots' => 'true'
                ],
            ]
        );
        
        $this->add_responsive_control(
            'navigation_dots_normal_width',
            [
                'label' => esc_html__( 'Dots Normal Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-unique-slider ul.slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'navigation_dots_height',
            [
                'label' => esc_html__( 'Dots Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-unique-slider ul.slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label' => esc_html__( 'Dots Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid ul.slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'dots_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-unique-slider ul.slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'left_position',
            [
                'label'      => esc_html__( 'Dots Left Position', 'rsaddon' ),
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
                'condition' => [
                    'slider_dots' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'left: {{SIZE}}{{UNIT}};right:unset;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'dots_right_position',
            [
                'label'      => esc_html__( 'Dots Right Position', 'rsaddon' ),
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
                'condition' => [
                    'slider_dots' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'right: {{SIZE}}{{UNIT}};left:unset;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'bottom_position',
            [
                'label'      => esc_html__( 'Dots Bottom Position', 'rsaddon' ),
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
                'condition' => [
                    'slider_dots' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};top:unset;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'dotstop_position',
            [
                'label'      => esc_html__( 'Dots Top Position', 'rsaddon' ),
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
                'condition' => [
                    'slider_dots' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'top: {{SIZE}}{{UNIT}};bottom:unset;',
                ],
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nav_icon_typo',
                'label' => esc_html__( 'Navigation Icon Typography', 'rsaddon' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-unique-slider button.slick-arrow::before',
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
        $this->add_control( 'btn_border_gradiant', 
        [
			'label' => esc_html__( 'Gradiant Enable', 'rsaddon' ),
			'type' => Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'btn_border_gradiant_enable' => esc_html__( 'Enable', 'rsaddon' ),
				'' => esc_html__( 'Disable', 'rs-addon' ),
			],
            'condition' => [
                'slider_nav' => 'true'
            ],
		] );


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
                    'slider_nav' => 'true'
                ],
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'left',
					'slider_nav' => 'true'
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'right',
					'slider_nav' => 'true'
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
				'condition'=>[
					'slider_nav' => 'true'
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'top',
					'slider_nav' => 'true'
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'bottom',
					'slider_nav' => 'true'
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
					'slider_nav' => 'true'
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'left',
					'slider_nav' => 'true'
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'right',
					'slider_nav' => 'true'
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
                    'slider_nav' => 'true'
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'top',
					'slider_nav' => 'true'
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
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-next' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'bottom',
					'slider_nav' => 'true'
		        ]
			]
		);


        $this->start_controls_tabs( '_tabs_global' );
        // Normal Start
        $this->start_controls_tab(
            'arrow_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'arrow_bg',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-next, {{WRAPPER}} .prelements-addon-slider .slick-prev, {{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:after' => 'background: {{VALUE}};',],
                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );
        $this->add_control(
            'arrow_icon_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-prev:before, {{WRAPPER}} .prelements-addon-slider .slick-next:before' => 'color: {{VALUE}};',],

                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );
        $this->add_control(
			'gradiant_icon_heading',
			[
				'label' => esc_html__( 'Gradiant Icon Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'gradiant_icon_color',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:before',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'arrow_icon_border_r',
                'selector' => '{{WRAPPER}} .slick-next, {{WRAPPER}} .slick-prev',
            ]
        );
        $this->add_control(
			'gradiant_border_heading',
			[
				'label' => esc_html__( 'Gradiant Border Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'gradiant_border',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->end_controls_tab(); // Normal End 
                
            // Hover Start
            $this->start_controls_tab(
                'arrow_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );
            $this->add_control(
                'arrow_bg_hover',
                [
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-next:hover, {{WRAPPER}} .prelements-addon-slider .slick-prev:hover, {{WRAPPER}} .prelements-addon-slider .slick-next:hover:before' => 'background: {{VALUE}};',],
                    'condition' => [
                        'slider_nav' => 'true'
                    ],
                ]
            );
            $this->add_control(
                'gradiant_bg_hover_heading',
                [
                    'label' => esc_html__( 'Gradiant Hover Background', 'rsaddon' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'arrow_gradiant_bg_hover',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:hover::after',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_control(
                'gradiant_icon_hover_heading',
                [
                    'label' => esc_html__( 'Gradiant Icon Hover Color', 'rsaddon' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'icon_hover_gradiant_color',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:hover::before',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_control(
                'arrow_icon_color_hover',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-prev:hover:before, {{WRAPPER}} .prelements-addon-slider .slick-next:hover:before' => 'color: {{VALUE}};',],

                    'condition' => [
                        'slider_nav' => 'true'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'arrow_icon_border_r_hover',
                    'selector' => '{{WRAPPER}} .slick-next:hover, {{WRAPPER}} .slick-prev:hover',
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'arrow_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                     '{{WRAPPER}} .slick-next, {{WRAPPER}} .slick-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; width: auto; height: auto;',
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .slick-next, {{WRAPPER}} .slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
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

        $slidesToShow    = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $interval        = $settings['slider_interval'];
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
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
       
        $unique = rand(100,31120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');
        ?>

            <div class="prelements-unique-slider prelements-blog-grid">
            <!-- Default Old Style -->           
            <div id="prelements-slick-slider-<?php echo esc_attr($unique); ?>" class="prelements-addon-slider blog_style_<?php echo esc_html($settings['latest_blog_slider_style']);?>">
                <?php 
                    if('style1' == $settings['latest_blog_slider_style']){
                        include plugin_dir_path(__FILE__)."/style1.php";
                    } 
                    elseif ('style2' == $settings['latest_blog_slider_style']){                        
                        include plugin_dir_path(__FILE__)."/style2.php";
                    } 
                    else {                        
                        include plugin_dir_path(__FILE__)."/style1.php";
                    }
                ?>                 
            </div>           
            <!-- End Default Old Style -->
            <div class="prelements-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div> 
            <script type="text/javascript"> 
            jQuery(document).ready(function(){
                jQuery( '.prelements-addon-slider' ).each(function( index ) {        
                    var slider_id       = jQuery(this).attr('id'); 
                    var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.prelements-unique-slider').find('.prelements-slider-conf').attr('data-conf'));               
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
                    gap: 30,
                    loop : false,
                    rtl: <?php echo $rtl; ?>,
                    responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: parseInt(slider_conf.col_md),
                        }
                    }, 
                    {
                        breakpoint: 881,
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
            });
        </script>
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
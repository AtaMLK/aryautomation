<?php
/**
 * Hotspot widget.
 *
 */
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();

class rselementsElementor_Pro_Hotspot_Showcase_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve rs hotspot widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rs-hotspot';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RS Hotspot Showcase', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'rs-badge';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'hotspot', 'location', 'maping', 'address', 'image' ];
    }

    protected function register_controls() {
        // Content Section Start
        $this->start_controls_section(
            '_section_hotspot',
            [
                'label' => esc_html__( 'Hotspot Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'pre_map_image',
                [
                    'label' => esc_html__('Map Image', 'rsaddon'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_responsive_control(
                'map_align',
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots' => 'text-align: {{VALUE}}'
                    ]
                ]
            );

            $repeater = new Repeater();
            $repeater->add_control(
                'name',
                [
                    'label' => esc_html__('Title', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Embassy of the States of America Rd-124545', 'rsaddon'),
                    'label_block' => false,
                    'placeholder' => esc_html__( 'Name', 'rsaddon' ),
                    'separator'   => 'before',
                ]
            );
            $repeater->add_control(
                'description',
                [
                    'label' => esc_html__('Description', 'rsaddon'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('What I find remarkable is that this text has been the industrys standard', 'rsaddon'),
                    'label_block' => true,
                    'placeholder' => esc_html__( 'Description', 'rsaddon' ),
                    'separator'   => 'before',
                ]
            );
            $repeater->add_responsive_control(
                'item_position_left',
                [
                    'label' => esc_html__( 'Position (Left/Right)', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -5000,
                            'max' => 5000,
                        ],
                    ],                
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .rs-hotspot-item' => 'left: {{SIZE}}{{UNIT}};',                   
                    ],
                ]
            );
            $repeater->add_responsive_control(
                'item_position_top',
                [
                    'label' => esc_html__( 'Position (Top/Bottom)', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -5000,
                            'max' => 5000,
                        ],
                    ],                
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .rs-hotspot-item' => 'top: {{SIZE}}{{UNIT}};',                   
                    ],
                ]
            );
            $this->add_control(
                'hotspots_list',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'title_field' => '{{{ name }}}',
                    'default' => [
                        ['name'  => esc_html__( 'Embassy of the States of America Rd-124545', 'rsaddon' ),],
                        ['name'  => esc_html__( 'Embassy of the States of America Rd-124545', 'rsaddon' ),],
                        ['name'  => esc_html__( 'Embassy of the States of America Rd-124545', 'rsaddon' ),],
                        ['name'  => esc_html__( 'Embassy of the States of America Rd-124545', 'rsaddon' ),],
                    ]
                ]
            );
        $this->end_controls_section();
        // Content Section End

        // General Style Start
        $this->start_controls_section(
            '_default_style',
            [
                'label' => esc_html__( 'Default Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'box_background',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-hots-figure',
                ]
            );
            $this->add_control(
                'triangle_color',
                [
                    'label' => esc_html__( 'Bubble Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,            
                    'selectors' => [
                        '{{WRAPPER}} .rs-hots-figure:after' => 'border-top-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'box_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-hots-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'box_border',
                    'selector' => '{{WRAPPER}} .rs-hots-figure',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-hots-figure',
                ]
            );
            $this->add_control(
                'box_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-hots-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                    ],
                ]
            );
            $this->add_responsive_control(
                'box_align',
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-hots-figure' => 'text-align: {{VALUE}}'
                    ]
                ]
            );
            $this->add_responsive_control(
                'figure_min_width',
                [
                    'label' => esc_html__( 'Min-Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-hots-figure' => 'min-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // General Style End

        // Ripple Style Start
        $this->start_controls_section(
            '_ripple_style',
            [
                'label' => esc_html__( 'Ripple Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'ripple_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pre-circle-ripple:before' => 'background: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'ripple_inner_border_color',
                [
                    'label' => esc_html__( 'Inner Border Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pre-circle-ripple:after' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
        $this->end_controls_section();
        // Ripple Style Start

        // Title Style Start
        $this->start_controls_section(
            '_title_style',
            [
                'label' => esc_html__( 'Title Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'show_title',
                [
                    'label' => esc_html__( 'Show', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'title_tag',
                [
                    'label' => esc_html__( 'HTML Tag', 'rsaddon' ),
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
                    'default' => 'h4',
                    'toggle' => false,
                    'condition' => [
                        'show_title' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .pre-title .title' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'show_title' => 'yes'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}}  .pre-title .title',
                    'separator'   => 'before',
                    'condition' => [
                        'show_title' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'title_padding',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .pre-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_title' => 'yes'
                    ],
                ]
            );
        $this->end_controls_section();
        // Title Style End

        // Description Style Start
        $this->start_controls_section(
            '_description_style',
            [
                'label' => esc_html__( 'Description Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'show_description',
                [
                    'label' => esc_html__( 'Show', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hotspot-desc .description' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'show_description' => 'yes'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}}  .hotspot-desc .description',
                    'separator'   => 'before',
                    'condition' => [
                        'show_description' => 'yes'
                    ],
                ]
            );
        $this->end_controls_section();
        // Description Style Start

        // Mobile Style Start
        $this->start_controls_section(
            '_mobile_style',
            [
                'label' => esc_html__( 'Mobile Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'box_mobile_background',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-hotspots .mobile_item',
                ]
            );
            $this->add_responsive_control(
                'box_mobile_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'box_mobile_border',
                    'selector' => '{{WRAPPER}} .rs-hotspots .mobile_item',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_mobile_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-hotspots .mobile_item',
                ]
            );
            $this->add_control(
                'box_mobile_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                    ],
                ]
            );
            $this->add_responsive_control(
                'box_mobile_align',
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item' => 'text-align: {{VALUE}}'
                    ]
                ]
            );
            $this->add_responsive_control(
                'box_mobile_max_width',
                [
                    'label' => esc_html__( 'Max-Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            // Mbile Close Icon
            $this->add_control(
                'box_mobile_close_icon_options',
                [
                    'label' => esc_html__( 'Close Icon Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'box_mobile_close_icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item .remove-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    ],
                ]
            );
            // Mobile Title
            $this->add_control(
                'mobile_title_options',
                [
                    'label' => esc_html__( 'Title Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'mobile_title_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item .pre-title .title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'mobile_title_typography',
                    'selector' => '{{WRAPPER}} .rs-hotspots .mobile_item .pre-title .title',
                ]
            );
            $this->add_responsive_control(
                'mobile_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item .pre-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            // Description Title
            $this->add_control(
                'mobile_desc_options',
                [
                    'label' => esc_html__( 'Description Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'mobile_desc_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-hotspots .mobile_item .hotspot-desc p' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'mobile_desc_typography',
                    'selector' => '{{WRAPPER}} .rs-hotspots .mobile_item .hotspot-desc p',
                ]
            );
        $this->end_controls_section();
        // Mobile Style End
    }

    protected function render() {

        $settings = $this->get_settings_for_display();        

        if ( empty($settings['hotspots_list'] ) ) {
            return;
        }
        ?>
        <div class="rs-hotspots">
            <?php if(!empty($settings['pre_map_image']['url'])) :?>
                <img src="<?php echo esc_url($settings['pre_map_image']['url']);?>" alt="image">
            <?php endif;?>
            <?php
            $pre_i = 1;
            foreach ( $settings['hotspots_list'] as $index => $hotspot ) :
                $name = $hotspot['name'];
                if ( ! $name ) {
                    $name = $hotspot['name'];
                }  
                $title = !empty($hotspot['name']) ? $hotspot['name'] : '';
                $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h5';                        
                $description = !empty($hotspot['description']) ? $hotspot['description'] : '';
                ?>

                <div class="desktop_item elementor-repeater-item-<?php echo $hotspot['_id'];?>">
                	<div class="rs-hotspot-item hotspot__<?php echo esc_attr($pre_i); ?>">
                	    <div  class="rs-hots-figure">                            
                            <?php if ( 'yes' === $settings['show_title'] ):?>                            
                                <?php if(!empty($hotspot['name'])):?>
                                    <div class="pre-title">
                                        <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr ($title); ?> </<?php echo esc_attr($title_tag);?>>                                    
                                    </div>
                                <?php endif;?>
                            <?php endif;?>

                	        <!-- Start Description -->
                            <?php if ( 'yes' === $settings['show_description'] ):?>
                    	        <?php if(!empty($hotspot['description'])):?>            	            
                	                <div class="hotspot-desc">
                	                    <p class="description"> <?php echo wp_kses_post($description); ?></p>
                	                </div>            	            
                    	        <?php endif;?>
                            <?php endif;?>
                	        <!-- End Description -->
                	    </div>
                        <div class="pre-circle-ripple"></div>
                	</div>
                </div>
                
                <div class="mobile_item elementor-repeater-item-<?php echo $hotspot['_id'];?>">
                    <i class="remove-icon ri-close-line"></i>
                    <?php if ( 'yes' === $settings['show_title'] ):?>                            
                        <?php if(!empty($hotspot['name'])):?>
                            <div class="pre-title">
                                <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr ($title); ?> </<?php echo esc_attr($title_tag);?>>                                    
                            </div>
                        <?php endif;?>
                    <?php endif;?>
                    <?php if ( 'yes' === $settings['show_description'] ):?>
                        <?php if(!empty($hotspot['description'])):?>            	            
                            <div class="hotspot-desc">
                                <p class="description"> <?php echo wp_kses_post($description); ?></p>
                            </div>            	            
                        <?php endif;?>
                    <?php endif;?>
                </div>
            <?php $pre_i++; endforeach; ?> 
        </div>

        <script>
            jQuery(document).ready(function() {
                jQuery('.desktop_item').each(function(index) {
                    var uniqueClass = 'desktop_item-' + index;
                    jQuery(this).addClass(uniqueClass);
                    var parentHotspots = jQuery(this).closest('.rs-hotspots');
                    var targetMobileItem = parentHotspots.find('.mobile_item').eq(index);
                    jQuery(this).click(function() {
                        if (targetMobileItem.hasClass('active')) {
                            targetMobileItem.removeClass('active');
                        } else {
                            parentHotspots.find('.mobile_item.active').removeClass('active');
                            targetMobileItem.addClass('active');
                        }
                    });
                    parentHotspots.on('click', '.remove-icon', function(event) {
                        event.stopPropagation();
                        targetMobileItem.removeClass('active');
                    });
                });

                // Ripple Class Switching
                var switches = jQuery('.rs-hotspots .desktop_item');
                var currentIndex = 0;
                var interval;
                var speed = 1500;

                function startRotation() {
                    interval = setInterval(function() {
                        switches.eq(currentIndex).removeClass('ripple');
                        currentIndex = (currentIndex + 1) % switches.length;
                        switches.eq(currentIndex).addClass('ripple');
                    }, speed);
                }
                function stopRotation() {
                    clearInterval(interval);
                    switches.eq(currentIndex).removeClass('ripple');
                }
                startRotation();
                switches.hover(
                    function() {
                        stopRotation();
                    },
                    function() {
                        startRotation();
                    }
                );
            });
        </script>


    <?php 
    }
}
<?php
/**
 * Feature List
 *
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSwork_Process_Widget extends \Elementor\Widget_Base {

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
        return 'rswork-process';
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
        return esc_html__( 'RS Work Process', 'rsaddon' );
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
        return [ 'work', 'process' ];
    }



    protected function register_controls() {       

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'work_process_title',
            [
                'label' => esc_html__( 'Work Title', 'rsaddon' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Product Design and Planning', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'number_title',
            [
                'label' => esc_html__( 'Number Title', 'rsaddon' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '01', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'rsaddon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => "I'm winner of the world's most prestigious web design awards in the fields.",
            ]
        );

        $this->add_control(
            'history_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'work_process_title' => esc_html__( 'Web Developer', 'rsaddon' ),
                    ],
                    [
                        'work_process_title' => esc_html__( 'Sr. Developer', 'rsaddon' ),
                    ],
                   
                ],
                'title_field' => '{{{ work_process_title }}}',
            ]
        );

        $this->add_responsive_control(
            'g_display_style',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'g_vertical_align',
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
                'condition' => [
                    'g_display_style' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'g_column_align',
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
                'condition' => [
                    'g_display_style' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'g_h_align',
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
                'condition' => [
                    'g_display_style' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'g_flex_wrap',
            [
                'label' => esc_html__( 'Flex Wrap', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'nowrap' => [
                        'title' => esc_html__( 'No Wrap', 'rsaddon' ),
                        'icon' => 'eicon-nowrap',
                    ],
                    'wrap' => [
                        'title' => esc_html__( 'Wrap', 'rsaddon' ),
                        'icon' => 'eicon-wrap',
                    ],
                ],
                'condition' => [
                    'g_display_style' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item' => 'flex-wrap: {{VALUE}};',
                ],
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
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .left-part .item-period' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .left-part h4' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .right-part h4' => 'color: {{VALUE}};',                   
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .right-part .item-period' => 'color: {{VALUE}};',                   

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-work-process-wrap .work-item .left-part .item-period, {{WRAPPER}} .rs-work-process-wrap .work-item .left-part h4,{{WRAPPER}} .rs-work-process-wrap .work-item .right-part h4, {{WRAPPER}} .rs-work-process-wrap .work-item .right-part .item-period',                    
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .left-part .item-period, {{WRAPPER}} .rs-work-process-wrap .work-item .left-part h4,{{WRAPPER}} .rs-work-process-wrap .work-item .right-part h4, {{WRAPPER}} .rs-work-process-wrap .work-item .right-part .item-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .left-part .item-period, {{WRAPPER}} .rs-work-process-wrap .work-item .left-part h4,{{WRAPPER}} .rs-work-process-wrap .work-item .right-part h4, {{WRAPPER}} .rs-work-process-wrap .work-item .right-part .item-period' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        $this->add_responsive_control(
            'title_part_width',
            [
                'label' => esc_html__('Title Part Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .right-part' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_description_style',
            [
                'label' => esc_html__( 'Description Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .timeline-desc p' => 'color: {{VALUE}};',                                                  
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .timeline-desc' => 'color: {{VALUE}};',                                                  

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__( 'Description Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-work-process-wrap .work-item .timeline-desc p,{{WRAPPER}} .rs-work-process-wrap .work-item .timeline-desc',                    
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__( 'Description Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .timeline-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_responsive_control(
            'desc_part_width',
            [
                'label' => esc_html__('Description Wrapper Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .timeline-desc' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_step_style',
            [
                'label' => esc_html__( 'Step Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'step_typography',
                'label' => esc_html__( 'Step Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part span',                    
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'divider_border',
                'selector' => '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part:after',
            ]
        );

        $this->add_responsive_control(
            'step_width',
            [
                'label' => esc_html__('Step Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part span' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'step_height',
            [
                'label' => esc_html__('Step Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part span' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'step_part_width',
            [
                'label' => esc_html__('Step Wrapper Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'divider_left_pos',
            [
                'label' => esc_html__('Divider Left Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part:after' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'divider_top_pos',
            [
                'label' => esc_html__('Divider Top Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'divider_height',
            [
                'label' => esc_html__('Divider Divider Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'work_p_steps_normal_hover_style_tabs' );
        
            $this->start_controls_tab(
                'work_p_steps_normal_style',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );
                $this->add_control(
                    'step_color',
                    [
                        'label' => esc_html__( 'Step Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part span' => 'color: {{VALUE}};',                                                                                               
                        ],                
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'step_bgcolor',
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-work-process-wrap .work-item .rs-step-part span',
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'work_p_steps_hover_style',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );
                $this->add_control(
                    'step_hover_color',
                    [
                        'label' => esc_html__( 'Step Hover Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-work-process-wrap .work-item:hover .rs-step-part span' => 'color: {{VALUE}};',                                                                                               
                        ],                
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'step_hover_bgcolor',
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-work-process-wrap .work-item:hover .rs-step-part span',
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
        <div class="rs-work-process-wrap clearfix">

            <?php 
            $count = 1;
            foreach ( $settings['history_list'] as $index => $feature ) : 

                $work_process_title = $feature['work_process_title'];
                $description   = $feature['description'];
                $number_title    = $feature['number_title'];

                ?>               
                <div class="work-item clearfix">
                    <div class="rs-step-part"><span><?php echo $number_title;?></span></div>
                    <div class="right-part">
                        <h5 class="item-period"><?php echo esc_html($work_process_title); ?></h5> 
                    </div>
                    <div class="timeline-desc">
                        <p><?php echo $description;?></p>
                    </div>
                </div>
            <?php endforeach; ?>
           </div>
    <?php
    }
}?>
<?php
/**
 * Elementor RS Couter Widget.
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
use Elementor\Utils;

use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Breadcrumb_Widget extends \Elementor\Widget_Base {

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
        return 'rs-breadcrumb';
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
        return esc_html__( 'RS Breadcrumb', 'rsaddon' );
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
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'Breadcrumb' ];
    }
	protected function register_controls() {
        $this->start_controls_section(
            'section_cta',
            [
                'label' => esc_html__( 'Breadcrumb', 'rsaddon' ),
            ]
        );            

        $this->add_control(
            'breadcrumb_style',
            [
                'label'   => esc_html__( 'Breadcrumb Separator Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [                  
                    'style1' => esc_html__( 'Default Style', 'rsaddon'),
                    'style2' => esc_html__( 'Dots Style', 'rsaddon'),
                    'style3' => esc_html__( 'Arrow Style', 'rsaddon'),
                ],
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'breadcrumb_area_bg_color',
                'label' => esc_html__( 'Hover Shape Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .breadcrumb-area',
                'condition' => [
                    'breadcrumb_style' => 'style2',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_dot_bg_color',
            [
                'label' => esc_html__( 'Breadcrumb Dots Bg Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area.style2 span::after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'breadcrumb_style' => 'style2',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb-color',
            [
                'label' => esc_html__( 'Breadcrumb Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area, {{WRAPPER}} .breadcrumb-area span, {{WRAPPER}} .breadcrumbs-inner span a:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .breadcrumbs-inner span a:after' => 'background: {{VALUE}};',
                ],
            ]
        );  

        $this->add_control(
            'breadcrumb_link_color',
            [
                'label' => esc_html__( 'Breadcrumb Link Color (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area span a span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_link_hover_color',
            [
                'label' => esc_html__( 'Breadcrumb Link Color (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area span a:hover span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'breadcrumb_icon_color',
            [
                'label' => esc_html__( 'Breadcrumb Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area.style3 span:after' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'breadcrumb_style' => 'style3',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'breadcrumb_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .breadcrumb-area span',
            ]
        );  

        $this->add_responsive_control(
            'breadcrumb-padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'breadcrumb-margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'breadcrumb_width',
            [
                'label' => esc_html__( 'Breadcrumb Area Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'breadcrumb-padding-area',
            [
                'label' => esc_html__( 'Breadcrumb Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'separator_top_position',
            [
                'label' => esc_html__( 'Separator Top Position', 'rsaddon' ),
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
                    '{{WRAPPER}} .breadcrumbs-inner span a:after' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'breadcrumb_style'=> 'style1',
                ]
            ]
        );
        $this->add_responsive_control(
            'separator_right_position',
            [
                'label' => esc_html__( 'Separator Right Position', 'rsaddon' ),
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
                    '{{WRAPPER}} .breadcrumbs-inner span a:after' => 'right: {{SIZE}}{{UNIT}}!important;',
                ],
                'condition' => [
                    'breadcrumb_style'=> 'style1',
                ]
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {   
        $settings = $this->get_settings_for_display();
        ?>
        <?php 
        if(function_exists('bcn_display')){?>
            <div class="breadcrumb-area <?php echo esc_attr( $settings['breadcrumb_style'] ); ?>"> 
                <div class="breadcrumbs-inner"> 
                    <?php bcn_display(); ?>
                </div>
            </div> 
        <?php } ?>  
    <?php 
    }
}

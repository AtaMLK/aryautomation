<?php
/**
 * Elementor RS Newsletter Widget.
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


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSNewsLetter_Widget extends \Elementor\Widget_Base {

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
        return 'rs-newsletter';
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
        return esc_html__( 'RS Newsletter', 'rsaddon' );
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
        return [ 'newsletter', 'form', 'contact' ];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'prelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'shortcode',
            [
                'label' => esc_html__( 'Shortcode Text', 'prelements' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Shortcode Here', 'prelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'rs_newsletter_select',
            [
                'label'   => esc_html__('Newsletter Style', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style2',
                'options' => [
                    'style1' => esc_html__('Style 1', 'rsaddon'),
                    'style2' => esc_html__('Style 2', 'rsaddon'),
                ],
                'separator' => 'before',

            ]
        );

        $this->end_controls_section();
 
        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => esc_html__( 'Form Fields', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'field_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'width: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'field_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields .rs-newsletter-form .form-inner, {{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'height: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );


        $this->add_responsive_control(
            'field_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .mc4wp-form-fields  input',
            ]
        );

        $this->add_control(
            'field_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_placeholder_color',
            [
                'label' => esc_html__( 'Placeholder Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="email"]',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="email"]',
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => esc_html__( 'Focus', 'rsaddon' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_focus_border',
                'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="email"]:focus',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="email"]:focus',
            ]
        );

        $this->add_control(
            'field_focus_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Label Style Start
        $this->start_controls_section(
            '_label',
            [
                'label' => esc_html__( 'Label', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .mc4wp-form-fields label',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Label Style End

        $this->start_controls_section(
            'submit',
            [
                'label' => esc_html__( 'Submit Button', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'button_position',
			[
				'label' => esc_html__( 'Button Position', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'relative',
				'options' => [
					'relative' => esc_html__( 'block', 'rsaddon' ),
					'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} input[type="submit"]' => 'position: {{VALUE}};z-index: 1;right: 5px;top: 5px',
				],
			]
		);

        $this->add_control(
            'submit_filter_color',
            [
                'label' => esc_html__( 'Filter Invert(1/0)', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'selectors' => [
                    '{{WRAPPER}} .rs_newsletterstyle2 .mc4wp-form-fields em img' => 'filter: invert({{VALUE}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_right_x',
            [
                'label' => esc_html__( 'Button Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'right: {{SIZE}}{{UNIT}}!important;',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'button_top_x',
            [
                'label' => esc_html__( 'Button Top Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'top: {{SIZE}}{{UNIT}}!important;',                    
                                    
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );

            $this->add_control(
                'submit_color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form-fields input[type="submit"], {{WRAPPER}} .subscribe_btn' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'submit_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'submits_gradiant_background',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]',
                ]
            );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'submit_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]:hover, {{WRAPPER}} .mc4wp-form-fields input[type="submit"]:focus, {{WRAPPER}} .subscribe_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]:hover, {{WRAPPER}} .mc4wp-form-fields input[type="submit"]:focus' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'submits_gradiant_hover_background',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]:hover, {{WRAPPER}} .mc4wp-form-fields input[type="submit"]:focus',
            ]
        );

        $this->add_control(
            'submit_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]:hover, {{WRAPPER}} .mc4wp-form-fields input[type="submit"]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'field_width_btn',
            [
                'label' => esc_html__( 'Button Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'field_height_btn',
            [
                'label' => esc_html__( 'Button Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );
        $this->add_responsive_control(
            'submit_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'submit_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submit_typography',
                'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submit_border',
                'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]',
            ]
        );
        $this->add_control(
            'submit_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_icon_position',
            [
                'label' => esc_html__( 'Position Arrow Left', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .subscribe_btn i' => 'left: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs_newsletterstyle1 .mc4wp-form-fields em code.news-icon-btn2, {{WRAPPER}} .rs_newsletterstyle1 .mc4wp-form-fields em code.news-icon-btn1' => 'left: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_icon_position_top',
            [
                'label' => esc_html__( 'Position Arrow Top', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .subscribe_btn i' => 'top: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs_newsletterstyle1 .mc4wp-form-fields em code.news-icon-btn2, {{WRAPPER}} .rs_newsletterstyle1 .mc4wp-form-fields em code.news-icon-btn1' => 'top: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_icon_position_hover',
            [
                'label' => esc_html__( 'Position Arrow (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .subscribe_btn:hover i' => 'left: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_icon_color_opacity',
            [
                'label' => esc_html__( 'Arrow Icon Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs_newsletterstyle1 .mc4wp-form-fields em img' => 'filter: invert({{SIZE}});',                    
                                    
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display(); 
        echo '<div class="rs-newsletter-form  rs_newsletter'.$settings['rs_newsletter_select'].' ">';
        echo do_shortcode($settings['shortcode']);
        echo '</div>';
    }
}



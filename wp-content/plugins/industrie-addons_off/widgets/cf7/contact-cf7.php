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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSCF7_Widget extends \Elementor\Widget_Base {

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
        return 'rs-cf7';
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
        return esc_html__( 'Contact Form 7', 'rsaddon' );
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
        return [ 'counter' ];
    }
	protected function register_controls() {
		$this->start_controls_section(
			'_section_cf7',
			[
				'label' => class_exists( 'WPCF7' ) ? esc_html__( 'Contact Form 7', 'rsaddon' ) : esc_html__( 'Notice', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        if ( ! class_exists( 'WPCF7' ) ) {
            $this->add_control(
                'cf7_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        esc_html__( 'Hi, it seems contact form7 is missing in your site. Please install and activate contact form7 first.', 'rsaddon' ),
                        '<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank" rel="noopener">Contact Form 7</a>'
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                ]
            );
            $this->end_controls_section();
            return;
        }
// contact-heading-title
        $this->add_control(
            'selected_form_id',
            [
                'label' => esc_html__( 'Chosse Your Form', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ['' => esc_html__( '', 'rsaddon' ) ] + \rs_get_cf7_forms(),
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
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'width: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'field_width_select',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'height: {{SIZE}}px; display: block;',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label' => esc_html__( 'Spacing Bottom', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_indent',
            [
                'label' => esc_html__( 'Text Indent', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'text-indent: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_all_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} select:valid, {{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );
        $this->add_control(
            'field_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'field_placeholder_color',
            [
                'label' => esc_html__( 'Placeholder Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} select:valid' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
		);
        $this->add_responsive_control(
            'input_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .form-list i, {{WRAPPER}} .wpcf7 .col-sm-12 i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'input_icon_text_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .contact-us-page .wpcf7-form .col-sm-12 i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .contact-us-page .wpcf7-form .col-sm-6 i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .contact-us-page .wpcf7-form i' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'icon_focus_color',
            [
                'label' => esc_html__( 'Icon Focus Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus .wpcf7-form .col-sm-12 i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_top_position',
            [
                'label' => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .form-list i, {{WRAPPER}} .wpcf7 .col-sm-12 i' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'icon_left_position',
            [
                'label' => esc_html__( 'Left/Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .form-list i, {{WRAPPER}} .wpcf7 .col-sm-12 i' => 'left: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'email_icon_top_position',
            [
                'label' => esc_html__( 'Email Top/Bottom Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .col-sm-12 p i.ri-mail-line' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'message_icon_top_position',
            [
                'label' => esc_html__( 'Textarea Top/Bottom Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .col-sm-12 p i.ri-edit-line' => 'top: {{SIZE}}{{UNIT}}!important;',
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
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );

        $this->add_control(
            'field__border_mac',
            [
                'label'   => esc_html__( 'Border Type (For Mac)', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    '' => esc_html__( 'None', 'rsaddon' ),
                    'solid' => esc_html__( 'Solid', 'rsaddon' ),
                    'double' => esc_html__( 'Double', 'rsaddon' ),
                    'dotted' => esc_html__( 'Dotted', 'rsaddon' ),
                    'dashed' => esc_html__( 'Dashed', 'rsaddon' ),
                    'groove' => esc_html__( 'Groove', 'rsaddon' ),
                ],
            ]
        );

        $this->add_control(
            'field__border_width',
            [
                'label'   => esc_html__( 'Border Width (For Mac)', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    '1px' => esc_html__( '1', 'rsaddon' ),
                    '2px' => esc_html__( '2', 'rsaddon' ),
                    '3px' => esc_html__( '3', 'rsaddon' ),
                    '4px' => esc_html__( '4', 'rsaddon' ),
                    '5px' => esc_html__( '5', 'rsaddon' ),
                    '6px' => esc_html__( '6', 'rsaddon' ),
                    '7px' => esc_html__( '7', 'rsaddon' ),
                    '8px' => esc_html__( '8', 'rsaddon' ),
                    '9px' => esc_html__( '9', 'rsaddon' ),
                    '10px' => esc_html__( '10', 'rsaddon' ),
                    '11px' => esc_html__( '11', 'rsaddon' ),
                    '12px' => esc_html__( '12', 'rsaddon' ),
                ],
                'condition' => [
                    'field__border_mac!' => '',
                ]
            ]
        );

        $this->add_control(
            'field__border_color',
            [
                'label' => esc_html__( 'Color (For Mac)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'field__border_mac!' => '',
                ]
            ]
        );

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'field_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .request-a-services select, {{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
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
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus, {{WRAPPER}} body div textarea:focus, {{WRAPPER}} input[type="text"]:focus, {{WRAPPER}} input[type="number"]:focus, {{WRAPPER}} input[type="password"]:focus, {{WRAPPER}} input[type="email"]:focus, {{WRAPPER}} input[type="search"]:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus',
            ]
		);

		$this->add_control(
            'field_focus_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .request-a-services select, {{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
        $this->add_responsive_control(
            'message_width',
            [
                'label' => esc_html__( 'Message Box Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control-wrap textarea' => 'height: {{SIZE}}{{UNIT}} !important;',                    
                                    
                ],
            ]
        );

		$this->end_controls_section();


        $this->start_controls_section(
            'cf7-form-label',
            [
                'label' => esc_html__( 'Form Fields Label', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__( 'Spacing Bottom', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} label',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'select',
            [
                'label' => esc_html__( 'Select', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'select_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 select.wpcf7-form-control' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} body select:valid' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'select_dropdown_icon_color',
            [
                'label' => esc_html__( 'Dropdown Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} em.select-full:after' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'select_dropdown_icon_position',
            [
                'label' => esc_html__( 'Dropdown Icon Slider', 'rsaddon' ),
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
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} em.select-full:after' => 'top:{{SIZE}}{{UNIT}}!important;',                    
                                    
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'textarea',
            [
                'label' => esc_html__( 'Textarea', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'textarea_width',
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
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form textarea' => 'width: {{SIZE}}{{UNIT}} !important;',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'textarea_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
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
                    '{{WRAPPER}} .wpcf7-form textarea' => 'height: {{SIZE}}{{UNIT}} !important;',                    
                                    
                ],
            ]
        );
        $this->end_controls_section();

        // Range Slider Start
        $this->start_controls_section(
            'range_slider',
            [
                'label' => esc_html__( 'Range Slider', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'range_slider_heading',
			[
				'label' => esc_html__( 'Slider Control', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
			]
		);
        $this->add_control(
			'range_slider_width',
			[
				'label' => esc_html__( 'Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7 input[type=range]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'range_slider_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                'default' => [
					'unit' => 'px',
					'size' => 9,
				],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 input[type=range]' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'range_slider_bg_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .wpcf7 input[type=range]',  
			]
		);
		$this->add_responsive_control(
            'range_slider_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 input[type=range]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'range_slider_border_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 input[type=range]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'range_slider_border_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 input[type=range]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'range_slider_border',
		        'selector' => '{{WRAPPER}} .wpcf7 input[type=range]',
		    ]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'range_slider_box_shadow',
				'selector' => '{{WRAPPER}} .wpcf7 input[type=range]',
			]
		);


        $this->add_control(
            'heading_range_slider_pointer',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Slider Pointer', 'rsaddon' ),
                'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'range_slider_pointer_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 input[type=range]::-webkit-slider-thumb' => 'width: {{SIZE}}{{UNIT}};',                   
                    '{{WRAPPER}} .wpcf7 input[type=range]::-moz-range-thumb' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'range_slider_pointer_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 input[type=range]::-webkit-slider-thumb' => 'height: {{SIZE}}{{UNIT}};',                   
                    '{{WRAPPER}} .wpcf7 input[type=range]::-moz-range-thumb' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_control(
			'range_slider_pointer_bg',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7 input[type=range]::-webkit-slider-thumb' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .wpcf7 input[type=range]::-moz-range-thumb' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_responsive_control(
            'range_slider_pointer_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 input[type=range]::-webkit-slider-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7 input[type=range]::-moz-range-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'range_slider_pointer_box_shadow_color',
			[
				'label' => esc_html__( 'Shadow Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7 input[type=range]::-webkit-slider-thumb' => 'box-shadow: 0px 0px 10px 0px {{VALUE}}',
					'{{WRAPPER}} .wpcf7 input[type=range]::-moz-range-thumb' => 'box-shadow: 0px 0px 10px 0px {{VALUE}}',
				]
			]
		);
        $this->add_control(
            'heading_range_slider_result',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Slider Result', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'range_slider_result_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpcf7 output.contactform7-output' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'range_slider_result_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '.wpcf7 output.contactform7-output',
		    ]
		);

        // Position Maker Pop-over Start
        $this->add_control(
            'range_slider_result_position_maker_popover_toggle',
            [
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label' => esc_html__( 'Position Maker', 'rsaddon' ),
                'label_off' => esc_html__( 'Default', 'rsaddon' ),
                'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                'return_value' => 'yes',
            ]
        );
        
        $this->start_popover();
            $this->add_control(
                'range_slider_result_position',
                [
                    'label' => esc_html__( 'Position', 'rsaddon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'relative',
                    'separator' => 'before',
                    'options' => [
                        '' => esc_html__( 'Default', 'rsaddon' ),
                        'unset' => esc_html__( 'Unset', 'rsaddon' ),
                        'relative' => esc_html__( 'Relative', 'rsaddon' ),
                        'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 output.contactform7-output' => 'position: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'range_slider_result_position_x_left',
                [
                    'label'      => esc_html__( 'Left', 'rsaddon' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 output.contactform7-output' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'range_slider_result_position' => [ 'relative', 'absolute' ],
                    ]
                ]
            );
            $this->add_responsive_control(
                'range_slider_result_position_x_right',
                [
                    'label'      => esc_html__( 'Right', 'rsaddon' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 output.contactform7-output' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'range_slider_result_position' => [ 'relative', 'absolute' ],
                    ]
                ]
            );
            $this->add_responsive_control(
                'range_slider_result_position_y_top',
                [
                    'label'      => esc_html__( 'Top', 'rsaddon' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 output.contactform7-output' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'range_slider_result_position' => [ 'relative', 'absolute' ],
                    ]
                ]
            );
            $this->add_responsive_control(
                'range_slider_result_position_y_bottom',
                [
                    'label'      => esc_html__( 'Bottom', 'rsaddon' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7 output.contactform7-output' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'range_slider_result_position' => [ 'relative', 'absolute' ],
                    ]
                ]
            );
        $this->end_popover();
        // Position Maker Pop-over End

        $this->end_controls_section();
        // Range Slider End

        $this->start_controls_section(
            'submit',
            [
                'label' => esc_html__( 'Submit Button', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'button_border_style',
			[
				'label' => esc_html__( 'Button Show/Hide?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'button_before_border_enable',
			[
				'label' => esc_html__( 'Button Before Border Show/Hide?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'button_border_bottom_position',
			[
				'label' => esc_html__( 'Border Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-home4 .wpcf7 .btn_area::before' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_border_style' => 'yes']
			]
		);
		$this->add_control(
			'button_border_left_position',
			[
				'label' => esc_html__( 'Border Position X', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-home4 .wpcf7 .btn_area::before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_border_style' => 'yes']
			]
		);

		$this->add_control(
			'button_border_ddfwidth',
			[
				'label' => esc_html__( 'Border Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-home4 .wpcf7 .btn_area::before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_border_style' => 'yes']
			]
		);
		$this->add_control(
			'button_border_dfdfheight',
			[
				'label' => esc_html__( 'Border Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .contact-home4 .wpcf7 .btn_area::before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_border_style' => 'yes']
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submit_borders',
                'selector' => '{{WRAPPER}} .contact-home4 .wpcf7 .btn_area::before',
                'condition' => ['button_border_style' => 'yes']
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
            'btn_gradient_clr_switch',
            [
                'label' => esc_html__( 'Button Gradient Show/Hide?', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .chatbot-submit-btn:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7-form .form-btn-area svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'icon_text_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .chatbot-submit-btn:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .form-btn-area svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7-form .form-btn-area svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_text_bg',
            [
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .chatbot-submit-btn:before' => 'background: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'circle_background',
            [
                'label' => esc_html__( 'Button Circle Dots Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .arrow-btn:after' => 'background: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submit_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition'=>[
                    'btn_gradient_clr_switch!'=> 'yes',
                ]

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpcf7-submit, {{WRAPPER}} .btn-gradient-clr .wpcf7-submit',
            ]
        );
        $this->add_responsive_control(
			'btn_position_maker',
			[
				'label' => esc_html__( 'Button Position', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'relative' => esc_html__( 'Relative', 'rsaddon' ),
					'absolute'  => esc_html__( 'Absolute', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7 .submit-btn' => 'position: {{VALUE}} !important;',
				],
			]
		);
        $this->add_responsive_control(
            'btn_position_left',
            [
                'label' => esc_html__( 'Left Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .submit-btn' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_position_maker' => ['relative','absolute']
                ]
            ]
        );
        $this->add_responsive_control(
            'btn_position_right',
            [
                'label' => esc_html__( 'Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .submit-btn' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_position_maker' => ['relative','absolute']
                ]
            ]
        );
        $this->add_responsive_control(
            'btn_position_top',
            [
                'label' => esc_html__( 'Top Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .submit-btn' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_position_maker' => ['relative','absolute']
                ]
            ]
        ); 
        $this->add_responsive_control(
            'btn_position_bottom',
            [
                'label' => esc_html__( 'Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .submit-btn' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'btn_position_maker' => ['relative','absolute']
                ]
            ]
        ); 
        $this->add_control(
            'button_before_border',
            [
                'label' => esc_html__( 'Button Before Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .form-btn-area::after' => 'background-color: {{VALUE}};',
                ],
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
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_text_hover_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form .form-btn-area:hover svg' => 'fill: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus',
            ]
        );

        $this->add_control(
            'submit_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .form-btn-area:before' => 'background-color: {{VALUE}}!important;',
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
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .form-btn-area p, {{WRAPPER}} .wpcf7-submit' => 'width: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );
        $this->add_responsive_control(
            'field_height_btn',
            [
                'label' => esc_html__( 'Button Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .wpcf7-submit' => 'height: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );
        $this->add_responsive_control(
            'hover_border_height',
            [
                'label' => esc_html__( 'Hover Border Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .form-btn-area:before' => 'height: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );
        $this->add_responsive_control(
            'hover_border_height_position',
            [
                'label' => esc_html__( 'Hover Border Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .form-btn-area:before' => 'bottom: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_padding_icon_wrapper',
            [
                'label' => esc_html__( 'Icon Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .form-btn-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submit_typography',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submit_border',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );
        $this->add_control(
            'custom_submit_border_notice',
            [
                'label' => esc_html__( '(Custom Border Option)', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => esc_html__( 'This border will only work if used in this .form-btn-area class', 'rsaddon' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'custom__submit_border',
                'selector' => '{{WRAPPER}} .form-btn-area',
                'default' => esc_html__( 'Custom Submit Border', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'submit_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .submit-btn .wpcf7-submit,
                    {{WRAPPER}} .form-button,
                    {{WRAPPER}} .form-btn-area' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_control(
            'hr4',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );       

        $this->end_controls_section();

        $this->start_controls_section(
            'contact_from_heading',
            [
                'label' => esc_html__( 'Heading', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'form_heading_typography',
                'selector' => '{{WRAPPER}} .wpcf7 .wpcf7-form .row h2,{{WRAPPER}} .wpcf7 .wpcf7-form .row h1,{{WRAPPER}} .wpcf7 .wpcf7-form .row h3,{{WRAPPER}} .wpcf7 .wpcf7-form .row h4,{{WRAPPER}} .wpcf7 .wpcf7-form .row h5,{{WRAPPER}} .wpcf7 .wpcf7-form .row h6',
            ]
        );

        $this->add_control(
            'form_heading_text_color',
            [
                'label' => esc_html__( 'Heading Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h6' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_heading_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .wpcf7 .wpcf7-form .row h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'contact_from_bottom_text',
            [
                'label' => esc_html__( 'Bottom Text', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'form_bottom_text_typography',
                'selectors' => '{{WRAPPER}} .insurance_bottom_text,{{WRAPPER}} .insurance_bottom_text a,{{WRAPPER}} .insurance_bottom_text a: hover',
            ]
        );

        $this->add_control(
            'form_bottom_text_text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insurance_bottom_text' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'form_bottom_text_text_link_color',
            [
                'label' => esc_html__( 'Text Link Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insurance_bottom_text a' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'form_bottom_text_text_link_hovercolor',
            [
                'label' => esc_html__( 'Text Link Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insurance_bottom_text a:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'form_bottom_text_link_type',
				'selector' => '{{WRAPPER}} .insurance_bottom_text a',
			]
		);

        $this->add_control(
			'insurance_text_align',
			[
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .insurance_bottom_text' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            'cf7_bottom_text_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .insurance_bottom_text'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .insurance_bottom_text a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();




        $this->start_controls_section(
            'contact_from_error_msg',
            [
                'label' => esc_html__( 'Validation Message', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'success_message_validate_color',
            [
                'label' => esc_html__( 'Error Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_validate_margin',
            [
                'label' => esc_html__( 'Error Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_validate_padding',
            [
                'label' => esc_html__( 'Error Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_validate_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-not-valid-tip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'errorb_ackground',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wpcf7-not-valid-tip',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
            'contact_from_success_msg',
            [
                'label' => esc_html__( 'Invalid Output', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'success_message_text_color',
            [
                'label' => esc_html__( 'Invalid Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cf7_response_margin',
            [
                'label' => esc_html__( 'Invalid Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_response_padding',
            [
                'label' => esc_html__( 'Invalid Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_response_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'error_success_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wpcf7 .wpcf7-form.invalid .wpcf7-response-output',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'invalid_field_border',
                'selector' => '{{WRAPPER}} .wpcf7 form .wpcf7-response-output',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'contact_cf7_from_success_msg',
            [
                'label' => esc_html__( 'Success Message', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cf7_from_success_responsetext_color',
            [
                'label' => esc_html__( 'Success Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cf7_from_response_margin',
            [
                'label' => esc_html__( 'Success Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_from_response_padding',
            [
                'label' => esc_html__( 'Success Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_from_response_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'cf7_from_success_sent_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output',
			]
		);
        $this->end_controls_section();
    }

    protected function render() {
        if ( ! class_exists('WPCF7') ) {
            return;
        }
        $settings = $this->get_settings_for_display();  
        $button_border_style = $settings['button_border_style'];
        $button_before_border = $settings['button_before_border_enable'];
        $btn_gradient_clr_switch = $settings['btn_gradient_clr_switch'];

        
        if( $button_border_style == 'yes' || $button_before_border == 'yes' ) {
            echo '<div class="contact-home4 ">';
        }

       if( 'yes' ===  $btn_gradient_clr_switch ){
        echo '<div class="btn-gradient-clr">';
        }
        
        if ( ! empty( $settings['selected_form_id'] ) ) {
            echo  do_shortcode( '[contact-form-7 id="'.$settings['selected_form_id'].'"]');
        }
        $field__border_mac      = $settings[ 'field__border_mac'] ?? '';
        $field__border_width    = $settings[ 'field__border_width'] ?? '';
        $field__border_color    = $settings[ 'field__border_color'] ?? '';
        if ( $field__border_mac && ! empty( $field__border_mac )) { ?>            
            <style type="text/css">
                body .wpcf7-form-control:not(.wpcf7-submit){
                    -webkit-border-before: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                    -webkit-border-after: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                    -webkit-border-start: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                    -webkit-border-end: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                }           
            </style>
            <?php
        }
        if( $button_border_style == 'yes' || $button_before_border == 'yes' ) {
            echo "</div>";
        }
        if( 'yes' ===  $btn_gradient_clr_switch ){
        echo '</div>';
        }
    }
}

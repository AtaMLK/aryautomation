<?php
/**
 * Pricing table widget class
 *
 */
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RS_Pricing_Switcher_Widget extends \Elementor\Widget_Base {

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
        return 'rs-pricing-switcher';
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
        return esc_html__( 'RS Pricing Switcher', 'rsaddon' );
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
        return [ 'pricing', 'table', 'price', 'package', 'product', 'plan' ];
    }
	protected function register_controls() {

        // Global Content Start
        $this->start_controls_section(
            '_section_price',
            [
                'label' => esc_html__( 'Pricing Table', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'pricing_style',
                [
                    'label' => esc_html__( 'Pricing Style', 'rsaddon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1' => esc_html__( 'Style 1', 'rsaddon' ),
                        '2' => esc_html__( 'Style 2', 'rsaddon' ),
                    ]
                ]
            );
            $this->add_control(
                'duration_swither_show_hide',
                [
                    'label' => esc_html__( 'Switcher Show/Hide', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'switcher_button_style',
                [
                    'label' => esc_html__( 'Switcher Button Style', 'rsaddon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1' => esc_html__( 'Style 1', 'rsaddon' ),
                        '2' => esc_html__( 'Style 2', 'rsaddon' ),
                    ],
                    'condition' => [
                        'duration_swither_show_hide' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'monthly_title',
                [
                    'label' => esc_html__( 'Monthly Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Monthly Plan',
                    'condition' => [
                        'duration_swither_show_hide' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'yearly_title',
                [
                    'label' => esc_html__( 'Yearly Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Yearly Plan',
                    'condition' => [
                        'duration_swither_show_hide' => 'yes',
                    ],
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'common_options',
                [
                    'label' => esc_html__( 'Common Content', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            $repeater->add_control(
                'plan_title',
                [
                    'label' => esc_html__( 'Title', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => false,
                    'default' => esc_html__( 'Basic Plan', 'rsaddon' ),
                ]
            );
            $repeater->add_control(
                'badge',
                [
                    'label' => esc_html__( 'Badge Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                ]
            );
            $repeater->add_control(
                'feature_title',
                [
                    'label' => esc_html__( 'Feature Title', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Features List',
                ]
            );
            $repeater->add_control(
                'button_text',
                [
                    'label' => esc_html__( 'Button Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Get Started', 'rsaddon' ),
                    'placeholder' => esc_html__( 'Type button text here', 'rsaddon' ),
                    'label_block' => false,
                ]
            );
            $repeater->add_control(
				'btn_icon',
				[
					'label' => __('Button Icon', 'rsaddon'),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-chevron-right',
						'library' => 'fa-solid',
					]
				]
			);

            // Monthly Content
            $repeater->add_control(
                'monthly_options',
                [
                    'label' => esc_html__( 'Monthly Pricing Here', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $repeater->add_control(
                'intro_monthly',
                [
                    'label' => esc_html__( 'Intro Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'price_monthly',
                [
                    'label' => esc_html__( 'Price', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '$29.00', 'rsaddon' ),
                ]
            );
            $repeater->add_control(
                'duration_text_monthly',
                [
                    'label' => esc_html__( 'Duration', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Monthly', 'rsaddon' ),
                ]
            );
            $repeater->add_control(
                'desc_monthly',
                [
                    'label' => esc_html__( 'Description', 'rsaddon' ),
                    'type' => Controls_Manager::TEXTAREA,
                ]
            );
            $repeater->add_control(
                'features_monthly',
                [
                    'label'   => esc_html__( 'Features (Use List Style)', 'rsaddon' ),
                    'type'    => Controls_Manager::WYSIWYG,
                    'rows'    => 10, 
                    'default' => esc_html__( '1 Users Access', 'rsaddon' ),          
                ]
            );
            $repeater->add_control(
                'button_link_monthly',
                [
                    'label' => esc_html__( 'Link', 'rsaddon' ),
                    'type' => Controls_Manager::URL,
                    'label_block' => true,
                    'placeholder' => esc_html__( 'https://example.com/', 'rsaddon' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );
            
            // Yearly Content
            $repeater->add_control(
                'yearly_options',
                [
                    'label' => esc_html__( 'Yearly Pricing Here', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $repeater->add_control(
                'intro_yearly',
                [
                    'label' => esc_html__( 'Intro Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'price_yearly',
                [
                    'label' => esc_html__( 'Price', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( '$49.00', 'rsaddon' ),
                ]
            );
            $repeater->add_control(
                'duration_text_yearly',
                [
                    'label' => esc_html__( 'Duration', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Yearly', 'rsaddon' ),
                ]
            );
            $repeater->add_control(
                'desc_yearly',
                [
                    'label' => esc_html__( 'Description', 'rsaddon' ),
                    'type' => Controls_Manager::TEXTAREA,
                ]
            );
            $repeater->add_control(
                'features_yearly',
                [
                    'label'   => esc_html__( 'Features (Use List Style)', 'rsaddon' ),
                    'type'    => Controls_Manager::WYSIWYG,
                    'rows'    => 10, 
                    'default' => esc_html__( '3 Users Access', 'rsaddon' ),          
                ]
            );
            $repeater->add_control(
                'button_link_yearly',
                [
                    'label' => esc_html__( 'Link', 'rsaddon' ),
                    'type' => Controls_Manager::URL,
                    'label_block' => true,
                    'placeholder' => esc_html__( 'https://example.com/', 'rsaddon' ),
                    'default' => [
                        'url' => '#',
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'item_active',
                [
                    'label' => esc_html__( 'Item Active?', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'price_list',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'plan_title' => esc_html__( 'Basic Plan', 'rsaddon' ),

                            'intro_monthly' => esc_html__( 'What you will get in this plan !!', 'rsaddon' ),
                            'price_monthly' => esc_html__( '$29.00', 'rsaddon' ),
                            'duration_text_monthly' => esc_html__( 'Monthly', 'rsaddon' ),
                            'desc_monthly' => esc_html__( 'This plan includes online consultation options for all users', 'rsaddon' ),
                            'features_monthly' => esc_html__( '1 User Access', 'rsaddon' ),

                            'intro_yearly' => esc_html__( 'What you will get in this plan !!', 'rsaddon' ),
                            'price_yearly' => esc_html__( '$49.00', 'rsaddon' ),
                            'duration_text_yearly' => esc_html__( 'Yearly', 'rsaddon' ),
                            'desc_yearly' => esc_html__( 'This plan includes online consultation options for all users', 'rsaddon' ),
                            'features_yearly' => esc_html__( '3 User Access', 'rsaddon' ),

                            'button_text' => esc_html__( 'Get Start Now', 'rsaddon' ),
                        ]
                    ],
                    'title_field' => '{{{ plan_title }}}',
                ]
            );

            $this->add_responsive_control(
                'col_gutter_width',
                [
                    'label' => esc_html__( 'Gutter Width', 'rsaddon' ),
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
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .row' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .rs-pricing-switcher .row > [class*="col-"]' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // Global Content End

        // Switcher Button Style Start
        $this->start_controls_section(
            '_section_style_switcher_button',
            [
                'label' => esc_html__( 'Switcher Button Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'duration_swither_show_hide' => 'yes'
                ]
            ]
        );
            $this->add_control(
                'switcher_wrapper_options',
                [
                    'label' => esc_html__( 'Wrapper Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING
                ]
            );
            $this->add_responsive_control(
                'switcher_wrapper_text_align',
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
                        '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => [
                        'switcher_button_style!' => '2'
                    ]
                ]
            );
            $this->add_responsive_control(
                'switcher_wrapper_text_align_border_style',
                [
                    'label' => esc_html__( 'Alignment', 'rsaddon' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        '0' => [
                            'title' => esc_html__( 'Left', 'rsaddon' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        '0 auto' => [
                            'title' => esc_html__( 'Center', 'rsaddon' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        '0 0 0 auto' => [
                            'title' => esc_html__( 'Right', 'rsaddon' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'margin: {{VALUE}};',
                    ],
                    'condition' => [
                        'switcher_button_style' => '2'
                    ]
                ]
            );
            $this->add_responsive_control(
				'switcher_wrapper_margin_bottom',
				[
					'label' => esc_html__( 'Margin Bottom', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
            $this->add_responsive_control(
				'switcher_wrapper_width',
				[
					'label' => esc_html__( 'Max Width', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'max-width: {{SIZE}}{{UNIT}} !important;',
					],
                    'condition' => [
                        'switcher_button_style' => '2'
                    ]
				]
			);
            $this->add_responsive_control(
                'switcher_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'switcher_button_style' => '2'
                    ]
                ]
            );
            $this->add_responsive_control(
                'switcher_wrapper_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'switcher_button_style' => '2'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'switcher_wrapper_border',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part',
                    'condition' => [
                        'switcher_button_style' => '2'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'switcher_wrapper_shadow',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part',
                    'condition' => [
                        'switcher_button_style' => '2'
                    ]
                ]
            );
            // Position Maker
            $this->add_control(
                'switcher_position_maker_options',
                [
                    'label' => esc_html__( 'Position Maker', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'switcher_position_popover_toggle',
                [
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label' => esc_html__( 'Position', 'rsaddon' ),
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'return_value' => 'yes',
                ]
            );
            
            $this->start_popover();
                $this->add_responsive_control(
                    'switcher_position',
                    [
                        'label' => esc_html__( 'Position', 'rsaddon' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'rsaddon' ),
                            'unset' => esc_html__( 'Unset', 'rsaddon' ),
                            'relative' => esc_html__( 'Relative', 'rsaddon' ),
                            'absolute'  => esc_html__( 'Absolute', 'rsaddon' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'switcher_p_top',
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
                            'switcher_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'switcher_p_right',
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
                            'switcher_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'switcher_p_bottom',
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
                            'switcher_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'switcher_p_left',
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
                            'switcher_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .switcher-part' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();

            $this->add_control(
                'switcher_button_options',
                [
                    'label' => esc_html__( 'Button Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
				'switcher_button_gap',
				[
					'label' => esc_html__( 'Gap Between', 'rsaddon' ),
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
                    'condition' => [
                        'switcher_button_style' => '1'
                    ],
					'selectors' => [
						'{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);
            $this->add_responsive_control(
				'switcher_button_opacity_inactive',
				[
					'label' => esc_html__('Opacity ( Inactive )', 'rsaddon'),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1,
							'step' => 0.1,
						],
					],
                    'condition' => [
                        'switcher_button_style!' => '2'
                    ],
					'selectors' => [
						'{{WRAPPER}} .rs-pricing-switcher:not(.switched) .switcher-part .pricing-switcher-wrapper span.btn-yearly,
                        {{WRAPPER}} .rs-pricing-switcher.switched .switcher-part .pricing-switcher-wrapper span.btn-monthly' => 'opacity: {{SIZE}}',
					]
				]
			);
            $this->add_control(
                'switcher_button_color',
                [
                    'label' => esc_html__( 'Button Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span:not(.switcher)' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'switcher_button_style!' => '2'
                    ],
                ]
            );

            $this->start_controls_tabs( 
                'switcher_button_normal_active_style_tabs',
                [
                    'condition' => [
                        'switcher_button_style' => '2'
                    ],
                ]
            );
                $this->start_controls_tab(
                    'switcher_button_normal_style_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'switcher_button_color_month_normal',
                        [
                            'label' => esc_html__( 'Month Button Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.btn-monthly' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'switcher_button_color_year_normal',
                        [
                            'label' => esc_html__( 'Year Button Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.btn-yearly' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'switcher_button_active_style_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'switcher_button_color_month_active',
                        [
                            'label' => esc_html__( 'Month Button Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher.switched .switcher-part .pricing-switcher-wrapper span.btn-monthly' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'switcher_button_color_year_active',
                        [
                            'label' => esc_html__( 'Year Button Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher.switched .switcher-part .pricing-switcher-wrapper span.btn-yearly' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_control(
                'switcher_slide_options',
                [
                    'label' => esc_html__( 'Swither Slide Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'switcher_slide_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'switcher_slide_border',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'switcher_slide_shadow',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher',
                ]
            );
            $this->add_responsive_control(
                'switcher_slide_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            // inner circle style 1
            $this->add_control(
                'switcher_slide_inner_circle_options',
                [
                    'label' => esc_html__( 'Inner Circle Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'condition' => [
                        'switcher_button_style' => '1'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'switcher_slide_inner_circle_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher:after',
                    'condition' => [
                        'switcher_button_style' => '1'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'switcher_slide_inner_circle_border',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher:after',
                    'condition' => [
                        'switcher_button_style' => '1'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'switcher_slide_inner_circle_shadow',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher:after',
                    'condition' => [
                        'switcher_button_style' => '1'
                    ]
                ]
            );
            $this->add_responsive_control(
                'switcher_slide_inner_circle_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'condition' => [
                        'switcher_button_style' => '1'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .switcher-part .pricing-switcher-wrapper span.switcher:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // Switcher Button Style End
        
        // General Style Start
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'General Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'g_text_align',
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_display',
                [
                    'label' => esc_html__( 'Display (Inline / Block)', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-item-inner' => 'display: {{VALUE}};',
                    ],
                    'condition' => [
                        'pricing_style' => '2',
                    ]
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
                        'g_display' => 'flex',
                        'pricing_style' => '2',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-item-inner' => 'align-items: {{VALUE}};',
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
                        'g_display' => 'flex',
                        'pricing_style' => '2',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-item-inner' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_column_direction',
                [
                    'label' => esc_html__( 'Direction', 'rsaddon' ),
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
                        'g_display' => 'flex',
                        'pricing_style' => '2',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-item-inner' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_flex_gap',
                [
                    'label' => esc_html__('Gap Between', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'custom'],
                    'show_label' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-item-inner' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'g_display' => 'flex',
                        'pricing_style' => '2',
                    ]
                ]
            );
            $this->add_responsive_control(
                'content_part_width_style2',
                [
                    'label' => esc_html__('Content Part Width', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'custom'],
                    'show_label' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .content-side' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'pricing_style' => '2',
                    ]
                ]
            );
            $this->add_responsive_control(
                'g_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Normal Card Tab
            $this->add_control(
                'g_normal_card_options',
                [
                    'label' => esc_html__( 'Normal Grid Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs( 'g_normal_hover_style_tabs' );
                $this->start_controls_tab(
                    'g_normal_style_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_background',
                            'types' => [ 'classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'g_border',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'g_hover_style_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_background_hover',
                            'types' => [ 'classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'g_border_hover',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            // Active Card Tab
            $this->add_control(
                'g_active_card_options',
                [
                    'label' => esc_html__( 'Active Grid Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs( 'g_active_normal_hover_style_tabs' );
                $this->start_controls_tab(
                    'g_active_normal_style_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_active_background',
                            'types' => [ 'classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'g_active_border',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_active_box_shadow',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'g_active_hover_style_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_active_background_hover',
                            'types' => [ 'classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'g_active_border_hover',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_active_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        // General Style End

        // Badge Style Start
        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => esc_html__( 'Badge Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'badge_text_align',
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'badge_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge',
                ]
            );
            $this->add_control(
                'badge_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'badge_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge',
                ]
            );
            $this->add_responsive_control(
                'badge_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'badge_padding',
                [
                    'label' => esc_html__('Padding', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'badge_margin',
                [
                    'label' => esc_html__('Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'badge_radius',
                [
                    'label' => esc_html__('Border Radius', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'badge_border',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'badge_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge',
                ]
            );

            // Position Maker
            $this->add_control(
                'badge_position_maker_options',
                [
                    'label' => esc_html__( 'Position Maker', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'badge_position_popover_toggle',
                [
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label' => esc_html__( 'Position', 'rsaddon' ),
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'return_value' => 'yes',
                ]
            );
            
            $this->start_popover();
                $this->add_responsive_control(
                    'badge_position',
                    [
                        'label' => esc_html__( 'Position', 'rsaddon' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'rsaddon' ),
                            'unset' => esc_html__( 'Unset', 'rsaddon' ),
                            'relative' => esc_html__( 'Relative', 'rsaddon' ),
                            'absolute'  => esc_html__( 'Absolute', 'rsaddon' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'badge_p_top',
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
                            'badge_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'badge_p_right',
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
                            'badge_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'badge_p_bottom',
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
                            'badge_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'badge_p_left',
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
                            'badge_position' => ['relative', 'absolute']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricebadge' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();
        $this->end_controls_section();
        // Badge Style end

        // Title Wrapper Style Start
        $this->start_controls_section(
            '_section_style_title_wrapper',
            [
                'label' => esc_html__( 'Title Wrapper Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            // Wrapper Options
            $this->add_control(
                'title_wrapper_options',
                [
                    'label' => esc_html__( 'Wrapper Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING
                ]
            );
            $this->add_responsive_control(
                'title_wrapper_text_align',
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_wrapper_padding',
                [
                    'label' => esc_html__('Padding', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_wrapper_margin',
                [
                    'label' => esc_html__('Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'title_wrapper_normal_active_tabs' );
                $this->start_controls_tab(
                    'title_wrapper_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'title_wrapper_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'title_wrapper_border',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'title_wrapper_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'title_wrapper_active_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}}  .rs-pricing-switcher .pricing-item.item-active .title-wrapper',
                        ]
                    );
                    $this->add_control(
                        'title_wrapper_active_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .title-wrapper' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            // Title Options
            $this->add_control(
                'title_options',
                [
                    'label' => esc_html__( 'Title Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Title Typography', 'rsaddon' ),
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper .title',
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Title Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper .title' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'title_active_color',
                [
                    'label' => esc_html__( 'Title Active Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .title-wrapper .title' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            // Intro Options
            $this->add_control(
                'intro_options',
                [
                    'label' => esc_html__( 'Intro Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Intro Typography', 'rsaddon' ),
                    'name' => 'intro_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper .intro-txt',
                ]
            );
            $this->add_control(
                'intro_color',
                [
                    'label' => esc_html__( 'Intro Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper .intro-txt' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'intro_active_color',
                [
                    'label' => esc_html__( 'Intro Active Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .title-wrapper .intro-txt' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'intro_margin',
                [
                    'label' => esc_html__( 'Intro Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .title-wrapper .intro-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // Title Wrapper Style end
        
        // Price Wrapper Style Start
        $this->start_controls_section(
            '_section_price_wrapper',
            [
                'label' => esc_html__( 'Price Wrapper Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            // Wrapper Options
            $this->add_control(
                'price_wrapper_options',
                [
                    'label' => esc_html__( 'Wrapper Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING
                ]
            );
            $this->add_responsive_control(
                'price_wrapper_flex_vertical_align',
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'price_wrapper_flex_h_align',
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'price_wrapper_flex_column_align',
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'price_wrapper_flex_gap',
                [
                    'label' => esc_html__('Gap Between', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px'],
                    'show_label' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'price_wrapper_padding',
                [
                    'label' => esc_html__('Padding', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_wrapper_margin',
                [
                    'label' => esc_html__('Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'price_wrapper_normal_active_tabs' );
                $this->start_controls_tab(
                    'price_wrapper_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'price_wrapper_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'price_wrapper_border',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'price_wrapper_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'price_wrapper_active_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}}  .rs-pricing-switcher .pricing-item.item-active .price-wrapper',
                        ]
                    );
                    $this->add_control(
                        'price_wrapper_active_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .price-wrapper' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            // Price Options
            $this->add_control(
                'price_options',
                [
                    'label' => esc_html__( 'Price Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Price Typography', 'rsaddon' ),
                    'name' => 'price_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper .price',
                ]
            );
            $this->add_control(
                'price_color',
                [
                    'label' => esc_html__( 'Price Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper .price' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'price_active_color',
                [
                    'label' => esc_html__( 'Price Active Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .price-wrapper .price' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'price_margin',
                [
                    'label' => esc_html__( 'Price Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Duration Options
            $this->add_control(
                'duration_options',
                [
                    'label' => esc_html__( 'Duration Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Duration Typography', 'rsaddon' ),
                    'name' => 'duration_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper .plan-duration',
                ]
            );
            $this->add_control(
                'duration_color',
                [
                    'label' => esc_html__( 'Duration Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper .plan-duration' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'duration_active_color',
                [
                    'label' => esc_html__( 'Duration Active Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .price-wrapper .plan-duration' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'duration_margin',
                [
                    'label' => esc_html__( 'Duration Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .price-wrapper .plan-duration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            // Description Options
            $this->add_control(
                'description_options',
                [
                    'label' => esc_html__( 'Description Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Description Typography', 'rsaddon' ),
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .description',
                ]
            );
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Description Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .description' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'description_active_color',
                [
                    'label' => esc_html__( 'Description Active Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .description' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'description_padding',
                [
                    'label' => esc_html__( 'Description Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .description' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Description Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // Price Wrapper Style end
        
        // Feature Wrapper Style Start
        $this->start_controls_section(
            '_section_feature_wrapper',
            [
                'label' => esc_html__( 'Feature Wrapper Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            // Wrapper Options
            $this->add_control(
                'feature_wrapper_options',
                [
                    'label' => esc_html__( 'Wrapper Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_text_align',
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_display',
                [
                    'label' => esc_html__( 'Display (Inline / Block)', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul' => 'display: {{VALUE}};',
                    ],
                    'condition' => [
                        'pricing_style' => '2',
                    ]
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_vertical_align',
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
                        'feature_wrapper_display' => 'flex',
                        'pricing_style' => '2',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_h_align',
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
                        'feature_wrapper_display' => 'flex',
                        'pricing_style' => '2',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_column_direction',
                [
                    'label' => esc_html__( 'Direction', 'rsaddon' ),
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
                        'feature_wrapper_display' => 'flex',
                        'pricing_style' => '2',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_padding',
                [
                    'label' => esc_html__('Padding', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_margin',
                [
                    'label' => esc_html__('Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_wrapper_max_width',
                [
                    'label' => esc_html__( 'Max Width', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'feature_wrapper_normal_active_tabs' );
                $this->start_controls_tab(
                    'feature_wrapper_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'feature_wrapper_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'feature_wrapper_border',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'feature_wrapper_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'feature_wrapper_active_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}}  .rs-pricing-switcher .pricing-item.item-active .pricing-feature',
                        ]
                    );
                    $this->add_control(
                        'feature_wrapper_active_border_color',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-feature' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            // Feature List Options
            $this->add_control(
                'feature_list_options',
                [
                    'label' => esc_html__( 'Feature List Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'name' => 'feature_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li',
                ]
            );
            $this->add_responsive_control(
                'feature_list_margin',
                [
                    'label' => esc_html__( 'List Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_list_padding',
                [
                    'label' => esc_html__( 'List Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_list_width',
                [
                    'label' => esc_html__( 'List Width', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs( 'feature_list_normal_active_tabs' );
                $this->start_controls_tab(
                    'feature_list_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'feature_list_color',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'feature_list_close_color',
                        [
                            'label' => esc_html__( 'Close Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li.close' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'feature_list_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'feature_list_active_color',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-feature ul li' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'feature_list_active_close_color',
                        [
                            'label' => esc_html__( 'Close Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-feature ul li.close' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
            // Feature Icon Options
            $this->add_control(
                'feature_list_icon_options',
                [
                    'label' => esc_html__( 'Feature Icon Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
				'feature_icon_position',
				[
					'label' => esc_html__( 'Icon & Text Direction', 'rsaddon' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'0' => [
							'title' => esc_html__( 'Icon Left', 'rsaddon' ),
							'icon' => 'eicon-wrap',
						],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li:before' => 'left: {{VALUE}}; right: unset;',
					],
				]
			);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'name' => 'feature_icon_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li:before',
                ]
            );
            $this->start_controls_tabs( 'feature_list_icon_normal_active_tabs' );
                $this->start_controls_tab(
                    'feature_list_icon_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'feature_list_icon_color',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li:before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'feature_list_icon_close_color',
                        [
                            'label' => esc_html__( 'Close Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature ul li.close:before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'feature_list_icon_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'feature_list_icon_active_color',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-feature ul li:before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'feature_list_icon_active_close_color',
                        [
                            'label' => esc_html__( 'Close Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-feature ul li.close:before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
            // Feature Title Options
            $this->add_control(
                'feature_title_options',
                [
                    'label' => esc_html__( 'Feature Title Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'feature_title_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature .feature-title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'feature_title_text_color_active',
                [
                    'label' => esc_html__( 'Text Color ( Active )', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-feature .feature-title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'name' => 'feature_title_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature .feature-title',
                ]
            );
            $this->add_responsive_control(
                'feature_title_margin',
                [
                    'label' => esc_html__( 'Margin', 'textdomain' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ], 
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature .feature-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'feature_title_position_top',
                [
                    'label' => esc_html__( 'Top Position', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-feature .feature-title' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // Feature Wrapper Style end

        // Button Style Start
        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__( 'Button Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'button_wrapper_text_align',
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'button_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'button_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'button_options',
                [
                    'label' => esc_html__( 'Button Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a',
                ]
            );
            $this->add_control(
                'button_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'button_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'button_icon_options',
                [
                    'label' => esc_html__( 'Button Icon Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
				'button_inner_direction',
				[
					'label' => esc_html__( 'Icon & Text Direction', 'rsaddon' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'row' => [
							'title' => esc_html__( 'Icon Right', 'rsaddon' ),
							'icon' => 'eicon-nowrap',
						],
						'row-reverse' => [
							'title' => esc_html__( 'Icon Left', 'rsaddon' ),
							'icon' => 'eicon-wrap',
						],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a' => 'flex-direction: {{VALUE}};',
					],
				]
			);
            $this->add_responsive_control(
                'button_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'button_icon_gap_between',
                [
                    'label' => esc_html__( 'Gap Between', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            // Normal Card Tab
            $this->add_control(
                'button_normal_card_options',
                [
                    'label' => esc_html__( 'Normal Grid Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs( 'style_button_normal_hover_tabs' );
                $this->start_controls_tab(
                    'style_button_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'button_text_color',
                        [
                            'label' => esc_html__( 'Text Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'button_icon_color',
                        [
                            'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a svg path' => 'fill: {{VALUE}}',
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a i' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'style_button_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'button_text_color_hover',
                        [
                            'label' => esc_html__( 'Text Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'button_icon_hover_color',
                        [
                            'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a:hover svg path' => 'fill: {{VALUE}}',
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a:hover i' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a:hover',
                        ]
                    );
                    $this->add_control(
                        'button_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item .pricing-btn a:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            // Active Card Tab
            $this->add_control(
                'button_active_card_options',
                [
                    'label' => esc_html__( 'Active Grid Options', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->start_controls_tabs( 'style_button_active_normal_hover_tabs' );
                $this->start_controls_tab(
                    'style_button_active_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'button_active_text_color',
                        [
                            'label' => esc_html__( 'Text Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'button_active_icon_color',
                        [
                            'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a svg path' => 'fill: {{VALUE}}',
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a i' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_active_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_active_border',
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'style_button_active_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'button_active_text_color_hover',
                        [
                            'label' => esc_html__( 'Text Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'button_active_icon_color_hover',
                        [
                            'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a:hover svg path' => 'fill: {{VALUE}}',
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a:hover i' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'button_active_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a:hover',
                        ]
                    );
                    $this->add_control(
                        'button_active_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-pricing-switcher .pricing-item.item-active .pricing-btn a:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        // Button Style end
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $unique = rand(2012, 3554120);
    ?>
    <div class="<?php echo $unique ?> rs-pricing-switcher style-<?php echo esc_attr( $settings['pricing_style'] )?> switcher-button-style<?php echo esc_attr( $settings['switcher_button_style'] )?>">
        <?php if('yes' == $settings['duration_swither_show_hide']){ ?>
            <div class="switcher-part">
                <div class="<?php echo $unique ?> pricing-switcher-wrapper">
                    <span class="btn-monthly"><?php echo esc_html( $settings['monthly_title'] )?></span>
                    <span class="switcher"></span>
                    <span class="btn-yearly"><?php echo esc_html( $settings['yearly_title'] )?></span>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <?php foreach ( $settings['price_list'] as $index => $item ) { ?>
                <?php
                    // Common
                    $plan_title = !empty($item['plan_title']) ? $item['plan_title'] : '';
                    $badge = !empty($item['badge']) ? $item['badge'] : '';
                    $button_text = !empty($item['button_text']) ? $item['button_text'] : '';
                    $item_active = !empty($item['item_active']) ? $item['item_active'] : ''; 
                    $itemactive_class = '';
                    if($item_active == 'yes') {
                        $itemactive_class = 'item-active';
                    }

                    // Monthly
                    $intro_monthly = !empty($item['intro_monthly']) ? $item['intro_monthly'] : '';
                    $price_monthly = !empty($item['price_monthly']) ? $item['price_monthly'] : '';
                    $duration_monthly = !empty($item['duration_text_monthly']) ? $item['duration_text_monthly'] : '';                            
                    $desc_monthly = !empty($item['desc_monthly']) ? $item['desc_monthly'] : '';
                    $features_monthly = !empty($item['features_monthly']) ? $item['features_monthly'] : '';
                    $button_link_monthly = !empty($item['button_link_monthly']['url']) ? $item['button_link_monthly']['url'] : '';
                    $btn_link_external_monthly = '';
                    if (!empty($item['button_link_monthly']['is_external'])) {
                        $btn_link_external_monthly = 'target="_blank"';
                    }
                    
                    // Yearly
                    $intro_yearly = !empty($item['intro_yearly']) ? $item['intro_yearly'] : '';
                    $price_yearly = !empty($item['price_yearly']) ? $item['price_yearly'] : '';
                    $duration_yearly = !empty($item['duration_text_yearly']) ? $item['duration_text_yearly'] : '';                            
                    $desc_yearly = !empty($item['desc_yearly']) ? $item['desc_yearly'] : '';
                    $features_yearly = !empty($item['features_yearly']) ? $item['features_yearly'] : '';
                    $button_link_yearly = !empty($item['button_link_yearly']['url']) ? $item['button_link_yearly']['url'] : '';
                    $btn_link_external_yearly = '';
                    if (!empty($item['button_link_yearly']['is_external'])) {
                        $btn_link_external_yearly = 'target="_blank"';
                    }
                ?>
                    <?php
                        if ('1' == $settings['pricing_style']) {
                            include plugin_dir_path(__FILE__) . "/style1.php";
                        } else {
                            include plugin_dir_path(__FILE__) . "/style2.php";
                        }
                    ?>
            <?php } ?>
        </div>
    </div>
    <script>
        jQuery(function($) {
            $('.pricing-switcher-wrapper.<?php echo $unique ?> span').click(function() {
                $('.rs-pricing-switcher.<?php echo $unique ?>').toggleClass('switched');

                $('.rs-pricing-switcher.<?php echo $unique ?>').addClass('switching');
                setTimeout(() => {
                    $('.rs-pricing-switcher.<?php echo $unique ?>').removeClass('switching');
                }, 50);
            });
        });
    </script>
        
    <?php }  
}

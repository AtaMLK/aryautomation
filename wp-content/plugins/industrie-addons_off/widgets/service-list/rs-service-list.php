<?php
/**
 *
 * @since 1.0.0
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_RSservices_List_Widget extends \Elementor\Widget_Base
{

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
	public function get_name()
	{
		return 'rs-service-list';
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
	public function get_title()
	{
		return esc_html__('RS Services List', 'rsaddon');
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
	public function get_icon()
	{
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
	public function get_categories()
	{
		return ['rsaddon_category'];
	}
	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		// Service Global Card Start
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__('Services Global', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'show_btn',
				[
					'label'        => esc_html__('Show Button', 'rsaddon'),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__('Show', 'rsaddon'),
					'label_off'    => esc_html__('Hide', 'rsaddon'),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);
			$this->add_control(
				'btn_icon',
				[
					'label' => __('Button Icon', 'rsaddon'),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-chevron-right',
						'library' => 'fa-solid',
					],
					'condition' => [
						'show_btn' => 'yes'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
					'separator' => 'before',
					'exclude' => [
						'custom'
					]
				]
			);

			$repeater = new Repeater();
				$repeater->add_control(
					'link',
					[
						'label'       => esc_html__('Link', 'rsaddon'),
						'type'        => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'url' => '#',
						]
					]
				);
				$repeater->add_control(
					'feature_img',
					[
						'label' => esc_html__('Feature Image', 'rsaddon'),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					]
				);
				$repeater->add_control(
					'service_icon',
					[
						'label' => __('Icon', 'rsaddon'),
						'type' => Controls_Manager::ICONS,
						'default' => [
							'value' => 'far fa-smile',
							'library' => 'fa-ragular',
						],
					]
				);
				$repeater->add_control(
					'title',
					[
						'label'       => esc_html__('Title', 'rsaddon'),
						'type'        => Controls_Manager::TEXT,
						'label_block' => true,
						'default'     => 'Services Title',
						'placeholder' => esc_html__('Services Title', 'rsaddon'),
						'separator'   => 'before',
					]
				);
				$repeater->add_control(
					'description',
					[
						'label' => esc_html__('Description', 'rsaddon'),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' => esc_html__('Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. Dummy text generator.', 'rsaddon'),
						'separator' => 'before',
					]
				);
			$this->add_control(
                'services_list',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'show_label' => false,
                    'default' => [
                        [
                            'title' => esc_html__( 'Service One', 'rsaddon' ),
                        ],
                        [
                            'title' => esc_html__( 'Service Two', 'rsaddon' ),
                        ]
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );
		$this->end_controls_section();
		// Service Global End

		// Service Global Style Start
        $this->start_controls_section(
			'_section_global_style',
			[
				'label' => esc_html__('General Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'g_v_align',
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
						'{{WRAPPER}} .rs-service-list .services-inner' => 'align-items: {{VALUE}};',
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
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-service-list .services-inner' => 'flex-direction: {{VALUE}};',
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
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-service-list .services-inner' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
                'g_gap_between',
                [
                    'label' => esc_html__( 'Space Between', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-service-list .services-inner' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			$this->add_responsive_control(
                'g_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-list .services-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .rs-service-list .services-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .rs-service-list .services-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'g_min_height',
                [
                    'label' => esc_html__( 'Min Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-list .services-inner' => 'min-height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

			// Global Hover Normal Tab Start
			$this->start_controls_tabs( 'g_hover_normal_tabs' );
                $this->start_controls_tab(
                    'g_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'g_background',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' => 'g_border',
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner',
						]
					);
					$this->add_control(
                        'g_border_color_last_child',
                        [
                            'label' => esc_html__( 'Border Color ( Last Child )', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-service-list .services-inner:last-child' => 'border-color: {{VALUE}} !important;',
                            ],
                        ]
                    );
					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'g_box_shadow',
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner',
						]
					);
				$this->end_controls_tab();
        
                $this->start_controls_tab(
                    'g_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-service-list .services-inner:hover',
                        ]
                    );
                    $this->add_control(
                        'g_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-service-list .services-inner:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .rs-service-list .services-inner:hover',
                        ]
                    );
                $this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		// Service Global Style End

		// Feature Image Style Start
        $this->start_controls_section(
			'_section_image_style',
			[
				'label' => esc_html__('Feature Image Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'image_width',
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
						'{{WRAPPER}} .rs-service-list .services-inner .feature_img img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
					],
				]
			);
			$this->add_responsive_control(
				'image_height',
				[
					'label' => esc_html__( 'Height', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .feature_img img' => 'height: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_control(
                'img_wrapper_control',
                [
                    'label' => esc_html__( 'Wrapper Control', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
			$this->add_responsive_control(
				'img_wrapper_opacity_hover',
				[
					'label' => esc_html__('Opacity ( Hover )', 'rsaddon'),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .rs-service-list .services-inner:hover .feature_img' => 'opacity: {{SIZE}}',
					]
				]
			);
			$this->add_responsive_control(
				'img_wrapper_position_right',
				[
					'label' => esc_html__( 'Right Position', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .feature_img' => 'right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'img_wrapper_position_bottom',
				[
					'label' => esc_html__( 'Bottom Position', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .feature_img' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
                'img_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-list .services-inner .feature_img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
			$this->add_responsive_control(
                'img_wrapper_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-list .services-inner .feature_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
			$this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'img_wrapper_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-service-list .services-inner .feature_img img',
                ]
            );
			$this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'img_wrapper_border',
                    'selector' => '{{WRAPPER}} .rs-service-list .services-inner .feature_img img',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'img_wrapper_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-service-list .services-inner .feature_img img',
                ]
            );
		$this->end_controls_section();
		// Feature Image Style End

		// Title & Icon Wrapper Style Start
        $this->start_controls_section(
			'_section_title_icon_wrapper_style',
			[
				'label' => esc_html__('Title & Icon Wrapper Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'icon_title_weapper_options_heading',
				[
					'label' => esc_html__( 'Wrapper Options', 'rsaddon' ),
					'type' => Controls_Manager::HEADING,
				]
			);
			$this->add_responsive_control(
				'title_icon_wrapper_width',
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
						'{{WRAPPER}} .rs-service-list .services-inner .top-wrapper' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'title_icon_wrapper_v_align',
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
						'{{WRAPPER}} .rs-service-list .services-inner .top-wrapper' => 'align-items: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'title_icon_wrapper_column_align',
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
						'{{WRAPPER}} .rs-service-list .services-inner .top-wrapper' => 'flex-direction: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'title_icon_wrapper_h_align',
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
						'{{WRAPPER}} .rs-service-list .services-inner .top-wrapper' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
                'title_icon_wrapper_gap_between',
                [
                    'label' => esc_html__( 'Space Between', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-service-list .services-inner .top-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

			// Title
			$this->add_control(
				'title_options_heading',
				[
					'label' => esc_html__( 'Title Options', 'rsaddon' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .rs-service-list .services-inner .title',
				]
			);
			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Title Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs-service-list .services-inner .title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'title_color_hover',
				[
					'label' => esc_html__( 'Title Color ( Hover )', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs-service-list .services-inner:hover .title' => 'color: {{VALUE}}',
					],
				]
			);

			// Icon
			$this->add_control(
				'icon_options_heading',
				[
					'label' => esc_html__( 'Icon Options', 'rsaddon' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'icon_font_size',
				[
					'label' => esc_html__( 'Font Size', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .icon-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .rs-service-list .services-inner .icon-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'icon_wrapper_width',
				[
					'label' => esc_html__( 'Wrapper Width', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .icon-wrap' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'icon_wrapper_height',
				[
					'label' => esc_html__( 'Wrapper Height', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .icon-wrap' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
                'icon_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-list .services-inner .icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );
			$this->add_responsive_control(
                'icon_wrapper_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-list .services-inner .icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'icon_wrapper_box_shadow',
					'selector' => '{{WRAPPER}} .rs-service-list .services-inner .icon-wrap',
				]
			);
			// Icon Hover Normal Tab
			$this->start_controls_tabs( 'icon_hover_normal_tabs' );
                $this->start_controls_tab(
                    'icon_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
					$this->add_control(
						'icon_color',
						[
							'label' => esc_html__( 'Icon Color', 'rsaddon' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rs-service-list .services-inner .icon-wrap svg path' => 'fill: {{VALUE}}',
								'{{WRAPPER}} .rs-service-list .services-inner .icon-wrap i' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'icon_wrapper_background',
							'types' => [ 'classic', 'gradient'],
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner .icon-wrap',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' => 'icon_wrapper_border',
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner .icon-wrap',
						]
					);
				$this->end_controls_tab();
				// Hover
                $this->start_controls_tab(
                    'icon_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
					$this->add_control(
						'icon_color_hover',
						[
							'label' => esc_html__( 'Icon Color', 'rsaddon' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rs-service-list .services-inner:hover .icon-wrap svg path' => 'fill: {{VALUE}}',
								'{{WRAPPER}} .rs-service-list .services-inner:hover .icon-wrap i' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'icon_wrapper_background_hover',
							'types' => [ 'classic', 'gradient'],
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner:hover .icon-wrap',
						]
					);
					$this->add_control(
						'icon_wrapper_border_color_hover',
						[
							'label' => esc_html__( 'Border Color', 'rsaddon' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rs-service-list .services-inner:hover .icon-wrap' => 'border-color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		// Title & Icon Wrapper Style End

		// Decription & Button Wrapper Style Start
        $this->start_controls_section(
			'_section_desc_btn_wrapper_style',
			[
				'label' => esc_html__('Desc & Button Wrapper Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'desc_btn_weapper_options_heading',
				[
					'label' => esc_html__( 'Wrapper Options', 'rsaddon' ),
					'type' => Controls_Manager::HEADING,
				]
			);
			$this->add_responsive_control(
				'desc_btn_wrapper_width',
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
						'{{WRAPPER}} .rs-service-list .services-inner .bottom-wrapper' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'desc_btn_wrapper_v_align',
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
						'{{WRAPPER}} .rs-service-list .services-inner .bottom-wrapper' => 'align-items: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'desc_btn_wrapper_column_align',
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
						'{{WRAPPER}} .rs-service-list .services-inner .bottom-wrapper' => 'flex-direction: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'desc_btn_wrapper_h_align',
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
						'{{WRAPPER}} .rs-service-list .services-inner .bottom-wrapper' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
                'desc_btn_wrapper_gap_between',
                [
                    'label' => esc_html__( 'Space Between', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-service-list .services-inner .bottom-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

			// Description
			$this->add_control(
				'desc_options_heading',
				[
					'label' => esc_html__( 'Description Options', 'rsaddon' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .rs-service-list .services-inner .desc-text',
				]
			);
			$this->add_control(
				'desc_color',
				[
					'label' => esc_html__( 'Description Color', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs-service-list .services-inner .desc-text' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'desc_color_hover',
				[
					'label' => esc_html__( 'Description Color ( Hover )', 'rsaddon' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs-service-list .services-inner:hover .desc-text' => 'color: {{VALUE}}',
					],
				]
			);

			// Button
			$this->add_control(
				'btn_options_heading',
				[
					'label' => esc_html__( 'Button Options', 'rsaddon' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'btn_icon_font_size',
				[
					'label' => esc_html__( 'Font Size', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .btn-part svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .rs-service-list .services-inner .btn-part i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'btn_wrapper_width',
				[
					'label' => esc_html__( 'Wrapper Width', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .btn-part' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'btn_wrapper_height',
				[
					'label' => esc_html__( 'Wrapper Height', 'rsaddon' ),
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
						'{{WRAPPER}} .rs-service-list .services-inner .btn-part' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
                'btn_wrapper_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-list .services-inner .btn-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'btn_wrapper_box_shadow',
					'selector' => '{{WRAPPER}} .rs-service-list .services-inner .btn-part',
				]
			);
			// Icon Hover Normal Tab
			$this->start_controls_tabs( 'btn_hover_normal_tabs' );
                $this->start_controls_tab(
                    'btn_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
					$this->add_control(
						'btn_icon_color',
						[
							'label' => esc_html__( 'Icon Color', 'rsaddon' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rs-service-list .services-inner .btn-part svg path' => 'fill: {{VALUE}}',
								'{{WRAPPER}} .rs-service-list .services-inner .btn-part i' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'btn_wrapper_background',
							'types' => [ 'classic', 'gradient'],
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner .btn-part',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' => 'btn_wrapper_border',
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner .btn-part',
						]
					);
				$this->end_controls_tab();
				// Hover
                $this->start_controls_tab(
                    'btn_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
					$this->add_control(
						'btn_icon_color_hover',
						[
							'label' => esc_html__( 'Icon Color', 'rsaddon' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rs-service-list .services-inner:hover .btn-part svg path' => 'fill: {{VALUE}}',
								'{{WRAPPER}} .rs-service-list .services-inner:hover .btn-part i' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'btn_wrapper_background_hover',
							'types' => [ 'classic', 'gradient'],
							'selector' => '{{WRAPPER}} .rs-service-list .services-inner:hover .btn-part',
						]
					);
					$this->add_control(
						'btn_wrapper_border_color_hover',
						[
							'label' => esc_html__( 'Border Color', 'rsaddon' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rs-service-list .services-inner:hover .btn-part' => 'border-color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tab();
		$this->end_controls_section();
		// Decription & Button Wrapper Style End
	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
	?>

		<div class="rs-service-list">
			<?php foreach ($settings['services_list'] as $index => $item) :
				$link = !empty($item['link']['url']) ? $item['link']['url'] : '#';
				$target = $item['link']['is_external'] ? 'target=_blank' : '';

				$image = wp_get_attachment_image_url( $item['feature_img']['id'], $settings['thumbnail_size']);
				$alt_text = get_post_meta($item['feature_img']['id'], '_wp_attachment_image_alt', true);
				$alt_text = ($alt_text) ? $alt_text : $item['title'];
				if ( ! $image ) {
					$image = Utils::get_placeholder_image_src();
				}
			?>
				<a class="services-inner" href="<?php echo esc_url($item['link']['url']); ?>" <?php echo esc_attr($target); ?>>
					<div class="feature_img prallax-img">
						<img data-depth="2" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr($alt_text); ?>">
					</div>
					<div class="top-wrapper">
						<?php if (!empty($item['service_icon'])) : ?>
							<div class="icon-wrap">
								<?php Icons_Manager::render_icon($item['service_icon'], ['aria-hidden' => 'true']) ?>
							</div>
						<?php endif; ?>
						<?php if (!empty($item['title'])) { ?>
							<h4 class="title">
								<?php echo wp_kses_post($item['title']); ?>
							</h4>
						<?php } ?>
					</div>
					<div class="bottom-wrapper">
						<?php if (!empty($item['description'])) : ?>
							<div class="desc-text">
								<?php echo wp_kses_post($item['description']); ?>
							</div>
						<?php endif; ?>
						<?php if ('yes' == $settings['show_btn']) { ?>
							<div class="btn-part">
								<?php
									if (!empty($settings['btn_icon'])) {
										Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']);
									}
								?>
							</div>
						<?php } ?>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<script> 
			jQuery(document).ready(function(){
				jQuery(".prallax-img").each(function() {
					var prallaxImg = jQuery(this).get(0);
					var parallaxInstance = new Parallax(prallaxImg);
				});
			});
		</script>
<?php
	}
}
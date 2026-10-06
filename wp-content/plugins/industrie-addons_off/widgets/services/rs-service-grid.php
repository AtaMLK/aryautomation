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

class Rsaddon_Elementor_pro_RSservices_Grid_Widget extends \Elementor\Widget_Base
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
		return 'rs-service-grid';
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
		return esc_html__('RS Services Grid', 'rsaddon');
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

		// ----------------------------------------  Service Global Card  ------------------------------
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__('Services Global', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'services_style',
			[
				'label'   => esc_html__('Services Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__('Style 1', 'rsaddon'),
					'2' => esc_html__('Style 2', 'rsaddon'),
					'3' => esc_html__('Style 3', 'rsaddon'),
					'4' => esc_html__('Style 4', 'rsaddon'),
					'5' => esc_html__('Style 5', 'rsaddon'),
					'6' => esc_html__('Style 6', 'rsaddon'),
					'7' => esc_html__('Style 7', 'rsaddon'),
					'8' => esc_html__('Style 8', 'rsaddon'),
					'9' => esc_html__('Style 9', 'rsaddon'),
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'rsaddon'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'rsaddon'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'rsaddon'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'rsaddon'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'rsaddon'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .services-inner' => 'text-align: {{VALUE}}'
				],
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'clip_path',
			[
				'label' => esc_html__('Clip Path ON/OFF?', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['services_style' => ['1', '6', '9']]
			]
		);

		$this->add_responsive_control(
            'box_horizontal_align',
            [
                'label' => esc_html__( 'Box Style (Inline / Block)', 'rsaddon' ),
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
				'default' => 'block',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
                'condition' => [
                    'services_style' => '7',
                ]
            ]
        );
		$this->add_responsive_control(
            'box_vertical_align',
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
				'default' => 'flex-start',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_column_align',
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
				'default' => 'row',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'flex_box_h_align',
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
				'default' => 'flex-start',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'services_flex_gap',
			[
				'label' => esc_html__('Flex Gap', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .services-inner' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_horizontal_align' => 'flex',
				]
			]
		);

		$this->end_controls_section(); // Service Global End

		// ----------------------------------------  Service Numbering Start ------------------------------
		$this->start_controls_section(
			'_service_numbering',
			[
				'label' => esc_html__('Numbering', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'numbering_show_hide',
			[
				'label' => esc_html__('Show/Hide', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'numbering_txt',
			[
				'label'       => esc_html__('Number', 'rsaddon'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '01',
				'placeholder' => esc_html__('01', 'rsaddon'),
				'condition' => [
					'numbering_show_hide' => 'yes',
				]
			]
		);
		$this->add_control(
			'numbering_step_title',
			[
				'label'       => esc_html__('Step Title', 'rsaddon'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Step',
				'condition' => [
					'numbering_show_hide' => 'yes',
					'services_style' => '8',
				]
			]
		);
		$this->end_controls_section(); //End Service Numbering

		// ----------------------------------------  Service Icon & Image Start ------------------------------
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__('Icon / Image', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				'condition' => ['services_style' => '5']
            ]
        );
		$this->add_control(
			'icon_image_show_hide',
			[
				'label' => esc_html__('Icon/Image', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__('Select Icon Type', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__('Icon', 'rsaddon'),
					'image' => esc_html__('Image', 'rsaddon'),
				],
				'condition' => [
					'icon_image_show_hide' => 'yes',
				],
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' => __('Icon', 'prelements'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'icon',
				],
			]
		);

		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__('Feature Image', 'rsaddon'),
				'type'  => Controls_Manager::MEDIA,
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',

				],
				'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
			]
		);

		$this->add_responsive_control(
			'icon_image_width',
			[
				'label' => esc_html__('Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .image_style img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image',

				]
			]
		);
		$this->add_responsive_control(
			'icon_image_height',
			[
				'label' => esc_html__('Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .image_style img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image',

				]
			]
		);

		$this->add_responsive_control(
			'icon_image_wrapper_width',
			[
				'label' => esc_html__('Image Wrapper Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .media_wrap .image_style' => 'width: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'icon_type' => 'image',

				]
			]
		);

		$this->add_responsive_control(
			'icon_image_wrapper_height',
			[
				'label' => esc_html__('Image Wrapper Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .media_wrap .image_style' => 'height: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'icon_type' => 'image',

				]
			]
		);

		$this->end_controls_section(); // Service Icon & Image End

		// ----------------------------------------  Service Title & Description Start ------------------------------
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Title & Description', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
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
		$this->add_control(
			'title_link',
			[
				'label_block' => true,
				'label' => esc_html__('Title Link', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('#', 'rsaddon'),
			]
		);
		$this->add_control(
			'link_open',
			[
				'label'   => esc_html__('Link Open New Window', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => esc_html__('No', 'rsaddon'),
					'yes' => esc_html__('Yes', 'rsaddon'),

				],
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'rsaddon'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h1'  => [
						'title' => esc_html__('H1', 'rsaddon'),
						'icon' => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => esc_html__('H2', 'rsaddon'),
						'icon' => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => esc_html__('H3', 'rsaddon'),
						'icon' => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => esc_html__('H4', 'rsaddon'),
						'icon' => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => esc_html__('H5', 'rsaddon'),
						'icon' => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => esc_html__('H6', 'rsaddon'),
						'icon' => 'eicon-editor-h6'
					]
				],
				'default' => 'h2',
				'toggle' => false,
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'rsaddon'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. Dummy text generator.', 'rsaddon'),
				'separator' => 'before',
			]
		);
		$this->end_controls_section(); // Service Title & Description End

		// ----------------------------------------  Service Button Start ------------------------------
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Button', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'button_show_hide',
			[
				'label' => esc_html__('Button Show/Hide', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->add_control(
			'btn__icon_type',
			[
				'label'   => esc_html__('Select Button Icon Type', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'rsaddon'),
					'icon' => esc_html__('Icon', 'rsaddon'),
				],
				'condition' => [
					'button_show_hide' => 'yes',
					'default_icon_show_hide!' => 'yes',
					
				],
			]
		);
		$this->add_control(
			'btn__selected_icon',
			[
				'label' => __('Icon', 'prelements'),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'button_show_hide' => 'yes',
				],
				'default' => [
					'value' => 'fas fa-circle',
					'library' => '',
				],
			]
		);
		$this->add_control(
			'button_icon_postion',
			[
				'label'   => esc_html__('Icon Position', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Left', 'rsaddon'),
					'right' => esc_html__('Right', 'rsaddon'),
				],
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style!' => '4',
				],
			]
		);
		$this->add_control(
			'_btn_icon_spacing',
			[
				'label' => esc_html__('Icon Margin Left', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'services_btn_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .btn-part a i, {{WRAPPER}} .btn-part a svg' => 'margin-left: {{SIZE}}{{UNIT}};',

				],
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style!' => '4',
				],
			]
		);
		$this->add_control(
			'_btn_icon_spacing_right',
			[
				'label' => esc_html__('Icon Margin Right', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'condition' => [
					'services_btn_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .btn-part a i, {{WRAPPER}} .btn-part a svg' => 'margin-right: {{SIZE}}{{UNIT}};',

				],
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style!' => '4',
				],
			]
		);
		$this->add_control(
			'services_btn_text',
			[
				'label' => esc_html__('Button Text', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Read More', 'rsaddon'),
				'separator' => 'before',
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style!' => '4',
				],
			]
		);
		$this->add_control(
			'services_btn_link',
			[
				'label' => esc_html__('Button Link', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__('#', 'rsaddon'),
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style!' => '4',
				],
			]
		);
		$this->add_control(
			'services_btn_link_open',
			[
				'label'   => esc_html__('Link Open New Window', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => esc_html__('No', 'rsaddon'),
					'yes' => esc_html__('Yes', 'rsaddon'),
				],
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style!' => '4',
				],
			]
		);

		$this->end_controls_section(); // Service Button End
		/**
		 * Style Tab
		 * ------------------------------ Icon / Image Global Style ------------------------------
		 *
		 */
		$this->start_controls_section(
			'_section_area_style',
			[
				'label' => esc_html__('Global Style', 'rsaddon'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'item_padding_area',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_margin_area',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// ----------------------------------------  Global Style Hover & Normal Tab Start ------------------------------
		$this->start_controls_tabs('_tabs_global');
		// Normal Start
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'global_background',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services .services-inner',
			]
		);
		$this->add_responsive_control(
			'item_border_radius_area',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .rs-addon-services .services-inner',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'services_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rs-addon-services .services-inner'
			]
		);
		$this->end_controls_tab(); // Normal End 

		// Hover Start
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'global_background_hover',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover,{{WRAPPER}} .rs-addon-services .services-inner.active-bg',
			]
		);

		$this->add_responsive_control(
			'item_border_radius_area_hover',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner.gradient-border-enable:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'items_border_hover',
				'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'services_box_shadow_hover',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover'
			]
		);
		$this->end_controls_tab(); // Hover End

		$this->end_controls_tabs(); // Global Style Hover & Normal Tab End


		$this->add_control(
			'item_transition',
			[
				'label' => esc_html__('Transition', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.5,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner, {{WRAPPER}} .media-cmn, {{WRAPPER}} .media-cmn img, {{WRAPPER}} .services-title .title a, {{WRAPPER}} .desc-text, {{WRAPPER}} .btn-part a, {{WRAPPER}} .btn-part a i, {{WRAPPER}} .btn-part a svg, {{WRAPPER}} .btn-part a svg path' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$this->add_control(
			'bottom_border_color',
			[
				'label' => esc_html__('Bottom Border Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner:after' => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style5 .services-inner:after' => 'background-color: {{VALUE}}!important;',
				],
				'condition' => ['services_style' => ['4','5']]

			]
		);

		$this->add_control(
			'bottom_border_radius',
			[
				'label' => esc_html__('Bottom Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style5 .services-inner:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => ['services_style' => ['4','5']]
			]
		);

		$this->end_controls_section(); // Service Global Style End

		// ----------------------------------------  Numbering Style Start ------------------------------
		$this->start_controls_section(
			'_service_numbering_style',
			[
				'label' => esc_html__('Numbering', 'rsaddon'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'numbering_show_hide' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .numbering, {{WRAPPER}} .rs-addon-services.style1 .services-inner .numbering span, {{WRAPPER}} .rs-addon-services.style3 .services-inner .numbering span, {{WRAPPER}} .rs-addon-services .services-inner .step-number span',
			]
		);
		$this->add_responsive_control(
			'number_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .numbering' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services .services-inner .step-number .numbering-step' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'number_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .numbering' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services .services-inner .step-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'number_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering-step' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'number_wrapper_width',
			[
				'label' => esc_html__('Number Wrapper Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering' => 'width: {{SIZE}}{{UNIT}};display:flex;align-items:center;justify-content:center;',
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering-step' => 'width: {{SIZE}}{{UNIT}};display:flex;align-items:center;justify-content:center;',
				],
				'condition' => [
					'numbering_show_hide' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'number_wrapper_height',
			[
				'label' => esc_html__('Number Wrapper Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering-step' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'numbering_show_hide' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'number_position_y',
			[
				'label' => esc_html__('Position Y (Top)', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .numbering' => 'top: {{SIZE}}{{UNIT}}; bottom: unset; position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner .numbering' => 'top: {{SIZE}}{{UNIT}}; bottom: unset; position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number' => 'top: {{SIZE}}{{UNIT}}; bottom: unset; position: absolute;',
				],
			]
		);
		$this->add_responsive_control(
			'number_position_y_bottom',
			[
				'label' => esc_html__('Position Y (Bottom)', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .numbering' => 'bottom: {{SIZE}}{{UNIT}}; top: unset; position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner .numbering' => 'bottom: {{SIZE}}{{UNIT}}; top: unset; position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number' => 'bottom: {{SIZE}}{{UNIT}}; top: unset; position: absolute;',
				],
			]
		);
		$this->add_responsive_control(
			'number_position_x',
			[
				'label' => esc_html__('Position X (Left)', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .numbering' => 'left: {{SIZE}}{{UNIT}}; right: unset;  position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner .numbering' => 'left: {{SIZE}}{{UNIT}}; right: unset;  position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number' => 'left: {{SIZE}}{{UNIT}}; right: unset;  position: absolute;',
				],
			]
		);
		$this->add_responsive_control(
			'number_position_x_right',
			[
				'label' => esc_html__('Position X (Right)', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .numbering' => 'right: {{SIZE}}{{UNIT}}; left: unset;  position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner .numbering' => 'right: {{SIZE}}{{UNIT}}; left: unset;  position: absolute;',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number' => 'right: {{SIZE}}{{UNIT}}; left: unset;  position: absolute;',
				],
			]
		);

		 // Numbering Stroke
		 $this->add_control(
            'border_top_',
            [
                'label' => esc_html__( 'Numbering Stroke', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'number_fill_stroke_color',
            [
                'label' => esc_html__( 'Number Stroke Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .numbering span ' => '-webkit-text-fill-color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number .numbering-step span ' => '-webkit-text-fill-color: {{VALUE}};',
                ],                
            ]
        );
       
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'number_text_stroke',
                'selector' => '{{WRAPPER}} .rs-addon-services .services-inner .numbering span,{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number .numbering-step span',
            ]
        );

		$this->add_control(
			'step_title_color',
			[
				'label' => esc_html__('Step Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .step-number .step-title' => 'color: {{VALUE}};',
				],
				'condition' => ['services_style' => '8']

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'step_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-addon-services .services-inner .step-number .step-title',
				'condition' => ['services_style' => '8']
			]
		);
		
		$this->start_controls_tabs('_tabs_number');
		// Normal Start
		$this->start_controls_tab(
			'style_number_tab',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);
		
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .numbering' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner .numbering span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style3 .services-inner .numbering span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style6 .services-inner .numbering span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number .numbering-step span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style9 .services-inner .numbering span' => 'color: {{VALUE}}!important;',
				],

			]
		);

		$this->add_control(
			'number_bgcolor',
			[
				'label' => esc_html__('Number BG Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .numbering' => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style3 .services-inner .numbering' => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number .numbering-step' => 'background-color: {{VALUE}}!important;',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'number_border',
				'selector' => '{{WRAPPER}} .rs-addon-services.style3 .services-inner .numbering,{{WRAPPER}} .numbering,{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number .numbering-step',
			]
		);
		$this->add_responsive_control(
			'number_opacity',
			[
				'label' => esc_html__('Opacity', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner .step-number .numbering-step' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_responsive_control(
			'number_rote',
			[
				'label' => esc_html__('Rotate', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['deg'],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .numbering' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);

		$this->end_controls_tab(); // Normal End 

		// Hover Start
		$this->start_controls_tab(
			'style_number_hover_tab',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'number_hover_border',
				'selector' => '{{WRAPPER}} .rs-addon-services.style3 .services-inner:hover .numbering,{{WRAPPER}} .rs-addon-services .services-inner:hover .numbering,{{WRAPPER}} .rs-addon-services .services-inner:hover .numbering-step',
			]
		);
		
		$this->add_control(
			'number_hover_color',
			[
				'label' => esc_html__('Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-inner:hover .numbering' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner:hover .numbering span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style3 .services-inner:hover .numbering span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style6 .services-inner:hover .numbering span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style8 .services-inner:hover .numbering-step span' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style9 .services-inner:hover .numbering span' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'number_bg_hover_color',
			[
				'label' => esc_html__('Number BG Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services.style3 .services-inner:hover .numbering' => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .numbering' => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .numbering-step' => 'background-color: {{VALUE}}!important;',
				],

			]
		);
		$this->add_responsive_control(
			'number_opacity_hover',
			[
				'label' => esc_html__('Opacity ( Hover )', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .numbering' => 'width: {{SIZE}};',
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .numbering-step' => 'width: {{SIZE}};',
				],
			]
		);
	
		$this->end_controls_tab(); // Hover End
		$this->end_controls_tabs();
		$this->end_controls_section(); // Numbering Style End


		// ----------------------------------------  Icon Style Start ------------------------------
		$this->start_controls_section(
			'_section_media_style',
			[
				'label' => esc_html__('Icon / Image', 'rsaddon'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_alignments',
			[
				'label' => esc_html__('Icon Alignment', 'rsaddon'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'rsaddon'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'rsaddon'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'rsaddon'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .media_wrap' => 'justify-content: {{VALUE}} !important;display:flex;align-items:center;',
					'{{WRAPPER}} .rs-addon-services .services-inner .media_wrap .icon_style' => 'justify-content: {{VALUE}} !important;display:flex;align-items:center;',
					'{{WRAPPER}} .rs-addon-services .services-inner .media_wrap .image_style' => 'justify-content: {{VALUE}} !important;display:flex;align-items:center;',
				],
			]
		);
		$this->add_responsive_control(
			'media_hover_transition',
			[
				'label' => esc_html__('Media Transition', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap,
					 {{WRAPPER}} .services-inner .media-cmn,
                     {{WRAPPER}} .services-inner .media-cmn img,
                     {{WRAPPER}} .services-inner .media-cmn i,
                     {{WRAPPER}} .services-inner .media-cmn svg' => 'transition: all {{SIZE}}s !important;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_wrapper_width',
			[
				'label' => esc_html__('Icon Wrapper Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap' => 'width: {{SIZE}}{{UNIT}};display:flex;align-items:center;justify-content:center;',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'width: {{SIZE}}{{UNIT}};display:flex;align-items:center;justify-content:center;',
					'{{WRAPPER}} .rs-addon-services.style9 .media_wrap' => 'width: {{SIZE}}{{UNIT}};display:flex;align-items:center;justify-content:center;',

				],
			]
		);
		$this->add_responsive_control(
			'icon_wrapper_height',
			[
				'label' => esc_html__('Icon Wrapper Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style9 .media_wrap' => 'height: {{SIZE}}{{UNIT}};',

				],
			]
		);

		
		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label' => esc_html__('Icon Wrapper Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style9 .media_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_image_position_haeding',
			[
				'label' => esc_html__('Position Of Icon/Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_image_position',
			[
				'label' => esc_html__('Position', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'rsaddon'),
					'unset' => esc_html__('Unset', 'rsaddon'),
					'relative' => esc_html__('Relative', 'rsaddon'),
					'absolute' => esc_html__('Absolute', 'rsaddon'),
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap' => 'position: {{VALUE}};',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'position: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_image_position_x',
			[
				'label' => esc_html__('Move X From', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Left', 'rsaddon'),
					'right' => esc_html__('Right', 'rsaddon'),
				],
				'condition' => [
					'icon_image_position' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'icon_image_position_x_left',
			[
				'label'      => esc_html__('Left', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap,
					{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style,
					{{WRAPPER}} .rs-addon-services.style6 .media_wrap,
					{{WRAPPER}} .rs-addon-services.style9 .media_wrap' => 'left: {{SIZE}}{{UNIT}}; right:unset;',
				],
				'condition' => [
					'icon_image_position' => ['relative', 'absolute'],
					'icon_image_position_x' => 'left',
				]
			]
		);
		$this->add_responsive_control(
			'icon_image_position_x_right',
			[
				'label'      => esc_html__('Right', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap,
					{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style,
					{{WRAPPER}} .rs-addon-services.style6 .media_wrap,
					{{WRAPPER}} .rs-addon-services.style9 .media_wrap' => 'right: {{SIZE}}{{UNIT}}; left:unset;',
				],
				'condition' => [
					'icon_image_position' => ['relative', 'absolute'],
					'icon_image_position_x' => 'right',
				]
			]
		);
		$this->add_control(
			'icon_image_position_y',
			[
				'label' => esc_html__('Move Y From', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top' => esc_html__('Top', 'rsaddon'),
					'bottom' => esc_html__('Bottom', 'rsaddon'),
				],
				'condition' => [
					'icon_image_position' => ['relative', 'absolute'],
				],
			]
		);
		$this->add_responsive_control(
			'icon_image_position_y_top',
			[
				'label'      => esc_html__('Top', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap,
					{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style,
					{{WRAPPER}} .rs-addon-services.style6 .media_wrap,
					{{WRAPPER}} .rs-addon-services.style9 .media_wrap' => 'top: {{SIZE}}{{UNIT}}; bottom:unset;',
				],
				'condition' => [
					'icon_image_position' => ['relative', 'absolute'],
					'icon_image_position_y' => 'top',
				]
			]
		);
		$this->add_responsive_control(
			'icon_image_position_y_bottom',
			[
				'label'      => esc_html__('Bottom', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap,
					{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style,
					{{WRAPPER}} .rs-addon-services.style6 .media_wrap,
					{{WRAPPER}} .rs-addon-services.style9 .media_wrap' => 'bottom: {{SIZE}}{{UNIT}}; top:unset;',
				],
				'condition' => [
					'icon_image_position' => ['relative', 'absolute'],
					'icon_image_position_y' => 'bottom',
				]
			]
		);

		$this->add_control(
			'service_border_enable',
			[
				'label' => esc_html__( 'Icon Border Enable', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'service_icon_border',
				'selector' => '{{WRAPPER}} .rs-addon-services.style6 .media_wrap',
				'condition' => ['service_border_enable' => 'yes']
			]
		);

		$this->add_responsive_control(
            'icon_box_horizontal_align',
            [
                'label' => esc_html__( 'Box Style (Inline / Block)', 'rsaddon' ),
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
				'default' => 'block',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner .media_wrap' => 'display: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
				'condition' => ['service_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'icon_box_vertical_align',
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
				'default' => 'flex-start',
				'condition' => [
					'icon_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner .media_wrap' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'align-items: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'icon_flex_box_h_align',
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
				'default' => 'flex-start',
				'condition' => [
					'icon_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner .media_wrap' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		// Floating Image Cotrol End

		$this->start_controls_tabs('_icons_tabs_section');

		$this->start_controls_tab(
			'icon_tab_normal_color',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'service_icon_css_filters',
				'selector' => '{{WRAPPER}} .services-inner .media_wrap .image_style img',
			]
		);


		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .media-cmn svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .media-cmn i' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style2 .services-inner.box .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style2 .services-inner.box .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner.box .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner.box .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap svg path' => 'fill: {{VALUE}} !important',

				],
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_control(
			'wrapper_bg_color',
			[
				'label' => esc_html__('Wrapper BG Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services.style2 .services-inner .media_wrap' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services .services-inner .media_wrap' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'wrapper_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_normal_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rs-addon-services.style2 .services-inner .media_wrap,{{WRAPPER}} .rs-addon-services .services-inner .media_wrap,{{WRAPPER}} .rs-addon-services.style6 .media_wrap'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_tab_hover_color',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'tekone_service_icon_hover_css_filters',
				'selector' => '{{WRAPPER}} .services-inner:hover .media_wrap img',
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__('Icon Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .media-cmn svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .media-cmn i' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style2 .services-inner.box:hover .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style2 .services-inner.box:hover .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner.box:hover .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner.box:hover .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style6:hover .media_wrap svg path' => 'fill: {{VALUE}} !important',
					'{{WRAPPER}} .rs-addon-services.style6:hover .media_wrap svg path' => 'fill: {{VALUE}} !important',
				],
				'condition' => [
					'icon_type' => 'icon'
				]
			]
		);

		$this->add_control(
			'wrapper_bg_hover_color',
			[
				'label' => esc_html__('Wrapper Hover BG Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services.style2 .services-inner:hover .media_wrap' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .media_wrap' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services.style6:hover .media_wrap' => 'background-color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'wrapper_border_hover_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .services-inner:hover .media_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6:hover .media_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style5 .services-inner:hover .media_wrap .image_style img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6:hover .media_wrap .image_style img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_hover_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rs-addon-services.style2 .services-inner:hover .media_wrap,{{WRAPPER}} .rs-addon-services .services-inner:hover .media_wrap,{{WRAPPER}} .rs-addon-services.style6:hover .media_wrap'
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_width_size',
			[
				'label' => esc_html__('Icon Svg Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media-cmn svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6 .media-cmn svg' => 'width: {{SIZE}}{{UNIT}};',

				],
				'condition' => [
					'icon_type' => 'icon'
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_height_size',
			[
				'label' => esc_html__('Icon Svg height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .services-inner .media-cmn svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services.style6 .media-cmn svg' => 'height: {{SIZE}}{{UNIT}};',

				],
				'condition' => [
					'icon_type' => 'icon'
				],
				'separator' => 'before',
			]
		);
		


		$this->end_controls_section(); //End Icon/Img Style

		// ----------------------------------------  Title Style ------------------------------
		$this->start_controls_section(
			'_section_title_style',
			[
				'label' => esc_html__('Title & Description', 'rsaddon'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Title', 'rsaddon'),
				'separator' => 'before',
			]
		);

		// This Control Handle Title Color Switch Condition Based On Hover Box or Link ↓
		$this->add_control(
			'title_hover_color_based_on',
			[
				'label'   => esc_html__('Hover Color Based On', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'box',
				'options' => [
					'box' => esc_html__('Box', 'rsaddon'),
					'link' => esc_html__('Link', 'rsaddon'),
				],
			]
		);
		// This Control Handle Title Color Switch Condition Based On Hover Box or Link ↑
		$this->add_control(
			'title_hover_transiation',
			[
				'label' => esc_html__('Hover Transiation', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [

						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .services-title a' => 'transition: all {{SIZE}}s;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .services-title .title, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title a,{{WRAPPER}} .rs-addon-services.style4 .services-inner .services-title .title',

			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services-title .title, {{WRAPPER}} .services-title .title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .services-title a, {{WRAPPER}} .rs-addon-services .services-inner:hover .services-title > *,{{WRAPPER}} .rs-addon-services .services-inner:hover .services-title,{{WRAPPER}} .rs-addon-services .services-inner:hover .services-title .title' => 'color: {{VALUE}}!important;',
				],
				'condition' => [
					'title_hover_color_based_on' => 'box',
				]
			]
		);
		$this->add_control(
			'title_hover_color_link_style',
			[
				'label' => esc_html__('Link Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .services-title a:hover' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner .services-title:hover .title' => 'color: {{VALUE}}!important;',
				],
				'condition' => [
					'title_hover_color_based_on' => 'link',
				]
			]
		);
		$this->add_control(
			'title_hover_underline',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Title Hover Underline Color', 'rsaddon'),
				'separator' => 'before',
				'condition' => ['services_style' => '5']
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_hover_background',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services.style5 .services-inner .content_part .title a:hover',
				'condition' => ['services_style' => '5'],
				'separator' => 'after'
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__('Title Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .services-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services .services-inner .services-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .services-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services .services-inner .services-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'description_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Description', 'rsaddon'),
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .desc-text',
			]
		);
		$this->add_responsive_control(
			'description_spacing',
			[
				'label' => esc_html__('Description Spacing', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .desc-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services .services-inner .content_part .desc-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .desc-text,
					{{WRAPPER}} .desc-text a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'description_hover_color',
			[
				'label' => esc_html__('Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .desc-text,
					{{WRAPPER}} .rs-addon-services .services-inner:hover .desc-text a' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'description_link_hover_color',
			[
				'label' => esc_html__('Link Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .desc-text a:hover' => 'color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_section(); //End Titlle & Description

		// ---------------------------------------- Button Style Start ------------------------------
		$this->start_controls_section(
			'_section_style_button',
			[
				'label' => esc_html__('Button', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_show_hide' => 'yes',
				]
			]
		);

		// This Control Handle Button Color Switch Condition Based On Hover Box or Link ↓
		$this->add_control(
			'button_hover_color_based_on',
			[
				'label'   => esc_html__('Hover Color Based On', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'box',
				'options' => [
					'box' => esc_html__('Box', 'rsaddon'),
					'link' => esc_html__('Link', 'rsaddon'),
				],
			]
		);
		// This Control Handle Button Color Switch Condition Based On Hover Box or Link ↑
		$this->add_responsive_control(
			'link_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .btn-part a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_parent_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .btn-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_normal_width',
			[
				'label' => esc_html__('Button Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-part a' => 'width: {{SIZE}}{{UNIT}}; text-align: center;',

				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'btn_svg_height',
			[
				'label' => esc_html__('Icon Svg Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-part a svg' => 'height: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .btn-part svg' => 'height: {{SIZE}}{{UNIT}}!important;',

				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'btn_svg_width',
			[
				'label' => esc_html__('Icon Svg Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-part a svg' => 'width: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .btn-part svg' => 'width: {{SIZE}}{{UNIT}}!important;',

				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .btn-part a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .btn-part a',
			]
		);
		$this->add_control(
			'_hr',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);
		$this->start_controls_tabs('_tabs_button');

		//

		$this->start_controls_tab(
			'_tab_button_normal',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => esc_html__('Text Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'default' => '#6EC1E4',
				'selectors' => [
					'{{WRAPPER}} .btn-part a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn-part svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .btn-part svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner .services-btn svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .btn-part i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner .btn-part i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner .btn-part svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner .btn-part svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '
							{{WRAPPER}} .btn-part a',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .btn-part a',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .btn-part a',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_button_hover',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Text Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .btn-part a.services-btn:hover' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services .services-inner .btn-part a.services-btn:hover svg path' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services .services-inner .btn-part a.services-btn:hover i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services .services-inner .services-title:hover .btn-part i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services .services-inner .services-title:hover .btn-part svg' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner .services-title:hover .btn-part svg path' => 'fill: {{VALUE}} !important;',
				],
				'condition' => [
					'button_hover_color_based_on' => 'link',
				]
			]
		);
		$this->add_control(
			'button_hover_color_box',
			[
				'label' => esc_html__('Text Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .btn-part a.services-btn' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .btn-part a.services-btn svg path' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services .services-inner:hover .btn-part a.services-btn i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services.border-default-active .services-inner .btn-part a.services-btn' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner:hover .btn-part i' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner:hover .btn-part svg' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} .rs-addon-services.style4 .services-inner:hover .btn-part svg path' => 'fill: {{VALUE}} !important;',
				],
				'condition' => [
					'button_hover_color_based_on' => 'box',
				]
			]
		);
		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-part a:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'button_hover_color_based_on' => 'link',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_hover_typography',
				'selector' => '{{WRAPPER}} .services-inner:hover .btn-part a',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hoverborder',
				'selector' => '{{WRAPPER}} .btn-part a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'_section_style_content',
			[
				'label' => esc_html__('Content Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_style' => ['5','2']]
			]
		);
		$this->add_responsive_control(
			'content_part_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .content_part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_part_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .content_part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
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



		$this->add_inline_editing_attributes('title', 'basic');
		$this->add_render_attribute('title', 'class', 'title');

		$this->add_inline_editing_attributes('text', 'basic');
		$this->add_render_attribute('text', 'class', 'services-txt');
		$this->add_inline_editing_attributes('services_btn_text', 'basic');
		$this->add_render_attribute('services_btn_text', '', '');

		$clip_path = $settings['clip_path'];
		$title_based_on = $settings['title_hover_color_based_on'];

		$clip_path_css = '';
		if ($clip_path == 'yes') {
			$clip_path_css = 'clip-path-enable';
		}

?>

		<div class="rs-addon-services style<?php echo esc_attr($settings['services_style']); ?>">
			<?php

			if ('1' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style1.php";
			}
			elseif ('2' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style2.php";
			}
			elseif ('3' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style3.php";
			}
			elseif ('4' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style4.php";
			} 
			elseif ('5' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style5.php";
			}
			elseif ('6' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style6.php";
			}
			elseif ('7' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style7.php";
			}
			elseif ('8' == $settings['services_style']) {
				include plugin_dir_path(__FILE__) . "/style8.php";
			}
			else {
				include plugin_dir_path(__FILE__) . "/style9.php";
			}

			?>
		</div>

<?php
	}
}
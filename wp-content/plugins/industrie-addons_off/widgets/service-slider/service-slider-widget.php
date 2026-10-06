<?php

/**
 * Logo widget class
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
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;


defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_RSservices_Slider_Widget extends \Elementor\Widget_Base
{
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

    public function get_name()
    {
        return 'rs-service-slider';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title()
    {
        return esc_html__('RS Service Slider and Grid', 'rsaddon');
    }

    /**
     * Get widget icon.
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


    public function get_categories()
    {
        return ['rsaddon_category'];
    }

    public function get_keywords()
    {
        return ['service'];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__('Service Item', 'rsaddon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'enable_grid_',
            [
                'label' => esc_html__('Enable Grid', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'service__column_desktop',
            [
                'label'   => esc_html__('Column Desktop', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => esc_html__('Column 1', 'rsaddon'),
                    '6' => esc_html__('Column 2', 'rsaddon'),
                    '4' => esc_html__('Column 3', 'rsaddon'),
                    '3' => esc_html__('Column 4', 'rsaddon'),
                ],
                'condition' => [
                    'enable_grid_' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'service__column_md',
            [
                'label'   => esc_html__('Column Medium Device', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '6',
                'options' => [
                    '12' => esc_html__('Column 1', 'rsaddon'),
                    '6' => esc_html__('Column 2', 'rsaddon')
                ],
                'condition' => [
                    'enable_grid_' => 'yes',
                ],
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
                ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Robot Installation', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__('Name', 'rsaddon'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'rsaddon'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Consectetur ipiscing elit tellus ullam corper mattis', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__('Description', 'rsaddon'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'number',
            [
                'label' => esc_html__('Number', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'rsaddon'),
                'placeholder' => esc_html__('01', 'rsaddon'),
                'separator'   => 'before',
            ]
        );
       
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,
            ]
        );

       

        $this->add_control(
            'service_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );

        $this->add_responsive_control(
            'show_read',
            [
                'label' => esc_html__('Show Read More', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View Details', 'rsaddon'),
                'separator'   => 'before',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'show_read_icon',
            [
                'label' => esc_html__('Show Icon', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => __('Button Icon', 'rsaddon'),
                'type' => Controls_Manager::ICONS,
                'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'number_enable_disable',
			[
				'label' => esc_html__( 'Number Enable?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

       
        $this->end_controls_section();

        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__('Slider Settings', 'rsaddon'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_grid_!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__('Desktops > 1199px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Desktops > 991px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 767px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__('Tablets < 768px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__('Slide To Scroll', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '1' => esc_html__('1 Item', 'rsaddon'),
                    '2' => esc_html__('2 Item', 'rsaddon'),
                    '3' => esc_html__('3 Item', 'rsaddon'),
                    '4' => esc_html__('4 Item', 'rsaddon'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'navigation_dots_number',
            [
                'label'   => esc_html__('Navigation Dots/Number', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dots',
                'options' => [
                    'dots' => esc_html__('Dots', 'rsaddon'),
                    'number' => esc_html__('Number', 'rsaddon'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__('Navigation Dots', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',
                'condition' => ['navigation_dots_number' => 'dots']
            ]

        );
        $this->add_control(
            'slider_number',
            [
                'label'   => esc_html__('Navigation Number', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',
                'condition' => ['navigation_dots_number' => 'number']

            ]

        );

        $this->add_control(
			'number_separator_text',
			[
				'label' => esc_html__('Number Separator Text', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
                'default' => '',
				'label_block' => true,
				'placeholder' => esc_html__('/', 'rsaddon'),
				'separator' => 'before',
				'condition' => [
                    'navigation_dots_number' => 'number',
                    'slider_number' => 'true',

                    ]
			]

		);

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__('Navigation Nav', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__('Autoplay', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__('Autoplay Slide Speed', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3000',
                'options' => [
                    '1000' => esc_html__('1 Seconds', 'rsaddon'),
                    '2000' => esc_html__('2 Seconds', 'rsaddon'),
                    '3000' => esc_html__('3 Seconds', 'rsaddon'),
                    '4000' => esc_html__('4 Seconds', 'rsaddon'),
                    '5000' => esc_html__('5 Seconds', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__('Stop on Hover', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__('Autoplay Interval', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3000',
                'options' => [
                    '5000' => esc_html__('5 Seconds', 'rsaddon'),
                    '4000' => esc_html__('4 Seconds', 'rsaddon'),
                    '3000' => esc_html__('3 Seconds', 'rsaddon'),
                    '2000' => esc_html__('2 Seconds', 'rsaddon'),
                    '1000' => esc_html__('1 Seconds', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__('Loop', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__('Center Mode', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__('Item Gap', 'rsaddon'),
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
                    '{{WRAPPER}} .rs-addon-slider .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => esc_html__('Item Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin_slid',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_button');

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider, {{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'grid_border',
                'selector' => '{{WRAPPER}} .rs-service-slider, {{WRAPPER}} .rs-addon-slider.rs-services-slider.services-style2 .rs-service-slider',
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => esc_html__('Background Hover Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider:hover'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_hover_border',
                'selector' => '{{WRAPPER}} .rs-service-slider:hover',
                'separator' => 'after',
            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            '_img_sett_ings',
            [
                'label' => esc_html__('Image Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                ]
            ]
        );
       
        $this->add_responsive_control(
            'serv_image_width',
            [
                'label' => esc_html__('Image Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'serv_image_height',
            [
                'label' => esc_html__('Image Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
               
            ]
        );
     
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider .service-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_title_style_grid_',
            [
                'label' => esc_html__('Title Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'title_hover_underline',
			[
				'label' => esc_html__('Title Hover Underline', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_hover_background',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-services-slider .service-title-holder .service-title.yes .title a:hover',
				'condition' => ['title_hover_underline' => 'yes'],
				'separator' => 'after'
			]
		);
        $this->add_control(
            'title_hover_based',
            [
                'label'   => esc_html__('Hover Color Based On?', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'Link',
                'options' => [
                    'link' => esc_html__('Link', 'rsaddon'),
                    'box' => esc_html__('Box', 'rsaddon'),
                ],
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title___title',
            [
                'label' => esc_html__('Title', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_title' => 'yes'
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
                'default' => 'h3',
                'toggle' => false,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}}  .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title',
                'separator'   => 'before',
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .service-title .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .service-title .title a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title .title a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title .title:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'title_hover_based' => 'link'
                ],
            ]
        );

        $this->add_control(
            'title_hover_color_box',
            [
                'label' => esc_html__('Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .service-title .title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .service-title .title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'title_hover_based' => 'box'
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_desc_style_grid',
            [
                'label' => esc_html__('Description Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_hover_based',
            [
                'label'   => esc_html__('Hover Color Based On?', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'Link',
                'options' => [
                    'link' => esc_html__('Link', 'rsaddon'),
                    'box' => esc_html__('Box', 'rsaddon'),
                ],
            ]
        );

        $this->add_responsive_control(
            'show_desc',
            [
                'label' => esc_html__('Show Description', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}}  .rs-services-slider .rs-service-slider .service-desc p,{{WRAPPER}}  .rs-services-slider .rs-service-slider .service-desc',
                'separator'   => 'before',
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-desc p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );
       
        $this->add_responsive_control(
            'desc_area__margin_',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .rs-services-slider .rs-service-slider .service-title-holder .service-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}  .rs-services-slider .rs-service-slider .service-title-holder .service-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_hovercolor',
            [
                'label' => esc_html__('HOver Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc p:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes',
                    'desc_hover_based' => 'link'
                ],
            ]
        );

        $this->add_control(
            'desc_hovercolor_box',
            [
                'label' => esc_html__('HOver Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider:hover .service-title-holder .service-desc' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider:hover .service-title-holder .service-desc p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes',
                    'desc_hover_based' => 'box'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_style',
            [
                'label' => esc_html__('Content Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .rs-services-slider .service-title-holder' => 'text-align: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );
       
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_part_bg',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder',
            ]
        );

        $this->add_control(
			'content_part_hover',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Hover Background', 'prelements'),
				'separator' => 'before',
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_part_hover_bg',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-services-slider .service-title-holder:after',
            ]
        );
       
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_part_border',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder',
            ]
        );
        $this->add_responsive_control(
            'content_part_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
   
        $this->add_responsive_control(
            'content_part_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       
        $this->end_controls_section();

        $this->start_controls_section(
            '_read_style_',
            [
                'label' => esc_html__('Read More Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'read_more_hover_based',
            [
                'label'   => esc_html__('Hover Color Based On?', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'box',
                'options' => [
                    'link' => esc_html__('Link', 'rsaddon'),
                    'box' => esc_html__('Box', 'rsaddon'),
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'read_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more .btn-text',
                'separator'   => 'before',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
       

        $this->add_responsive_control(
            'read_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'show_read' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'show_read' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'show_read' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_button_style');

        // Normal Bullet Start
        $this->start_controls_tab(
            'slider_button_normal_tab',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );
        $this->add_control(
            'read_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read__background',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more .btn-text',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'read_border',
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more .btn-text',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_icon_bg_color',
            [
                'label' => esc_html__('Icon BG Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'arrow_icon_arrow_color',
            [
                'label' => esc_html__('Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-icon svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);
        $this->add_control(
            'read_color_hover',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-text:hover' => 'color: {{VALUE}}',
                ],
                'condition' => ['read_more_hover_based' => 'link']
            ]
        );
        $this->add_control(
            'read_color_hover_box',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .rs-service-slider:hover .service-title-holder .read__more .btn-text' => 'color: {{VALUE}}!important',
                    '{{WRAPPER}} .rs-services-slider.service-style-1 .rs-service-slider:hover .btn_box .btn-area .btn-text' => 'color: {{VALUE}}!important',
                ],
                'condition' => ['read_more_hover_based' => 'box']
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read__hover_background',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more .btn-text:hover',
                'condition' => [
                    'show_read' => 'yes',
                    'read_more_hover_based' => 'link'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read__hover_background_box',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider .rs-service-slider:hover .service-title-holder .read__more .btn-text',
                'condition' => [
                    'show_read' => 'yes',
                    'read_more_hover_based' => 'box'
                ],
            ]
        );

        $this->add_control(
            'read_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-text:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'read_border_color_hover_box',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .rs-service-slider:hover .service-title-holder .read__more .btn-text' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                    'read_more_hover_based' => 'box'
                ],
            ]
        );

        $this->add_control(
            'arrow_icon_bg_color_hover',
            [
                'label' => esc_html__('Icon BG Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-icon:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                    'read_more_hover_based' => 'link',
                ],
            ]
        );

        $this->add_control(
            'arrow_icon_arrow_color_hover',
            [
                'label' => esc_html__('Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-icon:hover svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-service-slider .read__more .btn-icon:hover svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                    'read_more_hover_based' => 'link'
                ],
            ]
        );
        $this->add_control(
            'arrow_icon_bg_color_hover_box',
            [
                'label' => esc_html__('Icon BG Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .btn_box .btn-area .btn-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                    'read_more_hover_based' => 'box',
                ],
            ]
        );

        $this->add_control(
            'arrow_icon_arrow_color_hover_box',
            [
                'label' => esc_html__('Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .btn_box .btn-area .btn-icon svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider.service-style-1 .rs-service-slider:hover .btn_box .btn-area .btn-icon svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                    'read_more_hover_based' => 'box'
                ],
            ]
        );
        $this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_number_style',
            [
                'label' => esc_html__('Number Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['number_enable_disable' => 'yes']
            ]
        );
        $this->add_control(
            'number_display_position',
            [
                'label' => esc_html__('Number Position Absolute/Default', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'unset',
                'options' => [
                    'absolute' => [
                        'title' => esc_html__('Position Absolute', 'rsaddon'),
                        'icon' => 'eicon-check',
                    ],
                    'unset' => [
                        'title' => esc_html__('Default', 'rsaddon'),
                        'icon' => 'eicon-editor-close',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .service-title-holder .numbering' => 'position: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
			'number_hover_based',
			[
				'label' => esc_html__( 'Number Hover Enable?', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'number_line_enable',
			[
				'label' => esc_html__( 'Number Line Enable?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_responsive_control(
            'number_line_bgcolor',
            [
                'label' => esc_html__('Number Line BG Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .service-title-holder .numbering.number-line:after' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['number_line_enable' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'number_line_bgcolor_hover',
            [
                'label' => esc_html__('Number Line Hover BG Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .numbering.number-line:after' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['number_line_enable' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'number_line_width',
            [
                'label' => esc_html__('Line Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .service-title-holder .numbering.number-line:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['number_line_enable' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'number_line_top_gap',
            [
                'label' => esc_html__('Line Top Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .service-title-holder .numbering.number-line:after' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['number_line_enable' => 'yes']
            ]
        );
        $this->add_responsive_control(
            'number_line_right_gap',
            [
                'label' => esc_html__('Line Right Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .service-title-holder .numbering.number-line:after' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['number_line_enable' => 'yes'],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number__typography',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering span',
            ]
        );
    
        $this->add_responsive_control(
            'number_color__',
            [
                'label' => esc_html__('Number Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering span' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'number_fill_stroke_color',
            [
                'label' => esc_html__( 'Number Stroke Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .numbering span' => '-webkit-text-fill-color: {{VALUE}};',
                ],                
            ]
        );
       
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'number_text_stroke',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering span',
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'stroke_hover_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Stroke Hover Style', 'prelements'),
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'number_color_hover',
            [
                'label' => esc_html__('Number Hover Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .numbering span' => 'color: {{VALUE}}',
                ],
                'condition' => ['number_hover_based' => 'yes']
            ]
        );
        $this->add_control(
            'number_fill_stroke_color_box',
            [
                'label' => esc_html__( 'Number Stroke HOver Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .numbering span' => '-webkit-text-fill-color: {{VALUE}};',
                ],
                'condition' => ['number_hover_based' => 'yes']                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'number_text_hover_box_stroke',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .numbering span',
                'condition' => [
                    'show_title' => 'yes',
                    'number_hover_based' => 'yes'
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
                    '{{WRAPPER}} .rs-services-slider .service-title-holder .numbering ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__top__position',
            [
                'label' => esc_html__('Number Top Position', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'top: {{SIZE}}{{UNIT}};bottom:unset;',
                ],
                'condition' => [
                    'number_display_position' => ['absolute']
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__bottom__position',
            [
                'label' => esc_html__('Number Bottom Position', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'bottom: {{SIZE}}{{UNIT}};top:unset;',
                ],
                'condition' => [
                    'number_display_position' => ['absolute']
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__right__position',
            [
                'label' => esc_html__('Number Right Position', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'right: {{SIZE}}{{UNIT}};left:unset;',
                ],
                'condition' => [
                    'number_display_position' => ['absolute']
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__left__position',
            [
                'label' => esc_html__('Number Left Position', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'left: {{SIZE}}{{UNIT}};right:unset;',
                ],
                'condition' => [
                    'number_display_position' => ['absolute']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'arrow_style',
            [
                'label' => esc_html__('Arrow Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_nav' => 'true'
                ],
                'condition' => [
                    'enable_grid_!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_default_show_enable',
            [
                'label' => esc_html__('Navigation Nav Show Enable?', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'arrow_show_disable',
                'options' => [
                    'arrow_show_enable'  => esc_html__('Arrow Default Show', 'rsaddon'),
                    'arrow_show_disable' => esc_html__('Arrow Hover Show', 'rsaddon'),
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );

        $this->add_responsive_control(
			'arrow_position_maker',
			[
				'label' => esc_html__( 'Arrow Position Style', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'custom' => esc_html__( 'Custom', 'rsaddon' ),
				],
			]
		);

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
					'arrow_position_maker' => 'custom',
				]
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'left',
					'arrow_position_maker' => 'custom',
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset!important;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'right',
					'arrow_position_maker' => 'custom',
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
				'condition' => [
					'arrow_position_maker' => 'custom',
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'top',
					'arrow_position_maker' => 'custom',
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'bottom',
					'arrow_position_maker' => 'custom',
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
					'arrow_position_maker' => 'custom',
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'left',
					'arrow_position_maker' => 'custom',
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'right',
					'arrow_position_maker' => 'custom',
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
					'arrow_position_maker' => 'custom',
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'top',
					'arrow_position_maker' => 'custom',
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'bottom',
					'arrow_position_maker' => 'custom',
		        ]
			]
		);

       
        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'nav_arrow_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}}  .rsaddon-unique-slider .rs-addon-slider .slick-arrow:before',
                'separator'   => 'before',
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->start_controls_tabs('_tabs_slider_arrow');
        $this->start_controls_tab(
            'slider_arrow_normal_tab2',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__( ' Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev:before' => 'color: {{VALUE}};',
                ],                
            ]
        );
       
        $this->add_control(
            'arrow_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'background-color: {{VALUE}};',  
                ],             
            ]
        );
        $this->end_controls_tab();
        // Normal Bullet End

        // Active Bullet Start
        $this->start_controls_tab(
            'slider_arrow_active_tab2',
            [
                'label' => esc_html__('Hover', 'rsaddon'),
            ]
        );
        $this->add_control(
            'arrow_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev:hover:before' => 'color: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'arrow_bg_color_hover',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover' => 'background-color: {{VALUE}};',  
                ],            
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_bullet_style',
            [
                'label' => esc_html__('Dots Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['navigation_dots_number' => ['number','dots']],
                'condition' => [
                    'enable_grid_!' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'dots_style',
            [
                'label'   => esc_html__('Dots Style', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Style 1', 'rsaddon'),
                    '2' => esc_html__('Style 2', 'rsaddon'),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dots_text_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .slick-dots li .slick-paiging',
                'separator'   => 'before',
                'condition' => ['navigation_dots_number' => 'number']
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-dots li .slick-paiging' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li .slick-paiging' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['navigation_dots_number' => 'number']
            ]
        );
       
        $this->add_responsive_control(
            'bullet__align',
            [
                'label' => esc_html__('Bullet Alignment', 'rsaddon'),
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
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_slider_dots');

        // Normal Bullet Start
        $this->start_controls_tab(
            'slider_dots_normal_tab',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );
        $this->add_control(
            'navigation_text_normal_color',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging' => 'color: {{VALUE}};',

                ],
                'condition' => ['navigation_dots_number' => 'number']
            ]
        );
        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__('Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging' => 'background: {{VALUE}};',

                ],
            ]
        );
        $this->add_control(
            'bullet_inner_normal_bg',
            [
                'label' => esc_html__('Bullet Inner BG Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .slick-dots li button:after' => 'background: {{VALUE}};',

                ],
                'condition' => ['dots_style' => '2']
            ]
        );
        $this->add_responsive_control(
            'bullet_normal_width_custom',
            [
                'label' => esc_html__('Bullet Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_height_custom',
            [
                'label' => esc_html__('Bullet Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
       
        $this->add_responsive_control(
            'bullet_normal_inner_width_custom',
            [
                'label' => esc_html__('Bullet Inner Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .slick-dots li button:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['dots_style' => '2']
            ]
        );
        $this->add_responsive_control(
            'bullet_inner_height_custom',
            [
                'label' => esc_html__('Bullet Inner Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .slick-dots li button:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['dots_style' => '2']
            ]
        );
        $this->add_responsive_control(
            'bullet_active_hover_width_custom',
            [
                'label' => esc_html__('Bullet Active/Hover Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active .slick-paiging' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li:hover button' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li:hover .slick-paiging' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_border_radius_custom',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'bullet_border_custom',
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button,{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'bullet_shadow_custom',
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button,{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging'
            ]
        );
        $this->end_controls_tab();
        // Normal Bullet End

        // Active Bullet Start
        $this->start_controls_tab(
            'slider_dots_active_tab',
            [
                'label' => esc_html__('Active', 'rsaddon'),
            ]
        );
        $this->add_control(
            'navigation_text_color',
            [
                'label' => esc_html__('Active Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li:hover .slick-paiging' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active .slick-paiging' => 'color: {{VALUE}};',

                ],
                'condition' => ['navigation_dots_number' => 'number']
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'navigation_dot_icon_background_active',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li:hover button,{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button,{{WRAPPER}} .rs-addon-slider .slick-dots li:hover .slick-paiging,{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active .slick-paiging',
            ]
        );
        $this->add_control(
            'bullet_inner_active_bg',
            [
                'label' => esc_html__('Bullet Inner BG Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .slick-dots li:hover button:after' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-services-slider .slick-dots li.slick-active button:after' => 'background: {{VALUE}};',

                ],
                'condition' => ['dots_style' => '2']
            ]
        );

        $this->add_responsive_control(
            'bullet_active_width_custom',
            [
                'label' => esc_html__('Bullet Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging:hover' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active .slick-paiging' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'navigation_dot_active_border_color',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li .slick-paiging:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active .slick-paiging' => 'border-color: {{VALUE}};',

                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        // Active Bullet End

        $this->add_responsive_control(
            'bullet_spacing_custom',
            [
                'label' => esc_html__('Margin Bottom', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_top__spacing_custom',
            [
                'label' => esc_html__('Top Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'top: {{SIZE}}{{UNIT}};bottom:unset;',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_bottom__spacing_custom',
            [
                'label' => esc_html__('Bottom Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};top:unset;',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_right__spacing_custom',
            [
                'label' => esc_html__('Right Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_left__spacing_custom',
            [
                'label' => esc_html__('Left Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Bullet Style End

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $services_style         = $settings['services_style'];
        $slidesToShow           = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
        $autoplaySpeed          = $settings['slider_autoplay_speed'];
        $interval               = $settings['slider_interval'];
        $slidesToScroll         = $settings['slides_ToScroll'];
        $slider_autoplay        = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover           = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        
        $sliderNav              = $settings['slider_nav'] == 'true' ? 'true' : 'false';
        $infinite               = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode             = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg                 = $settings['col_lg'];
        $col_md                 = $settings['col_md'];
        $col_sm                 = $settings['col_sm'];
        $col_xs                 = $settings['col_xs'];
        $arrow_default_show_enable = $settings['arrow_default_show_enable'];
        $number_enable_disable = $settings['number_enable_disable'];
        $read_more_hover_based = $settings['read_more_hover_based'];
        $number_separator_text = $settings['number_separator_text'];

        $navigation_dots_number = $settings['navigation_dots_number'];
        $number_line_enable = $settings['number_line_enable'];
        $title_hover_underline = $settings['title_hover_underline'];
        $show_read = $settings['show_read'];
        $dots_style = $settings['dots_style'];

        $number_line_css = '';
        if($number_line_enable == 'yes') {
            $number_line_css = 'number-line';
        }

        if($navigation_dots_number == 'dots') {
            $sliderDots             = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        } else {
            $sliderDots             = $settings['slider_number'] == 'true' ? 'true' : 'false';
        }

        if ( is_rtl() ):
           $rtl= 'true';
        else:
           $rtl= 'false';
        endif;
        

        $unique = rand(2012, 35120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay', 'pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');

        if (empty($settings['service_list'])) {
            return;
        }

        ?>
        
        <?php if ('yes' === $settings['enable_grid_']) { ?>
        <div class="rsaddon-unique-slider rs-unique-grid-services">
            <div class="rs-addon-slider rs-services-slider service-style-<?php echo $services_style; ?> row">
        <?php } else { ?>
            <div class="rsaddon-unique-slider">
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider rs-addon-slider-<?php echo $unique; ?> rs-services-slider <?php echo esc_attr($arrow_default_show_enable); ?>  service-style-<?php echo $services_style; ?> slick-dots-<?php echo $dots_style;?>">
        <?php } ?>

            <?php
                foreach ($settings['service_list'] as $index => $item) :
                    $image        = wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']);
                    $title        = !empty($item['name']) ? $item['name'] : '';
                    $nnumber      = !empty($item['number']) ? $item['number'] : '';
                    $title_tag    = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
                    $description  = !empty($item['description']) ? $item['description'] : '';
                    $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';
                    $link         = !empty($item['link']['url']) ? $item['link']['url'] : '';

                    if ($services_style == '1') {
                        include plugin_dir_path(__FILE__) . "/style1.php";
                    } else {
                        include plugin_dir_path(__FILE__) . "/style2.php";
                    }
                    ?>
                <?php endforeach; ?>
            </div>
            <?php if ('yes' != $settings['enable_grid_']) { ?>
                <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            <?php } ?>
        </div>
        <?php if ('yes' != $settings['enable_grid_']) { ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.rs-addon-slider-<?php echo $unique; ?>').each(function(index) {
                    var slider_id = jQuery(this).attr('id');
                    var slider_conf = jQuery.parseJSON(jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));

                    if (typeof(slider_id) != 'undefined' && slider_id != '') {
                        jQuery('#' + slider_id).not('.slick-initialized').slick({
                            slidesToShow: parseInt(slider_conf.col_lg),
                            centerMode: (slider_conf.centerMode) == "true" ? true : false,
                            dots: (slider_conf.sliderDots) == "true" ? true : false,
                            arrows: (slider_conf.sliderNav) == "true" ? true : false,
                            autoplay: (slider_conf.slider_autoplay) == "true" ? true : false,
                            slidesToScroll: parseInt(slider_conf.slidesToScroll),
                            centerPadding: '15px',
                            autoplaySpeed: parseInt(slider_conf.autoplaySpeed),
                            pauseOnHover: (slider_conf.pauseOnHover) == "true" ? true : false,
                            loop: false,
                           <?php if($navigation_dots_number == 'number') { ?>
                            customPaging: function(slick,index2) {
                                if(index < 10) {
                                    return '<a class="slick-paiging">' + '0' + (index2 + 1) + "<span><?php echo $number_separator_text;?></span>" + '</a>';
                                } else {
                                    return '<a class="slick-paiging">' + (index2 + 1) + "<span><?php echo $number_separator_text;?></span>" + '</a>';
                                }
                            },
                            <?php } ?>
                            rtl: <?php echo $rtl; ?>,
                            responsive: [{
                                    breakpoint: 1200,
                                    settings: {
                                        slidesToShow: parseInt(slider_conf.col_md),
                                    }
                                },
                                {
                                    breakpoint: 992,
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
                                },
                            ]
                        });
                    }

                });
            });
        </script>
<?php
        }
    }
}

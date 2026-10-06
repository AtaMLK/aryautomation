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
use Elementor\POPOVER_TOGGLE;
use Elementor\Icons_Manager;

defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_RS_Testimonial_Slider_Widget extends \Elementor\Widget_Base
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
        return 'rs-testimonial-slider';
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
        return esc_html__('RS Testimonial Slider', 'rsaddon');
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
        return ['testimonial_slider'];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__('Testimonial Item', 'rsaddon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'testimonial_style',
                [
                    'label'   => esc_html__( 'Testimonial Style', 'rsaddon' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [					
                        '1' => esc_html__( 'Style 1', 'rsaddon'),
                        '2' => esc_html__( 'Style 2', 'rsaddon'),
                        '3' => esc_html__( 'Style 3', 'rsaddon'),
                    ],
                ]
            );
            $this->add_control(
                'testimonial_quote_icon',
                [
                    'label' => __( 'Icon', 'rsaddon' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-quote-right',
                        'library' => 'fa-solid',
                    ],
                ]
            );
            $this->add_control(
                'ratings_show',
                [
                    'label' => esc_html__( 'Ratings Show', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'title_show',
                [
                    'label' => esc_html__( 'Title Show', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'company_logo_show',
                [
                    'label' => esc_html__( 'Company Logo Show', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $this->add_control(
                'separator_content',
                [
                    'label' => esc_html__('Separator', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('/', 'rsaddon'),
                    'label_block' => true,
                    'placeholder' => esc_html__('Separator ( / )', 'rsaddon'),
                    'separator'   => 'before',
                    'condition' => [
                        'testimonial_style' => '3'
                    ]
                ]
            );
            $repeater = new Repeater();
            $repeater->add_control(
                'vendor_image',
                [
                    'label' => esc_html__('Vendor Image', 'rsaddon'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $repeater->add_control(
                'name',
                [
                    'label' => esc_html__('Name', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('', 'rsaddon'),
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
                    'default' => esc_html__('', 'rsaddon'),
                    'label_block' => true,
                    'placeholder' => esc_html__('Description', 'rsaddon'),
                    'separator'   => 'before',
                ]
            );
            $repeater->add_control(
                'designation',
                [
                    'label' => esc_html__('Designation', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('', 'rsaddon'),
                    'label_block' => true,
                    'placeholder' => esc_html__('Designation', 'rsaddon'),
                    'separator'   => 'before',
                ]
            );
            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__('Title', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('', 'rsaddon'),
                    'label_block' => true,
                    'placeholder' => esc_html__('Title Here', 'rsaddon'),
                    'separator'   => 'before',
                ]
            );
            $repeater->add_control(
                'ratings',
                [
                    'label' => esc_html__( 'Rating', 'rsaddon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '4.5',
                    'options' => [
                        '1' => esc_html__( '1', 'rsaddon' ),
                        '1.5'  => esc_html__( '1.5', 'rsaddon' ),
                        '2' => esc_html__( '2', 'rsaddon' ),
                        '2.5' => esc_html__( '2.5', 'rsaddon' ),
                        '3' => esc_html__( '3', 'rsaddon' ),
                        '3.5' => esc_html__( '3.5', 'rsaddon' ),
                        '4' => esc_html__( '4', 'rsaddon' ),
                        '4.5' => esc_html__( '4.5', 'rsaddon' ),
                        '5' => esc_html__( '5', 'rsaddon' ),
                    ],
                ]
            );
            $repeater->add_control(
                'company_logo',
                [
                    'label' => esc_html__('Company Logo', 'rsaddon'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'testi_list',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ name }}}',
                    'default' => [
                        [
                            'name' => esc_html__( 'Abdur Rashid', 'rsaddon' ),
                            'description' => esc_html__( "Holly is one of the best content writers I've ever worked with. Her ability to write clearly and help the reader achieve their goals is remarkable.", 'rsaddon' ),
                            'designation' => esc_html__( "Founder & CEO", 'rsaddon' ),
                        ],
                        [
                            'name' => esc_html__( 'Brish Jhonson', 'rsaddon' ),
                            'description' => esc_html__( "Holly is one of the best content writers I've ever worked with. Her ability to write clearly and help the reader achieve their goals is remarkable.", 'rsaddon' ),
                            'designation' => esc_html__( "Web Developer", 'rsaddon' ),
                        ],
                        [
                            'name' => esc_html__( 'Marry Jaen', 'rsaddon' ),
                            'description' => esc_html__( "Holly is one of the best content writers I've ever worked with. Her ability to write clearly and help the reader achieve their goals is remarkable.", 'rsaddon' ),
                            'designation' => esc_html__( "Web Designer", 'rsaddon' ),
                        ],
                        [
                            'name' => esc_html__( 'Alen Walker', 'rsaddon' ),
                            'description' => esc_html__( "Holly is one of the best content writers I've ever worked with. Her ability to write clearly and help the reader achieve their goals is remarkable.", 'rsaddon' ),
                            'designation' => esc_html__( "Manager", 'rsaddon' ),
                        ],
                    ]
                ]
            );
            $this->add_control(
                'right_clip_path_enable',
                [
                    'label' => esc_html__( 'Clip Path Enable?', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'testimonial_style' => '1'
                    ],
                ]
            );
        $this->end_controls_section();

        // Slider Setting Start
        $this->start_controls_section(
			'content_slider',
			[
				'label' => esc_html__('Slider Settings', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
            $this->add_control(
                'col_lg',
                [
                    'label'   => esc_html__('Desktops > 1199px', 'rsaddon'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 3,
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
                'col_lg_2',
                [
                    'label'   => esc_html__('Desktops < 1199px', 'rsaddon'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 3,
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
                    'default' => 3,
                    'options' => [
                        '1' => esc_html__('1 Column', 'rsaddon'),
                        '2' => esc_html__('2 Column', 'rsaddon'),
                        '3' => esc_html__('3 Column', 'rsaddon'),
                        '4' => esc_html__('4 Column', 'rsaddon'),
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
                    'default' => 2,
                    'options' => [
                        '1' => esc_html__('1 Column', 'rsaddon'),
                        '2' => esc_html__('2 Column', 'rsaddon'),
                        '3' => esc_html__('3 Column', 'rsaddon'),
                        '4' => esc_html__('4 Column', 'rsaddon'),
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
                    'default' => 1,
                    'options' => [
                        '1' => esc_html__('1 Column', 'rsaddon'),
                        '2' => esc_html__('2 Column', 'rsaddon'),
                        '3' => esc_html__('3 Column', 'rsaddon'),
                        '4' => esc_html__('4 Column', 'rsaddon'),
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
                    'default' => 2,
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

                ]

            );
            $this->add_control(
                'slider_dots_style',
                [
                    'label'   => esc_html__('Dots Style', 'rsaddon'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'default' => esc_html__('Default', 'rsaddon'),
                        '2' => esc_html__('Style 2', 'rsaddon'),
                    ],
                    'condition' => [
                        'slider_dots' => 'true',
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
                    'default' => 3000,
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
                    'default' => 3000,
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
            $this->add_control(
                'slider_centers_pad_xl',
                [
                    'label'   => esc_html__('Center Mode Padding (XL)', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'separator' => 'before',
                    'condition' => [
                        'slider_centerMode' => 'true',
                    ]
                ]
            );
            $this->add_control(
                'slider_centers_pad_lg',
                [
                    'label'   => esc_html__('Center Mode Padding (LG)', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'separator' => 'before',
                    'condition' => [
                        'slider_centerMode' => 'true',
                    ]
                ]
            );
            $this->add_control(
                'slider_centers_pad_md',
                [
                    'label'   => esc_html__('Center Mode Padding (MD)', 'rsaddon'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'separator' => 'before',
                    'condition' => [
                        'slider_centerMode' => 'true',
                    ]
                ]
            );
            $this->add_responsive_control(
                'item_gap_custom',
                [
                    'label' => esc_html__('Item Gap', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'custom'],
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
                        '{{WRAPPER}} .rs-addon-slider .grid-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'item_gap_custom_margin',
                [
                    'label' => esc_html__('Item Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    ],
                ]
            );
		$this->end_controls_section();
        // Slider Setting End

        // Global Style Start
        $this->start_controls_section(
			'_section_global_style',
			[
				'label' => esc_html__('General Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'display: {{VALUE}};',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'align-items: {{VALUE}};',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'flex-direction: {{VALUE}};',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'justify-content: {{VALUE}};',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner' => 'min-height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            
            $this->start_controls_tabs(
                'g_hover_normal_tabs'
            );
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
                            'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'g_border',
                            'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow',
                            'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner',
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
                            'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner:hover',
                        ]
                    );
                    $this->add_control(
                        'g_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner:hover',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'g_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'g_background_active',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .rs-testimonial-slider .slick-center .testimonial-inner',
                        ]
                    );
                    $this->add_control(
                        'g_border_color_active',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-testimonial-slider .slick-center .testimonial-inner' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'g_box_shadow_active',
                            'selector' => '{{WRAPPER}} .rs-testimonial-slider .slick-center .testimonial-inner',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        // Global Style End

        // Quote Icon Style Start
        $this->start_controls_section(
			'_section_quote_icon_style',
			[
				'label' => esc_html__('Quote Icon Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_responsive_control(
                'quote_font_size',
                [
                    'label' => esc_html__( 'Font Size', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 18,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'quote_color',
                [
                    'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon svg path' => 'fill: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'quote_text_align',
                [
                    'label' => esc_html__( 'Inner Alignment', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'quote_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'width: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_responsive_control(
                'quote_height',
                [
                    'label' => esc_html__( 'Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'quote_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon',
                ]
            );
            $this->add_responsive_control(
                'quote_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'quote_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'quote_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'quote_border',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'quote_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon',
                ]
            );

            $this->add_responsive_control(
                'quote_icon_opacity',
                [
                    'label' => esc_html__( 'Opacity', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'show_label' => true,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1,
                            'step' => 0.1,
                        ],
                    ],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'opacity: {{SIZE}};',                   
                    ],
                ]
            );
            // Quote Icon Position Maker Start
            $this->add_control(
                'quote_icon_position_maker',
                [
                    'label' => esc_html__( 'Position Maker', 'rsaddon' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                ]
            );
            
            $this->start_popover();
                $this->add_responsive_control(
                    'quote_icon_position',
                    [
                        'label' => esc_html__( 'Position', 'rsaddon' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'rsaddon' ),
                            'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
                            'relative'  => esc_html__( 'Relative', 'rsaddon' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'quote_icon_p_top',
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
                            'quote_icon_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'quote_icon_p_right',
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
                            'quote_icon_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'quote_icon_p_bottom',
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
                            'quote_icon_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'quote_icon_p_left',
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
                            'quote_icon_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .quote_icon' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();
            // Quote Icon Position Maker End
            
        $this->end_controls_section();
        // Quote Icon Style End

        // Ratings Icon Style Start
        $this->start_controls_section(
			'_section_rating_style',
			[
				'label' => esc_html__('Rating Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ratings_show' => 'yes'
                ]
			]
		);

            $this->add_control(
                'rating_text_align',
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
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'rating_icon_font_size',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .ratings i',
                ]
            );
            $this->add_control(
                'rating_icon_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_icon_display',
                [
                    'label' => esc_html__( 'Display Style', 'rsaddon' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex' => [
                            'title' => esc_html__( 'Block', 'rsaddon' ),
                            'icon' => 'eicon-post-list',
                        ],
                        'inline-flex' => [
                            'title' => esc_html__( 'Inline Flex', 'rsaddon' ),
                            'icon' => 'eicon-post-list',
                        ],
                    ],
                    'default' => 'flex',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_icon_h_align',
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
                        'rating_icon_display' => ['flex', 'inline-flex'],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_icon_column_align',
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
                        'rating_icon_display' => ['flex', 'inline-flex'],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_icon_vertical_align',
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
                        'rating_icon_display' => ['flex', 'inline-flex'],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_icon_gap_between_icon',
                [
                    'label' => esc_html__( 'Icon Space Between', 'rsaddon' ),
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
                        'rating_icon_display' => ['flex', 'inline-flex'],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'rating_wrapper_control',
                [
                    'label' => esc_html__( 'Wrapper Control', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'rating_wrapper_background',
                    'types' => [ 'classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .ratings',
                ]
            );
            $this->add_responsive_control(
                'rating_wrapper_width',
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
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_wrapper_height',
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
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'rating_wrapper_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'rating_wrapper__border',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .ratings',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'rating_wrapper_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .ratings',
                ]
            );

            // Rating Icon Position Maker Start
            $this->add_control(
                'rating_wrapper_position_maker',
                [
                    'label' => esc_html__( 'Position Maker', 'rsaddon' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                ]
            );
            
            $this->start_popover();
                $this->add_responsive_control(
                    'rating_wrapper_position',
                    [
                        'label' => esc_html__( 'Position', 'rsaddon' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'rsaddon' ),
                            'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
                            'relative'  => esc_html__( 'Relative', 'rsaddon' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'rating_wrapper_p_top',
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
                            'rating_wrapper_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'rating_wrapper_p_right',
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
                            'rating_wrapper_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'rating_wrapper_p_bottom',
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
                            'rating_wrapper_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'rating_wrapper_p_left',
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
                            'rating_wrapper_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .ratings' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();
            // Rating Icon Position Maker End

        $this->end_controls_section();
        // Ratings Icon Style End

        // Vendor Image Style Start
        $this->start_controls_section(
			'_section_vendor_image_style',
			[
				'label' => esc_html__('Vendor Image Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_responsive_control(
                'vendor_img_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img img' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                    ],
                ]
            );
            $this->add_responsive_control(
                'vendor_img_height',
                [
                    'label' => esc_html__( 'Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img img' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_responsive_control(
                'vendor_img_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'vendor_img_wrapper_padding_',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'ivendor_img_wrapper_margin',
                [
                    'label' => esc_html__('Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    ],
                ]
            );
            $this->add_control(
                'vendor_img_wrapper_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper Control', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'vendor_img_wrapper_overflow',
                [
                    'label' => esc_html__( 'Wrapper Overflow', 'rsaddon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'rsaddon' ),
                        'visible' => esc_html__( 'Visible', 'rsaddon' ),
                        'hidden' => esc_html__( 'Hidden', 'rsaddon' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'overflow: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'vendor_img_wrapper_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'width: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_responsive_control(
                'vendor_img_wrapper_height',
                [
                    'label' => esc_html__( 'Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'vendor_img_wrapper_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img',
                ]
            );
            $this->add_responsive_control(
                'vendor_img_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'vendor_img_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'vendor_img_wrapper_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'vendor_img_wrapper_border',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'vendor_img_wrapper_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .vendor-img',
                ]
            );
        $this->end_controls_section();
        // Vendor Image Style End

        // Company Logo Style Start
        $this->start_controls_section(
			'_section_company_logo_style',
			[
				'label' => esc_html__('Company Logo Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'company_logo_show' => 'yes'
                ]
			]
		);
            $this->add_responsive_control(
                'logo_img_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img img' => 'width: {{SIZE}}{{UNIT}}; height: auto;'
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_height',
                [
                    'label' => esc_html__( 'Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img img' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_wrapper_margins',
                [
                    'label' => esc_html__('Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    ],
                ]
            );
            $this->add_control(
                'logo_img_wrapper_ctrl_heading',
                [
                    'label' => esc_html__( 'Wrapper Control', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'logo_img_wrapper_overflow',
                [
                    'label' => esc_html__( 'Wrapper Overflow', 'rsaddon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'rsaddon' ),
                        'visible' => esc_html__( 'Visible', 'rsaddon' ),
                        'hidden' => esc_html__( 'Hidden', 'rsaddon' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'overflow: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_wrapper_width',
                [
                    'label' => esc_html__( 'Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'width: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_wrapper_height',
                [
                    'label' => esc_html__( 'Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'logo_img_wrapper_background',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img',
                ]
            );
            $this->add_responsive_control(
                'logo_img_wrapper_padding__',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_img_wrapper_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'logo_img_wrapper_border',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'logo_img_wrapper_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img',
                ]
            );

             // Quote Icon Position Maker Start
             $this->add_control(
                'clogo_icon_position_maker',
                [
                    'label' => esc_html__( 'Position Maker', 'rsaddon' ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                ]
            );
            
            $this->start_popover();
                $this->add_responsive_control(
                    'clogo_position',
                    [
                        'label' => esc_html__( 'Position', 'rsaddon' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Default', 'rsaddon' ),
                            'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
                            'relative'  => esc_html__( 'Relative', 'rsaddon' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'position: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'clogo_p_top',
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
                            'clogo_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'clogo_p_right',
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
                            'clogo_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'clogo_icon_p_bottom',
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
                            'clogo_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'clogo_icon_p_left',
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
                            'clogo_position' => ['absolute', 'relative']
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .logo-img' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_popover();
            // Quote Icon Position Maker End
        $this->end_controls_section();
        // Company Logo Style End

        // Content Style Start
        $this->start_controls_section(
			'_section_content_inner_style',
			[
				'label' => esc_html__('Content & Wrapper Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                'content_wrapper_text_align',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_display_style',
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
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_vertical_align',
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
                        'content_wrapper_display_style' => 'flex',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_column_align',
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
                        'content_wrapper_display_style' => 'flex',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_box_h_align',
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
                        'content_wrapper_display_style' => 'flex',
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_wrapper_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-card-bottom' => 'gap: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            
            // Name
            $this->add_control(
                'name_ctrl_heading',
                [
                    'label' => esc_html__( 'Name Control', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'name_typography',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .name,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .name',
                ]
            );
            $this->add_control(
                'name_text_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .name,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .name' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'name_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .name,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'name_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .name,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Description
            $this->add_control(
                'description_ctrl_heading',
                [
                    'label' => esc_html__( 'Description Control', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .description',
                ]
            );
            $this->add_control(
                'description_text_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .description' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'description_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'description_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'description_border',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .description',
                ]
             );

            // Designation
            $this->add_control(
                'designation_ctrl_heading',
                [
                    'label' => esc_html__( 'Designation Control', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'designation_typography',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .testi-designation,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .testi-designation',
                ]
            );
            $this->add_control(
                'designation_text_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .testi-designation,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .testi-designation' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'designation_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .testi-designation,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .testi-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'designation_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part .testi-designation,
                        {{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify .testi-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Title & Designation Flex Style 3
            $this->add_control(
                'title_designation_style',
                [
                    'label' => esc_html__( 'Title & Designation Style', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'testimonial_style' => '3'
                    ]
                ]
            );
            $this->add_control(
                'separator_content_show',
                [
                    'label' => esc_html__( 'Separator Show/Hide', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'testimonial_style' => '3'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'separator_content_typography',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-separator',
                    'condition' => [
                        'separator_content_show' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'separator_content_color',
                [
                    'label' => esc_html__( 'Separator Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .testi-separator' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'separator_content_show' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'title_designation_display_style',
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
                    'default' => 'flex',
                    'toggle' => true,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify' => 'display: {{VALUE}};',
                    ],
                    'condition' => [
                        'testimonial_style' => '3'
                    ]
                ]
            );
            $this->add_responsive_control(
                'title_designation_vertical_align',
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
                        'title_designation_display_style' => 'flex',
                        'testimonial_style' => '3'
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_designation_column_align',
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
                        'title_designation_display_style' => 'flex',
                        'testimonial_style' => '3'
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_designation_box_h_align',
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
                        'title_designation_display_style' => 'flex',
                        'testimonial_style' => '3'
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_designation_gap',
                [
                    'label' => esc_html__( 'Gap Between', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .content-part-modify' => 'gap: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        'title_designation_display_style' => 'flex',
                        'testimonial_style' => '3'
                    ]
                ]
            );
        $this->end_controls_section();
        // Content Style End

        // Title Style Start
        $this->start_controls_section(
			'_section_testi_title_style',
			[
				'label' => esc_html__('Title Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .title',
                ]
            );
            $this->add_control(
                'title_text_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-testimonial-slider .testimonial-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // Title Style End

        // Arrow Section Start
		$this->start_controls_section(
			'section_slider_style_arrow_ontrol',
			[
				'label' => esc_html__('Arrow Control', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_nav' => 'true'
				]
			]
		);
            // positioning start
            $this->add_control(
                'arrow_position_maker',
                [
                    'label' => esc_html__('Arrow Position Style', 'rsaddon'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'rsaddon'),
                        'custom' => esc_html__('Custom', 'rsaddon'),
                    ],
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_x_select',
                [
                    'label' => esc_html__('Prev Position X', 'rsaddon'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'rsaddon'),
                        'left' => esc_html__('Left', 'rsaddon'),
                        'right' => esc_html__('Right', 'rsaddon'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_left_position',
                [
                    'label' => esc_html__('Prev Left Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                    'condition' => [
                        'arrow_prev_x_select' => 'left',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_right_position',
                [
                    'label' => esc_html__('Prev Right Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                        '{{WRAPPER}} .rs-addon-slider .slick-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                    ],
                    'condition' => [
                        'arrow_prev_x_select' => 'right',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrow_prev_y_select',
                [
                    'label' => esc_html__('Prev Position Y', 'rsaddon'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'rsaddon'),
                        'top' => esc_html__('Top', 'rsaddon'),
                        'bottom' => esc_html__('Bottom', 'rsaddon'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_top_position',
                [
                    'label' => esc_html__('Prev Top Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                    'condition' => [
                        'arrow_prev_y_select' => 'top',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_prev_bottom_position',
                [
                    'label' => esc_html__('Prev Bottom Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                    'condition' => [
                        'arrow_prev_y_select' => 'bottom',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrow_next_x_select',
                [
                    'label' => esc_html__('Next Position X', 'rsaddon'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'rsaddon'),
                        'left' => esc_html__('Left', 'rsaddon'),
                        'right' => esc_html__('Right', 'rsaddon'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_left_position',
                [
                    'label' => esc_html__('Next Left Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                    'condition' => [
                        'arrow_next_x_select' => 'left',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_right_position',
                [
                    'label' => esc_html__('Next Right Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                    'condition' => [
                        'arrow_next_x_select' => 'right',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrow_next_y_select',
                [
                    'label' => esc_html__('Next Position Y', 'rsaddon'),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'rsaddon'),
                        'top' => esc_html__('Top', 'rsaddon'),
                        'bottom' => esc_html__('Bottom', 'rsaddon'),
                    ],
                    'condition' => [
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_top_position',
                [
                    'label' => esc_html__('Next Top Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                    'condition' => [
                        'arrow_next_y_select' => 'top',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            $this->add_responsive_control(
                'arrow_next_bottom_position',
                [
                    'label' => esc_html__('Next Bottom Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'custom'],
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
                    'condition' => [
                        'arrow_next_y_select' => 'bottom',
                        'arrow_position_maker' => 'custom'
                    ]
                ]
            );
            // positioning end

            $this->add_control(
                'arrow_after_hr',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );

            $this->add_responsive_control(
                'navigation_arrow_width',
                [
                    'label' => esc_html__('Arrow Width', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-prev,
                        {{WRAPPER}} .rs-addon-slider .slick-next' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'navigation_arrow_height',
                [
                    'label' => esc_html__('Arrow Height', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-prev,
                        {{WRAPPER}} .rs-addon-slider .slick-next' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'navigation_arrow_line_height',
                [
                    'label' => esc_html__('Arrow Line Height', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-prev,
                        {{WRAPPER}} .rs-addon-slider .slick-next' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'nav_icon_typography',
                    'label' => esc_html__('Icon Typography', 'rsaddon'),
                    'selector' => '
                        {{WRAPPER}} .rs-addon-slider .slick-prev::before,
                        {{WRAPPER}} .rs-addon-slider .slick-next::before
                    ',
                ]
            );

            $this->add_control(
                'arrow_border_radius_',
                [
                    'label' => esc_html__('Border Radius', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-prev,
                        {{WRAPPER}} .rs-addon-slider .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'arrow_border_padding_',
                [
                    'label' => esc_html__('Padding', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-prev,
                        {{WRAPPER}} .rs-addon-slider .slick-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Arrow Hover Normal Tab Start
            $this->start_controls_tabs('_tabs_slider_arrow');
                // Normal Bullet Start
                $this->start_controls_tab(
                    'slider_arrow_normal_tab',
                    [
                        'label' => esc_html__('Normal', 'rsaddon'),
                    ]
                );
                    $this->add_control(
                        'navigation_arrow_color',
                        [
                            'label' => esc_html__('Icon Color', 'rsaddon'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-prev::before,
                                {{WRAPPER}} .rs-addon-slider .slick-next::before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'navigation_arrow_background',
                            'types' => ['classic', 'gradient'],
                            'selector' => '
                                {{WRAPPER}} .rs-addon-slider .slick-prev,
                                {{WRAPPER}} .rs-addon-slider .slick-next
                            ',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'nav_arrow_border',
                            'selector' => '
                                {{WRAPPER}} .rs-addon-slider .slick-prev,
                                {{WRAPPER}} .rs-addon-slider .slick-next
                            ',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'arrow_shadow_custom',
                            'selector' => '
                                {{WRAPPER}} .rs-addon-slider .slick-prev,
                                {{WRAPPER}} .rs-addon-slider .slick-next
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'arrow_opacity',
                        [
                            'label' => esc_html__('Opacity', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-arrow' => 'opacity: {{SIZE}}',
                            ]
                        ]
                    );
                $this->end_controls_tab();

                // Hover Bullet Start
                $this->start_controls_tab(
                    'slider_arrow_hover_tab',
                    [
                        'label' => esc_html__('Hover', 'rsaddon'),
                    ]
                );
                    $this->add_control(
                        'navigation_arrow_color_hover',
                        [
                            'label' => esc_html__('Icon Color', 'rsaddon'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-prev:hover::before,
                                {{WRAPPER}} .rs-addon-slider .slick-next:hover::before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'navigation_arrow_background_hover',
                            'types' => ['classic', 'gradient'],
                            'selector' => '
                                {{WRAPPER}} .rs-addon-slider .slick-prev:hover,
                                {{WRAPPER}} .rs-addon-slider .slick-next:hover
                            ',
                        ]
                    );
                    $this->add_control(
                        'nav_arrow_border_hover',
                        [
                            'label' => esc_html__('Border Color', 'rsaddon'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-prev:hover,
                                {{WRAPPER}} .rs-addon-slider .slick-next:hover' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'arrow_opacity_hover',
                        [
                            'label' => esc_html__('Opacity', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider:hover .slick-arrow' => 'opacity: {{SIZE}}',
                            ]
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
            // Arrow Hover Normal Tab End
		$this->end_controls_section();
		// Arrow Style End

		// Bullet Style Start
		$this->start_controls_section(
			'section_slider_style_dots_ontrol',
			[
				'label' => esc_html__('Dots Control', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_dots' => 'true'
				]
			]
		);
            $this->add_responsive_control(
                'dots_alignments',
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
                        '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}}'
                    ],
                ]
            );
            $this->add_control(
                'bullet_wrapper_box_style',
                [
                    'label' => esc_html__('Dots Wrapper Box', 'rsaddon'),
                    'type' => Controls_Manager::HEADING,
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'bullet_wrapper_box_bg',
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots',
                ]
            );
            $this->add_responsive_control(
                'bullet_wrapper_box_padding',
                [
                    'label' => esc_html__('Padding', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_wrapper_box_margin',
                [
                    'label' => esc_html__('Margin', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_wrapper_box_radius',
                [
                    'label' => esc_html__('Border Radius', 'rsaddon'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                '_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                    'style' => 'thick',
                ]
            );
            $this->add_control(
                'bullet_item_options',
                [
                    'label' => esc_html__('Bullet Item Style', 'rsaddon'),
                    'type' => Controls_Manager::HEADING,
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
                        'navigation_dot_inner_color',
                        [
                            'label' => esc_html__('Inner Dot Color', 'rsaddon'),
                            'type' => Controls_Manager::COLOR,
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'background: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_height_custom',
                        [
                            'label' => esc_html__('Inner Dot Height', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_normal_width_custom',
                        [
                            'label' => esc_html__('Inner Dot Width', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_border_radius',
                        [
                            'label' => esc_html__('Inner Dot Radius', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'border-radius: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'navigation_dot_icon_background',
                            'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button',
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
                            ],
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
                            ],
                        ]
                    );
                    $this->add_control(
                        'bullet_border_radius_custom',
                        [
                            'label' => esc_html__('Border Radius', 'rsaddon'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'bullet_border_custom',
                            'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'bullet_shadow_custom',
                            'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button'
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
                        'navigation_dot_inner_color_active',
                        [
                            'label' => esc_html__('Inner Dot Color', 'rsaddon'),
                            'type' => Controls_Manager::COLOR,
                            'condition' => [
                                'slider_dots_style' => '2',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
                                {{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'background: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_height_custom_active',
                        [
                            'label' => esc_html__('Inner Dot Height', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
                                {{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_inner_dot_active_width_custom',
                        [
                            'label' => esc_html__('Inner Dot Width', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
                                {{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'navigation_dot_icon_background_active',
                            'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover, {{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button',
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_active_width_custom',
                        [
                            'label' => esc_html__('Bullet Width', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_active_height_custom',
                        [
                            'label' => esc_html__('Bullet Height', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'bullet_active_scale_custom',
                        [
                            'label' => esc_html__('Bullet Scale', 'rsaddon'),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'transform: scale({{SIZE}})',
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
                                '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'border-color: {{VALUE}};',

                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
            // Active Bullet End
            $this->add_responsive_control(
                'bullet_spacing_custom',
                [
                    'label' => esc_html__('Top Gap', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'show_label' => true,
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 25,
                    ],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_spacing_custom_position',
                [
                    'label' => esc_html__('Top Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'show_label' => true,
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'top: {{SIZE}}{{UNIT}}; bottom:unset;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'bullet_spacing_custom_position_bottom',
                [
                    'label' => esc_html__('Bottom Position', 'rsaddon'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'show_label' => true,
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
                    ],
                ]
            );
		$this->end_controls_section();
		// Bullet Style End

    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

		$slidesToShow          = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
		$autoplaySpeed         = $settings['slider_autoplay_speed'];
		$interval              = $settings['slider_interval'];
		$slidesToScroll        = $settings['slides_ToScroll'];
		$slider_autoplay       = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
		$pauseOnHover          = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
		$sliderDots            = $settings['slider_dots'] == 'true' ? 'true' : 'false';
		$sliderNav             = $settings['slider_nav'] == 'true' ? 'true' : 'false';
		$infinite              = $settings['slider_loop'] === 'true' ? 'true' : 'false';
		$centerMode            = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
		$col_lg                = $settings['col_lg'];
		$col_md                = $settings['col_md'];
		$col_sm                = $settings['col_sm'];
		$col_xs                = $settings['col_xs'];
		$col_lg_2                = $settings['col_lg_2'];
		$slider_centers_pad_xl = !empty($settings['slider_centers_pad_xl']) ? $settings['slider_centers_pad_xl'] : '400px';
		$slider_centers_pad_lg = !empty($settings['slider_centers_pad_lg']) ? $settings['slider_centers_pad_lg'] : '250px';
		$slider_centers_pad_md = !empty($settings['slider_centers_pad_md']) ? $settings['slider_centers_pad_md'] : '100px';

        if ( is_rtl() ):
           $rtl= 'true';
        else:
           $rtl= 'false';
        endif;


        $unique = rand(2012, 35120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay', 'pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs', 'slider_centers_pad_xl', 'slider_centers_pad_lg', 'slider_centers_pad_md', 'col_lg_2');

        if (empty($settings['testi_list'])) {
            return;
        }
        $clip_path_enable = $settings['right_clip_path_enable'];
?>

    <div class="rsaddon-unique-slider">
        <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="addon-slider-<?php echo esc_attr($unique); ?> rs-addon-slider rs-testimonial-slider style<?php echo esc_attr($settings['testimonial_style']); ?> slick-dots-<?php echo esc_attr($settings['slider_dots_style']); ?> <?php if($clip_path_enable == 'yes') echo 'clip-path-css';?>">
            <?php
            foreach ($settings['testi_list'] as $index => $item) :
                $vendor_image         =  wp_get_attachment_image_url( $item['vendor_image']['id'],'full' );
                $company_logo         =  wp_get_attachment_image_url( $item['company_logo']['id'],'full' );
                $name                 = !empty($item['name']) ? $item['name'] : '';
                $title                = !empty($item['title']) ? $item['title'] : '';
                $description          = !empty($item['description']) ? $item['description'] : '';
                $designation          = !empty($item['designation']) ? $item['designation'] : '';

                // Rating Start
                if ($settings['ratings_show'] == 'yes') {
                    $ratings = $item['ratings'];
                    $ratingstars = '';
                    $fullStars = floor($ratings);
                    $halfStar = ($ratings - $fullStars) == 0.5;
                    for ($i = 1; $i <= 5; $i++) {
                        $class = ($i <= $fullStars) ? 'ri-star-fill' : 'ri-star-line';
                        
                        if ($i == $fullStars + 1 && $halfStar) {
                            $class = 'ri-star-half-line';
                        }
                        $ratingstars .= '<i class="' . $class . '"></i>';
                    }
                }
                // Rating End
                ?>

                <?php
                    if ('3' == $settings['testimonial_style']) {
                        include plugin_dir_path(__FILE__) . "/style3.php";
                    } elseif ('2' == $settings['testimonial_style']) {
                        include plugin_dir_path(__FILE__) . "/style2.php";
                    } else {
                        include plugin_dir_path(__FILE__) . "/style1.php";
                    }
                ?>

            <?php endforeach; ?>
        </div>
        <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.addon-slider-<?php echo esc_attr($unique); ?>').each(function(index) {
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
                        centerPadding: slider_conf.slider_centers_pad_xl,
                        autoplaySpeed: parseInt(slider_conf.autoplaySpeed),
                        pauseOnHover: (slider_conf.pauseOnHover) == "true" ? true : false,
                        infinite: (slider_conf.infinite) == "true" ? true : false,
                        rtl: <?php echo $rtl; ?>,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: parseInt(slider_conf.col_md),
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 1199,
                                settings: {
                                    slidesToShow: parseInt(slider_conf.col_lg_2),
                                    centerPadding: slider_conf.slider_centers_pad_xl,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: parseInt(slider_conf.col_sm),
                                    slidesToScroll: 1,
                                    centerPadding: slider_conf.slider_centers_pad_lg,
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: false,
                                    slidesToShow: parseInt(slider_conf.col_xs),
                                    slidesToScroll: 1,
                                    centerPadding: slider_conf.slider_centers_pad_md,
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 1,
                                    arrows: false,
                                    slidesToScroll: 1,
                                    centerPadding: '0px',
                                }
                            }
                        ]
                    });
                }

            });

            // Check if the slider element exists

        });
    </script>
<?php
    }
}




<?php

/**
 * Tab widget class
 *
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;


defined('ABSPATH') || die();
class Rsaddon_Pro_Advance_Tab_Widget extends \Elementor\Widget_Base
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
        return 'rs-tab-advanced';
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
        return esc_html__('RS Advance Tab', 'rsaddon');
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
        return ['tab', 'vertical', 'icon', 'horizental'];
    }

    protected function register_controls()
    {
        $category_dropdown[0] = 'Select Template';
        $best_wp = new wp_Query(array(
            'post_type'      => 'rselements_pro',
            'posts_per_page' => -1

        ));

        while ($best_wp->have_posts()) : $best_wp->the_post();

            $title = get_the_title();
            $id = get_the_ID();
            $category_dropdown[$id] = $title;

        endwhile;
        wp_reset_query();


        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__('Tabs', 'rsaddon'),
            ]
        );

        $this->add_control(
            'tab_style',
            [
                'label' => esc_html__('Layout Style', 'prelements'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Style 1', 'prelements'),
                    '2' => esc_html__('Style 2', 'prelements'),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__('Title & Description', 'rsaddon'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Tab Title', 'rsaddon'),
                'placeholder' => esc_html__('Tab Title', 'rsaddon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon_type_enroll',
            [
                'label' => esc_html__('Selct Icon Type', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__('Normal', 'rsaddon'),
                    'svg' => esc_html__('Svg', 'rsaddon'),
                    'image' => esc_html__('Image', 'rsaddon'),
                ],
            ]
        );

        $repeater->add_control(
            'tab_icon',
            [
                'label'       => esc_html__('Title Icon', 'rsaddon'),
                'label_block' => true,
                'type'        => Controls_Manager::ICON,
                'options'     => rsaddon_pro_get_icons(),
                'condition'   => [
                    'icon_type_enroll' => 'normal'
                ]
            ]
        );

        $repeater->add_control(
            'tab_icon_svg',
            [
                'label' => __('Title Svg Icons', 'prelements'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => '',
                ],
                'condition' => [
                    'icon_type_enroll' => 'svg'
                ],
            ]
        );

        $repeater->add_control(
            'selected_image_title',
            [
                'label'       => esc_html__('Title Image (Ex:Content Title)', 'rsaddon'),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition' => [
                    'icon_type_enroll' => 'image'
                ],
            ]
        );


        $repeater->add_control(
            'tab_content_title',
            [
                'label'       => esc_html__('Title', 'rsaddon'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Title', 'rsaddon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label'       => esc_html__('Content', 'rsaddon'),
                'default'     => esc_html__('Tab Content', 'rsaddon'),
                'placeholder' => esc_html__('Tab Content', 'rsaddon'),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'tab_list_content',
            [
                'label'       => esc_html__('List Content', 'rsaddon'),
                'type'        => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'selected_imagetab',
            [
                'label'       => esc_html__('Content Image', 'rsaddon'),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tab_content_btn',
            [
                'label'       => esc_html__( 'Button', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
			'tab_content_btn_link',
			[
				'label'       => esc_html__(' Button Link', 'rsaddon'),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
                'default' => [
					'url' => '#',
				],
			]
		);

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__('Tabs Items', 'rsaddon'),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title'   => esc_html__('Tab #1', 'rsaddon'),
                        'tab_content' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon'),
                    ],
                    [
                        'tab_title'   => esc_html__('Tab #2', 'rsaddon'),
                        'tab_content' => esc_html__('Ohh your data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon'),
                    ],

                    [
                        'tab_title'   => esc_html__('Tab #3', 'rsaddon'),
                        'tab_content' => esc_html__('You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
			'show_content_btn_icon',
			[
				'label' => esc_html__( 'Content Button Icon', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'separator' => 'before',
			]
		);
        $this->add_control(
			'content_btn_icon',
			[
				'label' => __('Button Icon', 'rsaddon'),
				'type' => Controls_Manager::ICONS,
				'default' => [
                    'value' => 'ri-arrow-right-line',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'show_content_btn_icon' => 'yes'
                ]
			]
		);
        $this->add_responsive_control(
			'content_btn_icon_size',
			[
				'label' => esc_html__('Icon Size', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a em' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'show_content_btn_icon' => 'yes'
                ]
			]
		);
        $this->add_responsive_control(
			'content_btn_icon_posi',
			[
				'label' => esc_html__('Top', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a em' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'show_content_btn_icon' => 'yes'
                ]
			]
		);
        $this->add_responsive_control(
            'icon_reverse',
            [
                'label' => esc_html__( 'Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-nowrap',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-wrap',
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'show_content_btn_icon' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'content_btn_space_between',
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
                    '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_content_btn_icon' => 'yes'
                ]
            ]
        );
        

        $this->add_control(
            'view',
            [
                'label'   => esc_html__('View', 'rsaddon'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'auto_switch',
			[
				'label' => esc_html__( 'Auto Switch Tab', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
                'separator' => 'before'
			]
		);
        $this->add_control(
			'switching_duration',
			[
				'label' => esc_html__( 'Switching Duration', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '5000', 'rsaddon' ),
				'placeholder' => esc_html__( '5000', 'rsaddon' ),
                'condition' => [
                    'auto_switch' => 'yes'
                ]
			]
		);

        $this->add_control(
			'count_number',
			[
				'label' => esc_html__( 'Count Number', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
                'separator' => 'before'
			]
		);

        $this->add_control(
            'tabs_item_width',
            [
                'label' => esc_html__('Tab Menu Item Full', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'full_tab_item',
                'options' => [
                    'full_tab_item' => esc_html__('Yes', 'rsaddon'),
                    'no_item_menu' => esc_html__('No', 'rsaddon'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'menu_item_alignment',
            [
                'label' => esc_html__('Menu Alignment', 'rsaddon'),
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
                    '{{WRAPPER}} .rstab-main.no_item_menu' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'tabs_item_width' => 'no_item_menu',
                ],
            ]
        );

        $this->add_responsive_control(
            'type',
            [
                'label' => esc_html__('Type', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'rsaddon'),
                    'vertical' => esc_html__('Vertical', 'rsaddon'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'type_vertical_align',
            [
                'label' => esc_html__('Vertical Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rsaddon'),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
                'condition' => [
                    'type' => 'vertical',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.vertical' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
			'clip_path_img',
			[
				'label' => esc_html__('Clip Path ON/OFF?', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->end_controls_section();

        //start title styling

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => esc_html__('Top Menu', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'all_menu_wrapper_control',
            [
                'label' => esc_html__('Menu Wrapper Settings', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'type' => 'horizontal',
                ],
            ]
        );

        $this->add_responsive_control(
            'all_menu_wrapper_view_style',
            [
                'label' => esc_html__('View Style (Inline / Block)', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__('Inline', 'rsaddon'),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__('Block', 'rsaddon'),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
                'condition' => [
                    'type' => 'horizontal',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'display: {{VALUE}}; flex-wrap: wrap;',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_wrapper_v_align',
            [
                'label' => esc_html__('Vertical Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rsaddon'),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
                'default' => 'start',
                'condition' => [
                    'all_menu_wrapper_view_style' => 'flex',
                    'type' => 'horizontal',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_wrapper_flex_direction',
            [
                'label' => esc_html__('Column Direction', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'rsaddon'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Row Reverse', 'rsaddon'),
                        'icon' => 'eicon-wrap',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'rsaddon'),
                        'icon' => 'eicon-justify-start-v',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Column Reverse', 'rsaddon'),
                        'icon' => 'eicon-wrap',
                    ],
                ],
                'default' => 'row',
                'condition' => [
                    'all_menu_wrapper_view_style' => 'flex',
                    'type' => 'horizontal',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_wrapper_h_align',
            [
                'label' => esc_html__('Horizontal Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'rsaddon'),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Space Between', 'rsaddon'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
                'default' => 'flex-start',
                'condition' => [
                    'all_menu_wrapper_view_style' => 'flex',
                    'all_menu_wrapper_flex_direction' => ['row', 'row-reverse'],
                    'type' => 'horizontal',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'type' => 'horizontal',
                ],
            ]
        );
        $this->add_control(
            'all_menu_border_heading',
            [
                'label' => esc_html__('Menu Wrapper Border', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'menu_wrapper_width',
            [
                'label' => esc_html__('Menu Wrapper Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'all_menu_border',
                'selector' => '{{WRAPPER}} .nav-tabs',
            ]
        );

        $this->add_responsive_control(
            'menu_wrapper_border_radius',
            [
                'label' => esc_html__('Menu Wrapper Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_wrapper_background_color',
            [
                'label' => esc_html__('Wrapper Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper, {{WRAPPER}} .accordion-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // Menu Wrapper Settings End

        $this->add_control(
            'menu_items_settings',
            [
                'label' => esc_html__('Menu Items Settings', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'type' => 'horizontal',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'menu_item_width',
            [
                'label' => esc_html__('Menu Items Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs .nav-link' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'horizontal',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link',
            ]
        );

        $this->add_responsive_control(
            'navigation_area_width',
            [
                'label' => esc_html__('Navigation Area Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
                'condition' => [
                    'type' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_width',
            [
                'label' => esc_html__('Navigation Item Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
                'condition' => [
                    'type' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_spacing_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_spacing_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_spacing_margin_last_child',
            [
                'label' => esc_html__('Margin (Last Child)', 'rsaddon'),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [],
                ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_title_spacing_margin_heading',
            [
                'label' => esc_html__(' Header (h1) Margin', 'rsaddon'),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [],
                ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .accordion-item .accordion-headerd' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'tab_icon_bg_border',
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link'
            ]
        );

        $this->add_control(
            'after_border_tab_menu',
            [
                'label' => esc_html__('Before Border', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('Normal', 'rsaddon'),
                    'all-menu-after-border' => esc_html__('Before Border Middle/Top', 'rsaddon'),
                ],
            ]
        );
        $this->add_responsive_control(
            'before_after_line_height',
            [
                'label' => esc_html__('Before Border Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs.all-menu-after-border .nav-link:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['after_border_tab_menu' => 'all-menu-after-border']
            ]
        );
        $this->add_responsive_control(
            'afterbefr_border_color',
            [
                'label' => esc_html__('Before Middle Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs.menu-after-border .nav-link:not(.active):before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs.all-menu-after-border .nav-link:before' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs.all-menu-after-border:after' => 'background: {{VALUE}}',
                ],
                'condition' => ['after_border_tab_menu' => 'all-menu-after-border']
            ]
        );

        $this->add_responsive_control(
            'after_top_border_color',
            [
                'label' => esc_html__('Before Top Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs.all-menu-after-border .nav-link.active:after' => 'background: {{VALUE}}',
                ],
                'condition' => ['after_border_tab_menu' => 'all-menu-after-border']
            ]
        );

        $this->add_responsive_control(
            'bottom_border_width',
            [
                'label' => esc_html__('Bottom Border Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs.all-menu-after-border .nav-link:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['after_border_tab_menu' => 'all-menu-after-border']
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link'
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Title Alignment', 'rsaddon'),
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
                    'flex-end' => [
                        'title' => esc_html__('Right', 'rsaddon'),
                        'icon' => 'eicon-text-align-right',
                    ],

                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs' => 'align-items: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs' => 'justify-content: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'tab_bubble_position_vertical',
            [
                'label' => esc_html__('Bubble Position Vertical', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active:after' => 'top: {{SIZE}}%;',
                ],

                'condition' => [
                    'tab_design' => 'bubble',
                    'type' => 'vertical'
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_icon_text_v_align',
            [
                'label' => esc_html__('Icon/Text Vertical Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rsaddon'),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'display: inline-flex; align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_icon_text_x_align',
            [
                'label' => esc_html__('Icon/Text Horizontal Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rsaddon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'start',
                'condition' => [
                    'menu_icon_text_v_align' => ['flex-start', 'center', 'flex-end'],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        // Bubble Arrow Style Start
        $this->add_control(
            'tab_bottom_arrow_design_hedding',
            [
                'label' => esc_html__('Tab Bottom Arrow', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'type' => 'horizontal',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'tab_bottom_arrow_color',
            [
                'label' => esc_html__('Arrow Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'type' => 'horizontal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after, {{WRAPPER}} .accordion-menu-wrapper .nav-link.accordion-button:not(.collapsed):before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_bottom_arrow_color_hover',
            [
                'label' => esc_html__('Arrow Color (Hover)', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'type' => 'horizontal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:hover:after' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_bottom_arrow_design',
            [
                'label' => esc_html__('Arrow ( Show / Hide)', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'unset' => [
                        'title' => esc_html__('Show', 'rsaddon'),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__('Hide', 'rsaddon'),
                        'icon' => 'eicon-close',
                    ],
                ],
                'toggle' => true,
                'condition' => [
                    'type' => 'horizontal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'display: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_bottom_arrow_size',
            [
                'label' => esc_html__('Arrow Size', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'font-size: {{SIZE}}px;',
                ],
                'condition' => [
                    'tab_bottom_arrow_design' => 'unset',
                    'type' => 'horizontal',
                ]
            ]
        );
        $this->add_responsive_control(
            'tab_bottom_arrow_position_y',
            [
                'label' => esc_html__('Position Y (Top)', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -150,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'top: calc(100% + {{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'tab_bottom_arrow_design' => 'unset',
                    'type' => 'horizontal',
                ]
            ]
        );
        $this->add_responsive_control(
            'tab_bottom_arrow_position_x',
            [
                'label' => esc_html__('Position X (Left)', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'custom'],
                'range' => [
                    '%' => [
                        'min' => -150,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'transform: translateX(-{{SIZE}}{{UNIT}}); left: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'tab_bottom_arrow_design' => 'unset',
                    'type' => 'horizontal',
                ]
            ]
        );
        // Bubble Arrow Style End

        
        $this->add_control(
            'all_menu_inner_wrapper_control',
            [
                'label' => esc_html__('Menu Inner Settings', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_view_style',
            [
                'label' => esc_html__('View Style (Inline / Block)', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__('Inline', 'rsaddon'),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__('Block', 'rsaddon'),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'display: {{VALUE}}; flex-wrap: wrap;',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_v_align',
            [
                'label' => esc_html__('Vertical Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rsaddon'),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
                'default' => 'start',
                'condition' => [
                    'all_menu_inner_wrapper_view_style' => 'flex',
                    'menu_icon_show_hide' => 'unset'
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_flex_direction',
            [
                'label' => esc_html__('Column Direction', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'rsaddon'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Row Reverse', 'rsaddon'),
                        'icon' => 'eicon-wrap',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'rsaddon'),
                        'icon' => 'eicon-justify-start-v',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Column Reverse', 'rsaddon'),
                        'icon' => 'eicon-wrap',
                    ],
                ],
                'default' => 'row',
                'condition' => [
                    'all_menu_inner_wrapper_view_style' => 'flex',
                    'menu_icon_show_hide' => 'unset'
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_h_align',
            [
                'label' => esc_html__('Horizontal Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'rsaddon'),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Space Between', 'rsaddon'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
                'default' => 'start',
                'condition' => [
                    'all_menu_inner_wrapper_view_style' => 'flex',
                    'all_menu_inner_wrapper_flex_direction' => ['row', 'row-reverse'],
                    'menu_icon_show_hide' => 'unset'
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_t_align',
            [
                'label' => esc_html__('Text Alignment', 'rsaddon'),
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
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        // Button Icon Style End

        $this->add_control(
            'count_number_style_heading',
            [
                'label' => esc_html__( 'Count Number Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'count_number' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'count_number_typography',
				'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link span.count_number',
                'condition' => [
                    'count_number' => 'yes'
                ]
			]
		);
        $this->add_control(
			'count_number_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link span.count_number' => 'color: {{VALUE}}',
				],
                'condition' => [
                    'count_number' => 'yes'
                ]
			]
		);
        $this->add_control(
			'count_number_color_hover',
			[
				'label' => esc_html__( 'Color ( Hover )', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover span.count_number' => 'color: {{VALUE}}',
				],
                'condition' => [
                    'count_number' => 'yes'
                ]
			]
		);
        $this->add_control(
			'count_number_color_active',
			[
				'label' => esc_html__( 'Color ( Active )', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active span.count_number' => 'color: {{VALUE}}',
				],
                'condition' => [
                    'count_number' => 'yes'
                ]
			]
		);

        // Count Number Position Maker Start
        $this->add_control(
            'count_num_position_maker',
            [
                'label' => esc_html__( 'Number Position Maker', 'rsaddon' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'Default', 'rsaddon' ),
                'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'count_number' => 'yes'
                ]
            ]
        );
        
        $this->start_popover();
            $this->add_responsive_control(
                'count_num_position',
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
                        '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link span.count_number' => 'position: {{VALUE}};',
                    ],
                    'condition' => [
                        'count_number' => 'yes'
                    ]
                ]
            );
            $this->add_responsive_control(
                'count_num_p_top',
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
                        'count_num_position' => ['absolute', 'relative']
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link span.count_number' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'count_num_p_right',
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
                        'count_num_position' => ['absolute', 'relative']
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link span.count_number' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'count_num_p_bottom',
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
                        'count_num_position' => ['absolute', 'relative']
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link span.count_number' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'count_num_p_left',
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
                        'count_num_position' => ['absolute', 'relative']
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link span.count_number' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_popover();
        // Count Number Position Maker End

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->start_controls_tabs('_tabs_title_icon');

        $this->start_controls_tab(
            'tab_icon_bg_normal_tab',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );

        $this->add_responsive_control(
            'tab_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ti_menu_background_color',
            [
                'label' => esc_html__('Title Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tmenu_background_full',
            [
                'label' => esc_html__('Title Area Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_title_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'normal_tab_border',
                'selector' => '{{WRAPPER}} .rstab-main .nav-tabs .nav-link, {{WRAPPER}} .accordion-menu-wrapper .nav-tabs .nav-link',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_bg_hover_tab_hover',
            [
                'label' => esc_html__('Hover', 'rsaddon'),
            ]
        );
        $this->add_responsive_control(
            'tab_active_color_hover',
            [
                'label' => esc_html__('Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active), {{WRAPPER}} .accordion-menu-wrapper .nav-tabs .nav-link:hover:not(.show)' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'ti_hover_menu_background_color',
            [
                'label' => esc_html__('Title Hover Bg Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active), {{WRAPPER}} .accordion-menu-wrapper .nav-tabs .nav-link:hover:not(.show)' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_title_area_padding_hover',
            [
                'label' => esc_html__('Title Area Padding (Hover)', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_icon_color_hover',
            [
                'label' => esc_html__('Icon Color (Hover)', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active) i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active) svg path' => 'fill: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'tab_title_hover_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'hover_tab_border',
                'selector' => '{{WRAPPER}} .rstab-main .nav-tabs .nav-link:hover, {{WRAPPER}} .accordion-menu-wrapper .nav-tabs .nav-link:hover',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_bg_hover_tab',
            [
                'label' => esc_html__('Active', 'rsaddon'),
            ]
        );

        $this->add_responsive_control(
            'tab_active_color',
            [
                'label' => esc_html__('Active Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link.active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-menu-wrapper .nav-link.accordion-button:not(.collapsed)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-menu-wrapper .nav-link.accordion-button.collapsed.show' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ti_active_menu_background_color',
            [
                'label' => esc_html__('Title Active Bg Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link.active' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-menu-wrapper .nav-link.accordion-button:not(.collapsed)' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-menu-wrapper .nav-link.accordion-button.collapsed.show' => 'background-color: {{VALUE}};',
                    
                    '{{WRAPPER}} .accordion-menu-wrapper .nav-tabs .nav-link.accordion-button:not(.collapsed):before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_area_padding_active',
            [
                'label' => esc_html__('Title Area Padding (Active)', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'menu_icon_color_active',
            [
                'label' => esc_html__('Icon Color (Active)', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active svg path' => 'fill: {{VALUE}}',
                ]
            ]
        );
        $this->add_responsive_control(
            'tab_active_title_border_radius',
            [
                'label' => esc_html__('Active Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'active_tab_border',
                'selector' => '
                    {{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link.active,
                    {{WRAPPER}} .accordion-menu-wrapper .nav-link.accordion-button:not(.collapsed),
                    {{WRAPPER}} .accordion-menu-wrapper .nav-link.accordion-button.collapsed.show
                ',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Progress Style Start
        $this->start_controls_section(
            'section_tabs_progress_style',
            [
                'label' => esc_html__('Progress Bar', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'auto_switch' => 'yes'
                ]
            ]
        );
            $this->add_control(
                'progresse_bar_color',
                [
                    'label' => esc_html__( 'Bar Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rstab-main.auto_switch_yes .tab-menu-wrapper .nav-tabs .nav-link:before' => 'background: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'progresse_bar_height',
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
                        '{{WRAPPER}} .rstab-main.auto_switch_yes .tab-menu-wrapper .nav-tabs .nav-link:before' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'progresse_bar_p_top',
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
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rstab-main.auto_switch_yes .tab-menu-wrapper .nav-tabs .nav-link:before' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'progresse_bar_p_bottom',
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
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rstab-main.auto_switch_yes .tab-menu-wrapper .nav-tabs .nav-link:before' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
                    ],
                ]
            );
        $this->end_controls_section();
        // Progress Style End
        

        $this->start_controls_section(
            'section_menu_nav_icon',
            [
                'label' => esc_html__('Nav Icon', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'menu_icon_show_hide',
            [
                'label' => esc_html__('Menu Icon ( Show / Hide)', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'unset' => [
                        'title' => esc_html__('Show', 'rsaddon'),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__('Hide', 'rsaddon'),
                        'icon' => 'eicon-close',
                    ],
                ],
                'default' => 'unset',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs .nav-link i, {{WRAPPER}} .nav-tabs .nav-link svg' => 'display: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'menu_icon_color',
            [
                'label' => esc_html__('Icon Color (Normal)', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg path' => 'fill: {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_icon_typography',
                'label' => esc_html__('Icon Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i',
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
            ]
        );
        $this->add_responsive_control(
            'svg_icon_size',
            [
                'label' => esc_html__('Svg Icon Size', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
            ]
        );
        $this->add_responsive_control(
            'menu_icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i, {{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
            ]
        );
        $this->add_responsive_control(
            'menu_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i, {{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
            ]
        );
        $this->end_controls_section();

        //start content styling
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content Part Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_area_width',
            [
                'label' => esc_html__('Content Area Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_horizontal_align',
            [
                'label' => esc_html__('Box Style (Inline / Block)', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__('Inline', 'rsaddon'),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__('Block', 'rsaddon'),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area' => 'display: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'content_box_vertical_align',
            [
                'label' => esc_html__('Vertical Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rsaddon'),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
                'default' => 'start',
                'condition' => [
                    'content_box_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_flex_direction',
            [
                'label' => esc_html__('Column Direction', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'rsaddon'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Row Reverse', 'rsaddon'),
                        'icon' => 'eicon-wrap',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'rsaddon'),
                        'icon' => 'eicon-justify-start-v',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__('Column Reverse', 'rsaddon'),
                        'icon' => 'eicon-wrap',
                    ],
                ],
                'default' => 'row',
                'condition' => [
                    'content_box_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_part_width',
            [
                'label' => esc_html__('Image Part Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .image--right-area' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_box_horizontal_align' => 'flex'
                ]
            ]
        );
        $this->add_responsive_control(
            'text_part_width',
            [
                'label' => esc_html__('Text Part Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_box_horizontal_align' => 'flex'
                ]
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'content_bg',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'textdomain'),
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_bg_border',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
                'separator' => 'before',
            ]
        );


        $this->add_responsive_control(
            'tab_content_align',
            [
                'label' => esc_html__('Content Alignment', 'rsaddon'),
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
                'separator' => 'before',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_top_gap',
            [
                'label' => esc_html__('Content Top Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Content Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_wrapper_padding',
            [
                'label' => esc_html__('Content Box Wrapper Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'horizontal',
                ]
            ]
        );

        $this->add_responsive_control(
            'content_paddings',
            [
                'label' => esc_html__('Content Padding (Left Area)', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_content_border_radius_inner',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important; overflow: hidden !important;',
                ],
            ]
        );

        $this->add_control(
            'content_inner_settings',
            [
                'label' => esc_html__('Content Inner Settings', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'content_unner_bg',
                'selector' => '{{WRAPPER}} .tab-pane',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_inner_shadow',
                'label' => esc_html__('Box Shadow', 'textdomain'),
                'selector' => '{{WRAPPER}} .tab-pane',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_bg_inner_border',
                'selector' => '{{WRAPPER}} .tab-pane',
            ]
        );

        $this->add_responsive_control(
            'content_inner_radius',
            [
                'label' => esc_html__('Inner Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tab-pane' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_horizontal_align',
            [
                'label' => esc_html__('Content Style (Inline / Block)', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__('Inline', 'rsaddon'),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__('Block', 'rsaddon'),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'display: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_vertical_align',
            [
                'label' => esc_html__('Content Vertical Align', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rsaddon'),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rsaddon'),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rsaddon'),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
                'default' => 'start',
                'condition' => [
                    'content_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_inner_padding',
            [
                'label' => esc_html__('Content Inner Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        
        $this->add_control(
            'title_image_settings',
            [
                'label' => esc_html__('Title Image Settings', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control(
            'title_image_margin',
            [
                'label' => esc_html__('Title Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content_part_image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_image_height',
            [
                'label' => esc_html__('Title Image Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content_part_image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'mobile_white_bg_color',
			[
				'label' => esc_html__( 'Mobile White Bg', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-menu-wrapper.accordion-menu-wrapper .accordion-item' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();
        $this->start_controls_section(
            'section_content_image_style',
            [
                'label' => esc_html__('Content Image Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_part_settings',
            [
                'label' => esc_html__('Side Image Part Settings', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control(
            'content_image_box_margin',
            [
                'label' => esc_html__('Content Img Box Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .image--right-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_tab_border_radius',
            [
                'label' => esc_html__('Img Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .image--right-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'content_image_box_padding',
            [
                'label' => esc_html__('Content Img Box Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .image--right-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();
        // Button Icon Style Start
        $this->start_controls_section(
            'section_content_title_style',
            [
                'label' => esc_html__('Title Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'title_part_width',
            [
                'label' => esc_html__('Title Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .title, {{WRAPPER}} .accordion.tab-menu-wrapper .content--left-area .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content .title, {{WRAPPER}} .accordion.tab-menu-wrapper .content--left-area .title',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Title Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .title, {{WRAPPER}} .accordion.tab-menu-wrapper .content--left-area .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_part_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // description
        $this->start_controls_section(
            'section_content_description_style',
            [
                'label' => esc_html__('Description Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__('Desc Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc_btn_wrapper p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .desc_btn_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Desc Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc_btn_wrapper p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .desc_btn_wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .desc_btn_wrapper p,{{WRAPPER}} .desc_btn_wrapper',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
         // Content Button Style Start
         $this->start_controls_section(
            'section_content_list_style',
            [
                'label' => esc_html__('List Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['tab_style' => '2']
            ]
        );

        $this->add_control(
            'feature_list_color',
            [
                'label' => esc_html__('List Title Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li .list-feature-content .rs-feature-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_list_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .rs-features-list li .list-feature-content .rs-feature-text',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'feature_list_icon_color',
            [
                'label' => esc_html__('List Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_list_icon_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .rs-features-list li i',
                'separator'   => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'feature_border',
                'selector' => '{{WRAPPER}} .rs-features-list li i',
            ]
        );

        $this->add_responsive_control(
            'list_box_horizontal_align',
            [
                'label' => esc_html__( 'List Style (Inline / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-features-list' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'list_box_vertical_align',
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
					'list_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list' => 'align-items: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'list_flex_box_h_align',
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
					'list_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'list_flex_gap',
			[
				'label' => esc_html__('Flex Gap', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-features-list' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'list_box_horizontal_align' => 'flex',
				]
			]
		);

        $this->add_responsive_control(
            'list_style_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Button Style Start
        $this->start_controls_section(
            'section_content_button_style',
            [
                'label' => esc_html__('Button Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'content_btn_text_align',
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
                        '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_btn_typography',
                    'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a',
                ]
            );
            $this->add_responsive_control(
                'content_btn_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_btn_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_btn_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_btn_width',
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
                        '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a' => 'width: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );
            $this->start_controls_tabs(
                'content_btn_style_tabs'
            );
                $this->start_controls_tab(
                    'content_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'content_btn_color',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'content_btn_icon_color',
                        [
                            'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a svg path' => 'fill: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_content_btn_icon' => 'yes'
                            ]
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'content_btn_background',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'content_btn_border',
                            'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'content_btn_box_shadow',
                            'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'content_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
                    $this->add_control(
                        'content_btn_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_control(
                        'content_btn_icon_color_hover',
                        [
                            'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a:hover i' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a:hover svg path' => 'fill: {{VALUE}}',
                            ],
                            'condition' => [
                                'show_content_btn_icon' => 'yes'
                            ]
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'content_btn_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a:hover',
                        ]
                    );
                    $this->add_control(
                        'content_btn_border_color_hover',
                        [
                            'label' => esc_html__( 'Border Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a:hover' => 'border-color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'content_btn_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .tab-button-area a:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        // Button Style End
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $tabs = $this->get_settings_for_display('tabs');
        $settings = $this->get_settings_for_display();
        $id_int = substr($this->get_id_int(), 0, 3);

        $after_border_tab_menu = $settings['after_border_tab_menu'];
        $tab_style = $settings['tab_style'];

        $unique = rand(2012, 3554120);
        $widget_id = $this->get_id();

        $clip_path_img = $settings['clip_path_img'];

        $clip_path_css = '';
        if($clip_path_img  == 'yes' ) {
            $clip_path_css = 'clip-path-css';
        }
?>



        <div class="rstab-main <?php echo esc_attr($settings['type']); ?> tab_<?php echo $widget_id;?> auto_switch_<?php echo esc_attr($settings['auto_switch']); ?> <?php echo esc_attr($settings['tabs_item_width']); ?> <?php echo $clip_path_css;?> style<?php echo $tab_style;?>">
            <nav class="tab-menu-wrapper">
                <div class="nav nav-tabs <?php echo esc_attr($after_border_tab_menu); ?>" id="nav-tab-<?php echo $widget_id;?>" role="tablist">
                    <?php

                    $x = 0;
                    $arial_lebel = 1;
                    foreach ($tabs as $index => $item) :
                        $x++;

                        if ($x == 1) {
                            $active_tab = 'active';
                        } else {
                            $active_tab = '';
                        }

                        $tab_count = $index + 1;
                        $number_count = sprintf('%02d', $index + 1);
                        $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

                        $this->add_render_attribute($tab_title_setting_key, [
                            'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                            'class' => ['elementor-tab-title', 'elementor-tab-desktop-title'],
                            'data-tab' => $tab_count,
                            'role' => 'tab',
                            'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                        ]);

                        $icon = !empty($item['tab_icon']) ? '<i class="' . $item['tab_icon'] . '"></i>' : '';

                    ?>
                        <button class="nav-link <?php echo esc_attr($active_tab); ?> count_number_<?php echo esc_attr($settings['count_number']); ?>" id="nav-home-<?php echo esc_attr($arial_lebel); ?>-<?php echo esc_attr($unique); ?>" data-bs-toggle="tab" data-bs-target="#tab<?php echo esc_html($arial_lebel); ?>-<?php echo esc_attr($unique); ?>" type="button" role="tab" aria-controls="nav-home-<?php echo esc_attr($arial_lebel); ?>-<?php echo esc_attr($unique); ?>" aria-selected="true">
                            
                            <?php
                                if ('yes' === $settings['count_number']) {
                                    echo '<span class="count_number">' . $number_count . '</span>';
                                }

                                echo esc_html($item['tab_title']);

                                if (!empty($item['tab_icon_svg'])) {
                                    Icons_Manager::render_icon($item['tab_icon_svg'], ['aria-hidden' => 'true']);
                                } else {
                                    echo $icon;
                                }
                            ?>
                        </button>

                    <?php $arial_lebel++;
                    endforeach; ?>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent-<?php echo $widget_id;?>">
                <?php
                $x = 0;
                $arial_lebel = 1;
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $x++;
                    if ($x == 1) {
                        $active_tab = 'show active';
                    } else {
                        $active_tab = '';
                    }
                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                    $tab_title_mobile_setting_key = $this->get_repeater_setting_key('tab_title_mobile', 'tabs', $tab_count);

                    $titleimg_content    = !empty($item['selected_image_title']['url']) ? '<img class="nor_img" src="' . $item['selected_image_title']['url'] . '" alt="icon-image" />' : '';
                    $this->add_render_attribute($tab_content_setting_key, [
                        'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                        'class' => ['elementor-tab-content', 'elementor-clearfix'],
                        'data-tab' => $tab_count,
                        'role' => 'tabpanel',
                        'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                    ]);

                    $this->add_render_attribute($tab_title_mobile_setting_key, [
                        'class' => ['elementor-tab-title', 'elementor-tab-mobile-title'],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                    ]);

                    $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');
                    $selected_imagetab    = !empty($item['selected_imagetab']['url']) ? '<div class="image--right-area"><img class="nor_imgs" src="' . $item['selected_imagetab']['url'] . '" alt="icon-image" /></div>' : '';

                    $tab_list_content = $item['tab_list_content'];
                    $target = $item['tab_content_btn_link']['is_external'] ? 'target=_blank' : '';


                ?>
                    <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="tab<?php echo esc_html($arial_lebel); ?>-<?php echo esc_attr($unique); ?>" role="tabpanel" aria-labelledby="nav-home-<?php echo esc_attr($arial_lebel); ?>-<?php echo esc_attr($unique); ?>">


                        <?php
                        if (empty($item['selected_imagetab']['url'])) {
                            $fulls = 'full-sec';
                        } else {
                            $fulls = 'half-sec';
                        }


                        ?>
                        <?php if ($tab_style == '1') { ?>
                            <div class="content--teb-area <?php echo esc_attr($fulls); ?>">
                                <?php echo $selected_imagetab; ?>

                                <div class="content--left-area">

                                    <?php if (!empty($item['selected_image_title'])) { ?>
                                        <div class="content_part_image">
                                            <?php echo $titleimg_content; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($item['tab_content_title'])) { ?>
                                        <div class="title"><?php echo $this->parse_text_editor($item['tab_content_title']); ?></div>
                                    <?php } ?>
                                    <div class="desc_btn_wrapper">
                                        <?php if (!empty($item['tab_content'])) { ?>
                                            <?php echo $this->parse_text_editor($item['tab_content']); ?>
                                        <?php } ?>
                                    </div>

                                    <?php if(!empty($item['tab_content_btn'])){?>
                                        <div class="tab-button-area">
                                            <a href="<?php echo esc_url($item['tab_content_btn_link']['url']); ?>" <?php echo esc_attr($target); ?>>
                                                <?php echo $this->parse_text_editor( $item['tab_content_btn'] ); ?>
                                                <?php if(($settings['show_content_btn_icon']) == 'yes') { ?>
                                                    <em>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    </em>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } elseif ($tab_style == '2') { ?>
                            <div class="content--teb-area <?php echo esc_attr($fulls); ?>">
                                <?php if (!empty($item['selected_imagetab']['url'])) { ?>
                                    <div class="image--right-area">
                                        <div class="tab-image-style2"><img class="nor_imgs" src="<?php echo $item['selected_imagetab']['url']; ?>" alt="icon-image" />
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="content--left-area">

                                    <?php if (!empty($item['selected_image_title'])) { ?>
                                        <div class="content_part_image">
                                            <?php echo $titleimg_content; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($item['tab_content_title'])) { ?>
                                        <div class="title"><?php echo $this->parse_text_editor($item['tab_content_title']); ?></div>
                                    <?php } ?>
                                    <div class="desc_btn_wrapper">
                                        <?php if (!empty($item['tab_content'])) { ?>
                                            <?php echo $this->parse_text_editor($item['tab_content']); ?>
                                        <?php } ?>
                                    </div>
                                    <?php echo  $tab_list_content;?>
                                    <?php if(!empty($item['tab_content_btn'])){?>
                                        <div class="tab-button-area">
                                            <a href="<?php echo esc_url($item['tab_content_btn_link']['url']); ?>" <?php echo esc_attr($target); ?>>
                                                <?php echo $this->parse_text_editor( $item['tab_content_btn'] ); ?>
                                                <?php if(($settings['show_content_btn_icon']) == 'yes') { ?>
                                                    <em>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    </em>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <?php $arial_lebel++;
                endforeach; ?>
            </div>
        </div>
        <?php if ('yes' === $settings['auto_switch']) { ?>
            <script>
                jQuery(document).ready(function($) {
                    var interval = <?php echo esc_attr($settings['switching_duration']); ?>;
                    var autoSwitchTimer;
                    function switchTabs() {
                        var $activeTab = $('body:not(.elementor-editor-active) .rstab-main.tab_<?php echo $widget_id;?>.auto_switch_yes .nav-tabs .nav-link.active');
                        var $nextTab = $activeTab.next('.nav-link');
                        if (!$nextTab.length) {
                            $nextTab = $('body:not(.elementor-editor-active) .rstab-main.tab_<?php echo $widget_id;?>.auto_switch_yes .nav-tabs .nav-link').first();
                        }
                        $nextTab.trigger('click');
                    }
                    function startAutoSwitch() {
                        autoSwitchTimer = setInterval(switchTabs, interval);
                    }
                    startAutoSwitch();
                    $('.rstab-main').on('mouseenter', function() {
                        clearInterval(autoSwitchTimer);
                    });
                    $('.rstab-main').on('mouseleave', function() {
                        startAutoSwitch();
                    });
                });
            </script>
            <style>
                .rstab-main.tab_<?php echo $widget_id;?>.auto_switch_yes .nav-tabs .nav-link.active:before {
                    animation-duration: <?php echo esc_attr($settings['switching_duration']); ?>ms;
                }
            </style>
        <?php } ?>

        <div class="accordion tab-menu-wrapper accordion-menu-wrapper rs_<?php echo esc_attr($settings['type']); ?>" id="accordionExample-<?php echo $widget_id;?>">

            <?php
            $x = 0;
            $arial_lebel = 1;
            foreach ($tabs as $index => $item) :
                $tab_count = $index + 1;
                $x++;
                if ($x == 1) {
                    $active_tab = 'show';
                } else {
                    $active_tab = '';
                }

                $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                $tab_title_mobile_setting_key = $this->get_repeater_setting_key('tab_title_mobile', 'tabs', $tab_count);

                $titleimg_content    = !empty($item['selected_image_title']['url']) ? '<img class="nor_img" src="' . $item['selected_image_title']['url'] . '" alt="icon-image" />' : '';
                $this->add_render_attribute($tab_content_setting_key, [
                    'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                    'class' => ['elementor-tab-content', 'elementor-clearfix'],
                    'data-tab' => $tab_count,
                    'role' => 'tabpanel',
                    'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                ]);

                $this->add_render_attribute($tab_title_mobile_setting_key, [
                    'class' => ['elementor-tab-title', 'elementor-tab-mobile-title'],
                    'data-tab' => $tab_count,
                    'role' => 'tab',
                ]);

                $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');
                $selected_imagetab    = !empty($item['selected_imagetab']['url']) ? '<div class="image--right-area"><img class="nor_imgs" src="' . $item['selected_imagetab']['url'] . '" alt="icon-image" /></div>' : '';

                $tab_count = $index + 1;
                $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

                $this->add_render_attribute($tab_title_setting_key, [
                    'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                    'class' => ['elementor-tab-title', 'elementor-tab-desktop-title'],
                    'data-tab' => $tab_count,
                    'role' => 'tab',
                    'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                ]);
                $icon = !empty($item['tab_icon']) ? '<i class="' . $item['tab_icon'] . '"></i>' : '';
            ?>
                <div class="accordion-item nav-tabs">
                    
                    <div class="accordion-headerd" id="heading_<?php echo esc_html($arial_lebel); ?>-<?php echo esc_attr($unique); ?>">
                        <button class="nav-link accordion-button collapsed <?php echo esc_attr($active_tab);?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo esc_html($arial_lebel); ?>-<?php echo esc_attr($unique); ?>" aria-expanded="true" aria-controls="collapse_<?php echo esc_html($arial_lebel); ?>-<?php echo esc_attr($unique); ?>">
                            <?php
                            if (!empty($item['tab_icon_svg'])) {
                                Icons_Manager::render_icon($item['tab_icon_svg'], ['aria-hidden' => 'true']);
                            } else {
                                echo $icon;
                            }
                            ?>
                            <?php echo esc_html($item['tab_title']); ?>
                        </button>
                    </div>

                    <div id="collapse_<?php echo esc_html($arial_lebel); ?>-<?php echo esc_attr($unique); ?>" class="accordion-collapse collapse <?php echo esc_attr($active_tab); ?>" aria-labelledby="heading_<?php echo esc_html($arial_lebel); ?>-<?php echo esc_attr($unique); ?>" data-bs-parent="#accordionExample-<?php echo $widget_id;?>">
                        <div class="tab-pane">


                            <?php
                            if (empty($item['selected_imagetab']['url'])) {
                                $fulls = 'full-sec';
                            } else {
                                $fulls = 'half-sec';
                            }
                            
                            ?>
                            <?php if ($tab_style == '1') { ?>
                            <div class="content--teb-area <?php echo esc_attr($fulls); ?>">
                                <?php echo $selected_imagetab; ?>

                                <div class="content--left-area">

                                    <?php if (!empty($item['selected_image_title'])) { ?>
                                        <div class="content_part_image">
                                            <?php echo $titleimg_content; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($item['tab_content_title'])) { ?>
                                        <div class="title"><?php echo $this->parse_text_editor($item['tab_content_title']); ?></div>
                                    <?php } ?>
                                    <div class="desc_btn_wrapper">
                                        <?php if (!empty($item['tab_content'])) { ?>
                                            <?php echo $this->parse_text_editor($item['tab_content']); ?>
                                        <?php } ?>
                                    </div>
                                    <?php if(!empty($item['tab_content_btn'])){?>
                                        <div class="tab-button-area">
                                            <a href="<?php echo esc_url($item['tab_content_btn_link']['url']); ?>" <?php echo esc_attr($target); ?>>
                                                <?php echo $this->parse_text_editor( $item['tab_content_btn'] ); ?>
                                                <?php if(($settings['show_content_btn_icon']) == 'yes') { ?>
                                                    <em>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    </em>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } elseif ($tab_style == '2') { ?>
                                <div class="content--teb-area <?php echo esc_attr($fulls); ?>">
                                <?php if (!empty($item['selected_imagetab']['url'])) { ?>
                                    <div class="image--right-area">
                                        <div class="tab-image-style2"><img class="nor_imgs" src="<?php echo $item['selected_imagetab']['url']; ?>" alt="icon-image" />
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="content--left-area">

                                    <?php if (!empty($item['selected_image_title'])) { ?>
                                        <div class="content_part_image">
                                            <?php echo $titleimg_content; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($item['tab_content_title'])) { ?>
                                        <div class="title"><?php echo $this->parse_text_editor($item['tab_content_title']); ?></div>
                                    <?php } ?>
                                    <div class="desc_btn_wrapper">
                                        <?php if (!empty($item['tab_content'])) { ?>
                                            <?php echo $this->parse_text_editor($item['tab_content']); ?>
                                        <?php } ?>
                                    </div>
                                    <?php echo  $tab_list_content;?>

                                    <?php if(!empty($item['tab_content_btn'])){?>
                                        <div class="tab-button-area">
                                            <a href="<?php echo esc_url($item['tab_content_btn_link']['url']); ?>" <?php echo esc_attr($target); ?>>
                                                <?php echo $this->parse_text_editor( $item['tab_content_btn'] ); ?>
                                                <?php if(($settings['show_content_btn_icon']) == 'yes') { ?>
                                                    <em>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['content_btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    </em>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php $arial_lebel++;
            endforeach; ?>
        </div>
<?php
    }
}

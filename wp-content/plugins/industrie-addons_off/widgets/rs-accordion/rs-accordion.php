<?php
/**
 * Logo widget class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\render_icon;
use Elementor\Icons_Manager;
use Elementor\is_migration_allowed;
use Elementor\Global_Colors;
use Elementor\Global_Typography;


defined( 'ABSPATH' ) || die();

class Widget_Rs_Accordion_custom extends \Elementor\Widget_Base {
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
        return 'rs-accordions-custom';
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
        return esc_html__( 'RS Accordion', 'rsaddon' );
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
        return [ 'Accordion' ];
    }


    protected function register_controls() {       

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Accordion Item', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Scheme', 'rsaddon'),		
					'secondary_primary_scheme' => esc_html__('Secondary & Primary', 'rsaddon'),
					'primary_secondary_scheme' => esc_html__('Primary & Secondary', 'rsaddon'),
                    'gradient_scheme' => esc_html__('Gradient Scheme', 'rsaddon')
				],
			]
		);

        $repeater = new Repeater();  


        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'rsaddon' ),
                'separator'   => 'before',
            ]
        ); 
        
        $repeater->add_control(
            'step_title',
            [
                'label' => esc_html__('Step Title', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Step - 1', 'rsaddon'),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );  

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Content', 'elementor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Accordion Content', 'elementor' ),
                'show_label' => false,
            ]
        );  
        $repeater->add_control(
            'selected_image',
            [
                'label'       => esc_html__( 'Icon image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $repeater->add_responsive_control(
            'accordion_open_closed',
            [
                'label' => esc_html__( 'Accordion Open/Closed?', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );   
        $this->add_control(
            'accordion_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                ]
            ]
        );
        $this->add_control(
            'accord_style',
            [
                'label'   => esc_html__( 'Select Accordion Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [                  
                    'style1' => esc_html__( 'Style 1', 'rsaddon'),
                    'style2' => esc_html__( 'Style 2', 'rsaddon'),
                    'style3' => esc_html__( 'Style 3', 'rsaddon'),
                ],
            ]
        );
        $this->add_control(
            'selected_active_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-up',
                        'angle-up',
                        'angle-double-up',
                        'caret-up',
                        'caret-square-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );
        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Active Icon', 'elementor' ),
                'type' => Controls_Manager::ICONS,
                'separator' => 'before',
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'chevron-down',
                        'angle-down',
                        'angle-double-down',
                        'caret-down',
                        'caret-square-down',
                    ],
                    'fa-regular' => [
                        'caret-square-down',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );
        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'div',
                'separator' => 'before',
            ]
        ); 
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Accordion', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'margin_acc',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_acc',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'box_shadow',
               'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-item',
           ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-accordion-area .accordion-item .accordion-header .accordion-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_area',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-item',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __( 'Title', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-button.collapsed .tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label' => __( 'Active Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-button:not(.collapsed) .tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_normaldfdf_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-item .accordion-header .accordion-button',
            ]
        );

        $this->add_control(
            'title_active_bg',
            [
                'label' => esc_html__( 'Title Active Background', 'rsaddon' ),
                'type'  => Controls_Manager::HEADING,              
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_active_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-item .accordion-button:not(.collapsed)',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-button .tab-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-button .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding_active',
            [
                'label' => __( 'Active Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-button .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-button .tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'normal_title__border',
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-button.collapsed .tab-title'
            ]
        );
        $this->add_responsive_control(
            'title_inner_width',
            [
                'label' => esc_html__( 'Title Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .tab-title' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'active_title_activeborder',
            [
                'label' => esc_html__( 'Title Active Area', 'rsaddon' ),
                'type'  => Controls_Manager::HEADING,              
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'active_title__border',
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-button:not(.collapsed) .tab-title'
            ]
        );
        $this->add_responsive_control(
            'active_title_border_radius',
            [
                'label' => esc_html__( 'Active Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-button:not(.collapsed) .tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_image',
            [
                'label' => __( 'Image', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );
        $this->add_control(
            'image_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Start', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'End', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => is_rtl() ? 'right' : 'left',
                'toggle' => false,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'img_background1',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-button.collapsed .icon_image,{{WRAPPER}} div.rs-accordion-area.style3 .accordion-header .icon_image::after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'img_background2',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-button:not(.collapsed) .icon_image',
            ]
        );

        $this->add_control(
            'step_line_color',
            [
                'label' => __( 'Step Line Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area.style3 .accordion-item:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'img_space',
            [
                'label' => __( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .icon_image' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .icon_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
		    'image_icon_padding',
		    [
		        'label' => esc_html__( ' Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} div.rs-accordion-area .icon_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
            'icon_image_width',
            [
                'label' => __( 'Width', 'rs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .icon_image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'iconimage_height',
            [
                'label' => __( 'Height', 'rs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .icon_image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_icon',
            [
                'label' => __( 'Icon', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Start', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'End', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => is_rtl() ? 'right' : 'left',
                'toggle' => false,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background1',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} div.rs-accordion-area .accordion-button span',
            ]
        );
        $this->add_control(
            'active_bg',
            [
                'label' => esc_html__( 'Active Background', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .accordion-button:not(.collapsed) .elementor-accordion-icon',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-button.collapsed i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-button.collapsed svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_active_color',
            [
                'label' => __( 'Active Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-button:not(.collapsed) i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .accordion-button:not(.collapsed) svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_space',
            [
                'label' => esc_html__( 'Spacing', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'open_icon_margin',
            [
                'label' => esc_html__( 'Open Icon Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-header .elementor-accordion-icon .elementor-accordion-icon-opened' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_left_position',
            [
                'label'      => esc_html__( 'Icon left Space', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .accordion-header .elementor-accordion-icon' => 'left: {{SIZE}}{{UNIT}}!important; right:unset;',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_right_position',
            [
                'label'      => esc_html__( 'Icon Right Space', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .accordion-header .elementor-accordion-icon' => 'right: {{SIZE}}{{UNIT}}!important; left:unset;',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_top_bottom_position',
            [
                'label'      => esc_html__( 'Icon Top/Bottom Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-header .elementor-accordion-icon' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_top_position',
            [
                'label' => esc_html__( 'Icon Top to Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-header .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}  !important;',
                ],
            ]
        );
       
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .accordion-button span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => __( 'Width', 'rs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-header .elementor-accordion-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_height',
            [
                'label' => __( 'Height', 'rs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-header .elementor-accordion-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_hundred_percentent_height',
            [
                'label' => esc_html__( 'Height (100%)', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-header .elementor-accordion-icon' => 'height: {{SIZE}}{{UNIT}}; display:flex !important; align-items:center !important; justify-content: center !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'line_height',
            [
                'label' => __( 'Line Height', 'rs-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-header .elementor-accordion-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_alignment',
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
                    '{{WRAPPER}} .rs-accordion-area .accordion-header .elementor-accordion-icon' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
        	'icon_font_size',
        	[
        		'label' => __( 'Font Size', 'rs-addons' ),
        		'type' => Controls_Manager::SLIDER,
        		'range' => [
        			'px' => [
        				'min' => 0,
        				'max' => 100,
        			],
        		],
        		'selectors' => [
        			'{{WRAPPER}} div.rs-accordion-area .accordion-button .elementor-accordion-icon-closed' => 'font-size: {{SIZE}}{{UNIT}};',
        			'{{WRAPPER}} div.rs-accordion-area .accordion-button .elementor-accordion-icon-opened' => 'font-size: {{SIZE}}{{UNIT}};',
        			'{{WRAPPER}} div.rs-accordion-area .accordion-button .elementor-accordion-icon-opened svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} div.rs-accordion-area .accordion-button .elementor-accordion-icon-closed svg' => 'width: {{SIZE}}{{UNIT}};',
        		],
        	]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => __( 'Content', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-body',
            ]
        );

        $this->add_control(
            'content_active_bg',
            [
                'label' => esc_html__( 'Content Active Background', 'rsaddon' ),
                'type'  => Controls_Manager::HEADING,              
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_active_background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-item .accordion-collapse.show .accordion-body',
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-body' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-body',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin_cons',
            [
                'label' => esc_html__( 'Content Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin_cons_active',
            [
                'label' => esc_html__( 'Active Content Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-accordion-area .accordion-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-collapse',
            ]
        );

        $this->add_control(
            'content_inner_control',
            [
                'label' => esc_html__( 'Content Inner Control', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_inner_border',
                'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-body',
            ]
        );

        $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'content_shadow',
               'selector' => '{{WRAPPER}} .rs-accordion-area .accordion-body',
           ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'step_title_style',
            [
                'label' => __( 'Step Title Style', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'step_title_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area.style3 .accordion-header .accordion-button .title-step-wrap .acc-step-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'step_title_typography',
                'selector' => '{{WRAPPER}} div.rs-accordion-area.style3 .accordion-header .accordion-button .title-step-wrap .acc-step-title',
            ]
        );

        $this->add_responsive_control(
		    'step_title_margin',
		    [
		        'label' => esc_html__( 'Step Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} div.rs-accordion-area.style3 .accordion-header .accordion-button .title-step-wrap .acc-step-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'title_highlight_style',
            [
                'label' => esc_html__( 'Highlight Title', 'prelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'hightlight_typography',
                'label' => esc_html__( 'Hightlight Typography', 'prelements' ),
                'selector' => '{{WRAPPER}} div.rs-accordion-area .tab-title span',
            ]
        );
        $this->add_control(
            'highlight_color',
            [
                'label' => esc_html__( 'Highlight Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .tab-title span' => 'color: {{VALUE}};',
                ],             
            ]
        );
        $this->add_control(
            'highlight_title_stroke_color',
            [
                'label' => esc_html__( 'Highlight Stroke Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .tab-title span' => '-webkit-text-stroke: 1px {{VALUE}};',
                ],            
            ]
        );
        $this->add_control(
            'hightlight_title_fill_stroke_color',
            [
                'label' => esc_html__( 'Highlight Stroke Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .tab-title span' => '-webkit-text-fill-color: {{VALUE}};',
                ],            
            ]
        );
        $this->add_responsive_control(
            'highlight_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', 'custom' ],  
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .tab-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'highlight_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', 'custom' ], 
                'selectors' => [
                    '{{WRAPPER}} div.rs-accordion-area .tab-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'highlight_color_gradient',
                'label' => esc_html__( 'Highlight Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} div.rs-accordion-area .tab-title span',
            ]
        ); 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hightlight_shape_color',
                'label' => esc_html__( 'Hightlight Shape', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} div.rs-accordion-area .tab-title span',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        
        $settings = $this->get_settings_for_display();

        $accord_style = $settings['accord_style'];
        $unique = rand(2012,35120);
        if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // @todo: remove when deprecated
            // added as bc in 2.6
            // add old default
            $settings['icon'] = 'fa fa-plus';
            $settings['icon_active'] = 'fa fa-minus';
            $settings['icon_align'] = $this->get_settings( 'icon_align' );
        }

        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
        $has_icon = ( ! $is_new || ! empty( $settings['selected_icon']['value'] ) );
        $id_int = substr( $this->get_id_int(), 0, 3 );
      
        if ( empty($settings['accordion_list'] ) ) {
            return;
        }

       
        ?>

            <div class="rs-accordion-area accordion <?php echo esc_html($settings['choose_color_scheme']); ?> <?php echo esc_html($settings['accord_style']);?>" id="rs_accordion_inner_<?php echo $unique; ?>">
              <?php
                $i = rand(20212,351820);
                foreach ( $settings['accordion_list'] as $index => $item ) :
                $title        = !empty($item['name']) ? $item['name'] : '';
                $description  = !empty($item['description']) ? $item['description'] : '';


                $accordion_open_closed = $item['accordion_open_closed'];
                $active = '';
                $collapsed = 'collapsed';
                if($accordion_open_closed == 'yes' ) {
                    $collapsed = '';
                    $active = 'show';
                }
                
                $selected_image    = !empty($item['selected_image']['url']) ? '<div class="icon_image"><img class="icon_img" src="'. $item['selected_image']['url']. '" alt="icon-image" /></div>' : '';

                if( $accord_style == 'style1' || $accord_style == 'style2' ) {
            ?>  
                <div class="accordion-item">
                    <div class="accordion-header" id="heading<?php echo $i;?>">
                        <div class="accordion-button <?php echo esc_attr($collapsed);?>" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $i;?>" aria-controls="collapse_<?php echo $i;?>">
                            <?php if ( $has_icon ) : ?>
                                <span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
                                    <?php
                                    if ( $is_new ) { ?>
                                        <span class="elementor-accordion-icon-closed"><?php Icons_Manager::render_icon( $settings['selected_icon'] ); ?></span>
                                        <span class="elementor-accordion-icon-opened"><?php Icons_Manager::render_icon( $settings['selected_active_icon'] ); ?></span>
                                    <?php } ?>
                                </span>
                            <?php endif; ?>                        

                            <?php if('left' == $settings['image_align']){ ?>
                                <?php echo $selected_image; ?>
                            <?php } ?>

                            <?php if(!empty($title)):?>
                            <<?php echo $settings['title_html_tag']; ?> class="tab-title"><?php echo wp_kses_post($title);?></<?php echo $settings['title_html_tag']; ?>>
                            <?php endif; ?>

                            <?php if('right' == $settings['image_align']){ ?>
                                <?php echo $selected_image; ?>
                            <?php } ?>

                        </div>
                    </div>

                    <?php if(!empty($item['description'])):?>
                    <div id="collapse_<?php echo $i;?>" class="accordion-collapse collapse <?php echo esc_attr( $active); ?>" aria-labelledby="heading<?php echo $i;?>" data-bs-parent="#rs_accordion_inner_<?php echo $unique; ?>">
                        <div class="accordion-body">
                            <?php echo $this->parse_text_editor( $item['description'] ); ?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <?php } elseif( $accord_style == 'style3' ) { 
                    include plugin_dir_path(__FILE__)."/acc-style3.php";
                } $i++; endforeach; ?>
            </div>
        <?php
       
    }
}
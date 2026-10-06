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

class Rsaddon_Elementor_pro_Pricing_RS_Table_Widget extends \Elementor\Widget_Base {

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
        return 'rsprices';
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
				'label'   => esc_html__('Select Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => 'Style 1',
				],
			]
		);
        $this->add_control(
            'duration_swither_show_hide',
            [
                'label' => esc_html__( 'Switcher Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'monthly_title',
            [
                'label' => esc_html__( 'Monthly Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Monthly',
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
                'default' => 'Yearly',
                'condition' => [
					'duration_swither_show_hide' => 'yes',
				],
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__( 'Currency', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
            ]
        );

        $repeater = new Repeater();

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
            'title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__( 'Basic', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'monthly_short_desc',
            [
                'label' => esc_html__( 'Monthly Description', 'rsaddon' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '$29.00', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'monthly_duration_text',
            [
                'label' => esc_html__( 'Duration', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Monthly Text', 'rsaddon' ),
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
            'features',
            [
                'label'   => esc_html__( 'Features (Use List Style)', 'rsaddon' ),
                'type'    => Controls_Manager::WYSIWYG,
                'rows'    => 10, 
                'default' => esc_html__( '1 Users', 'rsaddon' ),          
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
            'button_link',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'https://example.com/', 'rsaddon' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        //Yearly Content
        $repeater->add_control(
            'yearly_options',
            [
                'label' => esc_html__( 'Yearly Pricing Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'title_yearly',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__( 'Basic', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'yearly_short_desc',
            [
                'label' => esc_html__( 'Yearly Description', 'rsaddon' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'price_yearly',
            [
                'label' => esc_html__( 'Price', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '$59.00', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'yearly_duration_text',
            [
                'label' => esc_html__( 'Duration', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Yearly Text', 'rsaddon' ),               
            ]
        );
        $repeater->add_control(
            'badge_yearly',
            [
                'label' => esc_html__( 'Badge Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'title_top_icon_two',
            [
                'label' => esc_html__( 'Title Icon', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
            ]
        );
        $repeater->add_control(
            'features_yearly',
            [
                'label'   => esc_html__( 'Features (Use List Style)', 'rsaddon' ),
                'type'    => Controls_Manager::WYSIWYG,
                'rows'    => 10,
                'default' => esc_html__( '1 Users', 'rsaddon' ),         
            ]
        );
        $repeater->add_control(
            'button_text_yearly',
            [
                'label' => esc_html__( 'Button Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Get Started', 'rsaddon' ),
                'placeholder' => esc_html__( 'Type button text here', 'rsaddon' ),
                'label_block' => false,
            ]
        );
        $repeater->add_control(
            'button_link_yearly',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'https://example.com/', 'rsaddon' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
			'item_active',
			[
				'label' => esc_html__( 'Item Active?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'price_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_months',
            [
                'label' => esc_html__( 'Monthly & Yearly Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'pricing_align_style',
            [
                'label' => esc_html__( 'Pricing Alignment', 'rsaddon' ),
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
                'selectors' => [
                    '{{WRAPPER}}  .rs-pricing-container .pricing-switcher' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_colors_fie',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-switcher .fieldset',
            ]
        );

        $this->add_control(
			'pricing_switcher_position_heading',
			[
				'label' => esc_html__( 'Pricing Switcher Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'pricing_switcher_position_y_top',
			[
				'label' => esc_html__( 'Top', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 100,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'top: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'pricing_switcher_position_x_right',
			[
				'label' => esc_html__( 'Right', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 100,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'right: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'pricing_switcher_position_y_bottom',
			[
				'label' => esc_html__( 'Bottom', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 100,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'bottom: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'pricing_switcher_position_x_left',
			[
				'label' => esc_html__( 'Left', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 100,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'left: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);

        $this->add_control(
            'switcher_bg_heading',
            [
                'label' => esc_html__( 'Switcher Color (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'switcher_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-switcher .switch',
            ]
        );

        $this->add_control(
            'switcher_normal_color',
            [
                'label' => esc_html__( 'Switcher Color (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'switcher_normal_bg_color',
            [
                'label' => esc_html__( 'Switcher Background (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher label' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'switcher_active_color',
            [
                'label' => esc_html__( 'Switcher Color (Active)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset.mnt-ac .rs-mnt, {{WRAPPER}} .pricing-switcher .fieldset.mnt-acs .rs-yrs' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'switcher_active_bg_color',
            [
                'label' => esc_html__( 'Switcher Background Color (Active)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset.mnt-ac .rs-mnt, {{WRAPPER}} .pricing-switcher .fieldset.mnt-acs .rs-yrs' => 'background: {{VALUE}} !important; border-color:{{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'fieldset_max_width',
			[
				'label' => esc_html__( 'Fieldset Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
			'yearly_position',
			[
				'label' => esc_html__( 'Yearly Left Position', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher input[type=radio]:checked + label + .switch, .pricing-switcher input[type=radio]:checked + label:nth-of-type(n) + .switch' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'switcher_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .pricing-switcher label',
            ]
        );
        $this->add_responsive_control(
            'year_padding',
            [
                'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'year_margin',
            [
                'label' => esc_html__( 'Wrapper Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sinle_lable_padding',
            [
                'label' => esc_html__( 'Single Label Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'sinle_lable_margin',
            [
                'label' => esc_html__( 'Single Label Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'price_menu_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricing-switcher .fieldset',
            ]
        );
        $this->add_responsive_control(
            'month_year_border_radius',
            [
                'label' => esc_html__( 'Wrapper Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .switch' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'my_single_label_br',
            [
                'label' => esc_html__( 'Single Label Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .pricing-switcher .fieldset label',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'Item Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gradient_color_showhide',
            [
                'label'   => esc_html__( 'Gradient Color', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'gradient_disable',
                'options' => [                  
                    'gradient_enable' => esc_html__( 'Enable', 'rsaddon'),
                    'gradient_disable' => esc_html__( 'Disable', 'rsaddon'),
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
                    '{{WRAPPER}}  .rs-pricing-container' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-wrapper > li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-wrapper > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_style_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .pricing-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricing-wrapper > li',
            ]
        );

        $this->add_control(
            'box_shadow_hover_title',
            [
                'label' => esc_html__( 'Hover Box-show', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow_hover',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricing-wrapper > li:hover',
            ]
        );

        $this->start_controls_tabs( '_tabs_item_style' );

        $this->start_controls_tab(
            '_tab_item_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-wrapper > li',
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .pricing-wrapper > li',
			]
		);
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_item_hover',
            [
                'label' => esc_html__( 'Active', 'rsaddon' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper > li',
            ]
        );
        $this->add_control(
			'item_active_border_color',
			[
				'label' => esc_html__( 'Border Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper > li' => 'border-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => esc_html__( 'Header Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'title_icon_width',
            [
                'label' => esc_html__( 'Tile Icon Width', 'textdomain' ),
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
                    '{{WRAPPER}} .rs-pricing-container.style1 .pricing-header .title-icon-wrap .title-icon-sec' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-pricing-container.style1 .pricing-header .title-icon-wrap-two .title-icon-sec-two' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_style'=>'1',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_icon_height',
            [
                'label' => esc_html__( 'Tile Icon Height', 'textdomain' ),
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
                    '{{WRAPPER}} .rs-pricing-container.style1 .pricing-header .title-icon-wrap .title-icon-sec' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-pricing-container.style1 .pricing-header .title-icon-wrap-two .title-icon-sec-two' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_style'=>'1',
                ],
            ]
        );
        $this->add_control(
            'title_icon_color',
            [
                'label' => esc_html__( 'Title Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container.style1 .pricing-header .title-icon-wrap .title-icon-sec svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_active_icon_color',
            [
                'label' => esc_html__( 'Title Active Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container.style1 .exclusive.item-active .pricing-header .title-icon-wrap .title-icon-sec svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'headtitle_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header h3' => 'color: {{VALUE}};',
                ],
                'separator'=>'before',
            ]
        );

        $this->add_control(
            'headtitle_hover_color',
            [
                'label' => esc_html__( 'Title Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper .pricing-header h3' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Title Typography', 'rsaddon' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header h3',
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header h3',
			]
		);

        $this->add_control(
            'headtitle_active_border_color',
            [
                'label' => esc_html__( 'Active Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper .pricing-header h3' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_pirce_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_align',
            [
                'label' => esc_html__( 'Price Alignment', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner' => 'justify-content: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Price Typography', 'rsaddon' ),
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header .price',
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gradient_color' => 'gradient_disable',
                ], 
            ]
        );
        $this->add_control(
            'price_active_color',
            [
                'label' => esc_html__( 'Price Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper .pricing-header .price' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gradient_color' => 'gradient_disable',
                ], 
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Currency Typography', 'rsaddon' ),
                'name' => 'currency__typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner .price span.currency',
            ]
        );
        
        $this->add_responsive_control(
            'currency_left_position',
            [
                'label' => esc_html__( 'Currency Left Position', 'textdomain' ),
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
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner .price span.currency' => 'left: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'currency_top_position',
            [
                'label' => esc_html__( 'Currency Top Position', 'textdomain' ),
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
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner .price span.currency' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_control(
            'btn_border_gradient_heading_price',
            [
                'label' => esc_html__( 'Price Gradient Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'price_gradient_color',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gradient_enable .pricing-header .price',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );
        $this->add_responsive_control(
            'header_wrapper_paddings',
            [
                'label' => esc_html__( 'Header Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_inner_paddings',
            [
                'label' => esc_html__( 'Price Inner Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'des_list_color',
            [
                'label' => esc_html__( 'Duration Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner span' => 'color: {{VALUE}}; opacity:1;',
                ],
            ]
        );
        $this->add_control(
            'des_list_active_color',
            [
                'label' => esc_html__( 'Duration Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper .pricing-header .price-inner span' => 'color: {{VALUE}}; opacity:1;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Description Typography', 'rsaddon' ),
                'name' => 'des_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner span',
            ]
        );
        $this->add_control(
            'short_desc_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'heading_border',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header',
            ]
        );
        $this->add_control(
            'heading_active_border_color',
            [
                'label' => esc_html__( 'Heading Active Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .exclusive.item-active .pricing-header' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'short_desc_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'short_desc_radius_active',
            [
                'label' => esc_html__( 'Border Radius ( Active )', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .exclusive.item-active .pricing-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Badge Style Start
        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => esc_html__( 'Badge Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'badge_wrap',
            [
                'label' => esc_html__( 'Badge Wrap (If Given Width)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'break-all' => [
                        'title' => esc_html__( 'Wrap', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'unset' => [
                        'title' => esc_html__( 'Unwrap', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricebadge' => 'word-break: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricebadge' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'badge_align',
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
                    '{{WRAPPER}} .pricebadge' => 'text-align: {{VALUE}}',
                ]
            ]
        );


        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'badge_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .pricebadge',
		        
		    ]
		);
        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricebadge' => 'color: {{VALUE}};',                   
                ],
            ]
        );
        $this->add_responsive_control(
		    'badge_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricebadge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'badge_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricebadge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'badge_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricebadge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'badge_background',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricebadge',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .pricebadge',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricebadge'
            ]
        );
        $this->add_responsive_control(
            'badge_align_width_base',
            [
                'label' => esc_html__( 'Alignment (If Given Width)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => '',
                'options' => [
                    '' => [
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
                    '{{WRAPPER}} .pricebadge' => 'margin: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
			'badge_position_heading',
			[
				'label' => esc_html__( 'Badge Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'badge_position_y_top',
			[
				'label' => esc_html__( 'Top', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'top: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'badge_position_x_right',
			[
				'label' => esc_html__( 'Right', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'right: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'badge_position_y_bottom',
			[
				'label' => esc_html__( 'Bottom', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'bottom: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'badge_position_x_left',
			[
				'label' => esc_html__( 'Left', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'left: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);

        $this->end_controls_section();
        // Badge Style End

        $this->start_controls_section(
            '_section_style_body',
            [
                'label' => esc_html__( 'Pricing Body Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align_body',
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
                    '{{WRAPPER}}  .pricing-body' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'des_features_color',
            [
                'label' => esc_html__( 'Features Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'des_features__title__color',
            [
                'label' => esc_html__( 'Features Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'des_features_active_color',
            [
                'label' => esc_html__( 'Features Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper .pricing-body .features ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'des_features__active_title__color',
            [
                'label' => esc_html__( 'Features Active Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper .pricing-body .features span' => 'color: {{VALUE}};',
                ],
            ]
        );

        

        $this->add_control(
            'des_close_features_color',
            [
                'label' => esc_html__( 'Close Features Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li.close-icon' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_control(
            'des_close_features_active_color',
            [
                'label' => esc_html__( 'Close Features Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper .pricing-body .features ul li.close-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_features_color',
            [
                'label' => esc_html__( 'Check Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-body .features ul li:before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_active__features_color',
            [
                'label' => esc_html__( 'Check Icon Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .exclusive.item-active .pricing-body .features ul li:before' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_gradient',
            [
                'label' => esc_html__( 'Check Icon Gradient Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'check_icon_gradient',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-body .features ul li:before',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ],
            ]
        );
        $this->add_control(
            'icon_border_features_color',
            [
                'label' => esc_html__( 'Close Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-body .features ul li.close-icon:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Features Typography', 'rsaddon' ),
                'name' => 'features_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Features Close Typography', 'rsaddon' ),
                'name' => 'close_feature_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li.close-icon',
            ]
        );
        $this->add_responsive_control(
            'body_wrapper_padding',
            [
                'label' => esc_html__( 'Body Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'body_wrapper_margin',
            [
                'label' => esc_html__( 'Body Wrapper Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'list_wrapper_padding',
            [
                'label' => esc_html__( 'List Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_wrapper_margin',
            [
                'label' => esc_html__( 'List Wrapper Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->add_control(
            'item_fea_desc_margin',
            [
                'label' => esc_html__( 'Margin (Per Item)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'item_fea_desc_padding',
            [
                'label' => esc_html__( 'Padding (Per Item)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_width',
            [
                'label' => esc_html__( 'Button Width', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_align',
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
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'textdomain' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background__sd',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container.gradient_enable .pricing-footer a:before, {{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );

        $this->add_control(
            'btn_border_gradient_heading',
            [
                'label' => esc_html__( 'Button Border Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_gradient_bg',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container.gradient_enable .pricing-footer a',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );
        $this->add_control(
            'button_border_radius_footer',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-wrapper > li:hover .pricing-footer a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-wrapper > li:hover .pricing-footer a',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-wrapper > li:hover .pricing-footer a',
            ]
        );
        $this->add_control(
            'gradient_color',
            [
                'label'   => esc_html__( 'Gradient Color', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'gradient_disable',
                'options' => [                  
                    'gradient_enable' => esc_html__( 'Enable', 'rsaddon'),
                    'gradient_disable' => esc_html__( 'Disable', 'rsaddon'),
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_btn_hover',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container .exclusive .pricing-wrapper > li:hover .pricing-footer a',
                'condition' => [
                    'gradient_color' => 'gradient_disable',
                ], 
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_btn_hover_gradientds',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container.gradient_enable .pricing-wrapper > li:hover .pricing-footer a:before',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_active',
            [
                'label' => esc_html__( 'Active', 'rsaddon' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_active_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper > li .pricing-footer a',
            ]
        );
        $this->add_control(
            'button_active_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .exclusive.item-active .pricing-wrapper > li .pricing-footer a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $pricing_style = $settings['pricing_style'];

        ?>
        

        <div class="pricing-container rs-pricing-container <?php echo esc_attr( $settings['gradient_color'] ); ?> style<?php echo esc_attr($pricing_style);?>">
             <?php if(($settings['duration_swither_show_hide'] == 'yes') ){ ?>
                <div class="pricing-switcher">
                    <p class="fieldset mnt-ac" style="text-align:
                    center;">
                        <input type="radio" name="duration-1" value="monthly" id="monthly-1" checked>
                        <label for="monthly-1" id ="rsmnt" class="rs-mnt"><?php echo wp_kses_post($settings['monthly_title']);?>  </label>
                        <input type="radio" name="duration-1" value="yearly" id="yearly-1">
                        <label for="yearly-1" id ="rsyrs" class="rs-yrs"><?php echo wp_kses_post($settings['yearly_title']);?>  </label>
                        <span class="switch"></span>
                    </p>
                </div>
            <?php }

            if('1' == $settings['pricing_style']){
                    include plugin_dir_path(__FILE__)."/style1.php";
            } ?>

        </div>
        <?php
    }  
}

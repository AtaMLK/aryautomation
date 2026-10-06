<?php
/**
 * Pricing table widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Pricing_Table_Widget extends \Elementor\Widget_Base {

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
        return 'rsprice';
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
        return esc_html__( 'RS Pricing Table', 'rsaddon' );
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
        return [ 'pricing', 'table', 'package', 'product', 'plan' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'_section_global',
			[
				'label' => esc_html__( 'Global', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'primary_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Scheme', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Scheme', 'rsaddon'),				
					'secondary_scheme' => esc_html__('Secondary Scheme', 'rsaddon'),
                    'gradient_scheme' => esc_html__('Gradient Scheme', 'rsaddon'),
				],											
			]
		);
        $this->add_control(
			'pricing_style',
			[
				'label'   => esc_html__( 'Pricing Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [					
					'1' => esc_html__( 'Style 1', 'rsaddon'),
					'2' => esc_html__( 'Style 2', 'rsaddon'),
					'3' => esc_html__( 'Style 3', 'rsaddon'),
					'4' => esc_html__( 'Style 4', 'rsaddon'),
				],
                'separator' => 'before',
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Header', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Basic', 'rsaddon' ),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_icon',
            [
                'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );  

        $this->add_control(
            'selected_image_postion',
            [
                'label' => esc_html__( 'Select Image & Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__( 'Top', 'rsaddon' ),
                    'middle' => esc_html__( 'Middle', 'rsaddon' ),
                   
                ],
                'default' => 'top',            
            ]
        );       

        $this->start_controls_tabs(
            'style_tabs_icon'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Select Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICON,
                'options' => rsaddon_pro_get_icons(),                         
            ]
        );       

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Image', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        ); 

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => esc_html__( 'Pricing', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__( 'Currency', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => esc_html__( 'None', 'rsaddon' ),
                    'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'rsaddon' ),
                    'bdt' => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'rsaddon' ),
                    'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'rsaddon' ),
                    'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'rsaddon' ),
                    'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'rsaddon' ),
                    'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'rsaddon' ),
                    'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'rsaddon' ),
                    'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'rsaddon' ),
                    'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'rsaddon' ),
                    'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'rsaddon' ),
                    'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'rsaddon' ),
                    'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'rsaddon' ),
                    'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'rsaddon' ),
                    'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'rsaddon' ),
                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'rsaddon' ),
                    'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'rsaddon' ),
                    'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'rsaddon' ),
                    'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'rsaddon' ),
                    'custom' => esc_html__( 'Custom', 'rsaddon' ),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => esc_html__( 'Custom Symbol', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '11.19',
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => esc_html__( 'Period', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Per Month', 'rsaddon' ),
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );
        $this->add_control(
            'heading_watermark',
            [
                'label' => esc_html__( 'Heading Watermark', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'pricing_style' => '1',
                ]
            ]
        );

        $this->end_controls_section();

        // Short Description Start
        $this->start_controls_section(
            '_section_short_desc',
            [
                'label' => esc_html__( 'Short Description', 'rsaddon' ),
                'condition' => [
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_control(
            'short_desc_show_hide',
            [
                'label' => esc_html__( 'Description Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'short_desc',
            [
                'label' => esc_html__( 'Description', 'rsaddon' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Start with a free 14 day trial, no credit card required', 'rsaddon' ),
                'condition'=>[
                    'short_desc_show_hide'=>'yes'
                ]
            ]
        );
        $this->add_control(
            'des_border_circle',
            [
                'label' => esc_html__( 'Before/After Round Circle ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'rsaddon' ),
                    'none' => esc_html__( 'Hide', 'rsaddon' ),
                    'inline-block'  => esc_html__( 'Show', 'rsaddon' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .short-desc::before, {{WRAPPER}} .rs-price-table .short-desc::after' => 'display: {{VALUE}};',
                ],
                'condition'=>[
                    'short_desc_show_hide'=>'yes'
                ]
            ]
        );



        $this->end_controls_section();
        // Short Description End

        $this->start_controls_section(
            '_section_features',
            [
                'label' => esc_html__( 'Features', 'rsaddon' ),
                'condition' => [
                    'pricing_style!' => '3'
                ]
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Features', 'rsaddon' ),
                'separator' => 'after',
            ]
        );


        $this->add_control(
            'icon_show',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'icon_postion',
            [
                'label'   => esc_html__( 'Icon Position', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [                  
                    'left' => esc_html__( 'Left', 'rsaddon'),
                    'right_position' => esc_html__( 'Right', 'rsaddon'),
                ],
                'condition' => [
                    'icon_show' => 'yes'
                ]
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Exciting Feature', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
			'text_current_item',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .rs-pricing-table-feature-text' => 'color: {{VALUE}} !important;'
				],
			]
		);
        $repeater->add_control(
			'icon_current_item',
			[
				'label' => esc_html__( 'Icon Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}} !important;',
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}} !important;'
				],
			]
		);

        $repeater->add_control(
            'icon_show',
            [
                'label' => esc_html__( 'Icon Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'text_line_through',
            [
                'label' => esc_html__( 'Text Line Through', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_show' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__( 'Awesome Features', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__( 'Responsive Pricing Table', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__( 'Yearly Subscribe', 'rsaddon' ),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => esc_html__( 'Professional Design', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_footer',
            [
                'label' => esc_html__( 'Footer', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Subscribe', 'rsaddon' ),
                'placeholder' => esc_html__( 'Type button text here', 'rsaddon' ),
                'label_block' => false,
            ]
        );

        $this->add_control(
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

        $this->add_control(
            'btn_icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICONS,
                'separator' => 'before',            
            ]
        );
        $this->add_control(
            'btn_bottom_text_show',
            [
                'label' => esc_html__( 'Button Bottom Text', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'btn_bottom_text_',
            [
                'label' => esc_html__( 'Button Bottom Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Expire on: 02.06.2023', 'rsaddon' ),
                'label_block' => false,
                'condition' => [
                    'btn_bottom_text_show' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'btn_arrow_rotate',
            [
                'label' => esc_html__( 'Button Rotate Enable?', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_badge',
            [
                'label' => esc_html__( 'Badge', 'rsaddon' ),
                'condition' => [
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__( 'Badge Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Popular', 'rsaddon' ),
                'placeholder' => esc_html__( 'Type badge text', 'rsaddon' ),
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_shape_icon',
            [
                'label' => esc_html__( 'Shape Icon', 'rsaddon' ),
                'condition' => [
                    'pricing_style' => '4',
                ],
            ]
        );

        $this->add_control(
            'shape_icon_show_hide',
            [
                'label' => esc_html__( 'Shape Icon Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'shape_icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();
    
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'General', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}}  .elementor-widget-container' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'general_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'general_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'general_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        $this->start_controls_tabs( '_tabs_general' );

        $this->start_controls_tab(
            'general_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title,'
                    . '{{WRAPPER}} .rs-pricing-table-currency,'
                    . '{{WRAPPER}} .rs-pricing-table-period,'
                    . '{{WRAPPER}} .rs-pricing-table-features-title,'
                    . '{{WRAPPER}} .rs-pricing-table-features-list li,'
                    . '{{WRAPPER}} .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_colord',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .rs-price-table'
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'general_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-title,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-currency,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-period,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-title,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-list li,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_colordd',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_hover_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Pricing Overlayer Style Start
        $this->start_controls_section(
            '_section_style_overlayer',
            [
                'label' => esc_html__('Overlayer Style', 'rsaddon'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'overlay_show_hide',
            [
                'label' => esc_html__( 'Show / Hide', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Show', 'rsaddon' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'rsaddon' ),
                        'icon' => 'eicon-close',
                    ],
                ],
                'default' => 'none',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table::after' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'overlay_border',
                'selector' => '{{WRAPPER}} .rs-price-table::after',
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_bg',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-price-table::after',
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_top',
            [
                'label' => esc_html__( 'Top', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table::after' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_right',
            [
                'label' => esc_html__( 'Right', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table::after' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table::after' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_left',
            [
                'label' => esc_html__( 'Left', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->end_controls_section();
        // Pricing Overlayer Style End

        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_icon' );

        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'icon_hover_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_hover_bg',
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_icon_inner',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Icon Inner Part', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Icon Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .rs-pricing-icon i, {{WRAPPER}} .rs-pricing-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__( 'Icon Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .rs-pricing-icon i, {{WRAPPER}} .rs-pricing-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 

        $this->add_responsive_control(
            'icon_line_height',
            [
                'label' => esc_html__( 'Line Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .rs-pricing-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );

        $this->start_controls_tabs( '_tabs_icon_inner' );

        $this->start_controls_tab(
            'icon_inner_normal_tab',
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
                    '{{WRAPPER}} .rs-pricing-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_inner_bg',
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-icon  i',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_inner_border',
                'selector' => '{{WRAPPER}} .rs-pricing-icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_inner_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_inner_top',
            [
                'label' => esc_html__( 'Top Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'margin-top: {{SIZE}}{{UNIT}};',
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
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_left_transform',
            [
                'label' => esc_html__( 'Transform Left/Right', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_inner_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon  i ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_inner_hover_bg',
                'label' => esc_html__( 'Icon Hover Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_inner_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_inner_hover_border_radius',
            [
                'label' => esc_html__( 'Hover Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_left_position',
            [
                'label' => esc_html__( 'Hover Left Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_left_transform',
            [
                'label' => esc_html__( 'Hover Transform Left/Right', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();   

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );


        $this->add_responsive_control(
            'icon_bottom_spacing',
            [
                'label' => esc_html__( 'Icon Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 3,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'margin-bottom: {{SIZE}}{{UNIT}} ;',
                ],                
            ]
        );

       
        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Image Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .rs-pricing-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Image Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );                    

        $this->end_controls_section();  

        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => esc_html__( 'Header', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; z-index: 1; position: relative;',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'header_border',
                'selector' => '{{WRAPPER}} .rs-price-table.style-4 .rs-pricing-table-header',
                'condition' => ['pricing_style' => '4']
               
            ]
        );

        $this->start_controls_tabs( '_tabs_header' );

        $this->start_controls_tab(
            'header_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-header',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'header_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_hover_bg',
                'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-header',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
			'header_overlay_color_heading',
			[
				'label' => esc_html__( 'Header Overlay', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'pricing_style' => '2'
                ]
			]
		);
        $this->add_control(
			'header_overlay_color',
			[
				'label' => esc_html__( 'Overly Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-price-table.style-2 .rs-pricing-table-header:after' => 'background: {{VALUE}}',
				],
                'condition' => [
                    'pricing_style' => '2'
                ]
			]
		);

        $this->add_control(
			'header_title_heading',
            [
                'label' => esc_html__( 'Title Style', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'title_display_style',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                    'inline-block' => [
                        'title' => esc_html__( 'Inline Block', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'flex' => [
                        'title' => esc_html__( 'Flex', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                ],
				'default' => 'block',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'display: {{VALUE}};',
                    '{{WRAPPER}} .rs-price-table.style-4 .rs-pricing-table-header' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_f_y_align',
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
					'title_display_style' => ['flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .rs-price-table.style-4 .rs-pricing-table-header' => 'align-items: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'title_f_x_align',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
				'condition' => [
					'title_display_style' => ['flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .rs-price-table.style-4 .rs-pricing-table-header' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'title_f_column_align',
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
					'title_display_style' => ['flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'flex-direction: {{VALUE}};',
                    '{{WRAPPER}} .rs-price-table.style-4 .rs-pricing-table-header' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-title',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .rs-pricing-table-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_title' );

        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_hover_bg',
                'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow_hover',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-title',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_pricing',
            [
                'label' => esc_html__( 'Pricing', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_inline',
            [
                'label' => esc_html__( 'Display Inline', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Disable', 'rsaddon' ),
                    'display-inline' => esc_html__( 'Enable', 'rsaddon' ),
                    'display-inline2' => esc_html__( 'Enable 2', 'rsaddon' ),
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );
        $this->add_control(
            'price_gradient_color_setting',
            [
                'label'   => esc_html__( 'Pricing Txt Gradient Color ', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    ''               => esc_html__( 'Default', 'rsaddon'),
                    'price-gradient-color' => esc_html__( 'Enable', 'rsaddon'),
                ],
            ]
         );
         $this->add_group_control(
         Group_Control_Background::get_type(),
            [
                'name' => 'price__gradient_color',
                'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn i',
                'condition'=>[
                    'price_gradient_color_setting'=> ['price-gradient-color'],
                ]
            ]
         );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pricing_area_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-price .rs-pricing-table-price-tag',
            ]
        );

        $this->add_control(
            '_heading_price',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Price', 'rsaddon' ),
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'price_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_pricing' );

        $this->start_controls_tab(
            'pricing_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
               [
                   'name' => 'pricing_text_bg__gradient_color',
                   'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                   'types' => [ 'classic', 'gradient' ],
                   'selector' => '{{WRAPPER}} .rs-pricing-table-price .rs-pricing-table-price-text',
               ]
            );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-price',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pricing_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'price_hover_color',
            [
                'label' => esc_html__( 'Price Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_hover_bg',
                'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-price',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-price .rs-pricing-table-price-tag .rs-pricing-table-price-text',
            ]
        );
        
        $this->add_responsive_control(
            'align_pricing',
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
                    '{{WRAPPER}} .rs-pricing-table-price-tag' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            '_heading_currency',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Currency', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'currency_spacing',
            [
                'label' => esc_html__( 'Side Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'currency_spacing_top_bottom',
            [
                'label' => esc_html__( 'Vertical Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-currency' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                ],
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label' => esc_html__( 'Currency Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-currency,
                    {{WRAPPER}} .rs-price-table.color_primary_scheme .rs-pricing-table-currency,
                    {{WRAPPER}} .rs-price-table.color_secondary_scheme .rs-pricing-table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'currency_hover_color',
            [
                'label' => esc_html__( 'Currency Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-price .rs-pricing-table-currency',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
               [
                   'name' => 'pricing_bg__gradient_color',
                   'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                   'types' => [ 'classic', 'gradient' ],
                   'selector' => '{{WRAPPER}} .rs-pricing-table-price .rs-pricing-table-currency',
               ]
            );
        $this->add_control(
            '_heading_period',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Period', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->add_responsive_control(
            'period_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->add_responsive_control(
            'period_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => esc_html__( 'Period Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->add_control(
            'period_hover_color',
            [
                'label' => esc_html__( 'Period Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-period' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-period',
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->add_control(
            '_heading_separator',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Separator', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
                    'pricing_inline' => 'display-inline',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_spacing_left',
            [
                'label' => esc_html__( 'Left Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_spacing_top',
            [
                'label' => esc_html__( 'Top Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => esc_html__( 'Separator Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .rs-price-table.style-1 .rs-pricing-table-price.display-inline .rs-pricing-table-period:before' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_control(
            'seperator_hover_color',
            [
                'label' => esc_html__( 'Separator Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-period::before' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .rs-price-table.style-1:hover .rs-pricing-table-price.display-inline .rs-pricing-table-period:before' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline',
                    'pricing_style!' => '2',
                ],
            ]
        );
         $this->add_control(
            'water_mark_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Watermark', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );
         $this->add_responsive_control(
            'watermark_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-1 .rs-pricing-table-price .rs-pricing-table-price-tag span.watermark' => 'left: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_responsive_control(
            'watermark_vertical',
            [
                'label' => esc_html__( 'Vertical Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-1 .rs-pricing-table-price .rs-pricing-table-price-tag span.watermark' => 'top: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_control(
            'watermark_color',
            [
                'label' => esc_html__( 'Separator Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-1 .rs-pricing-table-price .rs-pricing-table-price-tag span.watermark' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'pricing_style!' => '2',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'watermark_typography',
                'selector' => '{{WRAPPER}} .rs-price-table.style-1 .rs-pricing-table-price .rs-pricing-table-price-tag span.watermark',
                'condition' => [
                    'pricing_style!' => '2',
                ]
            ]
        );

        $this->end_controls_section();

        // Short Description Stayle Section Start
        $this->start_controls_section(
            '_section_style_short_desc',
            [
                'label' => esc_html__( 'Short Description', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'short_desc_show_hide' => 'yes',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_control(
            'short_desc_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .short-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_desc_typography',
                'selector' => '{{WRAPPER}} .rs-price-table .short-desc',
            ]
        );

        $this->add_control(
            'short_desc_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .short-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'short_desc_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .short-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'short_desc_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .short-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'short_desc_border',
                'selector' => '{{WRAPPER}} .rs-price-table .short-desc',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'short_desc_background',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table .short-desc',
            ]
        );
        $this->add_control(
            'short_desc_circle__color',
            [
                'label' => esc_html__( 'Circle Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .short-desc::before, {{WRAPPER}} .rs-price-table .short-desc::after' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Short Description Stayle Section End

        $this->start_controls_section(
            '_section_style_features',
            [
                'label' => esc_html__( 'Features', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'align_features',
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
                    '{{WRAPPER}} .rs-pricing-table-features-list' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'features_title_margin',
            [
                'label' => esc_html__( 'Feature Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-1 .rs-pricing-table-body .rs-pricing-table-features-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_features' );

        $this->start_controls_tab(
            'features_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'features_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-body .rs-pricing-table-features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_container_spacing',
            [
                'label' => esc_html__( 'Container Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-body',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'features_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-body',
            ]
        );

        $this->add_control(
            'features_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'features_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-body',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'features_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'features_hover_padding',
            [
                'label' => esc_html__( 'Hover Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_hover_container_spacing',
            [
                'label' => esc_html__( 'Hover Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_hover_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'features_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body',
            ]
        );

        $this->add_control(
            'features_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'features_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_features_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label' => esc_html__( 'Feature Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_hover_color',
            [
                'label' => esc_html__( 'Feature Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-title',
            ]
        );

        $this->add_control(
            '_heading_features_list',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'List', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_list_padding',
            [
                'label' => esc_html__( 'List Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => esc_html__( 'Spacing Between', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list li i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-pricing-table-features-list li svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'feature_icon_gradient_color_setting',
            [
                'label'   => esc_html__( 'Feature Icon Gradient Color ', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    ''               => esc_html__( 'Default', 'rsaddon'),
                    'feature_icon_gradient_color' => esc_html__( 'Enable', 'rsaddon'),
                ],
            ]
         );
        $this->add_group_control(
            Group_Control_Background::get_type(),
               [
                   'name' => 'feature_icon__gradient_color',
                   'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                   'types' => [ 'classic', 'gradient' ],
                   'selector' => '{{WRAPPER}} .rs-pricing-table-features-list li i',
               ]
            );

        $this->add_responsive_control(
            'features_icon_font_size',
            [
                'label' => esc_html__( 'Icon Font Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-pricing-table-features-list li svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_icon_bg',
            [
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list li i' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-pricing-table-features-list li svg' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list li i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-pricing-table-features-list li svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'features_icon_margin',
            [
                'label' => esc_html__( 'Icon Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list li i' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-pricing-table-features-list li svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_icon_border_radius',
            [
                'label' => esc_html__( 'Icon Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list li i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-pricing-table-features-list li svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list > li',
            ]
        );
        $this->add_responsive_control(
            'feature_list_display_style',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                    'flex' => [
                        'title' => esc_html__( 'Flex', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .rs-pricing-table-features-list' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'feature_list_f_y_align',
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
					'feature_list_display_style' => ['flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .rs-pricing-table-features-list' => 'align-items: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'feature_list_f_x_align',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
				'condition' => [
					'feature_list_display_style' => ['flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .rs-pricing-table-features-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'feature_list_f_column_align',
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
					'feature_list_display_style' => ['flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table .rs-pricing-table-features-list' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_list' );

        $this->start_controls_tab(
            'list_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'features_list_color',
            [
                'label' => esc_html__( 'List Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list > li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_list_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list > li',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_list_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list li',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'list_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'features_list_hover_color',
            [
                'label' => esc_html__( 'List Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-list > li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_list_hover_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-list > li',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_list_hover_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list li',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_footer',
            [
                'label' => esc_html__( 'Footer', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_tabs_footer' );

        $this->start_controls_tab(
            'footer_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'footer_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .btn-part',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'footer_border',
                'selector' => '{{WRAPPER}} .btn-part',
            ]
        );

        $this->add_control(
            'footer_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'footer_box_shadow',
                'selector' => '{{WRAPPER}} .btn-part',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'footer_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'footer_hover_padding',
            [
                'label' => esc_html__( 'Hover Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_hover_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .btn-part',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'footer_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .btn-part',
            ]
        );

        $this->add_control(
            'footer_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .btn-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'footer_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .btn-part',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_button',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button', 'rsaddon' ),
                'separetor' => 'before'
            ]
        );

        $this->add_responsive_control(
            'f_button_display_style',
            [
                'label' => esc_html__( 'Display Style (Flex / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline-flex' => [
                        'title' => esc_html__( 'Flex', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
				'default' => 'inline-flex',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'display: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'f_button_vertical_align',
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
					'f_button_display_style' => 'inline-flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'f_button_column_align',
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
					'f_button_display_style' => 'inline-flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'f_button_h_align',
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
					'f_button_display_style' => 'inline-flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_width',
            [
                'label' => esc_html__( 'Button Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'btn_height',
            [
                'label' => esc_html__( 'Button Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 

        $this->add_responsive_control(
            'btn_line_height',
            [
                'label' => esc_html__( 'Line Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'line-height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_position',
            [
                'label' => esc_html__( 'Button Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'top: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_responsive_control(
            'align_btn',
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
                    '{{WRAPPER}} .rs-price-table .btn-part' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_icon_font_size',
            [
                'label' => esc_html__( 'Icon Font Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-pricing-table-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_control(
            'btn__icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .rs-pricing-table-btn svg path' => 'fill: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .rs-pricing-table-btn,
                    {{WRAPPER}} .rs-price-table.color_primary_scheme .rs-pricing-table-btn,
                    {{WRAPPER}} .rs-price-table.color_secondary_scheme .rs-pricing-table-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '
                    {{WRAPPER}} .rs-pricing-table-btn,
                    {{WRAPPER}} .rs-price-table.color_primary_scheme .rs-pricing-table-btn,
                    {{WRAPPER}} .rs-price-table.color_secondary_scheme .rs-pricing-table-btn
                ',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn',
            ]
        );

        $this->add_control(
            'btn_icon_spacing',
            [
                'label' => esc_html__( 'Icon Translate X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn i, {{WRAPPER}} .rs-pricing-table-btn svg' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ], 
            ]
        );
        $this->add_control(
            'btn_gradient_color_setting',
            [
                'label'   => esc_html__( 'Button Txt Gradient Color ', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    ''               => esc_html__( 'Default', 'rsaddon'),
                    'btn-gradient-color' => esc_html__( 'Enable', 'rsaddon'),
                ],
            ]
        );
        $this->add_group_control(
        Group_Control_Background::get_type(),
            [
                'name' => 'pricing__gradient_color',
                'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn i',
                'condition'=>[
                    'btn_gradient_color_setting'=> ['btn-gradient-color'],
                ]
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
                    '{{WRAPPER}} .rs-pricing-table-btn:hover,
                    {{WRAPPER}} .rs-pricing-table-btn:focus,
                    {{WRAPPER}} .rs-price-table.color_primary_scheme .rs-pricing-table-btn:hover,
                    {{WRAPPER}} .rs-price-table.color_secondary_scheme .rs-pricing-table-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'selector' => '
                    {{WRAPPER}} .rs-pricing-table-btn:hover,
                    {{WRAPPER}} .rs-price-table.color_primary_scheme .rs-pricing-table-btn:hover,
                    {{WRAPPER}} .rs-price-table.color_secondary_scheme .rs-pricing-table-btn:hover
                ',
            ]
        );

        $this->add_control(
            'button_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn:hover',
            ]
        );

        $this->add_control(
            'btn_icon_hover_spacing',
            [
                'label' => esc_html__( 'Icon Translate X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn:hover i, {{WRAPPER}} .rs-pricing-table-btn:hover svg' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ], 
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_btn_hoverss',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .btn-part .rs-pricing-table-btn:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => esc_html__( 'Badge', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,                
                'condition' => [
                    'show_badge' => 'yes',
                    'pricing_style!' => '2',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_top_position',
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
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_bottom_position',
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
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_left_position',
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
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_right_position',
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
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'right: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_badge' );

        $this->start_controls_tab(
            '_tab_badge_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__( 'Badge Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
               [
                   'name' => 'bage_bg__gradient_color',
                   'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                   'types' => [ 'classic', 'gradient' ],
                   'selector' => '{{WRAPPER}} .rs-pricing-table-badge',
               ]
            ); 

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_badge_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_hover_color',
            [
                'label' => esc_html__( 'Badge Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_hover_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'button_bottom_text_style',
            [
                'label' => esc_html__( 'Buttom Bottom Text Style', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'btn_bottom_text_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'button_bottom_text',
            [
                'label' => esc_html__( 'Button Bottom Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .btn-bottom-text p,
                    {{WRAPPER}} .rs-price-table.color_primary_scheme .btn-bottom-text p,
                    {{WRAPPER}} .rs-price-table.color_secondary_scheme .btn-bottom-text p' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_bottom_text_typo',
                'selector' => '{{WRAPPER}} .btn-bottom-text p',

            ]
        );
        $this->add_responsive_control(
            'button_bottom_text_margin',
            [
                'label' => esc_html__( 'Button Bottom Text Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-bottom-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'button_bottom_text_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-bottom-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_shape_icon_style',
            [
                'label' => esc_html__( 'Shape Icon', 'textdomain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pricing_style' => '4',
                ],
            ]
        );
        $this->add_control(
            'icon_normal_color',
            [
                'label' => esc_html__( 'Icon Normal Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-4 .pricing-svg svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shape_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-4:hover .pricing-svg svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'shape_icon_width',
            [
                'label' => esc_html__( 'Svg Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-4 .pricing-svg svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'shape_icon_height',
            [
                'label' => esc_html__( 'Svg Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table.style-4 .pricing-svg svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $btn_arrow_rotate = $settings['btn_arrow_rotate'];

        $this->add_render_attribute( 'badge_text', 'class',
            [
                'rs-pricing-table-badge',                
            ]
        );

        

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'rs-pricing-table-title' );

        $this->add_inline_editing_attributes( 'price', 'none' );
        $this->add_render_attribute( 'price', 'class', 'rs-pricing-table-price-text' );

        $this->add_inline_editing_attributes( 'period', 'none' );
        $this->add_render_attribute( 'period', 'class', 'rs-pricing-table-period' );

        $this->add_inline_editing_attributes( 'features_title', 'basic' );
        $this->add_render_attribute( 'features_title', 'class', 'rs-pricing-table-features-title' );

        $this->add_inline_editing_attributes( 'button_text', 'none' );
        $this->add_render_attribute( 'button_text', 'class', 'rs-pricing-table-btn' );

        $this->add_render_attribute( 'button_text', 'href', esc_url( $settings['button_link']['url'] ) );
        if ( ! empty( $settings['button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'button_text', 'target', '_blank' );
        }
        if ( ! empty( $settings['button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'button_text', 'rel', 'nofollow' );
        }

        if ( $settings['currency'] === 'custom' ) {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol( $settings['currency'] );
        }

        $btn_rotate = '';
        if ( $btn_arrow_rotate === 'yes' ) {
            $btn_rotate = 'btn-arrow-rotate';
        } 


       


        ?>
        <div class="rs-price-table style-<?php echo esc_attr($settings['pricing_style']); ?> color_<?php echo esc_html($settings['choose_color_scheme']);?>"> 
            <?php
                if('1' == $settings['pricing_style']){
                    include plugin_dir_path(__FILE__)."/style1.php";
                }
                elseif('2' == $settings['pricing_style']){
                    include plugin_dir_path(__FILE__)."/style2.php";
                }
                elseif('3' == $settings['pricing_style']){ 
                    include plugin_dir_path(__FILE__)."/style3.php"; 
                } else {
                    include plugin_dir_path(__FILE__)."/style4.php"; 
                }
            ?>
        </div>
        <?php
    }
}

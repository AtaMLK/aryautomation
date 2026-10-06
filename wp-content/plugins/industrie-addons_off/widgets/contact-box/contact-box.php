<?php
/**
 * Elementor RS Contact Box Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RScontactbox_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rs-contact-box';
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
		return esc_html__( 'RS Contact Box', 'rsaddon' );
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
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	
	protected function register_controls() {

		// Conatct Box Items Start
		$this->start_controls_section(
			'rs_section_contact_box_items',
			[
				'label' => esc_html__( 'Contact Box Items', 'rsaddon' ),
			]
		);

		$this->add_control(
		    'rs_contact_d_style',
		    [
		        'label' => esc_html__( 'Contact Box Style', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'style1' => esc_html__( 'Style 1', 'rsaddon'),
		        	'style2' => esc_html__( 'Style 2', 'rsaddon'),		

		        ],
		        'default' => 'style1',
		    ]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type_contact_box',
			[
				'label'   => esc_html__( 'Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text_box',
				'dynamic' => [
					'active' => true,
				],
				'options' => [					
					'text_box' => esc_html__( 'Address', 'rsaddon'),
					'email' => esc_html__( 'Email', 'rsaddon'),
					'phone' => esc_html__( 'Phone', 'rsaddon'),
					'button' => esc_html__( 'Phone', 'rsaddon'),
				],
			]
		);

		$repeater->add_control(
			'contact_label',
			[
				'label' => esc_html__( 'label', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Address', 'rsaddon' ),
				'show_label' => false,
				'condition' => [
		            'type_contact_box' => 'text_box'
		        ],
			]
		);

		$repeater->add_control(
			'contact_label_email',
			[
				'label' => esc_html__( 'Email', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
		            'type_contact_box' => 'email'
		        ],
			]
		);

		$repeater->add_control(
			'contact_label_phone',
			[
				'label' => esc_html__( 'Phone', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
		            'type_contact_box' => 'phone'
		        ],
			]
		);

		$repeater->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
					'image' => esc_html__( 'Image', 'rsaddon'),
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICONS,			
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'icon',
				],				
			]
		);

		$repeater->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
		    'icon_position_y',
		    [
		        'label' => esc_html__( 'Icon Space Y', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
		        ],
		    ]
		);
		$repeater->add_control(
		    'icon_position_x',
		    [
		        'label' => esc_html__( 'Icon Space X', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$repeater->add_control(
			'btn_link',
			[
				'label'       => esc_html__( ' Button Link', 'rsaddon' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,					
			]
		);

		$this->add_control(
			'tabs',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'contact_label' => esc_html__( 'Email:', 'rsaddon' ),
						'tab_content' => esc_html__( '(+088)589-8745', 'rsaddon' ),
						'selected_icon' => 'fa fa-home',
					],
					[
						'contact_label' => esc_html__( 'Phone:', 'rsaddon' ),
						'tab_content' => esc_html__( 'support@rstheme.com', 'rsaddon' ),
						'selected_icon' => 'fa fa-phone',
					],
					[
						'contact_label' => esc_html__( 'Address:', 'rsaddon' ),
						'tab_content' => esc_html__( 'New Jesrsy, 1201, USA', 'rsaddon' ),
						'selected_icon' => 'fa fa-map-marker',
					],
				],
				'title_field' => '{{{ contact_label }}}',
			]
		);

		// 

		$this->add_responsive_control(
            'box_wrapper_horizontal_align',
            [
                'label' => esc_html__( 'Box Wrapper Style (Inline / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-contact-box' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'box_wrapper_vertical_align',
            [
                'label' => esc_html__( 'Wrapper Vertical Align', 'rsaddon' ),
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
					'box_wrapper_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-contact-box' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_box_column_align',
            [
                'label' => esc_html__( 'Wrapper Column Direction', 'rsaddon' ),
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
					'box_wrapper_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-contact-box' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'flex_wrapper_box_h_align',
            [
                'label' => esc_html__( 'Wrapper Box Horizontal Align', 'rsaddon' ),
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
					'box_wrapper_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-contact-box' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
		// 

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
                    '{{WRAPPER}} .rs-contact-box .address-item' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
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
                    '{{WRAPPER}} .rs-contact-box .address-item' => 'align-items: {{VALUE}};',
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
                    '{{WRAPPER}} .rs-contact-box .address-item' => 'flex-direction: {{VALUE}};',
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
                    '{{WRAPPER}} .rs-contact-box .address-item' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'align_item',
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
                    '{{WRAPPER}} .rs-contact-box .address-item' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );
        

		$this->add_responsive_control(
		    'text_area_top_space',
		    [
		        'label' => esc_html__( 'Text Area Top Space', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -200,
		                'max' => 500,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text' => 'margin-top: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'item__top_bottom_gap',
		    [
		        'label' => esc_html__( 'Item Area Bottom Space', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -200,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'item__area__last__child__space',
		    [
		        'label' => esc_html__( 'Item Area Last-child Space', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -200,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item:last-child' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
			'vibrate_style',
			[
				'label' => esc_html__( 'Vibrate Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'textdomain' ),
					'unset' => esc_html__( 'Hide', 'textdomain' ),
					'vibrate 0.4s' => esc_html__( 'Show', 'textdomain' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rs-contact-box .address-item:hover .address-icon img' => 'animation: {{VALUE}} !important;',
				],
			]
			
		);
		$this->end_controls_section();
		// Conatct Box Items End

		$this->start_controls_section(
		    'rs_contact_icons',
		    [
		        'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'icon_typography',
		        'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-icon i',
		    ]
		);

		$this->add_responsive_control(
		    'ico _size_svg',
		    [
		        'label' => esc_html__( 'SVG Icon Size', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'ico_image_width',
		    [
		        'label' => esc_html__( 'Image Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'ico_image_height',
		    [
		        'label' => esc_html__( 'Image Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon i' => 'color: {{VALUE}} !important;',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon svg' => 'fill: {{VALUE}} !important;',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon svg path' => 'fill: {{VALUE}} !important;',
		        ],
		    ]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_i_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],                
                'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-icon',
            ]
        );

		$this->add_control(
		    'icon_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Effect Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon:before' => 'background-color: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon:after, {{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'ico _spacing',
		    [
		        'label' => esc_html__( 'Icon Right Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -500,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
					'rs_contact_box_style' => 'flex',
				],
		    ]
		);

		$this->add_responsive_control(
		    'icon_left_position',
		    [
		        'label' => esc_html__( 'Icon Left Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -500,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'left: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
					'rs_contact_box_style' => 'flex',
				],
		    ]
		);

		$this->add_responsive_control(
		    'ico _spacing_top',
		    [
		        'label' => esc_html__( 'Icon Top Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => -500,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon i, {{WRAPPER}} .rs-contact-box .address-item .address-icon svg' => 'top: {{SIZE}}{{UNIT}} !important; position: relative;',
		        ],
		        'condition' => [
					'rs_contact_box_style' => 'flex',
				],
		    ]
		);

		$this->add_responsive_control(
		    'image_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px'],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'image_height',
		    [
				'label'      => esc_html__( 'Height', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);


		$this->add_responsive_control(
		    'icon_line_height',
		    [
		        'label' => esc_html__( 'Line Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'line-height: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'separator' => 'before',

		    ]
		);

		$this->add_responsive_control(
            'align_icon',
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
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'media_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-icon'
		    ]
		);

		$this->add_responsive_control(
		    'icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon, {{WRAPPER}} .rs-contact-box .address-item .address-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		

		$this->add_responsive_control(
			'icon_area_margin',
			[
				'label' => esc_html__( 'Icon Area Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_area_transform_skew',
			[
				'label' => esc_html__( 'Skew Transform', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'deg' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'transform: skewX({{SIZE}}deg);',
				],
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'contact_box_border',
		        'selector' => '{{WRAPPER}} .rs-contact-box .address-icon',
		    ]
		);

		$this->add_control(
			'before_border_enable',
			[
				'label' => esc_html__('Border ON/OFF?', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'before_border',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Before Border', 'prelements'),
				'separator' => 'before',
				'condition' => ['before_border_enable' => 'yes']
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'before_box_border',
		        'selector' => '{{WRAPPER}} .rs-contact-box .address-icon:after,{{WRAPPER}} .rs-contact-box .address-icon:before',
				'condition' => ['before_border_enable' => 'yes']
		    ]
		);

		$this->add_responsive_control(
		    'before_border_width',
		    [
		        'label' => esc_html__( 'Before Border Width/Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-icon:after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
				'condition' => ['before_border_enable' => 'yes']
		    ]
		);

		$this->add_responsive_control(
		    'before_left_width',
		    [
		        'label' => esc_html__( 'Border Left Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-icon:after' => 'left: {{SIZE}}{{UNIT}};',
		        ],
				'condition' => ['before_border_enable' => 'yes']
		    ]
		);
		$this->add_responsive_control(
		    'before_top_width',
		    [
		        'label' => esc_html__( 'Border Top Position', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-icon:after' => 'top: {{SIZE}}{{UNIT}};',
		        ],
				'condition' => ['before_border_enable' => 'yes']
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Label', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
            'label_desc_horizontal_align',
            [
                'label' => esc_html__( 'Label/Text Style (Inline / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-contact-box .address-item .address-text div' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'label_text_vertical_align',
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
                    '{{WRAPPER}} .rs-contact-box .address-item .address-text div' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_text_column_align',
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
                    '{{WRAPPER}} .rs-contact-box .address-item .address-text div' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'label_text_box_h_align',
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
                    '{{WRAPPER}} .rs-contact-box .address-item .address-text div' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
		    'label_color',
		    [
		        'label' => esc_html__( 'Label Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text span.label' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-text span.label',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-contact-box .address-item .address-text span.label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
		    '_section_des_style',
		    [
		        'label' => esc_html__( 'Description', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
		    'des_color',
		    [
		        'label' => esc_html__( 'Description Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text div > a,
					{{WRAPPER}} .rs-contact-box .address-item .address-text div > .des a,
					{{WRAPPER}} .rs-contact-box .address-item .address-text div > .des' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'des_hover_color',
		    [
		        'label' => esc_html__( 'Description Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text div > a:hover,
					{{WRAPPER}} .rs-contact-box .address-item .address-text div > .des a:hover' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text a'
				]
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-contact-box .address-item .address-text .des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-contact-box .address-item .address-text a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
		    'area_spacing',
		    [
		        'label' => esc_html__( 'Area Bottom Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_control(
			'description_right_icon',
			[
				'label'     => esc_html__( 'Select Right Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICONS,			
				'separator' => 'before',				
			]
		);

		$this->add_responsive_control(
		    'description_right_icon_right_space',
		    [
		        'label' => esc_html__( 'Icon Right Space', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text' => 'margin-right: {{SIZE}}{{UNIT}};',
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
	protected function render() {
		$settings = $this->get_settings_for_display(); 

		$layout_style = $settings['rs_contact_d_style']
		?>
		
		

		<!-- Style 1 Start -->
		<div class="rs-contact-box">

		<?php 

			$i = 0;
			foreach ( $settings['tabs'] as $item ) :

				$phone_replace = $item['contact_label_phone'] ?? '';
				$str_phone_replace = str_replace(' ','',$phone_replace);

				$str_phone_replace = $str_phone_replace ?? '';
				$i++;

				$target = $item['btn_link']['is_external'] ? 'target=_blank' : '';
				
			?>
				<div class="address-item box<?php echo esc_attr($settings['rs_contact_d_style']); ?>">

					<?php if(!empty($item['selected_icon']) || !empty($item['selected_image']['url'])){ ?>
		            <div class="address-icon icon_<?php echo esc_html($i); ?> elementor-repeater-item-<?php echo $item['_id'] ?>">
		            	<?php if($item['selected_icon']) { 		            	
		            		Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );		            		    
		            	 } else{ ?>
						 <?php if($layout_style == 'style1') { ?>
						 	<span>
							<?php } ?>
		            		<img src="<?php echo esc_html($item['selected_image']['url']); ?>" alt="Contact Title" />
							<?php if($layout_style == 'style1') { ?>
						 	</span>
							 <?php } ?>
		            	<?php } ?>
		            </div>
		            <?php } ?>

		            <div class="address-text">
		            	<?php if(!empty($item['tab_content'])){ ?>
		            	<div class="text">
		            		<?php if($item['contact_label']){ ?>
		            			<span class="label"><?php echo esc_html($item['contact_label']);?></span>
		            		<?php } ?>
							<?php if( isset($item['btn_link']['url']) && !empty($item['btn_link']['url'])) { ?>
								<a href="<?php echo esc_url($item['btn_link']['url']);?>" <?php if(!empty($target)) { ?> target="<?php echo $target;?>" <?php } ?>>
									<?php } ?>
									<?php if(!empty($item['tab_content'])){ ?>
									<span class="des">
										<?php echo nl2br($item['tab_content']);?>
									</span>
									<?php } ?>
									<?php if( isset($item['btn_link']['url']) && !empty($item['btn_link']['url'])) { ?>
								</a>
							<?php } ?>
			            </div>
			       		<?php } ?>
						   
		            	<?php if(!empty($item['contact_label_phone'])){ ?>
			            	<div class="phone">
			            		<?php if($item['contact_label']){ ?>
			            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
			            		<?php } ?>
				                
				                <a href="tel:<?php echo esc_html($str_phone_replace);?>"><?php echo wp_kses_post($item['contact_label_phone']);?></a>
				            </div>
			       		<?php } ?>
						   

		            	<?php if(!empty($item['contact_label_email'])){ ?>
			            	<div class="email">
			            		<?php if($item['contact_label']){ ?>
			            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
			            		<?php } ?>
				                <a href="mailto:<?php echo esc_html($item['contact_label_email']);?>"><?php echo esc_html($item['contact_label_email']);?></a>
				            </div>
			       		<?php } ?>
						   
		            </div>
					<span class="des-right-icon"><?php Icons_Manager::render_icon( $settings['description_right_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
		        </div>
			<?php endforeach; ?>
		</div>

	<!-- Style 1 End -->	
		
	<?php
	}
}

<?php

/**
 * Elementor RS Button Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Background;


defined('ABSPATH') || die();

class Rsaddon_pro_Button_Widget extends \Elementor\Widget_Base
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
		return 'rs-button';
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
		return esc_html__('RS Button', 'rsaddon');
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
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['button'];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Content', 'rsaddon'),
			]
		);

		$this->add_control(
			'button_style',
			[
				'label'   => esc_html__('Select Button Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'rsaddon'),
					'style2' => esc_html__('Style 2', 'rsaddon'),
					'style3' => esc_html__('Style 3', 'rsaddon')
				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__('Button Text', 'rsaddon'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Sample',
				'placeholder' => esc_html__('Enter Button Text', 'rsaddon'),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'       => esc_html__(' Button Link', 'rsaddon'),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
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
					]
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-button' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'rsaddon'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label'        => esc_html__('Show Icon', 'rsaddon'),
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
				'label' => __('Icon', 'rsaddon'),
				'type' => Controls_Manager::ICONS,
				'default' => [
                    'value' => 'ri-arrow-right-line',
                    'library' => 'reguler',
                ],
                'condition'    => [
                	'show_icon' => 'yes',
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
					'{{WRAPPER}} .rs-button .rs-btn span' => 'flex-direction: {{VALUE}};',
				],
				'condition'    => [
                	'show_icon' => 'yes',
                ]
			]
		);
		$this->add_responsive_control(
			'btn_icon_svg_size',
			[
				'label' => esc_html__('Icon Size', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'show_label' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-button .rs-btn em' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-button .rs-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
					'show_icon' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'space_between',
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
					'{{WRAPPER}} .rs-button .rs-btn span' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
                	'show_icon' => 'yes',
                ]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Button Width', 'rsaddon' ),
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
					'{{WRAPPER}} .rs-button .rs-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );        
        
		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-button .rs-btn' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rs-button .rs-btn svg path' => 'fill: {{VALUE}};',
		        ], 
		    ]
		);
		$this->add_control(
		    'btn_icon_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-button .rs-btn svg path' => 'fill: {{VALUE}};',
		            '{{WRAPPER}} .rs-button .rs-btn i' => 'color: {{VALUE}};',
		        ],
				'condition'    => [
                	'show_icon' => 'yes',
                ]
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-button .rs-btn'				
			]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rs-button .rs-btn',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .rs-button .rs-btn',
		    ]
		);


		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-button .rs-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-button .rs-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button__box_shadow',
		        'selector' => '{{WRAPPER}} .rs-button .rs-btn',
		    ]
		);
		$this->add_responsive_control(
			'btn_icon_top_pos',
			[
				'label' => esc_html__( 'Button Icon Top Position', 'rsaddon' ),
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
					'{{WRAPPER}} .rs-button .rs-btn em' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
                	'show_icon' => 'yes',
                ]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-button .rs-btn:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rs-button .rs-btn:hover svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'btn_icon_hover_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-button .rs-btn:hover svg path' => 'fill: {{VALUE}};',
		            '{{WRAPPER}} .rs-button .rs-btn:hover i' => 'color: {{VALUE}};',
		        ],
				'condition'    => [
                	'show_icon' => 'yes',
                ]
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'btn_background_hover',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-button .rs-btn:before'				
			]
		);
		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border_hover',
		        'selector' => '{{WRAPPER}} .rs-button .rs-btn:hover',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-button .rs-btn:hover',
		    ]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
		$unique = rand(35121, 63250);

		?>
		<div class="rs-button <?php echo esc_attr($settings['button_style']); ?>">
			<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : ''; ?>
			<a class="rs-btn" href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php echo esc_attr($target); ?>>	
				<span><?php echo esc_html($settings['btn_text']); ?> 
				<?php if(($settings['show_icon']) == 'yes') { ?>
					<em>
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
						<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
					</em>	
				<?php } ?>
				</span>
			</a>
		</div>
<?php
	}
}
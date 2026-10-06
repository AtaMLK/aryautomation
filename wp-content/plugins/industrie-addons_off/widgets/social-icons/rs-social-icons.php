<?php

/**
 * Elementor RS Iconbox Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
defined('ABSPATH') || die();
class Rsaddon_Elementor_proSocial_Icons_Widget extends \Elementor\Widget_Base
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
		return 'rs-social-icons';
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
		return esc_html__('RS Social Icons', 'rsaddon');
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

		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__('Social Icons', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'social_style',
			[
				'label'   => esc_html__( 'Social Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rsaddon'),
                    'style2' => esc_html__( 'Style 2', 'rsaddon'),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'social_title',
			[
				'label' => esc_html__( 'Social Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-social-menu ul' => 'display: {{VALUE}};',
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
                    '{{WRAPPER}} .rs-social-menu ul' => 'align-items: {{VALUE}};',
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
                    '{{WRAPPER}} .rs-social-menu ul' => 'flex-direction: {{VALUE}};',
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
                    '{{WRAPPER}} .rs-social-menu ul' => 'justify-content: {{VALUE}};',
                ],
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
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-social-menu ul' => 'justify-content: {{VALUE}}'
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
		    'sticky_social_hide',
		    [
		        'label' => esc_html__( 'Show Sticky', 'rsaddon' ),
		        'type' => Controls_Manager::SWITCHER,
		        'default' => 'no',
		        'options' => [
		            'label_on' => esc_html__( 'Show', 'rsaddon' ),
		            'label_off' => esc_html__( 'Hide', 'rsaddon' ),
		        ],               
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'social_sticky_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-add-sticky',
				'condition' => [
				    'sticky_social_hide' => 'yes',
				] 
			]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sticky_wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .rs-add-sticky',
                'condition' => [
                    'sticky_social_hide' => 'yes',
                ]
            ]
        );


		$repeater = new Repeater();
       
        $repeater->add_control(
            'social_icon',
            [
                'label' => __( 'Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

		$repeater->add_control(
			'social_text',
			[
				'label' => esc_html__( 'Social Text', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'facebook', 'rs-addon' ),
				'label_block' => true,
			]
		);
     

        $repeater->add_control(
			'social_link',
			[
				'label' => esc_html__( 'Link', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '#', 'rsaddon' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

        $this->add_control(
            'social_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                       
                        'social_icon' => 'fa fa-check',
                        'social_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        
                        'social_icon' => 'fa fa-check',
                        'social_link' => [
                            'url' => '#',
                        ],
                    ],
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            '_section_style_connector',
            [
                'label' => esc_html__( 'Social Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'social_title_typography',
				'selector' => '{{WRAPPER}} .social-title',
			]
		);
		$this->add_control(
		    'social_title_color',
		    [
		        'label' => esc_html__( 'Social Title Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .social-title' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		 $this->add_responsive_control(
		    'social_title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .social-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
			'social_title_rotate',
			[
				'label' => esc_html__( 'Social Title Rotate', 'rsaddon' ),
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
					'{{WRAPPER}} .social-title' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'social_width',
			[
				'label' => esc_html__('Social Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-social-menu ul li a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'social_height',
			[
				'label' => esc_html__('Social Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-social-menu ul li a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_line_height',
			[
				'label' => esc_html__('Social Svg Line Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .rs-social-menu ul li a' => 'line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);


		$this->add_responsive_control(
            'social_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-social-menu ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
		    'icon_wrapper_margin',
		    [
		        'label' => esc_html__( 'Wrapper Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-social-menu ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_margin',
		    [
		        'label' => esc_html__( 'List Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-social-menu ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Icon Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-social-menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
			'social_font_size',
			[
				'label' => esc_html__('Icon Size', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .rs-social-menu ul li a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .rs-social-menu ul li a'
            ]
        );

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'social_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-social-menu ul li a',
			]
		);

		$this->add_control(
		    'icon_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-social-menu ul li svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'social_border',
		        'selector' => '{{WRAPPER}} .rs-social-menu ul li a',
				
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'social_hover_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-social-menu ul li a:hover',
			]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,	      
		        'selectors' => [
		            '{{WRAPPER}} .rs-social-menu ul li a:hover svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'hover_social_border',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,	      
		        'selectors' => [
		            '{{WRAPPER}} .rs-social-menu ul li a:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
            '_section_social_text',
            [
                'label' => esc_html__( 'Social Text Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'social_text_typography',
		        'selector' => '{{WRAPPER}} .rs-social-menu.style2 ul li a:hover span',
		    ]
		);

		$this->add_control(
		    'social_text_color',
		    [
		        'label' => esc_html__( 'Social Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,	      
		        'selectors' => [
		            '{{WRAPPER}} .rs-social-menu.style2 ul li a:hover span' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
			'social_top',
			[
				'label' => esc_html__('Social Text Top', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .rs-social-menu.style2 ul li a span' => 'top: {{SIZE}}{{UNIT}};bottom:unset;',
				],
			]
		);

		$this->add_responsive_control(
			'social_bottom',
			[
				'label' => esc_html__('Social Text Bottom', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .rs-social-menu.style2 ul li a span' => 'bottom: {{SIZE}}{{UNIT}};top:unset;',
				],
			]
		);

		$this->add_responsive_control(
			'social_right',
			[
				'label' => esc_html__('Social Text Right', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .rs-social-menu.style2 ul li a span' => 'right: {{SIZE}}{{UNIT}};left:unset;',
				],
			]
		);

		$this->add_responsive_control(
			'social_left',
			[
				'label' => esc_html__('Social Text Left', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .rs-social-menu.style2 ul li a span' => 'left: {{SIZE}}{{UNIT}};right:unset;',
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
		$social_style = $settings['social_style'];
		$sticky_position = ($settings['sticky_social_hide'] == 'yes') ? 'rs-social-sticky' : 'rs-social-sticky-diable' ;

	?>

		<div class="rs-social-menu <?php echo $social_style; ?> <?php echo $sticky_position; ?>">
			<?php 
			$social_title = $settings['social_title'];
			if( $social_title && !empty($social_title)):?>
				<h4 class="social-title"><?php echo esc_html($social_title); ?></h4>
			<?php 
			endif;
			?>
			<ul>
			<?php 
				foreach ( $settings['social_list'] as $index => $social ) : 

				$target       = !empty($social['social_link']['is_external']) ? 'target=_blank' : '';                    
				$link         = !empty($social['social_link']['url']) ? $social['social_link']['url'] : '';

				$social_text = $social['social_text'];

				?>
				<li><a href="<?php echo esc_url($link);?>">
				<?php \Elementor\Icons_Manager::render_icon( $social['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				<span class="social-hover-text"><?php echo $social_text;?></span>
				</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>


<?php
	}
}
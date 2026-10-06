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

class Rsaddon_Elementor_pro_Award_Widget extends \Elementor\Widget_Base
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
		return 'rs-award-widget';
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
		return esc_html__('RS Award Widget', 'rsaddon');
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

		// Service Global Card Start
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__('General', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


            $this->add_control(
                'award_img',
                [
                    'label' => esc_html__('Feature Image', 'rsaddon'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_control(
                'logo_title',
                [
                    'label'       => esc_html__('Logo Title', 'rsaddon'),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'Site of the day',
                    'placeholder' => esc_html__('Services Title', 'rsaddon'),
                    'separator'   => 'before',
                ]
            );

            $this->add_control(
                'logo_subtitle_title',
                [
                    'label'       => esc_html__('Logo Subtitle Title', 'rsaddon'),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'winner',
                    'placeholder' => esc_html__('Services Title', 'rsaddon'),
                    'separator'   => 'before',
                ]
            );

            $this->add_control(
                'year_title',
                [
                    'label'       => esc_html__('Year Title', 'rsaddon'),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => '2020',
                    'separator'   => 'before',
                ]
            );

			$this->add_control(
                'watermark_text',
                [
                    'label'       => esc_html__('Watermark Text', 'rsaddon'),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'in',
                    'separator'   => 'before',
                ]
            );

            $this->add_control(
                'award_title',
                [
                    'label'       => esc_html__('Award Title', 'rsaddon'),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'design award',
                    'separator'   => 'before',
                ]
            );

			$this->add_responsive_control(
				'global_alignment',
				[
					'label' => esc_html__('Alignment', 'prelements'),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__('Left', 'prelements'),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__('Center', 'prelements'),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__('Right', 'prelements'),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__('Justify', 'prelements'),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-award-wrapper .award-inner' => 'text-align: {{VALUE}}'
					]
				]
			);

		$this->end_controls_section();
		$this->start_controls_section(
			'_global__style',
			[
				'label' => esc_html__('Global Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'award_background',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-award-wrapper .award-inner',
			]
		);

		$this->add_control(
			'line_hover_color',
			[
				'label' => esc_html__( 'Line BG Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner:after' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'padding_award',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
		    'inner_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-award-wrapper .award-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'line_border_radius',
		    [
		        'label' => esc_html__( 'Line Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-award-wrapper .award-inner:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'_year__style',
			[
				'label' => esc_html__('Year Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'year_align',
			[
				'label' => esc_html__('Alignment', 'prelements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'prelements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'prelements'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'prelements'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'prelements'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area' => 'text-align: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'year_typography',
				'selector' => '{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area',
			]
		);
		$this->add_control(
			'year_color',
			[
				'label' => esc_html__( 'Year Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'year_margin',
			[
				'label' => esc_html__( 'Year Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'watermark_color',
			[
				'label' => esc_html__( 'Watermark Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'watermark_margin',
			[
				'label' => esc_html__( 'Watermark Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'watermark_typography',
				'selector' => '{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area span',
			]
		);

		$this->add_control(
            'watermark_stroke_color',
            [
                'label' => esc_html__( 'Watermark Stroke Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area span ' => '-webkit-text-fill-color: {{VALUE}};',
                ],                
            ]
        );
       
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'watermark_text_stroke',
                'selector' => '{{WRAPPER}} .rs-award-wrapper .award-inner .year .top-area span',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'_logo__style',
			[
				'label' => esc_html__('Logo Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'logo_width',
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
					'{{WRAPPER}} .rs-award-wrapper .award-inner .award-middle-part img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_logo__title',
			[
				'label' => esc_html__('Logo Title Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_color',
			[
				'label' => esc_html__( 'Title Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .award-middle-part .logo-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'logo9_margin',
			[
				'label' => esc_html__( 'Title Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .award-middle-part .logo-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'logo_title_typography',
				'selector' => '{{WRAPPER}} .rs-award-wrapper .award-inner .award-middle-part .logo-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_logo_subtitle_title',
			[
				'label' => esc_html__('Logo Subtitle Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_subcolor',
			[
				'label' => esc_html__( 'Subtitle Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .award-middle-part .logo-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'logo9_submargin',
			[
				'label' => esc_html__( 'Subtitle Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .award-middle-part .logo-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'logo_subtitle_typography',
				'selector' => '{{WRAPPER}} .rs-award-wrapper .award-inner .award-middle-part .logo-subtitle',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_award_titlestyle',
			[
				'label' => esc_html__('Award Title Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'award_title_color',
			[
				'label' => esc_html__( 'Award title Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .bottom-part .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'award_title_margin',
			[
				'label' => esc_html__( 'Award Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rs-award-wrapper .award-inner .bottom-part .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'award_title_typography',
				'selector' => '{{WRAPPER}} .rs-award-wrapper .award-inner .bottom-part .title',
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

		$logo_title = $settings['logo_title'];
		$logo_subtitle_title = $settings['logo_subtitle_title'];
		$year_title = $settings['year_title'];
		$award_title = $settings['award_title'];
		$watermark_text = $settings['watermark_text'];


	?>

		<div class="rs-award-wrapper">
            <div class="award-inner">
                <div class="year">
                    <div class="top-area"><span><?php echo $watermark_text;?></span><?php echo $year_title;?></div>
                </div>
                <div class="award-middle-part">
				<img class="rs-multi-image" src="<?php echo esc_url($settings['award_img']['url']);?>" alt="image"/>
                    <div class="logo-title"><?php echo $logo_title;?></div>
                    <div class="logo-subtitle"><?php echo $logo_subtitle_title;?></div>
                </div>
                <div class="bottom-part">
                    <h4 class="title"><?php echo $award_title;?></h4>
                </div>
            </div>
		</div>
<?php
	}
}
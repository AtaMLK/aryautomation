<?php

/**
 * Elementor rsgallery Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_Heading_Widget extends \Elementor\Widget_Base
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
		return 'rs-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('RS Heading', 'rsaddon');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
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
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['rsaddon_category'];
	}

	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Heading Info', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => esc_html__('Select Heading Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'rsaddon'),
					'style1' => esc_html__('Style 1', 'rsaddon'),
				],
			]
		);
		$this->add_control(
			'sub_img_icon',
			[
				'label'   => esc_html__('SubTitle Left Image/Icon', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sub_image',
				'options' => [
					'sub_image' => esc_html__('Image', 'rsaddon'),
					'sub_icon' => esc_html__('Icon', 'rsaddon'),
				],
				'separator' => 'before',
				'condition' => [
					'style' => 'style1',
				],
			]
		);

		$this->add_control(
			'sub_left_image',
			[
				'label' => esc_html__('Choose Image', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'sub_img_icon' => 'sub_image',
					'style' => 'style1',
				],

			]
		);

		$this->add_control(
			'sub_rs_icon',
			[
				'label' => esc_html__('Icon', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'sub_img_icon' => 'sub_icon',
					'style' => 'style1',
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'     => esc_html__('Sub Heading Text', 'prelements'),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => esc_html__('Sub Heading', 'prelements'),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'split_text_animation',
			[
				'label'   => esc_html__( 'Split Text Animation', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [
					'disable' => esc_html__( 'Disable', 'rsaddon'),
					'enable' => esc_html__( 'Enable', 'rsaddon'),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'split_text_animation_name',
			[
				'label'   => esc_html__( 'Animation Name', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'split-in-fade',
				'options' => [
					'split-in-fade' => esc_html__( 'Split in Fade', 'rsaddon'),
					'split-in-right' => esc_html__( 'Split in Right', 'rsaddon'),
					'split-in-left' => esc_html__( 'Split in Left', 'rsaddon'),
					'split-in-up' => esc_html__( 'Split in Up', 'rsaddon'),
					'split-in-down' => esc_html__( 'Split in Down', 'rsaddon'),
					'split-in-rotate' => esc_html__( 'Split in Rotate', 'rsaddon'),
					'split-in-scale' => esc_html__( 'Split in Scale', 'rsaddon'),
				],
				'condition' => [
					'split_text_animation' => 'enable'
				]
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__('Select Heading Tag', 'prelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__('H1', 'prelements'),
					'h2' => esc_html__('H2', 'prelements'),
					'h3' => esc_html__('H3', 'prelements'),
					'h4' => esc_html__('H4', 'prelements'),
					'h5' => esc_html__('H5', 'prelements'),
					'h6' => esc_html__('H6', 'prelements'),
					'div' => esc_html__('div', 'prelements'),
					'p' => esc_html__('p', 'prelements'),
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__('Heading Text', 'prelements'),
				'type' => Controls_Manager::TEXTAREA,
				'description'	=> esc_html__('Hightlight Title Settings will be worked, If you use this <span>Text</span> format', 'prelements'),
				'default' => esc_html__('Heading Style', 'prelements'),
			]
		);

		$this->add_control(
			'content',
			[
				'label'   => esc_html__('Description', 'prelements'),
				'type'    => Controls_Manager::WYSIWYG,
				'rows'    => 10,
			]
		);
		$this->add_responsive_control(
			'heading_align',
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
					'{{WRAPPER}} .prelements-heading' => 'text-align: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__('Heading Style', 'prelements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Title', 'prelements'),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'prelements'),
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_stroke_color',
			[
				'label' => esc_html__('Title Stroke Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => '-webkit-text-stroke: 1px {{VALUE}}!important;',
				],
			]
		);


		$this->add_control(
			'title_fill_stroke_color',
			[
				'label' => esc_html__('Title Stroke Fill Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => '-webkit-text-fill-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_responsive_control(
			'title_writing_mode',
			[
				'label' => esc_html__( 'Writing Mode', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'unset' => esc_html__( 'Normal', 'rsaddon' ),
					'vertical-rl' => esc_html__( 'Vertical', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => 'writing-mode: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_white_space',
			[
				'label' => esc_html__( 'White Space', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'unset' => esc_html__( 'Normal', 'rsaddon' ),
					'nowrap' => esc_html__( 'Nowrap', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => 'white-space: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'line_break_tag_enable',
			[
				'label' => esc_html__( 'Line Break Tag', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'none' => esc_html__( 'Disable', 'rsaddon' ),
					'unset' => esc_html__( 'Enable', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title br' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_background_clip',
			[
				'label' => esc_html__( 'Bg Clip Text', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'unset' => esc_html__( 'Normal', 'rsaddon' ),
					'text' => esc_html__( 'Text', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title' => 'background-clip: {{VALUE}}; -webkit-background-clip: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_clip_text_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title',
				'condition' => [
					'title_background_clip' => 'text'
				]
			]
		);
		// Controls For Style 4

		$this->end_controls_section();

		$this->start_controls_section(
			'rs_subtitle_style',
			[
				'label' => esc_html__('Subtitle Title', 'prelements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__('Subtitle Typography', 'prelements'),
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .sub-text',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Subtitle Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
            'subtitle_fill_stroke_color',
            [
                'label' => esc_html__( 'Subtitle Stroke Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text' => '-webkit-text-fill-color: {{VALUE}};',
                ],                
            ]
        );
       
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'subtitle_text_stroke',
                'selector' => '{{WRAPPER}} .prelements-heading .title-inner .sub-text',
            ]
        );

		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__('Subtitle Margin', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Subtitle Padding', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'sub_border_radius',
			[
				'label' => __('Border Radius', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sub_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .sub-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rs_description_style',
			[
				'label' => esc_html__('Description Title', 'prelements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__('Description Typography', 'prelements'),
				'selector' => '{{WRAPPER}} .prelements-heading .description p,{{WRAPPER}} .prelements-heading .description',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__('Description Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .prelements-heading .description p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc__hover__color',
			[
				'label' => esc_html__('Description Hover Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .description p:hover' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .prelements-heading .description:hover' => 'color: {{VALUE}}!important;',

				],
			]
		);

		$this->add_responsive_control(
			'desc_width',
			[
				'label' => esc_html__( 'Width', 'prelements' ),
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
					'{{WRAPPER}} .prelements-heading .description' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__('Description Margin', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .description,
					{{WRAPPER}} .prelements-heading .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label' => esc_html__('Description Padding', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_highlight_style',
			[
				'label' => esc_html__('Highlight Title', 'prelements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'highlight_setting',
			[
				'label'   => esc_html__('Select Heading Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' => esc_html__('Normal', 'rsaddon'),
					'stroke_color' => esc_html__('Stroke', 'rsaddon'),
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hightlight_typography',
				'label' => esc_html__('Hightlight Typography', 'prelements'),
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title span, {{WRAPPER}} .description span',
			]
		);

		$this->add_control(
			'highlight_color',
			[
				'label' => esc_html__('Highlight Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title span, {{WRAPPER}} .prelements-heading .title-inner .title span a, {{WRAPPER}} .description span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'highlight_color_hover',
			[
				'label' => esc_html__('Highlight Color Hover', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title span:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'highlight_title_stroke_color',
			[
				'label' => esc_html__('Highlight Stroke Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title span' => '-webkit-text-stroke: 2px {{VALUE}};',
				],
				'condition' => [
					'highlight_setting' => 'stroke_color',
				],
			]
		);
		$this->add_control(
			'hightlight_title_fill_stroke_color',
			[
				'label' => esc_html__('Highlight Stroke Fill Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title span' => '-webkit-text-fill-color: {{VALUE}};',
				],
				'condition' => [
					'highlight_setting' => 'stroke_color',
				],
			]
		);
		$this->add_responsive_control(
			'highlight_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'highlight_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_icon_style',
			[
				'label' => esc_html__('Image/Icon Title', 'prelements'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'style1',
				],
			]
		);


		

		$this->add_responsive_control(
			'sub_image_margin',
			[
				'label' => esc_html__('Margin', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .prelements-heading .title-inner span.sub-text svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'style1',
				],
			]
		);
		$this->add_responsive_control(
			'subimage_height',
			[
				'label' => esc_html__('Height', 'prelements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text svg' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'style1',
				],

			]
		);
		$this->add_responsive_control(
			'subimage_width',
			[
				'label' => esc_html__('Width', 'prelements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prelements-heading .title-inner .sub-text svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'style1',
				],

			]
		);

		$this->add_control(
			'subtitle_svg__color',
			[
				'label' => esc_html__('Subtitle Svg Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prelements-heading .title-inner span.sub-text svg' => 'fill: {{VALUE}}!important;',
					'{{WRAPPER}} .prelements-heading .title-inner span.sub-text svg path' => 'fill: {{VALUE}}!important;',

				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$layout_style = $settings['style'];
		$main_title   = ($settings['title']) ? '<' . $settings['title_tag'] . ' class="title rs-split-text-'. esc_attr($settings['split_text_animation']) .' ' . esc_attr($settings['split_text_animation_name']) .'">' 
		. wp_kses_post($settings['title']) . 
		'</' . $settings['title_tag'] . '>' : '';

		$heading_align = '';
		if (!empty($settings['heading_align'])) {
			$align = $settings['heading_align'];
		}


?>

		<div class="prelements-heading <?php echo esc_attr($settings['style']); ?>  <?php echo esc_attr($heading_align); ?>">
			<div class="title-inner">
				<?php
				if (!empty($settings['subtitle'])) {
					$sub_left_img = '';
				?>
					<span class="sub-text">
						<?php
						if ($layout_style == 'style1') {
							if (!empty($settings['sub_left_image']['url'])) {
								$sub_left_img = '<img src="' . $settings['sub_left_image']['url'] . '" alt="icon">';
							}
							if (!empty($settings['sub_rs_icon']['value'])) {
								\Elementor\Icons_Manager::render_icon($settings['sub_rs_icon'], ['aria-hidden' => 'true']);
							}
						}
						?>
						<?php
						echo $sub_left_img;
						echo $settings['subtitle'];
						?>
					</span>
				<?php }

				// default style
				echo wp_kses_post($main_title);
				?>

			</div>
			<?php if ($settings['content']) { ?>
				<div class="description">
					<?php echo wp_kses_post($settings['content']); ?>
				</div>
			<?php } ?>
		</div>
<?php
	}
} ?>
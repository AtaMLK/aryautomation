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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined('ABSPATH') || die();

class Rsaddon_Portfolio_Slider_Pro_Widget extends \Elementor\Widget_Base
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
		return 'portfolio-slider';
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
		return __('RS Portfolio Slider', 'rsaddon');
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


		$post_dropdown[0] = 'Select Portfolio';
		$wp_portfolio_query = new wp_Query(array(
			'post_type'      => 'portfolios',
			'posts_per_page' => '-1',
		));

		if ($wp_portfolio_query->have_posts()) :
			while ($wp_portfolio_query->have_posts()) : $wp_portfolio_query->the_post();
				$id    = get_the_ID($wp_portfolio_query->ID);
				$title = get_the_title($wp_portfolio_query->ID);
				$post_dropdown[$id] = $title;
			endwhile;
			wp_reset_query();
		endif;

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'portfolio_slider_style',
			[
				'label'   => esc_html__('Select Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2',
					'3' => 'Style 3',
					'4' => 'Style 4',
					'5' => 'Style 5',
				],
			]
		);
		$this->add_control(
			'portfolio_is_manual_selection',
			[
				'label' => esc_html__('Select Portfolio by:', 'prelements'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'yes'       => esc_html__('Selected Portfolio', 'prelements'),
					''        => esc_html__('Category Portfolio', 'prelements'),
				],
			]
		);
		$this->add_control(
			'portfolio_category',
			[
				'label'   => esc_html__('Category', 'rsaddon'),
				'type'    => Controls_Manager::SELECT2,
				'default' => 0,
				'options' => $this->getCategories(),
				'multiple' => true,
				'condition' => ['portfolio_is_manual_selection' => ''],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'select_portfolio_item',
			[
				'label'   => esc_html__('Select Portfolio', 'prelements'),
				'type'    => Controls_Manager::SELECT2,
				'default' => 0,
				'options' => [] + $post_dropdown,
				'multiple' => true,
				'condition' => ['portfolio_is_manual_selection' => 'yes'],
			]
		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__('Portfolio Show Per Page', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('example 3', 'rsaddon'),
				'separator' => 'before',
				'prefix_class' => 'faridmia',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
				'separator' => 'before',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'cat_show_hide',
			[
				'label' => esc_html__('Show Category', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'btn__show_hide',
			[
				'label' => esc_html__('Button Show', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'btn__title',
			[
				'label' => esc_html__('Button Title', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('View Project', 'rsaddon'),
				'placeholder' => esc_html__('Button Title', 'rsaddon'),
				'condition' => [
					'btn__show_hide' => 'yes'
				],
			]
		);
		$this->add_control(
			'btn__icon',
			[
				'label' => esc_html__('Icon', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
					'btn__show_hide' => 'yes'
				],
			]
		);

		$this->add_control(
			'number_show_hide',
			[
				'label' => esc_html__('Number Enable?', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'condition' => ['portfolio_slider_style' => '2']
			]
		);

		$this->add_control(
			'clip_path',
			[
				'label' => esc_html__('Clip Path ON/OFF?', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['portfolio_slider_style' => '4']
			]
		);

		$this->end_controls_section();


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
					'{{WRAPPER}} .rs-addon-sliders .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rs-addon-sliders .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__('General Section', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__('Item Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__('Item Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-item',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .rs-portfolio .portfolio-item',
			]
		);

		$this->end_controls_section();

		// image section start
		$this->start_controls_section(
			'section_slider_style_image',
			[
				'label' => esc_html__('Image Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'image_wrapper_width',
			[
				'label'      => esc_html__('Image Wrapper Width', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-img' => 'width: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; min-width: auto !important;',
				],
			]
		);
		$this->add_responsive_control(
			'image__width',
			[
				'label'      => esc_html__('Image Width', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_wrapper_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_wrapper_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_wrapper_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-img, {{WRAPPER}} .rs-portfolio-style5 .portfolio-item:hover .portfolio-img::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_wrapper_border',
				'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-img',
			]
		);
		$this->add_control(
			'image_hover_overlay_color_heading',
			[
				'label' => esc_html__('Image Hover Overlay Background', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_hover_overlay_color',
				'types' => ['classic', 'gradient'],
				'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-img .img-overlay',
			]
		);
		$this->end_controls_section();
		// image section end

		$this->start_controls_section(
			'section_slider_style_title',
			[
				'label' => esc_html__('Title Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .p-title a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Title Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content:hover .p-title a' => 'color: {{VALUE}};',
				],
			]

		);
		$this->add_control(
            'title_hover_line_color',
            [
                'label' => esc_html__( 'Line Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content .p-title a' => 'background-image: linear-gradient(to bottom, {{VALUE}} 0%, {{VALUE}} 100%);',
                ], 
				'condition' => ['portfolio_slider_style' => '4'] 
				         
            ]
        );
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .p-title a,{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .p-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__('Background Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_slider_style_category',
			[
				'label' => esc_html__('Category Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a',
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'category_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'category_color_hover',
			[
				'label' => esc_html__('Color (Hover)', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content:hover .p-category a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'category_bg_color',
			[
				'label' => esc_html__('Background Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'category_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_slider_style_content',
			[
				'label' => esc_html__('Content Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_width',
			[
				'label'      => esc_html__('Width', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'width: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; min-width: auto !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_wrapper_bg',
				'types' => ['classic', 'gradient'],
				'selector' => '
					{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details',
			]
		);
		$this->add_responsive_control(
			'content_wrapper_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_wrapper_border',
				'selector' => '
					{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_wrapper_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '
					{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details',
			]
		);
		$this->add_control(
			'content_position_options_heading',
			[
				'label' => esc_html__('Content Wrapper Position', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_position_options',
			[
				'label'   => esc_html__('Position', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Defalut', 'rsaddon'),
					'absolute' => esc_html__('Absolute', 'rsaddon'),
					'relative' => esc_html__('Relative', 'rsaddon'),
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content' => 'position: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'position: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-content' => 'position: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_position_left',
			[
				'label'      => esc_html__('Left', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details,{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-content' => 'left: {{SIZE}}{{UNIT}} !important;right:unset;',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_position_right',
			[
				'label'      => esc_html__('Right', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details,{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-content' => 'right: {{SIZE}}{{UNIT}} !important;left:unset;',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_position_top',
			[
				'label'      => esc_html__('Top', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details,{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-content' => 'top: {{SIZE}}{{UNIT}} !important;bottom:unset;',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_position_bottom',
			[
				'label'      => esc_html__('Bottom', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details,{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-content' => 'bottom: {{SIZE}}{{UNIT}} !important;top:unset;',
				],
			]
		);
		$this->end_controls_section();

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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
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
					'{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'line-height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_icon_typography',
				'label' => esc_html__('Icon Typography', 'rsaddon'),
				'selector' => '
					{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev::before,
					{{WRAPPER}} .rs-addon-sliders .slick-next::before
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
					'{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev::before,
							{{WRAPPER}} .rs-addon-sliders .slick-next::before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'navigation_arrow_background',
				'types' => ['classic', 'gradient'],
				'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-next
						',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_arrow_border',
				'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-next
						',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'arrow_shadow_custom',
				'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-next
						',
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
					'{{WRAPPER}} .swiper .swiper-button-next:hover,
							{{WRAPPER}} .swiper .swiper-button-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-prev:hover::before,
							{{WRAPPER}} .rs-addon-sliders .slick-next:hover::before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'navigation_arrow_background_hover',
				'types' => ['classic', 'gradient'],
				'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next:hover,
							{{WRAPPER}} .swiper .swiper-button-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-next:hover
						',
			]
		);
		$this->add_control(
			'nav_arrow_border_hover',
			[
				'label' => esc_html__('Border Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper .swiper-button-next:hover,
							{{WRAPPER}} .swiper .swiper-button-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-next:hover' => 'border-color: {{VALUE}};',
				],
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
			'bullet_alignment_dots',
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
					'{{WRAPPER}} .rs-portfolio-slider ul.slick-dots' => 'text-align: {{VALUE}}'
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
		$this->add_control(
			'dots__margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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


		// Button Style Start
		$this->start_controls_section(
			'btn_style',
			[
				'label' => esc_html__('Button Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn__show_hide' => 'yes'
				],
			]
		);

		$this->add_control(
			'btn_top_line_color',
			[
				'label' => esc_html__('Button Border Top Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon' => 'border-top: 1px solid {{VALUE}};',
				],
				'condition' => ['portfolio_slider_style!' => '5']
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label'      => esc_html__('Button Width', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon .prs_btn' => 'width: {{SIZE}}{{UNIT}};display:flex;align-items:center;justify-content:center;',
				],
				'condition' => ['portfolio_slider_style!' => '5']
			]
		);

		$this->add_responsive_control(
			'button_height',
			[
				'label'      => esc_html__('Button Height', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon .prs_btn' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['portfolio_slider_style!' => '5']
			]
		);

		$this->add_responsive_control(
			'button_svgwidth',
			[
				'label'      => esc_html__('Button SVg Width', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn .btn_icon_2 svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn .btn_icon_1 svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_svgheight',
			[
				'label'      => esc_html__('Button SVg Height', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn .btn_icon_2 svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn .btn_icon_1 svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_bottom_normal_position',
			[
				'label'      => esc_html__('Button Bottom Position', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'button_bottom_position',
			[
				'label'      => esc_html__('Button Hover Bottom Position', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item:hover .p-icon' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['portfolio_slider_style!' => '5']
			]
		);

		$this->add_responsive_control(
			'button_right_normal_position',
			[
				'label'      => esc_html__('Button Right Position', 'rsaddon'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon' => 'right: {{SIZE}}{{UNIT}};left:unset;',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn' => 'right: {{SIZE}}{{UNIT}};left:unset;',
				],
			]
		);
		$this->start_controls_tabs(
			'btn__style_tabs'
		);
		$this->start_controls_tab(
			'btn__style_normal_tab',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text,{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn .pbtn_text',
			]
		);
		$this->add_control(
			'btn_text_color',
			[
				'label' => esc_html__('Text Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn .pbtn_text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .p-icon a.prs_btn svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .p-icon a.prs_btn svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text,{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn span.pbtn_icon,{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn .pbtn_text',
			]
		);
		$this->add_control(
			'button_brder_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .p-icon a.prs_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => ['portfolio_slider_style!' => '5']
			]
		);
		$this->add_control(
			'button__margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style4.rs-portfolio-slider .portfolio-item .p-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button__padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .p-icon a.prs_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn span.pbtn_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-portfolio-style4.rs-portfolio-slider .portfolio-item .p-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'portfolio__border',
				'selector' => '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .p-icon a.prs_btn,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text,{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn,{{WRAPPER}} .rs-portfolio-style4.rs-portfolio-slider .portfolio-item .p-icon',
				'condition' => ['portfolio_slider_style!' => '5']
			]
		);
		$this->add_control(
			'btn__icon_bg_color',
			[
				'label' => esc_html__('Icon BG Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon .btn_icon_1' => 'background-color: {{VALUE}};',
				],
				'condition' => ['portfolio_slider_style' => '2']
			]
		);
		$this->add_control(
			'btn__icon_color',
			[
				'label' => esc_html__('Svg Icon Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon .btn_icon_1 svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon .btn_icon_1 svg path' => 'fill: {{VALUE}};',
				],
				'condition' => ['portfolio_slider_style' => '2']
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'btn__style_hover_tab',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn__hover_bg',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn:hover,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text:hover,{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn:hover span.pbtn_icon,{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn:hover .pbtn_text',
			]
		);
		$this->add_control(
			'btn__hover_text_color',
			[
				'label' => esc_html__('Text Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .p-icon a.prs_btn:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .p-icon a.prs_btn:hover svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn:hover .pbtn_text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn:hover .pbtn_icon svg' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style5.rs-portfolio-slider .portfolio-item .p-icon2 a.prs_btn:hover .pbtn_icon svg path' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'portfolio_hover_border',
				'selector' => '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .p-icon a.prs_btn:hover,{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon a.prs_btn .btn_text',
				'condition' => ['portfolio_slider_style!' => '5']
			]
		);

		$this->add_control(
			'btn__icon_hover_bg_color',
			[
				'label' => esc_html__('Icon HOver BG Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon .btn_icon_1:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => ['portfolio_slider_style' => '2']
			]
		);

		$this->add_control(
			'btn__icon_hover_color',
			[
				'label' => esc_html__('Hover Icon Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon .btn_icon_1:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .p-icon .btn_icon_1:hover svg path' => 'fill: {{VALUE}};',
				],
				'condition' => ['portfolio_slider_style' => '2']
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		// Button Style Ens

		// number Style 

		$this->start_controls_section(
			'section_number_style',
			[
				'label' => esc_html__('Number Style', 'prelements'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'number_show_hide' => 'yes',
					'portfolio_slider_style' => '2'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'label' => esc_html__('Number Typography', 'prelements'),
				'selector' => '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .numbering span',
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Number Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .numbering span' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'number_fill_stroke_color',
			[
				'label' => esc_html__('Number Stroke Fill Color', 'prelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .numbering span' => '-webkit-text-fill-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'number_text_stroke',
                'selector' => '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .numbering span',
            ]
        );
		$this->add_responsive_control(
			'number_margin',
			[
				'label' => esc_html__('Number Margin', 'prelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content .numbering span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
			]
		);

		// Controls For Style 4

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

		$settings              = $this->get_settings_for_display();
		$slidesToShow          = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
		$autoplaySpeed         = $settings['slider_autoplay_speed'];
		$number_show_hide      = $settings['number_show_hide'];
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

		$overlay_show_hide = $settings['overlay_show_hide'] ?? '';
		$clip_path = $settings['clip_path'];

		if ( is_rtl() ):
           $rtl= 'true';
		else:
           $rtl= 'false';
		endif;

		$unique = rand(2012, 35120);

		$slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay', 'pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs', 'slider_centers_pad_xl', 'slider_centers_pad_lg', 'slider_centers_pad_md', 'col_lg_2');
?>

		<div class="rsaddon-unique-slider rs-addon-slider rs-portfolio-slider rs-portfolio rs-portfolio-style<?php echo esc_attr($settings['portfolio_slider_style']); ?> slider-style-<?php echo esc_attr($settings['portfolio_slider_style']); ?>  overlay-<?php echo esc_attr($overlay_show_hide); ?> <?php if($clip_path == 'yes') echo "clip-path-enable";?>">

			<div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-sliders slick-dots-<?php echo esc_attr($settings['slider_dots_style']); ?>">
				<?php 
				if ('1' == $settings['portfolio_slider_style']) {
					include plugin_dir_path(__FILE__) . "/style1.php";
				} elseif ('2' == $settings['portfolio_slider_style']) {
					include plugin_dir_path(__FILE__) . "/style2.php";
				} elseif ('3' == $settings['portfolio_slider_style']) {
					include plugin_dir_path(__FILE__) . "/style3.php";
				} elseif ('4' == $settings['portfolio_slider_style']) {
					include plugin_dir_path(__FILE__) . "/style4.php";
				} 
				else {
					include plugin_dir_path(__FILE__) . "/style5.php";
				}
				?>
			</div>
			<div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#rsaddon-slick-slider-<?php echo esc_attr($unique); ?>').each(function(index) {
					var slider_id = jQuery(this).attr('id');
					var slider_conf = jQuery.parseJSON(jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));

					if (typeof(slider_id) != 'undefined' && slider_id != '') {
						jQuery('#' + slider_id ).not('.slick-initialized').slick({
							slidesToShow: parseInt(slider_conf.col_lg),
							centerMode: (slider_conf.centerMode) == "true" ? true : false,
							dots: (slider_conf.sliderDots) == "true" ? true : false,
							arrows: (slider_conf.sliderNav) == "true" ? true : false,
							autoplay: (slider_conf.slider_autoplay) == "true" ? true : false,
							slidesToScroll: parseInt(slider_conf.slidesToScroll),
							centerPadding: slider_conf.slider_centers_pad_xl,
							autoplaySpeed: parseInt(slider_conf.autoplaySpeed),
							pauseOnHover: (slider_conf.pauseOnHover) == "true" ? true : false,
							infinite: true,
							rtl: <?php echo $rtl; ?>,
							loop: (slider_conf.slider_loop) == "true" ? true : false,
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
			});
		</script>

		<?php 
			if ('5' == $settings['portfolio_slider_style']) { ?>
			<script type="text/javascript">
				document.addEventListener("DOMContentLoaded", function() {
					var tooltipTriggers = document.querySelectorAll(".rs-portfolio-style5 .portfolio-item");
					tooltipTriggers.forEach(function(element) {
						element.addEventListener("mousemove", myFunction);
					});
					function myFunction(e) {
						var x = e.clientX;
						var y = e.clientY;
						var tooltipTrigger = e.currentTarget;
						var tooltip = tooltipTrigger.querySelector(".rs-portfolio-style5 .portfolio-content");
						var triggerRect = tooltipTrigger.getBoundingClientRect();
						var offsetX = x - triggerRect.left;
						var offsetY = y - triggerRect.top;
						var tooltipRect = tooltip.getBoundingClientRect();
						var triggerWidth = triggerRect.width;
						var triggerHeight = triggerRect.height;
						var tooltipWidth = tooltipRect.width;
						var tooltipHeight = tooltipRect.height;
						var buffer = 200;
						var maxX = triggerWidth - tooltipWidth + buffer;
						var maxY = triggerHeight - tooltipHeight + buffer;
						var left = Math.min(Math.max(x - triggerRect.left - tooltipWidth / 2, -buffer), maxX);
						var top = Math.min(Math.max(y - triggerRect.top - tooltipHeight / 2, -buffer), maxY);
						tooltip.style.left = left + "px";
						tooltip.style.top = top + "px";
					}
				});
			</script>
		<?php } ?>
<?php
	}
	public function getCategories()
	{
		$cat_list = [];
		if (post_type_exists('portfolios')) {
			$terms = get_terms(array(
				'taxonomy'    => 'portfolio-category',
				'hide_empty'  => true
			));

			foreach ($terms as $post) {
				$cat_list[$post->slug]  = [$post->name];
			}
		}
		return $cat_list;
	}
}

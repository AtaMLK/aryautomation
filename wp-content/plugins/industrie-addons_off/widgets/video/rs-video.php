<?php

/**
 * Elementor RS video Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Group_Control_Background;


defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_RSvideo_Widget extends \Elementor\Widget_Base
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
		return 'rs-video';
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
		return __('RS Video', 'rsaddon');
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
		return ['video'];
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
			'section_counter',
			[
				'label' => esc_html__('Content', 'rsaddon'),
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
					'right' => [
						'title' => esc_html__('Right', 'rsaddon'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'rsaddon'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default'     => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rs-video' => 'text-align: {{VALUE}}'
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_video_style',
			[
				'label'   => esc_html__('Select Video Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'rsaddon'),
					'style2' => esc_html__('Style 2', 'rsaddon'),
				],
			]
		);

		$this->add_control(
			'video_link',
			[
				'label' => esc_html__('Enter Link Here', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__('Video link here', 'rsaddon'),
				'separator' => 'before',
			]
		);


		$this->add_control(
			'section_icons',
			[
				'label' => esc_html__('Icon / Image', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__('Select Icon Type', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__('Icon', 'rsaddon'),
					'image' => esc_html__('Image', 'rsaddon'),

				],
			]
		);



		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'textdomain'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => 'icon',
				],
			]
		);



		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__('Choose Image', 'rsaddon'),
				'type'  => Controls_Manager::MEDIA,

				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$this->add_responsive_control(
			'selected_image_width',
			[
				'label' => esc_html__('Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__('Video Description', 'rsaddon'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => 'Add your video description here',
				'placeholder' => esc_html__('Add your video description here..', 'rsaddon'),
				'separator' => 'before',
			]

		);
		$this->add_control(
			'desc_link',
			[
				'label' => esc_html__( 'Enable Video Link ?', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'rs_video_style' => 'style2'
				]
			]
		);
		$this->add_control(
			'writing_mode',
			[
				'label'   => esc_html__('Writing Mode', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' => esc_html__('Normal', 'rsaddon'),
					'vertical_rl' => esc_html__('Vertical-rl', 'rsaddon'),
					'vertical_lr' => esc_html__('Vertical-lr', 'rsaddon'),
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Content', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Content Text Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-text-video, {{WRAPPER}} .video-desc' => 'color: {{VALUE}};',
				],


			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Content Text Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-text-video:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'desc_link' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_text',
				'selector' => '{{WRAPPER}} .video-desc',

			]
		);

		$this->add_responsive_control(
			'video_title_postion',
			[
				'label' => esc_html__('Content Position Vertical', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-video .video-desc' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_title_horaizontal',
			[
				'label' => esc_html__('Content Position Horizontal', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-video .video-desc' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_full_area_padding',
			[
				'label' => esc_html__('Area Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_inner_area_padding',
			[
				'label' => esc_html__('Inner Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'video_height',
			[
				'label' => esc_html__('Video height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video .video-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'rs_video_style' => 'style5',
				],
			]
		);

		$this->add_responsive_control(
			'video_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video .video-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'rs_video_style' => 'style5',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__('Icon', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'rsaddon'),
				'name' => 'typography_icon',
				'selector' => '{{WRAPPER}} .rs-video .popup-videos i, {{WRAPPER}} .rs-video a i',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'video_icon_width',
			[
				'label' => esc_html__('Icon Wrapper Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
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
					'{{WRAPPER}} .rs-video .popup-videos' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-videos:before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-videos:after' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-text-video img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_icon_height',
			[
				'label' => esc_html__('Icon Wrapper Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
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
					'{{WRAPPER}} .rs-video .popup-videos' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-videos:before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-videos:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'svg_icon_width',
			[
				'label' => esc_html__('SVG Icon Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
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
					'{{WRAPPER}} .rs-video .popup-videos svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'svg_icon_height',
			[
				'label' => esc_html__('SVG Icon Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
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
					'{{WRAPPER}} .rs-video .popup-videos svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_brder_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos, {{WRAPPER}} .rs-video .popup-videos:before , {{WRAPPER}} .rs-video .popup-videos:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_icon_postion_ver',
			[
				'label' => esc_html__('Video Position Vertical', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
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
					'{{WRAPPER}} .rs-video .overly-border' => 'top: {{SIZE}}%;',
				],
			]
		);

		$this->add_responsive_control(
			'video_icon_postion_ht',
			[
				'label' => esc_html__('Video Position Horizontal', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%','px'],
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
					'{{WRAPPER}} .rs-video .overly-border' => 'left: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_left',
			[
				'label' => esc_html__('Icon Left Position', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos i' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-videos svg' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_top',
			[
				'label' => esc_html__('Icon Top Position', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos i' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-videos svg' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'video_close_icon_bg',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Close Icon Background', 'rsaddon'),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'close_icon_gradiant_background',
				'label' => __('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .mfp-close-btn-in .mfp-close',
			]
		);

		$this->start_controls_tabs('_tabs_button');

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'rsaddon'),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-video .popup-videos svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rs-video .popup-videos svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'popup_background',
				'label' => __('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-video .popup-videos, {{WRAPPER}} .rs-video .popup-videos:before',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .rs-video .overly-border',
                'separator' => 'after',
            ]
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__('Hover', 'rsaddon'),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__('Icon  Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-video a:hover i, 
					{{WRAPPER}} .rs-video .rs-icon-inners .popup-text-video:hover i,
					{{WRAPPER}} .rs-video .popup-videos:hover svg,
					{{WRAPPER}} .rs-video .popup-videos:hover svg path' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'popup_hover_background',
				'label' => __('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-video .popup-videos:hover, {{WRAPPER}} .rs-video .popup-videos:hover:before',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrapper',
			[
				'label' => esc_html__('Wrapper', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'wrapper_width',
			[
				'label' => esc_html__('Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video:before' => 'width: {{SIZE}}{{UNIT}};opacity:0.6;',
				],
			]
		);

		$this->add_responsive_control(
			'wrapper_height',
			[
				'label' => esc_html__('Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video:before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bgim',
				'label' => esc_html__('Background', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-video:before',
			]
		);

		$this->add_responsive_control(
			'video_wrapper_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-video:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wrapper_opacity',
			[
				'label' => esc_html__('Wrapper Opacity', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-video:before' => 'opacity: {{SIZE}};',
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
		$rand = rand(12, 3330);

		$this->add_inline_editing_attributes('description', 'basic');
		$this->add_render_attribute('description', 'class', 'video-desc');
		$unique = rand(37121, 68250);
		$align = '';
		if (!empty($settings['align'])) {
			$align = $settings['align'];
		}

?>
		<div class="rs-video video-item-<?php echo esc_attr($rand); ?> writing-<?php echo esc_html($settings['writing_mode']) ?>  <?php echo esc_html($align); ?>   <?php echo esc_html($settings['rs_video_style']); ?>">

			<?php if ($settings['rs_video_style'] == 'style1') { ?>
				<div class="overly-border">
					<?php if (!empty($settings['selected_icon']['value'])) : ?>
						<a class="popup-videos icon-type" href="<?php echo esc_url($settings['video_link']); ?>">
							<?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
						</a>
					<?php endif; ?>

					<?php if (!empty($settings['selected_image'])) : ?>
						<a class="popup-videos image-type" href="<?php echo esc_url($settings['video_link']); ?>"><img src="<?php echo esc_url($settings['selected_image']['url']); ?>" alt="image" /></a>
					<?php endif; ?>
				</div>
				<?php if (!empty($settings['description'])) : ?>
					<div <?php echo $this->print_render_attribute_string('description'); ?>>
						<?php echo wp_kses_post($settings['description']); ?>
					</div>
				<?php endif; ?>

			<?php }; ?>


			<?php if ($settings['rs_video_style'] == 'style2') { ?>
				<div class="overly-border">
					<?php if (!empty($settings['selected_icon']['value']) || !empty($settings['selected_image']['url'])) { ?>
						<div class="icon-area">
							<?php if (!empty($settings['selected_icon']['value'])) : ?>
								<a class="popup-videos icon-type" href="<?php echo esc_url($settings['video_link']); ?>">
									<?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
								</a>
							<?php endif; ?>

							<?php if (!empty($settings['selected_image'])) : ?>
								<a class="popup-videos image-type" href="<?php echo esc_url($settings['video_link']); ?>">
									<img src="<?php echo esc_url($settings['selected_image']['url']); ?>" alt="image" />
								</a>
							<?php endif; ?>
						</div>
					<?php } ?>
				</div>
				<?php if (!empty($settings['description'])) : ?>
					<div <?php echo $this->print_render_attribute_string('description'); ?>>
						<?php if ($settings['desc_link'] == 'yes') { ?>
							<a class="popup-text-video" href="<?php echo esc_url($settings['video_link']); ?>">
								<?php echo wp_kses_post($settings['description']); ?>
							</a>
						<?php } else {
							echo wp_kses_post($settings['description']);
						} ?>
					</div>
				<?php endif; ?>

			<?php }; ?>

		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('.popup-videos, .popup-text-video').magnificPopup({
					disableOn: 10,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});
			});
		</script>

<?php
	}
}

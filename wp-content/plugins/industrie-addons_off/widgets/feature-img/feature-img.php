<?php
/**
 * Feature Image widget.
 *
 */

use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();

class rselementsElementor_Pro_Feature_Img_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve rs hotspot widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rs-feature-img';
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
        return esc_html__( 'RS Featured Image', 'rsaddon' );
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
        return [ 'image', 'feature', 'thumbnail' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Featured Image Size', 'rsaddon' ),
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
			'f_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'f_img_width',
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
					'{{WRAPPER}} .elementor-widget-container img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);
        $this->add_responsive_control(
			'f_img_height',
			[
				'label' => esc_html__( 'Height', 'rsaddon' ),
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
					'{{WRAPPER}} .elementor-widget-container img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'f_img_object_fit',
			[
				'label' => esc_html__( 'Image Fit', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'none' => esc_html__( 'None', 'rsaddon' ),
					'contain' => esc_html__( 'Contain', 'rsaddon' ),
					'cover' => esc_html__( 'Cover', 'rsaddon' ),
					'scale-down' => esc_html__( 'Scale Down', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container img' => 'object-fit: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'f_img_object_position',
			[
				'label' => esc_html__( 'Image Position', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'center center' => esc_html__( 'Center Center', 'rsaddon' ),
					'center left' => esc_html__( 'Center Left', 'rsaddon' ),
					'center right' => esc_html__( 'Center Right', 'rsaddon' ),
					'top center' => esc_html__( 'Top Center', 'rsaddon' ),
					'top left' => esc_html__( 'Top Left', 'rsaddon' ),
					'top right' => esc_html__( 'Top Right', 'rsaddon' ),
					'bottom center' => esc_html__( 'Bottom Center', 'rsaddon' ),
					'bottom left' => esc_html__( 'Bottom Left', 'rsaddon' ),
					'bottom right' => esc_html__( 'Bottom Right', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container img' => 'object-position: {{VALUE}};',
				],
                'condition' => [
                    'f_img_object_fit' => ['contain', 'cover', 'scale-down']
                ]
			]
		);
		
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        the_post_thumbnail($settings['thumbnail_size']);
    }
}
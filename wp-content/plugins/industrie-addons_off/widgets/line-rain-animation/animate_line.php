<?php
/**
 * Image widget class
 *
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_banner_animate_Widget extends \Elementor\Widget_Base {
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
        return 'rs-rain-animates';
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
        return esc_html__( 'RS Rain Line Animation', 'rsaddon' );
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

	protected function register_controls() {

		$this->start_controls_section(
		    'rain_line_style',
		    [
		        'label' => esc_html__( 'Rain Static Line Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT
		    ]
		);

        $this->add_responsive_control(
            'line_wrapper_width',
            [
                'label' => esc_html__( 'Wrapper Width', 'rsaddon' ),             
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
                    '{{WRAPPER}} .rs-rain-animate' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'line_wrapper_opacity',
            [
                'label' => esc_html__( 'Wrapper Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate' => 'opacity: {{SIZE}};',
                ]
            ]
        );

        $this->add_control(
			'line_show_count',
			[
				'label'   => esc_html__( 'Line Show Count', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
                'separator' => 'before',
				'options' => [
					'2' => esc_html__( '2 Line', 'rsaddon'),
					'3' => esc_html__( '3 Line', 'rsaddon'),
					'4' => esc_html__( '4 Line', 'rsaddon'),
					'5' => esc_html__( '5 Line', 'rsaddon'),
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-rain-animate .line'
            ]
        );

		$this->end_controls_section();	

		$this->start_controls_section(
		    'rain_dt_style',
		    [
		        'label' => esc_html__( 'Rain Animate Line Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_CONTENT
		    ]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_dt',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-rain-animate .line:after'
            ]
        );

        $this->add_responsive_control(
            'animation_durationfi',
            [
                'label' => esc_html__( 'Animation Duration', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 30,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate .line:after' => 'animation-duration: {{SIZE}}s !important;',
                ],
            ]
        );

        $this->add_control(
			'animation_heading_line',
			[
				'label' => esc_html__( 'Line Setting', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_responsive_control(
            'animation_delay_one',
            [
                'label' => esc_html__( 'Animation Delay ( One )', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 30,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate .line:nth-child(1):after' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'animation_delay_two',
            [
                'label' => esc_html__( 'Animation Delay ( Two )', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 30,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate .line:nth-child(2):after' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'animation_delay_three',
            [
                'label' => esc_html__( 'Animation Delay ( Three )', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 30,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'line_show_count!' => '2'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate .line:nth-child(3):after' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'animation_delay_four',
            [
                'label' => esc_html__( 'Animation Delay ( Four )', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 30,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'line_show_count!' => ['2', '3']
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate .line:nth-child(4):after' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'animation_delay_five',
            [
                'label' => esc_html__( 'Animation Delay ( Five )', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 30,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'line_show_count!' => ['2', '3', '4']
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate .line:nth-child(4):after' => 'animation-delay: {{SIZE}}s !important;',
                ],
            ]
        );

		$this->end_controls_section();		
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-image' ); ?>
	    <div class="rs-rain-animate">
            <?php if('2' == $settings['line_show_count']){ ?>
                <div class="line"></div>
                <div class="line"></div>
            <?php } ?>  
            <?php if('3' == $settings['line_show_count']){ ?>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            <?php } ?>
            <?php if('4' == $settings['line_show_count']){ ?>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            <?php } ?>
            <?php if('5' == $settings['line_show_count']){ ?>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            <?php } ?>
	    </div>
		<?php
	}

	/**
	 * Render image widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */

	/**
	 * Retrieve image widget link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $settings
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
}
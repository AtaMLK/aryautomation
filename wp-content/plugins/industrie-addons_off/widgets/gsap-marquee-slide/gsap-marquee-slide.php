<?php
/**
 * Marquee Slider Widget class
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
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;



defined( 'ABSPATH' ) || die();

class Rsaddon_GSAP_Marquee_Slider_Widget extends \Elementor\Widget_Base {
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
        return 'rs-gsap-marquee-slide';
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
        return esc_html__( 'RS GSAP Marquee Slider', 'rsaddon');
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
        return [ 'gsap', 'slider', 'marquee', 'marquee slider'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_marquee',
            [
                'label' => esc_html__( 'RS Marquee Text', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'marquee_type',
			[
				'label' => esc_html__( 'Marquee Type', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Text', 'rsaddon' ),
					'image' => esc_html__( 'Image', 'rsaddon' ),
				]
			]
		);

        $this->add_control(
			'slide_direction',
			[
				'label' => esc_html__( 'Direction', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'right' => esc_html__( 'Right', 'rsaddon' ),
					'left' => esc_html__( 'Left', 'rsaddon' ),
				]
			]
		);
        $this->add_control(
			'slide_duration',
			[
				'label' => esc_html__( 'Animation Duration', 'rsaddon' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 5,
                'default' => 50
			]
		);
        $this->add_control(
			'slide_move_to',
			[
				'label' => esc_html__( 'Slide Move To', 'rsaddon' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 5,
                'default' => 1000,
                'description' => esc_html( 'This control will help you to handle animation loop time based on text length (px).', 'rsaddon' ),
                'separator' => 'after',
			]
		);

        $this->add_control(
            'marquee_text',
            [
                'label'       => esc_html__( 'Marquee Text', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Marquee Text', 'rsaddon' ),
                'default' => esc_html__( 'Strategic guidance for business success. Elevate your operations with our expert consultation.', 'rsaddon' ),
                'condition' => [
                    'marquee_type!' => 'image'
                ]
            ]
        );

            $repeater = new Repeater();
            $repeater->add_control(
                'logo_image',
                [
                    'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            $this->add_control(
                'image_list',
                [
                    'label' => esc_html__( 'Images List', 'rsaddon' ),
                    'type' => Controls_Manager::REPEATER,
                    'condition' => [
                        'marquee_type' => 'image'
                    ],
                    'default' => [
                        ['logo_image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['logo_image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['logo_image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['logo_image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['logo_image' => ['url' => Utils::get_placeholder_image_src()]],
                        ['logo_image' => ['url' => Utils::get_placeholder_image_src()]],
                    ],
                    'fields' => $repeater->get_controls(),
                    'title_field' => '{{{ name }}}',
                ]
            );

        $this->end_controls_section();
        

        // General Style Section Start
        $this->start_controls_section(
            '_section_general_style',
            [
                'label' => esc_html__( 'General Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper .slider-item',
                ]
            );
            $this->add_control(
                'color',
                [
                    'label' => esc_html__( 'Color', 'prelements' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper .slider-item' => 'color: {{VALUE}};',
                    ],                
                ]
            );
            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),
                [
                    'name' => 'slide_text_stroke',
                    'selector' => '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper .slider-item',
                ]
            );
            $this->add_responsive_control(
                'text_margin',
                [
                    'label' => esc_html__( 'Margin', 'prelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        // General Style Section End

        // Image Style Section Start
        $this->start_controls_section(
            '_section_image_style',
            [
                'label' => esc_html__( 'Image Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'marquee_type' => 'image'
                ]
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
                        '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper .slider-item.image img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_height',
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
                        '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper .slider-item.image img' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_margin',
                [
                    'label' => esc_html__( 'Margin', 'prelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper .slider-item.image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Css_Filter::get_type(),
                [
                    'name' => 'logo_css_filters',
                    'selector' => '{{WRAPPER}} .rs-marquee-slider-gsap .gsap-marquee .marquee-wrapper .slider-item.image img',
                ]
            );
        $this->end_controls_section();
        // Image Style Section End
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $unique = rand(2012,35120);
        $marquee_text  = $settings['marquee_text'];
    ?>
    <div class="rs-marquee-slider-gsap">
        <div class="gsap-marquee <?php echo esc_attr($settings['slide_direction']); ?> speed-<?php echo esc_attr($settings['slide_duration']); ?> move-to-<?php echo esc_attr($settings['slide_move_to']); ?>">
            <div class="marquee-wrapper">
                <span class="slider-item <?php echo $settings['marquee_type'] ?>">
                    <?php if ('image' == $settings['marquee_type']) {
                        
                        foreach ($settings['image_list'] as $index => $item) :                            
                            $this->add_render_attribute( 'logo_image', 'alt', \Elementor\Control_Media::get_image_alt( $item['logo_image'] ) );
                            $image = $item['logo_image']['url'];
                            if ( ! $image ) {
                                $image = Utils::get_placeholder_image_src();
                            }
                        ?>
                            <?php echo wp_get_attachment_image( $item['logo_image']['id'], ' ' ); ?>
                        <?php endforeach;

                        } else {
                            echo wp_kses_post($marquee_text);
                        } 
                    ?>
                </span>
            </div>
        </div>
    </div>
    <?php    
    }
}
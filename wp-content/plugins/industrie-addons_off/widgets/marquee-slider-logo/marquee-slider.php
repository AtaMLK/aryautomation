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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Marquee_logo_text_Slider_Widget extends \Elementor\Widget_Base {
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
        return 'rs-marquee-logo-slider';
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
        return esc_html__( 'RS Marquee Logo & Text Slider', 'rsaddon');
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
        return [ 'slider', 'marquee', 'marquee slider'];
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
			'slide_speed',
			[
				'label'       => esc_html__( 'Slider Speed', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
                'default' => 6000,
				'placeholder' => esc_html__( '6000', 'rsaddon' ),
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
            'marquee_text',
            [
                'label'       => esc_html__( 'Marquee Text', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Marquee Text', 'rsaddon' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'marquee_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]]
                ]
            ]
        );

        $this->add_control(
            'marquee_direction',
            [
                'label'   => esc_html__( 'Marquee Direction', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [                  
                    '1' => esc_html__( 'Direction Left', 'rsaddon'),
                    '2' => esc_html__( 'Direction Right', 'rsaddon'),
                ],
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
        $this->end_controls_section();

        // General Style Section Start
        $this->start_controls_section(
            '_section_general_style',
            [
                'label' => esc_html__( 'General Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );  

            $this->add_responsive_control(
                'marquee_box_display',
                [
                    'label' => esc_html__( 'Display', 'rsaddon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__( 'Default', 'rsaddon' ),
                        'block' => esc_html__( 'Block', 'rsaddon' ),
                        'inline-block' => esc_html__( 'Inline Block', 'rsaddon' ),
                        'flex' => esc_html__( 'Flex', 'rsaddon' ),
                        'inline-flex' => esc_html__( 'Inline Flex', 'rsaddon' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'marquee_box_y_align',
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
                    'default' => 'center',
                    'condition' => [
                        'marquee_box_display' => ['flex', 'inline-flex'],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner' => 'align-items: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'marquee_box_x_align',
                [
                    'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__( 'Left', 'rsaddon' ),
                            'icon' => 'eicon-align-start-h',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'rsaddon' ),
                            'icon' => 'eicon-align-center-h',
                        ],
                        'flex-end' => [
                            'title' => esc_html__( 'Right', 'rsaddon' ),
                            'icon' => 'eicon-align-end-h',
                        ],
                        'space-between' => [
                            'title' => esc_html__( 'Space Between', 'rsaddon' ),
                            'icon' => 'eicon-justify-space-between-h',
                        ],
                        'space-evenly' => [
                            'title' => esc_html__( 'Space Evenly', 'rsaddon' ),
                            'icon' => 'eicon-justify-space-evenly-h',
                        ],

                    ],
                    'default' => 'center',
                    'condition' => [
                        'marquee_box_display' => ['flex', 'inline-flex'],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'marquee_column_align',
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
                        'marquee_box_display' => ['flex', 'inline-flex'],
                    ],
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'padding',
                [
                    'label' => esc_html__( 'Padding', 'prelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Text Settings Start
            $this->add_control(
                'text_style_heading',
                [
                    'label' => esc_html__( 'Text Style', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .marquee_wrapper_logo .item-inner .rs-marquee-text',
                ]
            );
            $this->add_control(
                'color',
                [
                    'label' => esc_html__( 'Color', 'prelements' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner .rs-marquee-text' => 'color: {{VALUE}};',
                    ],                
                ]
            );
            $this->add_control(
                'text_stroke_enable_disable',
                [
                    'label'   => esc_html__( 'Text Stroke', 'rsaddon' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'disable',
                    'options' => [                  
                        'enable' => esc_html__( 'Enable', 'rsaddon'),
                        'disable' => esc_html__( 'Disable', 'rsaddon'),
                    ]
                ]
            );
            $this->add_control(
                'text_stroke_color',
                [
                    'label' => esc_html__( 'Stroke Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo.stroke-enable .rs-marquee-text' => '-webkit-text-stroke-color: {{VALUE}}; text-stroke-color: {{VALUE}};',                   
                    ],
                    'condition' => [
                        'text_stroke_enable_disable' => 'enable'
                    ]
                ]
            );
            $this->add_responsive_control(
                'text_stroke_width',
                [
                    'label' => esc_html__( 'Stroke Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' ],
                    'show_label' => true,
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo.stroke-enable .rs-marquee-text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}; text-stroke-width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'text_stroke_enable_disable' => 'enable'
                    ]
                ]
            );
            $this->add_responsive_control(
                'text_margin',
                [
                    'label' => esc_html__( 'Margin', 'prelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .rs-marquee-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            // Text Settings End

            // Image Settings Start
            $this->add_control(
                'heading_image_control',
                [
                    'label' => esc_html__( 'Image Settings', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );
            $this->add_responsive_control(
                'image_width',
                [
                    'label'      => esc_html__( 'Width', 'rsaddon' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -20,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner .rs-marquee-image img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                    ]
                ]
            );
            $this->add_responsive_control(
                'image_height',
                [
                    'label'      => esc_html__( 'Height', 'rsaddon' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => -20,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee_wrapper_logo .item-inner .rs-marquee-image img' => 'height: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );
            // Image Settings End
        $this->end_controls_section();
        // General Style Section End
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $unique = rand(2012,35120);

        if ( empty($settings['marquee_list'] ) ) {
            return;
        }
        
        /*----------marquee slider style-------
        -----------------------------*/
        ?>

        <?php if('2' === $settings['marquee_direction']){ ?>

        <div class="marquee_wrapper marquee_wrapper_logo stroke-<?php echo esc_attr($settings['text_stroke_enable_disable']); ?>">
            <div class="rstheme-marquee-slider_<?php echo $unique; ?>" dir="rtl" data-speed="<?php echo esc_attr($settings['slide_speed']); ?>">
                <?php
                    foreach ( $settings['marquee_list'] as $index => $item ) :
                        $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                        
                        $marquee_text  = !empty($item['marquee_text']) ? $item['marquee_text'] : '';
                        ?>
                        <div class="item">
                            <div class="item-inner">
                                <?php if(!empty($item['marquee_text'])) {?>
                                    <div class="rs-marquee-text"> <?php echo esc_html($marquee_text); ?> </div>
                                <?php } ?>
                                <?php if(!empty($item['image']['url'])) {?>
                                    <div class="rs-marquee-image"><img src="<?php echo esc_url( $image ); ?>" alt="marquee image"></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endforeach;
                ?>
            </div>
        </div>

        <script type="text/javascript"> 
            jQuery(document).ready(function(){
                var speedValue = jQuery(".rstheme-marquee-slider_<?php echo $unique; ?>").data("speed");
                jQuery(".rstheme-marquee-slider_<?php echo $unique; ?>").slick({
                    arrows: false,
                    infinite: true,
                    autoplay: true,
                    centerMode: true,
                    dots: false,
                    variableWidth: true,
                    slidesToScroll: 1,
                    speed: speedValue,
                    autoplay: true,
                    autoplaySpeed: 0,
                    cssEase: "linear",
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    draggable: true,
                    rtl: true,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 5
                            }
                        },
                        {
                        breakpoint: 767,
                            settings: {
                                slidesToShow: 3,
                                speed: speedValue,
                                dots: false
                            }
                        }
                    ]
                });
            });
        </script>
        <?php } else { ?>

            <div class="marquee_wrapper marquee_wrapper_logo stroke-<?php echo esc_attr($settings['text_stroke_enable_disable']); ?>">
                <div class="rstheme-marquee-slider_<?php echo $unique; ?>" data-speed="<?php echo esc_attr($settings['slide_speed']); ?>">
                    <?php
                        foreach ( $settings['marquee_list'] as $index => $item ) :
                            $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                            $marquee_text  = !empty($item['marquee_text']) ? $item['marquee_text'] : '';
                            ?>
                            <div class="item">
                                <div class="item-inner">
                                    <?php if(!empty($item['marquee_text'])) {?>
                                        <div class="rs-marquee-text"> <?php echo esc_html($marquee_text); ?> </div>
                                    <?php } ?>
                                    <?php if(!empty($item['image']['url'])) {?>
                                        <div class="rs-marquee-image"><img src="<?php echo esc_url( $image ); ?>" alt="marquee image"></div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endforeach;
                    ?>
                </div>
            </div>

            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    var speedValue = jQuery(".rstheme-marquee-slider_<?php echo $unique; ?>").data("speed");
                    jQuery(".rstheme-marquee-slider_<?php echo $unique; ?>").slick({
                        arrows: false,
                        infinite: true,
                        autoplay: true,
                        centerMode: true,
                        dots: false,
                        variableWidth: true,
                        slidesToScroll: 1,
                        speed: speedValue,
                        autoplaySpeed: 0,
                        cssEase: "linear",
                        pauseOnHover: false,
                        pauseOnFocus: false,
                        draggable: true,
                        rtl: false,
                        responsive: [
                            {
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 5
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 3,
                                    speed: speedValue,
                                    dots: false
                                }
                            }
                        ]
                    });
                });
            </script>

        <?php } ?>
        <?php 
    }
}
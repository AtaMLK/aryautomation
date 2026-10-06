<?php
/**
 * Feature List
 *
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Company_Slogan_Widget extends \Elementor\Widget_Base {

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
        return 'rs-company-slogan';
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
        return esc_html__( 'RS Company Slogan', 'rsaddon' );
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
        return [ 'logo', 'company', 'rs' ];
    }

    // Register Controlls
    protected function register_controls() {
        $this->register_content_controls();
        $this->register_content_style_controls();
    }

    // Content Start
    protected function register_content_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_control(
                'rotate_degree',
                [
                    'label'       => esc_html__( 'Latter Space', 'rsaddon' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => '',
                    'description' => esc_html__( 'Count all letters & divide with 360 (Space also a letter).', 'rsaddon' ),
                    'placeholder' => esc_html__( '20', 'rsaddon' ),
                ]
            );
            $this->add_control(
                'sologan_logot_heading',
                [
                    'label' => esc_html__( 'Slogan Logo', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'show_logo_image',
                [
                    'label' => esc_html__( 'Show Logo Image', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'logo_image',
                [
                    'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'show_logo_image' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'logo_width',
                [
                    'label' => esc_html__( 'Logo Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan .slogan-logo img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_logo_image' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'logo_height',
                [
                    'label' => esc_html__( 'Logo Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan .slogan-logo img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_logo_image' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'logo_line_height',
                [
                    'label' => esc_html__( 'Logo LIne Height', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan .slogan-logo' => 'line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'show_logo_image' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'image_animation',
                [
                    'label' => esc_html__( 'Image Aniamtion', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'rsaddon' ),
                    'label_off' => esc_html__( 'No', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'show_logo_image' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'image_animation_duration',
                [
                    'label' => esc_html__( 'Animation Duration', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan.image-anim-yes .slogan-logo img' => 'animation-duration: {{SIZE}}s;',
                    ],
                    'condition' => [
                        'image_animation' => 'yes',
                        'show_logo_image' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'video_btn_moode',
                [
                    'label' => esc_html__( 'Video Button Mood', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'rsaddon' ),
                    'label_off' => esc_html__( 'no', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                    'condition' => [
                        'show_logo_image' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'video_btn_link',
                [
                    'label' => esc_html__( 'Link', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default'     => '#',
				    'placeholder' => esc_html__( 'Video link here', 'rsaddon' ),
                    'label_block' => true,
                    'condition' => [
                        'show_logo_image' => 'yes',
                        'video_btn_moode' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'btn_link_enable',
                [
                    'label' => esc_html__( 'Button Link Enable?', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'rsaddon' ),
                    'label_off' => esc_html__( 'no', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'btn_link',
                [
                    'label' => esc_html__( 'Link', 'elementor' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => ['btn_link_enable' => 'yes']
                ]
            );

            // Content Text
            $this->add_control(
                'sologan_text_heading',
                [
                    'label' => esc_html__( 'Slogan Text', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'slogan_text',
                [
                    'label'       => esc_html__( 'Slogan Text', 'rsaddon' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'CompanySloganHere.',
                    'placeholder' => esc_html__( 'Company Slogan (No Space)', 'rsaddon' ),
                ]
            );
            $this->add_control(
                'text_animation',
                [
                    'label' => esc_html__( 'Text Aniamtion', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'rsaddon' ),
                    'label_off' => esc_html__( 'No', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            $this->add_control(
                'text_animation_duration',
                [
                    'label' => esc_html__( 'Animation Duration', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                    'default' => [
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan.text-anim-yes .text-wrapper' => 'animation-duration: {{SIZE}}s;',
                    ],
                    'condition' => [
                        'text_animation' => 'yes'
                    ]
                ]
            );
        $this->end_controls_section();
    }

    protected function register_content_style_controls()
    {   
        
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            // Wrapper Style Start
            $this->add_control(
                'wrapper_style_heading',
                [
                    'label' => esc_html__( 'Wrapper Style', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'wrapper_size',
                [
                    'label' => esc_html__( 'Wrapper Size', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 150,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'wrapper_background',
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .rs-company-slogan',
				]
			);
            $this->add_responsive_control(
                'wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'wrapper_border',
                    'selector' => '{{WRAPPER}} .rs-company-slogan',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'wrapper_shadow',
                    'selector' => '{{WRAPPER}} .rs-company-slogan',
                ]
            );
            // Wrapper Style End

            // Logo Style Start
            $this->add_control(
                'logo_style_heading',
                [
                    'label' => esc_html__( 'Logo Style', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'logo_wrapper_size',
                [
                    'label' => esc_html__( 'Wrapper Size', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 90,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan .slogan-logo' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'logo_wrapper_background',
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .rs-company-slogan .slogan-logo',
				]
			);
            $this->add_responsive_control(
                'logo_wrapper_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan .slogan-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'logo_wrapper_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan .slogan-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'logo_wrapper_border',
                    'selector' => '{{WRAPPER}} .rs-company-slogan .slogan-logo',
                ]
            );
            $this->add_control(
                'logo_hover_border',
                [
                    'label' => esc_html__( 'Logo Hover Border', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'logo_wrapper_hover_border',
                    'selector' => '{{WRAPPER}} .rs-company-slogan .slogan-logo:hover',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'logo_wrapper_shadow',
                    'selector' => '{{WRAPPER}} .rs-company-slogan .slogan-logo',
                ]
            );
            // Logo Style End

            // Text Style Start
            $this->add_control(
                'text_style_heading',
                [
                    'label' => esc_html__( 'Text Style', 'rsaddon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'selector' => '{{WRAPPER}} .rs-company-slogan .text-wrapper span',
                ]
            );
            $this->add_control(
                'text_color',
                [
                    'label' => esc_html__( 'Text Color', 'textdomain' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-company-slogan .text-wrapper span' => 'color: {{VALUE}}',
                    ],
                ]
            );
            // Text Style End
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

	protected function render() {        
        $settings = $this->get_settings_for_display(); 
        if ( 'yes' === $settings['show_logo_image']) {
            $image = $settings['logo_image']['url'];
            if ( ! $image ) {
                $image = Utils::get_placeholder_image_src();
            }
        } 

        $link_enable = $settings['btn_link_enable'];
        $unique = rand(2012, 3554120);


        if ( ! empty( $settings['btn_link']['url'] ) ) {
            $this->add_link_attributes( 'btn_link', $settings['btn_link'] );
        }
        
        ?> 
            <div class="rs-company-slogan text-anim-<?php echo esc_html($settings['text_animation']); ?> image-anim-<?php echo esc_html($settings['image_animation']); ?> sologan<?php echo $unique ?>">
                <?php if ( 'yes' === $settings['show_logo_image']):?>
                    <?php 
                        if ( ! empty( $settings['btn_link']['url'] ) ) :
                        ?>
                    <a <?php echo $this->get_render_attribute_string( 'btn_link' ); ?>>
                    <?php endif; ?>
                        <div class="slogan-logo">
                            <?php if ($settings['video_btn_moode'] == 'yes') { ?>
                                <a class="popup-videos" title="Play" href="<?php echo esc_url($settings['video_btn_link']); ?>"><img src="<?php echo esc_url( $image ); ?>" alt="image"/></a>
                            <?php } else { ?>
                                <img src="<?php echo esc_url( $image ); ?>" alt="image"/>
                            <?php } ?>
                        </div>
                        <?php if ( ! empty( $settings['btn_link']['url'] ) ) : ?>
                    </a>
                    <?php endif; ?>
                <?php endif;?>
                <div class="text-wrapper"><?php echo esc_html($settings['slogan_text']);?></div>
            </div>

            <style>
                <?php                
                    $rotate_degree = ($settings['rotate_degree']) ? $settings['rotate_degree'] : '20' ;
                    for ($i = 1; $i <= 100; $i++) {
                        echo ".sologan$unique .text-wrapper .char{$i} {
                            transform: rotate(" . ($i * $rotate_degree) . "deg);
                        }\n";
                    }
                ?>
            </style>
            
            <script>
                jQuery(function() {
                    jQuery(".sologan<?php echo $unique ?> .text-wrapper").lettering();
                });
            </script>
        <?php
    }
}

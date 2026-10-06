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


defined('ABSPATH') || die();

class Rsaddon_Elementor_Pro_Post_Navigation_Widget extends \Elementor\Widget_Base
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
        return 'rspostnavigation';
    }


    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('RS Post Navigation', 'rsaddon');
    }
    /**
     * Get widget icon.
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


    public function get_categories()
    {
        return ['rsaddon_category'];
    }

    public function get_keywords()
    {
        return ['list', 'navigation', 'nav', 'post', 'single post'];
    }

    protected function register_controls()
    {
        // Global Control Start
        $this->start_controls_section(
            '_global_settings',
            [
                'label' => esc_html__('Global Control', 'rsaddon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => esc_html__('Next Icon', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'prev_icon',
            [
                'label' => esc_html__('Prev Icon', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'g_button_wrapper_control_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Wrapper Control', 'prelements'),
            ]
        );

        $this->add_responsive_control(
            'g_button_wrapper_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'g_button_wrapper_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Button Wrapper Cntrol End

        $this->add_control(
            '_hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        // Button Cntrol Start
        $this->add_control(
            'g_button_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Next / Prev Button Control ▼', 'rsaddon'),
            ]
        );

        $this->add_control(
            '_hr2',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'g_button_transition',
            [
                'label' => esc_html__('Transition', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a, {{WRAPPER}} .rs-post-navigation ul li a i, {{WRAPPER}} .rs-post-navigation ul li svg path' => 'transition-duration: {{SIZE}}s;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'g_button_typo',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li a',
            ]
        );

        $this->add_responsive_control(
            'g_button_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'g_button_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'g_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Icon Setting
        $this->add_control(
            'g_button_icon_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Icon Settings', 'rsaddon'),
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'g_button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-post-navigation ul li a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'g_button_icon_color',
            [
                'label' => esc_html__('Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-post-navigation ul li a i'        => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'g_button_icon_color_hover',
            [
                'label' => esc_html__('Icon Color (Hover)', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a:hover svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-post-navigation ul li a:hover i'        => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'g_button_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a svg, {{WRAPPER}} .rs-post-navigation ul li.next a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_hr6',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        // Hover & Noraml Tab Start
        $this->start_controls_tabs('g_button_tabs_section');
        //  Normal
        $this->start_controls_tab(
            'g_button_noraml',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );
        $this->add_control(
            'g_button_color',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'g_button_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'g_button_border',
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li a',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'g_button_box_shadow',
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li a',
            ]
        );
        $this->end_controls_tab();

        // Hover Start
        $this->start_controls_tab(
            'g_button_hover',
            [
                'label' => esc_html__('Hover', 'rsaddon'),
            ]
        );
        $this->add_control(
            'g_button_color_hover',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'g_button_bg_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li a:hover',
            ]
        );
        $this->add_control(
            'g_button_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'g_button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li a:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        // Hover & Noraml Tab End

        // Next Button Control Start
        $this->add_control(
            '_hr3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'button_next_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Only Next Button Control ▼', 'rsaddon'),
            ]
        );

        $this->add_control(
            '_hr4',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_next_typo',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li.next a',
            ]
        );

        $this->add_responsive_control(
            'button_next_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_next_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_next_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Next Button Icon Setting
        $this->add_control(
            'button_next_icon_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Next Icon Settings', 'rsaddon'),
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'button_next_icon_size',
            [
                'label' => esc_html__('Icon Size', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => ['%', 'px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-post-navigation ul li.next a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'button_next_icon_color',
            [
                'label' => esc_html__('Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-post-navigation ul li.next a i'        => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_next_icon_color_hover',
            [
                'label' => esc_html__('Icon Color (Hover)', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a:hover svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-post-navigation ul li.next a:hover i'        => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_next_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a svg, {{WRAPPER}} .rs-post-navigation ul li.next a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_hr5',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        //Next Button Hover & Noraml Tab Start
        $this->start_controls_tabs('button_next_tabs_section');
        //  Normal
        $this->start_controls_tab(
            'button_next_noraml',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );
        $this->add_control(
            'button_next_color',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_next_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li.next a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_next_border',
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li.next a',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_next_box_shadow',
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li.next a',
            ]
        );
        $this->end_controls_tab();

        // Hover Start
        $this->start_controls_tab(
            'button_next_hover',
            [
                'label' => esc_html__('Hover', 'rsaddon'),
            ]
        );
        $this->add_control(
            'button_next_color_hover',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_next_bg_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li.next a:hover',
            ]
        );
        $this->add_control(
            'button_next_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li.next a:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_next_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li.next a:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        // Hover & Noraml Tab End

        $this->end_controls_section();
        // Global Control End

        $this->start_controls_section(
            '_section_style_post_title',
            [
                'label' => esc_html__( 'Title Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'portfolio_title_color',
            [
                'label' => esc_html__('Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a span.link_text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'portfolio_title_hover_color',
            [
                'label' => esc_html__('Text Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a span.link_text:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'portfolio_title_typo',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .rs-post-navigation ul li a span.link_text',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-post-navigation ul li a span.link_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-portfolio-navigation ul li a .link_text:hover',
			]
		);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display(); ?>
        <?php
        $next_post = get_next_post();
        $previous_post = get_previous_post();
        if (!empty($next_post) || !empty($previous_post)) : ?>
            <div class="rs-post-navigation rs-portfolio-navigation">
                <ul>
                    <?php
                    $url_next = is_object($next_post) ? get_permalink($next_post->ID) : '';
                    $title    = is_object($next_post) ? get_the_title($next_post->ID) : '';
                    if ($next_post) : ?>
                        <li class="prev">
                            <a href="<?php echo esc_url($url_next) ?>">
                                <span class="next_link">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php echo esc_html__('Prev Post', 'rsaddon'); ?>
                                </span>
                                <span class="link_text"> <?php echo esc_attr($title); ?></span>
                            </a>
                        </li>
                    <?php endif;
                    $url_previous = is_object($previous_post) ? get_permalink($previous_post->ID) : '';
                    $title = is_object($previous_post) ? get_the_title($previous_post->ID) : '';
                    if ($previous_post) : ?>
                        <li class="next">
                            <a href="<?php echo esc_url($url_previous) ?>">
                                <span class="next_link">
                                    <?php echo esc_html__('Next Post', 'rsaddon'); ?>
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <span class="link_text"><?php echo esc_attr($title); ?> </span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="clearfix"></div>
            </div>
        <?php endif; ?>
<?php
    }
}

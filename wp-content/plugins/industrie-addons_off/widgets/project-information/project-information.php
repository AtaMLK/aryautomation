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

class Rsaddon_Elementor_Pro_Project_Information_Widget extends \Elementor\Widget_Base
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
        return 'rs-project-information';
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
        return esc_html__('RS Project Information', 'rsaddon');
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
        return ['list', 'title', 'features', 'heading', 'plan'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            '_section_header',
            [
                'label' => esc_html__('Content', 'rsaddon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $repeater = new Repeater();
        $repeater->add_control(
            'client_title',
            [
                'label' => esc_html__('Client Title', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Client', 'rsaddon'),
            ]
        );

        $repeater->add_control(
            'client_text',
            [
                'label' => esc_html__('Client Text', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Maverick Harrison', 'rsaddon'),
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'client_title' => esc_html__('Maverick Harrison', 'rsaddon'),
                       
                    ],
                    [
                        'client_title' => esc_html__('Maverick Harrison', 'rsaddon'),
                    ],
                ],
                'title_field' => '{{{ client_title }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_list_wrapper',
            [
                'label' => esc_html__('Wrapper Style', 'rsaddon'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper__bgcolord',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-client-list',
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-client-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-client-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            '_section_style_list',
            [
                'label' => esc_html__('List Style', 'rsaddon'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

       

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__( 'Item Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-client-list-content .rs-client-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item__border',
                'selector' => '{{WRAPPER}} .rs-client-list-content .rs-client-list li',
            ]
        );


        $this->add_responsive_control(
		    'title_part_width',
		    [
		        'label' => esc_html__( 'Title Part Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-client-list-content .rs-client-list li .list-client-title' => 'min-width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-client-list-content .rs-client-list li h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rs_title_typography',
				'selector' => '{{WRAPPER}} .rs-client-list-content .rs-client-list li h3'
			]
		);

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-client-list-content .rs-client-list li h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Description Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-client-list-content .rs-client-list li .list-client-content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .rs-client-list-content .rs-client-list li .list-client-content p'
			]
		);

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__( 'Description Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-client-list-content .rs-client-list li .list-client-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        
        $this->end_controls_section();
    }



    protected function render()
    {
        $settings = $this->get_settings_for_display(); ?>

        <div class="rs-client-list-content">
            <?php if (is_array($settings['features_list'])) : ?>
                <ul class="rs-client-list">
                    <?php foreach ($settings['features_list'] as $index => $feature) :
                        $name_key = $this->get_repeater_setting_key('text', 'features_list', $index);
                        $this->add_inline_editing_attributes($name_key, 'basic');
                        $this->add_render_attribute($name_key, 'class', 'rs-feature-text');

                        $client_title = $feature['client_title'];
                        $client_text = $feature['client_text'];


                    ?>
                        <li class="<?php echo esc_attr('elementor-repeater-item-' . $feature['_id']); ?>">
                            <div class="list-client-title">
                                <h3><?php echo wp_kses_post($feature['client_title']); ?></h3>
                            </div>
                            <div class="list-client-content">
                                <p><?php echo wp_kses_post($feature['client_text']); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
<?php
    }
}

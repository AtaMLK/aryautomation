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


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Brochures_Widget extends \Elementor\Widget_Base {

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
        return 'rsbrochures';
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
        return esc_html__( 'RS Brochures ', 'rsaddon' );
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
        return 'glyph-icon flaticon-price';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'list', 'title', 'features', 'heading', 'plan' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		); 
  
        $repeater = new Repeater();
        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '100GB free space with hosting', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
			'brochures_list_link',
			[
				'label' => esc_html__( 'Link', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '#', 'rsaddon' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
                
			]
		);

        $repeater->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,             
            ]
        );

        $repeater->add_control(
            'selected_image_second',
            [
                'label' => esc_html__( 'Choose Image Two', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA, 
            ]
        );

        $this->add_control(
            'brochures_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__( '100GB Free Space with Hosting', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'brochures_list_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'text' => esc_html__( 'Responsive Features List', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'brochures_list_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'text' => esc_html__( 'Auto Renew After Finish', 'rsaddon' ),
                        'icon' => 'fa fa-close',
                        'brochures_list_link' => [
                            'url' => '#',
                        ], 
                    ],
                    [
                        'text' => esc_html__( 'Hurry UP! RSElements Now Free', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'brochures_list_link' => [
                            'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->end_controls_section();

    
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'General', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_horizontal_align',
            [
                'label' => esc_html__( 'Box Style (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__( 'Inline', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-brochures .brochures-content ul' => 'display: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'box_vertical_align',
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
                'condition' => [
                    'box_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-brochures .brochures-content ul' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_column_align',
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
                'condition' => [
                    'box_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-brochures .brochures-content ul' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'flex_box_h_align',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
                'condition' => [
                    'box_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-brochures .brochures-content ul' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'List Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-features-list li',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_color',
                'label' => esc_html__( 'List Hover Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-features-list li:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .rs-features-list li'
            ]
        );       

        $this->add_responsive_control(
            'general_padding',
            [
                'label' => esc_html__( 'List Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator' => 'before', 
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'general_margin',
            [
                'label' => esc_html__( 'List Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_border',
                'selector' => '{{WRAPPER}} .rs-features-list li'                
            ]
        );
       $this->add_responsive_control(
            'features_title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();   

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-feature-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li:hover .rs-feature-text, {{WRAPPER}} .rs-features-list li:hover .rs-feature-text a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .rs-feature-text',
            ]
        );
        $this->end_controls_section();       


        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Icon & image', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-features-list li img, {{WRAPPER}} .rs-features-list li i',
            ]
        );
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li img, {{WRAPPER}} .rs-features-list li i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li img, {{WRAPPER}} .rs-features-list li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_icon_border',
                'selector' => '{{WRAPPER}} .rs-features-list li img, {{WRAPPER}} .rs-features-list li i',

            ]
        );
        
        
        $this->add_responsive_control(
            'icon_wrapper_padding',
            [
                'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ..rs-features-list li .list-brochures-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_wrapper_margin',
            [
                'label' => esc_html__( 'Wrapper Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-features-list li .list-brochures-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Font Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-brochures .brochures-content ul li a .brochures-left i,{{WRAPPER}} .rs-brochures .brochures-content ul li a .brochures-left svg' => 'font-size: {{SIZE}}{{UNIT}};',
                ],             
            ]
        ); 
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Icon Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-brochures .brochures-content ul li a .brochures-left .list-brochures-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );
        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__( 'Icon Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-brochures .brochures-content ul li a .brochures-left .list-brochures-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );
        
        $this->end_controls_section();
    }

  

	protected function render() {
        $settings = $this->get_settings_for_display();?> 

        <div class="rs-brochures">

            <div class="brochures-content">
                <?php if ( is_array( $settings['brochures_list'] ) ) : ?>
                    <ul class="rs-features-list">
                        <?php foreach ( $settings['brochures_list'] as $index => $brochures ) :
                            $name_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
                            $this->add_inline_editing_attributes( $name_key, 'basic' );
                            $this->add_render_attribute( $name_key, 'class', 'rs-feature-text' );
                            $brochureUrl = !empty($brochures['brochures_list_link']['url']) ? esc_url($brochures['brochures_list_link']['url']) : '';

                            ?>
                            <li class="<?php echo esc_attr( 'elementor-repeater-item-' . $brochures['_id'] ); ?>">
                                
                                <a href="<?php echo esc_url($brochureUrl); ?>" >
                                    <div class="brochures-left">
                                        <?php if ( $brochures['selected_image'] ) : ?>
                                            <div class="list-brochures-img">
                                                <img src="<?php echo esc_url( $brochures['selected_image']['url'] );?>" alt="image">
                                            </div>
                                        <?php endif; ?>

                                        <div class="list-feature-content">
                                            <span <?php $this->print_render_attribute_string( $name_key ); ?>><?php echo wp_kses_post( $brochures['text'] ); ?></span>
                                        </div>

                                    </div>

                                    <div class="brochures-right">
                                        <?php if ( $brochures['selected_image_second'] ) : ?>
                                            <div class="list-brochures-img">
                                                <img src="<?php echo esc_url( $brochures['selected_image_second']['url'] );?>" alt="image">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>  

        </div>
        <?php
    }
}

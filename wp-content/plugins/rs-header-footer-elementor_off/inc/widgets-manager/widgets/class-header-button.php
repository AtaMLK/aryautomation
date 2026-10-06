<?php
namespace RSHFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Header_Button extends Widget_Base {

	public function get_name() {
		return 'header_button';
	}

	public function get_title() {
		return __( 'RS Header Button', 'rs-header-footer-elementor' );
	}

	public function get_icon() {
		return 'rs-badge';
	}

	public function get_categories() {
		return [ 'hfe-widgets' ];
	}


	protected function register_controls() {
		$this->register_content_general_controls();
		$this->register_content_style_controls();
	}

	/**
	 * Undocumented function
	 *
	 * @return 
	 */
	protected function register_content_general_controls() {
		$this->start_controls_section(
			'header_btn_section',
			[
				'label' => __( 'Header Button', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'header_btn_text',
			[
				'label'   => __( 'Button Text', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Simple', 'rs-header-footer-elementor' ),
				'placeholder' => __( 'Button', 'rs-header-footer-elementor' ),
				'separator'   => 'before',
				'label_block' => true,
			]
		);

		$this->add_control(
			'header_btn_link',
			[
				'label' => esc_html__( 'Link', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'rs-header-footer-elementor' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'header_btn_align',
			[
				'label'              => __( 'Alignment', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'   => [
						'title' => __( 'Left', 'rs-header-footer-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'rs-header-footer-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'rs-header-footer-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .btn-signin' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'header_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'header_btn_icon_spacing',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Icon Spacing', 'rs-header-footer-elementor' ),
				'separator'   => 'before',
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header-btn-iocn' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
		    'svg__width',
		    [
		        'label' => esc_html__( 'Width', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'separator'   => 'before',
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .header-btn-wrapper span svg' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'svg__height',
		    [
		        'label' => esc_html__( 'Height', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'separator'   => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .header-btn-wrapper span svg' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();
	}

	protected function register_content_style_controls(){
		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'rs-header-footer-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);

		/**
		 * General style Tab
		 */
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'header_btn_text_color',
			[
				'label' => esc_html__( 'Color', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-btn-wrapper' => 'color: {{VALUE}}',
					'{{WRAPPER}} .header-btn-wrapper span svg path' => 'fill: {{VALUE}}',
				],
				'separator'     => 'after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_btn_background',
				'label' => esc_html__( 'Background', 'rs-header-footer-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .header-btn-wrapper',
			]
		);
		$this->end_controls_tab();
		
		/**
		 * Style hover tab
		 */
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'header_btn_text_hover_color',
			[
				'label' => esc_html__( 'Color', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-btn-wrapper:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .header-btn-wrapper:hover span svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'header_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-btn-wrapper:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'header_btn_hover_background',
				'label' => esc_html__( 'Background', 'rs-header-footer-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .header-btn-wrapper:hover',
			]
		);

		$this->add_control(
			'header_btn_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'header_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .header-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'header_btn_typography',
				'selector' => '{{WRAPPER}} .header-btn-text',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'header_btn_border',
				'label' => esc_html__( 'Border', 'rs-header-footer-elementor' ),
				'selector' => '{{WRAPPER}} .header-btn-wrapper',
			]
		);

		$this->add_responsive_control(
			'header_btn_margin',
			[
				'label' => esc_html__( 'Border Radius', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .header-btn-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Undocumented function
	 *
	 * @return HTML view
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['header_btn_link']['url'] ) ) {
			$this->add_link_attributes( 'header_btn_link', $settings['header_btn_link'] );
		}

		$elementClass = 'btn-signin';
		if ( $settings['header_btn_hover_animation'] ) {
			$elementClass .= ' elementor-animation-' . $settings['header_btn_hover_animation'];
		}
		$this->add_render_attribute( 'wrapper', 'class', $elementClass );
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a class="header-btn" <?php echo $this->get_render_attribute_string( 'header_btn_link' ); ?>>
				<span class="header-btn-wrapper">
					<span class="header-btn-iocn">						
						<?php Icons_Manager::render_icon( $settings['header_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?> 
					</span>
					<span class="header-btn-text">
						<?php echo esc_html( $settings['header_btn_text'] ); ?> 
					</span>
				</span>
			</a>
		</div>
		<?php
	}
}

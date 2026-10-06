<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace RSHFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * HFE Cart Widget
 *
 * @since 1.4.0
 */
class Cart extends Widget_Base {

	public function get_name() {
		return 'hfe-cart';
	}

	public function get_title() {
		return __( 'RS Cart', 'rs-header-footer-elementor' );
	}

	public function get_icon() {
		return 'rs-badge';
	}

	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	protected function register_controls() {

		$this->register_general_content_controls();
		$this->register_cart_typo_content_controls();
	}

	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Menu Cart', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'rs_show_mini_cart',
			[
				'label' => esc_html__( 'Show Cart Icon', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rs-header-footer-elementor' ),
				'label_off' => esc_html__( 'Hide', 'rs-header-footer-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'rs_show_cart_count',
			[
				'label' => esc_html__( 'Show Cart Count', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rs-header-footer-elementor' ),
				'label_off' => esc_html__( 'Hide', 'rs-header-footer-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Menu Cart Typography Controls.
	 *
	 */
	protected function register_cart_typo_content_controls() {
		$this->start_controls_section(
			'section_heading_typography',
			[
				'label' => __( 'Menu Cart', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'rs_cart_area_count_padding',
			[
				'label'              => __( 'Padding Cart Area', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .menu-cart-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'toggle_button_padding',
			[
				'label'              => __( 'Padding Cart Icon', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .menu-cart-area a.mini_cart__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->start_controls_tabs( 'toggle_button_colors' );

		$this->start_controls_tab(
			'toggle_button_normal_colors',
			[
				'label' => __( 'Normal', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_button_icon_color',
			[
				'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_button_hover_colors',
			[
				'label' => __( 'Hover', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_button_hover_icon_color',
			[
				'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-menu-cart__toggle .elementor-button:hover .elementor-button-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_control(
			'toggle_icon_size',
			[
				'label'      => __( 'Icon Size', 'rs-header-footer-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .menu-cart-area i:before' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label'     => __( 'Items Count', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rs_height_cart_count',
			[
				'label' => esc_html__( 'Cart Count Height', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 23,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area a .rsw-count' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rs_width_cart_count',
			[
				'label' => esc_html__( 'Cart Count Width', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 23,
				],
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area a .rsw-count' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rs_cart_count_padding',
			[
				'label'              => __( 'Padding', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .menu-cart-area a .rsw-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'rs_cart_count_margin',
			[
				'label'              => __( 'Margin', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .menu-cart-area a .rsw-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->start_controls_tabs( 'count_colors' );

		$this->start_controls_tab(
			'count_normal_colors',
			[
				'label' => __( 'Normal', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'items_indicator_text_color',
			[
				'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area .rsw-count' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'items_indicator_background_color',
			[
				'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area .rsw-count' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'count_hover_colors',
			[
				'label' => __( 'Hover', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'items_indicator_text_hover_color',
			[
				'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-menu-cart__toggle:hover .elementor-button-icon[data-counter]:before' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'items_indicator_background_hover_color',
			[
				'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-menu-cart__toggle:hover .elementor-button-icon[data-counter]:before' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cart_content',
			[
				'label'     => __( 'Cart Content', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rs_cart_content_bg_color',
			[
				'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area .cart-icon-total-products' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'rs_cart_content_icon_color',
			[
				'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area .woocommerce-mini-cart__empty-message:before' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'rs_cart_content_text_color',
			[
				'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area .woocommerce-mini-cart__empty-message' => 'color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Menu Cart output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {

		if ( null === WC()->cart ) {
			return;
		}

		$settings  = $this->get_settings_for_display();
		$rs_show_cart = $settings['rs_show_mini_cart'];
		$rs_show_cart_count = $settings['rs_show_cart_count'];

		if( 'yes' == $rs_show_cart ){
		?>
		<div class="menu-cart-area">
			<a href="<?php echo esc_url( wc_get_cart_url() );?>" class="mini_cart__icon"><i class="ri-shopping-bag-2-line"></i>
			<?php if( 'yes' == $rs_show_cart_count ){ ?>
				<em class="rsw-count"><?php echo WC()->cart->get_cart_contents_count();?></em>
				<?php } ?>
			</a>
			<div class="cart-icon-total-products">
				<?php the_widget( 'WC_Widget_Cart' ); ?>
			</div>
		</div> 
		<?php
		}
	}
}

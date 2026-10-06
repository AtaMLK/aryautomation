<?php
/**
 * Elementor Classes.
 *
 */

namespace RSHFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Copyright extends Widget_Base {

	public function get_name() {
		return 'copyright';
	}
	/**
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RS Copyright', 'rs-header-footer-elementor' );
	}
	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'rs-badge';
	}
	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	/**
	 * Register Copyright controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->register_content_copy_right_controls();
	}
	/**
	 * Register Copyright General Controls.
	 *
	 * @since 1.2.0
	 * @access protected
	 */
	protected function register_content_copy_right_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Copyright', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'shortcode',
			[
				'label'   => __( 'Copyright Text', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Copyright © [hfe_current_year] [hfe_site_title] | Powered by [hfe_site_title]', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'rs-header-footer-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .hfe-copyright-wrapper' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting.
					'{{WRAPPER}} .hfe-copyright-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'title_color_link',
			[
				'label'     => __( 'Link Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting.
					'{{WRAPPER}} .hfe-copyright-wrapper a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_link_hover',
			[
				'label'     => __( 'Link Color (Hover)', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting.
					'{{WRAPPER}} .hfe-copyright-wrapper a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'selector' => '{{WRAPPER}} .hfe-copyright-wrapper, {{WRAPPER}} .hfe-copyright-wrapper a',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
		    '_section_color_style',
		    [
		        'label' => esc_html__( 'Color Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
			'icon_normal_gradient_style',
			[
				'label'   => esc_html__( 'Color Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [					
					'normal' => esc_html__( 'Normal', 'rsaddon'),
                    'gradient_color' => esc_html__( 'gradient', 'rsaddon'),
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'hover__text_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .hfe-copyright-wrapper.gradient_color span a:hover',
			]
		);

		// // $this->end_controls_section();
		$this->end_controls_section();
	}

	/**
	 * Render Copyright output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$link     = isset( $settings['link']['url'] ) ? $settings['link']['url'] : '';

		$icon_normal_gradient_style = $settings['icon_normal_gradient_style'];

		if ( ! empty( $link ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		$copy_right_shortcode = do_shortcode( shortcode_unautop( $settings['shortcode'] ) ); ?>
		<div class="hfe-copyright-wrapper <?php echo $icon_normal_gradient_style;?>">
			<?php if ( ! empty( $link ) ) { ?>
				<a <?php echo wp_kses_post( $this->get_render_attribute_string( 'link' ) ); ?>>
					<span><?php echo wp_kses_post( $copy_right_shortcode ); ?></span>
				</a>
			<?php } else { ?>
				<span><?php echo wp_kses_post( $copy_right_shortcode ); ?></span>
			<?php } ?>
		</div>
		<?php
	}

	public function render_plain_content() {
		// In plain mode, render without shortcode.
		echo esc_attr( $this->get_settings( 'shortcode' ) );
	}

	protected function content_template() {}
}

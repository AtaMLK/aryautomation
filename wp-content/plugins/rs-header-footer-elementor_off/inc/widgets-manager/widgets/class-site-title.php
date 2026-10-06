<?php
namespace RSHFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

use RSHFE\WidgetsManager\Widgets_Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Site_Title extends Widget_Base {
	public function get_name() {
		return 'hfe-site-title';
	}

	/**
	 * Retrieve the widget title.
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Site Title', 'rs-header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'rs-badge';
	}

	/**
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	/**
	 * Register site title controls.
	 */
	protected function register_controls() {

		$this->register_general_content_controls();
		$this->register_heading_typo_content_controls();
	}

	/**
	 * Register Advanced Heading General Controls.
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'General', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'before',
			[
				'label'   => __( 'Before Title Text', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'after',
			[
				'label'   => __( 'After Title Text', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => __( 'Icon', 'rs-header-footer-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'     => __( 'Icon Spacing', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .hfe-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'custom_link',
			[
				'label'   => __( 'Link', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'custom'  => __( 'Custom URL', 'rs-header-footer-elementor' ),
					'default' => __( 'Default', 'rs-header-footer-elementor' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'heading_link',
			[
				'label'       => __( 'Link', 'rs-header-footer-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'rs-header-footer-elementor' ),
				'dynamic'     => [
					'active' => true,
				],
				'default'     => [
					'url' => get_home_url(),
				],
				'condition'   => [
					'custom_link' => 'custom',
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => __( 'Size', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'rs-header-footer-elementor' ),
					'small'   => __( 'Small', 'rs-header-footer-elementor' ),
					'medium'  => __( 'Medium', 'rs-header-footer-elementor' ),
					'large'   => __( 'Large', 'rs-header-footer-elementor' ),
					'xl'      => __( 'XL', 'rs-header-footer-elementor' ),
					'xxl'     => __( 'XXL', 'rs-header-footer-elementor' ),
				],
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'   => __( 'HTML Tag', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'rs-header-footer-elementor' ),
					'h2' => __( 'H2', 'rs-header-footer-elementor' ),
					'h3' => __( 'H3', 'rs-header-footer-elementor' ),
					'h4' => __( 'H4', 'rs-header-footer-elementor' ),
					'h5' => __( 'H5', 'rs-header-footer-elementor' ),
					'h6' => __( 'H6', 'rs-header-footer-elementor' ),
				],
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'heading_text_align',
			[
				'label'              => __( 'Alignment', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => __( 'Left', 'rs-header-footer-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'rs-header-footer-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'rs-header-footer-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'rs-header-footer-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-heading' => 'text-align: {{VALUE}};',
				],
				'prefix_class'       => 'hfe%s-heading-align-',
				'frontend_available' => true,
			]
		);
		$this->end_controls_section();
	}


	/**
	 * Register Advanced Heading Typography Controls.
	 */
	protected function register_heading_typo_content_controls() {
		$this->start_controls_section(
			'section_heading_typography',
			[
				'label' => __( 'Title', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .elementor-heading-title, {{WRAPPER}} .hfe-heading a',
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .hfe-heading-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-icon i'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-icon svg'     => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'heading_shadow',
				'selector' => '{{WRAPPER}} .hfe-heading-text',
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label'     => __( 'Blend Mode', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''            => __( 'Normal', 'rs-header-footer-elementor' ),
					'multiply'    => __( 'Multiply', 'rs-header-footer-elementor' ),
					'screen'      => __( 'Screen', 'rs-header-footer-elementor' ),
					'overlay'     => __( 'Overlay', 'rs-header-footer-elementor' ),
					'darken'      => __( 'Darken', 'rs-header-footer-elementor' ),
					'lighten'     => __( 'Lighten', 'rs-header-footer-elementor' ),
					'color-dodge' => __( 'Color Dodge', 'rs-header-footer-elementor' ),
					'saturation'  => __( 'Saturation', 'rs-header-footer-elementor' ),
					'color'       => __( 'Color', 'rs-header-footer-elementor' ),
					'difference'  => __( 'Difference', 'rs-header-footer-elementor' ),
					'exclusion'   => __( 'Exclusion', 'rs-header-footer-elementor' ),
					'hue'         => __( 'Hue', 'rs-header-footer-elementor' ),
					'luminosity'  => __( 'Luminosity', 'rs-header-footer-elementor' ),
				],
				'selectors' => [
					'{{WRAPPER}} .hfe-heading-text' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label'     => __( 'Icon', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon[value]!' => '',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon[value]!' => '',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hfe-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icons_hover_color',
			[
				'label'     => __( 'Icon Hover Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'icon[value]!' => '',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hfe-icon:hover i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render Heading output on the frontend.
	 */
	protected function render() {

		$settings = $this->get_settings();
		$title    = get_bloginfo( 'name' );

		$this->add_inline_editing_attributes( 'heading_title', 'basic' );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( ! empty( $settings['heading_link']['url'] ) ) {
			$this->add_link_attributes( 'url', $settings['heading_link'] );
		}

		$heading_size_tag = Widgets_Loader::validate_html_tag( $settings['heading_tag'] );
		?>

		<div class="hfe-module-content hfe-heading-wrapper elementor-widget-heading">
		<?php if ( ! empty( $settings['heading_link']['url'] ) && 'custom' === $settings['custom_link'] ) { ?>
					<a <?php echo wp_kses_post( $this->get_render_attribute_string( 'url' ) ); ?>>
				<?php } else { ?>
					<a href="<?php echo get_home_url(); ?>">
				<?php } ?>
			<<?php echo $heading_size_tag; ?> class="hfe-heading elementor-heading-title elementor-size-<?php echo $settings['size']; ?>">
				<?php if ( '' !== $settings['icon']['value'] ) { ?>
					<span class="hfe-icon">
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>					
					</span>
				<?php } ?>
					<span class="hfe-heading-text" >
					<?php
					if ( '' !== $settings['before'] ) {
						echo wp_kses_post( $settings['before'] );
					}
					?>
					<?php echo wp_kses_post( $title ); ?>
					<?php
					if ( '' !== $settings['after'] ) {
						echo wp_kses_post( $settings['after'] );
					}
					?>
					</span>			
			</<?php echo $heading_size_tag; ?>>
			</a>		
		</div>
		<?php
	}
		/**
		 * Render site title output in the editor.
		 */
	protected function content_template() {
		?>
		<#
		if ( '' == settings.heading_title ) {
			return;
		}
		if ( '' == settings.size ){
			return;
		}
		if ( '' != settings.heading_link.url ) {
			view.addRenderAttribute( 'url', 'href', settings.heading_link.url );
		}
		var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );

		var headingSizeTag = settings.heading_tag;

		if ( typeof elementor.helpers.validateHTMLTag === "function" ) { 
			headingSizeTag = elementor.helpers.validateHTMLTag( headingSizeTag );
		} else if( HfeWidgetsData.allowed_tags ) {
			headingSizeTag = HfeWidgetsData.allowed_tags.includes( headingSizeTag.toLowerCase() ) ? headingSizeTag : 'div';
		}

		#>
		<div class="hfe-module-content hfe-heading-wrapper elementor-widget-heading">
				<# if ( '' != settings.heading_link.url ) { #>
					<a {{{ view.getRenderAttributeString( 'url' ) }}} >
				<# } #>
				<{{{ headingSizeTag }}} class="hfe-heading elementor-heading-title elementor-size-{{{ settings.size }}}">
				<# if( '' != settings.icon.value ){ #>
				<span class="hfe-icon">
					{{{ iconHTML.value }}}					
				</span>
				<# } #>
				<span class="hfe-heading-text  elementor-heading-title" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic" >
				<#if ( '' != settings.before ){#>
					{{{ settings.before }}} 
				<#}#>
				<?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?>
				<# if ( '' != settings.after ){#>
					{{{ settings.after }}}
				<#}#>
				</span>
			</{{{ headingSizeTag }}}>
			<# if ( '' != settings.heading_link.url ) { #>
				</a>
			<# } #>
		</div>
		<?php
	}
}

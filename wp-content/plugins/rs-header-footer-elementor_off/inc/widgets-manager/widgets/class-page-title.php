<?php
namespace RSHFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use RSHFE\WidgetsManager\Widgets_Loader;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Page_Title extends Widget_Base {


	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'page-title';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RS Page Title', 'rs-header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'rs-badge';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	/**
	 * Register Page Title controls.
	 */
	protected function register_controls() {
		$this->register_content_page_title_controls();
		$this->register_page_title_style_controls();
	}

	/**
	 * Register Page Title General Controls.
	 */
	protected function register_content_page_title_controls() {
		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Title', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'archive_title_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				/* translators: %1$s doc link */
				'raw'             => sprintf( __( '<b>Note:</b> Archive page title will be visible on frontend.', 'rs-header-footer-elementor' ) ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);

		//
		$this->add_control(
			'custom_page',
			[
				'label' => esc_html__( 'Custom Page Title', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'custom_menta',
			[
				'label' => esc_html__( 'Custom Meta', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'custom_page_title',
			[
				'label' => esc_html__( 'Title', 'rs-header-footer-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'rs-header-footer-elementor' ),
				'condition' => [
					'custom_page' => 'yes',
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
			'align',
			[
				'label'              => __( 'Alignment', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => __( 'Left', 'rs-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'rs-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'rs-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'rs-header-footer-elementor' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'            => '',
				'selectors'          => [
					'{{WRAPPER}} .hfe-page-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Register Page Title Style Controls.
	 */
	protected function register_page_title_style_controls() {
		$this->start_controls_section(
			'section_title_typography',
			[
				'label' => __( 'Title', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .elementor-heading-title, {{WRAPPER}} .hfe-page-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title, {{WRAPPER}} .hfe-page-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-page-title-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-page-title-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_shadow',
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_control(
			'blend_mode',
			[
				'label'     => __( 'Blend Mode', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''            => __( 'Normal', 'rs-header-footer-elementor' ),
					'multiply'    => __('Multiply', 'rs-header-footer-elementor'),
					'screen'      => __('Screen', 'rs-header-footer-elementor'),
					'overlay'     => __('Overlay', 'rs-header-footer-elementor'),
					'darken'      => __('Darken', 'rs-header-footer-elementor'),
					'lighten'     => __('Lighten', 'rs-header-footer-elementor'),
					'color-dodge' => __('Color Dodge', 'rs-header-footer-elementor'),
					'saturation'  => __('Saturation', 'rs-header-footer-elementor'),
					'color'       => __('Color', 'rs-header-footer-elementor'),
					'difference'  => __('Difference', 'rs-header-footer-elementor'),
					'exclusion'   => __('Exclusion', 'rs-header-footer-elementor'),
					'hue'         => __('Hue', 'rs-header-footer-elementor'),
					'luminosity'  => __('Luminosity', 'rs-header-footer-elementor'),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .hfe-page-title:before',
			]
		);
		
		$this->add_responsive_control(
		    'title_paddings',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-page-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label'     => __( 'Icon', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'new_page_title_select_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'page_title_icon_color',
			[
				'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'new_page_title_select_icon[value]!' => '',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hfe-page-title-icon i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-page-title-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'page_title_icons_hover_color',
			[
				'label'     => __( 'Icon Hover Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'new_page_title_select_icon[value]!' => '',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hfe-page-title-icon:hover i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .hfe-page-title-icon:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render page title widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'page_title', 'basic' );
		$heading_size_tag = Widgets_Loader::validate_html_tag( $settings['heading_tag'] );
		?>		
		<div class="hfe-page-title hfe-page-title-wrapper elementor-widget-heading">
			
			<<?php echo $heading_size_tag; ?> class="elementor-heading-title elementor-size">
				<?php
				if( 'yes' != $settings['custom_page'] ){
					if ( is_archive() ) {
						echo wp_kses_post( get_the_archive_title() );
					} elseif(is_search() ){
						printf( __( 'Search Results for: %s', 'rs-header-footer-elementor' ), '<span>' . get_search_query() . '</span>' );
					} elseif( !is_front_page() && is_home() ){
						printf( __( 'Blog ', 'sasly' ));
					}
					else {
						echo wp_kses_post( get_the_title() );
					}
				} else {
					echo wp_kses_post( $settings['custom_page_title'] );
				}
				?>			 
			</<?php echo $heading_size_tag; ?> > 

			<?php 
				$post_id        = get_the_id();
				$author_id      = get_post_field ('post_author', $post_id);
				$display_name   = get_the_author_meta( 'display_name' , $author_id );
			?>
			<?php if( 'yes' == $settings['custom_menta'] ){ ?>
			    <ul class="rs-breadcrumbs-meta-elementor">			    	
			    	<?php if(!empty($display_name)){ ?>
				    	<li class="rs_author">
				    		<span class="name">
				    		    <i class="ri-user-3-line"></i>
				    		    <?php 
				    		        echo esc_html($display_name);
				    		    ?>
				    		</span> 
				    	</li>
				    <?php } ?>

				    <?php
			    	$post_date = get_the_date(); 
			    	if(!empty($post_date)){
			    	?>
				    	<li class="rs_date">
				    		<span>
				    		    <i class="ri-calendar-line"></i>
				    		    <?php echo esc_attr($post_date);?>
				    		</span>
				    	</li>
			    	<?php } ?>

		
			    	<?php if (has_category()){ ?>
				    	<li class="rs-category">
				    		<i class="ri-file-3-line"></i>
				    		<ul class="single-posts-meta">
				    		    <li class="post-cate">                                                      
				    		        <?php
				    		            //tag add
				    		            $seperator = ', '; // blank instead of comma
				    		            $after = '';
				    		            $before = '';
				    		            echo '<div class="tag-line">';
				    		            ?>                                                
				    		            <?php
				    		            the_category(', '); 
				    		            echo '</div>';
				    		          ?> 
				    		    </li>
				    		</ul> 
				    	</li>
				    <?php } ?>				    
			    	<li class="rs_comments">
			    		<span>
			    		    <i class="ri-chat-4-line"></i>
			    		    <?php echo get_comments_number( '0', '1', '%' ); ?>
			    		</span>
			    	</li>				    
			    </ul>
			<?php } ?>
		</div>
		<?php

	}
}

<?php
namespace RSHFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Search_Button extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hfe-search-button';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RS Search', 'rs-header-footer-elementor' );
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
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	/**
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hfe-frontend-js' ];
	}

	/**
	 * Register Search Button controls.
	 */
	protected function register_controls() {
		$this->register_search_style_controls();
	}
	/**
	 * Register Search General Controls.
	 */
	/**
	 * Register Search Style Controls.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function register_search_style_controls() {
		$this->start_controls_section(
			'section_close_icon',
			[
				'label'     => __( 'Close Icon', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);		

		$this->start_controls_tabs( 'close_icon_normal' );

		$this->start_controls_tab(
			'normal_close_button',
			[
				'label' => __( 'Normal', 'rs-header-footer-elementor' ),
			]
		);


		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .search_icons .ri-search-line' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
		    'close_icon_color',
		    [
		        'label' => esc_html__( 'Close Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .ri-close-fill:before' => 'color: {{VALUE}};',
		        ]
		    ]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_close_icon',
			[
				'label' => __( 'Hover', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'hover_close_icon_text',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search_icons:hover .ri-search-line' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __( 'Input Color', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'input_typography',
				'selector' => ' {{WRAPPER}} .rs_stickys_form.search-form .search-input',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_responsive_control(
			'input_icon_size',
			[
				'label'              => __( 'Width', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'            => [
					'size' => 250,
				],
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .rs_stickys_form.search-form' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'          => [
					'layout' => 'icon',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
		    'input_position_x',
		    [
		        'label' => esc_html__( 'Position (X)', 'prelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs_stickys_form.search-form' => 'right: {{SIZE}}{{UNIT}};',                   
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'input_position',
		    [
		        'label' => esc_html__( 'Position (Y)', 'prelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs_stickys_form.search-form ' => 'top: {{SIZE}}{{UNIT}};',                   
		        ], 
		    ]
		);

		$this->start_controls_tabs( 'tabs_input_colors' );

			$this->start_controls_tab(
				'tab_input_normal',
				[
					'label'     => __( 'Normal', 'rs-header-footer-elementor' ),
				]
			);
			$this->add_control(
				'input_text_color',
				[
					'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'input_placeholder_color',
				[
					'label'     => __( 'Placeholder Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input::placeholder' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'input_background_color',
				[
					'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ededed',
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'input_box_shadow',
					'selector'  => '{{WRAPPER}} .rs_stickys_form.search-form .search-input',
				]
			);
			$this->add_responsive_control(
				'border_radius',
				[
					'label'     => __( 'Border Radius', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'default'   => [
						'size' => 3,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
					'separator' => 'before',
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_input_focus',
				[
					'label'     => __( 'Focus', 'rs-header-footer-elementor' ),					
				]
			);
			$this->add_control(
				'input_placeholder_hover_color',
				[
					'label'     => __( 'Placeholder Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus::placeholder' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'input_background_color_focus',
				[
					'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'           => 'input_box_shadow_focus',
					'selector'       =>
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input',
					'fields_options' => [
						'box_shadow_type' => [
							'separator' => 'default',
						],
					],
				]
			);
			$this->add_control(
				'input_border_color_focus',
				[
					'label'     => __( 'Border Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input' => 'border-color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_text_color_focus',
			[
				'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'icon',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_text_background_color_focus',
			[
				'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_focus_border_radius',
			[
				'label'     => __( 'Border Radius', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input' => 'border-radius: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_control(
			'input_icon_color',
			[
				'label'     => __( 'Button Icon Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-form.rs_stickys_form button i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Render Search button output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
	?>
		<div class="search_icons">
			<i class="ri-close-fill"></i>
			<i class="ri-search-line"></i>
		</div>

		<form role="search" class="bs-search search-form rs_stickys_form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		    <div class="search-wrap">
		    	<label class="screen-reader-text">
		    		<?php echo esc_html__( 'Search for:', 'rs-header-footer-elementor' ); ?>
		    	</label>
		        <input type="search" placeholder="<?php esc_attr_e( 'Searching...', 'rs-header-footer-elementor' ); ?>" name="s" class="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
		        <button type="submit"  value="Search"><i class="ri-search-line"></i></button>
		    </div>
		</form>
	<?php
		
	}
}

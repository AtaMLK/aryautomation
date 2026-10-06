<?php
namespace RSHFE\WidgetsManager\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Nav Menu.
 */
class Navigation_Menu extends Widget_Base {
	/**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	/**
	 * Retrieve the widget name.
	 *
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'navigation-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RS Navigation Menu', 'rs-header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'rs-badge';
	}

	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	public function get_script_depends() {
		return [ 'hfe-frontend-js' ];
	}

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Check if the Elementor is updated.
	 */
	public static function is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Register Nav Menu controls.
	 */
	protected function register_controls() {
		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
	}

	/**
	 * Register Nav Menu General Controls.
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_menu',
			[
				'label' => __( 'Menu', 'rs-header-footer-elementor' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'        => __( 'Menu', 'rs-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					/* translators: %s Nav menu URL */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'rs-header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'rs-header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'menu_last_item',
			[
				'label'     => __( 'Last Menu Item', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none' => __( 'Default', 'rs-header-footer-elementor' ),
					'cta'  => __( 'Button', 'rs-header-footer-elementor' ),
				],
				'default'   => 'none',
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_control(
			'separator_dots',
			[
				'label'     => __( 'Select Separator', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'no-separator' 		=> __( 'Default', 'rs-header-footer-elementor' ),
					'separator-dots'  	=> __( 'Separator Dots', 'rs-header-footer-elementor' ),
				],
				'default'   => 'no-separator',
			]
		);

		$this->add_responsive_control(
			'separator_dots_color',
			[
				'label'     => __( 'Separator Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF82',
				'selectors' => [
					'{{WRAPPER}} nav.separator-dots ul.hfe-nav-menu li a:before' => 'background-color: {{VALUE}}!important',
				],
				'condition' => [
					'separator_dots' => 'separator-dots',
				],
			]
		);

		$this->add_control(
			'right_arrow',
			[
				'label'     => __( 'Select Arrow', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'no-arrow' 		=> __( 'Default', 'rs-header-footer-elementor' ),
					'arrow-tops'  	=> __( 'Arrow Top', 'rs-header-footer-elementor' ),
					'border-tops'  	=> __( 'Border Top', 'rs-header-footer-elementor' ),					
				],
				'default'   => 'no-arrow',
			]
		);

		$this->add_control(
			'left_circle',
			[
				'label'     => __( 'Select Circle', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'no-circle' 		=> __( 'Default', 'rs-header-footer-elementor' ),
					'left-circle'  	=> __( 'Select Circle', 'rs-header-footer-elementor' ),
				],
				'default'   => 'no-circle',
			]
		);


		$this->add_responsive_control(
			'location_area_padding',
			[
				'label'              => __( 'Padding', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} ul.rs__mobile_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
		    'separator_dots__pos',
		    [
		        'label' => esc_html__( 'Dot Top Position', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'selectors' => [
		            '{{WRAPPER}} nav.separator-dots ul.hfe-nav-menu li a:before' => 'top: {{SIZE}}%;',
		        ],
				'condition' => ['separator_dots' => 'separator-dots']
		    ]
		);

		$this->add_control(
			'current_menu_shape_enable',
			[
				'label'        => __( 'Current Menu Shape?', 'rs-header-footer-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'rs-header-footer-elementor' ),
				'label_off'    => __( 'No', 'rs-header-footer-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'item_arrow__shape_enable',
			[
				'label'        => __( 'Item Arrow Enable', 'rs-header-footer-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'rs-header-footer-elementor' ),
				'label_off'    => __( 'No', 'rs-header-footer-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'current_menu_shape',
			[
				'label'     => __( 'Current Menu Shape', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => ['current_menu_shape_enable' => 'yes']
			]
		);


		$this->end_controls_section();

			$this->start_controls_section(
				'section_layout',
				[
					'label' => __( 'Layout', 'rs-header-footer-elementor' ),
				]
			);

			$this->add_control(
				'layout',
				[
					'label'   => __( 'Layout', 'rs-header-footer-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => __( 'Horizontal', 'rs-header-footer-elementor' ),
						'vertical'   => __( 'Vertical', 'rs-header-footer-elementor' ),
						'expandible' => __( 'Expanded', 'rs-header-footer-elementor' ),
						'flyout'     => __( 'Flyout', 'rs-header-footer-elementor' ),
					],
				]
			);


			$this->add_control(
				'item_column',
				[
					'label'   => __( 'Menu Item Columns', 'rs-header-footer-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'rs_one_columns',
					'options' => [
						'rs_one_columns' => __( 'Default', 'rs-header-footer-elementor' ),
						'rs_two_columns'   => __( 'Two Columns', 'rs-header-footer-elementor' ),
					],
					'condition' => [
						'layout' => 'vertical',
					],
				]
			);


			$this->add_responsive_control(
				'navmenu_align',
				[
					'label'        => __( 'Alignment', 'rs-header-footer-elementor' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => [
						'left'    => [
							'title' => __( 'Left', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-right',
						],
						'justify' => [
							'title' => __( 'Justify', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'      => 'left',
					'condition'    => [
						'layout' => [ 'horizontal', 'vertical' ],
					],
					'prefix_class' => 'hfe-nav-menu__align-',
				]
			);

			$this->add_control(
				'flyout_layout',
				[
					'label'     => __( 'Flyout Orientation', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => [
						'left'  => __( 'Left', 'rs-header-footer-elementor' ),
						'right' => __( 'Right', 'rs-header-footer-elementor' ),
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'flyout_type',
				[
					'label'       => __( 'Appear Effect', 'rs-header-footer-elementor' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'normal',
					'label_block' => false,
					'options'     => [
						'normal' => __( 'Slide', 'rs-header-footer-elementor' ),
						'push'   => __( 'Push', 'rs-header-footer-elementor' ),
					],
					'render_type' => 'template',
					'condition'   => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_responsive_control(
				'hamburger_align',
				[
					'label'                => __( 'Hamburger Align', 'rs-header-footer-elementor' ),
					'type'                 => Controls_Manager::CHOOSE,
					'default'              => 'center',
					'options'              => [
						'left'   => [
							'title' => __( 'Left', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-right',
						],
					],
					'selectors_dictionary' => [
						'left'   => 'margin-right: auto',
						'center' => 'margin: 0 auto',
						'right'  => 'margin-left: auto',
					],
					'selectors'            => [
						'{{WRAPPER}} .hfe-nav-menu__toggle,
						{{WRAPPER}} .hfe-nav-menu-icon' => '{{VALUE}}',
					],
					'condition'            => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'label_block'          => false,
					'frontend_available'   => true,
				]
			);

			$this->add_responsive_control(
				'hamburger_menu_align',
				[
					'label'              => __( 'Menu Items Align', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::CHOOSE,
					'options'            => [
						'flex-start'    => [
							'title' => __( 'Left', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'        => [
							'title' => __( 'Center', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-center',
						],
						'flex-end'      => [
							'title' => __( 'Right', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-right',
						],
						'space-between' => [
							'title' => __( 'Justify', 'rs-header-footer-elementor' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'            => 'space-between',
					'condition'          => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'selectors'          => [
						'{{WRAPPER}} li.menu-item a' => 'justify-content: {{VALUE}};',
						'{{WRAPPER}} li .elementor-button-wrapper' => 'text-align: {{VALUE}};',
						'{{WRAPPER}}.hfe-menu-item-flex-end li .elementor-button-wrapper' => 'text-align: right;',
					],
					'prefix_class'       => 'hfe-menu-item-',
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'submenu_icon',
				[
					'label'        => __( 'Submenu Icon', 'rs-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'arrow',
					'options'      => [
						'hide_default'   => __( 'Default', 'rs-header-footer-elementor' ),
						'arrow'   => __( 'Arrows', 'rs-header-footer-elementor' ),
						'plus'    => __( 'Plus Sign', 'rs-header-footer-elementor' ),
						'classic' => __( 'Classic', 'rs-header-footer-elementor' ),
					],
					'prefix_class' => 'hfe-submenu-icon-',
				]
			);

			$this->add_control(
				'submenu_animation',
				[
					'label'        => __( 'Submenu Animation', 'rs-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'none',
					'options'      => [
						'none'     => __( 'Default', 'rs-header-footer-elementor' ),
						'slide_up' => __( 'Slide Up', 'rs-header-footer-elementor' ),
					],
					'prefix_class' => 'hfe-submenu-animation-',
					'condition'    => [
						'layout' => 'horizontal',
					],
				]
			);

			$this->add_control(
				'link_redirect',
				[
					'label'        => __( 'Action On Menu Click', 'rs-header-footer-elementor' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'child',
					'description'  => __( 'For Horizontal layout, this will affect on the selected breakpoint', 'rs-header-footer-elementor' ),
					'options'      => [
						'child'     => __( 'Open Submenu', 'rs-header-footer-elementor' ),
						'self_link' => __( 'Redirect To Self Link', 'rs-header-footer-elementor' ),
					],
					'prefix_class' => 'hfe-link-redirect-',
				]
			);

		$this->add_control(
			'heading_responsive',
			[
				'type'      => Controls_Manager::HEADING,
				'label'     => __( 'Responsive', 'rs-header-footer-elementor' ),
				'separator' => 'before',
				'condition' => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
			]
		);

		$this->add_control(
			'dropdown',
			[
				'label'        => __( 'Breakpoint', 'rs-header-footer-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => [
					'mobile' => __( 'Mobile (768px >)', 'rs-header-footer-elementor' ),
					'landscape' => __( 'Mobile landscape (991px >)', 'rs-header-footer-elementor' ),
					'tablet' => __( 'Tablet (1025px >)', 'rs-header-footer-elementor' ),
					'none'   => __( 'None', 'rs-header-footer-elementor' ),
				],
				'prefix_class' => 'hfe-nav-menu__breakpoint-',
				'condition'    => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'resp_align',
			[
				'label'                => __( 'Alignment', 'rs-header-footer-elementor' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => [
					'left'   => [
						'title' => __( 'Left', 'rs-header-footer-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'rs-header-footer-elementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'rs-header-footer-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'              => 'center',
				'description'          => __( 'This is the alignement of menu icon on selected responsive breakpoints.', 'rs-header-footer-elementor' ),
				'condition'            => [
					'layout'    => [ 'horizontal', 'vertical' ],
					'dropdown!' => 'none',
				],
				'selectors_dictionary' => [
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				],
				'selectors'            => [
					'{{WRAPPER}} .hfe-nav-menu__toggle' => '{{VALUE}}',
				],
			]
		);


		$this->add_responsive_control(
		    'responsive_background_menu',
		    [
		        'label' => esc_html__( 'Background Color (Menu Area)', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .hfe-nav-menu nav' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'responsive_color_menu',
		    [
		        'label' => esc_html__( 'Color', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .hfe-nav-menu nav ul li a' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'responsive_color_menu_hover',
		    [
		        'label' => esc_html__( 'Color (Hover)', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .hfe-nav-menu nav ul li a:hover, {{WRAPPER}} .hfe-nav-menu nav > ul > li.current_page_item > a, {{WRAPPER}} .hfe-nav-menu nav > ul > li.current-menu-ancestor > a' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'responsive_padding_menu',
		    [
		        'label' => esc_html__( 'Padding (Menu Area)', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-nav-menu nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'responsive_top_menu',
		    [
		        'label' => esc_html__( 'Dropdown Top Position', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-nav-menu nav' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'full_width_dropdown',
			[
				'label'        => __( 'Full Width', 'rs-header-footer-elementor' ),
				'description'  => __( 'Enable this option to stretch the Sub Menu to Full Width.', 'rs-header-footer-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'rs-header-footer-elementor' ),
				'label_off'    => __( 'No', 'rs-header-footer-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'dropdown!' => 'none',
					'layout!'   => 'flyout',
				],
				'render_type'  => 'template',
			]
		);

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Menu Icon', 'rs-header-footer-elementor' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'fas fa-align-justify',
						'library' => 'fa-solid',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Icon', 'rs-header-footer-elementor' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-align-justify',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'rs-header-footer-elementor' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'far fa-window-close',
						'library' => 'fa-regular',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'rs-header-footer-elementor' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-close',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'section_megaMenu',
			[
				'label' => __( 'Mega Menu Settings', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'mega__menu__col',
			[
				'label'   => esc_html__( 'Mega Menu Columns', 'rs-header-footer-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'mega_columns1',
				'options' => [					
					'mega_columns1' => esc_html__( 'Default', 'rs-header-footer-elementor'),
					'mega_columns2' => esc_html__( 'Two Columns', 'rs-header-footer-elementor'),
					'mega_columns3' => esc_html__( 'Three Columns', 'rs-header-footer-elementor'),
					'mega_columns4' => esc_html__( 'Four Columns', 'rs-header-footer-elementor'),
					'mega_columns5' => esc_html__( 'Five Columns', 'rs-header-footer-elementor'),
				],
			]
		);

		$this->add_responsive_control(
		    'mega__menu__width',
		    [
		        'label' => esc_html__( 'Width', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-nav-menu li.menu-item.rs-mega-menu ul.sub-menu' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'mega__menu__padding',
		    [
		        'label' => esc_html__( 'Padding (Mega Menu Area)', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-nav-menu > li.menu-item.rs-mega-menu > ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'mega__menu_box_shadow',
				'selector' => '{{WRAPPER}} .hfe-nav-menu > li.menu-item.rs-mega-menu > ul.sub-menu',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_style_content_controls() {

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'     => __( 'Main Menu', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_responsive_control(
			'width_flyout_menu_item',
			[
				'label'              => __( 'Flyout Box Width', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 500,
						'min' => 100,
					],
				],
				'default'            => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-flyout-wrapper .hfe-side' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-flyout-open.left'  => 'left: -{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-flyout-open.right' => 'right: -{{SIZE}}{{UNIT}}',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

			$this->add_responsive_control(
				'padding_flyout_menu_item',
				[
					'label'              => __( 'Flyout Box Padding', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 30,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .hfe-flyout-content' => 'padding: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_menu_item',
				[
					'label'              => __( 'Padding', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .hfe-nav-menu nav > ul > li > .hfe-has-submenu-container > a, {{WRAPPER}} .hfe-nav-menu nav > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
			    'margin_horizontal_menu_item',
			    [
			        'label' => esc_html__( 'Margin', 'rsaddon' ),
			        'type' => Controls_Manager::DIMENSIONS,
			        'range' => [
			            'px' => [
			                'max' => 100,
			            ],
			        ],
			        'default' => [
			            'size' => 30,
			        ],  
			        'selectors' => [
			            '{{WRAPPER}} .hfe-nav-menu nav > ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);
			
			$this->add_control(
				'item_border_color',
				[
					'label'     => __( 'Item Border Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .hfe-nav-menu nav.border-tops > ul > li > a::before,
						{{WRAPPER}} .hfe-nav-menu nav.border-tops > ul > li > div > a::before' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'item_arrows_color',
				[
					'label'     => __( 'Item arrow Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .hfe-nav-menu nav.arrow-tops > ul > li > a::before,
						{{WRAPPER}} .hfe-nav-menu nav.arrow-tops > ul > li > div > a::before' => 'border-top-color: {{VALUE}}',
					],
				]
			);


			$this->add_responsive_control(
				'menu_row_space',
				[
					'label'              => __( 'Row Spacing', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'body:not(.rtl) {{WRAPPER}} .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);
			$this->add_responsive_control(
	            'main_menu_wrapper__width',
	            [
	                'label' => esc_html__( 'Menu Wrapper Width', 'rs-header-footer-elementor' ),
	                'type' => Controls_Manager::SLIDER, 
					'size_units' => [ 'px','%' ,'custom'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],               
	                'selectors' => [
	                    '{{WRAPPER}} .hfe-nav-menu' => 'width: {{SIZE}}{{UNIT}};',                   
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'main_menu_min_width',
	            [
	                'label' => esc_html__( 'Min Width', 'rs-header-footer-elementor' ),
	                'type' => Controls_Manager::SLIDER, 
					'size_units' => [ 'px','%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],               
	                'selectors' => [
	                    '{{WRAPPER}} .hfe-nav-menu__layout-horizontal li.menu-item' => 'min-width: {{SIZE}}{{UNIT}};',                   
	                ],
	            ]
	        );

			$this->add_responsive_control(
				'menu_top_space',
				[
					'label'              => __( 'Menu Item Top Spacing', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px', '%' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .hfe-flyout-wrapper .hfe-nav-menu > li.menu-item:first-child' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_bottom_space_last_zero',
				[
					'label'              => __( 'Menu Item Bottom', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px', '%' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} ul.hfe-nav-menu > li.menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} ul.hfe-nav-menu > li.menu-item:last-child' => 'margin-bottom: 0 !important',
					],
					'condition'          => [
						'layout' => 'vertical',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'menu_text_style',
				[
					'label'   => esc_html__( 'Menu Text Style', 'rsaddon' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'normal',
					'options' => [					
						'normal' => esc_html__( 'Normal', 'rsaddon'),
						'gradient' => esc_html__( 'Gradient', 'rsaddon'),
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'menu_text_normal_heading',
				[
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Normal Gradient Heading Color', 'rs-header-footer-elementor' ),
					'separator' => 'before',
					'condition' => ['menu_text_style' => 'gradient']
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'menu_nromal_text_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .hfe-nav-menu.gradient .hfe-nav-menu li a',
					'condition' => ['menu_text_style' => 'gradient']
				]
			);

			$this->add_control(
				'menu_text_gradient_heading',
				[
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Hover Gradient Heading Color', 'rs-header-footer-elementor' ),
					'separator' => 'before',
					'condition' => ['menu_text_style' => 'gradient']
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'menu_hover_text_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .hfe-nav-menu.gradient .hfe-nav-menu li a:hover',
					'condition' => ['menu_text_style' => 'gradient']
				]
			);

			$this->add_control(
				'bg_color_flyout',
				[
					'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .hfe-flyout-content' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'pointer',
				[
					'label'     => __( 'Link Hover Effect', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'none',
					'options'   => [
						'none'        => __( 'None', 'rs-header-footer-elementor' ),
						'underline'   => __( 'Underline', 'rs-header-footer-elementor' ),
						'overline'    => __( 'Overline', 'rs-header-footer-elementor' ),
						'double-line' => __( 'Double Line', 'rs-header-footer-elementor' ),
						'framed'      => __( 'Framed', 'rs-header-footer-elementor' ),
						'text'        => __( 'Text', 'rs-header-footer-elementor' ),
					],
					'condition' => [
						'layout' => [ 'horizontal' ],
					],
				]
			);

		$this->add_control(
			'animation_line',
			[
				'label'     => __( 'Animation', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => __('Fade', 'rs-header-footer-elementor'),
					'slide'    => __('Slide', 'rs-header-footer-elementor'),
					'grow'     => __('Grow', 'rs-header-footer-elementor'),
					'drop-in'  => __('Drop In', 'rs-header-footer-elementor'),
					'drop-out' => __('Drop Out', 'rs-header-footer-elementor'),
					'none'     => __('None', 'rs-header-footer-elementor'),
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => [ 'underline', 'overline', 'double-line' ],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label'     => __( 'Frame Animation', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => __('Fade', 'rs-header-footer-elementor'),
					'grow'    => __('Grow', 'rs-header-footer-elementor'),
					'shrink'  => __('Shrink', 'rs-header-footer-elementor'),
					'draw'    => __('Draw', 'rs-header-footer-elementor'),
					'corners' => __('Corners', 'rs-header-footer-elementor'),
					'none'    => __('None', 'rs-header-footer-elementor'),
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label'     => __( 'Animation', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => [
					'grow'   => __('Grow', 'rs-header-footer-elementor'),
					'shrink' => __('Shrink', 'rs-header-footer-elementor'),
					'sink'   => __('Sink', 'rs-header-footer-elementor'),
					'float'  => __('Float', 'rs-header-footer-elementor'),
					'skew'   => __('Skew', 'rs-header-footer-elementor'),
					'rotate' => __('Rotate', 'rs-header-footer-elementor'),
					'none'   => __('None', 'rs-header-footer-elementor'),
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'text',
				],
			]
		);

		$this->add_control(
			'style_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'menu_typography',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} a.hfe-menu-item, {{WRAPPER}} a.hfe-sub-menu-item',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

				$this->start_controls_tab(
					'tab_menu_item_normal',
					[
						'label' => __( 'Normal', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_menu_item',
						[
							'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item' => 'color: {{VALUE}}',
							],
						]
					);
					
					$this->add_control(
						'color_menu_item_icon',
						[
							'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li.menu-item a:before' => 'border-left-color: {{VALUE}}',
								'{{WRAPPER}} .right-arrow ul li.menu-item a:after' => 'background: {{VALUE}}',
							],
							'condition' => [
								'layout' => 'vertical',
								'right_arrow' => 'right-arrow',
							],
						]
					);

					

					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' => 'bg_color_menu_item',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item',
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'main_menu_border',
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item',
						]
					);

					$this->add_responsive_control(
						'main_menu_border_radius',
						[
							'label'              => __( 'Border Radius', 'rs-header-footer-elementor' ),
							'type'               => Controls_Manager::DIMENSIONS,
							'size_units'         => [ 'px', '%' ],
							'selectors'          => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'frontend_available' => true,
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover',
					[
						'label' => __( 'Hover', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_menu_item_hover',
						[
							'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item:hover a.hfe-menu-item,
								{{WRAPPER}} .menu-item.highlighted a.hfe-menu-item,
								{{WRAPPER}} .menu-item:focus a.hfe-menu-item' => 'color: {{VALUE}} !important',
							],
						]
					);

					$this->add_control(
						'color_menu_item_icon_hover',
						[
							'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li.menu-item:hover a:before' => 'border-left-color: {{VALUE}}!important',
								'{{WRAPPER}} .right-arrow ul li.menu-item:hover a:after' => 'background: {{VALUE}}!important',
								'{{WRAPPER}} .hfe-layout-vertical .right-arrow-style2 ul .menu-item a:after' => 'color: {{VALUE}}!important',
							],
							'condition' => [
								'layout' => 'vertical',
								'right_arrow' => 'right-arrow',
								'right_arrow' => 'right-arrow',
								'right_arrow' => 'right-arrow-style2',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' => 'bg_color_menu_item_hover',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item:hover, {{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item, {{WRAPPER}} .menu-item a.hfe-menu-item.highlighted, {{WRAPPER}} .menu-item a.hfe-menu-item:focus',
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'main_menu_hover_border',
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item:hover',
						]
					);
		
					$this->add_responsive_control(
						'main_menu_hover_border_radius',
						[
							'label'              => __( 'Hover Border Radius', 'rs-header-footer-elementor' ),
							'type'               => Controls_Manager::DIMENSIONS,
							'size_units'         => [ 'px', '%' ],
							'selectors'          => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
							'frontend_available' => true,
						]
					);

					$this->add_control(
						'pointer_color_menu_item_hover',
						[
							'label'     => __( 'Link Hover Effect Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent a.hfe-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent .sub-menu .hfe-has-submenu-container a:after' => 'background-color: unset',
								'{{WRAPPER}} .hfe-pointer__framed .menu-item.parent a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-pointer__framed .menu-item.parent a.hfe-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active',
					[
						'label' => __( 'Active', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_menu_item_active',
						[
							'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.hfe-menu-item' => 'color: {{VALUE}}!important',
							],
						]
					);

					$this->add_control(
						'color_menu_item_icon_active',
						[
							'label'     => __( 'Icon Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li.menu-item.current-menu-item a:before' => 'border-left-color: {{VALUE}}',
								'{{WRAPPER}} .right-arrow ul li.menu-item.current-menu-item a:after' => 'background: {{VALUE}}',
							],
							'condition' => [
								'layout' => 'vertical',
								'right_arrow' => 'right-arrow',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Background::get_type(),
						[
							'name' => 'bg_color_menu_item_active',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item, {{WRAPPER}} .menu-item.current-menu-ancestor a.hfe-menu-item',
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_control(
						'pointer_color_menu_item_active',
						[
							'label'     => __( 'Link Hover Effect Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent.current-menu-item a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent.current-menu-item a.hfe-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .hfe-nav-menu:not(.hfe-pointer__framed) .menu-item.parent .sub-menu .hfe-has-submenu-container a.current-menu-item:after' => 'background-color: unset',
								'{{WRAPPER}} .hfe-pointer__framed .menu-item.parent.current-menu-item a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-pointer__framed .menu-item.parent.current-menu-item a.hfe-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'bg_color_menu_item_hovers',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .menu-item:hover a.hfe-menu-item cite.rs_item_wrap:before, {{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item cite.rs_item_wrap:before, {{WRAPPER}} .menu-item.current-menu-ancestor a.hfe-menu-item cite.rs_item_wrap:before',
					'condition' => [
						'layout!' => 'flyout',
					],
				]
			);

			$this->add_responsive_control(
	            'pad__top_cals',
	            [
	                'label' => esc_html__( 'Top Padding', 'rs-header-footer-elementor' ),
	                'type' => Controls_Manager::SLIDER, 
					'size_units' => [ 'px','%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],               
	                'selectors' => [
	                    '{{WRAPPER}} cite.rs_item_wrap::before' => 'top:calc(100% - {{SIZE}}{{UNIT}});',                   
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'pad__top_cals_btm',
	            [
	                'label' => esc_html__( 'Top Padding', 'rs-header-footer-elementor' ),
	                'type' => Controls_Manager::SLIDER, 
					'size_units' => [ 'px','%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],               
	                'selectors' => [
	                    '{{WRAPPER}} cite.rs_item_wrap::before' => 'bottom:calc(100% - {{SIZE}}{{UNIT}});',                   
	                ],
	            ]
	        );

			$this->add_responsive_control(
				'main_menu_border_radiusd',
				[
					'label'              => __( 'Border Radius', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'selectors'          => [
						'{{WRAPPER}} cite.rs_item_wrap:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'layout!' => 'flyout',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_right_arrow',
			[
				'label'     => __( 'Right Arrow Style', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'right_arrow' => 'right-arrow',
				],
			]
		);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'right_arrow_style_typography',
					'selector' => '{{WRAPPER}} .right-arrow ul li a:before',
				]
			);
			$this->start_controls_tabs('right_arrow_style_tabs');
				$this->start_controls_tab(
					'right_arrow_style_tabs_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'rs-header-footer-elementor' ),
					]
				);
					$this->add_control(
						'_right_arrow_color',
						[
							'label' => esc_html__( 'Color', 'rs-header-footer-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li a:before' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'_right_arrow_position_right',
						[
							'label' => esc_html__( 'Position X', 'rs-header-footer-elementor' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%', 'custom' ],
							'range' => [
								'px' => [
									'min' => -1000,
									'max' => 1000,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li a:before' => 'right: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'_right_arrow_position_top',
						[
							'label' => esc_html__( 'Position Y', 'rs-header-footer-elementor' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%', 'custom' ],
							'range' => [
								'px' => [
									'min' => -1000,
									'max' => 1000,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li a:before' => 'top: {{SIZE}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'right_arrow_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'rs-header-footer-elementor' ),
					]
				);
					$this->add_control(
						'_right_arrow_color_hover',
						[
							'label' => esc_html__( 'Color', 'rs-header-footer-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li a:hover:before' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_responsive_control(
						'_right_arrow_position_right_hover',
						[
							'label' => esc_html__( 'Position X', 'rs-header-footer-elementor' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%', 'custom' ],
							'range' => [
								'px' => [
									'min' => -1000,
									'max' => 1000,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li a:hover:before' => 'right: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'_right_arrow_position_top_hover',
						[
							'label' => esc_html__( 'Position Y', 'rs-header-footer-elementor' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%', 'custom' ],
							'range' => [
								'px' => [
									'min' => -1000,
									'max' => 1000,
								],
								'%' => [
									'min' => -100,
									'max' => 100,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .right-arrow ul li a:hover:before' => 'top: {{SIZE}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_main-menu_responsive',
			[
				'label'     => __( 'Main Menu Style (Mobile)', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style_mobile' );

				$this->start_controls_tab(
					'tab_menu_item_normal_mobile',
					[
						'label' => __( 'Normal', 'rs-header-footer-elementor' ),
					]
				);

				$this->add_control(
					'color_menu_item_mobile',
					[
						'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .menu-is-active .menu-item a.hfe-menu-item, {{WRAPPER}} ul.rs__mobile_info li, {{WRAPPER}} ul.rs__mobile_info li a' => 'color: {{VALUE}}',
						],
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover_mobile',
					[
						'label' => __( 'Hover', 'rs-header-footer-elementor' ),
					]
				);

				$this->add_control(
					'color_menu_item_hover_mobile',
					[
						'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .menu-is-active ul.hfe-nav-menu .menu-item a.hfe-menu-item:hover,
							{{WRAPPER}} .menu-is-active .menu-item a.hfe-menu-item.highlighted,
							{{WRAPPER}} {{WRAPPER}} ul.rs__mobile_info li a:hover,
							{{WRAPPER}} .menu-is-active .menu-item a.hfe-menu-item:focus' => 'color: {{VALUE}}!important;',
						],
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active_mobile',
					[
						'label' => __( 'Active', 'rs-header-footer-elementor' ),
					]
				);

				$this->add_control(
					'color_menu_item_active_mobile',
					[
						'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .hfe-nav-menu .menu-is-active.hfe-dropdown .menu-item.current-menu-item a.hfe-menu-item,
							{{WRAPPER}} .hfe-nav-menu .menu-is-active.hfe-dropdown .menu-item.current-menu-ancestor a.hfe-menu-item' => 'color: {{VALUE}}',
						],
					]
				);

				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls() {

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __( 'Dropdown', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'dropdown_description',
				[
					'raw'             => __( '<b>Note:</b> On desktop, below style options will apply to the submenu. On mobile, this will apply to the entire menu.', 'rs-header-footer-elementor' ),
					'type'            => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
					'condition'       => [
						'layout!' => [
							'expandible',
							'flyout',
						],
					],
				]
			);

			$this->add_control(
			    'dropdown__arrow_color',
			    [
			        'label' => esc_html__( 'Dropdown Line Bg Color', 'rs-header-footer-elementor' ),
			        'type' => Controls_Manager::COLOR,
			        'selectors' => [
			            '{{WRAPPER}} .hfe-nav-menu .menu-item-has-children .sub-menu:before' => 'background-color: {{VALUE}};',
			        ],
			    ]
			);

			$this->add_responsive_control(
	            'dropdown__arrow_color_position',
	            [
	                'label' => esc_html__( 'Dropdown Line Position', 'rs-header-footer-elementor' ),
	                'type' => Controls_Manager::SLIDER,                
	                'selectors' => [
	                    '{{WRAPPER}} .hfe-nav-menu .menu-item-has-children .sub-menu:before' => 'left: {{SIZE}}px;',                   
	                ],
	            ]
	        );


			$this->add_responsive_control(
			    'dropdown_area_padding',
			    [
			        'label' => esc_html__( 'Dropdown Area Padding', 'rsaddon' ),
			        'type' => Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', 'em', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .hfe-nav-menu .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

			$this->add_control(
				'menu_text_submenu_normal_heading',
				[
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Submenu Gradient Heading Color', 'rs-header-footer-elementor' ),
					'separator' => 'before',
					'condition' => ['menu_text_style' => 'gradient']
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'menu_submenu_nromal_text_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .hfe-nav-menu.gradient .hfe-nav-menu li .sub-menu li .hfe-sub-menu-item',
				]
			);

			$this->start_controls_tabs( 'tabs_dropdown_item_style' );

				$this->start_controls_tab(
					'tab_dropdown_item_normal',
					[
						'label' => __( 'Normal', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_dropdown_item',
						[
							'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item, 
								{{WRAPPER}} .elementor-menu-toggle,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_responsive_control(
						'background_color_dropdown_item',
						[
							'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#fff',
							'selectors' => [
								'{{WRAPPER}} .sub-menu,
								{{WRAPPER}} nav.hfe-dropdown,
								{{WRAPPER}} nav.hfe-dropdown-expandible,
								{{WRAPPER}} nav.hfe-dropdown .menu-item a.hfe-menu-item,
								{{WRAPPER}} nav.hfe-dropdown .menu-item a.hfe-sub-menu-item' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_hover',
					[
						'label' => __( 'Hover', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'color_dropdown_item_hover',
						[
							'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item:hover, 
								{{WRAPPER}} .elementor-menu-toggle:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_responsive_control(
						'background_color_dropdown_item_hover',
						[
							'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item:hover' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_active',
					[
						'label' => __( 'Active', 'rs-header-footer-elementor' ),
					]
				);

				$this->add_control(
					'color_dropdown_item_active',
					[
						'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active,	
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-item a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-ancestor a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active
							' => 'color: {{VALUE}}',

						],
					]
				);

				$this->add_responsive_control(
					'background_color_dropdown_item_active',
					[
						'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active,	
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-item a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-ancestor a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active' => 'background-color: {{VALUE}}',
						],
						'separator' => 'after',
					]
				);

				$this->end_controls_tabs();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'dropdown_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'separator' => 'before',
					'selector'  => '
							{{WRAPPER}} .sub-menu li a.hfe-sub-menu-item,
							{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item,
							{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item',
				]
			);

	        $this->add_control(
				'mega_menu_title',
				[
					'label' => esc_html__( 'Mega Menu Title', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'mega_menu_title_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'separator' => 'before',
					'selector'  => '{{WRAPPER}} .hfe-nav-menu .rs-mega-menu .sub-menu li .hfe-has-submenu-container a',
				]
			);

	        $this->add_control(
				'mega_menu_full_pad_title',
				[
					'label' => esc_html__( 'Mega Menu Full Padding', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_responsive_control(
			    'mega_menu_full_padding',
			    [
			        'label' => esc_html__( 'Padding', 'rsaddon' ),
			        'type' => Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', 'em', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .hfe-nav-menu .rs-mega-menu > .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);

	        $this->add_control(
				'mega_menu_item_padding',
				[
					'label' => esc_html__( 'Mega Menu Item Padding', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);

			$this->add_responsive_control(
			    'mega_menu_item_paddingddd',
			    [
			        'label' => esc_html__( 'Padding', 'rsaddon' ),
			        'type' => Controls_Manager::DIMENSIONS,
			        'size_units' => [ 'px', 'em', '%' ],
			        'selectors' => [
			            '{{WRAPPER}} .hfe-nav-menu .rs-mega-menu .sub-menu a.hfe-menu-item, {{WRAPPER}} .hfe-nav-menu .rs-mega-menu .sub-menu a.hfe-sub-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			        ],
			    ]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'dropdown_border',
					'selector' => '{{WRAPPER}} nav.hfe-nav-menu__layout-horizontal .sub-menu, 
							{{WRAPPER}} nav:not(.hfe-nav-menu__layout-horizontal) .sub-menu.sub-menu-open,
							{{WRAPPER}} nav.hfe-dropdown .hfe-nav-menu,
						 	{{WRAPPER}} nav.hfe-dropdown-expandible .hfe-nav-menu',
				]
			);

			$this->add_responsive_control(
				'dropdown_border_radius',
				[
					'label'              => __( 'Border Radius', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .sub-menu li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden;',
						'{{WRAPPER}} .sub-menu li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.hfe-dropdown li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown-expandible' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
					],
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'dropdown_box_shadow',
					'exclude'   => [
						'box_shadow_position',
					],
					'selector'  => '{{WRAPPER}} .hfe-nav-menu .sub-menu,
								{{WRAPPER}} nav.hfe-dropdown,
						 		{{WRAPPER}} nav.hfe-dropdown-expandible',
					'separator' => 'after',
				]
			);

			$this->add_responsive_control(
				'width_dropdown_item',
				[
					'label'              => __( 'Dropdown Width (px)', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'default'            => [
						'size' => '220',
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} ul.sub-menu' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_dropdown_item',
				[
					'label'              => __( 'Horizontal Padding', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu li a.hfe-sub-menu-item,
						{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
						{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav.hfe-dropdown-expandible a.hfe-sub-menu-item,
						{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_dropdown_item',
				[
					'label'              => __( 'Vertical Padding', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'distance_from_menu',
				[
					'label'              => __( 'Top Distance', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} nav.hfe-nav-menu__layout-horizontal:not(.hfe-dropdown) ul.sub-menu, {{WRAPPER}} nav.hfe-nav-menu__layout-expandible.menu-is-active, {{WRAPPER}} nav.hfe-nav-menu__layout-vertical:not(.hfe-dropdown) ul.sub-menu' => 'margin-top: {{SIZE}}px;',
						'{{WRAPPER}} .hfe-dropdown.menu-is-active' => 'margin-top: {{SIZE}}px;',
					],
					'condition'          => [
						'layout' => [ 'horizontal', 'vertical', 'expandible' ],
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'heading_dropdown_divider',
				[
					'label'     => __( 'Divider', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'dropdown_divider_border',
				[
					'label'       => __( 'Border Style', 'rs-header-footer-elementor' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => false,
					'options'     => [
						'none'   => __( 'None', 'rs-header-footer-elementor' ),
						'solid'  => __( 'Solid', 'rs-header-footer-elementor' ),
						'double' => __( 'Double', 'rs-header-footer-elementor' ),
						'dotted' => __( 'Dotted', 'rs-header-footer-elementor' ),
						'dashed' => __( 'Dashed', 'rs-header-footer-elementor' ),
					],
					'selectors'   => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-style: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'divider_border_color',
				[
					'label'     => __( 'Border Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#c4c4c4',
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

			

			$this->add_control(
				'dropdown_divider_width',
				[
					'label'     => __( 'Border Width', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'default'   => [
						'size' => '1',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

		$this->add_control(
			'divider_border_colors_megas',
			[
				'label'     => __( 'Border Color (Mega)', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#C8C0E230',
				'selectors' => [
					'{{WRAPPER}} .hfe-nav-menu ul > li.menu-item.rs-mega-menu > ul.sub-menu > li > a' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_toggle',
			[
				'label' => __( 'Menu Trigger & Close Icon', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_style_normal',
			[
				'label' => __( 'Normal', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.hfe-nav-menu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.hfe-nav-menu-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-nav-menu-icon' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
				'condition' => ['menu_text_style' => 'normal']
				
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_icon_gradient',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .hfe-nav-menu-icon',
				'condition' => ['menu_text_style' => 'gradient']
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			[
				'label' => __( 'Hover', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_hover_color',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.hfe-nav-menu-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.hfe-nav-menu-icon:hover svg' => 'fill: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'toggle_hover_background_color',
			[
				'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-nav-menu-icon:hover' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
				'condition' => ['menu_text_style' => 'normal']
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'nav_icon_gradient_hover',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .hfe-nav-menu-icon:hover',
				'condition' => ['menu_text_style' => 'gradient']
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label'              => __( 'Icon Size', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-nav-menu-icon'     => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-nav-menu-icon svg' => 'font-size: {{SIZE}}px;line-height: {{SIZE}}px;height: {{SIZE}}px;width: {{SIZE}}px;',
				],
				'frontend_available' => true,
				'separator'          => 'before',
			]
		);

		$this->add_responsive_control(
			'toggle_border_width',
			[
				'label'              => __( 'Border Width', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-nav-menu-icon' => 'border-width: {{SIZE}}{{UNIT}}; padding: 0.35em;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'              => __( 'Border Radius', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .hfe-nav-menu-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'close_color_flyout',
			[
				'label'     => __( 'Close Icon Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A7A7A',
				'selectors' => [
					'{{WRAPPER}} .hfe-flyout-close'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .hfe-flyout-close svg' => 'fill: {{VALUE}}',

				],
				'condition' => [
					'layout' => 'flyout',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'close_flyout_size',
			[
				'label'              => __( 'Close Icon Size', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-flyout-close,
					{{WRAPPER}} .hfe-flyout-close svg' => 'height: {{SIZE}}px; width: {{SIZE}}px; font-size: {{SIZE}}px; line-height: {{SIZE}}px;',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'style_button',
			[
				'label'     => __( 'Button', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_last_item' => 'cta',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'all_typography',
					'label'    => __( 'Typography', 'rs-header-footer-elementor' ),
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
				]
			);
			$this->add_responsive_control(
				'padding',
				[
					'label'              => __( 'Padding', 'rs-header-footer-elementor' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', 'em', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->start_controls_tabs( '_button_style' );

				$this->start_controls_tab(
					'_button_normal',
					[
						'label' => __( 'Normal', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'all_text_color',
						[
							'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_color',
							'label'          => __( 'Background Color', 'rs-header-footer-elementor' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'all_border',
							'label'    => __( 'Border', 'rs-header-footer-elementor' ),
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
						]
					);

					$this->add_control(
						'all_border_radius',
						[
							'label'      => __( 'Border Radius', 'rs-header-footer-elementor' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'     => 'all_button_box_shadow',
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'all_button_hover',
					[
						'label' => __( 'Hover', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_control(
						'all_hover_color',
						[
							'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_hover_color',
							'label'          => __( 'Background Color', 'rs-header-footer-elementor' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_control(
						'all_border_hover_color',
						[
							'label'     => __( 'Border Hover Color', 'rs-header-footer-elementor' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'      => 'all_button_hover_box_shadow',
							'selector'  => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover',
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
		$this->start_controls_section(
			'style_dots',
			[
				'label'     => __( 'Dots Style', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_last_item' => 'cta',
				],
				'condition' => ['left_circle' => 'left-circle']
			]
		);

		$this->add_control(
			'left_outer_circle_color',
			[
				'label'     => __( 'Dots Outer Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hfe-layout-vertical .left-circle ul li:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .hfe-layout-horizontal .left-circle ul li:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'leftdots_inner_circle_color',
			[
				'label'     => __( 'Dots Inner Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hfe-layout-vertical .left-circle ul li:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .hfe-layout-horizontal .left-circle ul li:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
		    'dots_outer_pos',
		    [
				'label'      => esc_html__( 'Outer Dots Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-layout-vertical .left-circle ul li:before' => 'top: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .hfe-layout-horizontal .left-circle ul li:before' => 'top: {{SIZE}}{{UNIT}};',
		        ],		        
		    ]
		);

		$this->add_responsive_control(
		    'dots_inner_pos',
		    [
				'label'      => esc_html__( 'Inner Dots Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-layout-vertical .left-circle ul li:after' => 'top: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .hfe-layout-horizontal .left-circle ul li:after' => 'top: {{SIZE}}{{UNIT}};',
		        ],		        
		    ]
		);
	
		$this->end_controls_section();
		$this->start_controls_section(
			'style_arrow_style',
			[
				'label'     => __( 'Arrow Style', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_last_item' => 'cta',
				],
				'condition' => ['right_arrow' => 'left-arrow']
			]
		);

		$this->add_responsive_control(
		    'arrow_border_style_color',
		    [
		        'label' => esc_html__( 'Color', 'rs-header-footer-elementor' ),
		        'type' => Controls_Manager::COLOR,
				'condition' => ['right_arrow' => 'left-arrow']
		    ]
		);
		$this->end_controls_section();
	}

	/**
	 * Add itemprop for Navigation Schema.
	 *
	 */
	public function handle_link_attrs( $atts ) {

		$atts .= ' itemprop="url"';
		return $atts;
	}

	/**
	 * Add itemprop to the li tag of Navigation Schema.
	 *
	 */
	public function handle_li_values( $value ) {

		$value .= ' itemprop="name"';
		return $value;
	}

	/**
	 * Get the menu and close icon HTML.
	 */
	public function get_menu_close_icon( $settings ) {
		$menu_icon     = '';
		$close_icon    = '';
		$icons         = [];
		$icon_settings = [
			$settings['dropdown_icon'],
			$settings['dropdown_close_icon'],
		];

		foreach ( $icon_settings as $icon ) {
			if ( $this->is_elementor_updated() ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon(
					$icon,
					[
						'aria-hidden' => 'true',
						'tabindex'    => '0',
					]
				);
				$menu_icon = ob_get_clean();
			} else {
				$menu_icon = '<i class="' . esc_attr( $icon ) . '" aria-hidden="true" tabindex="0"></i>';
			}

			array_push( $icons, $menu_icon );
		}

		return $icons;
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render() {

		$menus = $this->get_available_menus();

		if ( empty( $menus ) ) {
			return false;
		}

		$settings = $this->get_settings_for_display();
		$menu_close_icons = [];
		$menu_close_icons = $this->get_menu_close_icon( $settings );

		
		$args = [
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_class'  => 'hfe-nav-menu',
			'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
			'walker'      => new Menu_Walker,
		];

		$menu_html = wp_nav_menu( $args ); 
		$arrow_border_style_color = $settings['arrow_border_style_color'];
		$menu_text_style = $settings['menu_text_style'];

		?>

		<style>
			.hfe-layout-vertical .left-arrow ul .menu-item:hover a:after {
				background: <?php echo $arrow_border_style_color;?>!important;
			}
			.hfe-layout-vertical .left-arrow ul .menu-item:hover a:before {
				border-left: 6px solid <?php echo $arrow_border_style_color;?>
			}
		</style>

		<?php if ( 'flyout' === $settings['layout'] ) {
			$this->add_render_attribute( 'hfe-flyout', 'class', 'hfe-flyout-wrapper' );
			if ( 'cta' === $settings['menu_last_item'] ) {

				$this->add_render_attribute( 'hfe-flyout', 'data-last-item', $settings['menu_last_item'] );
			}
		?>

			<div class="hfe-nav-menu__toggle elementor-clickable hfe-flyout-trigger <?php echo $menu_text_style;?>" tabindex="0">
				<div class="hfe-nav-menu-icon">
					<?php echo isset( $menu_close_icons[0] ) ? $menu_close_icons[0] : ''; ?> 
				</div>
			</div>

			<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'hfe-flyout' ) ); ?> >
				<div class="hfe-flyout-overlay elementor-clickable"></div>
				<div class="hfe-flyout-container">
					<div id="hfe-flyout-content-id-<?php echo esc_attr( $this->get_id() ); ?>" class="hfe-side hfe-flyout-<?php echo esc_attr( $settings['flyout_layout'] ); ?> hfe-flyout-open" data-layout="<?php echo wp_kses_post( $settings['flyout_layout'] ); ?>" data-flyout-type="<?php echo wp_kses_post( $settings['flyout_type'] ); ?>">
						<div class="hfe-flyout-content push">						
							<nav <?php echo wp_kses_post( $this->get_render_attribute_string( 'hfe-nav-menu' ) ); ?>><?php echo $menu_html; ?></nav>
							<div class="elementor-clickable hfe-flyout-close" tabindex="0">
								<?php echo isset( $menu_close_icons[1] ) ? $menu_close_icons[1] : ''; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
		} else {
			$this->add_render_attribute(
				'hfe-main-menu',
				'class',
				[
					'hfe-nav-menu',
					'hfe-layout-' . $settings['layout'],
					$menu_text_style
				]
			);

			$this->add_render_attribute( 'hfe-main-menu', 'class', 'hfe-nav-menu-layout' );
			$this->add_render_attribute( 'hfe-main-menu', 'class', $settings['mega__menu__col'] );

			$this->add_render_attribute( 'hfe-main-menu', 'class', $settings['layout'] );

			$this->add_render_attribute( 'hfe-main-menu', 'data-layout', $settings['layout'] );

			if ( 'cta' === $settings['menu_last_item'] ) {

				$this->add_render_attribute( 'hfe-main-menu', 'data-last-item', $settings['menu_last_item'] );
			}

			if ( $settings['pointer'] ) {
				if ( 'horizontal' === $settings['layout'] || 'vertical' === $settings['layout'] ) {
					$this->add_render_attribute( 'hfe-main-menu', 'class', 'hfe-pointer__' . $settings['pointer'] );

					if ( in_array( $settings['pointer'], [ 'double-line', 'underline', 'overline' ], true ) ) {
						$key = 'animation_line';
						$this->add_render_attribute( 'hfe-main-menu', 'class', 'hfe-animation__' . $settings[ $key ] );
					} elseif ( 'framed' === $settings['pointer'] || 'text' === $settings['pointer'] ) {
						$key = 'animation_' . $settings['pointer'];
						$this->add_render_attribute( 'hfe-main-menu', 'class', 'hfe-animation__' . $settings[ $key ] );
					}
				}
			}

			if ( 'expandible' === $settings['layout'] ) {
				$this->add_render_attribute( 'hfe-nav-menu', 'class', 'hfe-dropdown-expandible' );
			}

			$this->add_render_attribute(
				'hfe-nav-menu',
				'class',
				[
					'hfe-nav-menu__layout-' . $settings['layout'],
					'hfe-nav-menu__submenu-' . $settings['submenu_icon'],
				]
			);

			$item_arrow__shape_enable = ($settings['item_arrow__shape_enable'] === 'yes') ? 'icon-enable' : 'rs-icon-dis' ;

			$this->add_render_attribute( 'hfe-nav-menu', 'data-toggle-icon', $menu_close_icons[0] );

			$this->add_render_attribute( 'hfe-nav-menu', 'data-close-icon', $menu_close_icons[1] );

			$this->add_render_attribute( 'hfe-nav-menu', 'data-full-width', $settings['full_width_dropdown'] );

			$this->add_render_attribute( 'hfe-nav-menu', 'class', $settings['item_column'] );
			$this->add_render_attribute( 'hfe-nav-menu', 'class', $settings['separator_dots'] );
			$this->add_render_attribute( 'hfe-nav-menu', 'class', $settings['right_arrow'] );
			$this->add_render_attribute( 'hfe-nav-menu', 'class', $settings['left_circle'] );
			$this->add_render_attribute( 'hfe-nav-menu', 'class', $settings['submenu_icon'] );
			$this->add_render_attribute( 'hfe-nav-menu', 'class', $item_arrow__shape_enable );

			

			?>
			<div <?php echo $this->get_render_attribute_string( 'hfe-main-menu' ); ?>>
				<div class="hfe-nav-menu__toggle elementor-clickable">
					<div class="hfe-nav-menu-icon">
						<?php echo isset( $menu_close_icons[0] ) ? $menu_close_icons[0] : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
				
				<nav <?php echo $this->get_render_attribute_string( 'hfe-nav-menu' ); ?>>
					<?php echo $menu_html; ?>
				</nav>              
			</div>

			<?php
		}
	}
}
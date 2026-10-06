<?php
final class Rsaddon_Elementor_Pro_Extension {
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '5.4';
	private static $_instance = null;


	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'rseleemnt_init' ] );
		register_activation_hook( RSADDON_PLUGIN_FILE, [$this,'rselements_plugin_activate'] );

	}

	public function i18n() {
		load_plugin_textdomain( 'rsaddon' );
	}

	public function rseleemnt_init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'rselements_register_plugin_styles' ] );		
		add_action( 'wp_enqueue_scripts', [ $this, 'rselements_register_widget_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'rselements_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'rselements_register_plugin_admin_styles' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'rselements_studio_fonts_url' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'rs_elementor_js'] );

		$this->include_files();

	}

	public static function init() {

		static $_instance = false;


		$get_version = get_option( 'rselement_version' );
        $updated     = get_option( 'rselement_updated' );

        if ( $get_version < RSELEMENT_VERSION && !$updated ) {
			
			
			$all_elements_list = self::rselements_widget_list();

			update_option('rselements_addon_option',$all_elements_list);

			update_option( 'rselement_version', RSELEMENT_VERSION );	
			update_option( 'rselement_updated',false );	
			
        }

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	public function rselements_plugin_activate() {
        $all_elements_list = $this->rselements_widget_list();
		update_option("rs_heading_setting", "rselement_heading");
        update_option('rselements_addon_option',$all_elements_list);
    }



	public static function rselements_widget_list()
    {
        $rsall_elements = [

            'rs_portfolio_post' => 'rs_portfolio_post',
            'rs_team_post' => 'rs_team_post ',
			'rs_service_post' => 'rs_service_post',
            'rs_heading_setting' => 'rselement_heading',
            'rs_team_gread_setting' => 'rselement_team_gread',
            'rs_team_slider_setting' => 'rselement_team_slider',
            'rs_portfolio_grid_setting' => 'rselement_portfolio_grid',
            'rs_portfolio_filter_setting' => 'rselement_portfolio_filter',
            'rs_portfolio_slider_setting' => 'rselement_portfolio_slider',
            'rs_counter_setting' => 'rselement_counter',
            'rs_service_grid_setting' => 'rselement_service_grid',
            'rs_service_slider_setting' => 'rselement_service_grid',
            'rs_service_list_setting' => 'rselement_service_list',
            'rs_gsap_marquee_slide_settings' => 'rs_gsap_marquee_slide',
            'rs_video_setting' => 'rselement_video',
            'rs_pricing_table_setting' => 'rselement_pricing_table',
            'rs_accordion_settings' => 'rs_accordion_value',
            'rs_pricing_switcher_setting' => 'rselement_pricing_switcher',
            'rs_button_setting' => 'rselement_button',
            'rs_logo_showcase_setting' => 'rselement_logo_showcase',
            'rs_image_showcase_setting' => 'rselement_image_showcase',
            'rs_image_hover_effect_setting' => 'rselement_image_hover_effect',
            'rs_image_animation_shape_setting' => 'rselement_image_animation_shape',
            'rs_breadcrumb_setting' => 'rselement_breadcrumb',
            'rs_newsletter_setting' => 'rselement_newsletter',
            'rs_testimonial_slider_setting' => 'rselement_testimonial_slider',
            'rs_latest_blog_grid_setting' => 'rselement_latest_blog_grid',
            'rs_latest_blog_slider_setting' => 'rselement_latest_blog_slider',
            'rs_post_navigation_setting' => 'rs_post_navigation_setting',
            'rs_hotspots_showcase_settings' => 'rs_hotspots_showcase',
            'rs_isotope_filter_settings' => 'rs_isotope_filter',
            'rs_social_icon_settings' => 'rs_social_icon',
            'rs_header_offcanvas_settings' => 'rs_header_offcanvas',
            'rs_pagination_settings' => 'rs_pagination',
            'rs_feature_img_setting' => 'rselement_feature_img',
            'rs_line_rain_animation_setting' => 'rselement_line_rain_animation',
            'rs_contact_cf7_settings' => 'rs_contact_cf7',
            'rs_work_process_settings' => 'rs_work_process_value',
            'rs_company_slogan_settings' => 'rs_company_slogan_value',
            'rs_advanced_tab_settings' => 'rs_advanced_tab_value',
			'rs_project_information_settings' => 'rs_project_information',

        ];

        return $rsall_elements;
    }


	public function rs_elementor_js() {
		$dir = plugin_dir_url(__FILE__);
		wp_enqueue_script( 'rsaddons-offcanvas-js', $dir.'assets/js/custom.js', array('jquery'), '201513434', true);
		wp_enqueue_script( 'rsaddons-countdowntimer-js', $dir.'assets/js/jquery.countdownTimer.js', array('jquery'), '201513434', true);
	}

	function rselements_studio_fonts_url() {
          $font_url = '';
          
          /*
          Translators: If there are characters in your language that are not supported
          by chosen font(s), translate this to 'off'. Do not translate into your own language.
           */
          if ( 'off' !== _x( 'on', 'Google font: on or off', 'rsaddon' ) ) {
              $font_url = add_query_arg( 'family', urlencode( 'Open Sans: 400,500,600,700|Montserrat: 400,500,600,700' ), "//fonts.googleapis.com/css" );
          }
        return $font_url;
    }

	public function rselements_register_plugin_styles() {

		$dir = plugin_dir_url(__FILE__);
              
       // wp_enqueue_style( 'rsaddons-floaticon', $dir.'assets/icon/fonts/flaticon.css' );
        wp_enqueue_style( 'headding-title', $dir.'assets/css/headding-title.css' );
        wp_enqueue_style( 'rsaddons-pro-css', $dir.'assets/css/rsaddons.css',null,time());
		
		wp_enqueue_script( 'popper', $dir.'assets/js/popper.min.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'headding-title', $dir.'assets/js/headding-title.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'slick', $dir.'assets/js/slick.min.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'js-tilt-view', $dir.'assets/js/tilt.jquery.min.js', array('jquery'), '201513434', true);
        wp_enqueue_script( 'jquery-ui', $dir.'assets/js/jquery-ui.js', array('jquery'), '201513434', true);
		wp_enqueue_script( 'parallax', $dir.'assets/js/parallax-effect.min.js', array('jquery'), '201513434', true);
        wp_enqueue_script( 'jquery-plugin-progressbar', $dir.'assets/js/jQuery-plugin-progressbar.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'ddbefore-and-after', $dir.'assets/js/ddbeforeandafter.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'rsaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201513434', true);
		wp_enqueue_script( 'rsaddons-marquee-js', $dir.'assets/js/jquery.marquee.min.js', array('jquery'), '201513434', true);
		wp_enqueue_script( 'rsaddons-music-player-js', $dir.'assets/js/jquery.marquee.min.js', array('jquery'), '201513434', true);
    }

	public function rselements_register_widget_styles(){
		$dir = plugin_dir_url(__FILE__);
		/**
         * Element css
         */
        $rselements_addon_setting = get_option( 'rselements_addon_option' );
        //Heading
        if( isset( $rselements_addon_setting['rs_heading_setting'] ) == 'rselement_heading' ){
            wp_enqueue_style( 'rselements-heading', $dir.'widgets/heading/heading.css' );
        }
       
		
		//Team Gread
        if( isset( $rselements_addon_setting['rs_team_gread_setting'] ) == 'rselement_team_gread' ){
            wp_enqueue_style( 'rselements-team_grid', $dir.'widgets/team-member/team-grid-widget.css' );
        }

		//Team Slider
        if( isset( $rselements_addon_setting['rs_team_slider_setting'] ) == 'rselement_team_slider' ){
            wp_enqueue_style( 'rselements-team_slider', $dir.'widgets/team-member-slider/team-slider-widget.css' );
        }
		//Portfolio Grid
        if( isset( $rselements_addon_setting['rs_portfolio_grid_setting'] ) == 'rselement_portfolio_grid' ){
            wp_enqueue_style( 'rselements-portfolio_grid', $dir.'widgets/portfolio-grid/portfolio-grid.css' );
        }
		//Portfolio Filter
        if( isset( $rselements_addon_setting['rs_portfolio_filter_setting'] ) == 'rselement_portfolio_filter' ){
            wp_enqueue_style( 'rselements-portfolio_filter', $dir.'widgets/portfolio-filter/portfolio-filter-widget.css' );
        }
		//Portfolio Slider
        if( isset( $rselements_addon_setting['rs_portfolio_slider_setting'] ) == 'rselement_portfolio_slider' ){
            wp_enqueue_style( 'rselements-portfolio_slider', $dir.'widgets/portfolio-slider/portfolio-slider.css' );
        }
		//Counter
        if( isset( $rselements_addon_setting['rs_counter_setting'] ) == 'rselement_counter' ){
            wp_enqueue_style( 'rselements-counter', $dir.'widgets/counter/counter.css' );
        }
		//Services Grid
        if( isset( $rselements_addon_setting['rs_service_grid_setting'] ) == 'rselement_service_grid' ){
            wp_enqueue_style( 'rselements-service_grid', $dir.'widgets/services/rs-service-grid.css' );
        }
		//Services Slider
        if( isset( $rselements_addon_setting['rs_service_slider_setting'] ) == 'rselement_service_grid' ){
            wp_enqueue_style( 'rselements-service_slider', $dir.'widgets/service-slider/service-slider-widget.css' );
        }
        // Services List
        if( isset( $rselements_addon_setting['rs_service_list_setting'] ) == 'rselement_service_list' ){
            wp_enqueue_style( 'rselements-service_list', $dir.'widgets/service-list/rs-service-list.css' );
        }
		//Video
        if( isset( $rselements_addon_setting['rs_video_setting'] ) == 'rselement_video' ){
            wp_enqueue_style( 'rselements-video', $dir.'widgets/video/rs-video.css' );
        }
		// GSAP marquee slide
		if( isset( $rselements_addon_setting['rs_gsap_marquee_slide_settings'] ) == 'rs_gsap_marquee_slide' ){
		    wp_enqueue_style( 'rselements-gsap-marquee-slide', $dir.'widgets/gsap-marquee-slide/gsap-marquee-slide.css' );
		}
		//Button
        if( isset( $rselements_addon_setting['rs_button_setting'] ) == 'rselement_button' ){
            wp_enqueue_style( 'rselements-button', $dir.'widgets/button/button.css' );
        }
		//Logo Showcase
        if( isset( $rselements_addon_setting['rs_logo_showcase_setting'] ) == 'rselement_logo_showcase' ){
            wp_enqueue_style( 'rselements-logo_widget', $dir.'widgets/logo-widget/logo-widget.css' );
        }
		// Rain Line Animation
        if( isset( $rselements_addon_setting['rs_line_rain_animation_setting'] ) == 'rselement_line_rain_animation' ){
            wp_enqueue_style( 'rselements-line_rain_animation', $dir.'widgets/line-rain-animation/line-rain-animation.css' );
        }
		//Progress Bar
        if( isset( $rselements_addon_setting['rs_progress_bar_setting'] ) == 'rselement_progress_bar' ){
            wp_enqueue_style( 'rselements-progress_bar', $dir.'widgets/progress/rs-progress.css' );
        }
		
		//Features List
        if( isset( $rselements_addon_setting['rs_features_list_setting'] ) == 'rselement_features_list' ){
            wp_enqueue_style( 'rselements-features_list', $dir.'widgets/feature-list/feature-list.css' );
        }
        
		//Dual Button
        if( isset( $rselements_addon_setting['rs_dual_button_setting'] ) == 'rselement_dual_button' ){
            wp_enqueue_style( 'rselements-dual_button', $dir.'widgets/dual-button/dual-button.css' );
        }
		//Breadcrumb
        if( isset( $rselements_addon_setting['rs_breadcrumb_setting'] ) == 'rselement_breadcrumb' ){
            wp_enqueue_style( 'rselements-breadcrumb', $dir.'widgets/breadcrumb-widget/breadcrumb-widget.css' );
        }
		
		//Newsletter
        if( isset( $rselements_addon_setting['rs_newsletter_setting'] ) == 'rselement_newsletter' ){
            wp_enqueue_style( 'rselements-newsletter', $dir.'widgets/newsletter/newsletter.css' );
        }
	

        //Latest Blog Grid
        if( isset( $rselements_addon_setting['rs_latest_blog_grid_setting'] ) == 'rselement_latest_blog_grid' ){
            wp_enqueue_style( 'rselements-latest_blog', $dir.'widgets/latest-blog-grid/blog-grid.css' );
        }

        //Latest Blog Slider
        if( isset( $rselements_addon_setting['rs_latest_blog_slider_setting'] ) == 'rselement_latest_blog_slider' ){
            wp_enqueue_style( 'rselements-latest_blog_slider', $dir.'widgets/latest-blog-slider/blog-slider.css' );
        }

        //Post Navigation
        if( isset( $rselements_addon_setting['rs_post_navigation_setting'] ) == 'rselement_post_navigation' ){
            wp_enqueue_style( 'rselements-post_navigation', $dir.'widgets/post-navigation/post-navigation.css' );
        }

		// Pricing Switcher
		if( isset( $rselements_addon_setting['rs_pricing_switcher_setting'] ) == 'rselement_pricing_switcher' ){
            wp_enqueue_style( 'rselements-pricing_switcher', $dir.'widgets/pricing-switcher/pricing-switcher.css' );
        }
        // RS Hotspot
		if( isset( $rselements_addon_setting['rs_hotspots_showcase_settings'] ) == 'rs_hotspots_showcase' ){
            wp_enqueue_style( 'rselements-hotspots_showcase', $dir.'widgets/hotspot-widget/hotspot.css' );
        }
        //Testimonial Slider
        if( isset( $rselements_addon_setting['rs_testimonial_slider_setting'] ) == 'rselement_testimonial_slider' ){
            wp_enqueue_style( 'rselements-testimonial_slider', $dir.'widgets/testimonial/slider/testimonial-slider-widget.css' );
        }

		if( isset( $rselements_addon_setting['rs_social_icon_settings'] ) == 'rs_social_icon' ) {
			wp_enqueue_style( 'rselements-social-icons', $dir.'widgets/social-icons/rs-social-icons.css' );
		}
		
		if( isset( $rselements_addon_setting['rs_header_offcanvas_settings'] ) == 'rs_header_offcanvas' ) {
			wp_enqueue_style( 'rselements-header-offcanvas', $dir.'widgets/header-offcanvas/header-offcanvas.css' );
		}

		if( isset( $rselements_addon_setting['rs_contact_cf7_settings'] ) == 'rs_contact_cf7' ) {
			wp_enqueue_style( 'rselements-cf7-widget', $dir.'widgets/cf7/cf7.css' );
		}

		if( isset( $rselements_addon_setting['rs_accordion_settings'] ) == 'rs_accordion_value' ) {
			wp_enqueue_style( 'rselements-accordion-widget', $dir.'widgets/rs-accordion/rs-accordion.css' );
		}

		if( isset( $rselements_addon_setting['rs_advanced_tab_settings'] ) == 'rs_advanced_tab_value' ) {
			wp_enqueue_style( 'rselements-advanced-tab-widget', $dir.'widgets/advanced-tab/advanced-tab.css' );
		}

		if( isset( $rselements_addon_setting['rs_company_slogan_settings'] ) == 'rs_company_slogan_value' ) {
			wp_enqueue_style( 'rselements-company-slogan-widget', $dir.'widgets/company-slogan/company-slogan.css' );
		}
		if( isset( $rselements_addon_setting['rs_project_information_settings'] ) == 'rs_project_information_settings' ) {
			wp_enqueue_style( 'rselements-project-information', $dir.'widgets/project-information/project-information.css' );
		}
		wp_enqueue_style( 'marquee-slider-widget', $dir.'widgets/marquee-slider-logo/marquee-slider-widget.css' );

        //if( isset( $rselements_addon_setting['rs_iconbox_settings'] ) == 'rs_iconbox_value' ) {
            wp_enqueue_style( 'rselements-iconbox-widget', $dir.'widgets/iconbox/iconbox.css' );
        //}
		wp_enqueue_style( 'rselements-image-widget', $dir.'widgets/image-widget/image-widget.css' );
		wp_enqueue_style( 'rselements-progress-widget', $dir.'widgets/progress/rs-progress.css' );
		wp_enqueue_style( 'rselements-work-process', $dir.'widgets/work-process/work-process.css' );
		wp_enqueue_style( 'rselements-award-widget', $dir.'widgets/rs-award-widget/award-widget.css' );
		wp_enqueue_style( 'rselements-brochures', $dir.'widgets/brochures/brochures.css' );
		
		

	}

    public function rselements_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rselements-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'rselements-admin-floaticon-pro', $dir.'assets/icon/fonts/flaticon.css' );
    } 

    public function rselements_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rselements-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/rs-addon-icons.php' ); 
        require( __DIR__ . '/inc/rs-icon-manager.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
        require( __DIR__ . '/inc/single-templates.php' );
        
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'rsaddon_category',
            [
                'title' => esc_html__( 'Industrie Addons', 'rsaddon' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
		$dir = plugin_dir_url(__FILE__);
		//wp_enqueue_style( 'rselements-admin-floaticon-pro', $dir.'assets/icon/fonts/flaticon.css' );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rsaddon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rsaddon' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'rsaddon' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

        $rselements_addon_setting = get_option( 'rselements_addon_option' );
        //Heading
        if( isset( $rselements_addon_setting['rs_heading_setting'] ) == 'rselement_heading' ) {
            require_once(__DIR__ . '/widgets/heading/heading.php');
            \Elementor\Plugin::instance()->widgets_manager->register(new \Rsaddon_Elementor_pro_Heading_Widget());
        }
		
		//team grid
		if( isset( $rselements_addon_setting['rs_team_gread_setting'] ) == 'rselement_team_gread' ) {
			require_once( __DIR__ . '/widgets/team-member/team-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Team_Grid_Widget() );
		}
		
		//Team Slider
		if( isset( $rselements_addon_setting['rs_team_slider_setting'] ) == 'rselement_team_slider' ) {
			require_once( __DIR__ . '/widgets/team-member-slider/team-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Team_Slider_Pro_Widget() );
		}
		//Portfolio Grid
		if( isset( $rselements_addon_setting['rs_portfolio_grid_setting'] ) == 'rselement_portfolio_grid' ) {
			require_once( __DIR__ . '/widgets/portfolio-grid/portfolio-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_pro_Grid_Widget() );
		}
		//Portfolio Filter
		if( isset( $rselements_addon_setting['rs_portfolio_filter_setting'] ) == 'rselement_portfolio_filter' ) {
			require_once( __DIR__ . '/widgets/portfolio-filter/portfolio-filter-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_pro_Filter_Widget() );
		}
		//Portfolio Slider
		if( isset( $rselements_addon_setting['rs_portfolio_slider_setting'] ) == 'rselement_portfolio_slider' ) {
			require_once( __DIR__ . '/widgets/portfolio-slider/portfolio-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_Slider_Pro_Widget() );	
		}
		//Counter
		if( isset( $rselements_addon_setting['rs_counter_setting'] ) == 'rselement_counter' ) {
			require_once( __DIR__ . '/widgets/counter/rs-counter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSCounter_Widget() );
		}
		//Service Grid
		if( isset( $rselements_addon_setting['rs_service_grid_setting'] ) == 'rselement_service_grid' ) {
			require_once( __DIR__ . '/widgets/services/rs-service-grid.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSservices_Grid_Widget() );
		}
		//Service Slider
		if( isset( $rselements_addon_setting['rs_service_slider_setting'] ) == 'rselement_service_slider' ) {
			require_once( __DIR__ . '/widgets/service-slider/service-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSservices_Slider_Widget() );
		}
		// Service List
		if( isset( $rselements_addon_setting['rs_service_list_setting'] ) == 'rselement_service_list' ) {
			require_once( __DIR__ . '/widgets/service-list/rs-service-list.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSservices_List_Widget() );
		}
		//Video
		if( isset( $rselements_addon_setting['rs_video_setting'] ) == 'rselement_video' ) {
			require_once( __DIR__ . '/widgets/video/rs-video.php');
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSvideo_Widget() );
		}
		// Hotspot
		if( isset( $rselements_addon_setting['rs_hotspots_showcase_settings'] ) == 'rs_hotspots_showcase' ) {
			require_once( __DIR__ . '/widgets/hotspot-widget/hotspot.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \rselementsElementor_Pro_Hotspot_Showcase_Widget() );
		}
		// GSAP marquee slide
        if( isset( $rselements_addon_setting['rs_gsap_marquee_slide_settings'] ) == 'rs_gsap_marquee_slide' ){
            require_once( __DIR__ . '/widgets/gsap-marquee-slide/gsap-marquee-slide.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_GSAP_Marquee_Slider_Widget() );
        }
		//Pricing Table
		if( isset( $rselements_addon_setting['rs_pricing_table_setting'] ) == 'rselement_pricing_table' ) {
			require_once( __DIR__ . '/widgets/pricing-table/pricing-table.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Pricing_Table_Widget() );
		}
		
		//Pricing Switcher
		if( isset( $rselements_addon_setting['rs_pricing_switcher_setting'] ) == 'rselement_pricing_switcher' ) {
			require_once( __DIR__ . '/widgets/pricing-switcher/pricing-switcher.php');
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RS_Pricing_Switcher_Widget() );
		}
		//Button
		if( isset( $rselements_addon_setting['rs_button_setting'] ) == 'rselement_button' ) {
			require_once( __DIR__ . '/widgets/button/button.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Button_Widget() );
		}
		//Logo Showcase
		if( isset( $rselements_addon_setting['rs_logo_showcase_setting'] ) == 'rselement_logo_showcase' ) {
			require_once( __DIR__ . '/widgets/logo-widget/logo.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Logo_Showcase_Widget() );
		}

		//Breadcrumb
		if( isset( $rselements_addon_setting['rs_breadcrumb_setting'] ) == 'rselement_breadcrumb' ) {
			require_once( __DIR__ . '/widgets/breadcrumb-widget/breadcrumb.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Breadcrumb_Widget() );
		}
		// Rain Line Animation
		if( isset( $rselements_addon_setting['rs_line_rain_animation_setting'] ) == 'rs_line_rain_animation_setting' ) {
			require_once( __DIR__ . '/widgets/line-rain-animation/animate_line.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_banner_animate_Widget() );
		}

		// Feature Image
		if( isset( $rselements_addon_setting['rs_feature_img_setting'] ) == 'rs_feature_img_setting' ) {
			require_once( __DIR__ . '/widgets/feature-img/feature-img.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \rselementsElementor_Pro_Feature_Img_Widget() );	
		}
		
		//Newsletter
		if( isset( $rselements_addon_setting['rs_newsletter_setting'] ) == 'rselement_newsletter' ) {
			require_once( __DIR__ . '/widgets/newsletter/newsletter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSNewsLetter_Widget() );
		}
		
        // Latest Blog Grid

        if( isset( $rselements_addon_setting['rs_latest_blog_grid_setting'] ) == 'rselement_latest_blog_grid' ){
            require_once( __DIR__ . '/widgets/latest-blog-grid/blog-grid-widget.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_latest_Blog_Grid_Widget() );
        }

        // Latest Blog Slider
        if( isset( $rselements_addon_setting['rs_latest_blog_slider_setting'] ) == 'rselement_latest_blog_slider' ){
            require_once( __DIR__ . '/widgets/latest-blog-slider/blog-slider-widget.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_latest_Blog_Slider_Widget() );
        }

		// Post Navigation
		if( isset( $rselements_addon_setting['rs_post_navigation_setting'] ) == 'rs_post_navigation' ) {
			require_once( __DIR__ . '/widgets/post-navigation/post-navigation.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Post_Navigation_Widget() );
		}

		// Register widget
		if( isset( $rselements_addon_setting['rs_social_icon_settings'] ) == 'rs_social_icon' ) {
			require_once( __DIR__ . '/widgets/social-icons/rs-social-icons.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_proSocial_Icons_Widget() );
		}

        //Testimonial Slider
        if( isset( $rselements_addon_setting['rs_testimonial_slider_setting'] ) == 'rselement_testimonial_slider' ){
            require_once( __DIR__ . '/widgets/testimonial/slider/testimonial-slider-widget.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RS_Testimonial_Slider_Widget() ); 
        }

		// header offcanvas widget
		if( isset( $rselements_addon_setting['rs_header_offcanvas_settings'] ) == 'rs_header_offcanvas' ) {
			require_once( __DIR__ . '/widgets/header-offcanvas/header-offcanvas.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Offcanvas_Widget() );
		}

		if( isset( $rselements_addon_setting['rs_pagination_settings'] ) == 'rs_pagination' ) {
			require_once( __DIR__ . '/widgets/pagination/pagination.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_paginaiton_Widget() );
		}

		if( isset( $rselements_addon_setting['rs_contact_cf7_settings'] ) == 'rs_contact_cf7' ) {
			require_once( __DIR__ . '/widgets/cf7/contact-cf7.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSCF7_Widget() );
		}

		if( isset( $rselements_addon_setting['rs_accordion_settings'] ) == 'rs_accordion_value' ) {
			require_once( __DIR__ . '/widgets/rs-accordion/rs-accordion.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Widget_Rs_Accordion_custom() );
		}
		if( isset( $rselements_addon_setting['rs_work_process_settings'] ) == 'rs_work_process_value' ) {
			require_once( __DIR__ . '/widgets/work-process/work-process.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSwork_Process_Widget() );	
		}

		if( isset( $rselements_addon_setting['rs_advanced_tab_settings'] ) == 'rs_advanced_tab_value' ) {
			require_once( __DIR__ . '/widgets/advanced-tab/tab.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Advance_Tab_Widget() );	
		}
		if( isset( $rselements_addon_setting['rs_project_information_settings'] ) == 'rs_project_information_settings' ) {
			require_once( __DIR__ . '/widgets/project-information/project-information.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Project_Information_Widget() );
		}
		if( isset( $rselements_addon_setting['rs_company_slogan_settings'] ) == 'rs_company_slogan_value' ) {
			require_once( __DIR__ . '/widgets/company-slogan/company-slogan.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Company_Slogan_Widget() );	
		}

		require_once( __DIR__ . '/widgets/marquee-slider-logo/marquee-slider.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Marquee_logo_text_Slider_Widget() );	

		require_once( __DIR__ . '/widgets/iconbox/rs-iconbox.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSIcon_Box_Widget() );	

		require_once( __DIR__ . '/widgets/image-widget/image.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Image_Showcase_Widget() );	

		require_once( __DIR__ . '/widgets/progress/rs-progress.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_progress_Widget() );

		require_once( __DIR__ . '/widgets/contact-box/contact-box.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RScontactbox_Grid_Widget() );
		
		require_once( __DIR__ . '/widgets/rs-award-widget/rs-award-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Award_Widget() );	
			
		require_once( __DIR__ . '/widgets/pie-chart/rs-chart.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_rs__chart_Widget() );

		require_once( __DIR__ . '/widgets/brochures/brochures.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Brochures_Widget() );


		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
	}
}
function rselement_addon()
{
	return Rsaddon_Elementor_Pro_Extension::init();
}

// kick-off the plugin
rselement_addon();
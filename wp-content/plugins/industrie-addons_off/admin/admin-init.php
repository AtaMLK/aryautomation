<?php
class RS_Elements_Addon_Control
{

    private $rselements_options;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'rselements_add_plugin_page'));
        add_action('admin_init', array($this, 'rselements_page_init'));
        add_action('admin_enqueue_scripts', array($this, 'rselements_admin_scripts'));
    }

    public function rselements_admin_scripts()
    {
        wp_register_style('rselements-admin-styles', RSADDON_DIR_URL_PRO . 'admin/assets/css/rselements-admin.css', array(), null);
        wp_enqueue_style('rselements-admin-styles');
    }


    public function rselements_add_plugin_page()
    {
        add_menu_page(
            'RS Elements Setting',
            'Industrie Addons',
            'manage_options',
            'rselements-addon-settings',
            array($this, 'rselements_create_admin_page'),
            'dashicons-xing',
            6
        );
    }

    /**
     *
     */
    public function rselements_create_admin_page()
    {
        $this->rselements_options = get_option('rselements_addon_option');


?>
        <div class="wrap">
            <form class="rselements-form" method="post" action="options.php">
                <?php
                settings_fields('rselements_addon_group');
                do_settings_sections('rselements-addon-field');
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }


    public function rselements_page_init()
    {

        /**
         * Sanitize callback
         */
        register_setting(
            'rselements_addon_group',
            'rselements_addon_option',
            array($this, 'rselements_sanitize')
        );

        add_settings_section(
            'rselements_post_type_section_field_id',
            esc_html__('Active Custom Post', 'rsaddon'),
            array($this, 'rselements_section_info'),
            'rselements-addon-field'
        );

        add_settings_section(
            'rselements_section_field_id',
            esc_html__('Deactivate elements for better performance', 'rsaddon'),
            array($this, 'rselements_section_info'),
            'rselements-addon-field'
        );

        /**
         * Team
         */
        add_settings_field(
            'rs_team_post',
            esc_html__('Teams', 'rsaddon'),
            array($this, 'rselements_team_setting'),
            'rselements-addon-field',
            'rselements_post_type_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Portfolio
         */
        add_settings_field(
            'rs_portfolio_post',
            esc_html__('Portfolio', 'rsaddon'),
            array($this, 'rselements_portfolio_setting'),
            'rselements-addon-field',
            'rselements_post_type_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Services
         */
        add_settings_field(
            'rs_service_post',
            esc_html__('Services', 'rsaddon'),
            array($this, 'rselements_services_setting'),
            'rselements-addon-field',
            'rselements_post_type_section_field_id',
            array('class' => 'rselements_addon_field')
        );


        /**
         * Heading addon control
         */
        add_settings_field(
            'rs_heading',
            esc_html__('RS Heading', 'rsaddon'),
            array($this, 'rselements_heading_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

       
        /**
         * Team Grid control
         */
        add_settings_field(
            'rs_team_gread',
            esc_html__('RS Team Grid', 'rsaddon'),
            array($this, 'rselements_team_gread_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
       
        /**
         * Full Width Slider control
         */
        add_settings_field(
            'rs_team_slider',
            esc_html__('RS Team Slider', 'rsaddon'),
            array($this, 'rselements_team_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Portfolio Grid
         */
        add_settings_field(
            'rs_portfolio_grid',
            esc_html__('RS Portfolio Grid', 'rsaddon'),
            array($this, 'rselements_portfolio_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Portfolio Filter
         */
        add_settings_field(
            'rs_portfolio_filter',
            esc_html__('RS Portfolio Filter', 'rsaddon'),
            array($this, 'rselements_portfolio_filter_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Portfolio Slider
         */
        add_settings_field(
            'rs_portfolio_slider',
            esc_html__('RS Portfolio Slider', 'rsaddon'),
            array($this, 'rselements_portfolio_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Counter
         */
        add_settings_field(
            'rs_counter',
            esc_html__('RS Counter', 'rsaddon'),
            array($this, 'rselements_counter_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
       
        /**
         * Services Grid
         */
        add_settings_field(
            'rs_service_grid',
            esc_html__('RS Services Grid', 'rsaddon'),
            array($this, 'rselements_service_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Services Slider
         */
        add_settings_field(
            'rs_service_slider',
            esc_html__('RS Services Slider', 'rsaddon'),
            array($this, 'rselements_service_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Services List
         */
        add_settings_field(
            'rs_service_list',
            esc_html__('RS Services List', 'rsaddon'),
            array($this, 'rselements_service_list_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Rain Line Animation
         */
        add_settings_field(
            'rs_line_rain_animation',
            esc_html__( 'RS Line Rain Animation', 'rsaddon' ),
            array( $this, 'rselements_line_rain_animation' ),
            'rselements-addon-field',
            'rselements_section_field_id',
            array( 'class' => 'rselements_addon_field' )
        );
        /**
         * Feature Image
         */
        add_settings_field(
            'rs_feature_img',
            esc_html__('RS Feature Image', 'rsaddon'),
            array($this, 'rselements_feature_img'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * GSAP marquee slide
         */
        add_settings_field(
            'rs_gsap_marquee_slide',
            esc_html__('RS GSAP Marquee Slide', 'rsaddon'),
            array($this, 'rs_gsap_marquee_slide_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Video
         */
        add_settings_field(
            'rs_video',
            esc_html__('RS Video', 'rsaddon'),
            array($this, 'rselements_video_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * RS hotspots showcase
         */
        add_settings_field(
            'rs_hotspots_showcase',
            esc_html__('RS Hotspot Showcase', 'rsaddon'),
            array($this, 'rs_hotspots_showcase_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Pricing Table
         */
        add_settings_field(
            'rs_pricing_table',
            esc_html__('RS Pricing Table', 'rsaddon'),
            array($this, 'rselements_pricing_table_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        
        /**
         * Pricing Switcher
         */
        add_settings_field(
            'rs_pricing_switcher',
            esc_html__('RS Pricing Switcher', 'rsaddon'),
            array($this, 'rselements_pricing_switcher_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Button
         */
        add_settings_field(
            'rs_button',
            esc_html__('RS Button', 'rsaddon'),
            array($this, 'rselements_button_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Logo Showcase
         */
        add_settings_field(
            'rs_logo_showcase',
            esc_html__('RS Logo Showcase', 'rsaddon'),
            array($this, 'rselements_logo_showcase_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
       
    
    
        /**
         * Breadcrumb
         */
        add_settings_field(
            'rs_breadcrumb',
            esc_html__('RS Breadcrumb', 'rsaddon'),
            array($this, 'rselements_breadcrumb_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
       
        /**
         * Newsletter
         */
        add_settings_field(
            'rs_newsletter',
            esc_html__('RS Newsletter', 'rsaddon'),
            array($this, 'rselements_newsletter_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );


        /**
         * Latest Blog Grid
         */
        add_settings_field(
            'rs_latest_blog_grid',
            esc_html__('RS Latest Blog Grid', 'rsaddon'),
            array($this, 'rselements_latest_blog_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Latest Blog Slider
         */
        add_settings_field(
            'rs_latest_blog_sliders',
            esc_html__('RS Latest Blog Slider', 'rsaddon'),
            array($this, 'rs_latest_blog_sliders_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Post Navigation
         */
        add_settings_field(
            'rs_post_navigation',
            esc_html__('RS Post Navigation', 'rsaddon'),
            array($this, 'rs_post_navigation_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );


        /**
         * RS Social Icon
         */
        add_settings_field(
            'rs_social_icon',
            esc_html__('RS Social Icon', 'rsaddon'),
            array($this, 'rs_social_icon_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );


         /**
         * RS Header offcanvas
         */
        add_settings_field(
            'rs_header_offcanvas',
            esc_html__('RS Header Offcanvas', 'rsaddon'),
            array($this, 'rs_header_offcanvas_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );


       //  RS Pagination

       add_settings_field(
            'rs_pagination',
            esc_html__('RS Pagination', 'rsaddon'),
            array($this, 'rs_pagination_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

       /**
        * Testimonial Slider
        */
       add_settings_field(
           'rs_monial_slider',
           esc_html__( 'RS Testimonial Slider', 'rsaddon' ),
           array( $this, 'rselements_testimonial_slider_setting' ),
           'rselements-addon-field',
           'rselements_section_field_id',
           array( 'class' => 'rselements_addon_field' )
       );

        // contact from 7

        add_settings_field(
            'rs_cf7_from',
            esc_html__('Contact Form 7', 'rsaddon'),
            array($this, 'rs_contact_cf7_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        
        // contact from 7

        add_settings_field(
            'rs_accordion',
            esc_html__('RS Accordion', 'rsaddon'),
            array($this, 'rs_accordion_func_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        // rs work process

        add_settings_field(
            'rs_work_process',
            esc_html__('RS Work Process', 'rsaddon'),
            array($this, 'rs_work_process_func_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        // rs company slogan

        add_settings_field(
            'rs_company_slogan',
            esc_html__('RS Company Slogan', 'rsaddon'),
            array($this, 'rs_company_slogan_func_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        // rs advanced tab

        add_settings_field(
            'rs_advanced_tab',
            esc_html__('RS Advance Tab', 'rsaddon'),
            array($this, 'rs_advanced_tab_func_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        // Project Information
        add_settings_field(
            'rs_project_information',
            esc_html__('RS Project Information', 'rsaddon'),
            array($this, 'rs_project_information_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        

        
        
    }

    /**
     * Sanitize all form
     */
    public function rselements_sanitize($input_addon)
    {
        $rs_addon_arg = array();

        // rs advanced tab


        if (isset($input_addon['rs_advanced_tab_settings'])) {
            $rs_addon_arg['rs_advanced_tab_settings'] = sanitize_text_field($input_addon['rs_advanced_tab_settings']);
        }

        // rs company slogan
        if (isset($input_addon['rs_company_slogan_settings'])) {
            $rs_addon_arg['rs_company_slogan_settings'] = sanitize_text_field($input_addon['rs_company_slogan_settings']);
        }
        // rs work process

        if (isset($input_addon['rs_work_process_settings'])) {
            $rs_addon_arg['rs_work_process_settings'] = sanitize_text_field($input_addon['rs_work_process_settings']);
        }
        // rs accordion

        if (isset($input_addon['rs_accordion_settings'])) {
            $rs_addon_arg['rs_accordion_settings'] = sanitize_text_field($input_addon['rs_accordion_settings']);
        }

        //Service Post
        if (isset($input_addon['rs_service_post'])) {
            $rs_addon_arg['rs_service_post'] = sanitize_text_field($input_addon['rs_service_post']);
        }

        // contact from 7
        
        if (isset($input_addon['rs_contact_cf7_settings'])) {
            $rs_addon_arg['rs_contact_cf7_settings'] = sanitize_text_field($input_addon['rs_contact_cf7_settings']);
        }

        // rs pagination

        if (isset($input_addon['rs_pagination_settings'])) {
            $rs_addon_arg['rs_pagination_settings'] = sanitize_text_field($input_addon['rs_pagination_settings']);
        }


        // rs Header Offcanvas
        if (isset($input_addon['rs_header_offcanvas_settings'])) {
            $rs_addon_arg['rs_header_offcanvas_settings'] = sanitize_text_field($input_addon['rs_header_offcanvas_settings']);
        }

        // rs social icon
        if (isset($input_addon['rs_social_icon_settings'])) {
            $rs_addon_arg['rs_social_icon_settings'] = sanitize_text_field($input_addon['rs_social_icon_settings']);
        }
        //Team
        if (isset($input_addon['rs_team_post'])) {
            $rs_addon_arg['rs_team_post'] = sanitize_text_field($input_addon['rs_team_post']);
        }
        // Rain Line Animation
        if( isset( $input_addon['rs_line_rain_animation_setting'] ) ){
            $rs_addon_arg['rs_line_rain_animation_setting'] = sanitize_text_field( $input_addon['rs_line_rain_animation_setting'] );
        }
        //Feature Image
        if (isset($input_addon['rs_feature_img_setting'])) {
            $rs_addon_arg['rs_feature_img_setting'] = sanitize_text_field($input_addon['rs_feature_img_setting']);
        }
        // Project Information
        if (isset($input_addon['rs_project_information_settings'])) {
            $rs_addon_arg['rs_project_information_settings'] = sanitize_text_field($input_addon['rs_project_information_settings']);
        }
        //Portfolio
        if (isset($input_addon['rs_portfolio_post'])) {
            $rs_addon_arg['rs_portfolio_post'] = sanitize_text_field($input_addon['rs_portfolio_post']);
        }
        //Heading
        if (isset($input_addon['rs_heading_setting'])) {
            $rs_addon_arg['rs_heading_setting'] = sanitize_text_field($input_addon['rs_heading_setting']);
        }
        //Team Grid
        if (isset($input_addon['rs_team_gread_setting'])) {
            $rs_addon_arg['rs_team_gread_setting'] = sanitize_text_field($input_addon['rs_team_gread_setting']);
        }
        // GSAP marquee slide
        if (isset($input_addon['rs_gsap_marquee_slide_settings'])) {
            $rs_addon_arg['rs_gsap_marquee_slide_settings'] = sanitize_text_field($input_addon['rs_gsap_marquee_slide_settings']);
        }
        //Team Slider
        if (isset($input_addon['rs_team_slider_setting'])) {
            $rs_addon_arg['rs_team_slider_setting'] = sanitize_text_field($input_addon['rs_team_slider_setting']);
        }
        //Portfolio Grid 
        if (isset($input_addon['rs_portfolio_grid_setting'])) {
            $rs_addon_arg['rs_portfolio_grid_setting'] = sanitize_text_field($input_addon['rs_portfolio_grid_setting']);
        }
        //Portfolio Filter 
        if (isset($input_addon['rs_portfolio_filter_setting'])) {
            $rs_addon_arg['rs_portfolio_filter_setting'] = sanitize_text_field($input_addon['rs_portfolio_filter_setting']);
        }
        //Portfolio Slider 
        if (isset($input_addon['rs_portfolio_slider_setting'])) {
            $rs_addon_arg['rs_portfolio_slider_setting'] = sanitize_text_field($input_addon['rs_portfolio_slider_setting']);
        }
        //Counter 
        if (isset($input_addon['rs_counter_setting'])) {
            $rs_addon_arg['rs_counter_setting'] = sanitize_text_field($input_addon['rs_counter_setting']);
        }
        //Services Grid 
        if (isset($input_addon['rs_service_grid_setting'])) {
            $rs_addon_arg['rs_service_grid_setting'] = sanitize_text_field($input_addon['rs_service_grid_setting']);
        }
        //Services Slider 
        if (isset($input_addon['rs_service_slider_setting'])) {
            $rs_addon_arg['rs_service_slider_setting'] = sanitize_text_field($input_addon['rs_service_slider_setting']);
        }
        //Services List 
        if (isset($input_addon['rs_service_list_setting'])) {
            $rs_addon_arg['rs_service_list_setting'] = sanitize_text_field($input_addon['rs_service_list_setting']);
        }
        //Video 
        if (isset($input_addon['rs_video_setting'])) {
            $rs_addon_arg['rs_video_setting'] = sanitize_text_field($input_addon['rs_video_setting']);
        }
        //Pricing Table 
        if (isset($input_addon['rs_pricing_table_setting'])) {
            $rs_addon_arg['rs_pricing_table_setting'] = sanitize_text_field($input_addon['rs_pricing_table_setting']);
        }
       
        //Pricing Switcher 
        if (isset($input_addon['rs_pricing_switcher_setting'])) {
            $rs_addon_arg['rs_pricing_switcher_setting'] = sanitize_text_field($input_addon['rs_pricing_switcher_setting']);
        }
        //Button
        if (isset($input_addon['rs_button_setting'])) {
            $rs_addon_arg['rs_button_setting'] = sanitize_text_field($input_addon['rs_button_setting']);
        }
        //Logo Showcase
        if (isset($input_addon['rs_logo_showcase_setting'])) {
            $rs_addon_arg['rs_logo_showcase_setting'] = sanitize_text_field($input_addon['rs_logo_showcase_setting']);
        }
       
        //Testimonial Slider 
        if( isset( $input_addon['rs_testimonial_slider_setting'] ) ){
            $rs_addon_arg['rs_testimonial_slider_setting'] = sanitize_text_field( $input_addon['rs_testimonial_slider_setting'] );
        }
       
        //Blog Grid
        if (isset($input_addon['rs_blog_grid_setting'])) {
            $rs_addon_arg['rs_blog_grid_setting'] = sanitize_text_field($input_addon['rs_blog_grid_setting']);
        }
        
      
        //Contact Box
        if (isset($input_addon['rs_contact_box_setting'])) {
            $rs_addon_arg['rs_contact_box_setting'] = sanitize_text_field($input_addon['rs_contact_box_setting']);
        }
      
        //FAQ
        if (isset($input_addon['rs_faq_setting'])) {
            $rs_addon_arg['rs_faq_setting'] = sanitize_text_field($input_addon['rs_faq_setting']);
        }
       
       
        //Image Hover Effect
        if (isset($input_addon['rs_image_hover_effect_setting'])) {
            $rs_addon_arg['rs_image_hover_effect_setting'] = sanitize_text_field($input_addon['rs_image_hover_effect_setting']);
        }
       
        //Breadcrumb
        if (isset($input_addon['rs_breadcrumb_setting'])) {
            $rs_addon_arg['rs_breadcrumb_setting'] = sanitize_text_field($input_addon['rs_breadcrumb_setting']);
        }
       
        //Newsletter
        if (isset($input_addon['rs_newsletter_setting'])) {
            $rs_addon_arg['rs_newsletter_setting'] = sanitize_text_field($input_addon['rs_newsletter_setting']);
        }
        // rs hotspots settings
        if (isset($input_addon['rs_hotspots_showcase_settings'])) {
            $rs_addon_arg['rs_hotspots_showcase_settings'] = sanitize_text_field($input_addon['rs_hotspots_showcase_settings']);
        }
        //Latest Blog Grid
        if (isset($input_addon['rs_latest_blog_grid_setting'])) {
            $rs_addon_arg['rs_latest_blog_grid_setting'] = sanitize_text_field($input_addon['rs_latest_blog_grid_setting']);
        }

        //Latest Blog Slider
        if (isset($input_addon['rs_latest_blog_slider_setting'])) {
            $rs_addon_arg['rs_latest_blog_slider_setting'] = sanitize_text_field($input_addon['rs_latest_blog_slider_setting']);
        }

        //Post Navigation
        if (isset($input_addon['rs_post_navigation_setting'])) {
            $rs_addon_arg['rs_post_navigation_setting'] = sanitize_text_field($input_addon['rs_post_navigation_setting']);
        }



        return $rs_addon_arg;
    }

    /**
     * Print the Section text
     */
    public function rselements_section_info()
    {
        //print 'Enter your settings below:';
    }

    // rs advanced tab

    public function rs_advanced_tab_func_settings () {
        ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_advanced_tab_settings]" id="rs_advanced_tab_settings" value="rs_advanced_tab_value" %s/>',
                (isset($this->rselements_options['rs_advanced_tab_settings']) && $this->rselements_options['rs_advanced_tab_settings']) == 'rs_advanced_tab_value' ? 'checked' : ''
            );
            ?>
            <label for="rs_advanced_tab_settings"></label>
        </div>
    <?php
    }

    // rs company slogan
    public function rs_company_slogan_func_settings () {
        ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_company_slogan_settings]" id="rs_company_slogan_settings" value="rs_company_slogan_value" %s/>',
                (isset($this->rselements_options['rs_company_slogan_settings']) && $this->rselements_options['rs_company_slogan_settings']) == 'rs_company_slogan_value' ? 'checked' : ''
            );
            ?>
            <label for="rs_company_slogan_settings"></label>
        </div>
    <?php
    }


    // rs work process function

    public function rs_work_process_func_settings () {
        ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_work_process_settings]" id="rs_work_process_settings" value="rs_work_process_value" %s/>',
                (isset($this->rselements_options['rs_work_process_settings']) && $this->rselements_options['rs_work_process_settings']) == 'rs_work_process_value' ? 'checked' : ''
            );
            ?>
            <label for="rs_work_process_settings"></label>
        </div>
    <?php
    }
    
    public function rs_accordion_func_settings () {
        ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_accordion_settings]" id="rs_accordion_settings" value="rs_accordion_value" %s/>',
                (isset($this->rselements_options['rs_accordion_settings']) && $this->rselements_options['rs_accordion_settings']) == 'rs_accordion_value' ? 'checked' : ''
            );
            ?>
            <label for="rs_accordion_settings"></label>
        </div>
    <?php
    }
    
    public function rs_contact_cf7_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_contact_cf7_settings]" id="rs_contact_cf7_settings" value="rs_contact_cf7" %s/>',
                (isset($this->rselements_options['rs_contact_cf7_settings']) && $this->rselements_options['rs_contact_cf7_settings']) == 'rs_contact_cf7' ? 'checked' : ''
            );
            ?>
            <label for="rs_contact_cf7_settings"></label>
        </div>
    <?php
    }


    // rs pagination

    public function rs_pagination_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_pagination_settings]" id="rs_pagination_settings" value="rs_pagination" %s/>',
                (isset($this->rselements_options['rs_pagination_settings']) && $this->rselements_options['rs_pagination_settings']) == 'rs_pagination' ? 'checked' : ''
            );
            ?>
            <label for="rs_pagination_settings"></label>
        </div>
    <?php
    }

    /**
     * Rain Line Animation
     */
    public function rselements_line_rain_animation() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rselements_addon_option[rs_line_rain_animation_setting]" id="rs_line_rain_animation_setting" value="rselement_line_rain_animation" %s/>',
                (isset( $this->rselements_options['rs_line_rain_animation_setting']) && $this->rselements_options['rs_line_rain_animation_setting'] ) == 'rselement_line_rain_animation' ? 'checked' : ''
            );
            ?>
            <label for="rs_line_rain_animation_setting"></label>
        </div>
        <?php
    }

    // Project Information
    public function rs_project_information_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_project_information_settings]" id="rs_project_information_settings" value="rs_project_information" %s/>',
                (isset($this->rselements_options['rs_project_information_settings']) && $this->rselements_options['rs_project_information_settings']) == 'rs_project_information' ? 'checked' : ''
            );
            ?>
            <label for="rs_project_information_settings"></label>
        </div>
    <?php
    }

    /**
     * Feature Image
     */
    public function rselements_feature_img() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rselements_addon_option[rs_feature_img_setting]" id="rs_feature_img_setting" value="rselement_feature_img" %s/>',
                (isset( $this->rselements_options['rs_feature_img_setting']) && $this->rselements_options['rs_feature_img_setting'] ) == 'rselement_feature_img' ? 'checked' : ''
            );
            ?>
            <label for="rs_feature_img_setting"></label>
        </div>
        <?php
    }

    /**
     * GSAP marquee slide
     */
    public function rs_gsap_marquee_slide_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_gsap_marquee_slide_settings]" id="rs_gsap_marquee_slide_settings" value="rs_gsap_marquee_slide" %s/>',
                (isset($this->rselements_options['rs_gsap_marquee_slide_settings']) && $this->rselements_options['rs_gsap_marquee_slide_settings']) == 'rs_gsap_marquee_slide' ? 'checked' : ''
            );
            ?>
            <label for="rs_gsap_marquee_slide_settings"></label>
        </div>
    <?php
    }

    /**
     * rs header offcanvas settings
     */
    public function rs_header_offcanvas_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_header_offcanvas_settings]" id="rs_header_offcanvas_settings" value="rs_header_offcanvas" %s/>',
                (isset($this->rselements_options['rs_header_offcanvas_settings']) && $this->rselements_options['rs_header_offcanvas_settings']) == 'rs_header_offcanvas' ? 'checked' : ''
            );
            ?>
            <label for="rs_header_offcanvas_settings"></label>
        </div>
    <?php
    }

    /**
     * rs hotspots settings
     */
    public function rs_hotspots_showcase_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_hotspots_showcase_settings]" id="rs_hotspots_showcase_settings" value="rs_hotspots_showcase" %s/>',
                (isset($this->rselements_options['rs_hotspots_showcase_settings']) && $this->rselements_options['rs_hotspots_showcase_settings']) == 'rs_hotspots_showcase' ? 'checked' : ''
            );
            ?>
            <label for="rs_hotspots_showcase_settings"></label>
        </div>
    <?php
    }

    /**
     * rs social settings
     */
    public function rs_social_icon_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_social_icon_settings]" id="rs_social_icon_settings" value="rs_social_icon" %s/>',
                (isset($this->rselements_options['rs_social_icon_settings']) && $this->rselements_options['rs_social_icon_settings']) == 'rs_social_icon' ? 'checked' : ''
            );
            ?>
            <label for="rs_social_icon_settings"></label>
        </div>
    <?php
    }

    /**
     * services tab
     */
    public function rs_services_filter_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_services_filter_settings]" id="rs_services_filter_settings" value="rs_services_filter" %s/>',
                (isset($this->rselements_options['rs_services_filter_settings']) && $this->rselements_options['rs_services_filter_settings']) == 'rs_services_filter' ? 'checked' : ''
            );
            ?>
            <label for="rs_services_filter_settings"></label>
        </div>
    <?php
    }


    /**
     * Team
     */
    public function rselements_team_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_team_post]" id="rs_team_post" value="rs_team_post" %s/>',
                (isset($this->rselements_options['rs_team_post']) && $this->rselements_options['rs_team_post']) == 'rs_team_post' ? 'checked' : ''
            );
            ?>
            <label for="rs_team_post"></label>
        </div>
    <?php
    }

    /**
     * Portfolio
     */
    public function rselements_portfolio_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_post]" id="rs_portfolio_post" value="rs_portfolio_post" %s/>',
                (isset($this->rselements_options['rs_portfolio_post']) && $this->rselements_options['rs_portfolio_post']) == 'rs_portfolio_post' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_post"></label>
        </div>
    <?php
    }



    /**
     * Heading field
     */
    public function rselements_heading_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_heading_setting]" id="rs_heading_setting" value="rselement_heading" %s/>',
                (isset($this->rselements_options['rs_heading_setting']) && $this->rselements_options['rs_heading_setting']) == 'rselement_heading' ? 'checked' : ''
            );
            ?>
            <label for="rs_heading_setting"></label>
        </div>
    <?php
    }

   

    /**
     * Team Grid
     */
    public function rselements_team_gread_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_team_gread_setting]" id="rs_team_gread_setting" value="rselement_team_gread" %s/>',
                (isset($this->rselements_options['rs_team_gread_setting']) && $this->rselements_options['rs_team_gread_setting']) == 'rselement_team_gread' ? 'checked' : ''
            );
            ?>
            <label for="rs_team_gread_setting"></label>
        </div>
    <?php
    }

    /**
     * Services
     */
    public function rselements_services_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_service_post]" id="rs_service_post" value="rs_service_post" %s/>',
                (isset($this->rselements_options['rs_service_post']) && $this->rselements_options['rs_service_post']) == 'rs_service_post' ? 'checked' : ''
            );
            ?>
            <label for="rs_service_post"></label>
        </div>
    <?php
    }


    /**
     * Team Slider
     */
    public function rselements_team_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_team_slider_setting]" id="rs_team_slider_setting" value="rselement_team_slider" %s/>',
                (isset($this->rselements_options['rs_team_slider_setting']) && $this->rselements_options['rs_team_slider_setting']) == 'rselement_team_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_team_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Portfolio Grid
     */
    public function rselements_portfolio_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_grid_setting]" id="rs_portfolio_grid_setting" value="rselement_portfolio_grid" %s/>',
                (isset($this->rselements_options['rs_portfolio_grid_setting']) && $this->rselements_options['rs_portfolio_grid_setting']) == 'rselement_portfolio_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Portfolio Filter
     */
    public function rselements_portfolio_filter_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_filter_setting]" id="rs_portfolio_filter_setting" value="rselement_portfolio_filter" %s/>',
                (isset($this->rselements_options['rs_portfolio_filter_setting']) && $this->rselements_options['rs_portfolio_filter_setting']) == 'rselement_portfolio_filter' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_filter_setting"></label>
        </div>
    <?php
    }

    /**
     * Portfolio Slider
     */
    public function rselements_portfolio_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_slider_setting]" id="rs_portfolio_slider_setting" value="rselement_portfolio_slider" %s/>',
                (isset($this->rselements_options['rs_portfolio_slider_setting']) && $this->rselements_options['rs_portfolio_slider_setting']) == 'rselement_portfolio_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Counter
     */
    public function rselements_counter_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_counter_setting]" id="rs_counter_setting" value="rselement_counter" %s/>',
                (isset($this->rselements_options['rs_counter_setting']) && $this->rselements_options['rs_counter_setting']) == 'rselement_counter' ? 'checked' : ''
            );
            ?>
            <label for="rs_counter_setting"></label>
        </div>
    <?php
    }


    /**
     * Services Grid
     */
    public function rselements_service_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_service_grid_setting]" id="rs_service_grid_setting" value="rselement_service_grid" %s/>',
                (isset($this->rselements_options['rs_service_grid_setting']) && $this->rselements_options['rs_service_grid_setting']) == 'rselement_service_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_service_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Services Slider
     */
    public function rselements_service_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_service_slider_setting]" id="rs_service_slider_setting" value="rselement_service_slider" %s/>',
                (isset($this->rselements_options['rs_service_slider_setting']) && $this->rselements_options['rs_service_slider_setting']) == 'rselement_service_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_service_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Services List
     */
    public function rselements_service_list_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_service_list_setting]" id="rs_service_list_setting" value="rselement_service_list" %s/>',
                (isset($this->rselements_options['rs_service_list_setting']) && $this->rselements_options['rs_service_list_setting']) == 'rselement_service_list' ? 'checked' : ''
            );
            ?>
            <label for="rs_service_list_setting"></label>
        </div>
    <?php
    }

    /**
     * Video
     */
    public function rselements_video_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_video_setting]" id="rs_video_setting" value="rselement_video" %s/>',
                (isset($this->rselements_options['rs_video_setting']) && $this->rselements_options['rs_video_setting']) == 'rselement_video' ? 'checked' : ''
            );
            ?>
            <label for="rs_video_setting"></label>
        </div>
    <?php
    }

    /**
     * Pricing Table
     */
    public function rselements_pricing_table_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_pricing_table_setting]" id="rs_pricing_table_setting" value="rselement_pricing_table" %s/>',
                (isset($this->rselements_options['rs_pricing_table_setting']) && $this->rselements_options['rs_pricing_table_setting']) == 'rselement_pricing_table' ? 'checked' : ''
            );
            ?>
            <label for="rs_pricing_table_setting"></label>
        </div>
    <?php
    }


    /**
     * Pricing Switcher
     */
    public function rselements_pricing_switcher_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_pricing_switcher_setting]" id="rs_pricing_switcher_setting" value="rselement_pricing_switcher" %s/>',
                (isset($this->rselements_options['rs_pricing_switcher_setting']) && $this->rselements_options['rs_pricing_switcher_setting']) == 'rselement_pricing_switcher' ? 'checked' : ''
            );
            ?>
            <label for="rs_pricing_switcher_setting"></label>
        </div>
    <?php
    }

    /**
     * Button
     */
    public function rselements_button_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_button_setting]" id="rs_button_setting" value="rselement_button" %s/>',
                (isset($this->rselements_options['rs_button_setting']) && $this->rselements_options['rs_button_setting']) == 'rselement_button' ? 'checked' : ''
            );
            ?>
            <label for="rs_button_setting"></label>
        </div>
    <?php
    }

    /**
     * Logo Showcase
     */
    public function rselements_logo_showcase_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_logo_showcase_setting]" id="rs_logo_showcase_setting" value="rselement_logo_showcase" %s/>',
                (isset($this->rselements_options['rs_logo_showcase_setting']) && $this->rselements_options['rs_logo_showcase_setting']) == 'rselement_logo_showcase' ? 'checked' : ''
            );
            ?>
            <label for="rs_logo_showcase_setting"></label>
        </div>
    <?php
    }


    /**
     * Breadcrumb
     */
    public function rselements_breadcrumb_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_breadcrumb_setting]" id="rs_breadcrumb_setting" value="rselement_breadcrumb" %s/>',
                (isset($this->rselements_options['rs_breadcrumb_setting']) && $this->rselements_options['rs_breadcrumb_setting']) == 'rselement_breadcrumb' ? 'checked' : ''
            );
            ?>
            <label for="rs_breadcrumb_setting"></label>
        </div>
    <?php
    }


    /**
     * Newsletter
     */
    public function rselements_newsletter_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_newsletter_setting]" id="rs_newsletter_setting" value="rselement_newsletter" %s/>',
                (isset($this->rselements_options['rs_newsletter_setting']) && $this->rselements_options['rs_newsletter_setting']) == 'rselement_newsletter' ? 'checked' : ''
            );
            ?>
            <label for="rs_newsletter_setting"></label>
        </div>
    <?php
    }

    /**
     * Testimonial Slider
     */
    public function rselements_testimonial_slider_setting() {
        ?>
        <div class="checkbox">
            <?php
            printf('<input type="checkbox" name="rselements_addon_option[rs_testimonial_slider_setting]" id="rs_testimonial_slider_setting" value="rselement_testimonial_slider" %s/>',
                (isset( $this->rselements_options['rs_testimonial_slider_setting']) && $this->rselements_options['rs_testimonial_slider_setting'] ) == 'rselement_testimonial_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_testimonial_slider_setting"></label>
        </div>
        <?php
    }

    /**
     * Latest Blog Grid
     */
    public function rselements_latest_blog_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php

            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_latest_blog_grid_setting]" id="rs_latest_blog_grid_setting" value="rselement_latest_blog_grid" %s/>',
                (isset($this->rselements_options['rs_latest_blog_grid_setting']) && $this->rselements_options['rs_latest_blog_grid_setting']) == 'rselement_latest_blog_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_latest_blog_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Latest Blog Slider
     */
    public function rs_latest_blog_sliders_setting()
    {
    ?>
        <div class="checkbox">
            <?php

            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_latest_blog_slider_setting]" id="rs_latest_blog_slider_setting" value="rselement_latest_blog_slider" %s/>',
                (isset($this->rselements_options['rs_latest_blog_slider_setting']) && $this->rselements_options['rs_latest_blog_slider_setting']) == 'rselement_latest_blog_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_latest_blog_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Post Navigation
     */
    public function rs_post_navigation_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_post_navigation_setting]" id="rs_post_navigation_setting" value="rselement_post_navigation" %s/>',
                (isset($this->rselements_options['rs_post_navigation_setting']) && $this->rselements_options['rs_post_navigation_setting']) == 'rselement_post_navigation' ? 'checked' : ''
            );
            ?>
            <label for="rs_post_navigation_setting"></label>
        </div>
    <?php
    }

}

if (is_admin())
    new RS_Elements_Addon_Control();

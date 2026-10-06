<?php
/**
 * Logo widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;



defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Logo_Showcase_Widget extends \Elementor\Widget_Base {
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
        return 'rs-logo';
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
        return esc_html__( 'RS Logo Showcase', 'rsaddon' );
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
        return 'rs-badge';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Logo Setting', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'rs_logo_style',
            [
                'label'   => esc_html__( 'Layout Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [                  
                    'style1' => esc_html__( 'Style 1', 'rsaddon'),
                    'style2' => esc_html__( 'Style 2', 'rsaddon'),
                    'style3' => esc_html__( 'Style 3', 'rsaddon'),
                ],
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Select Grid/Slider', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'grid' => esc_html__( 'Grid', 'rsaddon' ),
                    'slider' => esc_html__( 'Slider', 'rsaddon' ),
                   
                ],
                'default' => 'slider',            
            ]
        );
        $this->add_control(
            'logo_grid_style',
            [
                'label'   => esc_html__( 'Select Grid Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [                  
                    'style1' => esc_html__( 'Style 1', 'rsaddon'),                   
                    'style2' => esc_html__( 'Style 2', 'rsaddon'),                 
                ],
                'condition' => [
                    'layout' => 'grid'
                ],
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'rs_logo_image',
            [
                'label'   => esc_html__( 'Logo Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [                  
                    'style1' => esc_html__( 'Style 1', 'rsaddon'),
                    'style2' => esc_html__( 'Style 2', 'rsaddon'),
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Logo', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'image2',
            [
                'label' => esc_html__('Hover Logo', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => ['rs_logo_image' => 'style2']
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,
                'default' => [
					'url' => '',
				],
            ]
        ); 

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Brand Name', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'rsaddon' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Brand Description', 'rsaddon'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'rsaddon' ),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );
        
        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rsaddon' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'text-align: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
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
				'default' => 'flex',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'display: {{VALUE}};',
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
				'default' => 'flex-start',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'align-items: {{VALUE}};',
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
				'default' => 'flex-start',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'flex_box_col_dir',
            [
                'label' => esc_html__( 'Column Direction', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Row', 'rsaddon' ),
                        'icon' => 'eicon-justify-end-h',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Column', 'rsaddon' ),
                        'icon' => 'eicon-justify-end-v',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-v',
                    ],
                ],
                'toggle' => true,
                'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
			'clip_path',
			[
				'label' => esc_html__( 'Clip Path ON/OFF?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'condition' => ['rs_logo_style' => 'style1']
			]
		);

        $this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Title', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__('H1', 'rsaddon'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__('H2', 'rsaddon'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__('H3', 'rsaddon'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__('H4', 'rsaddon'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__('H5', 'rsaddon'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__('H6', 'rsaddon'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_control(
			'show_desc',
			[
				'label' => esc_html__( 'Show Description', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__( 'Grid Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => 'grid'
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 4,
                'options' => [
                    6 => esc_html__( '2 Columns', 'rsaddon' ),
                    4 => esc_html__( '3 Columns', 'rsaddon' ),
                    3 => esc_html__( '4 Columns', 'rsaddon' ),
                    2 => esc_html__( '6 Columns', 'rsaddon' ),
                    12 => esc_html__( '1 Columns', 'rsaddon' ),
                ],                           
            ]
        );
        $this->add_control(
            'grid_columns_md',
            [
                'label' => esc_html__( 'Columns (Medium Device)', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    6 => esc_html__( '2 Columns', 'rsaddon' ),
                    4 => esc_html__( '3 Columns', 'rsaddon' ),
                    3 => esc_html__( '4 Columns', 'rsaddon' ),
                    2 => esc_html__( '6 Columns', 'rsaddon' ),
                    12 => esc_html__( '1 Columns', 'rsaddon' ),
                ],                           
            ]
        );
        $this->add_control(
            'grid_columns_sm',
            [
                'label' => esc_html__( 'Columns (Small Device)', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 4,
                'options' => [
                    6 => esc_html__( '2 Columns', 'rsaddon' ),
                    4 => esc_html__( '3 Columns', 'rsaddon' ),
                    3 => esc_html__( '4 Columns', 'rsaddon' ),
                    2 => esc_html__( '6 Columns', 'rsaddon' ),
                    12 => esc_html__( '1 Columns', 'rsaddon' ),
                ],                           
            ]
        );
        $this->add_control(
            'grid_columns_xs',
            [
                'label' => esc_html__( 'Columns (Mobile Device)', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 6,
                'options' => [
                    6 => esc_html__( '2 Columns', 'rsaddon' ),
                    4 => esc_html__( '3 Columns', 'rsaddon' ),
                    3 => esc_html__( '4 Columns', 'rsaddon' ),
                    2 => esc_html__( '6 Columns', 'rsaddon' ),
                    12 => esc_html__( '1 Columns', 'rsaddon' ),
                ],                           
            ]
        );

        $this->add_responsive_control(
            'columns-gap',
            [
                'label' => esc_html__( 'Columns Gap', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'rsaddon' ),
                    'no-padding' => esc_html__( 'No Gap', 'rsaddon' ),                   
                ],                           
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => 'slider'
                ],
            ]
        );

    
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 768px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'rsaddon' ),
                    '2' => esc_html__( '2 Item', 'rsaddon' ),
                    '3' => esc_html__( '3 Item', 'rsaddon' ),
                    '4' => esc_html__( '4 Item', 'rsaddon' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );      

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'rsaddon' ),
                    '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                    '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                    '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                    '1000' => esc_html__( '1 Seconds', 'rsaddon' ),     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Loop', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_responsive_control(
            'item_gap_left',
            [
                'label' => esc_html__( 'Item Gap Left', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          

                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .grid-item .rs-grid-figure' => 'margin-left: {{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 

        $this->add_responsive_control(
            'item_gap_right',
            [
                'label' => esc_html__( 'Item Gap Left', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          

                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .grid-item .rs-grid-figure' => 'margin-right: {{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 
                
        $this->end_controls_section();

   
        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => esc_html__( 'Item', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'grid_border',
                'selector' => '{{WRAPPER}} .rs-grid-figure',
            ]
        );
        
        $this->add_control(
            'grid_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'grid_bg_hover_color',
            [
                'label' => esc_html__( 'Background Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['rs_logo_style' => 'style3']
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'selector' => '{{WRAPPER}} .rs-grid-figure',
            ]
        ); 

        $this->add_responsive_control(
			'logo_item_widt',
			[
				'label' => esc_html__('Box Width', 'prelements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-grid-figure' => 'width: {{SIZE}}{{UNIT}};',
				],

			]
		);

        $this->add_responsive_control(
			'logo_item_height',
			[
				'label' => esc_html__('Box Height', 'prelements'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-grid-figure' => 'height: {{SIZE}}{{UNIT}};',
				],

			]
		);

        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rsl_logo_style2 .rs-grid-figure .left-bottom-shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider.rsl_logo_style2 .rs-grid-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'shape_bg_color',
            [
                'label' => esc_html__( 'Shape Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rsl_logo_style2 .rs-grid-figure:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider.rsl_logo_style2 .rs-grid-figure:after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider.rsl_logo_style2 .rs-grid-figure .left-bottom-shape' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['rs_logo_style' => 'style2']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style_title',
            [
                'label' => esc_html__( 'Title Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .rs-addon-slider .grid-item .logo-title .title',
                ]
            );
            $this->add_control(
                'title_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .grid-item .logo-title .title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .grid-item .logo-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style_desc',
            [
                'label' => esc_html__( 'Description Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'selector' => '{{WRAPPER}} .rs-addon-slider .grid-item .logo-desc .description',
                ]
            );
            $this->add_control(
                'desc_text_color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .grid-item .logo-desc .description' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'desc_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-addon-slider .grid-item .logo-desc .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Slider Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'slider'
                ],

            ]
        );
      
        $this->add_control(
            'arrow_options',
            [
                'label' => esc_html__( 'Arrow Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-next' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev::before' => 'color: {{VALUE}};',

                ],                
            ]
        );

         $this->add_control(
            'bullet_options',
            [
                'label' => esc_html__( 'Bullet Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'background: {{VALUE}};',

                ],                
            ]
        );
          $this->add_control(
            'bullet_spacing_custom',
            [
                'label' => esc_html__( 'Top Gap', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 25,
                ],          

                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin-bottom:-{{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 

        

        $this->end_controls_section();

        $this->start_controls_section(
            '_logo_image_style_grid',
            [
                'label' => esc_html__( 'Image Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'logo_image_width',
            [
                'label' => esc_html__( 'Logo Image Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure .rs-grid-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $logo_style = $settings['logo_grid_style'];


        $slidesToShow    = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $interval        = $settings['slider_interval'];
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        $clip_path       = $settings['clip_path'];
        $rs_logo_style       = $settings['rs_logo_style'];

        $clip_path_css = '';
        if($clip_path == 'yes') {
            $clip_path_css = 'clip-path-enable';
        }
        
        if ( is_rtl() ):
           $rtl= 'true';
        else:
           $rtl= 'false';
        endif;

        $unique = rand(2012,351202);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');   

        if ( empty($settings['logo_list'] ) ) {
            return;
        }
        ?>

        <?php

            /*----------grid style-------
            -----------------------------*/

            if ($logo_style == 'style1') {
                include plugin_dir_path(__FILE__) . "/style1.php";
            } else {
                include plugin_dir_path(__FILE__) . "/style2.php";
            ?>

            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    jQuery( '.rs-addon-slider-<?php echo $unique;?>' ).each(function( index ) {        
                    var slider_id       = jQuery(this).attr('id'); 
                    var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
                   
                    if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
                    jQuery('#'+slider_id).not('.slick-initialized').slick({
                    slidesToShow    : parseInt(slider_conf.col_lg),
                    centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
                    dots            : (slider_conf.sliderDots)  == "true" ? true : false,
                    arrows          : (slider_conf.sliderNav) == "true" ? true : false,
                    autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
                    slidesToScroll  : parseInt(slider_conf.slidesToScroll),
                    centerPadding   : '15px',
                    autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
                    pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
                    loop : false,
                    rtl: <?php echo $rtl; ?>,
                    responsive: [
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: parseInt(slider_conf.col_md),
                            }
                        }, 
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: parseInt(slider_conf.col_sm),
                            }
                        }, 
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                slidesToShow: parseInt(slider_conf.col_xs),
                            }
                        },
                    ]
                    });
                }
               
                });
            });
            </script>
        <?php }

    }
}
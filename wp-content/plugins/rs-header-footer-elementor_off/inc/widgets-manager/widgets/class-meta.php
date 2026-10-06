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

class rs_meta extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hfe-meta';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RS Meta', 'rs-header-footer-elementor' );
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
		$this->register_general_content_controls();
		$this->register_search_style_controls();
	}
	/**
	 * Register Search General Controls.
	 */
	protected function register_general_content_controls() {
		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Meta Settings', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
            'author_show',
            [
				'label'        => esc_html__( 'Author Show / Hide', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );

		$this->add_control(
            'date_show',
            [
				'label'        => esc_html__( 'Date Show / Hide', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );

        $this->add_control(
            'cate_show',
            [
				'label'        => esc_html__( 'Category Show / Hide', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );

        $this->add_control(
            'comm_show',
            [
				'label'        => esc_html__( 'Comments Show / Hide', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );

		$this->end_controls_section();
	}
	/**
	 * Register Search Style Controls.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function register_search_style_controls() {
		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __( 'Meta Settings', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-breadcrumbs-meta-elementor, {{WRAPPER}} .rs-breadcrumbs-meta-elementor li.rs-category ul li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'meta_sep_color',
			[
				'label' => esc_html__('Separator Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-breadcrumbs-meta-elementor li:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-breadcrumbs-meta-elementor, {{WRAPPER}} .rs-breadcrumbs-meta-elementor li.rs-category ul li a',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
		    'align_meta',
		    [
		        'label' => esc_html__( 'Alignment', 'prelements' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'left' => [
		                'title' => esc_html__( 'Left', 'prelements' ),
		                'icon' => 'eicon-text-align-left',
		            ],
		            'center' => [
		                'title' => esc_html__( 'Center', 'prelements' ),
		                'icon' => 'eicon-text-align-center',
		            ],
		            'right' => [
		                'title' => esc_html__( 'Right', 'prelements' ),
		                'icon' => 'eicon-text-align-right',
		            ],
		            'justify' => [
		                'title' => esc_html__( 'Justify', 'prelements' ),
		                'icon' => 'eicon-text-align-justify',
		            ],
		        ],
		        'toggle' => true,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
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
		$post_id        = get_the_id();
		$author_id      = get_post_field ('post_author', $post_id);
		$display_name   = get_the_author_meta( 'display_name' , $author_id );

		?>
	    <ul class="rs-breadcrumbs-meta-elementor">
	    	<?php if(($settings['author_show'] == 'yes') ){ ?>
	    	<?php if(!empty($display_name)){ ?>
		    	<li class="rs_author">
		    		<span class="name">
		    		    <i class="ri-user-3-line"></i>
		    		    <?php 
		    		        echo esc_html($display_name);
		    		    ?>
		    		</span> 
		    	</li>
		    <?php }} ?>

		    <?php if(($settings['date_show'] == 'yes') ){  
	    	$post_date = get_the_date(); 
	    	if(!empty($post_date)){
	    	?>
		    	<li class="rs_date">
		    		<span>
		    		    <i class="ri-calendar-line"></i>
		    		    <?php echo esc_attr($post_date);?>
		    		</span>
		    	</li>
	    	<?php } } ?>

	    	<?php if(($settings['cate_show'] == 'yes') ){ ?>
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
		    <?php } } ?>

		    <?php if(($settings['comm_show'] == 'yes') ){ ?>
		    	<li class="rs_comments">
		    		<span>
		    		    <i class="ri-chat-4-line"></i>
		    		    <?php echo get_comments_number( '0', '1', '%' ); ?>
		    		</span>
		    	</li>
		    <?php } ?>
	    </ul>      
		<?php
	}
}

<?php

/**
 * Elementor Chart Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_rs__chart_Widget extends \Elementor\Widget_Base
{

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
	public function get_name()
	{
		return 'rs-chart';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('RS Pie Chart', 'rsaddon');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve pie widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'rs-badge';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['rsaddon_category'];
	}

	/**
	 * Register pie widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls(){

		$this->start_controls_section(
			'pie_content_section',
			[
				'label' => esc_html__('Pie Chart Settings', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'separator'   => 'before',
                'default' => 'Name'
            ]
        );

		$repeater->add_control(
		    'color',
		    [
		        'label' => esc_html__('Color', 'rsaddon'),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ea5501',
		        'selectors' => [
		            '{{CURRENT_ITEM}} .rs-pie-slice' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$repeater->add_control(
		    'percentage',
		    [
		        'label' => esc_html__('Percentage', 'rsaddon'),
		        'type' => Controls_Manager::TEXT,
		        'default' => '16',
		        'separator'   => 'before',
		    ]
		);

		$this->add_control(
		    'pie_list',
		    [
		        'show_label' => false,
		        'type' => Controls_Manager::REPEATER,
		        'fields' => $repeater->get_controls(),
		        'title_field' => '{{{ name }}}',
		        'default' => [
		            ['name' => 'Sciences & Healthcare', 'color' => '#0D80CE', 'percentage' => '16'],
		            ['name' => 'Power Generation', 'color' => '#5CC8BE', 'percentage' => '36'],
		            ['name' => 'Retail & Consumer', 'color' => '#3B37FD', 'percentage' => '46'],
		            ['name' => 'Industrial & Chemical', 'color' => '#EE0D08', 'percentage' => '56'],
		            ['name' => 'Oil & Gas Energy', 'color' => '#EA5501', 'percentage' => '76']
		        ]
		    ]
		);


		$this->add_control(
		    'pie_position',
		    [
		        'label'   => esc_html__( 'Chart Color Position', 'rsaddon' ),
		        'type'    => Controls_Manager::SELECT,
		        'default' => 'left',
		        'options' => [                  
		            'left' => esc_html__( 'Left', 'rsaddon'),
		            'right' => esc_html__( 'Right', 'rsaddon'),
		            'top' => esc_html__( 'Top', 'rsaddon'),
		            'bottom' => esc_html__( 'Bottom', 'rsaddon'),
		        ],
		    ]
		);

		$this->add_control(
		    'pie_type',
		    [
		        'label'   => esc_html__( 'Chart Type', 'rsaddon' ),
		        'type'    => Controls_Manager::SELECT,
		        'default' => 'pie',
		        'options' => [                  
		            'pie' => esc_html__( 'Pie', 'rsaddon'),
		            'line' => esc_html__( 'Line', 'rsaddon'),
		            'doughnut' => esc_html__( 'Doughnut', 'rsaddon'),
		        ],
		    ]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Pie widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render(){
		$settings = $this->get_settings_for_display();
		$unique = rand(2012,351202);
		$labels = [];
		$data = [];
		$colors = [];
		$position = $settings['pie_position'];
		$pie_type = $settings['pie_type'];

		foreach ($settings['pie_list'] as $item) {
		   $labels[] = $item['name'];
		   $data[] = $item['percentage']; // Replace with your actual data
		   $colors[] = $item['color'];		    
		}
		
	?>
		<div class="rs-pie-widget">
		    <div class="rs-pie-widget-inner">
		        <canvas id="pie-chart-<?php echo esc_attr($unique); ?>" style="height: auto !important;"></canvas>
		    </div>
		</div>
	    <script>
	        jQuery(document).ready(function(){
	            new Chart(document.getElementById("pie-chart-<?php echo esc_attr($unique); ?>"), {
	                type : <?php echo json_encode($pie_type); ?>,
	                data : {
	                    labels : <?php echo json_encode($labels); ?>,
	                    datasets : [ {
	                        backgroundColor : <?php echo json_encode($colors); ?>,
	                        data : <?php echo json_encode($data); ?>,
	                    } ]
	                },
	                options : {
	                    responsive : true,
	                    layout:{
	                    	padding:0,
	                    },
	                    plugins: {
	                        legend: {
	                           position: <?php echo json_encode($position); ?>,	                           
       	                        labels:{
       	                        	color: '#1F1F1F',
       	                        	padding:15,
       	                        	boxWidth:12,
       	                        	boxHeight:12,
                                    font: {
                                       size: 15,
                                       weight: 600,
                                    }
                                }
	                        },	                        
	                    }
	                }
	            });
	        });
	    </script>
	<?php
		}
	} 
?>
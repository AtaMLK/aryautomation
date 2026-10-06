<?php

/**
 * Elementor header offcanvas Widget jkjuiiugftyfytvhuj.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_Offcanvas_Widget extends \Elementor\Widget_Base
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
        return 'rsoffcanvas';
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
        return esc_html__('RS Header Offcanvas', 'rsaddon');
    }

    /**
     * Get widget icon.
     *
     * Retrieve rsgallery widget icon.
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

    protected function register_controls(){
        $this->start_controls_section(
            'rs_offcanvas_header_offcanvas_section_tab_style',
            [
                'label' => esc_html__('Offcanvas', 'rsaddons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('rs_offcanvas_header_offcanvas_style_tabs');
        $this->start_controls_tab(
            'rs_offcanvas_header_offcanvas_style_hamburger_tab',
            [
                'label' => esc_html__('Hamburger', 'rsaddons')
            ]
        );

        $this->add_control(
            'canvas_icon',
            [
                'label' => __('Icon', 'rsaddon'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'ri-menu-3-line',
                    'library' => 'reguler',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_offcanvas_icon_color',
            [
                'label' => esc_html__('Color', 'rsaddons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area .nav-expander i, {{WRAPPER}} .rs-offcanvas-area .nav-expander svg path' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_offcanvas_icon_color_hover',
            [
                'label' => esc_html__('Color', 'rsaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area .nav-expander:hover i, {{WRAPPER}} .rs-offcanvas-area .nav-expander:hover svg path' => 'color: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rs_offcanvas_text_font_hr',
            [
                'type'  => Controls_Manager::DIVIDER,
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }


    protected function render()
    {
        $this->render_raw();
    }

    protected function render_raw()
    {
        $settings = $this->get_settings();
    ?>
    <div class="rs-offcanvas-area">
        <ul>
            <li class="nav-link pr-20">
                <a class="nav-expander">
                    <?php \Elementor\Icons_Manager::render_icon($settings['canvas_icon'], ['aria-hidden' => 'true']); ?>
                </a>
            </li>
        </ul>            
    </div>

<?php
    }
}

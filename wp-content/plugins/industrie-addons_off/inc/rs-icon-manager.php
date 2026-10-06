<?php
defined( 'ABSPATH' ) || die();

class Rs_Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'rs_custom_icons_tab' ] );
    }

    public static function rs_custom_icons_tab( $tabs ) {
        
        $tabs['rselement-icons'] = [
            'name' => 'rselement-icons',
            'label' => __( 'RS Element Icons', 'rselements' ),
            'url' => RSADDON_ASSETS_PRO . 'fonts/flaticon_lifetec2.css',
            'enqueue' => [ RSADDON_ASSETS_PRO . 'fonts/flaticon_lifetec2.css' ],
            'prefix' => ' ',
            'displayPrefix' => '',
            'labelIcon' => 'rs-badge',
            'ver' => RSELEMENT_VERSION,
            'fetchJson' => RSADDON_ASSETS_PRO . 'fonts/rselement-icons.json?v=' . RSELEMENT_VERSION,
            'native' => false,
        ];
        return $tabs;
    }

}

Rs_Icons_Manager::init();
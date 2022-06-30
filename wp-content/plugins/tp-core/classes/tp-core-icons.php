<?php

namespace TPCore;
defined( 'ABSPATH' ) || die();
class TP_Core_Icon {
    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'tp_core_icofont' ] );
    }
    public static function tp_core_icofont($tabs) {
        $tabs['tp-core-icofont'] = [
            'name' => 'tp-core-icofont',
            'label' => __( 'Ico Font', 'tp-core' ),
            'url' => TP_ASSETS . 'fonts/css/icofont.min.css',
            'enqueue' => [ TP_ASSETS . 'fonts/css/icofont.min.css' ],
            'prefix' => '',
            'displayPrefix' => '',
            'labelIcon' => 'fas fa-i-cursor',
            'ver' => TP_VERSION,
            'fetchJson' => TP_ASSETS . 'fonts/data/icofont-data.js?v=' . time(),
            'native' => false,
        ];
        return $tabs;
    }
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fz_features_enqueue_assets() {
    wp_enqueue_style( 'fz-features-style', FZ_FEATURES_URL . 'assets/css/fz-main.css', array(), '1.0' );
    wp_enqueue_script( 'fz-features-scripts', FZ_FEATURES_URL . 'assets/js/fz-scripts.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'fz_features_enqueue_assets' );
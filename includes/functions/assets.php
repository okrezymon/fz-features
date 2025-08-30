<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function fz_features_enqueue_assets() {
    wp_enqueue_script( 'fz-features-scripts', FZ_FEATURES_URL . 'assets/js/fz-scripts.js', array('jquery'), '1.0', true );

    if ( is_singular('fz-book') ) {
        wp_localize_script( 'fz-features-scripts', 'fz_features_ajax', [
            'ajax_url'   => admin_url('admin-ajax.php'),
            'nonce'      => wp_create_nonce('fz_books_nonce'),
            'current_id' => get_the_ID(),
        ]);
    }
}
add_action( 'wp_enqueue_scripts', 'fz_features_enqueue_assets' );
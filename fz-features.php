<?php
/*
Plugin Name: Fooz features
Description: Custom features to extend basic theme
Version: 1.0
Author: Olga Krezymon
*/

if (!defined('ABSPATH')) {
    exit;
}

define( 'FZ_FEATURES_PATH', plugin_dir_path( __FILE__ ) );
define( 'FZ_FEATURES_URL', plugin_dir_url( __FILE__ ) );

function fz_features_load_textdomain() {
    load_plugin_textdomain( 'fz-features', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
}
add_action( 'plugins_loaded', 'fz_features_load_textdomain' );

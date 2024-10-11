<?php
/*
Plugin Name: Simple Membership Plugin
Description: A custom membership plugin with member registration and login functionality.
Version: 1.0
Author: Iqbal Fadhil (https://iqbalfadhil.com)
*/

// If this file is called directly, abort.
// if ( !defined( 'ABSPATH' ) ) {
//     die;
// }

// // Include necessary files
// include_once plugin_dir_path( __FILE__ ) . 'includes/registration.php';
// include_once plugin_dir_path( __FILE__ ) . 'includes/login.php';

// // Enqueue CSS and JS files (if needed)
// function membership_plugin_enqueue_assets() {
//     wp_enqueue_style( 'membership-plugin-styles', plugins_url( 'assets/css/style.css', __FILE__ ) );
//     wp_enqueue_script( 'membership-plugin-scripts', plugins_url( 'assets/js/script.js', __FILE__ ), array('jquery'), null, true );
// }
// add_action( 'wp_enqueue_scripts', 'membership_plugin_enqueue_assets' );

// Prevent direct access
if ( !defined( 'ABSPATH' ) ) {
    die;
}

// Include necessary files
include_once plugin_dir_path( __FILE__ ) . 'includes/registration.php';
include_once plugin_dir_path( __FILE__ ) . 'includes/login.php';
include_once plugin_dir_path( __FILE__ ) . 'includes/member-management.php';
include_once plugin_dir_path( __FILE__ ) . 'includes/premium-content.php';

// include_once plugin_dir_path( __FILE__ ) . 'includes/member-dashboard.php';

// Enqueue CSS and JS files (if needed)
function membership_plugin_enqueue_assets() {
    wp_enqueue_style( 'membership-plugin-styles', plugins_url( 'assets/css/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'membership_plugin_enqueue_assets' );

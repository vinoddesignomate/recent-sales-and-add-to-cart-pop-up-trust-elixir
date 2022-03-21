<?php
/*
Plugin Name: Sat Test
Plugin URI: https://wordpress.com
Description: Powerful ecommerce.
Version: 1.0
Author: Satya
Author URI: https://wordpress.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



define('rsaacpptelx_plugin_url', plugin_dir_url(__FILE__));
define( 'rsaacpptelx_plugin_dir', untrailingslashit( plugin_dir_path( __FILE__ ) ) );


function rsaacpptelx_activation(){

	if ( ! empty( $_SERVER['SCRIPT_NAME'] ) && false !== strpos( $_SERVER['SCRIPT_NAME'], '/wp-admin/plugins.php' ) ) {
		add_option( 'Activated_SatTest', true );
	}
}
add_action('activate_sat-test/index.php', 'rsaacpptelx_activation');
function rsaacpptelx_css(){
    wp_register_style( 'sat-style', plugins_url('/assets/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('sat-style');
}
add_action('admin_enqueue_scripts', "rsaacpptelx_css");
include(sprintf("%s/includes/functions.php", rsaacpptelx_plugin_dir));





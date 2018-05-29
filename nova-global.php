<?php
/*
Plugin Name: Nova Global
Plugin URI: https://www.wearenova.co.uk/
Description: Global options for the Nova Healthcare Framework
Version: 1.0
Author: We Are Nova
Author URI: https://www.wearenova.co.uk/
Text Domain: nova-global
*/

if( !defined('NOVA_GLOBAL_VERSION') ){
    define( 'NOVA_GLOBAL_VERSION', '1' );
}
if( !defined( 'NOVA_GLOBAL_VERSION_DIR' ) ) {
    define( 'NOVA_GLOBAL_VERSION_DIR', dirname( __FILE__ ) );
}
if( !defined( 'NOVA_GLOBAL_URL' ) ) {
    define( 'NOVA_GLOBAL_URL', plugin_dir_url( __FILE__ ) );
}
if( !defined( 'NOVA_GLOBAL_POST_TYPE' ) ) {
    define( 'NOVA_GLOBAL_POST_TYPE', 'nova_global' );
}

// Die if accessed incorrectly
if ( ! defined( 'WPINC' ) ) {
    die;
}

// IMPORTS
require_once( NOVA_GLOBAL_VERSION_DIR . '/includes/class-nova-global.php' );
// require_once( NOVA_GLOBAL_VERSION_DIR . '/includes/class-nova-header-options.php' );

function run_nova_global() {

	$nova_global = new Nova_Global();
	$nova_global->run();

}

run_nova_global();
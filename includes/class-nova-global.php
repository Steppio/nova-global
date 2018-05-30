<?php
/**
 * Nova Global Class to load and display all global settings
 * 
 * @package nova-global
 * @since 1.0.0
 */

class Nova_Global {

    protected 	$loader;

    protected 	$plugin_slug;

    protected 	$version;

    public function __construct() {

        $this->plugin_slug = 'nova-global-slug';
        $this->version = NOVA_GLOBAL_VERSION_DIR;

        $this->load_dependencies();
        $this->define_admin_hooks();

    }

    private function load_dependencies() {

        require_once( NOVA_GLOBAL_VERSION_DIR . '/includes/class-nova-header-options.php' );

        require_once( NOVA_GLOBAL_VERSION_DIR . '/admin/class-nova-global-admin.php' );
 
        require_once( NOVA_GLOBAL_VERSION_DIR . '/includes/class-nova-global-loader.php' );
        
        $this->loader = new Nova_Global_Loader();

    }

    private function define_admin_hooks() {
 
        $admin = new Nova_Global_Admin( $this->get_version() );
        $admin->add_hooks();
        $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );

        // $this->loader->add_action( 'add_meta_boxes', $admin, 'add_meta_box' );
 
    }

    public function run() {
        $this->loader->run();
    }
 
    public function get_version() {
        return $this->version;
    }

}
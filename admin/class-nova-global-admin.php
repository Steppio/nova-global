<?php
 
class Nova_Global_Admin {
 
    private $version;
 
    public function __construct( $version ) {
        
        $this->version = $version;

        $this->add_menu_page();
        $this->load_dependencies();

    }

    public function enqueue_styles() {
 
        wp_enqueue_style(
            'nova-global-admin',
            plugin_dir_url( __FILE__ ) . 'css/nova-global-admin.css',
            array(),
            $this->version,
            FALSE
        );
 
    }

    public function add_menu_page() {
        add_options_page('Nova Options', 'Nova Options', 'administrator', __FILE__, array('Nova_Global_Header_Options', 'display_nova_options_page'));
    }

    public function display_nova_options_page() {
        ?>

        <div class="wrap">
        
            <h2>Nova Theme Options</h2>
        
            <?php
                //we check if the page is visited by click on the tabs or on the menu button.
                //then we get the active tab.
                $active_tab = "header-options";
                if(isset($_GET["tab"]))
                {

                    // switch ($_GET["tab"]) {
                    //     case "header-options":
                    //         $active_tab = "header-options";
                    //         break;
                    //     case "bar":
                    //         $active_tab = "footer-options";
                    //         break;
                    // }

                    if($_GET["tab"] == "header-options")
                    {
                        $active_tab = "header-options";
                    }
                    else
                    {
                        $active_tab = "footer-options";
                    }

                    print_r($active_tab);
                    die();
                }
            ?>

            <!-- wordpress provides the styling for tabs. -->
            <h2 class="nav-tab-wrapper">
                
                <!-- when tab buttons are clicked we jump back to the same page but with a new parameter that represents the clicked tab. accordingly we make it active -->
                <a href="#" id="header-options" class="nav-tab <?php if($active_tab == 'header-options'){echo 'nav-tab-active';} ?> "><?php _e('Header Options', 'sandbox'); ?></a>
                <a href="#" id="footer-options" class="nav-tab <?php if($active_tab == 'footer-options'){echo 'nav-tab-active';} ?>"><?php _e('Footer Options', 'sandbox'); ?></a>
            </h2>
            <form method="post" action="options.php" enctype="multipart/form-data">

                <div class="header-options nova-tab">

                    <?php settings_fields('nova_header_options'); ?>
                    <?php do_settings_sections(__FILE__); ?>

                    <?php 
                    // $o = get_option('nova_header_options');
                    // echo '<pre>';
                    // echo $o['nova_header_colour'];
                    // echo '</pre>';
                    ?>

                </div>

                <div class="footer-options nova-tab">
                    <input type="text" name="nova_footer_options[text-input]">
                </div>

                <p class="submit">
                    <input name="submit" type="submit" class="button-primary" />
                </p>
            </form>
        </div>

        <script>
            jQuery( document ).ready(function() {
                jQuery( ".nav-tab" ).click(function() {
                    jQuery( ".nova-tab" ).css('display', 'none');
                    var attr = '.' + jQuery( this ).attr( 'id' );
                    console.log( attr );
                    jQuery( attr ).css( 'display', 'block' );
                });
            });
        </script>

        <?php 
    }

 
    // public function add_meta_box() {
 
    //     add_meta_box(
    //         'single-post-meta-manager-admin',
    //         'Single Post Meta Manager',
    //         array( $this, 'render_meta_box' ),
    //         'post',
    //         'normal',
    //         'core'
    //     );
 
    // }
 
    // public function render_meta_box() {
    //     require_once plugin_dir_path( __FILE__ ) . 'partials/single-post-meta-manager.php';
    // }
 
}


add_action('admin_menu', function() {
    Nova_Global_Admin::add_menu_page();
});

add_action('admin_init', function() {
    new Nova_Global_Admin();
});
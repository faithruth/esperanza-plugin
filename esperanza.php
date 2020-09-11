<?php
/**
 * Plugin Name: Espranza Custom Post Types
 * Description: A plugin that for the donations custon post type.
 * Version:     1.0.0
 * Author:      Imokol Faith Ruth
 * Text Domain: esperanza-custom-post-types
 */


namespace Esperanza\Custom;

use Esperanza\Admin\Custom_Post_Type;
use Esperanza\Admin\Custom_Meta_Box;
use Esperanza\Admin\Testimonials_Page;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Esperanza{

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return Plugin An instance of the class.
     * @since 1.2.0
     * @access public
     *
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_styles_and_scripts(){
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files()
    {
        require_once(__DIR__ . '/includes/admin/custom-post-type.php');
        require_once(__DIR__ . '/includes/admin/custom-meta-box.php');
        require_once(__DIR__ . '/includes/admin/testimonials-page.php');

    }

    /**
     *  Esperanza class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct()
    {

        define('ESP_DIR', plugin_dir_path( __FILE__ ));
        define('ESP_URL', plugin_dir_url( __FILE__ ));
    
        $this->include_widgets_files();
        //enqueue scripts
        add_action( 'wp_enqueue_scripts', [$this, 'widget_styles_and_scripts'] );
        $custom_post_type = new Custom_Post_Type();
        $custom_meta_box = new Custom_Meta_Box();
        $testimonials = new Testimonials_Page();

        //add hooks
        add_action( 'init', [$custom_post_type, 'register_custom_post_type'], 0 );
        add_action( 'add_meta_boxes', [$custom_meta_box, 'add_meta_box']  );
        add_action( 'save_post', [$custom_meta_box, 'save_target'] );
        add_action( 'save_post', [$custom_meta_box, 'save_raised'] );
        add_action( 'save_post', [$custom_meta_box, 'save_link'] );

        add_action( 'init', [$testimonials, 'testimonials_post_type']);
        add_action('admin_menu', [$testimonials, 'testimonial_menu']); 
        add_action( 'add_meta_boxes', [$testimonials, 'add_meta_box']  );


    }
}

// Instantiate Plugin Class
Esperanza::instance();
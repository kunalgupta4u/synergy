<?php
/**
 * Plugin Name: FLEX MAP
 * Plugin URI: http://demo.zotheme.com/extensions/flexmap/
 * Description: Provide a powerful map solution for your Wordpress website.
 * Version: 1.0.3
 * Author: Jax Porter & Fox
 * Author URI: https://twitter.com/jax_porter_139
 * License: GPLv2 or later
 * Text Domain: flex-map
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

include_once 'mapBootStrapper.php';

if( !class_exists( 'myMaps' ) )
{
    final class myMaps extends mapBootStrapper
    {

        /**
         * Action argument used by the nonce validating the AJAX request.
         *
         * @var string
         */
        const NONCE = 'flx-mp-ajax';

        public $map_id;
        /**
         * Main Instance
         *
         * Insures that only one instance of myMaps exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @since 1.0.0
         * @staticvar object $instance
         * @uses myMaps::setup_globals() Setup the globals needed
         * @uses myMaps::includes() Include the required files
         * @uses myMaps::setup_actions() Setup the hooks and actions
         * @return The one true myMaps
         */
        public static function instance()
        {
            /*Store the instance locally to avoid private static replication*/
            static $instance = null;

            /* Only run these methods if they haven't been ran previously*/
            if (null === $instance)
            {
                $instance = new myMaps();
                $instance->setup_globals();
                $instance->setup_actions();
                $instance->include_files();
            }
            /*Always return the instance*/
            return $instance;
        }


        /**
         * Set some smart defaults to class variables.
         * Allow some of them to be
         * filtered to allow for early overriding.
         *
         * @since 1.0.0
         * @access private
         * @uses plugin_dir_path() To generate plugin path
         * @uses plugin_dir_url() To generate plugin url
         * @uses apply_filters() Calls various filters
         */
        private function setup_globals()
        {


            $this -> file = __FILE__;
            $this->basename     = plugin_basename($this->file);

            $this->plugin_dir   = plugin_dir_path($this->file);
            $this->plugin_url   = plugin_dir_url($this->file);


            $this -> assets     = trailingslashit($this -> plugin_url . 'assets');
            /* plugin data */
            if( function_exists('get_plugin_data') ) {
                $this -> pl_data = get_plugin_data($this -> file);

            }
            $this -> pl_name = 'Flex Map';
            /* short code name */
            $this -> shortcode   = 'flexmap';
        }

        /**
         * Setup the default hooks and actions
         *
         * @since 1.0.0
         * @access private
         * @uses add_action() To add various actions
         */
        private function setup_actions()
        {


        }


        /**
         * Include core file
         */
        private function include_files()
        {
            $this->folder_class_calling_out( 'core');
        }

        /**
         * Get the AJAX data that WordPress needs to output.
         *
         * @return array
         */
        public function get_ajax_data()
        {
            return wp_create_nonce(myMaps::NONCE);
        }

    }

    /**
     * The main function responsible for returning the one true rlProducts Instance
     * to functions everywhere.
     *
     * Use this function like you would a global variable, except without needing
     * to declare the global.
     *
     *
     * @return The one true rlProducts Instance
     */

    if (! function_exists('FlexMap') )
    {
        function FlexMap()
        {
            return myMaps::instance();
        }
    }

    /**
     * Hook declare_mymaps early onto the 'plugins_loaded' action.
     *
     * This gives all other plugins the chance to load before myMaps, to get their
     * actions, filters, and overrides setup without tabCarousel being in the way.
     */
    if (defined('FlexMap_LATE_LOAD'))
    {
        add_action('plugins_loaded', 'FlexMap', (int) FlexMap_LATE_LOAD);
    } else {
        FlexMap();
    }

}



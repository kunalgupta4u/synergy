<?php
class mapData {

    function __construct() {
        /* Mymaps add options */
        register_activation_hook( FlexMap() -> file, array($this, 'mymaps_add_options'));
    }


    /**
     * Add custom options
     */
    function mymaps_add_options()
    {
        if( !get_option('mymaps_options') )
        {
            $new_options['_mystyles_'] = array();
            $new_otions['_last_posts_'] = 0;
            $new_options['_map_posts_'] = array();
            $new_options['_icons_'] = array();
            add_option('mymaps_options', $new_options);
        }

        if( !get_option('disable_legend_carousel')) {
            add_option('disable_legend_carousel', 'checked');
        }
    }

    /**
     * To get value from request or data
     */
    function get_field_values($essential_array, $request)
    {
        if (!isset($request['save_change'])) return false;

        foreach ($essential_array as $key => $type) {
            if ($type == 'checkbox') {

                $value = (isset($request[$key]) && $request[$key] == '1') ? 'checked' : '';
            } else {
                $value = $request[$key];
            }
            update_option($key, $value);
        }
    }
}
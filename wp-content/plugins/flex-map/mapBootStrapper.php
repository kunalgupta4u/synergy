<?php

class mapBootStrapper
{
    function __construct() {

        $this->file = __FILE__;
        $this->basename = plugin_basename($this->file);

        $this->plugin_dir = plugin_dir_path($this->file);
        $this->plugin_url = plugin_dir_url($this->file);

        $this->assets = trailingslashit($this->plugin_url . 'assets');
    }

    /**
     * Too calling all file and object of a folder
     * @param $folder
     */
    public function folder_class_calling_out($path)
    {

        $full_path = $this->plugin_dir . $this->switch_alias_url($path);

        if (is_dir($full_path)) {

            $all_core_files = scandir($full_path, SCANDIR_SORT_DESCENDING);
            if (is_array($all_core_files)) {

                foreach ($all_core_files as $file_name) {
                    $path_file = $full_path . '/' . $file_name;
                    if (file_exists($path_file) && strpos($file_name, '.php') !== false) {
                        include_once($path_file);
                        $class_name = substr($file_name, 0, -4);
                        if (class_exists($class_name)) {
                            new $class_name();
                        }
                    }
                }
            }
        } else {
            $path = explode('.', $path);
            echo 'The system lost file <b>' . $full_path . '</b>, Please re-install plugin <br>' . $path[0];
        }
    }


    /**
     * Rendering elements
     * ------------------
     * @param $path
     * @param $form_data
     */


    public function get_template_file_e($alias_path, $data_form = null)
    {
        $full_path = $this->plugin_dir . '/' . $this->switch_alias_url($alias_path);

        if (is_array($data_form)) {
            foreach ($data_form as $variable_name => $variable_value) {
                $data_form[$variable_name] = $variable_value;
            }
        }

        $full_path_name = $full_path . '.temp.php';

        if (file_exists($full_path_name))
            include $full_path_name;
    }


    /**
     * Render template file in template folder
     * ------------------------------------------
     * @param $path
     * @param $form_data
     * @return string
     */

    public function get_template_file__($alias_path, $form_data = null)
    {
        $full_path = $this->plugin_dir . '/' . $this->switch_alias_url($alias_path);
        // Checking for variable assign
        if (!empty($form_data) && is_array($form_data)) {
            foreach ($form_data as $variable_name => $variable_value) {
                $form_data[$variable_name] = $variable_value;
            }
        }

        $full_path_name = $full_path . '.temp.php';
        if (file_exists($full_path_name)) {
            ob_start();
            require_once $full_path_name;
            return ob_get_clean();
        }
        return '';
    }


    public function switch_alias_url($path)
    {
        if (strpos($path, '.') !== false)
            return str_replace('.', '/', $path);

        return $path;
    }

    /**
     * @param $file_content
     */
    public function flex_map_import_data( $file_content ) {

        $options = get_option('mymaps_options');
        $origin = $file_content;

        if( $file_content =  json_decode( $file_content, true )) {

            /* Decode and redefine */
            try {

                $_HOST_             = $file_content['_host_'];
                $_MY_STYLES_        = (isset($file_content['_mystyles_']) && $file_content['_mystyles_'] != '' ) ? json_decode(rawurldecode($file_content['_mystyles_']), true) : '';
                $_MAP_POST_         = (isset($file_content['_map_posts_']) && $file_content['_map_posts_'] != '' ) ? json_decode(rawurldecode($file_content['_map_posts_']), true) : '';
                $_ICONS_            = (isset($file_content['_icons_']) && $file_content['_icons_'] != '' ) ? json_decode(rawurldecode($file_content['_icons_']), true) : '';

            } catch(Exception $e ) {
               return array('error' => 'data.wrong');
            }

            /* check style */
            if( is_array($_MY_STYLES_) && count($_MY_STYLES_) > 0 )
            {
                foreach( $_MY_STYLES_  as $name => $value ) {
                    if( !array_key_exists( $name, $options['_mystyles_'] ) )
                    {
                        $options['_mystyles_'][$name] = $value;
                    }
                }
            }

            /* Check icon */
            if( is_array($_ICONS_) && count($_ICONS_) > 0 )
            {
                foreach( $_ICONS_ as $value ) {
                    if( !in_array( $value, $options['_icons_'] ) )
                    {
                        $options['_icons_'][] = $value;
                    }
                }
            }

            /* Check post */
            if( $_POST['append'] !== 'true' ) {
                $options['_map_posts_'] = array();
            }

            $cur_content_dir = (function_exists('content_url')) ? content_url() : plugins_url('.../.../',__FILE__);

            if( is_array($_MAP_POST_) && count($_MAP_POST_) > 0 )
            {
                foreach( $_MAP_POST_ as $id => $value ) {
                    $gen = json_decode($value['general']);
                    preg_match("/\[flexmap id='([0-9])'\]/", $gen->short_code, $id_array);

                    try {
                        $value['markers'] = str_replace($_HOST_, $cur_content_dir, $value['markers']);
                    } catch( Exception $e ) {
                        return array('error' => 'failed');
                    }

                    if(isset($id_array[1]) && is_numeric($id_array[1])) {
                        $options['_map_posts_'][$id_array[1]] = $value;
                    } else {
                        $options['_map_posts_'][$id + 1] = $value;
                    }
                }
            }

            /* Update */
            if( update_option( 'mymaps_options', $options ) ) {
                return array('success' => 'imported');
            } else {
                return array('error' => 'nothing.changed');
            }
        } else {
            return array('error' => 'content.incorrect', 'content' => $origin);
        }
    }

}
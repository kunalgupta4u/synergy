<?php
class mapAjaxHandler{

   function __construct()
   {
       /* Load admin ajax url.*/
       add_action('admin_header', array($this, 'mymaps_ajaxurl'));
       /* Do shortcode action */
       /* add_action('init', function(){
           add_action('wp_ajax_flex_do_shortcode', array($this, 'flex_do_shortcode_callback'));
           add_action('wp_ajax_nopriv_flex_do_shortcode', array($this, 'flex_do_shortcode_callback'));
       });*/
       /* AJAX for load my styles */
       add_action('wp_ajax_flx_load_my_styles', array($this, 'flx_load_my_styles_callback'));
       add_action('wp_ajax_nopriv_flx_load_my_styles', array($this, 'flx_load_my_styles_callback'));


       /* AJAX for save 2 mystyles */
       add_action('wp_ajax_flx_save2_mystyles', array($this, 'flx_save2_mystyles_callback'));
       add_action('wp_ajax_nopriv_flx_save2_mystyles', array($this, 'flx_save2_mystyles_callback'));

       /* AJAX for delete mystyle */
       add_action('wp_ajax_flx_delete_mystyle', array($this, 'flx_delete_mystyle_callback'));
       add_action('wp_ajax_nopriv_flx_delete_mystyle', array($this, 'flx_delete_mystyle_callback'));

       /* AJAX for save map post */
       add_action('wp_ajax_flx_save_map', array($this, 'flx_save_map_callback'));
       add_action('wp_ajax_nopriv_flx_save_map', array($this, 'flx_save_map_callback'));

       /* AJAX for delete map post */
       add_action('wp_ajax_flx_delete_map', array($this, 'flx_delete_map_callback'));
       add_action('wp_ajax_nopriv_flx_delete_map', array($this, 'flx_delete_map_callback'));

       /* AJAX for upload marker icons  */
       add_action('wp_ajax_flx_upload_marker_icon', array($this, 'flx_upload_marker_icon_callback'));
       add_action('wp_ajax_nopriv_flx_upload_marker_icon', array($this, 'flx_upload_marker_icon_callback'));

       /* AJAX for delete marker icons */
       add_action('wp_ajax_flx_delete_marker_icon', array($this, 'flx_delete_marker_icon_callback'));
       add_action('wp_ajax_nopriv_flx_delete_marker_icon', array($this, 'flx_delete_marker_icon_callback'));

       /* AJAX for delete marker icons */
       add_action('wp_ajax_flx_import_map', array($this, 'flx_import_map_callback'));
       add_action('wp_ajax_nopriv_flx_import_map', array($this, 'flx_import_map_callback'));

       /* AJAX for delete marker icons */
       add_action('wp_ajax_mymaps_load_styles_libs', array($this, 'mymaps_load_styles_libs_callback'));
       add_action('wp_ajax_nopriv_mymaps_load_styles_libs', array($this, 'mymaps_load_styles_libs_callback'));

       /* AJAX for import data from theme */
       add_action('wp_ajax_mymaps_theme_import', array($this, 'mymaps_theme_import_callback'));
       add_action('wp_ajax_nopriv_mymaps_theme_import', array($this, 'mymaps_theme_import_callback'));

       add_action( 'init', function() {
           $this->ps_register_shortcode_ajax( 'flx_user_do_shortcode', 'flex_do_shortcode' );
       } );
   }

    /**
     * @param $callable
     * @param $action
     */
    function ps_register_shortcode_ajax($callable, $action ) {
        if ( empty( $_POST['action'] ) || $_POST['action'] != $action )
            return;

        echo call_user_func( array($this, 'flx_user_do_shortcode'), $_REQUEST['description']);
        exit();
    }

    /**
     * @param $content
     * @return string
     */
    function flx_user_do_shortcode( $content ) {
        return do_shortcode($content);
    }

    /**
     *
     */
    function flex_do_shortcode_callback() {
        $description = $_REQUEST['description'];
        $description =  $this->flx_user_do_shortcode($description);
        var_dump($description);
        exit();
        //header('Content-Type: application/json');
        // Make sure we are getting a valid AJAX request
        check_ajax_referer(myMaps::NONCE);
        var_dump($description);
        if(function_exists('do_shortcode')) {
            die(json_encode((object)array('content' => do_shortcode($_REQUEST['description']))));
        } else {
            die(json_encode((object)array('error' => "Cannot find do_shortcode function", 'content' => $_REQUEST['description'])));
        }
    }
    /**
     * Handle ajax request to load my styles panel
     *
     * @since 1.0.0
     */
    function flx_load_my_styles_callback() {
        header('Content-Type: application/json');
        if ( ! is_admin() ) exit();
        // Make sure we are getting a valid AJAX request
        check_ajax_referer(myMaps::NONCE);
        //var_dump(get_option('mymaps_options'));
        if(get_option('mymaps_options'))
        {
            $mymaps_options = get_option('mymaps_options');
            die(json_encode((object)array('_mystyles_' => $mymaps_options['_mystyles_'])));
        }
        exit();
    }


    /**
     * AJAX callback when request to import
     *
     */
    function flx_import_map_callback() {
        if( isset($_POST['file_content']) && $_POST['file_content'] != '' )
        {
            $options = get_option('mymaps_options');

            if( $file_content =  json_decode(stripslashes($_POST['file_content']), true ) ) {
                /* Decode and redefine */
                try {
                    $_HOST_             = $file_content['_host_'];
                    $_MY_STYLES_        = (isset($file_content['_mystyles_']) && $file_content['_mystyles_'] != '' ) ? json_decode(rawurldecode($file_content['_mystyles_']), true) : '';
                    $_MAP_POST_         = (isset($file_content['_map_posts_']) && $file_content['_map_posts_'] != '' ) ? json_decode(rawurldecode($file_content['_map_posts_']), true) : '';
                    $_ICONS_            = (isset($file_content['_icons_']) && $file_content['_icons_'] != '' ) ? json_decode(rawurldecode($file_content['_icons_']), true) : '';
                } catch(Exception $e ) {
                    echo 'content_incorrect'; exit();
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

                /* check icon */
                if( is_array($_ICONS_) && count($_ICONS_) > 0 )
                {
                    foreach( $_ICONS_ as $value ) {
                        if( !in_array( $value, $options['_icons_'] ) )
                        {
                            $options['_icons_'][] = $value;
                        }
                    }
                }
                /* check post */
                if( $_POST['append'] !== 'true' ) {
                    $options['_map_posts_'] = array();
                }

                $cur_content_dir = (function_exists('content_url')) ? content_url() : plugins_url('.../.../',__FILE__);

                if( is_array($_MAP_POST_) && count($_MAP_POST_) > 0 )
                {
                    foreach( $_MAP_POST_ as $id => $value ) {
                        $gen = json_decode($value['general']);
                        preg_match("/\[flexmap id='([0-9])'\]/", $gen->short_code, $id_array);
                        try{
                            $value['markers'] = str_replace($_HOST_, $cur_content_dir, $value['markers']);
                        } catch( Exception $e ){
                            echo 'fail';
                            exit();
                        }
                        if(isset($id_array[1]) && is_numeric($id_array[1])) {
                            $options['_map_posts_'][$id_array[1]] = $value;
                        } else {
                            $options['_map_posts_'][$id + 1] = $value;
                        }

                    }
                }
                /* update */
                if( update_option( 'mymaps_options', $options ) ) {
                    echo 'success';
                } else {
                    echo 'nothing_change';
                }
            } else {
                echo 'content_incorrect';
            }
        } else {
            echo 'file_content_exist';
        }
        exit();
    }

    /**
     * Handle ajax request for DELETE marker icons
     *
     * since 1.0.0
     */
    function flx_delete_marker_icon_callback() {
        if ( ! is_admin() ) exit();
        // Make sure we are getting a valid AJAX request
        check_ajax_referer(self::NONCE);
        if(isset( $_POST['link'] ) ) {
            $link = trim($_POST['link']);
            $image = $this->get_link_title( $link );
            /* Get options */
            if( $options = get_option('mymaps_options') ) {
                if( isset($options['_icons_']) && $options['_icons_'] != '' && count($options['_icons_']) > 0 ) {
                    if( in_array($image, $options['_icons_']) ) {
                        $key = array_search( $image, $options['_icons_'] );
                        if( is_numeric($key) && $key >= 0 ) {
                            unset($options['_icons_'][$key]);
                            update_option('mymaps_options', $options );
                        }
                    }
                }
            }
        }
        exit();
    }

    /**
     * Handle ajax request for save to my styles
     *
     * since 1.0.0
     */
    function flx_save2_mystyles_callback()
    {
        // Make sure we are getting a valid AJAX request
        //check_ajax_referer(FlexMap() -> NONCE);

        if( get_option('mymaps_options') ) {

            $mymaps_options = get_option('mymaps_options');
            $arr_mystyles   = $mymaps_options['_mystyles_'];
            $style_name     = $_POST['style_name'];
            if ($arr_mystyles == '')
            {
                $arr_mystyles = array(
                    $style_name => array(
                        'json' => $_POST['style_json'],
                        'image' => $_POST['style_image']
                    )
                );
            } else {
                if( !array_key_exists($style_name, $arr_mystyles))
                {
                    $arr_mystyles[$style_name] = array(
                        'json'  => stripslashes($_POST['style_json']),
                        'image' => $_POST['style_image']
                    );
                }
            }
            $mymaps_options['_mystyles_'] = $arr_mystyles;

            if(update_option('mymaps_options', $mymaps_options)) {
                die(json_encode((object)array('success' => esc_html__('Added to my style', 'flex-map'))));
            } else {
                die(json_encode((object)(array('error' => 'Update failed'))));
            }

        }
        die(json_encode((object)(array('error' => 'cannot find database'))));
        exit();
    }

    /**
     * Handle ajax request to delete my style
     */
    function flx_delete_mystyle_callback()
    {
        header('Content-Type: application/json');
        if( $mymaps_options = get_option('mymaps_options') )
        {
            $arr_mystyles = $mymaps_options['_mystyles_'];
            $style_name = rawurlencode($_POST['style_name']);
            if( array_key_exists($style_name, $arr_mystyles ) ) {
                unset( $arr_mystyles[$style_name] );
            } else {
                die(json_encode((object)(array('error' => 'Cannot find this style in database.', 'details' => array('style_name' => $style_name, 'map_array' => $arr_mystyles)))));
            }
            $mymaps_options['_mystyles_'] = $arr_mystyles;
            if(update_option('mymaps_options', $mymaps_options)) {
                die(json_encode((object)(array('success' => 'Deleted style'))));
            } else {
                die(json_encode((object)(array('error' => "something's wrong with update options"))));
            }
        } else {
            die(json_encode((object)(array('error' => 'Cannot find database'))));
        }
        die(json_encode((object)(array('error' => 'Undefine errors!!!'))));
    }

    /**
     * Handle ajax request to save map post
     */
    function flx_save_map_callback() {
        header('Content-Type: application/json');
        if (!is_admin()) exit();

        // Make sure we are getting a valid AJAX request
        check_ajax_referer(myMaps::NONCE);

        if ( get_option('mymaps_options') !== false) {
            $options = get_option('mymaps_options');
            $general = stripslashes($_POST['general']);
            $markers = stripslashes($_POST['markers']);
            $markersCat = stripslashes($_POST['markersCat']);
            $polyLines = stripslashes($_POST['polyLines']);
            $polyGons = stripslashes($_POST['polyGons']);
            $circles = stripslashes($_POST['circles']);
            $recTangles = stripslashes($_POST['recTangles']);

            $option_save = array(
                'general'    => $general,
                'markers'    => $markers,
                'markersCat' => $markersCat,
                'polyLines'  => $polyLines,
                'polyGons'   => $polyGons,
                'circles'    => $circles,
                'recTangles' => $recTangles
            );

            if ($options != '' && array_key_exists('_map_posts_', $options)) {

                /* Create new map situation */
                if ($_POST['map_id'] == -1) {
                    /* Get last id */
                    $id = (int)end(array_keys($options['_map_posts_'])) + 1;
                    $options['_map_posts_'][$id] = $option_save;
                    $message = esc_html__('Created A New Map', 'flex-map');

                    /* Edit map situation */
                } else {
                    if (array_key_exists($_POST['map_id'], $options['_map_posts_'])) {
                        $options['_map_posts_'][$_POST['map_id']] = $option_save;
                        $message = esc_html__('Map Save Changed', 'flex-map');
                        $id = $_POST['map_id'];
                    }
                }
            } else {
                $options['_map_posts_'][1] = $option_save;
                $message = esc_html__('Created A New Map', 'flex-map');
                $id = 1;
            }

            if( update_option('mymaps_options', $options) ) {
                die(json_encode((object)array('success' => $message, 'map_id' => $id)));
            }
        } else {
            die(json_encode((object)array('failed' => esc_html__('Save Map Failed! Refresh Page Again.', 'flex-map'))));
        }

        die(json_encode((object)array('failed' => esc_html__('Undefine Error, please contact to Flex Map Develope Team'))));
    }

    /**
     * Handle ajax request to delete map post
     */
    function flx_delete_map_callback()
    {
        header('Content-Type: application/json');

        if ( ! is_admin() ) exit();
        // Make sure we are getting a valid AJAX request
        check_ajax_referer(myMaps::NONCE);
        if( $options = get_option('mymaps_options') )
        {
            $change = 0;
            $map_id = trim( $_POST['map_id'], ',' );
            $map_ids = explode( ',', $map_id );

            foreach( $map_ids as $value ) {
                $id = (int) $value;
                if( $id !== '' ) {
                    $map_post = $options['_map_posts_'];
                    unset($map_post[$id]);
                    $options['_map_posts_'] = $map_post;
                    $change += 1;
                }
            }
            if( $change > 0 ) {
                if(update_option('mymaps_options', $options )) {
                    die(json_encode((object)(array('success' => "<i class='fa fa-check'></i> Delete inserted map!"))));
                }
            } else {
                die(json_encode((object)(array('error' => "Don't have any change to delete map"))));
            }
        } else {
            die(json_encode((object)(array('error' => "Can't get option"))));
        }
        exit();
    }

    /**
     * Handle ajax request to upload marker image
     */
    function flx_upload_marker_icon_callback()
    {
        if ( ! is_admin() ) exit();
        // Make sure we are getting a valid AJAX request
        check_ajax_referer(myMaps::NONCE);
        if(isset($_POST['link'])) {
            $link = trim($_POST['link']);
            $image = $this->get_link_title( $link );
            /* Get options */
            if( $options = get_option('mymaps_options') ) {
                /* check option exists */
                if( isset( $options['_icons_'] ) ) {
                    /* check option null */
                    if( $options['_icons_'] == '' || $options['_icons_'] == null ) {
                        $options['_icons_'][0] = $image;
                    } else {
                        $options['_icons_'][] = $image;
                    }
                } else { /* if not exists */
                    $options['_icons_'][0] = $image;
                }
                update_option( 'mymaps_options', $options );
                echo $image['title'];
            }else { /* if cannot get options */
                echo 'not_get';
            }
        } else { /* if not isset link variable */
            echo 'not_isset';
        }
        exit();
    }

    /**
     * Load admin ajax url.
     *
     * @since 1.0.0
     */
    function mymaps_ajaxurl()
    {
    ?>
        <script type="text/javascript">var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';</script>
    <?php
    }

    /**
     * @param $link
     * @return array
     */
    function get_link_title( $link ) {
        $get_file_name = explode('/', $link);
        $get_file_name = $get_file_name[(count($get_file_name) - 1)];
        $title = explode( '.', $get_file_name );
        $title = $title[(count($title) - 2)];
        $image = array( 'title' => $title, 'link' => $link );
        return $image;
    }

    /**
     * Theme import
     */
    public function mymaps_theme_import_callback() {
        header('Content-Type: application/json');
        $bootstrap = new mapBootStrapper();
        $dir = trailingslashit(get_template_directory_uri()) . "inc/demo-data/elementy/maps_backup.json";
        $file_content  =  file_get_contents($dir);

        $result = $bootstrap->flex_map_import_data($file_content);
        die(json_encode((object)$result));
    }
}
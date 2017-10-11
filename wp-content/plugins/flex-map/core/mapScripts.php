<?php
class mapScripts {

    function __construct() {
        /*  hook to link only on the front-end */
        add_action( 'wp_enqueue_scripts', array($this, 'mymaps_add_scripts_method' ) );

        /* Hook to embed admin script function */
        add_action('admin_enqueue_scripts', array($this, 'mymaps_add_admin_scripts'));

        add_action( 'admin_enqueue_scripts', array($this, 'prfx_image_enqueue' ) );
    }

    /**
     * add front-end script.
     *
     * @since 1.0.0
     *
     * @uses wp_enqueue_style() load styles.
     * @uses wp_enqueue_script() load scripts.
     */
    function mymaps_add_scripts_method()
    {

    }

    /**
     * add back-end script.
     *
     * @since 1.0.0
     *
     * @uses wp_enqueue_style() load styles.
     * @uses wp_enqueue_script() load scripts.
     */
    function mymaps_add_admin_scripts() {
        $screen = get_current_screen();

        $this -> slug_name = strtolower( FlexMap() -> pl_name );
        $this -> slug_name = explode( ' ', $this -> slug_name );
        $this -> slug_name = implode( '-', $this -> slug_name );


        // ----------- MAP POST
        if (isset($screen->id) && $screen->id == $this -> slug_name . '_page_map-post')
        {

            wp_enqueue_script("jquery");
            wp_enqueue_style('map.admin.css',  FlexMap() -> assets . 'css/admin.css', null, '1.1.0');

            $api_key = get_option('api_key', '');
            if(!empty($api_key)) {
                $api_key = 'key=' . $api_key;
            } else {
                $api_key = 'sensor=false';
            }

            wp_enqueue_script('googlemap-script', 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=weather,places&' . $api_key, null, '1.0.0', TRUE);

            //wp_enqueue_script('googlemap-script', 'https://maps.googleapis.com/maps/api/js?v=3.21&libraries=weather,places&sensor=false', null, '1.0.0', TRUE);

            // Bootstrap
            wp_enqueue_style('bootstrap.min.css',  FlexMap() -> assets . 'elements/bootstrap/bootstrap.min.css');
            //wp_enqueue_style('bootstrap-theme.min.css',  '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css');

            // Draw panel
            //wp_enqueue_style('elm-slider', FlexMap() -> assets . 'elements/slider/jquery.mobile-1.4.5.min.css');
            //wp_enqueue_script('jquery.mobile-1.4.5.min.js', FlexMap() -> assets . 'elements/slider/jquery.mobile-1.4.5.min.js', null, '1.0.0', TRUE);
            wp_enqueue_style('nouislider.css', FlexMap() -> assets . 'elements/slider/nouislider.css');
            wp_enqueue_script('nouislider.js', FlexMap() -> assets . 'elements/slider/nouislider.js', null, '1.0.0', TRUE);


            // Notification
            wp_enqueue_style('elm-notifi', FlexMap() -> assets . 'elements/notification/jquery.growl.css');
            wp_enqueue_script('elm-notifi-script', FlexMap() -> assets . 'elements/notification/jquery.growl.js', null, '1.0.0', TRUE);
            wp_enqueue_script('list.min.js', FlexMap() -> assets . 'elements/list_filter/list.min.js', null, '1.0.0', TRUE);

            // Style panel script
            wp_enqueue_script('admin.st.script', FlexMap() -> assets . 'js/st.admin.js', null, '1.1.0', TRUE);
            wp_localize_script('admin.st.script', 'ajax_data', FlexMap() -> get_ajax_data());
            wp_enqueue_script('admin.st.script');

            wp_enqueue_script('admin.mk.script', FlexMap() -> assets . 'js/mk.admin.js', null, '1.1.0', TRUE);
            wp_localize_script('admin.mk.script', 'ajax_data', FlexMap() -> get_ajax_data());
            wp_enqueue_script('admin.mk.script');

            wp_enqueue_script('admin.dr.script', FlexMap() -> assets . 'js/dr.admin.js', null, '1.1.0', TRUE);
            wp_enqueue_script('gnr.admin.script',FlexMap() -> assets . 'js/gnr.admin.js', null, '1.1.0', TRUE);


            wp_enqueue_style('font-awesome', FlexMap() -> assets . 'css/font-awesome.min.css');
            wp_enqueue_style('elm-accordion', FlexMap() -> assets . 'elements/accordion/css/style.css');
            wp_enqueue_script('elm-accordion-scr', FlexMap() -> assets . 'elements/accordion/js/modernizr.custom.29473.js', null, '1.1.0', TRUE);

            // Minicolors
            wp_enqueue_script('elm-tinycolor', FlexMap() -> assets . 'elements/colorpicker/tinycolor.js', null, '1.1.0', TRUE);
            wp_enqueue_style('elm-colorpicker', FlexMap() -> assets . 'elements/colorpicker/jquery.colorpickersliders.css');
            wp_enqueue_script('elm-colorpicker-scr', FlexMap() -> assets . 'elements/colorpicker/jquery.colorpickersliders.js', null, '1.1.0', TRUE);

            // Flip panel
            //wp_enqueue_style('elm-flpanel', FlexMap() -> assets . 'elements/panel/flpanel.css');

            // Transition effects
            wp_enqueue_style('animations', FlexMap() -> assets . 'elements/PageTransitions/css/animations.css');
            wp_enqueue_style('component', FlexMap() -> assets . 'elements/PageTransitions/css/component.css');
            wp_enqueue_script('modernizr.custom', FlexMap() -> assets . 'elements/PageTransitions/js/modernizr.custom.js', null, '1.0.0', TRUE);
            wp_enqueue_script('jquery.dlmenu', FlexMap() -> assets . 'elements/PageTransitions/js/jquery.dlmenu.js', null, '1.0.0', TRUE);

            $map_data = array( '_post_id_' => -1 );

            if(isset($_GET['edit_map']) && is_numeric($_GET['edit_map'])) {
                if( $options = get_option('mymaps_options') )
                {
                    $map_data                 = $options['_map_posts_'];
                    $map_data                 = $map_data[$_GET['edit_map']];
                    $map_data['_post_id_']    = $_GET['edit_map'];
                    $map_data['_shortcode_']  = 'flexmap';
                }
            }

            $map_data['_nonce_'] = FlexMap() -> get_ajax_data();

            wp_enqueue_script('pagetransitions', FlexMap() -> assets . 'elements/PageTransitions/js/pagetransitions.js', null, '1.0.0', TRUE);

            wp_enqueue_script('admin.init', FlexMap() -> assets . 'js/init.admin.js', null, '1.1.0', TRUE);
            wp_localize_script('admin.init', 'mapData', $map_data);
            wp_enqueue_script('admin.init');


            // Helper
            wp_enqueue_script('elm-helper', FlexMap() -> assets . 'js/helper.js', null, '1.0.1', TRUE);
            wp_enqueue_script('adminUI', FlexMap() -> assets . 'js/helpers/adminUI.js', null, '1.0.0', TRUE);
        }


        /* Map List */
        if (isset($screen->id) && $screen->id == 'toplevel_page_' . $this -> slug_name . '-main-menu')
        {

            wp_enqueue_script("jquery");

            wp_enqueue_style('font-awesome', FlexMap() -> assets . 'css/font-awesome.min.css');

            wp_enqueue_style('map.common', FlexMap() -> assets . 'css/common.css');

            wp_enqueue_style('map.map-list', FlexMap() -> assets . 'css/list.css');

            wp_enqueue_script('list.admin.script', FlexMap() -> assets . 'js/list.admin.js', null, '1.0.0', TRUE);
            wp_localize_script('list.admin.script', 'ajax_data', FlexMap() -> get_ajax_data());
            wp_enqueue_script('list.admin.script');

            /* notification*/
            wp_enqueue_style('elm-notifi', FlexMap() -> assets . 'elements/notification/jquery.growl.css');
            wp_enqueue_script('elm-notifi-script', FlexMap() -> assets . 'elements/notification/jquery.growl.js', null, '1.0.0', TRUE);

            /* helper */
            wp_enqueue_script('elm-helper', FlexMap() -> assets . 'js/helper.js', null, '1.0.0', TRUE);
        }

        // --- IMPORT EXPORT PAGE
        if (isset($screen->id) && $screen->id == $this -> slug_name . '_page_import-export')
        {
            /* get map data */
            $options = get_option('mymaps_options');

            if( function_exists('content_url') ) {
                $options['_host_'] = content_url();
            } else {
                $options['_host_'] =  plugins_url('../../',__FILE__);
            }
            $options['_nonce_'] = FlexMap() -> get_ajax_data();
            wp_enqueue_script("jquery");
            wp_enqueue_script('ex-im.admin', FlexMap() -> assets . 'js/ex-im.admin.js', null, '1.0.0', TRUE);
            wp_localize_script('ex-im.admin', 'mapData', $options);
            wp_enqueue_script('ex-im.admin');
            wp_enqueue_style('admin.css',  FlexMap() -> assets . 'css/admin.css');

            /* flip panel*/
            wp_enqueue_style('font-awesome', FlexMap() -> assets . 'css/font-awesome.min.css');
            wp_enqueue_style('common', FlexMap() -> assets . 'css/common.css');
            wp_enqueue_style('map-list', FlexMap() -> assets . 'css/list.css');

            /* Notification*/
            wp_enqueue_style('elm-notifi', FlexMap()->assets . 'elements/notification/jquery.growl.css', null, '1.0.0');
            wp_enqueue_script('elm-notifi-script', FlexMap()->assets . 'elements/notification/jquery.growl.js', null, '1.0.0', TRUE);

            /* Jquery upload */
            wp_enqueue_style('elm-bootstrap', FlexMap() -> assets . 'elements/upload/bootstrap.min.css', null, '1.0.0');
            wp_enqueue_style('elm-fileupload', FlexMap() -> assets . 'elements/upload/jquery.fileupload.css', null, '1.0.0');
            wp_enqueue_script('elm-ui-widget', FlexMap() -> assets . 'elements/upload/jquery.ui.widget.js', null, '1.0.0', TRUE );
            wp_enqueue_script('elm-iframe-transport', FlexMap() -> assets . 'elements/upload/jquery.iframe-transport.js', null, '1.0.0', TRUE );
            wp_enqueue_script('elm-fileupload-script', FlexMap() -> assets . 'elements/upload/jquery.fileupload.js', null, '1.0.0', TRUE );

            /* helper */
            wp_enqueue_script('elm-helper', FlexMap() -> assets . 'js/helper.js', null, '1.0.0', TRUE);
        }

        // -- SETTINGS PAGE
        if (isset($screen->id) && $screen->id == $this -> slug_name . '_page_flex-setting-page')
        {
            wp_enqueue_style('admin.css',  FlexMap() -> assets . 'css/admin.css');

            /* flip panel*/
            wp_enqueue_style('font-awesome', FlexMap() -> assets . 'css/font-awesome.min.css');
            wp_enqueue_style('common', FlexMap() -> assets . 'css/common.css');
            wp_enqueue_style('map-list', FlexMap() -> assets . 'css/list.css');

        }

        if(isset($screen->id) && $screen->id == 'tools_page_ef3-import-and-export') {
            // Style panel script
            wp_enqueue_script('theme_import_scripts', FlexMap() -> assets . 'js/helpers/theme_import_scripts.js', null, '1.0.0', TRUE);
            wp_localize_script('theme_import_scripts', 'ajax_data', FlexMap() -> get_ajax_data());
            wp_enqueue_script('theme_import_scripts');

        }
    }

    /**
     * Loads the image management javascript
     */
    function prfx_image_enqueue() {
        $screen = get_current_screen();
        $this -> slug_name = strtolower( FlexMap() -> pl_name );
        $this -> slug_name = explode( ' ', $this -> slug_name );
        $this -> slug_name = implode( '-', $this -> slug_name );
        /* map post */
        if (isset($screen->id) && $screen->id == $this -> slug_name . '_page_map-post')
        {
            if( function_exists('wp_enqueue_media') ) {
                wp_enqueue_media();
                // Registers and enqueues the required javascript.
                wp_register_script('meta-box-image', FlexMap() -> assets . 'js/meta-box-image.js', array('jquery'));
                wp_localize_script('meta-box-image', 'meta_image',
                    array(
                        'title' => __('Choose or Upload an Image', 'flex-map'),
                        'button' => __('Use this image', 'flex-map'),
                    )
                );
                wp_enqueue_script('meta-box-image');
            }
        }
    }
}
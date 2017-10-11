<?php
class mapShortcode extends mapBootStrapper{

    function __construct() {
        /* Add shortcode */
        add_shortcode( 'flexmap', array($this, 'mymaps_shortcode_func' ) );
        parent::__construct();
    }

    /**
     * Provide an implement for mymaps to render front end of 'mymaps' shortcode
     *
     * @param  array $atts : contain attributes of shortcode
     * @return map_frame : html code of shortcode
     * @since 1.0.0
     */
    function mymaps_shortcode_func( $atts ) {
        global $map_id;

        if(!isset($atts['id'])) exit();
        $map_id[] = (int) $atts['id'];
        $map_data_arr = array();
        $map_data = array();

        $atts = shortcode_atts( array(
            'id' => false,
        ), $atts, FlexMap() -> shortcode );

        if( $options = get_option('mymaps_options') )
        {
            $map_post = $options['_map_posts_'];

            foreach( $map_id as $id ) {
                if( isset($map_post[$id]) && $map_post[$id] != '' ) {
                    $map_data_arr[$id] = $map_post[$id];
                    $map_data_arr[$id]['general'] = json_decode($map_post[$id]['general'], true);
                    $map_data_arr[$id]['markers'] = json_decode($map_post[$id]['markers'], true);

                    /* Checking for shortcode in description to do shortcode before initial google map */
                    if(isset($map_data_arr[$id]['general']['load_shortcode']) && $map_data_arr[$id]['general']['load_shortcode'] === true) {
                        foreach($map_data_arr[$id]['markers'] as $key => $marker) {
                            if($marker['shortcode_in_desc'] === true) {
                                $map_data_arr[$id]['markers'][$key]['description'] = $this->get_shortcode_html($marker['description']);
                            }
                        }
                    }
                }
            }

            $map_data_arr['_nonce_'] = FlexMap() -> get_ajax_data();
            $map_data_arr['ajax_url'] = admin_url( 'admin-ajax.php' );

            if( !empty($map_data_arr) ) {

                $this->shortcode_enqueue_script( $map_data_arr, FlexMap() -> assets );
                return $this->get_template_file__('template.shortcode', ['map_id' => $atts['id']]);
            } else {
                return 'map array null';
            }
        } else {
            return 'cannot show';
        }
    }

    /**
     * @param $shortcode
     * @return string
     */
    function get_shortcode_html($shortcode ) {
        ob_start();
        echo do_shortcode($shortcode);
        return ob_get_clean();
    }

    /**
     * @param $map_data
     * @param $assets
     */
    function shortcode_enqueue_script($map_data, $assets ) {

        wp_enqueue_script('jquery');

        wp_enqueue_script('frontHelpers.js', $assets . 'js/helpers/frontHelpers.js', null, '1.1.0', TRUE);
        wp_localize_script('frontHelpers.js', 'map_data', $map_data);
        wp_enqueue_script('frontHelpers.js');

        $api_key = get_option('api_key', '');
        if(!empty($api_key)) {
            $api_key = 'key=' . $api_key;
        } else {
            $api_key = 'sensor=false';
        }

        wp_enqueue_script('googlemap-script', 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=weather,places&' . $api_key, null, '1.0.0', TRUE);

		//wp_enqueue_script('googlemap-script', 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=weather,places&key=AIzaSyCcE-O1qwuPwxLeSrouVOANb4ZAjo5_-Rc', null, '1.1.0', TRUE);

        wp_enqueue_script('mm.front', $assets . 'js/front.js', null, '1.1.0', TRUE);
        wp_localize_script('mm.front', 'map_data', $map_data);
        wp_enqueue_script('mm.front');

        /* Owl carousel assets */

        if(get_option('owl_carousel', 'checked') == 'checked') {
            wp_enqueue_style('mm-carousel', $assets . 'elements/owl-carousel/owl.carousel.css');
            wp_enqueue_style('mm-theme', $assets . 'elements/owl-carousel/owl.theme.css');
            wp_enqueue_style('mm-trans', $assets . 'elements/owl-carousel/owl.transitions.css');
            wp_enqueue_script('mm-carousel-js', $assets . 'elements/owl-carousel/owl.carousel.min.js', null, '1.0.0', TRUE);
        }

        wp_enqueue_style('mm-shorcode', $assets . 'css/shortcode.css');


        /* snow */
        wp_enqueue_script('mm-fallingsnow-js', $assets . 'elements/bg/fallingsnow_v6.js', null, '1.0.0', TRUE);
    }
}

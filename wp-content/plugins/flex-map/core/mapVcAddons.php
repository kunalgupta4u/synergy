<?php
class mapVcAddons {

    function __construct(){
        add_action( 'vc_before_init', array($this, 'flexmap_shortcode_VC') );
    }

    /**
     * Add shortcode to VC
     */
    public function flexmap_shortcode_VC() {
        $options = get_option('mymaps_options');
        $options  = $options['_map_posts_'];
        $arr_post = array();
        if( is_array($options) && count($options) > 0 ) {
            foreach( $options as $key => $value ) {
                $general = json_decode($value['general']);
                $arr_post[$general -> name . ' - ' . '[flexmap id="' . $key . '"]'] = $key;
            }
        }
        vc_map( array(
            "name" => __( "Flex Map", "flex-map" ),
            "base" => "flexmap",
            "icon" => FlexMap() -> plugin_url . '/img/icon-sm.png',
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Map Post', 'flex-map' ),
                    'param_name' => 'id',
                    'value' => $arr_post
                ),
            ),
        ) );
    }
}

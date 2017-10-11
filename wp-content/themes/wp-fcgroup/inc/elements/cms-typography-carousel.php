<?php
vc_map(array(
    "name" => 'CMS Typography Carousel',
    "base" => "cms_typography_carousel",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'wp-fcgroup'),
    "description" =>  '',
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" =>esc_html__("Style Carousel",'wp-fcgroup'),
            "param_name" => "effect_slide",
             "value" => array(
                    esc_html__( 'Slide', 'wp-fcgroup' ) => 'slide-carousel',
                    esc_html__( 'Fade In', 'wp-fcgroup' ) => 'fade-in-carousel',
                ),
             "group" => __("Slide Setting", 'wp-fcgroup'),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'List Slide', 'wp-fcgroup' ),
            'param_name' => 'values',
            'description' => esc_html__( 'Enter values for slide item', 'wp-fcgroup' ),
            "group" => __("Slide Setting", 'wp-fcgroup'),
            'value' => '',
            'params' => array(
               
                array(
                    "type" => "attach_image",
                    "heading" =>esc_html__("Image Slide",'wp-fcgroup'),
                    "param_name" => "image",
                ),
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Title",'wp-fcgroup'),
                    "param_name" => "title",
                    'std'=>'',
                    'admin_label' => true,
                ),
                array(
                    "type" => "textarea",
                    "heading" =>esc_html__("Description",'wp-fcgroup'),
                    "param_name" => "desc",
                    'std'=>'',
                ),
                array(
                    'type' => 'checkbox',
                    'heading' =>  esc_html__( 'Show Button', 'wp-fcgroup' ),
                    'param_name' => 'show_button',
                ),
                array(
                    "type" => "vc_link",
                    "heading" =>esc_html__("Button Link",'wp-fcgroup'),
                    "param_name" => "link_readmore",
                    'value'=>'',
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => array( 'true' ),
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' =>  esc_html__( 'Color Button', 'wp-fcgroup' ),
                    'param_name' => 'color_button',
                    "value" => array(
                        esc_html__( 'Primary', 'wp-fcgroup' ) => 'cms-primary',
                        esc_html__( 'Danger', 'wp-fcgroup' ) => 'btn-danger',
                        esc_html__( 'Warning', 'wp-fcgroup' ) => 'btn-warning',
                        ),
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => array( 'true' ),
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" =>esc_html__("Caption Align",'wp-fcgroup'),
                    "param_name" => "caption_align",
                     "value" => array(
                            esc_html__( 'Left', 'wp-fcgroup' ) => 'caption-left',
                            esc_html__( 'Right', 'wp-fcgroup' ) => 'caption-right',
                            esc_html__( 'Full', 'wp-fcgroup' ) => 'full-caption',
                        ),
                    'std'=>'',
                ),
            ),
        ),
        
        array(
            'type' => 'checkbox',
            'heading' =>  esc_html__( 'Auto Play', 'wp-fcgroup' ),
            'param_name' => 'auto',
        ),
        array(
            'type' => 'checkbox',
            'heading' =>  esc_html__( 'Show nav', 'wp-fcgroup' ),
            'param_name' => 'nav',
        ),
        array(
            'type' => 'checkbox',
            'heading' =>  esc_html__( 'Show Dots', 'wp-fcgroup' ),
            'param_name' => 'dots',
        ),
    )
));

    if(class_exists('CmsShortCode')) {
        class WPBakeryShortCode_cms_typography_carousel extends CmsShortCode{
            protected function content($atts, $content = null){

                if ( isset( $atts['values'] ) && strlen( $atts['values'] ) > 0 ) {
                    $values = vc_param_group_parse_atts( $atts['values'] );
                    if ( ! is_array( $values ) ) {
                        $temp = explode( ',', $atts['values'] );
                        $paramValues = array();
                        foreach ( $temp as $value ) {
                            $data = explode( '|', $value );
                            
                            $newLine = array();
                            $newLine['title'] = isset( $data[0] ) ? $data[0] : 0;
                            $newLine['label'] = isset( $data[1] ) ? $data[1] : '';
                            if ( isset( $data[1] ) && preg_match( '/^\d{1,3}\%$/', $data[1] ) ) {
                                $colorIndex += 1;
                                $newLine['value'] = (float) str_replace( '%', '', $data[1] );
                                $newLine['label'] = isset( $data[2] ) ? $data[2] : '';
                            }
                            
                            $paramValues[] = $newLine;
                        }

                        $atts['values'] = urlencode( json_encode( $paramValues ) );
                    }
                }
                
                // Enqueued script with localized data.
                wp_enqueue_script( 'cms-typography-carousel' );
                
                return parent::content($atts, $content);
            }
        }
    }
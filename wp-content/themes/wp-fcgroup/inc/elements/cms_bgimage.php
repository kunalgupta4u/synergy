<?php
vc_map(array(
    "name" => 'CMS Special Image',
    "base" => "cms_bgimage",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-fcgroup'),
    "params" => array(
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Select Image", 'wp-fcgroup'),
            "param_name" => "image",
        ),
     
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Background Position", 'wp-fcgroup'),
            "description" => esc_html__('Set background position for image bg', 'wp-fcgroup'),
            "param_name" => "bg_image_position",
            "value" => wp_fcgroup_background_position(),
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Animation Effect", 'wp-fcgroup'),
            "description" => esc_html__('Animation effect', 'wp-fcgroup'),
            "param_name" => "css_animation",
            "value" => wp_fcgroup_animate_lib(),
        ),
     
    )
));
class WPBakeryShortCode_cms_bgimage extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
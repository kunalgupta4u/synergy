<?php
vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Custom Heading Type", 'wp-fcgroup'),
    "admin_label" => true,
    "param_name" => "cms_custom_headding_type",
    "value" => array(
        "Default" => "heading-default",
        "Default Black" => "heading-default-black",
        "Default Robotoblack" => "heading-roboto-black",
        "Default Blue" => "heading-default-blue",
        "Heading with underline" => "heading-underline",
        "Heading with underline top bottom" => "heading-underline-top-bottom",
    ),
    "description" => esc_html__('Select custom heading type', 'wp-fcgroup'),
    "group" => esc_html__("CMS Custom", 'wp-fcgroup')
));

vc_add_param("vc_custom_heading", array(
    "type" => "textarea",
    "class" => "",
    "heading" => esc_html__("Sub heading", 'wp-fcgroup'),
    "param_name" => "cms_custom_sub_headding",
    "description" => esc_html__('Enter sub heading', 'wp-fcgroup'),
    "group" => esc_html__("CMS Custom", 'wp-fcgroup')
));
vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Text transfom heading", 'wp-fcgroup'),
    "param_name" => "cms_custom_text_headding",
    "group" => esc_html__("CMS Custom", 'wp-fcgroup'),
    "value" => array(
        'uppercase' => 'uppercase' ,
        'inherit' => 'inherit',
        'capitalize' => 'capitalize',
        'lowercase' => 'lowercase',
        )
));
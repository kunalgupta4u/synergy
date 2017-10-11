<?php
vc_remove_param('cms_fancybox_single', 'title');
vc_remove_param('cms_fancybox_single', 'description_item');
vc_remove_param('cms_fancybox_single', 'description');
vc_remove_param('cms_fancybox_single', 'content_align');
vc_remove_param('cms_fancybox_single', 'button_type');
vc_remove_param('cms_fancybox_single', 'button_link');
vc_remove_param('cms_fancybox_single', 'button_text');

vc_add_param('cms_fancybox_single', array(
    'type' => 'img',
    'admin_label' => true,
    'heading' => esc_html__( 'Fancy Style', 'wp-fcgroup' ),
    'value' => array(
        'style1' => get_template_directory_uri().'/vc_params/fancybox/fc-fancy-1.png',
        'style2' => get_template_directory_uri().'/vc_params/fancybox/fc-fancy-2.png',
        'style3' => get_template_directory_uri().'/vc_params/fancybox/fc-fancy-3.png',
        'style4' => get_template_directory_uri().'/vc_params/fancybox/fc-fancy-4.png',
        'intro' => get_template_directory_uri().'/vc_params/fancybox/intro.png',
    ),
    'param_name' => 'fancy_style',
    'description' => esc_html__( 'Select fancy style.', 'wp-fcgroup' ),
    'weight' => 1,
    "group" => esc_html__("Template", 'wp-fcgroup'),
));

vc_add_param('cms_fancybox_single', array(
    "type" => "textfield",
    "heading" => esc_html__("Title Item",'wp-fcgroup'),
    "param_name" => "title_item",
    "value" => "",
    "description" => esc_html__("Title Of Item",'wp-fcgroup'),
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style2',
            'style3',
            'style4',
        ),
    ),
));

vc_add_param('cms_fancybox_single', array(
    "type" => "textarea_html",
    "heading" => esc_html__("Content Item",'wp-fcgroup'),
    "param_name" => "content",
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style1',
            'style2',
            'style3',
            'style4',
        ),
    ),
));

vc_add_param("cms_fancybox_single", array(
    "type" => "attach_image",
    "heading" => esc_html__("Image Item", 'wp-fcgroup'),
    "param_name" => "image",
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style2',
            'style3',
            'intro',
        ),
    ),
));


vc_add_param("cms_fancybox_single", array(
    "type" => "attach_image",
    "heading" => esc_html__("Image Icon", 'wp-fcgroup'),
    "param_name" => "image_icon",
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style2',
            'style4',
        ),
    ),
));
vc_add_param("cms_fancybox_single", array(
    "type" => "attach_image",
    "heading" => esc_html__("Image Item Hover", 'wp-fcgroup'),
    "param_name" => "image_icon_hover",
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style4',
        ),
    ),
));


vc_add_param('cms_fancybox_single', array(
    "type" => "textfield",
    "heading" => esc_html__("Extra Class",'wp-fcgroup'),
    "param_name" => "class",
    "value" => "",
    "description" => '',
    "group" => esc_html__("Template", 'wp-fcgroup'),
));

/* Start Icon */
vc_add_param('cms_fancybox_single', array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Icon library', 'wp-fcgroup' ),
    'param_name' => 'icon_type',
    'value' => array(
        esc_html__( 'Font Awesome', 'wp-fcgroup' ) => 'fontawesome',
        esc_html__( 'Elegant Icon', 'wp-fcgroup' ) => 'elegant',
        esc_html__( 'Linea Icons', 'wp-fcgroup' ) => 'lineaicon',
    ),
    'description' => esc_html__( 'Select icon library.', 'wp-fcgroup' ),
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style1',
        ),
    ),
));

vc_add_param('cms_fancybox_single', array(
    'type' => 'iconpicker',
    'heading' => esc_html__( 'Icon Item', 'wp-fcgroup' ),
    'param_name' => 'icon_fontawesome',
    'value' => '',
    'settings' => array(
        'emptyIcon' => true, // default true, display an "EMPTY" icon?
        'type' => 'fontawesome',
        'iconsPerPage' => 200, // default 100, how many icons per/page to display
    ),
    'dependency' => array(
        'element' => 'icon_type',
        'value' => 'fontawesome',
    ),
    'description' => esc_html__( 'Select icon from library.', 'wp-fcgroup' ),
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
));

vc_add_param('cms_fancybox_single', array(
    "type" => "cms_template",
    "param_name" => "cms_template",
    "admin_label" => false,
    "heading" => esc_html__("Shortcode Template",'wp-fcgroup'),
    "shortcode" => "cms_fancybox_single",
    "group" => esc_html__("Template", 'wp-fcgroup'),
));
vc_add_param('cms_fancybox_single',array(
    "type" => "vc_link",
    "heading" => esc_html__("Button Link",'wp-fcgroup'),
    "param_name" => "link_fancy",
    'description' => esc_html__( 'Button Link.', 'wp-fcgroup' ),
    "group" => esc_html__("Fancy Content", 'wp-fcgroup'),
    'dependency' => array(
        'element' => 'fancy_style',
        'value' => array(
            'style3',
            'style4',
            'intro',
        ),
    )
));
vc_add_param("cms_fancybox_single", array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Animate Delay', 'wp-fcgroup' ),
        'param_name' => 'css_animation_delay',
        'value' => wp_fcgroup_animate_time_delay_lib(),
        'description' => esc_html__( 'Select "animation in" for page transition.', 'wp-fcgroup' ),
        "group" => esc_html__("Custom", 'wp-fcgroup'),
    ));
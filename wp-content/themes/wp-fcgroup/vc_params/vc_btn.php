<?php
vc_remove_param('vc_btn', 'i_align');
vc_remove_param('vc_btn', 'css_animation');

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Style', 'wp-fcgroup' ),
    'description' => esc_html__( 'Select button display style.', 'wp-fcgroup' ),
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'Default', 'wp-fcgroup' ) => 'cms-default',
        esc_html__( 'Border button', 'wp-fcgroup' ) => 'cms-border',
        esc_html__( 'Transparent button', 'wp-fcgroup' ) => 'cms-transparent',
        esc_html__( 'Transparent Readmore', 'wp-fcgroup' ) => 'transparent-readmore',
        esc_html__( 'Transparent Readmore Primary', 'wp-fcgroup' ) => 'transparent-readmore primary',
        esc_html__( 'CMS Banner', 'wp-fcgroup' ) => 'cms-banner',
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Color', 'wp-fcgroup' ),
    'param_name' => 'color',
    'description' => esc_html__( 'Select button color.', 'wp-fcgroup' ),
    'value' => array(
            esc_html__( 'White', 'wp-fcgroup' ) => 'default',
            esc_html__( 'Dark', 'wp-fcgroup' ) => 'cms-dark',
            esc_html__( 'Gray', 'wp-fcgroup' ) => 'cms-gray',
            esc_html__( 'Cyan', 'wp-fcgroup' ) => 'cms-cyan',
            esc_html__( 'Violet', 'wp-fcgroup' ) => 'cms-violet',
            esc_html__( 'Blue', 'wp-fcgroup' ) => 'cms-blue',
            esc_html__( 'Teal', 'wp-fcgroup' ) => 'cms-teal',
            esc_html__( 'Green', 'wp-fcgroup' ) => 'cms-green',
            esc_html__( 'Lime', 'wp-fcgroup' ) => 'cms-lime',
            esc_html__( 'Yellow Light', 'wp-fcgroup' ) => 'cms-yellow-light',
            esc_html__( 'Deeporange', 'wp-fcgroup' ) => 'cms-deeporange',
            esc_html__( 'Primary', 'wp-fcgroup' ) => 'cms-primary',
            esc_html__( 'Danger', 'wp-fcgroup' ) => 'cms-danger',
            esc_html__( 'Warning', 'wp-fcgroup' ) => 'cms-warning',
            esc_html__( 'Success', 'wp-fcgroup' ) => 'cms-success',
        ),
    'std' => '',
    'dependency' => array(
        'element' => 'style',
        'value' => array(
            'cms-default',
        ),
    ),
));

vc_add_param("vc_btn", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Size', 'wp-fcgroup' ),
    'param_name' => 'size',
    'description' => esc_html__( 'Select button display size.', 'wp-fcgroup' ),
    'std' => 'md',
    'value' => array(
        esc_html__( 'Large', 'wp-fcgroup' ) => 'lg',
        esc_html__( 'Medium', 'wp-fcgroup' ) => 'md',
        esc_html__( 'Small', 'wp-fcgroup' ) => 'sm',
    )
));


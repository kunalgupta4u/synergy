<?php 
vc_add_param('cms_grid', array(
    'type' => 'checkbox',
    'admin_label' => true,
    'heading' => esc_html__( 'Show Nav', 'wp-fcgroup' ),
    'param_name' => 'checkbox_grid_nav',
    "group" => esc_html__("Grid Settings", 'wp-fcgroup'),
));
vc_add_param("cms_grid", array(
    'type' => 'colorpicker',
    'heading' => esc_html__('Bg color item', 'wp-fcgroup'),
    'param_name' => 'bg_color_item_grid',
    'default' => '#fff',
    "group" => esc_html__("Grid Settings", 'wp-fcgroup'),
));
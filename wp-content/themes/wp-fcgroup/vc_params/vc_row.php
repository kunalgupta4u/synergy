<?php  
vc_add_param('vc_row', array(
	'type' => 'checkbox',
	'heading' => esc_html__("Background Black Color", 'wp-fcgroup'),
	'param_name' => 'bg_black_row',
	'std' => false,
	'group' => esc_html__('Design Options','wp-fcgroup'),
));

vc_add_param('vc_row', array(
    'type' => 'textfield',
    'heading' => esc_html__( 'One Page Offset', 'wp-fcgroup' ),
    'param_name' => 'onepage_offset',
    'value' => '',
    'description' => esc_html__( 'Enter number if you want edit onepage scroll', 'wp-fcgroup' ),
    'group' => 'CMS Custom'
));

vc_add_param('vc_row', array(
    'type' => 'el_id',
    'heading' => esc_html__( 'Row ID', 'wp-fcgroup' ),
    'param_name' => 'el_id',
    'group' => 'CMS Custom',
    'description' => sprintf( esc_html__( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'wp-fcgroup' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
));
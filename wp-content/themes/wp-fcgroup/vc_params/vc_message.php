<?php
vc_add_param("vc_message", array (
	'type' => 'checkbox',
	'heading' => esc_html__( 'Alerts closable ?', 'wp-fcgroup' ),
	'param_name' => 'message_closeable',
	'description' => esc_html__( 'Alerts closable', 'wp-fcgroup' ),
	'value' => array( esc_html__( 'Yes', 'wp-fcgroup' ) => 'yes' ),
	'group' => 'CMS Custom'
));
vc_add_param("vc_message", array (
	'type' => 'checkbox',
	'heading' => esc_html__( 'Remove Icon', 'wp-fcgroup' ),
	'param_name' => 'remove_icon_message',
	'description' => esc_html__( 'Remove Icon.', 'wp-fcgroup' ), 
	'group' => 'CMS Custom'
));

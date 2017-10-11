<?php
	vc_add_param('vc_column', array(
	    'type' => 'checkbox',
	    'heading' => esc_html__("Is Absolute?", 'wp-fcgroup'),
	    'description' => esc_html__("Set this column is position absolute - min-width: 992px", 'wp-fcgroup'),
	    'param_name' => 'column_absolute',
	    'std' => false,
	    'group' => esc_html__('CMS Custom','wp-fcgroup'),
	));
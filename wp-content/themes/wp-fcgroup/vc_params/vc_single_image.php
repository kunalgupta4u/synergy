<?php
	vc_add_param("vc_single_image", array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'CSS Animation', 'wp-fcgroup' ),
		'param_name' => 'css_animation',
		'value' => wp_fcgroup_animate_lib(),
		'description' => esc_html__( 'Select "animation in" for page transition.', 'wp-fcgroup' ),
	));
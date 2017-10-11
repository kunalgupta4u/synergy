<?php 
	vc_add_param("vc_tta_accordion", array(
			'type' => 'dropdown',
			'param_name' => 'color',
			'value' => array('Primary Color' => 'primary_color') + getVcShared( 'colors-dashed' ),
			'heading' => __( 'Color', 'wp-fcgroup' ),
			'description' => __( 'Select accordion color.', 'wp-fcgroup' ),
			'param_holder_class' => 'vc_colored-dropdown',
		));
<?php 
	vc_remove_param('cms_counter_single', 'title');
	vc_remove_param('cms_counter_single', 'description');
	vc_remove_param('cms_counter_single', 'icon_type');
	vc_remove_param('cms_counter_single', 'icon_fontawesome');
	vc_remove_param('cms_counter_single', 'icon_openiconic');
	vc_remove_param('cms_counter_single', 'icon_typicons');
	vc_remove_param('cms_counter_single', 'icon_entypo');
	vc_remove_param('cms_counter_single', 'icon_linecons');
	vc_remove_param('cms_counter_single', 'icon_pixelicons');
	vc_remove_param('cms_counter_single', 'icon_pe7stroke');
	vc_remove_param('cms_counter_single', 'icon_rticon');
	vc_remove_param('cms_counter_single', 'icon_glyphicons');
	vc_remove_param('cms_counter_single', 'suffix');
	vc_remove_param('cms_counter_single', 'prefix');

	vc_add_param('cms_counter_single',array(
            "type" => "attach_image",
            "heading" => esc_html__("Select Background Image Digit", 'wp-fcgroup'),
            "param_name" => "bg_image_counter",
            "group" => esc_html__("Counters Settings", 'wp-fcgroup'),
        )
	);
	
 ?>
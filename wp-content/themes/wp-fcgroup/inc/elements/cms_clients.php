<?php
vc_map(array(
    "name" => 'CMS Clients',
    "base" => "cms_clients",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-fcgroup'),
    "description" => esc_html__('Clients', 'wp-fcgroup'),
    "params" => array(
		array(
		    "type" => "textfield",
		    "heading" => esc_html__("Title ",'wp-fcgroup'),
		    "param_name" => "title",
		    "value" => "",
		),
        array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'wp-fcgroup' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'wp-fcgroup' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'wp-fcgroup' ),
			'param_name' => 'external_img_size',
			'value' => '',
			'description' => esc_html__( 'Enter image size in pixels. Example: 220x100 (Width x Height).', 'wp-fcgroup' ),
		),
        array(
			'type' => 'exploded_textarea_safe',
			'heading' => esc_html__( 'Custom links', 'wp-fcgroup' ),
			'param_name' => 'custom_links',
			'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'wp-fcgroup' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'wp-fcgroup' ),
			'param_name' => 'columns',
			'value' => array(
				'2 Columns' => '2',
				'3 Columns' => '3',
				'4 Columns' => '4',
				'6 Columns' => '6',
			),
			'sdt' => '4',
			'description' => esc_html__( 'Set number columns in per row', 'wp-fcgroup' ),
		),
        array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'wp-fcgroup' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-fcgroup' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'wp-fcgroup' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'wp-fcgroup' ),
		),
    )
));

class WPBakeryShortCode_cms_clients extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
<?php
vc_map(array(
    "name" => 'CMS Callout',
    "base" => "cms_callout",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'wp-fcgroup'),
    "description" => esc_html__('CMS Call to action', 'wp-fcgroup'),
    "params" => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Heading', 'wp-fcgroup' ),
            'admin_label' => true,
            'param_name' => 'callout_heading',
            'value' => '',
            'description' => esc_html__( 'Enter text for heading line.', 'wp-fcgroup' )
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'wp-fcgroup' ),
            'param_name' => 'link',
            'description' => esc_html__( 'Add link to button.', 'wp-fcgroup' ),
        ),
    )
));
class WPBakeryShortCode_cms_callout extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
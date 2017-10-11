<?php 
vc_add_param("vc_column_text", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Style', 'wp-fcgroup' ),
    'description' => esc_html__( 'Select custom text.', 'wp-fcgroup' ),
    'param_name' => 'style_text',
    'value' => array(
        esc_html__( 'Default', 'wp-fcgroup' ) => '',
        esc_html__( 'Blue Text', 'wp-fcgroup' ) => 'cms-blue-text',
        esc_html__( 'Text ul', 'wp-fcgroup' ) => 'cms-ul-text',
        esc_html__( 'Text FAQ', 'wp-fcgroup' ) => 'cms-faq-text',
    ),

));
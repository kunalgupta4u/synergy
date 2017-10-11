<?php
/**
 * Meta box config file
 */
if (! class_exists('MetaFramework')) {
    return;
}

/**
 * get list menu.
 * @return array
 */
function wp_fcgroup_get_nav_menu(){

    $menus = array(
        '' => esc_html__('Default', 'wp-fcgroup')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->term_id] = $obj_menu->name;
    }

    return $menus;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_meta_options'),
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Allow you to start the panel in an expanded way initially.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field
    'disable_save_warn' => true,
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => false,

    'output' => false,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => false,
    // save meta to multiple keys.
    'meta_mode' => 'multiple'
);

// -> Set Option To Panel.
MetaFramework::setArgs($args);

/** page options */
MetaFramework::setMetabox(array(
    'id' => '_page_main_options',
    'label' => esc_html__('Page Setting', 'wp-fcgroup'),
    'post_type' => 'page',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => false,
    'sections' => array(
        array(
            'title' => esc_html__('General', 'wp-fcgroup'),
            'id' => 'tab-general',
            'icon' => 'el el-adjust-alt',
            'fields' => array(
                array(
                    'id' => 'page_general_padding',
                    'title' => esc_html__('At moment, main content got padding top and bottom is 70px', 'wp-fcgroup'),
                    'type' => 'info',
                    'style' => 'success',
                ),
                array(
                    'id' => 'page_general_padding_top',
                    'title' => esc_html__('Set padding top to 0px', 'wp-fcgroup'),
                    'desc' => esc_html__('Enable this option to set padding top of main content is 0px ', 'wp-fcgroup'),
                    'default' => '',
                    'type' => 'switch',
                    'default' => false,
                ),
                array(
                    'id' => 'page_general_padding_bottom',
                    'title' => esc_html__('Set padding bottom to 0px', 'wp-fcgroup'),
                    'desc' => esc_html__('Enable this option to set padding bottom of main content is 0px ', 'wp-fcgroup'),
                    'default' => '',
                    'type' => 'switch',
                    'default' => false,
                ),
                array(
                    'title' => esc_html__('Content background color', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Set background color for content page, default - inherit from theme option', 'wp-fcgroup'),
                    'id' => 'page_general_color',
                    'type' => 'color',
                    'default' => '',
                ),
                array(
                    'id'       => 'button_set_slider',
                    'type'     => 'button_set',
                    'title'    => esc_html__('OWL Slider, Rev Slider , OFF', 'wp-fcgroup'),
                    //Must provide key => value pairs for options
                    'options' => array(
                        '1' => 'OWL Slider', 
                        '2' => 'Rev Slider', 
                        '3' => 'OFF'
                     ), 
                    'default' => '3'
                ),

                array(
                    'id'       => 'header_banner',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Category Slider', 'wp-fcgroup' ),
                    'options'  => array('111111'=>'111','222222'=>'22222'),
                    'default' => '',
                    'required' => array('button_set_slider', '=', '1')
                ),
                array(
                    'id'       => 'header_banner_bg_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Select Background Color Slider', 'wp-fcgroup' ),
                    'default' => '#0f1923',
                    'required' => array('button_set_slider', '=', '1')
                ),
                array(
                    'id'       => 'header_banner_bg_color_phone',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Select Background Color Slider Phone', 'wp-fcgroup' ),
                    'default' => 'rgba(15, 25, 35, 0.6)',
                    'required' => array('button_set_slider', '=', '1')
                ),
                array(
                    'id'       => 'slider_show_nav',
                    'type'     => 'switch', 
                    'title'    => esc_html__( 'Show Nav', 'wp-fcgroup' ),
                    'default'  => true,
                    'required' => array('button_set_slider', '=', '1')
                ),
                array(
                    'id'       => 'slider_show_dots',
                    'type'     => 'switch', 
                    'title'    => esc_html__( 'Show Dots', 'wp-fcgroup' ),
                    'default'  => true,
                    'required' => array('button_set_slider', '=', '1')
                ),
                array(
                    'id'       => 'select_rev_slider',
                    'type'     => 'select',
                    'title'    => esc_html__('Select Rev Slider', 'wp-fcgroup' ), 
                    'options'  =>  wp_fcgroup_get_list_rev_slider(),
                    'default'  => '2',
                    'required' => array('button_set_slider', '=', '2')
                ),
                array(
                    'id'       => 'opt_explore_text',
                    'type'     => 'text',
                    'title'    => esc_html__('Explore the services', 'wp-fcgroup'),
                    'default'  => '',
                    'required' => array('button_set_slider', '=', '1')
                ),
                array(
                    'id'       => 'opt_explore_target',
                    'type'     => 'text',
                    'title'    => esc_html__('Explore the services Target', 'wp-fcgroup'),
                    'default'  => '#services',
                    'required' => array('button_set_slider', '!=', '3')
                ),
            )
        ),
        array(
            'title' => esc_html__('Header', 'wp-fcgroup'),
            'id' => 'tab-page-header',
            'icon' => 'el el-credit-card',
            'fields' => array(
                array(
                    'id' => 'header_layout',
                    'title' => esc_html__('Layouts', 'wp-fcgroup'),
                    'subtitle' => esc_html__('select a layout for header', 'wp-fcgroup'),
                    'default' => '',
                    'type' => 'image_select',
                    'options' => array(
                        '' => get_template_directory_uri().'/assets/images/header/h-default.png',
                    ),
                ),
                array(
                    'id'       => 'header_menu',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Menu', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'custom menu for current page', 'wp-fcgroup' ),
                    'options'  => wp_fcgroup_get_nav_menu(),
                    'default' => '',
                ),
            )
        ),
        array(
            'title' => esc_html__('Page Title & BC', 'wp-fcgroup'),
            'id' => 'tab-page-title-bc',
            'icon' => 'el el-map-marker',
            'fields' => array(
                array(
                    'id'       => 'button_set_pagetitle',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Inherit, Custom , OFF', 'wp-fcgroup'),
                    //Must provide key => value pairs for options
                    'options' => array(
                        '1' => 'Inherit', 
                        '2' => 'Custom', 
                        '3' => 'OFF'
                     ), 
                    'default' => '1'
                ),
             /*   array(
                    'subtitle' => esc_html__('Enable custom Page title & BC.', 'wp-fcgroup'),
                    'id' => 'enable_custom_pagetitle',
                    'type' => 'switch',
                    'title' => esc_html__('Enable', 'wp-fcgroup'),
                    'default' => false,
                ),*/
                array(
                    'id' => 'page_title_layout',
                    'title' => esc_html__('Layouts', 'wp-fcgroup'),
                    'subtitle' => esc_html__('select a layout for page title', 'wp-fcgroup'),
                    'default' => '1',
                    'type' => 'image_select',
                    'options' => array(
                        '1' => get_template_directory_uri().'/assets/images/pagetitle/page-title-df.jpg',
                        '2' => get_template_directory_uri().'/assets/images/pagetitle/page-title-2.jpg',
                    ),
                    'required' => array('button_set_pagetitle', '=', '2')
                ),
                array(
                    'id'       => 'page-title-align',
                    'type'     => 'select',
                    'title'    => esc_html__('Page title align', 'wp-fcgroup' ),
                    'subtitle' => esc_html__('Select page title align: left or center', 'wp-fcgroup' ),
                    'default'    => 'left',
                    'options'  => array(
                        'left' => esc_html__('Align Left', 'wp-fcgroup' ),
                        'center' => esc_html__('Align Center', 'wp-fcgroup' ),
                    ),
                    'required' => array('page_title_layout', '=', '1')
                ),
                array(
                    'id'       => 'page_title_background',
                    'type'     => 'background',
                    'title'    => esc_html__( 'Background', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'page title background with image, color, etc.', 'wp-fcgroup' ),
                    'default'  => array(
                        'background-color' => '#0f1923',
                        'background-repeat' => 'no-repeat',
                        'background-attachment' => 'inherit',
                        'background-position' => 'center center',
                        'background-size' => 'cover',
                        'background-image' => get_template_directory_uri().'/assets/images/blog-2-1.jpg',
                    ),
                    'required' => array('page_title_layout', '=', '2')
                ),
                array(
                    'title' => esc_html__('Page title, BC color', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Set page title color.', 'wp-fcgroup'),
                    'id' => 'page_title_color',
                    'type' => 'color',
                    'default' => '#fff',
                    'required' => array('button_set_pagetitle', '=', '2')
                ),
                array(
                    'title' => esc_html__('OPTIONS FOR BREADCRUMB', 'wp-fcgroup'),
                    'id'   => 'breadcrumb-info',
                    'type' => 'info',
                    'style' => 'success',
                    'required' => array('button_set_pagetitle', '=', '2')
                ),
                array(
                    'title' => esc_html__('Enable Breadcrumb', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Display breadcrumb', 'wp-fcgroup'),
                    'id' => 'enable-breadcrumb',
                    'type' => 'switch',
                    'default' => true,
                    'required' => array('button_set_pagetitle', '=', '2')
                ),
               /* array(
                    'title' => esc_html__('Breadcrumb color', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Set page title color.', 'wp-fcgroup'),
                    'id' => 'breadcrumb_color',
                    'type' => 'color',
                    'required'  => array('enable-breadcrumb', '=', '1'),
                    'default' => '#fff'
                ),*/
                array(
                    'title' => esc_html__('Breadcrumb hover, focus color', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Set breadcrumb color when hover, focus .', 'wp-fcgroup'),
                    'id' => 'breadcrumb_color_hover',
                    'type' => 'color',
                    'required'  => array('enable-breadcrumb', '=', '1'),
                    'default' => '#51c5eb'
                ),
                array(
                    'title' => esc_html__('OPTIONS FOR SUB PAGE TITLE', 'wp-fcgroup'),
                    'id'   => 'sub-page-title-info',
                    'type' => 'info',
                    'style' => 'success',
                    'required' => array('button_set_pagetitle', '=', '2')
                ),
                array(
                    'title' => esc_html__('Enable Sub page title', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Enable sub page title, will appear for all pages', 'wp-fcgroup'),
                    'id' => 'enable-sub-pagetitle',
                    'type' => 'switch',
                    'default' => true,
                    'required' => array('button_set_pagetitle', '=', '2')
                ),
                array(
                    'id'       => 'sub-pagetitle-text',
                    'type'     => 'textarea',
                    'title'    => esc_html__('Sub page title', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Use <br /> for break to new line', 'wp-fcgroup'),
                    'required'  => array('enable-sub-pagetitle', '=', '1')
                ),
            )
        ),
        array(
            'title' => esc_html__('One Page', 'wp-fcgroup'),
            'id' => 'tab-one-page',
            'icon' => 'el el-download-alt',
            'fields' => array(
                array(
                    'subtitle' => esc_html__('Enable one page mode for current page.', 'wp-fcgroup'),
                    'id' => 'page_one_page',
                    'type' => 'switch',
                    'title' => esc_html__('Enable', 'wp-fcgroup'),
                    'default' => false,
                ),
                array(
                    'id'            => 'page_one_page_speed',
                    'type'          => 'slider',
                    'title'         => esc_attr__( 'Speed', 'wp-fcgroup' ),
                    'default'       => 1000,
                    'min'           => 500,
                    'step'          => 100,
                    'max'           => 5000,
                    'display_value' => 'text',
                    'required' => array('page_one_page', '=', 1)
                ),
            )
        ),
        /*footer*/
       
        array(
            'title' => esc_html__('Footer', 'wp-fcgroup'),
            'id' => 'tab-footer-page',
            'icon' => 'el el-download-alt',
            'fields' => array(
                 array(
                    'title' => esc_html__('OPTIONS FOR CALL TO ACTION OF FOOTER', 'wp-fcgroup'),
                    'id'   => 'footer-top-info',
                    'type' => 'info',
                    'style' => 'success',
                ),
                array(
                    'title' => esc_html__('Show CTA', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Show call to action section in footer', 'wp-fcgroup'),
                    'id' => 'show-cta-footer-page',
                    'type' => 'switch',
                    'default' => true
                ),
                array(
                    'id'       => 'footer-cta-bg-page',
                    'type'     => 'background',
                    'title'    => esc_html__( 'Background', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'Set background (image, color..) for footer top', 'wp-fcgroup' ),
                    'default'  => array(
                        'background-color' => '#000',
                        'background-repeat' => 'no-repeat',
                        'background-attachment' => 'inherit',
                        'background-position' => 'center center',
                        'background-size' => 'cover',
                    ),
                    'required'  => array('show-cta-footer-page', '=', '1')
                ),
                array(
                    'id' => 'footer-cta-padding-page',
                    'type' => 'spacing',
                    'mode' => 'padding',
                    'units' => array('px'),
                    'title' => 'Padding',
                    'right' => false,
                    'left' => false,
                    'default' => array(
                        'padding-top'     => '29',
                        'padding-bottom'  => '29',
                    ),
                    'required'  => array('show-cta-footer-page', '=', '1')
                ),
                array(
                    'id'       => 'cta-text-page',
                    'type'     => 'text',
                    'title'    => esc_html__('CTA Title', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Call to action title', 'wp-fcgroup'),
                    'required'  => array('show-cta-footer-page', '=', '1'),
                    'default'  => ''
                ),
                array(
                    'id'       => 'cta-button-page',
                    'type'     => 'text',
                    'title'    => esc_html__('CTA Button Url', 'wp-fcgroup'),
                    /*'validate' => 'url',*/
                    'required'  => array('show-cta-footer-page', '=', '1'),
                    'default'  => ''
                ),
                array(
                    'id'       => 'cta-button-text-page',
                    'type'     => 'text',
                    'title'    => esc_html__('CTA Button Title', 'wp-fcgroup'),
                    'required'  => array('show-cta-footer-page', '=', '1'),
                    'default'  => ''
                )
            )
        ),
    )
));

/** post options */
MetaFramework::setMetabox(array(
    'id' => '_page_post_format_options',
    'label' => esc_html__('Post Format', 'wp-fcgroup'),
    'post_type' => 'post',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'color-Color',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id'       => 'opt-video-type',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Select Video Type', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'Local video, Youtube, Vimeo', 'wp-fcgroup' ),
                    'options'  => array(
                        'local' => esc_html__('Upload', 'wp-fcgroup' ),
                        'youtube' => esc_html__('Youtube', 'wp-fcgroup' ),
                        'vimeo' => esc_html__('Vimeo', 'wp-fcgroup' ),
                    )
                ),
                array(
                    'id'       => 'otp-video-local',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Local Video', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'Upload video media using the WordPress native uploader', 'wp-fcgroup' ),
                    'required' => array( 'opt-video-type', '=', 'local' )
                ),
                array(
                    'id'       => 'opt-video-youtube',
                    'type'     => 'text',
                    'title'    => esc_html__('Youtube', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Load video from Youtube.', 'wp-fcgroup'),
                    'placeholder' => esc_html__('https://youtu.be/iNJdPyoqt8U', 'wp-fcgroup'),
                    'required' => array( 'opt-video-type', '=', 'youtube' )
                ),
                array(
                    'id'       => 'opt-video-vimeo',
                    'type'     => 'text',
                    'title'    => esc_html__('Vimeo', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Load video from Vimeo.', 'wp-fcgroup'),
                    'placeholder' => esc_html__('https://vimeo.com/155673893', 'wp-fcgroup'),
                    'required' => array( 'opt-video-type', '=', 'vimeo' )
                ),
                array(
                    'id'       => 'otp-video-thumb',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Video Thumb', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'Upload thumb media using the WordPress native uploader', 'wp-fcgroup' ),
                    'required' => array( 'opt-video-type', '=', 'local' )
                ),
                array(
                    'id'       => 'otp-audio',
                    'type'     => 'media',
                    'url'      => true,
                    'mode'       => false,
                    'title'    => esc_html__( 'Audio Media', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'Upload audio media using the WordPress native uploader', 'wp-fcgroup' ),
                ),
                array(
                    'id'       => 'opt-gallery',
                    'type'     => 'gallery',
                    'title'    => esc_html__( 'Add/Edit Gallery', 'wp-fcgroup' ),
                    'subtitle' => esc_html__( 'Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'wp-fcgroup' ),
                ),
                array(
                    'id'       => 'opt-quote-title',
                    'type'     => 'text',
                    'title'    => esc_html__('Quote Title', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Quote title or quote name...', 'wp-fcgroup'),
                ),
                array(
                    'id'       => 'opt-quote-content',
                    'type'     => 'textarea',
                    'title'    => esc_html__('Quote Content', 'wp-fcgroup'),
                ),
            )
        ),
    )
));

/** Pricing options */
MetaFramework::setMetabox(array(
    'id' => '_page_pricing_options',
    'label' => esc_html__('Pricing Options', 'wp-fcgroup'),
    'post_type' => 'pricing',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'pricing-option',
            'icon' => 'el el-laptop',
            'fields' => array(
                array(
                    'id'       => 'opt-pricing-doller',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Doller', 'wp-fcgroup' ),
                    'default'    => '$'
                ),
                array(
                    'id'       => 'opt-pricing-numeric',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Numberic', 'wp-fcgroup' ),
                    'default'    => '4'
                ),
                array(
                    'id'       => 'opt-pricing-blur',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Blur', 'wp-fcgroup' ),
                    'default'    => '99'
                ), 
                array(
                    'id'       => 'opt-pricing-time',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Time', 'wp-fcgroup' ),
                    'default'    => 'mo'
                ),
                array(
                    'id'       => 'opt-pricing-button-link',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Button Link', 'wp-fcgroup' ),
                    'default'    => '#'
                ),
                array(
                    'id'       => 'opt-pricing-button-text',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Button Text', 'wp-fcgroup' ),
                    'default'    => 'Order Now'
                ),
                array(
                    'id'       => 'opt-pricing-feature',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Is Feature', 'wp-fcgroup' ),
                    'default'    => '0'
                )
            )
        ),
    )
));

/** Team options */
MetaFramework::setMetabox(array(
    'id' => '_page_team_options',
    'label' => esc_html__('Team Options', 'wp-fcgroup'),
    'post_type' => 'team',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'social-team-option',
            'icon' => 'el el-share-alt',
            'fields' => array(
                array(
                    'id'       => 'opt_switch_socail_team',
                    'type'     => 'switch', 
                    'title'    => esc_html__('Social Team ON / OFF', 'wp-fcgroup'),
                    'default'  => true,
                ),
               array(
                    'id'    => 'face_url_team',
                    'type'  => 'text',
                    'title' => esc_html__('Facebook Url', 'wp-fcgroup'),
                    'required' => array('opt_switch_socail_team','=','1'),
                ),
                array(
                    'id'    => 'twitter_url_team',
                    'type'  => 'text',
                    'title' => esc_html__('Twitter Url', 'wp-fcgroup'),
                    'required' => array('opt_switch_socail_team','=','1'),
                ),
                array(
                    'id' => 'linkedin_url_team',
                    'type' => 'text',
                    'title' => esc_html__('Linkedin', 'wp-fcgroup'),
                    'required' => array('opt_switch_socail_team','=','1'),
                ),
                array(
                    'id'    => 'google_url_team',
                    'type'  => 'text',
                    'title' => esc_html__('Google Url', 'wp-fcgroup'),
                    'required' => array('opt_switch_socail_team','=','1'),
                ),
                array(
                    'id'    => 'role',
                    'type'  => 'text',
                    'title' => esc_html__('Role', 'wp-fcgroup')
                )
            )
        ),
    )
));
/** Testimonial options */
MetaFramework::setMetabox(array(
    'id' => '_page_testimonial_options',
    'label' => esc_html__('Testimonial Options', 'wp-fcgroup'),
    'post_type' => 'testimonial',
    'context' => 'advanced',
    'priority' => 'default',
    'open_expanded' => true,
    'sections' => array(
        array(
            'title' => '',
            'id' => 'testimonial-option',
            'icon' => 'el el-laptop',
            'fields' => array(
               array(
                    'id'    => 'name_testimonial',
                    'type'  => 'text',
                    'title' => esc_html__('Name', 'wp-fcgroup')
                ),
               array(
                    'id'    => 'link_testi',
                    'type'  => 'text',
                    'title' => esc_html__('Url Website', 'wp-fcgroup')
                )
            )
        ),
    )
));
MetaFramework::init();
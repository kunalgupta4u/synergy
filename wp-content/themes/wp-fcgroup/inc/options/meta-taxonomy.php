<?php
/**
 * Meta box config file
 */
if (! class_exists('EF3Taxonomy_meta')) {
    return;
}

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => apply_filters('opt_meta', 'opt_taxonomy_options'),
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
    // hide left panel.
    'open_expanded' => true,
);

// -> Set Option To Panel.
EF3Taxonomy_meta::setArgs($args);

/** page options */
EF3Taxonomy_meta::setMetabox(array(
    'taxonomy' => 'category',
    'sections' => array(
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
                        'default' => get_template_directory_uri().'/assets/images/header/h-style-1.png',
                        'top' => get_template_directory_uri().'/assets/images/header/h-style-2.png'
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
                    'id' => 'page_title_layout',
                    'title' => esc_html__('Layouts', 'wp-fcgroup'),
                    'subtitle' => esc_html__('select a layout for page title', 'wp-fcgroup'),
                    'default' => '5',
                    'type' => 'image_select',
                    'options' => array(
                        '' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-default.png',
                        '1' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-0.png',
                        '2' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-1.png',
                        '3' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-2.png',
                        '4' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-3.png',
                        '5' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-4.png',
                        '6' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-5.png',
                        '7' => get_template_directory_uri().'/assets/images/pagetitle/pt-s-6.png',
                    ),
                ),
                array(
                    'id' => 'page_title_text',
                    'type' => 'text',
                    'title' => esc_html__('Custom Title', 'wp-fcgroup'),
                    'subtitle' => esc_html__('Custom current page title.', 'wp-fcgroup'),
                )
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
                )
            )
        )
    )
));

EF3Taxonomy_meta::init();
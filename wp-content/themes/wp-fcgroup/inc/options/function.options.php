<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (! class_exists('Redux')) {
    return;
}

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('opt_name', 'opt_theme_options');

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => $theme->get('Name'),
    'page_title' => $theme->get('Name'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => false,
    // Use a asynchronous font on the front end or font string
    // 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-smiley',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    // 'open_expanded' => true, // Allow you to start the panel in an expanded way initially.
    // 'disable_save_warn' => true, // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-dashboard',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'dashicons-smiley',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit' => '', // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => ''
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave'
            )
        )
    )
);

Redux::setArgs($opt_name, $args);

/**
 * Header Options
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'wp-fcgroup'),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => esc_html__('Layouts', 'wp-fcgroup'),
            'subtitle' => esc_html__('select a layout for header', 'wp-fcgroup'),
            'default' => 'default',
            'type' => 'image_select',
            'options' => array(
                'default' => get_template_directory_uri().'/assets/images/header/h-default.png',
            )
        ),
        array(
            'title' => 'Select Favicon',
            'id' => 'favicon_icon',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/favicon.png'
            )
        ),
        array(
            'subtitle' => esc_html__('Header height.', 'wp-fcgroup'),
            'id' => 'header_height_id',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => esc_html__('Header height.', 'wp-fcgroup'),
            'default' => array(
                'height' => '105',
            )
        ),
        array(
            'title' => esc_html__('Header background', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set header background', 'wp-fcgroup'),
            'id' => 'header_bg',
            'type' => 'color',
            'default' => '#f3f3f3',
            'output' => array(
                'background-color' => '.cshero-main-header'
            )
        ),
        array(
            'subtitle' => esc_html__('Header height when sticky menu on top.', 'wp-fcgroup'),
            'id' => 'header_height_fixed',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => 'Header height when fixed',
            'default' => array(
                'height' => '70',
            )
        ),
        array(
            'subtitle' => esc_html__('Enable mega menu.', 'wp-fcgroup'),
            'id' => 'mega_menu',
            'type' => 'switch',
            'title' => esc_html__('Mega Menu', 'wp-fcgroup'),
            'default' => false,
        ),
        array(
            'subtitle' => esc_html__('enable sticky mode for menu.', 'wp-fcgroup'),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => esc_html__('Sticky Header', 'wp-fcgroup'),
            'default' => false,
        ),
        /*array(
            'title' => esc_html__('OPTIONS FOR SEARCH ICON', 'wp-fcgroup'),
            'id'   => 'menu_sticky_info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'title' => esc_html__('Enable Search Icon', 'wp-fcgroup'),
            'subtitle' => esc_html__('Display search icon in header.', 'wp-fcgroup'),
            'id' => 'search-icon',
            'type' => 'switch',
            'default' => false,
        )*/
    )
));

/* Logo */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Logo', 'wp-fcgroup'),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('Select Logo', 'wp-fcgroup'),
            'subtitle' => esc_html__('Select an image file for your logo.', 'wp-fcgroup'),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            )
        ),
        array(
            'subtitle' => esc_html__('in pixels.', 'wp-fcgroup'),
            'id' => 'main_logo_height',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => 'Logo Height',
            'output' => array('.cshero-header-logo img'),
            'default' => array(
                'height' => '41',
            )
        ),
        array(
            'subtitle' => esc_html__('in pixels.', 'wp-fcgroup'),
            'id' => 'sticky_logo_height',
            'type' => 'dimensions',
            'width' => false,
            'units' => array( 'px' ), 
            'title' => 'Sticky Logo Height',
            'output' => array('.is-sticky .sticky-desktop .cshero-header-logo img'),
            'default' => array(
                'height' => '40',
            )
        ),
    )
));

/**
 * Page Title
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Title & BC', 'wp-fcgroup'),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id' => 'page_title_layout',
            'title' => esc_html__('Layouts', 'wp-fcgroup'),
            'subtitle' => esc_html__('select a layout for page title', 'wp-fcgroup'),
            'default' => '2',
            'type' => 'image_select',
            'options' => array(
                '1' => get_template_directory_uri().'/assets/images/pagetitle/page-title-df.jpg',
                '2' => get_template_directory_uri().'/assets/images/pagetitle/page-title-2.jpg',
            )
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
            'output'   => array('.page-titile-bg-wrap .page-title-bg'),
            'default'  => array(
                'background-color' => '#0f1923',
                'background-repeat' => 'no-repeat',
                'background-attachment' => 'inherit',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-image' => get_template_directory_uri().'/assets/images/blog-2-1.jpg',
            ),
            'required'  => array('page_title_layout', '>', '1')
        ),
        array(
            'title' => esc_html__('Page title & Breadcrumb color', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set page title color.', 'wp-fcgroup'),
            'id' => 'page_title_color',
            'type' => 'color',
            'default' => '#fff',
            'required'  => array('page_title_layout', '>=', '1'),
            'output' => array('.page-title-text h1, .breadcrumb-text li a')
        ),
        array(
            'title' => esc_html__('OPTIONS FOR BREADCRUMB', 'wp-fcgroup'),
            'id'   => 'breadcrumb-info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'title' => esc_html__('Enable Breadcrumb', 'wp-fcgroup'),
            'subtitle' => esc_html__('Display breadcrumb', 'wp-fcgroup'),
            'id' => 'enable-breadcrumb',
            'type' => 'switch',
            'default' => true,
        ),
       /* array(
            'title' => esc_html__('Breadcrumb color', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set page title color.', 'wp-fcgroup'),
            'id' => 'breadcrumb_color',
            'type' => 'color',
            'output' => array('.page-title-text h1, .breadcrumb-text li a'),
            'required'  => array('enable-breadcrumb', '=', '1'),
            'default' => '#fff'
        ),*/
        array(
            'title' => esc_html__('Breadcrumb current color', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set breadcrumb color when hover, focus .', 'wp-fcgroup'),
            'id' => 'breadcrumb_color_hover',
            'type' => 'color',
            'output' => array('.breadcrumb-text li a:hover, .breadcrumb-text li a:focus, .breadcrumb-text li'),
            'required'  => array('enable-breadcrumb', '=', '1'),
            'default' => '#51c5eb'
        ),
        array(
            'title' => esc_html__('OPTIONS FOR SUB PAGE TITLE', 'wp-fcgroup'),
            'id'   => 'sub-page-title-info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'title' => esc_html__('Enable Sub page title', 'wp-fcgroup'),
            'subtitle' => esc_html__('Enable sub page title, will appear for all pages', 'wp-fcgroup'),
            'id' => 'enable-sub-pagetitle',
            'type' => 'switch',
            'default' => true,
        ),
        array(
            'id'       => 'sub-pagetitle-text',
            'type'     => 'textarea',
            'title'    => esc_html__('Sub page title', 'wp-fcgroup'),
            'subtitle' => esc_html__('Use <br /> for break to new line', 'wp-fcgroup'),
            'required'  => array('enable-sub-pagetitle', '=', '1'),
            'default' => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor aboreet dolore magna aliqua.', 'wp-fcgroup'),

        ),
        /*array(
            'id'       => 'sub-pagetitle-blog',
            'type'     => 'textarea',
            'title'    => esc_html__('Sub page title', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set sub page title, only appear for blog, category, archive, author pages. Use <br /> for break to new line', 'wp-fcgroup'),
            'required'  => array('enable-sub-pagetitle', '=', '1')
        ),*/
    )
));

/**
 * Styling
 * 
 * css color.
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Styling', 'wp-fcgroup'),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => esc_html__('set color main color.', 'wp-fcgroup'),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'wp-fcgroup'),
            'default' => '#51c5eb'
        ),

        array(
            'subtitle' => esc_html__('Set link color', 'wp-fcgroup'),
            'id' => 'link_color',
            'type' => 'link_color',
            'title' => esc_html__('Link Color', 'wp-fcgroup'),
            'active' => false,
            'default'  => array(
                'regular'  => '#0f1923',
                'hover'    => '#51c5eb',
                'visited'  => '#51c5eb', 
            )
        ),
        array(
            'title' => esc_html__('OPTIONS MAIN CONTENT BACKGROUND', 'wp-fcgroup'),
            'id'   => 'main-content-info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id'       => 'main_content_background',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'wp-fcgroup' ),
            'subtitle' => esc_html__( 'Main content background with image, color, etc.', 'wp-fcgroup' ),
            'output'   => array('.site-content'),
            'default'  => array(
                'background-color' => '#f3f3f3',
                'background-repeat' => 'no-repeat',
                'background-attachment' => 'inherit',
                'background-position' => 'center center',
                'background-size' => 'cover',
            ),
        ),
        
    )
));

/**
 * Typography
 * 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'wp-fcgroup'),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'line-height' => false,
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'wp-fcgroup'),
            'default' => array(
                'color' => '#777777',
                'font-weight' => '300',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '14px',
                /*'line-height' => '20px',*/
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('body h1'),
            'units' => 'px',
            'default' => array(
                'color' => '#0f1923',
                'font-weight' => '500',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '40px',
                /*'line-height' => '',*/
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('body h2'),
            'units' => 'px',
            'default' => array(
                'color' => '#0f1923',
                'font-weight' => '700',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '22px',
                /*'line-height' => '',*/
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('body h3'),
            'units' => 'px',
            'default' => array(
                'color' => '#0f1923',
                'font-weight' => '500',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '20px',
                /*'line-height' => '',*/
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('body h4'),
            'units' => 'px',
            'default' => array(
                'color' => '#0f1923',
                'font-weight' => '500',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '18px',
                /*'line-height' => '',*/
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('body h5'),
            'units' => 'px',
            'default' => array(
                'color' => '#0f1923',
                'font-weight' => '500',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '16px',
                /*'line-height' => '',*/
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'line-height' => false,
            'output'  => array('body h6'),
            'units' => 'px',
            'default' => array(
                'color' => '#0f1923',
                'font-weight' => '500',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '10px',
                /*'line-height' => '',*/
                'text-align' => ''
            ),
        )
    )
));

/* extra font. */
$custom_font_1 = Redux::getOption($opt_name, 'google-font-selector-1');
$custom_font_1 = !empty($custom_font_1) ? explode(',', $custom_font_1) : array();

Redux::setSection($opt_name, array(
    'title' => esc_html__('Extra Fonts', 'wp-fcgroup'),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => esc_html__('Custom Font', 'wp-fcgroup'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  =>  $custom_font_1,
            'units' => 'px',
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'wp-fcgroup'),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-weight' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => '',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => esc_html__('Selector 1', 'wp-fcgroup'),
            'subtitle' => esc_html__('add html tags ID or class (body,a,.class,#id)', 'wp-fcgroup'),
            'validate' => 'no_html',
            'default' => '',
        )
    )
));

/**
 * Blog
 * 
 * Archive, Pages, Single, 404, Search, Category, Tags .... 
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Blog', 'wp-fcgroup'),
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'subtitle' => 'Select main content and sidebar alignment.',
            'id' => 'blog_layout',
            'type' => 'image_select',
            'options' => array(
                'full-width' => get_template_directory_uri().'/assets/images/1col.png',
                'right-sidebar' => get_template_directory_uri().'/assets/images/2cr.png',
                'left-sidebar' => get_template_directory_uri().'/assets/images/2cl.png'
            ),
            'title' => 'Blog Layout',
            'default' => 'right-sidebar'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Blog', 'wp-fcgroup'),
    'icon' => 'el-icon-livejournal',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => 'Select main content and sidebar alignment.',
            'id' => 'single_layout',
            'type' => 'image_select',
            'options' => array(
                'full-width' => get_template_directory_uri().'/assets/images/1col.png',
                'right-sidebar' => get_template_directory_uri().'/assets/images/2cr.png',
                'left-sidebar' => get_template_directory_uri().'/assets/images/2cl.png'
            ),
            'title' => 'Post Layout',
            'default' => 'right-sidebar'
        ),
        array(
            'subtitle' => esc_html__('Show Socials Icon at bottom of single post.', 'wp-fcgroup'),
            'id' => 'show_social_post',
            'type' => 'switch',
            'title' =>esc_html__('Show Socials Icon', 'wp-fcgroup'),
            'default' => false
        ),
        array(
            'subtitle'          => esc_html__('Show author.', 'wp-fcgroup'),
            'id'                => 'single_author_post',
            'type'              => 'switch',
            'title'             => esc_html__('Author', 'wp-fcgroup'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show categories.', 'wp-fcgroup'),
            'id'                => 'single_categories_post',
            'type'              => 'switch',
            'title'             => esc_html__('Categories', 'wp-fcgroup'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show tags.', 'wp-fcgroup'),
            'id'                => 'single_tag_post',
            'type'              => 'switch',
            'title'             => esc_html__('Tags', 'wp-fcgroup'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show comment count.', 'wp-fcgroup'),
            'id'                => 'single_comment_post',
            'type'              => 'switch',
            'title'             => esc_html__('Comment', 'wp-fcgroup'),
            'default'           => true,
        ),
        array(
            'subtitle'          => esc_html__('Show view.', 'wp-fcgroup'),
            'id'                => 'single_view_post',
            'type'              => 'switch',
            'title'             => esc_html__('View', 'wp-fcgroup'),
            'default'           => true,
        )
    )
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Page 404', 'wp-fcgroup'),
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'title' => 'Select Logo',
            'subtitle' => 'Select an logo',
            'id' => '404-img-logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo2.png'
            )
        ),
        array(
            'title' => 'Your phone',
            'subtitle' => 'Enter your phone',
            'id' => '404-phone',
            'type' => 'text',
            'default' => '+1 2586 4587 634'
        ),
        array(
            'title' => 'Your email',
            'subtitle' => 'Enter your email',
            'id' => '404-email',
            'type' => 'text',
            'default' => 'info@financegroup.com'
        ),
        array(
            'id' => '404-img-bg',
            'type'     => 'background',
            'title' => 'Select background image',
            'subtitle' => 'Select an background image',
            'default'  => array(
                'background-color' => '#0f1923',
                'background-repeat' => 'no-repeat',
                'background-attachment' => 'inherit',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-image' => get_template_directory_uri().'/assets/images/error-banner.jpg',
            ),
        ),

    )
));
/*
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Login', 'wp-fcgroup'),
    'icon' => 'el el-lock',
    'fields' => array(
        array(
            'title' => 'Select Logo',
            'subtitle' => 'Select an logo',
            'id' => 'login-img-logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo2.png'
            )
        ),
        array(
            'id' => 'login-img-bg',
            'type'     => 'background',
            'title' => 'Select background image',
            'subtitle' => 'Select an background image',
            'default'  => array(
                'background-color' => '#0f1923',
                'background-repeat' => 'no-repeat',
                'background-attachment' => 'inherit',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-image' => get_template_directory_uri().'/assets/images/login-banner.jpg',
            ),
        ),

    )
));*/

/**
 * Footer
 *
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'wp-fcgroup'),
    'icon' => 'el el-website',
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
            'id' => 'show-cta-footer',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'id'       => 'footer-cta-bg',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'wp-fcgroup' ),
            'subtitle' => esc_html__( 'Set background (image, color..) for footer top', 'wp-fcgroup' ),
            'output'   => array('.footer-cta-wrap'),
            'default'  => array(
                'background-color' => '#000',
                'background-repeat' => 'no-repeat',
                'background-attachment' => 'inherit',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-image' => get_template_directory_uri().'/assets/images/support-team.jpg',
            ),
            'required'  => array('show-cta-footer', '=', '1')
        ),
        array(
            'id' => 'footer-cta-padding',
            'type' => 'spacing',
            'output' => array('.footer-cta-inner'),
            'mode' => 'padding',
            'units' => array('px'),
            'title' => 'Padding',
            'right' => false,
            'left' => false,
            'default' => array(
                'padding-top'     => '29',
                'padding-bottom'  => '29',
            ),
            'required'  => array('show-cta-footer', '=', '1')
        ),
        array(
            'id'       => 'cta-text',
            'type'     => 'text',
            'title'    => esc_html__('CTA Title', 'wp-fcgroup'),
            'subtitle' => esc_html__('Call to action title', 'wp-fcgroup'),
            'required'  => array('show-cta-footer', '=', '1'),
            'default' => esc_html__( ' If you have any query for related investment ... We are Available', 'wp-fcgroup' ),
            
        ),
        array(
            'id'       => 'cta-button',
            'type'     => 'text',
            'title'    => esc_html__('CTA Button Url', 'wp-fcgroup'),
            /*'validate' => 'url',*/
            'required'  => array('show-cta-footer', '=', '1'),
            'default' =>'#',
        ),
        array(
            'id'       => 'cta-button-text',
            'type'     => 'text',
            'title'    => esc_html__('CTA Button Title', 'wp-fcgroup'),
            'required'  => array('show-cta-footer', '=', '1'),
            'default' => esc_html__( ' Contact Now', 'wp-fcgroup' ),
        ),
        array(
            'title' => esc_html__('OPTIONS FOR FOOTER BOTTOM (4 columns)', 'wp-fcgroup'),
            'id'   => 'footer-bottom-info',
            'type' => 'info',
            'style' => 'success',
        ),
        array(
            'id'       => 'footer-bottom-column',
            'type'     => 'select',
            'title'    => esc_html__( 'Columns', 'wp-fcgroup' ),
            'subtitle' => esc_html__( 'Select Footer Column', 'wp-fcgroup' ),
            'default'    => 4,
            'options'  => array(
                2 => esc_html__('2 Columns', 'wp-fcgroup' ),
                3 => esc_html__('3 Columns', 'wp-fcgroup' ),
                4 => esc_html__('4 Columns', 'wp-fcgroup' ),
            )
        ),
        array(
            'title' => esc_html__('Custom Columns', 'wp-fcgroup'),
            'subtitle' => esc_html__('Add Col for each column footer', 'wp-fcgroup'),
            'id' => 'show_custom_columns',
            'type' => 'switch',
            'default' => true,
            'required' => array('footer-bottom-column' , 'greater', 1)
        ),
        array(
            'id'       => 'col1',
            'type'     => 'text',
            'title'    => esc_html__('Col 1', 'wp-fcgroup'),
            'required' => array( 
                array('show_custom_columns','=', true), 
            ),
            'default' => 'col-lg-4 col-md-4 col-xs-12'

        ),
        array(
            'id'       => 'col2',
            'type'     => 'text',
            'title'    => esc_html__('Col 2', 'wp-fcgroup'),
            'required' => array( 
                array('show_custom_columns','=', true), 
            ),
              'default' => 'col-lg-2 col-md-3 col-xs-12'
        ),
        array(
            'id'       => 'col3',
            'type'     => 'text', 
            'title'    => esc_html__('Col 3', 'wp-fcgroup'),
            'required' => array( 
                array('show_custom_columns','=', true), 
                array('footer-bottom-column','greater', 2),
            ),
              'default' => 'col-lg-3 col-md-3 col-xs-12'
        ),
        array(
            'id'       => 'col4',
            'type'     => 'text',
            'title'    => esc_html__('Col 4', 'wp-fcgroup'),
            'required' => array( 
                array('show_custom_columns','=', true), 
                array('footer-bottom-column','greater', 3),
            ),
              'default' =>'col-lg-3 col-md-3 col-xs-12'
        ),
        array(
            'id'       => 'footer-bottom-bg',
            'type'     => 'background',
            'title'    => esc_html__( 'Background', 'wp-fcgroup' ),
            'subtitle' => esc_html__( 'Set background (image, color..) for footer', 'wp-fcgroup' ),
            'output'   => array('.footer-bottom-wrap'),
            'default'  => array(
                'background-color' => '#0f1923',
                'background-repeat' => 'no-repeat',
                'background-attachment' => 'inherit',
                'background-position' => 'center center',
                'background-size' => 'cover',
            )
        ),
        array(
            'title' => esc_html__('Select Footer Logo', 'wp-fcgroup'),
            'subtitle' => esc_html__('Select an image file for your footer logo.', 'wp-fcgroup'),
            'id' => 'footer_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/footer-logo.png'
            )
        ),
        array(
            'id' => 'footer-bottom-copyright',
            'type' => 'textarea',
            'title' => esc_html__('Copyright', 'wp-fcgroup'),
            'subtitle' => esc_html__('Enter copyright text for footer bottom', 'wp-fcgroup'),
            'validate' => 'html_custom',
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            ),
            'default' => 'Copyright © FC Group 2017.
All rights reserved.
Created by: <a href="#">Designingmedia</a>',
        ),
        array(
            'id'       => 'footer-bottom-pos',
            'type'     => 'select',
            'title'    => esc_html__('Copyright Columns', 'wp-fcgroup' ),
            'subtitle' => esc_html__('Select copyright (copyright and footer logo) to column position 1 to 4', 'wp-fcgroup' ),
            'default'    => 4,
            'options'  => array(
                1 => esc_html__('Column 1', 'wp-fcgroup' ),
                4 => esc_html__('Column 4', 'wp-fcgroup' ),
            )
        ),
        array(
            'title' => esc_html__('Widget heading color', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set widget heading color.', 'wp-fcgroup'),
            'id' => 'footer-heading-color',
            'type' => 'color',
            'default' => '#fff',
            'output' => array('.footer-bottom-wrap .widget .wg-title')
        ),
        array(
            'title' => esc_html__('Footer text color', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set footer text color.', 'wp-fcgroup'),
            'id' => 'footer-text-color',
            'type' => 'color',
            'default' => '#c3c8cb',
            'output' => array('.footer-bottom-wrap')
        ),
        array(
            'title' => esc_html__('Footer link color', 'wp-fcgroup'),
            'subtitle' => esc_html__('Set footer link color.', 'wp-fcgroup'),
            'id' => 'footer-link-color',
            'type' => 'link_color',
            'visited' => false,
            'output' => array('#footer-bottom-wrap a'),
            'default' => array(
                'regular'  => '#c3c8cb',
                'hover'    => '#51c5eb',
                'active'   => '#51c5eb',
            )
        ),
        array(
            'title' => esc_html__('Show Social Footer', 'wp-fcgroup'),
            'id' => 'show_social_footer',
            'type' => 'switch',
            'default' => true,
        ),
        array(
            'id' => 'footer-bottom-padding',
            'type' => 'spacing',
            'output' => array('.footer-bottom-wrap'),
            'mode' => 'padding',
            'units' => array('px'),
            'title' => 'Padding',
            'right' => false,
            'left' => false,
            'default' => array(
                'padding-top'     => '70',
                'padding-bottom'  => '35',
            ),
        ),
    )
));

/**
 * Social 
 * 
 * Lists individual social
 * @author Duong Tung
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Individual Socials', 'wp-fcgroup'),
    'icon' => 'el el-share',
    'fields' => array(
        array(
            'id'    => 'individual_social_info',
            'type'  => 'info',
            'style' => 'success',
            'title' => esc_html__('Individual Socials Lists', 'wp-fcgroup'),
            'desc'  => esc_html__( 'Set link for social', 'wp-fcgroup'),
        ),
        array(
            'id' => 'facebook',
            'type' => 'text',
            'title' => esc_html__('Facebook Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'twitter',
            'type' => 'text',
            'title' => esc_html__('Twitter Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'rss',
            'type' => 'text',
            'title' => esc_html__('Rss Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'instagram',
            'type' => 'text',
            'title' => esc_html__('Instagram Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'google',
            'type' => 'text',
            'title' => esc_html__('Google Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'skype',
            'type' => 'text',
            'title' => esc_html__('Skype Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'linkedin',
            'type' => 'text',
            'title' => esc_html__('Linkedin', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'pinterest',
            'type' => 'text',
            'title' => esc_html__('Pinterest Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'vimeo',
            'type' => 'text',
            'title' => esc_html__('Vimeo Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'youtube',
            'type' => 'text',
            'title' => esc_html__('Youtube Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'yelp',
            'type' => 'text',
            'title' => esc_html__('Yelp Url', 'wp-fcgroup'),
            'default' => '#',
        ),
        array(
            'id' => 'tumblr',
            'type' => 'text',
            'title' => esc_html__('Tumblr Url', 'wp-fcgroup'),
            'default' => '#',
        ),

        array(
            'id'    => 'individual_social_on_footer_info',
            'type'  => 'info',
            'style' => 'success',
            'title' => esc_html__('List social will show in footer', 'wp-fcgroup'),
        ),
        array(
            'id'      => 'individual_social_on_footer',
            'type'    => 'sorter',
            'title'   => 'Footer socials',
            'options' => array(
                'enabled'  => array(
                    'facebook' => esc_html__('Facebook', 'wp-fcgroup'),
                    'twitter'     => esc_html__('Twitter', 'wp-fcgroup'),
                    'linkedin'     => esc_html__('Linkedin', 'wp-fcgroup'),
                    'google' => esc_html__('Google', 'wp-fcgroup'),
                ),
                'disabled' => array(
                    'instagram' => esc_html__('Rss', 'wp-fcgroup'),
                    'skype' => esc_html__('Skype', 'wp-fcgroup'),
                    'vimeo' => esc_html__('Vimeo', 'wp-fcgroup'),
                    'yelp' => esc_html__('Yelp', 'wp-fcgroup'),
                    'tumblr' => esc_html__('Tumblr', 'wp-fcgroup'),
                    'rss' => esc_html__('Rss', 'wp-fcgroup'),
                    'youtube' => esc_html__('Youtube', 'wp-fcgroup'),
                    'pinterest' => esc_html__('Pinterest', 'wp-fcgroup'),
                )
            ),
        ),
    )
));

/**
 * Woocommerce
 * 
 * Optimal options for theme. optimal speed
 * @author DieuLinh
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Woocommerce', 'wp-fcgroup'),
    'icon' => 'el el-shopping-cart',
    'fields' => array(
        array(
            'subtitle' => 'Shop List Sidebar Left, Shop List Sidebar Right, Full Width',
            'id' => 'woo_layout',
            'type' => 'image_select',
            'default' => 'left-sidebar',
            'options' => array(
                'full-width' => get_template_directory_uri().'/assets/images/1col.png',
                'right-sidebar' => get_template_directory_uri().'/assets/images/2cr.png',
                'left-sidebar' => get_template_directory_uri().'/assets/images/2cl.png'
            ),
            'title' => esc_html__('Shop Layout', 'wp-fcgroup'),
        ),
        array(
            'id'       => 'woo_column',
            'type'     => 'select',
            'title'    => esc_html__('Select Column', 'wp-fcgroup'), 
            'options'  => array(
                '2' => '2',
                '3' => '3',
                '4' => '4'
            ),
            'default'  => '3',
        ),
        array(
            'id' => 'woo_item_per_page',
            'type' => 'slider',
            'title' => esc_html__('Select Item Page', 'wp-fcgroup'),
            "default" => 9,
            "min" => 0,
            "step" => 1,
            "max" => 30,
            'display_value' => 'text'
        ),
 
    )
));
/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author Fox
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Optimal Core', 'wp-fcgroup'),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => esc_html__('no minimize , generate css over time...', 'wp-fcgroup'),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => esc_html__('Dev Mode (not recommended)', 'wp-fcgroup'),
            'default' => false
        )
    )
));
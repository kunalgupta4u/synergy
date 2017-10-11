<?php
class mapPage extends mapBootStrapper {

    function __construct() {
        /* hook to creating a multi-level administration menu */
        add_action( 'admin_menu', array($this, 'flex_admin_menu' ) );
        parent::__construct();
    }

    /**
     * Provide an implementation for the mymap_admin_menu from admin_menu hook
     * to creating a multi-level administration menu
     *
     * since 1.0.0
     */
    function flex_admin_menu()
    {
        $this -> slug_name          = strtolower( FlexMap() -> pl_name );
        $this -> slug_name          = explode( ' ', $this -> slug_name );
        $this -> slug_name          = implode( '-', $this -> slug_name );
        // Create top-level menu item
        add_menu_page(
            'My Maps Configuration Page',
            __( FlexMap() -> pl_name , 'flex-map'),
            'manage_options',
            $this -> slug_name . '-main-menu',
            array($this, 'maps_main_page'),
            FlexMap() -> plugin_url . '/img/icon-sm.png'
        );

        // Create a sub-menu under the top-level menu
        add_submenu_page(
            $this -> slug_name . '-main-menu',
            __('All Maps', 'flex-map'),
            __('All Maps', 'flex-map'),
            'manage_options',
            $this -> slug_name . '-main-menu',
            array($this, 'maps_main_page')
        );

        $title = 'Add A New Map Post';
        if(isset($_GET['edit_map']))
            $title = 'Edit Map - ' . $_GET['edit_map'];

        /* map post */
        add_submenu_page(
            $this -> slug_name . '-main-menu',
            $title,
            esc_html__('Map Post', 'flex-map'),
            'manage_options',
            'map-post',
            array($this, 'map_post_page')
        );

        /* backup page */
        add_submenu_page(
            $this -> slug_name . '-main-menu',
            __('Import / Export', 'flex-map'),
            __('Import / Export', 'flex-map'),
            'manage_options',
            'import-export',
            array($this, 'import_export_page')
        );

        /* backup page */
        add_submenu_page(
            $this -> slug_name . '-main-menu',
            __('Flex Map Settings', 'flex-map'),
            __('Settings', 'flex-map'),
            'manage_options',
            'flex-setting-page',
            array($this, 'flex_setting_page')
        );

    }

    /**
     * Initial Settings Page
     *
     */
    function flex_setting_page() {
        $default_data = array(
            'owl_carousel'          => 'checkbox',
            'api_key'                          => 'text'
        );
        $objMapData = new mapData();
        $map_data = $objMapData->get_field_values($default_data, $_REQUEST);

        $this->get_template_file_e(
            'template.mapSettings'
        );
    }


    /**
     * Render the Import Export page
     */
    function import_export_page() {
        $this->get_template_file_e(
            'template.importExportPage'
        );
    }

    /**
     *  Render the Main Page
     */
    function maps_main_page()
    {
        $this->get_template_file_e(
            'template.mapList'
        );

    }

    /**
     * Add 'Add Maps' submenu page
     *
     * since 1.0.0
     */
    function map_post_page() {

        $map_data = array();

        if(isset($_GET['edit_map']) && is_numeric($_GET['edit_map']))
        {
            if( $options = get_option('mymaps_options') )
            {
                $map_data                 = $options['_map_posts_'];
                $map_data                 = $map_data[$_GET['edit_map']];
                $map_data['_post_id_']    = $_GET['edit_map'];
                $map_data['_shortcode_']  = 'flexmap';
            }
        }

       // wp_editor( '', 'addmarker_description', array('textarea_name' => 'addmarker_description', 'textarea_rows' => 10) );
       // Render html page
        $this->get_template_file_e(
            'template.mapPost',
            array(
                'map_data' => $map_data
            )
        );
    }
}

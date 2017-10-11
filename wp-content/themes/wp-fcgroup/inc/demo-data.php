<?php
/**
 * demo data.
 *
 * config.
 */
add_filter('ef3-theme-options-opt-name', 'wp_fcgroup_set_demo_opt_name');

function wp_fcgroup_set_demo_opt_name(){
    return 'opt_theme_options';
}

add_filter('ef3-replace-content', 'wp_fcgroup_replace_content', 10 , 2);

function wp_fcgroup_replace_content($replaces, $attachment){
    return array(
        //'/image="(.+?)"/' => 'image="'.$attachment.'"',
        '/tax_query:/' => 'remove_query:',
        '/categories:/' => 'remove_query:',
        //'/src="(.+?)"/' => 'src="'.ef3_import_export()->acess_url.'ef3-placeholder-image.jpg"'
    );
}

add_filter('ef3-replace-theme-options', 'wp_fcgroup_replace_theme_options');

function wp_fcgroup_replace_theme_options(){
    return array(
        'dev_mode' => 0,
    );
}
add_filter('ef3-enable-create-demo', 'wp_fcgroup_enable_create_demo');

function wp_fcgroup_enable_create_demo(){
    return true;
}

/**
 * Set custom menu for sidebar
 * @return string[]
 * @author FOX
 */
function wp_fcgroup_update_widget_data_for_menu() {
    $settings = array(
        'sidebar-footer-bottom-2' => array('Our services'),
    );
    if(!empty($settings)){
        foreach($settings as  $sbarid =>$nav_arr_name){
            // get menu id unassign
            $sidebars_widgets = wp_get_sidebars_widgets();
            $widget_ids = $sidebars_widgets[$sbarid];
            
            if( !$widget_ids ) {
                return ;
            }
            $icr=0;
            foreach( $widget_ids as $id ) {
                $wdgtvar = 'widget_'._get_widget_id_base( $id );
                $idvar = _get_widget_id_base( $id );
                $instance = get_option( $wdgtvar );
                $idbs = str_replace( $idvar.'-', '', $id );
                if(isset($instance[$idbs]['nav_menu'])){
                    // get current menu id
                    $nav = wp_get_nav_menu_object($nav_arr_name[$icr]);
                    $mn_id = $nav->term_id;
                    // update menu id to widget
                    $instance[$idbs]['nav_menu'] = $mn_id;
                    update_option( $wdgtvar, $instance );
                    $icr++;
                }
            }   
        }   
    }
}
add_action('ef3-import-finish','wp_fcgroup_update_widget_data_for_menu');
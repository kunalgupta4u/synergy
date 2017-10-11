<?php


if(!function_exists('mymaps_tabs')) {
    function mymaps_tabs( $tabs_array ) {

        $contents = $frame_tab  = ''; $tab_name_array = array();
        echo '<div class="mymaps-tabs tabs-frame mymaps-effect-fade' . $tabs_array['frame_name'] . '">';

        if(has_filter('add_flexmap_post_tab')) {
            $tabs_array = apply_filters('add_flexmap_post_tab', $tabs_array);
        }


        foreach( $tabs_array as $frame_tab => $tabs_properties )
        {
            /* Check is frame name*/
            if( $frame_tab == 'frame_name' )
            {
                $frame_name = $tabs_properties;

            } else {

                /* Check the element that contain tab's properties is array */
                if( is_array($tabs_properties) )
                {
                    /* Check tab's property to get value */
                    $tab_id_class = $frame_tab;
                    $checked = ( isset($tabs_properties['checked']) && $tabs_properties['checked'] == 'true' )? ' checked="checked" ' : '';
                    $icon = ( isset($tabs_properties['icon']) && $tabs_properties['icon'] != '')? $tabs_properties['icon'] : '';
                    $name = ( isset($tabs_properties['tab_name']) && $tabs_properties['tab_name']!= '')? $tabs_properties['tab_name'] : '';
                    $label = ( isset($tabs_properties['tooltips']) && $tabs_properties['tooltips']!='' )? '<div class="text">'.$tabs_properties['tooltips'] . '</div>': '';
                    $label_class = ( isset($tabs_properties['tooltips']) )? 'class="tooltips"': '';
                    $tab_value = (isset($tabs_properties['tab_value'])) ? $tabs_properties['tab_value']: uniqid();

                    /* push to tab name array to generate css code */
                    $tab_name_array[] = $frame_tab;
                    if( $tab_id_class != '' )
                    {
                        echo '
                        <input type="radio" id="' . esc_attr($tab_id_class) . '" class="' . esc_attr($tab_id_class) . '" name="' . esc_attr($frame_name) . '" value="' . esc_attr($tab_value) . '" ' . $checked . '>
                                <label for="' . esc_attr($tab_id_class) . '" ' . $label_class . '>
                                ' . $label . '
                                  <span>' . $icon . $name .'</span>
                                </label>';
                    }
                }
            }
        }
        echo '<ul>';
        /* Foreach content */

        foreach( $tabs_array as $frame_tab => $tabs_properties )
        {
            /* Check is frame name*/
            if( $frame_tab == 'frame_name' )
            {
                $frame_name = $tabs_properties;
            } else {

                /* Check the element that contain tab's properties is array */
                if( is_array($tabs_properties) )
                {
                    /* Check tab's property to get value */
                    $tab_id_class = $frame_tab;
                    $name = ( isset($tabs_properties['tab_name']) && $tabs_properties['tab_name']!= '')? $tabs_properties['tab_name'] : '';
                    /* push to tab name array to generate css code */
                    $tab_name_array[] = $frame_tab;
                    if( $tab_id_class != '' )
                    {
                        /*************
                         * GET CONTENT
                         *************/
                        /* Extract to get rows array in tab */
                        if( isset( $tabs_properties['rows'] ) && is_array( $tabs_properties['rows'] ) )
                        {
                            /* (Begin content tag) */
                            echo '<li class="' . esc_attr( $tab_id_class ) . '">';

                            /* Extract to get each row */
                            foreach( $tabs_properties['rows'] as $row )
                            {
                                /* Use blah function to handle each row */
                                print_each_row( $row );
                            }
                            echo '</li>';
                        }
                    }
                }
            }
        }
        echo '</ul>';
        echo '<div class="waiting-style-map" title="1">
                  <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                  <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z" transform="rotate(30 25 25)">
                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"></animateTransform>
                    </path>
                  </svg>
                </div>';
        echo '</div>';
        echo generate_css( $tab_name_array );

    }
}




/**
     * Generate css for each tab
     * @param $tab_name_array
     * @return string
     */
if(!function_exists('generate_css')) {
    function generate_css( $tab_name_array )
    {
        $tab_name_none = '';
        $css = '<style>';
        foreach( $tab_name_array as $key => $tab_name )
        {
            $comma_first = ($key < (count($tab_name_array)- 1) )? ',' : '';
            $tab_name_none .= '.mymaps-tabs.mymaps-effect-none .' . $tab_name . ':checked ~ ul > .' . $tab_name . $comma_first;

            $css .= '.mymaps-tabs .' . $tab_name . ':checked ~ ul > .' . $tab_name . $comma_first;
        }
        $css .= '{
            position: relative;
            visibility: visible;
            -ms-transform: translate(0, 0) scale(1);
            -webkit-transform: translate(0, 0) scale(1) rotateX(0) rotateY(0);
            transform: translate(0, 0) scale(1) rotateX(0) rotateY(0);
            opacity: 1;
            top: 0;
            left: 0;
            -webkit-transition: 0.6s opacity 0.2s ease, 0.6s -webkit-transform 0.2s ease, 0.6s visibility 0.2s ease, 0s top ease, 0s left ease;
            transition: 0.6s opacity 0.2s ease, 0.6s transform 0.2s ease, 0.6s visibility 0.2s ease, 0s top ease, 0s left ease;
        }
        ';

        $css .= '.mymaps-tabs.mymaps-effect-none > ul > li,';
        $css .= $tab_name_none;
        $css .= '{
                    -webkit-transition: none;
                    transition: none;
                }
            </style>';
        return $css;
    }
}

if(!function_exists('print_each_row')) {
    function print_each_row( $row )
    {

        $row['wrap-layout-class'] = (isset($row['wrap-layout-class'])) ? $row['wrap-layout-class'] : '';
        $row['col-class'] = (isset($row['col-class'])) ? $row['col-class'] : '';


        if( is_array( $row ) )
        {
            /* (Begin row) */
            echo '<div class="mymaps-row ' . $row['wrap-layout-class'] . ' ">';

            /* Check layout */
            if ( isset( $row['layout']) && isset($row['params']) )
            {

                /* Extract layout */
                $layout_cols = extract_layout($row['layout']);

                /* Use function to print params in each columns of layout */
                foreach($layout_cols as $col_pos => $col_number )
                {
                    echo '<div class="mymaps-col c-' . (int) $col_number . ' ' . $row['col-class'] . '">';

                    /* Extract params */
                    foreach ( $row['params'] as $param_properties )
                    {
                        print_params( $param_properties['type'], $param_properties, $col_pos );
                    }

                    echo '</div>';
                }
            }
            /* (End row) */
            echo '</div>';
        }
    }
}

/**
 * Rendering param's html code depend on field type
 *
 * since 1.0.0
 * @param string $param_type
 * @param array $param_properties
 * @return string $render
 */
if(!function_exists('print_params')) {
    function print_params( $param_type, $param_properties, $col_pos = 0)
    {
        $bootstrap = new mapBootStrapper();
        if( ( (int)$param_properties['col_pos'] == $col_pos ) || ($col_pos == 0 && !isset($param_properties['col_pos']) ) )
        {

            $bootstrap -> get_template_file_e( 'template.params.' . $param_type, array('param_properties' => $param_properties));
        }
    }
}

/**
 * Extract layout from string
 *
 * @param string $layout_str
 * @return array $layout_arr
 */
if(!function_exists('extract_layout')) {
    function extract_layout( $layout_str )
    {
        $layout_str = trim($layout_str, '/');
        if( strpos( $layout_str, '/') === false )
        {
            if( is_numeric( $layout_str ) )
            {
                return array( $layout_str );
            }
        } else {
            $layout_arr = explode('/', $layout_str);
            $layout_arr = array_filter($layout_arr);
            if( count($layout_arr) > 0 )
            {
                return $layout_arr;
            } else {
                return false;
            }
        }

    }
}


if (!function_exists('generate_admin_field')) {

    function generate_admin_field($field_type, $attribute, $request = array())
    {

        $attrs = array_merge(array(
            'name'        => '',
            'id'          => '',
            'class'       => '',
            'placeholder' => '',
            'default'     => '',
            'style'       => '',
            'cols'        => '',
            'rows'        => 10

        ), array_filter($attribute));

        if (isset($request[$attrs['name']])) {
            $value = $request[$attrs['name']];
        } else if (get_option($attrs['name'], '')) {
            $value = get_option($attrs['name'], '');
        } else {
            $value = $attrs['default'];
        }

        switch ($field_type) {
            case 'text':
                ?>
                <input type="text"
                       name="<?php echo $attrs['name']; ?>"
                       id="<?php echo $attrs['id']; ?>"
                       class="<?php echo $attrs['class']; ?>"
                       value="<?php echo $value; ?>"
                       placeholder="<?php echo $attrs['placeholder']; ?>"
                >
                <?php
                break;
            case 'checkbox' :
                if($value !== true)
                    $value = 'checked';
                ?>
                <div class="can-toggle demo-rebrand-2">
                    <input
                        id="<?php echo $attrs['id']; ?>"
                        name="<?php echo $attrs['name']; ?>"
                        type="checkbox"
                        <?php
                        echo $value;
                        ?>
                        value="1"
                    >
                    <label for="<?php echo $attrs['id']; ?>">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
                <?php
                break;
            case 'textarea' :
                ?>
                <textarea name="<?php echo $attrs['name']; ?>" id="<?php echo $attrs['id']; ?>"
                          rows="<?php echo $attrs['rows']; ?>" style="<?php echo $attrs['style']; ?>"><?php echo $value; ?></textarea>
                <?php
                break;
            case 'radio' :
                break;

        }
    }
}
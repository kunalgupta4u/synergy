<?php
    $options = get_option('mymaps_options');
    if( isset($_GET['edit_map']) ) {
        $name = 'Loading...';
        $id   = (int) $_GET['edit_map'];
    } else if( isset($options['_map_posts_']) && is_array($options['_map_posts_'])){
        $array_id_keys = array_keys( $options['_map_posts_'] );
        $id = (int) end($array_id_keys) + 1;
        $name   = 'Flex Map ' . $id;
    } else {
        $name = 'Flex Map 1';
        $id   = 1;
    }
?>

<table class="field-container">
        <tr>
            <td><?php esc_html_e('Map Name', 'flex-map'); ?>: </td>
            <td><input type="text" name="map_name" id="map_name" value="<?php esc_html_e($name); ?>"/></td>
        </tr>
        <tr>
            <td><?php esc_html_e('Short Code', 'flex-map'); ?>: </td>
            <td><input type="text" name="short_code" id="short_code" readonly value="[flexmap id='<?php echo $id; ?>']"/></td>
        </tr>
        <tr>
            <td><?php esc_html_e('Extra Class', 'flex-map'); ?>: </td>
            <td><input type="text" name="extra_class" id="extra_class" value=""/></td>
        </tr>
        <tr class="mapLayout">
            <td><?php esc_html_e('Map Layout', 'flex-map'); ?>: </td>
            <td>
                <span>
                    <input name="map_layout" id="map_layout_cus" type="radio" value="cus" checked/>
                    <label for="map_layout_cus"><?php esc_html_e('Custom', 'flex-map'); ?></label>
                </span>
                <span>
                    <input name="map_layout" id="map_layout_res" type="radio" value="res"/>
                    <label for="map_layout_res"><?php esc_html_e('Auto Responsive', 'flex-map'); ?></label>
                </span>
            </td>
        </tr>
        <tr class="heightUn hidden">
            <td><label for="height_unlimited"><?php esc_html_e('Height Unlimited', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="height_unlimited" name="height_unlimited" type="checkbox" value="1" >
                    <label for="height_unlimited">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr class="widthTr">
            <td><?php esc_html_e('Width', 'flex-map'); ?>: </td>
            <td>
                <input name="map_width" id="map_width" class="small-box" type="text" value=""/>
                <select name="unit_width" id="unit_width">
                    <option value="px"><?php esc_html_e('px', 'flex-map'); ?></option>
                    <option value="%">%</option>
                </select>
            </td>
        </tr>
        <tr class="heightTr">
            <td>
                <?php esc_html_e('Height', 'flex-map'); ?>:
            </td>
            <td>
                <input name="map_height" class="small-box" id="map_height" type="text" value=""/>
                <select name="unit_height" id="unit_height">
                    <option value="px">px</option>
                    <option value="%">%</option>
                </select>
            </td>
        </tr>
        <!-- Current state -->
        <tr class="zoomTr">
            <td><?php esc_html_e('Zoom', 'flex-map'); ?>: </td>
            <td>
                <input type="hidden" id="map-zoom-hidden" value="0"/>
                <div id="map-zoom-result">0</div>
                <div id="map-zoom"></div>
            </td>
        </tr>
        <tr>
            <td><?php esc_html_e('Map type', 'flex-map'); ?>: </td>
            <td><select name="curMapType" id="curMapType">
                <option value="ROADMAP"><?php esc_html_e('ROADMAP', 'flex-map'); ?></option>
                <option value="TERRAIN"><?php esc_html_e('TERRAIN', 'flex-map'); ?></option>
                <option value="SATELLITE"><?php esc_html_e('SATELLITE', 'flex-map'); ?></option>
                <option value="HYBRID"><?php esc_html_e('HYBRID', 'flex-map'); ?></option>
            </select>
            </td>
        </tr>
        <tr>
            <td><label for="search_box"><?php esc_html_e('Search Box', 'flex-map'); ?>:</label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="search_box" name="search_box" type="checkbox" value="1" >
                    <label for="search_box">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
                <i class="tips"><?php esc_html_e('Enable for show the search box in map frame at front end', 'flex-map'); ?></i>
            </td>
        </tr>
        <tr>
            <td><label for="map_legend"><?php esc_html_e('Map Legend', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="map_legend" name="map_legend" type="checkbox" value="1" >
                    <label for="map_legend">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>

        <!-- Map options -->
        <tr class="draggable">
            <td><label for="draggable"><?php esc_html_e('Draggable All Devices', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="draggable" name="draggable" type="checkbox" value="1" checked="checked">
                    <label for="draggable">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr class="drMobile">
            <td><label for="dr_mobile"><?php esc_html_e('Dragable Mobile', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="dr_mobile" name="dr_mobile" type="checkbox" value="1" checked="checked">
                    <label for="dr_mobile">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td><label for="scroll_wheel"><?php esc_html_e('Scroll Wheel', 'flex-map'); ?>:</label> </td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="scroll_wheel" name="scroll_wheel" type="checkbox" value="1" checked="checked">
                    <label for="scroll_wheel">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td><label for="scroll_wheel"><?php esc_html_e('Double Click Zoom', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="double_click_zoom" name="double_click_zoom" type="checkbox" value="1" checked="checked">
                    <label for="double_click_zoom">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <!-- Default UI -->
        <tr class="defaultUI">
            <td><label for="df_ui"><?php esc_html_e('Default UI', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="df_ui" name="df_ui" type="checkbox" value="1" >
                    <label for="df_ui">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr class="scaleCt hidden">
            <td><label for="scale_control"><?php esc_html_e('Scale Control', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="scale_control" name="scale_control" type="checkbox" value="1" >
                    <label for="scale_control">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr class="zoomCt hidden">
            <td><label for="zoom_control"><?php esc_html_e('Zoom Control', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="zoom_control" name="zoom_control" type="checkbox" value="1" >
                    <label for="zoom_control">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr class="hidden">
            <td><?php esc_html_e('Zoom Control Size', 'flex-map'); ?>: </td>
            <td>
                <select id="zoom_control_size">
                    <option value="DEFAULT"><?php esc_html_e('DEFAULT', 'flex-map'); ?></option>
                    <option value="LARGE"><?php esc_html_e('LARGE', 'flex-map'); ?></option>
                    <option value="SMALL"><?php esc_html_e('SMALL', 'flex-map'); ?></option>
                </select>
            </td>
        </tr>
        <tr class="typeCt hidden">
            <td><?php esc_html_e('Type Control Style', 'flex-map'); ?>: </td>
            <td>
                <select name="type_control_style" id="type_control_style">
                    <option value="DEFAULT"><?php esc_html_e('Default', 'flex-map'); ?></option>
                    <option value="HORIZONTAL_BAR"><?php esc_html_e('Horizontal Bar', 'flex-map'); ?></option>
                    <option value="DROPDOWN_MENU"><?php esc_html_e('Dropdown Menu', 'flex-map'); ?></option>
                </select>
            </td>
        </tr>
        <tr class="typeIds hidden">
            <td><?php esc_html_e('Type Control IDS', 'flex-map'); ?>: </td>
            <td>
                <select name="map_type_id[]" id="map_type_id" multiple="multiple">
                    <option value="ROADMAP"><?php esc_html_e('ROADMAP', 'flex-map'); ?></option>
                    <option value="SATELLITE"><?php  esc_html_e('SATELLITE', 'flex-map'); ?></option>
                    <option value="HYBRID"><?php  esc_html_e('HYBRID', 'flex-map'); ?></option>
                    <option value="TERRAIN"><?php esc_html_e('TERRAIN', 'flex-map'); ?></option>
                </select>
                <i class="tips"><?php esc_html_e('Hold control key to choose more', 'flex-map'); ?></i>
            </td>
        </tr>
        <tr class="streetCt hidden">
            <td><label for="street_view_control"><?php esc_html_e('Street View Control', 'flex-map'); ?>: </label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="street_view_control" name="street_view_control" type="checkbox" value="1" >
                    <label for="street_view_control">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr class="hidden">
            <td><label for="pan_control"><?php esc_html_e('Pan Control', 'flex-map'); ?></label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="pan_control" name="pan_control" type="checkbox" value="1" >
                    <label for="pan_control">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
        <tr class="hidden">
            <td><label for="overview_control"><?php esc_html_e('Overview Control', 'flex-map'); ?></label></td>
            <td>
                <div class="can-toggle demo-rebrand-2">
                    <input id="overview_control" name="overview_control" type="checkbox" value="1" >
                    <label for="overview_control">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
            </td>
        </tr>
    <?php
        $tabs_array = array();
        if(has_filter('flex_map_addition_general_options')) {
            $tabs_array = apply_filters('flex_map_addition_general_options', $tabs_array);
            foreach($tabs_array as $value ) {
                echo $value;
            }
        }
    ?>
 </table>

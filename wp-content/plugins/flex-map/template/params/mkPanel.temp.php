<div id="list-markers-page" class="pt-main pt-perspective">
    <!-- LIST MARKER PAGE -->
    <div class="pt-page list-markers-page">
        <div class="front">
            <h3><?php _e('Markers', 'flex-map'); ?></h3>
            <div class="wrap-button">
                <button
                    class="btn-addmarker map-btn btn-blue btn-effect"
                    data-animation="34"
                    data-switch-to="add-marker-page"
                    data-cur-page="list-markers-page"
                >
                    <i class="fa fa-plus"></i>
                    <?php _e('Add Marker', 'flex-map'); ?>
                </button>
                <button class="btn-addFastMarkers map-btn btn-orange btn-effect"
                        data-animation="34"
                        data-switch-to="add-fast-markers-page"
                        data-cur-page="list-markers-page"
                >
                    <i class="fa fa-rocket"></i>
                    <?php esc_html_e('Add Fast Markers', 'flex-map'); ?>
                </button>
            </div>

            <div id="markers" class="wrap-content">

                <div class="show_content option-button hidden">
                    <input type="text" class="search" placeholder="Search">
                    <select name="categories" id="categories">
                        <option value=""><?php esc_html_e('All Categories', 'flex-map'); ?></option>
                    </select>
                </div>

                <div class="empty_content" style="text-align: center;padding-top: 70px;">
                    <img src="<?php echo FlexMap() -> plugin_url . 'img/icons/base/39.png' ?>">
                    <span class="blur_text" style="display: block;color: #cccccc;font-size: 25px;line-height: 25px;"><?php esc_html_e('Empty marker!', 'flex-map'); ?></span>
                </div>

                <div class="list table-list-data marker_list" id="markers-table" >

                </div>
            </div>
        </div>
    </div>
    <!-- ADD MARKER PAGE -->
    <div class="pt-page add-marker-page">
        <div class="back">
            <div class="mymaps-row">
                <h3><?php esc_html_e('Add A Marker', 'flex-map'); ?></h3>
                <table border="0" class="field-container">
                    <tr>
                        <td><?php esc_html_e('Title', 'flex-map'); ?> </td>
                        <td>
                            <div class="field_container">
                                <input type="text" id="marker_title" name="marker_title" value="" placeholder="Title">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Category', 'flex-map'); ?></td>
                        <td>
                            <p>
                                <select name="marker_category_select" id="marker_category_select" style='width:100%'>
                                    <option value="">-- <?php esc_html_e('New Category', 'flex-map'); ?> --</option>
                                </select>
                            </p>
                            <p>
                                <input type="text" name="marker_new_cat_name" class="marker_new_cat_name" id="marker_new_cat_name" placeholder="<?php esc_html_e('New Category'); ?>" style="width:100%">
                            </p>
                        </td>
                    </tr>
                    <tr class="lat_field">
                        <td><?php esc_html_e('Latitude', 'flex-map'); ?> <span class="required">*</span> </td>
                        <td>
                            <div class="field_container">
                                <input type="text" id="latitude" name="latitude" value="" placeholder="Latitude">
                                <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php esc_html_e('Click on the map to get latitude.', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr class="long_field">
                        <td><?php esc_html_e('Longitude', 'flex-map'); ?> <span class="required">*</span> </td>
                        <td>
                            <div class="field_container">
                                <input type="text" id="longitude" name="longitude" value="" placeholder="Longitude">
                                <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php _e('Click on the map to get longitude.', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Set Time Out', 'flex-map'); ?> </td>
                        <td>
                            <div class="field_container">
                                <input type="text" id="marker_timeout" name="marker_timeout" value="" placeholder="Time Out">
                                <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php _e('Second time ( 1000 = 1s )', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Marker Icon', 'flex-map'); ?> <span class="required">*</span> </td>
                        <td>
                            <div class="chose_wrapper">
                                <img src="" alt="" width="32" height="37" class="marker_icon_chose"/>
                                <img src="<?php echo plugins_url('../../img/pencil.png', __FILE__) ?>" alt="" class="edit_chose_marker_icon"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="icon_library marker_libs_icon hidden">
                                <br clear="all"><div class="seperator-icon"><?php _e('Base', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group base-icon">
                                    <?php for($i=1; $i<40; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/base/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Business', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group bussiness-icon">
                                    <?php for($i=1; $i< 78; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/business/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Crisis', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group crisis-icon">
                                    <?php for($i=1; $i<36; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/crisis/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Facilities and services', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group f-a-s-icon">
                                    <?php for($i=1; $i< 17; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/fns/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Points of interest', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group p-o-i-icon">
                                    <?php for( $i = 1; $i < 64; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/poi/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Recreation', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group recreation">
                                    <?php for( $i = 1; $i < 34; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/recreation/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Transportation', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group transportation">
                                    <?php for( $i = 1; $i < 28; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/transportation/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Weather', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group weather">
                                    <?php for( $i = 1; $i < 11; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/weather/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Custom Icon', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group custom-group">
                                    <?php
                                    if ( $options = get_option( 'mymaps_options' ) ) {
                                        $image = $options['_icons_'];
                                        if( $image != '' && count($image) > 0 ) {
                                            foreach( $image as $value ) {
                                                ?>
                                                <div class="marker_wrap">
                                                    <img src="<?php echo $value['link']; ?>" alt="" width="32" height="37" title="<?php echo $value['title']; ?>">
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <br clear="all"/>
                                <button id="meta-image-button" class="btn-blue upload-btn"> <i class="fa fa-plus-square"></i> </button>
                                <button id="delete-icon" class="delete-icon btn-red upload-btn hidden"> <i class="fa fa-trash-o"></i> </button>
                                <input type="hidden" name="marker-upoad-image" id="marker-upoad-image" value="<?php if ( isset ( $prfx_stored_meta['meta-image'] ) ) echo $prfx_stored_meta['meta-image'][0]; ?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Effect', 'flex-map'); ?>: </td>
                        <td>
                            <div class="field_container">
                                <select name="marker_effect" id="marker_effect">
                                    <option value="NONE"><?php _e('NONE', 'flex-map'); ?></option>
                                    <option value="BOUNCE"><?php _e('BOUNCE', 'flex-map'); ?></option>
                                    <option value="DROP"><?php _e('DROP', 'flex-map'); ?></option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Open Description', 'flex-map'); ?>: </td>
                        <td>
                            <input id="addmarker_des_open" type="checkbox"/> <label for="addmarker_des_open"><?php _e('Enable', 'flex-map'); ?></label>
                            <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php _e('Open Description when the map is loaded.', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Shortcode In Description'); ?></td>
                        <td><input id="shortcode_in_des" type="checkbox"/> <label for="shortcode_in_des"><?php _e('Yes', 'flex-map'); ?></label>
                            <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php _e('If the description below contain shortcodes, check this field and your shortcode will be showed on marker content.', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a></td>
                    </tr>
                    <tr>
                        <td><?php _e('Description', 'flex-map'); ?>: </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="add_marker_des_wrapper">
                            <?php
                            $fastmarker_addmarker_description = array(
                                'textarea_name' => 'fastmarker_description',
                                'textarea_rows' => 10,
                                'media_buttons' => false,
                                'tinymce' => array(
                                    'theme_advanced_buttons1' => 'formatselect,|,bold,italic,underline,|,' .
                                        'bullist,blockquote,|,justifyleft,justifycenter' .
                                        ',justifyright,justifyfull,|,link,unlink,|' .
                                        ',spellchecker,wp_fullscreen,wp_adv'
                                )
                            );
                            wp_editor( '', 'addmarker_description', $fastmarker_addmarker_description );
                            ?>
                        </td>
                    </tr>
                </table>
                <div class="marker_wrap_button">
                    <button id="save_marker"
                            class="save_marker btn-orange map-btn"
                            data-animation="35"
                            data-switch-to="list-markers-page"
                            data-cur-page="add-marker-page"
                    >
                        <?php _e('Save', 'flex-map'); ?>
                    </button>
                    <button
                        id="cancel_marker"
                        class="cancel_marker btn-red map-btn btn-effect"
                        data-animation="35"
                        data-switch-to="list-markers-page"
                        data-cur-page="add-marker-page"
                    >
                        <?php _e('Cancel', 'flex-map'); ?>
                    </button>
                </div>
                <input type="hidden" id="curMarker">
            </div>
        </div>
    </div>
    <!-- ADD FAST MARKER PAGE -->
    <div class="pt-page add-fast-markers-page">
        <div class="back">
            <div class="mymaps-row">
                <h3><?php esc_html_e('Add Fast Markers'); ?></h3>
                <table border="0" class="field-container">
                    <tr class="fast_add_options">
                        <td><?php esc_html_e('Reset field', 'flex-map'); ?>: </td>
                        <td>
                            <div class="can-toggle demo-rebrand-2">
                                <input id="mk_reset_field" name="reset_field" type="checkbox" value="1" >
                                <label for="mk_reset_field">
                                    <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                                </label>
                            </div>
                            <i class="tips"><?php esc_html_e('Reset all field after added a marker.', 'flex-map'); ?></i>
                        </td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e('Title', 'flex-map'); ?>: </td>
                        <td>
                            <div class="field_container">
                                <input type="text" id="marker_title" name="marker_title" value="" placeholder="Title">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Category', 'flex-map'); ?></td>
                        <td>
                            <p>
                                <select name="marker_category_select" id="marker_category_select" style='width:164px'>
                                    <option value="">-- <?php esc_html_e('New Category', 'flex-map'); ?> --</option>
                                </select>
                            </p>
                            <p>
                                <input type="text" name="marker_new_cat_name" class="marker_new_cat_name" id="marker_new_cat_name" placeholder="<?php esc_html_e('New Category'); ?>">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Set Time Out', 'flex-map'); ?>: </td>
                        <td>
                            <div class="field_container">
                                <input type="text" id="marker_timeout" name="marker_timeout" value="" placeholder="Time Out">
                                <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php _e('Second time ( 1000 = 1s )', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e('Marker Icon', 'flex-map'); ?>: </td>
                        <td>
                            <div class="chose_wrapper">
                                <img src="" alt="" width="32" height="37" class="marker_icon_chose"/>
                                <img src="<?php echo plugins_url('../../img/pencil.png', __FILE__) ?>" alt="" class="edit_chose_marker_icon"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="icon_library marker_libs_icon hidden">
                                <br clear="all"><div class="seperator-icon"><?php _e('Base', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group base-icon">
                                    <?php for($i=1; $i<40; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/base/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Business', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group bussiness-icon">
                                    <?php for($i=1; $i< 78; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/business/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Crisis', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group crisis-icon">
                                    <?php for($i=1; $i<36; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/crisis/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Facilities and services', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group f-a-s-icon">
                                    <?php for($i=1; $i< 17; $i++)
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/fns/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Points of interest', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group p-o-i-icon">
                                    <?php for( $i = 1; $i < 64; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/poi/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Recreation', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group recreation">
                                    <?php for( $i = 1; $i < 34; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/recreation/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Transportation', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group transportation">
                                    <?php for( $i = 1; $i < 28; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/transportation/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Weather', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group weather">
                                    <?php for( $i = 1; $i < 11; $i++ )
                                    {?>
                                        <div class="marker_wrap">
                                            <img src="<?php echo plugins_url('../../img/icons/weather/'. $i . '.png', __FILE__) ?>"/>
                                        </div>
                                    <?php } ?>
                                </div>
                                <br clear="all"><div class="seperator-icon"><?php _e('Custom Icon', 'flex-map'); ?></div><br clear="all">
                                <div class="icon-mk-group custom-group">
                                    <?php
                                    if ( $options = get_option( 'mymaps_options' ) ) {
                                        $image = $options['_icons_'];
                                        if( $image != '' && count($image) > 0 ) {
                                            foreach( $image as $value ) {
                                                ?>
                                                <div class="marker_wrap">
                                                    <img src="<?php echo $value['link']; ?>" alt="" width="32" height="37" title="<?php echo $value['title']; ?>">
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <br clear="all"/>
                                <button id="meta-image-button" class="btn-blue upload-btn"> <i class="fa fa-plus-square"></i> </button>
                                <button id="delete-icon" class="delete-icon btn-red upload-btn hidden"> <i class="fa fa-trash-o"></i> </button>
                                <input type="hidden" name="marker-upoad-image" id="marker-upoad-image" value="<?php if ( isset ( $prfx_stored_meta['meta-image'] ) ) echo $prfx_stored_meta['meta-image'][0]; ?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Effect', 'flex-map'); ?>: </td>
                        <td>
                            <div class="field_container">
                                <select name="marker_effect" id="marker_effect">
                                    <option value="NONE"><?php _e('NONE', 'flex-map'); ?></option>
                                    <option value="BOUNCE"><?php _e('BOUNCE', 'flex-map'); ?></option>
                                    <option value="DROP"><?php _e('DROP', 'flex-map'); ?></option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Open Description', 'flex-map'); ?>: </td>
                        <td>
                            <input id="des_open" type="checkbox"/> <label for="des_open"><?php _e('Enable', 'flex-map'); ?></label>
                            <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php _e('Open Description when the map is loaded.', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-right:5px;"><?php esc_html_e('Shortcode In Description'); ?></td>
                        <td>
                            <input id="shortcode_in_des" type="checkbox"/> <label for="shortcode_in_des"><?php _e('Yes', 'flex-map'); ?></label>
                            <a href="javascript:void(0);" class="tooltip question_mark" data-tooltip="<?php _e('If the description below contain shortcodes, check this field and your shortcode will be showed on marker content.', 'flex-map'); ?>"><i class="fa fa-question-circle"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Description', 'flex-map'); ?>: </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="fast_marker_des_wrapper">
                            <?php
                            $fastmarker_description_settings = array(
                                'textarea_name' => 'fastmarker_description',
                                'textarea_rows' => 10,
                                'media_buttons' => false,
                                'tinymce' => array(
                                    'theme_advanced_buttons1' => 'formatselect,|,bold,italic,underline,|,' .
                                        'bullist,blockquote,|,justifyleft,justifycenter' .
                                        ',justifyright,justifyfull,|,link,unlink,|' .
                                        ',spellchecker,wp_fullscreen,wp_adv'
                                )
                            );
                            wp_editor( '', 'fastmarker_description', $fastmarker_description_settings );
                            ?>
                        </td>
                    </tr>
                </table>
                <div class="marker_wrap_button">
                    <button
                        id="cancel_add_fast_markers"
                            class="cancel_marker btn-red map-btn btn-effect"
                            data-animation="35"
                            data-switch-to="list-markers-page"
                            data-cur-page="add-fast-markers-page">
                        <?php esc_html_e('Cancel', 'flex-map'); ?>
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
                <input type="hidden" id="curMarker">
            </div>
        </div>
    </div>
</div>
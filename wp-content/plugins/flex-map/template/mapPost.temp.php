<?php

$page_name = ( isset($_GET['edit_map']) )? __('Edit Map', 'flex-map') : __('Add Map', 'flex-map');
$this->get_template_file_e( 'template.layouts.head', array('page_name' => $page_name) );
?>

<div class="mymaps-container">
    <div class="mymaps-tabs map-wrap">
        <div class="mymaps-row rows">
            <div class="col-md-4" style="padding-left:0px;">
                <!-- Your Tabs Here -->
                <?php
                mymaps_tabs(
                    array(
                    'frame_name' => 'marker-options',
                    'marker_tab_general' => array(
                        'icon' => '<i class="fa fa-cog"></i>',
                        'tab_name' => '',
                        'checked' => 'true',
                        'tooltips' => 'Generals',
                        'rows' => array(
                            array(
                                'layout' => '12',
                                'params' => array(
                                    array(
                                        'type' => 'htag',
                                        'htype' => 'h3',
                                        'value' => __('General', 'flex-map'),
                                        'col_pos'   => '0'
                                    )
                                )
                            ),
                            array(
                                'layout' => '12',
                                'params' => array(
                                    array(
                                        'type' => 'gnPanel',
                                        'col_pos'   => '0'
                                    )
                                )
                            )
                        )
                    ),
                    'marker_tab_id_1' => array(
                        'icon' => '<i class="fa fa-map-marker"></i>',
                        'tab_name' => '',
                        'tooltips' => __('Markers', 'flex-map'),
                        'rows' => array(
                            array(
                                'layout' => '12',
                                'wrap-layout-class' => 'inherit-size',
                                'col-class' => 'inherit-size',
                                'params' => array(
                                    array(
                                        'type' => 'mkPanel',
                                        'title' => 'Height: ',
                                        'col_pos'   => '0'
                                    )
                                )
                            )
                        )
                    ),
                    'marker_tab_id_2' => array(
                        'icon' => '<i class="fa fa-chevron-up"></i>',
                        'tab_name' => '',
                        'tooltips' => __( 'Draw', 'flex-map' ),
                        'rows' => array(
                            array(
                                'layout' => '12',
                                'wrap-layout-class' => 'inherit-size',
                                'col-class' => 'inherit-size',
                                'params' => array(
                                    array(
                                        'type' => 'drPanel',
                                        'col_pos'   => '0'
                                    )
                                )
                            )
                        )
                    ),
                    'marker_tab_id_6' => array(
                        'icon' => '<i class="fa fa-paint-brush"></i>',
                        'tab_name' => '',
                        'tooltips' => __( 'Styles', 'flex-map' ),
                        'rows' => array(
                            array(
                                'layout' => '12',
                                'wrap-layout-class' => 'inherit-size',
                                'col-class' => 'inherit-size',
                                'params' => array(
                                    array(
                                        'type' => 'stPanel',
                                        'col_pos'   => '0'
                                    )
                                )
                            )
                        )
                    )
                ) );
                ?>
            </div>
            <div class="col-md-8"  style="padding-right:0px;">
                <div class="map-wraper">
                    <input type="text" class="" id="pac-input" name="pac-input" style="width:100%;margin:0;" placeholder="<?php _e('Search', 'flex-map'); ?>">
                    <div id="map-canvas"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-button out-tab">
        <button id="save_map" class="map-btn-out-tab btn-green map-btn"> <i class="fa fa-floppy-o"></i> <?php _e('SAVE MAP', 'flex-map'); ?></button>
    </div>
</div>
<!---------------------- INVI ELM ---------------------->
<div class="invi">
    <!-- LIST MARKER -->
    <div class="list table-list-marker-data">
        <div class="mymaps-row table_data_row" data-marker-id="">
            <div class="col-md-1" style="padding-right: 0;">
                <img class="marker_icon" src="" width="21" height="31">
            </div>
            <div class="col-md-8">
                <p class="marker_title">[[name]]</p>
                <p class="marker_category">[[category]]</p>
            </div>
            <div class="col-md-3 list_option" style="text-align:right">

                <a class="btn btn-xs edit_marker op_edit btn-effect"
                    data-animation="34"
                    data-switch-to="add-marker-page"
                    data-cur-page="list-markers-page"><i class="fa fa-pencil-square-o"></i></a>

                <a class="btn btn-xs delete_marker op_delete"><i class="fa fa-trash-o"></i></a>
            </div>
        </div>
    </div>

    <!-- LIST POLY -->
    <div class="list table-list-poly-data">
        <div class="mymaps-row table_data_row" data-poly-id="" data-poly-type="">
            <div class="col-md-1" style="padding-right: 0;">
                <font color="" class="icon_color poly_icon"></font>
            </div>
            <div class="col-md-8">
                <p class="poly_title">[[name]]</p>
            </div>
            <div class="col-md-3 list_option" style="text-align:right">
                <a class="btn btn-xs edit_poly op_edit btn-effect"
                   data-animation="34"
                   data-switch-to="add-poly-page"
                   data-cur-page="list-poly-page"><i class="fa fa-pencil-square-o"></i>
                </a>

                <a class="btn btn-xs delete_poly op_delete"><i class="fa fa-trash-o"></i></a>
            </div>
        </div>
    </div>

    <!-- Edit marker page-->
    <div class="edit-marker-page">
        <!-- button -->
        <div class="buttons">
            <button
                id="apply_changes_edit_marker"
                class="apply_changes btn-orange map-btn"
                data-animation="35"
                data-switch-to="list-markers-page"
                data-cur-page="add-marker-page"
            >
                <i class="fa fa-floppy-o"></i>
                <?php esc_html_e('Apply Changes', 'flex-map'); ?>
            </button>
            <button
                id="cancel_edit_marker"
                class="btn-red map-btn btn-effect"
                data-animation="35"
                data-switch-to="list-markers-page"
                data-cur-page="add-marker-page"
            >
                <?php esc_html_e('Cancel', 'flex-map'); ?> <i class="fa fa-arrow-right"></i>
            </button>
        </div>
        <!-- Heading -->
        <div class="heading">
            <?php esc_html_e('Edit Marker', 'flex-map'); ?>
        </div>
    </div>

    <div class="add-marker-page">
        <!-- button -->
        <div class="buttons">
            <button id="save_marker"
                    class="save_marker btn-orange map-btn"
                    data-animation="35"
                    data-switch-to="list-markers-page"
                    data-cur-page="add-marker-page"> <i class="fa fa-floppy-o"></i>
                <?php _e('Save', 'flex-map'); ?>
            </button>
            <button
                id="cancel_marker"
                class="cancel_marker btn-red map-btn btn-effect"
                data-animation="35"
                data-switch-to="list-markers-page"
                data-cur-page="add-marker-page">
                <?php _e('Cancel', 'flex-map'); ?> <i class="fa fa-arrow-right"></i>
            </button>
        </div>
        <!-- Heading -->
        <div class="heading">
            <?php esc_html_e('Add A Marker', 'flex-map'); ?>
        </div>
    </div>

    <!-- Style panel -->
    <div class="style-page">
        <div class="button-switch-to-libs">
            <button
                class="add_style btn-orange map-btn btn-effect"
                data-animation="35"
                data-switch-to="libs-style-page"
                data-cur-page="list-style-page"
                style="width:100%;text-align:center;">
                <i class="fa fa-th-large"></i> <?php esc_html_e('Add More Style', 'flex-map'); ?>
            </button>
        </div>
    </div>

    <!-- DRAW PANNEL -->
    <div class="button-download-style">
        <div class="wrap-button">
            <div class="col-md-12">
                <button class="exit_style btn-red map-btn btn-effect"
                        data-animation="35"
                        data-switch-to="list-style-page"
                        data-cur-page="libs-style-page"
                        style="width:100%;"
                >
                    <i class="fa fa-arrow-right"></i> <?php esc_html_e('Exit', 'flex-map'); ?>
                </button>
            </div>
        </div>
    </div>
    <!-- STYLE PANEL -->
    <div class="style-panel-wrapper">
        <div class="default-style">
            <div class="maps_style_wrapper ">
                <div class="image_wrap">
                    <img src="<?php echo FlexMap() -> plugin_url . 'img/default_style.png';?>" style="height:100%;">
                    <div class="button-container" style-json="" style-name="<?php esc_html_e('Default Style'); ?>"> </div> </div>
                <div class="style-name"><?php esc_html_e('Default Style', 'flex-map'); ?></div>
            </div>
        </div>
    </div>
</div>
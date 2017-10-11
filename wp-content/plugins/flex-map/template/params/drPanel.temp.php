<div id="list-poly-page" class="pt-main pt-perspective">
    <!-- LIST DRAW -->
    <div class="pt-page list-poly-page">
        <div class="front">
            <h3><?php _e('Draw', 'flex-map'); ?></h3>
            <div class="wrap-button">
                <button
                    class="btn-addpolylines map-btn btn-blue btn-effect"
                    data-animation="34"
                    data-switch-to="add-poly-page"
                    data-cur-page="list-poly-page"
                >
                    <i class="fa fa-chevron-up"></i>
                    <?php _e('Add Shape', 'flex-map'); ?>
                </button>
                <button class="btn-addCircle map-btn btn-blue btn-effect"
                        data-animation="34"
                        data-switch-to="add-poly-page"
                        data-cur-page="list-poly-page"
                >
                    <i class="fa fa-circle"></i> <?php _e('Add Circle', 'flex-map'); ?>
                </button>
                <button class="btn-addRectangle map-btn btn-blue btn-effect"
                        data-animation="34"
                        data-switch-to="add-poly-page"
                        data-cur-page="list-poly-page"
                >
                    <i class="fa fa-stop"></i> <?php _e('Add Rectangle', 'flex-map'); ?>
                </button>
                <br clear="all">
            </div>

            <div id="poly" class="wrap-content">
                <div class="empty_content" style="text-align: center;padding-top: 70px;">
                    <img src="<?php echo FlexMap() -> plugin_url . 'img/draw.png' ?>" height="150">
                    <span class="blur_text" style="margin-top:10px;display: block;color: #cccccc;font-size: 25px;line-height: 25px;"><?php esc_html_e('Empty draw layout!', 'flex-map'); ?></span>
                </div>

                <div class="list table-list-data draw_list" id="draw-table" >

                </div>
            </div>

            <!--<table class="wp-list-table widefat fixed striped poly_list hidden">
                <thead>
                <tr>
                    <td><?php /*_e('Icon', 'flex-map'); */?></td>
                    <td><?php /*_e('Title', 'flex-map'); */?></td>
                    <td><?php /*_e('Custom', 'flex-map'); */?></td>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>-->
        </div>
    </div>
    <div class="pt-page add-poly-page">
        <div class="back">
            <div class="line-gon">
                <h3><?php _e('Add New PolyLine', 'flex-map'); ?></h3>
                <table border="0" style="width:100%" class="field-container">
                    <tr>
                        <td><?php _e('Title', 'flex-map'); ?>: </td>
                        <td><input class="pl_title" type="text" name="pl_title"/></td>
                    </tr>
                    <tr class="poly_stroke">
                        <td><?php _e('Stroke Color', 'flex-map'); ?>: </td>
                        <td>
                            <div id="polyColors"></div>
                            <input type="hidden" class="stroke_poly" id="stroke_poly_hex" data-color-format="hex">
                            <input type="hidden" class="stroke_poly" id="stroke_poly_hsl" data-color-format="hsl">
                        </td>
                    </tr>
                    <tr class="poly_fill">
                        <td><?php _e('Fill color', 'flex-map'); ?>: </td>
                        <td>
                            <div id="polyFillColors"></div>
                            <input type="hidden" class="fill_poly" id="fill_poly_hex" data-color-format="hex">
                            <input type="hidden" class="fill_poly" id="fill_poly_hsl" data-color-format="hsl">
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Stroke Weight', 'flex-map');?>: </td>
                        <td>
                            <input type="hidden" id="polo-weight-hidden" value="3"/>
                            <div id="poly-weight-result">3</div>
                            <div id="polo-weight"></div>

                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Description', 'flex-map'); ?>: </td>
                        <td>
                            <?php
                            wp_editor( '', 'poly_content', array('textarea_name' => 'poly_des','textarea_rows' => 10,) );
                            ?>
                        </td>
                    </tr>
                </table>
                <div class="wrap-button poly-option">
                    <button
                        class="btn-savePoly map-btn btn-orange"
                        data-animation="35"
                        data-switch-to="list-poly-page"
                        data-cur-page="add-poly-page"
                    >
                        <i class="fa fa-floppy-o"></i> <?php _e('Save', 'flex-map'); ?>
                    </button>
                    <button
                        class="btn-polycancel map-btn btn-red btn-effect"
                        data-animation="35"
                        data-switch-to="list-poly-page"
                        data-cur-page="add-poly-page"
                    >
                        <?php _e('Cancel', 'flex-map');?> <i class="fa fa-arrow-right"></i>
                    </button>
                    <input id="polyStatus" type="hidden"/>
                    <input id="curPoly" type="hidden"/>
                    <input id="eventTrack" type="hidden"/>
                </div>
            </div>
        </div>
    </div>
</div>

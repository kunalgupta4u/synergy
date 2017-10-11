
<form action="" method="POST">
    <div class="list-wrapper">
        <div class="inner-list">
            <?php
            $this->get_template_file_e('template.layouts.head', array('page_name' => 'Settings Page'));
            ?>
            <div class="body-map">
                <?php
                mymaps_tabs(array(
                    'frame_name' => 'setting_pages',
                    'import_tab' => array(
                        'tab_value' => 'general',
                        'checked'  => (!isset($_POST['setting_pages']) || (isset($_POST['setting_pages']) && $_POST['setting_pages'] == 'general')),
                        'icon'     => ' <i class="fa fa-list-alt" aria-hidden="true"></i>  ',
                        'tab_name' => 'General',
                        'rows'     => array(
                            array (
                                'layout' => '1/10/1',
                                'params' => array(
                                    array(
                                        'type'    => 'htag',
                                        'htype'   => 'h3',
                                        'value'   => __('General', 'flex-map'),
                                        'col_pos' => '1'
                                    )
                                )
                            ),
                            array (
                                'layout' => '1/10/1',
                                'params' => array(
                                    array(
                                        'type'    => 'generalSettings',
                                        'col_pos' => '1'
                                    )
                                )
                            )
                        )
                    ),
                    'auth_tab' => array(
                        'tab_value' => 'authentication',
                        'checked'  => (isset($_POST['setting_pages']) && $_POST['setting_pages'] == 'authentication'),
                        'icon'     => ' <i class="fa fa-check-square-o" aria-hidden="true"></i> ',
                        'tab_name' => 'Authentication',
                        'rows'     => array(
                            array (
                                'layout' => '1/10/1',
                                'params' => array(
                                    array(
                                        'type'    => 'htag',
                                        'htype'   => 'h3',
                                        'value'   => __('Authentication', 'flex-map'),
                                        'col_pos' => '1'
                                    )
                                )
                            ),
                            array (
                                'layout' => '1/10/1',
                                'params' => array(
                                    array(
                                        'type'    => 'authenticationSettings',
                                        'col_pos' => '1'
                                    )
                                )
                            )
                        )
                    )
                ));
                ?>
            </div>
            <div class="wrap-button out-tab">
                <button type="submit" id="save_change" name="save_change" class="map-btn-out-tab btn-green map-btn"
                        value="save_change"><i class="fa fa-floppy-o"></i> <?php _e('SAVE CHANGE', 'flex-map'); ?>
                </button>
            </div>
        </div>
    </div>
</form>
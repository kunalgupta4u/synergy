<?php
$this->get_template_file_e( 'template.layouts.head', array('page_name' => esc_html__('List Map', 'flex-map')) );
?>

<div class="list-wrapper">
    <div class="inner-list">
        <?php
        if( function_exists('fl_header') ) {
            fl_header( __('List All Map', 'flex-map') );
        }
        ?>
        <div class="action-option action-list">
            <div class="inner-action">
                <div class="fixed-button">
                    <a href="<?php echo get_admin_url('', 'admin.php?page=map-post' ); ?>" id="add_map" class="map-btn-big btn-blue"> <i class="fa fa-plus-square"></i><?php esc_html_e('Add Map', 'flex-map'); ?></a>
                </div>
                <div class="special_options">
                    <button id="edit_map" class="map-btn-big btn-orange"> <i class="fa fa-pencil-square-o"></i> <?php esc_html_e('Edit', 'flex-map'); ?> </button>
                    <button id="delete_map" class="map-btn-big btn-red"> <i class="fa fa-trash-o"></i> <?php esc_html_e('Delete', 'flex-map'); ?> </button>
                </div>
            </div>
        </div>

        <?php if( $options = get_option('mymaps_options')): ?>
            <?php if( count($options['_map_posts_']) > 0 ): ?>
            <table class="wp-list-table widefat fixed striped posts map-list-table">
                <thead>
                <tr>
                    <td  class="checkbox-list">
                        <label for="check_all">
                            <input id="check_all" type="checkbox" value=""/>
                        </label>
                    </td>
                    <td>Name</td>
                    <td>Shortcode</td>
                </tr>
                </thead>
                <tbody>
                <?php
                        foreach( $options['_map_posts_'] as $id => $map ) {

                            $general = json_decode($map['general']);
                            ?>
                            <tr>
                                <td class="checkbox-list">
                                    <label for="<?php echo esc_attr( $id ); ?>">
                                        <input type="checkbox" id="<?php echo esc_attr( $id ); ?>" class="post_map" value="<?php echo esc_attr( $id ); ?>">
                                    </label>
                                </td>
                                <td>
                                    <a href="<?php echo get_admin_url('', 'admin.php?page=map-post&edit_map=' . esc_attr( $id ) ); ?>"><?php echo esc_attr( $general->name ); ?></a>
                                </td>
                                <td><input type="text" value='<?php echo '[flexmap id="' . esc_attr( $id ) . '"]'; ?>' readonly  onClick="this.setSelectionRange(0, this.value.length)" > </td>
                            </tr>
                            <?php
                        }
                ?>
                <tr>
                    <td colspan="3">
                        <div class="wait waiting-style-map">
                            <div class="background-waiting"></div>
                            <div class="circles-loader">Loading...</div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php else: ?>
            <img src="<?php echo FlexMap()->plugin_url . 'img/empty_list.jpg' ?>" alt="" width="100%" height="850px">
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
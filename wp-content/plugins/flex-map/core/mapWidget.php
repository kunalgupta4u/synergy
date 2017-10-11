<?php
class mapWidget {
    function __construct(){
        add_action( 'widgets_init', array($this, 'flexmap_widgets_widgets' ) );
    }
    /**
     * Register our sidebars and widgetized areas.
     *
     */
    function flexmap_widgets_widgets() {
        register_widget('flexmap_widgets');
    }

}

if( class_exists('WPBakeryShortCode') ) {
    class WPBakeryShortCode_Bartag extends WPBakeryShortCode {
    }
}
if( class_exists('WP_Widget') ) {
    class Flexmap_Widgets extends WP_Widget {
        function __construct () {
            parent::__construct(
                'flexmap_widgets',
                'Flex Map',
                array( 'description' =>
                           'Displays flex map post' )
            );
        }
        function form( $instance ) {
            // Retrieve previous values from instance
            //    // or set default values if not present
            $render_widget = ( !empty( $instance['render_widget'] ) ?
                $instance['render_widget'] : 'true' );

            $options = get_option('mymaps_options');
            $options  = $options['_map_posts_'];

            ?>
            <!-- Display fields to specify title and item count -->
            <p>
                <label for="<?php echo $this->get_field_id( 'render_widget' ); ?>">
                    <?php echo 'Maps'; ?>
                    <select id="<?php echo $this->get_field_id( 'render_widget' ); ?>"
                            name="<?php echo $this->get_field_name( 'render_widget' );?>">
                        <?php
                        foreach( $options as $key => $value ) {
                            $general = json_decode($value['general']);
                            ?>
                            <option value="<?php echo $key; ?>"
                                <?php selected( $render_widget, $key ); ?>>
                                <?php echo $general -> name . ' - ' . '[flexmap id="' . $key . '"]' ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </label>
            </p>

        <?php }
        function widget( $args, $instance ) {
            if ( $instance['render_widget'] != '' ) {
                $map_id = (int) $instance['render_widget'];
                $map_id = "[flexmap id='" . $map_id . "']";
                do_shortcode($map_id);
            }
        }
    }
}
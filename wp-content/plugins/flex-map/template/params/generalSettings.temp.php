
    <table class="settings-table">
        <tr>
            <td>
                <?php esc_html_e('Owl Carousel', 'flex-map'); ?> :
            </td>
            <td>
                <?php generate_admin_field(
                    'checkbox',
                    array(
                        'name'        => 'owl_carousel',
                        'id'          => 'owl_carousel',
                        'placeholder' => '',
                        'style'       => 'width:100%;',
                        'default'     => true
                    ),
                    $_REQUEST
                ); ?>
            </td>
        </tr>
    </table>


<table class="settings-table">
    <tr>
        <td>
            <?php esc_html_e('API KEY', 'flex-map'); ?>
        </td>
        <td>
            <?php generate_admin_field(
                'text',
                array(
                    'name'        => 'api_key',
                    'id'          => 'api_key',
                    'placeholder' => ''
                ),
                $_REQUEST
            ); ?>
        </td>
    </tr>
</table>
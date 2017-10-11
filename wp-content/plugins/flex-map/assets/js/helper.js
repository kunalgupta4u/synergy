/**
 * The helper file will handle all the process that don't relate with map process
 *
 * @since 1.0.1
 * @author JAX
 **/
$ = jQuery;

function flx_extract_action( data ) {
    if( matches = data.match(/action\=(.[^&]+)/) ) {
        if( matches[1] ) {
            return matches[1];
        }
    }
    return data;
}
function flx_ajax_accession( options ) {

    var curAction = '';

    if( options.url ) {
        curAction = flx_extract_action(options.url);
    }

    var arr_action = [
        'flx_save_map',
        'flx_load_styles_libs',
        'flx_load_my_styles',
        'flx_delete_mystyle',
        'flx__save2_mystyles',
        'flx_upload_marker_icon',
        'flx_delete_marker_icon',
        'flx_import_map',
        'flx_delete_map'
    ];

    if(arr_action.indexOf(curAction) )
        return true;

    return false;
}

function waiting_animation( $type, options ) {
    if( flx_ajax_accession(options) === true )
    {
        if( $type == 'before' ) {
            jQuery('.waiting-style-map').show();
            jQuery('#save_map').attr('disabled', 'disabled');
        } else {
            jQuery('.waiting-style-map').hide();
            jQuery('#save_map').removeAttr('disabled');
        }
    }
}

/**
 * AJAX effect loading
 *
 * since 1.0.1
 */
function ajax_loading_icon() {
    jQuery(document).ready(function() {
        jQuery(document)
            .ajaxSend(function( event, xhr, options ) {
                waiting_animation( 'before', options);
            })
            .ajaxComplete(function( event, xhr, options ) {
                waiting_animation( 'after', options);
            });
    });
}

ajax_loading_icon();

/**
 * Reset all field of pannel
 *
 */
function reset_field_pannel( $tyepe_panel ) {

    switch($tyepe_panel){
        case 'add_markers' : {
            $add_marker_page = $('.add-marker-page');
            $add_marker_page.find('.back').scrollTop(0);
            /* Reset coordinate */
            $add_marker_page.find($('#latitude')).val('');
            $add_marker_page.find($('#longitude')).val('');
            /* Reset cateogries */
            $add_marker_page.find($('#marker_title')).val('');
            /* Reset Timeout */
            $add_marker_page.find($('#marker_timeout')).val('');

            /* Reset Effect */
            $add_marker_page.find('#marker_effect').find('option').removeAttr('selected');
            /* Reset Category */
            $add_marker_page.find('#marker_new_cat_name').val('');
            $add_marker_page.find('#marker_category_select').find('option').removeAttr('selected');
            /* Reset Open Description */
            $add_marker_page.find($('#des_open').prop('checked', false));
            /* Reset Description */
            $add_marker_page.find('button#addmarker_description-html').trigger('click');
            $add_marker_page.find('textarea#addmarker_description').val('');
            $add_marker_page.find('button#addmarker_description-tmce').trigger('click');

            if($add_marker_page.find('.marker_libs_icon').hasClass('hidden'))
                $add_marker_page.find('.edit_chose_marker_icon').trigger('click');

            $add_marker_page.find($('.base-icon div:first-child')).trigger('click');

            if(!$add_marker_page.find('.marker_libs_icon').hasClass('hidden'))
                $add_marker_page.find('.edit_chose_marker_icon').trigger('click');

        }; break;
        case 'add_fast_markers' : {
            $add_marker_page = $('.add-fast-markers-page');
            $add_marker_page.find('.back').scrollTop(0);

            /* Reset Title */
            $add_marker_page.find($('#marker_title')).val('');
            /* Reset Category */
            $add_marker_page.find('#marker_new_cat_name').val('');
            $add_marker_page.find('#marker_category_select').find('option').removeAttr('selected');
            /* Reset Timeout */
            $add_marker_page.find($('#marker_timeout')).val('');

            /* Reset Effect */
            $add_marker_page.find('#marker_effect').find('option').removeAttr('selected');

            /* Reset Open Description */
            $add_marker_page.find($('#des_open').prop('checked', false));

            /* Shortcode In Description */
            $add_marker_page.find('#shortcode_in_des').prop('checked', false);

            /* Reset Description */
            $add_marker_page.find('button#addmarker_description-html').trigger('click');
            $add_marker_page.find('textarea#fastmarker_description').val('');
            $add_marker_page.find('button#addmarker_description-tmce').trigger('click');

            if($add_marker_page.find('.marker_libs_icon').hasClass('hidden'))
                $add_marker_page.find('.edit_chose_marker_icon').trigger('click');

            $add_marker_page.find($('.base-icon div:first-child')).trigger('click');

            if(!$add_marker_page.find('.marker_libs_icon').hasClass('hidden'))
                $add_marker_page.find('.edit_chose_marker_icon').trigger('click');

        }; break;

        case 'draw' : break;
    }
}

/**
 *
 * Lanching Ajax Effect Loading
 */

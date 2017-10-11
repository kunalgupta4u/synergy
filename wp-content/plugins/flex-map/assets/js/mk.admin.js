jQuery(function($) {
    var markerPanel = {
        init : function() {
            this.bindClickUI( 'button.btn-addmarker', this.clickAddMarker );
            this.bindClickUI('.edit_marker', this.clickEditMarker);
            this.bindClickUI( '.btn-addFastMarkers', this.clickAddFastMarker );

            this.bindClickUI( '.icon_library .marker_wrap', this.clickChooseIcon );
            this.bindClickUI( '.edit_chose_marker_icon', this.clickShowIcon );
            this.bindClickUI( '.view_marker', this.clickViewMarker );
            this.bindClickUI( '#delete-icon', this.deleteIcons );
            this.focusSearchField();
            this.uploadImage();
        },
        bindClickUI : function( obj, func ) {
            $glb = this;
            this.event = 'ontouchstart' in window ? 'touchstart' : 'click';
            $(document).on( this.event, obj, function( e ){
                e.preventDefault();
                /* action function */
                func( $(this), $glb);
            });
        },
        clickEditMarker : function () {
            /* Add new button*/
            var $edit_marker_page = $('.invi .edit-marker-page');
            $('.add-marker-page .marker_wrap_button').html($edit_marker_page.find('.buttons').html());

            $('.add-marker-page h3').html($edit_marker_page.find('.heading').html());
        },
        clickAddMarker : function( obj, $glb ) {

            /* Reset all field */
            var $add_marker_page = $('.invi .add-marker-page');
            $('.add-marker-page .marker_wrap_button').html($add_marker_page.find('.buttons').html());

            $('.add-marker-page h3').html($add_marker_page.find('.heading').html());

            reset_field_pannel('add_markers');
        },
        clickAddFastMarker : function (obj, $glb) {

            /* Reset all field */
            reset_field_pannel('add_fast_markers');

        },
        /* Chose icon marker */
        clickChooseIcon : function( obj, $glb ) {
            if( $('.icon_library .marker_wrap').hasClass('selected') )
            {
                $('.icon_library .marker_wrap').removeClass('selected');
            }
            obj.addClass('selected');
            /* Remove current image was chose */
            $('.chose_wrapper img.marker_icon_chose').remove();
            /* Add new image to icon chose */
            var image_chose = obj.html();
            $('.chose_wrapper').prepend(image_chose);
            $('.chose_wrapper > img:first-child').addClass('marker_icon_chose');
            /* show or hidden delete button if it is custom icon */
            if( obj.parent().hasClass('custom-group') ) {
                $('.delete-icon').removeClass('hidden');
            } else {
                $('.delete-icon').addClass('hidden');
            }
            /* Set icon if in edit marker page */
            /*                 var marker_id = jQuery('button#apply_changes_edit_marker').attr('marker-data');
             markers[marker_id].setIcon( jQuery('.chose_wrapper img:first-child').attr('src') );*/

        },
        /* Focus search field */
        focusSearchField : function() {
            var $this = this;
            $this.searchInput = $('#pac-input');
            /* Search focus and focus out*/
            $this.searchInput.focus(function(){
                $(this).addClass('focus');
            });
            $this.searchInput.focusout(function(){
                $(this).removeClass('focus');
            });
        },
        /* Show marker icon library */
        clickShowIcon : function( obj, $glb ) {
            this.libsIcon = $('.marker_libs_icon');
            if( this.libsIcon.hasClass('hidden') )
            {
                this.libsIcon.show('fast');
                this.libsIcon.removeClass('hidden');
            } else {
                this.libsIcon.addClass('hidden');
                this.libsIcon.hide('fast');
            }
            $('.icon_library img[src=\"' + $('.marker_icon_chose').attr('src') + '\"]').parent().addClass('selected');
        },
        clickViewMarker : function( obj, $glb ) {
            /* Remove if have the view to some of marker before */
            if ($('table.marker_list tr').hasClass('selecting') === true) {
                $('table.marker_list tr').removeClass('selecting');
            }
        },
        uploadImage : function () {
            var $this = this;
            $(document).on('change', '#marker-upoad-image', function ( e ) {
                e.preventDefault();
                $obj  = $(this);
                $this.data = {
                    'action'        : 'flx_upload_marker_icon',
                    'link'          : $(this).val(),
                    '_ajax_nonce'   : ajax_data
                };
                $.post( ajaxurl, $this.data, function ( responsive ) {
                    if( responsive!= 'not_get' && responsive !='not_isset' ) {
                        $this.show  = '<div class="marker_wrap">';
                        $this.show += '<img src="' + $obj.val() + '" alt="" width="32" height="37" title="' + responsive + ' ">';
                        $this.show += '</div>';
                        $('.custom-group').append( $this.show );
                    }
                });
            });
        },
        deleteIcons : function ( obj, $glb ) {
            if( window.confirm('Are you sure you want to delete this icon? ') ) {
                $link = $('.custom-group .selected img').attr('src');
                /* ajax to delete icon */
                $this.data = {
                    'action'    : 'flx_delete_marker_icon',
                    'link'      : $link,
                    '_ajax_nonce'   : ajax_data
                };
                $.post( ajaxurl, $this.data, function ( responsive ) {
                    /* reset to default */
                    $('.custom-group .selected').remove();
                    $('.base-icon div:first-child').trigger('click');
                });
            }
        }
    };
    markerPanel.init();
});
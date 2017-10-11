$ = jQuery;

var adminUI = {
    init: function () {

        this.define_marker_table();
        this.define_poly_table();
        this.table_click_row();
        this.general_slider_define();
        this.poly_slider_define();
    },
    /* -- MARKER -- */
    define_marker_table: function () {

        /* Define some table elements */
        var $get_item = $('.invi .table-list-marker-data').html();

        var values = [];

        /* Filter html tag */
        $get_item = $get_item.toString();
        $get_item = $get_item.replace(/\n|\  /g, "");

        var options = {
            valueNames: [
                'marker_title',
                'marker_category',
                {data: ['marker-id']},
                {attr: 'src', name: 'marker_icon'}
            ],
            item: $get_item
        };

        markersList = new List('markers', options, values);


        $('select#categories').on('change', function () {
            var $this = this;
            $this.cat_search = $(this).val();
            if( $this.cat_search == '') {
                markersList.filter(function(item) {
                    return true;
                });
            } else {
                markersList.filter(function(item) {
                    if(item.values().marker_category == $this.cat_search ) {
                        return true;
                    } else {
                        return false;
                    }
                });
            }
        });
    },
    marker_modify_row: function ($table_data) {
        var item = markersList.get('marker-id', $table_data.id)[0];

        item.values({
            id: $table_data.id,
            marker_title: $table_data.title,
            marker_category: $table_data.cat,
            marker_icon: $table_data.icon
        });
    },
    marker_table_add_row: function ( $table_data ) {

        markersList.add({
            'marker-id': $table_data.id,
            'marker_title': $table_data.title,
            'marker_category': $table_data.cat,
            'marker_icon': $table_data.icon
        });

        /* Add marker id */
        $target_table_object = $table_data.table_object;

        $wrap_content = $target_table_object.parents('.wrap-content');

        /* Hide empty content */
        if ($wrap_content.find('.empty_content').hasClass('hidden') === false)
            $wrap_content.find('.empty_content').addClass('hidden');

        if ($wrap_content.find('.show_content').hasClass('hidden'))
            $wrap_content.find('.show_content').removeClass('hidden');
    },
    marker_delete_row: function ($marker_id ) {
        markersList.remove('marker-id', $marker_id);
    },
    add_category_marker: function ( $catename ) {
        $('.add-fast-markers-page').find('#marker_category_select').append('<option value="' + $catename + '">' + $catename + '</option>');
        $('.add-marker-page').find('#marker_category_select').append('<option value="' + $catename + '">' + $catename + '</option>');
        $('.list-markers-page select#categories').append('<option value="' + $catename + '">' + $catename + '</option>');
    },

    /* -- POLY -- */
    define_poly_table : function () {

        /* Define some table elements */
        var $get_item = $('.invi .table-list-poly-data').html();

        var values = [];

        /* Filter html tag */
        $get_item = $get_item.toString();
        $get_item = $get_item.replace(/\n|\  /g, "");

        var options = {
            valueNames: [
                'poly_title',
                {data: ['poly-id']},
                {data: ['poly-type']},
                'poly_icon',
                {attr: 'color', name: 'icon_color'}
            ],
            item: $get_item
        };

        polysList = new List('poly', options, values);

    },
    poly_modify_row: function($table_data) {

        var item = polysList.get('poly-id', $table_data.id)[0];

        item.values({
            'poly-type' : $table_data.type,
            'poly-id': $table_data.id,
            'poly_title': $table_data.title,
            'icon_color': $table_data.color
        });

    },
    poly_table_add_row: function ($table_data) {
        switch ($table_data.type) {
            case 'line':
            {
                this.icon = '<i class="fa fa-chevron-up"></i>';
            }
                ;
                break;
            case 'gon':
            {
                this.icon = '▲';
            }
                ;
                break;
            case 'circle':
            {
                this.icon = '<i class="fa fa-circle"></i>';
            }
                ;
                break;
            case 'rectangle':
            {
                this.icon = '<i class="fa fa-stop"></i>';
            }
                ;
                break;
        }
        if($table_data.title == '') {
            $id = $table_data.id.split('_');
            $table_data.title = 'Layer ' + $table_data.type + ' ' + $id[1];
        }
        polysList.add({
            'poly-type' : $table_data.type,
            'poly-id': $table_data.id,
            'poly_title': $table_data.title,
            'icon_color' : $table_data.icon_color,
            'poly_icon': this.icon
        });

        /* Add marker id */
        $target_table_object = $table_data.table_object;

        $wrap_content = $target_table_object.parents('.wrap-content');

        /* Hide empty content */
        if ($wrap_content.find('.empty_content').hasClass('hidden') === false)
            $wrap_content.find('.empty_content').addClass('hidden');

        if ($wrap_content.find('.show_content').hasClass('hidden'))
            $wrap_content.find('.show_content').removeClass('hidden');

    },
    poly_slider_define: function () {
        polySlider = document.getElementById('polo-weight');

        noUiSlider.create(polySlider, {
            start: 3,
            behaviour: 'snap',
            connect: 'lower',
            range: {
                'min':  0,
                'max':  21
            },
            step: 1,
            decimals: 1,
            orientation: 'horizontal'
        });

        polySlider.noUiSlider.on('update', function (values, handle) {
            var num = values[handle];
            num = parseInt(num);
            $('#poly-weight-result').html(num);
            $('#polo-weight-hidden').val(num);
            $('#polo-weight-hidden').trigger('click');
        });

    },
    general_slider_define: function () {
        snapSlider = document.getElementById('map-zoom');

        noUiSlider.create(snapSlider, {
            start: 0,
            behaviour: 'snap',
            connect: 'lower',
            range: {
                'min':  0,
                'max':  21
            },
            step: 1,
            decimals: 1,
            orientation: 'horizontal'
        });


    },
   /* Event click to row in table data */
    table_click_row: function () {
        $(document).on('click', '.table-list-data .mymaps-row', function () {
            var table_id = $(this).parents('.table-list-data').attr('id');
            /* Remove old selected class */
            $('#' + table_id + ' .mymaps-row').each(function () {
                if ($(this).hasClass('selecting'))
                    $(this).removeClass('selecting');
            });
            /* Add new selecting class */
            $(this).addClass('selecting');
        });
    },


};

adminUI.init();


jQuery(document).ready(function ($) {
    flip_panel = true;
    google.maps.event.addDomListener(window, 'load', function () {
        /* Global variable */
        var mymapsInit;
        var markers = [], markerCat = [],
            polyLines = [], polyGons = [],
            recTangles = [], circles = [],
            load_shortcode = false, default_style = '';
        mapPostId = mapData._post_id_;

        var trackChange = 0;
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 0,
            center: new google.maps.LatLng(19.1759668, 72.79504659999998),
            disableDefaultUI: true
        });
        /* responsive */
        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

        var infoWindow = new google.maps.InfoWindow;

        mymapsInit = {
            init: function () {
                this.rfVarsGeneral();
                this.createSearchBox();
                this.general.gnInit();
                this.editMap.init();
                this.markers.mkInit();
                this.styles.stInit();
                this.draw.drInit();
                this.trackEventChange();
                this.handleBeforeUnload();
            },
            createSearchBox: function () {
                var $this = this;
                // Create the search box and link it to the UI element.
                var input = /** @type {HTMLInputElement} */(
                    document.getElementById('pac-input'));

                var searchBox = new google.maps.places.SearchBox(
                    /** @type {HTMLInputElement} */(input));

                // Listen for the event fired when the user selects an item from the
                // pick list. Retrieve the matching places for that item.
                google.maps.event.addListener(searchBox, 'places_changed', function () {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }
                    var bounds = new google.maps.LatLngBounds();
                    for (var i = 0, place; place = places[i]; i++) {
                        var image = {
                            url: place.icon,
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };

                        // Create a marker for each place.
                        $this.query = {
                            icon: image,
                            cat: '',
                            map: map,
                            title: place.name,
                            position: place.geometry.location
                        };
                        $this.marker = new google.maps.Marker($this.query);
                        google.maps.event.addListener($this.marker, 'click', mymapsInit.markers.onMarkerClick);
                        markers.push($this.marker);

                        var length = countobj(markers);
                        $this.query.id = 'mk_' + length;
                        $this.query.icon = place.icon;
                        $this.query.table_object = $('.marker_list#markers-table');
                        adminUI.marker_table_add_row($this.query);

                        if ($('.marker_list').hasClass('hidden')) $('.marker_list').removeClass('hidden');
                        bounds.extend(place.geometry.location);
                    }
                    map.fitBounds(bounds);
                });

                // Bias the SearchBox results towards places that are within the bounds of the
                // current map's viewport.
                google.maps.event.addListener(map, 'bounds_changed', function () {
                    var bounds = map.getBounds();
                    searchBox.setBounds(bounds);
                });
            },
            bindMapEvent: function (behav, func) {
                $this = this;
                google.maps.event.addListener(map, behav, function (e) {
                    func(e);
                    infoWindow.close();
                });
            },
            rfVarsGeneral: function () {
                /* Page */
                this.addFastMarkerPage = $('.add-fast-markers-page');
                this.mapName = $('#map_name');
                this.shortCode = $('#short_code');
                this.extraClass = $('#extra_class');
                /* layout */
                this.mapWidth = $('#map_width');
                this.unitWidth = $('#unit_width');
                this.mapHeight = $('#map_height');
                this.unitHeight = $('#unit_height');
                this.mapLayouts = $('input[name="map_layout"][id="map_layout_res"]');
                this.heightUnlimited = $('#height_unlimited');
                /* Current state */
                this.zoom = $('#map-zoom-hidden');
                this.curMapType = $('#curMapType');
                this.searchBox = $('#search_box');
                this.mapLegend = $('#map_legend');
                /* Map options */
                this.draggAble = $('#draggable');
                this.drMobile = $('#dr_mobile');
                this.scrollWheel = $('#scroll_wheel');
                this.doubleClickZoom = $('#double_click_zoom');

                /* DF UI */
                this.dfUi = $('#df_ui');
                this.scaleControl = $('#scale_control');
                this.zoomControl = $('#zoom_control');
                this.zoomControlSize = $('#zoom_control_size');
                this.typeControl = $('#type_control_style');
                this.mapTypeId = $('#map_type_id');
                this.streetViewControl = $('#street_view_control');
                this.panControl = $('#pan_control');
                this.overViewControl = $('#overview_control');
                this.roTateControl = $('#rotate_control');
                /* style default */
                this.styleDefault = $('#style_default');
            },
            trackEventChange: function () {
                $(document).on('change', 'input', function () {
                    trackChange = 1;
                });
                $(document).on('change', 'select', function () {
                    trackChange = 1;
                });
            },
            handleBeforeUnload: function () {
                window.onbeforeunload = function () {
                    if (trackChange == 1)
                        return "You may lost all data in this post when you redirect to other page.";
                };
                return false;
            },
            markers: {
                mkInit: function () {
                    this.refreshVarsMarker();

                    /* Click to ADD marker */
                    this.bindClickUI('#save_marker', this.clickSaveMarker, this);
                    this.bindClickUI('.btn-addmarker', this.clickAddMarker, this);
                    this.bindClickUI('.btn-addFastMarkers', this.clickAddFastMarker, this);
                    this.bindClickUI('#cancel_add_fast_markers', this.clickCancelAddFastMarker, this);
                    this.bindClickUI('.cancel_marker', this.clickCancelMarker, this);

                    /* Click to VIEW marker */
                    this.bindClickUI('.marker_list .table_data_row > div:first-child, .marker_list .table_data_row div:nth-child(2)', this.clickViewMarker, this);
                    /* Click to EDIT marker */
                    this.bindClickUI('.edit_marker', this.clickEditMarker, this);
                    /* Click to DELETE marker */
                    this.bindClickUI('.delete_marker', this.clickDeleteMarker, this);
                    /* Click to CANCEL EDIT marker */
                    this.bindClickUI('#cancel_edit_marker', this.clickCancelEditMarker, this);
                    /* Click to APPLY CHANGE marker */
                    this.bindClickUI('#apply_changes_edit_marker', this.clickApplyChangeMarker, this);
                },
                /* Marker Variable */
                refreshVarsMarker: function () {
                    this.mkResetField = $('#mk_reset_field');
                    this.mkLat = $('#latitude');
                    this.mkLong = $('#longitude');
                    this.mkTitle = $('#marker_title');
                    this.mkCat = $('#marker_category_select');
                    this.mkNewCatName = $('#marker_new_cat_name');
                    this.mkTimeOut = $('#marker_timeout');
                    this.mkEffect = $('#marker_effect');
                    this.mkAddEditorContentHtml = $('button#addmarker_description-html');
                    this.mkAddEditorContentMce = $('button#addmarker_description-tmce');
                    this.mkAddDes = $('textarea#addmarker_description');

                    this.mkAddDesOpen = $('#addmarker_des_open');
                    this.mkAddShortcodeInDesc = $('.add-marker-page #shortcode_in_des');
                    this.mkAddFastShortcodeInDesc = $('.add-fast-markers-page #shortcode_in_des');
                    this.mkAddFastEditorContentHtml = $('button#fastmarker_description-html');
                    this.mkAddFastEditorContentMce = $('button#fastmarker_description-tmce');
                    this.mkAddFastDes = $('textarea#fastmarker_description');

                    this.mkIcon = $('.marker_icon_chose');

                    /* Marker data from table */
                    this.markerData = 'marker-data';
                    this.curMarker = $('#curMarker');
                    this.tempMarker = {};
                },
                /* EVENT */
                bindClickUI: function (obj, func, $glb) {
                    this.event = 'ontouchstart' in window ? 'touchstart' : 'click';
                    $(document).on(this.event, obj, function (e) {
                        e.preventDefault();
                        /* action function */
                        func($(this), $glb);
                    });
                },
                onMarkerClick: function () {
                    this.marker_data = get_key_obj(markers, this);

                    if (this.marker_data != false) {
                        /* Table */
                        this.table_marker_list = $('.marker_list .table_data_row');
                        /* Remove if have the view to some of marker before */
                        if (this.table_marker_list.hasClass('selecting') === true) {
                            this.table_marker_list.removeClass('selecting');
                        }

                        $('.marker_list .table_data_row[data-marker-id="' + this.marker_data + '"]').addClass('selecting');

                        /* Get offset */
                        var table_offset = $('.marker_tab_id_1 .front .marker_list').offset().top;
                        var tr_offset = $('.marker_list .table_data_row[data-marker-id="' + this.marker_data + '"]').offset().top;
                        var distance_tr = tr_offset - table_offset;

                        $('.marker_tab_id_1 .front').animate({
                            scrollTop: distance_tr
                        }, 600);
                    }
                    mymapsInit.markers.showInfor(this);
                    mymapsInit.markers.toggleBounce(this);
                },
                onMarkerDrag: function () {
                    var marker = this;
                    var cur_position = marker.getPosition();
                    $('#latitude').val(cur_position.lat());
                    $('#longitude').val(cur_position.lng());
                },
                clickGetPosition: function (e) {
                    /* Map click to get position */
                    var latitude = e.latLng.lat();
                    var longitude = e.latLng.lng();
                    /* print information into field settings */
                    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);
                },

                /* UI & TABLE */
                clickAddMarker: function (obj, $glb) {
                    /* checking for session and flip */
                    map.setOptions({draggableCursor: 'crosshair'});
                    google.maps.event.clearListeners(map, 'click');
                    /* Map event */
                    mymapsInit.bindMapEvent('click', mymapsInit.markers.clickGetPosition);
                    infoWindow.close();
                },
                clickAddFastMarker: function (obj, $glb) {

                    map.setOptions({draggableCursor: 'crosshair'});

                    mymapsInit.bindMapEvent('click', function (e) {
                        $glb.clickAddMarkersOnMap(e, $glb);
                    });
                },
                clickAddMarkersOnMap: function (e, $glb) {
                    if ($glb.markerValidate($glb, false) === false) {
                        return false;
                    }
                    /* Map click to get position */
                    var latitude = e.latLng.lat();
                    var longitude = e.latLng.lng();

                    $glb.saveMarker(latitude, longitude, $glb, $('.add-fast-markers-page'));

                    if ($glb.mkResetField.is(':checked') === true)
                        reset_field_pannel('add_fast_markers');
                },
                clickCancelAddFastMarker: function (e, $glb) {
                    /* Switch cursor */
                    map.setOptions({draggableCursor: 'pointer'});
                    google.maps.event.clearListeners(map, 'click');
                },
                clickCancelMarker: function (obj, $glb) {
                    /* checking for session and flip */
                    this.fliped = $glb.flip('front');
                    if (this.fliped === false) {
                        return false;
                    }
                    /* Switch cursor */
                    map.setOptions({draggableCursor: 'pointer'});
                },
                clickViewMarker: function (obj, $glb) {
                    $this = this;
                    $this.markerData = obj.parents('.table_data_row').data('marker-id');
                    $this.curMarker = markers[$this.markerData];
                    /* set center */
                    map.setCenter($this.curMarker.getPosition());

                    /* Check isset infoWindow */

                    mymapsInit.markers.showInfor($this.curMarker);

                    mymapsInit.markers.toggleBounce($this.curMarker);
                },
                clickEditMarker: function (obj, $glb) {
                    var $this = this;

                    $this.curData = obj.parents('.table_data_row').data('marker-id');
                    $this.curMarker = markers[$this.curData];

                    $glb.curMarker.val($this.curData);

                    /* UI set infomation to configuration field */
                    $this.curPosition = $this.curMarker.getPosition();
                    /* Backup marker */
                    $glb.tempMarker.position = $.extend(true, {}, $this.curPosition);

                    $glb.mkLat.val($this.curPosition.lat());
                    $glb.mkLong.val($this.curPosition.lng());
                    $glb.mkTitle.val($this.curMarker.title);


                    $('#marker_category_select option[value="' + $this.curMarker.cat + '"]').attr('selected', 'selected');
                    $glb.mkTimeOut.val($this.curMarker.timeout);

                    $('#marker_effect option[value="' + $this.curMarker.animation_type + '"]').attr('selected', 'selected');
                    $glb.mkAddEditorContentHtml.trigger('click');
                    $glb.mkAddDesOpen.prop('checked', $this.curMarker.des_open);
                    $glb.mkAddShortcodeInDesc.prop('checked', $this.curMarker.shortcode_in_desc);
                    $glb.mkAddDes.val($this.curMarker.description);
                    $glb.mkAddEditorContentMce.trigger('click');

                    if ($('.marker_wrap img[src="' + $this.curMarker.icon + '"]').length > 0) {
                        $('.marker_wrap img[src="' + $this.curMarker.icon + '"]').parent().trigger('click');
                    } else {
                        $('.marker_icon_chose').attr('src', $this.curMarker.icon.url);
                    }
                    /* Close icon container */
                    if (!$('.marker_libs_icon').hasClass('hidden')) {
                        $('.edit_chose_marker_icon').trigger('click');
                    }
                    /* Set to data to map */
                    map.setCenter($this.curMarker.getPosition());
                    $this.curMarker.setDraggable(true);

                    /* Add effect */
                    $this.curMarker.setAnimation(google.maps.Animation.BOUNCE);

                    google.maps.event.addListener($this.curMarker, 'drag', mymapsInit.markers.onMarkerDrag);
                },
                clickDeleteMarker: function (obj, $glb) {
                    if (confirm(' Are you sure you want to delete this marker? ')) {
                        this.markerData = obj.parents('.table_data_row').data('marker-id');
                        if (markers[this.markerData] && markers[this.markerData] != undefined) {
                            markers[this.markerData].setMap(null);
                            delete markers[this.markerData];
                            /* Delete table row */
                            obj.parents('.table_data_row').hide('slow');
                            obj.parents('.table_data_row').remove('slow');
                            adminUI.marker_delete_row(this.markerData);
                        }
                    }
                },
                /* OPTION MARKER */
                clickSaveMarker: function (obj, $glb) {
                    if ($glb.markerValidate($glb, true) === false) {
                        return false;
                    }

                    $glb.saveMarker($glb.mkLat.val(), $glb.mkLong.val(), $glb, $('.add-marker-page'));
                    PageTransitions.trigger_next_page(obj);

                    /* Switch cursor */
                    map.setOptions({draggableCursor: 'pointer'});

                },
                saveMarker: function (lat, lng, $glb, $wrapper) {
                    /* check condition */
                    var $this = this;
                    /* Get all field value */
                    $this.mkIcon = $wrapper.find('.chose_wrapper img:first-child').attr('src');

                    /* Trigger text tab and trigger back to print content to textarea */
                    if ($wrapper.find('button#addmarker_description-html').length > 0) {
                        $glb.mkAddEditorContentHtml.trigger('click');
                        /* Filter content */
                        $this.mk_des = ($glb.mkAddDes.val().trim() == '<br />') ? '' : $glb.mkAddDes.val().trim();
                        $glb.mkAddEditorContentMce.trigger('click');

                    } else if ($wrapper.find('button#fastmarker_description-html').length > 0) {
                        $glb.mkAddFastEditorContentHtml.trigger('click');
                        /* Filter content */
                        $this.mk_des = ($glb.mkAddFastDes.val() == '<br />') ? '' : $glb.mkAddFastDes.val();
                        $glb.mkAddFastEditorContentMce.trigger('click');
                    }

                    /* Get animation and get the id of effect */
                    $this.effect = $wrapper.find('#marker_effect').val();
                    $this.marker_title = ($wrapper.find('#marker_title').val() != '') ? $wrapper.find('#marker_title').val() : 'Marker ' + (parseInt(countobj(markers)) + 1);

                    /* Category add */
                    $this.cat = ($wrapper.find('#marker_category_select').val() != '') ? $wrapper.find('#marker_category_select').val() : $wrapper.find('#marker_new_cat_name').val();
                    $this.shortcodeInDesc = $wrapper.find('#shortcode_in_des').is(':checked');

                    if (load_shortcode === false)
                        load_shortcode = $this.shortcodeInDesc;

                    if ($wrapper.find('#marker_new_cat_name').val() != '') {
                        if (markerCat.indexOf($this.cat) == -1) {
                            markerCat.push($this.cat);
                            /* Add categories */
                            adminUI.add_category_marker($this.cat);
                        }
                    }

                    $this.query = {
                        map: map,
                        position: new google.maps.LatLng(lat, lng),
                        shortcode_in_desc: $this.shortcodeInDesc,
                        des_open: $this.mkAddDesOpen.is(':checked'),
                        description: $this.mk_des,
                        title: $this.marker_title,
                        cat: $this.cat,
                        animation: google.maps.Animation[$this.effect],
                        animation_type: $this.effect,
                        icon: $this.mkIcon,
                        timeout: $this.mkTimeOut.val().trim()
                    };

                    /* Set Option */
                    $this.marker = new google.maps.Marker($this.query);

                    /* Temporary for contain old marker object */
                    google.maps.event.addListener($this.marker, 'click', $glb.onMarkerClick);

                    /* Assign to markers global array */
                    var length = countobj(markers);

                    $this.query.id = 'mk_' + length;

                    markers[$this.query.id] = $this.marker;
                    $this.query.table_object = $('.marker_list#markers-table');
                    adminUI.marker_table_add_row($this.query);
                },
                markerValidate: function ($glb, check_lat_lng) {
                    if ($glb.mkTimeOut.val() != '' && flm_validation($glb.mkTimeOut.val(), 'number', " <i class='fa fa-exclamation-triangle'></i> The Time Out is not number!") === false) {
                        return false;
                    }
                    if (check_lat_lng == true) {
                        if (flm_validation($glb.mkLong.val(), 'empty', " <i class='fa fa-exclamation-triangle'></i> Click on map to get coordinate!") === false
                            || flm_validation($glb.mkLat.val(), 'empty', " <i class='fa fa-exclamation-triangle'></i> Click on map to get coordinate!") === false
                            || flm_validation($glb.mkLong.val(), 'number', " <i class='fa fa-exclamation-triangle'></i> Click on map to get coordinate!") === false
                            || flm_validation($glb.mkLat.val(), 'number', " <i class='fa fa-exclamation-triangle'></i> Click on map to get coordinate!") === false
                        ) {
                            return false;
                        }
                    }

                    if (/* Check title */
                        flm_validation($glb.mkTitle.val(), 'string', "<i class='fa fa-exclamation-triangle'></i> The Title can't contain any of the following characters: <br> \\ / : * ? \" < >")
                    ) {
                        return true;
                    }
                    return false;
                },
                clickApplyChangeMarker: function (obj, $glb) {
                    /* checking for session and flip */
                    this.markerData = $glb.curMarker.val();
                    if (markers[this.markerData] && markers[this.markerData] != undefined) {
                        this.curMarker = markers[this.markerData];

                        /* Get LatLng from field */
                        this.myLatlng = new google.maps.LatLng($glb.mkLat.val(), $glb.mkLong.val());

                        /* trigger text tab and trigger back to print content to textarea */
                        $glb.mkAddEditorContentHtml.trigger('click');
                        $glb.mkAddEditorContentMce.trigger('click');

                        /* Icon */
                        this.url = $('.add-marker-page .chose_wrapper img:first-child').attr('src');

                        if (typeof this.curMarker.icon === 'string') {
                            this.icon = this.url;
                        } else if (this.url == this.curMarker.icon.url) {
                            this.icon = {
                                url: this.url,
                                size: this.curMarker.icon.size,
                                origin: this.curMarker.icon.origin,
                                anchor: this.curMarker.icon.anchor,
                                scaledSize: this.curMarker.icon.scaledSize
                            };
                        } else {
                            this.icon = this.url;
                        }
                        /* Category change */
                        this.cat = ($glb.mkCat.val() != '') ? $glb.mkCat.val() : $glb.mkNewCatName.val();

                        if ($glb.mkNewCatName.val() != '') {
                            if (markerCat.indexOf(this.cat) == -1) {
                                markerCat.push(this.cat);
                                /* Add categories */
                                $('#marker_category_select').append('<option value="' + $this.cat + '">' + $this.cat + '</option>');
                            }
                        }

                        /* Set new info */
                        this.curMarker.setTitle($glb.mkTitle.val().trim());

                        this.curMarker.cat = this.cat;
                        this.curMarker.setPosition(this.myLatlng);
                        this.curMarker.timeout = $glb.mkTimeOut.val().trim();
                        this.curMarker.des_open = $glb.mkAddDesOpen.is(':checked');
                        this.curMarker.setIcon(this.icon);
                        this.curMarker.shortcode_in_desc = $glb.mkAddShortcodeInDesc.is(':checked');

                        if (load_shortcode === false)
                            load_shortcode = $glb.mkAddShortcodeInDesc.is(':checked');

                        this.curMarker.description = $glb.mkAddDes.val().trim();
                        this.mkDes = ( $glb.mkAddDes.val().trim() == '<br />' ) ? '' : $glb.mkAddDes.val().trim();
                        infoWindow.setContent(this.mkDes);

                        this.curMarker.setDraggable(false);
                        markers[this.markerData] = this.curMarker;

                        /* Destroy animation */
                        this.curMarker.setAnimation(null);
                        this.curMarker.animation_type = $glb.mkEffect.val();

                        /* Update table */
                        adminUI.marker_modify_row({
                            id: this.markerData,
                            title: $glb.mkTitle.val().trim(),
                            cat: this.cat,
                            icon: $('.chose_wrapper img:first-child').attr('src')
                        });

                        PageTransitions.trigger_next_page(obj);

                    }
                },
                clickCancelEditMarker: function (obj, $glb) {
                    /* Checking for session and flip */
                    this.fliped = $glb.flip('front');
                    if (this.fliped === false) {
                        return false;
                    }
                    this.markerData = $glb.curMarker.val();
                    if (markers[this.markerData]) {
                        this.curMarker = markers[this.markerData];
                        this.oldPosition = new google.maps.LatLng($glb.tempMarker.position.lat(), $glb.tempMarker.position.lng());
                        this.curMarker.setPosition(this.oldPosition);
                        this.curMarker.setDraggable(false);
                        markers[this.markerData] = this.curMarker;
                        this.curMarker.setAnimation(null);
                    }

                },
                /* Helper */
                flip: function (face) {
                    this.flipContainer = $('.flip-container');
                    if (face == 'back') {
                        if (this.flipContainer.hasClass('flip') === false) {
                            /* Flip to back */
                            this.flipContainer.addClass('flip');
                            $('.marker_tab_id_1 .front').scrollTop(0);
                        } else {
                            return false;
                        }
                    } else if (face == 'front') {
                        if (this.flipContainer.hasClass('flip') === true) {
                            /* Flip to front */
                            this.flipContainer.removeClass('flip');
                            $('.marker_tab_id_1 .back').scrollTop(0);
                        } else {
                            return false;
                        }
                    }
                },
                showInfor: function (obj) {
                    if (obj.description && obj.description.trim() != '' && obj.description.trim() != '<br />') {
                        infoWindow.setContent(obj.description.trim());
                        infoWindow.open(map, obj);
                    }
                },
                toggleBounce: function (obj) {
                    for (var key in markers) {
                        markers[key].setAnimation('');
                    }
                    obj.setAnimation(google.maps.Animation.BOUNCE);
                },
                checkHiddenTable: function () {
                    if ($('table.marker_list').hasClass('hidden')) {
                        $('table.marker_list').removeClass('hidden');
                    }
                },
                checkHiddenPolyTable : function () {

                }
            },
            draw: {
                drInit: function () {
                    this.refreshVarsPoly();
                    this.bindClickUI('.btn-addpolylines', this.definePolyline, this);
                    this.bindClickUI('.btn-addRectangle', this.defineRectangle, this);
                    this.bindClickUI('.btn-polycancel', this.clickCancelDraw, this);
                    this.bindClickUI('.btn-addCircle', this.defineCircle, this);
                    /* On change poly color */
                    this.bindClickUI('#fill_poly_hsl', this.onChangeColor, this);
                    this.bindClickUI('#stroke_poly_hsl', this.onChangeColor, this);
                    this.bindClickUI('#polo-weight-hidden', this.onChangeWeight, this);
                    /* Save */
                    this.bindClickUI('.btn-savePoly', this.clickSavePl, this);
                    /* Save change or cancel change */
                    this.bindClickUI('.btn-saveChangePoly', this.clickSaveChangePl, this);
                    this.bindClickUI('.btn-cancelChangePoly', this.clickCancelChangePl, this);
                    /* Event UI */
                    this.bindClickUI('.draw_list .table_data_row > div:first-child, .draw_list .table_data_row div:nth-child(2)', this.clickViewPoly, this);
                    this.bindClickUI('.delete_poly', this.clickDeletePoly, this);
                    this.bindClickUI('.edit_poly', this.clickEditPoly, this);
                },
                refreshVarsPoly: function () {
                    this.strokePolyHsl = $('#stroke_poly_hsl');
                    this.strokePolyHex = $('#stroke_poly_hex');
                    this.fillPolyHsl = $('#fill_poly_hsl');
                    this.fillPolyHex = $('#fill_poly_hex');
                    this.strokeWeight = $('#polo-weight-hidden');
                    this.plTitle = $('.pl_title');
                    this.polyContent = $('#poly_content');
                    /* Hidden Field For Track Map Status */
                    this.eventTrack = $('#eventTrack');
                    this.polyStatus = $('#polyStatus');
                    this.curPoly = $('#curPoly');
                    this.btnVisual = $('#poly_content-tmce');
                    this.btnText = $('#poly_content-html');
                    this.flipContainer = $('.draw-flip-container');
                    this.polyTemp = {};
                },
                /* Event define */
                bindClickUI: function (obj, func, $glb) {
                    this.event = 'ontouchstart' in window ? 'touchstart' : 'click';
                    $(document).on(this.event, obj, function (e) {
                        e.preventDefault();
                        /* action function */
                        func($(this), $glb);
                    });
                },
                bindChangeUI: function (obj, func, $glb) {
                    $(document).on('change', obj, function (e) {
                        e.preventDefault();
                        /* action function */
                        func($(this), $glb);
                    });
                },
                onPolyClick: function (e) {
                    if (this.description.trim() != '' && this.description.trim() != '<br />') {
                        /* Map click to get position */
                        infoWindow.setContent(this.description);
                        infoWindow.setPosition(e.latLng);
                        infoWindow.open(map);
                    }
                    if (get_key_obj(polyLines, this) != false) {
                        this.cur = get_key_obj(polyLines, this);
                        this.status = 'line';
                    } else if (get_key_obj(polyGons, this) != false) {
                        this.cur = get_key_obj(polyGons, this);
                        this.status = 'gon';
                    } else if (get_key_obj(recTangles, this) != false) {
                        this.cur = get_key_obj(recTangles, this);
                        this.status = 'rectangle';
                    } else if (get_key_obj(circles, this) != false) {
                        this.cur = get_key_obj(circles, this);
                        this.status = 'circle';
                    }
                    /* Remove if have the view to some of marker before */
                    if ($('.draw_list .table_data_row').hasClass('selecting') === true) {
                        $('.draw_list .table_data_row').removeClass('selecting');
                    }
                    $('.draw_list .table_data_row[data-poly-id="' + this.cur + '"][data-poly-type="' + this.status + '"]').addClass('selecting');
                },
                onChangeColor: function ($obj, $glb) {
                    $this = this;
                    $this.status = $glb.polyStatus.val();
                    $this.cur = $glb.curPoly.val();
                    /* switch color to object depends on poly's type */
                    switch ($this.status) {
                        case 'line':
                        {
                            $this.path = polyLines[$this.cur];
                            $this.path.setOptions({
                                strokeColor: $glb.strokePolyHex.val(),
                                strokeOpacity: getOpacity($glb.strokePolyHsl.val())
                            });
                            polyLines[$this.cur] = $this.path;
                        };break;
                        case 'gon':
                        {
                            $this.path = polyGons[$this.cur];

                            $this.path.setOptions({
                                strokeColor: $glb.strokePolyHex.val(),
                                strokeOpacity: getOpacity($glb.strokePolyHsl.val()),
                                fillColor: $glb.fillPolyHex.val(),
                                fillOpacity: getOpacity($glb.fillPolyHsl.val())
                            });
                            polyGons[$this.cur] = $this.path;
                        };break;
                        case 'circle':
                        {
                            $this.path = circles[$this.cur];
                            $this.path.setOptions({
                                strokeColor: $glb.strokePolyHex.val(),
                                strokeOpacity: getOpacity($glb.strokePolyHsl.val()),
                                fillColor: $glb.fillPolyHex.val(),
                                fillOpacity: getOpacity($glb.fillPolyHsl.val())
                            });
                            circles[$this.cur] = $this.path;
                        };break;
                        case 'rectangle':
                        {
                            $this.path = recTangles[$this.cur];
                            $this.path.setOptions({
                                strokeColor: $glb.strokePolyHex.val(),
                                strokeOpacity: getOpacity($glb.strokePolyHsl.val()),
                                fillColor: $glb.fillPolyHex.val(),
                                fillOpacity: getOpacity($glb.fillPolyHsl.val())
                            });
                            recTangles[$this.cur] = $this.path;
                        };break;
                    }
                },
                onChangeWeight: function ($obj, $glb) {
                    $this = this;
                    $this.status = $glb.polyStatus.val();
                    $this.cur = $glb.curPoly.val();
                    /* switch color to object depends on poly's type */
                    switch ($this.status) {
                        case 'line':
                        {
                            $this.path = polyLines[$this.cur];
                            $this.path.setOptions({
                                strokeWeight: $glb.strokeWeight.val()
                            });
                        };break;
                        case 'gon':
                        {
                            $this.path = polyGons[$this.cur];
                            $this.path.setOptions({
                                strokeWeight: $glb.strokeWeight.val()
                            });
                        };break;
                        case 'circle':
                        {
                            $this.path = circles[$this.cur];
                            $this.path.setOptions({
                                strokeWeight: $glb.strokeWeight.val()
                            });
                        };break;
                        case 'rectangle':
                        {
                            $this.path = recTangles[$this.cur];
                            $this.path.setOptions({
                                strokeWeight: $glb.strokeWeight.val()
                            });
                        };break;
                    }
                },
                /* Define after click */
                definePolyline: function ($obj, $glb) {

                    $this = this;
                    map.setOptions({draggableCursor: 'crosshair'});
                    var flightPlanCoordinates = [];
                    var polyOptions = {
                        path: flightPlanCoordinates,
                        strokeColor: $glb.strokePolyHex.val(),
                        strokeOpacity: getOpacity($glb.strokePolyHsl.val()),
                        strokeWeight: $glb.strokeWeight.val(),
                        fillColor: $glb.fillPolyHex.val(),
                        fillOpacity: getOpacity($glb.fillPolyHsl.val()),
                        geodesic: true,
                        editable: true,
                        draggable: true,
                        clickable: false
                    };
                    var poly = new google.maps.Polyline(polyOptions);

                    var new_id = 'dr_' + countobj(polyLines);
                    polyLines[new_id] = poly;

                    // Add a listener for the click event
                    map.addListener('click', function (e) {
                        mymapsInit.draw.clickAddPlLine(e, $glb);
                    });
                    google.maps.event.addListener(poly, 'click', function (e) {
                        mymapsInit.draw.onLinesClick(e, $glb)
                    });

                    poly.setMap(map);
                    $glb.curPoly.val(new_id);
                    $.growl.warning({message: " <i class='fa fa-exclamation'></i> Click on map to draw!"});
                },
                defineRectangle: function ($obj, $glb) {
                    /* checking for session and flip */
                    this.fliped = $glb.flip('back');
                    if (this.fliped === false) {
                        return false;
                    }

                    /* Show hidden fill color picker */
                    $('tr.poly_fill').show('slow');
                    map.setOptions({draggableCursor: 'crosshair'});
                    // Define a rectangle and set its editable property to true.
                    var rt = new google.maps.Rectangle({
                        editable: true,
                        draggable: true,
                        strokeColor: $glb.strokePolyHex.val(),
                        strokeOpacity: getOpacity($glb.strokePolyHsl.val()),
                        strokeWeight: $glb.strokeWeight.val(),
                        fillColor: $glb.fillPolyHex.val(),
                        fillOpacity: getOpacity($glb.fillPolyHsl.val())
                    });

                    /* Define event */
                    map.addListener('click', function (e) {
                        mymapsInit.draw.clickAddRectangle(e, $glb);
                    });
                    rt.setMap(map);
                    var new_id = 'dr_' + countobj(recTangles);
                    recTangles[new_id] = rt;
                    /* Assign curPoly */
                    $glb.curPoly.val(new_id);
                    $.growl.warning({message: " <i class='fa fa-exclamation'></i> Click on map to draw!"});
                },
                defineCircle: function ($obj, $glb) {
                    /* checking for session and flip */
                    this.fliped = $glb.flip('back');
                    if (this.fliped === false) {
                        return false;
                    }

                    /* Show hidden fill color picker */
                    $('tr.poly_fill').show('slow');
                    map.setOptions({draggableCursor: 'crosshair'});

                    /* Define event */
                    map.addListener('click', function (e) {
                        mymapsInit.draw.clickAddCirCle(e, $glb);
                    });
                    var cityCircle = new google.maps.Circle({
                        editable: true,
                        draggable: true,
                        strokeColor: $glb.strokePolyHex.val(),
                        strokeOpacity: getOpacity($glb.strokePolyHsl.val()),
                        strokeWeight: $glb.strokeWeight.val(),
                        fillColor: $glb.fillPolyHex.val(),
                        fillOpacity: getOpacity($glb.fillPolyHsl.val()),
                        map: map
                    });

                    /* Define event */
                    map.addListener('click', function (e) {
                        mymapsInit.draw.clickAddCirCle(e, $glb);
                    });
                    var new_id = 'dr_' + countobj(circles);
                    /*citycircles.setMap( map );*/
                    circles[new_id] = cityCircle;
                    /* Assign curPoly */
                    $glb.curPoly.val(new_id);
                    $.growl.warning({message: " <i class='fa fa-exclamation'></i> Click on map to draw!"});
                },
                /* Click to add */
                clickAddCirCle: function (e, $glb) {
                    this.cur = $glb.curPoly.val();
                    this.path = circles[this.cur];
                    this.zoom = parseInt(map.getZoom());

                    if (this.zoom == 0 || this.zoom == 1) {
                        this.diameter = 2000000;
                    } else if ((this.zoom >= 2 ) && (this.zoom <= 4 )) {
                        this.diameter = 800000;
                    } else if ((this.zoom >= 5 ) && (this.zoom <= 7 )) {
                        this.diameter = 100000;
                    } else if ((this.zoom >= 8 ) && (this.zoom <= 10 )) {
                        this.diameter = 10000;
                    } else if ((this.zoom >= 11 ) && (this.zoom <= 13 )) {
                        this.diameter = 1000;
                    } else if ((this.zoom >= 14 ) && (this.zoom <= 15 )) {
                        this.diameter = 300;
                    } else if ((this.zoom >= 16 ) && (this.zoom <= 17 )) {
                        this.diameter = 100;
                    } else {
                        this.diameter = 10;
                    }
                    this.path.setOptions({
                        center: {lat: e.latLng.lat(), lng: e.latLng.lng()},
                        radius: this.diameter
                    });
                    $glb.eDestroy();
                    map.setOptions({draggableCursor: 'pointer'});
                },
                clickAddRectangle: function (e, $glb) {
                    this.cur = $glb.curPoly.val();
                    this.path = recTangles[this.cur];
                    this.coordinates = e.latLng;
                    this.zoom = parseInt(map.getZoom());

                    if (this.zoom >= 0 && this.zoom <= 3) {
                        this.addition = 15;
                    } else if ((this.zoom == 4 ) || (this.zoom == 5 )) {
                        this.addition = 8.5;
                    } else if ((this.zoom == 6 ) || (this.zoom == 7 )) {
                        this.addition = 1.5;
                    } else if ((this.zoom == 8 ) || (this.zoom == 9 )) {
                        this.addition = 0.5;
                    } else if ((this.zoom == 10 ) || (this.zoom == 11 )) {
                        this.addition = 0.1;
                    } else if (this.zoom == 12) {
                        this.addition = 0.05;
                    } else if (this.zoom == 13) {
                        this.addition = 0.04;
                    } else if (this.zoom == 14) {
                        this.addition = 0.01;
                    } else if (this.zoom == 15) {
                        this.addition = 0.008;
                    } else if (this.zoom == 16) {
                        this.addition = 0.005;
                    } else if (this.zoom == 17) {
                        this.addition = 0.002;
                    } else if (this.zoom == 18) {
                        this.addition = 0.001;
                    } else if (this.zoom == 19) {
                        this.addition = 0.0005;
                    } else if (this.zoom == 20) {
                        this.addition = 0.0001;
                    } else {
                        this.addition = 0.00008;
                    }

                    /* Define */
                    var bounds = new google.maps.LatLngBounds(
                        new google.maps.LatLng(this.coordinates.lat(), this.coordinates.lng()),
                        new google.maps.LatLng(this.coordinates.lat() + this.addition, this.coordinates.lng() + this.addition)
                    );

                    this.path.setBounds(bounds);
                    /* Destroy event */
                    $glb.eDestroy();
                    map.setOptions({draggableCursor: 'pointer'});
                },
                clickAddPlLine: function (e, $glb) {
                    var path = polyLines[$glb.curPoly.val()].getPath();
                    // Because path is an MVCArray, we can simply append a new coordinate
                    // and it will automatically appear.
                    path.push(e.latLng);
                },
                onLinesClick: function (e, $glb) {
                    var $this = this;
                    $this.cur = $glb.curPoly.val();
                    if ($glb.polyStatus.val() == 'line') {
                        var curPoly = polyLines[$this.cur];
                        var path = curPoly.getPath();

                        /* Checking for switch to polygon */
                        if (e.latLng.lat() == path.j[0].lat() && e.latLng.lng() == path.j[0].lng()) {
                            /* unset this path in Line array */
                            curPoly.setMap(null);
                            delete_obj($this.cur, polyLines);

                            var newPolyGon = new google.maps.Polygon({
                                paths: path,
                                editable: true,
                                draggable: true,
                                clickable: true,
                                strokeColor: $glb.strokePolyHex.val(),
                                strokeOpacity: getOpacity($glb.strokePolyHsl.val()),
                                strokeWeight: $glb.strokeWeight.val(),
                                fillColor: $glb.fillPolyHex.val(),
                                fillOpacity: getOpacity($glb.fillPolyHsl.val())
                            });
                            newPolyGon.setMap(map);

                            var new_id = 'dr_' + countobj(polyGons);
                            polyGons[new_id] = newPolyGon;


                            /* Change status and current Global variable length */
                            $glb.polyStatus.val('gon');
                            $glb.curPoly.val(new_id);

                            /* Destroy event */
                            $glb.eDestroy();

                            /* Switch cursor */
                            map.setOptions({draggableCursor: 'pointer'});
                            /* Show poly fill */
                            $('tr.poly_fill').show('slow');
                        } else {
                            path.push(e.latLng);
                        }
                    }
                },
                /* Action UI */
                clickViewPoly: function ($obj, $glb) {
                    this.cur = $obj.parents('.table_data_row').data('poly-id');
                    this.status = $obj.parents('.table_data_row').data('poly-type');

                    switch (this.status) {
                        case 'line':
                        {
                            this.curPoly = polyLines[this.cur];
                            this.curPath = this.curPoly.getPath();
                            this.curPath = this.curPath.j[0];
                            this.curLat = this.curPath.lat();
                            this.curLng = this.curPath.lng();
                            this.curDes = this.curPoly.description;
                        }
                            ;
                            break;
                        case 'gon':
                        {
                            this.curPoly = polyGons[this.cur];
                            this.curPath = this.curPoly.getPath();
                            this.curPath = this.curPath.j[0];
                            this.curLat = this.curPath.lat();
                            this.curLng = this.curPath.lng();
                            this.curDes = this.curPoly.description;
                        };break;
                        case 'circle':
                        {
                            this.curPoly = circles[this.cur];
                            this.curPath = this.curPoly.getCenter();
                            this.curLat = this.curPath.lat();
                            this.curLng = this.curPath.lng();
                            this.curDes = this.curPoly.description;
                        };break;
                        case 'rectangle':
                        {
                            this.curPoly = recTangles[this.cur];
                            this.curBounds = this.curPoly.getBounds();
                            this.curBounds = this.curBounds.getCenter();
                            this.curLat = this.curBounds.lat();
                            this.curLng = this.curBounds.lng();
                            this.curDes = this.curPoly.description;
                        };break;
                    }
                    /* Set infor */
                    if (this.curDes != '' && this.curDes != '<br />') {
                        /* Map click to get position*/
                        infoWindow.setContent(this.curDes);
                        infoWindow.setPosition({lat: parseFloat(this.curLat), lng: parseFloat(this.curLng)});
                        infoWindow.open(map);
                    }
                    /* set center */
                    map.setCenter({lat: parseFloat(this.curLat), lng: parseFloat(this.curLng)});

                    /* Remove if have the view to some of marker before */
                    if ($('table.poly_list tr').hasClass('selecting') === true) {
                        $('table.poly_list tr').removeClass('selecting');
                    }
                    $('table.poly_list tr[poly-data="' + this.cur + '"][poly-type="' + this.status + '"]').addClass('selecting');
                },
                clickEditPoly: function ($obj, $glb) {

                    this.cur = $obj.parents('.table_data_row').data('poly-id');
                    this.status = $obj.parents('.table_data_row').data('poly-type');
                    switch (this.status) {
                        case 'line':
                        {
                            this.curPoly = polyLines[this.cur];
                            this.curPath = this.curPoly.getPath();
                            this.curPath = this.curPath.j[0];
                            this.curLat = this.curPath.lat();
                            this.curLng = this.curPath.lng();
                            this.name = 'Polyline';
                            /* Backup */
                            this.pathTemp = this.curPoly.getPath();
                            $glb.polyTemp.path = $.extend(true, {}, this.pathTemp.j);
                        };break;
                        case 'gon':
                        {
                            this.curPoly = polyGons[this.cur];
                            this.curPath = this.curPoly.getPath();
                            this.curPath = this.curPath.j[0];
                            this.curLat = this.curPath.lat();
                            this.curLng = this.curPath.lng();
                            this.name = 'Polygon';
                            $('tr.poly_fill').show();
                            /* Backup */
                            this.pathTemp = this.curPoly.getPath();
                            $glb.polyTemp.path = $.extend(true, {}, this.pathTemp.j);
                            $glb.polyTemp.fillColor = this.curPoly.fillColor;
                            $glb.polyTemp.fillOpacity = this.curPoly.fillOpacity;
                        };break;
                        case 'circle':
                        {
                            this.curPoly = circles[this.cur];
                            this.curPath = this.curPoly.getCenter();
                            this.curLat = this.curPath.lat();
                            this.curLng = this.curPath.lng();
                            this.name = 'Circle';
                            $('tr.poly_fill').show();
                            /* Backup */
                            this.tmpcenter = $.extend(true, {}, this.curPoly.getCenter());
                            $glb.polyTemp.center = new google.maps.LatLng(this.tmpcenter.lat(), this.tmpcenter.lng());
                            $glb.polyTemp.radius = this.curPoly.getRadius();
                            $glb.polyTemp.fillColor = this.curPoly.fillColor;
                            $glb.polyTemp.fillOpacity = this.curPoly.fillOpacity;
                        };break;
                        case 'rectangle':
                        {
                            this.curPoly = recTangles[this.cur];
                            this.curBounds = this.curPoly.getBounds();
                            this.curBounds = this.curBounds.getCenter();
                            this.curLat = this.curBounds.lat();
                            this.curLng = this.curBounds.lng();
                            this.name = 'Rectangle';
                            $('tr.poly_fill').show();
                            /* Backup */
                            $glb.polyTemp.bounds = $.extend(true, {}, this.curPoly.getBounds());
                            $glb.polyTemp.fillColor = this.curPoly.fillColor;
                            $glb.polyTemp.fillOpacity = this.curPoly.fillOpacity;
                        };break;
                    }

                    /* Backup common color */
                    $glb.polyTemp.strokeColor = this.curPoly.strokeColor;
                    $glb.polyTemp.strokeOpacity = this.curPoly.strokeOpacity;
                    $glb.polyTemp.strokeWeight = this.curPoly.strokeWeight;

                    /* Set edit able */
                    this.curPoly.setOptions({
                        draggable: true,
                        clickable: true,
                        editable: true
                    });

                    /* set center */
                    map.setCenter({lat: parseFloat(this.curLat), lng: parseFloat(this.curLng)});

                    /* Render form */
                    $glb.polyStatus.val(this.status);
                    $glb.curPoly.val(this.cur);
                    $('.line-gon h3').html('Edit ' + this.name);
                    $glb.plTitle.val(this.curPoly.title);
                    /* Render color */
                    $("#polyColors").trigger("colorpickersliders.updateColor", this.curPoly.oriStroke);
                    $("#polyFillColors").trigger("colorpickersliders.updateColor", this.curPoly.oriFill);

                    /* Weight */
                    polySlider.noUiSlider.set(this.curPoly.strokeWeight);

                    /* Trigger to get des */
                    $glb.btnText.trigger('click');
                    $glb.polyContent.val(this.curPoly.description);
                    $glb.btnVisual.trigger('click');
                },
                clickDeletePoly: function ($obj, $glb) {
                    this.cur = $obj.parents('.table_data_row').data('poly-id');
                    this.status = $obj.parents('.table_data_row').data('poly-type');
                    switch (this.status) {
                        case 'line'     :
                        {
                            this.name = 'shape';
                        };break;
                        case 'gon'      :
                        {
                            this.name = 'shape';
                        };break;
                        case 'circle'   :
                        {
                            this.name = 'circle';
                        };break;
                        case 'rectangle':
                        {
                            this.name = 'rectangle';
                        };break;
                    }
                    if (confirm(' Are sure want to delete this ' + this.name + '?')) {
                        switch (this.status) {
                            case 'line'     :
                            {
                                polyLines[this.cur].setMap(null);
                                delete_obj(this.cur, polyLines);
                            };break;
                            case 'gon'      :
                            {
                                polyGons[this.cur].setMap(null);
                                delete_obj(this.cur, polyGons);
                            };break;
                            case 'circle'   :
                            {
                                circles[this.cur].setMap(null);
                                delete_obj(this.cur, circles);
                            };break;
                            case 'rectangle':
                            {
                                recTangles[this.cur].setMap(null);
                                delete_obj(this.cur, recTangles);
                            };break;
                        }
                        $obj.parents('.table_data_row').hide('slow');
                        $obj.parents('.table_data_row').remove('slow');
                    }
                },
                clickSavePl: function ($obj, $glb) {

                    this.status = $glb.polyStatus.val(),
                        this.cur = $glb.curPoly.val(),
                        this.strokePolyHex = $glb.strokePolyHex.val();

                    this.condition = $glb.SavePl(this.cur, this.status, $glb);
                    if (this.condition == false) return false;

                    //$glb.generateTable(this.cur, this.status, $glb.plTitle.val(), this.strokePolyHex);

                    adminUI.poly_table_add_row({
                        'id': this.cur,
                        'type' : this.status,
                        'table_object': $('.draw_list#draw-table'),
                        'title': $glb.plTitle.val(),
                        'icon_color' : this.strokePolyHex
                    });

                    $glb.eDestroy();
                    /* Change cursor */
                    map.setOptions({draggableCursor: 'pointer'});

                    PageTransitions.trigger_next_page($obj);
                },
                clickSaveChangePl: function ($obj, $glb) {

                    this.status = $glb.polyStatus.val(),
                        this.cur = $glb.curPoly.val();

                    $glb.SavePl(this.cur, this.status, $glb, 0);

                    /* Update table */
                    adminUI.poly_modify_row({
                        id: this.cur,
                        type: this.status,
                        title: $glb.plTitle.val(),
                        color: $glb.strokePolyHex.val()
                    });
                    PageTransitions.trigger_next_page($obj);
                },
                SavePl: function (cur, status, $glb) {
                    var $this = this;
                    this.cur = cur;
                    this.status = status;
                    /* Switch text */
                    $('#poly_content-html').trigger('click');
                    this.description = $glb.polyContent.val();
                    $('#poly_content-tmce').trigger('click');

                    switch (this.status) {
                        case 'line':
                        {
                            if($glb.plTitle.val() == '') {
                                $id = this.cur.split('_');
                                $this.title = 'Layer polyline ' + $id[1];
                            }

                            this.path = polyLines[this.cur];
                            polyLines[this.cur] = this.path;
                            if (parseInt($glb.eventTrack.val()) == 0) {
                                /* Destroy all event */
                                google.maps.event.clearListeners(this.path, 'click');
                            }
                            /* Checking for drawed */
                            this.checkPath = this.path.getPath();
                            if (this.checkPath.j.length == 0) {
                                $.growl.warning({message: " <i class='fa fa-exclamation-triangle'></i> Click on map to draw a line!"});
                                return false;
                            }
                        }
                            ;
                            break;
                        case 'gon':
                        {
                            if($glb.plTitle.val() == '') {
                                $id = this.cur.split('_');
                                $this.title = 'Layer polygon ' + $id[1];
                            }

                            this.path = polyGons[this.cur];
                            this.checkPath = this.path.getPath();
                            if (this.checkPath.j.length == 0) {
                                $.growl.warning({message: " <i class='fa fa-exclamation-triangle'></i> Click on map to draw a line!"});
                                return false;
                            }
                        };break;
                        case 'circle':
                        {
                            if($glb.plTitle.val() == '') {
                                $id = this.cur.split('_');
                                $this.title = 'Layer circle ' + $id[1];
                            }

                            this.path = circles[this.cur];
                            this.checkPath = this.path.getCenter();
                            if (this.checkPath == undefined) {
                                $.growl.warning({message: " <i class='fa fa-exclamation-triangle'></i> Click on map to create a circle!"});
                                return false;
                            }
                        };break;
                        case 'rectangle':
                        {
                            if($glb.plTitle.val() == '') {
                                $id = this.cur.split('_');
                                $this.title = 'Layer rectangle ' + $id[1];
                            }

                            this.path = recTangles[this.cur];
                            this.checkPath = this.path.getBounds();
                            if (this.checkPath == undefined) {
                                $.growl.warning({message: "Click on map to create a rectangle!"});
                                return false;
                            }
                        };break;
                    }

                    /* Set path */
                    this.path.setOptions({
                        draggable: false,
                        clickable: true,
                        editable: false,
                        oriFill: $glb.fillPolyHsl.val(),
                        oriStroke: $glb.strokePolyHsl.val(),
                        title: $this.title,
                        description: this.description
                    });
                    if (parseInt(this.eventTrack.val()) == 1) {
                        google.maps.event.addListener(this.path, 'click', $glb.onPolyClick);
                    }
                },
                clickCancelChangePl: function ($obj, $glb) {

                    this.status = $glb.polyStatus.val(),
                        this.cur = $glb.curPoly.val(),
                        this.strokePolyHex = $glb.strokePolyHex.val();

                    switch (this.status) {
                        case 'line':
                        {
                            this.curPl = polyLines[this.cur];
                            /* Set path */
                            this.path = [];
                            for (var key in $glb.polyTemp.path) {
                                path.push(new google.maps.LatLng($glb.polyTemp.path[key].lat(), $glb.polyTemp.path[key].lng()));
                            }
                            this.curPl.setPath(this.path);
                        };break;
                        case 'gon':
                        {
                            this.curPl = polyGons[this.cur];
                            /* Set path */
                            this.path = [];
                            for (var key in $glb.polyTemp.path) {
                                path.push(new google.maps.LatLng($glb.polyTemp.path[key].lat(), $glb.polyTemp.path[key].lng()));
                            }
                            this.curPl.setPath(this.path);
                        };break;
                        case 'circle':
                        {
                            this.curPl = circles[this.cur];
                            this.curPl.setCenter($glb.polyTemp.center);
                            this.curPl.setRadius($glb.polyTemp.radius);
                        };break;
                        case 'rectangle':
                        {
                            this.curPl = recTangles[this.cur];
                            this.southWest = $glb.polyTemp.bounds.getSouthWest();
                            this.northEast = $glb.polyTemp.bounds.getNorthEast();
                            this.curPl.setBounds(new google.maps.LatLngBounds(this.southWest, this.northEast));
                        };break;

                    }
                    /* set option*/
                    this.curPl.setOptions({
                        draggable: false,
                        clickable: true,
                        editable: false,
                        strokeColor: $glb.polyTemp.strokeColor,
                        strokeOpacity: $glb.polyTemp.strokeOpacity,
                        strokeWeight: $glb.polyTemp.strokeWeight,
                        fillColor: $glb.polyTemp.fillColor,
                        fillOpacity: $glb.polyTemp.fillOpacity
                    });
                    if (this.status != 'line') {
                        this.curPl.setOptions({
                            fillColor: $glb.polyTemp.fillColor,
                            fillOpacity: $glb.polyTemp.fillOpacity
                        });
                    }
                },
                clickCancelDraw: function (e, $glb) {
                    this.fliped = $glb.flip('front');
                    if (this.fliped !== false) {
                        this.status = $glb.polyStatus.val();
                        this.cur = $glb.curPoly.val();
                        /* switch color to object depends on poly's type */
                        switch (this.status) {
                            case 'line':
                            {
                                this.path = polyLines[this.cur];
                                /* remove from array */
                                polyLines.splice(this.cur, 1);
                            }
                                ;
                                break;
                            case 'gon':
                            {
                                this.path = polyGons[this.cur];
                                /* remove from array */
                                polyGons.splice(this.cur, 1);
                            }
                                ;
                                break;
                            case 'circle':
                            {
                                this.path = circles[this.cur];
                                /* remove from array */
                                circles.splice(this.cur, 1);
                            }
                                ;
                                break;
                            case 'rectangle':
                            {
                                this.path = recTangles[this.cur];
                                /* remove from array */
                                recTangles.splice(this.cur, 1);
                            };break;
                        }
                        map.setOptions({draggableCursor: 'pointer'});
                        $glb.eDestroy();
                        this.path.setMap(null);
                    }
                },
                /* Helper */
                eDestroy: function () {
                    if (0 === parseInt(this.eventTrack.val())) {
                        google.maps.event.clearListeners(map, 'click');
                        this.eventTrack = $('#eventTrack').val('1');
                    }
                },

                modifiedTable: function (cur, status, $glb) {
                    this.table = $('table.poly_list tr[poly-data="' + cur + '"][poly-type="' + status + '"]');
                    this.table.find('.polo_icon font').attr('color', $glb.strokePolyHex.val());
                    this.table.find('.polo_title').html($glb.plTitle.val());
                },
                flip: function (face) {
                    this.flipContainer = $('.draw-flip-container');

                    if (face == 'back') {
                        if (this.flipContainer.hasClass('flip') === false) {
                            /* Flip to back */
                            this.flipContainer.addClass('flip');
                            $('.marker_tab_id_2 .front').scrollTop(0);
                        } else {
                            return false;
                        }
                    } else if (face == 'front') {
                        if (this.flipContainer.hasClass('flip') === true) {
                            /* Flip to front */
                            this.flipContainer.removeClass('flip');
                            $('.marker_tab_id_2 .back').scrollTop(0);
                        } else {
                            return false;
                        }
                    }
                },
                checkHiddenTable: function () {
                    if ($('table.wp-list-table').hasClass('hidden')) {
                        $('table.wp-list-table').removeClass('hidden');
                    }
                }
            },
            styles: {
                stInit: function () {
                    this.adminisColorChange();
                },
                bindChangeUI: function (obj, func) {
                    $glb = this;
                    $(document).on('change', obj, function (e) {
                        e.preventDefault();
                        /* action function */
                        func($(this), $glb);
                    });
                },
                adminisColorChange: function () {
                    this.bindChangeUI('#adm_all_hex', this.admAll);
                    this.bindChangeUI('#adm_all_hsl', this.admAll);
                    this.bindChangeUI('#adm_country_hsl', this.admCountry);
                    this.bindChangeUI('#adm_country_hex', this.admCountry);
                },
                admAll: function () {
                    $this = this;
                    $this.admHex = $('#adm_all_hex').val();
                    $this.admSl = cvColorPicker($('#adm_all_hsl').val());
                    var styles = [
                        {
                            stylers: [
                                {hue: $this.admHex},
                                {saturation: $this.admSl[1]},
                                {lightness: $this.admSl[2]}
                            ]
                        }
                    ];
                    map.setOptions({styles: styles});
                },
                admCountry: function () {
                    var $this = this;
                    $this.countryHex = $('#adm_country_hex').val();
                    $this.countrySl = cvColorPicker($('#adm_country_hsl').val());
                    var styles = {
                        featureType: "administrative.country",
                        elementType: "all",
                        stylers: [
                            {hue: $this.countryHex},
                            {saturation: $this.countrySl[1]},
                            {lightness: $this.countrySl[2]}
                        ]
                    };
                    $this.newStyle = map.styles;
                    $this.newStyle.push(styles);
                    map.setOptions({styles: $this.newStyle});
                }
            },
            general: {
                gnInit: function () {
                    var $this = this;

                    snapSlider.noUiSlider.on('update', function (values, handle) {
                        var num = values[handle];
                        num = parseInt(num);
                        $('#map-zoom-result').html(num);
                        $('#map-zoom-hidden').val(num);
                        map.setZoom(parseInt(num));
                    });

                    this.bindChangeUI('#curMapType', this.changeMapType);
                    this.bindChangeUI('#zoom_control_size', this.setZoomControlSize);
                    this.bindClickUI('#save_map', this.saveMap, this);
                    this.changeUiDf();
                    /* Map event */
                    mymapsInit.bindMapEvent('zoom_changed', mymapsInit.general.setZoomSlider);
                },
                /* event define */
                bindChangeUI: function (obj, func) {
                    $glb = this;
                    $(document).on('change', obj, function (e) {
                        e.preventDefault();
                        /* action function */
                        func($(this), $glb);
                    });
                },
                bindClickUI: function (obj, func, $glb) {
                    this.event = 'ontouchstart' in window ? 'touchstart' : 'click';
                    $(document).on(this.event, obj, function (e) {
                        e.preventDefault();
                        /* action function */
                        func($(this), $glb);
                    });
                },
                /**** Set live ****/
                changeUiDf: function () {
                    /* Map options */
                    this.bindChangeUI('#draggable', this.setDraggable);
                    this.bindChangeUI('#scroll_wheel', this.setScrollWheel);
                    this.bindChangeUI('#double_click_zoom', this.setDoubleClickZoom);
                    /* Df UI*/
                    this.bindChangeUI('#df_ui', this.setDefaultUI);
                    this.bindChangeUI('#scale_control', this.setScaleControl);
                    this.bindChangeUI('#zoom_control', this.setZoomControl);
                    this.bindChangeUI('#pan_control', this.setPanControl);
                    this.bindChangeUI('#overview_control', this.setOverViewControl);
                    this.bindChangeUI('#type_control_style', this.setTypeControl);
                    this.bindChangeUI('#map_type_id', this.setTypeControl);
                    this.bindChangeUI('#street_view_control', this.setStreetView);
                    this.bindChangeUI('#pan_control', this.setPanControl);
                    this.bindChangeUI('#overview_control', this.setOverViewControl);

                    this.bindChangeUI('#rotate_control', this.setRoTateControl);
                },
                /* Current state */
                changeZoomMap: function (obj, $glb) {
                    map.setZoom(parseInt(obj.val()));
                },
                changeMapType: function (obj, $glb) {
                    this.map_type = obj.val();
                    map.setMapTypeId(google.maps.MapTypeId[this.map_type]);
                },
                setZoomSlider: function () {
                    //$('#map-zoom-hidden').val(parseInt(map.getZoom()));
                    //$('#map-zoom-hidden').trigger('change');
                    snapSlider.noUiSlider.set(parseInt(map.getZoom()));
                    return false;
                },
                /* Map options */
                setDraggable: function (obj, $glb) {
                    map.setOptions({draggable: obj.is(':checked')});
                },
                setScrollWheel: function (obj, $glb) {
                    map.setOptions({scrollwheel: obj.is(':checked')});

                },
                setDoubleClickZoom: function (obj, $glb) {
                    if (obj.is(':checked') === true) {
                        map.setOptions({disableDoubleClickZoom: false});
                    } else {
                        map.setOptions({disableDoubleClickZoom: true});
                    }

                },
                /* control */
                setDefaultUI: function (obj, $glb) {
                    if (obj.is(':checked') == false) {
                        this.defaultUI = $('.defaultUI');
                        obj.parent().parent().nextAll().find('input[type="checkbox"]').prop("checked", false);
                        obj.parent().parent().nextAll().find('option').prop("selected", false);
                        this.defaultUI.nextAll().find('input[type="checkbox"]').trigger('change');
                        this.defaultUI.nextAll().find('select').trigger('change');
                    }
                },
                setScaleControl: function (obj, $glb) {
                    if (obj.is(':checked')) {
                        map.setOptions({scaleControl: true});
                    } else {
                        map.setOptions({scaleControl: false});
                    }
                },
                setTypeControl: function (obj, $glb) {
                    var $vars = mymapsInit;
                    this.typeControl = $vars.typeControl.find('option:selected').val();
                    this.mapTypeId = [];
                    this.mapTypeId = $vars.mapTypeId.val();
                    if (this.mapTypeId !== null && this.mapTypeId !== '') {
                        if (this.mapTypeId.length > 0) {
                            this.typeIdArray = [];
                            for (var key in this.mapTypeId) {
                                this.typeIdArray.push(google.maps.MapTypeId[this.mapTypeId[key]]);
                            }
                            map.setOptions({
                                mapTypeControl: true,
                                mapTypeControlOptions: {
                                    style: google.maps.MapTypeControlStyle[this.typeControl],
                                    mapTypeIds: this.typeIdArray
                                }
                            });
                        }
                    } else {
                        map.setOptions({
                            mapTypeControl: false
                        });
                    }
                },

                setStreetView: function (obj, $glb) {
                    map.setOptions({
                        streetViewControl: obj.is(':checked')
                    });
                },

                setPanControl: function (obj, $glb) {
                    map.setOptions({
                        panControl: obj.is(':checked')
                    });
                },

                setOverViewControl: function (obj, $glb) {
                    map.setOptions({
                        overviewMapControl: obj.is(':checked')
                    });
                },

                setZoomControl: function (obj, $glb) {
                    if (obj.is(':checked')) {
                        map.setOptions({
                            zoomControl: true,
                            zoomControlOptions: {
                                style: google.maps.ZoomControlStyle[$('#zoom_control_size').val()]
                            }
                        });
                    } else {
                        map.setOptions({zoomControl: false});
                    }
                },
                setZoomControlSize: function (obj, $glb) {
                    if ($('#zoom_control').is(':checked') === true) {
                        map.setOptions({
                            zoomControlOptions: {
                                style: google.maps.ZoomControlStyle[obj.val()]
                            }
                        });
                    }
                },

                setRoTateControl: function (obj, $glb) {
                    map.setOptions({
                        rotateControl: obj.is(':checked')
                    });
                },

                /* Action */
                saveMap: function (obj, $glb) {
                    var $this = this;
                    var $vars = mymapsInit;
                    $this.valid = $glb.validSave();
                    if ($this.valid == false) {
                        return false;
                    }

                    $this.markersSave = {}, $this.pllsSave = {}, $this.plgsSave = {},
                        $this.circlesSave = {}, $this.recsSave = {}, $this.general = {};
                    /* general */
                    $this.center = map.getCenter();
                    $this.general = {
                        name: $vars.mapName.val().trim(),
                        short_code: $vars.shortCode.val().trim(),
                        extra_class: $vars.extraClass.val(),
                        map_width: $vars.mapWidth.val().trim(),
                        unit_width: $vars.unitWidth.val(),
                        map_height: $vars.mapHeight.val().trim(),
                        unit_height: $vars.unitHeight.val(),
                        map_layouts: ($vars.mapLayouts.is(':checked')) ? 'res' : 'cus',
                        height_unlimited: $vars.heightUnlimited.is(':checked'),
                        /* current state */
                        zoom: $vars.zoom.val(),
                        map_type: $vars.curMapType.val(),
                        search_box: $vars.searchBox.is(':checked'),
                        map_legend: $vars.mapLegend.is(':checked'),

                        draggable: $vars.draggAble.is(':checked'),
                        dr_mobile: $vars.drMobile.is(':checked'),
                        scroll_wheel: $vars.scrollWheel.is(':checked'),
                        double_click_zoom: $vars.doubleClickZoom.is(':checked'),
                        /* Default UI Control */
                        df_ui: $vars.dfUi.is(':checked'),
                        scale_control: $vars.scaleControl.is(':checked'),
                        zoom_control: $vars.zoomControl.is(':checked'),
                        zoom_control_size: $vars.zoomControlSize.val(),
                        type_control_style: $vars.typeControl.val(),
                        map_type_id: $vars.mapTypeId.val(),
                        street_view_control: $vars.streetViewControl.is(':checked'),
                        overview_control: $vars.overViewControl.is(':checked'),
                        pan_control: $vars.panControl.is(':checked'),
                        /* Default style */
                        style_default: default_style,
                        center: {lat: $this.center.lat(), lng: $this.center.lng()},
                        load_shortcode: load_shortcode
                    };

                    /* street view */
                    $this.street_view = map.getStreetView();
                    $this.street_view_pos = $this.street_view.getPosition();
                    if ($this.street_view_pos) {
                        $this.general.street_view = {
                            visible: $this.street_view.getVisible(),
                            pov: $this.street_view.getPov(),
                            position: {lat: $this.street_view_pos.lat(), lng: $this.street_view_pos.lng()}
                        };
                    }

                    /* Marker */
                    for (var i  in markers) {
                        $this.mkposition = markers[i].getPosition();
                        $this.markerSave = {
                            title: markers[i].title,
                            des_open: markers[i].des_open,
                            shortcode_in_desc: markers[i].shortcode_in_desc,
                            description: markers[i].description,
                            cat: markers[i].cat,
                            position: {
                                lat: parseFloat($this.mkposition.lat()),
                                lng: parseFloat($this.mkposition.lng())
                            },
                            icon: markers[i].getIcon(),
                            animation: markers[i].animation,
                            animation_type: markers[i].animation_type,
                            timeout: parseFloat(markers[i].timeout)
                        };
                        $this.markersSave[countobj($this.markersSave)] = $this.markerSave;
                    }

                    /* Line */
                    for (var i in polyLines) {
                        $this.pll = {};
                        $this.pll.title = polyLines[i].title;
                        $this.pll.description = polyLines[i].description;
                        $this.pll.oriFill = polyLines[i].oriFill;
                        $this.pll.oriStroke = polyLines[i].oriStroke;
                        $this.pll.strokeColor = polyLines[i].strokeColor;
                        $this.pll.strokeOpacity = polyLines[i].strokeOpacity;
                        $this.pll.strokeWeight = polyLines[i].strokeWeight;
                        /* get path */
                        $this.pll.path = polyLines[i].getPath();
                        $this.paths = [];
                        for (var key in $this.pll.path.j) {
                            $this.paths.push({lat: $this.pll.path.j[key].lat(), lng: $this.pll.path.j[key].lng()});
                        }
                        $this.pll.path = $this.paths;
                        $this.pllsSave[countobj($this.pllsSave)] = $this.pll;
                    }
                    /* Save Gon */
                    for (var i in polyGons) {
                        $this.plg = {};
                        $this.plg.title = polyGons[i].title;
                        $this.plg.description = polyGons[i].description;
                        $this.plg.oriFill = polyGons[i].oriFill;
                        $this.plg.oriStroke = polyGons[i].oriStroke;
                        $this.plg.strokeColor = polyGons[i].strokeColor;
                        $this.plg.strokeOpacity = polyGons[i].strokeOpacity;
                        $this.plg.strokeWeight = polyGons[i].strokeWeight;
                        $this.plg.fillColor = polyGons[i].fillColor;
                        $this.plg.fillOpacity = polyGons[i].fillOpacity;
                        /* get path */
                        $this.plg.path = polyGons[i].getPath();
                        $this.path = [];
                        for (var key in $this.plg.path.j) {
                            $this.path.push({lat: $this.plg.path.j[key].lat(), lng: $this.plg.path.j[key].lng()});
                        }
                        $this.plg.path = $this.path;
                        $this.plgsSave[countobj($this.plgsSave)] = $this.plg;
                    }

                    /* Save Rectangle */
                    for (var i in recTangles) {
                        $this.rec = {};
                        $this.rec.title = recTangles[i].title;
                        $this.rec.description = recTangles[i].description;
                        $this.rec.oriStroke = recTangles[i].oriStroke;
                        $this.rec.oriFill = recTangles[i].oriFill;
                        $this.rec.strokeColor = recTangles[i].strokeColor;
                        $this.rec.strokeOpacity = recTangles[i].strokeOpacity;
                        $this.rec.strokeWeight = recTangles[i].strokeWeight;
                        $this.rec.fillColor = recTangles[i].fillColor;
                        $this.rec.fillOpacity = recTangles[i].fillOpacity;
                        /* get path */
                        $this.bounds = recTangles[i].getBounds();
                        $this.rec.bounds = {
                            SouthWest: {
                                lat: $this.bounds.getSouthWest().lat(),
                                lng: $this.bounds.getSouthWest().lng()
                            },
                            NorthEast: {
                                lat: $this.bounds.getNorthEast().lat(),
                                lng: $this.bounds.getNorthEast().lng()
                            },
                            Center: {
                                lat: $this.bounds.getCenter().lat(),
                                lng: $this.bounds.getCenter().lng()
                            }
                        };
                        $this.recsSave[countobj($this.recsSave)] = $this.rec;
                    }

                    /* Save Circle */
                    for (var i in circles) {
                        $this.circle = {};
                        $this.circle.title = circles[i].title;
                        $this.circle.description = circles[i].description;
                        $this.circle.oriStroke = circles[i].oriStroke;
                        $this.circle.oriFill = circles[i].oriFill;
                        $this.circle.strokeColor = circles[i].strokeColor;
                        $this.circle.strokeOpacity = circles[i].strokeOpacity;
                        $this.circle.strokeWeight = circles[i].strokeWeight;
                        $this.circle.fillColor = circles[i].fillColor;
                        $this.circle.fillOpacity = circles[i].fillOpacity;
                        /* get path */
                        $this.circle.radius = circles[i].getRadius();
                        $this.circle.center = {
                            lat: circles[i].getCenter().lat(),
                            lng: circles[i].getCenter().lng()
                        };

                        $this.circlesSave[countobj($this.circlesSave)] = $this.circle;
                    }

                    $this.data = {
                        'action': 'flx_save_map',
                        '_ajax_nonce': mapData._nonce_,
                        'markers': JSON.stringify($this.markersSave),
                        'markersCat': JSON.stringify(markerCat),
                        'polyLines': JSON.stringify($this.pllsSave),
                        'polyGons': JSON.stringify($this.plgsSave),
                        'circles': JSON.stringify($this.circlesSave),
                        'recTangles': JSON.stringify($this.recsSave),
                        'general': JSON.stringify($this.general),
                        'map_id': mapPostId
                    };

                    $.post(ajaxurl, $this.data, function (responsive) {
                        if (responsive.success) {
                            $.growl.notice({message: responsive.success});
                            $glb.setGlobalMapId(parseInt(responsive.map_id));
                        } else if (responsive.failed) {
                            $.growl.notice({message: responsive.failed});
                        }
                    });
                },
                validSave: function () {
                    var $vars = mymapsInit;

                    /* check empty number */
                    if (
                        /* check empty size */
                    flm_validation($vars.mapWidth.val(), 'empty', " <i class='fa fa-exclamation-triangle'></i> Width or height is empty!")
                        /* check frame size( width & height) */
                    && flm_validation($vars.mapWidth.val(), 'number', " <i class='fa fa-exclamation-triangle'></i> Width or height is not number!")
                    && flm_validation($vars.mapHeight.val(), 'number', " <i class='fa fa-exclamation-triangle'></i> Width or height is not number!")
                        /* Check extra class */
                    && flm_validation($vars.extraClass.val(), 'string', " <i class='fa fa-exclamation-triangle'></i> The Extra Class value can't contain any of the following characters: <br> \\ / : * ? \" < >")
                        /* Map name */
                    && flm_validation($vars.mapName.val(), 'string', " <i class='fa fa-exclamation-triangle'></i> A Map name can't contain any of the following characters: <br> \\ / : * ? \" < >")
                    ) {
                        return true;
                    }

                    return false;
                },
                /* helper */
                setGlobalMapId: function (value) {
                    mapPostId = value;
                    trackChange = 0;
                }
            },
            editMap: {
                init: function () {
                    if (mapPostId != -1) {

                        var $general = JSON.parse(mapData.general);
                        this.assignValues($general);
                        this.setMapOption($general);
                        this.generateMarker(mapData, this);
                        this.generatePoly(mapData);

                    }
                },
                assignValues: function ($general) {
                    'use strict';
                    var $vars = mymapsInit;

                    $vars.mapName.val($general.name);
                    $vars.shortCode.val('[' + mapData._shortcode_ + ' id="' + mapData._post_id_ + '"]');
                    $vars.extraClass.val($general.extra_class);
                    /* Layout */
                    $vars.mapWidth.val($general.map_width);
                    $vars.mapHeight.val($general.map_height);
                    $vars.unitWidth.find('option[value="' + $general.unit_width + '"]').prop("selected", true);
                    $vars.unitHeight.find('option[value="' + $general.unit_height + '"]').prop("selected", true);
                    $vars.curMapType.find('option[value="' + $general.map_type + '"]').prop("selected", true);
                    if ($general.map_layouts == 'res') $vars.mapLayouts.trigger('click');
                    $vars.heightUnlimited.prop("checked", $general.height_unlimited);

                    /* Current State */
                    $vars.searchBox.prop("checked", $general.search_box);
                    $vars.mapLegend.prop("checked", $general.map_legend);

                    /* Map options */
                    $vars.draggAble.prop("checked", $general.draggable);
                    $vars.drMobile.prop("checked", $general.dr_mobile);
                    $vars.scrollWheel.prop("checked", $general.scroll_wheel);
                    $vars.doubleClickZoom.prop("checked", $general.double_click_zoom);
                    /* Style */

                    /* DF UI */
                    if ($general.df_ui == true) {
                        if ($vars.dfUi.is(':checked') == false) {
                            $vars.dfUi.trigger('click');
                        }
                        $vars.scaleControl.prop("checked", $general.scale_control);
                        $vars.zoomControl.prop("checked", $general.zoom_control);
                        $vars.zoomControlSize.find('option[value="' + $general.zoom_control_size + '"]').prop("selected", true);
                        $vars.typeControl.find('option[value="' + $general.type_control_style + '"]').prop("selected", true);

                        if ($general.map_type_id !== '' && $general.map_type_id != null) {
                            $.each($general.map_type_id, function (i, e) {
                                $vars.mapTypeId.find('option[value="' + e + '"]').prop("selected", true);
                            });
                        }

                        $vars.typeControl.trigger('change');
                        $vars.streetViewControl.prop("checked", $general.street_view_control);
                        $vars.panControl.prop("checked", $general.pan_control);
                        $vars.overViewControl.prop("checked", $general.overview_control);
                    }

                    /* Style Default */
                    $vars.styleDefault.val($general.style_default);
                    this.tab_general = $('li.marker_tab_general');
                    this.tab_general.find('input[type="checkbox"]').trigger('change');
                    this.tab_general.find('select').trigger('change');

                    if ($general.load_shortcode)
                        load_shortcode = $general.load_shortcode;
                    /*this.tab_general.nextAll().find('input[type="checkbox"]').trigger('change');*/
                    /*this.tab_general.nextAll().find('select').trigger('change');*/
                },

                setMapOption: function ($general) {
                    if ($general.style_default != '') {
                        this.map_style = JSON.parse($general.style_default);
                        if(this.map_style.style_json == '') {
                            this.map_style = false;
                        } else {
                            this.map_style = JSON.parse(this.map_style.style_json);
                        }

                    } else {
                        this.map_style = false;
                    }

                    map.setOptions({
                        styles: this.map_style,
                        zoom: parseInt($general.zoom),
                        center: new google.maps.LatLng(parseFloat($general.center.lat), parseFloat($general.center.lng)),
                        mapTypeId: google.maps.MapTypeId[$general.map_type]
                    });

                    /* Checking for street view */
                    if ($general.street_view && $general.street_view.pov.heading !== 0 && $general.street_view.visible == 1) {
                        this.panorama = map.getStreetView();
                        this.panorama.setPosition(new google.maps.LatLng(parseFloat($general.street_view.position.lat), parseFloat($general.street_view.position.lng)));
                        this.panorama.setPov(({
                            heading: parseFloat($general.street_view.pov.heading),
                            pitch: parseFloat($general.street_view.pov.pitch),
                            zoom: parseFloat($general.street_view.pov.zoom)
                        }));
                        this.panorama.setVisible(true);
                    }
                },
                generateMarker: function (mapData, $glb) {
                    var $this = this;

                    var markers_data = JSON.parse(mapData.markers);
                    if(mapData.markersCat) {
                        var markers_cat = JSON.parse(mapData.markersCat);

                        for (var cat in markers_cat) {
                            adminUI.add_category_marker(markers_cat[cat]);
                            markerCat.push(markers_cat[cat]);
                        }
                    }


                    for (var key in markers_data) {
                        $this.new_id = 'mk_' + key.toString();
                        if (typeof markers_data[key].icon === 'string') {
                            $this.icon = markers_data[key].icon;
                        } else {
                            $this.icon = {
                                url: markers_data[key].icon.url,
                                size: markers_data[key].icon.size,
                                origin: markers_data[key].icon.origin,
                                anchor: markers_data[key].icon.anchor,
                                scaledSize: markers_data[key].icon.scaledSize
                            };
                        }
                        $this.cat = (markers_data[key].cat) ? markers_data[key].cat : '';
                        $this.query = {
                            map: map,
                            position: new google.maps.LatLng(markers_data[key].position.lat, markers_data[key].position.lng),
                            title: markers_data[key].title,
                            cat: $this.cat,
                            des_open: markers_data[key].des_open,
                            shortcode_in_desc: markers_data[key].shortcode_in_desc,
                            description: markers_data[key].description,
                            animation: google.maps.Animation[markers_data[key].animation_type],
                            animation_type: markers_data[key].animation_type,
                            icon: markers_data[key].icon,
                            timeout: markers_data[key].timeout
                        };
                        $this.marker = new google.maps.Marker($this.query);
                        markers[$this.new_id] = $this.marker;
                        google.maps.event.addListener($this.marker, 'click', mymapsInit.markers.onMarkerClick);
                        google.maps.event.addListener($this.marker, 'drag', mymapsInit.markers.onMarkerDrag);

                        $this.query.id = $this.new_id;
                        $this.query.table_object = $('.marker_list#markers-table');
                        /* Switch to url icon if it is object */
                        if(markers_data[key].icon.url) {
                            $this.query.icon = markers_data[key].icon.url;
                        }
                        adminUI.marker_table_add_row($this.query);
                    }
                },
                generatePoly: function (mapData) {
                    'use strict';
                    var $this = this;
                    this.plLs = JSON.parse(mapData.polyLines);
                    this.plGs = JSON.parse(mapData.polyGons);
                    this.recTs = JSON.parse(mapData.recTangles);
                    this.cCs = JSON.parse(mapData.circles);

                    /* Lines */
                    for (var keypll in this.plLs) {

                        $this.path = [];
                        for (var i = 0; i < this.plLs[keypll].path.length; i++) {

                            $this.path.push(new google.maps.LatLng(this.plLs[keypll].path[i].lat, this.plLs[keypll].path[i].lng));
                        }

                        $this.line = new google.maps.Polyline({
                            map: map,
                            path: $this.path,
                            title: $this.plLs[keypll].title,
                            description: $this.plLs[keypll].description,
                            oriStroke: $this.plLs[keypll].oriStroke,
                            oriFill: $this.plLs[keypll].oriFill,
                            strokeColor: $this.plLs[keypll].strokeColor,
                            strokeOpacity: $this.plLs[keypll].strokeOpacity,
                            strokeWeight: $this.plLs[keypll].strokeWeight
                        });

                        $this.new_id = 'dr_' + keypll;
                        polyLines[$this.new_id] = $this.line;

                        adminUI.poly_table_add_row({
                            'id': $this.new_id,
                            'type' : 'line',
                            'table_object': $('.draw_list#draw-table'),
                            'title': $this.plLs[keypll].title,
                            'icon_color' : $this.plLs[keypll].strokeColor
                        });

                        google.maps.event.addListener(this.line, 'click', mymapsInit.draw.onPolyClick);
                    }
                    /* Gons */
                    for (var keyplg in this.plGs) {
                        $this.path = [];
                        for (var key in this.plGs[keyplg].path) {
                            $this.path.push(new google.maps.LatLng(this.plGs[keyplg].path[key].lat, this.plGs[keyplg].path[key].lng));
                        }
                        $this.plg = new google.maps.Polygon({
                            map: map,
                            path: $this.path,
                            title: $this.plGs[keyplg].title,
                            description: $this.plGs[keyplg].description,
                            strokeColor: $this.plGs[keyplg].strokeColor,
                            strokeOpacity: $this.plGs[keyplg].strokeOpacity,
                            strokeWeight: $this.plGs[keyplg].strokeWeight,
                            fillColor: $this.plGs[keyplg].fillColor,
                            fillOpacity: $this.plGs[keyplg].fillOpacity,
                            oriFill: $this.plGs[keyplg].oriFill,
                            oriStroke: $this.plGs[keyplg].oriStroke
                        });

                        $this.new_id = 'dr_' + keyplg;
                        polyGons[$this.new_id] = $this.plg;

                        adminUI.poly_table_add_row({
                            'id': $this.new_id,
                            'type' : 'gon',
                            'table_object': $('.draw_list#draw-table'),
                            'title': this.plGs[keyplg].title,
                            'icon_color' : this.plGs[keyplg].fillColor
                        });

                        //mymapsInit.draw.generateTable($this.new_id, 'gon', this.plGs[keyplg].title, this.plGs[keyplg].fillColor);
                        google.maps.event.addListener(this.plg, 'click', mymapsInit.draw.onPolyClick);
                    }
                    /* Rec */
                    for (var keyrt in this.recTs) {
                        /* Define */

                        $this.bounds = new google.maps.LatLngBounds(
                            new google.maps.LatLng(this.recTs[keyrt].bounds.SouthWest.lat, this.recTs[keyrt].bounds.SouthWest.lng),
                            new google.maps.LatLng(this.recTs[keyrt].bounds.NorthEast.lat, this.recTs[keyrt].bounds.NorthEast.lng)
                        );

                        $this.rec = new google.maps.Rectangle({
                            map: map,
                            bounds: $this.bounds,
                            title: $this.recTs[keyrt].title,
                            description: $this.recTs[keyrt].description,
                            strokeColor: $this.recTs[keyrt].strokeColor,
                            strokeOpacity: $this.recTs[keyrt].strokeOpacity,
                            strokeWeight: $this.recTs[keyrt].strokeWeight,
                            fillColor: $this.recTs[keyrt].fillColor,
                            fillOpacity: $this.recTs[keyrt].fillOpacity,
                            oriFill: $this.recTs[keyrt].oriFill,
                            oriStroke: $this.recTs[keyrt].oriStroke
                        });

                        $this.new_id = 'dr_' + keyrt;
                        recTangles[$this.new_id] = $this.rec;
                        adminUI.poly_table_add_row({
                            'id': $this.new_id,
                            'type' : 'rectangle',
                            'table_object': $('.draw_list#draw-table'),
                            'title': this.recTs[keyrt].title,
                            'icon_color' : this.recTs[keyrt].fillColor
                        });
                        //mymapsInit.draw.generateTable($this.new_id, 'rectangle', this.recTs[keyrt].title, this.recTs[keyrt].fillColor);
                        google.maps.event.addListener(this.rec, 'click', mymapsInit.draw.onPolyClick);
                    }

                    /* Circles */
                    for (var keycc in this.cCs) {
                        $this.center = new google.maps.LatLng(this.cCs[keycc].center.lat, this.cCs[keycc].center.lng);
                        $this.circle = new google.maps.Circle({
                            map: map,
                            center: $this.center,
                            radius: $this.cCs[keycc].radius,
                            title: $this.cCs[keycc].title,
                            description: $this.cCs[keycc].description,
                            strokeColor: $this.cCs[keycc].strokeColor,
                            strokeOpacity: $this.cCs[keycc].strokeOpacity,
                            strokeWeight: $this.cCs[keycc].strokeWeight,
                            fillColor: $this.cCs[keycc].fillColor,
                            fillOpacity: $this.cCs[keycc].fillOpacity,
                            oriFill: $this.cCs[keycc].oriFill,
                            oriStroke: $this.cCs[keycc].oriStroke
                        });
                        $this.new_id = 'dr_' + keycc;
                        circles[$this.new_id] = $this.circle;
                        adminUI.poly_table_add_row({
                            'id': $this.new_id,
                            'type' : 'circle',
                            'table_object': $('.draw_list#draw-table'),
                            'title': this.cCs[keycc].title,
                            'icon_color' : this.cCs[keycc].fillColor
                        });
                        //mymapsInit.draw.generateTable($this.new_id, 'circle', this.cCs[keycc].title, this.cCs[keycc].fillColor);
                        google.maps.event.addListener($this.circle, 'click', mymapsInit.draw.onPolyClick);
                    }
                }
            }
        };

        mymapsInit.init();

        /**
         * GENERATE MARKER TABLE
         *
         * since 1.0.0
         * @param title      : marker title
         * @param position   : the number of marker's position in markers object
         * @param image      ; marker icon
         * @param timeout    : marker generate timeout
         */
        function generateMarkerTable(title, position, image, timeout) {
            timeout = ( timeout == '' || timeout == undefined ) ? 'none' : timeout;
            $('table.marker_list > tbody').append('<tr marker-data="' + position + '">' +
                '<td> ' +
                '<div class="icon-mk-wrap"> ' +
                '<img src="' + image + '" alt="" width="32" height="37" id="marker_100"/> ' +
                '</div> ' +
                '</td> ' +
                '<td>' + title + '</td> ' +
                '<td> ' + timeout + ' </td> ' +
                '<td class="marker_list_option list_option"> <a class="view_marker op_view tooltips"><span>View</span><i class="fa fa-search"></i></a> <a class="edit_marker op_edit tooltips"><span>Edit</span><i class="fa fa-pencil-square-o"></i></a> <a class="delete_marker op_delete tooltips"><span>Delete</span><i class="fa fa-trash-o"></i></a> </td> ' +
                '</tr>');
        }

        /**
         * Modifier table after marker was change
         *
         * since 1.0.0
         * @param int marker_data : current marker object
         * @param string title      : the title of marker
         * @param position          : the position of marker in object
         * @param image             : icon of marker
         * @param timeout           : marker generate timeout
         *
         */
        function modifiedMarkerTable( title, position, image, timeout) {
            timeout = ( timeout == '' ) ? 'none' : timeout;
            this.table = $('table.marker_list tr[marker-data="' + position + '"]');
            this.table.find('.icon-mk-wrap img').attr('src', image);
            this.table.find('td:nth-child(2)').html(title);
            this.table.find('td:nth-child(3)').html(timeout);
        }

        /*******************************
         * ACTIVE n DEACTIVE STYLE EVENT
         * ****************************/
        $(document).on('click', '.maps_style_wrapper  .image_wrap > img, .maps_style_wrapper .style-name', function () {
            /* Set map style */
            var style_json = $(this).parents('.maps_style_wrapper').find('.button-container').attr('style-json');
            var style_name = encodeURIComponent($(this).parents('.maps_style_wrapper').find('.button-container').attr('style-name'));
            var style_image = $(this).parents('.maps_style_wrapper').find('img').attr('src');
            this.arr_style = {'style_json': style_json, 'style_name': style_name, 'style_image': style_image};

            /* assign to default style fields*/
            try {
                default_style = JSON.stringify(this.arr_style);
            }
            catch (e) {
                // statements to handle any exceptions
                console.log(e); // pass exception object to error handler
            }

            if(style_json == '') {
                var styles = false;
            } else {
                var styles = JSON.parse(style_json);
            }

            map.setOptions({styles: styles});
        });

        $(document).on('click', '.exit_style', function (e) {
            e.preventDefault();
            $('.list-style-page h3').trigger('click');
        });

        // desctroy style
        $(document).on('click', '.btn.btn-deactived', function () {
            map.setOptions({styles: false});
        });

        /**
         * Extract Satuation and light value from RGB color value
         * @param Array arr : The array contain RGB value
         * @return Array arr: The modified array that's contain set and light
         */
        function cvColorPicker(arr) {
            arr = arr.split(',');
            arr[1] = ( ( parseInt(arr[1]) * 2) - 100 );
            /* sat */
            arr[2] = ( ( parseInt(arr[2]) * 2) - 100 );
            /* light */
            return arr;
        }

        function getOpacity(hsla) {

            var arr = hsla.split(',');
            if (arr[3]) {
                return parseFloat(arr[3]);
            } else {
                return 1;
            }
        }

        function clearMarkers() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }

        /*
         * COUNT OBJECT LENGTH
         */
        function countobj(obj) {
            var length = 0;
            for (var key in obj) {
                length += 1;
            }
            return length;
        }

        /**
         * DELETE ELEMENTS IN OBJECT
         **/
        function delete_obj(elm, obj) {
            if (obj[elm]) {
                delete obj[elm];
            }
        }

        /**
         * Get key from elements object
         *
         * @param object obj: The object that's contain marker or symbols
         * @param object elm: The object that's marker or symbol object
         * @return number result: The key of "elm" in "obj"
         **/
        function get_key_obj(obj, elm) {
            var result = false;
            for (var key in obj) {
                if (obj[key] == elm) {
                    result = key;
                }
            }
            return result;
        }

        /* Check Float number  */
        function isFloat(n) {
            return n === Number(n) && n % 1 !== 0;
        }

        /* Check Integer number */
        function isInt(n) {
            return Number(n) === n && n % 1 === 0;
        }

        /* Check special char */
        function check_special_char(string) {
            var specialChars = "\\/:*?\"<>|";
            for (var i = 0; i < specialChars.length; i++) {
                if (string.indexOf(specialChars[i]) > -1) {
                    return true
                }
            }
            return false;
        }

        /* Validation field */
        function flm_validation(value, type, notice) {
            var val = value.trim();
            switch (type) {
                case 'empty' :
                {
                    if (val == '' || val == null) {
                        $.growl.warning({message: notice});
                        return false;
                    }
                };break;
                case 'number'  :
                {
                    if ($.isNumeric(val) !== true) {
                        $.growl.warning({message: notice});
                        return false;
                    }
                };break;
                case 'string'   :
                {
                    if (check_special_char(val) === true) {
                        $.growl.warning({message: notice});
                        return false;
                    }
                };break;
            }
            return true;
        }
    });
});

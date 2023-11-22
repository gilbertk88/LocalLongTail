jQuery(document).ready(function($) {

    $('.ewm_llt_main_edit_button').click(function() {
        data_llt_post_id = $(this).data('llt-post-id');
        // alert('hello world '+data_llt_post_id);
        window.location.search += '&ewm_llt_id=' + data_llt_post_id;
    })

    $('.ewm_llt_tabs_location').click(function(e) {
        // 
        $('.ewm_llt_tabs_location').addClass('ewm_llt_tabs_50_active');
        $('.ewm_llt_tabs_keyword').removeClass('ewm_llt_tabs_50_active');

        $(".ewm_llt_locations_list").show();
        $(".ewm_llt_generate_long_tails").hide();
    })
    $('.ewm_llt_tabs_keyword').click(function(e) {        
        $('.ewm_llt_tabs_location').removeClass('ewm_llt_tabs_50_active');
        $('.ewm_llt_tabs_keyword').addClass('ewm_llt_tabs_50_active');
        $(".ewm_llt_locations_list").hide();
        $(".ewm_llt_generate_long_tails").show();
    })
    $('.ewm_llt_background_inner_close').click(function(e) {
        $('.ewm_llt_background_main').hide();
        $(".ewm_llt_menu_r_s").css({ 'border':'0px' });
        $(".ewm_llt_menu_l_s").css({ 'border':'0px' });
    })
    $('.ewm_llt_header_items_manager').click(function(e) {

        ewm_llt_post_title_d = $( '.ewm_main_ttl_text_inner' ).val();

        console.log( "ewm_llt_post_title_d:" );
        console.log( ewm_llt_post_title_d );

        $('.ewm_llt_post_title_d').html( ewm_llt_post_title_d );
        $('.ewm_llt_background_main').show();

    } )

    var ewm_ajax_save_main_post_key = function(){

		var form_data = new FormData();
		form_data.append( 'action', 'ewm_dpm_save_main_post' ) ;
		form_data.append( 'ewmdsm_heading', args.heading ) ;
		form_data.append( 'ewmdsm_content', args.content ) ;
        form_data.append( 'ewmdsm_main_id', args.main_id ) ;       

		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {},
			error: function (response) {}			
		} );
    }

    $(document).ajaxStart(function() {
        // $('.ewm_llt_save_llt_main').css({'cursor' : 'wait'});
        document.body.style.cursor='wait';
    }).ajaxStop(function() {
        // console.log('cursor load...');
        // $('.ewm_llt_save_llt_main').css({'cursor' : 'pointer'});
        document.body.style.cursor='default';
    });

    var ewm_ajax_save_main_post = function( args ){

		var form_data = new FormData();
		form_data.append( 'action', 'ewm_dpm_save_main_post' ) ;
		form_data.append( 'ewmdsm_heading', args.heading ) ;
		form_data.append( 'ewmdsm_content', args.content ) ;
        form_data.append( 'ewmdsm_main_id', args.main_id ) ;       

		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				response = jQuery.parseJSON( response );
                alert('Main Local Long Tail Post saved.');
                console.log( response );
                // window.location.search += '&ewm_llt_id='+response.postid
			},
			error: function (response) {
				console.log( response );
			}
		} );
    }
/*
    $( '.ewm_llt_header_input_full' ).keyup(function(){

        inputid = 'ewm_llt_main_content';
        var editor = tinyMCE.get( inputid );
        //tinyMCE.activeEditor.setContent('');

        ewm_ajax_save_main_post_key( {
            'heading': $('.ewm_llt_header_input_full').val() ,
            'content': editor.getContent() ,
            'main_id': $(this).data('ewm-llt-id')
        } );

    });

    $( '.ewm_llt_main_content' ).keyup( function(){

        inputid = 'ewm_llt_main_content';
        var editor = tinyMCE.get( inputid );
        ewm_ajax_save_main_post_key( {
            'heading': $('.ewm_llt_header_input_full').val() ,
            'content': editor.getContent() ,
            'main_id': $(this).data('ewm-llt-id')
        } );

    } );

*/

    $('.ewm_llt_save_llt_main').click( function(e) {

        inputid = 'ewm_llt_main_content';
        var editor = tinyMCE.get( inputid );
        
        ewm_ajax_save_main_post( {
            'heading': $('.ewm_llt_header_input_full').val() ,
            'content': editor.getContent() ,
            'main_id': $(this).data('ewm-llt-id')
        } );

    } )

    $('.ewm_llt_save_location_lcl').click( function() {
        $('.ewm_llt_child_message_save_success').html( '' );
    } );

    var ewm_llt_ajax_save_location = function( args ){

		var form_data = new FormData();
		
		form_data.append( 'action', 'ewm_dpm_save_location_post' );
		form_data.append( 'ewmdsm_location_name', args.location );
        form_data.append( 'ewmdsm_post_id', args.post_id );
        form_data.append( 'ewmdsm_post_group', args.post_group );    

		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				console.log( response );
				response = jQuery.parseJSON( response );
                $('.ewm_llt_child_message_save_success').html( 'Location Saved Successfully.' );
                location.reload();
			},
			error: function (response) {
				console.log( response );
			}

		});

    }

    $('.ewm_llt_save_location_lcl').click(function(e) {

        $('.ewm_llt_checkbox_item_lcl').val();
        // console.log( $( this ).data('llt-location-post-id') );

        ewm_llt_ajax_save_location( {
            'location' : $('.ewm_llt_checkbox_item_lcl').val(),
            'post_id' : $( this ).data('llt-location-post-id'),
            'post_group' : $( '#ewmPostGroup' ).val()
        } );

    })

    $('.ewm_llt_checkbox_item_lcl').click(function() {
        $('.ewm_llt_message_save_success').html( '' );
    });

    var ewm_llt_ajax_save_location_group = function( args ){

		var form_data = new FormData();
		
		form_data.append( 'action', 'ewm_llt_ajax_save_location_group' );

		form_data.append( 'ewmdsm_location_name', args.location );
        form_data.append( 'ewmdsm_post_id', args.post_id );
        // form_data.append( 'ewmdsm_post_group', args.post_group );

		jQuery.ajax({
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				console.log( response );
				response = jQuery.parseJSON( response );
                $('.ewm_llt_message_save_success').html( 'Location Group Saved Successfully' );
                // location.reload();
			},
			error: function (response) {
				console.log( response );
			}
		});

    }

    $('.ewm_llt_save_location_group_lcl').click(function(e) {

        $('.ewm_llt_checkbox_item_lcl').val();
        // console.log( $( this ).data('llt-location-post-id') );
        ewm_llt_ajax_save_location_group( {
            'location' : $('.ewm_llt_checkbox_item_lcl').val(),
            'post_id' : 0,
            'post_group' : $( '#ewmPostGroup' ).val()
        } );

    })

    $('.ewm_llt_background_inner_close_lcl').click( function(e) {
        $('.ewm_llt_background_main_lcl').hide();
        location.reload();
    } )

    $('.ewm_llt_new_location').click( function(e) {

        // TODO add new location as 0
        $('.ewm_llt_checkbox_item_lcl').val('') ;
        $('.ewm_llt_background_main_lcl').show() ;

        $('.ewm_llt_save_location_lcl').attr( { "data-llt-location-post-id": '0' } ) ;
        $('.ewm_llt_delete_b_t').attr( { "data-llt-location-post-id": '0' } ) ;

    } )

    $('.ewm_llt_main_edit_button_location').click(function(e) {
        // TODO add location details
        $('.ewm_llt_background_main_lcl').show();
        // populate location name
        $('.ewm_llt_checkbox_item_lcl').val( $( this ).data('llt-location-post-title') );

        // populate location id
        $('.ewm_llt_save_location_lcl').attr( { "data-llt-location-post-id": $( this ).data('llt-location-post-id') } );
        $('.ewm_llt_delete_b_t').attr( { "data-llt-location-post-id": $( this ).data('llt-location-post-id') } );

    })

    var ewm_llt_update_location = function( args ){

		var form_data = new FormData();

		form_data.append( 'action', 'ewm_dpm_save_main_locations' );
		form_data.append( 'ewmdsm_location_id', args.location_id );
		form_data.append( 'ewmdsm_main_llt_id', args.main_llt_id );
		form_data.append( 'ewmdsm_location_status', args.location_status );
        // form_data.append( 'ewmdsm_keyword_name', args.keyword_name );
        // form_data.append( 'ewmdsm_keyword_id', args.keyword_id );
        // form_data.append( 'ewmdsm_status', args.status );
        // form_data.append( 'ewmdsm_random_id', args.random_id );

		jQuery.ajax({
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				response = jQuery.parseJSON(response);
                console.log( response );
			},
			error: function (response) {}
		});

    }

    var ewm_llt_update_keyword = function (){}

    var ewm_new_keyword_locations = function ( args ){
        
        ewm_location_id     = args.locations_id ;
        // ewm_keyword_name    = $( '.ewm_llt_kw_edit_area_0' ).val();
        ewm_main_llt_post_id= $( '#ewm_llt_main_id' ).val();
        // ewm_keyword_id      = $('.ewm_llt_keyword_id_').val();
        // ewm_keyword_random_id = $( '.ewm_llt_random_details' ).val();

        ewm_llt_update_location({
            'location_id' : ewm_location_id,
            'main_llt_id' : ewm_main_llt_post_id,
            'location_status' : args.location_status,
            // 'status': 'new_keyword',
            // 'keyword_name' : ewm_keyword_name,
            // 'keyword_id' : ewm_keyword_id,
            // 'random_id' : ewm_keyword_random_id
        });

    }

    var ewm_update_keywords_location = function (){
        ewm_location_id     = $(this).data('location-id');
        ewm_main_llt_post_id = $('#ewm_llt_main_id').val();
        ewm_llt_update_keyword({
            'location_id' : ewm_location_id,
            'main_llt_id' : ewm_main_llt_post_id,
            'location_status' :  $(this).is(":checked")
        });
    }

    $('.ewm_llt_checkbox_item').click( function(e) {

        // var keyword_id_ = $( '.ewm_llt_keyword_id_' ).val();
        var valid_update = true;
        //if( $('.ewm_keyword_client_status').val() == 'new_keyword' ){
            keyword_id_ = 0;
        //}
        //if( $( '.ewm_llt_kw_edit_area_' + keyword_id_ ).val().length == 0 ) {
        //    valid_update = false;
        //}
        //if(  $('.ewm_llt_kw_edit_area_' + keyword_id_).val().length == 0 ){
        //    $('.ewm_llt_kw_edit_area_' + keyword_id_).css({
        //        'border': '1px solid red'
        //    });
        //    valid_update=false;
        //    alert('Please add a keyword on the keyword field');
            // return false;
        //}
        //if( valid_update ){
            //if( keyword_id_ == 0 ){
                ewm_new_keyword_locations( {
                    'locations_id': $( this ).data( 'location-id' ),
                    'location_status': $(this).is( ":checked" )
                });
            /*}
            else{
                ewm_update_keywords_location();
            }
            */
        //}

        /*
        else{
            $ewm_is_checked = $( this ).is(":checked") ;
            $ewm_is_checked = false;
            if( $ewm_is_checked == true ){
               $ewm_is_checked = false;
            }
            else{
                $ewm_is_checked=false;
            }
            $( this ).prop( 'checked', $ewm_is_checked );
        }
        */

    } )

    $('.ewmLltDeleteButtonP').click(function(){

        ewm_llt_p_id = $( this ).data( 'llt-p-id' );
        $('.ewm_llt_single_main_r_' + ewm_llt_p_id ).remove();
		var form_data = new FormData();

		form_data.append( 'action', 'ewmLltDeleteButtonP' );
		form_data.append( 'ewm_llt_p_id', ewm_llt_p_id );
        // form_data.append( 'ewmdsm_keyword_name', args.keyword_name );
        // form_data.append( 'ewmdsm_keyword_id', args.keyword_id );
        // form_data.append( 'ewmdsm_status', args.status );
        // form_data.append( 'ewmdsm_random_id', args.random_id );

		jQuery.ajax({
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				response = jQuery.parseJSON(response);
                console.log( response );
			},
			error: function (response) {}
		});


    });

    $('.ewm_main_ttl_text_inner').keyup(function(){

		var form_data = new FormData();	
		form_data.append( 'action', 'ewm_dpm_update_main_llt_title' );

		form_data.append( 'ewmdsm_main_llt_id', $('#ewmParentId ').val() );
        form_data.append( 'ewmdsm_main_llt_title', $( this ).val() );


		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				console.log( response );
				response = jQuery.parseJSON( response );
                
			},
			error: function (response) {
				console.log( response );
			}
		} );



    })

    var ewm_llt_generate_llt_items = function ( args ){

		var form_data = new FormData() ;
		form_data.append( 'action', 'ewm_dpm_generate_main_llt' ) ;
		form_data.append( 'ewmdsm_main_llt_id', args.main_llt_id ) ;
        
		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				response = jQuery.parseJSON( response );
                var ewm_post_count_length = 0 ;

                Object.entries( response.keyword_list ).forEach( ( [ key , keyword_value ] ) => {

                    ewm_post_count_length = ewm_post_count_length + 1;

                    $( '.ewm_llt_generate_long_tail_list' ).html('');

                    $( '.ewm_llt_generate_long_tail_list' ).append(
                        '<div class="ewm_dpm_single_title_link"> \
                            <span class="ewm_llt_ttle"> Parent Title: '+ keyword_value.keyword.title +'</span> \
                        </div>'
                    );
                    Object.entries( keyword_value.location_list ).forEach( ( [ key,value ] ) => {
                        $( '.ewm_llt_generate_long_tail_list' ).append(
                            '<div class="ewm_dpm_single_title_link"> \
                                <a class="ewm_dpm_single_title_link_a" href="'+ value.link +'">'+ value.title +'</a> \
                            </div>'
                        ) ;
                    } )

                });

                ewm_post_count_length = response.keyword_list[0].location_list.length ;

                $( '.ewm_llt_generate_message_response' ).html( ewm_post_count_length + ' post(s) generated. Please see them below.' );

			},
			error: function ( response ) {
				console.log( response );
			}
		} );

    }

    $('.ewm_llt_generate_long_tail_button').click( function (e) {
        // get main llt post id. // console.log( $('#ewm_llt_main_id').val() );
        // send the id to server
        ewm_llt_generate_llt_items( {
            'main_llt_id': $('#ewm_llt_main_id').val()
        } );

        // populate the local host

    } )

	$('.ewm_llt_checkbox_item_all').change(function() {
        var valid_update=true;
        data_keyword_id = $( this ).data('keyword-id');
        if( data_keyword_id == 0 ){
            if(  $('.ewm_llt_kw_edit_area_0').val().length == 0 ){
                $('.ewm_llt_kw_edit_area_0').css({'border': '1px solid red'});
                valid_update=false;
                alert('Please add a keyword on the keyword field');
                // return false;
            }
        }
        if(valid_update){
            $ewm_is_checked = $( this ).is(":checked");
            $('.ewm_llt_checkbox_item').prop('checked', $ewm_is_checked );
            $('.ewm_llt_checkbox_item_all').prop('checked', $ewm_is_checked );
            ewmdsm_keyword_f = $( '.ewm_llt_kw_edit_area_' + $( this ).data('') ).val();

            $('.ewm_llt_checkbox_item').each(function( index ){
                ewm_location_id = $(this).data('location-id');
                ewm_main_llt_post_id = $('#ewm_llt_main_id').val();
                ewm_llt_update_location({
                    'location_id' : ewm_location_id,
                    'main_llt_id' : ewm_main_llt_post_id,
                    'location_status' :  $ewm_is_checked, // $(this).is(":checked")
                    'ewmdsm_keyword_f' : ewmdsm_keyword_f                   
                });
            });
        }
        else{
            $ewm_is_checked = $( this ).is(":checked");
            $ewm_is_checked=false;
            if( $ewm_is_checked == true ){
               $ewm_is_checked=false;
            }
            else{
                $ewm_is_checked=false;
            }
            $( this ).prop('checked', $ewm_is_checked );
        }
	});

    $('#ewm_llt_save_settings').click(function(e) {

        ewm_setting_f_industry = $('#ewm_setting_f_industry').val();
        if( typeof ewm_setting_f_industry == 'undefined' || ewm_setting_f_industry == 'Unselected' ){
            alert('Please select an industry.')
        }

		var form_data = new FormData();	
		form_data.append( 'action', 'ewm_dpm_settings_save' );
		form_data.append( 'ewm_setting_f_industry', ewm_setting_f_industry );

		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				console.log( response );
				response = jQuery.parseJSON( response );
                alert('Settings saved successfully');
			},
			error: function (response) {
				console.log( response );
			}
		} );
    });

    if( typeof activate_keyword_page == 'undefined' ) {
        // do nothing
    }
    else{
        // console.log( 'activate keyword page:' );
        //if( activate_keyword_page == true ){
            // $('.ewm_llt_header_items_manager').click();
        //}
    }

    var ewm_llt_create_draft_post = function(){
        $('.ewm_llt_keyword_id_').val('0');
        ewm_dpm_create_keyword();
    }

    $('.ewm_close_edit_section').click( function(){
        $('.ewm_edit_sections_field').hide();
        location.reload();
    } )

    var ewm_llt_create_new_keyword_form = function(){
        $('.ewm_llt_checkbox_item_all_0').prop( "checked", false );
        $('.ewm_llt_checkbox_0').prop( "checked", false );
        $('.ewm_keyword_client_status').val('new_keyword');
        $('.ewm_llt_kw_edit_area_0').val('');
        $('.ewm_llt_kw_edit_link_2').html('keyword-sample');
        $('.ewm_llt_kw_edit_link_4').html('city-nj');
        $(".ewm_llt_generate_llt_list_0").html('');
        $(".ewm_llt_generate_long_tail_button_0").val('Generate Posts');
        $('.ewm_llt_keyword_id_').val('0');
        ewm_llt_create_draft_post();
    }

    $('.ewm_llt_edit_kw_item_new').click( function(){
        random_id = Date.now();
        // console.log( random_id );
        $('.ewm_llt_random_details').val( random_id );
        $('.ewm_llt_keyword_id_').val('0');
        $('.ewm_llt_no_keyword_selected').hide();
        $('.ewm_llt_main_body').hide();
        $('#ewm_llt_main_wrapper_0').show();
        ewm_llt_create_new_keyword_form();
    });

    var ewm_llt_update_keyword_form = function( args ){

        args.keyword_id;
        // $( '.ewm_llt_checkbox_item_all_' + args.keyword_id ).prop( "checked", false );
        // $( '.ewm_llt_checkbox_' + args.keyword_id ).prop( "checked", false );
        // $('.ewm_llt_kw_edit_area_0').val('');
        // $('.ewm_llt_kw_edit_link_2').html('keyword-sample');
        // $('.ewm_llt_kw_edit_link_4').html('city-nj');
        $( ".ewm_llt_generate_llt_list_" + args.keyword_id ).html('');
        $( ".ewm_llt_generate_long_tail_button_" + args.keyword_id ).val('Generate Posts');
        $('.ewm_llt_keyword_id_').val( args.keyword_id );

    }

    $('.ewm_llt_edit_kw_item').click(function() {

        $('.ewm_keyword_client_status').val('update_keyword');
        random_id = Date.now();
        ewm_keyword_id = $( this ).data('keyword-id');

        $('.ewm_llt_random_details').val( random_id );
        $('.ewm_llt_keyword_id_').val( ewm_keyword_id );
        $('.ewm_llt_no_keyword_selected').hide();
        $('.ewm_llt_main_body').hide();
        $('#ewm_llt_main_wrapper_' + ewm_keyword_id ).show();

        ewm_llt_update_keyword_form({
            'keyword_id': ewm_keyword_id
        });

    } )

    var ewm_dpm_update_keyword = function( args ){

        // Send keyword to server with current active keyword.
        ewm_dpm_active_keywords_id = $('.ewm_llt_keyword_id_').val();

		var form_data = new FormData();
		form_data.append( 'action', 'ewm_dpm_update_keyword' );
		form_data.append( 'ewm_dpm_active_keywords_id', args.ewm_dpm_active_keywords_id );
        form_data.append( 'ewm_llt_random_details', args.ewm_llt_random_details );
        form_data.append( 'ewm_llt_main_id', args.ewm_llt_main_id );
        form_data.append( 'status', args.status );
        form_data.append( 'ewmdsm_main_llt_id', args.ewmdsm_main_llt_id );
        form_data.append( 'ewmdsm_keyword_name', args.ewmdsm_keyword_name );
        form_data.append( 'ewmdsm_random_id', args.ewmdsm_random_id );

		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				console.log( response );
				response = jQuery.parseJSON( response );
                $('.ewm_llt_keyword_id_').val( response.post_id );
			},
			error: function (response) {
				console.log( response );
			}
		} );

    }

    var ewm_dpm_create_keyword = function(){
        // Send keyword to server with current active keyword.
        ewm_dpm_active_keywords_id = $('.ewm_llt_keyword_id_').val();

		var form_data = new FormData();
		form_data.append( 'action', 'ewm_dpm_create_keyword' );

		form_data.append( 'ewm_dpm_active_keywords_id', $('.ewm_llt_keyword_id_').val() );
        form_data.append( 'ewm_llt_random_details', $('.ewm_llt_random_details').val() );
        // keyword id
        form_data.append( 'ewm_llt_main_id', $('.ewm_llt_main_id').val() );
        // post id
        form_data.append( 'status', 'draft' );
        form_data.append( 'ewmdsm_main_llt_id', $( '#ewm_llt_main_id' ).val() );
        form_data.append( 'ewmdsm_keyword_name', '' ); // $( '.ewm_llt_kw_edit_area_' + ewm_dpm_active_keywords_id ).val() );
        form_data.append( 'ewmdsm_random_id', $( '.ewm_llt_random_details' ).val() );

		jQuery.ajax({
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {
				console.log( response );
				response = jQuery.parseJSON( response );
                $('.ewm_llt_keyword_id_').val( response.post_id );

                $('.ewm_llt_kw_table').append('<tr class="ewm_llt_single_raw ewm_llt_keyword_name_'+response.post_id +'">\
                    <td class="ewm_llt_left_kw_item ewm_llt_left_kw_item_'+response.post_id +'">\
                    </td>\
                    <td>\
                        <input type="button" value="edit keyword" class="ewm_llt_edit_kw_item" data-keyword-id="'+response.post_id +'">\
                    </td>\
                </tr>');
    
			},
			error: function (response) {
				console.log( response );
			}
		});

    }

	$('.ewm_llt_kw_edit_area').keyup( function(){

		$('.ewm_llt_kw_edit_link_2').html( $(this).val().replace(/\s+/g, '-').toLowerCase() );
		$('.ewm_llt_kw_edit_link_4').html( $('.ewm_llt_header_input_full').val().replace(/\s+/g, '-').replace('[LLT_Location]', 'city-nj').toLowerCase() );
	    // Create / update => keyword
        llt_keyword_id = $( this ).data('keyword-id');

        // if keyword == 0 => add random_id to the $_POST
        // create/ update -> keyword on server.
        ewm_dpm_active_keywords_id = $('.ewm_llt_keyword_id_').val();
        $( '.ewm_llt_left_kw_item_' + ewm_dpm_active_keywords_id ).html( $( this ).val() );

        if( ewm_dpm_active_keywords_id > 0 ){
            ewm_dpm_update_keyword( {
                'ewm_dpm_active_keywords_id' : $('.ewm_llt_keyword_id_').val(),
                'ewm_llt_random_details': $('.ewm_llt_random_details').val(),
                'ewm_llt_main_id': $('.ewm_llt_main_id').val(),
                'status': 'publish',
                'ewmdsm_main_llt_id': $( '#ewm_llt_main_id' ).val(),
                'ewmdsm_keyword_name': $( this ).val(),
                'ewmdsm_random_id': $( '.ewm_llt_random_details' ).val(),
            } );
        }
        
    } );

    $('.ewm_llt_edit_kw_item').click( function(){
        $('.ewm_llt_main_body').hide();
        ewm_keyword_id = $( this ).data('keyword-id');
        // console.log( '.ewm_llt_main_wrapper_' + ewm_keyword_id );
        $( '#ewm_llt_main_wrapper_' + ewm_keyword_id ).show();
    } );

    $(".ewm_llt_menu_l_s").click(function(e) {
        $('.ewm_llt_l_key_section').show();
        $('.ewm_llt_generate_long_tails').hide();
        $(".ewm_llt_menu_r_s").css({ 'border':'1px solid #fff' });
        $(".ewm_llt_menu_l_s").css({ 'border':'1px solid #cab437' });
    })

    $(".ewm_llt_menu_r_s").click(function(e) {
        $('.ewm_llt_l_key_section').hide();
        $('.ewm_llt_generate_long_tails').show();
        $(".ewm_llt_menu_l_s").css({ 'border':'1px solid #fff' });
        $(".ewm_llt_menu_r_s").css({ 'border':'1px solid #cab437' });
    })

    var ewm_llt_delete_keyword = function( args ){
        // Send keyword to server with current active keyword.        
        var form_data = new FormData();
        form_data.append( 'action', 'ewm_llt_delete_keyword' );
        form_data.append( 'ewm_dpm_keywords_id', args.ewm_data_keyword_id );
        
        jQuery.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                response = jQuery.parseJSON( response );
                $('#ewm_llt_main_wrapper_'+args.ewm_data_keyword_id).hide();
                $('.ewm_llt_keyword_name_'+args.ewm_data_keyword_id).hide()

                alert( 'The keyword "' + response.keywords_status.post_title + '" has been deleted.');
            },
            error: function (response) {
                console.log( response );
            }
        });
    
    }

    $('.ewm_dpm_delete_keyword').click(function(){

        ewm_data_keyword_id = $( this ).data('keyword-id');
        // ask of confirmation
        if( confirm("You are about to delete a keyword, would you like to proceed? ") ){
            ewm_llt_delete_keyword({
                'ewm_data_keyword_id' : ewm_data_keyword_id
            } );
        }

    } )

    var ewm_llt_delete_main_p_kw = function( args ){

        // args.ewm_data_main_post_id
        var form_data = new FormData();
        form_data.append( 'action', 'ewm_llt_delete_main_post_keyword' );
        form_data.append( 'ewm_data_main_post_id', args.ewm_data_main_post_id );
         
        jQuery.ajax( {
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                response = jQuery.parseJSON( response );
                window.location.replace( '/wp-admin/admin.php?page=ewm-dpm-mainllt' );
                // $('#ewm_llt_main_wrapper_'+args.ewm_data_keyword_id).hide();
                // $('.ewm_llt_keyword_name_'+args.ewm_data_keyword_id).hide()
                // alert( 'The keyword "' + response.keywords_status.post_title + '" has been deleted.');
            },
            error: function (response) {
                console.log( response );
            }
        } );
    }

    var ewmAddNewPSectionUI = function ( response ) {

        $('.ewmSectionsWrappersSection').append( '<center><div class="ewm_parent_post_section" data-section-id="'+ response.section_id +'" id="parent_section_'+ response.section_id +'"> \
            <div class="ewm_parent_post_section_title"> \
            </div> \
            <div class="ewm_parent_post_section_manage" data-section-id=" '+ response.section_id +'" > \
                Open \
            </div> \
        </div></center>' );

    }

    var ewmCreateNewPSection = function(){
        
        var form_data = new FormData();
        form_data.append( 'action', 'ewmCreateNewPSection' );
        form_data.append( 'ewmParentId', $('#ewmParentId').val() );
        // form_data.append( 'ewmParentSectionId', $('#ewmParentSectionId').val() );
        
        jQuery.ajax( {
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                response = jQuery.parseJSON( response );
                $('#ewmParentSectionId').val( response.section_id );
                ewmAddNewPSectionUI( response );
            },
            error: function (response) {
                console.log( response );
            }            
        } );

    }

    $('.ewm_parent_add_section').click(function () {

        $('.ewm_llt_header_input_full').val('');
        $('#ewmImageIcon').html('');
        $('#ewmImageURL').val('');

        $('.ewm_edit_sections_field').show();

        inputid = 'ewm_llt_main_content';
        var editor = tinyMCE.get( inputid ).setContent('');
        // tinyMCE.activeEditor.setContent('');
        ewmCreateNewPSection();

    });

    $('#ewm_llt_delete_main_post_keyword').click( function(){
        if( confirm("You are about to delete this parent post, would you like to proceed? ") ){
            ewm_data_main_post_id = $( this ).data('ewm-llt-id') ;
            ewm_llt_delete_main_p_kw( {
                'ewm_data_main_post_id' : ewm_data_main_post_id
            } );
        }
    } )

    var ewm_llt_delete_location = function( args ) {

        // args.llt_location_post_id
        var form_data = new FormData();
        form_data.append( 'action', 'ewm_llt_delete_location' );
        form_data.append( 'ewm_llt_location_post_id', args.llt_location_post_id );
          
        jQuery.ajax( {
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                //response = jQuery.parseJSON( response );
                $('.ewm_llt_background_main_lcl').hide();
                console.log( '.ewm_llt_location_name_' + args.llt_location_post_id );
                $('.ewm_llt_location_name_' + args.llt_location_post_id ).remove();
                alert('The location has been successfully deleted.');
                
            },
            error: function (response) {
                console.log( response );
            }
        } );
    }

    $( '.ewm_llt_delete_b_t' ).click( function(){

        if( confirm("You are about to delete this location, would you like to proceed? ") ){
            ewm_llt_delete_location( {
                'llt_location_post_id' : $(this).data('llt-location-post-id')
            } );
        }
    } )
   
    // let's create function
    var ewmSelectImage = function(){
    
        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
        }
            
        // Create the media frame.
        var frame = wp.media.frames.items = wp.media({
            title: 'Select PNG image', // media window title
            library: {type: 'image/png'}, //select ONLY png image, it could be image/jpeg or image/jpg for images or 'video/MP4'
                   
            /* or combination of media types
                   
                library: {
                    type: [ 'video', 'image' ]
                },
            */
                  
            multiple: false,
            button: {text: 'Insert'}
        });
   
        frame.on(
            'select',
            function() {
                var attachment = frame.state().get( 'selection' ).first();
                        
                // let's output different data for selected image or video
                console.log("attachments");
                console.log(attachment);
                console.log(attachment.attributes.url);
                console.log(attachment.attributes.orientation);
                console.log(attachment.attributes.sizes);
                console.log(attachment.id);
   
                // lets call rootscope function to update image src
                // $rootScope.updateImageURL(attachment.attributes.url,attachment.attributes.id);
                $("#ewmImageIcon").html('<img src="' + attachment.attributes.url + '" class="ewmImageDisplay"/>' );
                $("#ewmImageURL").val( attachment.attributes.url );
            
            }
        );
    
        // Finally, open the modal.
        frame.open();

    }

    var ewmUpdateSingleParentFields = function ( args ){

        ewmSectionData = args;
        
        /*
            'ewmTitle' => $ewmSectionData->post_title 
            'ewmContent' => $ewmSectionData->post_content,
            'ewmImage' => $ewmImageURL,
            'ewmService' => $ewmService,
        */
        
        ewmSectionData.ewmImage

        $('.ewm_llt_header_input_full').val( ewmSectionData.ewmTitle );
        
        inputid = 'ewm_llt_main_content';
        var editor = tinyMCE.get( inputid ).setContent( ewmSectionData.ewmContent );

        // display image
        $('#ewmImageIcon').html( '<img src="'+ ewmSectionData.ewmImage +'" class="ewmImageDisplay"></img>' );

        // image input
        $('#ewmImageURL').val( ewmSectionData.ewmImage );

        // service input
        $('.ewmServiceRightInput').val( ewmSectionData.ewmService );

        $('.ewm_edit_sections_field').show();
        $('.ewmServiceRightInput').val();

    }

    var ewmEditSingleParentSection = function ( args ){

        var form_data = new FormData();
        form_data.append( 'action', 'ewmGetPSection' );
        form_data.append( 'ewmSectionId', args.section.data('section-id') );
        $( '#ewmParentSectionId' ).val( args.section.data('section-id') );
        
        jQuery.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                response = jQuery.parseJSON( response );
                ewmUpdateSingleParentFields( response );
            },
            error: function (response) {
                console.log( response );
            }
        });

    }

    // 
    $('.ewm_parent_post_section_manage').click( function(){
        ewmEditSingleParentSection({ 'section': $( this ) });
    });

    $('.ewmSelectImage').click(function(e){
        ewmSelectImage();
    })

    $('.ewm_llt_main_delete_button_location').click( function(e){

        // inputid = 'ewm_llt_main_content';
        // var editor = tinyMCE.get( inputid );
        var form_data = new FormData();
        form_data.append( 'action', 'ewm_llt_main_delete_button_location' );

        form_data.append( 'ewm_llt_location_id', $( this ).data('llt-location-post-id') );
        form_data.append( 'ewm_llt_group_id', $( '#ewmPostGroup' ).val() );
        
        jQuery.ajax( {
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                response = jQuery.parseJSON( response );
                $( '.ewm_llt_location_name_' + response.location_id ).remove();
            },
            error: function (response) {
                console.log( response );
            }
        } );
        
    } )


    $('.ewmLltGroupDeleteButtonLocation').click( function(e){

        var form_data = new FormData();
        form_data.append( 'action', 'ewm_llt_main_delete_button_location_group' );
        form_data.append( 'ewm_llt_location_group_to_delete', $( this ).data('llt-location-post-id') );
        
        jQuery.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                // alert('Section Saved');
                response = jQuery.parseJSON( response );
                $( '.ewm_llt_location_name_' + response.location_id ).remove();
            },
            error: function (response) {
                console.log( response );
            }
        });
        
    } )

    var ewm_error_restore_color = function (){

        $('.ewm_llt_header_input_full').focus(function(e){
            $('#ewm_llt_header_error').html('');
            $('.ewm_llt_header_input_full').css({ "border": "2px solid #ccc !important" });
        })

        $('.ewmSelectImage').focus(function(e){
            $('#ewm_image_error_message').html('');
            $('.ewmSelectImage').css({"border":"0px solid red"});
        })

        $('.ewmServiceRightInput').focus(function(e){
            $('#ewm_service_error_message').html('');
            $('.ewmServiceRightInput').css({"border":"2px solid #ccc !important"});
        })

    }

    var ewm_show_missing_area_notice = function(){

        //var numb_of_empties = 0;
        if($('.ewmServiceRightInput').val().length == 0 ){
            $('#ewm_service_error_message').html('Field is required');
            $('.ewmServiceRightInput').css({"border":"1px solid red !important"});
        }

        if( $('#ewmImageURL').val().length == 0 ){
            $('#ewm_image_error_message').html('Field is required');
            $('.ewmSelectImage').css({"border":"1px solid red !important" });
        }

        if( $('.ewm_llt_header_input_full').val().length == 0 ){
            $('#ewm_llt_header_error').html('Field is required');
            $('.ewm_llt_header_input_full').css({ "border": "1px solid red !important" });
        }

        ewm_error_restore_color();

    }

    var ewm_check_that_all_sections_are_filled = function (){

        var numb_of_empties = 0;

        if($('.ewmServiceRightInput').val().length == 0 ){
            numb_of_empties++;
        }

        if( $('#ewmImageURL').val().length == 0 ){
            numb_of_empties++;
        }

        if( $('.ewm_llt_header_input_full').val().length == 0 ){
            numb_of_empties++;
        }

        return numb_of_empties;

    }

    $( '.ewmSaveSingleSection' ).click(function(){

        numb_of_empties = ewm_check_that_all_sections_are_filled();

        if( numb_of_empties > 0 ){
            ewm_show_missing_area_notice();
            return 0;
        }

        inputid = 'ewm_llt_main_content';
        var editor = tinyMCE.get( inputid );

        var form_data = new FormData();
        form_data.append( 'action', 'ewmSaveSingleSection' );
        
        form_data.append( 'ewm_llt_header_input_full', $('.ewm_llt_header_input_full').val() );
        form_data.append( 'ewm_llt_content', editor.getContent() );
        form_data.append( 'ewmServiceRightInput', $('.ewmServiceRightInput').val() );
        form_data.append( 'ewmImageURL', $('#ewmImageURL').val() );
        form_data.append( 'ewm_post_id', $( '#ewmParentSectionId' ).val() );
        form_data.append( 'ewmParentId',  $('#ewmParentId').val() );
        
        jQuery.ajax( {
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                // console.log( response );
                // alert('Section Saved');
                $('.ewmSave_message_bottom').html('Section Saved Successfully!');
            },
            error: function (response) {
                console.log( response );
            }
        } );

    } )

    var ewmDeleteParentSection = function( args ){

        var form_data = new FormData();

        form_data.append( 'action', 'ewmDeleteParentSection' );
        form_data.append( 'ewmSectionId', args.sectionId );
        
        jQuery.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                // alert('Section Deleted');
            },
            error: function (response) {
                console.log( response );
            }
        });
        
    }

    var ewmUpdateDeleteParentSection = function( args = {} ){

        $('#parent_section_' + args.sectionId ).remove();
        
    }

    $('.ewm_parent_post_section_delete').click( function () {

        ewmDeleteParentSection({
           'sectionId' : $( this ).data( 'section-id' )
        });

        ewmUpdateDeleteParentSection({
            'sectionId' : $( this ).data( 'section-id' )
        });

    } );

    $('.ewm_llt_inner_field').click(function(){
        $('.ewmSave_message_bottom').html('');
    });

    $('.ewm_group_name_edit_text').keyup(function(){

        ewm_group_id = $( this ).data('ewm-group-id');
        ewm_group_name =  $( this ).val();

		var form_data = new FormData();
		form_data.append( 'action', 'ewm_group_update_name' ) ;
		form_data.append( 'ewm_group_id', ewm_group_id ) ;
		form_data.append( 'ewm_group_name', ewm_group_name ) ;   

		jQuery.ajax( {
			url: ajax_object.ajaxurl,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function ( response ) {},
			error: function ( response ) {}
		} );

    } );

    var ewm_llt_update_single_location_to_group = function( args ){

        var form_data = new FormData();

        form_data.append( 'action', 'ewm_llt_update_s_l_to_g' );
        form_data.append( 'ewm_args_post_name', args.post_name );
        form_data.append( 'ewm_args_post_id', args.post_id );
        form_data.append( 'ewmdsm_post_group_id', $('#ewmPostGroup').val() );
            
        jQuery.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                response = jQuery.parseJSON( response );  
                // alert('Section Deleted');
                $('.ewm_llt_background_inner_close_lcl').click();
            },
            error: function (response) {
                console.log( response );
            }
        });

    }

    var ewm_llt_listen_to_search_options = function(){

        $('.ewm_llt_s_search_item').click( function(){

           // alert( $( this ).html() +' -- '+ $( this ).data('ewm_post_id') );
           $('.ewm_llt_checkbox_item_lcl').val( $( this ).html() );
           $('.ewm_llt_save_location_lcl').hide();

           ewm_llt_update_single_location_to_group( {
                'post_name' : $( this ).html(),
                'post_id' : $( this ).data('ewm_post_id'),
            } );

        } );

    }

    var ewm_llt_populate_possible_variables = function( args ){

        obj = args.search_list;
        $('.ewm_llt_search_list_display').html('');

        Object.keys( obj ).forEach(function(k){

            // console.log(k + ' - ' + obj[k]);
            $('.ewm_llt_search_list_display').append( '<span class="ewm_llt_s_search_item" data-ewm_post_id="' + k + '" >' + obj[k] + '</span>' );

        });

        ewm_llt_listen_to_search_options();

    }

    var ewm_llt_update_on_search = function ( args = {} ){

        // search var
        // populate possible variables
        var form_data = new FormData();

        form_data.append( 'action', 'ewm_llt_update_on_search' );
        form_data.append( 'var_to_search', args.var_to_search );
        
        jQuery.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {
                console.log( response );
                response = jQuery.parseJSON( response );
                ewm_llt_populate_possible_variables({ 
                    'search_list' : response.search_list 
                });
                // alert('Section Deleted');
            },
            error: function (response) {
                console.log( response );
            }
        });

    };

    $('.ewm_llt_checkbox_item_lcl').keyup(function(){

        var_to_search = $( this ).val();
        $('.ewm_llt_save_location_lcl').show() ;

        ewm_llt_update_on_search({
            'var_to_search' : var_to_search
        });
    
    })

} );
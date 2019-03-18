var wppx_imgs = {};
var wppx_selected = new Array();
var wppx_opened = false;
var wppx_current = '';
var wppx_width_small = '630px';
var wppx_width_big = '930px';
var wppx_height = '580px';

jQuery( document ).ready( function( $ ) {

	$( 'body' ).on( 'click touch', '#wppx_search', function() {
		wppx_search( 1 );
	} );

	$( 'body' ).on( 'change', '#wppx_page_select', function() {
		wppx_search( $( this ).val() );
	} );

	$( 'body' ).on( 'click touch', '.wppx_item_overlay', function( event ) {
		console.log('wppx_item_overlay');
		var checkbox = $( this ).parent().find( ':checkbox' );
		var checkbox_id = $( this ).attr( 'rel' );

		wppx_opened = true;
		wppx_current = checkbox_id;

		if ( event.ctrlKey ) {

			if ( ! checkbox.is( ':checked' ) ) {
				wppx_selected.push( checkbox_id );
			} else {
				wppx_selected.splice( wppx_selected.indexOf( checkbox_id ), 1 );
			}

			checkbox.attr( 'checked', ! checkbox.is( ':checked' ) );
		} else {
			if ( ! checkbox.is( ':checked' ) ) {
				wppx_selected = [checkbox_id];
				$( '#wppx_area' ).find( 'input:checkbox' ).removeAttr( 'checked' );
				checkbox.attr( 'checked', ! checkbox.is( ':checked' ) );
			}
		}
		$( '#wppx_title' ).val( wppx_imgs[checkbox_id].img_title );
		$( '#wppx_caption' ).val( wppx_imgs[checkbox_id].img_caption );
		$( '#wppx_width' ).val( wppx_imgs[checkbox_id].img_width );
		$( '#wppx_height' ).val( wppx_imgs[checkbox_id].img_height );
		$( '#wppx_url' ).val( wppx_imgs[checkbox_id].img_full );
		$( '#cur-pexels-img' ).attr( 'src', wppx_imgs[checkbox_id].img_full );
		$( '#wppx_view' ).html( '<img src="' + wppx_imgs[checkbox_id].img_full + '"/>' );

	} );

} );

function wppx_search( page ) {
	jQuery( '#wppx_search' ).addClass( 'loading' );
	jQuery( '#wppx_container' ).html( '' );
	jQuery( '#wppx_page' ).html( '' );
	var data = {
		action: 'wppx_search',
		key: jQuery( '#wppx_input' ).val(),
		page: page,
		wppx_nonce: wppx_vars.wppx_nonce
	};
	jQuery.ajax( {
		method: 'POST',
		url: wppx_vars.wppx_ajax_url,
		data: data,
		success: function( response ) {
			wppx_show_images( JSON.parse( response ), page );
		},
		error: function() {
			console.log( 'error' );
		},
	} );
}

function wppx_show_images( data, page ) {
	jQuery( '#wppx_search' ).removeClass( 'loading' );
	if ( data.photos != 'undefined' ) {
		for ( var i = 0; i < data.photos.length; i ++ ) {
			var img_id = '';
			var img_title = '';
			if ( data.photos[i].id != undefined ) {
				img_id = data.photos[i].id;
			} else {
				img_id = data.photos[i].id;
			}
			var img_ext = data.photos[i].src.original.split( '.' ).pop().toUpperCase().substring( 0, 4 );
			var img_site = data.photos[i].url;
			var img_thumb = data.photos[i].src.tiny;
			var img_full = data.photos[i].src.original;
			var img_width = data.photos[i].width;
			var img_height = data.photos[i].height;
			if ( data.photos[i].photographer != undefined ) {
				img_title = String( data.photos[i].photographer );
			} else {
				img_title = img_id;
			}
			jQuery( '#wppx_container' ).append( '<div class="wppx_item" bg="' + img_thumb + '"><div class="wppx_item_overlay" rel="' + img_id + '"></div><div class="wppx_check"><input type="checkbox" value="' + img_id + '"/></div><span>' +
			                                    img_ext + ' | ' + img_width + 'x' + img_height + '</span></div>'
			);
			wppx_imgs[img_id] = {
				img_ext: img_ext,
				img_site: img_site,
				img_thumb: img_thumb,
				img_full: img_full,
				img_width: img_width,
				img_height: img_height,
				img_title: img_title,
				img_caption: ''
			};
		}
		jQuery( '.wppx_item' ).each( function() {
			var bg_url = jQuery( this ).attr( 'bg' );
			jQuery( this ).css( 'background-image', 'url(' + bg_url + ')' );
		} );
	}
	if ( data.total_results != 'undefined' ) {
		var pages = 'About ' + data.total_results + ' results / Pages: ';
		var per_page = 12;
		if ( data.total_results / per_page > 1 ) {
			pages += '<select id="wppx_page_select" class="wppx_page_select">';
			for ( var j = 1; j < data.total_results / per_page + 1; j ++ ) {
				pages += '<option value="' + j + '"';
				if ( j == page ) {
					pages += ' selected';
				}
				pages += '>' + j + '</option> ';
			}
			pages += '</select>';
		}
		jQuery( '#wppx_page' ).html( pages );
	}
}

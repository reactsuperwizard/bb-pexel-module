var bbpx_imgs = {};
var bbpx_selected = new Array();
var bbpx_opened = false;
var bbpx_current = '';
var bbpx_width_small = '630px';
var bbpx_width_big = '930px';
var bbpx_height = '580px';

jQuery( document ).ready( function( $ ) {

	$( 'body' ).on( 'click touch', '#bbpx_search', function() {
		bbpx_search( 1 );
	} );

	$( 'body' ).on( 'change', '#bbpx_page_select', function() {
		bbpx_search( $( this ).val() );
	} );

	$( 'body' ).on( 'click touch', '.bbpx_item_overlay', function( event ) {
		console.log('bbpx_item_overlay');
		var checkbox = $( this ).parent().find( ':checkbox' );
		var checkbox_id = $( this ).attr( 'rel' );

		bbpx_opened = true;
		bbpx_current = checkbox_id;

		if ( event.ctrlKey ) {

			if ( ! checkbox.is( ':checked' ) ) {
				bbpx_selected.push( checkbox_id );
			} else {
				bbpx_selected.splice( bbpx_selected.indexOf( checkbox_id ), 1 );
			}

			checkbox.attr( 'checked', ! checkbox.is( ':checked' ) );
		} else {
			if ( ! checkbox.is( ':checked' ) ) {
				bbpx_selected = [checkbox_id];
				$( '#bbpx_area' ).find( 'input:checkbox' ).removeAttr( 'checked' );
				checkbox.attr( 'checked', ! checkbox.is( ':checked' ) );
			}
		}
		$( '#bbpx_title' ).val( bbpx_imgs[checkbox_id].img_title );
		$( '#bbpx_caption' ).val( bbpx_imgs[checkbox_id].img_caption );
		$( '#bbpx_width' ).val( bbpx_imgs[checkbox_id].img_width );
		$( '#bbpx_height' ).val( bbpx_imgs[checkbox_id].img_height );
		$( '#bbpx_url' ).val( bbpx_imgs[checkbox_id].img_full );
		$( '#cur-pexels-img' ).attr( 'src', bbpx_imgs[checkbox_id].img_full );
		$( '#bbpx_view' ).html( '<img src="' + bbpx_imgs[checkbox_id].img_full + '"/>' );

	} );

} );

function bbpx_search( page ) {
	jQuery( '#bbpx_search' ).addClass( 'loading' );
	jQuery( '#bbpx_container' ).html( '' );
	jQuery( '#bbpx_page' ).html( '' );
	var data = {
		action: 'bbpx_search',
		key: jQuery( '#bbpx_input' ).val(),
		page: page,
		bbpx_nonce: bbpx_vars.bbpx_nonce
	};
	jQuery.ajax( {
		method: 'POST',
		url: bbpx_vars.bbpx_ajax_url,
		data: data,
		success: function( response ) {
			bbpx_show_images( JSON.parse( response ), page );
		},
		error: function() {
			console.log( 'error' );
		},
	} );
}

function bbpx_show_images( data, page ) {
	jQuery( '#bbpx_search' ).removeClass( 'loading' );
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
			jQuery( '#bbpx_container' ).append( '<div class="bbpx_item" bg="' + img_thumb + '"><div class="bbpx_item_overlay" rel="' + img_id + '"></div><div class="bbpx_check"><input type="checkbox" value="' + img_id + '"/></div><span>' +
			                                    img_ext + ' | ' + img_width + 'x' + img_height + '</span></div>'
			);
			bbpx_imgs[img_id] = {
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
		jQuery( '.bbpx_item' ).each( function() {
			var bg_url = jQuery( this ).attr( 'bg' );
			jQuery( this ).css( 'background-image', 'url(' + bg_url + ')' );
		} );
	}
	if ( data.total_results != 'undefined' ) {
		var pages = 'About ' + data.total_results + ' results / Pages: ';
		var per_page = 12;
		if ( data.total_results / per_page > 1 ) {
			pages += '<select id="bbpx_page_select" class="bbpx_page_select">';
			for ( var j = 1; j < data.total_results / per_page + 1; j ++ ) {
				pages += '<option value="' + j + '"';
				if ( j == page ) {
					pages += ' selected';
				}
				pages += '>' + j + '</option> ';
			}
			pages += '</select>';
		}
		jQuery( '#bbpx_page' ).html( pages );
	}
}

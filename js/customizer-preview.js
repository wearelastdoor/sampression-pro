function google_web_fonts_id( font ) {
	font = font.split('=');
	var colon = '';
	if( font[0].indexOf(':') == -1 ) {
		colon = ':';
	}
	return font[0] + colon + ':latin';
}

function google_web_fonts() {
	var font_script =  document.getElementById('sampression-fonts-css');//sampression-google-fonts
	if (typeof(font_script) != 'undefined' && font_script != null) {
		font_script.parentNode.removeChild(font_script);
	}
	var google_fonts = Array();
	google_fonts.push( google_web_fonts_id( wp.customize._value.webtitle_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.webtagline_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.primarynav_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.secondarynav_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.headertext_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.bodytext_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.filterby_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.metatext_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.widgettext_font_family() ) );
	google_fonts.push( google_web_fonts_id( wp.customize._value.paginationtext_font_family() ) );

	google_fonts = jQuery.unique( google_fonts );
	//console.log(google_fonts);
	var fonts_ = google_fonts.join('|');

	var wf = document.createElement('link');
	wf.setAttribute("id", "sampression-fonts-css");
	wf.setAttribute("media", "all");
	wf.setAttribute("type", "text/css");
	wf.setAttribute("href", "//fonts.googleapis.com/css?family=" + fonts_);
	wf.setAttribute("rel", "stylesheet");
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(wf, s);

}

function font_family( to ) {
	var font_ = '', font = '', style_ = '', style = '';
	if(to.indexOf(':') === -1) {
		font_ = to.split('=');
		font = font_[0].replace('+', ' ');
		style = font_[1];
	} else {
		font_ = to.split(':');
		font = font_[0].replace('+', ' ');
		style_ = font_[1].split('=');
		style = style_[1];
	}
	return '"'+font+'", '+style;
}

( function( $ ) {

	"use strict";

	function sampression_font_family( target, to ) {
		google_web_fonts();
		var family = font_family( to );
		$( target ).css( {
			'font-family': family
		});
	}

	function sampression_font_size( target, to ) {
		$( target ).css( {
			'font-size': (to / 10) + 'rem'
		});
	}

	function sampression_font_style( target, to ) {
		var styles = to.split(',');
		if( $.inArray('bold', styles) !== -1 ) {
			$( target ).css({ 'font-weight' : 'bold' });
		} else {
			$( target ).css({ 'font-weight' : 'initial' });
		}
		if( $.inArray('italic', styles) !== -1 ) {
			$( target ).css({ 'font-style' : 'italic' });
		} else {
			$( target ).css({ 'font-style' : 'initial' });
		}
		if( $.inArray('all-caps', styles) !== -1 ) {
			$( target ).css({ 'text-transform' : 'uppercase' });
		} else {
			$( target ).css({ 'text-transform' : 'none' });
		}
		if( $.inArray('underline', styles) !== -1 ) {
			$( target ).css({ 'text-decoration' : 'underline' });
		} else {
			$( target ).css({ 'text-decoration' : 'none' });
		}
	}

	function sampression_font_color(target, to) {
		$( target ).css( {
			'color': to
		});
	}

	function sampression_font_color_hover( target, to, base_color ) {
		$( target ).hover(function() {
			$(this).css({
				'color': to
			});
		}, function() {
			$(this).css({
				'color': base_color
			});
		});
	}

	// Site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			if( $( '#site-title a' ).length > 0 ) {
				$( '#site-title a' ).text( to );
			}
		} );
	} );

	// Site description (Tagline)
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Body background color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$('body.custom-background').css({
				'background': 'none'
			});
			$('#content-wrapper').css({
    			'background-color': to
			});
		});
	} );

	// Body background cover
	wp.customize( 'sampression_background_cover', function( value ) {
		value.bind( function( to ) {
			if(to == true) {
				$('#content-wrapper').css('background-size', 'cover');
			} else {
				$('#content-wrapper').css('background-size', 'initial');
			}
		} );
	} );

	// Website Title Font Family
	wp.customize( 'webtitle_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '#site-title a', to );
		});
	});

	// Website Title Font Size
	wp.customize( 'webtitle_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '#site-title', to );
		} );
	} );

	// Website Title Font Style
	wp.customize( 'webtitle_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '#site-title a', to );
		});
	} );

	// Website Title Font Color
	wp.customize( 'webtitle_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '#site-title a', to );
		});
	});

	// Website Tagline Font Family
	wp.customize( 'webtagline_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '#site-description', to );
		});
	});

	// Website Tagline Font Size
	wp.customize( 'webtagline_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '#site-description', to );
		});
	});

	// Website Tagline Font Style
	wp.customize( 'webtagline_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '#site-description', to );
		} );
	} );

	// Website Tagline Font Color
	wp.customize( 'webtagline_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '#site-description', to );
		} );
	} );

	// Primary Navigation Font Family
	wp.customize( 'primarynav_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '#top-nav ul li a', to );
		});
	} );

	// Primary Navigation Font Size
	wp.customize( 'primarynav_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '#top-nav ul li a', to );
		});
	} );

	// Primary Navigation Font Style
	wp.customize( 'primarynav_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '#top-nav ul li a', to );
		} );
	} );

	// Primary Navigation Font Color
	wp.customize( 'primarynav_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '#top-nav ul li a', to );
		});
	} );

	// Primary Navigation Font Color:Hover
	wp.customize( 'primarynav_font_color_hover', function( value ) {
		value.bind( function( to ) {
			var base_color = wp.customize._value.primarynav_font_color();
			sampression_font_color_hover( '#top-nav ul li a', to, base_color );
		});
	} );

	// Social Icon Color
	wp.customize( 'social_icon_color', function( value ) {
		value.bind( function( to ) {
			if(wp.customize._value.use_social_default_color() == false) {
				if($('ul.sm-top').length > 0) {
					$('.sm-top li.sm-top-fb a, .sm-top li.sm-top-tw a, .sm-top li.sm-top-youtube a, .sm-top li.sm-top-gplus a, .sm-top li.sm-top-tumblr a, .sm-top li.sm-top-pinterest a, .sm-top li.sm-top-linkedin a, .sm-top li.sm-top-github a, .sm-top li.sm-top-instagram a, .sm-top li.sm-top-flickr a, .sm-top li.sm-top-vimeo a').css({
						'color' : to
					});
				}
			}
			
		});
	});

	// Secondary Navigation Background Color
	wp.customize( 'sec_nav_background_color', function( value ) {
		value.bind( function( to ) {
			$('.full-width #full-width-nav').css({
				'background-color' : to
			});
		});
	});

	// Secondary Navigation Font Family
	wp.customize( 'secondarynav_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( 'ul#menu-sec-menu li a', to );
		} );
	} );

	// Secondary Navigation Font Size
	wp.customize( 'secondarynav_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( 'ul#menu-sec-menu li a', to );
		} );
	} );

	// Secondary Navigation Font Style
	wp.customize( 'secondarynav_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( 'ul#menu-sec-menu li a', to );
		} );
	} );

	// Secondary Navigation Font Color
	wp.customize( 'secondarynav_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( 'ul#menu-sec-menu li a', to );
		} );
	} );

	// Secondary Navigation Font Color:Hover
	wp.customize( 'secondarynav_font_color_hover', function( value ) {
		value.bind( function( to ) {
			var base_color = wp.customize._value.secondarynav_font_color();
			sampression_font_color_hover( 'ul#menu-sec-menu li a', to, base_color );
		} );
	} );

	// Header Text Font Family
	wp.customize( 'headertext_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '.post-title a, .widget .widget-title', to );
		} );
	} );

	// Header Text Font Size
	wp.customize( 'headertext_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '.post-title a, .widget .widget-title', to );
		} );
	} );

	// Header Text Font Style
	wp.customize( 'headertext_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '.post-title a, .widget .widget-title', to );
		} );
	} );

	// Header Text Font Color
	wp.customize( 'headertext_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '.post-title a, .widget .widget-title', to );
		} );
	} );

	// Header Text Link Color
	wp.customize( 'headertext_link_color', function( value ) {
		value.bind( function( to ) {
			var base_color = wp.customize._value.headertext_font_color();
			sampression_font_color_hover( '.post-title a', to, base_color );
		} );
	} );

	// Body Text Font Family
	wp.customize( 'bodytext_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( 'p', to );
		} );
	} );

	// Body Text Font Size
	wp.customize( 'bodytext_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( 'p', to );
		} );
	} );

	// Body Text Font Style
	wp.customize( 'bodytext_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( 'p', to );
		} );
	} );

	// Body Text Font Color
	wp.customize( 'bodytext_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( 'p, p a', to );
		} );
	} );

	// Body Text Link Color
	wp.customize( 'bodytext_link_color', function( value ) {
		value.bind( function( to ) {
			var base_color = wp.customize._value.bodytext_font_color();
			sampression_font_color_hover( 'p a', to, base_color );
		} );
	} );

	// Filter By Icon Color
	wp.customize( 'filterby_icon_color', function( value ) {
		value.bind( function( to ) {
			$('#primary-nav ul.nav-listing li a span').css({
				'background-color' : to
			});
		} );
	} );

	// Filter By Font Family
	wp.customize( 'filterby_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '#primary-nav .nav-label, #filter a', to );
		} );
	} );

	// Filter By Font Size
	wp.customize( 'filterby_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '#primary-nav .nav-label, #filter a', to );
		} );
	} );

	// Filter By Font Style
	wp.customize( 'filterby_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '#primary-nav .nav-label, #filter a', to );
		} );
	} );

	// Filter By Font Color
	wp.customize( 'filterby_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '#primary-nav .nav-label, #filter a', to );
		} );
	} );

	// Meta Text Font Family
	wp.customize( 'metatext_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '.meta a', to );
		} );
	} );

	// Meta Text Font Size
	wp.customize( 'metatext_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '.post-author:before, .posted-on:before, .edit:before, .cats:before, .tags:before, .cats:before, .count-comment:before, .meta a', to );
		} );
	} );

	// Meta Text Font Style
	wp.customize( 'metatext_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '.meta a', to );
		} );
	} );

	// Meta Text Font Color
	wp.customize( 'metatext_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '.meta, .meta a', to );
		} );
	} );

	// Meta Text Link Color
	wp.customize( 'metatext_link_color', function( value ) {
		value.bind( function( to ) {
			var base_color = wp.customize._value.metatext_font_color();
			sampression_font_color_hover( '.meta a', to, base_color );
		} );
	} );

	// Widget Text Font Family
	wp.customize( 'widgettext_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '.widget', to );
		} );
	} );

	// Widget Text Font Size
	wp.customize( 'widgettext_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '.widget', to );
		} );
	} );

	// Widget Text Font Style
	wp.customize( 'widgettext_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '.widget', to );
		} );
	} );

	// Widget Text Font Color
	wp.customize( 'widgettext_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '.widget', to );
		} );
	} );

	// Widget Text Link Color
	wp.customize( 'widgettext_link_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '.widget a', to );
		} );
	} );

	// Pagination Text Font Family
	wp.customize( 'paginationtext_font_family', function( value ) {
		value.bind( function( to ) {
			sampression_font_family( '#nav-below a, #nav-below span', to );
		} );
	} );

	// Pagination Text Font Size
	wp.customize( 'paginationtext_font_size', function( value ) {
		value.bind( function( to ) {
			sampression_font_size( '#nav-below a, #nav-below span', to );
		} );
	} );

	// Pagination Text Font Style
	wp.customize( 'paginationtext_font_style', function( value ) {
		value.bind( function( to ) {
			sampression_font_style( '#nav-below a, #nav-below span', to );
		} );
	} );

	// Pagination Text Font Color
	wp.customize( 'paginationtext_font_color', function( value ) {
		value.bind( function( to ) {
			sampression_font_color( '#nav-below a, #nav-below span', to );
		} );
	} );

	// Pagination Text Font Color:Hover
	wp.customize( 'paginationtext_font_color_hover', function( value ) {
		value.bind( function( to ) {
			var base_color = wp.customize._value.paginationtext_font_color();
			sampression_font_color_hover( '#nav-below a', to, base_color );
		} );
	} );

	// Sticky Pin Color
	wp.customize( 'sticky_pin_color', function( value ) {
		value.bind( function( to ) {
			console.log(to);
		} );
	} );

	// Button Background Color
	wp.customize( 'button_bg_color', function( value ) {
		value.bind( function( to ) {
			$('.button, button, input[type="submit"], input[type="reset"], input[type="button"]').css({
				'background-color' : to
			});
		} );
	} );

	//Custom CSS
	wp.customize( 'sampression_custom_css', function( value ) {
		value.bind( function( to ) {
			$( '#sampression-custom-css' ).html( to );
		} );
	} );























	// wp.customize( 'title_font', function( value ) {
	// 	value.bind( function( to ) {
	// 		console.log(to);
	// 	} );
	// } );

} )( jQuery );
/**
 * Custom Scripts
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

jQuery( document ).ready(function($) {
    /**
     * Removing padding of Video Post's P TAG   archive
     */
    $('.entry p span.embed-youtube, .entry p div.responsive-video-wrapper, .entry span.embed-vine').each(function() {
        $(this).parent('p').css('padding', '0');
        //console.log($(this).parent('p'));
    });
});

function shadeColor(color, percent){
    if (color.length > 7 ) return shadeRGBColor(color,percent);
    else return shadeColor2(color,percent);
}
function shadeColor2(color, percent) {
    var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
    return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
}


(function($) {

    /**
     * Hiding icon on Nav listing menu on header if categories are on one line
     */
    if($('.nav-listing').length > 0) {
        if($('.nav-listing').height() < 40) {
            $('#btn-nav-opt').remove();
        }
        var data_col = $('.nav-listing').attr('data-color');
        var col = shadeColor(data_col, 0.5);
        $('.nav-listing li a').each(function() {
            if(!$(this).hasClass('selected')) {
                $(this).children('span').css('background-color', col);
                $(this).css('color', col);
            }
            $('#btn-nav-opt').css('background-color', col);
            $('#btn-nav-opt').hover(function(){
                $(this).css('background-color', data_col);
            }, function(){
                $(this).css('background-color', col);
            });
        });

    }

	/**
     * Do not submit search form if empty
     */
     $(document).on( 'click', '.searchsubmit', function() {
        var search = $(this).prev('.search-field');
        if(search.val() == '') {
            search.focus();
            return false;
        }
     });

// this fixes post spacing issue  when image is set to 100%
setTimeout(function(){$(window).resize()},2000); // This triggers window resize 1 second after dom is ready

// For Primary Navigation	
var minHt = 28; // Minimum height for Navigation
var ulHt = getTotalHt($('#primary-nav').find('ul')) || 28; // Getting the height of Navigation

//show the sneak peek of all categories
if( minHt < ulHt ) {
	$('#btn-nav-opt').show();
	$('#primary-nav .sixteen')
	.animate({ 'height' : ulHt },300,function(){
		$('#btn-nav-opt').addClass('up');
	})
	.delay( 300)
	.animate({ 'height' : minHt },1000,function(){
		$('#btn-nav-opt').removeClass('up');
	});
}

//==============================================================
// Toggle Height of the Primary Navigation
// =============================================================
$('#btn-nav-opt').click(function(){
	if($(this).hasClass('up')){
		$('#primary-nav .sixteen').animate({ 'height' : minHt } );
                pageScroll('#primary-nav-scroll',700); //scrolling page to the top when user clicks  on categories

		$(this).removeClass('up');
	}else{
		$('#primary-nav .sixteen').animate({ 'height' : ulHt });
		$(this).addClass('up');
	}
	return false;
});
//==============================================================
// WordPress specialist:
// get Widget title as a widget class
// ==============================================================

$('.widget').each( function(){
	var widgetTitle = $(this).find('.widget-title').text();
	var widgetTitleSlug = widgetTitle.replace(/ /gi, "-");
	widgetTitleSlug = widgetTitleSlug.toLowerCase();
	widgetTitleSlug = "widget-" + widgetTitleSlug;
	$(this).addClass(widgetTitleSlug);
});


//==============================================================
// get Sticky menu
// ==============================================================
$(window).scroll( function() {
        if ($(window).scrollTop() > getTotalHt('#header')) {
            $('.btn-top').addClass('fixed');
        }
        else{
            $('.btn-top').removeClass('fixed');
        }
    });

if($('body').hasClass('home')){ 	// enable sticky menu only on homepage
	$(window).scroll( function() {
		if ($(window).scrollTop() > getTotalHt('#header')){
			$('#primary-nav').addClass('fixed');
			$('#content-wrapper').css('padding-top',minHt+30);
			
		} else {
			$('#primary-nav').removeClass('fixed');
			$('#content-wrapper').css('padding-top','20px');
		}
	} );
}

$('.menu-primary-menu-container select').change(function(){
	var currentpage = $(this).val();
	$(location).attr('href','?page_id='+currentpage);
});
    if($(window).width() > 767){
        $('.menu-item').hover(
            function(e){
            e.stopPropagation();
            $(this).children('ul').fadeIn();
            },
            function(e){
            e.stopPropagation();
            $(this).children('ul').delay(100).fadeOut();
            }
        );
    }

	// Create the label 'Menu:'
	$("#top-nav-mobile").append($("<div />",{"class":"nav-label"}).html("Menu:"));
	
	// Create the dropdown select element
	$("<select />",{"class":"top-menu-nav"}).insertAfter("#top-nav-mobile .nav-label");
	
    // Create default option "Go to"
	$("<option />", {
			 "selected": "selected",
			 "value"   : "",
			 "text"    : "Go To"
	}).appendTo(" #top-nav-mobile select");
	  
    // Populate dropdown with menu items
	recursiveDropdown($("nav#top-nav > ul ").children('li'),'');
	
	// Recursive function for multilevel menu
	function recursiveDropdown(elem, dash){
		elem.each(function(){
			var el = $(this), anchor = $('> a', this);
			var sl = $("<option />", {
						"value"   : anchor.attr("href"),
						"text"    : dash+anchor.text()
					});
			if(el.children('ul').length>0){  //contains next level 
				$("#top-nav-mobile select").append(sl);
				recursiveDropdown(el.children('ul').children('li'), dash+'-'); //grab them
			}else{
				$("#top-nav-mobile select").append(sl);
			}	
		});	
	}
	  
	// To make dropdown actually work
    $("select.top-menu-nav").change(function() {
        window.location = $(this).find("option:selected").val();
    }); 
	 
	$('#page_id').change(function(){
		var currentpage = $(this).val();
		$(location).attr('href','?page_id='+currentpage);
	});


    /**
     * Navigation
     * Add the 'show-nav' class to the body when the nav toggle is clicked
     */
    $( '.toggle-nav' ).click(function(e) {

        // Prevent default behaviour
        e.preventDefault();

        // Add the 'show-nav' class
        $( 'body' ).toggleClass( 'show-nav' );
        $('#top-nav').addClass('toggled-on');
        // Add the 'vertical-transform' class
        $(this).toggleClass('vertical-transform');

    });

    /**
     * Append 'nav-height-col' and 'sub-menu-toggle' only once
     * after clicking '#trigger-primary-nav'
     */
    $( '.toggle-nav' ).one('click', function(e) {

        // Prevent default behaviour
        e.preventDefault();

        $('#inner-wrapper').append('<div class="nav-height-col">menu background</div>');
        // Append 'sub-menu-toggle'

    });


    if($('.page_item_has_children').length > 0){
        $('#top-nav li.page_item_has_children').prepend('<i class="sub-menu-toggle"></i>');
        $( '.sub-menu-toggle' ).click(function(e) {
            // Prevent default behaviour
            e.preventDefault();

            if($(this).hasClass('menu-open')){
                $(this).parent('li.page_item_has_children').children('ul').slideToggle('fast');
                $(this).parent('li.page_item_has_children').removeClass('active');
                $('#top-nav ul li').removeClass('inactive');
                $(this).toggleClass('menu-open');
            } else {
                $('#top-nav ul li').addClass('inactive');
                $('#top-nav ul li').removeClass('active');
                $(this).removeClass('menu-open');
                $(this).parent('li.page_item_has_children').children('ul').slideUp('fast');
                $(this).parent('li.page_item_has_children').children('ul').slideToggle('fast');
                $(this).parent('li.page_item_has_children').removeClass('inactive');
                $(this).parent('li.page_item_has_children').addClass('active');
                $(this).toggleClass('menu-open');
            }
        });
    }

    /**
     * Fallback for menu
     */
    if($('.top-menu ').length > 0){
        $('#top-nav li.menu-item-has-children').prepend('<i class="sub-menu-toggle"></i>');
        $( '.sub-menu-toggle' ).click(function(e) {
            // Prevent default behaviour
            e.preventDefault();
            if($(this).hasClass('menu-open')){

                $(this).parent('li.menu-item-has-children').children('ul').slideToggle('fast');
                $(this).parent('li.menu-item-has-children').removeClass('active');
                $('#top-nav ul li').removeClass('inactive');
                $(this).toggleClass('menu-open');
            } else {
                $('#top-nav ul li').addClass('inactive');
                $('#top-nav ul li').removeClass('active');
                $(this).removeClass('menu-open');
                $(this).parent('li.menu-item-has-children').children('ul').slideUp('fast');
                $(this).parent('li.menu-item-has-children').children('ul').slideToggle('fast');
                $(this).parent('li.menu-item-has-children').removeClass('inactive');
                $(this).parent('li.menu-item-has-children').addClass('active');
                $(this).toggleClass('menu-open');

            }
        });
    }


//==============================================================
//Responsive Video
//==============================================================

    (function($) {
        $.fn.responsiveVideo = function() {
            // Add CSS to head
            $('head').append('<style type="text/css">.responsive-video-wrapper{width:100%;position:relative;padding:0 ;margin-bottom:25px;}.responsive-video-wrapper iframe,.responsive-video-wrapper object,.responsive-video-wrapper embed{position:absolute;top:0;left:0;width:100%;height:100%}</style>');
            // Gather all videos
            var $all_videos = $(this).find('iframe[src*="player.vimeo.com"], iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="dailymotion.com"], iframe[src*="vine.co"], iframe[src*="kickstarter.com"][src*="video.html"], object, embed');
            // Cycle through each video and add wrapper div with appropriate aspect ratio if required
            $all_videos.not('object object').each(function() {
                var $video = $(this);
                if ($video.parents('object').length)
                    return;
                if (!$video.prop('id'))
                    $video.attr('id', 'rvw' + Math.floor(Math.random() * 999999));
                $video
                    .wrap('<div class="responsive-video-wrapper" style="padding-top: ' + ($video.attr('height') / $video.attr('width') * 100) + '%" />')

                    .removeAttr('height')
                    .removeAttr('width');
            });
        };
    })(jQuery);
    $( 'body' ).responsiveVideo();


})(jQuery);
// end ready function here.

//==============================================================
// scroll Particular Point
// ==============================================================
function pageScroll(scrollPoint,time){ // obj: click object, scrollPoint:Location to reach on page scroll
    var divOffset = jQuery(scrollPoint).offset().top;      
    jQuery('html,body').delay(time||0).animate({scrollTop: divOffset}, 500); 
}
//==============================================================
// jQuery isotope
// ==============================================================

  jQuery.Isotope.prototype._masonryResizeChanged = function() {
    return true;
  };

  jQuery.Isotope.prototype._masonryReset = function() {
    // layout-specific props
    this.masonry = {};
    this._getSegments();
    var i = this.masonry.cols;
    this.masonry.colYs = [];
    while (i--) {
      this.masonry.colYs.push( 0 );
    }
  
    if ( this.options.masonry.cornerStampSelector ) {
      var $cornerStamp = this.element.find( this.options.masonry.cornerStampSelector ),
          stampWidth = $cornerStamp.outerWidth(true) - ( this.element.width() % this.masonry.columnWidth ),
          cornerCols = Math.ceil( stampWidth / this.masonry.columnWidth ),
          cornerStampHeight = $cornerStamp.outerHeight(true);
		for ( i = ( this.masonry.cols - cornerCols ); i < this.masonry.cols; i++ ) {
        this.masonry.colYs[i] = cornerStampHeight;
      }
    }
  };

jQuery(function(){
var $container = jQuery('#post-listing');
$container.isotope({
	 itemSelector: '.item',
	 masonry : {
        cornerStampSelector: '.corner-stamp',
		columnWidth: $container.width() / SampressionJsVar.columncount
		
      }
});

var selector = '';
jQuery('.nav-listing li a').click(function(){

  selector = jQuery(this).attr('data-filter');  
	$all = jQuery('.nav-listing li a[data-filter="*"]');
	
	var num_selected = jQuery('.nav-listing li a.selected').length;  //get total count of selected options before clicking
	
	/* if show all option clicked */
  if( selector == "*" ){
		jQuery('.nav-listing li a').removeClass('selected');		
		jQuery(this).addClass('selected');						
	/* - if any category option clicked and its already selected, it should unfiltered 
		- show all option is not selected
		- num of other options selected is more than 1 */	
	}else if( jQuery(this).hasClass('selected') && !$all.hasClass('selected')){
		jQuery(this).removeClass('selected');				
	/* - if any category option clicked, it should added
		 - show all option is not selected
		 - num of other options selected is more than 1 */	
	}else if( !jQuery(this).hasClass('selected') && !$all.hasClass('selected') ){		
		jQuery(this).addClass('selected');
	}else{
		jQuery('.nav-listing li a').removeClass('selected');
		jQuery(this).addClass('selected');	
	}
	
	
  num_selected = jQuery('.nav-listing li a.selected').length;  //get total count of selected options after clicking
	
	/*If non of the option selected then show all*/
	if( num_selected == 0 ){		
		$all.addClass('selected');
		selector = $all.attr('data-filter');  
	}
	
	var isoFilters = [];
	if( num_selected>0 && !$all.hasClass('selected') ){
		optionsList = jQuery('.nav-listing li a.selected');		
		
		for( i=0; i<num_selected; i++){			
			isoFilters.push( optionsList.eq(i).attr('data-filter') );
		}		
		selector = isoFilters.join();
	}
	//alert(selector);
	
	$container.isotope({ filter: selector });
	
	//calling append function
    var data_col = jQuery('.nav-listing').attr('data-color');
    var col = shadeColor(data_col, 0.5);
    jQuery('.nav-listing li a').each(function() {
        if(!jQuery(this).hasClass('selected')) {
            jQuery(this).children('span').css('background-color', col);
            jQuery(this).css('color', col);
        } else {
            jQuery(this).children('span').css('background-color', data_col);
            jQuery(this).css('color', data_col);
        }
    });
	
  return false;
});


jQuery('#get-cats').change(function(){

  var selector = jQuery(this).val();
  $container.isotope({ filter: selector });
  selector = selector.replace(".","");
	pageScroll('#primary-nav-scroll',700); //scrolling page to the top when user changes categories
  return false;
}); 
 
});

// update columnWidth on window resize
    jQuery(window).smartresize(function(){
		var $container = jQuery('#post-listing');
      $container.isotope({
        // set columnWidth to a percentage of container width
        masonry: {
          columnWidth: $container.width() / SampressionJsVar.columncount
        }
      });
	  
    });


//==============================================================
// Get Total Height
// ==============================================================

function getTotalHt(obj, addPadding, addMargin, addBorder){
	if(jQuery(obj).is(':hidden')) return false;
	
    addPadding = typeof addPadding == 'undefined' ? 1 : addPadding;
    addMargin = typeof addMargin == 'undefined' ? 1 : addMargin;
    addBorder = typeof addBorder == 'undefined' ? 1 : addBorder;
    
    var totalHt = jQuery(obj).height();
    if( addPadding == 1){
    totalHt += parseInt(jQuery(obj).css('padding-top'));
    totalHt += parseInt(jQuery(obj).css('padding-bottom'));
    }
    if( addMargin == 1){
    totalHt += parseInt(jQuery(obj).css('margin-top'));
    totalHt += parseInt(jQuery(obj).css('margin-bottom'));
    }
    if( addBorder == 1){
    totalHt += parseInt(jQuery(obj).css('borderTopWidth'));
    totalHt += parseInt(jQuery(obj).css('borderBottomWidth'));
    }
    
    return totalHt;
}
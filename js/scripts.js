/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work? 
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function($) {

var $event = $.event,
    $special,
    resizeTimeout;

$special = $event.special.debouncedresize = {
    setup: function() {
        $( this ).on( "resize", $special.handler );
    },
    teardown: function() {
        $( this ).off( "resize", $special.handler );
    },
    handler: function( event, execAsap ) {
        // Save the context
        var context = this,
            args = arguments,
            dispatch = function() {
                // set correct event type
                event.type = "debouncedresize";
                $event.dispatch.apply( context, args );
            };

        if ( resizeTimeout ) {
            clearTimeout( resizeTimeout );
        }

        execAsap ?
            dispatch() :
            resizeTimeout = setTimeout( dispatch, $special.threshold );
    },
    threshold: 150
};

})(jQuery);

/**
 * Reponsive Video
 */
(function($) {

    soundcloud.addEventListener('onPlayerReady', function(player, data) {
        // please refer to the documentation for the full list of available methods
        // btw, here the flash can be accessed too as 'this' like in 'this.api_play()'
        player.api_play();
    });
    
    $.fn.responsiveVideo = function() {
        // Add CSS to head
        $('head').append('<style type="text/css">.responsive-video-wrapper{width:100%;position:relative;padding:0 ;margin-bottom:25px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}.responsive-video-wrapper iframe,.responsive-video-wrapper object,.responsive-video-wrapper embed{position:absolute;top:0;left:0;width:100%;height:100%;}</style>');
        // Gather all videos
        var $all_videos = $(this).find('iframe[src*="player.vimeo.com"], iframe[src*="youtube.com"], iframe[src*="embed-ssl.ted.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="dailymotion.com"], iframe[src*="vine.co"], iframe[src*="kickstarter.com"][src*="video.html"], object, embed');
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

/**
 * jQuery ready function
 */
jQuery( document ).ready(function($) {

    /**
     * Removing padding of Video Post's P TAG   archive
     */
    $('.entry p span.embed-youtube, .entry p div.responsive-video-wrapper, .entry span.embed-vine').each(function() {
        $(this).parent('p').css('padding', '0');
        //console.log($(this).parent('p'));
    });

    $( 'body' ).responsiveVideo();

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
    // For Primary Navigation
    var minHt = 32; // Minimum height for Navigation
    var ulHt = getTotalHt($('#primary-nav').find('ul')) || 32; // Getting the height of Navigation

    //show the sneak peek of all categories
    if( minHt < ulHt ) {
        $('#btn-nav-opt').show();
        $('#primary-nav .twelve')
            .animate({ 'height' : ulHt },300,function(){
                $('#btn-nav-opt').addClass('up');
            })
            .delay( 300)
            .animate({ 'height' : minHt },1000,function(){
                $('#btn-nav-opt').removeClass('up');
            });
    }

    /**
    * Toggle Height of the Primary Navigation
    */
    $('#btn-nav-opt').click(function(){
        if($(this).hasClass('up')){
            $('#primary-nav .twelve').animate({ 'height' : minHt } );
            pageScroll('#primary-nav-scroll',700); //scrolling page to the top when user clicks  on categories

            $(this).removeClass('up');
        }else{
            $('#primary-nav .twelve').animate({ 'height' : ulHt });
            $(this).addClass('up');
        }
        return false;
    });

    /**
     * get Sticky menu
     */

    $(window).scroll( function() {
        if ($(window).scrollTop() > getTotalHt('#header')) {
            $('.btn-top').addClass('fixed');
        }
        else{
            $('.btn-top').removeClass('fixed');
        }
    });

    if($('body').hasClass('home')){     // enable sticky menu only on homepage
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
    /***************************************************************************************
     * jQuery isotope
     *
    if ($('#post-listing').length > 0) {
            if($('body').hasClass('full-width-layout')){
                jQuery.Isotope.prototype._getCenteredMasonryColumns = function() {
                    this.width = this.element.width();
                    
                    var parentWidth = this.element.parent().width();
                    
                    // i.e. options.masonry && options.masonry.columnWidth
                    var colW = this.options.masonry && this.options.masonry.columnWidth ||
                        // or use the size of the first item
                        this.$filteredAtoms.outerWidth(true) ||
                        // if there's no items, use size of container
                        parentWidth;
                    
                    var cols = Math.floor( parentWidth / colW );
                    cols = Math.max( cols, 1 );
                    
                    // i.e. this.masonry.cols = ....
                    this.masonry.cols = cols;
                    // i.e. this.masonry.columnWidth = ...
                    this.masonry.columnWidth = colW;
                };
            }

            jQuery.Isotope.prototype._masonryReset = function() {
                if($('body').hasClass('full-width-layout')){
                    // layout-specific props
                    this.masonry = {};
                    // FIXME shouldn't have to call this again
                    this._getCenteredMasonryColumns();
                    var i = this.masonry.cols;
                    this.masonry.colYs = [];
                    while (i--) {
                        this.masonry.colYs.push( 0 );
                    }
                }else{
                    // layout-specific props
                    this.masonry = {};
                    this._getSegments();
                    var i = this.masonry.cols;
                    //console.log(i);
                    this.masonry.colYs = [];
                    while (i--) {
                      this.masonry.colYs.push( 0 );
                    }
                }
            };

            jQuery.Isotope.prototype._masonryResizeChanged = function() {
                 if($('body').hasClass('full-width-layout')){
                        var prevColCount = this.masonry.cols;
                        // get updated colCount
                        this._getCenteredMasonryColumns();
                        return ( this.masonry.cols !== prevColCount );
                    }else{
                        return true;
                    }
              };
       if($('body').hasClass('full-width-layout')){
            jQuery.Isotope.prototype._masonryGetContainerSize = function() {
                var unusedCols = 0,
                    i = this.masonry.cols;
                // count unused columns
                while ( --i ) {
                    if ( this.masonry.colYs[i] !== 0 ) {
                        break;
                    }
                    unusedCols++;
                }
                
                return {
                    height : Math.max.apply( Math, this.masonry.colYs ),
                    // fit container to columns that have been used;
                    width : (this.masonry.cols - unusedCols) * this.masonry.columnWidth
                };
            };
        }
        var $container = $('#post-listing');
        var $window = $(window);
            $container.imagesLoaded( function(){
                    if($('body').hasClass('full-width-layout')){
                        $container.isotope({
                            itemSelector: '.item',
                            masonry: {
                                columnWidth: 100,
                                gutterWidth: 30
                            }
                        });
                    } else {
                        $container.isotope({
                            itemSelector: '.item',
                            resizable: false,
                            isFitWidth: true,
                            masonry : {
                                columnWidth: $container.width() / SampressionVar.SampressionColumnsVar,
                            }
                      
                        });
                        console.log($container.width());
                    }

        });//imagesLoaded
            

                    var selector = '';
        jQuery('.nav-listing li a').click(function(){

          selector = jQuery(this).attr('data-filter');
            $all = jQuery('.nav-listing li a[data-filter="*"]');

            var num_selected = jQuery('.nav-listing li a.selected').length;  //get total count of selected options before clicking

            // if show all option clicked
          if( selector == "*" ){
                jQuery('.nav-listing li a').removeClass('selected');
                jQuery(this).addClass('selected');
            // - if any category option clicked and its already selected, it should unfiltered
            //    - show all option is not selected
             //   - num of other options selected is more than 1 
            }else if( jQuery(this).hasClass('selected') && !$all.hasClass('selected')){
                jQuery(this).removeClass('selected');
            // - if any category option clicked, it should added
            //     - show all option is not selected
            //     - num of other options selected is more than 1 
            }else if( !jQuery(this).hasClass('selected') && !$all.hasClass('selected') ){
                jQuery(this).addClass('selected');
            }else{
                jQuery('.nav-listing li a').removeClass('selected');
                jQuery(this).addClass('selected');
            }


          num_selected = jQuery('.nav-listing li a.selected').length;  //get total count of selected options after clicking

            //If non of the option selected then show all
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

            $('#post-listing').isotope({ filter: selector });


          return false;
        });


    // update columnWidth on window resize
        jQuery(window).smartresize(function(){
            
            if(!$('body').hasClass('full-width-layout')){
                $container.isotope({
                    // set columnWidth to a percentage of container width
                    masonry: {
                      columnWidth: $container.width() / SampressionVar.SampressionColumnsVar
                    }
                });
              }
            });

        jQuery('#get-cats').change(function(){

          var selector = jQuery(this).val();
          $('#post-listing').isotope({ filter: selector });
          selector = selector.replace(".","");
            //appenditem(selector);
            pageScroll('#primary-nav-scroll',700); //scrolling page to the top when user changes categories
          return false;
        });
    }*/// it exists

    /******
     ** ISOTOPE
     ******/

    var $container = $('#post-listing'),
    colWidth = function () {
        var w = $container.width(), 
            columnNum = SampressionVar.SampressionColumnsVar,
            columnWidth = 0;
            if (w <= 375) {
                columnNum  = 1;
            }
            // if (w > 1200) {
            //     columnNum  = 5;
            // } else if (w > 900) {
            //     columnNum  = 4;
            // } else if (w > 600) {
            //     columnNum  = 3;
            // } else if (w > 300) {
            //     columnNum  = 2;
            // }
        columnWidth = Math.floor(w/columnNum) - 15;
        $container.find('.item').each(function() {
            var $item = $(this),
                multiplier_w = $item.attr('class').match(/item-w(\d)/),
                multiplier_h = $item.attr('class').match(/item-h(\d)/),
                width = multiplier_w ? columnWidth*multiplier_w[1]-4 : columnWidth-4,
                height = multiplier_h ? columnWidth*multiplier_h[1]*0.5-4 : columnWidth*0.5-4;
            $item.css({
                width: width
                //height: height
            });
        });

        return columnWidth;
    },
    isotope = function () {
            $container.isotope({
                itemSelector: '.item',
                masonry: {
                    columnWidth: colWidth(),
                    gutter: 20
                }
            });
        };
    isotope();
    $(window).on('debouncedresize', isotope);

    $('#filter a').on( 'click', function() {
        var select = $(this).data('filter');
        if( select === '*' ) {
            $('#filter a').removeClass('selected');
            if( ! $(this).hasClass('selected') ) {
                $(this).addClass('selected');
            }
        } else {
            $('#filter').find("[data-filter='*']").removeClass('selected');
            $(this).toggleClass( 'selected', '' );
        }
        var selector = Array();
        $('#filter a').each(function() {
            if( $(this).hasClass('selected') ) {
                selector.push($(this).data('filter'));
            }
        });
        selector = selector.join(', ');
        if( selector == '') {
            $('#filter').find("[data-filter='*']").addClass('selected');
            selector = '*';
        }
        $container.isotope({
            filter: selector
        });
    });

    /*var $grid = $('#post-listing').isotope({
        itemSelector: '.item',
        percentPosition: true,
        masonry: {
            columnWidth: '.item',
            gutter: 20
        }
    });

    // bind filter button click
    $('#filter a').on( 'click', function() {
        var select = $(this).data('filter');
        if( select === '*' ) {
            $('#filter a').removeClass('selected');
            if( ! $(this).hasClass('selected') ) {
                $(this).addClass('selected');
            }
        } else {
            $('#filter').find("[data-filter='*']").removeClass('selected');
            $(this).addClass('selected');
        }
        var selector = Array();
        $('#filter a').each(function() {
            if( $(this).hasClass('selected') ) {
                selector.push($(this).data('filter'));
            }
        });
        selector = selector.join(', ');
        console.log(selector);
        $grid.isotope({ filter: selector });
    });*/

   /**
    *  Detect if dropdown navigation would go off screen and reposition it
    */
   
    $(".top-menu li").on('mouseenter mouseleave', function (e) {
        if ($('ul', this).length) {
            var elm = $('ul:first', this);
            var off = elm.offset();
            var l = off.left;
            var w = elm.width();
            var docH = $(".container").height();
            var docW = $(".container").width();

            var isEntirelyVisible = (l + w <= docW);

            if (!isEntirelyVisible) {
                $(this).addClass('edge');
            } else {
                $(this).removeClass('edge');
            }
        }
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
        $(this).toggleClass('open');

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
        $('li.page_item_has_children').prepend('<i class="sub-menu-toggle"></i>');
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
                //$(this).removeClass('menu-open');
                //$(this).parent('li.page_item_has_children').children('ul').slideUp('fast');
                $(this).parent('li.page_item_has_children').children('ul').slideToggle('fast');
                $(this).parent('li.page_item_has_children').removeClass('inactive');
                $(this).parent('li.page_item_has_children').addClass('active');
                $(this).addClass('menu-open');
            }
        });
    }

    /**
     * Fallback for menu
     */
    if($('.menu-item-has-children').length > 0){
        $('li.menu-item-has-children').prepend('<i class="sub-menu-toggle"></i>');
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
               // $(this).parent('li.menu-item-has-children').children('ul').slideUp('fast');
                $(this).parent('li.menu-item-has-children').children('ul').slideToggle('fast');
                $(this).parent('li.menu-item-has-children').removeClass('inactive');
                $(this).parent('li.menu-item-has-children').addClass('active');
                $(this).toggleClass('menu-open');

            }
        });
    }

     /* Mobile Menu (Full Width Navigation)
     * =============================*/
   jQuery('.trigger-nav').click(function(){
      jQuery('#full-width-nav').stop(true, true).slideToggle(600);
      $(this).toggleClass('open');
   });


});

// end ready function




/**
 * scroll Particular Point
 */

function pageScroll(scrollPoint,time){ // obj: click object, scrollPoint:Location to reach on page scroll
    var divOffset = jQuery(scrollPoint).offset().top;
    jQuery('html,body').delay(time||0).animate({scrollTop: divOffset}, 500);
}

/**
 * Get Total Height
 */

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

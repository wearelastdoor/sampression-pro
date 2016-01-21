/**
 * Javascripts file for Theme Options pages.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

jQuery.fn.selectText = function(){
   var doc = document;
   var element = this[0];
   //console.log(this, element);
   if (doc.body.createTextRange) {
       var range = document.body.createTextRange();
       range.moveToElementText(element);
       range.select();change-site-fontface
   } else if (window.getSelection) {
       var selection = window.getSelection();        
       var range = document.createRange();
       range.selectNodeContents(element);
       selection.removeAllRanges();
       selection.addRange(range);
   }
};

(function ($) {
    $.fn.restrict = function () {
        return this.each(function(){
            if (this.type && 'number' === this.type.toLowerCase()) {
                $(this).on('change', function(){
                    var _self = this,
                        v = parseFloat(_self.value),
                        min = parseFloat(_self.min),
                        max = parseFloat(_self.max);
                    if (v >= min && v <= max) {
                        _self.value = v;
                    } else {
                        _self.value = v < min ? min : max;
                    }

                    if(v == 0) {
                        $(this).siblings('label').children('input').prop('checked', true);
                    } else {
                        $(this).siblings('label').children('input').prop('checked', false);
                    }
                    var str = $( ".sam-number-input" ).serialize();
                    $('#category-posts-display').val(str);
                });
            }
        });
    };
})(jQuery);



jQuery(document).ready(function($) {
    
    if($('.sam-number-input').length > 0) {
        $('.sam-number-input').restrict();
    }

    $('.sam-cat-check').on('click', function() {
        if ($(this).is(':checked')) {
            $(this).parent('label').siblings('input.sam-number-input').val('0');
        } else {
            var max = $(this).parent('label').siblings('input.sam-number-input').attr('max');
            $(this).parent('label').siblings('input.sam-number-input').val(max);
        }
        var str = $( ".sam-number-input" ).serialize();
        $('#category-posts-display').val(str);
    });

    if($('.hide-setup-notice').length > 0) {
        $('.hide-setup-notice').on('click', function() {
            var answer = confirm('You are about to hide this notice.\n\nIf you hide this notice you will not be able to import the data from Sampression Lite to Sampression Pro.\n\nClick Cancel and import your data or you can click OK to dismiss this message.');
            if (answer) {
                return true;
            }
            return false;
        });
    }
    
/* Simple Tabination */	
//Default Action
	jQuery(".tab_content").hide(); //Hide all content
	if( jQuery.cookie("sam-active-tab") != null ) {		
		var lastActiveTab = jQuery.cookie("sam-active-tab"); //retriving cookie value
		jQuery("ul.tabs li a[href="+lastActiveTab+"]").parent().addClass("current"); //Activate tab from cookie value
		jQuery(lastActiveTab).show();
	} else {		
		jQuery("ul.tabs li:first").addClass("current").show(); //Activate first tab
		jQuery(".tab_content:first").show(); //Show first tab content
	} 
	//On Click Event
	jQuery("ul.tabs li").click(function() {
		jQuery("ul.tabs li").removeClass("current"); //Remove any "active" class
		jQuery(".tab_content").hide(); //Hide all tab content                
		jQuery(this).addClass("current"); //Add "active" class to selected tab
		var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).slideDown(600); //Fade in the active content
		jQuery.cookie("sam-active-tab", activeTab, { expires: 1 });
        scrolltotop();
		return false;
	});

    function scrolltotop() {
        $('html, body').animate({
            scrollTop: $("#sam-wrapper").offset().top
        }, 500);
    }

    $('body').addClass('noJS');
    var bodyTag = document.getElementsByTagName("body")[0];
    bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
    
    $('pre.select-me').on('click', function() {
        $(this).selectText();
    });

    // check confirmation for restoring theme to default.
    $('.sampression-restore').on('click', function() {
        var answer = confirm('Do you want to restore theme to default?');
        if (answer) {
            return true;
        }
        return false;
    });
    
    $('#import_button').on('click', function(){
          var imgVal =  $('#import_json').val();
          if( imgVal == '') {
            alert ("Please upload a file to import theme option");
            return false; 
            e.preventDefault(); 
        
    }
});
    // check if file is json
    $('#import_theme_settings').on('click', function() {
        if ($('.message').length > 0) {
            return false;
        }

        var mime_type = $('#mime_type').val();
        if (mime_type !== 'json') {
            var box = '<div class="message error">Import file must be json.</div>';
            var i = $(this).parent('li');
            i.append(box);
            setTimeout(function() {
                i.children('div.message').remove();
            }, 5000);
            return false;
        }
    });

    // get filename. works on IE as well now.
    $('#import_json').on('change', function() {
        var i = $(this);
        var filename = i.val();
        filename = filename.replace(/.*(\/|\\)/, '');
        i.closest('li').find('span.json-filename').html('<span id="json-file-name-display" style="display:none;">&nbsp;&nbsp;('+truncate_filename(filename)+')</span>');
        $(".sam-importexport-option div.fileUpload").animate({"width": "250px"}, "slow", function(){
            $('#json-file-name-display').show('fast');
        });
        $('#mime_type').val(filename.split('.').pop());
    });

    // close div after 2 seconds.
    $('div.auto-close').each(function() {
        var i = $(this);
        setTimeout(function() {
            i.remove();
        }, 20000);
    });
    
    // close div after 5 seconds.
    $('div#self-destroy').each(function() {
        var i = $(this);
        setTimeout(function() {
            i.slideUp(1000);
        }, 5000);
    });

    //Show Meta - Blog Page Setting - check/uncheck checkbox
    $('.show-meta').on('click', function() {
        var id = $(this).attr('for');
        if ($('#' + id).is(':checked')) {
            $('#show-' + id).val('no');
        } else {
            $('#show-' + id).val('yes');
        }
    });

    //Check/Uncheck checkbox - Apple Touch Icons - Logos & Icons
    $('.samp-style').on('click', function() {
        if ($(this).hasClass('appleicons') && !$(this).is(':checked')) {
            $('#no-touchicon').prop('checked', false);
            $('.sam-no-touchicon').val('no');
        }
        if ($(this).is(':checked')) {
            $('.sam-' + $(this).attr('id')).val('yes');
        } else {
            $('.sam-' + $(this).attr('id')).val('no');
        }
    });

    //Check/Uncheck checkbox - Disable All - Apple Touch Icons - Logos & Icons
    $('#no-touchicon').click(function() {
        $('.appleicons').prop('checked', $(this).prop('checked'));
        $('.appleicons').each(function() {
            if ($(this).is(':checked')) {
                $('.sam-' + $(this).attr('id')).val('yes');
            } else {
                $('.sam-' + $(this).attr('id')).val('no');
            }
        });
    });
    
    //Check/Uncheck - Website Description - Logos & Icons
    $('#no-webdesc').on('click', function() {
        check_checkbox_with_value($(this), '#sam-use-webdesc', 'yes', 'no');
    });
    
    /*
     * Check for checkbox is checked or not and put value in destination_id
     * 
     * @param {type} i Clicked Element
     * @param {type} destination Destination Element class or id. Example: '#my_id' or '.my_class'
     * @param {type} true_val
     * @param {type} false_val
     * @returns {undefined}
     */
    function check_checkbox_with_value(i, destination, true_val, false_val) {
        if (i.is(':checked')) {
            $(destination).val(true_val);
        } else {
            $(destination).val(false_val);
        }
    }

    //Get WP Default Image Uploader
    $('.upload_image_button').on('click', function(e) {
        e.preventDefault();
        var iii = '';
        var iii = $(this);
        get_custom_uploader(iii);
    });

    //Popup Uploader Function
    function get_custom_uploader(elem) {
        var figure = elem.parent('div.fileUpload').parent('div.backgroundimage-option').siblings('figure.image-preview').children('img');
        var loader = '../wp-content/themes/sampression/inc/admin/images/ajax-loader.gif';
        var prev_img = figure.attr('src');
        figure.attr('src', loader);
        
        var custom_uploader;
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            library: {
                type: 'image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            //Object:
            //attachment.alt - image alt
            //attachment.author - author id
            //attachment.caption
            //attachment.dateFormatted - date of image uploaded
            //attachment.description
            //attachment.editLink - edit link of media
            //attachment.filename
            //attachment.height
            //attachment.icon - don't know WTF?))
            //attachment.id - id of attachment
            //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
            //attachment.menuOrder
            //attachment.mime - mime type, for example image/jpeg"
            //attachment.name - name of attachment file, for example "my-image"
            //attachment.status - usual is "inherit"
            //attachment.subtype - "jpeg" if is "jpg"
            //attachment.title
            //attachment.type - "image"
            //attachment.uploadedTo
            //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
            //attachment.width
            //$('#upload_image').val(attachment.url);
            //console.log(attachment.url);
            if (attachment.type != 'image') {
                alert('Only Image Type are allowed!!');
                return false;
            } else {
                
                elem.prev('.upload_image').val(attachment.url);
                elem.parent('div').parent('div').siblings('.image-preview').children('img').attr('src', attachment.url);
                var file_name = truncate_filename(attachment.filename);
                elem.parent('div').siblings('div.image-title').html(file_name);
            }
            return false;
        });
        custom_uploader.on('close', function() {
            if(figure.attr('src') == loader) {
                figure.attr('src', prev_img);
            }
        });
        //Open the uploader dialog
        custom_uploader.open();
    }
    
    /*
     * Truncate the file name
     * @param {type} str = File Name
     * @returns {String} = Truncate File Name
     */
    function truncate_filename(str) {
        var strLen = 20;
        if (str.length <= strLen) return str;

        var separator = '...';

        var sepLen = separator.length,
            charsToShow = strLen - sepLen,
            frontChars = Math.ceil((charsToShow/2)-1),
            backChars = Math.floor((charsToShow/2)+1);

        return str.substr(0, frontChars) + separator + str.substr(str.length - backChars);
    }

    //Select sidebar layout - Sidebar - Customze - Styling
    $('#sidebar-selector li a').click(function() {
        var name = $(this).attr('data-sidebar');
        $('#sidebar').val(name);
        $('#sidebar-selector li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
    
    //Select column layout - Column - Customize - Column
    $('#column-selector li a').click(function() {
        var name = $(this).attr('data-column');
        $('#column').val(name);
        $('#column-selector li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
       

     
    //Fancyselect for styling selectbox.
    $('.sam-select').each(function() {
        var sb = new SelectBox({
            selectbox: $(this),
            height: 250,
            changeCallback: function(val) {
                if (val === 'general' || val === 'primary-nav' || val === 'post-pages' || val === 'widget' || val === 'footer' || val === 'index-blog') {
                    var menu = [ 'general', 'primary-nav', 'post-pages', 'widget', 'footer', 'index-blog' ];
                    for(var i = 0; i < menu.length; i++) {
                        $('.typo-'+menu[i]).slideUp(500);
                    }
                    $('.typo-'+val).slideDown(750);
                }
            }
        });
    });
    
    /*
     * Function for change typography preview for font face, size and style
     * 
     */
    function typography_fontface_preview(i, select_font_face, select_font_size, select_font_style, where_to_change) {
        if(typeof select_font_style === 'undefined') {
            select_font_style = '';
        }
        var font_face = '', font_size = '', font_style = '', font_color = '';
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            font_face = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_face).val();
            font_size = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-face').siblings('div.font-size').children('div.customSelect').children('select.'+select_font_size).val();
            if(select_font_style != '') {
                font_style = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-face').siblings('div.font-style').children('div.customSelect').children('select.'+select_font_style).val();
                font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-face').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            }
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            if(select_font_style != '') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
                if(font_color == '#ffffff') {
                    $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
                }
            }
        });
    }
    
    function typography_fontsize_preview(i, select_font_face, select_font_size, select_font_style, where_to_change) {
        if(typeof select_font_style === 'undefined') {
            select_font_style = '';
        }
        var font_face = '', font_size = '', font_style = '', font_color = '';
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            font_face = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-size').siblings('div.font-face').children('div.customSelect').children('select.'+select_font_face).val();
            font_size = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_size).val();
            if(select_font_style != '') {
                font_style = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-size').siblings('div.font-style').children('div.customSelect').children('select.'+select_font_style).val();
                font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-size').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            }
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            if(select_font_style != '') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
                if(font_color == '#ffffff') {
                    $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
                }
            }
        });
    }
    
    function typography_fontstyle_preview(i, select_font_face, select_font_size, select_font_style, where_to_change) {
        if(typeof select_font_style === 'undefined') {
            select_font_style = '';
        }
        var font_face = '', font_size = '', font_style = '', font_color = '';
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            font_face = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-style').siblings('div.font-face').children('div.customSelect').children('select.'+select_font_face).val();
            font_size = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-style').siblings('div.font-size').children('div.customSelect').children('select.'+select_font_size).val();
            if(select_font_style != '') {
                font_style = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_style).val();
                font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-style').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            }
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            if(select_font_style != '') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
                if(font_color == '#ffffff') {
                    $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
                }
            }
        });
    }

    /*
     * Website Title Styling - Start
     */
    //change Website Title font face
    $('.change-site-fontface').each(function() {
        //console.log($(this));
        typography_fontface_preview($(this), 'change-site-fontface', 'change-site-fontsize', 'change-site-fontstyle', 'div.sam-site-title');
    });
    //change Website Title font size
    $('.change-site-fontsize').each(function() {
        typography_fontsize_preview($(this), 'change-site-fontface', 'change-site-fontsize', 'change-site-fontstyle', 'div.sam-site-title');
    });    
    //change Website Title font style
    $('.change-site-fontstyle').each(function() {
        typography_fontstyle_preview($(this), 'change-site-fontface', 'change-site-fontsize', 'change-site-fontstyle', 'div.sam-site-title');
    });
    /*
     * Website Title Styling - End
     */
    
    
    /*
     * Website Description Styling - Start
     */
    //change Website Description fontface
    $('.change-sitedesc-fontface').each(function() {
        typography_fontface_preview($(this), 'change-sitedesc-fontface', 'change-sitedesc-fontsize', 'change-sitedesc-fontstyle', 'div.sam-site-desc');
    });    
    //change Website Description font size
    $('.change-sitedesc-fontsize').each(function() {
        typography_fontsize_preview($(this), 'change-sitedesc-fontface', 'change-sitedesc-fontsize', 'change-sitedesc-fontstyle', 'div.sam-site-desc');
    });    
    //change Website Description font style
    $('.change-sitedesc-fontstyle').each(function() {
        typography_fontstyle_preview($(this), 'change-sitedesc-fontface', 'change-sitedesc-fontsize', 'change-sitedesc-fontstyle', 'div.sam-site-desc');
    });
    /*
     * Website Description Styling - End
     */
    
    /*
     * Typography H/body Tag Styling - Start
     */
    //change H/body Tag fontface
    $('.change-fontface').each(function() {
        typography_fontface_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', '.font-demo');//change-fontstyle
    });
    //change H/body Tag font size
    $('.change-fontsize').each(function() {
        typography_fontsize_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', '.font-demo');//change-fontstyle
    });    
    //change H/body Tag font style
    $('.change-fontstyle').each(function() {
        typography_fontstyle_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', '.font-demo');//change-fontstyle
    });
    /*
     * Typography H/body Tag Styling - End
     */
    
    /*
     * Typography Navigation - Transfermation
     * 
     */
    $('.change-transformation').each(function() {
        typography_fonttransformation_preview($(this), 'change-fontface', 'change-fontsize', 'change-fontstyle', 'change-transformation', '.font-demo');
    });
    function typography_fonttransformation_preview(i, select_font_face, select_font_size, select_font_style, select_font_transformation, where_to_change) {
        i.siblings('div.selectValueWrap').children('div.selectedValue').bind("DOMSubtreeModified", function() {
            var font_face = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.font-face').children('div.customSelect').children('select.'+select_font_face).val();
            var font_size = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.font-size').children('div.customSelect').children('select.'+select_font_size).val();
            var font_style = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.font-style').children('div.customSelect').children('select.'+select_font_style).val();
            var font_color = $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.font-transformation').siblings('div.wp-picker-container').children('span.wp-picker-input-wrap').children('input.wp-color-picker').val();
            var font_trans = $(this).parent('div.selectValueWrap').siblings('select.'+select_font_transformation).val();
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).attr('style', 'font: ' + font_style + ' ' + font_size + 'px ' + font_face + ';');
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('color', font_color);
            $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('text-transform', font_trans);
            if(font_color == '#ffffff') {
                $(this).parent('div.selectValueWrap').parent('div.customSelect').parent('div.select-wrapper').siblings(where_to_change).css('background-color', '#57B94A');
            }
        });
    }
    //changing the color of site title with color picker
    var sam_site_title = get_color_option_head($head_div = '.sam-site-title');
    // caling color box
    $('.sam-site-title-color').wpColorPicker(sam_site_title);
    
    //changing the color of site description with color picker
    var sam_site_desc = get_color_option_head($head_div = '.sam-site-desc');
    // caling color box
    $('.sam-site-desc-color').wpColorPicker(sam_site_desc);
    
    //changing the color of body title with color picker
    var sam_body_font_color = get_color_option_head($head_div = '.sam-body-text');
    // caling color box
    $('.sam-body-text-color').wpColorPicker(sam_body_font_color);

    //changing the color of Navigation with color picker
    var sam_nav_font_color = get_color_option_head($head_div = '.sam-navigation-text');
    // caling color box
    $('.sam-nav-text-color').wpColorPicker(sam_nav_font_color);

    //changing the color of Link with color picker
    var sam_link_text_color = get_color_option_head($head_div = '.sam-link-text');
    // caling color box
    $('.sam-link-text-color').wpColorPicker(sam_link_text_color);

    //changing the color of Widget with color picker
    var sam_widget_header_text_color = get_color_option_head($head_div = '.sam-widget-header-text');
    // caling color box
    $('.sam-widget-header-text-color').wpColorPicker(sam_widget_header_text_color);
    
    //changing the color of single post/page title with color picker
    var sam_post_title_font_color = get_color_option_head($head_div = '.sam-post-title-text');
    // caling color box
    $('.sam-post-title-text-color').wpColorPicker(sam_post_title_font_color);
    
    //changing the color of single post/page meta with color picker
    var sam_meta_font_color = get_color_option_head($head_div = '.sam-meta-font-text');
    // caling color box
    $('.sam-meta-font-text-color').wpColorPicker(sam_meta_font_color);
    
    //changing the color of index/blog title with color picker
    var sam_post_title_font_color = get_color_option_head($head_div = '.sam-blog-post-title');
    // caling color box
    $('.sam-blog-post-title-color').wpColorPicker(sam_post_title_font_color);
    
       //changing the color of index/blog meta with color picker
    var sam_post_meta_font_color = get_color_option_head($head_div = '.sam-blog-meta-font');
    // caling color box
    $('.sam-blog-meta-font-color').wpColorPicker(sam_post_meta_font_color);
    
    //DEFAULT COLOR PICKER ONLY
    $('.wp_color_picker').wpColorPicker();

    // generate color option
    function get_color_option_head($head_div) {
        var colorOptions = {
            // a callback to fire whenever the color changes to a valid color
            change: function(event, ui) {
                //changing background of heading if white color is selected
                if (ui.color.toString() == '#ffffff') {
                    $($head_div).css({
                        "background-color": "rgb(87,185,74)",
                        "box-shadow": "0 0 0 3px rgb(87,185,74)"
                    });
                } else {
                    $($head_div).css({
                        'background-color': 'rgb(255, 255, 255)',
                        'box-shadow': 'none'
                    });
                }
                ;
                $($head_div).css('color', ui.color.toString());
            }
        };
        return colorOptions;
    }

    //maintaining the equal height
    function equalHeight(parentobj, obj) {
        $(parentobj).each(function() {
            var highestBox = 0;
            $(obj, this).each(function() {
                if ($(this).height() > highestBox)
                    highestBox = $(this).height();
            });
            $(obj, this).css({
                'min-height': highestBox
            });
        });
    }
    //calling equal height function on .box.col
    equalHeight('.sam-logooption', '.col');

    // generate tooltip
    $('.sam-tooltip').tooltip({
        position: {
            my: "left+20 center-5"
        }
    });
    
    /*
    * Get selected categories id from 'hide blog from' section on blog menu
    */
    $('.show-categories').on('click', function(){
        var chkId = '';
        $('.show-categories:checked').each(function() {
          chkId += $(this).val() + ",";
        });
        chkId =  chkId.slice(0,-1);
        $("#sam-hide-category").val(chkId); // Place checked values in hidden input field to save on database
    });

    $('#logos-icons').on('click', '#sam-use-logo', function() {
        if($('.overlay-box').length > 0) {
            $('.overlay-box').remove();
        }
        var top = $(this).parent('div.sam-radio').parent('div.box-title').parent('div.titled-box').siblings('div.titled-box');
        //console.log($(this).parent('div.sam-radio').parent('div.box-title').parent('div.titled-box'));
        top.prepend('<div class="overlay-box webtitle"></div>');

    });
    
    $('#logos-icons').on('click', '#sam-use-title', function() {
        if($('.overlay-box').length > 0) {
            $('.overlay-box').remove();
        }
        var top = $(this).parent('div.sam-radio').parent('div.box-title').parent('div.titled-box').siblings('div.titled-box');
        console.log($(this).parent('div.sam-radio').parent('div.box-title').parent('div.titled-box'));
        top.prepend('<div class="overlay-box weblogo"></div>');

    });

    
});// end ready function here.
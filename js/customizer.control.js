
jQuery( document ).ready(function($) {
    
	// Show responsive preview
	$( ".responsive-view" ).on( "click", function( e ) {
		e.preventDefault();
		var width = $(this).data('width');
		$('#customize-preview').css({
			width: width
		});
	});

	$( '.customize-control-checkboxes input[type="checkbox"]' ).on( 'change', function() {
            var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return this.value;
                }
            ).get().join( ',' );
            $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        }
    );

    $( '.sampression-cat-lists .cat-checked' ).on( 'click', function() {
    	if ($(this).is(':checked')) {
            $(this).siblings('.sam-number-input').val('0');
        } else {
            var max = $(this).siblings('.sam-number-input').attr('max');
            $(this).siblings('.sam-number-input').val(max);
        }
    	var str = $( ".sam-number-input" ).serialize();
    	$('.sampression-cat-lists .sampression-control-cat').val(str).trigger( 'change' );
    });

    $( '.sam-number-input' ).on( 'change', function() {
        if( $(this).val() == 0 ) {
            $(this).siblings('.cat-checked').prop('checked', true);
        } else {
            $(this).siblings('.cat-checked').prop('checked', false);
        }
    	var str = $( ".sam-number-input" ).serialize();
    	$('.sampression-cat-lists .sampression-control-cat').val(str).trigger( 'change' );
    });

    $( 'input[type=range]' ).each(function() {
        var val = $(this).val();
        //val = (val / 10) + 'rem';
        $(this).parent('label').append('<span class="font-range-value">'+val+'px</span>');
    });

    $(document).on("mousedown","input[type=range]",function() {

		var $range = $(this),
			$range_input = $range.parent('label').children( '.font-range-value' );

		value = $( this ).attr( 'value' );
		$range_input.val( value );

		$( this ).mousemove(function() {
			value = $( this ).attr( 'value' );
            //value = (value / 10) + 'rem';
			$range_input.text( value + 'px' );
		});
	});
    /*
    var fonts_bg_pos = [];
    fonts_bg_pos['Playfair+Display:400,700,400italic,700italic=serif'] = '0';
    fonts_bg_pos['Work+Sans:400,700=sans-serif'] = '-500';
    fonts_bg_pos['Alegreya:400,400italic,700,700italic=serif'] = '-100';
    fonts_bg_pos['Sacramento=cursive'] = '-150';

    $('#customize-control-webtitle_font_family select').each(function() {
        console.log($(this).val());
        console.log(fonts_bg_pos[$(this).val()]);
        $(this).css({
            'background-position' : fonts_bg_pos[$(this).val()]+'px'
        })
    });

    $('#customize-control-webtitle_font_family select option').each(function() {
        $(this).css({
            'background-position' : fonts_bg_pos[$(this).val()]+'px'
        })
    });

    $('#customize-control-webtitle_font_family select').change(function() {
        console.log($(this).val());
        console.log(fonts_bg_pos[$(this).val()]);
        $(this).css({
            'background-position' : fonts_bg_pos[$(this).val()]+'px'
        })
    });*/

});




















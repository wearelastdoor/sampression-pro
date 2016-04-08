<?php
/**
 * Sampression functions and definitions.
 *
 * @package Sampression Pro
 * @since  Sampression Pro 2.0
 */

function sampression_exclude_categories() {
	$post_display = get_theme_mod( 'categories_post_display' );
    $categories = array();
    if( is_array($post_display) ) {
        parse_str($post_display[0], $categories);
    }
    $cats = array();
    foreach ($categories as $slug => $count) {
    	if( $count == 0 ) {
    		$category = get_term_by('slug', $slug, 'category');
    		$cats[] = $category->term_id;
    	}
    }
    return $cats;
}

function sampression_filter_for_home_blog( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
    	$query->set( 'posts_per_page', -1 );
    	if( get_theme_mod( 'categories_post_display' ) ) {
	    	$post_display = get_theme_mod( 'categories_post_display' );
	    	$categories = array();
	    	if( is_array($post_display) ) {
	    		parse_str($post_display[0], $categories);
	    	}
	    	$exclude_cat = array();
	    	$exclude_post = array();
	    	foreach ($categories as $slug => $count) {
	    		$category = get_term_by('slug', $slug, 'category');
	    		if( $count == 0 ) {
	    			$exclude_cat[] = '-'.$category->term_id;
	    		} elseif( $count > 0 ) {
	    			if( $category->count != $count ) {
	    				//echo $count;
	    				$args = array(
		    				'posts_per_page' => $category->count,
		    				'offset'=> $count,
		    				'category' => $category->term_id
	    				);
	    				//print_r($args);
	    				$ex_posts = get_posts($args);
	    				foreach ($ex_posts as $post) {
	    					$exclude_post[] = $post->ID;
	    				}
	    			}
	    			// echo $category->count;
	    			
	    		}
	    	}

	    	if( sizeof($exclude_cat) ) {
	    		$exclude_cat_string = implode(',', $exclude_cat);
	    		$query->set( 'cat', $exclude_cat_string );
	    	}
	    	if( sizeof($exclude_post) ) {
	    		$query->set( 'post__not_in', $exclude_post );
	    	}
	    	//echo '<pre>';
	    	//print_r($categories);
	    	//print_r(array_unique($exclude_post));
	    	//print_r($exclude_post);
	    	//echo '</pre>';
    	}
    	
        //$query->set( 'cat', '-1,-1347' );
    }
}
add_action( 'pre_get_posts', 'sampression_filter_for_home_blog' );

if( ! function_exists( 'sampression_home_layout_classes') ) {

	function sampression_home_layout_classes() {
		$classes = array();
		$classes[] = 'columns';
		if( get_theme_mod( 'home_sidebar' ) === 'left' ) {
			$classes[] = 'alignright';
			$classes[] = 'nine';
		} elseif( get_theme_mod( 'home_sidebar' ) === 'right' ) {
			$classes[] = 'nine';
		} else {
			$classes[] = 'twelve';
		}
		
		echo implode( ' ', $classes );
		/*
		if( get_theme_mod( 'home_columns' ) ) {
				switch ( get_theme_mod( 'home_columns' ) ) {
					case '1':
						$classes[] = 'twelve';
						break;
					case '2':
						$classes[] = 'six';
						break;
					case '3':
						$classes[] = 'four';
						break;
					default:
						$classes[] = 'three';
						break;
				}
			}
		 */
	}

}

if ( ! function_exists( 'sampression_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function sampression_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'sampression', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Sampression Uses uses wp_nav_menu() in below assigned locations
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Navigation', 'sampression' ),
			'secondary' => esc_html__( 'Secondary Navigation', 'sampression' ),
		) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Enable support for Post Formats.
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'gallery',
			'video',
			'quote',
			'link',
			'status',
			'audio',
			'chat'
		) );

		/**
		 * Set up the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => 'F3F7F6',
            'default-image' => '',
            'wp-head-callback' => 'sampression_custom_background_cb'
		) );

		add_theme_support( 'custom-header', array(
			// Text color and image (empty to use none).
			'default-text-color'     => 'FE6E41',
			'default-image'          => '',

			// Set height and width, with a maximum value for the width.
			'height'                 => 152,
			'width'                  => 1200,
			'max-width'              => 2000,

			// Support flexible height and width.
			'flex-height'            => true,
			'flex-width'             => true,
            'header-text' => false
		) );
	}

endif;
add_action( 'after_setup_theme', 'sampression_setup' );

/**
 * Sampression theme background image css callback
 */
if(!function_exists( 'sampression_custom_background_cb' )):

    function sampression_custom_background_cb() {
        $background = get_background_image();
        $color = get_background_color();
     
        if ( ! $background && ! $color )
            return;
     
        $style = $color ? "background-color: #$color;" : '';
     
        if ( $background ) {
            $image = " background-image: url('$background');";
     
            $repeat = get_theme_mod( 'background_repeat', 'repeat' );
     
            if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
                $repeat = 'repeat';
     
            $repeat = " background-repeat: $repeat;";
     
            $position = get_theme_mod( 'background_position_x', 'left' );
     
            if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
                $position = 'left';
     
            $position = " background-position: top $position;";
     
            $attachment = get_theme_mod( 'background_attachment', 'scroll' );
     
            if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
                $attachment = 'scroll';
     
            $attachment = " background-attachment: $attachment;";

            $cover = '';
            if(get_theme_mod( 'sampression_background_cover' )) {
                $cover = ' background-size: cover;';
            }
     
            $style .= $image . $repeat . $position . $attachment . $cover;
        }
    ?>
    <style type="text/css">
    #content-wrapper { <?php echo trim( $style ); ?> }
    </style>
    <?php
    }

endif;

function sampression_font_family( $family ) {
	$family = explode('=', $family);
	//print_r($family);
	$character = $family[1];
	$font = explode(':', $family[0]);
	$font = str_replace('+', ' ', $font[0]);
	return "'$font', ".$character;
}

function sampression_font_style( $style ) {
	$webtitle = '';
	$style = (array)$style;
	if( in_array( 'bold', $style ) ) {
		$webtitle .= 'font-weight: bold;';
	} else {
		$webtitle .= 'font-weight: normal;';
	}
	if( in_array( 'italic', $style ) ) {
		$webtitle .= 'font-style: italic;';
	} else {
		$webtitle .= 'font-style: normal;';
	}
	if( in_array( 'all-caps', $style ) ) {
		$webtitle .= 'text-transform: uppercase;';
	} else {
		$webtitle .= 'text-transform: none;';
	}
	if( in_array( 'underline', $style ) ) {
		$webtitle .= 'text-decoration: underline;';
	} else {
		$webtitle .= 'text-decoration: none;';
	}
	return $webtitle;
}

if( ! function_exists( 'sampression_header_style') ) {

	function sampression_header_style() {

		$webtitle = $webtitle_color = $webtagline = $primary_nav = $primary_nav_col_hover = $social_media_icon = '';
		// Website Title Style
		if( !empty(get_theme_mod( 'webtitle_font_family' )) ) {
			$webtitle .= 'font-family: ' . sampression_font_family( get_theme_mod( 'webtitle_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'webtitle_font_size' ) ) {
			$size = get_theme_mod( 'webtitle_font_size' ) / 10;
			$webtitle .= 'font-size: ' . $size . 'rem;';
		}
		if( null !== get_theme_mod( 'webtitle_font_style' ) ) {
			$webtitle .= sampression_font_style( get_theme_mod( 'webtitle_font_style' ) );
		}
		if( get_theme_mod( 'webtitle_font_color' ) ) {
			$webtitle_color .= 'color: #' . get_theme_mod( 'webtitle_font_color' ) . ';';
		}
		// Website Tagline Style
		if( !empty(get_theme_mod( 'webtagline_font_family' )) ) {
			$webtagline .= 'font-family: ' . sampression_font_family( get_theme_mod( 'webtagline_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'webtagline_font_size' ) ) {
			$size = get_theme_mod( 'webtagline_font_size' ) / 10;
			$webtagline .= 'font-size: ' . $size . 'rem;';
		}
		if( get_theme_mod( 'webtagline_font_style' ) ) {
			$webtagline .= sampression_font_style( get_theme_mod( 'webtagline_font_style' ) );
		}
		if( get_theme_mod( 'webtagline_font_color' ) ) {
			$webtagline .= 'color: #' . get_theme_mod( 'webtagline_font_color' ) . ';';
		}
		if( !empty(get_theme_mod( 'primarynav_font_family' )) ) {
			$primary_nav .= 'font-family: ' . sampression_font_family( get_theme_mod( 'primarynav_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'primarynav_font_size' ) ) {
			$size = get_theme_mod( 'primarynav_font_size' ) / 10;
			$primary_nav .= 'font-size: ' . $size . 'rem;';
		}
		if( get_theme_mod( 'primarynav_font_style' ) ) {
			$primary_nav .= sampression_font_style( get_theme_mod( 'primarynav_font_style' ) );
		}
		if( get_theme_mod( 'primarynav_font_color' ) ) {
			$primary_nav .= 'color: #' . get_theme_mod( 'primarynav_font_color' ) . ';';
		}
		if( get_theme_mod( 'primarynav_font_color_hover' ) ) {
			$primary_nav_col_hover .= 'color: #' . get_theme_mod( 'primarynav_font_color_hover' ) . ';';
		}
		if( get_theme_mod( 'use_social_default_color' ) != 1 ) {
			$social_media_icon .= 'color: #' .get_theme_mod( 'social_icon_color' ) . ';';
		}

		$full_width_nav = $full_width_nav_a = $full_width_nav_a_hover = '';
		if( get_theme_mod( 'sampression_remove_secondary_nav' ) != 1 ) {
			$full_width_nav .= 'background-color: #' . get_theme_mod( 'sec_nav_background_color' ) . ';';
		}
		if( !empty(get_theme_mod( 'secondarynav_font_family' )) ) {
			$full_width_nav_a .= 'font-family: ' . sampression_font_family( get_theme_mod( 'secondarynav_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'secondarynav_font_size' ) ) {
			$size = get_theme_mod( 'secondarynav_font_size' ) / 10;
			$full_width_nav_a .= 'font-size: ' . $size . 'rem;';
		}
		//if( get_theme_mod( 'primarynav_font_style' ) ) {
			$full_width_nav_a .= sampression_font_style( get_theme_mod( 'secondarynav_font_style' ) );
		//}
		if( get_theme_mod( 'secondarynav_font_color' ) ) {
			$full_width_nav_a .= 'color: #' .get_theme_mod( 'secondarynav_font_color' ) . ';';
		}
		if( get_theme_mod( 'secondarynav_font_color_hover' ) ) {
			$full_width_nav_a_hover .= 'color: #' .get_theme_mod( 'secondarynav_font_color_hover' ) . ';';
		}

		$header_text = $header_text_hover = '';
		if( !empty(get_theme_mod( 'headertext_font_family' )) ) {
			$header_text .= 'font-family: ' . sampression_font_family( get_theme_mod( 'headertext_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'headertext_font_size' ) ) {
			$size = get_theme_mod( 'headertext_font_size' ) / 10;
			$header_text .= 'font-size: ' . $size . 'rem;';
		}
		$header_text .= sampression_font_style( get_theme_mod( 'headertext_font_style' ) );
		if( get_theme_mod( 'headertext_font_color' ) ) {
			$header_text .= 'color: #' .get_theme_mod( 'headertext_font_color' ) . ';';
		}
		if( get_theme_mod( 'headertext_link_color' ) ) {
			$header_text_hover .= 'color: #' .get_theme_mod( 'headertext_link_color' ) . ';';
		}

		$body_text = $body_text_link = '';
		if( !empty(get_theme_mod( 'bodytext_font_family' )) ) {
			$body_text .= 'font-family: ' . sampression_font_family( get_theme_mod( 'bodytext_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'bodytext_font_size' ) ) {
			$size = get_theme_mod( 'bodytext_font_size' ) / 10;
			$body_text .= 'font-size: ' . $size . 'rem;';
		}
		$body_text .= sampression_font_style( get_theme_mod( 'bodytext_font_style' ) );
		if( get_theme_mod( 'bodytext_font_color' ) ) {
			$body_text .= 'color: #' .get_theme_mod( 'bodytext_font_color' ) . ';';
		}
		if( get_theme_mod( 'body_text_link' ) ) {
			$body_text_link .= 'color: #' .get_theme_mod( 'body_text_link' ) . ';';
		}
		
		$filter_icon = $filter_text = '';
		if( get_theme_mod( 'filterby_icon_color' ) ) {
			$filter_icon .= 'background-color: #' .get_theme_mod( 'filterby_icon_color' ) . ';';
		}
		if( !empty(get_theme_mod( 'filterby_font_family' )) ) {
			$filter_text .= 'font-family: ' . sampression_font_family( get_theme_mod( 'filterby_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'filterby_font_size' ) ) {
			$size = get_theme_mod( 'filterby_font_size' ) / 10;
			$filter_text .= 'font-size: ' . $size . 'rem;';
		}
		$filter_text .= sampression_font_style( get_theme_mod( 'filterby_font_style' ) );
		if( get_theme_mod( 'filterby_font_color' ) ) {
			$filter_text .= 'color: #' .get_theme_mod( 'filterby_font_color' ) . ';';
		}

		$meta_text = $meta_text_color = $meta_text_color_hover = '';
		if( !empty(get_theme_mod( 'metatext_font_family' )) ) {
			$meta_text .= 'font-family: ' . sampression_font_family( get_theme_mod( 'metatext_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'metatext_font_size' ) ) {
			$size = get_theme_mod( 'metatext_font_size' ) / 10;
			$meta_text .= 'font-size: ' . $size . 'rem;';
		}
		$meta_text .= sampression_font_style( get_theme_mod( 'metatext_font_style' ) );
		if( get_theme_mod( 'metatext_font_color' ) ) {
			$meta_text_color .= 'color: #' .get_theme_mod( 'metatext_font_color' ) . ';';
		}
		if( get_theme_mod( 'metatext_link_color' ) ) {
			$meta_text_color_hover .= 'color: #' .get_theme_mod( 'metatext_link_color' ) . ';';
		}

		$widget_text = $widget_text_link = '';
		if( !empty(get_theme_mod( 'widgettext_font_family' )) ) {
			$widget_text .= 'font-family: ' . sampression_font_family( get_theme_mod( 'widgettext_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'widgettext_font_size' ) ) {
			$size = get_theme_mod( 'widgettext_font_size' ) / 10;
			$widget_text .= 'font-size: ' . $size . 'rem;';
		}
		$widget_text .= sampression_font_style( get_theme_mod( 'widgettext_font_style' ) );
		if( get_theme_mod( 'widgettext_font_color' ) ) {
			$widget_text .= 'color: #' .get_theme_mod( 'widgettext_font_color' ) . ';';
		}
		if( get_theme_mod( 'widgettext_link_color' ) ) {
			$widget_text_link .= 'color: #' .get_theme_mod( 'widgettext_link_color' ) . ';';
		}

		$pagination_text = $pagination_text_link = '';
		if( !empty(get_theme_mod( 'paginationtext_font_family' )) ) {
			$pagination_text .= 'font-family: ' . sampression_font_family( get_theme_mod( 'paginationtext_font_family' ) ) . ';';
		}
		if( get_theme_mod( 'paginationtext_font_size' ) ) {
			$size = get_theme_mod( 'paginationtext_font_size' ) / 10;
			$pagination_text .= 'font-size: ' . $size . 'rem;';
		}
		$pagination_text .= sampression_font_style( get_theme_mod( 'paginationtext_font_style' ) );
		if( get_theme_mod( 'paginationtext_font_color' ) ) {
			$pagination_text .= 'color: #' .get_theme_mod( 'paginationtext_font_color' ) . ';';
		}
		if( get_theme_mod( 'paginationtext_font_color_hover' ) ) {
			$pagination_text_link .= 'color: #' .get_theme_mod( 'paginationtext_font_color_hover' ) . ';';
		}
		$button_bg = '';
		if( get_theme_mod( 'button_bg_color' ) ) {
			$button_bg .= 'background-color: #' .get_theme_mod( 'button_bg_color' ) . ';';
		}

		//echo $full_width_nav_a;
		?>
<style id="sampression-header-style" type="text/css">
<?php
if($webtitle != '' ) {
echo "#site-title { $webtitle }" . PHP_EOL;
}
if($webtitle_color != '' ) {
echo "#site-title a { $webtitle_color }" . PHP_EOL;
}
if($webtagline != '') {
echo "#site-description { $webtagline }" . PHP_EOL;
}
if($primary_nav != '' ) {
echo "#top-nav ul li a { $primary_nav }" . PHP_EOL;
}
if($primary_nav_col_hover != '' ) {
echo "#top-nav ul li a:hover { $primary_nav_col_hover }" . PHP_EOL;
}
if($social_media_icon != '' ) {
echo ".sm-top li.sm-top-fb a, .sm-top li.sm-top-tw a, .sm-top li.sm-top-youtube a, .sm-top li.sm-top-gplus a, .sm-top li.sm-top-tumblr a, .sm-top li.sm-top-pinterest a, .sm-top li.sm-top-linkedin a, .sm-top li.sm-top-github a, .sm-top li.sm-top-instagram a, .sm-top li.sm-top-flickr a, .sm-top li.sm-top-vimeo a { $social_media_icon }" . PHP_EOL;
}
if( $full_width_nav != '' ) {
echo ".full-width #full-width-nav { $full_width_nav }" . PHP_EOL;
}
if( $full_width_nav_a != '' ) {
echo ".full-width #full-width-nav ul a { $full_width_nav_a }" . PHP_EOL;
}
if( $full_width_nav_a_hover != '' ) {
echo ".full-width #full-width-nav ul a:hover { $full_width_nav_a_hover }" . PHP_EOL;
}
if( $header_text != '' ) {
echo "article.post .post-title a, .widget .widget-title { $header_text }" . PHP_EOL;
}
if( $header_text_hover != '' ) {
echo "article.post .post-title a:hover { $header_text_hover }" . PHP_EOL;
}
if( $body_text != '' ) {
echo "p, p a { $body_text }" . PHP_EOL;
}
if( $body_text_link != '' ) {
echo "p a:hover { $body_text_link }" . PHP_EOL;
}
if( $filter_icon != '' ) {
echo "#primary-nav ul.nav-listing li a span { $filter_icon }" . PHP_EOL;
}
if( $filter_text != '' ) {
echo "#primary-nav .nav-label, #filter a { $filter_text }" . PHP_EOL;
}
if( $meta_text != '' ) {
echo ".meta a { $meta_text }" . PHP_EOL;
}
if( $meta_text_color != '' ) {
echo ".meta, .meta a { $meta_text_color }" . PHP_EOL;
}
if( $meta_text_color != '' ) {
echo ".meta, .meta a { $meta_text_color }" . PHP_EOL;
}
if( $meta_text_color_hover != '' ) {
echo ".meta a:hover { $meta_text_color_hover }" . PHP_EOL;
}
if( $widget_text != '' ) {
echo ".widget { $widget_text }" . PHP_EOL;
}
if( $widget_text_link != '' ) {
echo ".widget a { $widget_text_link }" . PHP_EOL;
}
if( $pagination_text != '' ) {
echo "#nav-below a, #nav-below span { $pagination_text }" . PHP_EOL;
}
if( $pagination_text_link != '' ) {
echo "#nav-below a:hover { $pagination_text_link }" . PHP_EOL;
}
if( $button_bg != '' ) {
echo ".button, button, input[type=\"submit\"], input[type=\"reset\"], input[type=\"button\"] { $button_bg }" . PHP_EOL;
}
?>
</style>
		<?php
	}
}
add_action( 'wp_head', 'sampression_header_style', 999 );

function sampression_header_code() {
	if( ! empty( get_theme_mod( 'sampression_header_code' ) ) ) {
		echo get_theme_mod( 'sampression_header_code' ) . PHP_EOL;
	}
}
add_action( 'wp_head', 'sampression_header_code', 1111 );

function sampression_footer_code() {
	if( ! empty( get_theme_mod( 'sampression_footer_code' ) ) ) {
		echo get_theme_mod( 'sampression_footer_code' ) . PHP_EOL;
	}
}
add_action( 'wp_footer', 'sampression_footer_code', 999 );

/**
 * Register widget area.
 */
function sampression_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'sampression' ),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__( 'The Primary Sidebar displays on sidebar of the inner pages.', 'sampression' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'sampression' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'The Footer Sidebar displays on footer.', 'sampression' ),
		'before_widget' => '<div id="%1$s" class="column one-third widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'sampression_widgets_init' );

function sampression_create_font_url( $family ) {
    $family = explode( '=', $family );
    return $family[0];
}

function sampression_fonts_url() {
    $fonts_url = '';
    $fonts     = array();

    $fonts[] = sampression_create_font_url( get_theme_mod( 'webtitle_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'webtagline_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'primarynav_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'secondarynav_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'headertext_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'bodytext_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'filterby_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'metatext_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'widgettext_font_family', 'Roboto+Slab:400,700=serif' ) );
    $fonts[] = sampression_create_font_url( get_theme_mod( 'paginationtext_font_family', 'Roboto+Slab:400,700=serif' ) );

    $fonts = array_unique( $fonts );
    
    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => implode( '|', $fonts )
        ), '//fonts.googleapis.com/css' );
    }
    return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function sampression_scripts() {
	wp_enqueue_style( 'sampression-fonts', sampression_fonts_url(), array(), null );
	wp_enqueue_style( 'sampression-genericons', get_template_directory_uri() . '/genericons/genericons.css' );
	wp_enqueue_style( 'sampression-style', get_stylesheet_uri() );

	wp_enqueue_script( 'sampression-modernizr', get_template_directory_uri() . '/js/modernizr.custom.min.js', array(), '', false );

	//wp_enqueue_script( 'sampression-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'sampression-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min-2.2.2.js', array('jquery'), '', true );
	wp_enqueue_script( 'sampression-soundcloud', get_template_directory_uri() . '/js/soundcloud.player.api.js', array(), '', false );
	wp_enqueue_script( 'sampression-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery', 'sampression-isotope'), '', false );
	global $post;
	$columns_var = 4;
	if( get_theme_mod( 'home_columns' ) ) {
		$columns_var = get_theme_mod( 'home_columns' );
	}
	if( is_archive() ) {
		$columns_var = 3;
	}
	wp_localize_script( 'sampression-scripts', 'SampressionVar',
		array(
			'SampressionColumnsVar' => $columns_var
		)
	);
}
add_action( 'wp_enqueue_scripts', 'sampression_scripts' );

/**
 * Fallback for wp_nav_menu calls in header.php
 */
if( !function_exists( 'sampression_page_menu' ) ) :

	function sampression_page_menu() {
		echo '<ul class="top-menu clearfix">';
        wp_list_pages('title_li=&depth=0');
        echo '</ul>';
	}
endif;

if( !function_exists( 'sampression_post_class' ) ) :
	/**
	 * Filter for post_class
	 */
	function sampression_post_class( $classes ) {
		global $post;
		if( is_sticky($post->ID) ) {
			$classes[] = '';
		}
		foreach ( ( get_the_category( $post->ID ) ) as $category ) {
			$classes[] = $category->category_nicename;
		}
		if( is_home() ) {
			if( get_theme_mod( 'home_columns' ) ) {
				switch ( get_theme_mod( 'home_columns' ) ) {
					case '1':
						$classes[] = 'twelve';
						break;
					case '2':
						$classes[] = 'six';
						break;
					case '3':
						$classes[] = 'four';
						break;
					default:
						$classes[] = 'three';
						break;
				}
			} else {
				$classes[] = 'three';
			}
			$classes[] = 'columns item';
		}
		if( is_archive() ) {
			$classes[] = 'four columns item';
		}
		if( is_attachment() ) {
			$classes[] = 'post';
		}
		return $classes;
	}

endif;
add_filter( 'post_class', 'sampression_post_class' );

if( ! function_exists( 'sampression_body_class' ) ) {
	function sampression_body_class( $classes ) {
		$classes[] = 'top';
		if( get_theme_mod( 'website_layout' ) === 'full-width-layout' ) {
			$classes[] = 'full-width-layout';
		}
		return $classes;
	}
}
add_filter( 'body_class', 'sampression_body_class' );

if( ! function_exists( 'sampression_entry_date' ) ) {
	/**
	 * Displays published date and comment count for posts
	 */
	function sampression_entry_date() {
		$link_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
                esc_url( get_permalink() ),
                get_the_time(),
                get_the_date()
            );

        printf( '<time class="col posted-on genericon-day" datetime="%1$s">%2$s</time>',
            esc_attr( get_the_date( 'c' ) ),
            $link_string
        );
        $hide_metas = array();
		if( ! empty( get_theme_mod( 'hide_post_metas' ) ) ) {
			$hide_metas = get_theme_mod( 'hide_post_metas' );
		}
		if( !in_array('comment-count', $hide_metas) ) {
	        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
	            echo '<span class="col count-comment genericon-comment">';
	            comments_popup_link( '0', '1', '%');
	            echo '</span>';
	        }
    	}
	}

}


if( ! function_exists( 'sampression_entry_author' ) ) {
	/**
	 * Displays author name and author archive url for posts
	 */
	function sampression_entry_author() {
		printf( '<div class="post-author genericon-user col"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></div>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            _x( 'View all posts by ', 'There is a space after the comma.', 'sampression' ) . get_the_author(),
            get_the_author()
        );
	}

}


if( ! function_exists( 'sampression_entry_category' ) ) {
	/**
	 * Displays categories lists with its archive links for posts
	 */
	function sampression_entry_category() {
		if ( 'post' === get_post_type() ) {
			$overflow_wrapper_open = '<div class="overflow-hidden cat-listing">';
			$overflow_wrapper_close = '</div>';
			if( is_single() ) {
				$overflow_wrapper_open = '';
				$overflow_wrapper_close = '';
			}
			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'sampression' ) );
			if ( $categories_list ) {
		        printf( '<div class="cats genericon-category">%1$s %2$s %3$s</div>',
		        	$overflow_wrapper_open,
		            $categories_list,
		            $overflow_wrapper_close
		        );
	        }
    	}
	}

}

if( ! function_exists( 'sampression_entry_tag' ) ) {
	/**
	 * Displays tags lists with its archive links for posts
	 */
	function sampression_entry_tag() {
		if ( 'post' === get_post_type() ) {
			$overflow_wrapper_open = '<div class="overflow-hidden tag-listing">';
			$overflow_wrapper_close = '</div>';
			$tag_wrapper_open = '<div class="meta">';
			$tag_wrapper_close = '</div>';
			if( is_single() ) {
				$overflow_wrapper_open = '';
				$overflow_wrapper_close = '';
				$tag_wrapper_open = '';
				$tag_wrapper_close = '';
			}
			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'sampression' ) );
	        if ( $tags_list ) {
	        	echo $tag_wrapper_open;
	            printf( '<div class="tags genericon-tag">%1$s %2$s %3$s</div>',
	            	$overflow_wrapper_open,
	                $tags_list,
	            $overflow_wrapper_close
	            );
	            echo $tag_wrapper_close;
	        }
        }
	}

}

if( ! function_exists( 'sampression_edit_post_link' ) ) {
	/**
	 * Displays edit link for posts if user logged in
	 */
	function sampression_edit_post_link() {
		if( is_user_logged_in() ) {
		?>
        <div class="meta">
            <div class="edit genericon-edit">
                <?php edit_post_link( __( 'Edit', 'sampression' ) ); ?>
            </div>
        </div>
    	<?php
    	}
	}

}

if( ! function_exists( 'sampression_post_entry_meta' ) ) {
	function sampression_post_entry_meta() {
		$hide_metas = array();
		if( ! empty( get_theme_mod( 'hide_post_metas' ) ) ) {
			$hide_metas = get_theme_mod( 'hide_post_metas' );
		}
		if( !in_array('date', $hide_metas) ) {
			echo '<div class="meta clearfix">';
	        sampression_entry_date();
		    echo '</div>';
		}
		if( !in_array('author', $hide_metas) ) {
		    echo '<div class="meta clearfix">';
		    sampression_entry_author();
		    echo '</div>';
		}
		if( !in_array('categories', $hide_metas) ) {
		    echo '<div class="meta">';
		    sampression_entry_category();
		    echo '</div>';
		}
		if( !in_array('tags', $hide_metas) ) {
	    	sampression_entry_tag();
		}
	    sampression_edit_post_link();
	}

}

if( ! function_exists( 'sampression_post_entry_meta_single' ) ) {
	function sampression_post_entry_meta_single() {
		$hide_metas = get_theme_mod( 'hide_post_metas' );
		//print_r($hide_metas);
		if( !in_array('date', $hide_metas) || !in_array('author', $hide_metas) || !in_array('categories', $hide_metas) || !in_array('tags', $hide_metas) ) {
			echo '<div class="meta clearfix">';
			if( !in_array('date', $hide_metas) ) {
				sampression_entry_date();
			}
			if( !in_array('author', $hide_metas) ) {
	    		sampression_entry_author();
	    	}
	    	if( !in_array('categories', $hide_metas) ) {
	    		sampression_entry_category();
	    	}
	    	if( !in_array('tags', $hide_metas) ) {
	    		sampression_entry_tag();
	    	}
	    	echo '</div>';
    	}
	}

}

if( !function_exists('sampression_social_media') ) {

	function sampression_social_media() {
		if( get_theme_mod( 'sampression_social_facebook' ) || get_theme_mod( 'sampression_social_twitter' ) || get_theme_mod( 'sampression_social_youtube' ) || get_theme_mod( 'sampression_social_googleplus' ) || get_theme_mod( 'sampression_socials_tumblr' ) || get_theme_mod( 'sampression_social_pinterest' ) || get_theme_mod( 'sampression_social_linkedin' ) || get_theme_mod( 'sampression_social_github' ) || get_theme_mod( 'sampression_social_instagram' ) || get_theme_mod( 'sampression_social_flickr' ) || get_theme_mod( 'sampression_social_vimeo' ) ) {
		?>
		<ul class="sm-top">
			<?php if( get_theme_mod( 'sampression_social_facebook' ) ) { ?>
            <li class="sm-top-fb">
            	<a class="genericon-facebook-alt" href="<?php echo esc_url( get_theme_mod( 'sampression_social_facebook' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_social_twitter' ) ) { ?>
            <li class="sm-top-tw">
            	<a class="genericon-twitter" href="<?php echo esc_url( get_theme_mod( 'sampression_social_twitter' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_social_youtube' ) ) { ?>
            <li class="sm-top-youtube">
            	<a class="genericon-youtube" href="<?php echo esc_url( get_theme_mod( 'sampression_social_youtube' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_social_googleplus' ) ) { ?>
            <li class="sm-top-gplus">
            	<a class="genericon-googleplus" href="<?php echo esc_url( get_theme_mod( 'sampression_social_googleplus' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_socials_tumblr' ) ) { ?>
            <li class="sm-top-tumblr">
            	<a class="genericon-tumblr" href="<?php echo esc_url( get_theme_mod( 'sampression_socials_tumblr' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_social_pinterest' ) ) { ?>
            <li class="sm-top-pinterest">
            	<a class="genericon-pinterest" href="<?php echo esc_url( get_theme_mod( 'sampression_social_pinterest' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_social_linkedin' ) ) { ?>
            <li class="sm-top-linkedin">
            	<a class="genericon-linkedin" href="<?php echo esc_url( get_theme_mod( 'sampression_social_linkedin' ) ); ?>" target="_blank"></a>
    		</li>
    		<?php } if( get_theme_mod( 'sampression_social_github' ) ) { ?>
            <li class="sm-top-github">
            	<a class="genericon-github" href="<?php echo esc_url( get_theme_mod( 'sampression_social_github' ) ); ?>" target="_blank"></a>
    		</li>
    		<?php } if( get_theme_mod( 'sampression_social_instagram' ) ) { ?>
            <li class="sm-top-instagram">
            	<a class="genericon-instagram" href="<?php echo esc_url( get_theme_mod( 'sampression_social_instagram' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_social_flickr' ) ) { ?>
            <li class="sm-top-flickr">
            	<a class="genericon-flickr" href="<?php echo esc_url( get_theme_mod( 'sampression_social_flickr' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } if( get_theme_mod( 'sampression_social_vimeo' ) ) { ?>
            <li class="sm-top-vimeo">
            	<a class="genericon-vimeo" href="<?php echo esc_url( get_theme_mod( 'sampression_social_vimeo' ) ); ?>" target="_blank"></a>
        	</li>
        	<?php } ?>
        </ul>
        <!-- .sm-top -->
		<?php
		}
	}

}


if( ! function_exists( 'sampression_has_embed') ) {
	/**
	 * Check for the URL if the_content have any video support url
	 */
	function sampression_has_embed() {

	    global $post;

	    if ( $post && $post->post_content ) {

	        global $shortcode_tags;
	        //print_r($shortcode_tags);
	        // Make a copy of global shortcode tags - we'll temporarily overwrite it.
	        $theme_shortcode_tags = $shortcode_tags;

	        // The shortcodes we're interested in.
	        $shortcode_tags = array(
	            'video' => $theme_shortcode_tags['video'],
	            'embed' => $theme_shortcode_tags['embed']
	        );
	        //print_r($shortcode_tags);
	        // Get the absurd shortcode regexp.
	        $video_regex = '#' . get_shortcode_regex() . '#i';

	        // Restore global shortcode tags.
	        $shortcode_tags = $theme_shortcode_tags;

	        $pattern_array = array( $video_regex );

	        // Get the patterns from the embed object.
	        if ( ! function_exists( '_wp_oembed_get_object' ) ) {
	            include ABSPATH . WPINC . '/class-oembed.php';
	        }
	        $oembed = _wp_oembed_get_object();
	        $pattern_array = array_merge( $pattern_array, array_keys( $oembed->providers ) );

	        // Or all the patterns together.
	        $pattern = '#(' . array_reduce( $pattern_array, function ( $carry, $item ) {
	            if ( strpos( $item, '#' ) === 0 ) {
	                // Assuming '#...#i' regexps.
	                $item = substr( $item, 1, -2 );
	            } else {
	                // Assuming glob patterns.
	                $item = str_replace( '*', '(.+)', $item );
	            }
	            return $carry ? $carry . ')|('  . $item : $item;
	        } ) . ')#is';

	        // Simplistic parse of content line by line.
	        $lines = explode( "\n", $post->post_content );
	        //print_r($lines);
	        foreach ( $lines as $line ) {
	            $line = trim( $line );
	            if ( preg_match( $pattern, $line, $matches ) ) {
	                if ( strpos( $matches[0], '[' ) === 0 ) {
	                    $ret = do_shortcode( $matches[0] );
	                } else {
	                    $ret = wp_oembed_get( $matches[0] );
	                }
	                return $ret;
	            }
	        }
	    }
	}
}

if( ! function_exists('sampression_get_url_in_content') ) {
	/**
	 * Get first URL from the_content
	 */
	function sampression_get_url_in_content() {
		$content = get_the_content();
	    $has_url = get_url_in_content( $content );
	    return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}
}

/**
 * [soundcloud_shortcode description]
 * auto_play  = true / false
 * hide_related = true / false
 * show_comments = true / false
 * show_user - true / false
 * show_reposts = true / false
 * visual = true / false
 *
 * width = 100%
 * height = 450
 * iframe = true / false
 *
 * [soundcloud url="https://api.soundcloud.com/tracks/245048301" params="auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&visual=true" width="100%" height="450" iframe="true" /]
 */
function sampression_soundcloud_shortcode( $atts, $content = null ) {
	$shortcode_options = array_merge(array('url' => trim($content)), is_array($atts) ? $atts : array());
	
	$shortcode_params = array();
	if (isset($shortcode_options['params'])) {
		parse_str(html_entity_decode($shortcode_options['params']), $shortcode_params);
	}
	$shortcode_options['params'] = $shortcode_params;

	// The "url" option is required
	if( !isset( $shortcode_options['url'] ) ) {
		return '';
	}

	// Both "width" and "height" need to be integers
	if (isset($shortcode_options['width']) && !preg_match('/^\d+$/', $shortcode_options['width'])) {
		// set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
		$shortcode_options['width'] = 0;
	}
	if (isset($shortcode_options['height']) && !preg_match('/^\d+$/', $shortcode_options['height'])) {
		unset($shortcode_options['height']);
	}

	// Return html embed code
	if ($shortcode_options['iframe'] == 'true') {
		return sampression_soundcloud_iframe_widget($shortcode_options);
	} else {
		return sampression_soundcloud_flash_widget($shortcode_options);
	}
}
add_shortcode("soundcloud", "sampression_soundcloud_shortcode");

function sampression_soundcloud_iframe_widget( $options ) {

	$url = $options['url'] . '&' . http_build_query($options['params']);
	$width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
	$height = isset($options['height']) && $options['height'] !== 0
		? $options['height']
		: (soundcloud_url_has_tracklist($options['url']) || (isset($options['params']['visual']) && $options['params']['visual'] == 'true') ? '450' : '166');
	return sprintf( '<iframe width="%s" height="%s" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=%s"></iframe>',
		$width, $height, $url
  	);
}

function sampression_soundcloud_flash_widget($options) {
	return '<object height="81" width="100%">
  <param name="movie" value="http://player.soundcloud.com/player.swf?url=https://api.soundcloud.com/tracks/245048301&enable_api=true"></param>
  <param name="allowscriptaccess" value="always"></param>
  <embed allowscriptaccess="always" height="81" src="http://player.soundcloud.com/player.swf?url=https://api.soundcloud.com/tracks/245048301&enable_api=true" type="application/x-shockwave-flash" width="100%"></embed>
</object>';
	$url = 'https://player.soundcloud.com/player.swf?' . http_build_query($options['params']) . '&url=' . $options['url'];
	//$url = $options['url'] . '&' . http_build_query($options['params']);
	$width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
	$height = isset($options['height']) && $options['height'] !== 0
		? $options['height']
		: (soundcloud_url_has_tracklist($options['url']) || (isset($options['params']['visual']) && $options['params']['visual'] == 'true') ? '255' : '81');
	return sprintf('<object height="%s" width="%s"><param name="movie" value="%s"></param><param name="allowscriptaccess" value="always"></param><embed allowscriptaccess="always" height="%s" src="%s" type="application/x-shockwave-flash" width="%s"></embed></object>',
		$height, $width, $url, $height, $url, $width
	);
}

function soundcloud_url_has_tracklist($url) {
	return preg_match('/^(.+?)\/(sets|groups|playlists)\/(.+?)$/', $url);
}

if ( ! function_exists( 'sampression_comment' ) ) :

function sampression_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sampression' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit','sampression' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
        <div class="avatar-wrapper">
        <span class="pointer"></span>
        <div class="avatar">
		<?php // Get Avatar
        $avatar_size = 80;
        if ( '0' != $comment->comment_parent )
            $avatar_size = 80;
        
        echo get_avatar( $comment, $avatar_size );
        ?>
        </div>
        <!-- .avatar -->
        </div>
        <!-- .col-2 -->
            <div class="comment-wrapper">
                <div class="comment-entry">
                <header class="comment-meta clearfix">
                <div class="comment-author">
                    <?php

                    /* translators: 1: comment author, 2: date and time */
                    printf( __( '%1$s on %2$s', 'sampression' ),
                        sprintf( '<span class="fn">%s</span>', get_comment_author_link()),
                        sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '<span class="date-details">%1$s</span>' ), get_comment_date(), get_comment_time() )
                        )
                    );
                    ?>
            	</div><!-- .comment-author  -->
                    <?php edit_comment_link( __( 'Edit', 'sampression' ), '<span class="edit-link">', '</span>' ); ?>

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'sampression' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
                </header>
        		<div class="comment-content"><?php comment_text(); ?></div>

            </div>
            
            <?php /*if ( $comment->comment_approved == '0' ) : ?>
					<div class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sampression' ); ?></div>
			<?php endif; */ ?>

			
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for sampression_comment()

if ( ! function_exists( 'sampression_posts_navi' ) ) :
	/**
	 * Displays post navigation
	 */
    function sampression_posts_navi( $nav_id ) {
	global $wp_query;
	
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="post-navigation clearfix" role="navigation">
        	<?php
			/**
			 * Navigation support for WP-PageNavi plugin
			 *
			 * @https://wordpress.org/plugins/wp-pagenavi/
			 */
			if( function_exists( 'wp_pagenavi' ) ) {
				wp_pagenavi();
			} else {
				if( !get_theme_mod( 'page_navigation' ) || get_theme_mod( 'page_navigation' ) === 'default' ) {
				?>
	                <div class="nav-previous alignleft">
	                	<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sampression' ) ); ?>
	            	</div>
	                <div class="nav-next alignright">
	                	<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sampression' ) ); ?>
	            	</div>
            	<?php
            	} else {
            		$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'prev_text' => __( '<span class="meta-nav">&larr;</span> Previous', 'sampression' ),
						'next_text' => __( 'Next <span class="meta-nav">&rarr;</span>', 'sampression' ),
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages
					) );
            	}
			}
			?>
		</nav>
	<?php endif;
}
endif;



function pre( $arr, $die = false ) {
	echo '<pre>';
	print_r( $arr );
	echo '</pre>';
	if($die) {
		die;
	}
}












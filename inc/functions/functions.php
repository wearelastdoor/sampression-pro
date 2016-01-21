<?php
/**
 * The main functions file
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if (!defined('ABSPATH'))
    exit('restricted access');

add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Check for data that saved in Sampression Lite theme to 
 * import to Sampression Pro when it is activated
 */
function sampression_setup_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    if( (is_super_admin( $user_id ) && get_option( 'opt_sam_use_logo' )) &&  !get_option( 'sampression_theme_options' )) {
        if ( !get_user_meta($user_id, 'sampression_ignore_setup_notice', true) ) {
            ?>
            <div class="error">
                <p><?php printf(__('Import all your previous settings and configurations of Sampression Lite to Sampression Pro. <a href="%2$s" class="import-lite-data">Import Now</a> | <a href="%1$s" class="hide-setup-notice">Hide Notice</a>', 'sampression'),
                '?sampression_setup_notice_dismiss=1',
                '?sampression_import_lite_data=1'); ?></p>
            </div>
            <?php
        }
    }
}

if (!function_exists('sampression_the_title')) :
    function sampression_the_title() {
        if(get_post_format() === 'link') {
            if(is_single()) {
                the_title( '<h2 class="post-title"><a href="' . esc_url( sampression_get_link_from_content() ) . '" rel="bookmark">', '</a><i class="icon-Link" title="'. get_post_format_string( get_post_format() ) .'"></i></h2>' );
            } else {
                the_title( '<h3 class="post-title"><a title="'. esc_attr( get_the_title() ) .'" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a><i class="icon-Link" title="'.get_post_format_string( get_post_format() ).'"></i></h3>' );
            }
        } else {
            if(is_attachment()) {
                global $post;
                the_title( '<h2 class="post-title"><a href="'.get_permalink($post->post_parent).'">'.get_the_title($post->post_parent).':</a> ', '<i class="icon-Photo" title="Image"></i></h2>' );
            } elseif ( is_single()) {
                the_title( '<h2 class="post-title">', '<i class="'. sampression_post_format_class(get_post_format(), true) .'" title="'. get_post_format_string( get_post_format() ) .'"></i></h2>' );
            } elseif( is_page() ) {
                the_title( '<h2 class="post-title">', '</h2>' );
            } else {
                the_title( '<h3 class="post-title"><a title="'. esc_attr( get_the_title() ) .'" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a><i class="'. sampression_post_format_class(get_post_format(), true) .'" title="'.get_post_format_string( get_post_format() ).'"></i></h3>' );
            }
        }
    }
endif;

/**
 * Return the post URL.
 *
 */
function sampression_get_link_from_content() {
    $content = get_the_content();
    $has_url = get_url_in_content( $content );

    return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

function sampression_setup_notice_dismiss() {
    global $current_user;
    $user_id = $current_user->ID;
    if ( isset($_GET['sampression_setup_notice_dismiss']) && '1' == $_GET['sampression_setup_notice_dismiss'] ) {
        add_user_meta($user_id, 'sampression_ignore_setup_notice', 1, true);
        if ( wp_get_referer() ) {
            wp_safe_redirect( wp_get_referer() );
            exit;
        } else {
            wp_safe_redirect( home_url( '/' ) );
            exit;
        }
    } else if ( isset($_GET['sampression_import_lite_data']) && '1' == $_GET['sampression_import_lite_data'] ) {
        global $sampression_options_settings;
        $options = $sampression_options_settings;

        $use_logo = 'use_logo';
        if( get_option('opt_sam_use_logo') == 'yes' ) {
            $use_logo = 'use_title';
        }
        $logo_url = SAM_PRO_ADMIN_IMAGES_URL . '/logo.png';
        if( get_option('opt_sam_logo') != '' ) {
            $logo_url = get_option('opt_sam_logo');
        }

        $use_favicon_16 = get_option('opt_sam_use_favicon16x16', 'yes');
        $favicon_16 = SAM_PRO_ADMIN_IMAGES_URL . '/sampression-16x16.png';
        if( get_option('opt_sam_favicons') != '' ) {
            $favicon_16 = get_option('opt_sam_favicons');
        }

        $use_apple_icons_57 = get_option('opt_sam_use_appletouch57x57', 'yes');
        $apple_icons_57 = SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-57x57.png';
        if( get_option('opt_sam_apple_icons_57') != '' ) {
            $apple_icons_57 = get_option('opt_sam_apple_icons_57');
        }

        $use_apple_icons_72 = get_option('opt_sam_use_appletouch72x72', 'yes');
        $apple_icons_72 = SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-72x72.png';
        if( get_option('opt_sam_apple_icons_72') != '' ) {
            $apple_icons_72 = get_option('opt_sam_apple_icons_72');
        }

        $use_apple_icons_114 = get_option('opt_sam_use_appletouch114x114', 'yes');
        $apple_icons_114 = SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-114x114.png';
        if( get_option('opt_sam_apple_icons_114') != '' ) {
            $apple_icons_114 = get_option('opt_sam_apple_icons_114');
        }

        $use_apple_icons_144 = get_option('opt_sam_use_appletouch144x144', 'yes');
        $apple_icons_144 = SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-144x144.png';
        if( get_option('opt_sam_apple_icons_144') != '' ) {
            $apple_icons_144 = get_option('opt_sam_apple_icons_144');
        }
        $facebook = get_option('opt_get_facebook', '');
        $twitter = get_option('opt_get_twitter', '');
        $youtube = get_option('opt_get_youtube', '');
        $googleplus = get_option('opt_get_gplus', '');
        $header = get_option('opt_sam_header', '');
        $footer = get_option('opt_sam_footer', '');
        $lite_data = array(
            'use_logo_title' => $use_logo,
            'logo_url' => $logo_url,
            'donot_use_favicon_16' => $use_favicon_16,
            'favicon_url_16' => $favicon_16,
            'donot_use_apple_icon_57' => $use_apple_icons_57,
            'apple_icon_url_57' => $apple_icons_57,
            'donot_use_apple_icon_72' => $use_apple_icons_72,
            'apple_icon_url_72' => $apple_icons_72,
            'donot_use_apple_icon_114' => $use_apple_icons_114,
            'apple_icon_url_114' => $apple_icons_114,
            'donot_use_apple_icon_144' => $use_apple_icons_144,
            'apple_icon_url_144' => $apple_icons_144,
            'social_facebook_url' => $facebook,
            'social_twitter_url' => $twitter,
            'social_youtube_url' => $youtube,
            'social_googleplus_url' => $googleplus,
            'advanced_header_code' => $header,
            'advanced_footer_code' => $footer,
        );
        $pro_data = array_merge($options, $lite_data);
        add_option( 'sampression_theme_options', $pro_data, '', 'yes' );
        add_user_meta($user_id, 'sampression_ignore_setup_notice', 1, true);
        wp_safe_redirect( admin_url( 'themes.php?page=sampression-options&settings-updated=import' ) );
        exit;
        //sam_p($pro_data);
    }
}

add_action( 'admin_notices', 'sampression_setup_notice' );
add_action('admin_init', 'sampression_setup_notice_dismiss');

/*=======================================================================
 * Fire up the engines to start theme setup.
 *=======================================================================*/

add_action('after_setup_theme', 'sampression_setup');

if (!function_exists('sampression_setup')):

    function sampression_setup() {

        global $content_width;

        /**
         * Global content width.
         */
        if (!isset($content_width))
            $content_width = 650;
        /**
         * Sampression is now available for translations.
         */
		//load_theme_textdomain('sampression', get_template_directory() . '/languages');
				
        /**
         * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
         * @see http://codex.wordpress.org/Function_Reference/add_editor_style
         */
        add_editor_style();

        /**
         * This feature enables post and comment RSS feed links to head.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
         */
        add_theme_support('automatic-feed-links');
        add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'link', 'status', 'audio', 'chat' ) );
        /**
         * This feature enables post-thumbnail support for a theme.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
		// Custom image sizes
		add_image_size( 'featured', 700); // Set the size of Featured Image
        add_image_size( 'featured-full', 940); // Set the size of Featured Image
		add_image_size( 'featured-thumbnail', 220); // Set the size of Featured Image Thumbnail
		
		/**
		 * This feature enables custom background color and image support for a theme
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => '',
		) );
		
		/**
		 * This feature enables custom header color and image support for a theme
		 */
		add_theme_support( 'custom-header', array(
			// Text color and image (empty to use none).
			'default-text-color'     => '',
			'default-image'          => '',

			// Set height and width, with a maximum value for the width.
			'height'                 => 152,
			'width'                  => 960,
			'max-width'              => 2000,

			// Support flexible height and width.
			'flex-height'            => true,
			'flex-width'             => true,
                        
            // header preview on admin panel
            'admin-head-callback'    => 'sampression_admin_header_style',
            'admin-preview-callback' => 'sampression_admin_header_image',
		) ); 
		
		/**
		 * remove wordpress version from header 
		 */
		remove_action( 'wp_head', 'wp_generator' );
        load_theme_textdomain( 'sampression', SAM_PRO_LANGUAGES_DIR );
        add_theme_support( 'menus' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );


        if ( ! current_theme_supports( 'sampression-menus' ) )
            add_theme_support( 'sampression-menus', array(
                'top-menu'   => __('Top Menu', 'sampression')
            ) );

        if ( ! current_theme_supports( 'sampression-sidebars' ) )
            add_theme_support( 'sampression-sidebars', array(
                'primary-sidebar'   => array(
                    'column' => 'No Column',
                    'name' => __('Primary Sidebar', 'sampression'),
                    'slug' => 'primary-sidebar',
                    'desc' => __('The Primary Sidebar displays on sidebar of the inner pages.', 'sampression')
                ),
                'footer-sidebar'   => array(
                    'column' => '3 Columns',
                    'name' => __('Footer Sidebar', 'sampression'),
                    'slug' => 'footer-sidebar',
                    'desc' => __('The Footer Sidebar displays on footer.', 'sampression')
                )
            ) );
        
        // Remove text color optopn from header options
        define( 'NO_HEADER_TEXT', true );
		
    }

endif;

/**
 * Get blog title if use-title is set in sampression backend
 * else get logo icon
 *
 * @global type $sampression_logo_icon
 */
function sampression_blog_title() {    
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    if (esc_attr($options['use_logo_title']) === 'use_title') {
        echo '<div class="logo-txt"><h1 class="site-title" id="site-title"> <a href="' . esc_url( home_url( '/' ) ) . '" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ) .'" rel="home" >'.  get_bloginfo('name') . '</a></h1>';
        if ( esc_attr( $options['use_web_desc'] )  === 'yes') {
              echo '<h2 class="site-description" id="site-description">' . get_bloginfo('description') . '</h2>';
        }
        echo '</div>';
    } else {
        echo '<div id="logo"> <a href="' . esc_url( home_url( '/' ) ) . '" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ) .'" rel="home" > <img src="' . esc_url( $options['logo_url'] ) . '" title="' . get_bloginfo('name') . '" /></a></div>';
    }
}
add_action('sampression_logo', 'sampression_blog_title');


/**
 * get sampression favicons
 *
 * @global type $sampression_logo_icon
 */
function sampression_add_favicons() {
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    if (esc_attr($options['donot_use_favicon_16']) === 'no') {
        echo '<link rel="shortcut icon" href="' . esc_url($options['favicon_url_16']) . '" />' . PHP_EOL;
    }
    if (esc_attr($options['donot_use_apple_icon']) === 'no') {
        if (esc_attr($options['donot_use_apple_icon_57']) === 'no') {
            echo '<link rel="apple-touch-icon" sizes="57x57" href="' . esc_url($options['apple_icon_url_57']) . '" />' . PHP_EOL;
        }
        if (esc_attr($options['donot_use_apple_icon_72']) === 'no'){
            echo '<link rel="apple-touch-icon" sizes="72x72" href="' . esc_url($options['apple_icon_url_72']) . '" />' . PHP_EOL;
        }
        if (esc_attr($options['donot_use_apple_icon_114']) === 'no') {
            echo '<link rel="apple-touch-icon" sizes="114x114" href="' . esc_url($options['apple_icon_url_114']) . '" />' . PHP_EOL;
        }
        if (esc_attr($options['donot_use_apple_icon_144']) === 'no') {
            echo '<link rel="apple-touch-icon" sizes="144x144" href="' . esc_url($options['apple_icon_url_144']) . '" />' . PHP_EOL;
        }
    }
}

add_action('sampression_favicons','sampression_add_favicons');

/*
 * Sampression - Social Media Icons
 * @param $location header
 * @return Social Media Links
 */
function sampression_social_media_icons() {
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    //sam_p($options);
    if( $options['social_facebook_url'] || $options['social_twitter_url'] || $options['social_googleplus_url'] || $options['social_youtube_url'] || $options['social_linkedin_url'] || $options['social_rss_url'] ){
        if( $options['social_facebook_url'] ){
            echo'<li class="sm-top-fb"><a href="'. esc_url( $options['social_facebook_url'] ) .'" target="_blank"><i class="icon-Facebook-2"></i></a></li>';
        }
        if( $options['social_twitter_url'] ){
            echo '<li class="sm-top-tw"><a href="'. esc_url( $options['social_twitter_url'] ) .'" target="_blank"><i class="icon-Twitter"></i></a></li>';
        }
        if( $options['social_googleplus_url'] ){
            echo '<li class="sm-top-gplus"><a href="'. esc_url( $options['social_googleplus_url'] ) .'" target="_blank"><i class="icon-Google-Plus"></i></a></li>';
        }
        if( $options['social_youtube_url'] ){
            echo '<li class="sm-top-youtube"><a href="'. esc_url( $options['social_youtube_url'] ) .'" target="_blank"><i class="icon-Youtube"></i></a></li>';
        }
        if( $options['social_linkedin_url'] ){
            echo '<li class="sm-top-linkedin"><a href="'. esc_url( $options['social_linkedin_url'] ) .'" target="_blank"><i class="icon-Linkedin-2"></i></a></li>';
        }
        if( $options['social_rss_url'] ) {
            echo '<li class="sm-top-rss"><a href="'. esc_url( $options['social_rss_url'] ) .'" target="_blank"><i class="icon-RSS"></i></a></li>';
        }
    }
}

/* 
 * function to echo number of class  depending on number of social media link set 
 */
function getnoofclass(){
    $noofclass=0;
    $class = 'socialzero';
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    if( $options['social_facebook_url'] ){ $noofclass++; }
    if( $options['social_twitter_url'] ){ $noofclass++; }
    if( $options['social_googleplus_url'] ){ $noofclass++; }
    if( $options['social_youtube_url'] ){ $noofclass++; }
    if( $options['social_linkedin_url'] ){ $noofclass++; }
    if( $options['social_rss_url'] ){ $noofclass++; }
    switch($noofclass){
            case 1: $class='socialone'; break;
            case 2: $class='socialtwo'; break;
            case 3: $class='socialthree'; break;
            case 4: $class='socialfour'; break;
            case 5: $class='socialfive'; break;
            case 6: $class='socialsix'; break;
     }
    return $class;
}

/*=======================================================================
 * Sets the post excerpt length to 40 characters.
 * Next few lines are adopted from Coraline
 *=======================================================================*/
function sampression_excerpt_length($length) {
    return 40;
}

add_filter('excerpt_length', 'sampression_excerpt_length');

/**
 * Returns a "Read more" link for excerpts
 */
function sampression_read_more() {
    return ' <span class="read-more"><a href="' . get_permalink() . '">' . __('Read more &#8250;', 'sampression') . '</a></span>';
}
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and sampression_read_more_link().
 */
function sampression_auto_excerpt_more($more) {
    return '<span class="ellipsis">&hellip;</span>' . sampression_read_more();
}
add_filter('excerpt_more', 'sampression_auto_excerpt_more');

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 */
function sampression_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= sampression_read_more();
    }
    return $output;
}

add_filter('get_the_excerpt', 'sampression_custom_excerpt_more');

/*=======================================================================
 * Get Category Slugs
 *=======================================================================*/
function sampression_cat_slug() {
    $cats = array();
	foreach((get_the_category()) as $category) { 
		$cats[] = $category->slug;
	} 
	$slug = implode(' ', $cats);
	return $slug;
}

/**
 * Sampression Post thumbnail
 *
 */
function sampression_post_thumbnail() {
    if ( has_post_thumbnail() && ! post_password_required() ) {
        $link = get_permalink();
        if((is_single() || (is_page())) && wp_get_attachment_url(get_post_thumbnail_id())) {
            $link = wp_get_attachment_url(get_post_thumbnail_id());
        }
        //echo $link; die;
        //sam_p($sampression_image_settings);
        echo '<a href="' . $link . '" title="' . the_title_attribute('echo=0') . '" >';
            $thumb = 'large';
            the_post_thumbnail($thumb);
        echo '</a>';
    }
}

/**
 * sampression sidebar class
 *
 * @global type $sampression_style
 */
function sampression_sidebar_class($classes = array()) {
    $position = sampression_sidebar_position();
    $class = '';
    if ($position === 'right') {
        $class = 'four columns offset-by-one';
    } else {
        $class = '';
    }
    if(!empty($classes)) {
        if(is_array($classes)) {
            $class .= ' ' . implode(' ', $classes);
        } else {
            $class .= ' ' . $classes;
        }
    }
    echo $class;
}

function sampression_post_format_class($format, $return = false) {//image', 'gallery', 'video', 'quote', 'link', 'status', 'audio', 'chat
    $icon = '';
    switch($format) {
        case 'image':
            $icon = 'icon-Photo';
            break;
        case 'gallery':
            $icon = 'icon-Photos';
            break;
        case 'video':
            $icon = 'icon-Film-Board';
            break;
        case 'quote':
            $icon = 'icon-Quotes-2';
            break;
        case 'link':
            $icon = 'icon-Link';
            break;
        case 'status':
            $icon = 'icon-Speach-Bubble12';
            break;
        case 'audio':
            $icon = 'icon-Music-Note2';
            break;
        case 'chat':
            $icon = 'icon-Speach-Bubbles';
            break;
        default:
            $icon = '';
    }
    if($return) {
        return $icon;
    } else {
        echo $icon;
    }
}

/**
 * Sampression column class
 *
 * @global type $sampression_style
 */
function sampression_column_class($classes = array()) {
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    if($options['column_active'] == 'three'){
        $column_class = 'one-third column'; 
    }
    if($options['column_active'] == 'one'){
        $column_class = 'sixteen columns'; 
    }
    if($options['column_active'] == 'two'){
        $column_class = 'eight columns'; 
    }
    if($options['column_active'] == 'four'){
        $column_class = 'four columns';         
    }
    return $column_class;
}

/**
 * Sampression content class
 *
 * @global type $sampression_style
 */
function sampression_content_class($classes = array()) {
    $position = sampression_sidebar_position();
    $class = '';
    if ($position === 'left') {
        $class = 'twelve columns';
    } elseif ($position === 'right') {
        $class = 'twelve columns';
    } else {
        $class = 'sixteen columns';
    }
    if(!empty($classes)) {
        if(is_array($classes)) {
            $class .= ' ' . implode(' ', $classes);
        } else {
            $class .= ' ' . $classes;
        }
    }
    echo $class;
}

/*
 * Sampression sidebar postition/ layout
 */
function sampression_sidebar_position() {
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    global $post;
    $post_id = $post->ID;
    $position = '';
    if(is_page() || is_single()) {
        $position = get_post_meta($post_id, 'sam_sidebar_by_post', true);
    }
    if($position == '' || $position == 'default') {
        $position = esc_attr( $options['sidebar_active'] );
    }
    return $position;
}

/**
 * message info
 */
function sampression_message_info() {
    if ((isset($_GET['settings-updated'])) && ($_GET['settings-updated'] == 'true') ) {
         echo '<div id="self-destroy" class="restore-info">Successfully saved.</div>';
    }
    if ((isset($_GET['settings-updated'])) && ($_GET['settings-updated'] == 'reset') ) {
         echo '<div id="self-destroy" class="restore-info">Successfully restored.</div>';
    }
    if ((isset($_GET['settings-updated'])) && ($_GET['settings-updated'] == 'import') ) {
         echo '<div id="self-destroy" class="restore-info">Successfully imported.</div>';
    }
    if ((isset($_GET['settings-updated'])) && ($_GET['settings-updated'] == 'error') && ($_GET['errormessage'] == 1) ) {
         echo '<div id="self-destroy" class="restore-info">Imported file contain error.</div>';
    }
    if ((isset($_GET['settings-updated'])) && ($_GET['settings-updated'] == 'error') && ($_GET['errormessage'] == 2) ) {
         echo '<div id="self-destroy" class="restore-info">Imported file is invalid.</div>';
    }
    if (isset($_GET['message'])) {
        switch ($_GET['message']) {
            case 1:
                echo '<div id="self-destroy" class="restore-info">Successfully imported.</div>';
                break;
            case 2:
                echo '<div id="self-destroy" class="restore-info">Successfully restored to default.</div>';
                break;
            case 3:
                echo '<div id="self-destroy" class="restore-info">Your site is using default settings.</div>';
                break;
            case 4:
                break;
            case 5:
                echo '<div id="self-destroy" class="restore-info">Imported file contain error.</div>';
                break;
            case 6:
                echo '<div id="self-destroy" class="restore-info">Imported file is invalid.</div>';
                break;
            default :
                echo '';
                break;
        }
    }
}

/**
 * generate javascript alert message
 *
 * @param $str message string
 */
function sam_a($str) {
    print "<script>\n";
    print "alert('" . $str . "');";
    print "</script>\n";
}

/**
 *  Php print_r function
 *
 * @param $array array
 */
function sam_p($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * restore theme options 
 */
if(isset($_POST['reset'])) {
    $message = 3;
    if(get_option('sampression_theme_options')){
        delete_option('sampression_theme_options');
        $message = 2;
    }
    wp_redirect('themes.php?page=sampression-options&message=' . $message);
    exit;
}

/**
 * export theme options 
 */
if (isset($_GET['page']) && $_GET['page'] === 'sampression-options' && isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'export') {
    $fname = "sampression-theme-settings" . date('m-d-y-H-i-s') . ".json";
    $data =array();
    $data = get_option('sampression_theme_options'); // Get all options data, return array
    //print_r($data); die;
    $json = json_encode($data);
    //die($json);
    header( 'Content-Description: File Transfer' );
    header( 'Cache-Control: public, must-revalidate' );
    header( 'Pragma: hack' );
    header( 'Content-Type: text/plain' );
    header( 'Content-Disposition: attachment; filename="' . $fname );
    header( 'Content-Length: ' . strlen( $json ) );
    echo $json;
    exit;
    
}

function json_validate($string) {
    if (is_string($string)) {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
    return 'false';
}

if(isset($_POST['import'])) { 
    $json = file_get_contents($_FILES['import_json']['tmp_name']);
    if ($_FILES['import_json']['error'] ) {
        wp_redirect('themes.php?page=sampression-options&settings-updated=error&errormessage=1');
        exit;
    }
    if( json_validate($json) ) {
        $settings = json_decode($json, true);
        if (get_option('sampression_theme_options')) {
            delete_option('sampression_theme_options');
        }
        add_option('sampression_theme_options', $settings, '', 'yes');
        wp_redirect('themes.php?page=sampression-options&settings-updated=import');
        exit;
    } else {
        wp_redirect('themes.php?page=sampression-options&settings-updated=error&errormessage=2');
        exit;
    }
}

/**
 * Truncate string in center
 *
 * @param $file File basename
 * @return truncated file name
 */
function truncate_filename($file) {
    $length = 20;
    if(strlen($file) <= $length) {
        return $file;
    }
    $separator = '...';
    $separatorlength = strlen($separator) ;
    $maxlength = $length - $separatorlength;
    $start = $maxlength / 2 ;
    $trunc =  strlen($file) - $maxlength;

    return substr_replace($file, $separator, $start, $trunc);
}

/*
 * Display font select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 */
function sampression_font_select($name = '', $class = '', $default = '') {
    $default_fonts = (object) sampression_fonts_style();
    $fonts = $default_fonts->fonts;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    foreach ($fonts as $fkey => $fval) {
        $return .= '<optgroup label="' . ucwords(str_replace('-', ' ', $fkey)) . '">';
        foreach ($fval as $key => $val) {
            $sel = '';
            if($default !== '' && ($val == $default)) {
                $sel = ' selected="selected"';
            }
            $return .= '<option value="' . $val .'"' . $sel . '>' . $key . '</option>';
        }
        $return .= '</optgroup>';
    }
    $return .= '</select>';
    echo $return;
}

/*
 * Display font size select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 * @param $min Minimum size value
 * @param $max Maximum size value
 */
function sampression_font_size_select($name = '', $class = '', $default = '') {
    $default_fonts = (object) sampression_fonts_style();
    $size = $default_fonts->size;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    for ($i = $size['min_value']; $i <= $size['max_value']; $i++) {
        $sel = '';
        if($default !== '' && ($i == $default)) {
            $sel = ' selected="selected"';
        }
        $return .= '<option value="' . $i . '"' . $sel . '>' . $i . 'px</option>';
    }
    $return .= '</select>';
    echo $return;
}

/*
 * Display font style select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 */
function sampression_font_style_select($name = '', $class = '', $default = '') {
    $default_fonts = (object) sampression_fonts_style();
    $style = $default_fonts->style;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    foreach ($style as $key => $val) {
        $sel = '';
        if($default !== '' && ($val == $default)) {
            $sel = ' selected="selected"';
        }
        $return .= '<option value="' . $val . '"' . $sel . '>' . $key . '</option>';
    }
    $return .= '</select>';
    echo $return;
}

/*
 * Display font transformation select menu
 * 
 * @param $name Select Menu Name
 * @param $class Select Menu Class Name(s)
 * @param $default Select Menu Default Value i.e. selected value
 */
function sampression_font_transformation_select($name = '', $class = '', $default = '') {
    $default_transformation = (object) sampression_fonts_style();
    $transformation = $default_transformation->transformation;
    $return = '';
    $return .= '<select name="' . $name . '" class="' . $class . '">';
    foreach ($transformation as $key => $val) {
        $sel = '';
        if($default !== '' && ($val == $default)) {
            $sel = ' selected="selected"';
        }
        $return .= '<option value="' . $val . '"' . $sel . '>' . $key . '</option>';
    }
    $return .= '</select>';
    echo $return;
}

/*=======================================================================
 * Shows footer credits
 *=======================================================================*/
function sampression_footer() {
?>

<div class="alignleft powered-wp">
<?php _e('Proudly powered by', 'sampression'); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org', 'sampression' ) ); ?>" title="<?php esc_attr_e( 'WordPress', 'sampression' ); ?>" target="_blank" ><?php _e( 'WordPress', 'sampression' ); ?></a>
</div>

<div class="alignright credit">
	<?php _e( 'A theme by', 'sampression');?> <a href="<?php echo esc_url( __( 'http://www.sampression.com', 'sampression' ) ); ?>" target="_blank" title="<?php esc_attr_e( 'Sampression', 'sampression' ); ?>"><?php _e( 'Sampression', 'sampression' ); ?></a>
</div>
<?php
}
add_filter( 'sampression_credits', 'sampression_footer' );

/*=======================================================================
 * A safe way of adding JavaScripts to a WordPress generated page.
 *=======================================================================*/
if (!is_admin())
	add_action('wp_enqueue_scripts', 'sampression_js');
	

if (!function_exists('sampression_js')) {

	function sampression_js() {
		//wp_enqueue_script("jquery");
		// JS at the bottom for fast page loading.
        wp_enqueue_script( 'modernizr', SAM_PRO_ADMIN_JS_URL . '/modernizr.js', array(), '2.6.2', false );
        wp_enqueue_script( 'selectivizr', SAM_PRO_ADMIN_JS_URL . '/selectivizr.js', array( 'jquery' ), '1.0.2', true );
		wp_enqueue_script('sampression-jquery-isotope', get_template_directory_uri() . '/lib/js/jquery.isotope.min.js', array('jquery'), '1.5.19', true);
		wp_enqueue_script('sampression-custom-script', get_template_directory_uri() . '/lib/js/scripts.js', array('jquery'), '1.1', true);
                
                
                global $sampression_options_settings;
                $options = $sampression_options_settings;
                $columncount= sampression_columncount($options['column_active']);
                
                wp_localize_script(
                    'sampression-custom-script',
                    'SampressionJsVar',
                    array(
                        'columncount' => $columncount
                    )
                );
                
	}

}

/* ===========================================================
 * Function to change words to number eg. three to 3
 * =========================================================== 
 */
function sampression_columncount($options='four'){
    
                switch ($options) {
                    case 'two':
                        return 2;
                        break;
                    case 'three':
                       return 3;
                            break;
                    default:
                        return 4;
                        break;
                }
}

/*=======================================================================
 * Comment Reply
 *=======================================================================*/
function sampression_enqueue_comment_reply() {
if ( is_singular() && comments_open() && get_option('thread_comments')) { 
		wp_enqueue_script('comment-reply'); 
	}
}
add_action( 'wp_enqueue_scripts', 'sampression_enqueue_comment_reply' );

/*=======================================================================
 * Remove rel attribute from the category list
 *=======================================================================*/
function sampression_remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}
add_filter('wp_list_categories', 'sampression_remove_category_list_rel');
add_filter('the_category', 'sampression_remove_category_list_rel');


/*=======================================================================
 * Display navigation to next/previous pages when applicable
 *=======================================================================*/

if ( ! function_exists( 'sampression_content_nav' ) ) :

        function sampression_content_nav( $nav_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="post-navigation clearfix">
        	<?php
			// Enable the Page Navigation features for wp-pagenavi plugin
			if(function_exists('wp_pagenavi')) {
				wp_pagenavi();
			} else {
			?>
                <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sampression' ) ); ?></div>
                <div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sampression' ) ); ?></div>
            <?php
			}
			?>
		</nav>
	<?php endif;
}
endif;

/**
 * wp_list_comments() Pings Callback
 * 
 * wp_list_comments() Callback function for 
 * Pings (Trackbacks/Pingbacks)
 */
function sampression_comment_list_pings( $comment ) {
	$GLOBALS['comment'] = $comment;
?>
	 <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php }

/*=======================================================================
 * Run function during a themes initialization. It clear all widgets
 *=======================================================================*/
add_action( 'setup_theme', 'sampression_widget_reset' );
function sampression_widget_reset() {
    if(isset( $_GET['activated'] )) {
        add_filter( 'sidebars_widgets', 'disable_all_widgets' );
        function disable_all_widgets( $sidebars_widgets ) {
            $sidebars_widgets = array( false );
            return $sidebars_widgets;    
        }
    }
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
        <div class="avatar">
		<?php // Get Avatar
        $avatar_size = 40;
        if ( '0' != $comment->comment_parent )
            $avatar_size = 40;
        
        echo get_avatar( $comment, $avatar_size );
        ?>
        </div>
        <!-- .avatar -->
        </div>
        <!-- .col-2 -->
            <div class="comment-meta clearfix">
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

                    <?php edit_comment_link( __( 'Edit', 'sampression' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .comment-author  -->

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'sampression' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->



            </div>
        <div class="comment-wrapper">
        <div class="comment-entry">

            
            <?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sampression' ); ?></div>
			<?php endif; ?>
            
            

			<div class="comment-content"><?php comment_text(); ?></div>
            </div>
            </div>
            <!-- .col-2 -->

			
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for sampression_comment()

/*=======================================================================
* embed the javascript file that makes the AJAX request to filter category in Primary Navigation
*=======================================================================*/

if (!is_admin())
	add_action('wp_enqueue_scripts', 'sampression_ajax');
	

if (!function_exists('sampression_ajax')) {

	function sampression_ajax() {
		wp_enqueue_script("jquery");
		
		 wp_enqueue_script( 'my-ajax-request', get_template_directory_uri() . '/lib/js/load_content.js', '' , '1.1', true );
		 wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

}

/*=======================================================================
* declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
*=======================================================================*/

add_action( 'wp_ajax_nopriv_filter-cat-data', 'sampression_filter_cat_callback' );
add_action( 'wp_ajax_filter-cat-data', 'sampression_filter_cat_callback' );
 
function sampression_filter_cat_callback() {
   $slug = $_POST['category'];
   $exc = $_POST['exclude'];
   $exclude = explode('~', $exc);
   query_posts(array ( 'category_name' => $slug, 'post__not_in' => $exclude, 'post_status' => 'publish' ) );
   while (have_posts()) : the_post();
   ?>
   <article id="post-<?php the_ID(); ?>" class="post item <?php echo sampression_column_class(); ?> <?php echo sampression_cat_slug(); ?> ">
      <h3 class="post-title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="bookmark" ><?php the_title(); ?></a></h3>
      
      <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured-img">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" ><?php the_post_thumbnail( 'large' ); ?></a>
        </div>
		<!-- .featured-img -->
      <?php } ?>
      
      <div class="entry">
        <?php the_excerpt(); ?>
      </div>
      <!-- .entry -->

      <div class="meta clearfix">
			<?php 
                printf( __( '%3$s <time class="col" datetime="2011-09-28"><span class="ico">Published on</span>%2$s</time> ', 'sampression' ),'meta-prep meta-prep-author',
					sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
						get_permalink(),
						esc_attr( get_the_time() ),
						get_the_date('d M Y')
					),
					sprintf( '<div class="post-author col"><span class="ico hello">Author</span><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></div>',
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
					sprintf( esc_attr__( 'View all posts by %s', 'sampression' ), get_the_author() ),
						get_the_author()
						)
                );
            ?>

			<?php if ( comments_open() ) : ?>
            <span class="col count-comment">
            <span class="pointer"></span>
            <?php comments_popup_link(__('0', 'sampression'), __('1', 'sampression'), __('%', 'sampression')); ?>
            </span>
            <?php endif; ?>
        
        
      </div>
      <div class="meta">
        <div class="cats"><?php printf(__('<span class="ico">Categories</span><div class="overflow-hidden cat-listing">%s</div>', 'sampression'), get_the_category_list(', ')); ?></div>
      </div>
    </article>
	<?php
	endwhile;
	wp_reset_query();
	die();
}

    /**
     * Get latest one sticky post
     */
    function sampression_latest_one_sticky_post() {
        if(get_option( 'sticky_posts' )) {
            $sticky = get_option( 'sticky_posts' );
            rsort( $sticky );
            return $sticky[0];
        }
    }

    /**
     * Get IDs of post that needs to display on blog page
     */
    function sampression_blog_page_posts() {
        global $sampression_options_settings;
        $all_cats = $sampression_options_settings['category_posts_display'];
        //sam_p($all_cats);
        parse_str($all_cats, $cats);
        $post_ids = $result = array();
        $sticky = sampression_latest_one_sticky_post();
        if( empty($cats) || $all_cats == '') {
            $categories = get_categories();
            foreach($categories as $category) {
                $args = array(
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => $category->slug
                        )
                    ),
                );
                $selected_posts = get_posts($args);
                foreach($selected_posts as $post) {
                    $post_ids[] = $post->ID;
                }
            }
        } else {
            foreach($cats as $slug=>$value) {
                if($value != 0) {
                    $args = array(
                        'posts_per_page' => $value,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $slug
                            )
                        ),
                    );
                    $selected_posts = get_posts($args);
                    foreach($selected_posts as $post) {
                        $post_ids[] = $post->ID;
                    }
                }
            }
            $categories = get_categories();
            foreach($categories as $category) {
                if(!array_key_exists($category->slug, $cats)) {
                    $args = array(
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $category->slug
                            )
                        ),
                    );
                    $selected_posts = get_posts($args);
                    foreach($selected_posts as $post) {
                        $post_ids[] = $post->ID;
                    }
                }
            }
        }
        $result = array_unique($post_ids);
        if (($key = array_search($sticky, $result)) !== false) {
            unset($result[$key]);
        }
        return $result;
    }

    /**
     * Return blog categories based on the post that are displayed on home page
     */
    function sampression_home_categories() {
        $post_ids = sampression_blog_page_posts();
        $slug = $result = array();
        foreach($post_ids as $ID) {
            $categories = get_the_category( $ID );
            foreach($categories as $category) {
                $slug[] = $category->slug;
            }
        }
        $result = array_unique($slug);
        return $result;
    }

    /**
     * Return a number of posts in a category
     */
    function sampression_category_count($slug) {
        $args = array(
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $slug
                )
            ),
        );
        $posts = get_posts($args);
        return count($posts);
    }

/*=======================================================================
* Get an IP of USER
*=======================================================================*/

function sampression_get_ip() {
	if (getenv('HTTP_CLIENT_IP')) {
		$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif (getenv('HTTP_X_FORWARDED_FOR')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_X_FORWARDED')) {
		$ip = getenv('HTTP_X_FORWARDED');
	}
	elseif (getenv('HTTP_FORWARDED_FOR')) {
		$ip = getenv('HTTP_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_FORWARDED')) {
		$ip = getenv('HTTP_FORWARDED');
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
 * Displays title. @uses wp_title() 
 */
add_action( 'sampression_title', 'sampression_add_title' );

function sampression_add_title() {
	?>
	<title>
		<?php wp_title( '|', true, 'right' ); ?>
	</title>
	<?php
}

add_filter( 'wp_title', 'sampression_filter_wp_title' );

function sampression_filter_wp_title( $title, $sep= '|' ) {
    global $paged, $page;

    if ( is_feed() )
    return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'sampression' ), max( $paged, $page ) );

    return $title;
}

/**
 * Add meta tags.
 */ 
add_action( 'sampression_meta', 'sampression_add_meta' );

function sampression_add_meta() {
	?>
	<!-- Charset -->
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Mobile Specific Metas  -->
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<?php
}

/**
 * Add google fonts, pingback url, etc.
 */ 

add_action( 'sampression_links', 'sampression_add_links' );

function sampression_add_links() {
	?>
	<!-- Pingback Url -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php
}

add_action( 'wp_enqueue_scripts', 'sampression_enqueue_styles' );

function sampression_enqueue_styles() {
	wp_enqueue_style('sampression-style', get_stylesheet_uri(), false, '1.0');
}


add_action('sampression_footer', 'sampression_enqueue_conditional_scripts');

function sampression_enqueue_conditional_scripts(){
	?>
	<!-- Enables advanced css selectors in IE, must be used with a JavaScript library (jQuery Enabled in functions.php) -->
	<!--[if lt IE 9]>
		<script src="<?php echo SAM_PRO_ADMIN_JS_URL; ?>/selectivizr.js"></script>
	<![endif]-->
	<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
	<![endif]-->
	<?php
}


if ( ! function_exists( 'sampression_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see sampression_custom_header_setup().
 */
function sampression_admin_header_style() {
    global $sampression_options_settings;
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
                    margin:0;
		}
		#headimg h1 {
		}
		#headimg h1 a {
                   color: <?php echo $sampression_options_settings['web_title_color']; ?> !important;
                   text-decoration: none;
                   font: <?php echo $sampression_options_settings['web_title_style'].' '. $sampression_options_settings['web_title_size'] . 'px '. $sampression_options_settings['web_title_font']; ?>;
		}
		#desc {
                    padding-top:2px;
                    padding-bottom:10px;
                    color: <?php echo $sampression_options_settings['web_desc_color']; ?> !important;
                    font: <?php echo $sampression_options_settings['web_desc_style'].' '. $sampression_options_settings['web_desc_size'] . 'px '. $sampression_options_settings['web_desc_font']; ?>;
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // sampression_admin_header_style

if ( ! function_exists( 'sampression_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see sampression_custom_header_setup().
 */
function sampression_admin_header_image() {
	
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // sampression_admin_header_image

/*
 *  Menu of theme option
 */
function sampression_option_menu() {
    
    $menus = array(
        'logos-icons' => array(
            'slug' => 'logos-icons',
            'label' => __( 'Logos &amp; Icons', 'sampression' )
        ),
        'styling' => array(
            'slug' => 'styling',
            'label' => __( 'Styling', 'sampression' )
        ),
        'typography' => array(
            'slug' => 'typography',
            'label' => __( 'Typography', 'sampression' )
        ),
        'social-media' => array(
            'slug' => 'social-media',
            'label' => __( 'Social Media', 'sampression' )
        ),
        'custom-css' => array(
            'slug' => 'custom-css',
            'label' => __( 'Custom CSS', 'sampression' )
        ),
        'blog' => array(
            'slug' => 'blog',
            'label' => __( 'Blog', 'sampression' )
        ),
        'hooks' => array(
            'slug' => 'hooks',
            'label' => __( 'Advanced', 'sampression' )
        ),
        'import-export' => array(
            'slug' => 'import-export',
            'label' => __( 'Import <br> Export', 'sampression' )
        )
    );
    
    foreach ( (array) $menus as $key => $val ) {
        ?>
        <li><a href="#<?php echo $val['slug']; ?>"><i class="icon-sam-<?php echo $key; ?>"></i><?php echo $val['label']; ?></a></li>
    <?php
    }
    
}

// 404 Page error messages
function sampression_404_text() {
    return __("Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly. You may also want to search for what you are looking for.", 'sampression');
}

function sampression_nothing_found_text() {
    
    return __("You can start a new search by using the box below.", 'sampression');
    
}

function sampression_get_template($template_name) {
    include_once SAM_PRO_TEMPLATE_DIR . '/' . $template_name;
}

/**
 * Truncate string in center
 *
 * @param $file File basename
 * @return truncated file name
 */
function sampression_truncate_text($str, $length = 20) {
    if(strlen($str) <= $length) {
        return $str;
    }
    $separator = '...';
    $separatorlength = strlen($separator) ;
    $maxlength = $length - $separatorlength;
    $start = $maxlength / 2 ;
    $trunc =  strlen($str) - $maxlength;

    return substr_replace($str, $separator, $start, $trunc);
}

/*=======================================================================
 * Display extra codes on header and footer added on advanced menu of theme options
 *=======================================================================*/

//Display styles that is written on Custom CSS tab of Theme Option.
function sampression_print_custom_css() {
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    $css = sampression_generate_custom_css($options);
    if($css != '') {
        $print = '<style type="text/css" media="screen">' . PHP_EOL;
        $print .= $css;
        $print .= '</style>' . PHP_EOL;
        echo $print;
    }
}
add_action( 'wp_head', 'sampression_print_custom_css', 15);

// Display Extra codes in Header
function sampression_header_code() {
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    if ( $options['advanced_header_code'] ) {
		echo htmlspecialchars_decode( stripslashes( $options['advanced_header_code'] ) ) . "\n";
	}
}
add_action('wp_head', 'sampression_header_code');

// Display Extra codes in Footer
function sampression_footer_code() {
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    if ( $options['advanced_footer_code'] ) {
		echo htmlspecialchars_decode( stripslashes( $options['advanced_footer_code'] ) ) . "\n";
	}
}
add_action('wp_footer', 'sampression_footer_code');

function sampression_generate_custom_css($options) {
    $css = '#site-title a, #site-title a:visited { font: ' . esc_attr( $options['web_title_style'] ) . ' ' . absint( $options['web_title_size'] ) . 'px/1.3 ' . esc_attr( $options['web_title_font'] ) . '; color: ' . esc_attr( $options['web_title_color'] ) . '; }' . PHP_EOL;
    $css .= '#site-description { font: ' . esc_attr( $options['web_desc_style'] ) . ' ' . absint( $options['web_desc_size'] ) . 'px/1.3 ' . esc_attr( $options['web_desc_font'] ) . '; color: ' . esc_attr( $options['web_desc_color'] ) . '; }' . PHP_EOL;
    if($options['show_background'] == 'no') {
        $css .= 'body #content-wrapper { background:none; }' . PHP_EOL;
    }
    $css .= 'body, label, legend { font: ' . esc_attr( $options['body_font_style'] ) . ' '  . absint( $options['body_font_size'] ) . 'px/1.6 ' . esc_attr( $options['body_font_family'] ) . '; color: ' . esc_attr( $options['body_font_color'] ) . '; }' . PHP_EOL;
    $css .= 'a:link, a:visited { font: ' . esc_attr( $options['link_font_style'] ) . ' '  . absint( $options['link_font_size'] ) . 'px/1.6 ' . esc_attr( $options['link_font_family'] ) . '; color: ' . esc_attr( $options['link_font_color'] ) . '; }' . PHP_EOL;
    $css .= '.button, button, input[type="submit"], input[type="reset"], input[type="button"] { background-color: ' . esc_attr( $options['button_bgcolor'] ) . '; }' . PHP_EOL;
    $css .= '.widget .widget-title, #respond #reply-title, #comments #comments-title, .container .quick-note { font: ' . esc_attr( $options['widget_header_font_style'] ) . ' '  . absint( $options['widget_header_font_size'] ) . 'px ' . esc_attr( $options['widget_header_font_family'] ) . '; color: ' . esc_attr( $options['widget_header_font_color'] ) . '; }' . PHP_EOL;
    $css .= 'a:hover, .widget a:hover { color: ' . esc_attr( $options['link_font_color_hover'] ) . '; }' . PHP_EOL;
    $css .= '#primary-nav ul.nav-listing li a.selected span, #primary-nav ul.nav-listing li a span, #btn-nav-opt { background-color: '. esc_attr( $options['filter_by_color'] ) .' }' . PHP_EOL;
    $css .= '#primary-nav ul.nav-listing li a, #primary-nav ul.nav-listing li a:hover, #primary-nav ul.nav-listing li a.selected { color: '.esc_attr( $options['filter_by_color'] ).' }' . PHP_EOL;
    $css .= '.entry a { color: ' . esc_attr( $options['body_link_color'] ) . ' }' . PHP_EOL;
    $css .= '#top-nav ul a:link, #top-nav ul a:visited { font: ' . esc_attr( $options['nav_font_style'] ) . ' '  . absint( $options['nav_font_size'] ) . 'px ' . esc_attr( $options['nav_font_family'] ) . '; color: ' . esc_attr( $options['nav_font_color'] ) . '; }' . PHP_EOL;
    $css .= '#top-nav ul li a:hover, #top-nav ul li.current-menu-item a, #top-nav ul li:hover > a, #top-nav ul li.current-menu-ancestor a, #top-nav ul li.current-menu-parent a, #top-nav ul li.sfHover li li a:hover { color: ' . esc_attr( $options['nav_font_color_hover'] ) . '; }' . PHP_EOL;
    $css .= '
    body.single article.post .post-title,
    body.page article.post .post-title,
    body.single article.format-link .post-title a,
    body.attachment article.type-attachment .post-title a, body.attachment article.type-attachment .post-title a:hover {
        font: ' . esc_attr( $options['post_title_font_style'] ) . ' ' . absint( $options['post_title_font_size'] ) . 'px/1.2 ' . esc_attr( $options['post_title_font_family'] ) . '; color: ' . esc_attr( $options['post_title_font_color'] ) . '; }' . PHP_EOL;
    $css .= '#post-listing .corner-stamp.columns.four, #post-listing .corner-stamp.columns.eight, #post-listing .corner-stamp.columns.sixteen, #post-listing .corner-stamp.column.one-third { background-color: ' . esc_attr( $options['sticky_bgcolor'] ) . '; }' . PHP_EOL;
    $css .= 'article.post .meta a, article.post .meta { font: '. esc_attr( $options['meta_font_style'] ) . ' ' . absint( $options['meta_font_size'] ) . 'px/1.6 ' . esc_attr( $options['meta_font_family'] ) . '; color: ' . esc_attr( $options['meta_font_color'] ) . '; }' . PHP_EOL;
    $css .= 'article.post .post-title a { font: '. esc_attr( $options['blog_post_title_font_style'] ) . ' ' . absint( $options['blog_post_title_font_size'] ) . 'px/1.3 ' . esc_attr( $options['blog_post_title_font_family'] ) . '; color: ' . esc_attr( $options['blog_post_title_color'] ) . '; color: ' . esc_attr( $options['blog_post_title_color'] ) . '; }' . PHP_EOL;
    $css .= '#post-listing article.post .post-title a + i { font-size: ' . absint( $options['blog_post_title_font_size'] ) . 'px; }' . PHP_EOL;
    $css .= 'article.post .post-title [class^="icon-"] { color: ' . esc_attr( $options['blog_post_title_color'] ) . '; }' . PHP_EOL;
    $css .= '#post-listing article.post .meta a, #post-listing article.post .meta { font: '. esc_attr( $options['blog_meta_font_style'] ) . ' ' . absint( $options['blog_meta_font_size'] ) . 'px/1.6 ' . esc_attr( $options['blog_meta_font_family'] ) . '; color: ' . esc_attr( $options['blog_meta_font_color'] ) . '; color: ' . esc_attr( $options['blog_meta_font_color'] ) . '; }' . PHP_EOL;
    $css .= '.entry-meta { font: ' . esc_attr( $options['meta_font_style'] ) . ' ' . absint( $options['meta_font_size'] ) . 'px/1.6 ' . esc_attr( $options['meta_font_family'] ) . '; }' . PHP_EOL;
    if(esc_attr( $options['custom_css_value'] ) != '') {
        $css .=  esc_attr( $options['custom_css_value'] ) . PHP_EOL;
    }
    return $css;
}
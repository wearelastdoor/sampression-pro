<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything until Primary Navigation
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
?>
<!doctype html>
<!--[if IE 6 ]>
<html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>
<html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>
<html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>
<html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
    <?php
    /**
     * Meta tags
     * sampression_meta hook
     * @hooked sampression_add_meta - 10
     */
    do_action('sampression_meta');
    /**
     * Add Title
     * sampression_title hook
     * @hooked sampression_add_title - 10
     */
    do_action('sampression_title');
    /**
     * Add Favicons
     * sampression_favicons hook
     * @hooked sampression_add_favicons - 10
     */
    do_action('sampression_favicons');
    /**
     * Added Pingback Url
     * sampression_links hook
     * @hooked sampression_add_links - 10
     */
    do_action('sampression_links');
    /**
     * Before </head> tag hook
     * sampression_before_head_tag hook
     * @hooked sampression_add_before_head_tag - 10
     */
    do_action('sampression_before_head_tag');
    wp_head();
    ?>
</head>
<body <?php body_class('top'); ?>>
<div id="wrapper">
<div id="inner-wrapper">
<header id="header">
    <div class="container">
        <div class="columns seven">
            <?php
            /**
             * Add Logo/Site title
             * sampression_logo hook
             * @hooked sampression_blog_title - 10
             */
            do_action('sampression_logo');
            ?>
            <div class="toggle-nav">
                <span class="ico-bar"></span>
                <span class="ico-bar"></span>
                <span class="ico-bar"></span>
            </div>
        </div>
        <div class="columns nine">
            <nav id="top-nav">
                <?php
                //Check if the Custom Navigation is available
                if (has_nav_menu('top-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'top-menu',
                        'container' => '',
                        'menu_class' => 'top-menu clearfix',
                        'depth' => 0, // set to 1 to disable dropdowns
                        'fallback_cb' => false
                    ));
                } else {
                    // Otherwise list the Pages
                    ?>
                    <ul class="top-menu clearfix">
                        <?php wp_list_pages('title_li=&depth=0'); ?>
                    </ul>
                <?php
                } ?>
            </nav>
            <div id="top-nav-mobile"></div>
            <!-- #top-nav -->
            <div id="interaction-sec" class="clearfix <?php echo getnoofclass(); ?>">
                <?php get_search_form(); ?>
                <ul class="sm-top">
                    <?php // Being Social
                    sampression_social_media_icons();
                    ?>
                </ul>
                <!-- .sm-top -->
            </div>
            <!-- #interaction-sec -->
        </div>
        <?php
        $header_image = get_header_image();
        if (!empty($header_image)) :
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url($header_image); ?>" class="header-image"
                     width="<?php echo get_custom_header()->width; ?>"
                     height="<?php echo get_custom_header()->height; ?>" alt=""/>
            </a>
        <?php endif;
        ?>
    </div>
</header>
<!-- #header -->

<!-- Filter the Post by Category: We are using Isotop (http://isotope.metafizzy.co/) for Filtering: An exquisite jQuery plugin for magical layouts -->
<?php if (is_home()): ?>
    <?php
    global $sampression_options_settings;
    ?>
    <span id="primary-nav-scroll"></span>
    <nav id="primary-nav">
        <div class="container">
            <a href="#" id="btn-nav-opt"><i class="icon-arrow-drop-down"></i><i class="icon-arrow-drop-up"></i></a>

            <div class="columns sixteen">
                <div class="nav-label"><?php _e('Filter By:', 'sampression'); ?></div>

                <ul class="nav-listing clearfix" data-color="<?php echo $sampression_options_settings['filter_by_color'] ?>">
                    <li><a href="#" data-filter="*"
                           class="selected"><span></span><?php _e('Show All', 'sampression'); ?></a></li>
                    <?php
                    /* to exclude some categories */
                    foreach (sampression_home_categories() as $cat):
                        $category = get_category_by_slug($cat);
                        ?>
                        <li><a href="javascript:void(0);" data-filter=".<?php echo $category->slug; ?>" id="<?php echo $category->slug; ?>" class="filter-data"><span></span><?php echo $category->name; ?></a></li>
                    <?php
                    endforeach;
                    ?>
                </ul>

                <!-- Check Viewport: If the normal design couldn't fit with viewport, the Categories will appear via CSS with Select Menu form -->
                <select name="get-cats" id="get-cats">
                    <option value="*"><?php _e('Show All', 'sampression'); ?></option>
                    <?php
                    foreach (sampression_home_categories() as $cat):
                        $category = get_category_by_slug($cat);
                        ?>
                        <option value=".<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>

            </div>
        </div>
        <!-- .container -->
    </nav> <!-- #primary-nav -->
<?php endif; ?>
<div id="content-wrapper">
<div class="container">
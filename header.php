<?php
/**
 * The header for our theme.
 *
 * @package Sampression
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php

//echo get_theme_mod( 'sampression_logo' );

?>
<div id="site-inner">
<div id="inner-wrapper">
<header id="header" class="full-width">
    <div class="container">
        <div class="columns five">
            <?php
            if( get_theme_mod( 'sampression_logo' ) && get_theme_mod( 'sampression_remove_logo' ) != 1 ) {
                ?>
                <a href="<?php bloginfo( 'wpurl' ) ?>" title="<?php bloginfo( 'name' ) ?>" rel="home" id="logo-area">
                    <img class="logo-img" src="<?php echo get_theme_mod( 'sampression_logo' ) ?>" alt="<?php bloginfo( 'name' ); ?>">
                </a>
                <?php
            } else {
                ?>
                <h1 id="site-title" class="site-title">
                    <a rel="home" title="<?php bloginfo( 'name' ) ?>" href="<?php bloginfo( 'wpurl' ) ?>"><?php bloginfo( 'name' ) ?></a>
                </h1>
                <?php
            }
            if( get_theme_mod( 'sampression_remove_tagline' ) != 1 ) {
            ?>
            <h2 id="site-description" class="site-description"><?php bloginfo( 'description' ) ?></h2>
            <?php } ?>
            <div class="toggle-nav">
                <span class="ico-bar"></span>
                <span class="ico-bar"></span>
                <span class="ico-bar"></span>
            </div>
        </div>
        <div class="columns seven">
            <?php if( get_theme_mod( 'sampression_remove_primary_nav' ) != 1 ) { ?>
            <nav id="top-nav">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container' => '',
                        'menu_class' => 'top-menu clearfix',
                        'fallback_cb' => 'sampression_page_menu'
                    )
                );
                ?>
            </nav>
            <!-- #top-nav-->
            <?php } ?>
            <div id="interaction-sec" class="clearfix socialzero">
                <?php sampression_social_media() ?>
                <?php
                if( get_theme_mod( 'sampression_remove_search' ) != 1 ) {
                    get_search_form();
                }
                ?>
            </div>
            <!-- #interaction-sec -->
        </div>
    </div>
    <?php
    if( get_theme_mod( 'sampression_remove_secondary_nav' ) != 1 ) {
        if ( has_nav_menu( 'secondary' ) ) {
            ?>
            <div class="center">
                <div class="trigger-nav">
                    <span class="ico-bar"></span>
                    <span class="ico-bar"></span>
                    <span class="ico-bar"></span>
                    <span>Menu</span>
                </div>
            </div>
            <nav id="full-width-nav">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'secondary',
                        'container_class' => 'container',
                        'menu_class' => 'top-menu clearfix',
                        'fallback_cb' => false
                    )
                );
                ?>
            </nav>
            <!-- #top-nav-->
            <?php
        }
    }
    ?>
    <div class="slider"><!-- container -->
        <?php
        if( get_theme_mod( 'sampression_use_revolution' ) != 1 ) {
            $header_image = get_header_image();
            if ( ! empty( $header_image ) ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
            <?php
            endif;
        } else {
            if ( ! is_customize_preview() ) {
                if( get_theme_mod( 'sampression_revolution_shortcode' ) ) {
                    echo do_shortcode( get_theme_mod( 'sampression_revolution_shortcode' ) );
                    //putRevSlider( get_theme_mod( 'sampression_revolution_shortcode' ) );
                }
            } else {
                if( get_theme_mod( 'sampression_revolution_shortcode' ) ) {
                    echo '<div class="revolution-dummy"><h3>Revolution Slider will disply here.</h3><small>Slider will be visible when you go to frontend.</small></div>';
                    echo '<style>.revolution-dummy {
                        background: #ccc none repeat scroll 0 0;
                        height: 150px;
                        padding: 50px;
                        text-align: center;
                    }
                    .revolution-dummy h3 {
                        font-size: 50px;
                    }
                    .revolution-dummy small {
                        font-size: 18px;
                    }
                    </style>';
                }
            }
        }
        ?>
    </div>
</header>
<!-- #header -->
<span id="primary-nav-scroll"></span>
<?php
if( is_home() ) { ?>
<nav id="primary-nav">
    <div class="container">
        <a href="#" id="btn-nav-opt">
            <i class="genericon-collapse"></i>
            <i class="genericon-expand"></i>
        </a>
        <div class="columns twelve">
            <div class="nav-label"><?php _e('Filter By:', 'sampression'); ?></div>
            <ul class="nav-listing clearfix" id="filter">
                <li><a href="javascript:void(0);" data-filter="*" class="selected"><span></span><?php _e('Show All', 'sampression'); ?></a></li>
                <?php
                $exclude_cats = sampression_exclude_categories();
                foreach( get_categories( array('exclude' => $exclude_cats ) ) as $category ) { ?>
                <li><a href="javascript:void(0);" data-filter=".<?php echo $category->slug ?>" id="<?php echo $category->slug ?>" class="filter-data"><span></span><?php echo $category->name ?></a></li>
                <?php } ?>
            </ul>

            <!-- Check Viewport: If the normal design couldn't fit with viewport, the Categories will appear via CSS with Select Menu form -->
            <select name="get-cats" id="get-cats">
                <option value="*">Show All</option>
                <?php foreach( get_categories() as $category ) { ?>
                <option value=".<?php echo $category->slug ?>"><?php echo $category->name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</nav>
<!-- #primary-nav -->
<?php } ?>
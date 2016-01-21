<?php

if (!defined('ABSPATH'))
    exit('restricted access');

/**
 * All the defaults value for Sampression Pro
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

global $sampression_option_defaults;
$sampression_option_defaults = array(
    'use_logo_title' => 'use_title',
    'logo_url' => SAM_PRO_ADMIN_IMAGES_URL . '/logo.png',
    'web_title_font' => 'Droid Serif',
    'web_title_size' => 27,
    'web_title_style' => '700',
    'web_title_color' => '#f36341',
    'use_web_desc' => 'yes',
    'web_desc_font' => 'Droid Serif',
    'web_desc_size' => 16,
    'web_desc_style' => '300',
    'web_desc_color' => '#8AB7AC',
    'donot_use_favicon_16' => 'yes',
    'favicon_url_16' => SAM_PRO_ADMIN_IMAGES_URL . '/sampression-16x16.png',
    'donot_use_apple_icon_57' => 'yes',
    'apple_icon_url_57' => SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-57x57.png',
    'donot_use_apple_icon_72' => 'yes',
    'apple_icon_url_72' => SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-72x72.png',
    'donot_use_apple_icon_114' => 'yes',
    'apple_icon_url_114' => SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-114x114.png',
    'donot_use_apple_icon_144' => 'yes',
    'apple_icon_url_144' => SAM_PRO_ADMIN_IMAGES_URL . '/apple-touch-icon-144x144.png',
    'donot_use_apple_icon' => 'yes',
    'show_background' => 'yes',
    'sidebar_active' => 'right',
    'column_active' => 'four',
    'body_font_family' => 'Arial, sans-serif',
    'body_font_size' => 12,
    'body_font_style' => 'normal',
    'body_font_color' => '#666666',
    'body_link_color' => '#8ab7ad',
    'nav_font_family' => 'Arial, sans-serif',
    'nav_font_size' => 12,
    'nav_font_style' => 'normal',
    'nav_font_color' => '#8ab7ad',
    'nav_font_color_hover' => '#666666',
    'link_font_family' => 'Arial, sans-serif',
    'link_font_size' => 12,
    'link_font_style' => 'normal',
    'link_font_color' => '#8ab7ad',
    'link_font_color_hover' => '#666666',
    'filter_by_color' => '#8ab7ad',
    'widget_header_font_family' => 'Droid Serif',
    'widget_header_font_size' => 20,
    'widget_header_font_style' => '700',
    'widget_header_font_color' => '#8ab7ad',
    'sticky_bgcolor' => '#8ab7ad',
    'button_bgcolor' => '#8ab7ad',
    'post_title_font_family' => 'Droid Serif',
    'post_title_font_size' => 20,
    'post_title_font_style' => '700',
    'post_title_font_color' => '#FF6600',
    'meta_font_family' => 'Arial, sans-serif',
    'meta_font_size' => 11,
    'meta_font_style' => 'normal',
    'meta_font_color' => '#9BB0AB',
    'blog_post_title_font_family' => 'Droid Serif',
    'blog_post_title_font_size' => 14,
    'blog_post_title_font_style' => '700',
    'blog_post_title_color' => '#FF6600',
    'blog_meta_font_family' => 'Arial, sans-serif',
    'blog_meta_font_size' => 11,
    'blog_meta_font_style' => 'normal',
    'blog_meta_font_color' => '#9BB0AB',
    'social_facebook_url' => '',
    'social_twitter_url' => '',
    'social_youtube_url' => '',
    'social_googleplus_url' => '',
    'social_linkedin_url' => '',
    'social_rss_url' => get_bloginfo('rss2_url'),
    'custom_css_value' => '',
    'show_meta_date' => 'yes',
    'show_meta_author' => 'yes',
    'show_meta_categories' => 'yes', 
    'show_meta_tags' => 'yes',
    'show_meta_comment_count' => 'yes',
    'category_posts_display' => '',
    'advanced_header_code' => '',
    'advanced_footer_code' => ''
);

global $sampression_options_settings;
$sampression_options_settings = sampression_options_set_defaults( $sampression_option_defaults );

function sampression_options_set_defaults( $sampression_option_defaults ) {
    $sampression_options_settings = array_merge( $sampression_option_defaults, (array) get_option( 'sampression_theme_options', array() ) );
    return $sampression_options_settings;
}

function sampression_fonts_style() {
    $fonts = array(
        'fonts' => array(
            'google-fonts' => array(
                'Kreon' => 'Kreon',
                'Droid Serif' => 'Droid Serif'
            ),
            'normal-fonts' => array(
                'Arial' => 'Arial, sans-serif',
                'Verdana' => 'Verdana, Geneva, sans-serif',
                'Trebuchet' => 'Trebuchet MS, Tahoma, sans-serif',
                'Georgia' => 'Georgia, serif',
                'Times New Roman' => 'Times New Roman, serif',
                'Tahoma' => 'Tahoma, Geneva, Verdana, sans-serif',
                'Impact' => 'Impact, Charcoal, sans-serif',
                'Courier' => 'Courier, Courier New, monospace',
                'Century Gothic' => 'Century Gothic, sans-serif'
            )
        ),
        'size' => array(
            'min_value' => 8,
            'max_value' => 72
        ),
        'style' => array(
            'Normal' => '400',
            'Normal/Italic' => 'italic 400',
            'Bold' => '700',
            'Bold/Italic' => 'italic 700'
        ),
        'transformation' => array(
            'Capitalize' => 'capitalize',
            'Uppercase' => 'uppercase',
            'Lowercase' => 'lowercase',
            'None' => 'none'
        )
    );
    return $fonts;
}

//Sidebar Options to chose for
function sampression_sidebar_options() {
    $sidebar_options = array( 'left', 'right', 'none' );
    return $sidebar_options;
}

//Sidebar Options to chose for
function sampression_column_options() {
    $column_options = array( 'one', 'two', 'three', 'four' );
    return $column_options;
}
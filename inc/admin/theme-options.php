<?php
/**
 * Main theme options page that validate user input and saved data.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );
    function sampression_theme_settings(){
        if (!isset($_REQUEST['settings-updated']))
        $_REQUEST['settings-updated'] = false;
        ?>  
        <!-- header -->
        <div id="sam-wrapper">
                <div id="header" class=" clearfix">
                    <div id="logo">
                        <h2><?php _e('Sampression Pro', 'sampression'); ?></h2>
                        <span class="tagline"><?php _e('Not just another responsive theme', 'sampression'); ?></span>
                    </div>
                    <div class="sam-version">
                        <span><?php _e('version 1.0', 'sampression'); ?></span>
                    </div>
                </div><!--end of #header-->
                
                <nav id="top-nav" class="clearfix">
                    <ul class="external-links">
                        <li><a href="<?php echo esc_url(__('http://www.sampression.com/themes/sampression-pro/#change-log', 'sampression')); ?>" target="_blank"><i class="icon-view-changes-log"></i><?php _e('VIEW CHANGE LOG', 'sampression'); ?></a></li>
                        <li><a href="<?php echo esc_url(__('http://www.docs.sampression.com/category/sampression-pro', 'sampression')); ?>" target="_blank"><i class="icon-theme-documentation"></i><?php _e('THEME DOCUMENTATION', 'sampression'); ?></a></li>
                        <li><a href="<?php echo esc_url(__('https://support.sampression.com/hc/en-us', 'sampression')); ?>" target="_blank"><i class="icon-support-desk"></i><?php _e('VISIT SUPPORT DESK', 'sampression'); ?></a></li>
                    </ul>
                </nav><!-- #top-nav-->
                
                <div id="sam-main-content" class="clearfix">
                    <?php sampression_message_info() ?>
                    <!-- sidebar -->
                    <div id="sidebar-nav">
                        <ul class="clearfix tabs" id="admin-menu">
                            <?php sampression_option_menu() ?>
                        </ul>
                    </div>
                    <div class="sam-saving-info"><?php echo _e('Please save your changes by clicking save button at the bottom', 'sampression'); ?></div>
                    <!-- content -->
                    <form method="post" action="options.php" enctype="multipart/form-data">
                        <div id="content">

                            <?php
                            settings_fields('sampression_options');
                            //print_r($options);
                            ?>
                            <div id="logos-icons" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-logos-icons'); ?>
                            </div>
                            <div id="styling" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-styling'); ?>
                            </div>
                            <div id="typography" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-typography'); ?>
                            </div>
                            <div id="social-media" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-social-media'); ?>
                            </div>
                            <div id="custom-css" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-custom-css'); ?>
                            </div>
                            <div id="blog" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-blog'); ?>
                            </div>
                            <div id="hooks" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-advanced'); ?>
                            </div>
                            <div id="import-export" class="tab_content">
                                <?php get_template_part(SAM_PRO_ADMIN_TPL_PART_DIR . 'sam-import-export'); ?>
                            </div>

                        </div> <!-- #content -->
                        <input name="reset" class="button4 sampression-restore" type="submit" value="Reset to theme default settings" >
                    </form>
                </div> <!-- #sam-main-content-->
            </div> <!-- #sam-wrapper -->    
                <?php
    }
    
function get_sampression_option($option_name) {
    
    global $sampression_options_settings;
    return $sampression_options_settings[$option_name];
    
}
    
function sampression_theme_validate( $options ) {
    global $sampression_options_settings, $sampression_option_defaults;
    
    $validated = $sampression_options_settings;
    $defaults = $sampression_option_defaults;
    
    $input = array();
    $input = $options;

    // Data Validation for Radio Button for chosing website logo or website name		
    if ( isset( $input[ 'use_logo_title' ] ) ) {
        $validated[ 'use_logo_title' ] = $input[ 'use_logo_title' ];
    }
    
    // Data Validation for Logo	Url	
    if ( isset( $input[ 'logo_url' ] ) ) {
        $validated[ 'logo_url' ] = esc_url_raw( $input[ 'logo_url' ] );
    }
    
    // Data Validation for Website Name Font Family
    if ( isset( $input[ 'web_title_font' ] ) ) {
        $validated[ 'web_title_font' ] = sanitize_text_field( $input[ 'web_title_font' ] );
    }
    
    // Data Validation for Website Name Font Size
    if ( isset( $input[ 'web_title_size' ] ) ) {
        $validated[ 'web_title_size' ] = absint( $input[ 'web_title_size' ] );
    }
    
     // Data Validation for Website Name Font Style
    if ( isset( $input[ 'web_title_style' ] ) ) {
        $validated[ 'web_title_style' ] = sanitize_text_field( $input[ 'web_title_style' ] );
    }
    
     // Data Validation for Website Name Font Color
    if ( isset( $input[ 'web_title_color' ] ) ) {
        $validated[ 'web_title_color' ] = sanitize_text_field( $input[ 'web_title_color' ] );
    }
    
     // Data Validation for checkbox for chosing website description
    if ( isset( $input[ 'use_web_desc' ] ) ) {
        $validated[ 'use_web_desc' ] = $input[ 'use_web_desc' ];
    }
    
     // Data Validation for Website description Font Family
    if ( isset( $input[ 'web_desc_font' ] ) ) {
        $validated[ 'web_desc_font' ] = sanitize_text_field( $input[ 'web_desc_font' ] );
    }
    
    // Data Validation for Website description Font Size
    if ( isset( $input[ 'web_desc_size' ] ) ) {
        $validated[ 'web_desc_size' ] = absint( $input[ 'web_desc_size' ] );
    }
    
     // Data Validation for Website description Font Style
    if ( isset( $input[ 'web_desc_style' ] ) ) {
        $validated[ 'web_desc_style' ] = sanitize_text_field( $input[ 'web_desc_style' ] );
    }
    
     // Data Validation for Website description Font Color
    if ( isset( $input[ 'web_desc_color' ] ) ) {
        $validated[ 'web_desc_color' ] = sanitize_text_field( $input[ 'web_desc_color' ] );
    }
    
     // Data Validation for checkbox for not using favicon icon
    if ( isset( $input[ 'donot_use_favicon_16' ] ) ) {
        $validated[ 'donot_use_favicon_16' ] = $input[ 'donot_use_favicon_16' ];
    }
    
     // Data Validation for favicon icon url
    if ( isset( $input[ 'favicon_url_16' ] ) ) {
        $validated[ 'favicon_url_16' ] = esc_url_raw( $input[ 'favicon_url_16' ] );
    }
    
    // Data Validation for checkbox for not using any apple touch icons
    if ( isset( $input[ 'donot_use_apple_icon' ] ) ) {
        $validated[ 'donot_use_apple_icon' ] = $input[ 'donot_use_apple_icon' ];
    }
    
    // Data Validation for checkbox for not using apple touch icons of size 57*57px
    if ( isset( $input[ 'donot_use_apple_icon_57' ] ) ) {
        $validated[ 'donot_use_apple_icon_57' ] = $input[ 'donot_use_apple_icon_57' ];
    }
    
     // Data Validation for apple touch icon url of size 57*57px
    if ( isset( $input[ 'apple_icon_url_57' ] ) ) {
        $validated[ 'apple_icon_url_57' ] = esc_url_raw( $input[ 'apple_icon_url_57' ] );
    }
    
    // Data Validation for checkbox for not using apple touch icons of size 72*72px
    if ( isset( $input[ 'donot_use_apple_icon_72' ] ) ) {
        $validated[ 'donot_use_apple_icon_72' ] = $input[ 'donot_use_apple_icon_72' ];
    }
    
     // Data Validation for apple touch icon url of size 72*72px
    if ( isset( $input[ 'apple_icon_url_72' ] ) ) {
        $validated[ 'apple_icon_url_72' ] = esc_url_raw( $input[ 'apple_icon_url_72' ] );
    }
    
    // Data Validation for checkbox for not using apple touch icons of size 114*114px
    if ( isset( $input[ 'donot_use_apple_icon_114' ] ) ) {
        $validated[ 'donot_use_apple_icon_114' ] = $input[ 'donot_use_apple_icon_114' ];
    }
    
     // Data Validation for apple touch icon url of size 114*114px
    if ( isset( $input[ 'apple_icon_url_114' ] ) ) {
        $validated[ 'apple_icon_url_114' ] = esc_url_raw( $input[ 'apple_icon_url_114' ] );
    }
    
    // Data Validation for checkbox for not using apple touch icons of size 144*144px
    if ( isset( $input[ 'donot_use_apple_icon_144' ] ) ) {
        $validated[ 'donot_use_apple_icon_144' ] = $input[ 'donot_use_apple_icon_144' ];
    }
    
     // Data Validation for apple touch icon url of size 144*144px
    if ( isset( $input[ 'apple_icon_url_144' ] ) ) {
        $validated[ 'apple_icon_url_144' ] = esc_url_raw( $input[ 'apple_icon_url_144' ] );
    }

    // Data validation for Content Wrapper Background show/hide
    if ( isset( $input[ 'show_background' ] ) ) {
        $validated[ 'show_background' ] = $input[ 'show_background' ];
    }
    
    // Data validation for sidebar selection whether right or none
    if ( isset( $input[ 'sidebar_active' ] ) ) {
        $validated[ 'sidebar_active' ] = $input[ 'sidebar_active' ];
    }
    
    // Data validation for column selection whether two, three or four
    if ( isset( $input[ 'column_active' ] ) ) {
        $validated[ 'column_active' ] = $input[ 'column_active' ];
    }
    
    // Data Validation for General body font family
    if ( isset( $input[ 'body_font_family' ] ) ) {
        $validated[ 'body_font_family' ] = sanitize_text_field( $input[ 'body_font_family' ] );
    }
    
    // Data Validation for General body font size
    if ( isset( $input[ 'body_font_size' ] ) ) {
        $validated[ 'body_font_size' ] = absint( $input[ 'body_font_size' ] );
    }
    
    // Data Validation for General body font color
    if ( isset( $input[ 'body_font_color' ] ) ) {
        $validated[ 'body_font_color' ] = sanitize_text_field( $input[ 'body_font_color' ] );
    }
    
    // Data Validation for General body font style
    if ( isset( $input[ 'body_font_style' ] ) ) {
        $validated[ 'body_font_style' ] = sanitize_text_field( $input[ 'body_font_style' ] );
    }

    // Data Validation for General body link color
    if ( isset( $input[ 'body_link_color' ] ) ) {
        $validated[ 'body_link_color' ] = sanitize_text_field( $input[ 'body_link_color' ] );
    }
    /*******************/
    // Data Validation for Navigation font family
    if ( isset( $input[ 'nav_font_family' ] ) ) {
        $validated[ 'nav_font_family' ] = sanitize_text_field( $input[ 'nav_font_family' ] );
    }

    // Data Validation for Navigation font size
    if ( isset( $input[ 'nav_font_size' ] ) ) {
        $validated[ 'nav_font_size' ] = absint( $input[ 'nav_font_size' ] );
    }

    // Data Validation for Navigation font color
    if ( isset( $input[ 'nav_font_color' ] ) ) {
        $validated[ 'nav_font_color' ] = sanitize_text_field( $input[ 'nav_font_color' ] );
    }

    // Data Validation for Navigation font style
    if ( isset( $input[ 'nav_font_style' ] ) ) {
        $validated[ 'nav_font_style' ] = sanitize_text_field( $input[ 'nav_font_style' ] );
    }

    // Data Validation for Navigation font color:hover
    if ( isset( $input[ 'nav_font_color_hover' ] ) ) {
        $validated[ 'nav_font_color_hover' ] = sanitize_text_field( $input[ 'nav_font_color_hover' ] );
    }
    /*******************/
    // Data Validation for Link font family
    if ( isset( $input[ 'link_font_family' ] ) ) {
        $validated[ 'link_font_family' ] = sanitize_text_field( $input[ 'link_font_family' ] );
    }

    // Data Validation for Link font size
    if ( isset( $input[ 'link_font_size' ] ) ) {
        $validated[ 'link_font_size' ] = absint( $input[ 'link_font_size' ] );
    }

    // Data Validation for Link font color
    if ( isset( $input[ 'link_font_color' ] ) ) {
        $validated[ 'link_font_color' ] = sanitize_text_field( $input[ 'link_font_color' ] );
    }

    // Data Validation for Link font style
    if ( isset( $input[ 'link_font_style' ] ) ) {
        $validated[ 'link_font_style' ] = sanitize_text_field( $input[ 'link_font_style' ] );
    }

    // Data Validation for Link font color:hover
    if ( isset( $input[ 'link_font_color_hover' ] ) ) {
        $validated[ 'link_font_color_hover' ] = sanitize_text_field( $input[ 'link_font_color_hover' ] );
    }
    /*******************/
    // Data Validation for Filter by color
    if ( isset( $input[ 'filter_by_color' ] ) ) {
        $validated[ 'filter_by_color' ] = sanitize_text_field( $input[ 'filter_by_color' ] );
    }
    /*******************/
    // Data Validation for Widget font family
    if ( isset( $input[ 'widget_header_font_family' ] ) ) {
        $validated[ 'widget_header_font_family' ] = sanitize_text_field( $input[ 'widget_header_font_family' ] );
    }

    // Data Validation for Widget font size
    if ( isset( $input[ 'widget_header_font_size' ] ) ) {
        $validated[ 'widget_header_font_size' ] = absint( $input[ 'widget_header_font_size' ] );
    }

    // Data Validation for Widget font color
    if ( isset( $input[ 'widget_header_font_color' ] ) ) {
        $validated[ 'widget_header_font_color' ] = sanitize_text_field( $input[ 'widget_header_font_color' ] );
    }

    // Data Validation for Widget font style
    if ( isset( $input[ 'widget_header_font_style' ] ) ) {
        $validated[ 'widget_header_font_style' ] = sanitize_text_field( $input[ 'widget_header_font_style' ] );
    }
    /*******************/
    // Data Validation for Sticky background color
    if ( isset( $input[ 'sticky_bgcolor' ] ) ) {
        $validated[ 'sticky_bgcolor' ] = sanitize_text_field( $input[ 'sticky_bgcolor' ] );
    }

    // Data Validation for Button background color
    if ( isset( $input[ 'button_bgcolor' ] ) ) {
        $validated[ 'button_bgcolor' ] = sanitize_text_field( $input[ 'button_bgcolor' ] );
    }
    /*******************/
     // Data Validation for post/page title font family
    if ( isset( $input[ 'post_title_font_family' ] ) ) {
        $validated[ 'post_title_font_family' ] = sanitize_text_field( $input[ 'post_title_font_family' ] );
    }
    
     // Data Validation for post/page title font size
    if ( isset( $input[ 'post_title_font_size' ] ) ) {
        $validated[ 'post_title_font_size' ] = absint( $input[ 'post_title_font_size' ] );
    }
    
    // Data Validation for Post Title Font Color
    if ( isset( $input[ 'post_title_font_color' ] ) ) {
        $validated[ 'post_title_font_color' ] = sanitize_text_field( $input[ 'post_title_font_color' ] );
    }
    
    // Data Validation for Post Title font style
    if ( isset( $input[ 'post_title_font_style' ] ) ) {
        $validated[ 'post_title_font_style' ] = sanitize_text_field( $input[ 'post_title_font_style' ] );
    }
    
     // Data Validation for meta text font family
    if ( isset( $input[ 'meta_font_family' ] ) ) {
        $validated[ 'meta_font_family' ] = sanitize_text_field( $input[ 'meta_font_family' ] );
    }
    
     // Data Validation for meta text font size
    if ( isset( $input[ 'meta_font_size' ] ) ) {
        $validated[ 'meta_font_size' ] = absint( $input[ 'meta_font_size' ] );
    }
    
    // Data Validation for meta Font Color
    if ( isset( $input[ 'meta_font_style' ] ) ) {
        $validated[ 'meta_font_style' ] = sanitize_text_field( $input[ 'meta_font_style' ] );
    }
    
    // Data Validation for Meta Font Color
    if ( isset( $input[ 'meta_font_color' ] ) ) {
        $validated[ 'meta_font_color' ] = sanitize_text_field( $input[ 'meta_font_color' ] );
    }
    
     // Data Validation for blog page post title font family
    if ( isset( $input[ 'blog_post_title_font_family' ] ) ) {
        $validated[ 'blog_post_title_font_family' ] = sanitize_text_field( $input[ 'blog_post_title_font_family' ] );
    }
    
     // Data Validation for blog page post title font size
    if ( isset( $input[ 'blog_post_title_font_size' ] ) ) {
        $validated[ 'blog_post_title_font_size' ] = absint( $input[ 'blog_post_title_font_size' ] );
    }
    
    // Data Validation for blog page post title font style
    if ( isset( $input[ 'blog_post_title_font_style' ] ) ) {
        $validated[ 'blog_post_title_font_style' ] = sanitize_text_field( $input[ 'blog_post_title_font_style' ] );
    }
    
    // Data Validation for blog  post title Font Color
    if ( isset( $input[ 'blog_post_title_color' ] ) ) {
        $validated[ 'blog_post_title_color' ] = sanitize_text_field( $input[ 'blog_post_title_color' ] );
    }
    
     // Data Validation for blog  post meta text font family
    if ( isset( $input[ 'blog_meta_font_family' ] ) ) {
        $validated[ 'blog_meta_font_family' ] = sanitize_text_field( $input[ 'blog_meta_font_family' ] );
    }
    
     // Data Validation for blog  post meta text font size
    if ( isset( $input[ 'blog_meta_font_size' ] ) ) {
        $validated[ 'blog_meta_font_size' ] = absint( $input[ 'blog_meta_font_size' ] );
    }
    
    // Data Validation for Blog  post meta Font style
    if ( isset( $input[ 'blog_meta_font_style' ] ) ) {
        $validated[ 'blog_meta_font_style' ] = sanitize_text_field( $input[ 'blog_meta_font_style' ] );
    }
    
    // Data Validation for Blog page post meta Font Color
    if ( isset( $input[ 'blog_meta_font_color' ] ) ) {
        $validated[ 'blog_meta_font_color' ] = sanitize_text_field( $input[ 'blog_meta_font_color' ] );
    }
    
    // Data Validation for meta text font size
    if ( isset( $input[ 'custom_css_value' ] ) ) {
        $validated[ 'custom_css_value' ] = wp_kses_stripslashes( $input[ 'custom_css_value' ] );
    }

    // Data validation for showing meta date option on post
    if ( isset( $input[ 'show_meta_date' ] ) ) {
        $validated[ 'show_meta_date' ] = $input[ 'show_meta_date' ];
    }
    
    // Data validation for showing meta time option on post
    if ( isset( $input[ 'show_meta_time' ] ) ) {
        $validated[ 'show_meta_time' ] = $input[ 'show_meta_time' ];
    }
    
    // Data validation for showing meta author option on post
    if ( isset( $input[ 'show_meta_author' ] ) ) {
        $validated[ 'show_meta_author' ] = $input[ 'show_meta_author' ];
    }
    
    // Data validation for showing meta categories option on post
    if ( isset( $input[ 'show_meta_categories' ] ) ) {
        $validated[ 'show_meta_categories' ] = $input[ 'show_meta_categories' ];
    }
    
    // Data validation for showing meta tags option on post
    if ( isset( $input[ 'show_meta_tags' ] ) ) {
        $validated[ 'show_meta_tags' ] = $input[ 'show_meta_tags' ];
    }
    
    // Data validation for showing meta comment count option on post
    if ( isset( $input[ 'show_meta_comment_count' ] ) ) {
        $validated[ 'show_meta_comment_count' ] = $input[ 'show_meta_comment_count' ];
    }
    
    // Data Validation for facebook url
    if ( isset( $input[ 'social_facebook_url' ] ) ) {
        $validated[ 'social_facebook_url' ] = esc_url_raw( $input[ 'social_facebook_url' ] );
    }
    
    // Data Validation for twitter url
    if ( isset( $input[ 'social_twitter_url' ] ) ) {
        $validated[ 'social_twitter_url' ] = esc_url_raw( $input[ 'social_twitter_url' ] );
    }
    
    // Data Validation for linkedin url
    if ( isset( $input[ 'social_googleplus_url' ] ) ) {
        $validated[ 'social_googleplus_url' ] = esc_url_raw( $input[ 'social_googleplus_url' ] );
    }
    
    // Data Validation for youtube url
    if ( isset( $input[ 'social_youtube_url' ] ) ) {
        $validated[ 'social_youtube_url' ] = esc_url_raw( $input[ 'social_youtube_url' ] );
    }

    // Data Validation for linkedin url
    if ( isset( $input[ 'social_linkedin_url' ] ) ) {
        $validated[ 'social_linkedin_url' ] = esc_url_raw( $input[ 'social_linkedin_url' ] );
    }

    // Data Validation for rss url
    if ( isset( $input[ 'social_rss_url' ] ) ) {
        $validated[ 'social_rss_url' ] = esc_url_raw( $input[ 'social_rss_url' ] );
    }
    
    // Data Validation for header code under advanced tab
    if ( isset( $input[ 'advanced_header_code' ] ) ) {
        $validated[ 'advanced_header_code' ] = wp_kses_stripslashes( $input[ 'advanced_header_code' ] );
    }
    
    // Data Validation for footer code under advanced tab
    if ( isset( $input[ 'advanced_footer_code' ] ) ) {
        $validated[ 'advanced_footer_code' ] = wp_kses_stripslashes( $input[ 'advanced_footer_code' ] );
    }

    /**
     * // Data validation for displaying post on blog page
     */
    $validated[ 'category_posts_display' ] = $input['category_posts_display'];

    return $validated;

}
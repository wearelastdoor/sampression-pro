<?php

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @since Sampression 2.0
 */
//return;
class Sampression_Customize {

	public static function register( $wp_customize ) {

        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

        $wp_customize->remove_section( 'title_tagline' );
        $wp_customize->remove_section( 'colors' );
        $wp_customize->remove_section( 'header_image' );
        $wp_customize->remove_section( 'background_image' );

        // Responsive Preview - Section
        $wp_customize->add_section( 'responsive_preview',
            array(
                'title' => __( 'Responsive Preview', 'sampression' ),
                'priority' => 10,
            )
        );
            $wp_customize->add_setting( 'sampression_preview' );
            $wp_customize->add_control(
                new Sampression_Responsive_Control( $wp_customize, 'sampression_preview',
                    array(
                        'section' => 'responsive_preview',
                    )
                )
            );

        // General Setting - Panel
        $wp_customize->add_panel( 'sampression_general_setting_panel', array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'General Setting', 'sampression' ),
            'description' => __( 'Description of what this panel does. Description of what this panel does. Description of what this panel does.', 'sampression' ),
        ) );

            // Site Title, Tagline, Site Icon - Section
            $wp_customize->add_section( 'title_tagline',
                array(
                    'title' => __( 'Site Identity', 'sampression' ),
                    'priority' => 1,
                    'panel' => 'sampression_general_setting_panel',
                )
            );

                // Website Logo - Setting
                $wp_customize->add_setting(
                    'sampression_logo', array( 'sanitize_callback' => 'sampression_sanitize_image' )
                );
                $wp_customize->add_control(
                    new WP_Customize_Image_Control( $wp_customize, 'sampression_logo',
                        array(
                            'label'    => __( 'Logo', 'sampression' ),
                            'section'  => 'title_tagline',
                            'settings' => 'sampression_logo',
                            'priority'    => 60,
                            'description' => 'We recommend logo sizes within 220px x 120px.'
                        )
                    )
                );

                // Remove Logo - Setting
                $wp_customize->add_setting( 'sampression_remove_logo', array('sanitize_callback' => 'sampression_sanitize_checkbox'));
                $wp_customize->add_control( 'sampression_remove_logo',
                    array(
                        'type' => 'checkbox',
                        'label' => __('Remove Logo?', 'sampression'),
                        'section' => 'title_tagline',
                        'priority'    => 61,
                    )
                );

                // Remove Tagline - Setting
                $wp_customize->add_setting( 'sampression_remove_tagline', array('sanitize_callback' => 'sampression_sanitize_checkbox'));
                $wp_customize->add_control( 'sampression_remove_tagline',
                        array(
                            'type' => 'checkbox',
                            'label' => __('Remove Tagline?', 'sampression'),
                            'section' => 'title_tagline',
                            'priority'    => 62,
                        )
                );

                // Copyright Text - Setting
                $wp_customize->add_setting( 'sampression_copyright_text', array('sanitize_callback' => 'sampression_sanitize_text'));
                $wp_customize->add_control( 'sampression_copyright_text',
                    array(
                        'label' => __('Copyright Text', 'sampression'),
                        'section' => 'title_tagline',
                        'priority'    => 63,
                        'type' => 'textarea'
                    )
                );

                // Remove Copyright Text - Setting
                $wp_customize->add_setting( 'sampression_remove_copyright_text', array('sanitize_callback' => 'sampression_sanitize_checkbox'));
                $wp_customize->add_control( 'sampression_remove_copyright_text',
                    array(
                        'label' => __('Remove Copyright Text?', 'sampression'),
                        'section' => 'title_tagline',
                        'priority'    => 64,
                        'type' => 'checkbox'
                    )
                );

                // Credit Text - Setting
                $wp_customize->add_setting( 'sampression_credit_text', array('sanitize_callback' => 'sampression_sanitize_text'));
                $wp_customize->add_control( 'sampression_credit_text',
                    array(
                        'label' => __('Credit Text', 'sampression'),
                        'section' => 'title_tagline',
                        'priority'    => 65,
                        'type' => 'textarea'
                    )
                );

                // Remove Credit Text - Setting
                $wp_customize->add_setting( 'sampression_remove_credit_text', array('sanitize_callback' => 'sampression_sanitize_checkbox'));
                $wp_customize->add_control( 'sampression_remove_credit_text',
                    array(
                        'label' => __('Remove Credit Text?', 'sampression'),
                        'section' => 'title_tagline',
                        'priority'    => 66,
                        'type' => 'checkbox'
                    )
                );

            // Background - Section
            $wp_customize->add_section( 'background_image',
                array(
                    'title' => __( 'Background', 'sampression' ),
                    'priority' => 2,
                    'panel' => 'sampression_general_setting_panel'
                )
            );

                // Background Image Cover - Setting
                $wp_customize->add_setting( 'sampression_background_cover', array('transport' => 'postMessage') );
                $wp_customize->add_control(
                    'sampression_background_cover',
                    array(
                        'type' => 'checkbox',
                        'label'    => __( 'Use Background as Cover', 'sampression' ),
                        'section'  => 'background_image',
                        'settings' => 'sampression_background_cover',
                        'priority'       => 10
                    )
                );

                // Background Color - Setting
                $wp_customize->add_setting( 'background_color', array(
                    'default' => get_theme_support( 'custom-background', 'default-color' ),
                    'theme_supports' => 'custom-background',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
                    'label' => __( 'Background Color' ),
                    'section' => 'background_image',
                    'priority' => 1
                ) ) );

            // Layout - Section
            $wp_customize->add_section( 'sampression_layout_section',
                array(
                    'title' => __( 'Layout', 'sampression' ),
                    'priority' => 3,
                    'panel' => 'sampression_general_setting_panel',
                )
            );

                // Website Layout - Setting
                $wp_customize->add_setting( 'website_layout', array(
                    'default' => 'fixed',
                    'sanitize_callback' => 'sampression_sanitize_select_radio',
                    //'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( 'website_layout', array(
                        'label' => __( 'Website Layout' ),
                        'section' => 'sampression_layout_section',
                        'settings' => 'website_layout',
                        'type' => 'radio',
                            'choices' => array(
                                'fixed' => __('Fixed', 'sampression'),
                                'full-width-layout' => __('Full Width', 'sampression'),
                            ),
                        'priority' => 1
                    )
                );

                // Sidebar Position - Setting
                $wp_customize->add_setting( 'sidebar_position', array(
                    'default' => 'right',
                    'sanitize_callback' => 'sampression_sanitize_select_radio',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( 'sidebar_position', array(
                        'label' => __( 'Inner Sidebar Position' ),
                        'description' => __( 'Sidebar on single page and single post.' ),
                        'section' => 'sampression_layout_section',
                        'settings' => 'sidebar_position',
                        'type' => 'radio',
                            'choices' => array(
                                'left' => __('Left', 'sampression'),
                                'right' => __('Right', 'sampression'),
                                'none' => __('None', 'sampression'),
                            ),
                        'priority' => 2
                    )
                );

                // Home Page Columns - Setting
                $wp_customize->add_setting( 'home_columns', array(
                    'default' => '4',
                    'sanitize_callback' => 'sampression_sanitize_select_radio',
                ) );
                $wp_customize->add_control( 'home_columns', array(
                        'label' => __( 'Home Columns' ),
                        'section' => 'sampression_layout_section',
                        'settings' => 'home_columns',
                        'type' => 'radio',
                            'choices' => array(
                                '1' => __('One', 'sampression'),
                                '2' => __('Two', 'sampression'),
                                '3' => __('Three', 'sampression'),
                                '4' => __('Four', 'sampression'),
                            ),
                        'priority' => 3
                    )
                );

                // Home Page Sidebar - Setting
                $wp_customize->add_setting( 'home_sidebar', array(
                    'default' => 'none',
                    'sanitize_callback' => 'sampression_sanitize_select_radio',
                ) );
                $wp_customize->add_control( 'home_sidebar', array(
                        'label' => __( 'Home Sidebar' ),
                        'section' => 'sampression_layout_section',
                        'settings' => 'home_sidebar',
                        'type' => 'radio',
                            'choices' => array(
                                'none' => __('None', 'sampression'),
                                'right' => __('Right', 'sampression'),
                                'left' => __('Left', 'sampression'),
                            ),
                        'priority' => 4
                    )
                );

                // Pagination - Setting
                $wp_customize->add_setting( 'page_navigation', array(
                    'default' => 'default',
                    'sanitize_callback' => 'sampression_sanitize_select_radio',
                ) );
                $wp_customize->add_control( 'page_navigation', array(
                        'label' => __( 'Pagination', 'sampression' ),
                        'description' => __( 'If you install WP-PageNavi - https://wordpress.org/plugins/wp-pagenavi/, system will use wp_pagenavi() function default.', 'sampression' ),
                        'section' => 'sampression_layout_section',
                        'settings' => 'page_navigation',
                        'type' => 'radio',
                            'choices' => array(
                                'default' => __('Default (Newer Posts / Older Posts)', 'sampression'),
                                'numeric' => __('Numeric', 'sampression'),
                            ),
                        'priority' => 5
                    )
                );

        // Header & Navigation - Panel
        $wp_customize->add_panel( 'sampression_header_nav_panel', array(
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'title' => __( 'Header & Navigation', 'sampression' ),
            'description' => __( 'Description of what this panel does.' ),
        ) );

            // Website Title & Tagline - Section
            $wp_customize->add_section( 'sampression_title_tag_section',
                array(
                    'title' => __( 'Website Title & Tagline', 'sampression' ),
                    'priority' => 11,
                    'panel' => 'sampression_header_nav_panel',
                )
            );

                // Website Title Font Family - Setting
                $wp_customize->add_setting( 'webtitle_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'webtitle_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 1, 
                        'description' => __('Select your desired font for Website Title.', 'sampression'),
                        'section' => 'sampression_title_tag_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'webtitle_font_family',
                        'label' => 'Website Title Font Family'
                ));

                // Website Title Font Size  - Setting
                $wp_customize->add_setting( 'webtitle_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'webtitle_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 2,
                        'settings' => 'webtitle_font_size',
                        'section'     => 'sampression_title_tag_section',
                        'label'       => 'Website Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 72,
                            'step'  => 1,
                        ),
                    )
                );

                // Title Font Style - Setting
                $wp_customize->add_setting( 'webtitle_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => 'all-caps',
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'webtitle_font_style',
                    array(
                        'priority'    => 3,
                        'settings' => 'webtitle_font_style',
                        'section'     => 'sampression_title_tag_section',
                        'label'       => 'Website Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Title Font Color - Setting
                $wp_customize->add_setting( 'webtitle_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'webtitle_font_color', array(
                    'label' => __( 'Title Font Color', 'sampression' ),
                    'section' => 'sampression_title_tag_section',
                    'settings' => 'webtitle_font_color',
                    'priority' => 4
                ) ) );

                // Website Tagline Font Family - Setting
                $wp_customize->add_setting( 'webtagline_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'webtagline_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 5,
                        'section' => 'sampression_title_tag_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'webtagline_font_family',
                        'label' => 'Website Tagline Font Family'
                ));

                // Website Tagline Font Size  - Setting
                $wp_customize->add_setting( 'webtagline_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'webtagline_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 6,
                        'settings' => 'webtagline_font_size',
                        'section'     => 'sampression_title_tag_section',
                        'label'       => 'Website Tagline Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 72,
                            'step'  => 1,
                        ),
                    )
                );

                // Website Tagline Font Style - Setting
                $wp_customize->add_setting( 'webtagline_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'webtagline_font_style',
                    array(
                        'priority'    => 7,
                        'settings' => 'webtagline_font_style',
                        'section'     => 'sampression_title_tag_section',
                        'label'       => 'Website Tagline Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Website Tagline Font Color - Setting
                $wp_customize->add_setting( 'webtagline_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'webtagline_font_color', array(
                    'label' => __( 'Tagline Font Color', 'sampression' ),
                    'section' => 'sampression_title_tag_section',
                    'settings' => 'webtagline_font_color',
                    'priority' => 8
                ) ) );


            // Primary Navigation - Section
            $wp_customize->add_section( 'sampression_primary_nav_section',
                array(
                    'title' => __( 'Primary Navigation', 'sampression' ),
                    'priority' => 12,
                    'panel' => 'sampression_header_nav_panel',
                )
            );

                // Remove Primary Navigation - Setting
                $wp_customize->add_setting( 'sampression_remove_primary_nav', array('sanitize_callback' => 'sampression_sanitize_checkbox'));
                $wp_customize->add_control( 'sampression_remove_primary_nav',
                    array(
                        'type' => 'checkbox',
                        'label' => __('Remove Primary Navigation?', 'sampression'),
                        'section' => 'sampression_primary_nav_section',
                        'priority'    => 1,
                    )
                );

                // Primary Navigation Font Family - Setting
                $wp_customize->add_setting( 'primarynav_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'primarynav_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 2,
                        'section' => 'sampression_primary_nav_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'primarynav_font_family',
                        'label' => 'Navigation Font Family'
                ));

                // Primary Navigation Font Size  - Setting
                $wp_customize->add_setting( 'primarynav_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'primarynav_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 3,
                        'settings' => 'primarynav_font_size',
                        'section'     => 'sampression_primary_nav_section',
                        'label'       => 'Navigation Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Primary Navigation Font Style - Setting
                $wp_customize->add_setting( 'primarynav_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'primarynav_font_style',
                    array(
                        'priority'    => 4,
                        'settings' => 'primarynav_font_style',
                        'section'     => 'sampression_primary_nav_section',
                        'label'       => 'Navigation Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Primary Navigatin Font Color - Setting
                $wp_customize->add_setting( 'primarynav_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primarynav_font_color', array(
                    'label' => __( 'Navigation Font Color', 'sampression' ),
                    'section' => 'sampression_primary_nav_section',
                    'settings' => 'primarynav_font_color',
                    'priority' => 5
                ) ) );

                // Primary Navigatin Font Color:Hover - Setting
                $wp_customize->add_setting( 'primarynav_font_color_hover', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primarynav_font_color_hover', array(
                    'label' => __( 'Navigation Font Color:Hover', 'sampression' ),
                    'section' => 'sampression_primary_nav_section',
                    'settings' => 'primarynav_font_color_hover',
                    'priority' => 6
                ) ) );

            // Social Media
            $wp_customize->add_section( 'sampression_social_section',
                array(
                    'title' => __( 'Social Media', 'sampression' ),
                    'priority' => 13,
                    'panel' => 'sampression_header_nav_panel',
                )
            );

                // Social Icon Color - Setting
                $wp_customize->add_setting( 'social_icon_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_icon_color', array(
                    'label' => __( 'Social Icon Color', 'sampression' ),
                    'section' => 'sampression_social_section',
                    'settings' => 'social_icon_color',
                    'priority' => 1
                ) ) );

                // Use Social Icon Default Color - Setting
                $wp_customize->add_setting( 'use_social_default_color', array('default' => 1, 'sanitize_callback' => 'sampression_sanitize_checkbox'));
                $wp_customize->add_control( 'use_social_default_color',
                    array(
                        'type' => 'checkbox',
                        'label' => __('Use Default Social Icon Color?', 'sampression'),
                        'section' => 'sampression_social_section',
                        'priority'    => 2,
                    )
                );

                // Facebook URL - Setting
                $wp_customize->add_setting( 'sampression_social_facebook', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_facebook',
                    array(
                        'label'    => __( 'Facebook link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_facebook',
                        'priority'    => 3,
                    )
                );

                // Twitter URL - Setting
                $wp_customize->add_setting( 'sampression_social_twitter', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_twitter',
                    array(
                        'label'    => __( 'Twitter link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_twitter',
                        'priority'    => 4,
                    )
                );

                // Youtube URL - Setting
                $wp_customize->add_setting( 'sampression_social_youtube', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_youtube',
                    array(
                        'label'    => __( 'Youtube link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_youtube',
                        'priority'    => 5,
                    )
                );

                // Google+ URL - Setting
                $wp_customize->add_setting( 'sampression_social_googleplus', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_googleplus',
                    array(
                        'label'    => __( 'Google+ link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_googleplus',
                        'priority'    => 6,
                    )
                );

                // Tumblr URL - Setting
                $wp_customize->add_setting( 'sampression_socials_tumblr', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control(
                    'sampression_socials_tumblr',
                    array(
                        'label'    => __( 'Tumblr link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_socials_tumblr',
                        'priority'    => 7,
                    )
                );

                // Pinterest URL - Setting
                $wp_customize->add_setting( 'sampression_social_pinterest', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_pinterest',
                    array(
                        'label'    => __( 'Pinterest link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_pinterest',
                        'priority'    => 8,
                    )
                );

                // Linkedin URL - Setting
                $wp_customize->add_setting( 'sampression_social_linkedin', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_linkedin',
                    array(
                        'label'    => __( 'Linkedin link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_linkedin',
                        'priority'    => 9,
                    )
                );

                // Github URL - Setting
                $wp_customize->add_setting( 'sampression_social_github', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_github',
                    array(
                        'label'    => __( 'Github link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_github',
                        'priority'    => 10,
                    )
                );

                // Instagram URL - Setting
                $wp_customize->add_setting( 'sampression_social_instagram', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_instagram',
                    array(
                        'label'    => __( 'Instagram link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_instagram',
                        'priority'    => 11,
                    )
                );

                // Flickr URL - Setting
                $wp_customize->add_setting( 'sampression_social_flickr', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_flickr',
                    array(
                        'label'    => __( 'Flickr link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_flickr',
                        'priority'    => 12,
                    )
                );

                // Vimeo URL - Setting
                $wp_customize->add_setting( 'sampression_social_vimeo', array('sanitize_callback' => 'esc_url_raw'));
                $wp_customize->add_control( 'sampression_social_vimeo',
                    array(
                        'label'    => __( 'Vimeo link', 'sampression' ),
                        'section'  => 'sampression_social_section',
                        'settings' => 'sampression_social_vimeo',
                        'priority'    => 13,
                    )
                );

            // Search Option - Section
            $wp_customize->add_section(
                'sampression_search_section',
                array(
                    'title' => __( 'Search Option', 'sampression' ),
                    'priority' => 14,
                    'panel' => 'sampression_header_nav_panel',
                )
            );

                // Remove search box - Setting
                $wp_customize->add_setting( 'sampression_remove_search', array('sanitize_callback' => 'sampression_sanitize_text'));
                $wp_customize->add_control( 'sampression_remove_search',
                        array(
                            'type' => 'checkbox',
                            'label' => __('Remove Search Box?', 'sampression'),
                            'section' => 'sampression_search_section',
                            'priority'    => 1,
                        )
                );

            // Secondary Navigation - Section
            $wp_customize->add_section( 'sampression_secondarynav_section',
                array(
                    'title' => __( 'Secondary Navigation', 'sampression' ),
                    'priority' => 15,
                    'panel' => 'sampression_header_nav_panel',
                )
            );

                // Remove Secondary Navigation - Setting
                $wp_customize->add_setting( 'sampression_remove_secondary_nav', array('sanitize_callback' => 'sampression_sanitize_text'));
                $wp_customize->add_control( 'sampression_remove_secondary_nav',
                        array(
                            'type' => 'checkbox',
                            'label' => __('Remove Secondary Navigation?', 'sampression'),
                            'section' => 'sampression_secondarynav_section',
                            'priority'    => 1,
                            'settings' => 'sampression_remove_secondary_nav'
                        )
                );

                // Full Width Navigation - Setting
                $wp_customize->add_setting( 'secondary_nav_fullwidth', array('default' => 1, 'sanitize_callback' => 'sampression_sanitize_text'));
                $wp_customize->add_control( 'secondary_nav_fullwidth',
                        array(
                            'type' => 'checkbox',
                            'label' => __('Full Width Navigation?', 'sampression'),
                            'section' => 'sampression_secondarynav_section',
                            'priority'    => 2,
                        )
                );

                // Full Width Navigation with Search Box - Setting
                $wp_customize->add_setting( 'sec_nav_fullwidth_withsearch', array('sanitize_callback' => 'sampression_sanitize_text'));
                $wp_customize->add_control( 'sec_nav_fullwidth_withsearch',
                        array(
                            'type' => 'checkbox',
                            'label' => __('Full Width Navigation with Search Box?', 'sampression'),
                            'section' => 'sampression_secondarynav_section',
                            'priority'    => 3,
                        )
                );

                // Secondary Navigation with Background color
                $wp_customize->add_setting( 'sec_nav_background_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sec_nav_background_color', array(
                    'label' => __( 'Background Color', 'sampression' ),
                    'section' => 'sampression_secondarynav_section',
                    'settings' => 'sec_nav_background_color',
                    'priority' => 4
                ) ) );

                // Secondary Navigation Font Family - Setting
                $wp_customize->add_setting( 'secondarynav_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'secondarynav_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 5,
                        'section' => 'sampression_secondarynav_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'secondarynav_font_family',
                        'label' => 'Navigation Font Family'
                ));

                // Secondary Navigation Font Size  - Setting
                $wp_customize->add_setting( 'secondarynav_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'secondarynav_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 6,
                        'settings' => 'secondarynav_font_size',
                        'section'     => 'sampression_secondarynav_section',
                        'label'       => 'Navigation Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Secondary Navigation Font Style - Setting
                $wp_customize->add_setting( 'secondarynav_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'secondarynav_font_style',
                    array(
                        'priority'    => 7,
                        'settings' => 'secondarynav_font_style',
                        'section'     => 'sampression_secondarynav_section',
                        'label'       => 'Navigation Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Secondary Navigatin Font Color - Setting
                $wp_customize->add_setting( 'secondarynav_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondarynav_font_color', array(
                    'label' => __( 'Navigation Font Color', 'sampression' ),
                    'section' => 'sampression_secondarynav_section',
                    'settings' => 'secondarynav_font_color',
                    'priority' => 8
                ) ) );

                // Secondary Navigation Font Color:Hover - Setting
                $wp_customize->add_setting( 'secondarynav_font_color_hover', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondarynav_font_color_hover', array(
                    'label' => __( 'Navigation Font Color:Hover', 'sampression' ),
                    'section' => 'sampression_secondarynav_section',
                    'settings' => 'secondarynav_font_color_hover',
                    'priority' => 9
                ) ) );

            // Banner Option - Section
            $wp_customize->add_section( 'header_image', array(
                'title'          => __( 'Banner Option', 'sampression' ),
                'theme_supports' => 'custom-header',
                'priority'       => 40,
                //'panel' => 'sampression_header_nav_panel'
            ) );

                // Use Revolution Slider - Setting
                $wp_customize->add_setting( 'sampression_use_revolution', array('sanitize_callback' => 'sampression_sanitize_checkbox'));
                $wp_customize->add_control( 'sampression_use_revolution',
                    array(
                        'type' => 'checkbox',
                        'label' => __('Use Revolution Slider?', 'sampression'),
                        'section' => 'header_image',
                        'priority'    => 11,
                    )
                );

                // Revolution Slider Shortcode - Setting
                $wp_customize->add_setting( 'sampression_revolution_shortcode', array('sanitize_callback' => 'sanitize_text_field'));
                $wp_customize->add_control( 'sampression_revolution_shortcode',
                    array(
                        'label' => __('Revolution Slider Shortcode', 'sampression'),
                        'section' => 'header_image',
                        'description' => 'You can find slider shortcode from Slider Revolution -> Slider Settings -> 2. Slider Title & Shordcode section. Slider shordcode looks like: [rev_slider alias="news-gallery2"]',
                        'priority'    => 12,
                        'settings' => 'sampression_revolution_shortcode'
                    )
                );
                
        // Typography - Panel
        $wp_customize->add_panel( 'sampression_typography_panel', array(
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'title' => __( 'Typography', 'sampression' ),
            'description' => __( 'Description of what this panel does.' ),
        ) );

            // Header Text - Section
            $wp_customize->add_section( 'sampression_headertext_section',
                array(
                    'title' => __( 'Header Text', 'sampression' ),
                    'priority' => 1,
                    'panel' => 'sampression_typography_panel',
                )
            );

                // Header Text Font Family - Setting
                $wp_customize->add_setting( 'headertext_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'headertext_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 1,
                        'section' => 'sampression_headertext_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'headertext_font_family',
                        'label' => 'Font Family'
                ));

                // Header Text Font Size  - Setting
                $wp_customize->add_setting( 'headertext_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'headertext_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 2,
                        'settings' => 'headertext_font_size',
                        'section'     => 'sampression_headertext_section',
                        'label'       => 'Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Header Text Font Style - Setting
                $wp_customize->add_setting( 'headertext_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'headertext_font_style',
                    array(
                        'priority'    => 3,
                        'settings' => 'headertext_font_style',
                        'section'     => 'sampression_headertext_section',
                        'label'       => 'Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Header Text Font Color - Setting
                $wp_customize->add_setting( 'headertext_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headertext_font_color', array(
                    'label' => __( 'Font Color', 'sampression' ),
                    'section' => 'sampression_headertext_section',
                    'settings' => 'headertext_font_color',
                    'priority' => 4
                ) ) );

                // Header Text Link Color - Setting
                $wp_customize->add_setting( 'headertext_link_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headertext_link_color', array(
                    'label' => __( 'Link Color', 'sampression' ),
                    'section' => 'sampression_headertext_section',
                    'settings' => 'headertext_link_color',
                    'priority' => 5
                ) ) );

            // Body Text - Section
            $wp_customize->add_section( 'sampression_bodytext_section',
                array(
                    'title' => __( 'Body Text', 'sampression' ),
                    'priority' => 1,
                    'panel' => 'sampression_typography_panel',
                )
            );

                // Body Text Font Family - Setting
                $wp_customize->add_setting( 'bodytext_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'bodytext_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 1,
                        'section' => 'sampression_bodytext_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'bodytext_font_family',
                        'label' => 'Font Family'
                ));

                // Body Text Font Size  - Setting
                $wp_customize->add_setting( 'bodytext_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'bodytext_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 2,
                        'settings' => 'bodytext_font_size',
                        'section'     => 'sampression_bodytext_section',
                        'label'       => 'Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Body Text Font Style - Setting
                $wp_customize->add_setting( 'bodytext_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'bodytext_font_style',
                    array(
                        'priority'    => 3,
                        'settings' => 'bodytext_font_style',
                        'section'     => 'sampression_bodytext_section',
                        'label'       => 'Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Body Text Font Color - Setting
                $wp_customize->add_setting( 'bodytext_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bodytext_font_color', array(
                    'label' => __( 'Font Color', 'sampression' ),
                    'section' => 'sampression_bodytext_section',
                    'settings' => 'bodytext_font_color',
                    'priority' => 4
                ) ) );

                // Body Text Link Color - Setting
                $wp_customize->add_setting( 'bodytext_link_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bodytext_link_color', array(
                    'label' => __( 'Link Color', 'sampression' ),
                    'section' => 'sampression_bodytext_section',
                    'settings' => 'bodytext_link_color',
                    'priority' => 5
                ) ) );


            // Filter By - Section
            $wp_customize->add_section( 'sampression_filterby_section',
                array(
                    'title' => __( 'Filter By', 'sampression' ),
                    'priority' => 3,
                    'panel' => 'sampression_typography_panel',
                )
            );

                // Filter By Icon Color - Setting
                $wp_customize->add_setting( 'filterby_icon_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'filterby_icon_color', array(
                    'label' => __( 'Icon Color', 'sampression' ),
                    'section' => 'sampression_filterby_section',
                    'settings' => 'filterby_icon_color',
                    'priority' => 1
                ) ) );

                // Filter By Font Family - Setting
                $wp_customize->add_setting( 'filterby_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'filterby_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 2,
                        'section' => 'sampression_filterby_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'filterby_font_family',
                        'label' => 'Font Family'
                ));

                // Filter By Font Size  - Setting
                $wp_customize->add_setting( 'filterby_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'filterby_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 3,
                        'settings' => 'filterby_font_size',
                        'section'     => 'sampression_filterby_section',
                        'label'       => 'Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Filter By Font Style - Setting
                $wp_customize->add_setting( 'filterby_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => 'underline',//italic,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'filterby_font_style',
                    array(
                        'priority'    => 4,
                        'settings' => 'filterby_font_style',
                        'section'     => 'sampression_filterby_section',
                        'label'       => 'Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Filter By Font Color - Setting
                $wp_customize->add_setting( 'filterby_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'filterby_font_color', array(
                    'label' => __( 'Font Color', 'sampression' ),
                    'section' => 'sampression_filterby_section',
                    'settings' => 'filterby_font_color',
                    'priority' => 5
                ) ) );

            // Meta Text - Section
            $wp_customize->add_section( 'sampression_metatext_section',
                array(
                    'title' => __( 'Meta Text', 'sampression' ),
                    'priority' => 4,
                    'panel' => 'sampression_typography_panel',
                )
            );

                // Meta Text Font Family - Setting
                $wp_customize->add_setting( 'metatext_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'metatext_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 1,
                        'section' => 'sampression_metatext_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'metatext_font_family',
                        'label' => 'Font Family'
                ));

                // Meta Text Font Size  - Setting
                $wp_customize->add_setting( 'metatext_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'metatext_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 2,
                        'settings' => 'metatext_font_size',
                        'section'     => 'sampression_metatext_section',
                        'label'       => 'Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Meta Text Font Style - Setting
                $wp_customize->add_setting( 'metatext_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'metatext_font_style',
                    array(
                        'priority'    => 3,
                        'settings' => 'metatext_font_style',
                        'section'     => 'sampression_metatext_section',
                        'label'       => 'Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Meta Text Font Color - Setting
                $wp_customize->add_setting( 'metatext_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'metatext_font_color', array(
                    'label' => __( 'Font Color', 'sampression' ),
                    'section' => 'sampression_metatext_section',
                    'settings' => 'metatext_font_color',
                    'priority' => 4
                ) ) );

                // Meta Text Link Color - Setting
                $wp_customize->add_setting( 'metatext_link_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'metatext_link_color', array(
                    'label' => __( 'Link Color', 'sampression' ),
                    'section' => 'sampression_metatext_section',
                    'settings' => 'metatext_link_color',
                    'priority' => 5
                ) ) );

            // Widget Text - Section
            $wp_customize->add_section( 'sampression_widgettext_section',
                array(
                    'title' => __( 'Widget Text', 'sampression' ),
                    'priority' => 5,
                    'panel' => 'sampression_typography_panel',
                )
            );

                // Widget Text Font Family - Setting
                $wp_customize->add_setting( 'widgettext_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'widgettext_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 1,
                        'section' => 'sampression_widgettext_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'widgettext_font_family',
                        'label' => 'Font Family'
                ));

                // Widget Text Font Size  - Setting
                $wp_customize->add_setting( 'widgettext_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'widgettext_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 2,
                        'settings' => 'widgettext_font_size',
                        'section'     => 'sampression_widgettext_section',
                        'label'       => 'Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Widget Text Font Style - Setting
                $wp_customize->add_setting( 'widgettext_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'widgettext_font_style',
                    array(
                        'priority'    => 3,
                        'settings' => 'widgettext_font_style',
                        'section'     => 'sampression_widgettext_section',
                        'label'       => 'Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Widget Text Font Color - Setting
                $wp_customize->add_setting( 'widgettext_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'widgettext_font_color', array(
                    'label' => __( 'Font Color', 'sampression' ),
                    'section' => 'sampression_widgettext_section',
                    'settings' => 'widgettext_font_color',
                    'priority' => 4
                ) ) );

                // Widget Text Link Color - Setting
                $wp_customize->add_setting( 'widgettext_link_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'widgettext_link_color', array(
                    'label' => __( 'Link Color', 'sampression' ),
                    'section' => 'sampression_widgettext_section',
                    'settings' => 'widgettext_link_color',
                    'priority' => 5
                ) ) );

            // Pagination Text - Section
            $wp_customize->add_section( 'sampression_paginationtext_section',
                array(
                    'title' => __( 'Pagination Text', 'sampression' ),
                    'priority' => 6,
                    'panel' => 'sampression_typography_panel',
                )
            );

                // Pagination Text Font Family - Setting
                $wp_customize->add_setting( 'paginationtext_font_family',
                    array(
                        'sanitize_callback' => 'sampression_sanitize_fonts',
                        'default' => 'Roboto+Slab:400,700=serif',
                        'transport' => 'postMessage'
                    )
                );
                $wp_customize->add_control( 'paginationtext_font_family',
                    array(
                        'type' => 'select',
                        'priority' => 1,
                        'section' => 'sampression_paginationtext_section',
                        'choices' => SELF::sampression_fonts(),
                        'settings' => 'paginationtext_font_family',
                        'label' => 'Font Family'
                ));

                // Pagination Text Font Size  - Setting
                $wp_customize->add_setting( 'paginationtext_font_size',
                        array(
                            'default' => 18,
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( 'paginationtext_font_size',
                    array(
                        'type'        => 'range',
                        'priority'    => 2,
                        'settings' => 'paginationtext_font_size',
                        'section'     => 'sampression_paginationtext_section',
                        'label'       => 'Font Size',
                        'input_attrs' => array(
                            'min'   => 12,
                            'max'   => 36,
                            'step'  => 1,
                        ),
                    )
                );

                // Pagination Text Font Style - Setting
                $wp_customize->add_setting( 'paginationtext_font_style',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'paginationtext_font_style',
                    array(
                        'priority'    => 3,
                        'settings' => 'paginationtext_font_style',
                        'section'     => 'sampression_paginationtext_section',
                        'label'       => 'Font Style',
                        'choices' => SELF::font_style()
                    ) )
                );

                // Pagination Text Font Color - Setting
                $wp_customize->add_setting( 'paginationtext_font_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'paginationtext_font_color', array(
                    'label' => __( 'Font Color', 'sampression' ),
                    'section' => 'sampression_paginationtext_section',
                    'settings' => 'paginationtext_font_color',
                    'priority' => 4
                ) ) );

                // Pagination Text Link Color:Hover - Setting
                $wp_customize->add_setting( 'paginationtext_font_color_hover', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'paginationtext_font_color_hover', array(
                    'label' => __( 'Font Color:Hover', 'sampression' ),
                    'section' => 'sampression_paginationtext_section',
                    'settings' => 'paginationtext_font_color_hover',
                    'priority' => 5
                ) ) );

            // Other Text - Section
            $wp_customize->add_section( 'sampression_othertext_section',
                array(
                    'title' => __( 'Other', 'sampression' ),
                    'priority' => 7,
                    'panel' => 'sampression_typography_panel',
                )
            );

                // Sticky Pin Color - Setting
                $wp_customize->add_setting( 'sticky_pin_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sticky_pin_color', array(
                    'label' => __( 'Sticky Pin Color', 'sampression' ),
                    'section' => 'sampression_othertext_section',
                    'settings' => 'sticky_pin_color',
                    'priority' => 1
                ) ) );

                // Button Background Color - Setting
                $wp_customize->add_setting( 'button_bg_color', array(
                    'default' => '#fe6e41',
                    'sanitize_callback' => 'sanitize_hex_color_no_hash',
                    'sanitize_js_callback' => 'maybe_hash_hex_color',
                    'transport' => 'postMessage'
                ) );
                $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_bg_color', array(
                    'label' => __( 'Button Background Color', 'sampression' ),
                    'section' => 'sampression_othertext_section',
                    'settings' => 'button_bg_color',
                    'priority' => 2
                ) ) );


            // Blog - Section
            $wp_customize->add_section( 'sampression_blog_section',
                array(
                    'title' => __( 'Blog', 'sampression' ),
                    'priority' => 60,
                )
            );

                // Show Post Meta - Setting
                $wp_customize->add_setting( 'hide_post_metas',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => '',//italic,underline
                            //'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Checkboxes_Control( $wp_customize, 'hide_post_metas',
                    array(
                        'priority' => 1,
                        'settings' => 'hide_post_metas',
                        'section' => 'sampression_blog_section',
                        'label' => 'Hide Post Meta',
                        'choices' => array(
                                'date' => 'Date',
                                'author' => 'Author',
                                'categories' => 'Categories',
                                'tags' => 'Tags',
                                'comment-count' => 'Comment Count',
                            )
                    ) )
                );

                // Post display - Setting
                $wp_customize->add_setting( 'categories_post_display',
                        array(
                            'sanitize_callback' => 'sampression_sanitize_checkboxes',
                            'default' => SELF::categories_lists(),
                            //'transport' => 'postMessage'
                        )
                    );
                $wp_customize->add_control( new Sampression_Categories_Control( $wp_customize, 'categories_post_display',
                    array(
                        'type' => 'categories',
                        'priority' => 2,
                        'settings' => 'categories_post_display',
                        'section' => 'sampression_blog_section',
                        'label' => 'Post Display',
                        'description' => 'Check to hide blog category on home page.',
                    ) )
                );

            // Custom CSS - Section
            $wp_customize->add_section(
                'sampression_customcss_panel',
                array(
                    'title' => __( 'Custom CSS', 'sampression' ),
                    'priority' => 70,
                    'capability' => 'edit_theme_options',
                )
            );

                // Custom CSS - Setting
                $wp_customize->add_setting(
                    'sampression_custom_css',
                    array(
                        'default' => '',
                        'type' => 'theme_mod',
                        'transport' => 'postMessage',
                        'sanitize_callback'    => 'wp_filter_nohtml_kses',
                        'sanitize_js_callback' => 'wp_filter_nohtml_kses',
                    )
                );
                $wp_customize->add_control(
                    new Sampression_CSS_Control( $wp_customize, 'sampression_blog_option',
                    array(
                        'type' => 'customcss',
                        'label' => __( 'Custom CSS', 'sampression' ),
                        'settings' => 'sampression_custom_css',
                        'section' => 'sampression_customcss_panel',
                        'description' => 'Custom CSS description to users.'
                    ))
                );

            // Custom code Section
            $wp_customize->add_section( 'sampression_custom_code_section' , array(
                'title' => __( 'Custom Code', 'sampression' ),
                'priority' => 80,
                'capability' => 'edit_theme_options',
            ));

                // Header Code Setting
                $wp_customize->add_setting( 'sampression_header_code', array('sanitize_callback' => 'sampression_sanitize_customcss','default' => ''));
                $wp_customize->add_control(
                    'sampression_header_code',
                    array(
                        'label'      => __( 'To insert into Header', 'sampression' ),
                        'description'      => __( 'Write/Paste the codes which you want to insert in Header. For eg. custom styles, scripts, etc. This will be inserted before the  &#060;/head&#062; tag in the header of the document.', 'sampression' ),
                        'section'    => 'sampression_custom_code_section',
                        'settings'   => 'sampression_header_code',
                        'type'       => 'textarea',
                    )
                );

                // Footer Code Setting
                $wp_customize->add_setting( 'sampression_footer_code', array('sanitize_callback' => 'sampression_sanitize_customcss','default' => ''));
                    $wp_customize->add_control(
                    'sampression_footer_code',
                    array(
                        'label'      => __( 'To insert into Footer', 'sampression' ),
                        'description' => __('Write/Paste the codes which you want to insert in Footer. For eg. custom styles, scripts, etc. This will be inserted before the  &#060;/body&#062; tag in the footer of the document.', 'sampression'),
                        'section'    => 'sampression_custom_code_section',
                        'settings'   => 'sampression_footer_code',
                        'type'       => 'textarea',
                    )
                );





























        // $wp_customize->add_setting( 'title_font',
        //     array(
        //         'sanitize_callback' => 'sampression_sanitize_select_radio',
        //         'default' => 'Roboto+Slab:400,700=serif',
        //         'transport' => 'postMessage'
        // ));
        
        // $wp_customize->add_control( 'title_font',
        //     array(
        //         'type' => 'select',
        //         'priority' => 0, 
        //         'description' => __('Select your desired font for the Title.', 'sampression'),
        //         'section' => 'title_tagline',
        //         'choices' => SELF::sampression_fonts(),
        //         'settings' => 'title_font',
        //         'label' => 'Header Text Font'
        // ));

    }

    public static function categories_lists() {
        foreach( get_categories() as $category ) {
            $data[] = $category->slug."=".$category->count;
        }
        return $data_str = implode( '&', $data );
    }

    public static function font_style() {
        return $font_style = array(
            'bold'   => 'Bold',
            'italic'   => 'Italic',
            'all-caps'   => 'All Caps',
            'underline'   => 'Underline',
        );
    }

	public static function customizer_js() {
        //wp_enqueue_script( 'sampression_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery' ), '1.0', true  );
		wp_enqueue_script( 'sampression_customizer', get_template_directory_uri() . '/js/customizer-preview.js', array( 'jquery' ), '1.0', true  );
	}

	public static function customize_controls_js() {
        wp_enqueue_style( 'sampression_customizer', get_template_directory_uri() . '/css/customizer.control.css' );
		wp_enqueue_script( 'sampression_customizer', get_template_directory_uri() . '/js/customizer.control.js', array( 'jquery' ), '1.0', true  );
	}

    public static function sampression_fonts() {
        return $google_fonts = array(
            'Playfair+Display:400,400italic,700,700italic=serif' => 'Playfair Display',
            'Work+Sans:400,700=sans-serif' => 'Work Sans',
            'Alegreya:400,400italic,700,700italic=serif' => 'Alegreya',
            'Alegreya+Sans:400,400italic,700,700italic=sans-serif' => 'Alegreya Sans',
            'Fira+Sans:400,400italic,700,700italic=sans-serif' => 'Fira Sans',
            'Droid+Sans:400,700=sans-serif' => 'Droid Sans',
            'Source+Sans+Pro:400,400italic,700,700italic=sans-serif' => 'Source Sans Pro',
            'Source+Serif+Pro:400,700=serif' => 'Source Serif Pro',
            'Lora:400,400italic,700,700italic=serif' => 'Lora',
            'Neuton:400,400italic,700,800=serif' => 'Neuton',
            'Poppins:400,700=sans-serif' => 'Poppins',
            'Karla:400,400italic,700,700italic=sans-serif' => 'Karla',
            'Merriweather:400,400italic,700,700italic=serif' => 'Merriweather',
            'Open+Sans:400,400italic,700,700italic=sans-serif' => 'Open Sans',
            'Roboto:400,400italic,700,700italic=sans-serif' => 'Roboto',
            'Roboto+Slab:400,700=serif' => 'Roboto Slab',
            'Lato:400,400italic,700,700italic=sans-serif' => 'Lato',
            'Droid+Serif:400,400italic,700,700italic=serif' => 'Droid Serif',
            'Archivo+Narrow:400,400italic,700,700italic=sans-serif' => 'Archivo Narrow',
            'Libre+Baskerville:400,700=serif' => 'Libre Baskerville',
            'Crimson+Text:400,400italic,700,700italic=serif' => 'Crimson Text',
            'Montserrat:400,700=sans-serif' => 'Montserrat',
            'Chivo:400,400italic=sans-serif' => 'Chivo',
            'Old+Standard+TT:400,400italic=serif' => 'Old Standard TT',
            'Domine:400,700=serif' => 'Domine',
            'Varela+Round=sans-serif' => 'Varela Round',
            'Bitter:400,400italic=serif' => 'Bitter',
            'Cardo:400,400italic=serif' => 'Cardo',
            'Arvo:400,400italic,700,700italic=serif' => 'Arvo',
            'PT+Serif:400,400italic,700,700italic=serif' => 'PT Serif',
            'Passion+One:400,700=cursive' => 'Passion One',
            'Poiret+One=cursive' => 'Poiret One',
            'Pacifico=cursive' => 'Pacifico',
            'Dancing+Script:400,700=cursive' => 'Dancing Script',
            'Kaushan+Script=cursive' => 'Kaushan Script',
            'Satisfy=cursive' => 'Satisfy',
            'Courgette=cursive' => 'Courgette',
            'Cookie=cursive' => 'Cookie',
            'Tangerine:400,700=cursive' => 'Tangerine',
            'Bad+Script=cursive' => 'Bad Script',
            'Calligraffitti=cursive' => 'Calligraffitti',
            'Sacramento=cursive' => 'Sacramento',
            'Nixie+One=cursive' => 'Nixie One',
            'Parisienne=cursive' => 'Parisienne',
            'Life+Savers:400,700=cursive' => 'Life Savers',
            'Special+Elite=cursive' => 'Special Elite',
            'Cutive=serif' => 'Cutive',
            'Cutive+Mono=serif' => 'Cutive Mono',
            'Josefin+Sans:400,400italic,700,700italic=sans-serif' => 'Josefin Sans',
            'Josefin+Slab:400,400italic,700,700italic=serif' => 'Josefin Slab',
        );
    }
    /*
    
     */

}

//Sanitizes Fonts 
function sampression_sanitize_fonts( $input ) {  
    $valid = array(
        'Playfair+Display:400,400italic,700,700italic=serif' => 'Playfair Display',
        'Work+Sans:400,700=sans-serif' => 'Work Sans',
        'Alegreya:400,400italic,700,700italic=serif' => 'Alegreya',
        'Alegreya+Sans:400,400italic,700,700italic=sans-serif' => 'Alegreya Sans',
        'Fira+Sans:400,400italic,700,700italic=sans-serif' => 'Fira Sans',
        'Droid+Sans:400,700=sans-serif' => 'Droid Sans',
        'Source+Sans+Pro:400,400italic,700,700italic=sans-serif' => 'Source Sans Pro',
        'Source+Serif+Pro:400,700=serif' => 'Source Serif Pro',
        'Lora:400,400italic,700,700italic=serif' => 'Lora',
        'Neuton:400,400italic,700,800=serif' => 'Neuton',
        'Poppins:400,700=sans-serif' => 'Poppins',
        'Karla:400,400italic,700,700italic=sans-serif' => 'Karla',
        'Merriweather:400,400italic,700,700italic=serif' => 'Merriweather',
        'Open+Sans:400,400italic,700,700italic=sans-serif' => 'Open Sans',
        'Roboto:400,400italic,700,700italic=sans-serif' => 'Roboto',
        'Roboto+Slab:400,700=serif' => 'Roboto Slab',
        'Lato:400,400italic,700,700italic=sans-serif' => 'Lato',
        'Droid+Serif:400,400italic,700,700italic=serif' => 'Droid Serif',
        'Archivo+Narrow:400,400italic,700,700italic=sans-serif' => 'Archivo Narrow',
        'Libre+Baskerville:400,700=serif' => 'Libre Baskerville',
        'Crimson+Text:400,400italic,700,700italic=serif' => 'Crimson Text',
        'Montserrat:400,700=sans-serif' => 'Montserrat',
        'Chivo:400,400italic=sans-serif' => 'Chivo',
        'Old+Standard+TT:400,400italic=serif' => 'Old Standard TT',
        'Domine:400,700=serif' => 'Domine',
        'Varela+Round=sans-serif' => 'Varela Round',
        'Bitter:400,400italic=serif' => 'Bitter',
        'Cardo:400,400italic=serif' => 'Cardo',
        'Arvo:400,400italic,700,700italic=serif' => 'Arvo',
        'PT+Serif:400,400italic,700,700italic=serif' => 'PT Serif',
        'Passion+One:400,700=cursive' => 'Passion One',
        'Poiret+One=cursive' => 'Poiret One',
        'Pacifico=cursive' => 'Pacifico',
        'Dancing+Script:400,700=cursive' => 'Dancing Script',
        'Kaushan+Script=cursive' => 'Kaushan Script',
        'Satisfy=cursive' => 'Satisfy',
        'Courgette=cursive' => 'Courgette',
        'Cookie=cursive' => 'Cookie',
        'Tangerine:400,700=cursive' => 'Tangerine',
        'Bad+Script=cursive' => 'Bad Script',
        'Calligraffitti=cursive' => 'Calligraffitti',
        'Sacramento=cursive' => 'Sacramento',
        'Nixie+One=cursive' => 'Nixie One',
        'Parisienne=cursive' => 'Parisienne',
        'Life+Savers:400,700=cursive' => 'Life Savers',
        'Special+Elite=cursive' => 'Special Elite',
        'Cutive=serif' => 'Cutive',
        'Cutive+Mono=serif' => 'Cutive Mono',
        'Josefin+Sans:400,400italic,700,700italic=sans-serif' => 'Josefin Sans',
        'Josefin+Slab:400,400italic,700,700italic=serif' => 'Josefin Slab',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function sampression_sanitize_customcss( $input ) {

    $allowed_html = array(
        'style' => array(
            'id' => array(),
            'type' => array()
        ),
        'script' => array(
            'src' => array(),
            'type' => array()
        ),
        'link' => array(
            'rel' => array(),
            'id' => array(),
            'href' => array(),
            'media' => array(),
            'type' => array()
        ),
    );
    return wp_kses($input, $allowed_html);

}

function sampression_sanitize_checkboxes( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Sanitization callback for 'select' and 'radio' type controls
 * @param  string $input   Slug to sanitize.
 * @param  WP_Customize_Setting $setting Setting instance
 * @return string           Sanitized slug if it is a valid choice; otherwise, the setting default
 */
function sampression_sanitize_select_radio( $input, $setting ) {
    
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitization callback for checkbox as a boolean value, either TRUE or FALSE.
 * @param  bool $checked Whether the checkbox is checked
 * @return bool          Whether the checkbox is checked
 */
function sampression_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitazation callback for textarea as allowed HTML tags for post content
 * @param  string $input Content to filter
 * @return string        Filtered content
 */
function sampression_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default
 * @param  string 				$image   	Image File Path
 * @param  WP_Customize_Setting $setting 	Setting Instance
 * @return string 							Image file path if the extension is allowed; otherwise, the setting default
 */
function sampression_sanitize_image( $image, $setting ) {
	$mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
    $file = wp_check_filetype( $image, $mimes );
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Generate Custom CSS on front-end
 */
if( ! function_exists( 'sampression_custom_css_add' ) ) {

    function sampression_custom_css_add(){
        echo PHP_EOL .'<style id="sampression-custom-css">'. PHP_EOL . esc_textarea(get_theme_mod( 'sampression_custom_css', '' )) . PHP_EOL . '</style>' .PHP_EOL;
    }

}

/**
 * Setup the Theme Customizer settings and controls for Sampression
 */
add_action( 'customize_register' , array( 'Sampression_Customize' , 'register' ) );
add_action( 'customize_preview_init', array('Sampression_Customize', 'customizer_js' ) );
add_action( 'customize_controls_enqueue_scripts', array('Sampression_Customize', 'customize_controls_js' ) );
add_action( 'wp_head', 'sampression_custom_css_add', 1000 );


/**
 * Google Fonts Bookmark URL
 *
 * https://www.google.com/fonts#UsePlace:use/Collection:Playfair+Display:400,400italic,700,700italic|Work+Sans:400,700|Alegreya:400,400italic,700,700italic|Alegreya+Sans:400,400italic,700,700italic|Fira+Sans:400,400italic,700,700italic|Droid+Sans:400,700|Source+Sans+Pro:400,400italic,700,700italic|Source+Serif+Pro:400,700|Lora:400,400italic,700,700italic|Neuton:400,400italic,700,800|Poppins:400,700|Karla:400,400italic,700,700italic|Merriweather:400,400italic,700,700italic|Open+Sans:400,400italic,700,700italic|Roboto:400,400italic,700,700italic|Roboto+Slab:400,700|Lato:400,400italic,700,700italic|Droid+Serif:400,400italic,700,700italic|Archivo+Narrow:400,400italic,700,700italic|Libre+Baskerville:400,700|Crimson+Text:400,400italic,700,700italic|Montserrat:400,700|Chivo:400,400italic|Old+Standard+TT:400,400italic|Domine:400,700|Varela+Round|Bitter:400,400italic|Cardo:400,400italic|Arvo:400,400italic,700,700italic|PT+Serif:400,400italic,700,700italic|Passion+One:400,700|Poiret+One|Pacifico|Dancing+Script:400,700|Kaushan+Script|Satisfy|Courgette|Cookie|Tangerine:400,700|Bad+Script|Calligraffitti|Sacramento|Nixie+One|Parisienne|Life+Savers:400,700|Special+Elite|Cutive|Cutive+Mono|Josefin+Sans:400,400italic,700,700italic|Josefin+Slab:400,400italic,700,700italic
 *
 *
'Playfair+Display:400,400italic,700,700italic=serif' => 'Playfair Display',
'Work+Sans:400,700=sans-serif' => 'Work Sans',
'Alegreya:400,400italic,700,700italic=serif' => 'Alegreya',
'Alegreya+Sans:400,400italic,700,700italic=sans-serif' => 'Alegreya Sans',
'Fira+Sans:400,400italic,700,700italic=sans-serif' => 'Fira Sans',
'Droid+Sans:400,700=sans-serif' => 'Droid Sans',
'Source+Sans+Pro:400,400italic,700,700italic=sans-serif' => 'Source Sans Pro',
'Source+Serif+Pro:400,700=serif' => 'Source Serif Pro',
'Lora:400,400italic,700,700italic=serif' => 'Lora',
'Neuton:400,400italic,700,800=serif' => 'Neuton',
'Poppins:400,700=sans-serif' => 'Poppins',
'Karla:400,400italic,700,700italic=sans-serif' => 'Karla',
'Merriweather:400,400italic,700,700italic=serif' => 'Merriweather',
'Open+Sans:400,400italic,700,700italic=sans-serif' => 'Open Sans',
'Roboto:400,400italic,700,700italic=sans-serif' => 'Roboto',
'Roboto+Slab:400,700=serif' => 'Roboto Slab',
'Lato:400,400italic,700,700italic=sans-serif' => 'Lato',
'Droid+Serif:400,400italic,700,700italic=serif' => 'Droid Serif',
'Archivo+Narrow:400,400italic,700,700italic=sans-serif' => 'Archivo Narrow',
'Libre+Baskerville:400,700=serif' => 'Libre Baskerville',
'Crimson+Text:400,400italic,700,700italic=serif' => 'Crimson Text',
'Montserrat:400,700=sans-serif' => 'Montserrat',
'Chivo:400,400italic=sans-serif' => 'Chivo',
'Old+Standard+TT:400,400italic=serif' => 'Old Standard TT',
'Domine:400,700=serif' => 'Domine',
'Varela+Round=sans-serif' => 'Varela Round',
'Bitter:400,400italic=serif' => 'Bitter',
'Cardo:400,400italic=serif' => 'Cardo',
'Arvo:400,400italic,700,700italic=serif' => 'Arvo',
'PT+Serif:400,400italic,700,700italic=serif' => 'PT Serif',
'Passion+One:400,700=cursive' => 'Passion One',
'Poiret+One=cursive' => 'Poiret One',
'Pacifico=cursive' => 'Pacifico',
'Dancing+Script:400,700=cursive' => 'Dancing Script',
'Kaushan+Script=cursive' => 'Kaushan Script',
'Satisfy=cursive' => 'Satisfy',
'Courgette=cursive' => 'Courgette',
'Cookie=cursive' => 'Cookie',
'Tangerine:400,700=cursive' => 'Tangerine',
'Bad+Script=cursive' => 'Bad Script',
'Calligraffitti=cursive' => 'Calligraffitti',
'Sacramento=cursive' => 'Sacramento',
'Nixie+One=cursive' => 'Nixie One',
'Parisienne=cursive' => 'Parisienne',
'Life+Savers:400,700=cursive' => 'Life Savers',
'Special+Elite=cursive' => 'Special Elite',
'Cutive=serif' => 'Cutive',
'Cutive+Mono=serif' => 'Cutive Mono',
'Josefin+Sans:400,400italic,700,700italic=sans-serif' => 'Josefin Sans',
'Josefin+Slab:400,400italic,700,700italic=serif' => 'Josefin Slab',
 */
<?php
/**
 * Logos and Icons tab of Theme Options.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );
$default_fonts = (object) sampression_fonts_style();
global $sampression_options_settings;
$options = $sampression_options_settings;
?>
        <section class="row sam-logooption">
            <h3 class="sec-title"><?php echo _e( 'Logos &amp; Icons', 'sampression' ); ?></h3>
            <div class="sam-section-wrapper clearfix">
                <div class="box titled-box col first-child">
                    <?php
                    if($options['use_logo_title'] == 'use_title') {
                        echo '<div class="overlay-box weblogo"></div>';
                    }
                    ?>
                    <div  class="box-title">
                        <div class="sam-radio clearfix">
                            <input id="sam-use-logo" type="radio" value="use_logo" name="sampression_theme_options[use_logo_title]" <?php checked( $options['use_logo_title'], 'use_logo' );  ?>>
                            <label for="sam-use-logo"><?php echo _e( 'Website Logo', 'sampression' ); ?></label>
                        </div>
                    </div>
                    <div class="box-entry clearfix">
                        <figure class="image-holder image-preview">
                            <img src="<?php echo $options['logo_url']; ?>" alt="Sampression" id="website-image-preview" />
                        </figure>
                        <div class="backgroundimage-option alignleft">
                            <div class="image-title" id="website-image-title"><?php echo sampression_truncate_text( basename( esc_url( $options['logo_url'] ) ) ); ?></div>
                            <div class="fileUpload button1 button2">
                                <span><?php _e( 'Change', 'sampression' );?></span>
                                <input type="hidden" id="website_image" class="upload_image" name="sampression_theme_options[logo_url]" value="<?php echo esc_url( $options['logo_url'] ); ?>" />
                                <input type="button" id="websiteimage" name="websiteimage" class="upload_image_button" />
                            </div>
                        </div>
                        <div class="alignleft sam-section-detail">
                            <p><?php echo _e('Website logo must be 340px x 75px<br>jpg, png, gif are supported.', 'sampression'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="box titled-box col">
                    <?php
                    $fonts = $default_fonts->fonts;
                    $size = $default_fonts->size;
                    $style = $default_fonts->style;

                    if($options['use_logo_title'] == 'use_logo') {
                        echo '<div class="overlay-box webtitle"></div>';
                    }
                    ?>
                    <div  class="box-title">
                        <div class="sam-radio clearfix">
                            <input id="sam-use-title" type="radio" value="use_title" name="sampression_theme_options[use_logo_title]" <?php checked( $options['use_logo_title'], 'use_title' ); ?>>
                            <label for="sam-use-title"><?php echo _e( 'Website Title', 'sampression' ); ?></label>
                        </div>
                    </div>
                    <div class="box-entry sam-add-border"><?php //echo $logo_icon_active['color'] ?>
                        <div class="sam-site-title font-demo" style="font: <?php echo esc_attr( $options['web_title_style'] ); ?> <?php echo absint( $options['web_title_size'] ); ?>px <?php echo esc_attr( $options['web_title_font'] ); ?>; color: <?php echo esc_attr( $options['web_title_color'] ); ?>;<?php if($options['web_title_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php echo get_bloginfo('name') ? get_bloginfo('name') : _e( 'Sampression', 'sampression' ); ?></div>
                        <div class="select-wrapper font-face medium-select alignleft" >
                            <?php sampression_font_select( 'sampression_theme_options[web_title_font]', 'sam-select change-site-fontface', esc_attr( $options['web_title_font'] ) ) ?>
                        </div>
                        <div class="select-wrapper font-size small-select alignleft">
                            <?php sampression_font_size_select( 'sampression_theme_options[web_title_size]', 'sam-select change-site-fontsize', absint( $options['web_title_size'] ) ) ?>
                        </div>
                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                            <?php sampression_font_style_select( 'sampression_theme_options[web_title_style]', 'sam-select change-site-fontstyle', esc_attr( $options['web_title_style'] ) ) ?>
                        </div>
                        <input type="text" name="sampression_theme_options[web_title_color]" value="<?php echo esc_attr( $options['web_title_color'] ); ?>" class="sam-site-title-color wp-color-picker" data-default-color="#00CC99" />
                    </div>
                    <div class="box-entry">
                        <div class="clearfix remove-description">
                            <input id="no-webdesc" class="sam-checkbox samp-style" type="checkbox" <?php checked( $options['use_web_desc'], 'yes' ); ?>>
                            <label class="checkbox-label" for="no-webdesc"><?php echo _e( 'Website Description', 'sampression' ); ?></label>
                            <input type="hidden" id="sam-use-webdesc" name="sampression_theme_options[use_web_desc]" value="<?php echo esc_attr( $options['use_web_desc'] ); ?>" />
                        </div>
                        <div class="sam-site-desc font-demo" style="font: <?php echo esc_attr( $options['web_desc_style'] ); ?> <?php echo absint( $options['web_desc_size'] ); ?>px <?php echo esc_attr( $options['web_desc_font'] ); ?>; color: <?php echo esc_attr( $options['web_desc_color'] ); ?>;<?php if( $options['web_desc_color'] == '#ffffff' ) { echo ' background-color: #57B94A;'; } ?>"><?php echo get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : _e( 'Just another responsive theme', 'sampression' ); ?></div>
                        <div class="select-wrapper font-face medium-select alignleft" >
                            <?php sampression_font_select( 'sampression_theme_options[web_desc_font]', 'sam-select change-sitedesc-fontface', esc_attr( $options['web_desc_font'] ) ) ?>
                        </div>
                        <div class="select-wrapper font-size small-select alignleft">
                            <?php sampression_font_size_select( 'sampression_theme_options[web_desc_size]', 'sam-select change-sitedesc-fontsize', absint( $options['web_desc_size'] ), absint( $size['min_value'] ), absint( $size['max_value'] ) ) ?>
                        </div>
                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                            <?php sampression_font_style_select( 'sampression_theme_options[web_desc_style]', 'sam-select change-sitedesc-fontstyle', esc_attr( $options['web_desc_style'] ) ) ?>
                        </div>
                        <input type="text" name="sampression_theme_options[web_desc_color]" value="<?php echo esc_attr( $options['web_desc_color'] ); ?>" class="sam-site-desc-color wp-color-picker" data-default-color="#00CC99" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end of .row-->
        <section class="row">

            <div class="box titled-box ">
                <div class="box-title"><h4><?php _e('Favicon', 'sampression'); ?></h4></div>
                <div class="box-entry sam-favicon">
                    <ul id="bgimage-selector" class="style-selector-list clearfix add-image-section">
                        <li class="clearfix sam-no-spacing sam-no-border">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $options['favicon_url_16']; ?>" alt="<?php get_bloginfo( 'name' ); ?> favicon" id="website-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo sampression_truncate_text( basename( esc_url( $options['favicon_url_16'] ) ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="sampression_theme_options[favicon_url_16]" value="<?php echo esc_url( $options['favicon_url_16'] ); ?>" />
                                    <input type="button" id="faviconimage" name="faviconimage" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Favicon must be 16px x 16px<br>jpg, png, gif, ico are supported.', 'sampression' ); ?></p>
                                <input type="checkbox" class="sam-checkbox samp-style" id="use-favicon"<?php checked( $options['donot_use_favicon_16'], 'yes' ); ?> />
                                <label for="use-favicon" class="checkbox-label"><?php echo _e('Disable', 'sampression'); ?></label>
                                <input type="hidden" class="sam-use-favicon" name="sampression_theme_options[donot_use_favicon_16]" value="<?php echo esc_attr( $options['donot_use_favicon_16'] ); ?>" />
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- .row-->
        <section class="row">

            <div class="box titled-box ">
                <div class="box-title"><h4><?php _e( 'Apple Touch Icons', 'sampression' );?></h4>
                    <div class="right-cnt">
                    <input type="checkbox" class="sam-checkbox samp-style" <?php checked( $options['donot_use_apple_icon'], 'yes' ); ?> id="no-touchicon" />

                    <label for="no-touchicon" class="checkbox-label"><?php _e( 'Disable All', 'sampression' );?></label>
                    <input type="hidden" class="sam-no-touchicon" name="sampression_theme_options[donot_use_apple_icon]" value="<?php echo esc_attr( $options['donot_use_apple_icon'] ); ?>" />
                    </div>
                </div>
                <div class="box-entry sam-appletouchicon">
                    <ul id="bgimage-selector" class="style-selector-list clearfix add-image-section">
                        <li class="clearfix">
                            <figure class="image-holder image-preview">
                                <img src="<?php echo $options['apple_icon_url_57']; ?>" alt="<?php get_bloginfo('name'); ?> apple favicon" id="favicon_57-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo sampression_truncate_text( basename( esc_url( $options['apple_icon_url_57'] ) ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="sampression_theme_options[apple_icon_url_57]" value="<?php echo esc_url( $options['apple_icon_url_57'] ); ?>" />
                                    <input type="button" id="faviconimage" name="favicon_57_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPhone Icon (57px x 57px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php checked( $options['donot_use_apple_icon_57'], 'yes' ); ?> id="use-iphone" />

                                <label for="use-iphone" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-iphone" name="sampression_theme_options[donot_use_apple_icon_57]" value="<?php echo esc_attr( $options['donot_use_apple_icon_57'] ); ?>" />
                            </div>
                        </li>
                        <li class="clearfix">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $options['apple_icon_url_72']; ?>" alt="<?php get_bloginfo( 'name' ); ?> apple favicon" id="favicon_72-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo sampression_truncate_text( basename( esc_url( $options['apple_icon_url_72'] ) ) ); ?> </div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="sampression_theme_options[apple_icon_url_72]" value="<?php echo esc_url( $options['apple_icon_url_72'] ); ?>" />
                                    <input type="button" id="faviconimage" name="favicon_72_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPad Icon (72px x 72px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php checked( $options['donot_use_apple_icon_72'], 'yes' ); ?> id="use-ipad" />

                                <label for="use-ipad" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-ipad" name="sampression_theme_options[donot_use_apple_icon_72]" value="<?php echo esc_attr( $options['donot_use_apple_icon_72'] ); ?>" />
                            </div>
                        </li>
                        <li class="clearfix">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo esc_url( $options['apple_icon_url_114'] ); ?>" alt="<?php get_bloginfo( 'name' ); ?> apple favicon" id="favicon_114-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo sampression_truncate_text( basename( esc_url( $options['apple_icon_url_114']) ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="sampression_theme_options[apple_icon_url_114]" value="<?php echo esc_url( $options['apple_icon_url_114'] ); ?>" />
                                    <input type="button" id="faviconimage" name="favicon_114_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPhone Retina Icon (114px x 114px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php checked( $options['donot_use_apple_icon_114'], 'yes' ); ?> id="use-iphoneretina" />

                                <label for="use-iphoneretina" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-iphoneretina" name="sampression_theme_options[donot_use_apple_icon_114]" value="<?php echo esc_attr( $options['donot_use_apple_icon_114'] ); ?>" />
                            </div>
                        </li>
                        <li class="clearfix sam-no-spacing sam-no-border">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $options['apple_icon_url_144']; ?>" alt="<?php get_bloginfo('name'); ?> apple favicon" id="favicon_144-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo sampression_truncate_text( basename( esc_url( $options['apple_icon_url_144'] ) ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="sampression_theme_options[apple_icon_url_144]" value="<?php echo esc_url( $options['apple_icon_url_144'] ); ?>" />
                                    <input type="button" id="faviconimage" name="favicon_144_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPad Retina Icon (144px x 144px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php checked( $options['donot_use_apple_icon_144'], 'yes' ); ?> id="use-ipadretina" />

                                <label for="use-ipadretina" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-ipadretina" name="sampression_theme_options[donot_use_apple_icon_144]" value="<?php echo esc_attr( $options['donot_use_apple_icon_144'] ); ?>" />
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </section>
        <!-- .row-->
        <div id="response"></div>
        
        <p class="submit">
                    <input type="submit" name="sampression-theme-settings" id="submit" class="button1 alignright save-data" value="Save" />
                </p>
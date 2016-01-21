<?php
/**
 * Typography tab of Theme Options.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if ( !defined( 'ABSPATH' ) )
    exit( 'restricted access' );
    $default_fonts = sampression_fonts_style();
    global $sampression_options_settings;
    $options = $sampression_options_settings;
?>
        <section class="row">
            <div class="box titled-box">
                <div class="box-title">
                    <h4><?php _e( 'Typography', 'sampression' ) ?></h4>
                    <div class="select-wrapper large-select">
                        <select class="sam-select " id="typo-selctor" autocomplete="off">
                            <?php
                            $t_options = array(
                                'general' => 'General',
                                'post-pages' => 'Post/Pages (Single)',
                                'index-blog'  => 'Index/Blog'
                            );
                            $counter = 0;
                            foreach ( $t_options as $tkey => $tval ) {
                                $counter++;
                                $sel = '';
                                if( $counter === 1 ) { $sel = ' selected="selected"'; }
                                echo '<option'.$sel.' value="'.$tkey.'">'.$tval.'</option>';
                            }                            
                            ?>
                        </select>
                    </div> <!-- .select-wrapper -->
                </div> <!-- .box-title -->
                <div class="box-entry typo-general" id="typography-general">
                    <div class="section row">
                        <div class="sec-label"><?php _e( 'Body Text', 'sampression' ) ?></div>
                        <div class="entry">
                            <p id="paragraphtext" class="sam-body-text font-demo" style="font: <?php echo esc_attr( $options['body_font_style'] ); ?> <?php echo absint( $options['body_font_size'] ); ?>px <?php echo esc_attr( $options['body_font_family'] ); ?>;  color: <?php echo esc_attr( $options['body_font_color'] ); ?>;<?php if($options['body_font_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e( 'The quick brown fox jumps over the lazy dog.', 'sampression' ) ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select( 'sampression_theme_options[body_font_family]', 'sam-select change-fontface', esc_attr( $options['body_font_family'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select( 'sampression_theme_options[body_font_size]', 'sam-select change-fontsize', absint( $options['body_font_size'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                <?php sampression_font_style_select( 'sampression_theme_options[body_font_style]', 'sam-select change-fontstyle', esc_attr( $options['body_font_style'] ) ) ?>
                            </div>
                                <input type="text" name="sampression_theme_options[body_font_color]" value="<?php echo esc_attr( $options['body_font_color'] ); ?>" class="sam-body-text-color wp-color-picker" data-default-color="#00CC99" />
                        </div> <!-- .entry -->
                        <div class="sec-label secondary">Link</div>
                        <div class="entry secondary">
                            <input type="text" name="sampression_theme_options[body_link_color]" value="<?php echo esc_attr( $options['body_link_color'] ); ?>" class="sam-body-link-color wp_color_picker wp-color-picker" data-default-color="#8ab7ad" />
                        </div>
                    </div><!-- .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e( 'Navigation', 'sampression' ) ?></div>
                        <div class="entry">
                            <p id="paragraphtext" class="sam-navigation-text font-demo" style="font: <?php echo esc_attr( $options['nav_font_style'] ); ?> <?php echo absint( $options['nav_font_size'] ); ?>px <?php echo esc_attr( $options['nav_font_family'] ); ?>;  color: <?php echo esc_attr( $options['nav_font_color'] ); ?>;<?php if($options['nav_font_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e( 'The quick brown fox jumps over the lazy dog.', 'sampression' ) ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select( 'sampression_theme_options[nav_font_family]', 'sam-select change-fontface', esc_attr( $options['nav_font_family'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select( 'sampression_theme_options[nav_font_size]', 'sam-select change-fontsize', absint( $options['nav_font_size'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                <?php sampression_font_style_select( 'sampression_theme_options[nav_font_style]', 'sam-select change-fontstyle', esc_attr( $options['nav_font_style'] ) ) ?>
                            </div>
                            <input type="text" name="sampression_theme_options[nav_font_color]" value="<?php echo esc_attr( $options['nav_font_color'] ); ?>" class="sam-nav-text-color wp-color-picker" data-default-color="#8ab7ad" />
                        </div> <!-- .entry -->
                        <div class="sec-label secondary">Hover</div>
                        <div class="entry secondary">
                            <input type="text" name="sampression_theme_options[nav_font_color_hover]" value="<?php echo esc_attr( $options['nav_font_color_hover'] ); ?>" class="sam-nav-text-color-hover wp_color_picker wp-color-picker" data-default-color="#8ab7ad" />
                        </div>
                    </div><!-- .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e( 'Link', 'sampression' ) ?></div>
                        <div class="entry">
                            <p id="paragraphtext" class="sam-link-text font-demo" style="font: <?php echo esc_attr( $options['link_font_style'] ); ?> <?php echo absint( $options['link_font_size'] ); ?>px <?php echo esc_attr( $options['link_font_family'] ); ?>;  color: <?php echo esc_attr( $options['link_font_color'] ); ?>;<?php if($options['link_font_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e( 'The quick brown fox jumps over the lazy dog.', 'sampression' ) ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select( 'sampression_theme_options[link_font_family]', 'sam-select change-fontface', esc_attr( $options['link_font_family'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select( 'sampression_theme_options[link_font_size]', 'sam-select change-fontsize', absint( $options['link_font_size'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                <?php sampression_font_style_select( 'sampression_theme_options[link_font_style]', 'sam-select change-fontstyle', esc_attr( $options['link_font_style'] ) ) ?>
                            </div>
                            <input type="text" name="sampression_theme_options[link_font_color]" value="<?php echo esc_attr( $options['link_font_color'] ); ?>" class="sam-link-text-color wp-color-picker" data-default-color="#8ab7ad" />
                        </div> <!-- .entry -->
                        <div class="sec-label secondary">Hover</div>
                        <div class="entry secondary">
                            <input type="text" name="sampression_theme_options[link_font_color_hover]" value="<?php echo esc_attr( $options['link_font_color_hover'] ); ?>" class="sam-link-text-color-hover wp_color_picker wp-color-picker" data-default-color="#8ab7ad" />
                        </div>
                    </div><!-- .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e( 'Filter by', 'sampression' ) ?></div>
                        <div class="entry">
                            <input type="text" name="sampression_theme_options[filter_by_color]" value="<?php echo esc_attr( $options['filter_by_color'] ); ?>" class="sam-filterby-color wp_color_picker wp-color-picker" data-default-color="#8ab7ad" />
                        </div> <!-- .entry -->
                    </div><!-- .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e( 'Widget Title', 'sampression' ) ?></div>
                        <div class="entry">
                            <p id="paragraphtext" class="sam-widget-header-text font-demo" style="font: <?php echo esc_attr( $options['widget_header_font_style'] ); ?> <?php echo absint( $options['widget_header_font_size'] ); ?>px <?php echo esc_attr( $options['widget_header_font_family'] ); ?>;  color: <?php echo esc_attr( $options['widget_header_font_color'] ); ?>;<?php if($options['widget_header_font_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e( 'The quick brown fox jumps over the lazy dog.', 'sampression' ) ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select( 'sampression_theme_options[widget_header_font_family]', 'sam-select change-fontface', esc_attr( $options['widget_header_font_family'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select( 'sampression_theme_options[widget_header_font_size]', 'sam-select change-fontsize', absint( $options['widget_header_font_size'] ) ) ?>
                            </div>
                            <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                <?php sampression_font_style_select( 'sampression_theme_options[widget_header_font_style]', 'sam-select change-fontstyle', esc_attr( $options['widget_header_font_style'] ) ) ?>
                            </div>
                            <input type="text" name="sampression_theme_options[widget_header_font_color]" value="<?php echo esc_attr( $options['widget_header_font_color'] ); ?>" class="sam-widget-header-text-color wp-color-picker" data-default-color="#8ab7ad" />
                        </div> <!-- .entry -->
                    </div><!-- .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e( 'Sticky Post', 'sampression' ) ?></div>
                        <div class="sec-label secondary" style="clear:left;">Background Color</div>
                        <div class="entry secondary">
                            <input type="text" name="sampression_theme_options[sticky_bgcolor]" value="<?php echo esc_attr( $options['sticky_bgcolor'] ); ?>" class="sam-sticky-bgcolor wp_color_picker wp-color-picker" data-default-color="#8ab7ad" />
                        </div> <!-- .entry -->
                    </div><!-- .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e( 'Button', 'sampression' ) ?></div>
                        <div class="sec-label secondary" style="clear:left;">Background Color</div>
                        <div class="entry secondary">
                            <input type="text" name="sampression_theme_options[button_bgcolor]" value="<?php echo esc_attr( $options['button_bgcolor'] ); ?>" class="sam-button-bgcolor wp_color_picker wp-color-picker" data-default-color="#8ab7ad" />
                        </div> <!-- .entry -->
                    </div><!-- .section-->
                </div> <!-- box-entry -->
                
                <div id="typography-post-pages" class="box-entry hide typo-post-pages">
                    <section class="row">
                        <div class="box titled-box ">
                            <div class="box-title">
                                <h4><?php _e('Post/Page Title', 'sampression') ?></h4>
                            </div>
                            <div class="box-entry">
                                <div class="section row">
                                    <div class="sec-label"><?php _e('Title', 'sampression') ?></div>
                                    <div class="entry">
                                        <h1 id="sam-post-title" class="sam-post-title-text font-demo" style="font: <?php echo esc_attr($options['post_title_font_style']); ?> <?php echo absint($options['post_title_font_size']); ?>px <?php echo esc_attr($options['post_title_font_family']); ?>; color: <?php echo esc_attr($options['post_title_font_color']); ?><?php if($options['body_font_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h1>
                                        <div class="select-wrapper font-face large-select alignleft" >
                                            <?php sampression_font_select('sampression_theme_options[post_title_font_family]', 'sam-select change-fontface', esc_attr($options['post_title_font_family'])) ?>
                                        </div>
                                        <div class="select-wrapper font-size small-select alignleft">
                                            <?php sampression_font_size_select('sampression_theme_options[post_title_font_size]', 'sam-select change-fontsize', absint($options['post_title_font_size'])) ?>
                                        </div>
                                        
                                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                            <?php sampression_font_style_select( 'sampression_theme_options[post_title_font_style]', 'sam-select change-fontstyle', esc_attr( $options['post_title_font_style'] ) ) ?>
                                        </div>
                                        <input type="text" name="sampression_theme_options[post_title_font_color]" value="<?php echo esc_attr($options['post_title_font_color']); ?>" class="sam-post-title-text-color wp-color-picker " data-default-color="#00CC99" />
                                    </div> <!-- .entry -->
                                </div> <!-- .section-->
                            </div> <!-- .box-entry -->
                        </div> <!-- .box -->
                    </section>
                    <section class="row">
                        <div class="box titled-box ">
                            <div class="box-title">
                                <h4><?php _e( 'Meta Text', 'sampression' ) ?></h4>
                            </div>
                            <div class="box-entry">
                                <div class="section row">
                                    <div class="sec-label"><?php _e( 'Text', 'sampression' ) ?></div>
                                    <div class="entry">
                                        <div id="sam-meta-text" class="sam-meta-font-text font-demo" style="font: <?php echo absint( $options['meta_font_style'] ); ?> <?php echo absint( $options['meta_font_size'] ); ?>px <?php echo esc_attr( $options['meta_font_family'] ); ?>; color: <?php echo esc_attr($options['meta_font_color']); ?><?php if($options['meta_font_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>  "><?php _e( 'The quick brown fox jumps over the lazy dog.', 'sampression' ) ?></div>
                                        <div class="select-wrapper font-face large-select alignleft" >
                                            <?php sampression_font_select( 'sampression_theme_options[meta_font_family]', 'sam-select change-fontface', esc_attr( $options['meta_font_family'] ) ) ?>
                                        </div>
                                        <div class="select-wrapper font-size small-select alignleft">
                                            <?php sampression_font_size_select( 'sampression_theme_options[meta_font_size]', 'sam-select change-fontsize', absint( $options['meta_font_size'] ) ) ?>
                                        </div>
                                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                            <?php sampression_font_style_select( 'sampression_theme_options[meta_font_style]', 'sam-select change-fontstyle', esc_attr( $options['meta_font_style'] ) ) ?>
                                        </div>
                                        <input type="text" name="sampression_theme_options[meta_font_color]" value="<?php echo esc_attr($options['meta_font_color']); ?>" class="sam-meta-font-text-color wp-color-picker " data-default-color="#00CC99" />
                                    </div> <!-- .entry -->
                                </div>  <!-- .section-->
                            </div> <!-- .box-entry -->
                        </div> <!-- .box -->
                    </section>
                </div> <!-- box-entry -->
                
                <div id="typography-index-blog" class="box-entry hide typo-index-blog">
                    <section class="row">
                        <div class="box titled-box ">
                            <div class="box-title">
                                <h4><?php _e('Post Title', 'sampression') ?></h4>
                            </div>
                            <div class="box-entry">
                                <div class="section row">
                                    <div class="sec-label"><?php _e('Title', 'sampression') ?></div>
                                    <div class="entry">
                                        <h1 id="sam-post-title" class="sam-blog-post-title font-demo" style="font: <?php echo esc_attr($options['blog_post_title_font_style']); ?> <?php echo absint($options['blog_post_title_font_size']); ?>px/1.3 <?php echo esc_attr($options['blog_post_title_font_family']); ?>; color: <?php echo esc_attr( $options['blog_post_title_color'] ); ?> <?php if($options['blog_post_title_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h1>
                                        <div class="select-wrapper font-face large-select alignleft" >
                                            <?php sampression_font_select('sampression_theme_options[blog_post_title_font_family]', 'sam-select change-fontface', esc_attr($options['blog_post_title_font_family'])) ?>
                                        </div>
                                        <div class="select-wrapper font-size small-select alignleft">
                                            <?php sampression_font_size_select('sampression_theme_options[blog_post_title_font_size]', 'sam-select change-fontsize', absint($options['blog_post_title_font_size'])) ?>
                                        </div>                                        
                                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                            <?php sampression_font_style_select( 'sampression_theme_options[blog_post_title_font_style]', 'sam-select change-fontstyle', esc_attr( $options['blog_post_title_font_style'] ) ) ?>
                                        </div>
                                        <input type="text" name="sampression_theme_options[blog_post_title_color]" value="<?php echo esc_attr($options['blog_post_title_color']); ?>" class="sam-blog-post-title-color wp-color-picker" data-default-color="#00CC99" />
                                    </div>  <!-- .entry -->
                                </div>  <!-- .section-->
                            </div> <!-- .box-entry -->
                        </div>  <!-- .box -->
                    </section>
                    
                    <section class="row">
                        <div class="box titled-box ">
                            <div class="box-title">
                                <h4><?php _e( 'Meta Text', 'sampression' ) ?></h4>
                            </div>
                            <div class="box-entry">
                                <div class="section row">
                                    <div class="sec-label"><?php _e( 'Text', 'sampression' ) ?></div>
                                    <div class="entry">
                                        <div id="sam-meta-text" class="sam-blog-meta-font font-demo" style="font: <?php echo esc_attr( $options['blog_meta_font_style'] ); ?> <?php echo absint( $options['blog_meta_font_size'] ); ?>px <?php echo esc_attr( $options['blog_meta_font_family'] ); ?>; color: <?php echo esc_attr( $options['blog_meta_font_color'] ); ?> <?php if($options['blog_meta_font_color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?> "><?php _e( 'The quick brown fox jumps over the lazy dog.', 'sampression' ) ?></div>
                                        <div class="select-wrapper font-face large-select alignleft" >
                                            <?php sampression_font_select( 'sampression_theme_options[blog_meta_font_family]', 'sam-select change-fontface', esc_attr( $options['blog_meta_font_family'] ) ) ?>
                                        </div>
                                        <div class="select-wrapper font-size small-select alignleft">
                                            <?php sampression_font_size_select( 'sampression_theme_options[blog_meta_font_size]', 'sam-select change-fontsize', absint( $options['blog_meta_font_size'] ) ) ?>
                                        </div>
                                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                            <?php sampression_font_style_select( 'sampression_theme_options[blog_meta_font_style]', 'sam-select change-fontstyle', esc_attr( $options['blog_meta_font_style'] ) ) ?>
                                        </div>
                                        <input type="text" name="sampression_theme_options[blog_meta_font_color]" value="<?php echo esc_attr( $options['blog_meta_font_color'] ); ?>" class="sam-blog-meta-font-color wp-color-picker" data-default-color="#00CC99" />
                                    </div>  <!-- .entry -->
                                </div> <!-- .section-->
                            </div> <!-- .box-entry -->
                        </div>  <!-- .box -->
                    </section>
                </div> <!-- box-entry -->
                
            </div> <!-- .box -->
            
        </section><a name="response"></a>
        
        <div id="response"></div>
        
        <p class="submit">
            <input type="submit" name="sampression-theme-settings" id="submit" class="button1 alignright save-data" value="Save" />
        </p>
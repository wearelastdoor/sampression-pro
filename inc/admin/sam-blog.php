<?php
/**
 * Blog tab of Theme Options.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );
    global $sampression_options_settings;
    $options = $sampression_options_settings;
    //sam_p($options);
?>
        <input type="hidden" name="meta_data" value="blog_page_settings" />
        <section class="row">
            <h3 class="sec-title"><?php _e( 'Blog Page Settings', 'sampression' );?></h3>
            <div class="box titled-box">
                <div  class="box-title">
                    <h4><?php _e( 'Post meta settings', 'sampression' );?></h4>
                </div>
                <div class="box-entry sam-lists sam-blogmeta-option">
                    <ul class=" clearfix">
                        <li class="row">
                            <label class="sec-label small"><?php _e( 'Show', 'sampression' );?></label>
                            <!-- Date -->
                            <input type="checkbox" class="sam-checkbox" id="use-date" <?php checked( $options['show_meta_date'], 'yes' ); ?> />
                            <label for="use-date" class="checkbox-label show-meta"> <?php _e('Date', 'sampression') ?> </label>
                            <input type="hidden" name="sampression_theme_options[show_meta_date]" id="show-use-date" value="<?php echo $options['show_meta_date']; ?>" />
                            
                            <!-- Author -->
                            <input type="checkbox" class="sam-checkbox" id="use-author" <?php checked( $options['show_meta_author'], 'yes' ); ?> />
                            <label for="use-author" class="checkbox-label show-meta"> <?php _e('Author', 'sampression') ?> </label>
                            <input type="hidden" name="sampression_theme_options[show_meta_author]" id="show-use-author" value="<?php echo $options['show_meta_author']; ?>" />
                            
                            <!-- Categories -->
                            <input type="checkbox" class="sam-checkbox" id="use-categories" <?php checked( $options['show_meta_categories'], 'yes' ); ?> />
                            <label for="use-categories" class="checkbox-label show-meta"> <?php _e('Categories', 'sampression') ?> </label>
                            <input type="hidden" name="sampression_theme_options[show_meta_categories]" id="show-use-categories" value="<?php echo $options['show_meta_categories']; ?>" />
                            
                            <!-- Tags -->
                            <input type="checkbox" class="sam-checkbox" id="use-tags" <?php checked( $options['show_meta_tags'], 'yes' ); ?> />
                            <label for="use-tags" class="checkbox-label show-meta"> <?php _e('Tags', 'sampression') ?> </label>
                            <input type="hidden" name="sampression_theme_options[show_meta_tags]" id="show-use-tags" value="<?php echo $options['show_meta_tags']; ?>" />
                            
                            <!-- Comment Count -->
                            <input type="checkbox" class="sam-checkbox" id="use-comment-count" <?php checked( $options['show_meta_comment_count'], 'yes' ); ?> />
                            <label for="use-comment-count" class="checkbox-label show-meta"> <?php _e('Comment Count', 'sampression') ?> </label>
                            <input type="hidden" name="sampression_theme_options[show_meta_comment_count]" id="show-use-comment-count" value="<?php echo $options['show_meta_comment_count']; ?>" />
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- .row-->
        <section class="row">
            
            <div class="box titled-box">
                <div  class="box-title">
                    <h4><?php _e( 'Post display settings (Check to hide blog from category on home page)', 'sampression' );?></h4>
                </div>
                <div class="box-entry sam-lists sam-blogmeta-option">
                    <ul class=" clearfix">
                        <li class="row">
                        <?php
                        $categories = get_categories();
                        $count = 0;
                        parse_str($options['category_posts_display'], $cat_display_count);
                        //sam_p($cat_display_count);
                        foreach($categories as $category) {
                            //sam_p($cat_display_count);
                            $count++;
                            if(count($cat_display_count) > 0 && array_key_exists($category->slug, $cat_display_count)) {
                                $count_value = $cat_display_count[$category->slug];
                            } else {
                                $count_value = sampression_category_count($category->slug);
                            }
                        ?>
                            <div class="sam-block">
                                <label class="sec-label small"><input type="checkbox" class="sam-cat-check"<?php if($count_value == 0) { echo ' checked="checked"'; } ?>><?php echo $category->name; ?></label>
                                <input type="number" min="-1" max="<?php echo sampression_category_count($category->slug) ?>" class="small-input sam-number-input" name="<?php echo $category->slug; ?>" value="<?php echo $count_value; ?>">
                                <small>Max: <?php echo sampression_category_count($category->slug) ?></small>
                            </div>
                        <?php
                            if(($count % 2) == 0) {
                                echo '</li>';
                                if(count($categories) != $count) {
                                    echo '<li class="row">';
                                }
                            }
                            $data_str[] = $category->slug."=".$count_value;
                        }
                        $data_str = implode("&", $data_str);
                        ?>
                        </li>
                    </ul><input type="hidden" name="sampression_theme_options[category_posts_display]" id="category-posts-display" value="<?php echo $data_str ?>">
                </div>
            </div>
        </section>
        <!-- .row-->
        
        <div id="response"></div>
        <p class="submit">
            <input type="submit" name="sampression-theme-settings" id="submit" class="button1 alignright save-data" value="Save" />
        </p>
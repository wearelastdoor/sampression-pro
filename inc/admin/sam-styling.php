<?php
/**
 * Styling tab of Theme Options.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if (!defined('ABSPATH'))
    exit('restricted access');

$sidebar_options = sampression_sidebar_options();
$column_options = sampression_column_options();
global $sampression_options_settings;
$options = $sampression_options_settings;
//sam_p($options);
?>
<section class="row">
    <h3 class="sec-title"><?php _e('Customize', 'sampression'); ?></h3>
    <div class="box titled-box">
        <div  class="box-title">
            <h4><?php _e('Background', 'sampression') ?></h4>
        </div>
        <div class="box-entry sam-lists sam-blogmeta-option">
            <ul class=" clearfix">
                <li class="row">
                    <label class="sec-label small"><?php _e( 'Show background', 'sampression' );?></label>
                    <!-- Date -->
                    <input type="checkbox" class="sam-checkbox" id="show-background" <?php checked( $options['show_background'], 'yes' ); ?> />
                    <label for="show-background" class="checkbox-label show-meta"> <?php _e('If unchecked, your selected background image or color will be shown.', 'sampression') ?> </label>
                    <input type="hidden" name="sampression_theme_options[show_background]" id="show-show-background" value="<?php echo $options['show_background']; ?>" />
                </li>
            </ul>
        </div> <!-- .box-entry -->
    </div> <!-- .box -->
</section>
<section class="row">
    <div class="box titled-box">
        <div  class="box-title">
            <h4><?php _e('Sidebar', 'sampression') ?></h4>
        </div>
        <div class="box-entry">
            <ul id="sidebar-selector" class="style-selector-list clearfix">
                <?php
                for ($i = 0; $i < count($sidebar_options); $i++) {
                    ?>
                    <li class="<?php
                    if ($i == 0) {
                        echo 'first ';
                    } if ($options['sidebar_active'] == $sidebar_options[$i]) {
                        echo 'active ';
                    }
                    ?>style-selector">
                        <a href="javascript:void(0);" data-sidebar="<?php echo $sidebar_options[$i]; ?>" class="sam-style">
                            <img src="<?php echo SAM_PRO_ADMIN_IMAGES_URL; ?>/<?php echo $sidebar_options[$i]; ?>-layout.jpg" alt=""/>
                            <?php echo ucwords($sidebar_options[$i]); ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <input type="hidden" name="sampression_theme_options[sidebar_active]" id="sidebar" value="<?php echo $options['sidebar_active']; ?>" />
        </div> <!-- .box-entry -->
    </div> <!-- .box -->
</section>
<section class="row">
    <div class="box titled-box">
        <div  class="box-title">
            <h4><?php _e('Columns', 'sampression') ?></h4>
        </div>
        <div class="box-entry">
            <ul id="column-selector" class="style-selector-list clearfix">
                <?php
                for ($i = 0; $i < count($column_options); $i++) {
                    ?>
                    <li class="<?php
                    if ($i == 0) {
                        echo 'first ';
                    } if ($options['column_active'] == $column_options[$i]) {
                        echo 'active ';
                    }
                    ?>style-selector">
                        <a href="javascript:void(0);" data-column="<?php echo $column_options[$i]; ?>" class="sam-style">
                            <img src="<?php echo SAM_PRO_ADMIN_IMAGES_URL; ?>/<?php echo $column_options[$i]; ?>-column.jpg" alt=""/>
                            <?php echo ucwords($column_options[$i]); ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <input type="hidden" name="sampression_theme_options[column_active]" id="column" value="<?php echo $options['column_active']; ?>" />
        </div> <!-- .box-entry -->
    </div> <!-- .box -->
</section>

<div id="response"></div>

<p class="submit">
    <input type="submit" name="sampression-theme-settings" id="submit" class="button1 alignright save-data" value="Save" />
</p>
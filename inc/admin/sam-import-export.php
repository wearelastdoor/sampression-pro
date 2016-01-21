<?php
/**
 * Export/Import tab of Theme Options.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if ( !defined( 'ABSPATH' ) )
    exit( 'restricted access' );
    global $sampression_options_settings;
    $options = $sampression_options_settings;
?>
        <input type="hidden" name="meta_data" value="import_export" />
        <section class="row">
            <h3 class="sec-title"><?php _e('Import Export', 'sampression');?></h3>
            <div class="box">
                <div class=" sam-lists sam-importexport-option">
                    <ul class=" clearfix">
                        <li class="row">
                            <span class="sec-label large-label alignleft"><?php _e('Export All Theme Settings', 'sampression');?></span>
                            <a href="themes.php?page=sampression-options&settings-updated=export" class="button1 alignright small-button">Export</a>
                        </li>
                        <li class="clearfix sam-no-border">
                            <span class="sec-label alignleft"><?php _e('Import Theme Settings', 'sampression');?></span>
                            <input name="import" id="import_button" class="button1 alignright small-button" type="submit" value="Execute" >
                            <div class="small-button  button3 fileUpload alignright">
                                <span><?php _e('Import Json File', 'sampression');?></span>
                                <span class="json-filename"></span>
                                <input type="hidden" id="mime_type" />
                                <input type="file" id="import_json" name="import_json" />
                            </div>                            
                        </li>
                    </ul>
                </div>
            </div>
            <?php //message_info() ?>
        </section>
        <!-- end of .row-->
<a name="response"></a>
        <div id="response"></div>
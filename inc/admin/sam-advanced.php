<?php
/**
 * Advanced tab of Theme Options.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

if ( !defined( 'ABSPATH' ) )
    exit( 'restricted access' );

    global $sampression_options_settings;
    $options = $sampression_options_settings;
?>
        <section class="row">
            <h3 class="sec-title"> <?php _e( 'Advanced', 'sampression' ); ?> </h3>
            <div class="box titled-box">
                <div class="box-title sam-hooks-cb">
                    <h4> <?php _e( 'Header Code', 'sampression' ); ?> </h4>
                </div>
                <div class="box-entry sam-hooks-option clearfix">
                    <div class="alignright sam-hooks-info">
                        <div class="notice"><?php _e('Description', 'sampression');?></div>
                        <div class="sam-info"><p><?php _e( 'The following code will add to the &lt;head&gt; tag before wp_head(). Useful if you need to add additional scripts such as CSS or JS.', 'sampression' ); ?></p></div>
                    </div>
                    <textarea name="sampression_theme_options[advanced_header_code]" class="large-input alignleft" placeholder="<?php _e('Type here', 'sampression');?>"><?php echo htmlspecialchars_decode( stripslashes( $options['advanced_header_code'] ) ); ?></textarea>
                </div>
            </div> <!-- .box -->
        </section> <!-- .row -->
        
        <section class="row">
            <div class="box titled-box">
                <div class="box-title sam-hooks-cb">
                    <h4> <?php _e( 'Footer Code', 'sampression' ); ?> </h4>
                </div> <!-- .box-title -->
                <div class="box-entry sam-hooks-option clearfix">
                    <div class="alignright sam-hooks-info">
                        <div class="notice"><?php _e('Description', 'sampression');?></div>
                        <div class="sam-info"><p><?php _e( 'The following code will add to the footer before the closing </body> tag. Useful if you need to Javascript or tracking code.', 'sampression' ); ?></p></div>
                    </div>
                    <textarea name="sampression_theme_options[advanced_footer_code]" class="large-input alignleft" placeholder="<?php _e('Type here', 'sampression');?>"><?php echo htmlspecialchars_decode( stripslashes( $options['advanced_footer_code'] ) ); ?></textarea>
                </div> <!-- .box-entry -->
            </div><!-- .box -->
        </section>  <!-- .row -->
        
         <div id="response"></div>
        
        <p class="submit">
            <input type="submit" name="sampression-theme-settings" id="submit" class="button1 alignright save-data" value="Save" />
        </p>
<?php
/**
 * The template for displaying the footer.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */
?>

</div> <!-- .container -->
</div> <!-- #content-wrapper -->

<footer id="footer">
    <div class="container">
        <div class="columns fourteen footer-block">
            <div
                class="alignleft copyright"><?php bloginfo('name'); ?> &copy; <?php _e(date('Y')); ?>.
            </div><?php do_action('sampression_credits'); ?>
        </div>
        <!-- .footer-block -->

        <div class="columns two footer-right">
            <div id="btn-top-wrapper">
                <a href="javascript:pageScroll('.top');" class="btn-top"><i class="icon-keyboard-arrow-up"></i></a>
            </div>
        </div>
        <!-- .footer-right -->

    </div>
    <!-- .container -->
</footer>
</div><!-- #inner-wrapper -->
<?php
/**
 * Before </body> tag hook
 * sampression_before_body_tag hook
 * @hooked sampression_add_before_body_tag - 10
 */
do_action('sampression_before_body_tag');
?>
<?php wp_footer(); ?>
</body>
</html>
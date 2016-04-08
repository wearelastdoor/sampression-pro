<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
<div class="footer-widget">
    <div class="container">
        <aside id="sidebar" class="clearfix">
            <?php dynamic_sidebar( 'footer-sidebar' ); ?>
        </aside>
        <!--#sidebar-->
    </div>
</div>
<!-- .footer-widget -->
<?php } ?>
<footer id="footer">
    <div class="container">
        <div class="columns twelve">
        <?php if( get_theme_mod( 'sampression_remove_copyright_text' ) != 1) { ?>
            <div class="alignleft powered-wp">
                <?php
                if( get_theme_mod( 'sampression_copyright_text' ) ) {
                    printf( '<div class="alignleft copyright">%s</div>',
                        get_theme_mod( 'sampression_copyright_text' )
                    );
                } else {
                    printf( '<div class="alignleft copyright">%s</div>%s <a href="http://wordpress.org/" title="WordPress" target="_blank">WordPress</a>',
                        __( 'Sampression Pro earqa © 2016.  All Rights Reserved.', 'sampression' ),
                        __( 'Proudly powered by', 'sampression' )
                    );
                }
                ?>
            </div>
            <?php } if( get_theme_mod( 'sampression_remove_credit_text' ) != 1) { ?>
            <div class="alignright credit">
                <?php
                if( get_theme_mod( 'sampression_credit_text' ) ) {
                    echo get_theme_mod( 'sampression_credit_text' );
                } else {
                    printf( '%s <a href="http://www.sampression.com/" target="_blank" title="Sampression">Sampression</a>',
                        __( 'A theme by', 'sampression' )
                    );
                }
                ?>
            </div>
            <?php } ?>
            <div id="btn-top-wrapper">
                <a href="javascript:pageScroll('.top');" class="btn-top"></a>
            </div>
        </div>

    </div>
    <!--.container-->
</footer>
<!--#footer-->
</div><!-- #inner-wrapper -->
</div><!-- #site-inner -->

<?php wp_footer(); ?>

</body>
</html>
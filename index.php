<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Underscores
 */

get_header(); ?>
<div id="content-wrapper">
    <div class="container">
        <section id="content" class="clearfix">
        <?php if( get_theme_mod( 'home_sidebar' ) && get_theme_mod( 'home_sidebar' ) !== 'none' ) { ?>
        <div class="<?php sampression_home_layout_classes() ?>">
        <?php } ?>
            <div id="post-listing" class="clearfix isotope">
                <?php
                if ( have_posts() ) :
                    //$i = 1;
                    while ( have_posts() ) : the_post();
                        //echo "<h2>$i - ".get_the_title()."</h2>";
                        //$i++;
                        get_template_part( 'template/content', get_post_format() );

                    endwhile;

                else :

                    get_template_part( 'template/content', 'none' );

                endif;
                ?>
            </div>
            <!-- #post-listing -->
        <?php if( get_theme_mod( 'home_sidebar' ) !== 'none' ) { ?>
        </div>
        <?php } ?>
        <?php
        if( get_theme_mod( 'home_sidebar' ) && get_theme_mod( 'home_sidebar' ) !== 'none' ) {
            get_sidebar();
        }
        sampression_posts_navi( $nav_id = 'nav-below' );
        ?>
        </section>
        <!-- #content -->
    </div>
</div>
<!-- #content-wrapper -->
<?php get_footer(); ?>
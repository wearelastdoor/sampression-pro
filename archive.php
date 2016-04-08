<?php
/**
 * The template for displaying archive pages.
 * 
 * @package Sampression
 */

get_header(); ?>
<div id="content-wrapper">
    <div class="container">
        <header class="page-header columns twelve">
            <?php
            the_archive_title( '<h2 class="page-title quick-note">', '</h2>' );
            the_archive_description( '<div class="category-archive-meta">', '</div>' );
            ?>
        </header>
        <section id="content" class="clearfix">
            <div class="nine columns alignright">
                <div id="post-listing" class="clearfix isotope">
                	<?php
                if ( have_posts() ) :

                    while ( have_posts() ) : the_post();
                        
                        get_template_part( 'template/content', get_post_format() );

                    endwhile;

                else :

                    get_template_part( 'template/content', 'none' );

                endif;
                ?>
                </div>
                <!-- #post-listing -->
            </div>
            <?php
            get_sidebar();
            sampression_posts_navi( $nav_id = 'nav-below' );
            
            ?>
            <!-- <nav id="nav-below" class="post-navigation clearfix">
                <div class="nav-previous alignleft"><a href="#"><span
                        class="meta-nav">&larr;</span> Older posts</a></div>
                <div class="nav-next alignright"><a href="#">Newer posts <span class="meta-nav">→</span></a></div>
            </nav> -->
        </section>
        <!-- #content -->
    </div>
</div>
<!-- #content-wrapper -->
<?php get_footer(); ?>
<?php
/**
 * The home page template with right sidebar
 *
 * @package Underscores
 *
 * Template Name: Home - Right Sidebar
 */

get_header(); ?>
<div id="content-wrapper">
    <div class="container">
        <section id="content" class="clearfix">
            <div class="nine columns">
                <div id="post-listing" class="clearfix isotope">
                	<?php
                	query_posts( array(
                			'post_type' => 'post',
                			'paged' => get_query_var( 'paged' )
                		) );
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
            wp_reset_query();
            ?>
        </section>
        <!-- #content -->
    </div>
</div>
<!-- #content-wrapper -->
<?php get_footer(); ?>
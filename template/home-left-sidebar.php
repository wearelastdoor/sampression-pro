<?php
/**
 * The home page template with right sidebar
 *
 * @package Underscores
 *
 * Template Name: Home - Left Sidebar
 */

get_header();
 echo '+++'.get_query_var( 'paged', 1 ).'+++';
 ?>
<div id="content-wrapper">
    <div class="container">
        <section id="content" class="clearfix">
            <div class="nine columns alignright">
                <div id="post-listing" class="clearfix isotope">
                	<?php
                	query_posts( array(
                			'post_type' => 'post',
                			'paged' => get_query_var( 'paged', 1 )
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
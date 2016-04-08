<?php
/**
 * The template for displaying all pages.
 * @package Sampression
 */

get_header(); ?>
<div id="content-wrapper">
    <div class="container">
        <section id="content" class="columns nine" role="main">
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class(); ?> id="page-<?php the_ID(); ?>">
                    <header class="post-header">
                        <h2 class="post-title"><?php the_title(); ?></h2>
                    </header>
                    <div class="entry clearfix">
                    	<?php
                		the_content();
                		wp_link_pages(
                			array(
                				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression' ) . '</span>',
                				'after' => '</div>'
            				)
        				);
                    	sampression_edit_post_link();
                    	?>
                    </div>
                </article>
            <?php
            comments_template();
            endwhile;
            ?>
        </section>
        <!-- #content -->

        <?php get_sidebar(); ?>
    </div>
</div>
<!-- #content-wrapper -->
<?php get_footer(); ?>
<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The main blog template
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

get_header(); ?>

<section id="content" class="clearfix">
	
  <?php if (have_posts()) : ?>
  <div id="post-listing" class="clearfix">
  
	<?php 
	// Show only one Sticky Post
	$sticky = sampression_latest_one_sticky_post();
	if ( count($sticky)> 0 ) {
		$args = array(
			'posts_per_page' => 1,
			'post__in'  => array($sticky),
			'ignore_sticky_posts' => 1
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) :
				$query->the_post();
                get_template_part( 'content' );
			endwhile;
		}
		wp_reset_postdata();
	}
	// Exclude Sticky Posts and show remaining normal posts
	$args = array(
		'post__in' => sampression_blog_page_posts(),
		'post__not_in'  => array($sticky),
		'posts_per_page' => -1
	);
	$query = new WP_Query( $args );
	while ( $query->have_posts() ) :
		$query->the_post();
        get_template_part( 'content', get_post_format() );
	endwhile;
	?>

     </div> <!-- #post-listing --> 
     <?php
        else:
     ?>
    
    <article id="post-0" class="no-results not-found">
        <header class="entry-header">
            <h2 class="entry-title"><?php _e( 'Nothing Found', 'sampression' ); ?></h2>
        </header><!-- .entry-header -->
    
        <div class="entry-content">
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sampression' ); ?></p>
        </div><!-- .entry-content -->
    </article><!-- #post-0 -->

<?php endif; ?>

  
</section> <!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
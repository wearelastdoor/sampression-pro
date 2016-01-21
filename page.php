<?php
/**
 * The template for displaying all pages.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

get_header(); ?>
<?php
$position = sampression_sidebar_position();
$main_class = array();
if ($position === 'left') { $main_class[] = 'alignright'; }
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section id="content" class="<?php sampression_content_class($main_class) ?>" role="main">
  <article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
    <?php if ( has_post_thumbnail() ) { ?>
    <div class="featured-img">
      <?php
            $position = sampression_sidebar_position(); 
            if ($position === 'right') {
                the_post_thumbnail( 'featured' );
            } else {
                the_post_thumbnail( 'featured-full' );
            }
        ?>
    </div>
    <!-- .featured-img -->
    <?php } ?>
    <header class="post-header">
<!--      <h2 class="post-title">-->
<!--        --><?php //the_title(); ?>
<!--      </h2>--><?php sampression_the_title() ?>
       
    </header>
   
    <div class="entry clearfix">
      <?php the_content(); ?>
      
      <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sampression' ) . '</span>', 'after' => '</div>' ) ); ?>
      
      <?php if(is_user_logged_in()){ ?>
       <div class="meta">
      	<div class="edit"><span class="icon-Pen-4"></span><?php edit_post_link( __( 'Edit', 'sampression' ) ); ?> </div>
       </div>
	  <?php } ?>
    </div>
  </article>
  <?php comments_template( '', true ); ?>
</section>
<!-- end content -->

<?php endwhile; endif; ?>
<?php
if($position == 'left' || $position == 'right') {
    get_sidebar('right');
}
?>
<?php get_footer(); ?>
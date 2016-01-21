<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * The template for displaying Archive pages.
 *
 * @package sampression-pro
 * @since Sampression Pro 1.0
 */

get_header(); ?>

<section id="content" class="clearfix">
  <?php if (have_posts()) : ?>

    <header class="page-header columns sixteen">
            <h2 class="quick-note columns sixteen">
                <?php if (is_day()) : ?>
                    <?php printf(__('Daily Archives: %s', 'sampression'), '<span>' . get_the_date() . '</span>'); ?>
                <?php elseif (is_month()) : ?>
                    <?php printf(__('Monthly Archives: %s', 'sampression'), '<span>' . get_the_date('F Y') . '</span>'); ?>
                <?php elseif (is_year()) : ?>
                    <?php printf(__('Yearly Archives: %s', 'sampression'), '<span>' . get_the_date('Y') . '</span>'); ?>
                <?php else : ?>
                    <?php _e('Blog Archives', 'sampression'); ?>
                <?php endif; ?>
            </h2>
   </header> <!-- .page-header --> 

   <div id="post-listing" class="clearfix">
           <!-- Corner Stamp: It will always remaing to the right top of the page -->
           <?php
           global $sampression_options_settings;
           $options = $sampression_options_settings;
           ?>
           <section class="corner-stamp post <?php echo sampression_column_class(); ?>">
               <header><h3><?php _e('Archives', 'sampression'); ?></h3></header>
               <div class="entry">
                   <ul class="categories archives">
                       <?php
                       // Getting Archive Lists
                       wp_get_archives('');
                       ?>  
                   </ul>
               </div> <!-- .entry -->

               <header><h3><?php _e('Categories', 'sampression'); ?></h3></header>
               <div class="entry">
                   <ul class="categories">
                       <?php
                       // Getting Categories Lists
                       wp_list_categories('title_li');
                       ?> 
                   </ul>
               </div> <!-- .entry -->
           </section> <!-- corner-stamp -->

           <?php
           while (have_posts()) : the_post();
               get_template_part( 'content', get_post_format() );
           endwhile;
           ?>
  </div>  <!-- #post-listing --> 
  
  <?php sampression_content_nav( 'nav-below' ); ?>
  <?php  else: ?>
    
  <article id="post-0" class="no-results not-found">
          <header class="entry-header">
              <h2 class="entry-title"><?php _e('Nothing Found', 'sampression'); ?></h2>
          </header><!-- .entry-header -->

          <div class="entry-content">
              <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sampression'); ?></p>
          </div> <!-- .entry-content -->
      </article> <!-- #post-0 -->

<?php endif; ?>
  
</section> <!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
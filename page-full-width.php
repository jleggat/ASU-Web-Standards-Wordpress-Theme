<?php
/**
 * Template Name: Full Width
 *
 * @package asu-wordpress-web-standards-theme
 */

include 'helpers/mime-types-helper.php';

get_header();

$custom_fields = get_post_custom();
?>
<div id="main-wrapper" class="clearfix">
  <div id="main" class="clearfix">
    <?php echo do_shortcode( '[page_feature]' ); ?>

    <div id="content" class="site-content">
      <?php echo do_shortcode( '[asu_breadcrumbs]' ); ?>
    	<main id="main" class="site-main" role="main">
          <?php
          while ( have_posts() ) {
            the_post();
            get_template_part( 'content', 'page' );

            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() ) :
              comments_template();
      				endif;
          } // end of the loop.
          ?>
	    </main><!-- #main -->
    </div>
  </div><!-- #main -->
</div><!-- #main-wrapper -->
    <?php
      get_footer();

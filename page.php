<?php get_header(); ?>
<main id="main" role="main" itemscope itemprop="mainContentOfPage">
  <?php
  if (have_posts()) : while (have_posts()) : the_post();
    get_template_part( 'layouts/content', '' );
  endwhile; else :
    get_template_part( 'layouts/content', 'none' );
  endif;
  ?>
</main>
<?php get_footer(); ?>

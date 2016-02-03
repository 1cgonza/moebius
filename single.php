<?php get_header(); ?>
<main id="main" class="moebius-post" role="main" itemscope itemprop="mainContentOfPage">
  <?php
  if (have_posts()) : while (have_posts()) : the_post();
    get_template_part( 'content', get_post_type() );
  endwhile; else :
    get_template_part( 'content', 'none' );
  endif;
  ?>
</main>
<?php get_footer(); ?>
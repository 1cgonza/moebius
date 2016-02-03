<?php get_header(); ?>
<main id="main" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
  <?php if ( is_home() ) : ?>
    <header class="archive-header">
      <h2 class="page-title archive-title" itemprop="headline"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h2>
    </header>
  <?php endif; ?>

  <?php
  if (have_posts()) : while (have_posts()) : the_post();
    get_template_part( 'gallery', get_post_type() );
  endwhile;
    moebius_page_nav();
  else :
    get_template_part( 'content', 'none' );
  endif;
  ?>
</main>
<?php get_footer(); ?>

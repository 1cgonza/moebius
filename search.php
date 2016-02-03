<?php get_header(); ?>

  <main id="main" class="moebius-gallery" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <header class="archive-header">
      <h2 class="page-title archive-title" itemprop="headline">Resultado busqueda: <span class="title-higlight"><?php echo esc_attr( get_search_query() ); ?></span></h2>
    </header>

    <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        get_template_part( 'gallery', '' );
      endwhile;
        moebius_page_nav();
      else :
        get_template_part( 'content', 'none' );
      endif;
    ?>
  </main>

<?php get_footer(); ?>
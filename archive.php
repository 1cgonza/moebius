<?php get_header(); ?>
<main id="main" class="moebius-gallery" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
  <header class="archive-header">
    <h2 class="page-title archive-title" itemprop="headline">
    <?php
      if ( is_category() ) single_cat_title();
      elseif ( is_post_type_archive() ) post_type_archive_title();
      elseif ( is_tax() ) single_term_title();
      elseif ( is_tag() ) single_tag_title();
      elseif ( is_author() ) {
        echo 'Articulos por: ' . get_the_author();
      }
      elseif ( is_day() ) the_time('l, F j, Y');
      elseif ( is_month() ) the_time('F Y');
      elseif ( is_year() ) {
        $year = get_the_time('Y');
        echo $year;
      }
    ?>
    </h2>
  </header>
  <?php
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'gallery', get_post_type() );
  endwhile;
    moebius_page_nav();
  else :
    get_template_part( 'content', 'none' );
  endif;
  ?>
</main>
<?php get_footer(); ?>

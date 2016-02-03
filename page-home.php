<?php
  // Template Name: Inicio
  get_header();

  $vArgs = array(
    'post_type' => 'videos',
    'posts_per_page' => 5
  );

  $bArgs = array(
    'post_type' => 'post',
    'posts_per_page' => 5
  );

  function get_home_section_post($query) {
    global $post;

    $isFirstPost = $query->current_post == 0 ? true : false;
    $postClass = $isFirstPost ? 'home-featured-post' : 'home-regular-post m-all t-all d-1of2 ld-1of2';
    // $imgSize = $isFirstPost ? 'medium-large' : 'medium';

    $article = '<article class="'. $postClass . '">';
      $article .= '<header class="home-post-img">';
        $article .= '<a href="'. get_the_permalink() .'">' . get_the_post_thumbnail($post->ID, 'medium-large') . '</a>';
      $article .= '</header>';

      $article .= '<section class="home-post-title">';
        $article .= '<h3 class="gallery-item-title" itemprop="headline" rel="bookmark">';
          $article .= '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
        $article .= '</h3>';
      $article .= '</section>';

    $article .= '</article>';

    return $article;
  }
?>

<main id="main" class="" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
  <?php
  /*----------  VIDEOS  ----------*/
  $queryVideos = new WP_Query($vArgs);

  if ( $queryVideos->have_posts() ) : ?>
    <section id="recent-videos" class="home-section m-all t-all d-3of5 ld-1of2">
      <h2 class="home-section-title page-title">Videos Recientes</h2>

      <?php while ( $queryVideos->have_posts() ) :
        $queryVideos->the_post();
        $isFirstPost = $queryVideos->current_post == 0 ? true : false;
        $postClass = $isFirstPost ? 'home-post-wrapper moebius-gallery home-featured-post' : 'home-post-wrapper moebius-gallery home-regular-post m-all t-all d-1of2 ld-1of2';

        echo '<div class="' . $postClass . '">';
        get_template_part( 'gallery', 'videos' );
        echo '</div>';
        endwhile;
      ?>

      <span class="home-more-link"><a href="<?php echo get_post_type_archive_link('videos'); ?>" title="Ver m&aacute;s videos">Ver m&aacute;s videos</a></span>
    </section>

  <?php
  wp_reset_postdata();
  endif;

  /*----------  BLOG  ----------*/
  $queryBlog = new WP_Query($bArgs);

  if ( $queryBlog->have_posts() ) : ?>
    <section id="recent-posts" class="home-section blog m-all t-all d-2of5 ld-1of4">
      <h2 class="home-section-title page-title">Entradas Recientes</h2>

      <?php while ( $queryBlog->have_posts() ) :
        $queryBlog->the_post();
        $isFirstPost = $queryBlog->current_post == 0 ? true : false;
        $postClass = 'home-post-wrapper moebius-gallery home-regular-post';

        echo '<div class="' . $postClass . '">';
        get_template_part( 'gallery', 'post' );
        echo '</div>';
        endwhile;

      ?>

      <span class="home-more-link"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" title="Blog">Blog</a></span>
    </section>

  <?php wp_reset_postdata(); endif; ?>
</main>
<?php get_footer(); ?>

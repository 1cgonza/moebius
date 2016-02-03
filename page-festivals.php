<?php
  // Template Name: Festivals
  get_header();

  include_once( ABSPATH . WPINC . '/feed.php' );
  $af = 'http://www.animation-festivals.com/feed/festivals/';
  $awn = 'http://www.awn.com/blogs/sprockets/rss.xml';
  $feed = fetch_feed( array($af, $awn) );
?>

<main id="main" role="main" itemscope itemprop="mainContentOfPage">
  <header class="archive-header">
    <h2 class="page-title archive-title" itemprop="headline"><?php echo get_the_title(); ?></h2>
  </header>

  <?php if (have_posts()) : ?>
  <section class="page-description content-wrapper">
    <?php while (have_posts()) : the_post();
      the_content();
    endwhile; ?>
  </section>
  <?php endif; ?>

  <section class="content-wrapper">
    <?php
      if ( !is_wp_error($feed) ) :
        $maxItems = $feed->get_item_quantity(0);

        if ($maxItems > 0) {
          $items = $feed->get_items(0, $maxItems);

          foreach ($items as $i => $item) {
            $url = $item->get_permalink();
            $desc = $item->get_description();
            $title = $item->get_title();
            $date = $item->get_date();
            $img = $item->get_links();

            $festival = '<article class="festival-item">';
              $festival .= !empty($url) && !empty($title) ? '<h3><a href="' . $url . '" target="_blank">' . $title . '</a></h3>' : '';
              $festival .= !empty($desc) ? '<section class="festival-info">' . $desc . '</section>' : '';
              $festival .= !empty($date) ? '<p class="festival-published-date">Published on: ' . $date . '</p>': '';
            $festival .= '</srticle>';

            echo $festival;
            // var_dump( $img, $url, $desc, $title, $date, '_________________________________');
          }
        }

      endif;
    ?>
  </section>
</main>
<?php get_footer(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-wrapper cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <header class="entry-header">
    <h2 class="entry-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h2>
    <p class="byline bypostauthor">
      <?php
        $date = get_the_time('j \d\e\ F \d\e\ Y ');
        $byLine = 'Publicado el <time class="updated" datetime="' . $date . '">' . $date . '</time>';
        $byLine .= 'por <a href="' . get_author_posts_url( get_the_author_meta('ID') ) . '">' . get_the_author_meta('display_name') . '</a>';
        echo $byLine;
      ?>
    </p>
  </header>

  <section class="entry-content">
    <?php the_content(); ?>
  </section>

  <footer class="entry-footer">
    <div class="footer-box">
      <a href="<?php comments_link(); ?>">
        <?php comments_number( '0 comentarios', '1 comentario', '% comentarios' ); ?>.
      </a>
    </div>

    <?php if ( function_exists('sharing_display') ) : ?>
      <div class="footer-box share-post"><?php sharing_display( '', true ); ?></div>
    <?php endif; ?>
  </footer>

  <?php if ( !is_page() ) comments_template(); ?>
</article>
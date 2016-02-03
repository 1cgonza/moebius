<article id="post-<?php the_ID(); ?>" <?php post_class('content-wrapper cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <?php if ( has_post_thumbnail() ) : ?>
    <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
      <?php the_post_thumbnail('large'); ?>
    </a>
  <?php endif; ?>
  <header class="entry-header">
    <h2 class="entry-title" itemprop="headline" rel="bookmark">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2>
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
    <?php the_excerpt(); ?>
    <span class="highlight-btn"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Sigue leyendo</a></span>
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

</article>
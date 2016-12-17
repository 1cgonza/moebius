<article id="post-<?php the_ID(); ?>" <?php post_class('content-wrapper cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <header class="page-header">
    <h2 class="page-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h2>
  </header>

  <section class="entry-content">
    <?php the_content(); ?>
  </section>

  <footer>
    <p class="tags"><?php the_tags('<span class="tags-title">Etiquetas:</span> ', ', ', ''); ?></p>
    <?php if ( function_exists('sharing_display') ) {
      sharing_display( '', true );
    } ?>
  </footer>

  <?php if ( !is_page() ) comments_template(); ?>
</article>
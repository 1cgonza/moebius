<?php
$descripcion    = get_post_meta( $post->ID, '_cmb2_descripcion', true );
$pdf = get_post_meta( $post->ID, '_cmb2_pdf', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-wrapper cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <header class="entry-header">
    <h2 class="entry-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h2>
  </header>

  <?php  if ($descripcion) : ?>

    <?php echo apply_filters( 'the_content', $descripcion ); ?>

  <?php endif; ?>

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
  <?php comments_template(); ?>
</article>
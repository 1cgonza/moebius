<?php
$video    = get_post_meta( $post->ID, '_cmb2_oembed', true );
$synopsis = get_post_meta( $post->ID, '_cmb2_sinopsis', true );
$tax      = ['director', 'technique', 'country', 'prod_year'];
$meta     = moebius_get_fields($tax);
?>

<?php  if ($video) : ?>
<div class="video-container">
  <div class="video-wrapper">
    <?php echo apply_filters( 'the_content', $video ); ?>
  </div>
</div>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <header class="article-header m-all t-1of2 d-1of3 ld-1of3">
    <h2 class="entry-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h2>

    <ul class="summary-info moebius-years">
      <li class="summary-title"><?php echo $meta['prod_year']; ?></li>
    </ul>

    <ul class="summary-info moebius-direccion">
      <li class="summary-title">Direcci&oacute;n:</li>
      <?php echo $meta['director']; ?>
    </ul>

    <ul class="summary-info moebius-tecnica">
      <li class="summary-title">T&eacute;cnica:</li>
      <?php echo $meta['technique']; ?>
    </ul>

    <ul class="summary-info moebius-pais">
      <li class="summary-title">Pa&iacute;s:</li>
      <?php echo $meta['country']; ?>
    </ul>
  </header>

  <section class="entry-content m-all t-1of2 d-2of3 ld-2of3">
    <?php echo apply_filters( 'the_content', $synopsis ); ?>
  </section>

  <footer class="entry-footer content-wrapper">
    <div class="footer-box">
      <a href="<?php comments_link(); ?>">
        <?php comments_number( '0 comentarios', '1 comentario', '% comentarios' ); ?>.
      </a>
    </div>

    <?php if ( function_exists('sharing_display') ) : ?>
      <div class="footer-box share-post"><?php sharing_display( '', true ); ?></div>
    <?php endif; ?>
  </footer>

  <section class="content-wrapper">
    <?php comments_template(); ?>
  </section>
</article>
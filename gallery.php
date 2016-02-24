<?php
$postType = get_post_type();
$headerText = 'General';
$excerpt = '';

if ($postType == 'post') {
  $headerText = 'Blog';
  $date = get_the_time('j \d\e\ F \d\e\ Y ');
  $postAuthor = get_the_author_meta('display_name', $post->post_author);
  $excerpt = get_the_excerpt();
}
elseif ($postType == 'videos') {
  $headerText = 'Video';

  $excerpt = custom_excerpt( get_post_meta($post->ID, '_cmb2_sinopsis', true), 40 );
  $tax  = ['director', 'prod_year'];
  $meta = moebius_get_fields($tax);
}
elseif ($postType == 'textos') {
  $headerText = 'Texto';
  $excerpt = custom_excerpt( get_post_meta($post->ID, '_cmb2_resumen', true), 40 );
  $tax  = ['director', 'prod_year'];
  $meta = moebius_get_fields($tax);
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('m-all t-1of2 d-1of2 ld-1of3'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <span class="gallery-post-type"><?php echo $headerText; ?></span>

  <?php if ( has_post_thumbnail() ) : ?>
  <section class="gallery-item-img">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium-large'); ?></a>
  </section>
  <?php endif; ?>
  <header class="entry-header">
    <h2 class="entry-title" itemprop="headline" rel="bookmark">
      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </h2>

    <?php if ($postType == 'post') : ?>
    <p class="summary-info"><time datetime="<?php echo $date; ?>"><?php echo $date; ?></time></p>
    <p class="summary-info">Por: <a href="<?php get_author_posts_url( $post->post_author ); ?>"><?php echo $postAuthor; ?></a></p>

    <?php elseif ($postType == 'videos') : ?>
    <ul class="summary-info moebius-years">
      <?php echo $meta['prod_year']; ?>
    </ul>
    <ul class="summary-info moebius-direccion">
      <li class="summary-title">Direcci&oacute;n:</li>
      <?php echo $meta['director']; ?>
    </ul>
    <?php elseif ($postType == 'textos') : ?>
    <ul class="summary-info moebius-years"><?php echo $meta['prod_year']; ?></ul>
    <ul class="summary-info moebius-direccion">Por: <?php echo $meta['director']; ?></ul>
    <?php endif; ?>
  </header>

  <section class="entry-content">
    <p><?php echo $excerpt; ?></p>
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
<?php
$postType = get_post_type();
$headerText = 'General';
$excerpt = '';

if ($postType == 'post') {
  $headerText = 'Blog';
}
elseif ($postType == 'videos') {
  $headerText = 'Video';

  $excerpt = custom_excerpt( get_post_meta($post->ID, '_cmb2_sinopsis', true), 40 );
}
elseif ($postType == 'textos') {
  $headerText = 'Texto';
  $excerpt = custom_excerpt( get_post_meta($post->ID, '_cmb2_resumen', true), 40 );
} else {
  $excerpt = get_the_excerpt();
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
  </header>

  <section class="entry-content">
    <?php echo $excerpt; ?>
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
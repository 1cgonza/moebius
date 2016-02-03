<?php
$pdf         = get_post_meta( $post->ID, '_cmb2_pdf', true );
$externalURL = get_post_meta( $post->ID, '_cmb2_ext_url', true );
$tax         = ['director', 'country', 'prod_year'];
$meta        = moebius_get_fields($tax);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('m-all t-1of2 d-1of2 ld-1of3'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <section class="gallery-item-content">
    <h2 class="gallery-item-title" itemprop="headline" rel="bookmark">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <ul class="summary-info moebius-years"><?php echo $meta['prod_year']; ?></ul>
    <ul class="summary-info moebius-direccion">Por: <?php echo $meta['director']; ?></ul>
    <ul class="summary-info moebius-pais">Pa&iacute;s: <?php echo $meta['country']; ?></ul>

    <?php
      if ($pdf) {
        echo '<p class="highlight-btn"><a href="' . $pdf . '" target="_blank">PDF</a></p>';
      }
      if ($externalURL) {
        echo '<p class="highlight-btn"><a href="' . $externalURL . '" target="_blank">Leer en l&iacute;nea</a></p>';
      }
    ?>
  </section>

</article>
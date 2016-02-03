<?php
$summary     = get_post_meta( $post->ID, '_cmb2_resumen', true );
$pdf         = get_post_meta( $post->ID, '_cmb2_pdf', true );
$externalURL = get_post_meta( $post->ID, '_cmb2_ext_url', true );
$tax         = ['director', 'country', 'prod_year'];
$meta        = moebius_get_fields($tax);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-wrapper cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <header class="article-header">
    <h2 class="entry-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h2>

    <ul class="summary-info moebius-years">
      <li class="summary-title"><?php echo $meta['prod_year']; ?></li>
    </ul>

    <ul class="summary-info moebius-direccion">
      <li class="summary-title">Por:</li>
      <?php echo $meta['director']; ?>
    </ul>

    <?php
      if ($pdf) {
        echo '<p class="highlight-btn"><a href="' . $pdf . '" target="_blank">PDF</a></p>';
      }
      if ($externalURL) {
        echo '<p class="highlight-btn"><a href="' . $externalURL . '" target="_blank">Leer en linea</a></p>';
      }
    ?>
  </header>

  <section class="entry-content">
    <h3>Resumen</h3>
    <?php echo apply_filters( 'the_content', $summary ); ?>
  </section>

  <section>
    <ul class="summary-info moebius-pais">
      <li class="summary-title">Pa&iacute;s:</li>
      <?php echo $meta['country']; ?>
    </ul>
  </section>

  <footer>
    <?php if ( function_exists('sharing_display') ) {
      sharing_display( '', true );
    } ?>
  </footer>

  <?php comments_template(); ?>
</article>
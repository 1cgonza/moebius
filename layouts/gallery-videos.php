<?php
$tax  = ['director', 'technique', 'country', 'prod_year'];
$meta = moebius_get_fields($tax);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('m-all t-1of2 d-1of2 ld-1of3'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <section class="gallery-item-img">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium-large'); ?></a>
  </section>

  <section class="gallery-item-content">
    <h2 class="gallery-item-title" itemprop="headline" rel="bookmark">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>

    <ul class="summary-info moebius-years">
      <?php echo $meta['prod_year']; ?>
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
  </section>
</article>

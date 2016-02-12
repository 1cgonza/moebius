<?php
  // Template Name: Quienes Somos
  get_header();

  $users = get_moebius_users();
  $authors = $users['authors'];
  $groups = $users['groups'];

  function build_authors_group($group) {
    $html = '';
    foreach ($group as $author) {
      $html .= '<div class="author-section">';
        $html .= '<div class="author-img m-all t-1of3 d-1of3 ld-1of4">' . wp_get_attachment_image($author['img'], 'moebius-square') . '</div>';
        $html .= '<div class="author-info m-all t-2of3 d-2of3 ld-3of4">';
          $html .= '<h3 class="author-name"><a href="/?s=' . urlencode( remove_accents($author['name']) ) . '">' . $author['name'] . '</a></h3>';
          $html .= '<p class="author-role">' . $author['role_title'] . '</p>';
          $html .= '<div class="author-bio">' . apply_filters( 'the_content', $author['bio'] ) . '</div>';
        $html .= '</div>';
      $html .= '</div>';
    }

    return $html;
  }

?>

<main id="main" role="main" itemscope itemprop="mainContentOfPage">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('content-wrapper cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
      <header class="page-header">
        <h2 class="page-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h2>
      </header>

      <section class="entry-content">
        <?php the_content(); ?>
      </section>

      <?php
      /*----------  EQUIPO PRINCIPAL  ----------*/
      if ( array_key_exists($groups['principal'], $authors) ) : ?>
      <section class="about-team-group">
        <h2 class="group-title">Equipo Principal</h2>
        <?php echo build_authors_group( $authors[$groups['principal']] ); ?>
      </section>
      <?php endif; ?>

      <?php
      /*----------  COLABORADORES  ----------*/
      if ( array_key_exists($groups['colaborators'], $authors) ) : ?>
      <section class="about-team-group">
        <h2 class="group-title">Colaboradores</h2>
        <?php echo build_authors_group( $authors[$groups['principal']] ); ?>
      </section>
      <?php endif; ?>

      <footer class="page-footer">
        <p class="tags"><?php the_tags('<span class="tags-title">Etiquetas:</span> ', ', ', ''); ?></p>
        <?php if ( function_exists('sharing_display') ) {
          sharing_display( '', true );
        } ?>
      </footer>

    </article>
  <?php
  endwhile; else :
    get_template_part( 'content', 'none' );
  endif;
  ?>
</main>
<?php get_footer(); ?>
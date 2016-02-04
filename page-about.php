<?php
  // Template Name: Quienes Somos
  get_header();

  $usersIDs = get_users( array(
    'orderby' => 'ID',
    'fields' => array('ID'),
    'who' => 'authors'
  ) );

  $groups = array(
    'principal' => '1',
    'colaborators' => '2'
  );

  $authors = [];
  foreach ($usersIDs as $id => $user) {
    $group = get_the_author_meta( '_moebius_user_group', $user->ID );

    if ( !empty($group) ) {
      if ( array_key_exists($group, $authors) ) {
        $authors[$group][] = get_authors_meta_info($user->ID);
      } else {
        $authors[$group] = [];
        $authors[$group][] = get_authors_meta_info($user->ID);
      }
    }
  }

  function get_authors_meta_info($userID) {
    $author = [];
    $author['ID']         = get_the_author_meta( 'ID', $userID );
    $author['bio']        = get_the_author_meta( '_moebius_user_bio', $userID );
    $author['img']        = get_the_author_meta( '_moebius_user_img_id', $userID );
    $author['role_title'] = get_the_author_meta( '_moebius_user_role_title', $userID );
    $author['name']       = get_the_author_meta( 'display_name', $userID );
    $author['url']        = get_the_author_meta( 'user_url', $userID );
    return $author;
  }

  function build_authors_group($group) {
    $html = '';
    foreach ($group as $author) {
      $html .= '<div class="author-section">';
        $html .= '<div class="author-img m-all t-1of3 d-1of3 ld-1of4">' . wp_get_attachment_image($author['img'], 'moebius-square') . '</div>';
        $html .= '<div class="author-info m-all t-2of3 d-2of3 ld-3of4">';
          $html .= '<h3 class="author-name">' . $author['name'] . '</h3>';
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
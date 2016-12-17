<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/library/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/library/images/manifest.json">
    <meta name="msapplication-TileColor" content="#202020">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/ms-icon-144x144.png">
    <meta name="theme-color" content="#202020">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <meta property="fb:app_id" content="906071909507916" />
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

  <header class="header" itemscope itemtype="http://schema.org/WPHeader">
    <h1 id="logo" class="m-1of2 t-1of5 d-1of5 ld-1of5" itemscope itemtype="http://schema.org/Organization">
      <a href="<?php echo home_url(); ?>" rel="nofollow">
        <img src="<?php echo get_template_directory_uri(); ?>/library/images/logo-moebius.svg" alt="<?php bloginfo('name'); ?>">
      </a>
    </h1>

    <div id="menu-icon"><span></span></div>
    <nav id="main-nav" class="m-all t-3of5 d-3of5 ld-3of5" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
      <?php
      wp_nav_menu(array(
        'container'       => false,
        'container_class' => 'menu cf',
        'menu'            => 'Menu Principal',
        'menu_class'      => 'nav top-nav cf',
        'theme_location'  => 'main-nav',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'depth'           => 0,
        'fallback_cb'     => ''
      ));
      ?>
    </nav>

    <div class="search-wrapper m-all t-1of5 d-1of5 ld-1of5">
      <?php get_search_form(); ?>
    </div>
  </header>

  <?php if ( is_archive() ) {
    get_sidebar( get_post_type() );
  } ?>
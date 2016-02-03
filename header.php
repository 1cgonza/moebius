<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
    <meta name="msapplication-TileColor" content="#ebecf4">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
    <meta name="theme-color" content="#3f647b">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
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
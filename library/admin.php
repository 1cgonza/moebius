<?php
/*=================================================
=            DISABLE DASHBOARD WIDGETS            =
=================================================*/
function disable_default_dashboard_widgets() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

  // remove plugin dashboard boxes
  unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
}
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );

/*-----  End of DISABLE DASHBOARD WIDGETS  ------*/

/*====================================
=            CUSTOM LOGIN            =
====================================*/
function moebius_login_css() {
  wp_enqueue_style( 'moebius-login', get_template_directory_uri() . '/library/css/login.min.css', false );
}

function moebius_login_url() {
  return home_url();
}

function moebius_login_title() {
  return get_option('blogname');
}

add_action( 'login_enqueue_scripts', 'moebius_login_css', 10 );
add_filter( 'login_headerurl', 'moebius_login_url' );
add_filter( 'login_headertitle', 'moebius_login_title' );

/*-----  End of CUSTOM LOGIN  ------*/

/*==========  ADMIN FOOTER  ==========*/
function moebius_custom_admin_footer() {
  return '<span id="footer-thankyou">Developed by <a href="http://juancgonzalez.com" target="_blank">Juan Camilo Gonzalez</a></span>.';
}
add_filter( 'admin_footer_text', 'moebius_custom_admin_footer' );
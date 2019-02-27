<?php

/*====================================
=            CUSTOM LOGIN            =
====================================*/
function moebius_login_css() {
  wp_enqueue_style( 'moebius-login', get_template_directory_uri() . '/css/login.min.css', false );
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

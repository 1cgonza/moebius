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

/*====================================
=            EXTEND USERS            =
====================================*/
add_action( 'cmb2_admin_init', 'moebius_register_user_profile_metabox' );
function moebius_register_user_profile_metabox() {
  $prefix = '_moebius_user_';

  $cmb_user = new_cmb2_box( array(
    'id'               => $prefix . 'profile',
    'title'            => 'Perfil de Usuario',
    'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
    'show_names'       => true,
    'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
  ) );

  $cmb_user->add_field( array(
    'name'     => 'Informaci&oacute;n Adicional para usuarios de Moebius Animaci&oacute;n',
    'desc'     => 'Esta informaci&oacute; sera visible en algunas de las paginas, por ejemplo en Quienes Somos.',
    'id'       => $prefix . 'extra_info_title',
    'type'     => 'title',
    'on_front' => false,
  ) );

  $cmb_user->add_field( array(
    'name' => 'Biografia',
    'desc' => '',
    'id'   => $prefix . 'bio',
    'type' => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 10,
      'teeny' => true,
      'media_buttons' => false,
    ),
  ) );

  $cmb_user->add_field( array(
    'name' => 'Imagen de Perfil',
    'desc' => 'La imagen que se publicara en tu perfil.',
    'id'   => $prefix . 'img',
    'type' => 'file',
    'options' => array(
      'url' => false,
      'add_upload_file_text' => 'Buscar archivo',
    ),
  ) );

  if ( current_user_can('edit_pages') ) {
    $cmb_user->add_field( array(
      'name' => 'Rol',
      'desc' => '',
      'id'   => $prefix . 'group',
      'type' => 'select',
      'show_option_none' => true,
      'options' => array(
        '1' => 'Equipo Principal',
        '2' => 'Colaborador',
      ),
    ) );

    $cmb_user->add_field( array(
      'name' => 'Titulo del Rol',
      'desc' => '',
      'id'   => $prefix . 'role_title',
      'type' => 'text',
    ) );
  }

}

/*=====  End of EXTEND USERS  ======*/

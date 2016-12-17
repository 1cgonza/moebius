<?php

add_action('after_switch_theme', 'jcg_flush_rewrite_rules');

function jcg_flush_rewrite_rules() {
  flush_rewrite_rules();
}

// The custom dashicons are at: https://developer.wordpress.org/resource/dashicons/
function moebius_register_cpt($typeName, $singular, $plural, $icon) {
  return register_post_type($typeName,
    array(
      'labels' => array(
        'name'               => $plural,
        'singular_name'      => $singular,
        'all_items'          => 'Todos',
        'add_new'            => 'Agregar Nuevo',
        'add_new_item'       => 'Agregar Nuevo',
        'edit'               => 'Editar',
        'edit_item'          => 'Editar ' . $singular,
        'new_item'           => 'Nuevo ' . $singular,
        'view_item'          => 'Ver ' . $singular,
        'search_items'       => 'Buscar ' . $plural,
        'not_found'          => 'No hay resultados.',
        'not_found_in_trash' => 'No hay nada en la basura',
        'parent_item_colon'  => ''
      ),

      'description'         => '',
      'public'              => true,
      'publicly_queryable'  => true,
      'exclude_from_search' => false,
      'show_ui'             => true,
      'query_var'           => true,
      'menu_position'       => 7,
      'menu_icon'           => $icon,
      'rewrite'             => array( 'slug' => $typeName, 'with_front' => false ),
      'has_archive'         => $typeName,
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'publicize', 'thumbnail', 'comments', 'revisions', 'sticky' ),
      // 'taxonomies'          => array( 'post_tag' )
    )
  );
}

function moebius_register_taxonomy($taxName, $singular, $plural, $types, $slug, $hierarchical) {
  return register_taxonomy($taxName,
    $types,
    array(
      'hierarchical' => $hierarchical,
      'labels' => array(
        'name'              => $singular,
        'singular_name'     => $singular,
        'search_items'      => 'Buscar',
        'popular_items'     => $plural . ' con mayor cantidad de articulos',
        'all_items'         => 'Todos',
        'parent_item'       => 'Parent ' . $singular,
        'parent_item_colon' => 'Parent ' . $singular . ':',
        'edit_item'         => 'Editar ' . $singular,
        'update_item'       => 'Actualizar ' . $singular,
        'add_new_item'      => 'Agregar ' . $singular,
        'new_item_name'     => 'Nuevo ' . $singular,
        'separate_items_with_commas' => 'Separar los ' . $plural . ' con coma.',
        'choose_from_most_used' => 'Ver lista de ' . $plural
      ),
      'show_admin_column' => true,
      'show_ui'           => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => $slug )
    )
  );
}

function custom_post_types() {
  moebius_register_cpt('videos', 'Video', 'Videos', 'dashicons-format-video');
  moebius_register_cpt('textos', 'Texto', 'Textos', 'dashicons-book-alt');
  moebius_register_cpt('eventos', 'Evento', 'Eventos', 'dashicons-tickets-alt');
}
add_action( 'init', 'custom_post_types');

/*----------  YEARS  ----------*/
moebius_register_taxonomy(
  'prod_year',
  'A&ntilde;o',
  'A&ntilde;os',
  array('videos', 'textos'),
  'fecha',
  false
);

/*----------  DIRECTORS  ----------*/
moebius_register_taxonomy(
  'director',
  'Autor',
  'Autores',
  array('videos', 'textos'),
  'autor',
  false
);

/*----------  TECHNIQUES  ----------*/
moebius_register_taxonomy(
  'technique',
  'T&eacute;cnica',
  'T&eacute;cnicas',
  array('videos'),
  'tecnica',
  true
);

/*----------  COUNTRY  ----------*/
moebius_register_taxonomy(
  'country',
  'Pa&iacute;s',
  'Pa&iacute;ses',
  array('videos', 'textos'),
  'pais',
  true
);

function moebius_mb() {
  $prefix = '_cmb2_';

  /*----------  VIDEOS  ----------*/
  $videos = new_cmb2_box(array(
    'id'            => $prefix . 'videos',
    'title'         => 'Video',
    'object_types'  => array( 'videos' ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
  ));

  $videos->add_field(array(
    'id'      => $prefix . 'sinopsis',
    'name'    => 'Sinopsis',
    'type'    => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 10,
      'teeny' => true,
      'media_buttons' => false,
    ),
  ));

  $videos->add_field(array(
    'id'      => $prefix . 'oembed',
    'name'    => 'Video',
    'desc' => 'El enlace (URL) a youtube o Vimeo.',
    'type'    => 'oembed',
    'options' => array(
      'textarea_rows' => 10,
      'teeny' => true,
      'media_buttons' => false,
    ),
  ));

  /**
   *
   * Could be changed to a group to be able to add more than one video to an entry.
   * Sample code below...
   *
   */

  // $oembed_id = $videos->add_field(array(
  //   'id' => $prefix . 'oembed',
  //   'type' => 'group',
  //   'description' => '',
  //   'options' => array(
  //     'group_title' => __('Video {#}'),
  //     'add_button' => 'Nuevo video',
  //     'remove_button' => 'Borrar video',
  //     'sortable' => true
  //   )
  // ));

  // $videos->add_group_field($oembed_id, array(
  //   'name' => 'Video',
  //   'description' => 'El enlace (URL) a YouTube o Vimeo.',
  //   'id' => 'oembed_url',
  //   'type' => 'oembed'
  // ));

  /*----------  TEXTOS  ----------*/
  $textos = new_cmb2_box(array(
    'id'            => $prefix . 'texto',
    'title'         => 'Texto',
    'object_types'  => array( 'textos' ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
  ));

  $textos->add_field(array(
    'id'      => $prefix . 'resumen',
    'name'    => 'Resumen',
    'type'    => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 10,
      'teeny' => true,
      'media_buttons' => false,
    ),
  ));

  $textos->add_field(array(
    'id'   => $prefix . 'pdf',
    'name' => 'PDF',
    'type' => 'file',
    'options' => array(
      'url' => false,
      'add_upload_file_text' => 'Agregar PDF'
    ),
  ));

  $textos->add_field(array(
    'id'   => $prefix . 'ext_url',
    'name' => 'Enlace externo',
    'desc' => '(OPCIONAL) En caso de que no se tenga el PDF y el texto se encuentre publicado en una pagina web, poner aqu&iacute; el enlace (URL).',
    'type' => 'text_url',
  ));

  /*----------  EVENTOS  ----------*/
  $eventos = new_cmb2_box(array(
    'id'            => $prefix . 'eventos',
    'title'         => 'Evento',
    'object_types'  => array( 'eventos' ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
  ));

  $eventos->add_field(array(
    'id'      => $prefix . 'descripcion',
    'name'    => 'Descripción',
    'type'    => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 10,
      // 'teeny' => true,
      // 'media_buttons' => false,
    ),
  ));

  $eventos->add_field(array(
    'id'   => $prefix . 'pdf',
    'name' => 'PDF',
    'type' => 'file',
    'options' => array(
      'url' => false,
      'add_upload_file_text' => 'Agregar PDF'
    ),
  ));

}

add_filter( 'cmb2_admin_init', 'moebius_mb' );

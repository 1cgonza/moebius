<?php

add_action('after_switch_theme', 'jcg_flush_rewrite_rules');

function jcg_flush_rewrite_rules() {
  flush_rewrite_rules();
}

// The custom dashicons are at: https://developer.wordpress.org/resource/dashicons/
function custom_post_types() {
  register_post_type( 'videos',
    array(
      'labels' => array(
        'name'               => 'Videos',
        'singular_name'      => 'Video',
        'all_items'          => 'Todos los Videos',
        'add_new'            => 'Agregar Nuevo Video',
        'add_new_item'       => 'Agregar Nuevo Video',
        'edit'               => 'Editar',
        'edit_item'          => 'Editar Video',
        'new_item'           => 'Nuevo Video',
        'view_item'          => 'Ver Video',
        'search_items'       => 'Buscar Videos',
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
      'menu_position'       => 8,
      'menu_icon'           => 'dashicons-format-video',
      'rewrite'             => array( 'slug' => 'videos', 'with_front' => false ),
      'has_archive'         => 'videos',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'publicize', 'thumbnail', 'comments', 'revisions', 'sticky' ),
      // 'taxonomies'          => array( 'post_tag' )
    )
  );

  register_post_type( 'textos',
    array(
      'labels' => array(
        'name'               => 'Textos',
        'singular_name'      => 'Texto',
        'all_items'          => 'Todos los Textos',
        'add_new'            => 'Agregar Nuevo Texto',
        'add_new_item'       => 'Agregar Nuevo Texto',
        'edit'               => 'Editar',
        'edit_item'          => 'Editar Texto',
        'new_item'           => 'Nuevo Texto',
        'view_item'          => 'Ver Texto',
        'search_items'       => 'Buscar Textos',
        'not_found'          => 'Nothing found in the Database.',
        'not_found_in_trash' => 'Nothing found in Trash',
        'parent_item_colon'  => ''
      ),
      'description'         => '',
      'public'              => true,
      'publicly_queryable'  => true,
      'exclude_from_search' => false,
      'show_ui'             => true,
      'query_var'           => true,
      'menu_position'       => 8,
      'menu_icon'           => 'dashicons-book-alt',
      'rewrite'             => array( 'slug' => 'textos', 'with_front' => false ),
      'has_archive'         => 'textos',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'publicize', 'thumbnail', 'comments', 'revisions', 'sticky'),
      'taxonomies'          => array( 'post_tag' )
    )
  );
}
add_action( 'init', 'custom_post_types');

/*----------  YEARS  ----------*/
register_taxonomy( 'prod_year',
  array('videos', 'textos'),
  array(
    'hierarchical' => false,
    'labels' => array(
      'name'              => 'A&ntilde;o',
      'singular_name'     => 'A&ntilde;o',
      'search_items'      => 'Buscar A&ntilde;o',
      'popular_items'     => 'A&ntilde;os con mayor cantidad de articulos',
      'all_items'         => 'Todos los A&ntilde;o',
      'parent_item'       => 'Parent A&ntilde;o',
      'parent_item_colon' => 'Parent A&ntilde;o:',
      'edit_item'         => 'Editar A&ntilde;o',
      'update_item'       => 'Actualizar A&ntilde;o',
      'add_new_item'      => 'Nuevo A&ntilde;o',
      'new_item_name'     => 'Nuevo A&ntilde;o',
      'separate_items_with_commas' => 'Separar los a&ntilde;os con coma.',
      'choose_from_most_used' => 'Ver lista de a&ntilde;os'
    ),
    'show_admin_column' => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'fecha' )
  )
);

/*----------  DIRECTORS  ----------*/
register_taxonomy( 'director',
  array('videos', 'textos'),
  array(
    'hierarchical' => false,
    'labels' => array(
      'name'              => 'Director(es) / Autor(es)',
      'singular_name'     => 'Autor',
      'search_items'      => 'Buscar Autores',
      'all_items'         => 'Todos los Autores',
      'parent_item'       => 'Parent Autor',
      'parent_item_colon' => 'Parent Autor:',
      'edit_item'         => 'Editar Autor',
      'update_item'       => 'Actualizar Autor',
      'add_new_item'      => 'Nuevo Autor',
      'new_item_name'     => 'Nuevo Autor',
      'separate_items_with_commas' => 'Separar los autores con coma.',
      'choose_from_most_used' => 'Lista de los autores m&aacute;s referenciados.'
    ),
    'show_admin_column' => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'autor', 'with_front' => false )
  )
);

/*----------  TECHNIQUES  ----------*/
register_taxonomy( 'technique',
  array('videos'),
  array(
    'hierarchical' => true,
    'labels' => array(
      'name'              => 'T&eacute;cnicas',
      'singular_name'     => 'T&eacute;cnica',
      'search_items'      => 'Buscar T&eacute;cnicas',
      'all_items'         => 'Todas las T&eacute;cnicas',
      'parent_item'       => 'Pariente T&eacute;cnica',
      'parent_item_colon' => 'Pariente T&eacute;cnica:',
      'edit_item'         => 'Editar T&eacute;cnica',
      'update_item'       => 'Actualizar T&eacute;cnica',
      'add_new_item'      => 'Agregar T&eacute;cnica',
      'new_item_name'     => 'Nueva T&eacute;cnica'
    ),
    'show_admin_column' => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'tecnica' )
  )
);

/*----------  COUNTRY  ----------*/
register_taxonomy( 'country',
  array('videos', 'textos'),
  array(
    'hierarchical' => true,
    'labels' => array(
      'name'              => 'Pa&iacute;ses',
      'singular_name'     => 'Pa&iacute;s',
      'search_items'      => 'Buscar Pa&iacute;ses',
      'all_items'         => 'Todos los Pa&iacute;ses',
      'parent_item'       => 'Pariente Pa&iacute;s',
      'parent_item_colon' => 'Pariente Pa&iacute;s:',
      'edit_item'         => 'Editar Pa&iacute;s',
      'update_item'       => 'Actualizar Pa&iacute;s',
      'add_new_item'      => 'Agregar Pa&iacute;s',
      'new_item_name'     => 'Nuevo Pa&iacute;s'
    ),
    'show_admin_column' => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'pais' )
  )
);

add_filter( 'cmb2_meta_boxes', 'moebius_mb' );

function moebius_mb( array $meta_boxes ) {
  $prefix = '_cmb2_';

  /*----------  VIDEOS  ----------*/
  $meta_boxes['video'] = array(
    'id'            => 'videos',
    'title'         => 'Video',
    'object_types'  => array( 'videos' ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
    'fields'        => array(
      array(
        'name'    => 'Sinopsis',
        'id'      => $prefix . 'sinopsis',
        'type'    => 'wysiwyg',
        'options' => array(
          'textarea_rows' => 10,
          'teeny' => true,
          'media_buttons' => false,
        ),
      ),
      array(
        'name' => 'Video',
        'desc' => 'El enlace (URL) a youtube o Vimeo.',
        'id'   => $prefix . 'oembed',
        'type' => 'oembed',
      ),
    ),
  );

  /*----------  TEXTOS  ----------*/
  $meta_boxes['texto'] = array(
    'id'            => 'texto',
    'title'         => 'Texto',
    'object_types'  => array( 'textos' ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true,
    'fields'        => array(
      array(
        'name'    => 'Resumen',
        'id'      => $prefix . 'resumen',
        'type'    => 'wysiwyg',
        'options' => array(
          'textarea_rows' => 10,
          'teeny' => true,
          'media_buttons' => false,
        ),
      ),
      array(
        'name' => 'PDF',
        'id'   => $prefix . 'pdf',
        'type' => 'file',
        'options' => array(
          'url' => false,
          'add_upload_file_text' => 'Agregar PDF'
        ),
      ),
      array(
        'name' => 'Enlace externo',
        'desc' => '(OPCIONAL) En caso de que no se tenga el PDF y el texto se encuentre publicado en una pagina web, poner aqu&iacute; el enlace (URL).',
        'id'   => $prefix . 'ext_url',
        'type' => 'text_url',
      ),
    ),
  );

  return $meta_boxes;
}
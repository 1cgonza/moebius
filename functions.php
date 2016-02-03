<?php
require_once('library/admin.php');

function moebius_init() {
	add_editor_style();
	require_once('library/custom-post-type.php');
	add_action( 'init', 'moebius_head_cleanup' );
	add_action( 'wp_enqueue_scripts', 'moebius_scripts_and_styles', 999 );
	moebius_theme_support();
	add_action('widgets_init', 'moebius_register_sidebars');
	add_filter('the_content', 'moebius_filter_ptags_on_images');
}
add_action('after_setup_theme', 'moebius_init');

/*==================================
=            CLEAN HEAD            =
==================================*/
function moebius_head_cleanup() {
  // category feeds
  remove_action('wp_head', 'feed_links_extra', 3);
  // post and comment feeds
  remove_action('wp_head', 'feed_links', 2);
  // EditURI link
  remove_action('wp_head', 'rsd_link');
  // windows live writer
  remove_action('wp_head', 'wlwmanifest_link');
  // previous link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  // start link
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  // links for adjacent posts
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  // WP version
  remove_action('wp_head', 'wp_generator');
  // remove WP version from css
  add_filter('style_loader_src', 'moebius_remove_wp_ver_css_js', 9999);
  // remove Wp version from scripts
  add_filter('script_loader_src', 'moebius_remove_wp_ver_css_js', 9999);

  disable_emojis();
}

/*-----  End of CLEAN HEAD  ------*/

/*==========================================
=            SCRIPTS AND STYLES            =
==========================================*/
function moebius_scripts_and_styles() {
  global $wp_styles;

  if ( !is_admin() ) {
    wp_register_style('moebius-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.min.css', array(), '', 'all');

    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    wp_register_script('moebius-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true);
    // Google Fonts
    wp_register_style('google-fonts', 'http://fonts.googleapis.com/css?family=Roboto+Slab:300,700,400');

    wp_enqueue_style('google-fonts');
    wp_enqueue_style('moebius-stylesheet');
    wp_enqueue_script('moebius-js');
  }
}

/*-----  End of SCRIPTS AND STYLES  ------*/

/*=====================================
=            THEME SUPPORT            =
=====================================*/
function moebius_theme_support() {
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(125, 125, true);
  add_theme_support('automatic-feed-links');

  // output the following with HTML5 syntax.
  add_theme_support( 'html5', array('comment-form', 'search-form', 'gallery', 'caption') );

  // remove the title tag from the header.php if this is activated. WP Takes care of that now.
  add_theme_support('title-tag'); // New on WP 4.1

  /*==========  MENUS  ==========*/
  add_theme_support('menus');

  register_nav_menus(
    array(
      'main-nav' => 'Menu Principal',
    )
  );
}

/*-----  End of THEME SUPPORT  ------*/

/*==========  SIDEBARS  ==========*/
function moebius_register_sidebars() {
	register_sidebar(array(
    'id'            => 'main-sidebar',
    'name'          => 'Sidebar Principal',
    'description'   => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));
}

/*======================================
=            JETPACK TWEAKS            =
======================================*/
// http://jetpack.me/2013/06/10/moving-sharing-icons/
function jptweak_remove_share() {
  remove_filter( 'the_content', 'sharing_display',19 );
  remove_filter( 'the_excerpt', 'sharing_display',19 );
}
add_action( 'loop_start', 'jptweak_remove_share' );

/*-----  End of JETPACK TWEAKS  ------*/

/*==========  REMOVE <p> AROUND IMAGES  ==========*/
function moebius_filter_ptags_on_images($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/*==========  REMOVE WP VERSION FROM CSS AND JS  ==========*/
function moebius_remove_wp_ver_css_js($src) {
  if ( strpos($src, 'ver=') )
    $src = remove_query_arg('ver', $src);

  return $src;
}

/*===============================================================
=            TURN A LIST INTO AN ABC DIVIDED SECTION            =
===============================================================*/
function buildABC ($list) {
  $dom = new DOMDocument();
  $dom->loadHTML($list);
  $groups = $dom->getElementsByTagName('li');
  $abc = [];
  $ret = '';
  $listArr = explode('</li>', $list);

  foreach ($groups as $index => $value) {
    $i = $value->nodeValue[0];
    $abc[$i][] = $listArr[$index] . '</li>';
  }

  foreach ($abc as $key => $value) {
    $ret .= '<li class="authors-group"><h4>' . $key .'</h4><ul>';
    $ret .= implode('', $value);
    $ret .= '</ul></li>';
  }

  return $ret;
}
/*=====  End of TURN A LIST INTO AN ABC DIVIDED SECTION  ======*/

/*=======================================
=            PAGE NAVIGATION            =
=======================================*/
function moebius_page_nav() {
  global $wp_query;
  $bignum = 999999999;

  if ( $wp_query->max_num_pages <= 1 ) {
    return;
  } else {
    $newNav = paginate_links( array(
      'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
      'format'    => '?paged=%#%',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $wp_query->max_num_pages,
      'prev_text' => '&larr;',
      'next_text' => '&rarr;',
      'type'      => 'list',
      'end_size'  => 3,
      'mid_size'  => 3
    ) );

    echo $newNav;
  }
}
/*-----  End of PAGE NAVIGATION  ------*/

/*===========================================
=            GET TAXONOMIES INFO            =
===========================================*/
function moebius_get_taxonomies_info($taxonomies) {
  global $post;
  $terms = [];

  if ( !is_array($taxonomies) ) {
    return;
  } else {
    foreach ($taxonomies as $taxonomy) {
      $postTermsIDs = wp_get_post_terms( $post->ID, $taxonomy, array('fields' => 'ids') );

      if ( !is_wp_error($postTermsIDs) ) {
        $order = $taxonomy == 'prod_year' ? 'DESC' : 'ASC';
        $args = array(
          'orderby'    => 'name',
          'order'      => $order,
          'echo'       => 0,
          // 'show_count' => 1,
          'include'    => implode(',', $postTermsIDs),
          'title_li'   => '',
          'taxonomy'   => $taxonomy
        );

        $terms[$taxonomy] = wp_list_categories($args);
      }
    }
  }

  return $terms;
}

function moebius_get_fields ($tax) {
  if ( !is_array($tax) ) {
    return;
  } else {
    global $post;
    $terms = [];

    foreach ($tax as $taxonomy) {
      $postTermsIDs = wp_get_post_terms( $post->ID, $taxonomy, array('fields' => 'ids') );

      // Create the item in the array even before we check if it is empty
      // Avoid errors later when filling the content.
      // As of now I don't mind getting empty fields in the content, this represents all the info is missing
      $terms[$taxonomy] = '';

      if ( !is_wp_error($postTermsIDs) && !empty($postTermsIDs) ) {
        $order = $taxonomy == 'prod_year' ? 'DESC' : 'ASC';
        $args = array(
          'orderby'    => 'name',
          'order'      => $order,
          'echo'       => 0,
          'include'    => implode(',', $postTermsIDs),
          'title_li'   => '',
          'taxonomy'   => $taxonomy
        );

        $terms[$taxonomy] = wp_list_categories($args);
      }
    }

    return $terms;
  }
}

/*-----  End of GET TAXONOMIES INFO  ------*/

/*==========  DEFINE GRID CLASS  ==========*/
function moebius_main_container_class() {
  $mainClass = 'm-all t-all d-4of5 ld-3of5 cf';
  if ( ! is_active_sidebar('main-sidebar') ) {
    $mainClass .= ' no-sidebar';
  }
  echo $mainClass;
}

/*===============================================
=            EXTEND WORDPRESS SEARCH            =
===============================================*/
/**
 * Extend WordPress search to include custom fields
 * http://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 */

/**
 * Join posts and postmeta tables
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
  global $wpdb;

  if ( is_search() ) {
    $join .=' LEFT JOIN ' . $wpdb->postmeta . ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
  }
  return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
  global $pagenow, $wpdb;

  if ( is_search() ) {
    $where = preg_replace(
      "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
      "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );
  }

  return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
  global $wpdb;

  if ( is_search() ) {
      return "DISTINCT";
  }

  return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

/*=====  End of EXTEND WORDPRESS SEARCH  ======*/

/*==============================================
=            FIX MENU HIGHLIGHT FOR            =
==============================================*/
function add_current_nav_class($classes, $item) {
  global $post;

  if ($post) {
    $customPostTypes = array ('videos', 'textos');
    $currentPostType = get_post_type($post->ID);
    $currentPostType = $currentPostType == 'post' ? 'blog' : $currentPostType;
    $menuSlug = strtolower( trim($item->url) );

    // Remove the class 'current_page_parent' from blog
    if ( is_archive() || is_singular($customPostTypes) || is_search() ) {
      $classes = array_diff( $classes, array('current_page_parent') );
    }
    if (!is_search() && strpos($menuSlug, $currentPostType) !== false) {
       $classes[] = 'current-menu-item';
    }

  } else {
    $classes = array();
  }

  return $classes;
}
add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );

/*=====  End of FIX MENU HIGHLIGHT FOR  ======*/

/*======================================
=            CUSTOM EXCERPT            =
======================================*/
function custom_excerpt_length( $length ) {
  return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt($text, $excerpt_length) {
  // EXAMPLE: $leaveTags = '<h1><h2><h3><h4><h5><strong><a><p>';
  $leaveTags = '';
  // This is important, the strip shortcodes needs to be passed before the apply_filters. The latter performs do_shortcode which will cause problems in the excerpt.
  $text = strip_shortcodes($text);
  $text = apply_filters('the_content', $text);
  $text = str_replace('\]\]\>', ']]&gt;', $text);
  $text = preg_replace('#<p>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#', '', $text);
  // strip the content except for the listed tags
  $text = strip_tags($text, $leaveTags);

  $words = explode(' ', $text, $excerpt_length + 1);

  // Custom excerpt with read more link if longer than $excerpt_length
  if (count($words) > $excerpt_length) {
    array_pop($words);
    array_push($words, '[...]');
    $text = implode(' ', $words);
    $text = closeOpenedTags($text);
    return $text;
  } else {
    $text = closeOpenedTags($text);
    return $text;
  }
}

/**
* This function checks if there are any open HTML tags after trimming the excerpt and closes them.
**/

function closeOpenedTags($html) {
  preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
  $openedtags = $result[1];
  preg_match_all('#</([a-z]+)>#iU', $html, $result);
  $closedtags = $result[1];
  $len_opened = count($openedtags);

  if (count($closedtags) == $len_opened) {
    return $html;
  }

  $openedtags = array_reverse($openedtags);

  for ($i=0; $i < $len_opened; $i++) {
    if (!in_array($openedtags[$i], $closedtags)) {
      $html .= '</' . $openedtags[$i] . '>';
    } else {
      unset( $closedtags[array_search($openedtags[$i], $closedtags)] );
    }
  }
  return $html;
}
/*=====  End of CUSTOM EXCERPT  ======*/


/*======================================
=            DISABLE EMOJIS            =
======================================*/
function disable_emojis() {
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

function disable_emojis_tinymce($plugins) {
  if ( is_array($plugins) ) {
    return array_diff( $plugins, array('wpemoji') );
  } else {
    return array();
  }
}
/*=====  End of DISABLE EMOJIS  ======*/

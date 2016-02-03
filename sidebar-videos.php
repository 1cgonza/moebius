<?php
/*===============================
=            FILTERS            =
===============================*/
$currentFilter = is_tax() ? get_queried_object()->taxonomy : '';

$filters = array(
  'country'   => 'Pa&iacute;s',
  'director'  => 'Autor',
  'technique' => 'T&eacute;cnica',
  'prod_year' => 'A&ntilde;o'
);
$data = [];

foreach ($filters as $slug => $name) {
  $order = $slug == 'prod_year' ? 'DESC' : 'ASC';

  $args = array(
    'orderby'    => 'name',
    'order'      => $order,
    'echo'       => 0,
    'show_count' => 1,
    'title_li'   => '',
    'taxonomy'   => $slug
  );

  $terms = wp_list_categories($args);

  if ($slug == 'director') {
    $terms = buildABC($terms);
  }

  $data[$slug] = $terms;
}
/*=====  End of FILTERS  ======*/

?>
<aside id="filters">
  <span class="filters-text">Filtrar por:</span>
  <nav id="filters-nav">
    <ul id="filters-options">
      <?php foreach ($filters as $slug => $name) {
        $current = $currentFilter == $slug ? 'current' : '';
        echo '<li id="filter-btn-' . $slug . '" class="' . $current . '">' . $name . '</li>';
      } ?>
    </ul>
  </nav>

  <div id="filter-contents">
    <?php
      foreach ($filters as $slug => $name) {
        echo '<nav id="filter-content-' . $slug . '" class="filter-section">';
          echo '<ul class="terms-list">';
            echo $data[$slug];
          echo '</ul>';
        echo '</nav>';
      }
    ?>
  </div>

</aside>
/*
Scripts for Moebius Animación
Author: Juan Camilo González
URL: http://juancgonzalez.com
*/

(function($) {
  'use strict';

  function moebiusFilters() {
    var btns = ['country', 'director', 'technique', 'prod_year'];
    var $container = $('#filter-contents');

    btns.forEach(function(ele, i, arr) {
      var $btn = $('#filter-btn-' + ele);
      var $content = $('#filter-content-' + ele);
      var $contentH = $content.height();
      var $sections = $('.filter-section');

      $btn.on('click', function() {
        $(this).toggleClass('open');
        $('#filters-options li').not(this).removeClass('open');
        $container.animate({height: $content.height() + 'px'}, 'fast');

        if ($(this).hasClass('open')) {
          $sections.not($content).fadeOut('fast');
          $content.fadeIn('slow');
        } else {
          $container.animate({height: 0}, 'fast');
          $sections.fadeOut('fast');
          return;
        }
      });
    });
  }

  $(document).ready(function() {
    var $sidebar = $('#filters');
    if ($sidebar.length > 0 && !$sidebar.hasClass('no-sidebar')) {
      moebiusFilters();
    }

    $('#menu-icon').on('click', function() {
      $(this).toggleClass('open');
      $('#main-nav').toggleClass('open');
    });

  });
}(jQuery));

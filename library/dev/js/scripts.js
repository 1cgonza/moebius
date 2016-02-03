/*
Scripts for Moebius Animación
Author: Juan Camilo González
URL: http://juancgonzalez.com
*/

(function ($) {
  "use strict";

  function moebius_filters() {
    var btns = ['country', 'director', 'technique', 'prod_year'];
    var $container = $('#filter-contents');

    btns.forEach(function (ele, i, arr) {
      var $btn = $('#filter-btn-' + ele);
      var $content = $('#filter-content-' + ele);
      var $contentH = $content.height();
      var $sections = $('.filter-section');

      $btn.on('click', function () {
        $(this).toggleClass('open');
        $('#filters-options li').not(this).removeClass('open');
        $container.animate( {height: $content.height() + 'px'}, 'fast' );

        if ( $(this).hasClass('open') ) {
          $sections.not( $content ).fadeOut('fast');
          $content.fadeIn('slow');
        } else {
          $container.animate( {height: 0}, 'fast' );
          $sections.fadeOut('fast');
          return;
        }
      });
    });

    /*====================================
    =            MOUSE EVENTS            =
    ====================================*/
    // $('#main, #filters').on('click', '.cat-item a', function (event) {
    //   event.preventDefault();
    //   var url = $(this).attr('href');
    //   var $main = $('#main');
    //   var title = $(this).text();

    //   history.pushState(getStateObject(url), title, url);

    //   $('.cat-item').removeClass('current-cat');
    //   $(this).closest('li').addClass('current-cat');
    //   $main.addClass('loading');

    //   updateMainContainer(url);
    // });

    // $('#main').on('click', 'a.page-numbers', function (event) {
    //   event.preventDefault();
    //   var url = $(this).attr('href');
    //   var title = $(this).text();

    //   history.pushState(getStateObject(url), title, url);

    //   $('page-numbers').removeClass('current');
    //   $(this).addClass('current');
    //   $('#main').addClass('loading');

    //   updateMainContainer(url);
    // });

    // $('.header a').on('click', function (event) {
    //   event.preventDefault();
    //   var url = $(this).attr('href');
    //   var title = $(this).text();

    //   history.pushState(getStateObject(url), title, url);

    //   $('#menu-main-menu li').removeClass('current-menu-item');
    //   $(this).closest('li').addClass('current-menu-item');

    //   $('#main').addClass('loading');
    //   updateMainContainer(url);
    // });

    // $('#main').on('click', 'a', function (event) {
    //   event.preventDefault();
    //   var url = $(this).attr('href');
    //   var title = $(this).text();

    //   history.pushState(getStateObject(url), title, url);
    //   $('#main').addClass('loading');
    //   updateMainContainer(url);
    // });
    /*=====  End of MOUSE EVENTS  ======*/
  }

  // function updateMainContainer (url) {
  //   $('#main').load(url + ' #content-wrapper', function (data) {
  //     $(this).removeClass('loading');
  //     // // console.log( $('head', data) );
  //     // var $html = $.parseHTML(data);
  //     // var $newHead = $.htmlDoc(data).find('head');
  //     // console.log( $newHead );
  //     // // $('head').html( $newHead );
  //     // if ( $('#content-wrapper').data('sidebar') ) {
  //     //   $(this).attr('class', 'm-all t-all d-3of5 ld-5of7 moebius-gallery');
  //     //   $('#filters').removeClass('no-sidebar');
  //     // } else {
  //     //   $(this).removeClass('loading');
  //     //   $('#main').attr('class', 'm-all t-all d-all ld-all');
  //     //   $('#filters').addClass('no-sidebar');
  //     // }
  //   });

  //   if (window.innerWidth > 1030) {
  //     $('html body').animate( {scrollTop: 0}, 'fast' );
  //   } else {
  //     $('html body').animate( {scrollTop: $('#content-wrapper').offset().top}, 'fast' );
  //   }
  // }

  // function getStateObject (url) {
  //   return {url: url};
  // }

  $(document).ready(function () {
    var $sidebar = $('#filters');
    if ( $sidebar.length > 0 && !$sidebar.hasClass('no-sidebar') ) {
      // var url = window.location.href;
      // history.replaceState(getStateObject(url), document.title, url);
      moebius_filters();
    }

    $('#menu-icon').on('click', function() {
      $(this).toggleClass('open');
      $('#main-nav').toggleClass('open');
    });


    // window.onpopstate = function (event) {
    //   $('#main').addClass('loading');
    //   if (event.state) {
    //     updateMainContainer(event.state.url);
    //   }
    // };
  });
}(jQuery));
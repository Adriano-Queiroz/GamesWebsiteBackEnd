function royal_jewellery_openNav() {
  jQuery(".sidenav").addClass('show');
}
function royal_jewellery_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function royal_jewellery_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const royal_jewellery_nav = document.querySelector( '.sidenav' );

      if ( ! royal_jewellery_nav || ! royal_jewellery_nav.classList.contains( 'show' ) ) {
        return;
      }
      const elements = [...royal_jewellery_nav.querySelectorAll( 'input, a, button' )],
        royal_jewellery_lastEl = elements[ elements.length - 1 ],
        royal_jewellery_firstEl = elements[0],
        royal_jewellery_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && royal_jewellery_lastEl === royal_jewellery_activeEl ) {
        e.preventDefault();
        royal_jewellery_firstEl.focus();
      }

      if ( shiftKey && tabKey && royal_jewellery_firstEl === royal_jewellery_activeEl ) {
        e.preventDefault();
        royal_jewellery_lastEl.focus();
      }
    } );
  }
  royal_jewellery_keepFocusInMenu();
} )( window, document );

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).ready(function() {
  var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
    margin: 0,
    nav:true,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: false,
    dots: false,
    navText : ['<i class="fa fa-lg fa-caret-left"></i>','<i class="fa fa-lg fa-caret-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      },
      1200: {
        items: 1
      }
    },
    autoplayHoverPause : false,
    mouseDrag: true
  });

  var owl = jQuery('.product-sec .owl-carousel');
    owl.owlCarousel({
    margin: 10,
    nav:false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: false,
    dots: false,
    navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      },
      1200: {
        items: 2
      }
    },
    autoplayHoverPause : false,
    mouseDrag: true
  });
})

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
});
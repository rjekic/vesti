  // Custom tab script
  $(document).ready(function() {
      $('.tab-action').click(function() {
          var tabData = $(this).data('tab-cnt');
          // Content
          $('.tab-cnt').removeClass('active');
          $('#' + tabData).toggleClass('active');
          // Actions
          $('.tab-action').removeClass('active');
          $(this).toggleClass('active');
      });
});

  
  //Smooth Scroll
  $(function() {
    $('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
  });



  
  //Slider
  $(document).ready(function(){
      if ($(".owl-3").length > 0) {
          var owl = $(".owl-3");
          owl.owlCarousel({
              items: 3,
              autoplay: true,
              autoplayTimeout: 5000,
              dots: true,
              loop: true,
              responsive: {
                  0: {
                      items: 1,
                      dots: true
                  },
                  479: {
                      items: 2,
                      dots: true
                  },
                  768: {
                      items: 2,
                      dots: true
                  },
                  980: {
                      items: 3
                  },
                  1199: {
                      items: 3
                  }
              },
              //Lazy load
              lazyLoad: false,
              lazyFollow: true,
              lazyEffect: "fade",
              autoplayHoverPause: true
          });
      }
  });


  /* Gallery */
  $(document).ready(function() {
    $('.gallery-link').magnificPopup({
      type: 'image',
      gallery:{
        enabled:true
      }
    });
  });


  /* Responsive Menu */
  $(document).ready(function() {
    $('.main-header .wrap > ul > li').click(function(e) {
          e.preventDefault();
          $(this).find('.sub').toggleClass('active');
    });

    $('.main-header .sub.active > li').click(function(e) {
          e.preventDefault();
          $(this).find('.third').addClass('active1');
    });

  });




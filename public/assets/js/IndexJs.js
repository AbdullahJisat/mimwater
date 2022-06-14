
        AOS.init({
            duration: 1500,
            })
            AOS.init({disable: 'mobile'});
            $(document).ready(function() {
                $('.card-carousel1').slick({
                    speed: 500,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: false,
                    autoplaySpeed: 1000,
                    dots: true,
                    // centerMode: true,
                    responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            // centerMode: true,
    
                        }
    
                    }, {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            infinite: true,
    
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            infinite: true,
                            autoplay: false,
                            autoplaySpeed: 2000,
                        }
                    }]
                });
            });
    
    
    $('.counting').each(function() {
      var $this = $(this),
          countTo = $this.attr('data-count');
      
      $({ countNum: $this.text()}).animate({
        countNum: countTo
      },
    
      {
    
        duration: 3000,
        easing:'linear',
        step: function() {
          $this.text(Math.floor(this.countNum));
        },
        complete: function() {
          $this.text(this.countNum);
    
        }
    
      });  
      
    
    });
    $(document).ready(function() {
        $('.card-carousel').slick({
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1000,
            dots: true,
            // centerMode: true,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    // centerMode: true,

                }

            }, {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true,
                    infinite: true,

                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 2000,
                }
            }]
        });
    });


    $(document).ready(function() {
      $('.carousel2').slick({
          speed: 500,
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 1000,
          dots: false,
          // centerMode: true,
          responsive: [{
              breakpoint: 1024,
              settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1,
                  // centerMode: true,

              }

          }, {
              breakpoint: 800,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  dots: true,
                  infinite: true,

              }
          }, {
              breakpoint: 480,
              settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  dots: true,
                  infinite: true,
                  autoplay: false,
                  autoplaySpeed: 2000,
              }
          }]
      });
  });



  $(document).ready(function() {
    $('.carousel3').slick({
        speed: 500,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        dots: false,
        // centerMode: true,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
                // centerMode: true,

            }

        }, {
            breakpoint: 800,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
                dots: true,
                infinite: true,

            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
                dots: false,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 2000,
            }
        }]
    });
});

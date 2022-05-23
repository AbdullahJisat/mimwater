<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meem Super Drinking Water</title>
    <link rel="stylesheet" href="{{asset('assets/css/logIn.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/navBar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/ourProducts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/newpage.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    

</head>

<body style="background-color: #ddefff; margin: 0;padding: 0;">
    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer')


    <!---------------------------------- js ------------------------------------->
    <script src="{{asset('assets/js/IndexJs.js')}}"></script>
    <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
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
    </script>
    <script>
        

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
</script>
<script>
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
</script>
<script>

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

</script>
<script>

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
</script>

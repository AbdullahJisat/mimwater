<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="newpage.css">
    <link rel="stylesheet" href="style.css"> 
</head>
<body style="background-color: #DDEFFF;">
    <section class="NewPage-sec1">
        <img   src="image/slider1.jpg" alt="" width="100%" height="550px">
    </section>
    <section class="container NewPage-sec2">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-md-12 mx-auto">
        <p class="row1-header">
             Fishing Company Details
        </p>
        <p>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </p>
            </div>
            <div class="col-lg-5 col-md-12 mx-auto">
                <img src="image/newPageImage.jpg" alt="" width="100%">
            </div>
        </div>

        
    </section>
    <section class="container NewPage-sec2">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-md-12 mx-auto">
                <img src="image/newPageImage.jpg" alt="" width="100%">
            </div>
            <div class="col-lg-5 col-md-12 mx-auto">
                <p class="row1-header">
                    Fishing Company Details
               </p>
               <p>
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            </p>
            </div>
        </div>
    </section>
    <section class="container NewPage-sec3">
        <div class="wrapper">
            <div class="carousel card-carousel4">
                <div class="card"> 
                    <img src="image/Slider-Image2/SlideImage1.jpg" alt="" width="100%" height="265px">
                </div>
                <div class="card"> 
                    <img  src="image/Slider-Image2/SlideImage2.jpg" alt="" width="100%" height="265px">
                 </div>
                 <div class="card"> 
                    <img src="image/Slider-Image2/SlideImage3.jpg" alt="" width="100%" height="265px">
                </div>
                <div class="card"> 
                    <img  src="image/Slider-Image2/SlideImage4.jpg" alt="" width="100%" height="265px">
                 </div>
                 <div class="card"> 
                    <img  src="image/Slider-Image2/SlideImage2.jpg" alt="" width="100%" height="265px">
                 </div>
                 <div class="card"> 
                    <img src="image/Slider-Image2/SlideImage3.jpg" alt="" width="100%" height="265px">
                </div>
            
             </div>
        </div>
    </section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
    $('.card-carousel4').slick({
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

</body>
</html>
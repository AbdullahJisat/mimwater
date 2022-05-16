@extends('frontend.layouts.master')
@section('content')
  <h1 style="font-size:50px; text-align: center; margin-top: 50px; font-weight: bolder;padding-bottom: 20px; border-bottom: 1px solid rgba(167, 167, 167, 0.596);">Gallery</h1>
    <div class="row ImageFlex-P mx-auto g-3">
            <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
            <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
             </div>
             <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
            <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_2.jpg" />
             </div>
             <div  class="modalimage col-lg-4 col-md-6 col-sm-12 ">
            <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
             </div>
             <div  class="modalimage col-lg-4 col-md-6 col-sm-12 ">
            <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_2.jpg" />
            </div>
            <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
              <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
              <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
              <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
              <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
              <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
              <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
              <div class="modalimage col-lg-4 col-md-6 col-sm-12 ">
                <img class="modal-target1" alt="Img 1" src="image/ProductionImage/Blueaqua_1.jpg" />
              </div>
      
      
      
      
      
            </div>
         
    

      <div id="modal1" class="modal1">
        <span id="modal-close1" class="modal-close1">&times;</span>
        <img id="modal-content1" class="modal-content1">
        <div id="modal-caption1" class="modal-caption1"></div>
      </div>
      <script>
     
        var modal = document.getElementById('modal1');

        var modalClose = document.getElementById('modal-close1');
        modalClose.addEventListener('click', function() { 
         modal.style.display = "none";
        });

        document.addEventListener('click', function (e) { 
         if (e.target.className.indexOf('modal-target1') !== -1) {
      var img = e.target;
      var modalImg = document.getElementById("modal-content1");
      var captionText = document.getElementById("modal-caption1");
      modal.style.display = "block";
      modalImg.src = img.src;
      captionText.innerHTML = img.alt;
   }
});

      </script>
@endsection
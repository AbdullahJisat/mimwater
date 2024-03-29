@extends('frontend.layouts.master')
@section('title', 'Meem Super Drinking Water')
@section('content')
<section class="sec1">
    <!--<iframe width="100%" height="540vh" src="https://www.youtube.com/embed/OCxF0Xu_9qc?autoplay=1&mute=1"-->
    <!--    title="YouTube video player" frameborder="0"-->
    <!--    allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
    
    <video width="100%" height="540vh" controls autoplay loop>
  <source src="{{asset('frontend/image/home.mp4')}}" type="video/mp4" >
    <source src="movie.ogg" type="video/ogg">

</video>
    <div class="content">
        <div class="another--three-blocks">
            <a class="blockone" href="{{ route('news_event') }}">News & Events</a>
            <a class="blocktwo" href="{{ route('career') }}">Career</a>
            <a class="blockthree" href="{{ route('gallery') }}"> Gallery</a>
        </div>
    </div>

</section>

<section class="sec2 row">
    <div class="slider2 col-lg-5  col-md-11  col-sm-11 mx-auto">
        <div class="rowImage">
            <img style="width: 100%;" src="{{$about->image}}">
            {{-- <button type="button" class="btn btn-primary btn-lg jwuButton">Join with us</button> --}}
        </div>
    </div>
    <div class="content1 col-lg-5 col-md-11 col-sm-11 mx-auto">
                <div class="content1-sec">
            <p class="content1-text">WELCOME TO <br><span>
                MEEM SUPER DRINKING WATER</span></p>
          <p style="text-align:justify;font-size:20px;margin-top:20px;">{{$about->description}}</p>
            
        </div>
    </div>
</section>

<section class="sec3">
    <div class="wrapper">
        <div class="carousel card-carousel">
            @foreach ($items as $item)

            <div class="card">
                <img class="cardImg" src="{{ (!empty($item->image)) ? $item->image : asset('noImage.png') }}" alt="">
                <p
                    style="text-align: center; font-weight: bold; color: rgb(92, 92, 92); padding-bottom: 5px; font-size: 20px; margin-bottom: 0px;">
                    {{ $item->name }}</p>
                
            </div>
            @endforeach
        </div>
    </div>
</section>

<h1 style="text-align: center; margin-top: 85px;">সেবা গ্রহণকারী</h1>

<section id="counter-stats" class="wow fadeInRight" data-wow-duration="1.4s">
    <div class="container">
        <div class="row mx-auto">

            <div class="col-lg-4 stats ">

                <div class="counting" data-count="2000">0</div>
                <h5>সেবা গ্রহণকারী</h5>
            </div>

            <div class="col-lg-4 stats">
                <div class="counting" data-count="700">0</div>
                <h5>চলমান সেবা</h5>
            </div>

            <div class="col-lg-4 stats">
                <div class="counting" data-count="2000">0</div>
                <h5>আমাদের সাথে যুক্ত</h5>
            </div>


        </div>

    </div>

</section>

<section class="sec5-review">
    <h1 style="text-align: center; font-weight: bold;padding-bottom: 30px;">Clients Review</h1>
    <div class="wrapper2">
        <div class="carousel2">

            @foreach ($clientReviews as $clientReview)
            <div class="review-card">
                <div class="review-text">
                    <p>
                        {!! $clientReview->review !!}
                    </p>
                </div>
                <div class="reviewer">
                    <img src="{{ (!empty($clientReview->image)) ? $clientReview->image : asset('noImage.png') }}">
                    <div class="reviwer-name">
                        <p
                            style="font-size: 20px; font-weight: bold; color: #58605C; text-align: left; margin-bottom: 0px;">{{ $clientReview->client_name }}</p>
                        <p style="font-size: 15px; color: #58605C; text-align: left;padding:0px; margin:0px;">{{ $clientReview->designation->name }}</p>
                       <p style="font-size: 15px; color: #58605C; text-align: left; padding:0px; margin:0px;"> {{ $clientReview->company_name }}</p>
                    </div>
                </div>
                <div style="float: right; background-color: red; border-radius: 50%;; padding: 7px; margin: 10px;">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="sec6-partner">

    <h1 style="text-align: center; font-weight: bold;padding-bottom: 30px;">Our Clients</h1>

    <div class="title-div pb-4">
        <span class="bottom-icon"><i class="fas fa-arrow-alt-circle-left"></i><span class="p-1"></span><i
                class="fas fa-arrow-alt-circle-right"></i></span>
    </div>
    <div class="wrapper3">
        <div class="carousel3">
            @foreach ($clients as $client)
            <div class="clients-logo">
                <img src="{{$client->image}}">
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

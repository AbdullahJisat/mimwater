@extends('frontend.layouts.master')
@section('title', 'Meem Super Drinking Water')
@section('content')
<section class="sec1">
    <iframe width="100%" height="540vh" src="https://www.youtube.com/embed/OCxF0Xu_9qc?autoplay=1&mute=1"
        title="YouTube video player" frameborder="0"
        allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
            <img style="width: 100%;" src="{{ asset('frontend') }}/image/slider2/slider21.jpg">
            {{-- <button type="button" class="btn btn-primary btn-lg jwuButton">Join with us</button> --}}
        </div>
    </div>
    <div class="content1 col-lg-5 col-md-11 col-sm-11 mx-auto">
        <div class="content1-sec">
            <p class="content1-text">WELCOME TO <br><span>
                MIM DRINKING WATER</span></p>
            <p class="content1-text2">MIM DRINKING WATER<span>Drinking Water – Drink The Difference </span></p>
            <p style="text-align: center; margin-top: 40px; ">
                The pure drinking water we produce is strictly quality controlled <br> by experienced chemists and
                microbiologists in our laboratory <br> at the <span style="font-weight: bold;">MIM DRINKING WATER</span>
                drinking water factory, which is tested
                by <br> BUET and ICDDR, It is marketed under the authorization of <br> Bangladesh Standards &
                Testing Institution (BSTI). <br>

                <br>
            </p>
            <p style="text-align: center; margin-top: 20px; ">
                Skilled sales and suppliers in our transportation system are <br> always ready to deliver <span
                    style="font-weight: bold;">MIM DRINKING WATER</span> drinking water jars & small <br> bottles to your
                office, factory, residence, hospital, restaurant,
                <br> shopping center and etc.
            </p>
            <p style="text-align: center; margin-top: 20px; ">Wash your hands well before meals, follow hygiene
                rules, and <br> always drink <span style="font-weight: bold;">MIM DRINKING WATER</span> drinking water to
                stay healthy.</p>
            <div class="readMore">
                <a href="#">READ MORE</a>
            </div>
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
                <p style="color: #b1b1b1; font-weight: bold;">(coming soon)</p>
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

                <div class="counting" data-count="900000">0</div>
                <h5>সেবা গ্রহণকারী</h5>
            </div>

            <div class="col-lg-4 stats">
                <div class="counting" data-count="280">0</div>
                <h5>চলমান সেবা</h5>
            </div>

            <div class="col-lg-4 stats">
                <div class="counting" data-count="999">0</div>
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
                            style="font-size: 30px; font-weight: bold; color: #58605C; text-align: left; margin-bottom: 0px;">{{ $clientReview->clientName }}</p>
                        <p style="font-size: 15px; color: #58605C; text-align: left;">{{ $clientReview->designation->name }}, {{ $clientReview->company_name }}</p>
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
                <img src="{{ (!empty($client->image)) ? $client->image : asset('noImage.png') }}">
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

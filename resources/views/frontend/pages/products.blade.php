@extends('frontend.layouts.master')
@section('title', 'Products')
@section('content')
<section class="content">
    <div class="sec">
        <div class="sec1 row mx-auto g-3">
            @foreach ($items as $item)
            <div class="sec1-card col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card-content">
                    <img class="cardImg1" src="{{ (!empty($item->image)) ? $item->image : asset('noImage.png') }}" width="80%" alt="">
                    <p style="text-align: center; font-weight: bold; color: rgb(1, 29, 29); font-size: 20px;">{{ $item->name }}</p>
                    <p
                        style=" text-align:center; font-size: 30px; font-weight: bold; color: red; padding-bottom: 12px;">
                        (coming soon)</p>
                </div>

            </div>
            @endforeach
        </div>

        {{-- <div class="sec2 row mx-auto g-3">
            <div class="sec1-card1 col-lg-6 col-md-6 col-sm-12 col-xs-12 g-3">
                <div class="card-content">
                    <img class="cardImg1" src="{{ asset('frontend') }}/image/cardImage/Blue-Aqua-2-Litter-Bottle-110x300.png" alt="">
                    <p style="text-align: center; font-weight: bold; color: rgb(1, 29, 29); font-size: 20px;">300 ML
                        Bottle</p>
                    <p
                        style=" text-align:center; font-size: 30px; font-weight: bold; color: red; padding-bottom: 12px;">
                        (coming soon)</p>
                </div>

            </div>
            <div class="sec1-card1 col-lg-6 col-md-6 col-sm-12 col-xs-12 g-3">
                <div class="card-content">
                    <img class="cardImg1" src="{{ asset('frontend') }}/image/cardImage/Blue-Aqua-Jar-19-Litter-160x300.png" alt="">
                    <p
                        style="text-align: center; font-weight: bold; color: rgb(1, 29, 29); font-size: 20px;padding-bottom: 72px;">
                        300 ML Bottle</p>
                </div>

            </div>
        </div> --}}
    </div>
</section>
@endsection

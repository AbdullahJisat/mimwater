@extends('frontend.layouts.master')
@section('title', 'Contact')
@section('content')
<section class="content">
    <div class="container">
        <div class="row d-flex justify-content-center mx-auto">
            <div class="col-sm-12 col-lg-5 contact-details">
                <div class="contact-details-all">
                    <h2 style="text-align: center;margin-top: 10px; margin-bottom: 20px;">
                        CONTACT INFO
                    </h2>
                          <div class="CONTACT-INFO">
                        <div class="CONTACT-INFO-1" style="display: flex;">
                            <i style="padding-left: 20px; font-size:28px;" class=" fa fa-mobile-android-alt"></i>
                            <div>
                                <p style="font-size:21px; font-weight: bold;">Phone</p>
                                <p style="font-size:17px; font-weight: lighter;">+88 01715-676677 </p>
                            </div>
                        </div>
                        <div class="CONTACT-INFO-1" style="display: flex;">
                            <i class=" fa fa-mail-bulk"></i>
                            <div>
                                <p style="font-size:21px; font-weight: bold;">Email Adress</p>
                                <p style="font-size:17px; font-weight: lighter;">meemsuperwater@gmail.com</p>
                            </div>
                        </div>
                        <div class="CONTACT-INFO-1" style="display: flex;">
                            <i class=" fa fa-home"></i>
                            <div>
                                <p style="font-size:21px; font-weight: bold;">Factory</p>
                                <p style="font-size:17px; font-weight: lighter;">Joy Food & Bevarage Industry, Plot No. B/8, Block-b, Nasirabad Shilpo Area, <br>
                                    Sholashahar, Chattogram, <br> Bangladesh.</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class=" col-sm-12 col-lg-7">
                <div>
                    <div class="contact-form-wrapper  contactUsForm">
                        <form action="{{ route('contact_store') }}" class="contact-form" method="post">
                            @csrf
                            <h5 class="title">Contact us</h5>
                            <div>
                                <input type="text" class="form-control rounded border-white mb-3 form-input" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div>
                                <input type="email" class="form-control rounded border-white mb-3 form-input"
                                    placeholder="Email" name="email" required>
                            </div>
                            <div>
                                <textarea id="message" class="form-control rounded border-white mb-3 form-text-area" name="message" rows="5" cols="30" placeholder="Message" required></textarea>
                            </div>
                            <div class="submit-button-wrapper">
                                <input type="submit" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

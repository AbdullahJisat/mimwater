@extends('frontend.layouts.master')
@section('title', 'Totally Quality Assurance')
@section('content')
<section class="content">
    <h4
        style="text-align:center; color: #6EC1E4; font-size: 35px; font-weight: bold;font-family: Arial, Helvetica, sans-serif; margin-bottom: 10px;margin-top: 100px;">
        Total Quality Assurance</h4>
    <p class="content-P">
        Our Quality Assurance consists of Quality Control Department and Quality Compliance. Our quality control
        laboratory is well-equipped with modern instruments which are calibrated on regular basis. Our well-trained
        personnel continuously monitors and check the products on every single stage of production to ensure the best
        quality of product. All processes are strictly followed under the proper guidelines of cGMP.
    </p>
    <div class="row TQAss">
        <div class="col-lg-7 col-sm-12">
            <img style="margin-left: 110px;" src="{{ asset('frontend') }}/image/Quality-Assurance.jpg" alt="">
        </div>
        <div class="col-lg-5 col-sm-12">
            <img src="{{ asset('frontend') }}/image/Quality-Assurance2.png" alt="">
        </div>
    </div>
    <h4
        style="text-align:center; color: #6EC1E4; font-size: 35px; font-weight: bold;font-family: Arial, Helvetica, sans-serif; margin-bottom: 10px;margin-top: 100px;">
        Specialties of Meem Drinking Water</h4>
    <p class="content-P">
        Source of raw water is our own deep tube-well at 800 ft. below the ground. The collected deep water is then
        processed through our high-tech water purification process involves high quality quartz sand filtration,
        activated carbon filtration, micro-filtration, Reverse osmosis filtration for chemical purification and for
        microbiological purification with UV and ozone sterilization. The whole process is automatic & untouched human
        hands. In addition to normal remove of 100% micro biological pollutants and 98% Total Dissolved Solid (TDS) the
        system also removes inorganic or organic toxic chemicals including cancer causing agents. Our water is Arsenic
        free, tested by BSTI & BCSIR, Institute of food science, Dhaka University and ICDDRB. Our water is meticulously
        quality controlled and BSTI approved. Also approved by the Department of Environment, Government of Bangladesh.
       
    </p>
  

</section>
@endsection

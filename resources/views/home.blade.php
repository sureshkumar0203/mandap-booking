@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')

@include('includes.home-slider')

<!--Service Section -->
<section class="container clearfix common-pad-about nasir-style">
   <div class="sec-header sec-header-pad">
      <h2>Services</h2>
      <h3>Pick a service that best suits your budget</h3>
   </div>

   <div class="room-slider">
      <div class="roomsuite-slider-two">
         @foreach($service_cat as $service_det)
         <a href="{{ asset('/services')}}" style="text-decoration:none;">
         <div class="room-suite room-suite-htwo">
            <div class="item">
               <div class="ro-img">
               <img src="{{ asset('public/service-category-photo/thumb/'.$service_det->category_photo) }}" class="img-responsive" alt=""></div>
               <div class="ro-txt">
                  <h2>{{ $service_det->category_name }}</h2>
               </div>
            </div>
         </div></a>
         @endforeach
      </div>
   </div>
</section>

<!--About Us Section -->
<div class="resot-activities clearfix">
   <div class="container clearfix common-pad">
      <div class="row">
         <div class="col-lg-6 col-md-6 activities-cont">
            <div class="sec-header3">
               <h2>Welcome To SR Valley</h2>
            </div>
            
            {!! str_limit($abt_det[0]->content,376) !!}
          
            <p><a href="{{ url('about-us') }}" class="res-btn">Read more<i class="fa fa-arrow-right"></i></a></p>
         </div>
         <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="row nasir-welboxes text-center">
               <img src="{{ asset('public/images/about-wedding.png') }}" class="ab-img">
            </div>
         </div>
      </div>
   </div>
</div>

<!--Gallery Selction-->
<section class="our-galler-htwo clearfix common-pad">
   <div class="container clearfix">
      <div class="sec-header sec-w-header">
         <h2>Our Gallery</h2>
      </div>
      <div class="clearfix"></div>
   </div>
   
   <div class="fullwidth-silder">
      <div class="fullwidth-slider">
         @foreach($gallery_det as $gallery_dtls)
          <div class="item">
            <img src="{{ asset('public/gallery-photo/thumb/'.$gallery_dtls->gallery_photo) }}" class="gallery-img" alt="{{ $gallery_dtls->photo_title }}">
             
            <div class="this-overlay">
               <div class="this-texts">
                  <a href="{{ asset('public/gallery-photo/thumb/'.$gallery_dtls->gallery_photo) }}" class="fancybox" rel="help" title="{{ $gallery_dtls->photo_title }}"><i class="icon icon-Search"></i></a>
               </div>
            </div>
          </div>
         @endforeach
      </div>
   </div>
</section>

<!--Newsletter Section-->
<div class="nasir-subscribe-form-row row">
   <div class="container">
      <div class="row this-dashed">
        <div class="this-texts">
          <h2>STAY TUNED WITH US</h2>
          <h3>Get our updated offers, discounts, events and much more!</h3>
        </div>
        
        <div class="this-form input-group">
          {!! Form::email('news_ltr_email',old('news_ltr_email'), array('id' => 'news_ltr_email','required', 'maxlength' => 150,'class'=>'form-control','placeholder'=>'Enter your email address','autocomplete' => 'off')) !!}
          <span class="input-group-addon">
          <button type="button" class="res-btn" onclick="newsletterValidation();">subscribe<i class="fa fa-arrow-right"></i></button>
          </span>
        </div>
      </div>
   </div>
</div>

@stop
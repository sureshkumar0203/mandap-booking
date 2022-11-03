@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')

<section class="row final-inner-header" style="background: url({{ asset('public/images/inner-header-service.jpg') }}) no-repeat scroll center bottom;">
  <div class="container">
      <h2 class="this-title">Services</h2>
  </div>
</section>

<section class="clearfix news-wrapper">
  <div class="container clearfix common-pad">
    <div class="row">
      <div class="col-md-12">
        <div class="sec-header3">
           <h2>Services</h2>
           <h3>Pick a service that best suits your budget</h3>
        </div>
      </div>
       
      <div class="col-lg-12 col-md-12 col-xs-12">
        @foreach($service_cat as $service_det)
        <div class="room-wrapper">
          <div class="media">
            <div class="media-left">
               <a href="#"><img src="{{ asset('public/service-category-photo/thumb/'.$service_det->category_photo) }}" alt=""></a>
            </div>
             
            <div class="media-body">
               <h2>{{ $service_det->category_name }}</h2>
               {!! $service_det->abt_ser_cat !!}
            </div>   
          </div>
        </div>  
        @endforeach   
      </div>
    </div>
  </div>
</section> 
@stop
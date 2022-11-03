@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')

<section class="row final-inner-header">
  <div class="container">
      <h2 class="this-title">About us</h2>
  </div>
</section>
 
<section class="container clearfix common-pad about-info-box"> 
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <div class="sec-header3">
          <h2>About SR Valley</h2>
          <!--<h3>Pick a room that best suits your taste and budget</h3>-->
      </div>
      
      {!! $about_det[0]->content !!}
    </div>
        
    <div class="col-sm-4 hidden-xs">
      <div class="img-cap-effect">
        <div class="img-box">
            <img src="{{ asset('public/images/1.jpg') }}" alt="">
            <div class="img-caption"></div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop

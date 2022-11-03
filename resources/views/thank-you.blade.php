@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')

<section class="row final-inner-header">
  <div class="container">
      <h2 class="this-title">Thank You</h2>
  </div>
</section>
 
<section class="container clearfix common-pad about-info-box"> 
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:#030;">
      Thank you.Your Booking has been placed successfully.<br />
      Please check your mail to get your booking detauls.
      </h2>
    </div>
  </div>
</section> 

@stop
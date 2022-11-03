@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')


<section class="resot-activities clearfix common-pad">
  <div class="container">
    <div class="sec-header3 text-center"><h2>Our Gallery</h2></div>
  </div>
           
  <div class="container">
    <div class="gal">
    @foreach($gallery_det as $gallery_dtls)
    <div class="item col-md-3">
      <img src="{{ asset('public/gallery-photo/thumb/'.$gallery_dtls->gallery_photo) }}" class="gallery-img" alt="{{ $gallery_dtls->photo_title }}">
      
      <div class="this-overlay">
        <div class="this-texts">
          <a href="{{ asset('public/gallery-photo/thumb/'.$gallery_dtls->gallery_photo) }}" class="fancybox" rel="help" title="{{ $gallery_dtls->photo_title }}"><i class="icon icon-Search"></i></a>
          {{ $gallery_dtls->photo_title }}
        </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>
</section>  
@stop
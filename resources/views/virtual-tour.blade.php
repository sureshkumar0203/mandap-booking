@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')



<iframe src="{{ asset('public/virtual-tour/index.html') }}" style="width:100%; height:600px; position:relative; border:0px;"></iframe>


  
@stop


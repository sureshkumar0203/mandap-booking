@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')

<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Edit photo Gallery</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-pencil-square-o"></i> Edit photo Gallery</h4> </div>
                <div class="widget-content">
                    <div class="col-xs-12 col-sm-12">
                      <div style="height:20px;">
                        @if (Session::has('success'))
                            <span style="color:#090;">Records has been saved successfully.</span>
                        @endif
                        
                        @if (Session::has('blank'))
                            <span style="color:#F00;">Please enter all * marked controls values.</span>
                        @endif
                        
                         @if (Session::has('exist'))
                            <span style="color:#F00;">This category name already exist.</span>
                        @endif
                        
                        @if (Session::has('invformat'))
                            <span style="color:#F00;">Please upload correct file format.</span>
                        @endif
                      </div>
                    
                      {{ Form::open(array('url' => 'update-photo-gallery', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_gp', 'id' => 'frm_gp','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      
                      {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!}
                          
                       <div class="form-group col-md-8">
                      <label>Photo Title*:</label> 
                     {!! Form::text('photo_title',$data[0]->photo_title,array('id' => 'photo_title','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                      <div class="form-group col-md-8">
                        <label>Upload  Photo*:</label> 
                        {!! Form::file('gallery_photo', array('id' => 'gallery_photo','', 'class'=>'','placeholder'=>'')) !!}
                        <span style="color:#F00;">
                        Note : For better quality photo  <strong>width = </strong> 990 &  <strong>Height =</strong> 665<br>
                        Upload only <strong>png,jpg,jpeg</strong> extension banner.
                        </span>
                      </div>
                      <div class="clearfix"></div>
                        
                        
                      <div class="form-group col-md-8">
                        <img src="{{ asset('public/gallery-photo/thumb/'.$data[0]->gallery_photo) }}" alt="" style="width:10%;"/>
                      </div>
                        
                     
                      
                      
                      <div class="clearfix"></div>
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-gallery') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
                      </div>
                              
                      {{ Form::close() }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@stop
@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Add Banner</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-plus-square"></i> Add Banner</h4> </div>
                <div class="widget-content">
                    <div class="col-xs-12 col-sm-12">
                      <div style="height:20px;">
                        @if (Session::has('success'))
                            <span style="color:#090;">Records has been saved successfully.</span>
                        @endif
                        
                        @if (Session::has('blank'))
                            <span style="color:#F00;">Please enter all * marked controls values.</span>
                        @endif
                        
                        @if (Session::has('invformat'))
                            <span style="color:#F00;">Please upload correct file format.</span>
                        @endif
                        
                      </div>
                    
                      {{ Form::open(array('url' => 'add-banner', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_banner', 'id' => 'frm_banner','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      <div class="form-group col-md-8">
                        <label>Upload  Banner*:</label> 
                        {!! Form::file('upload_banner', array('id' => 'upload_banner','required', 'class'=>'','placeholder'=>'')) !!}
                        <span style="color:#F00;">
                        Note : For better quality banner  <strong>width = </strong> 1920 &  <strong>Height =</strong> 940<br>
                        Upload only <strong>png,jpg,jpeg</strong> extension banner.
                        </span>
                      </div>

                      <div class="form-group col-md-8">
                          <label>Punchline1 :</label>
                          {!! Form::textarea('punch_line1','', array('id' => 'punch_line1','', 'class'=>'form-control','placeholder'=>'','size' => '100x1')) !!}
                      </div>

                      <div class="form-group col-md-12">
                          <label>Punchline2 :</label>
                          {!! Form::textarea('punch_line2','', array('id' => 'punch_line2','', 'class'=>'form-control','placeholder'=>'','size' => '90x3')) !!}
                      </div>


                      <div class="clearfix"></div>
                       
                     
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-banners') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
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
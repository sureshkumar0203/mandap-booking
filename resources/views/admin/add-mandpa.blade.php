@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Add Mandap</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-plus-square"></i> Add Mandap</h4> </div>
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
                            <span style="color:#F00;">This mandap name already exist.</span>
                        @endif
                      </div>
                    
                      {{ Form::open(array('url' => 'add-mandap', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_mandap', 'id' => 'frm_mandap','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      <div class="form-group col-md-8">
                      <label>Mandap Name*:</label> 
                     {!! Form::text('mandap_type','',array('id' => 'mandap_type','required','class'=>'form-control','placeholder'=>'')) !!}
                     </div>
                     
                      
                      <div class="clearfix"></div>
                       
                     
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-mandaps') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
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
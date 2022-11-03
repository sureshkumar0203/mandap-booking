@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')

<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>   
     
<script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
           
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Edit Content</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-pencil-square-o"></i> Edit Content</h4> </div>
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
                            <span style="color:#F00;">Please upload valid format photo.</span>
                        @endif
                      </div>
                      
                      
                      	 @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                  @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                   @endforeach
                                </ul>
                          </div>
                          @endif
                                
                                
                                
                    
                      {{ Form::open(array('url' => 'update-content', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_content', 'id' => 'frm_content','files'=>true, 'autocomplete' => 'off')) }}  
                      
                      
                      {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!}
                          
                        
                      <div class="form-group col-md-8">
                        <label>Page Title*:</label>
                        {!! Form::text('page_title',$data[0]->page_title, array('id' => 'page_title','required', 'class'=>'form-control','placeholder'=>'')) !!}
                      </div>
                      
                      
                      <div class="form-group col-md-12">
                        <label>Content*:</label>
                        {!! Form::textarea('content',$data[0]->content, array('id' => 'content_img','required', 'class'=>'ckeditor','placeholder'=>'')) !!}
                      </div>
                      
                      <div class="clearfix"></div>
                       <script type="text/javascript">						 
          						  CKEDITOR.replace( 'content_img', {
          								filebrowserUploadUrl: '{{ url("public/ckeditor/filemanager/connectors/php/upload.php")}}'
          							});
          			   </script>
                      
                      
                      <div class="clearfix"></div>
                        
                      <div class="form-group col-md-8">
                        <label>Meta Title*:</label>
                        {!! Form::textarea('meta_title',$data[0]->meta_title, array('id' => 'meta_title','required', 'class'=>'form-control','placeholder'=>'','size' => '100x5')) !!}
                      </div>
                       
                      <div class="form-group col-md-8">
                        <label>Meta Keyword*:</label>
                        {!! Form::textarea('meta_keyword',$data[0]->meta_keyword, array('id' => 'meta_keyword','required', 'class'=>'form-control','placeholder'=>'','size' => '100x5')) !!}
                      </div>
                      
                      <div class="form-group col-md-8">
                        <label>Meta Description:*:</label>
                        {!! Form::textarea('meta_descr',$data[0]->meta_descr, array('id' => 'meta_descr','required', 'class'=>'form-control','placeholder'=>'','size' => '30x5')) !!}
                      </div>
                      
                      <div class="clearfix"></div>
                      
                      
                      <div class="form-group col-md-12">
                      	{{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
                        
                        &nbsp;&nbsp;
                        
                        <a href="{{ URL::to('administrator/manage-contents') }}" class="btn btn-sm btn-danger">&nbsp;&nbsp;Back to List&nbsp;&nbsp; <i class="icon-angle-right"></i></a>
                        
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
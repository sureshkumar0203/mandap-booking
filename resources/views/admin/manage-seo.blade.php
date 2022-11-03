@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Manage Seo </li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-search"></i> Manage Seo</h4> </div>
                    <div class="widget-content">
                        <div class="col-xs-12 col-sm-8">
                          <div style="height:20px;">
                            @if (Session::has('success'))
                                <span style="color:#090;">Records has been saved successfully.</span>
                            @endif
                            
                            @if (Session::has('blank'))
                                <span style="color:#F00;">Please enter all * marked controls values.</span>
                            @endif
                          </div>
                        
                           {{ Form::open(array('url' => 'update-seo-details', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_seo', 'id' => 'frm_seo', 'autocomplete' => 'off')) }}  
                             
                              
                           {!! Form::hidden('_token',csrf_token(), array('id' => '_token','required', 'class'=>'','placeholder'=>'')) !!}
                              
                              <div class="form-group col-md-12">
                                <label>Meta Title*:</label>
                                {!! Form::textarea('meta_title',$data[0]->meta_title, array('id' => 'meta_title','required', 'class'=>'form-control','placeholder'=>'','size' => '100x5')) !!}
                              </div>
                               
                              <div class="form-group col-md-12">
                                <label>Meta Keyword*:</label>
                                {!! Form::textarea('meta_keyword',$data[0]->meta_keyword, array('id' => 'meta_keyword','required', 'class'=>'form-control','placeholder'=>'','size' => '100x5')) !!}
                              </div>
                              
                              <div class="form-group col-md-12">
                                <label>Meta Description:*:</label>
                                {!! Form::textarea('meta_descr',$data[0]->meta_descr, array('id' => 'meta_descr','required', 'class'=>'form-control','placeholder'=>'','size' => '100x5')) !!}
                              </div>
                              
                              <div class="clearfix"></div>
                                    
                              
                              <div class="form-group col-md-12">
                                {{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-left')) }}
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
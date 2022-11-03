@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> My Account </li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-user"></i> My Account</h4> </div>
                    <div class="widget-content">
                        <div class="col-xs-12 col-sm-6">
                          <div style="height:20px;">
                            @if (Session::has('success'))
                                <span style="color:#090;">Records has been saved successfully.</span>
                            @endif
                            
                            @if (Session::has('blank'))
                                <span style="color:#F00;">Please enter all * marked controls values.</span>
                            @endif
                          </div>
                        
                           {{ Form::open(array('url' => 'update-admin-details', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_adm_det', 'id' => 'frm_adm_det', 'autocomplete' => 'off')) }}  
                             
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Your Name*:</label>
                                  <div class="col-md-8">
                                     {!! Form::text('admin_name',$data[0]->admin_name, array('id' => 'admin_name','required', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Login Email*:</label>
                                  <div class="col-md-8">
                                    {!! Form::email('email',$data[0]->email, array('id' => 'email','required', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Contact Email:</label>
                                  <div class="col-md-8">
                                     {!! Form::email('alt_email',$data[0]->alt_email, array('id' => 'email','required', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Mobile No.:</label>
                                  <div class="col-md-8">
                                     {!! Form::text('mobile_no',$data[0]->mobile_no,array('id' => 'mobile_no','required', 'minlength' => 10,'maxlength' => 14, 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Alt. Mobile No.:</label>
                                  <div class="col-md-8">
                                     {!! Form::text('contact_no',$data[0]->contact_no,array('id' => 'contact_no','required', 'minlength' => 10,'maxlength' => 14, 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                            
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Address:</label>
                                  <div class="col-md-8">
                                   {!! Form::textarea('address',$data[0]->address,array('id' => 'address','required', 'class'=>'form-control','size' => '30x5','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              
                             
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Facebook URL:</label>
                                  <div class="col-md-8">
                                     {!! Form::url('facebook_url',$data[0]->facebook_url, array('id' => 'facebook_url', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Twitter URL:</label>
                                  <div class="col-md-8">
                                     {!! Form::url('twitter_url',$data[0]->twitter_url, array('id' => 'twitter_url', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-4 control-label">Linkedin URL:</label>
                                  <div class="col-md-8">
                                     {!! Form::url('linkedin_url',$data[0]->linkedin_url, array('id' => 'linkedin_url', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              
                               
                              <div class="form-group">
                                  <label class="col-md-4">&nbsp;</label>
                                  <div class="col-md-8">
                                      <span class="control-label" style="color:#090; font-size:14px;" >&nbsp;</span>
                                       {{ Form::submit('Update', array('class' => 'btn btn-sm btn-success pull-right')) }}
                                  </div>
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
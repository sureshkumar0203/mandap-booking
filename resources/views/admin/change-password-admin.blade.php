@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Change Password </li>
        </ul>
    </div>
    
    <div class="page-header"></div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-key"></i> Change Password</h4> </div>
                  <div class="widget-content">
                      <div class="col-xs-12 col-sm-6">
                          <div style="height:20px;">
                              @if (Session::has('success'))
                                  <span style="color:#090;">Records has been saved successfully.</span>
                              @endif
                              
                              @if (Session::has('blank'))
                                  <span style="color:#F00;">Please enter all * marked controls values.</span>
                              @endif
                              
                              @if (Session::has('conf_not_match'))
                                  <span style="color:#F00;">Password does not match !!</span>
                              @endif
                              
                              @if (Session::has('not_match'))
                                  <span style="color:#F00;">Incorrect Old Password !!</span>
                              @endif
                            </div>
                      
                         {{ Form::open(array('url' => 'change-admin-psw', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_chng_psw', 'id' => 'frm_chng_psw', 'autocomplete' => 'off')) }} 
                         
                            <div class="form-group">
                                <label class="col-md-4 control-label">Old Password*:</label>
                                <div class="col-md-8">
                                    {!! Form::password('old_password',  array('id' => 'old_password','required', 'class'=>'form-control', 'placeholder' => '')) !!}
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label">News Password*:</label>
                                <div class="col-md-8">
                                  {!! Form::password('new_password',  array('id' => 'new_password','required', 'minlength' => 4, 'class'=>'form-control', 'placeholder' => '')) !!}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm Password*:</label>
                                <div class="col-md-8">
                                    {!! Form::password('conf_password',  array('id' => 'conf_password','required', 'minlength' => 4, 'class'=>'form-control', 'placeholder' => '')) !!}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-4">&nbsp;</label>
                                <div class="col-md-8">
                                 {{ Form::submit('Save', array('class' => 'btn btn-sm btn-success pull-right')) }}
                                
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
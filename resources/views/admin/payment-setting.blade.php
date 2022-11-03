@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
<div id="content">
  <div class="container">
    <div class="crumbs">
        <ul id="breadcrumbs" class="breadcrumb">
            <li> <i class="fa fa-home"></i> 
            <a href="{{ URL::to('administrator/dashboard') }}">Dashboard</a> </li>
            <li> Payment Settings </li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header"><h4><i class="fa fa-money"></i> Payment Settings</h4> </div>
                    <div class="widget-content">
                        <div class="col-xs-12 col-sm-10">
                          <div style="height:20px;">
                            @if (Session::has('success'))
                                <span style="color:#090;">Records has been saved successfully.</span>
                            @endif
                            
                            @if (Session::has('blank'))
                                <span style="color:#F00;">Please enter all * marked controls values.</span>
                            @endif
                          </div>
                        	
                           {{ Form::open(array('url' => 'update-payment-setting', 'role' => 'form', 'class' =>'form-horizontal row-border', 'name' => 'frm_payment', 'id' => 'frm_payment', 'autocomplete' => 'off')) }}  
                             
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Payment Gateway Environment*:</label>
                                  <div class="col-md-9">
                                  <label>
                                     {!! Form::radio('payment_getway_environment','sandbox',$data[0]->payment_getway_environment=='sandbox',array('id' => 'payment_getway_environment','required', 'class'=>'','placeholder'=>'')) !!} Test</label>
                                     
                                     &nbsp;&nbsp;
                                     
                                      <label>
                                     {!! Form::radio('payment_getway_environment','live',$data[0]->payment_getway_environment=='live',array('id' => 'payment_getway_environment','required', 'class'=>'','placeholder'=>'')) !!} Live
                                     </label>
                                     
                                  </div>
                              </div>
                              
                              
                              <div class="form-group">
                                  <label class="col-md-3 control-label">MERCHANT KEY*:</label>
                                  <div class="col-md-9">
                                     {!! Form::text('merchant_key',$data[0]->merchant_key,array('id' => 'merchant_key','required', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-3 control-label">SALT*:</label>
                                  <div class="col-md-9">
                                     {!! Form::text('salt',$data[0]->salt,array('id' => 'salt','required', 'class'=>'form-control','placeholder'=>'')) !!}
                                  </div>
                              </div>
                              
                            <div class="form-group">
                                  <label class="col-md-3 control-label">Advance %*:</label>
                                  <div class="col-md-9">
                                     {!! Form::text('adv_per',$data[0]->adv_per,array('id' => 'adv_per','required', 'class'=>'form-control','placeholder'=>'','onKeyUp' => 'validatePrice(this)')) !!}
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-3 control-label">No. of Bookings per day*:</label>
                                  <div class="col-md-9">
                                     {!! Form::text('no_book_per_day',$data[0]->no_book_per_day,array('id' => 'no_book_per_day','required', 'class'=>'form-control','placeholder'=>'','maxlength' => '1', 'readonly', 'onKeyPress' => 'return numbersonly(event)')) !!}
                                  </div>
                              </div>
                              
                              
                              <div class="form-group">
                                  <label class="col-md-3">&nbsp;</label>
                                  <div class="col-md-9">
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
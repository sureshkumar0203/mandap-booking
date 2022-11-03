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
            <li> Order Details</li>
        </ul>
    </div>
    
    <div class="page-header"></div>
            
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                <div class="row">
                <div class="col-md-9">
                <h4><i class="fa fa-pencil-square-o"></i> Booking Details</h4> 
                </div>
                 <div class="col-md-3 text-right" style="padding-right:4px; margin-top: -2px;">
                <a href="{{ asset('administrator/print-booking-details/'.$booking_dtls[0]->booking_id) }}" class="btn btn-danger" target="_blank">Print</a>
                </div>
                </div>
                </div>
                <div class="widget-content">
                    <div class="form-group col-xs-12">
                          <div class="form-group col-xs-4">
                            <strong>Booking Information </strong><br /><br />
                            <strong>Registration  Date :</strong> {{ date("jS M,Y",strtotime($booking_dtls[0]->booking_reg_date)) }} <br />
                            <strong>Mandap : </strong> {{ $mandap_dtls[0]->mandap_type }} <br />
                            
                            <strong>Booking Date :</strong>  {{ date("jS M,Y",strtotime($booking_dtls[0]->booking_date)) }} <br />
                            <strong>Booking ID :</strong> {{ $booking_dtls[0]->booking_id }} <br />
                            <strong>Transaction ID :</strong> {{ $booking_dtls[0]->transaction_id }}<br />
                          </div>
                         
                          <div class="form-group col-xs-4">
                          <strong> Booking Charges</strong><br /><br />
                          <strong>Mandap Booking :</strong> Rs. {{ number_format($booking_dtls[0]->mandap_booking_price,2,'.','') }} <br />
                          <strong>Grand Total : </strong>Rs. {{ number_format($booking_dtls[0]->total_booking_cost,2,'.','') }} <br />
                          <strong>Advance Payment :</strong>Rs. {{ number_format($booking_dtls[0]->adv_amount,2,'.','') }} <br />
                          <strong>
                           Due Payment : 
                           @if($booking_dtls[0]->due_clear_status=="Pending")
                           <span style="color:#F00;">
                           Rs. {{ number_format($booking_dtls[0]->booking_due,2,'.','') }}
                           </span>
                           @else
                           
                           <span style="color:#060;">Cleared</span>
                           @endif
                           </strong>
                             
                           <br /> <br />
                          </div>
                          
                          <div class="form-group col-xs-4">
                            <strong> Customer Information </strong><br /><br />
                            {{ $booking_dtls[0]->full_name }} <br /> 
                            <strong>Contact No. :</strong> {{ $booking_dtls[0]->contact_no }} <br />
                            <strong>Email :</strong> {{ $booking_dtls[0]->email }} <br />
                            <strong>Address</strong> <br />
                            {{ $booking_dtls[0]->address }}
                          </div>
                          
                          <div class="clearfix"></div>
                          <div class="form-group col-xs-12">
                            <strong>Special Notes :</strong> 
                            {{ $booking_dtls[0] -> special_notes }} 
                          </div>
                          
                           @if(count($ext_ser_info)>0)
                            <div class="clearfix"></div>
                            <div class="form-group col-md-12"><h4>Other Services</h4> </div>
                            
                            <ul style="padding:20px">
                            @foreach($ext_ser_info as $es_det)
                              <li style="width:33%;float:left; list-style:none; margin-bottom:10px;">
                                  {{ $es_det->sub_cat_name }} 
                                  <b>Rs. {{ number_format($es_det->service_price,2,'.','') }}</b>
                              </li>
                            @endforeach
                            </ul>
                          @endif
          
          				  <div class="clearfix"></div><br /><br />
						  
                          {{ Form::open(array('url' => 'update-booking-status', 'role' => 'form', 'class' =>'', 'name' => 'frm_bs', 'id' => 'frm_bs','files'=>true, 'autocomplete' => 'off')) }}
                          {!! Form::hidden('reference_id',$ID, array('id' => 'reference_id','required', 'class'=>'','placeholder'=>'')) !!} 
                          
                          <div class="form-group col-md-4">
                             <strong> Due Clear Status : </strong>
                              <select name="due_clear_status" id="due_clear_status" <?php if($booking_dtls[0]->due_clear_status=='Cleared'){ echo  'disabled'; } ?>>
                                <option value="Cleared" @if($booking_dtls[0] -> due_clear_status =='Cleared') {{ 'selected' }} @endif >Cleared</option>
                                <option value="Pending" @if($booking_dtls[0] -> due_clear_status =='Pending') {{ 'selected' }} @endif >Pending</option>
                              </select>
                              
                              <div class="clearfix"></div>
                              
                              @if (Session::has('success'))
                                 <span style="color:#090;">Order status has been changed successfully.</span>
                              @endif
                              
                              @if (Session::has('cos'))
                                  <span style="color:#F00;">Please change order status.</span>
                              @endif
                          </div>
                          
                          
                          <div class="clearfix"></div><br />
                          
                          <div class="col-sm-12">
                          @if($booking_dtls[0] -> due_clear_status =='Pending')
                          {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                          @endif
                       
                          <a href="{{  URL::to('administrator/manage-bookings') }}" class="btn btn-danger">Back to Manage Bookings</a></div>
                          <div class="col-lg-12 row"><br /><br /></div>
                          
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
<!DOCTYPE html>
<html lang="en" ng-app="yorubaModule">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
      <title>Booking Order</title>
      
      <link href="{{ asset('public/admin/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
      
      
    
   
  </head>
<body>
<?php
$path = Request::path('');
$path = explode("/", $path);
$ID = $path[2];
?>   
<div id="content">
  <div class="container">
    <div class="row">
    <div style="width:400px;float:left;">
     <b>SR Valley</b><br>
     {{ $admin_det[0]->address }}<br>

     Contact No. : {{ $admin_det[0]->mobile_no }} /  {{ $admin_det[0]->contact_no }} <br>
     Email : {{ $admin_det[0]->alt_email }}  
     </div>
        <div style="float:right;"><img src="{{ URL::asset('public/images/logo.png') }}" style="height:80px" alt="logo"/></div>
    </div>
    
    <div class="row page-header" style="margin-top:12px;"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-content">
                    <div class="form-group col-xs-12">
                          <div class="form-group col-xs-4" style="font-size:12px">
                            <strong>Booking Information </strong><br /><br />
                            <strong>Reg.  Date :</strong> {{ date("d/m/Y",strtotime($booking_dtls[0]->booking_reg_date)) }} <br />
                            <strong>Mandap : </strong> {{ $mandap_dtls[0]->mandap_type }} <br />
                            
                            <strong>Booking Date :</strong>  {{ date("d/m/Y",strtotime($booking_dtls[0]->booking_date)) }} <br />
                            <strong>Booking ID :</strong> {{ $booking_dtls[0]->booking_id }} <br />
                            <strong>Transaction ID :-</strong> {{ $booking_dtls[0]->transaction_id }}<br />
                          </div>
                         
                          <div class="form-group col-xs-4" style="font-size:12px">
                          <strong> Booking Charges</strong><br /><br />
                          <strong>Mandap Booking :</strong> Rs. {{ number_format($booking_dtls[0]->mandap_booking_price,2,'.','') }} <br />
                          <strong>Grand Total : </strong>Rs. {{ number_format($booking_dtls[0]->total_booking_cost,2,'.','') }} <br />
                          <strong>Adv. Payment :</strong>Rs. {{ number_format($booking_dtls[0]->adv_amount,2,'.','') }} <br />
                          <strong>
                           Due Payment :-<br>

                           @if($booking_dtls[0]->due_clear_status=="Pending")
                           <span style="color:#F00;">
                           Rs. {{ number_format($booking_dtls[0]->booking_due,2,'.','') }}
                           </span>
                           @else
                           
                           <span style="color:#060;">Cleared </span>
                           ( Rs. {{ number_format($booking_dtls[0]->booking_due,2,'.','') }} )
                           @endif
                           </strong>
                             
                           <br /> <br />
                          </div>
                          
                          <div class="form-group col-xs-4" style="font-size:12px">
                            <strong> Customer Information </strong><br /><br />
                            {{ $booking_dtls[0]->full_name }} <br /> 
                            <strong>Contact No. :</strong> {{ $booking_dtls[0]->contact_no }} <br />
                            <strong>Email :</strong> {{ $booking_dtls[0]->email }} <br />
                            <strong>Address :-</strong> <br />
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
                              <li style="width:50%;float:left; list-style:none; margin-bottom:10px;">
                                  {{ $es_det->sub_cat_name }} 
                                  <b>Rs. {{ number_format($es_det->service_price,2,'.','') }}</b>
                              </li>
                            @endforeach
                            </ul>
                          @endif
          
          				  <div class="clearfix"></div>
						  
                         
                          <div style="margin-top:130px">Signature</div>
                          
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
window.print();
</script>
 </body>
</html>
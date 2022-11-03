<!DOCTYPE html>
<html lang="en" ng-app="yorubaModule">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Booking Order</title>

<link href="{{ asset('public/admin/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
<style type="text/css" media="all">
hr {
	border-top:solid 1px #504e4e52!important;
	margin-top: 10px !important;
	margin-bottom: 10px !important;
}

.page-header {
    padding-bottom: 9px;
    margin: 40px 0 20px;
    border-bottom: 1px solid #0000007a!important;
}
</style> 
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
            <div class="form-group">
              <div class="form-group col-xs-6" style="font-size:12px">
                <strong>Booking Information </strong><br /><br />
                <strong>Reg.  Date :</strong> {{ date("jS M, Y",strtotime($booking_dtls[0]->booking_reg_date)) }} <br />
                <strong>Mandap : </strong> {{ $mandap_dtls[0]->mandap_type }} <br />
                
                <strong>Booking Date :</strong>  {{ date("jS M, Y",strtotime($booking_dtls[0]->booking_date)) }} <br />
                <strong>Booking ID :</strong> {{ $booking_dtls[0]->booking_id }} <br />
                <strong>Transaction ID :</strong> {{ $booking_dtls[0]->transaction_id }}<br />
              </div>
            
            
            
              <div class="form-group col-xs-6" style="font-size:12px">
                <strong> Customer Information </strong><br /><br />
                {{ $booking_dtls[0]->full_name }} <br /> 
                <strong>Contact No. :</strong> {{ $booking_dtls[0]->contact_no }} <br />
                <strong>Email :</strong> {{ $booking_dtls[0]->email }} <br />
                <strong>Address </strong> <br />
                {{ $booking_dtls[0]->address }}
              </div>
            
              <div class="clearfix"></div>
              
              <div class="form-group col-xs-12">
                <strong>Special Notes :</strong> 
                {{ $booking_dtls[0] -> special_notes }} 
              </div>
              
              <div class="clearfix"></div>
            </div>
            
            <div class="form-group col-md-12">
              <table width="100%" border="0" cellpadding="5" cellspacing="0" style="font-size:12px;">
                <tr>
                  <td colspan="2"><hr></td>
                </tr>
                
                <tr>
                  <td colspan="2"><strong> Payment Details</strong></td>
                </tr>
                
                <tr>
                  <td colspan="2"><hr></td>
                </tr>
                
                <tr>
                  <td>Mandap Booking</td>
                  <td align="right"> {{ number_format($booking_dtls[0]->mandap_booking_price,2,'.','') }}</td>
                </tr>
                
                @if(count($ext_ser_info)>0)
                  @foreach($ext_ser_info as $es_det)
                  <tr>
                      <td>{{ $es_det->sub_cat_name }}</td>
                      <td align="right"> {{ number_format($es_det->service_price,2,'.','') }}</td>
                  </tr>
                  @endforeach 
                @endif
                <tr>
                  <td colspan="2"><hr></td>
                </tr>
                
                <tr>
                  <td><strong>Grand Total :</strong></td>
                  <td align="right"><strong>Rs. {{ number_format($booking_dtls[0]->total_booking_cost,2,'.','') }}</strong></td>
                </tr>
                
                <tr>
                  <td><strong>Advance :</strong></td>
                  <td align="right"><strong>Rs. {{ number_format($booking_dtls[0]->adv_amount,2,'.','') }}</strong></td>
                </tr>
                
                <tr>
                  <td colspan="2"><hr></td>
                </tr>
                
                <tr>
                  <td><strong>Due :</strong></td>
                  <td align="right">
                    <strong>
                    @if($booking_dtls[0]->due_clear_status=="Pending")
                        <span style="color:#F00;">
                        Rs. {{ number_format($booking_dtls[0]->booking_due,2,'.','') }}
                        </span>
                    @else
                        Rs. {{ number_format($booking_dtls[0]->booking_due,2,'.','') }} 
                        <span style="color:#060;">( Cleared )</span>
                    @endif
                    </strong>
                  </td>
                </tr>
                
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </div>
            
            <div class="clearfix"></div>
          </div>
          
          <div style="margin-top:130px">Signature</div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
window.print();
</script>
 </body>
</html>
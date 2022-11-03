@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<?php
$mb_price = DB::table('service_sub_categories')->where('sub_cat_id','=',1)->get();
//print_r($mb_price);exit;
 
$success_url = Config::get('constants.payment_success_url');
$failure_url = Config::get('constants.failure_url');

// Merchant Key and Salt as provided by Payu.
$MERCHANT_KEY = $payment_det[0]->merchant_key;


if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}

if($payment_det[0]->payment_getway_environment=='sandbox'){
	$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
}else{
	$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode
}

$adv_per = $payment_det[0]->adv_per;
?>
<script type="text/javascript">
	$(function(){
		var mandap_booking_price=$('#mandap_booking_price').val();
		var adv_per=$('#adv_per').val();
		
		
		
		var mbp = parseFloat(mandap_booking_price);
		$('#amount').val(mbp.toFixed(2));
		$('#amount_id').html('Rs. '+mbp.toFixed(2));
		
		
		
		var adv_amt=(mbp*adv_per)/100;
		var f_amt=adv_amt.toFixed(2);
		$('#adv_amount').val(f_amt);
		$('#adv_amount_id').html('Rs. '+f_amt);
				
		
		$('.my-activity').click(function(){
			var total=0;
			$('.my-activity:checked').each(function(){
				//alert($(this).attr('data'));
				//total += parseInt($(this).val());
				total += parseFloat($(this).attr('data'));
			});
			//alert(total);
			
			
			if(total==0){
				$('#amount').val(mbp.toFixed(2));
				$('#amount_id').html('Rs. '+mbp.toFixed(2));
				
				var adv_amt=(mbp*20)/100;
				var f_amt=adv_amt.toFixed(2);
				$('#adv_amount').val(f_amt);
				$('#adv_amount_id').html('Rs. '+f_amt);
		
		
				//$('#adv_amount').val('');
			}else{
				
				
				var total=parseFloat(total);
				var grandTotal = mbp + total;
				//alert(gt);
				$('#amount').val(grandTotal.toFixed(2));
				$('#amount_id').html('Rs. '+grandTotal.toFixed(2));
				
				var adv_amt=(grandTotal*20)/100;
				var f_amt=adv_amt.toFixed(2);
				
				$('#adv_amount').val(f_amt);
				$('#adv_amount_id').html('Rs. '+f_amt);
			}
			
		});
		
	});

</script>

<section class="row final-inner-header">
  <div class="container">
      <h2>
      <strong>Your booking date is</strong> {{ date("jS M, Y",strtotime(Session::get('booking_date'))) }}
      <br /> <strong>Mandap :</strong> {{ Session::get('mandap_name') }} 
      
      </h2>
  </div>
</section>
 
<section class="container clearfix common-pad book"> 
  {{ Form::open(array('url' => 'select-service', 'role' => 'form', 'class' =>'', 'name' => 'frm_booking', 'id' => 'frm_booking','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
    <div class="row">
      <div class="col-md-8">
        {!! Form::hidden('mandap_booking_price',$mb_price[0]->service_price, array('id' => 'mandap_booking_price')) !!}
        {!! Form::hidden('adv_per',$adv_per, array('id' => 'adv_per')) !!}
       
        @php
        $cat_ary = DB::table('service_categories')->where('cat_id','>',1)->orderBy('cat_id', 'DESC')->get();
        foreach($cat_ary as $cat_det){
        $sub_cat_ary = DB::table('service_sub_categories')->where('cat_id','=',$cat_det->cat_id)->get();
        if(count($sub_cat_ary)>0){
        @endphp  
        <div class="row">
         <h4 class="this-title"><i class="fa fa-caret-right" aria-hidden="true"></i> {{ $cat_det->category_name }}</h4> 
          @php
          foreach($sub_cat_ary as $sub_cat_det){
          @endphp  
          <div class="col-md-4" style="margin-bottom:12px; font-size:13px"  >     
          <input class="my-activity" type="checkbox" name="activity[]" data="{{ $sub_cat_det->service_price }}" value="{{ $sub_cat_det->sub_cat_id }} - {{ $sub_cat_det->sub_cat_name }} - {{ $sub_cat_det->service_price }}"> {{ $sub_cat_det->sub_cat_name }} ( Rs. {{ $sub_cat_det->service_price }} )</div>
           @php } @endphp  
        </div>
        @php } @endphp  
        @php } @endphp
        <div class="clearfix martop30"></div>  
      </div>
      
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group mar-bot10">
              <label class="control-label col-sm-12" for="email">Full Name*</label>
              <div class="col-sm-12">
                 {!! Form::text('firstname',old('firstname'), array('id' => 'firstname','required','class'=>'form-control','placeholder'=>'Full Name','autocomplete' => 'off')) !!}
              </div>
            </div>
            
            <div class="form-group mar-bot10">
              <label class="control-label col-sm-12" for="pwd">Email Address*</label>
              <div class="col-sm-12">
               {!! Form::email('email',old('email'), array('id' => 'email','required','class'=>'form-control','placeholder'=>'Email Address','autocomplete' => 'off')) !!}
              </div>
            </div>
            
            <div class="form-group mar-bot10">
              <label class="control-label col-sm-12" for="pwd">Contact No.*</label>
              <div class="col-sm-12">
               {!! Form::text('phone',old('phone'), array('id' => 'phone','required','class'=>'form-control','placeholder'=>'Contact No.','autocomplete' => 'off','maxlength' => '10','onKeyUp' => 'validatephone(this)')) !!}
              </div>
            </div>
            
            <div class="form-group mar-bot10">
              <label class="control-label col-sm-12" for="pwd">Address*</label>
              <div class="col-sm-12"> 
              	{!! Form::textarea('address','',array('id' => 'address','required','class'=>'form-control','size' => '30x3','placeholder'=>'Address')) !!}
              </div>
            </div>
            
            <div class="form-group mar-bot10">
              <label class="control-label col-sm-12" for="pwd">Notes</label>
              <div class="col-sm-12"> 
              	{!! Form::textarea('special_notes','',array('id' => 'special_notes','','class'=>'form-control','size' => '30x3','placeholder'=>'Special Notes')) !!}
              </div>
            </div>
            
            
          </div>
          
          <div class="clearfix"></div><hr>
          <div class="clearfix"></div>
        
          <div class="col-md-12">
            <h4><strong>Default Services</strong></h4>
            <h4>Mandap Booking ( Rs. {{ $mb_price[0]->service_price }} )</h4>
            <ul>
            @php
            $def_ser_ary = DB::table('service_sub_categories')->where('sub_cat_id','>',1)->where('cat_id','=',1)->get();
            foreach($def_ser_ary as $def_ser_det){
            @endphp  
                <li>{{ $def_ser_det->sub_cat_name }}</li> 
            @php } @endphp  
            </ul>
          </div>
        </div>
         <input type="hidden" name="amount" id="amount" style="border:solid 1px #FF0000;" / >
         <input type="hidden" name="adv_amount" id="adv_amount"/>
         
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><strong>Total Booking Amount </strong>:</td>
            <td align="right" valign="middle" id="amount_id" style="font-weight:bold;">
            
            </td>
          </tr>
          
          <tr>
            <td><strong>Advance Amount  <?php echo $adv_per; ?>% </strong>:</td>
            <td align="right" valign="middle" id="adv_amount_id" style="font-weight:bold;">
           
            </td>
          </tr>
        </table>
        
        <div class="col-md-12  martop30">
          <input type="submit" name="PayNow" id="PayNow" class="res-btn" value="Pay Now">
        </div>  
      </div>
    </div>
  {{ Form::close() }}
</section> 
@stop









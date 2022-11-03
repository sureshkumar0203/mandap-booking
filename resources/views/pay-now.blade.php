@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<?php
$success_url = Config::get('constants.payment_success_url');
$failure_url = Config::get('constants.failure_url');


// Merchant Key and Salt as provided by Payu.
$MERCHANT_KEY = $payment_det[0]->merchant_key;
$SALT = $payment_det[0]->salt;

if($payment_det[0]->payment_getway_environment=='sandbox'){
	$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
}else{
	$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode
}



$action = '';
$posted = array();
if(!empty($_POST)) {
  //echo "<pre>";print_r($_POST);exit;
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

/*echo sizeof($posted);
echo "<br>---------<br>";
echo $posted['hash'];
exit;*/
		
		
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {

    $formError = 1;
  } else {
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}

?>
<script>
document.payuForm.submit();
var hash = '<?php echo $hash ?>';
function submitPayuForm() {
  if(hash == '') {
	return;
  }
  document.payuForm.submit();
}
</script>  

<body onLoad="submitPayuForm()"> 
<section class="container clearfix common-pad about-info-box" id="boon"> 
  <div class="row">
    <div class="col-md-12">
    <div style="text-align:center;">
       <img src="{{ asset('public/images/ajax-loader.gif') }}">
       <h2 style="color:#666;">
         Please Wait....<br />
         Please do not refresh the page while we're redirecting you to PaymentGateway.
       </h2>
     </div>
           
           
	<?php if($formError) { ?>
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    
    
      <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
     {{ csrf_field() }}
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      
      
      <input type="hidden" name="amount" value="<?php echo $pay_dtls[0]->adv_amount; ?>" />
      <input type="hidden" name="firstname" id="firstname" value="<?php echo $pay_dtls[0]->full_name; ?>" />
      <input type="hidden" name="email" id="email" value="<?php echo $pay_dtls[0]->email; ?>" />
      <input type="hidden" name="phone" value="<?php echo $pay_dtls[0]->contact_no; ?>" />
      <input type="hidden" name="productinfo" value="<?php echo $pay_dtls[0]->booking_id; ?>" />
      <input type="hidden" name="surl" value="<?php echo $success_url; ?>"  />
      <input type="hidden" name="furl" value="<?php echo $failure_url; ?>" />
      <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
    </form>
     
    </div>
        
    
  </div>
</section> 
</body>

@stop
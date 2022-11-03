@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/mandap-calender.css') }}">
<script src="{{ asset('public/js/calender-jquery-ui.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/css/scroll-bar.css') }}">

<section class="row final-inner-header" style="background: url({{ asset('public/images/inner-header-booking.jpg') }}) no-repeat scroll center bottom;">
  <div class="container">
      <h2 class="this-title">Booking</h2>
  </div>
</section>

<section class="container clearfix common-pad-booking  activities-main">    
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <div class="lg-78">
        <div id="right-content">
          <div class="sec-header4">
          	<h2>Choose your preferred booking date from our Calender</h2>
          </div>
          
          <ul id="notification-ul">
              <li><span></span> Not Available </li>
              <li><span></span> Running Booking Slots</li>
              <li><span></span> Availabe</li>
              <li><span></span> Selected</li>
          </ul>
          <div id="datepicker"></div>
        </div>
        
       
        {{ Form::open(array('url' => 'selected-date', 'role' => 'form', 'class' =>'', 'name' => 'frm_booking', 'id' => 'frm_booking','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
        <div class="sec-header4">
          <h2 class="choosen-txt">You chosen date is : 
          <span id="selectdate">
          
		  <?php echo date("l, j F, Y", strtotime("+3 days")); ?>
          @if(count($avl_mandaps)==0)
          <span style="color:#F00; font-size:11px; margin-bottom:10px;">( Booking not available on this date )</span>
          @endif
          </span> 
          </h2>
          
          
          <h2 class="choosen-txt">
          Select Mandap* :
          <select name="mandap_type" id="mandap_type" class="man_cb" required>
            <option value="">--Select--</option>
            <?php foreach($avl_mandaps as $val){ ?>
          	<option value="<?php echo $val->mt_id; ?>"><?php echo $val->mandap_type; ?></option>
            <?php } ?>
          </select>
          </h2>
        </div>
        
        <div class="col-md-12">
          <div class="row">
            
                <input type="hidden" name="operation"  id="operation" value="gototime">
                <input type="hidden" name="booking_date"  id="booking_date" value="<?php echo date("l, j F, Y", strtotime("+3 days")); ?>">
                <input type="submit" class="res-btn"  value="Confirm Date">
            
          </div>
          
        </div>
        {{ Form::close() }}
       
        
        <div class="clearfix"></div>
      </div>
    </div>    
         
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pl40">
      <div class="sec-header4">
        <h2>Booking terms & conditions</h2>
        <div class="content">
        
         
         
         <div class="demo">
            <div class="scrollbar-inner">
             
                 {!! $terms_det[0]->content !!}
           
            
            </div>
         </div>
      </div>
       <!-- <div style="overflow-y:scroll; height:508px">{!! $terms_det[0]->content !!}</div>  -->
      </div>
    </div>
  </div>
</section>     
            
<?php
/* print_r($date_range_ary);
echo "<br>-----------<br>";
print_r($booking_started_ary);
echo "<br>-----------<br>";
print_r($booking_comp_ary);*/
?>
            
<script>
var availableDates = <?php echo json_encode($date_range_ary); ?>;
var bookingStarted = <?php echo json_encode($booking_started_ary); ?>;
var completedDates = <?php echo json_encode($booking_comp_ary); ?>;

//var pastdisabledDates = ["01-05-2018","02-05-2018","03-05-2018","04-05-2018","05-05-2018","06-05-2018","07-05-2018","08-05-2018","09-05-2018","10-05-2018","11-05-2018","12-05-2018","13-05-2018","14-05-2018","15-05-2018","16-05-2018","17-05-2018","18-05-2018","19-05-2018","20-05-2018","21-05-2018","22-05-2018","23-05-2018","24-05-2018","25-05-2018","26-05-2018","27-05-2018","28-05-2018","29-05-2018","30-05-2018","31-05-2018"];
// var traininer_notAvailableDates = [];

//console.log(traininer_notAvailableDates);
//console.log(traininer_notAvailableDates[0]);

function check_available_date(date){
	var formatted_date = '', ret = [true, "", ""];
	
	if (date instanceof Date) {
		formatted_date = $.datepicker.formatDate('dd-mm-yy', date);
	  	//console.log(formatted_date);
	} else {
		formatted_date = '' + date;
	}

	if (-1 !== availableDates.indexOf(formatted_date)) {
		ret[1] = "available";
	} else {
		ret[0] = false;
	}
  
	if (-1 !== bookingStarted.indexOf(formatted_date)) {
		ret[1] = "yellow";
	}
  
	if (-1 !== completedDates.indexOf(formatted_date)) {
		ret[0] = false;
		ret[1] = "_red";
	}

	/*if (-1 !== pastdisabledDates.indexOf(formatted_date)) {
		ret[0] = false;
		ret[1] = "grey";
	}*/
	
	/*if (-1 !== traininer_notAvailableDates.indexOf(formatted_date)) {
		ret[0] = false;
		ret[1] = "red";
	}*/
	return ret;
}

var currentTime = new Date();
//var maxDate = new Date(currentTime.getFullYear(), currentTime.getMonth() + 3, +0); 

// one day before next month
var maxDate = new Date(currentTime.getFullYear(), currentTime.getMonth() + 4, +0); 

$("#datepicker").datepicker({
  dateFormat: 'DD, d MM, yy',
  //minDate: '-1m',
  //minDate: 'm',
  //minDate: '0',
  minDate: 'DD' + 3,
  defaultDate: 'DD' + 3,
  maxDate: maxDate,
  beforeShowDay: check_available_date
});

$("#datepicker").on("change", function () {
  var selected = $(this).val();
  $("#selectdate").html(selected);
  $("#booking_date").val(selected);
  
  loadAvailableMandaps();
});


$("ul.available-dates li a").click(function (event) {
  event.preventDefault();
});


</script>

<script src="{{ asset('public/js/jquery.scrollbar.js') }}"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
	  jQuery('.scrollbar-inner').scrollbar();
  });
</script>
@stop



       
  
   

//local
var hostname = $(location).attr('origin')+"/mandap_booking";
//Server
//var hostname = $(location).attr('origin');


//This function is for phone number validation
//onKeyUp="validatephone(this);" 
function validatephone(ph) {
	var maintainplus = '';
 	var numval = ph.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curphonevar = numval.replace(/[\\A-Za-z!"£$%^&*+_={};:'@#~,.¦\/<>?|`¬\]\[]/g,'');
 	ph.value = maintainplus + curphonevar;
 	var maintainplus = '';
 	ph.focus;
}

//onKeyPress="return numbersonly(event);"
function numbersonly(e){
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode<48||unicode>57){ //if not a number
		return false //disable key press
	}
}


function validatePrice(e) {
	var val = e.value;
	var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
	var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
	
	val = re1.exec(val);
	if (val) {
		e.value = val[0];
	} else {
		e.value = "";
	}
}

//This function is for username  validation.space special character not allowed
//onKeyUp="checkUserName(this);"
function checkUserName(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}

//This function is for password  validation.space some special character are not allowed
//onKeyUp="checkPassword(this);"
function checkPassword(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9!@#$]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}


function chk_xss(xss){
	var maintainplus = '';
	var numval = xss.value
	curphonevar = numval.replace(/[\\!"£$%^&*+_={};:'#~,.¦\/<>?|`¬\]\[]/g,'');
	xss.value = maintainplus + curphonevar;
	var maintainplus = '';
	xss.focus;
}

function newsletterValidation(){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if($("#news_ltr_email").val()==''){
		$("#news_ltr_email").addClass('error_class');
		$("#news_ltr_email").focus();
		return false;
	}else{
		$("#news_ltr_email").removeClass('error_class');
	}
	if(!($("#news_ltr_email").val()).match(emailExp)){
		$("#news_ltr_email").addClass('error_class');
		$("#news_ltr_email").focus();
		return false;
	}else{
		$("#news_ltr_email").focus();
	}
	//postNewsLetterData();
	
	var url = hostname + "/save-nl-data";
	$.ajax({
		type: "POST",
		cache: false,
		url: url, // success.php
		//data : {'update_cart_id':cartid,'update_qty':qty,'update_unit_price':unitprice},
		data: {'news_ltr_email':$('#news_ltr_email').val()},
		success: function (data) {
			console.log(data);
			//return flase;
			if(data==0){
				$("#nl_msg").css('color','red').html('Please enter valid email address.');
			}
			if(data==1){
				$("#nl_msg").css('color','red').html('You have already sybscribed to our news letter.');
			}
			if(data=='success'){
				$("#news_ltr_email").val('');
				$("#nl_msg").css('color','#FFF').html('You have subscribed to our newsletter successfully.');
			}
		}
	});
}

function loadAvailableMandaps(){
	$('#mandap_type').empty();
	var url = hostname + "/avl-mandap-list";
	$.ajax({
		type: "POST",
		cache: false,
		url: url,
		data: {'booking_date':$('#booking_date').val()},
		success: function (data) {
			//console.log(data);
			//return false;
			$('#mandap_type').empty();
			$("#mandap_type").prepend("<option value=''>--Select--</option>");
			
			var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
			  $('#mandap_type').append('<option value="' + d.mt_id + '">' + d.mandap_type + '</option>');
            });
		}
	});
}

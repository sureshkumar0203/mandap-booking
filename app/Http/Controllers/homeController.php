<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Helpers;
use Image;
use Config;

//This line is used for getting the input box value
use Illuminate\Http\Request;
//This line is used for database connection
use DB;
//This line is used for session
use Session;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;

//use App\Mylibs\thumbnail_manager;
//use App\Mylibs\paypal_pro;

use Mail;
use App\Mail\Reminder;
use App\Mail\MailBuilder;

use DateTime;

class homeController extends BaseController{
	public function showHome(){
		$abt_det = DB::table('contents')->where('id', '1')->get();
		$service_cat = DB::table('service_categories')
					->orderBy('cat_id','DESC')
					->take(10)
					->get();
		$gallery_det = DB::table('photo_gallery')
					->orderBy('ph_id','DESC')
					->take(10)
					->get();
	  	return view('home',['abt_det'=>$abt_det,'service_cat'=>$service_cat,'gallery_det' => $gallery_det]);
	}
	
	public function viewAboutUs(){
		$about_det = DB::table('contents')
					->where('id', '=' ,'1')
					->get();
		
		
		return view('about-us',['about_det'=>$about_det]);
	}
	
	public function viewCmsServices(){
		$service_cat = DB::table('service_categories')
					->orderBy('cat_id','DESC')
					->get();
		return view('services',['service_cat'=>$service_cat]);
	}
	
	public function viewGallery(){
		$gallery_det = DB::table('photo_gallery')
					->orderBy('ph_id','DESC')
					->take(10)
					->get();
		return view('gallery',['gallery_det' => $gallery_det]);
	}
	
	
	
	public function viewVirtualTour(){
		return view('virtual-tour');
	}
	
	public function viewContactUs(){
		return view('contact-us');
	}
	
	public function sendContactUsMail(Request $request){
		$subject = trim($request->input('subject'));
		$full_name = trim($request->input('full_name'));	
		$user_email = trim($request->input('user_email'));	
		$contact_no = trim($request->input('contact_no'));
		
		$your_message = trim($request->input('your_message'));
		
		if($subject=="" || $full_name=="" || $user_email=="" || $your_message==""){
			return Redirect::to('contact-us')->with('blank', true);
		}else{
			// Admin Details
			$admin_det = Helpers::getAdminDetails();
			$admin_name = $admin_det[0]->admin_name;
			$admin_email = $admin_det[0]->alt_email;
			
			$current_year = date("Y");
			
			//Email Template Details
			$res_template = DB::table('email_template')->where('id', '=', 1)->get();
			$input = $res_template[0]->contents;
			
			$body_admin = str_replace(array('%ADMINNAME%','%NAME%','%EMAIL%','%CONTACTNO%','%MESSAGE%','%ADMINEMAIL%','%CURRENTYEAR%'), array($admin_name,$full_name,$user_email,$contact_no,$your_message,$admin_email, $current_year), $input);
		    //echo $body_admin;exit;
			
			/*$content = [
			'from_email' => $user_email,
			'subject'=> $subject,
			'body'=> $body_admin,
			'email_template' => 'emails.common_mail'
			];
			$ok=Mail::to($admin_email)->send(new MailBuilder($content));*/
			
			$headers = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=UTF-8\n";
			$headers .= "From:" . $full_name . " < " . $user_email . ">\n";
			//$ok = mail($admin_email, $subject, $body_admin, $headers);
				
			return Redirect::to('contact-us')->with('success', true);
		}
	}
	

	public function viewBooking(){
		$site_url = Config::get('constants.site_url');
		
		$admin_det = DB::table('core')->where('id',1)->first();
		$admin_name = $admin_det->admin_name;
		$admin_email = $admin_det->alt_email;
		$admin_contact_no = $admin_det->contact_no;
			
		Session::forget('booking_date');
		Session::forget('mandap_type');
	
	   $no_book_per_day_dtls = DB::table('payment_settings')->select('no_book_per_day')->where('id',1)->first();
	   $no_book_per_day = $no_book_per_day_dtls->no_book_per_day;
				
	   $startDate = strtotime(date("Y-m-d"));
	   $endDate= strtotime(date("Y-m-d", strtotime("+3 months")));
	   
	   //All booking date slotes from $startDate to $endDate.This date range will display in calender.
	   $date_range_ary = array();
	   for ($i = $startDate; $i <= $endDate; $i = $i + 86400) {
			$date_slot = date('Y-m-d', $i);
			array_push($date_range_ary, date("d-m-Y", strtotime($date_slot)));
	   }
	   //print_r($date_range_ary);exit;
	
	   //Here i am fetching booking dates between the month $startDate & $endDate
		$cur_date = date("Y-m-d");
		$dt_obj = new DateTime($cur_date);
		$dt_obj->modify('first day of this month');
		$date_from = $dt_obj->format('Y-m-d');
	
	
	   $date_to = date("Y-m-d", strtotime("+3 months"));
	   $booking_record_ary = array();
	   $booking_records = DB::table('booking_details')
				->where('transaction_id', '!=' ,NULL)
				->whereBetween('booking_date', array($date_from,$date_to))
				->orderBy('booking_date', 'asc')
				->groupBy('booking_date')
				->pluck('booking_date');
		
	
		foreach ($booking_records as  $booking_value) {
			array_push($booking_record_ary,$booking_value);
		}
		//print_r($booking_record_ary);exit;
	
	
		//Here i am fetching booking started dates & booking completed dates
		$booking_started_ary = array();
		$booking_comp_ary =array();
		foreach ($booking_record_ary as $booking_record_value) {
			$chk_records = DB::table('booking_details')
			->where('transaction_id', '!=' ,NULL)
			->where('booking_date', '=' ,$booking_record_value)
			->count();
			if($chk_records == $no_book_per_day){
				array_push($booking_comp_ary, date("d-m-Y", strtotime($booking_record_value)));
			}else{
				array_push($booking_started_ary, date("d-m-Y", strtotime($booking_record_value)));
			}	
		}
		//print_r($booking_started_ary);
		//print_r($booking_comp_ary);
		//exit;
		
		$terms_det = DB::table('contents')->where('id','=',2)->get();
		//print_r($terms_det);exit;
		
		$default_select_date= date("Y-m-d", strtotime("+3 days"));
		
		$avl_mandaps = DB::select("SELECT * FROM mandap_types WHERE mt_id NOT IN (SELECT mandap_id FROM booking_details where booking_date='".$default_select_date."' AND transaction_id IS NOT NULL)");
		
		
		
		
		//echo "<pre>"; print_r($avl_mandaps);exit;
	
		return view('booking',['date_range_ary'=>$date_range_ary,'booking_started_ary'=>$booking_started_ary,'booking_comp_ary'=>$booking_comp_ary,'terms_det' => $terms_det,'avl_mandaps' => $avl_mandaps]);	
	}
	
	
	public function viewBooking1(){
		   $startDate = strtotime(date("Y-m-d"));
		   $endDate= strtotime(date("Y-m-d", strtotime("+3 months")));
		   
		   //All booking date slotes from $startDate to $endDate.This date range will display in calender.
		   $date_range_ary = array();
		   for ($i = $startDate; $i <= $endDate; $i = $i + 86400) {
    			$date_slot = date('Y-m-d', $i);
				array_push($date_range_ary, date("d-m-Y", strtotime($date_slot)));
		   }
		   //print_r($date_range_ary);exit;

		   //Here i am fetching booking dates between the month $startDate & $endDate
		    $cur_date = date("Y-m-d");
		    $dt_obj = new DateTime($cur_date);
		    $dt_obj->modify('first day of this month');
		    $date_from = $dt_obj->format('Y-m-d');


		   $date_to = date("Y-m-d", strtotime("+3 months"));
		   $booking_record_ary = array();
		   $booking_records = DB::table('booking_details')
					->where('transaction_id', '!=' ,'')
					->whereBetween('booking_date', array($date_from,$date_to))
					->orderBy('booking_date', 'asc')
                    ->groupBy('booking_date')
					->pluck('booking_date');
			

			foreach ($booking_records as  $booking_value) {
				array_push($booking_record_ary,$booking_value);
			}
			//print_r($booking_record_ary);exit;


			//Here i am fetchinh booking started dates & booking completed dates
			$booking_started_ary = array();
			$booking_comp_ary =array();
			foreach ($booking_record_ary as $booking_record_value) {
				$chk_records = DB::table('booking_details')
				->where('transaction_id', '!=' ,'')
				->where('booking_date', '=' ,$booking_record_value)
				->count();
				if($chk_records == 2){
					array_push($booking_comp_ary, date("d-m-Y", strtotime($booking_record_value)));
				}else{
					array_push($booking_started_ary, date("d-m-Y", strtotime($booking_record_value)));
				}	
			}
			//print_r($booking_started_ary);
			//print_r($booking_comp_ary);
			//exit;

			return view('booking1',['date_range_ary'=>$date_range_ary,'booking_started_ary'=>$booking_started_ary,'booking_comp_ary'=>$booking_comp_ary]);	
	}
	
	
	public function setSelectedDate(Request $request){
		$booking_date = $request->input('booking_date');
		$mandap_type = $request->input('mandap_type');
		
		if($booking_date=="" || $mandap_type==""){
			return Redirect::to('booking')->with('blank', true);
		}else{
			$dt_ary=explode(",",$booking_date);
			$dm = $dt_ary['1'];
			$yr= $dt_ary['2'];
			
			$dm_ary= explode(" ",$dm);
			$d = $dm_ary[1];
			$m = $dm_ary[2];
			$m_name= date("m",strtotime($m));
			
			$final_selected_dt = $yr."-".$m_name."-".$d;
			
			$mandap_det = DB::table('mandap_types')
				->where('mt_id',$mandap_type)
				->first();
		    $mandap_name = $mandap_det->mandap_type;
		
			Session::put('booking_date', $final_selected_dt);
			Session::put('mandap_type', $mandap_type);
			Session::put('mandap_name', $mandap_name);
			
			return Redirect::to('select-service');
		}
	}



	public function viewServices(){
		if(Session::get('booking_date')=='' || Session::get('mandap_type')==''){
			return Redirect::to('booking');
		}
	  	return view('select-service');
	}

	public function payNow(Request $request){
		$full_name = $request->input('firstname');
		$email = $request->input('email');
		$contact_no = $request->input('phone');
		$address = $request->input('address');
		$special_notes = $request->input('special_notes');
		
		$booking_date = Session::get('booking_date');
		$booking_time = $request->input('booking_time');
		
		$mandap_booking_price = $request->input('mandap_booking_price');
		$adv_per = $request->input('adv_per');
		
		$total_booking_cost = $request->input('amount');
		$adv_amount = $request->input('adv_amount');
		$booking_due = $total_booking_cost - $adv_amount;
		
		//echo "<pre>";print_r($_REQUEST);exit;
		
		
		$mandap_id = Session::get('mandap_type');
		
		$created_date = date("Y-m-d");
		DB::table('booking_details')->insert(array('full_name' => $full_name,
		  	  'email' => $email,
		  	  'contact_no' => $contact_no,
			  'address' => $address,
			  'special_notes' => $special_notes,
			  'booking_date' => $booking_date,
			  'booking_time' => $booking_time,
			  'mandap_booking_price' => $mandap_booking_price,
			  'total_booking_cost' => $total_booking_cost,
			  'adv_amount' => $adv_amount,
			  'adv_per' => $adv_per,
			  'booking_due' => $booking_due,
			  'due_clear_status' => 'Pending',
			  'mandap_id' => $mandap_id,
			  'booking_reg_date' => $created_date));
			  
		$booking_id= DB::getPdo()->lastInsertId();
		Session::put('booking_id', $booking_id);
		
		if($request->input('activity')!=''){
		  $activity_ary = $request->input('activity');
		  foreach($activity_ary as  $value) {
			  $item_ary = explode("-",$value);
			  $sub_cat_id = $item_ary[0];
			  $sub_cat_name = $item_ary[1];
			  $service_price = $item_ary[2];
			  
			  DB::table('booking_extra_services')->insert(array('booking_id' => $booking_id,
			  'sub_cat_id' => $sub_cat_id,
		  	  'sub_cat_name' => $sub_cat_name,
		  	  'service_price' => $service_price
			 ));
		  }
		}
		return Redirect::to('pay-now');
	}
	
	
	public function viewPayNow(){
		$booking_id = Session::get('booking_id');
		$pay_dtls = DB::table('booking_details')
					->where('booking_id', '=' ,$booking_id)
					->get();
		
		if($pay_dtls[0]->adv_amount=='' || $pay_dtls[0]->adv_amount==0 || $pay_dtls[0]->full_name=="" || $pay_dtls[0]->email=="" || $pay_dtls[0]->contact_no=="" || $pay_dtls[0]->booking_id==""){
			return Redirect::to('booking');
		}		
		return view('pay-now',['pay_dtls' => $pay_dtls]);
	}

	public function updateTransactionDetails(){
		/*$fp=fopen("ipnresult.txt","w");
		fwrite($fp,'Hello Working fine'."\n");*/
		
		$status=$_POST["status"];
		$firstname=$_POST["firstname"];
		$amount=$_POST["amount"];
		$txnid=$_POST["txnid"];
		$posted_hash=$_POST["hash"];
		$key=$_POST["key"];
		$productinfo=$_POST["productinfo"];
		$email=$_POST["email"];
		
		
		//$mihpayid=$_POST["mihpayid"];
		
		
		//$salt="GjpUsgXW55";
		$payment_det = DB::table('payment_settings')
					->where('id', '=' ,1)
					->get();
		$salt=$payment_det[0]->salt;
		
		
		/*$fp=fopen("ipnresult.txt","w");
		foreach($_POST as $key => $value){
			fwrite($fp,$key.'===='.$value."\n");
		}*/
				
		if($status=='success' && $productinfo!=''){
			DB::table('booking_details')
				->where('booking_id', '=', $productinfo)
				->update(['transaction_id' => $txnid]);
			
			$site_url = Config::get('constants.site_url');
			$booking_dtls = DB::table('booking_details')->where('booking_id', '=', $productinfo)->get();
			$mandap_dtls = DB::table('mandap_types')->where('mt_id', '=',$booking_dtls[0]->mandap_id)->get();
			
			$admin_det = DB::table('core')->where('id',1)->first();
			$admin_name = $admin_det->admin_name;
			$admin_email = $admin_det->alt_email;
			$admin_contact_no = $admin_det->contact_no;
			
			$body1='<table align="center" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #707A54; background:#707A54; font-family:Arial, Helvetica, sans-serif; font-size:14px;" width="100%">
	<tbody>
	  <tr>
		<td align="left" style="padding:10px 10px 10px 10px; background-color:#ffffff; background-repeat:repeat-x; background-position:bottom;"><img src="'.$site_url."public/images/logo.png".'" /></td>
	  </tr>
	  
	  <tr>
		<td style="background-color:#ffffff; padding:10px;">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
			<tr>
			<td width="33%" height="30"><strong style="font-size:16px;">Booking Information </strong></td>
			<td width="33%"><strong style="font-size:16px;">Booking Charges</strong></td>
			
			 <td width="33%"><strong style="font-size:16px;">Customer Information </strong></td>
			</tr>
		  
			<tr>
			  <td height="30"><strong style="font-size:14px;">Registration  Date :</strong> '.date("jS M,Y",strtotime($booking_dtls[0]->booking_reg_date)).'</td>
			  <td><strong style="font-size:14px;">Mandap Booking  :</strong> Rs.  '.number_format($booking_dtls[0]->mandap_booking_price,2,'.','').'</td>
			  <td>'.$booking_dtls[0]->full_name.'</td>
			</tr>
			<tr>
			<td height="30"><strong style="font-size:14px;">Mandap : </strong>'.$mandap_dtls[0]->mandap_type.'</td>
			<td><strong style="font-size:14px;">Grand Total  :</strong> Rs.  '.number_format($booking_dtls[0]->total_booking_cost,2,'.','').'</td>
			 <td><strong style="font-size:14px;">Contact No. :</strong> '.$booking_dtls[0]->contact_no.'</td>
			</tr>
		  
			<tr>
			<td height="30"><strong style="font-size:14px;">Booking Date :</strong> '.date("jS M,Y",strtotime($booking_dtls[0]->booking_date)).'</td>
			<td><strong style="font-size:14px;">Advance Price :</strong> Rs.  '.number_format($booking_dtls[0]->adv_amount,2,'.','').'</td>
			<td><strong style="font-size:14px;">Email :</strong> '.$booking_dtls[0]->email.'</td>
			</tr>
		  
			<tr>
			<td height="30"><strong style="font-size:14px;">Booking ID :</strong> '.$booking_dtls[0]->booking_id.'</td>
			<td><strong style="font-size:14px;">Due Price :</strong> Rs.  '.number_format($booking_dtls[0]->	booking_due,2,'.','').'</td>
			 <td>Address</td>
			</tr>
			
			<tr>
			<td height="30"><strong style="font-size:14px;">Transaction ID :</strong> '.$booking_dtls[0]->transaction_id.'</td>
			<td>&nbsp;</td>
			<td>'.$booking_dtls[0]->address.'</td>
			</tr>
	
		   
		  </table>
		  
		  
		  <div style="font-size:14px; line-height:22px; padding:20px 0px 30px 0px;">
			 <h3>Other Services</h3>
			 <ul style="padding:0px">';
			  $extra_service_ary = DB::table('booking_extra_services')
			  ->where('booking_id', '=' ,$booking_dtls[0]->booking_id)
			  ->get();
			  $body3 = "";
			  foreach($extra_service_ary as $es_det){
			  $body2='<li style="width:33%; float:left; list-style:none; margin-bottom:10px;">'.$es_det->sub_cat_name.' 
						  <b>Rs. '.number_format($es_det->service_price,2,'.','').'</b>
					 </li>';
			  
			  $body3 =$body3.$body2;
			  }
			  $body3 =$body3.'</ul>
		  </div>
		  <div style="clear:both"></div>';
		
		 
		  $body5 ='<div style="padding:20px 0px 20px 0px; font-size:13px; line-height:22px;">
		  <strong style="font-size:14px;">Thank you,</strong><br />
		  <span style="color:#000;">'.$admin_name.'<br />
		  
		  <strong style="font-size:14px;">Email : </strong> <a href="mailto:'.$admin_email.'" style="color:#000; text-decoration:none;">'.$admin_email.'</a>
		  
		  <br />
		  <strong style="font-size:14px;">Contact No. :</strong> '.$admin_contact_no.'<br />
		  </div>
		
		</td>
	  </tr>
	  
	  
	</tbody>
	</table>';
	
			$body6=$body1.$body3.$body5;
	         //echo $body6;exit;
		
			$subject_admin ="Booking Details";
			$subject_user ="Thank You for your booking";
			
			$headers_user  = 'MIME-Version: 1.0' . "\n";
			$headers_user .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers_user .= "From:".$admin_email."\n";
			
			$headers_admin  = 'MIME-Version: 1.0' . "\n";
			$headers_admin .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers_admin .= "From:".$email."\n";
		
		
			 //Mail for admin
			 // mail($admin_email,$subject_admin,$body6,$headers_admin);
			 //Mail for user
			 // mail($email,$subject_user,$body6,$headers_user);




			Session::forget('booking_id');
			
			
			return Redirect::to('thank-you');
		}else{
			return Redirect::to('payment-failed');
		}
	}

	public function showThankYou(){
		return view('thank-you');
	}
	
	public function showPaymentFailed(){
		return view('payment-failed');
	}

	

	public function saveNewsletterData(Request $request) {
        $news_ltr_email = $request->input('news_ltr_email');
		
        $current_date = date("Y-m-d");

        $count = DB::table('newsletter')->where('nl_email', '=', $news_ltr_email)->count();
        if ($news_ltr_email == "") {
            return "0";
        } else if ($count > 0) {
            return "1";
        } else {
            DB::table('newsletter')->insert(array('nl_email' => $news_ltr_email, 'subscribe_date' => $current_date));
            return "success";
        }
    }
	
	public function availableMandapList(Request $request){
		$selected_date = date("Y-m-d",strtotime($request->input('booking_date')));
		//echo "SELECT * FROM mandap_types WHERE mt_id NOT IN (SELECT mandap_id FROM booking_details where booking_date='".$selected_date."' AND transaction_id!=NULL)";exit;
		
		$avl_mandaps = DB::select("SELECT * FROM mandap_types WHERE mt_id NOT IN (SELECT mandap_id FROM booking_details where booking_date='".$selected_date."' AND transaction_id IS NOT NULL)");
		echo json_encode($avl_mandaps);
		
	}
}
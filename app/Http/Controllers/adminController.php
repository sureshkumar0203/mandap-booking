<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
//This line is used for getting the input box value
use Illuminate\Http\Request;
//This line is used for database connection
use DB;
//This line is used for session
use Session;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;
use Helpers;
use Image;
use Response;
use Excel;

use Mail;
use App\Mail\MailBuilder;

use App\Mylibs\thumbnail_manager;

class adminController extends BaseController {
	//Admin Login
	public function adminLogin(Request $request){
	  $email = $request->input('email');
	  $user_password = $request->input('password');
	  //echo $email;echo $user_password;exit;
	  
	  if ($email == "" || $user_password == "") {
	  	return Redirect::to('administrator')->with('blank', true);
	  }
	  
	  // Get records from core table with email address
	  $result = DB::table('core')
	  ->where('email', '=', $email)
	  ->get();
	  
	  // If record not exist
	  if (count($result) == 0) {
		  return Redirect::to('administrator')->with('invalid', true);
	  }
	  
	  // Decrypt the password from the database
	  $db_password = base64_decode(base64_decode($result[0]->password));
	  
	  // If password does not macth in db_password
	  if ($user_password != $db_password) {
		  return Redirect::to('administrator')->with('invalid', true);
	  }
	  
	  // Store in SESSION
	  Session::put('admin_id', $result[0]->id);
	  Session::put('admin_name', $result[0]->admin_name);
	  return Redirect::to('administrator/dashboard');
	}
  
	//Admin Logout
	public function logout() {
	  //Delete data from cart_temp table
	  //$yesterday=date('Y-m-d', strtotime("-3 day"));
	  //DB::table('booking_details')->where('transaction_id', '!=' ,NULL)->where('booking_reg_date', '<=', $yesterday)->delete();
	  
	  //Delete data from master order & order items table if transaction id is blank
	  $yesterday=date('Y-m-d', strtotime("-3 day"));
	  $order_info = DB::table('booking_details')
					->where('transaction_id','=' ,NULL)
					->where('booking_reg_date', '<=', $yesterday)
		            ->get();
	  //echo "<pre>";print_r($order_info);exit;
	  foreach($order_info as $del_record){
		  DB::table('booking_details')->where('booking_id', '=', $del_record -> booking_id)->delete();
		  DB::table('booking_extra_services')->where('booking_id', '=', $del_record -> booking_id)->delete();
	  }
	  Session::flush();
	  Session::forget('admin_id');
	  Session::forget('admin_name');
	  
	  return Redirect::to('administrator');
	}
	
	//Admin Password Recovery
	public function adminPswRecovery(Request $request) {
	  $forgot_email = $request->input('forgot_email');
	
	  if ($forgot_email == "") {
		  return Redirect::to('administrator/forgot-psw-admin')->with('blank', true);
	  }
	
	  // Get records from core table with email address
	  $result = DB::table('core')
			  ->where('email', '=', $forgot_email)
			  ->get();
	
	  // If record not exist
	  if (count($result) == 0) {
		  return Redirect::to('administrator/forgot-psw-admin')->with('invalid', true);
	  }
	
	  // Decrypt the password from the database
	  $db_password = base64_decode(base64_decode($result[0]->password));
	
	  $res_template = DB::table('email_template')->where('id', '=', 4)->get();
	  // Admin Details
	  $admin_det = DB::table('core')->where('id', '=', 1)->get();
	  $admin_name = $admin_det[0]->admin_name;
	  $admin_email = $admin_det[0]->alt_email;
	  $site_url = $admin_det[0]->site_url;
	
	  $current_year = date("Y");
	
	  # Subject
	  $subject = "Administrator Password recovery";
	  $input = $res_template[0]->contents;
	
	  //echo $admin_email;exit;
	  $body = str_replace(array('%ADMINNAME%', '%ADMINEMAIL%', '%ADMINPASSWORD%', '%FROMEMAIL%', '%CURRENTYEAR%'), array($admin_name, $forgot_email, $db_password, $admin_email, $current_year), $input);
	  //echo $body;exit;
	  
	
	    $headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From:" . $admin_name . " < " . $admin_email . ">\n";
		/* echo $emailTo."<br><br>";
		echo $admin_email."<br><br>";
		echo $body."<br><br>-----------<br><br>"; */

		$ok = mail($forgot_email, $subject, $body, $headers);

		if ($ok) {
		  return Redirect::to('administrator/forgot-psw-admin')->with('success', true);
		} else {
		  return Redirect::to('administrator/forgot-psw-admin')->with('failed', true);
		}
	}
	
	//View manage content page start
	public function viewManageContents() {
	  $data = DB::table('contents')->orderBy('id')->get();
	  return view('admin.manage-contents')->with('data', $data);
	}
	
	public function viewEditContent($reference_id) {
	  $data = DB::table('contents')->where('id', '=', $reference_id)->get();
	  return view('admin.edit-content')->with('data', $data);
	}
	
	public function updateContent(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $page_title = $request->input('page_title');
	  $content = $request->input('content');
	  $meta_title = $request->input('meta_title');
	  $meta_descr = $request->input('meta_descr');
	  $meta_keyword = $request->input('meta_keyword');
	
	  if ($page_title == "" || $content == "") {
		  return Redirect::to('administrator/edit-content/' . $reference_id . '/edit')->with('blank', true);
	  }
	  DB::table('contents')->where('id', '=', $reference_id)->update(array('page_title' => $page_title, 'content' => $content, 'meta_title' => $meta_title, 'meta_descr' => $meta_descr, 'meta_keyword' => $meta_keyword));
	  return Redirect::to('administrator/edit-content/' . $reference_id . '/edit')->with('success', true);
	}
	
	//Banner page coding starts here
	public function viewManageBanners() {
	  $data = DB::table('banners')->orderBy('id', 'DESC')->get();
	  return view('admin.manage-banners')->with('data', $data);
	}
	
	public function viewAddBanner() {
	  return view('admin.add-banner');
	}
	
	public function saveBannerData(Request $request) {
	  if ($request->file('upload_banner') == "") {
		  return Redirect::to('administrator/add-banner/')->with('blank', true);
	  }
	  $ext = strtolower($request->file('upload_banner')->getClientOriginalExtension());
	  $punch_line1 = ($request->input('punch_line1'))?$request->input('punch_line1'):'';
	  $punch_line2 = ($request->input('punch_line2'))?$request->input('punch_line2'):'';
	
	  // File Upload here
	  if ($request->file('upload_banner')->getClientOriginalName() != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
		  $banner_image = 'B_' . date('dmy') . time() . '.' . $request->file('upload_banner')->getClientOriginalExtension();
		  $request->file('upload_banner')->move(public_path() . '/banners/', $banner_image);
	
		  $created_date = date("Y-m-d");
		  DB::table('banners')->insert(array('banner_photo' => $banner_image,
		  	  'punch_line1' => $punch_line1,
		  	  'punch_line2' => $punch_line2,
			  'created_date' => $created_date,
			  'updated_date' => $created_date));
		  return Redirect::to('administrator/add-banner')->with('success', true);
	  } else {
		  return Redirect::to('administrator/add-banner/')->with('invformat', true);
	  }
	}
	
	public function viewEditBanner($reference_id) {
	  $data = DB::table('banners')->where('id', '=', $reference_id)->get();
	  return view('admin.edit-banner')->with('data', $data);
	}
	
	public function updateBanner(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $updated_date = date("Y-m-d");
	  $punch_line1 = ($request->input('punch_line1'))?$request->input('punch_line1'):'';
	  $punch_line2 = ($request->input('punch_line2'))?$request->input('punch_line2'):'';
	  DB::table('banners')->where('id', '=', $reference_id)->update(array('punch_line1' => $punch_line1, 'punch_line2' => $punch_line2, 'updated_date' => $updated_date));
	
	  if ($request->file('upload_banner') != "") {
		  $ext = strtolower($request->file('upload_banner')->getClientOriginalExtension());
		  // File Upload here
		  if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
			  //Unlink code starts here
			  $data = DB::table('banners')->where('id', '=', $reference_id)->get();
			  if ($data[0]->banner_photo != '') {
				  $unlink_path = "public/banners/" . $data[0]->banner_photo;
				  unlink($unlink_path);
			  }
			  //Unlink code ends here	
	
			  $banner_image = 'B_' . date('dmy') . time() . '.' . $request->file('upload_banner')->getClientOriginalExtension();
			  $request->file('upload_banner')->move(public_path() . '/banners/', $banner_image);
			  DB::table('banners')->where('id', '=', $reference_id)->update(array('banner_photo' => $banner_image, 'updated_date' => $updated_date));
			  return Redirect::to('administrator/edit-banner/' . $reference_id . '/edit')->with('success', true);
		  }
	  } else {
		  return Redirect::to('administrator/edit-banner/' . $reference_id . '/edit')->with('success', true);
	  }
	}
	
	public function deleteBanner($id) {
	  $data = DB::table('banners')->where('id', '=', $id)->get();
	  //Unlink code starts here
	  $data = DB::table('banners')
			  ->where('id', '=', $id)
			  ->get();
	  if ($data[0]->banner_photo != '') {
		  $unlink_path = "public/banners/" . $data[0]->banner_photo;
		  unlink($unlink_path);
	  }
	  //Unlink code ends here	
	  DB::table('banners')->where('id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-banners');
	}
	//Banner page coding ends here
	
	//Manage Newsletter contact list starts here
	public function viewManageNewsletter() {
	  $data = DB::table('newsletter')->orderBy('id', 'DESC')->get();
	  $template_det = DB::table('email_template')->where('id', '=', '9')->get();
	  return view('admin.manage-newsletter')->with('data', $data)->with('template_det', $template_det);
	}
	
	public function deleteNlEmail($id) {
	  DB::table('newsletter')->where('id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-newsletter');
	}
	
	public function sendNewsletterMail(Request $request) {
	  if ($request->input('to_email') == '' || $request->input('subject') == '' || $request->input('contents') == '') {
		  return Redirect::to('administrator/manage-newsletter')->with('blank', true);
	  }
	
	  $res_template = DB::table('email_template')->where('id', '=', 9)->get();
	
	  // Admin Details
	  $admin_det = DB::table('core')->where('id', '=', 1)->get();
	  $admin_name = $admin_det[0]->admin_name;
	  $admin_email = $admin_det[0]->alt_email;
	  $site_url = $admin_det[0]->site_url;
	
	
	
	  $current_year = date("Y");
	
	  # Subject
	  $subject = $request->input('subject');
	  $input = $request->input('contents');
	
	  $allEmail = join(",", $request->input('to_email'));
	  $toEmail = explode(",", $allEmail);
	  for ($i = 0; $i < count($toEmail); $i++) {
		  $data = DB::table('newsletter')->where('nl_email', '=', $toEmail)->get();
		  $uid = $data[0]->id;
		  $token = Helpers::keyMaker($uid);
		  $body = str_replace(array('%ADMINNAME%', '%ADMINEMAIL%', '%CURRENTYEAR%', '%UID%', '%TOKEN%'), array($admin_name, $admin_email, $current_year, $uid, $token), $input);
		  //echo $body;exit;
	
		  $emailTo = $toEmail[$i];
		  if ($emailTo != "") {
			  $headers = "MIME-Version: 1.0\n";
			  $headers .= "Content-type: text/html; charset=UTF-8\n";
			  $headers .= "From:" . $admin_name . " < " . $admin_email . ">\n";
			  /* echo $emailTo."<br><br>";
				echo $admin_email."<br><br>";
				echo $body."<br><br>-----------<br><br>"; */
			  $ok = mail($emailTo, $subject, $body, $headers);
		  }
	  }
	  return Redirect::to('administrator/manage-newsletter')->with('success', true);
	}
	//Manage Newsletter contact list ends here
	
    //Manage Service Category 
	public function viewManageServiceCategory() {
	   $data = DB::table('service_categories')->orderBy('cat_id', 'DESC')->get();
	   return view('admin.manage-service-category')->with('data', $data);
	}
	
	public function viewAddServiceCategory() {
	   return view('admin.add-service-category');
	}
	
	public function saveServiceCategoryData(Request $request){
	  $category_name = $request->input('category_name');
	  $cat_seo_name = Helpers::seoUrl($category_name);
	  $abt_ser_cat = $request->input('abt_ser_cat');
	  
	  
	  if ($category_name=="" || $request->file('category_photo') == "") {
		return Redirect::to('administrator/add-service-category/')->with('blank', true);
	  }
	  
	  $ext = strtolower($request->file('category_photo')->getClientOriginalExtension());
	  if ($request->file('category_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
		return Redirect::to('administrator/add-service-category')->with('invformat', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('service_categories')
			  ->where('category_name', '=', $category_name)
			  ->count();
	  if($count == 0 && $request->file('category_photo') != "" && ($ext == "png" || $ext == "jpg" || $ext == "jpeg")){
		  //Laravel photo cropping
		  $category_image = 'C_'.date('dmy').time().'.'.$request->file('category_photo')->getClientOriginalExtension();
	
		  //Thumb Photo Uploading
		  $thumb_img = Image::make($request->file('category_photo')->getRealPath())->resize(270, 228);
		  $thumb_img->save(public_path() . '/service-category-photo/thumb/' . $category_image, 80);
	
		  //Upload Original Image Script
		  //$request->file('category_photo')->move(public_path() . '/category-photo/', $blog_image);
		  
		  $created_date = date("Y-m-d");
		  DB::table('service_categories')->insert(array('category_name' => $category_name,
		  	  'cat_seo_name'	=> $cat_seo_name,
			  'category_photo' => $category_image,
			  'abt_ser_cat'	=> $abt_ser_cat,
			  'created_date' => $created_date,
			  'updated_date' => $created_date));
		 return Redirect::to('administrator/add-service-category')->with('success', true);
	  }else{
		  return Redirect::to('administrator/add-service-category/')->with('exist', true);
	  }
	}
	
	public function viewEditServiceCategory($reference_id) {
	  $data = DB::table('service_categories')->where('cat_id', '=', $reference_id)->get();
	  return view('admin.edit-service-category')->with('data', $data);
	}
	
	public function updateServiceCategory(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $category_name = $request->input('category_name');
	  $cat_seo_name = Helpers::seoUrl($category_name);
	  $abt_ser_cat = $request->input('abt_ser_cat');
	  
	  if ($category_name=="" || $reference_id == "") {
		return Redirect::to('administrator/edit-service-category/' . $reference_id . '/edit')->with('blank', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('service_categories')
			->where('category_name', '=', $category_name)
			->where('cat_id', '<>', $reference_id)
			->count();
	  if($count>0){
		  return Redirect::to('administrator/edit-service-category/' . $reference_id . '/edit')->with('exist', true);
	  }
	  
	  if($request->file('category_photo') != ""){
		  $ext = strtolower($request->file('category_photo')->getClientOriginalExtension());
		  if($request->file('category_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
			  return Redirect::to('administrator/edit-service-category/' . $reference_id . '/edit')->with('invformat', true);
		  }
	
		  if ($request->file('category_photo') != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
			  //Unlink code starts here
			  $data = DB::table('service_categories')->where('cat_id', '=', $reference_id)->get();
			  if ($data[0]->category_photo != '') {
				  $unlink_path_thumb = "public/service-category-photo/thumb/" . $data[0]->category_photo;
				  unlink($unlink_path_thumb);
			  }
			  //Unlink code ends here
			  //Laravel photo cropping
			  $category_image = 'N_' . date('dmy') . time() . '.' . $request->file('category_photo')->getClientOriginalExtension();
	
			  //Thumb Photo Uploading
			  $thumb_img = Image::make($request->file('category_photo')->getRealPath())->resize(270, 228);
	
			  $thumb_img->save(public_path() . '/service-category-photo/thumb/' . $category_image, 80);
	
			  DB::table('service_categories')->where('cat_id', '=', $reference_id)->update(array('category_photo' => $category_image));
		  }
	  }
	  DB::table('service_categories')->where('cat_id', '=', $reference_id)->update(array('category_name' => $category_name,'cat_seo_name'	=> $cat_seo_name,'abt_ser_cat'	=> $abt_ser_cat));
	  return Redirect::to('administrator/edit-service-category/' . $reference_id . '/edit')->with('success', true);
	}
	
	public function deleteServiceCategory($id) {
	  //Unlink code starts here
	  $cat_data = DB::table('service_categories')->where('cat_id', '=', $id)->get();
	  if ($cat_data[0]->category_photo != '') {
		  $unlink_path_thumb = "public/service-category-photo/thumb/" . $cat_data[0]->category_photo;
		  unlink($unlink_path_thumb);
	  }
	  DB::table('service_categories')->where('cat_id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-service-category');
	}
	
	//Manage Service Sub Category 
	public function viewManageServiceSubCategory() {
	   $data = DB::table('service_sub_categories')
            ->leftJoin('service_categories', 'service_sub_categories.cat_id', '=', 'service_categories.cat_id')
            ->get();
			
			
	   return view('admin.manage-service-sub-category')->with('data', $data);
	}
	
	public function viewAddServiceSubCategory() {
		$cat_det = DB::table('service_categories')->pluck('category_name','cat_id')->prepend('Please Select','');
		return view('admin.add-service-sub-category')->with('cat_det', $cat_det);
	}
	
	public function saveServiceSubCategoryData(Request $request){
	  $cat_id = $request->input('cat_id');
	  $sub_cat_name = $request->input('sub_cat_name');
	  $sub_cat_seo_name = Helpers::seoUrl($sub_cat_name);
	  $service_price = ($request->input('service_price'))?$request->input('service_price'):0;
	  
	  
	  if ($cat_id=="" || $sub_cat_name=="") {
		  return Redirect::to('administrator/add-service-sub-category/')->with('blank', true);
	  }
	  //Duplicate checked
	  $count = DB::table('service_sub_categories')
	 		  ->where('cat_id', '=', $cat_id)
			  ->where('sub_cat_name', '=', $sub_cat_name)
			  ->count();
	  if($count == 0){
		  $created_date = date("Y-m-d");
		  DB::table('service_sub_categories')->insert(array('cat_id' => $cat_id,
		  	  'sub_cat_seo_name' => $sub_cat_seo_name,
			  'sub_cat_name' => $sub_cat_name,
			  'service_price' => $service_price,
			  'created_date' => $created_date,
			  'updated_date' => $created_date));
		 return Redirect::to('administrator/add-service-sub-category')->with('success', true);
	  }else{
		  return Redirect::to('administrator/add-service-sub-category/')->with('exist', true);
	  }
	}
	
	public function viewEditServiceSubCategory($reference_id) {
	  $data = DB::table('service_sub_categories')->where('sub_cat_id', '=', $reference_id)->get();
	  $cat_det = DB::table('service_categories')->pluck('category_name','cat_id')->prepend('Please Select','');
	  return view('admin.edit-service-sub-category')->with('data', $data)->with('cat_det', $cat_det);
	}
	
	public function updateServiceSubCategory(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $cat_id = $request->input('cat_id');
	  $sub_cat_name = $request->input('sub_cat_name');
	  $sub_cat_seo_name = Helpers::seoUrl($sub_cat_name);
	  $service_price = ($request->input('service_price'))?$request->input('service_price'):0;
	  
	  if ($reference_id == "" || $cat_id=="" || $sub_cat_name=="") {
		return Redirect::to('administrator/edit-service-sub-category/' . $reference_id . '/edit')->with('blank', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('service_sub_categories')
	  		->where('cat_id', '=', $cat_id)
			->where('sub_cat_name', '=', $sub_cat_name)
			->where('sub_cat_id', '<>', $reference_id)
			->count();
	  //dd($count);exit;
			
	  if($count>0){
		  return Redirect::to('administrator/edit-service-sub-category/' . $reference_id . '/edit')->with('exist', true);
	  }
	  
	  DB::table('service_sub_categories')->where('sub_cat_id', '=', $reference_id)->update(array('cat_id' => $cat_id,'sub_cat_name' => $sub_cat_name,'sub_cat_seo_name' => $sub_cat_seo_name, 'service_price' => $service_price));
	  return Redirect::to('administrator/edit-service-sub-category/' . $reference_id . '/edit')->with('success', true);
	}
	
	public function deleteServiceSubCategory($id) {
	  DB::table('service_sub_categories')->where('sub_cat_id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-service-sub-category');
	}
	
	
	
	//Manage Testimonials
	public function viewManageTestimonial() {
	   $data = DB::table('testimonials')->orderBy('tm_id', 'DESC')->get();
	   return view('admin.manage-testimonials')->with('data', $data);
	}
	
	public function viewAddTestimonial() {
	   return view('admin.add-testimonial');
	}
	
	public function saveTestimonialData(Request $request){
	  $tm_user_name = $request->input('tm_user_name');
	  $tm_det = $request->input('tm_det');
	  
	  if($tm_user_name=="" || $tm_det== "") {
		return Redirect::to('administrator/add-testimonial/')->with('blank', true);
	  }
	  $tm_image="";
	  if($request->file('tm_photo') != ""){
		  $ext = strtolower($request->file('tm_photo')->getClientOriginalExtension());
		  if ($request->file('tm_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
			return Redirect::to('administrator/add-testimonial')->with('invformat', true);
		  }else{
			  //Laravel photo cropping
			  $tm_image = 'TM_'.date('dmy').time().'.'.$request->file('tm_photo')->getClientOriginalExtension();
		
			  //Thumb Photo Uploading
			  $thumb_img = Image::make($request->file('tm_photo')->getRealPath())->resize(76, 76);
			  $thumb_img->save(public_path() . '/testimonial-photo/thumb/' . $tm_image, 80);
		
			  //Upload Original Image Script
			  //$request->file('category_photo')->move(public_path() . '/category-photo/', $blog_image);
		  }
	  }
	  $created_date = date("Y-m-d");
	  DB::table('testimonials')->insert(array('tm_user_name' => $tm_user_name,
		  'tm_det'	=> $tm_det,
		  'tm_photo' => $tm_image,
		  'created_date' => $created_date,
		  'updated_date' => $created_date));
	 return Redirect::to('administrator/add-testimonial')->with('success', true);
	}
	
	public function viewEditTestimonial($reference_id) {
	  $data = DB::table('testimonials')->where('tm_id', '=', $reference_id)->get();
	  return view('admin.edit-testimonial')->with('data', $data);
	}
	
	public function updateTestimonial(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $tm_user_name = $request->input('tm_user_name');
	  $tm_det = $request->input('tm_det');
	  
	  
	  if ($tm_user_name=="" || $tm_det == "") {
		return Redirect::to('administrator/edit-testimonial/' . $reference_id . '/edit')->with('blank', true);
	  }
	  
	  
	  if($request->file('tm_photo') != ""){
		  $ext = strtolower($request->file('tm_photo')->getClientOriginalExtension());
		  if($request->file('tm_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
			  return Redirect::to('administrator/edit-testimonial/' . $reference_id . '/edit')->with('invformat', true);
		  }
	
		  if ($request->file('tm_photo') != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
			  //Unlink code starts here
			  $data = DB::table('testimonials')->where('tm_id', '=', $reference_id)->get();
			  if ($data[0]->tm_photo != '') {
				  $unlink_path_thumb = "public/testimonial-photo/thumb/" . $data[0]->tm_photo;
				  unlink($unlink_path_thumb);
			  }
			  //Unlink code ends here
			  
			  //Laravel photo cropping
			  $tm_image = 'TM_' . date('dmy') . time() . '.' . $request->file('tm_photo')->getClientOriginalExtension();
	
			  //Thumb Photo Uploading
			  $thumb_img = Image::make($request->file('tm_photo')->getRealPath())->resize(76, 76);
	
			  $thumb_img->save(public_path() . '/testimonial-photo/thumb/' . $tm_image, 80);
	
			  DB::table('testimonials')->where('tm_id', '=', $reference_id)->update(array('tm_photo' => $tm_image));
		  }
	  }
	  DB::table('testimonials')->where('tm_id', '=', $reference_id)->update(array('tm_user_name' => $tm_user_name,'tm_det'	=> $tm_det,));
	  return Redirect::to('administrator/edit-testimonial/' . $reference_id . '/edit')->with('success', true);
	}
	
	public function deleteTestimonial($id) {
	  //Unlink code starts here
	  $tm_data = DB::table('testimonials')->where('tm_id', '=', $id)->get();
	  if ($tm_data[0]->tm_photo != '') {
		  $unlink_path_thumb = "public/testimonial-photo/thumb/" . $tm_data[0]->tm_photo;
		  unlink($unlink_path_thumb);
	  }
	  DB::table('testimonials')->where('tm_id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-testimonials');
	}
	
	
	//Manage Bookings
	public function viewManageBookings() {
	   $data = DB::table('booking_details')->where('transaction_id','!=','')->orderBy('booking_id', 'DESC')->get();
	   return view('admin.manage-bookings')->with('data', $data);
	}
	
	public function viewBookingDetails($id) {
		$booking_dtls = DB::table('booking_details')
				->where('booking_id', '=', $id)
				->get();
		$ext_ser_info = DB::table('booking_extra_services')
			->where('booking_id', '=' ,$id)
			->get();
		
		$mandap_dtls = DB::table('mandap_types')
			->where('mt_id', '=' ,$booking_dtls[0]->mandap_id)
			->get();
		
		return view('admin.booking-details', compact('booking_dtls','ext_ser_info','mandap_dtls'));
	}
	
	
	public function printBookingDetails($id) {
		$booking_dtls = DB::table('booking_details')
				->where('booking_id', '=', $id)
				->get();
		$ext_ser_info = DB::table('booking_extra_services')
			->where('booking_id', '=' ,$id)
			->get();
		
		$mandap_dtls = DB::table('mandap_types')
			->where('mt_id', '=' ,$booking_dtls[0]->mandap_id)
			->get();
			
		$admin_dtls = DB::table('core')->get();
		
		return view('admin.print-booking-details', compact('booking_dtls','ext_ser_info','mandap_dtls','admin_dtls'));
	}
	
	
	public function updateBookingStatus(Request $request) {
		$reference_id = $request->input('reference_id');
		$due_clear_status = $request->input('due_clear_status');
		$due_clear_date = date("Y-m-d");
		
		if ($due_clear_status=="Pending") {
		  return Redirect::to('administrator/booking-details/' . $reference_id . '/details')->with('cos', true);
		}
		
		DB::table('booking_details')->where('booking_id', '=', $reference_id)->update(array('due_clear_status' => $due_clear_status, 'due_clear_date' => $due_clear_date));
		
		
		  
		return Redirect::to('administrator/booking-details/' . $reference_id . '/details')->with('success', true);
	}
	
	public function deleteOrder($id) {
		DB::table('master_order')->where('order_id', '=', $id)->delete();
		DB::table('order_items')->where('order_id', '=', $id)->delete();
		return Redirect::to('administrator/manage-orders');
	}
	
	
	// My Account start
	public function viewAdminAccount() {
		$data = DB::table('core')->get();
		return view('admin.my-account')->with('data', $data);
	}
	public function updateAdminDetails(Request $request) {
		$admin_name = $request->input('admin_name');
		$email = $request->input('email');
		$alt_email = $request->input('alt_email');
		$contact_no = $request->input('contact_no');
		$mobile_no = $request->input('mobile_no');
		$address = $request->input('address');
  
  
  		$facebook_url = $request->input('facebook_url', false);
		$twitter_url = $request->input('twitter_url', false);
		$linkedin_url = $request->input('linkedin_url');
  
		if ($admin_name == "" || $email == "") {
			return Redirect::to('administrator/my-account')->with('blank', true);
		}
  
		DB::table('core')
				->where('id', '>', 0)
				->update(['admin_name' => $admin_name,
					'email' => $email,
					'alt_email' => $alt_email,
					'contact_no' => $contact_no,
					'mobile_no'  => $mobile_no,
					'facebook_url' => $facebook_url,
					'twitter_url' => $twitter_url,
					'linkedin_url' => $linkedin_url,
					'address' => $address]);
		return Redirect::to('administrator/my-account')->with('success', true);
	}
	// My Account end
	
	//Change password Start
	public function viewChangePassword() {
		return view('admin.change-password-admin');
	}
  
	public function changeAdminPsw(Request $request) {
		$old_password = $request->input('old_password');
		$new_password = $request->input('new_password');
		$conf_password = $request->input('conf_password');
  
		if ($old_password == "" || $new_password == "" || $conf_password == "") {
			return Redirect::to('administrator/change-password-admin')->with('blank', true);
		}
  
		if ($new_password != $conf_password) {
			return Redirect::to('administrator/change-password-admin')->with('conf_not_match', true);
		}
  
		$is_password_exist = DB::table('core')
				->select('password')
				->where('id', '>', 0)
				->get();
		$decrypted_db_password = base64_decode(base64_decode($is_password_exist[0]->password));
  
		if ($decrypted_db_password != $old_password) {
			return Redirect::to('administrator/change-password-admin')->with('not_match', true);
		}
  
		$encrypted_password = base64_encode(base64_encode($new_password));
  
		DB::table('core')->where('id', '>', 0)->update(array('password' => $encrypted_password));
  
		return Redirect::to('administrator/change-password-admin')->with('success', true);
	}
	//Change password end
	
	//Manage Seo start
	public function viewManageSeo() {
		$data = DB::table('seo')->get();
		return view('admin.manage-seo')->with('data', $data);
	}
  
	public function updateSeoDetails(Request $request) {
		$meta_title = $request->input('meta_title');
		$meta_keyword = $request->input('meta_keyword');
		$meta_descr = $request->input('meta_descr');
  
		if ($meta_title == "" || $meta_keyword == "" || $meta_descr == "") {
			return Redirect::to('administrator/manage-seo')->with('blank', true);
		}
  
		DB::table('seo')
				->where('id', '>', 0)
				->update(
						array('meta_title' => $meta_title,
							'meta_keyword' => $meta_keyword,
							'meta_descr' => $meta_descr,
		));
		return Redirect::to('administrator/manage-seo')->with('success', true);
	}
	//Manage Seo end
	
	//Payment Section
	public function viewManagePayment() {
		$data = DB::table('payment_settings')->get();
		return view('admin.payment-setting')->with('data', $data);
	}
	
	public function updatePaymentSetting(Request $request) {
		$payment_getway_environment = $request->input('payment_getway_environment');
		$merchant_key = $request->input('merchant_key');
		$salt = $request->input('salt');
		$adv_per = $request->input('adv_per');
		$no_book_per_day = $request->input('no_book_per_day');
		
  
		if ($payment_getway_environment == "" || $merchant_key == "" || $salt == "" || $no_book_per_day=="") {
			return Redirect::to('administrator/payment-setting')->with('blank', true);
		}
  
		DB::table('payment_settings')
				->where('id', '>', 0)
				->update(['payment_getway_environment' => $payment_getway_environment,
					'merchant_key' => $merchant_key,
					'salt' => $salt,
					'adv_per' => $adv_per,
					'no_book_per_day' => $no_book_per_day
					]);
		return Redirect::to('administrator/payment-setting')->with('success', true);
	}
	
	//Manage Mandap
	public function viewManageMandaps() {
	   $data = DB::table('mandap_types')->orderBy('mt_id', 'DESC')->get();
	   return view('admin.manage-mandaps')->with('data', $data);
	}
	
	public function viewAddMandap() {
	   return view('admin.add-mandpa');
	}
	
	public function saveMandapData(Request $request){
	  $mandap_type = $request->input('mandap_type');
	 
	  if ($mandap_type=="") {
		return Redirect::to('administrator/add-mandap/')->with('blank', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('mandap_types')
			  ->where('mandap_type', '=', $mandap_type)
			  ->count();
	  if($count == 0){
		  DB::table('mandap_types')->insert(array('mandap_type' => $mandap_type));
		 return Redirect::to('administrator/add-mandap')->with('success', true);
	  }else{
		  return Redirect::to('administrator/add-mandap/')->with('exist', true);
	  }
	}
	
	public function viewEditMandap($reference_id) {
	  $data = DB::table('mandap_types')->where('mt_id', '=', $reference_id)->get();
	  return view('admin.edit-mandap')->with('data', $data);
	}
	
	public function updateMandap(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $mandap_type = $request->input('mandap_type');
	 
	  if ($mandap_type=="" || $reference_id == "") {
		return Redirect::to('administrator/edit-mandap/' . $reference_id . '/edit')->with('blank', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('mandap_types')
			->where('mandap_type', '=', $mandap_type)
			->where('mt_id', '<>', $reference_id)
			->count();
	  if($count>0){
		  return Redirect::to('administrator/edit-mandap/' . $reference_id . '/edit')->with('exist', true);
	  }
	  
	  
	  DB::table('mandap_types')->where('mt_id', '=', $reference_id)->update(array('mandap_type' => $mandap_type));
	  return Redirect::to('administrator/edit-mandap/' . $reference_id . '/edit')->with('success', true);
	}
	
	
	//View manage photo gallery page
	public function viewManagePhotos(){
		$data = DB::table('photo_gallery')->orderBy('ph_id','DESC')->get();
		return view('admin.manage-photo-gallery')->with('data', $data);
	}
	
	public function viewAddPhotoGallery(){
		return view('admin.add-photo-gallery');
	}
	
	public function savePhotoGalleryData(Request $request){
		$photo_title = $request->input('photo_title');
		
		if ($photo_title=="" || $request->file('gallery_photo') == "") {
			return Redirect::to('administrator/add-photo-gallery/')->with('blank', true);
		}
	  
		$ext = strtolower($request->file('gallery_photo')->getClientOriginalExtension());
		if ($request->file('gallery_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
		  return Redirect::to('administrator/add-photo-gallery')->with('invformat', true);
		}
	   
		if($request->file('gallery_photo') != "" && ($ext == "png" || $ext == "jpg" || $ext == "jpeg")){
			//Laravel photo cropping
			$gp_image = 'GP_'.date('dmy').time().'.'.$request->file('gallery_photo')->getClientOriginalExtension();
	  
			//Thumb Photo Uploading
			$thumb_img = Image::make($request->file('gallery_photo')->getRealPath())->resize(990, 665);
			$thumb_img->save(public_path() . '/gallery-photo/thumb/' . $gp_image, 80);
	  
			//Upload Original Image Script
			//$request->file('category_photo')->move(public_path() . '/category-photo/', $blog_image);
			
			$created_date = date("Y-m-d");
			DB::table('photo_gallery')->insert(array('photo_title' => $photo_title,
				'gallery_photo'	=> $gp_image,
				'created_date' => $created_date,
				'updated_date' => $created_date));
		   return Redirect::to('administrator/add-photo-gallery')->with('success', true);
		}
		
	}
	
	//View edit photo page
	public function viewEditPhoto($reference_id){
		$data = DB::table('photo_gallery')->where('ph_id', '=', $reference_id)->get();
		return view('admin.edit-photo-gallery')->with('data', $data);
	}	
	
	
	//Update Photo page
	public function updatePhotoDetails(Request $request){
		$reference_id = $request->input('reference_id');
		$photo_title = $request->input('photo_title');
	  
		if ($photo_title=="" || $reference_id=="") {
		  return Redirect::to('administrator/edit-photo-gallery/' . $reference_id . '/edit')->with('blank', true);
		}
		
		if($request->file('gallery_photo') != ""){
			$ext = strtolower($request->file('gallery_photo')->getClientOriginalExtension());
			if($request->file('gallery_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
				return Redirect::to('administrator/edit-photo-gallery/' . $reference_id . '/edit')->with('invformat', true);
			}
	  
			if ($request->file('gallery_photo') != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
				//Unlink code starts here
				$data = DB::table('photo_gallery')->where('ph_id', '=', $reference_id)->get();
				if ($data[0]->gallery_photo != '') {
					$unlink_path_thumb = "public/gallery-photo/thumb/" . $data[0]->gallery_photo;
					unlink($unlink_path_thumb);
				}
				//Unlink code ends here
				
				
				//Laravel photo cropping
				$gp_image = 'GP_' . date('dmy') . time() . '.' . $request->file('gallery_photo')->getClientOriginalExtension();
	  
				//Thumb Photo Uploading
				$thumb_img = Image::make($request->file('gallery_photo')->getRealPath())->resize(990, 665);
	  
				$thumb_img->save(public_path() . '/gallery-photo/thumb/' . $gp_image, 80);
	  
				DB::table('photo_gallery')->where('ph_id', '=', $reference_id)->update(array('gallery_photo' => $gp_image));
			}
		}
		DB::table('photo_gallery')->where('ph_id', '=', $reference_id)->update(array('photo_title' => $photo_title));
		return Redirect::to('administrator/edit-photo-gallery/' . $reference_id . '/edit')->with('success', true);
	}
	
	public function deletePhoto($id){
		//Unlink code starts here
		$data = DB::table('photo_gallery')->where('ph_id', '=', $id)->get();
		if($data[0]->gallery_photo!=''){	
			$unlink_path="public/gallery-photo/thumb/".$data[0]->gallery_photo;
			unlink($unlink_path);
		}
		//Unlink code ends here	
		DB::table('photo_gallery')->where('ph_id', '=', $id)->delete();
		return Redirect::to('administrator/manage-gallery');
	}
	
	
}

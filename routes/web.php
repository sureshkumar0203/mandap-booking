<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('booking-success', 'homeController@updateTransactionDetails');

Route::get('/', 'homeController@showHome');
Route::get('about-us', 'homeController@viewAboutUs');

Route::get('contact-us', 'homeController@viewContactUs');
Route::post('contact-us', 'homeController@sendContactUsMail');

Route::get('services', 'homeController@viewCmsServices');
Route::get('gallery', 'homeController@viewGallery');

Route::get('virtual-tour', 'homeController@viewVirtualTour');

Route::get('booking', 'homeController@viewBooking');
Route::get('booking1', 'homeController@viewBooking1');

Route::post('selected-date', 'homeController@setSelectedDate');

Route::get('select-service', 'homeController@viewServices');
Route::post('select-service', 'homeController@payNow');

Route::post('avl-mandap-list', 'homeController@availableMandapList');

Route::get('pay-now', 'homeController@viewPayNow');
Route::post('pay-now', 'homeController@viewPayNow');


Route::get('thank-you', 'homeController@showThankYou');
Route::get('payment-failed', 'homeController@showPaymentFailed');

Route::post('save-nl-data', 'homeController@saveNewsletterData');



/*
*************************************************************************************************************
#################################### ADMIN CONTROLLER STARTS HERE ###########################################
*************************************************************************************************************
*/
Route::get('administrator', function() {
    if (Session::get('admin_id') != '') {
        return Redirect::to('administrator/dashboard');
    } else {
        return View::make('admin.login');
    }
});

Route::post('admin-login','adminController@adminLogin');

//Admin Logout
Route::get('administrator/logout', array('uses' => 'adminController@logout'));

//forgot password - Admin
Route::get('administrator/forgot-psw-admin', function(){	
	return View::make('admin.forgot-psw-admin');
});
Route::post('admin-forgot-psw-process','adminController@adminPswRecovery');



Route::group(['middleware' => ['checkadminlogin']], function() {
	
	Route::get('administrator/dashboard', function(){
		return View::make('admin.dashboard'); 
	});

	//Manage Contents
	Route::get('administrator/manage-contents', 'adminController@viewManageContents');
	Route::get('administrator/edit-content/{id}/edit', 'adminController@viewEditContent');
	Route::post('update-content', 'adminController@updateContent');
	
	//Manage Banners
	Route::get('administrator/manage-banners', 'adminController@viewManageBanners');
	
	Route::get('administrator/add-banner', 'adminController@viewAddBanner');
	Route::post('add-banner', 'adminController@saveBannerData');
	
	Route::get('administrator/edit-banner/{id}/edit', 'adminController@viewEditBanner');
	Route::post('update-banner', 'adminController@updateBanner');
	
	Route::get('administrator/manage-banners/{id}/delete', 'adminController@deleteBanner');
	
	
	//Manage Service Category
	Route::get('administrator/manage-service-category', 'adminController@viewManageServiceCategory');
	
	Route::get('administrator/add-service-category', 'adminController@viewAddServiceCategory');
	Route::post('add-service-category', 'adminController@saveServiceCategoryData');
	
	Route::get('administrator/edit-service-category/{id}/edit', 'adminController@viewEditServiceCategory');
	Route::post('update-service-category', 'adminController@updateServiceCategory');
	
	Route::get('administrator/manage-service-category/{id}/delete', 'adminController@deleteServiceCategory');
	
	//Manage Service Sub Category
	Route::get('administrator/manage-service-sub-category', 'adminController@viewManageServiceSubCategory');
	
	Route::get('administrator/add-service-sub-category', 'adminController@viewAddServiceSubCategory');
	Route::post('add-service-sub-category', 'adminController@saveServiceSubCategoryData');
	
	Route::get('administrator/edit-service-sub-category/{id}/edit', 'adminController@viewEditServiceSubCategory');
	Route::post('update-service-sub-category', 'adminController@updateServiceSubCategory');
	
	Route::get('administrator/manage-service-sub-category/{id}/delete', 'adminController@deleteServiceSubCategory');
	
	
	//Manage Testimonials
	Route::get('administrator/manage-testimonials', 'adminController@viewManageTestimonial');
	
	Route::get('administrator/add-testimonial', 'adminController@viewAddTestimonial');
	Route::post('add-testimonial', 'adminController@saveTestimonialData');
	
	Route::get('administrator/edit-testimonial/{id}/edit', 'adminController@viewEditTestimonial');
	Route::post('update-testimonial', 'adminController@updateTestimonial');
	
	Route::get('administrator/manage-testimonials/{id}/delete', 'adminController@deleteTestimonial');
	
	//My Account
	Route::get('administrator/my-account', 'adminController@viewAdminAccount');
	Route::post('update-admin-details','adminController@updateAdminDetails');
	
	//Changa Password
	Route::get('administrator/change-password-admin', 'adminController@viewChangePassword');
	Route::post('change-admin-psw', 'adminController@changeAdminPsw');
	
	//Manage SEO
	Route::get('administrator/manage-seo', 'adminController@viewManageSeo');
	Route::post('update-seo-details','adminController@updateSeoDetails');
	
	
	//Manage Payment Settings
	Route::get('administrator/payment-setting', 'adminController@viewManagePayment');
	Route::post('update-payment-setting','adminController@updatePaymentSetting');
	
	//Manage Newsletter Admin Section
	Route::get('administrator/manage-newsletter', 'adminController@viewManageNewsletter');
	Route::get('administrator/manage-newsletter/{id}/delete', 'adminController@deleteNlEmail');
	Route::post('manage-newsletter', 'adminController@sendNewsletterMail');
	
	//Manage Orders
	Route::get('administrator/manage-bookings', 'adminController@viewManageBookings');
	Route::get('administrator/booking-details/{id}/details', 'adminController@viewBookingDetails');
	Route::get('administrator/print-booking-details/{id}', 'adminController@printBookingDetails');
	
	Route::post('update-booking-status', 'adminController@updateBookingStatus');
	Route::get('administrator/manage-bookings/{id}/delete', 'adminController@deleteBooking');
	
	
	//Manage Mandaps
	Route::get('administrator/manage-mandaps', 'adminController@viewManageMandaps');
	
	Route::get('administrator/add-mandap', 'adminController@viewAddMandap');
	Route::post('add-mandap', 'adminController@saveMandapData');
	
	Route::get('administrator/edit-mandap/{id}/edit', 'adminController@viewEditMandap');
	Route::post('update-mandap', 'adminController@updateMandap');
	
	
	//Manage Photo Gallery
	Route::get('administrator/manage-gallery', 'adminController@viewManagePhotos');
	
	Route::get('administrator/add-photo-gallery', 'adminController@viewAddPhotoGallery');
	Route::post('add-photo-gallery', 'adminController@savePhotoGalleryData');
	
	Route::get('administrator/edit-photo-gallery/{id}/edit', 'adminController@viewEditPhoto');
	Route::post('update-photo-gallery', 'adminController@updatePhotoDetails');
	
	Route::get('administrator/manage-gallery/{id}/delete', 'adminController@deletePhoto');

	

});
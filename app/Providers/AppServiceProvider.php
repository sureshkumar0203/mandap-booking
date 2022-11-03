<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Helpers;
use View;
use DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $admin_det = Helpers::getAdminDetails();
        $seo_info = DB::table('seo')->where('id','=','1')->get();
		$tm_det = DB::table('testimonials')->orderBy('tm_id','=','DESC')->get();
		$payment_det = DB::table('payment_settings')->where('id','=','1')->get();
		
		View::share(['seo_info'=>$seo_info,'admin_det'=>$admin_det,'tm_det'=>$tm_det,'payment_det'=>$payment_det]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

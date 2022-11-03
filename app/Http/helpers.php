<?php
class Helpers {
	//Genrate Key for url passing
	public static function keyMaker($id){ 
		$secretkey='1HutysK98UuuhDasdfafdCrackThisBeeeeaaaatchkHgjsheIHFH44fheo1FhHEfo2oe6fifhkhs'; 
		$key=md5($id.$secretkey); 
		return $key; 
	} 
	
	public static function getAdminDetails() {
		$admin_data = DB::table('core')->where('id', '>', 0)->get();
		return $admin_data;
    }
	
	public static function createRandomPassword(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789ABCDEWFGHJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;		
		while ($i <= 6){
			$num = rand() % 70;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		 }
		return $pass;
	}
	
	public static function setActive($path){
        return Request::path() == $path ? "class=active" : '';
    }
	
	public static function seoUrl($string) {
		//Lower case everything
    	$string = strtolower($string);
    	//Make alphanumeric (removes all other characters)
    	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
   		//Clean up multiple dashes or whitespaces
    	$string = preg_replace("/[\s-]+/", " ", $string);
    	//Convert whitespaces and underscore to dash
    	$string = preg_replace("/[\s_]/", "-", $string);
    	return $string;
	}
}
?>
<?php
$locations = array(
	0=>array(
		"id"=>1, 
		"title"=>"Franks and Peckham Plex", 
		"lat"=>51.47083, 
		"lng"=>-0.06797, 
		"distance"=>0.2),
	1=>array(
		"id"=>2, 
		"title"=>"Bussey Building", 
		"lat"=>51.47083, 
		"lng"=> -0.06678, 
		"distance"=>0.2),
	2=>array(
		"id"=>3, 
		"title"=>"Bar Story", 
		"lat"=>51.46952, 
		"lng"=> -0.06990, 
		"distance"=>0.2),
	3=>array(
		"id"=>4, 
		"title"=>"Peckham Refreshment Rooms", 
		"lat"=>51.46965, 
		"lng"=>-0.06922, 
		"distance"=>0.2),
	4=>array(
		"id"=>5, 
		"title"=>"Ganapati", 
		"lat"=>51.46967, 
		"lng"=>-0.07309, 
		"distance"=>0.2),
	5=>array(
		"id"=>6, 
		"title"=>"Cafe Viva", 
		"lat"=>51.46803, 
		"lng"=>-0.06914, 
		"distance"=>0.2),
	6=>array(
		"id"=>7, 
		"title"=>"Montpelier", 
		"lat"=>51.46769, 
		"lng"=>-0.07041, 
		"distance"=>0.2),
	7=>array(
		"id"=>8, 
		"title"=>"Begging Bowl and Victoria Arms", 
		"lat"=>51.47083, 
		"lng"=>-0.07256, 
		"distance"=>0.5),
	8=>array(
		"id"=>9, 
		"title"=>"Artusi", 
		"lat"=>51.46734, 
		"lng"=>-0.07294, 
		"distance"=>0.2),
	9=>array(
		"id"=>10, 
		"title"=>"The Gowlett", 
		"lat"=>51.46380, 
		"lng"=>-0.07056, 
		"distance"=>0.2)
);

/* Begin */
foreach($locations	 as $value) {
	
}



function search_instagram($id,$lat, $lng) {
	
	$ch = curl_init();
	
	// set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/search?lat=".$lat."&lng=".$lng."&distance=20&client_id=83c4b0937a2048568904849f3e17b434");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	
	// grab URL and pass it to the browser
	$response = curl_exec($ch);
	
	// close cURL resource, and free up system resources
	curl_close($ch);
}

?>
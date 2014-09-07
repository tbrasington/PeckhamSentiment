<?php
include_once('colours.php');

$locations = array(
	0=>array(
		"id"=>1, 
		"title"=>"Frank's Campari Bar and Peckham Plex", 
		"lat"=>51.47083, 
		"lng"=>-0.06797, 
		"distance"=>0.2),
	1=>array(
		"id"=>2, 
		"title"=>"Bussey Building", 
		"lat"=>51.51706054, 
		"lng"=> -0.072932656, 
		"distance"=>0.3),
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
		"distance"=>0.2),
	10=>array(
		"id"=>10, 
		"title"=>"The Peckham Rye", 
		"lat"=>51.46, 
		"lng"=>-0.064, 
		"distance"=>0.3)
);

/*

latitude: 51.46,
name: "Peckham Rye",
longitude: -0.064,
$locations = array(
	0=>array(
		"id"=>1, 
		"title"=>"Franks and Peckham Plex", 
		"lat"=>51.47083, 
		"lng"=>-0.06797, 
		"distance"=>0.2)
	);
*/


/* Begin */

// colour variable setup
$delta = 24;
$reduce_brightness = true;
$reduce_gradients = true;
$num_results = 2;
// do the actual anaylsis 
$ex=new GetMostCommonColors();
		
		
//foreach($locations as $value) {
$length =sizeof($locations);

for($a=0; $a<$length; $a++) {
	
	$returned_response = search_instagram($locations[$a]['id'], $locations[$a]['lat'], $locations[$a]['lng']);
	
	// extract the data we need
	$locations[$a]['data'] = array();
	
	$response_length = sizeof($returned_response["data"]);
	
	for($b=0; $b<$response_length; $b++) {
		
		$locations[$a]['data'][$b]["created"] = $returned_response["data"][$b]["created_time"];
	//	$locations[$a]['data'][$b]["image"] = $returned_response["data"][$b]["images"]["low_resolution"]["url"];
		
		$locations[$a]['data'][$b]["likes"] =  ($returned_response["data"][$b]["likes"]['count'] ? $returned_response["data"][$b]["likes"]['count'] : 0);
		
		// copy the image temporarily
		$image_destination = $_SERVER['DOCUMENT_ROOT']. '/samples/img_'.$b.'.jpg';
		$copy_image = copy($returned_response["data"][$b]["images"]["low_resolution"]["url"], $image_destination);

		
		// get the colour sample
		$colors = $ex->Get_Color($image_destination, $num_results, $reduce_brightness, $reduce_gradients, $delta);
		//$locations[$a]['data'][$b]["colours"] = $colors;
		$c=0;
		foreach($colors as $key => $value) {
			$locations[$a]['data'][$b]["colours"][$c]["hex"] = $key;
			$locations[$a]['data'][$b]["colours"][$c]["weight"] = $value;
			$c++;
		}
		
		// delete the image 
		unlink($image_destination);		
	}
	
	if($a>=$length-1) {}
}

$file_name = date("Y-n-j").'.json';
copy($_SERVER['DOCUMENT_ROOT'].'/responses/_sample.json',$_SERVER['DOCUMENT_ROOT'].'/responses/'.$file_name);
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/responses/'.$file_name, json_encode($locations));

///
function search_instagram($id,$lat, $lng) {
	
 
	// grab URL and pass it to the browser
    $content = file_get_contents("https://api.instagram.com/v1/media/search?lat=".$lat."&lng=".$lng."&distance=20&client_id=83c4b0937a2048568904849f3e17b434");
    
	return json_decode($content, true);
	
}



?>
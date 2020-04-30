<?php

//get settings
include './inc/settings.inc.php';

//get query string parameters
$id = htmlspecialchars($_GET["id"]);

function searchmAirlistDatabase() {

}

function insertmAirlistRequest($dbid) {
	//Contruct REST url
	$apiRequestUrl = $mairlistIP . '/insertitem';

	//Create new CURL instance
	$client = curl_init($url);

	//Get mAirlistDB ID
	$data = array("id" => $dbid); 

	//Create JSON to post
	$dataCore = array("song" => $data); 
	$data_string = json_encode($dataCore);  

	//Set CURL options 
	curl_setopt($client,CURLOPT_USERPWD, $mairlistUser . ":" . $mairlistPassword );
 	curl_setopt($client,CURLOPT_CUSTOMREQUEST, "POST");
 	curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
 	curl_setopt($client, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($client,CURLOPT_RETURNTRANSFER, true);
	
	//Execute CURL
	$response = curl_exec($client);

	//Get Response
 	$result = json_decode($response);

	//Check Response 
 	if ($result->success == 'true') {
		return true;
 	} else {
		return false;
	}

}

if (isset($_POST['id']) && $_POST['id']!="") {
	

}

?>
<?php

//get settings
include './inc/settings.inc.php';

//get query string parameters
$id = htmlspecialchars($_GET["id"]);

function searchmAirlistDatabase() {

}

function insertmAirlistRequest() {
	$apiRequestUrl = $mairlistIP.'/insertitem';

}



 

 $url = "http://localhost:9300/insertitem";
 
 $client = curl_init($url);
 $username = 'test';
 $password = 'secret';

 $data = array("id" => $order_id); 
 $dataCore = array("song" => $data);                                                                   
 $data_string = json_encode($dataCore);       

 curl_setopt($client,CURLOPT_USERPWD, $username . ":" . $password);
 curl_setopt($client,CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
 curl_setopt($client, CURLOPT_POSTFIELDS, $data_string);
 curl_setopt($client,CURLOPT_RETURNTRANSFER, true);

 $response = curl_exec($client);
 $result = json_decode($response);

 if ($result->success == 'true') {
	echo 'Request successfull';
 } else {
	echo 'Request failed';
}

?>
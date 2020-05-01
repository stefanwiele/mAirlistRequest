<?php

function searchmAirlistDatabase($mlistIP,$mlistPort,$mlistUser,$mlistPassword,$search) {

    //Contruct REST url
    $apiRequestUrl = $mlistIP . ':' . $mlistPort . '/searchdatabase';

    //Create new CURL instance
    $client = curl_init($apiRequestUrl);

    //Set Search
    $data = array("search" => $search); 

    //Create JSON to post
    $dataCore = array("song" => $data);                                                                   
    $data_string = json_encode($dataCore);   

    //Set CURL options 
    curl_setopt($client,CURLOPT_USERPWD, $mlistUser . ":" . $mlistPassword);
    curl_setopt($client,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($client, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($client,CURLOPT_RETURNTRANSFER, true);	 

    //Execute CURL
    $response = curl_exec($client);

    return $response;
}

function insertmAirlistRequest($mlistIP,$mlistPort,$mlistUser,$mlistPassword,$dbid) {
    
    //Contruct REST url
    $apiRequestUrl = $mlistIP . ':' . $mlistPort . '/insertitem';

    //Create new CURL instance
    $client = curl_init($apiRequestUrl);

    //Set mAirlistDB ID
    $data = array("id" => $dbid); 

    //Create JSON to post
    $dataCore = array("song" => $data); 
    $data_string = json_encode($dataCore);  

    //Set CURL options 
    curl_setopt($client,CURLOPT_USERPWD, $mlistUser . ":" . $mlistPassword);
    curl_setopt($client,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($client, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($client,CURLOPT_RETURNTRANSFER, true);

    //Execute CURL
    $response = curl_exec($client);

    return $response;
}

function addRequestToDB($databaseID,$ipaddress) {
    $db = new SQLite3('mAirlistRequest.db');
    $db->exec("INSERT INTO requests(databaseID, ipaddress) VALUES('$databaseID', '$ipaddress')");
}
?>

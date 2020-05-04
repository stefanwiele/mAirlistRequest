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

function searchSQLiteDatabase($searchTerm){
    $db = new SQLite3('mAirlistRequest.db');
    $res = $db->query("SELECT * FROM music WHERE artist LIKE '%".$searchTerm."%' OR title LIKE '%".$searchTerm."%'");

    //Create array to keep all results
    $data= array();

    while ($row = $res->fetchArray(1)) {
        //insert row into array
        array_push($data, $row);  
    }

    $db->close();
    unset($db);

    return $data;
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
    $date = date('m/d/Y h:i:s a', time());

    $db->exec("INSERT INTO requests(databaseID, ipaddress, datetime, active) VALUES('$databaseID', '$ipaddress', '$date', 'true')");
    
    $db->close();
    unset($db);
}    

function getLastRequestFromDB(){

    $db = new SQLite3('mAirlistRequest.db');
    $res = $db->query("SELECT * FROM requests WHERE active='true' LIMIT 1");
    $dbid = '';

    while ($row = $res->fetchArray()) {
        $dbid = $row[1];
        $db->exec("UPDATE requests SET active='false' WHERE databaseID='".$dbid."'");
    }
    $db->close();
    unset($db);
    
    return $dbid;
}

?>

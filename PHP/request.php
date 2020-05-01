<?php

//get settings
include('./inc/settings.inc.php');
include('./inc/functions.inc.php');

//Check if request has an ID
if (isset($_GET["id"]) && ($_GET["id"]) !="") {

	$id = htmlspecialchars($_GET["id"]);
	$current_ip = $_SERVER['REMOTE_ADDR'];

	addRequestToDB($id,$current_ip);

	//Using mAirlist Rest API
	//echo (insertmAirlistRequest($mairlistIP,$mairlistPort,$mairlistUser,$mairlistPassword,$id));
	
}

elseif (isset($_GET["search"]) && ($_GET["search"]) !=""){
	$search = htmlspecialchars($_GET["search"]);
	echo (searchmAirlistDatabase($mairlistIP,$mairlistPort,$mairlistUser,$mairlistPassword,$search));
	
}

?>
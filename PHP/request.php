<?php

//get settings
include('./inc/settings.inc.php');
include('./inc/functions.inc.php');

//This is used when the mAirlist Rest API is available for lookup and pushing requests

//Check if request has an ID
if (isset($_GET["id"]) && ($_GET["id"]) !="") {

	$id = htmlspecialchars($_GET["id"]);
	
	//Using mAirlist Rest API
	echo (insertmAirlistRequest($mairlistIP,$mairlistPort,$mairlistUser,$mairlistPassword,$id));
	
}

elseif (isset($_GET["search"]) && ($_GET["search"]) !=""){
	$search = htmlspecialchars($_GET["search"]);
	echo (searchmAirlistDatabase($mairlistIP,$mairlistPort,$mairlistUser,$mairlistPassword,$search));
	
}

?>
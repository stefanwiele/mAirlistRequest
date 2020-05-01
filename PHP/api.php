<?php

    //get settings
    include('./inc/settings.inc.php');
    include('./inc/functions.inc.php');

    
    // get the HTTP method, path and body of the request
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $input = json_decode(file_get_contents('php://input'),true);

    switch ($method) {
        case 'GET':

            switch ($request[0]) {
                case 'getrequest':
                    if (!isset($jsonObject)) $jsonObject = new stdClass();
                    $jsonObject->request = $request[0];
                    $jsonObject->databaseID = '0';

                    $jsonObject = json_encode($jsonObject);

                    echo $jsonObject;
            
            break;
            }
        break;
        }

?>
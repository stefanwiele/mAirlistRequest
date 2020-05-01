<?php

    //get settings
    include('./inc/settings.inc.php');
    include('./inc/functions.inc.php');

    //limit access to the api to only the mAirlist PC

    if ($limitApiAccess) {
        $current_ip = $_SERVER['REMOTE_ADDR'];

        if($allowIpApi <> $current_ip)
        {            
            echo $current_ip.' not allowed';
            exit;
        }
    } 
    
    // get the HTTP method, path and body of the request
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    
    switch ($method) {
        case 'GET':

            switch ($request[0]) {
                case 'getrequest':
                    if (!isset($jsonObject)) $jsonObject = new stdClass();
                    $jsonObject->request = $request[0];
                    $jsonObject->databaseID = '1';

                    $jsonObject = json_encode($jsonObject);

                    //echo $jsonObject;
                    echo '1';
            
                break;    
                case 'setrequest':

                    if (isset($request[1])) {
                        $id = $request[1];
                        $current_ip = $_SERVER['REMOTE_ADDR'];
                
                        addRequestToDB($id,$current_ip);
                    }
                    else {
                        echo 'database id missing';
                    }
                break;       
                default:
                    echo 'not implemented';
            }
        break;
        default:
            echo 'not implemented';
        }

?>
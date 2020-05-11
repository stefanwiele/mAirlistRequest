<?php

    //get settings
    include('./inc/settings.inc.php');
    include('./inc/functions.inc.php');

    //limit access to the get api to only the mAirlist PC
    $getAllowed = true;    
    if ($limitApiAccess) {
        $current_ip = $_SERVER['REMOTE_ADDR'];

        if($allowIpApi <> $current_ip)
        {            
            $getAllowed = false;
            
        } 
    } 
    
    // get the HTTP method, path and body of the request
    $method = $_SERVER['REQUEST_METHOD'];

    if (isset($_SERVER['PATH_INFO'])){
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    }
    else{
        echo 'not implemented';
        http_response_code(400);
        exit;
    }
    
    switch ($method) {
        case 'GET':

            switch ($request[0]) {
                //Get the last request databaseID from the SQlite Database
                case 'getrequest':                    

                    if (!$getAllowed) {echo 'not allowed'; exit;};

                    echo getLastRequestFromDB();
            
                break;    
                case 'setrequest':                    
                //Add the request databaseID to the SQlite Database
                    if (isset($request[1])) {
                        $id = $request[1];

                        //Validate if ID is an INT
                        if (!filter_var($id, FILTER_VALIDATE_INT)) {
                            echo("input not valid");
                            http_response_code(400);
                            exit;
                        } 

                        $current_ip = $_SERVER['REMOTE_ADDR'];
                
                        addRequestToDB($id,$current_ip);
                        echo 'success';                        
                    }
                    else {
                        echo 'database id missing';
                        http_response_code(400);
                    }
                break;  
                case 'search':
                    if (isset($request[1])) {
                        $searchTerm = $request[1];
                        $dbresults = searchSQLiteDatabase($searchTerm);

                        echo json_encode($dbresults);                                                
                        
                    }
                    else {
                        echo 'searchterm is missing';
                        http_response_code(400);
                    }
                break;
                case 'getallrequests':
                    $results = GetAllRequestAsJson();                    
                    echo json_encode($results);
                break;
                default:
                    echo 'not implemented';
                    http_response_code(400);
            }
        break;
        default:
            echo 'not implemented';
            http_response_code(400);
        }

?>
<?php

    //get settings
    include('./inc/settings.inc.php');
    //limit access to the database creation to only the mAirlist PC

    if ($limitApiAccess) {
        $current_ip = $_SERVER['REMOTE_ADDR'];

        if($allowIpApi <> $current_ip)
        {            
            echo $current_ip.' not allowed';
            exit;
        }
    }    

    echo 'Create SQLite Database...<br>';
    $db = new SQLite3('mAirlistRequest.db');

    echo 'Create SQLite Database structure...<br>';
        $db->exec("CREATE TABLE requests(id INTEGER PRIMARY KEY, databaseID TEXT, ipaddress TEXT, datetime TEXT, active TEXT)");
        $db->exec("CREATE TABLE music(id INTEGER PRIMARY KEY, databaseID TEXT, artist TEXT, title TEXT, folder TEXT)");

    echo 'Finished';

?>
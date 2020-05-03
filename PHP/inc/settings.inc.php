<?php
    //$mairlistIP = '192.168.1.79';
    $mairlistIP = getenv("mairlistIP");

    $mairlistPort = '9300';

    //$mairlistUser = 'test';
    $mairlistUser = getenv("mairlistUser");

    //$mairlistPassword = '2XGDoAD6XbJ5wMK5';
    $mairlistPassword = getenv("mairlistPass");


    $limitApiAccess = false;
    //$allowIpApi = '192.168.1.79';
    $allowIpApi = getenv("allowIpApi");
?>
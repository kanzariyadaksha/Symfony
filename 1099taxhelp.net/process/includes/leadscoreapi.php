<?php

include_once('../assets/leadscore/Leadscore.php');
include_once('../assets/leadscore/Leadscore2.php');

function validatePhone($phoneNumber,$first_name,$last_name,$email,$state,$zipcode) {

    $phoneNumber = preg_replace('/\D+/', '', $phoneNumber);

    if(strlen($phoneNumber) == 10){
        $validate = new Leadscore();

        $result = $validate->validatePhone($phoneNumber,$first_name,$last_name,$email,$state,$zipcode,true);
        if($result) {
            return $result;
        }
    }

    return 0;

}

function validatePhone2($phoneNumber,$first_name,$last_name,$email,$state,$zipcode) {

    $phoneNumber = preg_replace('/\D+/', '', $phoneNumber);

    if(strlen($phoneNumber) == 10){
        $validate = new Leadscore2();

        //$result = $validate->validatePhone($phoneNumber,'1,2,3,4,5',true);
        $result = $validate->validatePhone($phoneNumber,$first_name,$last_name,$email,$state,$zipcode,true);
        if($result) {
            return $result;
        }
    }

    return 0;

}

function debug_var ($var) {
    echo "\n<!--\n";
    print_r($var);
    echo "\n-->\n";
}
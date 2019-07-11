<?php

include_once('../assets/nuestar/Nuestar.php');
include_once('../assets/nuestar/Nuestar2.php');

function validatePhone($phoneNumber) {

    $serviceID = '9212906183';
    $username = 'ForwardLeap';
    $password = 'x8ns@O75';

    $phoneNumber = preg_replace('/\D+/', '', $phoneNumber);

    if(strlen($phoneNumber) == 10){
        $validate = new Nuestar($serviceID, $username, $password);

        $result = $validate->validatePhone($phoneNumber,'1,2,3,4,5',true);

        if($result) {
            return $result;
        }
    }

    return 0;

}
function validatePhone2($phoneNumber,$first_name,$last_name,$email,$state,$zipcode) {
    $serviceID = '9212906183';
    $username = 'ForwardLeap';
    $password = 'x8ns@O75';

    $phoneNumber = preg_replace('/\D+/', '', $phoneNumber);

    if(strlen($phoneNumber) == 10){
        $validate = new Nuestar2($serviceID, $username, $password);

        //$result = $validate->validatePhone($phoneNumber,'1,2,3,4,5',true);
        $result = $validate->validatePhone($phoneNumber,$first_name,$last_name,$email,$state,$zipcode,'1,2,3,4,5',true);
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
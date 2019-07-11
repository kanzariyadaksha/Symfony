<?php

/**
 * Created by PhpStorm.
 * User: bill
 * Date: 5/23/16
 * Time: 12:47 PM
 */
class Nuestar2 {

    private $serviceID; // svcid
    private $username; // username
    private $password; // password
    private $serviceKey; // key1
    private $elements; // elems
    private $url = 'https://webgwy.targusinfo.com/access/query';
    private $first_name;
    private $last_name;
    private $email;
    private $state;
    private $zipcode;

    public function __construct($serviceID, $username, $password) {
        $this->serviceID = $serviceID;
        $this->username = $username;
        $this->password = $password;
    }

    public function validatePhone($number, $first_name, $last_name, $email, $state, $zipcode, $elements = '1,2,3,4,5', $fullresponse = false) {

        $this->serviceKey = $number;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->state = $state;
        $this->zipcode = $zipcode;



        $response = $this->makeRequest();

        if ($response) {
            if ($fullresponse === false) {
                $result = $this->decodeResponse($response);
                return $this->testResult($result);
            } else {
                $result = $this->decodeResponse($response);
                $final_result = $this->testResult($result);
                $response = $result;
                return compact('final_result', 'response');
            }
        }
        return 0;
    }

    private function decodeResponse($response) {

        $xml = simplexml_load_string($response);

        if (!empty($xml->response->result->value)) {
            //$result = array_combine(explode(',',$this->elements), explode(',',$xml->response->result->value));
            $result = end(explode(',', $xml->response->result->value));
            return $result;
        }
        return 0;
    }

    private function testResult($result) {
        // We're going to hard-code our pass/fail for now
        // Decisions based on values found in Element_ID_1320.pdf

        /*   if($result[2] != 'B' && strpos($result[3], 'A') !== false) {
          return 1;
          } */
        return true;
    }

    private function makeRequest() {

        // initiate curl and set options
        $ch = curl_init();
        $fullRequestURL = $this->url .
                '?svcid=' . $this->serviceID .
                '&username=' . $this->username .
                '&password=' . $this->password .
                '&key1=' . $this->serviceKey .
                '&key1397=' . $this->first_name . '%20' . $this->last_name .
                '&key1392=' . $this->state;
        //'&key1393=11542'.            
        if ($this->zipcode != "") {
            $fullRequestURL = $fullRequestURL . '&key1393=' . $this->zipcode;
        }
        $fullRequestURL = $fullRequestURL . '&key572=' . $this->email .
                '&key3221=1,2,3,4,5,6,19,23,8,20,22,24,26,10,11,14,27,28,29,30,31' .
                '&elems=3221';

        curl_setopt($ch, CURLOPT_URL, $fullRequestURL);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $headers = curl_getinfo($ch);
        // close curl
        curl_close($ch);
        // return XML data
        if ($headers['http_code'] != '200') {
            return false;
        } else {
            return($data);
        }
    }

}
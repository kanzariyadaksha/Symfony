<?php

/**
 * Created by PhpStorm.
 * User: bill
 * Date: 5/23/16
 * Time: 12:47 PM
 */
class Nuestar
{

    private $serviceID; // svcid
    private $username; // username
    private $password; // password

    private $serviceKey; // key1
    private $elements; // elems

    private $url = 'https://webgwy.targusinfo.com/access/query';

    public function __construct( $serviceID, $username, $password)
    {
        $this->serviceID = $serviceID;
        $this->username = $username;
        $this->password = $password;
    }

    public function validatePhone ($number, $elements = '1,2,3,4,5',$fullresponse = false)
    {
        $this->serviceKey = $number;
        $this->elements = $elements;

        $response = $this->makeRequest();
        if($response) {
            if($fullresponse===false) {
            $result = $this->decodeResponse($response);
            return $this->testResult($result);
            } else {
                $result = $this->decodeResponse($response);
                $final_result= $this->testResult($result);
                $response = $result[1].",".$result[2].",".$result[3].",".$result[4].",".$result[5];
               return compact('final_result','response');
            }
        }
        return 0;
    }

    private function decodeResponse($response)
    {
        $xml = simplexml_load_string($response);
        if(!empty($xml->response->result->value)) {
            $result = array_combine(explode(',',$this->elements), explode(',',$xml->response->result->value));
            return $result;
        }
        return 0;
    }

    private function testResult($result)
    {
        // We're going to hard-code our pass/fail for now
        // Decisions based on values found in Element_ID_1320.pdf
 
        if(strpos($result[3], 'A') !== false || strpos($result[3], 'U') !== false) {
            return 1;
        }
        return 0;

    }

    private function makeRequest()
    {
        // initiate curl and set options
        $ch = curl_init();
        $fullRequestURL = $this->url .
            '?svcid=' .$this->serviceID .
            '&username=' . $this->username .
            '&password=' . $this->password .
            '&key1=' . $this->serviceKey .
            '&key599=' . $this->elements .
            '&elems=1320';
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
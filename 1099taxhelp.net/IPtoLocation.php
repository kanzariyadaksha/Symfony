<?php
/*if($_SERVER['REMOTE_ADDR']=='182.70.120.94') {
    $ip = $_SERVER['REMOTE_ADDR'];
    $region_key = NULL;
    $state = NULL;
    if($_SERVER['REMOTE_ADDR']=='182.70.120.94') {
        $ip = "70.208.155.199";
    }
    $ch = curl_init();
    $fullRequestURL = "http://ip-api.com/json/{$ip}";
    curl_setopt($ch, CURLOPT_URL, $fullRequestURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    $data = curl_exec($ch);
    $data2 = curl_getinfo($ch);
    echo "<PRE>";
        print_r($data2);
        echo "</PRE>";
    $data = json_decode($data);
    if($_SERVER['REMOTE_ADDR']=='182.70.120.94') {
        echo "<PRE>";
        print_r($data);
        echo "</PRE>";
        exit;
    }
    //$details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
    $IP_City = $data->city;
    $IP_Region = $data->region;
    $state = $IP_Region;
} */

/*$states = array(
    "NA" => 'N/A',
    "AL" => 'Alabama',
    "AK" => 'Alaska',
    "AZ" => 'Arizona',
    "AR" => 'Arkansas',
    "CA" => 'California',
    "CO" => 'Colorado',
    "CT" => 'Connecticut',
    "DE" => 'Delaware',
    "DC" => 'Washington Dc',
    "FL" => 'Florida',
    "GA" => 'Georgia',
    "HI" => 'Hawaii',
    "ID" => 'Idaho',
    "IL" => 'Illinois',
    "IN" => 'Indiana',
    "IA" => 'Iowa',
    "KS" => 'Kansas',
    "KY" => 'Kentucky',
    "LA" => 'Louisiana',
    "ME" => 'Maine',
    "MD" => 'Maryland',
    "MA" => 'Massachusetts',
    "MI" => 'Michigan',
    "MN" => 'Minnesota',
    "MS" => 'Mississippi',
    "MO" => 'Missouri',
    "MT" => 'Montana',
    "NE" => 'Nebraska',
    "NV" => 'Nevada',
    "NH" => 'New Hampshire',
    "NJ" => 'New Jersey',
    "NM" => 'New Mexico',
    "NY" => 'New York',
    "NC" => 'North Carolina',
    "ND" => 'North Dakota',
    "OH" => 'Ohio',
    "OK" => 'Oklahoma',
    "OR" => 'Oregon',
    "PA" => 'Pennsylvania',
    "RI" => 'Rhode Island',
    "SC" => 'South Carolina',
    "SD" => 'South Dakota',
    "TN" => 'Tennessee',
    "TX" => 'Texas',
    "UT" => 'Utah',
    "VT" => 'Vermont',
    "VA" => 'Virginia',
    "WA" => 'Washington',
    "WV" => 'West Virginia',
    "WI" => 'Wisconsin',
    "WY" => 'Wyoming',
);
$state= array_search($IP_Region, $states);*/
?>
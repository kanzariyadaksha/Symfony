<?php
require_once("../assets/telesign/api.class.php");
function telesign($primary_phone) {
    $primaryphone = preg_replace('/\D+/', '', $primary_phone);
    $customer_id = '480E2BF6-9C2C-4381-A42F-A3ED42844FF2';
    $secret_key = 'QaatjGyn0z+MhnRdUORuQIYzvSt7Whnj5DV06uWbWvbA04bcNWNLoyvoQOp8vlJh8h87i9dsvk1pnZp2oUQuPg==';
    $telephoneNumber = $primaryphone;
    if (strlen($telephoneNumber) == 10) {
        $phoneid = new PhoneId($customer_id, $secret_key);

        $result = $phoneid->live("1" . $telephoneNumber, "BACS");
        if ($result['live']['subscriber_status'] == "ACTIVE") {
          return "active";
        } else if ($result['phone_type']['description'] == "MOBILE") {
            return "partial";
        } else if ($result['phone_type']['description'] == "VOIP") {
            return "partial";
        } else if ($result['phone_type']['description'] == "INVALID") {
            return "invalid";
        } else if ($result['live']['subscriber_status'] == "DISCONNECTED") {
            return "invalid";
        } else {
            return "unknown";
        }
    } else {
        return "unknown";
    }
}

?>

<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 11/12/15
 * Time: 11:22 AM
 */

$fields = array(
    'affid',
    'ckm_offer_id',
    'oc',
    'reqid',
    's1',
    's2',
    's3',
    'subid',
    'referrer',
    'tax_debt',
    'first_name',
    'last_name',
    'email_address',
    'primary_phone',
    'state',
    'enrolled_irs',
    'employment_status'
);

$fieldData = array();

foreach ($fields as $field) {
    if (!empty($_POST[$field]))
    {
        $fieldData[$field] = $_POST[$field];
    }
}

if($_POST['email_address']=="" && $_POST['primary_phone']=="") {
    echo "Failed";
    exit;
}

$fieldData['domain']= '1099TaxHelp';

$submitted = new DateTime();
$fieldData['created_at'] = $submitted->format('Y-m-d H:i:s');

$fieldData['user_agent'] = $_SERVER["HTTP_USER_AGENT"];
$fieldData['ip_address'] = "INET_ATON('".$_SERVER["REMOTE_ADDR"]."')";

if(isset($_SESSION['insertID'])) {

    $updateData = array();
    foreach($fieldData as $field => $value) {
        if($field=="ip_address") {
            $updateData[] = "{$field} = {$value}";
        } else {
            $updateData[] = "{$field} = ".$dbm->quote($value);    
        }
    }
    $updateString = implode(', ', $updateData);

    $sql = "UPDATE contacts SET $updateString, submit_attempts = submit_attempts + 1 WHERE id = ".$_SESSION['insertID'];

    $result = $dbm->exec($sql);
    if($result) echo " - Updated! ";
} else {

    $fieldData['submit_attempts'] = 1;

    $page = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    $fieldData['page'] = $page;

    $query = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
    $fieldData['query_string'] = $query;

    $insertData = array();
    foreach($fieldData as $field => $value) {
        if($field=="ip_address") {
            $insertData[] = "{$field} = {$value}";
        } else {
            $insertData[] = "{$field} = ".$dbm->quote($value);    
        }
    }
    $insertString = implode(', ', $insertData);

    $sql = "INSERT INTO contacts SET $insertString";
    $result = $dbm->exec($sql);
    $insertID = $dbm->lastInsertId();
    $_SESSION['insertID'] = $insertID;

    //echo $insertID;
    if($result) echo " - Stored! ";
}


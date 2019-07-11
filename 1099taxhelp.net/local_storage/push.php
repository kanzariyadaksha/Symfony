<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 11/17/15
 * Time: 4:08 PM
 */

if ($_GET['authKey'] != 'b7hak8w2nKDb2KS2n0d') {
    echo "<h1>Error: 403 - Unauthorized</h1>";
    return;
}

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
    'enrolled_irs'
);

$filter = '';

if(isset($_GET['id'])) {
    $subId = $_GET['id'];
}

$sql = "SELECT * FROM contacts WHERE id = $subId";

$stmt = $dbm->query($sql);
$result = $stmt->fetch(PDO::FETCH_OBJ);

$postURL = 'http://flmtrk.com/d.ashx';

foreach($fields as $field) {
    $postVars[$field] = $result->$field;
}

parse_str($result->query_string);

if(empty($postVars['ckm_offer_id'])) {
    $postVars['ckm_offer_id'] = 34;
}

if(empty($postVars['affid'])) {
    $postVars['affid'] = $affid;
}

$postVars['TCPA_checkbox'] = 'checked';
$postVars['toVerify'] = 'active';
$postVars['landing_page'] = 'textdebt';

$postString = http_build_query($postVars);

echo $postString."<br />\n";

$ch = curl_init($postURL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, count($postVars));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$curlResult = curl_exec($ch);

echo $curlResult;

echo <<<EOQ
<br /><br />
<h2><a href="#" onclick="window.close();return false;">Close Window</a></h2>
EOQ;



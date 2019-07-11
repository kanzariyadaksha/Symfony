<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 11/12/15
 * Time: 12:22 PM
 */

 if (!isset($_SESSION['username'])){
	$err_msg = "Please login to browse.";
	header("Location:../login.php?msg=" . rawurlencode($err_msg));
	exit;
}

if ($_GET['authKey'] != 'b7hak8w2nKDb2KS2n0d') {
    echo "<h1>Error: 403 - Unauthorized</h1>";
    return;
}

$doExport = false;

if(isset($_POST['export'])) {
    $doExport = true;
}

$fields = array(
    'id',
    'page',
    'query_string',
    'affid',
    'ckm_offer_id',
    'oc',
    'reqid',
//    's1',
//    's2',
//    's3',
//    'subid',
    'referrer',
    'tax_debt',
    'first_name',
    'last_name',
    'email_address',
    'primary_phone',
    'state',
    'enrolled_irs',
    'submit_attempts',
    'cake_status',
    'created_at'
);

$past_time = time() - 2*24*60*60;

$startTime = date('Y-m-d', $past_time);

$filter = "WHERE created_at >= '$startTime'";

if(isset($_POST['starttime'])) {
    $startTime = $_POST['starttime'];
    $filter = "WHERE created_at >= '$startTime'";
}

if(isset($_POST['endtime']) && !empty($_POST['endtime'])) {
    $endTime = $_POST['endtime'];
    $filter .= " AND created_at <= '$endTime'";
}

$sql = "SELECT * FROM contacts {$filter} ORDER BY created_at DESC";

$stmt = $dbm->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_OBJ);

$rowCount = 0;
if(!$doExport) {

    $header = "<table class=\"table table-condensed table-striped\">\n  <thead>\n    <tr>\n";
    foreach ($fields as $field) {
        if($field == 'ckm_offer_id') $field = 'ckm';
        if($field == 'enrolled_irs') $field = 'irs';
        if($field == 'submit_attempts') $field = 'tries';
        if($field == 'cake_status') $field = 'Cake';
        $header .= "      <th>$field</th>\n";
    }
    $header .= "    </tr>\n  </thead>\n";

    $body = "  <tbody>\n";

    foreach ($result as $row) {
        if($row->submitted == 0) {
            $body .= "    <tr class=\"noCake\">\n";
        } else {
            $body .= "    <tr>\n";
        }
        foreach ($fields as $field) {
            switch ($field) {
                case 'id':
                    $link = '<a href="/local_storage/push/?authKey=b7hak8w2nKDb2KS2n0d&amp;id='.$row->$field.'" target="_blank">'.$row->$field.'</a>';
                    $body .= "      <td class=\"$field\" >{$link}</td>\n";
                    break;
                case 'query_string':
                    $queryString = (!empty($row->$field)) ? '[Query String]' : '';
                    $body .= "      <td class=\"$field\" title=\"{$row->$field}\">".$queryString."</td>\n";
                    break;
                case 'referrer':
                    $body .= "      <td class=\"$field\" title=\"{$row->$field}\">".substr($row->$field,0,50)."</td>\n";
                    break;
                case 'email_address':
                    $body .= "      <td class=\"tries\" title=\"Melissa: {$row->melissa}\">{$row->email_address}</td>\n";
                    break;
                case 'primary_phone':
                    $body .= "      <td class=\"tries\" title=\"Neustar: {$row->neustar} \n".str_replace("\"","'",$row->neustar_disposition)."\">{$row->primary_phone}</td>\n";
                    break;
                case 'submit_attempts':
                    $body .= "      <td class=\"tries\" title=\"{$row->user_agent}\">{$row->$field}</td>\n";
                    break;
                case 'cake_status':
                    $body .= "      <td class=\"cakestatus\" title=\"".str_replace("\"","'",$row->cake_response)."\">{$row->$field}</td>\n";
                    break;
                case 'created_at':
                    $body .= "      <td class=\"$field\" title=\"".long2ip($row->ip_address)."\">{$row->$field}</td>\n";
                    break;
                default:
                    $body .= "      <td class=\"$field\" >{$row->$field}</td>\n";
            }
        }
        $body .= "    </tr>\n";
        $rowCount++;
    }
    $body .= "  </tbody>\n</table>\n";

    $body .= "<h3>Entries: $rowCount</h3>\n";

    require_once('page_template.php');
    return;
}
array_push($fields,"payment_status");
array_push($fields,"cake_response");

// we're going to export our data as CSV
$body = '"'. implode('","', $fields)."\"\n";

foreach ($result as $row) {
    foreach ($fields as $field) {
        if($field!="cake_response")
            $line[] = isset($row->$field)?$row->$field:"";
        else
           $line[] = str_replace('"','\'',$row->$field); 
    }
    $body .= '"'. implode('","', $line)."\"\n";
    unset($line);
}

$exportFile = "flm_raw_export_" . date("Y-m-d") . ".csv";

// force download
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header("Content-Disposition: attachment;filename={$exportFile}");
header("Content-Transfer-Encoding: binary");

echo $body;

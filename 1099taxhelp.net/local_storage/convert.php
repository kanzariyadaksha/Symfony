<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 11/12/15
 * Time: 11:23 AM
 */

//if ($_GET['authKey'] != 'b7hak8w2nKDb2KS2n0d') {
    echo "<h1>Error: 403 - Unauthorized</h1>";
    return;
//}

$fields = array(
    'id',
    'page',
    'query_string',
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
    'created_at'
);

$sql = "SELECT * FROM contacts";

$stmt = $db->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_OBJ);

$fieldList = implode(', ', $fields);
$replaceList = ':'.implode(', :', $fields);

$sql = "INSERT INTO contacts ( $fieldList ) VALUES ( $replaceList );";
$stmt = $dbm->prepare($sql);

foreach ($result as $row) {
    foreach ($fields as $field) {
        if($field == 'created_at') {
            $stmt->bindParam(':' . $field, $row->submitted);
        } else {
            $stmt->bindParam(':' . $field, $row->$field);
        }
    }
    $stmt->execute();

    echo "$row->id<br />\n";
}


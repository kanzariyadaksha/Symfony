<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 6/10/16
 * Time: 11:21 AM
 */

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

$fields = array_merge($commonFields, $config->get('fields'));

$result = $DB->read($config->get('dbtable'));

$rowCount = 0;
if(!$doExport) {

    $header = "<table class=\"table table-condensed table-striped\">\n  <thead>\n    <tr>\n";
    foreach ($fields as $field) {
        if($field == 'ckm_offer_id') $field = 'ckm';
        if($field == 'enrolled_irs') $field = 'irs';
        if($field == 'submit_attempts') $field = 'tries';
        $header .= "      <th>$field</th>\n";
    }
    $header .= "    </tr>\n  </thead>\n";

    $body = "  <tbody>\n";

    foreach ($result as $row) {
        $body .= "    <tr>\n";
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
                case 'submit_attempts':
                    $body .= "      <td class=\"tries\" title=\"{$row->user_agent}\">{$row->$field}</td>\n";
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

    require_once('./includes/page_template.php');
    return;
}

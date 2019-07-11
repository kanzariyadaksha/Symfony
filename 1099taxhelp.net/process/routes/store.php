<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 6/9/16
 * Time: 10:02 PM
 */


$fieldData = array();
$fields = array_merge($commonFields, $config->get('fields'));

if(empty($_POST['state'])) {
    $arrZip = $DB->read('zipcodes', " Where zipcode='" . $_POST['zip_code']."'"," id ASC");
    if(!empty($arrZip)){
        $_POST['state'] = $arrZip[0]->state;
    }
}

if(trim($_POST['tax_debt'])=="" || trim($_POST['email_address'])=="" || trim($_POST['primary_phone'])==""){
    if($_SERVER['HTTP_REFERER']!="") {
        $RefererHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        $RefererURI = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
        $RefererQueryParam = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
        $arrQueryParams = array();
        parse_str($RefererQueryParam,$arrQueryParams);
        $phoneNumber = preg_replace('/\D+/', '', $_POST['primary_phone']);
        $arrParams = array(
            'tax_debt'=>$_POST['tax_debt'],
            'first_name'=>$_POST['first_name'],
            'last_name'=>$_POST['last_name'],
            'email_address'=>$_POST['email_address'],
            'state'=>$_POST['state'],
            'primary_phone'=>$phoneNumber,'error_post'=>1);
        $arrQueryParams = array_merge($arrQueryParams,$arrParams);
        $postString = http_build_query($arrQueryParams);
        //$redirectURL = "http://".$RefererHost.$RefererURI."?".$postString;
        $redirectURL = "http://".$RefererHost.$RefererURI;
        /*if($_SERVER['REMOTE_ADDR']=='182.70.120.94'){
            echo "<PRE>POST";
            print_r($_POST);
            die("here");
        }*/

        header("Location: ".$redirectURL);
        exit;
    } else {
        header("Location: /thankyou.php");
        exit;
    }
}
$_POST['page']=strtok($_POST['page'],'?');
if(isset($_POST['current_situation']) && is_array($_POST['current_situation'])){
    $_POST['current_situation']=implode(",",$_POST['current_situation']);
}
foreach ($fields as $field) {
    if (!empty($_POST[$field])) {
        $fieldData[$field] = $_POST[$field];
        continue;
    }
    // this lets us handle values that we want but didn't get for some reason
    switch ($field) {
        // this handles pages that submit 'ckm_request_id' instead of 'reqid'
        case 'reqid':
            if (!empty($_POST['ckm_request_id']))
                $fieldData[$field] = $_POST['ckm_request_id'];
            break;
        // if we didn't get anything from the JavaScript neustar check, get it now.

        default:
            break;
    }
    // end empty field processing
}

//$emailValidate = new EmailValidate();
//$fieldData['melissa']= $emailValidate->validate($_POST['email_address']);
$fieldData['melissa'] = "";
                
if ($_POST['tax_debt'] > 9999)
{   
    if(!isset($_POST['zipcode']))
    {
       $_POST['zipcode']="";
    }
    $check=validatePhone($_POST['primary_phone'],$_POST['first_name'],$_POST['last_name'],$_POST['email_address'],$_POST['state'],$_POST['zipcode']);
    if($check!=0) {
        /*if($check['final_result']=='1'){
            $fieldData['neustar']='pass';
        }
        if($check['final_result']=='0'){
            $fieldData['neustar']='fail';
        }*/
        $fieldData['neustar_disposition']=$check['response'];
    }
}

if ($_POST['tax_debt'] > 9999)
{ 
    if(!isset($_POST['zipcode']))
    {
       $_POST['zipcode']="";
    }
    $check=validatePhone2($_POST['primary_phone'],$_POST['first_name'],$_POST['last_name'],$_POST['email_address'],$_POST['state'],$_POST['zipcode']);
    
    if($check!=0) {
        $nd_odlv=$check['response'];
        
        /*if(isset($fieldData['neustar']) && $fieldData['neustar']=='fail' && $nd_odlv!=26 && $nd_odlv!=31){
            $fieldData['neustar'] = 'pass';
        }*/
    }
    
    $fieldData['neustar'] = 'pass';
    
    if(isset($fieldData['neustar_disposition']) && trim($fieldData['neustar_disposition'],",")!="") {
        $ns_disposition = $fieldData['neustar_disposition'];
        //if(strpos($redirectURL, $ns_disposition))
        if(strpos($ns_disposition,"I")!==FALSE || $nd_odlv==26 || $nd_odlv==31){
            $fieldData['neustar'] = 'fail';
        } else {
            $fieldData['neustar'] = 'pass';
        }
    } else if(isset($fieldData['neustar_disposition']) && $fieldData['neustar_disposition']==",,,,") {
        $fieldData['neustar'] = 'fail';
    }
}

/*if($_SERVER['REMOTE_ADDR']=='14.102.161.106'){
    echo "<PRE>";
    print_r($_POST);
    print_r($fieldData);
    exit;
}*/

setcookie('tax_debt', $_POST['tax_debt'], 0, "/");
setcookie('first_name', $_POST['first_name'], 0, "/");
setcookie('last_name', $_POST['last_name'], 0, "/");
setcookie('primary_phone', $_POST['primary_phone'], 0, "/");
setcookie('email_address', $_POST['email_address'], 0, "/");
setcookie('landing_page', $_POST['landing_page'], 0, "/");
setcookie('state', $_POST['state'], 0, "/");


if(isset($_POST['opt_special_offers']) && $_POST['opt_special_offers']=="checked") {
    $fieldData['email_optin_offers']='checked';
}
if(isset($_POST['opt_in']) && ($_POST['opt_in']=="checked" || $_POST['opt_in']=="on")) {
    $fieldData['opt_in']='checked';
    if(!isset($_POST['opt_special_offers'])) {
        $fieldData['email_optin_offers']='checked';
    }
}
$fieldData['opt_in']='checked';
$fieldData['TCPA_checkbox']='checked';



$fieldData['user_agent'] = $_SERVER["HTTP_USER_AGENT"];
$fieldData['ip_address'] = ip2long($_SERVER["REMOTE_ADDR"]);

$page = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
$fieldData['page'] = $page;
$query = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
$fieldData['query_string'] = $query;

$data = array("first_name" => $_POST['first_name'], "last_name" => $_POST['last_name'], "primary_phone" => $_POST['primary_phone'], "email_address" => $_POST['email_address']);

$data_string = json_encode($data);
$ch = curl_init($_POST['xxTrustedFormCertUrl']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string),
    'Accept:application/json')
);
curl_setopt($ch, CURLOPT_USERPWD,  'api:df2c42ccef064639ca457c14b57c42a4');
$result = curl_exec($ch);

if ($result === false) 
    $result = curl_error($ch);

curl_close($ch);

if($result=="This Certificate of Authenticity was not found"){
    
} else {
    $fieldData['xxTrustedFormToken'] = $_POST['xxTrustedFormToken']; 
    $fieldData['xxTrustedFormCertUrl'] = $_POST['xxTrustedFormCertUrl']; 
    $fieldData['TrustedFormResponse'] = $result; 
    $trustFormResponse = json_decode($result,true);
    $fieldData['xxTrustedFormCertUrlMasked'] = $trustFormResponse['masked_cert_url'];
}    

$fieldData['submitted'] = 1;
$fieldData['domain']= '1099TaxHelp';

if (!isset($_SESSION['insertID'])) {
    $result = $DB->insert('contacts', $fieldData);
    $last_insert_id = $DB->insertID;
    $_SESSION['insertID'] = $last_insert_id;
} else {    
    $fieldData['RAW'] = 'submit_attempts = submit_attempts + 1';
    $DB->update('contacts', $fieldData, ' id=' . $_SESSION['insertID']);
}

setcookie('insertID', $_SESSION['insertID'], 0, "/");


$fieldData['nd_odlv'] = $nd_odlv;

if(isset($_POST['page']) && $_POST['page']!="") {
    $fieldData['page'] = $_SERVER['HTTP_HOST'].$_POST['page'];
} else {
    $page = $_SERVER['HTTP_REFERER'];//parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    $fieldData['page'] = $page;
}
$fieldData['ip_address'] = $_SERVER["REMOTE_ADDR"];

foreach ($passthruFields as $field) {
    if (!empty($_POST[$field])) {
        $fieldData[$field] = $_POST[$field];
        continue;
    }
}

unset($fieldData['RAW']);
$fieldData['TCPA_checkbox'] = 'checked';

if ($_POST['tax_debt'] < 10000) {
	$fieldData['toVerify'] = telesign($_POST['primary_phone']);
} else {
    $fieldData['toVerify'] = '';
}
$fieldData['landing_page'] = 'textdebt';
if($_POST['tax_debt'] <= 9999)
    $fieldData['ckm_bp'] = '1';
if(isset($fieldData['neustar']) && $fieldData['neustar']=="fail") 
    $fieldData['ckm_bp'] = '1';

$fieldData['ckm_bp'] = '1';

if(isset($_POST['opt_special_offers']) && $_POST['opt_special_offers']=="checked") {
    $fieldData['email_optin_offers']='checked';
}

if(isset($_POST['opt_in']) && ($_POST['opt_in']=="checked" || $_POST['opt_in']=="on")) {
    $fieldData['opt_in']='checked';
    if(!isset($_POST['opt_special_offers'])) {
        $fieldData['email_optin_offers']='checked';
    }
}
$fieldData['opt_in']='checked';
$fieldData['TCPA_checkbox']='checked';
$fieldData['LeadRouting']= @$_POST['LeadRouting'];

$scrubled= file_get_contents("http://www.freshstart-initiative.net/drips/scrambled_ids.php?sub_id=".$_POST['s1']."&aff_id=".$_POST['affid']."&s2=".$_POST['s2']);
$arrScrumbled = explode(",", $scrubled);

if(!empty($arrScrumbled[0])) {
    $fieldData['alt_subid'] = $arrScrumbled[0];
} else {
    $fieldData['alt_subid'] = 100;
}

if(!empty($arrScrumbled[1])) {
    $fieldData['alt_affid'] = $arrScrumbled[1];
} else {
    $fieldData['alt_affid'] = 100;
}

if(!empty($arrScrumbled[1])) {
    $fieldData['alt_s2'] = $arrScrumbled[1];
} else {
    $fieldData['alt_s2'] = 100;
}

$fieldData['first_name_capital']= ucwords(strtolower($_POST['first_name']));
$fieldData['last_name_capital']= ucwords(strtolower($_POST['last_name']));

if($fieldData['LeadRouting']=="TDN2"){
    //$fieldData['ckm_campaign_id'] = '1494';
    //$fieldData['ckm_key'] = 'ORLphuh8na0';
    $fieldData['ckm_campaign_id'] = '1627';
    $fieldData['ckm_key'] = 'D4UA24f8LJA';
}

if($fieldData['LeadRouting']=="TDN4"){
    $fieldData['ckm_campaign_id'] = '1339';
    $fieldData['ckm_key'] = 'trgfXo16zAM';
}

if($fieldData['LeadRouting']=="IRS2"){
    $fieldData['ckm_campaign_id'] = '1642';
    $fieldData['ckm_key'] = 'KDHujfoNU7g';
}

if($fieldData['LeadRouting']=="LINK"){
    $fieldData['ckm_campaign_id'] = '1678';
    $fieldData['ckm_key'] = 'TQlJKAt1fqs';
}

if($fieldData['LeadRouting']=="TDN2_ES"){
//    $fieldData['ckm_campaign_id'] = '1705';
//    $fieldData['ckm_key'] = 'D4UA24f8LJA';
    $fieldData['aff_id'] = '407';
    $fieldData['ckm_campaign_id'] = '1834';
    $fieldData['ckm_key'] = 'zCANFW7FK8';
}

if($fieldData['LeadRouting']=="LFRW"){
    $fieldData['ckm_campaign_id'] = '1755';
    $fieldData['ckm_key'] = 'rsRH1ID5t3M';
}
if($fieldData['LeadRouting']=="DIS2"){
    $fieldData['ckm_campaign_id'] = '1752';
    $fieldData['ckm_key'] = 'trgfXo16zAM';
}


$found=strtolower($_POST['first_name']);
if ($found=="ckmtestpixel") {
   try { 
    if (file_exists("data.txt")) {
       $myfile = fopen("data.txt", "a");
    }
    else{
        $myfile = fopen("data.txt", "w");
    }
    
    $date = new DateTime();
    $date = $date->format("d:m:Y h:i:s");

    fwrite($myfile,json_encode("current date=>".$date).PHP_EOL);

    fwrite($myfile, "------------Field Data------------".PHP_EOL);
    foreach ($fieldData as $key => $value) { 
        fwrite($myfile, json_encode(array($key => $value)).PHP_EOL);
    }

    fwrite($myfile, "------------Server Data------------".PHP_EOL);
    foreach ($_SERVER as $key => $value) { 
        fwrite($myfile, json_encode(array($key => $value)).PHP_EOL);
    }

    fwrite($myfile, "------------Post Data------------".PHP_EOL);
    foreach ($_POST as $key => $value) { 
        fwrite($myfile, json_encode(array($key => $value)).PHP_EOL);
    }

    fclose($myfile);
   } catch (Exception $e) {
       echo $e->getMessage();
   }
}

/*
//ZETA request//
    
$zetaData['firstname'] = $_POST['first_name'];
$zetaData['lastname'] = $_POST['last_name'];
$zetaData['state'] = $_POST['state'];
$zetaData['phone'] = $_POST['primary_phone'];
$zetaData['email'] = $_POST['email_address'];
$zetaData['url'] = $page;
$zetaData['ip'] = ip2long($_SERVER["REMOTE_ADDR"]);
$zetaData['pw'] = 'Jgvpfqbc';

$postZeta = http_build_query($zetaData);
$zetaURL = 'http://posts.aspiremail.com/cgi-bin/post_data.cgi';

$zeta = curl_init($zetaURL);
curl_setopt($zeta, CURLOPT_CUSTOMREQUEST, "POST");
//curl_setopt($zeta, CURLOPT_POST, count($zetaData));
curl_setopt($zeta, CURLOPT_POSTFIELDS, $postZeta);
curl_setopt($zeta, CURLOPT_RETURNTRANSFER, true);
$zetaInfo = curl_getinfo($zeta);
$zetaResult = curl_exec($zeta);
if (strpos($zetaResult, 'Success') !== false) {
    $zetastatus = 'Success';
}else{
    $zetastatus = 'Failure';
}

$zetaData['created_at'] = date('Y-m-d H:i:s');
$zetaData['status'] = $zetastatus;
$zetaData['zeta_response'] = $zetaResult;
$DB->insert('zeta_leads', $zetaData);

//ZETA request//
*/

$postString = http_build_query($fieldData);
$postURL = 'http://flmtrk.com/d.ashx';
// if($_SERVER['REMOTE_ADDR']=='122.169.30.147'){
//     echo "<PRE>";
//     print_r($_POST);
//     echo "fieldData--->";
//     print_r($fieldData);
//     die("here");
// }
$ch = curl_init($postURL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, count($fieldData));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curlResult = curl_exec($ch);
$curlInfo = curl_getinfo($ch);
/*if($_SERVER['REMOTE_ADDR']=='182.70.120.94'){
    echo "<PRE>";
    print_r($curlResult);
    die("here");
}*/

/* Maildrill send thank you mail start here */


$visitor_data['email_address']=$_POST['email_address'];
$visitor_data['recepient_name']=$_POST['first_name'];




// if ($_POST['first_name']=="ckmtestpixel" && $_POST['email_address']=="chetan.patel@bytestechnolab.com") {

//         $obj = new maildrill_send_mail_new_temp();
//         $obj->_sendthank_mail_new($visitor_data);
        
//     }

        
        $obj = new maildrill_send_mail();
        $obj->_sendthank_mail($visitor_data);

    
    
/* Maildrill send thank you mail end here */
$updateCakeResponse = array();
$updateCakeResponse['cake_response'] = $curlResult;
$DB->update('contacts', $updateCakeResponse, ' id=' . $_SESSION['insertID']);

// PUSH LEAD TO EDGE FINANCIAL
//include("push_edge_financial.php");

if (stripos($curlResult, 'html') !== false) {
    $dom = new DOMDocument;
    $dom->loadHTML($curlResult);
    $updateCakeResponse = array();
    $updateCakeResponse['cake_status'] = "error";
    $DB->update('contacts', $updateCakeResponse, ' id=' . $_SESSION['insertID']);
    foreach ($dom->getElementsByTagName('a') as $node) {
        $redirect = str_replace('&amp;', '&', $node->getAttribute("href"));
        unset($_SESSION['insertID']);
        unset($_SESSION['ERROR']);
        header("Location: $redirect");
        exit;
    }
} elseif (stripos($curlResult, 'xml') !== false) {
    $xml = new SimpleXMLElement($curlResult);
    if ($xml->msg == 'success') {
        $updateCakeResponse = array();
        $updateCakeResponse['cake_status'] = "success";
        $updateCakeResponse['cake_id'] = $xml->leadid;
        $DB->update('contacts', $updateCakeResponse, ' id=' . $_SESSION['insertID']);

        $redirect = $xml->redirect;
        $redirect = str_replace('&amp;', '&', $redirect);
        $leadID = $xml->leadid;
        unset($_SESSION['insertID']);
        unset($_SESSION['ERROR']);
        if($redirect!=""){
            header("Location: $redirect");
            exit;
        } else {
            $arrSearch = array("#first_name#","#last_name#","#email_address#","#primary_phone#","#tax_debt#");
            $arrReplace = array($_POST['first_name'],$_POST['last_name'],$_POST['email_address'],$_POST['primary_phone'],$_POST['tax_debt']);
            $queryString = str_replace($arrSearch, $arrReplace, '?fname=#first_name#&lname=&email=#email_address#&phone=#primary_phone#&debt=#tax_debt#');
            //header("Location: /thankyou.php" . $queryString);
            header("Location: /thankyou.php");
            exit;
        }
    } else {
        $error = $xml->errors->error;
        $updateCakeResponse = array();
        $updateCakeResponse['cake_status'] = "error";
        $updateCakeResponse['cake_errorcode'] = $error;
        $DB->update('contacts', $updateCakeResponse, ' id=' . $_SESSION['insertID']);
        $SESSION['error'] = $error;
        $arrSearch = array("#first_name#","#last_name#","#email_address#","#primary_phone#","#tax_debt#");
        $arrReplace = array($_POST['first_name'],$_POST['last_name'],$_POST['email_address'],$_POST['primary_phone'],$_POST['tax_debt']);
        $queryString = str_replace($arrSearch, $arrReplace, '?fname=#first_name#&lname=&email=#email_address#&phone=#primary_phone#&debt=#tax_debt#');
        //header("Location: /thankyou.php" . $queryString);
        header("Location: /thankyou.php");
        exit;
    }
}

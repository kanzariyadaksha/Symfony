<?php 
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 6/7/16
 * Time: 4:11 PM
 */
use Noodlehaus\Config;
include_once('includes/DB.php');
//include_once('includes/neustar.php');
include_once('includes/leadscoreapi.php');
include_once('includes/melissa.php');
include_once('includes/telesign.php');
include_once('includes/send_mail.php');
include_once('includes/send_mail_new_template.php');



session_start();

$subdomain = $domain = $tld = null;
$server = $_SERVER['HTTP_HOST'];
if(substr_count($server, '.') >= 2)
{
    list($subdomain, $domain, $tld) = explode('.', $server);
    if($_SERVER['HTTP_HOST']=="dev.1099taxhelp.net"){
        $tld = "dev";
    }
}
else
{
    list($domain, $tld) = explode('.', $server);
}
$configFile = "config/$domain.$tld.yaml";
$config = new Config($configFile);

// these fields are stored in the DB with each submission
// in addition to the fields spec'd by each site
$commonFields = array(
    'affid',
    'ckm_offer_id',
    'oc',
    'reqid',
    'page',
    'query_string',
    's1',
    's2',
    's3',
    'subid',
    'referrer',
    'neustar',
    'melissa',
    'opt_in',
    'current_situation',
    'income',
    'zip_code',
    'employment_status',
    'current_situation_reason',
    'employment_type_other'
);

// these fields are passed through to Cake, but not stored in the database.
$passthruFields = array(
    'ckm_request_id',
    'cpAFID',
    'cpSID',
    'cpSID2',
    'universal_leadid',
    'xxTrustedFormToken',
    'xxTrustedFormCertUrl',
    'cr_price',
    'opt_in'
);

try {
    $DB = new DB($config);
}

catch(PDOException $e)
{
    echo $e->getMessage();
}

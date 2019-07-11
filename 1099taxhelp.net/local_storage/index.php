<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 11/12/15
 * Time: 10:51 AM
 */
error_reporting(E_ALL  ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
ini_set("display_errors",1);
date_default_timezone_set('America/Los_Angeles');
ob_start('ob_gzhandler');

session_start();
require_once('dbinfo.php');

/*
// test URLs:
http://flmtrk.com/?a=74&oc=116&c=81&p=r&s1=7020
http://flmtrk.com/?a=74&oc=116&c=81&p=r&s1=7022
http://flmtrk.com/?a=74&oc=116&c=81&p=r&s1=7024
http://flmtrk.com/?a=74&oc=116&c=81&p=r&s1=7025
http://flmtrk.com/?a=74&oc=116&c=81&p=r&s1=7026
http://flmtrk.com/?a=74&oc=116&c=81&p=r&s1=7027
http://flmtrk.com/?a=74&oc=116&c=81&p=r&s1=7028
*/

/*
BlueHost DB Details
  Database: studepb5_fth_submissions
  Username: studepb5_dbuser
  Password: C9oa1v&.aU&T

*/

$DBFile = 'new_submissions.sdb';

if(isset($_GET['file']) && $_GET['file'] == 'old') {
    $DBFile = 'submissions.sdb';
}

if(!isset($_COOKIE['tax_debt']) && !empty($_POST['tax_debt'])) {
    setcookie('tax_debt', $_POST['tax_debt'], 0, '/', '1099taxhelp.net');
}

$DB_path = __DIR__.'/'.$DBFile;

try {
    $dbSource = 'mysql:host=localhost;dbname='.$dbDatabase;
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    $dbm = new PDO($dbSource, $dbUsername, $dbPassword, $options);
    $dbm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//    $db = new PDO('sqlite:'.$DB_path);

    // Get the subfolder request
    $fileName = './' . trim( str_replace(dirname($_SERVER['SCRIPT_NAME']), '', strtok($_SERVER['REQUEST_URI'], '?')), '/') . '.php';
    if(file_exists($fileName)) {
        require_once($fileName);
    }
}

catch(PDOException $e)
{
    echo $e->getMessage();
}

// close the DB connection
$db = null;
$dbm = null;

ob_end_flush();

exit();
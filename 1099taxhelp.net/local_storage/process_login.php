<?php
error_reporting(E_ALL);
ini_set("display_errors",true);
session_start();
include("dbinfo.php");

$dbSource = 'mysql:host=localhost;dbname='.$dbDatabase;
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$dbm = new PDO($dbSource, $dbUsername, $dbPassword, $options);
$dbm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_name = $_REQUEST['username'];
$password = md5($_REQUEST['password']);
$query = "SELECT * FROM login WHERE username = '" . $user_name . "' AND password = '" . $password . "'";
$stmt = $dbm->query($query);
$result = $stmt->fetchAll(PDO::FETCH_OBJ);

$count = count($result);
if ($count > 0) {
    $_SESSION["username"] = $user_name;
    header('Location:../local_storage/read/?authKey=b7hak8w2nKDb2KS2n0d');
} else {
    $err_msg = "Wrong username or password";
    header('Location:../local_storage/login.php?msg=' . $err_msg);
}
?>
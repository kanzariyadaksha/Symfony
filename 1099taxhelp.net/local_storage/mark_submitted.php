<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 12/4/15
 * Time: 3:27 PM
 */

if(isset($_SESSION['insertID'])) {

    $sql = "UPDATE contacts SET submitted = 1 WHERE id = ".$_SESSION['insertID'];

    $result = $dbm->exec($sql);
    if($result) echo $_SESSION['insertID']." - Submitted! ";
}
<?php
require_once 'src/Mandrill.php'; 
try {
    $mandrill = new Mandrill('PM5crQ3ItDpJ4h7L-CyY1Q');
    $result = $mandrill->senders->getList();
    print_r($result);
    /*
    Array
    (
        [0] => Array
            (
                [address] => sender.example@mandrillapp.com
                [created_at] => 2013-01-01 15:30:27
                [sent] => 42
                [hard_bounces] => 42
                [soft_bounces] => 42
                [rejects] => 42
                [complaints] => 42
                [unsubs] => 42
                [opens] => 42
                [clicks] => 42
                [unique_opens] => 42
                [unique_clicks] => 42
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Invalid_Key - Invalid API key
    throw $e;
}
?>
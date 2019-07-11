<?php
require_once 'mail/src/Mandrill.php'; //Not required with Composer
try {
    $mandrill = new Mandrill('33b3909940e728e15d35bb93d6261403-us20');
    $name = 'Example Template';
    $from_email = 'daksha.kanzariya@bytestechnolab.com';
    $from_name = 'Example Name';
    $subject = 'example subject';
    $code = '<div>example code</div>';
    $text = 'Example text content';
    $publish = false;
    $labels = array('example-label');
    $result = $mandrill->templates->add($name, $from_email, $from_name, $subject, $code, $text, $publish, $labels);
    echo "<pre>";
    print_r($result);

} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Invalid_Key - Invalid API key
    throw $e;
}
?>
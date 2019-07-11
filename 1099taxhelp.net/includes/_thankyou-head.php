<?php

/**
 * Created by PhpStorm.
 * User: bill
 * Date: 4/20/16
 * Time: 10:40 PM
 */
error_reporting(E_ALL ^ E_NOTICE);
$fname = "";
$lname = "";
$email = "";
$phone = "";
$tax_debt = "";
$state = "";

/*if (isset($_GET['debt'])) {
    $tax_debt = $_GET['debt'];
} else*/if (isset($_COOKIE['tax_debt'])) {
    $tax_debt = $_COOKIE['tax_debt'];
}


/*if (isset($_GET['fname'])) {
    $fname = $_GET['fname'];
} else*/if (isset($_COOKIE['first_name'])) {
    $fname = $_COOKIE['first_name'];
}

/*if (isset($_GET['lname'])) {
    $lname = $_GET['lname'];
} else*/if (isset($_COOKIE['last_name'])) {
    $lname = $_COOKIE['last_name'];
}

/*if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];
} elseif (isset($_COOKIE['primary_phone'])) {
    $phone = $_COOKIE['primary_phone'];
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
} elseif (isset($_COOKIE['email_address'])) {
    $email = $_COOKIE['email_address'];
}*/
if (isset($_GET['state'])) {
    $state = $_GET['state'];
} elseif (isset($_COOKIE['state'])) {
    $state = $_COOKIE['state'];
}

if (isset($_GET['affid'])) {
    $affid = $_GET['affid'];
} elseif (isset($_COOKIE['affid'])) {
    $affid = $_COOKIE['affid'];
}

debug_var($tax_debt);

function debug_var($var) {
    echo "\n<!--\n";
    print_r($var);
    echo "mitul";
    echo "\n-->\n";
}
?>
<script type="text/javascript"> _linkedin_data_partner_id = "37082"; </script><script type="text/javascript"> (function()
{var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);}

)(); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=37082&fmt=gif" /> </noscript>
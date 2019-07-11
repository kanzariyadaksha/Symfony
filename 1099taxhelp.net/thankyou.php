<?php 
session_start();
if(isset($_GET['debt'])) {
  $tax_debt = $_GET['debt'];
}
elseif (isset($_COOKIE['tax_debt'])) {
  $tax_debt = $_COOKIE['tax_debt'];
}
$requestURI = $_SERVER['REQUEST_URI'];
$queryString = "";
if(strpos($requestURI, "?") != false)
  { $queryString = substr($requestURI, strpos($requestURI, "?")); }

if(isset($_COOKIE['primary_phone'])){$phone = $_COOKIE['primary_phone'];
$pp1 = substr($phone,0,3);
$pp2 = substr($phone,3,3);
$pp3 = substr($phone, 6,4);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>1099 Tax Help - Thank You</title>
  <meta charset="utf-8">
  <?php if(isset($tax_debt) && $tax_debt < 10000) {?>
    <meta name="tax_amount" content="<?php echo $tax_debt?>">
  <?php }?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style_v2.css">
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />

  <!-- Generated by ClickWerx Adserver v3.1.0 -->
  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/_thankyou-head.php'); ?> 

</head>
<body class="thankspage">
  <header class="container">
    <div class="header-inner">
      <div class="header-left">
        <img src="rideshare/images/logo.png" alt="1099-LOGO">
      </div>
      <div class="phone-number">
        Call Now For Immediate Help<br/>
        <?php
        if(!empty($_SESSION['tel'])) {
          $tel = $_SESSION['tel'];
        } elseif(!empty($_SESSION['supplier_phone'])) {
          $tel = $_SESSION['supplier_phone'];
        } else {
          $tel =   '833-300-0849';
        } ?>
        <span id="phoneNumberCP">
          <a href="tel:+1<?php echo str_replace("-","",$tel);?>" style="text-decoration: none;" class="number"><?php echo $tel?></a>
        </span>
        <!-- span id="phoneNumberCP"></span -->
      </div>
      <div class="header-right"><img src="assets/images/two-img.png" alt="Thank-you-img"/></div>

    </div>

  </header>

  <?php
  $debtvalue = 0;
  if (isset($_GET['debt'])) {
    $debtvalue = $_GET['debt'];
  } elseif (isset($_COOKIE['tax_debt'])) {
    $debtvalue = $_COOKIE['tax_debt'];
  } elseif(isset($tax_debt)) {
    $debtvalue = $tax_debt;
  }

  if ($debtvalue != 0 && $debtvalue > 9999) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/_tracking-pixels.php');
  }
  ?>

  <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/_thankyou-content_v2.php'); ?>

  <footer class="container">
    <div class="footer-detail">1099 taxhelp.net is a matching service for various services. By calling and/or providing your personal information, you agree that your information may be collected and transferred to a company that may be able to assist you. Your personal details are important to us. Our partners' clients' results may vary based on ability to save funds and completion of all program terms. Not all of our partners' clients' are able to complete their program for various reasons, including their ability to save sufficient funds. Our partners' estimates are based on prior results, which will vary depending on your specific circumstances. Our partner does not guarantee that your debts will be resolved for a specific amount or percentage or within a specific period of time. Our partners do not assume your debts, make monthly payments to creditors or provide tax, bankruptcy, accounting or legal advice or credit repair services. Our partners' service is not available in all states and their fees may vary from state to state. Please contact a tax professional to discuss potential tax consequences of less than full balance debt resolution. Depending on the product or services offered, you may be able to obtain this service on your own without the help of one of our 3rd party members of our network. Read and understand all program materials prior to enrollment. Please note that all calls with the company may be recorded or monitored for quality assurance and training purposes.
    </div>
    <div class="footer-bottom">



      <div class="copyright">Copyright © 2019.1099taxhelp.net.</div>


      <ul class="list-inline">
        <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#contactUsModal">Contact Us</a></li>
        <li class="list-inline-item"><a href="/terms.php">Terms of Use</a></li>
        <li class="list-inline-item"><a href="/privacy-policy.php">Privacy Policy</a></li>
        <li class="list-inline-item"><a href="http://www.byetrk.info/o-qkvl-d21-316731a1907ef2c846e69841dc17fe58" target="_blank">Unsubscribe</a></li>
      </ul>


      
    </div>
    <?php  require_once($_SERVER['DOCUMENT_ROOT'].'/rideshare/includes/_modal.php'); ?>
  </footer>

  <script id="LeadiDscript" type="text/javascript">(function() { var s = document.createElement('script'); s.id = 'LeadiDscript_campaign'; s.type = 'text/javascript'; s.async = true; s.src = (document.location.protocol + '//d1tprjo2w7krrh.cloudfront.net/campaign/583e8030-6ca1-2387-f3d7-11eedb8c4896.js'); var LeadiDscript = document.getElementById('LeadiDscript'); LeadiDscript.parentNode.insertBefore(s, LeadiDscript);})();</script><noscript><img src='//create.leadid.com/noscript.png?lac=581e5a37-7a2c-a742-c313-6f515b2d3222&lck=583e8030-6ca1-2387-f3d7-11eedb8c4896' /></noscript>

</body>
</html>

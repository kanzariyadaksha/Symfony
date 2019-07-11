<?php
session_start();

$tel = '877-506-5546';
if(isset($_SESSION['TDN2_TEL']))
    $tel = $_SESSION['TDN2_TEL'];
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Contact</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/owl.carousel.css" rel="stylesheet"/>
   <link href="assets/css/owl.theme.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!--Internet Explorer 9-->
<!--[if IE 9]><link rel="stylesheet" type="text/css" href="assets/css/ie9.css"/><![endif]-->

<!--Internet Explorer 8-->
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="assets/css/ie8.css"/><![endif]-->

<!--Internet Explorer 7-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" href="assets/css/ie7.css"/><![endif]-->

<!--[if lt IE 9]>
<script src="assets/js/html5shiv.js"></script>
<![endif]-->        
    </head>
    <body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MW4MZP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MW4MZP');</script>
<!-- End Google Tag Manager -->    
        <div class="wraper">
            <div class="container">
                <div class="header">
                    <div class="logo"><a href="index.php"><img src="../rideshare/images/logo.png" alt=""/></a></div>
                    <div class="header-sec">
                        <strong class="call-now">Call Now For Immediate Help</strong><br/>
                        <strong class="number"><?php echo $tel?></strong>                       
                    </div>
                    <div class="header-right"><img src="assets/images/two-img.png" alt=""/></div> 
                    <div class="clearfix"></div>
                </div>

<div class="contact-ban">
    <strong class="con-one">You will work with a real, <span>live person<br/> to help you</span> every step of the way</strong>
    <div class="con-arrow"><img src="assets/images/contact-arrow.png" alt=""/></div>
    <div class="btn-wrap"><button onclick="window.location.href='<?= $_SESSION['entry'] ?>'" class="con-btn" type="button" name="btn">get started</button></div>
</div>
<div class="clearfix"></div>
<div class="cont-head">Contact Us</div>
<div class="clearfix"></div>
                <div class="cont-address">
                    15333 Culver Dr.<br>
                    Suite 340-244<br>
                    Irvine, CA 92604
                </div>
<div class="cont-content">

    <div class="cont-col">
        <div class="cont-img"><img src="assets/images/con1.png" alt=""/></div>
        <div class="col-wrap">
            <p>Contact our customer service department</p>
            <strong><a href="mailto:support@1099taxhelp.net">support@1099taxhelp.net</a></strong>
        </div>
    </div>

        <div class="cont-col con-add">
        <div class="cont-img"><img src="assets/images/con2.png" alt=""/></div>
        <div class="col-wrap">
            <p>Want to be an affiliate? Please email </p>
            <strong class="con-blue"><a href="mailto:affiliates@1099taxhelp.net">affiliates@1099taxhelp.net</a></strong>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/_non-thankyou-content.php'); ?>

                <div class="footer">
                    <div class="copyright">Copyright &copy; <?php echo date("Y");?> 1099taxhelp.net. All rights reserved .</div>
                    <ul class="footer-nav">
                        <li><a href="about.php" >About Us </a></li>
                        <li>|</li>
                        <li><a href="contact.php">Contact Us </a></li>
                        <li>|</li>
                        <li><a href="/privacy.php">Privacy</a></li>
                        <li>|</li>
                        <li><a href="http://www.byetrk.info/o-qkvl-d21-316731a1907ef2c846e69841dc17fe58" target="_blank">Unsubscribe</a></li>
                    </ul>
                    <div class="clearfix"></div>
<!--<div id="about" class="white-popup mfp-hide">
            <div class="popup-content">
                <p class="popup-hero">About Usf</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
</div>                 
<div id="contact" class="white-popup mfp-hide">
            <div class="popup-content">
                <p class="popup-hero">Contact Us</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
</div>  
<div id="terms" class="white-popup mfp-hide">
            <div class="popup-content">
                <p class="popup-hero">Terms of Use</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
</div> -->
 <div id="privacy" class="white-popup mfp-hide">
            <div class="popup-content">
                <p class="popup-hero">Privacy Policy</p>
                <p>1099taxhelp.net is a matching service for various services. By calling and/or providing your personal information, you agree that your information may be collected and transferred to a company that may be able to assist you. Your personal details will not be misused.</p>
                                <p>*Our partner's clients' results may vary based on ability to save funds and completion of all program terms. Not all of our partner's clients' are able to complete their program for various reasons, including their ability to save sufficient funds. Our partner's estimates are based on prior results, which will vary depending on your specific circumstances. Our partner does not guarantee that your debts will be resolved for a specific amount or percentage or within a specific period of time. Our partner does not assume your debts, make monthly payments to creditors or provide tax, bankruptcy, accounting or legal advice or credit repair services. Our partner's service is not available in all states and their fees may vary from state to state. Please contact a tax professional to discuss potential tax consequences of less than full balance debt resolution. Depending on the product or services offered, you may be able to obtain this service on your own without the help of one of our 3rd party members of our network. Read and understand all program materials prior to enrollment.</p>
            </div>
</div>  
                </div>
        
</div>            
        </div>
<script src="assets/js/jslab.js" type="text/javascript"></script>
<script src="assets/js/validation.js" type="text/javascript"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/placeholder.js" type="text/javascript"></script>
<script src="assets/html5shiv-master/dist/html5shiv.js" type="text/javascript"></script>
<script type="text/javascript">
	//POPUP ACTIVATION
	$(document).ready(function()
	{
		$('.open-popup-link').magnificPopup({
			//                    type: 'inline',
			midClick: true, // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});
	});

$(document).ready(function($) {
  $("#owl-example").owlCarousel({

   /* navigation : true, // Show next and prev buttons */
    slideSpeed : 300,
     autoPlay : 3000,
   /* paginationSpeed : 400, */
    singleItem:true
  });
});


</script>        
    </body>
</html>
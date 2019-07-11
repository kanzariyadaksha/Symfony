<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fresh Tax Help</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
        <link rel="icon" href="images/favicon.png" type="image/ico" sizes="16x16">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <!--Internet Explorer 9--><!--[if IE 9]><link rel="stylesheet" type="text/css" href="assets/css/ie9.css"/><![endif]-->
        <!--Internet Explorer 8--><!--[if IE 8]><link rel="stylesheet" type="text/css" href="assets/css/ie8.css"/><![endif]-->
        <!--Internet Explorer 7--><!--[if IE 7]><link rel="stylesheet" type="text/css" href="assets/css/ie7.css"/><![endif]-->
        <!--[if lt IE 9]><script src="assets/js/html5shiv.js"></script><![endif]-->

<!-- MBB -->
<script src="https://d1a32x6bfz4b86.cloudfront.net/jsapi/v1/retreaver.min.js" type="text/javascript"></script>
	    <style>
		    .policy { padding: 100px 25px 25px; }
		    h1 { color: #333; text-align: center; font-size: 22px; }
		    p { color: #333; margin-top: 10px; line-height: 1.5em; font-size: 15px; text-align: left; }
		    p.section { font-size: 18px; }
		    p.subtext { font-size: 11px; }
	    </style>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<?php
if(isset($_SESSION['supplier_phone']) && $_SESSION['supplier_phone']!="")
{
    $tel= $_SESSION['supplier_phone'];
} else {
    $tel = "877-506-5546";
}
?>
        <div class="wraper">
            <div class="holder">
                <div class="container">
                    <div class="header" style="margin-bottom: 24px;">
                        <div class="logo"><a href="<?= $_SESSION['entry'] ?>"><img src="../rideshare/images/logo.png" alt=""/></a></div>
                        <div class="header-sec">
                            <strong class="call-now">Call Now For Immediate Help</strong><br/>
                            <span id="phoneNumberCP"><a href="tel:+1<?php str_replace("-","",$tel); ?>" class="number" style="text-decoration: none;"><?php echo $tel?></a></span>
                        </div>
                        <div class="header-right"><img src="assets/images/two-img.png" alt=""/></div>
                        <div class="clearfix"></div>
                    </div>

	                <h1>Privacy Policy</h1>
					<?php include('privacyBody.php'); ?>

                    <div class="footer">
                        <div class="copyright">Copyright © <?php echo date("Y"); ?> 1099taxhelp.net. All rights reserved. </div>
                        <ul class="footer-nav">
                          <li><a href="about.php" >About Us </a></li>
                          <li>|</li>
                          <li><a href="contact.php">Contact Us </a></li>
                          <li>|</li>
                          <li><a href="/privacy.php">Privacy</a></li>
                          <li>|</li>
                          <li><a  href="http://www.byetrk.info/o-qkvl-d21-316731a1907ef2c846e69841dc17fe58" target="_blank">Unsubscribe</a></li>
                        </ul>
                        <div class="clearfix"></div>
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
        </div>



<script id="LeadiDscript" type="text/javascript">(function() { var s = document.createElement('script'); s.id = 'LeadiDscript_campaign'; s.type = 'text/javascript'; s.async = true; s.src = (document.location.protocol + '//d1tprjo2w7krrh.cloudfront.net/campaign/583e8030-6ca1-2387-f3d7-11eedb8c4896.js'); var LeadiDscript = document.getElementById('LeadiDscript'); LeadiDscript.parentNode.insertBefore(s, LeadiDscript);})();</script><noscript><img src='//create.leadid.com/noscript.png?lac=581e5a37-7a2c-a742-c313-6f515b2d3222&lck=583e8030-6ca1-2387-f3d7-11eedb8c4896' /></noscript>

        
        <script type="text/javascript">
            (function() {
                var field = 'xxTrustedFormCertUrl';
                var provideReferrer = false;
                var tf = document.createElement('script');
                tf.type = 'text/javascript';
                tf.async = true;
                tf.src = 'http' + ('https:' == document.location.protocol ? 's' : '') +
                        '://api.trustedform.com/trustedform.js?provide_referrer=' + escape(provideReferrer) + '&field=' + escape(field) + '&l=' + new Date().getTime() + Math.random();
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(tf, s);
            })();
        </script>
<!-- VWO GOES HERE -->
        <!-- Start Visual Website Optimizer Asynchronous Code -->
        <script type="text/javascript">
            var _vwo_code = (function() {
                var account_id = 97242,
                        settings_tolerance = 2000,
                        library_tolerance = 2500,
                        use_existing_jquery = false,
                        // DO NOT EDIT BELOW THIS LINE
                        f = false, d = document;
                return{use_existing_jquery: function() {
                        return use_existing_jquery;
                    }, library_tolerance: function() {
                        return library_tolerance;
                    }, finish: function() {
                        if (!f) {
                            f = true;
                            var a = d.getElementById('_vis_opt_path_hides');
                            if (a)
                                a.parentNode.removeChild(a);
                        }
                    }, finished: function() {
                        return f;
                    }, load: function(a) {
                        var b = d.createElement('script');
                        b.src = a;
                        b.type = 'text/javascript';
                        b.innerText;
                        b.onerror = function() {
                            _vwo_code.finish();
                        };
                        d.getElementsByTagName('head')[0].appendChild(b);
                    }, init: function() {
                        settings_timer = setTimeout('_vwo_code.finish()', settings_tolerance);
                        this.load('//dev.visualwebsiteoptimizer.com/j.php?a=' + account_id + '&u=' + encodeURIComponent(d.URL) + '&r=' + Math.random());
                        var a = d.createElement('style'), b = 'body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}', h = d.getElementsByTagName('head')[0];
                        a.setAttribute('id', '_vis_opt_path_hides');
                        a.setAttribute('type', 'text/css');
                        if (a.styleSheet)
                            a.styleSheet.cssText = b;
                        else
                            a.appendChild(d.createTextNode(b));
                        h.appendChild(a);
                        return settings_timer;
                    }};
            }());
            _vwo_settings_timer = _vwo_code.init();
        </script>

        <!-- End Visual Website Optimizer Asynchronous Code -->
    </body>
</html>
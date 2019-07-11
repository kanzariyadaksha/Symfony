<?php #require_once($_SERVER['DOCUMENT_ROOT'].'/includes/sentry-include.php'); ?>

<script type="text/javascript" src="/includes/js/d.js"></script>

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

    //CKM.error_class = "input-error";

    var counter = 0;
    var submitCounter = 0;

</script>

<!-- Start Visual Website Optimizer Asynchronous Code -->
<script type='text/javascript'>
    var _vwo_code=(function(){
        var account_id=97242,
            settings_tolerance=2000,
            library_tolerance=2500,
            use_existing_jquery=false,
        // DO NOT EDIT BELOW THIS LINE
            f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
</script>
<!-- End Visual Website Optimizer Asynchronous Code -->


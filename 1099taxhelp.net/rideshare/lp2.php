<?php  
error_reporting(0);
session_start();
$path = '/rideshare/';
$state = null;
$hasExitPop = true;

require_once('../includes/sess_form.php');

$_SERVER['REQUEST_SCHEME'] = "http";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=="on"){
	$_SERVER['REQUEST_SCHEME']="https";
}
if(!isset($_REQUEST['ClientGuid']) && !isset($_REQUEST['VendorGuid']) && !isset($_REQUEST['LocationCode']) ){
	
	$url = 'http://click.callerready.com/click.aspx';

	$data = $_GET;
	$data["TrackingCode"] = $data["click_id"];
	$data["ClientGuid"] = "8726B511-5E23-4DA7-9E46-13AB24116D1B";
	$data["VendorGuid"] = "8e8d1d8f-19e9-4dca-9ee9-77f3bf208861";
    //RingPool Location Code
	$data["LocationCode"] = "CRSS2165-102";
	$data["offer_id"] = "94";
	$data["UrlRefer"] = urlencode($_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
	$data["PathLabel"] = "TAX-HELP-1099";
    //$data["tags"] = urlencode($_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);

	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'GET',
			'content' => http_build_query($data),
		),
	);

	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	$supplier_phone = $result;

    //Build Redirect
	$data["aff_sub"] = $supplier_phone;
	$data["SubmitType"] = "TALK";
    //Posting Location Code
	$data["LocationCode"] = "CRSS2165-101";

    //Session the tel
	$_SESSION['supplier_phone'] = substr($supplier_phone, 2, 3)."-".substr($supplier_phone, 5, 3)."-".substr($supplier_phone, 8, 4);

	$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/rideshare/lp2.php?' . http_build_query($data);
	header("Location: $url");
	exit;
}
$_SESSION['home'] = '/rideshare';
$_SESSION['entry'] = $path;
$tel = $_SESSION['tel'] = $_SESSION['supplier_phone'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>1099 Tax Help</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META NAME="robots" CONTENT="noindex,nofollow">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/lp2-style.css">
	<link rel="icon" href="favicon.ico" type="image/ico" sizes="16x16">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	
	<?php require_once('./includes/_scripts-header.php') ?>
</head>

<body>
	<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-sm-between justify-content-center fixed-top"> -->
		<header class="d-none d-sm-block">
			<nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-center justify-content-sm-between fixed-top">
				<a class="navbar-brand" href="#">
					<img class="logo-img img-fluid" src="images/logo.png" alt="logo">
				</a>
				<!-- <div class="header-call-info text-center d-none d-sm-block"> -->
				<div class="header-call-info">
					<label>For More Information call:</label>
					<?php
					if (isset($_SESSION['supplier_phone'])) {
						$tel = $_SESSION['supplier_phone'];
					} else {
						$tel = '833-300-0849';
					}
					?>
					<a class="click-to-call d-block" href="tel:<?php echo str_replace(array("-", " ", "(", ")"), "", $tel); ?>"><?php echo $tel ?></a>
				</div>
			</nav>
		</header>

			<section class="taxhelp-for-drivers">
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-5 text-left text-sm-center text-lg-left mb-lg-0 mb-5 order-2 order-sm-1">
							<?php if(isset($_REQUEST['error_post'])){?>
								<p class="error">An error occurred. Please try again.</p>
							<?php }?>
							
							<h1 class="d-none d-sm-block"><span>Rideshare drivers…</span>Tax Help Is On The Way!</h1>
							<h3>Do you earn money from what many consider a <span>side gig</span>?</h3>
							<p>57 million Americans do. From Uber, Lyft or GrubHub drivers to freelance graphic designers, web developers, or freelance writers, many self-employed Americans could be facing a higher-than-expected tax bill this year.</p>
							<img class="img-fluid car-tax-image d-none d-lg-block" src="images/car-tax-help.png" alt="car-tax-help">
						</div>
						<div class="col-lg-6 order-1 order-sm-2">
							<h1 class="d-block d-sm-none"><span>Rideshare drivers…</span>Tax Help Is On The Way!</h1>
							<form class="row tax-form mx-auto step-1-open d-fkex align-content-center" id="ckm_form" action="/process/" name ="ckm_form" method="post">
								<?php echo $formFields; ?>
								<input type="hidden" name="toVerify" id="toVerify" value="active"/>
								<input type="hidden" name="page" value="<?= $_SERVER['REQUEST_URI'] ?>" />
								<input type="hidden" name="cr_price" value="0.00" />
								<input id="leadid_token" name="universal_leadid" type="hidden" value=""/>
								<input type="hidden" id="TCPA_checkbox" checked="checked" name="TCPA_checkbox" value="checked"/>
								<input type="hidden" name="landing_page" id="landing_page" value="textdebt" />
								<input type="hidden" name="tax_debt" value="" id="tax_debt">
								<section class="step step-1 active form-group col-12">
									<label class="form-title">How much do you owe in unpaid taxes (Federal or State)?</label>
									<div class="row">
										<div class="col-sm-6">
											<button type="button" class="form-control tax_val option option-1 next" data-amount="5000">
												UNDER $7,500
											</button>
										</div>
										<div class="col-sm-6">
											<button type="button" class="form-control tax_val option option-2 next" data-amount="7500">
												$7,500 - $9,999
											</button>
										</div>
										<div class="col-sm-6">
											<button type="button" class="form-control tax_val option option-3 next" data-amount="10000">
												$10,000 - $19,999
											</button>
										</div>
										<div class="col-sm-6">
											<button type="button" class="form-control tax_val option option-4 next" data-amount="20000">
												$20,000 - $49,999
											</button>
										</div>
										<div class="col-sm-6">
											<button type="button" class="form-control tax_val option option-5 next" data-amount="50000">
												$50,000 - $99,999
											</button>
										</div>
										<div class="col-sm-6">
											<button type="button" class="form-control tax_val option option-6 next" data-amount="100000">
												$100,000 OR MORE
											</button>
										</div>
									</div>
									<div class="hint">
										Click Any Amount to Continue
									</div>
								</section>

								<section class="step step-2 form-group col-12">
									<label class="form-title">What state do you live in?</label>
									<div class="row">
										<div class="col-sm-12">
											<div class="selectbox">
												<?php if(isset($_REQUEST['state'])) { $state = strtoupper($_REQUEST['state']); }?>
												<select class="form-control" id="state" name="state">
													<option value="">Select Your State</option>
													<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/_states.php') ?>
												</select>
											</div>
										</div>
									</div>
								</section>

								<section class="step step-3 form-group col-12">
									<label class="form-title">Please Enter Your Name:</label>
									<div class="row">
										<div class="col-12">
											<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $_REQUEST['first_name']?>"  placeholder="First Name">
										</div>

										<div class="col-12">
											<input type="text" class="form-control" id="last_name" name="last_name"  value="<?php echo $_REQUEST['last_name']?>" placeholder="Last Name">
										</div>
									</div>
								</section>

								<section class="step step-4 form-group col-12">
									<label class="form-title">What is your email address?</label>
									<input type="email" class="form-control" id="email_address" name="email_address" value="<?php echo $_REQUEST['email_address']?>" placeholder="Email Address">
									<div class="emailCompailance hide_emailCompailance">
										<p>Privacy and Spam Protection</p>
										<div class="emailCheckbox">
											<label class="chkbox">Please send special offers from 1099 Tax Help and partners.
												<input type="checkbox" name="opt_special_offers" id="opt_special_offers" checked="checked">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</section>

								<section class="step step-5 form-group col-12">
									<label class="form-title">What is your phone number? </label>
									<input type="tel" class="form-control" id="primary_phone" name="primary_phone" value="<?php echo $_REQUEST['primary_phone']?>" placeholder="Phone Number">
								</section>
								<div class="optin d-none">
									<input name="opt_in" id="opt_in" class="optin" type="checkbox" value="checked" checked="checked">
								</div>
								

								<div class="col-12 col-sm-12 text-center submit-btn-section p-0">
									<button type="button" class="btn btn-primary submit next hide-submit" data-currentstep="1"><span>Next</span></button>
									<button id="submitButton" type="submit" style="display: none;" class="btn btn-primary submit next show-submit" data-currentstep="1"><span>Submit</span></button>
								</div>

								<div class="note">
									YOU MAY QUALIFY TO SUBSTANTIALLY LOWER YOUR TAX DEBT
								</div>

								<!-- <div class="col-12 col-sm-12 d-none d-sm-block submit-btn-section">
									<button type="submit" id="submitButton" class="btn btn-primary submit"><span>Submit</span></button>
								</div> -->
								
								<div class="form-details">
									<div class="terms hide_terms">
										<?php include('includes/tcpa_without_checkbox.php'); ?>
									</div>
								</div>
								
							</form>
							<div class="d-block d-sm-none ">
								<nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-center justify-content-sm-between header-call-info">
									<a class="navbar-brand" href="#">
										<img class="logo-img img-fluid" src="images/logo.png" alt="logo">
									</a>
									<!-- <div class="header-call-info text-center d-none d-sm-block"> -->
										<div class="">
										<label>For More Information call:</label>
										<?php
										if (isset($_SESSION['supplier_phone'])) {
											$tel = $_SESSION['supplier_phone'];
										} else {
											$tel = '833-300-0849';
										}
										?>
										<a class="click-to-call d-block" href="tel:<?php echo str_replace(array("-", " ", "(", ")"), "", $tel); ?>"><?php echo $tel ?></a>
									</div>
								</nav>
							</div>
							<!-- <section class="container-fluid header-call-info mob-call d-block d-sm-none bg-primary text-center py-3">
								<label>For More Information call:</label>
								<?php
								if (isset($_SESSION['supplier_phone'])) {
									$tel = $_SESSION['supplier_phone'];
								} else {
									$tel = '833-300-0849';
								}
								?>
								<a class="click-to-call d-block" href="tel:<?php echo str_replace(array("-", " ", "(", ")"), "", $tel); ?>"><?php echo $tel ?></a>
							</section> -->
							
							<img class="img-fluid car-tax-image d-none d-sm-block d-lg-none " src="images/car-tax-help.png" alt="car-tax-help">
						</div>

					</div>
				</div>
			</section>

			

			<section class="container-fluid testimonial-wrapper">
				<div class="container">
					<div id="demo" class="testimonial-inner carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active testimonial-item">
								<div class="testimonial-content">
									20 plus years hiding from the IRS. On payment plans with them. Never seem to get caught up, alway's behind. IRS tried to attached my pay. Huge mess. Tax liens on 2 towns I lived in. About $90'000.00 in debt. I am a free man today. Tax liens now removed. Took about 1 year plus to settle. Just received my second tax refund on my yearly taxes. These professionals made it all go away. It's like I never had a problem in the first place. Better yet, I did not have to pay the IRS back anything because of my income.was to low. These guys did everything they needed to do to solve the problem.
								</div>
								<div class="testimonial-by">
									- Thomas G.
								</div>
							</div>

							<div class="carousel-item testimonial-item">
								<div class="testimonial-content">
									From the first consultation they were up to speed on my options and very understanding of what was feasible. I think the standout thing they did – apart from releasing a small bank levy and reducing my tax debt substantially – was the professional excellence each and every time we were in contact. Updates were provided weekly, I never had to call and ask for something, and they were just completely on top of the ball. I will ask them to handle my returns each year as well. Quite a find, considering how many companies are out there claiming to be tax relief specialists. 
								</div>
								<div class="testimonial-by">
									- Morris C.
								</div>
							</div>

							<div class="carousel-item testimonial-item">
								<div class="testimonial-content">
									Not only did they resolve my huge tax issue that had me biting my nails and wondering if I would ever be out from beneath the debt, but they arranged a very reasonable payment plan, got the fines and penalties reduced to sensible levels, and cut my tax debt by less than half! Every piece of paper I had to submit was easy to fill out, made sense, and literally took the burden off of my shoulders! I'm very happy I chose them to help! Don't go anywhere else! 
								</div>
								<div class="testimonial-by">
									- William B.
								</div>
							</div>

							<div class="carousel-item testimonial-item">
								<div class="testimonial-content">
									They did most of the work locating documents and negotiating a very favorable settlement with both federal and state tax agencies. They had our backs and I would recommend to everyone like us who had no clue what to do to solve their tax issues to call tax defense and you will feel like I do now, free to get on with our lives!!! Thank you  
								</div>
								<div class="testimonial-by">
									- Don H.
								</div>
							</div>

						</div>

						<ul class="carousel-indicators">
							<li data-target="#demo" data-slide-to="0" class="active"></li>
							<li data-target="#demo" data-slide-to="1"></li>
							<li data-target="#demo" data-slide-to="2"></li>
							<li data-target="#demo" data-slide-to="3"></li>
						</ul>

					</div>


				</div>
			</section>

			<section class="container-fluid independant-contactor">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<h2>What you need to know about
								<span>Paying Taxes as an Independent Contractor</span>
							</h2>
							<div class="info-text">
								If you are an independent contractor or a freelancer, you should receive a 1099 form every January. This paperwork is similar to a W-2 form sent by employers – it shows how much money you made in the tax year. Unlike W-2s employees, though, 1099 contractors do not get any taxes take out. No social security. No unemployment. No federal taxes. But you still have to pay into these funds through something called Self-employment tax. And that means if you’re a driver for Uber or Lyft – or any other type of 1099 contractor – you might owe the IRS more than you expected. 
							</div>
						</div>
						<div class="col-lg-6 d-none d-sm-block d-lg-none">
							<img class="img-fluid" src="images/paying-taxes.png" alt="paying-taxes">
						</div>
					</div>
				</div>
			</section>

			<section class="container-fluid no-saving">
				<div class="container">
					<div class="row justify-content-lg-end">
						<div class="col-lg-6">
							<h2><span>No Savings to Pay your Taxes?</span>
								Don’t Panic.
							</h2>
							<div class="info-text">
								<p>It’s not unusual for independent contractors like Uber and Lyft drivers to owe thousands in tax debt on April 15th. And most workers in the gig economy don’t have savings stashed away to pay their taxes. In fact, 46% of Americans live paycheck-to-paycheck. So, if you didn’t set aside 30% of your pay from every gig, it’s understandable. You needed that money to live. But now you’re faced with un unexpected tax bill. 
								</p>
								<p>Fortunately, self-employed individuals may have multiple tax deductions they didn’t know about. A professional tax firm can help you find those deductions to reduce what you owe in taxes. Working with a professional tax firm to file your 1099 taxes can help you reduce your tax debt with appropriate, legal tax deductions that won’t raise red flags with the IRS. You can reduce the amount you own without worrying about an audit. Take action quickly, because you may realize your situation isn’t as bad as you first thought.</p>
							</div>
						</div>
						<div class="col-lg-6 d-none d-sm-block d-lg-none">
							<img class="img-fluid" src="images/no-saving.png" alt="no-saving">
						</div>
					</div>
				</div>
			</section>

			<section class="container-fluid help-for-uber-driver">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<h2><span>There’s Help for Uber/Lyft Drivers with Tax Debt.</span>
								Still can’t pay?
							</h2>
							<div class="info-text">
								There are options for 1099 Contractors facing tax debt. Tax experts can buy you more time. Tax professionals can help you file the paperwork for an offer-in-compromise, a partial pay installment agreement, or even an extension. Any of these actions can help you avoid additional late fees and penalties and help prevent levies or liens on your property. Don’t let your debt pile up. Let 1099 Tax Help assist you to find a tax expert that can alleviate your tax challenges in the gig economy. 
							</div>
						</div>
						<div class="col-lg-6 d-none d-sm-block d-lg-none">
							<img class="img-fluid" src="images/i-can-help.png" alt="i-can-help">
						</div>
					</div>
				</div>
			</section>

			<section class="container-fluid footer">
				<div class="container">
					<div class="quick-links d-flex justify-content-center">
						<ul class="list-inline">
							<li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#contactUsModal">Contact Us</a></li>
							<li class="list-inline-item"><a href="terms.php" target="_blank">Terms of Use</a></li>
							<li class="list-inline-item"><a href="privacy-policy.php" target="_blank">Privacy Policy</a></li>
							<li class="list-inline-item">
								<a href="http://www.byetrk.info/o-qkvl-d21-316731a1907ef2c846e69841dc17fe58" target="_blank">Unsubscribe</a></li>
							</ul>
							
						</div>
						<div class="footer-text">
							<p>1099 Tax Help is a matching service for various services. By calling and/or providing your personal information, you agree that your information may be collected and transferred to a company that may be able to assist you. Your personal details are important to us. Our partners’ clients’ results may vary based on ability to save funds and completion of all program terms. Not all of our partners’ clients’ are able to complete their program for various reasons, including their ability to save sufficient funds.</p>
							<p>Our partners’ estimates are based on prior results, which will vary depending on your specific circumstances. Our partner does not guarantee that your debts will be resolved for a specific amount or percentage or within a specific period of time. Our partners do not assume your debts, make monthly payments to creditors or provide tax, bankruptcy, accounting or legal advice or credit repair services. Our partners’ service is not available in all states and their fees may vary from state to state. Please contact a tax professional to discuss potential tax consequences of less than full balance debt resolution. Depending on the product or services offered, you may be able to obtain this service on your own without the help of one of our 3rd party members of our network. Read and understand all program materials prior to enrollment.</p>
							<p>Please note that all calls with the company may be recorded or monitored for quality assurance and training purposes.</p>
						</div>
						<div class="copyright">
							<p>Copyright © 2019. 1099taxhelp.net/rideshare</p>
						</div>
					</div>
					<?php 
					include_once('../submit_process_popup.php');
					require_once('./includes/_page_bottom.php'); ?>
					<?php $disableRetreaver = true; require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/_scripts-body.php') ?>

				</section>
				<?php require_once('./includes/_modal.php') ?>

				<script id="LeadiDscript" type="text/javascript">(function () {
					var s = document.createElement('script');
					s.id = 'LeadiDscript_campaign';
					s.type = 'text/javascript';
					s.async = true;
					s.src = (document.location.protocol + '//d1tprjo2w7krrh.cloudfront.net/campaign/583e8030-6ca1-2387-f3d7-11eedb8c4896.js');
					var LeadiDscript = document.getElementById('LeadiDscript');
					LeadiDscript.parentNode.insertBefore(s, LeadiDscript);
				})();</script><noscript><img src='//create.leadid.com/noscript.png?lac=581e5a37-7a2c-a742-c313-6f515b2d3222&lck=583e8030-6ca1-2387-f3d7-11eedb8c4896' /></noscript>

				<script>

					$("body").on("click",".tax_val",function() {
					  $('#tax_debt').val($(this).attr('data-amount'));
					});

					$('#state').change(function(e) {
           			    $('#ckm_form').valid();
        			});

				   	var i = 2; 
					$(window).on("load resize orientationchange", function (e) {
						var w= window.innerWidth;  
					//if (window.innerWidth <= 576) {
						$('.step').hide();
						$('.active').show();       
						
						// $('.hide_emailCompailance').hide();
						// $('.hide_terms').hide(); 

						$('.form-control').keypress(function (e) {
							var key = e.which;
							if(key == 13)  // the enter key code
							{
								$('.next').click();
							}
							
						});   


						$('.next').unbind().click(function () {
							console.log("i",i);
							var isValid = $("#ckm_form").valid();
							
							if(isValid) {
								var pos = $(this).attr('data-currentstep');
								
								$('.tax-form').removeClass('step-1-open');


								if (pos==4) {
									$('.tax-form').addClass('form-details-active');
								}

								if (pos!=5) {
									if (pos==4) {
										$(".hide-submit").hide();
										$(".show-submit").show();
									}
									$(this).parents('.tax-form').find('.active + .step').addClass('active').show();
									$(this).parents('.tax-form').find('.active:not(:last-of-type)').first().removeClass('active').hide();
									$('.active').show();
									// console.log($('.active .form-control').focus().attr('id'));
									$('.active #first_name').focus();
									
									$(this).attr('data-currentstep', i++);


									if ($(this).attr('data-currentstep') == 5) {
									$('.next').html('<span>Submit</span>');
										e.preventDefault();
									}
								}
							}
							
						});
					//} 
					//else {
					//	$('.step').show();
					//}
				});
			</script>
			<script type="text/javascript">
				$(document).ready(function(){
					function savelead() {
						var postData = $("#ckm_form").serialize();
						jQuery.post("/local_storage/store/", postData, function (data) {
							console.log(data);
						});
					}

					$("#primary_phone").on("blur", function () {
						
						var tmp, digits = '', entry = $.trim($(this).val());
						var regex = /\d+/g;
						while ((tmp = regex.exec(entry)) != null) {
							digits += tmp[0];
						}
						if (digits.length == 10) {
							savelead();
						}
					});
				});
			</script>
		</body>
	
	</html>

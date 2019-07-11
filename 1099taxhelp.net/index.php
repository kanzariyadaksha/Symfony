<?php
session_start();
$path = '/1099taxhelp/';
$state = null;
$hasExitPop = true;

require_once('includes/sess_form.php');

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

	$url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/index.php?' . http_build_query($data);
	
	header("Location: $url");
	exit;
}
$_SESSION['home'] = '/1099taxhelp';
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
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/favicon.png" type="image/ico" sizes="16x16">
	


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery.ui.touch-punch.js"></script>
	<script src="js/main.js"></script>
	
	<?php require_once('rideshare/includes/_scripts-header.php') ?>
</head>
<?php
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/android|avantgo|bb10|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|playbook|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            ?>
            <script type="text/javascript">
                $(function() {
                    $('html, body').animate({
                        scrollTop: $('#ckm_form').offset().top - 50
                    });
                    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                        var target = $(e.target).attr("href") // activated tab
                        $('html, body').animate({
                            scrollTop: $(target).offset().top - 50
                        });
                    });
                });
            </script>
        <?php } ?>
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
					<!-- <h2 class="title text-center">Are You Self-Employed? Get Tax Help Now!</h2> -->
					<h2 class="title text-center">Are You Self-Employed? Get Tax Debt Help Now!</h2>
					<div class="row justify-content-between align-items-center">
						
						<div class="col-lg-12 order-1">
							<!-- <h1 class="d-block d-sm-none"><span>Rideshare drivers…</span>Tax Help Is On The Way!</h1> -->
							<form class="row tax-form mx-auto step-1-open d-fkex align-content-center" id="ckm_form" action="/process/" name ="ckm_form" method="post">
<!-- 								<a name="top" id="userform"></a> -->
								<?php echo $formFields; ?>
								<input type="hidden" name="toVerify" id="toVerify" value="active"/>
								<input type="hidden" name="page" value="<?= $_SERVER['REQUEST_URI'] ?>" />
								<input type="hidden" name="cr_price" value="0.00" />
								<input id="leadid_token" name="universal_leadid" type="hidden" value=""/>
								<input type="hidden" id="TCPA_checkbox" checked="checked" name="TCPA_checkbox" value="checked"/>
								<input type="hidden" name="landing_page" id="landing_page" value="textdebt" />
								<input type="hidden" name="tax_debt" value="10000" id="tax_debt">
								<input type="hidden" name="employment_status" value="" id="employment_status">

								<div class="navbar d-none">
                                    <div class="navbar-inner">
                                        <ul class="nav nav-pills">
                                            <li class="active"><a href="#step-1" data-toggle="tab" data-step="1">Step 1</a></li>
                                            <li><a href="#step-2" data-toggle="tab" data-step="2">Step 2</a></li>
                                            <li><a href="#step-3" data-toggle="tab" data-step="3">Step 3</a></li>
                                            <li><a href="#step-4" data-toggle="tab" data-step="4">Step 4</a></li>
                                            <li><a href="#step-5" data-toggle="tab" data-step="5">Step 5</a></li>
                                            <li><a href="#step-6" data-toggle="tab" data-step="6">Step 6</a></li>
                                        </ul>
                                    </div>
                                </div>


								<div class="tab-content d-block w-100">
									<section id="step-1" class="tab-pane fade show active step step-1 active form-group col-12">
										<label class="form-title">See If You Qualify for a Fresh Start?</label>
										<label class="sub-title">What Type of Independent Contractor Are You?</label>
										<div class="row">
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-1 next step-2 other_chk" name="employment_type" value="1">
													Uber/Lyft/Postmates Driver
												</button>
											</div>
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-2 next other_chk" name="employment_type"  value="2" style="line-height: 27px;">
													Real Estate Agent / Insurance Agent
												</button>
											</div>
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-3 next other_chk" name="employment_type"  value="3">
													Artist / Graphic Designer
												</button>
											</div>
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-4 next other_chk" name="employment_type" value="4">
													Construction Worker
												</button>
											</div>
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-5 next other_chk" name="employment_type" value="5">
													Airbnb / VRBO
												</button>
											</div>
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-6 next other_chk" name="employment_type" value="6">
													Trucker
												</button>
											</div>
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-6 next other_chk" name="employment_type" value="7">
													Consultant
												</button>
											</div>
											
											<div class="col-sm-6">
												<button type="button" class="form-control tax_val option option-6 other_chk" name ="employment_type" value="8">
													Other
												</button>
											</div>
											
		                                    <div class="col-sm-12 checkbox other_type dis-none">
		                                        <input id="employment_type_other" name="employment_type_other" type="text" placeholder="Enter other Type" class="form-control">
		                                    </div>
		                                    <div class="col-sm-12 checkbox other_type dis-none">
		                                        <button type="button" class="form-control next d-inline-flex mx-auto first-step-btn" style="background-color: #5E98CB;">
													NEXT
												</button>
		                                    </div>
										</div>
										<div class="hint">
											Click Any Option to Continue
										</div>
										<div class="note">
											YOU MAY QUALIFY TO SUBSTANTIALLY LOWER YOUR TAX DEBT
										</div>
									</section>

									<section id="step-2" class="tab-pane fade step step-2 form-group col-12">
										<label class="form-title">See If You Qualify for a Fresh Start</label>
										<img class="step-img img-fluid" src="../images/step-2.png">
										<label class="sub-title">How Much In Unpaid Taxes Do You Owe?</label>
										<div class="row text-center">
											<div class="col-sm-12">
												<p class="price-picker">$10,000 - $19,999</p>
												<div class="range-slider">
													<div id="slider"></div>
													<input type="hidden" class="taxval">
													<div class="range-value">
														<span class="left-val">$0</span>
														<span class="right-val">$100k +</span>
													</div>
												</div>
												<button type="button" class="btn btn-primary next" data-toggle="tab" data-target="#step-3"><span>Next</span></button>
											</div>
										</div>
									</section>
									
									<section id="step-3" class="tab-pane fade step step-3 form-group col-12">
										<label class="form-title">See If You Qualify for a Fresh Start</label>
										<img class="step-img img-fluid" src="../images/step-3.png">
										<label class="sub-title">What state do you live in?</label>
										<div class="row">
											<div class="col-sm-12">
												<div class="selectbox">
													<?php if(isset($_REQUEST['state'])) { $state = strtoupper($_REQUEST['state']); }?>
													<select class="form-control" id="state" name="state">
														<option value="">Select Your State</option>
														<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/_states.php') ?>
													</select>
												</div>
												<button type="button" class="btn btn-primary next step-4"><span>Next</span></button>
											</div>
										</div>
									</section>

									<section id="step-4" class="tab-pane fade step step-4 form-group col-12">
										<label class="form-title">See If You Qualify for a Fresh Start</label>
										<img class="step-img img-fluid" src="../images/step-4.png">
										<label class="sub-title">Please enter your name</label>
										<div class="row">
											<div class="col-12">
												<input type="text" class="form-control checkmark-input" id="first_name" name="first_name" value=""  placeholder="First Name">
											</div>

											<div class="col-12">
												<input type="text" class="form-control checkmark-input" id="last_name" name="last_name"  value="" placeholder="Last Name">
											</div>
											<div class="col-12">
												<button type="button" class="btn btn-primary next step-5"><span>Next</span></button>
											</div>
										</div>
									</section>

									<section id="step-5" class="tab-pane  fade step step-5 form-group col-12">
										<label class="form-title">See If You Qualify for a Fresh Start</label>
										<img class="step-img img-fluid" src="../images/step-5.png">
										<label class="sub-title">What is your email address?</label>
										<input type="email" class="form-control checkmark-input" id="email_address" name="email_address" value="" placeholder="Email Address">
										<div class="emailCompailance hide_emailCompailance">
											<p>Privacy and Spam Protection</p>
											<div class="emailCheckbox">
												<label class="chkbox">Please send special offers from 1099 Tax Help and partners.
													<input type="checkbox" name="opt_special_offers" id="opt_special_offers" checked="checked">
													<span class="checkmark"></span>
												</label>
											</div>
										</div>
										<button type="button" class="btn btn-primary next step-6"><span>Next</span></button>
										
									</section>

									<section id="step-6" class="tab-pane  fade step step-6 form-group col-12">
										<label class="form-title">See If You Qualify for a Fresh Start </label>
										<img class="step-img img-fluid" src="../images/step-6.png">
										<label class="sub-title">What is your phone number?</label>
										<input type="tel" class="form-control checkmark-input" id="primary_phone" name="primary_phone" value="" placeholder="Phone Number">
										<button type="submit" class="btn btn-primary next"><span>submit</span></button>
										<div class="form-details">
											<div class="terms hide_terms">
												<?php include('includes/tcpa_without_checkbox.php'); ?>
											</div>
										</div>
									</section>
								</div>
								<div class="optin d-none">
									<input name="opt_in" id="opt_in" class="optin" type="checkbox" value="checked" checked="checked">
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
								<a class="click-to-call d-block" href="tel:<?php //echo str_replace(array("-", " ", "(", ")"), "", $tel); ?>"><?php //echo $tel ?></a>
							</section> -->
							
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
								If you are self-employed, you should receive a 1099 form every January. This paperwork is similar to a W-2 form sent by employers – it shows how much money you made in the tax year. Unlike W-2s employees, independent contractors (1099 employees) do not get any taxes taken out. No social security. No unemployment. No federal taxes. That being said, you still have to pay into these funds through something called Self-Employment Tax. That means that if you’re any type of 1099 employee, you might owe the IRS more than you expected. 
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
								<p>It’s not unusual for independent contractors to owe thousands in tax debt on April 15th. And most workers who are self-employed don’t have massive amounts of savings stashed away to pay their taxes. In fact, 46% of Americans live paycheck-to-paycheck. So, if you didn’t set aside 30% of your pay from your job, it’s understandable. You needed that money to live. But now you’re faced with un unexpected tax bill. 
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
							<h2><span>There’s Help for Independent Contractors with Tax Debt.</span>
								Still can’t pay?
							</h2>
							<div class="info-text">
								There are options for those who are self-employed facing tax debt. Tax experts can buy you more time. Tax professionals can help you file the paperwork for an offer-in-compromise, a partial pay installment agreement, or even an extension. Any of these actions can help you avoid additional late fees and penalties and help prevent levies or liens on your property. Don’t let your debt pile up. Let 1099 Tax Help assist you to find a tax expert that can alleviate your tax challenges in the gig economy. 
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
							<li class="list-inline-item"><a href="/terms.php" target="_blank">Terms of Use</a></li>
							<li class="list-inline-item"><a href="/privacy-policy.php" target="_blank">Privacy Policy</a></li>
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
							<p>Copyright © 2019. 1099taxhelp.net</p>
						</div>
					</div>
					<?php 
					include_once('submit_process_popup.php');
					require_once('rideshare/includes/_page_bottom.php'); ?>
					<?php $disableRetreaver = true; require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/_scripts-body.php') ?>

				</section>
				<?php require_once('rideshare/includes/_modal.php') ?>

				<script id="LeadiDscript" type="text/javascript">(function () {
					var s = document.createElement('script');
					s.id = 'LeadiDscript_campaign';
					s.type = 'text/javascript';
					s.async = true;
					s.src = (document.location.protocol + '//d1tprjo2w7krrh.cloudfront.net/campaign/583e8030-6ca1-2387-f3d7-11eedb8c4896.js');
					var LeadiDscript = document.getElementById('LeadiDscript');
					LeadiDscript.parentNode.insertBefore(s, LeadiDscript);
				})();</script>
				<noscript><img src='//create.leadid.com/noscript.png?lac=581e5a37-7a2c-a742-c313-6f515b2d3222&lck=583e8030-6ca1-2387-f3d7-11eedb8c4896' /></noscript>

				<script>
					var displayText = ["UNDER $7,500",
						"$7,500 - $9,999", "$10,000 - $19,999", "$20,000 - $49,999", "$50,000 - $99,999", "$100,000 OR MORE"];
					var taxVal = ["5000", "7500", "10000", "20000", "50000", "100000"];
					$("#slider").slider({
						min: 0,
						max: taxVal.length - 1,
						step: 1,
						slide: function(event, ui) {
							$(".price-picker").text(displayText[ui.value]);
							$("#tax_debt").val(taxVal[ui.value]);
						},
						create: function(event, ui) {
							$(this).slider('value', '2');
						}
					});
				</script>
				<script>

					$("body").on("click",".tax_val",function() {
					  $('#employment_status').val($(this).val());
					});

					$('#state').change(function(e) {
           			    $('#ckm_form').valid();
        			});

				   
			</script>
			<script type="text/javascript">
			    $(document).ready(function () {
			        $('.other_chk').click(function () {
			            var chkbox = $(this);
			            $('.other_type').toggle();
			       	});
			       
			 	});

			</script>
			<script type="text/javascript">
				$(document).ready(function(){

				$(".checkmark-input").focus(function() {
	                $(this).css('background-image', "url('images/active-check.png')");
	            });

				$('#state').on('keydown', function (e) {
                    if (e.which == 13) {
                        $('#step-3 .next').click();
                        e.preventDefault();
                    }
                });
                $('#step-4 input[type=text]').on('keydown', function (e) {
                    if (e.which == 13) {
                        $('#step-4 .next').click();
                        e.preventDefault();
                    }
                });
                $('#step-5 input[type=email]').on('keydown', function (e) {

                    if (e.which == 13) {
                        $('#step-5 .next').click();
                        e.preventDefault();
                    }
                });
                $('#step-6 input[type=tel]').on('keydown', function (e) {

                    if (e.which == 13) {
                        $("#ckm_form").submit();
                        e.preventDefault();
                    }
                });

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

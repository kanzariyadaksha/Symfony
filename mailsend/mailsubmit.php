<?php
	include './lib/MailChimp.php';
	use \DrewM\MailChimp\MailChimp;

	/*$api_key = "544aaf5166a7f15760f23ca2b89244d5-us20";
	$list_id = "714d1110cd";
	$MailChimp = new MailChimp('');
	use \DrewM\MailChimp\MailChimp;*/
$MailChimp = new MailChimp('544aaf5166a7f15760f23ca2b89244d5-us20');
$result = $MailChimp->get('lists');
echo "<pre>";
print_r($result);exit;
	if(isset($_POST['submit']))
	{
		$email=$_POST['email'];
		$list_id = 'b1234346';
		$result = $MailChimp->post("lists/$list_id/members", [
				'email_address' => $email,
				'status'        => 'subscribed',
			]);
		echo "<pre>";
		print_r($result);exit;
		if ($MailChimp->success()) {
			print_r($result);	
		} else {
			echo $MailChimp->getLastError();
		}
	}
?>
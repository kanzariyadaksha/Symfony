<?php
class EmailValidate{
	public $customer_id;
	public $api_url;
	public function __construct(){
		$this->api_url = 'https://personator.melissadata.net/v3/WEB/ContactVerify/doContactVerify';
		$this->customer_id = 'GKZi0xxpuMlCDnZ0dykQtS**';	
	}
	public function validate($email,$opt='VerifyMailBox:Express',$format='json'){
		/**
		* Initialize handle and set options
      		*/
                $return = array('status'=>'no','email'=>'','error'=>'');
		$this->api_url .='?t=&format=json&id='.$this->customer_id.'&act=Check,Verify&cols=&opt=&full=&comp=&a1=&a2=&lastline=&first=&last=&city=&state=&postal=&email='.$email.'&phone=&ctry=';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		if ( curl_errno($ch) ) {
			$return['error'] = 'ERROR -> ' . curl_errno($ch) . ': ' . curl_error($ch);
			return $return;
		} else {
			$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
			switch($returnCode){
				case 404:
					$return['error'] = 'ERROR -> 404 Not Found';
					return $return;
					break;
				default:
					break;
					
			}
		}
		curl_close($ch);
		$result = json_decode($response,true);
		if(isset($result['TransmissionResults']) && trim($result['TransmissionResults'])==''){
			$record = $result['Records'][0];
			$emailResults = explode(',',$record['Results']);
			if(in_array('ES01',$emailResults)){
				$return['status'] = 'yes';
				$return['email'] = $record['EmailAddress'];
				$return['results'] =$record['Results'];
                                return 'pass';
			}else{
				$return['error'] =$record['Results'];
			}
		}else{
			$return['error'] =$result['TransmissionResults'];
		}

		 return 'fail';
	}
}


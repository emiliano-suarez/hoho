<?php
namespace hoho\admin\lib;

use hoho\models as Models;

class Lib_Mailgun {
  
  public static function sendMailGun($mailToAddress, $messageSubject, $messageBody) {
	
		define('MAILGUN_API','https://api.mailgun.net/v2/mg.skiptee.com');
		define('MAILGUN_KEY','key-8b2db634d567935745da6fa07ef5c80c');
		

		#send mail:
		$result = self::send_mailgun($mailToAddress, $messageSubject, $messageBody,MAILGUN_KEY,MAILGUN_API);

		return $result;
  
 }


static function send_mailgun($emailTo, $messageSubject, $messageBody,$mailgunKey,$mailgunPath){
 
 	$emailTo = 'fernando.beck@gmail.com';
 
	$config = array();
 
	$config['api_key'] = $mailgunKey;
 
	$config['api_url'] = $mailgunPath . "/messages";
 
	$message = array();
 
	$message['from'] = "Hoho <noreply@hoho.ly>";
 
	$message['to'] = $emailTo;
 
	$message['h:Reply-To'] = "noreply@hoho.ly";
 
	$message['subject'] = $messageSubject;
 
$message['html'] = $messageBody;
 		
	$ch = curl_init();
 
	curl_setopt($ch, CURLOPT_URL, $config['api_url']);
 
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
	curl_setopt($ch, CURLOPT_USERPWD, "api:{$config['api_key']}");
 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 
	curl_setopt($ch, CURLOPT_POST, true); 
 
	curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
 
	$result = curl_exec($ch);
 
	curl_close($ch);
 
	return $result;
 }

}


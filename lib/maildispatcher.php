<?php
namespace hoho\admin\lib;

use hoho\models as Models;

class Lib_MailDispatcher {
  
  public static function send($mailTag, $mailToAddress, $params = null) {
  
    $template = Models\Models_MailTemplate::getByTag($mailTag);
    if ($template->loaded) {

	  $vars = array(
		  "%params%"   => $params['key'],
		  "%firstname%" => $params['firstName'],
	  );

    
      //TODO: Dynamic replacing of params, not needed for the moment
      $mail = new Models\Models_Mail();
      $mail->to = $mailToAddress;
      $mail->subject = $template->subject;
      $mail->body = $template->body;
      $mail->tag = $template->tag;
      $mail->from = ADMIN_EMAIL;
      $mail->startDate = date('Y-m-d H:i:s');

      return $mail->save();
    } else {
      return false;
    }
  }

}
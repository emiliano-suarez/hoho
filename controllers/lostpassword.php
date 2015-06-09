<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;
use hoho\admin\lib as Lib;

class Controllers_Lostpassword extends Controllers_AdminBase {


  /**
  * @function: lostpassword
  * @goal: show lostpassword form to type email
  */

  public function lostpassword($params) {
	
    $viewName = "user/lostpassword";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Lost Password";

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
  
  /**
  * @function: sendemail
  * @goal: retrieve email and create password hash + send email to user
  */

  public function sendemail($params) {

	  
    if ((!isset($params['txtEmail'])) || ($params['txtEmail'] =='')){
    	$isValid = false;
			$result = array('result' => 'Error', 'message' => 'We couldnt find that email');
	    $this->response->setResponseCode("200");
  	  $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    	$this->response->setBody(json_encode($result));  
    	exit;
    }
    
    #get params from sign-up form:  
	  $txtEmailAddress = $params['txtEmail'];

    //Check current email exists and is active:
		$currentUser = Models\Models_User::getByEmail($txtEmailAddress);
    
    if ($currentUser != null){
    		//create new hash for the email:: email + hash_key + date(now)
    		$currentDate= date("Y-m-d H:i:s");
    		$newHashKey = sha1(HASH_KEY . $txtEmailAddress . $currentDate);
    		
    		//create new lost-password model:
    		$newRequest = Models\Models_LostPassword::getByEmail($txtEmailAddress);
    
				$newRequest->userId					= $currentUser[0]->id;
				$newRequest->requestHash		= $newHashKey;
				$newRequest->requestStatus	=	'Pending';
				$newRequest->requestTimeStamp=$currentDate;
				$newRequest->requestEmail		= $txtEmailAddress;
				
				
				#create request
				$saved = $newRequest->save();
				if ($saved) {
					#send lost password email 
					#url key :: e=fernando.beck@gmail.com&h=b564dfd0ee1cf9457514eaabe2fe472b57493fab
					$urlKey = "e=" . $txtEmailAddress . "&h=" . $newHashKey;
					$emailSent = self::sendMail('lostpassword', $txtEmailAddress, array('firstName' => $currentUser[0]->firstName, 'key' => $urlKey));
					
					$result = array('result' => 'OK', 'redirectUrl' => '/lostpassword/received');
						
				} else {
					$result = array('result' => 'Error', 'message' => 'Internal Error :: Password reset not created!');
				}
	  } 
	   else {
	   	$result = array('result' => 'Error', 'message' => 'Internal Error :: Password reset not created!');
	  }
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  

	}  


  /**
  * @function: received
  * @goal: shows form with message "your email was sent"
  */
 public function received($params){
    $viewName = "user/resetpasswordsent";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Reset Password";


    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render()); 
 
 }


  /**
  * @function: resetemail
  * @goal: receives the hashedlink, confirm it's good and shows form to type in new password
  */
 public function resetemail($params){
 
    $viewName = "user/resetpassword";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Reset Password";


	  $isValid = true;
	  
		if ((!isset($params['e'])) || (!isset($params['h']))){
	    $isValid = false;		
		}
		
		if ($isValid){
			#get params from sign-up form:
			$txtEmailAddress = $params['e'];
			$txtHashedLink	 = $params['h'];

			//get data from DB
			$newRequest = Models\Models_LostPassword::getByHash($txtEmailAddress, $txtHashedLink);
		
			if ($newRequest->id != null){
					//create new hash for the email:: email + hash_key + date(now)
					$originalHash = sha1(HASH_KEY . $txtEmailAddress . $newRequest->requestTimeStamp);
					if ($originalHash == $txtHashedLink){
						$isValid = true;
					}
			} else {
				$isValid = false;
			}
		}

	  $view->showForm = $isValid;
		if ($isValid) {			  
		  $view->email		= $txtEmailAddress;
		  $view->reqId		= $newRequest->id;
		}
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render()); 
 
 }
 

  /**
  * @function: resetpassword
  * @goal: changes password in db & closes request reset
  */
 public function resetpassword($params){

    $isValid = false;

    if ((!isset($params['txtEmail'])) || ($params['txtPwd'] =='')|| ($params['txtReqId'] =='')){
    	$isValid = false;
			$result = array('result' => 'Error', 'message' => 'We couldnt find that email');			
	    $this->response->setResponseCode("200");
  	  $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    	$this->response->setBody(json_encode($result));  
    	exit;
    }

    #get params from sign-up form:
    $txtEmailAddress = $params['txtEmail'];
    $newPassword		 = $params['txtPwd'];
    $requestId			 = $params['txtReqId'];

    //get data from DB
		$newRequest = Models\Models_LostPassword::getByPk($requestId);
    
    if ($newRequest != null){
    		//confirm password change in db
    		$currentUser = Models\Models_User::getByEmail($txtEmailAddress);
    		
    		if ($currentUser != null){
    				$currentUser[0]->passwordHash = sha1($newPassword);
    				if ($currentUser[0]->save()){
    				
    					$newRequest->requestStatus = 'Processed';
    					$newRequest->save();
    					
    					$isValid = true;
    				}
				}
	  }

		if ($isValid){	  
			$result = array('result' => 'OK', 'redirectUrl' => '/lostpassword/confirmreset');						
		} else {
			$result = array('result' => 'Error', 'message' => 'Internal Error :: Password reset not created!');
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
 
 } 
  

  function sendMail($mailTag, $mailToAddress, $params = null) {
  
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
      $message = strtr($template->body, $vars);      
      $mail->body = $message;      
      $mail->tag = $template->tag;
      $mail->from = ADMIN_EMAIL;
      $mail->startDate = date('Y-m-d H:i:s');

      return $mail->save();
    } else {
      return false;
    }
  }

  /**
  * @function: confirmreset
  * @goal: show result of process
  */

  public function confirmreset($params) {
	
    $viewName = "user/confirmreset";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Lost Password";

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

}

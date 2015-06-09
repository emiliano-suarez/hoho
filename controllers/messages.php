<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;

class Controllers_Messages extends Controllers_AdminBase {

  /**
  * @function: home
  * @goal: list all messages from user
  */

  public function home($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "messages/home";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: My Account :: My Messages";

		$userId = $_SESSION['userId'];

		#get all messages
 	  $msgsInfo = Models\Models_Messages::listAllByUserId($userId);
 	  
 	  if (empty($msgsInfo))
 	  	$view->hasInfo = false;
 	  else
 	  	$view->hasInfo = true;
 	  	
 	  $view->allMessages	 = $msgsInfo;
 	  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

  /**
  * @function: view
  * @goal: view full message
  */

  public function view($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

		$isValid = true;
		if ((!isset($params['msgid'])) || (trim($params['msgid']==''))){
			$isValid = false;
		}
		
	
    $viewName = "messages/view";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: My Account :: My Messages";

		$userId 	= $_SESSION['userId'];
		
		if ($isValid){
			#get current messages
			$msgInfo = Models\Models_Messages::getByPk($params['msgid']);

		 	  
			if ($msgInfo->id == null)
				$view->hasInfo = false;
			else {
				$view->hasInfo = true;
				$view->msgInfo	 = $msgInfo;
			}
			
		} else {
			$view->hasInfo = false;
		}
 	  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }


  
}

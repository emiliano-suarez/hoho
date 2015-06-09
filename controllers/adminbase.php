<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\services as Services;

class Controllers_AdminBase extends Fwk\controller {
	protected $pageSize = PAGINATION; 
public static function initialize($params = null) {
	 #only start session if it's not started:
		 if(!isset($_SESSION)) {
			 session_start();
		 }
		return true;
 }


  protected function _isAllowed($isAjax = false) {
// if ((!isset($_SESSION)) || ((isset($_SESSION['isLoggedIn']))  && (! $_SESSION['isLoggedIn']))){
if (!isset($_SESSION['isLoggedIn'])){
      if (! $isAjax) {
        $this->response->setResponseCode("302");
        #$this->response->setHeader("Location", "/login?&returnTo=".urlencode($_SERVER['REQUEST_URI']));
        $this->response->setHeader("Location", "/#login");
      } else {
        $this->response->setResponseCode("200");
        $this->response->setHeader("Content-Type", "text/json; charset=utf-8");
        $this->response->setBody(json_encode(array('result' => 'error', 'errors' => _('User not logged In'))));
      }
      return false;
    }
    return true;
  }

}

<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;

class Controllers_login extends Controllers_AdminBase {


 /*
  	goal: login user form
  */
  public function login($params) {
    if (isset($_SESSION['userId']) && ($_SESSION['userId'])) {
      //If the user is logged in just redirect to the Dashboard
      $this->response->setResponseCode("302");
      $this->response->setHeader("Location", "/user/myaccount");
    }
  
    $viewName = "user/login";
    $view = new Fwk\View($viewName);
    $view->setMasterView('generic');    
    
    if (isset($params['returnTo'])) {
      $view->targetUrl = $params['returnTo'];
    } else {
      $view->targetUrl = '';
    }
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());    
  }
  
  /**
  * @goal: login user action
  */
  public function dologin($params){

    #get params from login form
    $userEmail    = $params['txtEmail'];
    $userPassword = $params['txtPassword'];
    $returnTo     = $params['returnTo'];

    #To Do :: validate email & password not empty

    $isValid = true;

    if ($isValid) {
      $user =  Models\Models_Login::getUserByEmail($userEmail);

      // Check if a login through LinkedIn
      $linkedIn = isset($params['linkedIn']) ? $params['linkedIn'] : false;
      if ($linkedIn) {
        // Use the token to get user information (and login)
        $logIn = self::doLinkedInLogin($userEmail);
      } else {
        if (($user != null) && ($user[0]['PASSWORD'] == sha1($userPassword))) {
          $logIn = true;
        } else {
          $logIn = false;
        }
      }
      //redirect response to right place  
      if ($logIn) {  //login OK
        session_unset();
        session_destroy();
        session_start();

        
        $_SESSION['userId']     = $user[0]['ID'];
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['firstName'] 	= $user[0]['FIRST_NAME'];
        $_SESSION['lastName']	  = $user[0]['LAST_NAME'];

				//get companies related to this user profile:
				$companies = Models\Models_Company::allCompaniesFromUserId($_SESSION['userId']);
				$arrCompany = array();
				$c = 0;
				foreach ($companies as $company){
					$arrCompany[$c]['id'] 	= $company->id;
					$arrCompany[$c]['name']	= $company->companyName;
					$arrCompany[$c]['logo']	= $company->logoUrl;
					$c++;
				}
				
				$_SESSION['companies']		= $arrCompany;
				
        if ($returnTo == '') {
          $returnTo = '/user/myaccount';
        }
        
        $result = array('result' => 'OK', 'redirectUrl' => $returnTo);


      } else { // bad login, back to form
        $result = array('result' => 'Error', 'message' => _('Incorrect email or password, please try again.'));
      }
    } else {
      $result = array('result' => 'Error', 'message' => 'Error Logging In!');
    }

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
  }
  
  /**
  * @goal: logout user action
  */  
  public  function logout()
  {
    if (isset($_SESSION['isLoggedIn']))
    {
      session_unset();
      session_destroy();
    }
    header("Location: /");
  }  

    public function doLinkedInLogin($email) {
        $user = Models\Models_LinkedIn::getUserByEmail($email);

        if ( ! empty($user)) {
            $token = Models\Models_LinkedIn::getTokenByEmailId($user['EMAIL_ID']);
        }

        if (empty($token)) {
            return false;
        } else {
            // Check token expiration date
            if ($token[0]['EXPIRATION_DATE'] < time()) {
                return false;
            } else {
                $accessToken = $token[0]['TOKEN'];
                // Valid token. Ask for info
                $linkedInUser = Models\Models_LinkedIn::getLinkedInUserInfo($accessToken);
                return ( ! empty($linkedInUser) ) ? true : false;
            }
        }
    }
}

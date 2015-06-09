<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;

class Controllers_Signup extends Controllers_AdminBase {


  /**
  * @function: signup
  * @goal: show signup as new user form
  */

  public function signup($params) {
	
    $viewName = "signup/index";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Sign Up";

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
  
  /**
  * @function: adduser
  * @goal: signup new user
  */

  public function adduser($params) {
	
	/*  To Do:
			--  validate form fields are not empty
			--  validate email is valid & unique

    $validation = $this->validateUser($params);
    
    if (! $validation->valid) {
      
      $result = array('result' => 'Error', 'message' => 'Found some data errors: ', 'detail' => $validaton->errors);

      $this->response->setResponseCode("200");
      $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
      $this->response->setBody(json_encode($result));
      return;
    }
   */
    
    #get params from sign-up form:
    $txtFirstName    = $params['firstname'];
    $txtLastName     = $params['lastname'];
    $txtEmailAddress = $params['email'];
    //$txtCompany      = $params['company'];
    $txtPwd          = $params['pass1'];


		//check if this email is already in use
		$emailExists = Models\Models_User::getUserByEmail($txtEmailAddress);
		if ($emailExists == null) { //ok to continue if null only

			 //Create a new User Mode
			 $newUser = new Models\Models_User();
		
			 //Set values for the model
			 $newUser->passwordHash = sha1($txtPwd);
			 $newUser->email				 = $txtEmailAddress;
			 $newUser->firstName    = $txtFirstName;
			 $newUser->lastName     = $txtLastName;
			 $newUser->createdAt    = date('Y-m-d H:i:s');
			 $newUser->userStatus   = 'Active';
			 //$newUser->companyName  = $txtCompany;


			 #create new user
			 $saved = $newUser->save();
			 if ($saved) {
					 $newEmail = Models\Models_User::addNewEmail($txtEmailAddress);
					 if ($newEmail){
						 $userEmailAdd = Models\Models_User::addNewUserEmail($saved, $newEmail,1);							 
						 if ($userEmailAdd) {
							 $isValid = true;
					
						 }
					 } //new email added
		
				 #send welcome email 
				 //$emailSent = \lib\MailDispatcher::send('welcome', $txtEmailAddress, array('name' => $txtFirstName));
				 $result = array('result' => 'OK', 'redirectUrl' => '/user/welcome');
			
				 #Set User Session
				 $_SESSION['username']   = $newUser->firstName.' '.$newUser->lastName;
				 $_SESSION['userId']     = $newUser->id;
				 $_SESSION['userEmail']  = $txtEmailAddress;
				 $_SESSION['isLoggedIn'] = true;
			
			 } else {
				 $result = array('result' => 'Error', 'message' => 'Error :: User could not be created!');
			 }
		} else {
				$result = array('result' => 'Error', 'message' => 'Can not signup :: Email already in use!');
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  

	}  



}

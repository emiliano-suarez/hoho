<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;

class Controllers_user extends Controllers_AdminBase {

  /**
  * @function: welcome
  * @goal: show screen with welcome message
  */

  public function welcome($params) {
	
    $viewName = "user/welcome";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: Welcome!";


    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

  public function index($params) {
	
    $viewName = "user/index";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho :: User Management";
 	  $view->segments = Models\Models_Segment::listAll();

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

  public function myaccount($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "user/myaccount";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho :: User Management";


    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
  
  public function personalinfo($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "user/personalinfo";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho :: My Personal Info";

		//get user data
		$userId = $_SESSION['userId'];
		$currentUser = Models\Models_User::getByPk($userId);

		$view->userInfo = $currentUser;


    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }  
  
  public function updatepersonalinfo($params){
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

		$firstname = $params['firstname'];
		$lastname  = $params['lastname'];
		$photo		 = $params['photo'];
		$whatido	 = $params['whatido'];
		$bio			 = $params['bio'];
		
		//get user data
		$userId = $_SESSION['userId'];
		$currentUser = Models\Models_User::getByPk($userId);
		
		$currentUser->photoUrl = $photo;
		$currentUser->whatIDo	 = $whatido;
		$currentUser->bio			 = $bio;

		if ($currentUser->save()){
				$result = array('result' => 'OK', 'redirectUrl' => '/user/myaccount');
		} else {
				$result = array('result' => 'Error', 'message' => 'Error trying to update...');
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
  
  }


  /**
  * @function: company
  * @goal: show screen main menu for company profiles
  */

  public function company($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "user/company";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: My Companies";

		$userId = $_SESSION['userId'];
		 $userCompanies = Models\Models_User::listCompaniesByUserId($userId);
		$view->companies = $userCompanies;

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

  public function extendedsettings($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "user/extendedsettings";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho :: My Personal Info :: Extended Settings";

		//get user data
		$userId = $_SESSION['userId'];
		$currentUser = Models\Models_User::getByPk($userId);

		$view->userInfo = $currentUser;
		
		//Education
		$view->infoEducation = unserialize($currentUser->arrEducation);
		
		//Experience
		$view->infoExperience = unserialize($currentUser->arrExperience);

		//Links
		$view->infoLinks = unserialize($currentUser->arrLinks);		

		//Locations
		$view->infoLocations = unserialize($currentUser->arrLocations);		

		//Skills
		$view->infoSkills = unserialize($currentUser->arrSkills);				

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }  
    
  
  public function updatedextendedsettings($params){
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

		$education = $params['education'];
		//$experience  = $params['experience'];
		$links		 = $params['links'];
		$locations	 = $params['locations'];
		$skills	 = $params['skills'];

		
		//get user data
		$userId = $_SESSION['userId'];
		$currentUser = Models\Models_User::getByPk($userId);
		
		//on each attribute we have many lines, one element per line
		$arrayEducation = explode("\n", $education);
		//$arrayExperience = explode("\n", $experience);
		$arrayLinks = explode("\n", $links);
		$arrayLocations = explode("\n", $locations);
		$arraySkils = explode("\n", $skills);								
		
		$currentUser->arrEducation = serialize($arrayEducation);
		//$currentUser->arrExperience= serialize($arrayExperience);
		$currentUser->arrLinks		 = serialize($arrayLinks);
		$currentUser->arrLocations	 = serialize($arrayLocations);
		$currentUser->arrSkills		 = serialize($arraySkils);

		if ($currentUser->save()){
				$result = array('result' => 'OK', 'redirectUrl' => '/user/myaccount');
		} else {
				$result = array('result' => 'Error', 'message' => 'Error trying to update...');
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
  
  }  

  public function experiencesettings($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "user/experiencesettings";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho :: My Personal Info :: Experience Settings";

		//get user data
		$userId = $_SESSION['userId'];
		$currentUser = Models\Models_User::getByPk($userId);

		$view->userInfo = $currentUser;
		
		
		//Experience
		$view->infoExperience = unserialize($currentUser->arrExperience);

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  } 

  public function addnewposition($params){
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

		$companyName = $params['companyName'];
		$jobTitle  = $params['jobTitle'];
		$jobDescription		 = $params['jobDescription'];
		$month_from	 = $params['month_from'];
		$month_to	 = $params['month_to'];
		$year_from	 = $params['year_from'];
		$year_to	 = $params['year_to'];				

		//get user data
		$userId = $_SESSION['userId'];
		$currentUser = Models\Models_User::getByPk($userId);
		
		//Convert Month Number to Name:
		$dateObj   = \DateTime::createFromFormat('!m', $month_from);
		$monthNameFrom = $dateObj->format('F');

		$dateObj   = \DateTime::createFromFormat('!m', $month_to);
		$monthNameTo = $dateObj->format('F');
		
		//create array with data:
		$arrData = array(
		'companyName' => $companyName,
		'jobTitle'		=> $jobTitle,
		'jobDescription'=>$jobDescription,
		'month_from'	=> $monthNameFrom,
		'year_from' 	=> $year_from,
		'month_to'		=> $monthNameTo,
		'year_to'			=> $year_to
		);
		
		$currentExperience = unserialize($currentUser->arrExperience);
		$currentExperience[] = $arrData;
		
		$currentUser->arrExperience= serialize($currentExperience);

		if ($currentUser->save()){
				$result = array('result' => 'OK', 'redirectUrl' => '/user/myaccount');
		} else {
				$result = array('result' => 'Error', 'message' => 'Error trying to update...');
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
  
  }  


  
  /**
  * @function: contact
  * @goal: show form, send message to other user
  */

  public function contact($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "user/contact";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: Send Message";


    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }  

  /**
  * @function: sendcontact  
  * @goal: send direct contact message
  */

  public function sendcontact ($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
		$isValid = true;
    $viewName = "user/sendcontact";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Send Direct Message";
	  
		if (!isset($params['txtName'])){
	    $isValid = false;		
		}
		
		if ($isValid){
			$isValid = false;
			#send message to destination user
			$destinationUser = $params['txtName'];

			//get user data:
			$user = Models\Models_User::getByEmail($txtName);
			if ($user != null){
					//create new direct message
						$newMsg = new Models\Models_Messages();
					  $newMsg->parentId = 0;
						$newMsg->fromId	  = $_SESSION['userId'];
						$newMsg->toId			= $user->id;
						$newMsg->subject	= 'test-subj';
						$newMsg->messageBody='test-body'; 
						if ($newMsg->save()){
							$isValid = true;
						}
			}
		}

	  $view->showForm = $isValid;
		if ($isValid) {			  
		  $view->displayMessage = "Message Sent!";
		} else {
			$view->displayMessage = "Unable to send message... sorry.";
		}
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());	
	}
  
  
  /*
  	shows page with form to send direct message to user
  */
  public function senddirect ($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
		$isValid = true;
    $viewName = "user/sendmessage";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Send Direct Message";
	  
		if (!isset($params['uid'])){
	    $isValid = false;		
		}
		
		if ($isValid){
			$isValid = false;
			#send message to destination user
			$destinationUser = $params['uid'];

			//get user data:
			$user = Models\Models_User::getByPk($destinationUser);
			if ($user != null){
					$view->userName = $user->firstName;
					$view->userId = $destinationUser;
			}
		}

	  $view->showForm = $isValid;
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());	
	}  

/*
	send message to user (execute action)
*/

  public function sendMsgDo($params){
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

		$msgBody = $params['msgBody'];
		$destinationUserId  = $params['destId'];

		//get sender's user data
		$senderData = Models\Models_User::getByPk($_SESSION['userId']);
		
		//get target user data
		$targetData = Models\Models_User::getByPk($destinationUserId);
		
			if ($targetData != null){
					//create new direct message
					// name=sender's name
					// params=message body
					$emailSent = self::sendMail('directmessage', $targetData->email, array('firstName' => $senderData->firstName, 'body' => $msgBody));
					$isValid = true;

			}

		if ($isValid){
				$result = array('result' => 'OK', 'redirectUrl' => '/user/myaccount');
		} else {
				$result = array('result' => 'Error', 'message' => 'Error trying to send...');
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
  
  }  

  function sendMail($mailTag, $mailToAddress, $params = null) {
  
    $template = Models\Models_MailTemplate::getByTag($mailTag);
    if ($template->loaded) {

	  $vars = array(
		  "%params%"   => $params['body'],
		  "%name%" => $params['firstName'],
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


/*
viewprofile: view user profile
*/
	public function viewprofile($params){
	
		if (isset($_SESSION['userId']))
			$userId = $_SESSION['userId'];
		else 
			$userId = 0;
		
		if ((!isset($params['uid'])) || (trim($params['uid']=='')))
			$isValid = false;
		else {
		
			$userProfileId = $params['uid'];	
			$userProfile = Models\Models_User::getUserById($userProfileId);
			if ($userProfile != null){
				$isValid 			= true;
				$isOwner 			= false;
				$isFollowing 	= false;
				
				if ($userId > 0) { // the person viewing this profile is logged in
					if ($userProfileId == $userId){ // the person viewing this profile is the profile owner
						$isOwner = true;
					}	else {
						//not the owner, verify if is following:
						$userFollowingUser = Models\Models_User::getFollowerFromUserId($userId, $userProfileId);
						if ($userFollowingUser[0]['TOTAL'] == 1){									
							$isFollowing = true;
						}
					}				
				}		else {
					$isValid = false;
				}	
				
			 //load full user profile
			 #$profileInfo = Models\Models_Assets::listAllByCompanyId($companyId);
			 
			 //load founders + photos for this company
			 #$foundersInfo=Models\Models_Company::getCompanyFoundersById($companyId);	

			 //load total followers:
			 $totalFollowers = Models\Models_User::getAllFollowers($userId);
			 $totalFollowing = Models\Models_User::getAllFollowing($userId);

			}
		}	
	
		if (!$isValid){
				$viewName = "profile/notvalid";
				$view = new Fwk\view($viewName);
				$view->setMasterView('generic');
				$view->pageTitle = "hoho: Invalid Request";
				$view->displayMessage	= "The requested user profile is not valid";
				$view->backUrl = "/user/myaccount";

		} else {
		
			 $viewName = "profile/viewuser";		
			 $view = new Fwk\view($viewName);
			 $view->setMasterView('generic');
			 $view->pageTitle = "hoho: User Pofile";
			 $view->userInfo = $userProfile[0];
			 $view->userId 	 = $userProfileId;
			 $view->isProfileOwner = $isOwner;
			 $view->isFollowing		 = $isFollowing;
			 $view->totalFollowers = $totalFollowers['totalFound'];
			 $view->allFollowers	 = $totalFollowers['results'];	
			 $view->totalFollowing = $totalFollowing['totalFound'];
			 $view->allFollowing	 = $totalFollowing['results'];
			 
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
	
	}

	public function addfollow($params){

		$isValid = true;
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      $isValid = false;
    }
    
		if ((!isset($params['fromid'])) || ($params['fromid']=='')){
				$isValid = false;
		}

		if ((!isset($params['toid'])) || ($params['toid']=='')){
				$isValid = false;
		}

    $userId   = $_SESSION['userId'];

		if ($params['fromid'] != $userId){
			$isValid = false;
		}
		
		if ($isValid){
			 $add = Models\Models_User::addFollower($params['toid'], $userId);
			 $result = array('result' => 'OK', 'message' => 'you are now a follower!');
		
		} else {
			$result = array('result' => 'Error', 'message' => 'Error trying to follow this company...');
		}
  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
	}

	public function removefollow($params){

		$isValid = true;
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      $isValid = false;
    }
    
		if ((!isset($params['fromid'])) || ($params['fromid']=='')){
				$isValid = false;
		}

		if ((!isset($params['toid'])) || ($params['toid']=='')){
				$isValid = false;
		}

    $userId   = $_SESSION['userId'];

		if ($params['fromid'] != $userId){
			$isValid = false;
		}
		
		if ($isValid){
			 $add = Models\Models_User::removeFollower($params['toid'], $userId);
			 $result = array('result' => 'OK', 'message' => 'you are not longer a follower!');
		
		} else {
			$result = array('result' => 'Error', 'message' => 'Error trying to unfollow this company...');
		}
  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
	}  
}

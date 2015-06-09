<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;

require_once($_SERVER["DOCUMENT_ROOT"]."/config/filesconf.php");

class Controllers_Profile extends Controllers_AdminBase {

  /**
  * @function: profile
  * @goal: initial step, enter name and company profile to clame
  */
  public function profile($params) {
	
    $viewName = "profile/index";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: Claim Your Personal Profile";
		
		$_SESSION['profileProcessFlag'] = "1";

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

	/**
		function: startclaim
		goal: get name & company, send email with link to verify
	*/
  public function startclaim($params) {

		$viewName = "profile/claim";
		$view = new Fwk\view($viewName);
		$view->setMasterView('generic');
		$view->pageTitle = "hoho :: Claim Profile Step 1";

		$isValid = true;
		
  	if (!isset($params['txtFirstName']) || (!isset($params['txtCompany']))){	  
  		$isValid = false;
  	}
  		  	
  	if ($isValid){
  			$isValid = false;
				$profileFirstName = $params['txtFirstName'];
				$profileLastName 	= $params['txtLastName'];				
				$profileCompany		= $params['txtCompany'];

				$profileInfo = Models\Models_Profile::getCompanyByName($profileCompany);

				if ($profileInfo[0]){
						//company profile exists: display founders 
						$allFounders = unserialize($profileInfo[0]->founders);
						$view->founders 		= $allFounders;	
						$view->totalFounders=count($allFounders);
						
						#extract company URL from contact Details info:
						$nodesInContact = count($profileInfo[0]->contactDetails);
						if ($nodesInContact > 0){
							$companyUrl = $profileInfo[0]->contactDetails[$nodesInContact-1];
						
							$companyUrl = str_replace("http://www.","",$companyUrl);			
							$companyUrl = str_replace("http://","",$companyUrl);									
							$view->companyEmail  = $companyUrl;

							$_SESSION['claimInfo'] = array($profileFirstName, $profileLastName, $profileCompany, $view->companyEmail);
							$_SESSION['profileProcessFlag'] = "1";

							$view->hasInfo = true;
							
						} else {
							$view->hasInfo = false;
						}						
						
				} else {
					$view->hasInfo = false;
				}

		}
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
  
/*
	function : processclaim
	get confirmation on which name was selected, and send the email with link
*/  
  
	public function processclaim($params){
		$viewName = "profile/claimsent";
		$view = new Fwk\view($viewName);
		$view->setMasterView('generic');
		$view->pageTitle = "hoho :: Claim Profile Step 2";


		$isValid = true;
		
    if ($_SESSION['profileProcessFlag'] != "1"){
  		$isValid = false;
  	}

		if ((!isset($params['sName'])) || ($params['sName']=='')){
  		$isValid = false;  	
  	}
  		  	
  	if ($isValid){
  			#retrieve data from selected founder profile:
  			$selectedName	= $params['sName'];
  			$profileInfo = Models\Models_Founder::getByPk($selectedName);
  			
  			if ($profileInfo !=null){
						
						$profileId = $profileInfo->id;
						$arrayInfo = $_SESSION['fullResults'];
						$found  	 = false;
						$c				 = 0;
						while ((!$found) && ($c < count($arrayInfo))){
						 if ($arrayInfo[$c]->id == $profileId){
							 $found = true;
							 $fIndex= $c;
						 } else {
							 $c++;
						 }
						}
						
						 #get data ready to create email:
						 $firstLastName = explode (' ', $profileInfo->founderName);
						 $arrNames 			= self::getNames($firstLastName);
						 						 
						 $profileFirstName  = $arrNames['first']; //$_SESSION['claimInfo'][0];
						 $profileLastName 	= $arrNames['last'];  //$_SESSION['claimInfo'][1];
						 
						 #get company email
						 $profileCompany		= $arrayInfo[$fIndex]->companyName; //$_SESSION['claimInfo'][2];
						 $companyEmail			= $arrayInfo[$fIndex]->companyEmail; //$_SESSION['claimInfo'][3];
				
				
						 $claimEmailAddress = strtolower($profileFirstName . "@" . $companyEmail);
						 
 
						 //create new hash for the email:: email + hash_key + date(now)
						 $currentDate= date("Y-m-d H:i:s");
						 $newHashKey = sha1(HASH_KEY . $claimEmailAddress . $currentDate);
 
						 //create new claim Request model:
						 $newRequest = Models\Models_ClaimRequest::getByEmail($claimEmailAddress);

						 $newRequest->requestHash				=	$newHashKey;
						 $newRequest->requestStatus			=	'Pending';
						 $newRequest->requestTimeStamp		=	$currentDate;
						 $newRequest->requestEmail				= $claimEmailAddress;
						 $newRequest->requestCompany			= $profileCompany;	
						 $newRequest->investorId					=	$selectedName;
						 $newRequest->investorContactName = "";			
						 if (isset($_SESSION['userId'])){
						 		$newRequest->userId = $_SESSION['userId'];
						 }	else{
						 		$newRequest->userId = null;
						 }
 
						 #create request
						 $saved = $newRequest->save();
						 if ($saved) {
							 #send claim company profile email 
							 #url key :: e=fernando.beck@gmail.com&h=b564dfd0ee1cf9457514eaabe2fe472b57493fab&company=mycompany
							 $urlKey = "e=" . $claimEmailAddress . "&h=" . $newHashKey . "&c=" . $profileCompany;
							 $emailSent = self::sendMail('claimcompany', $claimEmailAddress, array('firstName' => $profileFirstName, 'key' => $urlKey));
					
							 $_SESSION['profileProcessFlag'] = "0";
							 $isValid = true;
						 }

				 } else {
				 		$isValid = false;
				 }
		}
		
		if ($isValid) {
			$view->displayMessage = "Please check your Inbox and look for our email, click on the link to continue!";
		} else {
			$view->displayMessage = "<b> Can not proceed, the claim request is not valid.";		
		}
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());	
	}
	
/*
function: confirmAction
goal		: receive email confirmation for profile claim and create profile in database
*/	
	
	public function confirmaction($params){
	
		$isValid = true;
    $viewName = "profile/confirmclaim";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "Hoho: Claim Profile";
	  
		if (!isset($params['e']) || (!isset($params['c'])) || (!isset($params['h']))){
	    $isValid = false;		
		}
		
		if ($isValid){
			$isValid = false;
			$currentDate= date("Y-m-d H:i:s");
			
			#get params from email:
			$txtEmailAddress = $params['e'];
			$txtHashedLink	 = $params['h'];
			$txtCompany			 = $params['c'];

			//get data from DB
			$newRequest = Models\Models_ClaimRequest::getByHash($txtEmailAddress, $txtHashedLink, $txtCompany);
		
			if ($newRequest != null){
					//verify hash for the email:: email + hash_key + date(now)
					$originalHash = sha1(HASH_KEY . $txtEmailAddress . $newRequest->requestTimeStamp);
					if ($newRequest->requestHash == $txtHashedLink){
						$isValid 		= true;
						$isNewUser	= false;
						
						#get user profile from founders table:
						$founder = Models\Models_Founder::getFounderById($newRequest->investorId);
						
						#check if founder-profile already exists as user
						$userAccount = Models\Models_User::getUserByEmail($newRequest->requestEmail);
						
						if ($userAccount == null){ //this email is not registered yet, so we need to create profile

							 $isValid = false;
							 $newUsr = new Models\Models_User();
								
								//split Founder Name
							 $fullName = Helpers\Helpers_User::splitName($founder[0]->founderName);
								
							 $newUsr->email = $txtEmailAddress;
							 // To Do : create password hash, send welcome email with password
							 $newUsr->passwordHash = sha1('welcometohoho');  
							 $newUsr->firstName		 = $fullName['first'];
							 $newUsr->lastName		 = $fullName['last'];
							 $newUsr->userStatus	 = 'Active';  
							 $newUsr->companyName	 = $txtCompany;
							 $userId = $newUsr->save();
							 if ($userId) {
							 			$newEmail = Models\Models_User::addNewEmail($txtEmailAddress);
							 			if ($newEmail){
								 			$userEmailAdd = Models\Models_User::addNewUserEmail($userId, $newEmail,1);							 
								 			if ($userEmailAdd) {
								 				$isValid 		= true;
								 				$isNewUser	= true;
								 				
								 				#send email with welcome message
											  $emailSent = self::sendMail('welcome', $newRequest->requestEmail);				 				
								 			}
								 		} //new email added
							 
							 } //new user created
						} //user account null
						
						if ($isValid) {
								//create relation user <> founder
								$userFounder = Models\Models_Founder::addUserFounder($userId, $founder[0]->id);

								//extract profile from investors table using CompanyName as entry point:
								$profileInfo = Models\Models_Profile::getCompanyByName($txtCompany);
								$companyProfileId = $profileInfo[0]->id;						

								//relation: user-company
								$addRelation = Models\Models_Profile::addUserCompany($userId, $companyProfileId);


								// mark request as processed
								$closeRequest = Models\Models_ClaimRequest::getByEmail($txtEmailAddress);
								$closeRequest->requestStatus			=	'Processed';
								$closeRequest->requestTimeStamp		=	$currentDate;
								$isValid = $closeRequest->save();
								
						}
						
						/* To Do: Confirm here:
							1. get user profile from founders
							2. If profile doesn't exist as user, create new user using founder's profile data
							3. If profile already exists as user, replace user's data
							4. Create company profile from investors data
							5. Create relation user <> Company
							6. Mark the profile as "taken"
							7. Close Claim request, mark as Processed

						
						
						$usrExists = Models\Models_User::getByEmail($txtEmailAddress);
						if ($usrExists != null){
							//user already exists
							$userId = $usrExists->id;
							
						} else {
							//create new profile for this user
							$newUsr = new Models\Models_User();
								
								//split Contact Name
							 $splitName = explode(" ", $newRequest->investorContactName);
								
							 $newUsr->email = $txtEmailAddress;
							 $newUsr->passwordHash = '';  // To Do : create password hash, send welcome email with password
							 $newUsr->firstName		 = $splitName[0];
							 $newUsr->lastName		 = $splitName[1];
							 $newUsr->userStatus	 = 'Active';  
							 $newUsr->companyName	 = $txtCompany;
							 $userId = $newUsr->save();
							 
						}
						*/  
						
					}
			}
		}

	  $view->showForm = $isValid;
	  $view->newUser  = $isNewUser;
		if ($isValid) {			  
		  $view->displayMessage = "Company Profile Successfully claimed!";
		} else {
			$view->displayMessage = "Unable to claim company profile... sorry.";
		}
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());	
	}

/*
claimcompany : shows form to claim company profile when logged in
*/

	public function claimcompany($params){

    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
    
    $viewName = "profile/claimcompany";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: Claim Company Profile";
		
		$_SESSION['profileProcessFlag'] = "1";

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
	
	}

/*
processclaimcompany : gets company name & user ID, checks if it can claim de company for this user (logged-in)
*/

	public function processclaimcompany($params){
	
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
    
    $userId   = $_SESSION['userId'];
		$viewName = "profile/confirmclaim";
		$view = new Fwk\view($viewName);
		$view->setMasterView('generic');
		$view->pageTitle = "hoho :: Claim Profile Step 2";

		$isValid 			 = false;
		$view->hasInfo = false;
		
  	if (isset($params['txtCompany'])){	  
  		$isValid = true;
  	}
  		  	
  	if ($isValid){
  			
				$profileCompany		= $params['txtCompany'];

				$profileInfo = Models\Models_Profile::getCompanyByName($profileCompany);

				if ($profileInfo[0]){
						
						$companyProfileId = $profileInfo[0]->id;						
						 
						//company profile exists: get founders 
						$allFounders = unserialize($profileInfo[0]->founders);
						
						#Check if user name matches any of the founders names:
						$fullUserName = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
						$matchingName = false;
						for ($x=0; $x<count($allFounders);$x++){
							if (trim(strtolower($allFounders[$x]['name'])) == trim(strtolower($fullUserName))){
								$matchingName = true;
								continue;	
							}
						}
						if ($matchingName){
						
							#5 relation: user-company
							$addRelation = Models\Models_Profile::addUserCompany($userId, $companyProfileId);

							$view->hasInfo 			= true;
							$view->companyName 	= $profileCompany;
							$view->displayMessage = "Congratulations! <b>" . $profileCompany . "</b> is now linked to your own profile!";
							$view->backUrl			= "/user/myaccount";
						}	else {
							$view->displayMessage = "Seems like you are not related to the company <b>" . $profileCompany . "</b>. Sorry!";
							$view->backUrl			= "/user/myaccount";							
						}
						 
				} else {
						$view->displayMessage = "Seems like the compay profile you are asking for is not available. Sorry!";
						$view->backUrl			= "/user/myaccount";
				}
		}
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
	
	}

/*
viewcompany: view company profile
*/
	public function viewcompany($params){
	
	# if (! $this->_isAllowed(false)) {
	#	 //User is not logged in so gets redirected to login
	#	 return;
	# }
		
		if (isset($_SESSION['userId']))
			$userId = $_SESSION['userId'];
		else 
			$userId = 0;
		
		if ((!isset($params['cid'])) || (trim($params['cid']=='')))
			$isValid = false;
		else {
		
			$companyId = $params['cid'];	
			$companyProfile = Models\Models_Company::getByPk($companyId);
			if ($companyProfile != null){
				$isValid = true;
				$isOwner = false;
				$isFollowing = false;
				if ($userId > 0) {
					//verify: current user is related to this company_id
					$userCompany = Models\Models_Company::getCompanyFromUserId($userId, $companyId);
				
					if ($userCompany[0]['TOTAL'] == 1){			
						$isOwner = true;
						$_SESSION['selectedCompany'] = $companyId;
					}	else {
						//not the owner, verify if is following:
						$userFollowingCompany = Models\Models_Company::getFollowerFromUserId($userId, $companyId);
						if ($userFollowingCompany[0]['TOTAL'] == 1){									
							$isFollowing = true;
						}
					}				
				}				
				
			 //load assets for this company:
			 $assetsInfo = Models\Models_Assets::listAllByCompanyId($companyId);
			 
			 //load founders + photos for this company
			 $foundersInfo=Models\Models_Company::getCompanyFoundersById($companyId);	

			 //load people following this company
			 $followersInfo=Models\Models_Company::getCompanyFollowersById($companyId);				 
	
			}
		}	
	
		if (!$isValid){
				$viewName = "profile/notvalid";
				$view = new Fwk\view($viewName);
				$view->setMasterView('generic');
				$view->pageTitle = "hoho: Invalid Request";
				$view->displayMessage	= "The requested company profile is not valid";
				$view->backUrl = "/user/company";

		} else {
		
			 #get user profile:
			 $currentUser = Models\Models_User::getByPk($userId);			 

			 $viewName = "profile/viewcompany";		
			 $view = new Fwk\view($viewName);
			 $view->setMasterView('generic');
			 $view->pageTitle = "hoho: Your Company Pofile";
			 $view->companyInfo = $companyProfile;
			 $view->cid 				= $companyId;
			 $view->assets			= $assetsInfo;
			 $view->founders		= $foundersInfo['results'];
			 $view->memberSince = date('M. d, Y', strtotime($currentUser->createdAt));
			 $view->isCompanyOwner = $isOwner;
			 $view->isFollowing		 = $isFollowing;
			 $view->sortedAssets = $this->_createSortedAssets($assetsInfo);
			 $view->followersTotal	 = $followersInfo['totalFound'];
			 $view->follwersDetail	 = $followersInfo['results'];
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
	
	}

/*
editcompany: form to edit company profile
*/
	public function editcompany($params){
	
	 if (! $this->_isAllowed(false)) {
		 //User is not logged in so gets redirected to login
		 return;
	 }

		if ((!isset($params['cid'])) || (trim($params['cid']=='')))
			$isValid = false;
		else {
			$companyId = $params['cid'];	
			$companyProfile = Models\Models_Company::getByPk($companyId);
			if ($companyProfile != null)	
				$isValid = true;			
		}	
	
		if (!$isValid){
				$viewName = "profile/notvalid";
				$view = new Fwk\view($viewName);
				$view->setMasterView('generic');
				$view->pageTitle = "hoho: Invalid Request";
				$view->displayMessage	= "The requested company profile is not valid";
				$view->backUrl = "/user/company";
		} else {
			 $viewName = "profile/editcompany";		
			 $view = new Fwk\view($viewName);
			 $view->setMasterView('generic');
			 $view->pageTitle = "hoho: Edit Your Company Pofile";
			 $view->companyInfo = $companyProfile;
			 $view->photoPath = FILES_COMPANY_FOLDER;
			 $view->cid = $companyId;
			 $view->sectorCatalog = Models\Models_Sector::getAll();
             $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
             $view->reservePrice = Models\Models_Company::getCompanyReservePriceByUserIdCompanyId($userId, $companyId);
		}

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
	
	}

    function uploadCompanyLogoUrl() {
        $companyLogoUrl = "";
        if ( ! empty($_FILES)) {
            $tempFile = $_FILES['companyLogo']['tmp_name'];
            $fileName = $_FILES['companyLogo']['name'];
            $targetPath = $_SERVER["DOCUMENT_ROOT"] . FILES_COMPANY_FOLDER;
            $targetFile = $targetPath . $fileName;
            
            move_uploaded_file($tempFile, $targetFile);
            $companyLogoUrl = $targetFile;
        }
        return $companyLogoUrl;
    }

    // IMPORTANT !!! Method to be called via Ajax
    function loadCompanyLogoUrl($file) {
        $fileName = str_replace(FILES_COMPANY_FOLDER, "", $file['file']);
        $obj['full_name'] = $file['file'];
        $obj['name'] = $fileName;
        $obj['size'] = filesize($_SERVER["DOCUMENT_ROOT"] . $file['file']);
        $result[] = $obj;
        header('Content-Type: application/json');
        echo json_encode($result);
    }

 /*
 updatecompanyprofile : execute db-update for the given company-id profile
 */
 function updatecompanyprofile($params) {
 
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

    $companyId = $params['cid'];
    $userId = $_SESSION['userId'];

    //get company profile data
    $currentCompany = Models\Models_Company::getByPk($companyId);

    $companyName = isset($params['companyName']) ? $params['companyName'] : $currentCompany->companyName;
    $oneLiner = isset($params['oneLiner']) ? $params['oneLiner'] : $currentCompany->oneLiner;
    $sector = isset($params['sector']) ? $params['sector'] : unserialize($currentCompany->sector);
    $employees = isset($params['employees']) ? $params['employees'] : $currentCompany->employees;
    $fundCurrent = isset($params['fundCurrent']) ? $params['fundCurrent'] : $currentCompany->fundCurrent;
    $fundPast  = isset($params['fundPast']) ? $params['fundPast'] : $currentCompany->fundPast;
    $investors = isset($params['investors']) ? $params['investors'] : $currentCompany->investorNames;
    $productDescription = isset($params['productDescription']) ? $params['productDescription'] : $currentCompany->productDescription;
    $technology = isset($params['technology']) ? $params['technology'] : $currentCompany->technology;
    $specialties = isset($params['specialties']) ? $params['specialties'] : $currentCompany->specialties;
    $traction = isset($params['traction']) ? $params['traction'] : $currentCompany->traction;
    $founders = isset($params['founders']) ? $params['founders'] : $currentCompany->founders;
    $customers = isset($params['customers']) ? $params['customers'] : $currentCompany->customers;
    $advisors = isset($params['advisors']) ? $params['advisors'] : $currentCompany->advisors;
    $incubators = isset($params['incubators']) ? $params['incubators'] : $currentCompany->incubators;
    $press = isset($params['press']) ? $params['press'] : $currentCompany->press;
    $moreInfo = isset($params['moreInfo']) ? $params['moreInfo'] : $currentCompany->moreInfo;
    $attorneys = isset($params['attorneys']) ? $params['attorneys'] : $currentCompany->attorneys;
    $contactDetails = isset($params['contactDetails']) ? $params['contactDetails'] : $currentCompany->contactDetails;
    $location = isset($params['location']) ? $params['location'] : unserialize($currentCompany->city);
    $logoUrl = isset($params['logoUrl']) ? $params['logoUrl'] : $currentCompany->logoUrl;
    $reservePrice = $params['reservePrice'];
    $arrayCity = array($location);

    $currentCompany->companyName = $companyName;
    $currentCompany->oneLiner = $oneLiner;
    $currentCompany->sector = serialize($sector);
    $currentCompany->logoUrl = $logoUrl;
    $currentCompany->city = serialize($arrayCity);
    $currentCompany->employees = $employees;
    $currentCompany->fundCurrent = $fundCurrent;
    $currentCompany->fundPast = $fundPast;
    $currentCompany->productDescription = $productDescription;
    $currentCompany->technology = $technology;
    $currentCompany->specialties = $specialties;
    $currentCompany->traction = $traction;
    $currentCompany->founders = $founders;
    //  $currentCompany->investorNames= $investors;
    $currentCompany->customers = $customers;
    $currentCompany->advisors = $advisors;
    $currentCompany->incubators = $incubators;
    $currentCompany->press = $press;
    $currentCompany->moreInfo = $moreInfo;
    //  $currentCompany->currentInvestors= ;
    $currentCompany->attorneys = $attorneys;
    //  $currentCompany->contactDetails;

    if ($currentCompany->save()) {
        if ($reservePrice) {
            Models\Models_Company::updateCompanyReservePrice($userId, $companyId, $reservePrice);
        }
        $result = array('result' => 'OK', 'redirectUrl' => '/user/company');
    } else {
        $result = array('result' => 'Error', 'message' => 'Error trying to update company...');
    }

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
 }
 
  function sendMail($mailTag, $mailToAddress, $params = null) {
  
    $template = Models\Models_MailTemplate::getByTag($mailTag);
    if ($template->loaded) {

	  $vars = array(
	  	"%params%" => $params['key'],
		  "%firstname%" => $params['firstName']
	  );


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
		function: claimprofile
		goal: get name & start claim personal profile process
	*/
  public function claimprofile($params) {

		$viewName = "profile/claimprofile";
		$view = new Fwk\view($viewName);
		$view->setMasterView('generic');
		$view->pageTitle = "hoho :: Claim Personal Profile Step 1";

		$isValid = true;
		
  	if (!isset($params['txtName'])){	  
  		$isValid = false;
  	}
  		  	
  	if ($isValid){
  			$isValid = false;
				$profileName = $params['txtName'];

				$profileInfo = Models\Models_Founder::getFounderByName($profileName);

				if ($profileInfo!= null){
						//for each profile found, get company name
						$arrayResults = array();
						foreach($profileInfo as $profile){
							$company = Models\Models_Company::getCompanyFromFounderName($profile->founderName);						
							#extract company URL from contact Details info:
							$nodesInContact = count($company[0]->contactDetails);
							if ($nodesInContact > 0){
								$companyUrl = $company[0]->contactDetails[$nodesInContact-1];
								$companyUrl = str_replace("http://www.","",$companyUrl);			
								$companyUrl = str_replace("http://","",$companyUrl);									
								$companyEmail  = $companyUrl;
								
								$userView = new \stdClass();
								$userView->id 				 = $profile->id;
								$userView->founderName = $profile->founderName;
								$userView->companyName = $company[0]->companyName;
								$userView->companyId	 = $company[0]->id;
								$userView->companyEmail= $companyEmail;
								$arrayResults[] = $userView;            
							}	
						}			
						//founder profile exists: display founders-list
						$view->founders 		= $arrayResults;	
						$view->totalFounders=count($profileInfo);
						$view->hasInfo = true;
						$_SESSION['profileProcessFlag'] = "1";
						$_SESSION['fullResults']				= $arrayResults;	
				} else {
					$view->hasInfo = false;
				}

		}
		
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

	private static function getNames($objName){
		 $firstName = '';
		 $lastName	= '';
		 
		 switch (count($objName)){
			 case 1:
						$firstName = $objName[0];
					break;
			 case 2: 
						$firstName = $objName[0];
						$lastName	 = $objName[1];
					break;
			 default:
						$firstName = $objName[0];
						for ($x=1; $x < count($objName); $x++){
							$lastName.= $objName[$x] . ' ';						 	 
						}
					break;
		 }	
		 
		 return array('first' => $firstName, 'last' => $lastName);
	}

	public function addfollow($params){

		$isValid = true;
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      $isValid = false;
    }
    
		if ((!isset($params['cid'])) || ($params['cid']=='')){
				$isValid = false;
		}

		if ((!isset($params['uid'])) || ($params['uid']=='')){
				$isValid = false;
		}

    $userId   = $_SESSION['userId'];

		if ($params['uid'] != $userId){
			$isValid = false;
		}
		
		if ($isValid){
			 $add = Models\Models_Company::addFollower($params['cid'], $userId);
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
    
		if ((!isset($params['cid'])) || ($params['cid']=='')){
				$isValid = false;
		}

		if ((!isset($params['uid'])) || ($params['uid']=='')){
				$isValid = false;
		}

    $userId   = $_SESSION['userId'];

		if ($params['uid'] != $userId){
			$isValid = false;
		}
		
		if ($isValid){
			 $add = Models\Models_Company::removeFollower($params['cid'], $userId);
			 $result = array('result' => 'OK', 'message' => 'you are not longer a follower!');
		
		} else {
			$result = array('result' => 'Error', 'message' => 'Error trying to unfollow this company...');
		}
  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  
	}

    private function _createSortedAssets($assetsInfo) {
        // Generate a new array with the needed info for the column
        $topSortedAssets = array();
        foreach ($assetsInfo as $asset) {
            $assetData = unserialize($asset->assetValues);
            $topSortedAssets[] = array(
                                    'img' => $asset->ImgSmall,
                                    'assetTypeName' => $asset->TypeName,
                                    'assetName' => $asset->assetName,
                                    'date' => $asset->dateCreated,
                                    'description' => $assetData['description'],
                                    'status' => $asset->statusLabel,
                                    'info' => $assetData['info'],
                                );
        }
        // Sort $topSortedAssets by date DESC and typeName ASC
        foreach ($topSortedAssets as $index => $row) {
            $date[$index] = $row['date'];
            $assetTypeName[$index] = $row['assetTypeName'];
        }
        array_multisort($date, SORT_DESC, $assetTypeName, SORT_ASC, $topSortedAssets);

        return $topSortedAssets;
    }
}

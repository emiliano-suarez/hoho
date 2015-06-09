<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;

class Controllers_Company extends Controllers_AdminBase {

  /**
  * @function: addnewform
  * @goal: show new company form
  */

  public function addnewform($params) {
	
    $viewName = "company/new";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: Add New Company";
		
		$_SESSION['profileProcessFlag'] = "1";

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }
  
  /**
  * @function: add
  * @goal: create company in db
  */

  public function add($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

		$companyName = $params['txtCompanyName'];
		$oneLiner  	= $params['txtOneLiner'];
		$sector		 	= $params['txtSector'];
		$location	 	= $params['txtLocation'];
		$employees	= $params['txtNumberEmployees'];
		
		//get user data
		$userId = $_SESSION['userId'];
		
		//check company name doesn't exist
		
		if ((isset($_SESSION['profileProcessFlag'])) && ($_SESSION['profileProcessFlag'] == "1")){
			 //create new company model
			 $newCompany = new Models\Models_Company();

			 $arraySector = array($sector);
			 $arrayCity		= array($location);

			 $newCompany->companyName = $companyName;
			 $newCompany->oneLiner		 = $oneLiner;
			 $newCompany->sector			 = serialize($arraySector);
			 $newCompany->city				 = serialize($arrayCity);
			 $newCompany->totalEmployees	 = $employees;
			 $newCompany->originalId	 = 0;		

			 if ($newCompany->save()){
					 //create user-company relation
					 $ucRelation = Models\Models_Company::addUserCompany($userId, $newCompany->id);
	 
	 				 $_SESSION['profileProcessFlag'] = "0";
					 $result = array('result' => 'OK', 'redirectUrl' => '/user/company');
			 } else {
					 $result = array('result' => 'Error', 'message' => 'Error trying to create new company...(step 1)');
			 }
		} else {
				$result = array('result' => 'Error', 'message' => 'Error trying to create new company...(step 2)');
		}
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
    $this->response->setBody(json_encode($result));  


  }  
}

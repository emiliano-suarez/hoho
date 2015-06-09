<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;

class Controllers_Assets extends Controllers_AdminBase {

  /**
  * @function: list
  * @goal: list all assets from user
  */

  public function listall($params) {
    if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }
	
    $viewName = "assets/list";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho: My Account :: My Assets";

		$userId = $_SESSION['userId'];

		#get all assets
 	  $assetsInfo = Models\Models_Assets::listAllByUserId($userId);
 	  $arrayResults = array();
 	  $x=0;
 	  foreach ($assetsInfo as $asset) {  
 	  	switch ($asset->assetType) {
 	  		case 'technology':
 	  		// Description, Why it is interesting, Useful for,Specs,IP/Patent,example
 	  			$arrayResults[$x]['data'] = unserialize($asset->assetValues);			
 	  			$arrayResults[$x]['name'] = $asset->assetName;
 	  			$arrayResults[$x]['type'] = $asset->assetType;
 	  			break;
 	  		case 'data':
 	  			$arrayResults[$x]['data'] = unserialize($asset->assetValues);			
 	  			$arrayResults[$x]['name'] = $asset->assetName;
 	  			$arrayResults[$x]['type'] = $asset->assetType; 	  		
/*
- Description 
- Why it is interesting/unique
- Useful for: 
- Specs (to fill up): size, format of data, type, schema of database, estimation of accuracy, source of data. Public or proprietary.

*/
 	  			break;
 	  		case 'client':
/*
- Description
- Size
- Engagement
- Growth
- Financial information

*/ 	  		break;
				case 'user':
 	  			$arrayResults[$x]['data'] = unserialize($asset->assetValues);			
 	  			$arrayResults[$x]['name'] = $asset->assetName;
 	  			$arrayResults[$x]['type'] = $asset->assetType; 	  		
				
/*
- Description
- Size and location
- Engagement
- Growth

*/				
					break;
				case 'branding':
/*
- Description
- Images
- unique/cool?
- New ? or recognised? : 
- target audience
- Price

*/				
					break;	
				case 'team':
/*
- Name and position: 
- Expertise
- Strengths: 
- Availability:
*/				
					break;
				case 'offices':
/*
- Description
- Location
- Size
- Type
- Availability
- Price
- Looking for: 

*/				
					break;
				case 'other':
/*
free fields 
*/					
					break;
 	  		default:
 	  			break;
 	  	}
 	  	$x++;
 	  }
 	  
 	  	$view->allAssets	 = $arrayResults;
 	  /*
			$view->tech_assets = $arrayResults;
			$view->data_assets = '';
			$view->client_base_assets = '';
			$view->user_base_assets = '';
			$view->branding_assets = '';
			$view->team_assets = '';
			$view->offices_assets = '';
			$view->other_assets = '';
		*/
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

/*
show form to create new asset
*/
  public function newasset($params) {

	 if (! $this->_isAllowed(false)) {
		 //User is not logged in so gets redirected to login
		 return;
	 }
	 
	 $isValid = true;
	 if ((!isset($params['type'])) || ($params['type']=='')){
	 		$isValid = false;
	 }
	 
	 $assets = array("technology","data","client","user","branding","team","offices","other");
	 
	 if (!in_array($params['type'], $assets)){
	 	$isValid = false;
	 }
	 
    $viewName = "assets/new";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho :: Add New Asset";

		$view->newType = $params['type'];
		$view->showForm= $isValid;

    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

/* creates new asset in db */
  public function addnew($params) {
     if (! $this->_isAllowed(false)) {
      //User is not logged in so gets redirected to login
      return;
    }

	  $isValid = true;
		$newType 		= $params['assetType']; //asset type being created
		$assetName	= $params['asset_name']; //field "name"
		$cId	= $params['a_comp']; //companyId
        $assetStatus = $params['a_status'];
		$a_1  = $params['a_1'];
		$a_2  = $params['a_2'];
		$a_3  = $params['a_3'];
		$a_4  = $params['a_4'];
		$a_5  = $params['a_5'];
		$a_6  = $params['a_6'];	
		$a_7 = $params['a_7'];
		$a_8 = $params['a_8'];

		$userId = $_SESSION['userId'];

		switch ($newType){
		 case 'technology': 
						$assetArray = array('description' => $a_1, 'why' => $a_2, 'useful' => $a_3, 
						'specs' => $a_4, 'patent' => $a_5, 'example' => $a_6, 'info' => $a_8,
                        'status' => $assetStatus);
				 break;
			 case 'data': 
						$assetArray = array('description' => $a_1, 'why' => $a_2, 'useful' => $a_3, 
						'specs' => $a_4, 'info' => $a_8, 'status' => $assetStatus);
				 break;                        		
			 case 'client': 
						$assetArray = array('description' => $a_1, 'size' => $a_2, 'engagement' => $a_3, 
						'growth' => $a_4, 'financial' => $a_5, 'info' => $a_8, 'status' => $assetStatus);
				 break;                        		
			 case 'user': 
						$assetArray = array('description' => $a_1, 'size' => $a_2, 'engagement' => $a_3,
                        'growth' => $a_4, 'info' => $a_8, 'status' => $assetStatus);
				 break;                        		
			 case 'branding': 
						$assetArray = array('description' => $a_1, 'images' => $a_2, 'unique' => $a_3, 
						'new' => $a_4, 'target' => $a_5, 'info' => $a_8, 'status' => $assetStatus);
				 break;                        		
			 case 'team': 
						$assetArray = array('name' => $a_1, 'expertise' => $a_2, 'strengths' => $a_3, 
						'available' => $a_4, 'info' => $a_8, 'status' => $assetStatus);
				 break;
			 case 'offices':  
						$assetArray = array('description' => $a_1, 'location' => $a_2, 'size' => $a_3, 
						'type' => $a_4, 'available' => $a_5, 'price' => $a_6,'looking' => $a_7,
                        'info' => $a_8, 'status' => $assetStatus);
				 break;   
			 default :
			 	$isValid = false;      
			 	break;
		}

		if ($isValid) {
			//load new asset model
			$newAsset = new Models\Models_Assets();		
			$newAsset->userId			= $userId;
			$newAsset->assetDescription = $a_1;
			$newAsset->assetType	= $newType;
		
			$newAsset->assetName	= $assetName;
			
			$newAsset->assetValues = serialize($assetArray);
			$newAsset->companyId	 = $cId;	
		
			if ($newAsset->save()){
						$isValid = true;
			 }
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
 
  
}

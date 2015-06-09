<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Company extends Models_Base  {

  protected $id;
  protected $originalId;
  protected	$fundCurrent;
  protected $fundPast;
  protected $logoUrl;
  protected $companyName;
  protected $oneLiner;
  protected $investorNames;
  protected $city;
  protected $productDescription;
  protected $technology;
  protected $specialties;
  protected $traction;
  protected $founders;
  protected $sector;
  protected $customers;
  protected $advisors;
  protected $incubators;
  protected $press;
  protected $moreInfo;
  protected $currentInvestors;
  protected $attorneys;
  protected $employees;
  protected $totalEmployees;
  protected $contactDetails;
  protected $salePrice;
  protected $dateCreated;

  public static function getByPk($id) {
    $profile = new Models_Company();

    $profileInfo = data\Dataaccess_Company::getByPk($id);
    
    if (! empty($profileInfo)) {
      $record = $profileInfo[0];
      $profile->_fillData($record);
    } else {
      $profile->id = $id;
    }
    
    return $profile;
  }

 public static function getCompanyFromFounderName($founderName){
 	$result = data\Dataaccess_Company::getCompanyFromFounderName($founderName);
	$profiles = $result["results"];
	$profileList = array();
	if (! empty($profiles)) {
		foreach ($profiles as $record) {
			$profileList[] = self::getByPk($record["ID"]);
		}
	}
	return $profileList;
 }

 public static function getCompanyReservePriceByUserIdCompanyId($userId, $companyId) {
    $profile = data\Dataaccess_Company::getCompanyByUserIdCompanyId($userId, $companyId);
    return $profile[0]["RESERVE_PRICE"];
 }

 public static function allCompaniesFromUserId($userId){
 	$result = data\Dataaccess_Company::allCompaniesFromUserId($userId);
	$profiles = $result["results"];
	$profileList = array();
	if (! empty($profiles)) {
		foreach ($profiles as $record) {
			$profileList[] = self::getByPk($record["COMPANY_PROFILE_ID"]);
		}
	}
	return $profileList;

 }

 public static function getCompanyFollowersById($companyId){
 	$result = data\Dataaccess_Company::getCompanyFollowersById($companyId);
 	return $result;
 }



 public static function getCompanyFoundersById($companyId){
 	$result = data\Dataaccess_Company::getCompanyFoundersById($companyId);
 	return $result;
 }


 public static function addUserCompany($userId, $companyProfileId){
 	$result = data\Dataaccess_Company::addUserCompany($userId, $companyProfileId);
 	return $result;
 }

 public static function getCompanyFromUserId($userId, $companyProfileId){
 	$result = data\Dataaccess_Company::getCompanyFromUserId($userId, $companyProfileId);
 	return $result;
 }

 public static function getFollowerFromUserId($userId, $companyProfileId){
 	$result = data\Dataaccess_Company::getFollowerFromUserId($userId, $companyProfileId);
 	return $result;
 }
 
 public function addFollower($companyId, $userId){
 	$result = data\Dataaccess_Company::addFollower($companyId, $userId);
 	return $result; 
 }

 public function removeFollower($companyId, $userId){
 	$result = data\Dataaccess_Company::removeFollower($companyId, $userId);
 	return $result; 
 }



  public static function getCompanyByName($profileCompany) {
    $profileInfo = data\Dataaccess_Company::getCompanyByName($profileCompany);
    $profiles = $profileInfo["results"];
    $profileList = array();
    if (! empty($profiles)) {
      foreach ($profiles as $record) {
        $profileList[] = self::getByPk($record["ID"]);
      }
    }
    return $profileList;
  }

  public function updateCompanyReservePrice($userId, $companyId, $reservePrice) {
    return data\Dataaccess_Company::updateCompanyReservePrice($userId, $companyId, $reservePrice);
  }

  public function save() {
    if ($this->dirty) {
      if ($this->loaded) {
        $saved = data\Dataaccess_Company::update($this->id, $this->originalId, $this->fundCurrent, $this->fundPast, $this->logoUrl, 
        $this->companyName, $this->oneLiner, $this->investorNames, $this->city, $this->productDescription, $this->technology,
        $this->specialties, $this->traction, $this->founders, $this->sector,
        $this->customers, $this->advisors, $this->incubators, $this->press, $this->moreInfo,$this->currentInvestors,
        $this->attorneys,$this->employees,$this->contactDetails,$this->totalEmployees );
				return $this->id;
                                            
      } else {
        $saved = data\Dataaccess_Company::insert($this->originalId, $this->companyName, $this->oneLiner, $this->city, $this->sector,$this->totalEmployees);
                                            
        if ($saved) {
          $this->id = $saved;
          return $this->id;
        }
      }
    } else {
      $saved = true;
    }
    return $saved;
  }  

  
  private function _fillData($record) {
      $this->loaded = true;
      $this->id = $record['ID'];
      $this->originalId       = $record['ORIGINAL_ID'];
			$this->fundCurrent = $record['FUNDRAISING_CURRENT'];
			$this->fundPast = $record['FUNDRAISING_PAST'];
			$this->logoUrl = $record['COMPANY_LOGO_URL'];
			$this->companyName = $record['COMPANY_NAME'];
			$this->oneLiner = $record['ONE_LINER'];
			$this->investorNames = $record['INVESTOR_NAMES'];
			$this->city = $record['CITY'];
			$this->productDescription = $record['PRODUCTDESCRIPTION'];
			$this->technology = $record['TECHNOLOGY'];
			$this->specialties = $record['SPECIALTIES'];
			$this->traction = $record['TRACTION'];
			$this->founders = $record['FOUNDERS'];
			$this->sector = $record['SECTOR'];
			$this->customers = $record['CUSTOMERS'];
			$this->advisors = $record['ADVISORS'];
			$this->incubators = $record['INCUBATORS'];
			$this->press = $record['PRESS'];
			$this->moreInfo = $record['MOREINFO'];
			$this->currentInvestors = $record['CURRENT_INVESTORS'];
			$this->attorneys = $record['ATTORNEYS'];
			$this->employees 				= $record['EMPLOYEES'];
			$this->totalEmployees		= $record['TOTAL_EMPLOYEES'];
			$this->contactDetails = unserialize($record['CONTACT_DETAILS']);    
			$this->dateCreated		= $record['DATE_CREATED'];
  
  }
}

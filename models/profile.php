<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Profile extends Models_Base  {

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
  protected $contactDetails;                                

  public static function getByPk($id) {
    $profile = new Models_Profile();

    $profileInfo = data\Dataaccess_Profile::getByPk($id);
    
    if (! empty($profileInfo)) {
      $record = $profileInfo[0];
      $profile->_fillData($record);
    } else {
      $profile->id = $id;
    }
    
    return $profile;
  }

 public static function addUserCompany($userId, $companyProfileId){
 	$result = data\Dataaccess_Profile::addUserCompany($userId, $companyProfileId);
 	return $result;
 }

  public static function getCompanyByName($profileCompany) {
    $profileInfo = data\Dataaccess_Profile::getCompanyByName($profileCompany);
    $profiles = $profileInfo["results"];
    $profileList = array();
    if (! empty($profiles)) {
      foreach ($profiles as $record) {
        $profileList[] = self::getByPk($record["ID"]);
      }
    }
    return $profileList;
  }


  
  private function _fillData($record) {
      $this->loaded = true;
      $this->id = $record['ID'];
      $this->originalId       = $record['ORIGINAL_ID'];
  $this->fundCurrent = $record['FUNDRAISING_CURRENT'];
  $this->fundPast = $record['FUNDRAISING_PAST'];
  $this->logoUrl = $record['COMPANY_LOGO_URL'];
  $this->companyName = $record['COMPANY_NAME'];
  $this->oneLiner = $record['INVESTOR_NAMES'];
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
  $this->employees = $record['EMPLOYEES'];
  $this->contactDetails = unserialize($record['CONTACT_DETAILS']);    
  
  }
}
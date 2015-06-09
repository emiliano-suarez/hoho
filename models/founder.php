<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Founder extends Models_Base  {

  protected $id;
  protected $founderName;
  protected	$founderPhotoUrl;
  protected $whatIDo;
  protected $bioText;
  protected $profileTaken;
                                

  public static function getByPk($id) {
    $profile = new Models_Founder();

    $profileInfo = data\Dataaccess_Founder::getByPk($id);
    
    if (! empty($profileInfo)) {
      $record = $profileInfo[0];
      $profile->_fillData($record);
    } else {
      $profile->id = $id;
    }
    
    return $profile;
  }

  public static function getFounderById($founderId) {
    $profileInfo = data\Dataaccess_Founder::getFounderById($founderId);
    $profiles = $profileInfo["results"];
    $profileList = array();
    if (! empty($profiles)) {
      foreach ($profiles as $record) {
        $profileList[] = self::getByPk($record["ID"]);
      }
    }
    return $profileList;
  }



  public static function getFounderByName($founderName) {
    $profileInfo = data\Dataaccess_Founder::getFounderByName($founderName);
    $profiles = $profileInfo["results"];
    $profileList = array();
    if (! empty($profiles)) {
      foreach ($profiles as $record) {
        $profileList[] = self::getByPk($record["ID"]);
      }
    }
    return $profileList;
  }

 public static function addUserFounder($userId, $founderId){
    $info = data\Dataaccess_Founder::addUserFounder($userId, $founderId); 
    return $info;
 }


  
  private function _fillData($record) {
      $this->loaded = true;
      $this->id = $record['ID'];
      $this->founderName    = $record['FOUNDER_NAME'];
		  $this->founderPhotoUrl= $record['FOUNDER_PHOTO_URL'];
		  $this->whatIDo 				= $record['WHAT_I_DO'];
		  $this->bioText 				= $record['BIO_TEXT'];		  
			$this->profileTaken		= $record['PROFILE_TAKEN'];
  
  }
}
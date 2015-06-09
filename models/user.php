<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_User extends Models_Base  {

  protected $id;
  protected $email;
	protected $passwordHash;
	protected $firstName;
	protected $lastName;
	protected $address_1;
	protected $address_2;
	protected $zip;
	protected $state;
	protected $country;						
  protected $createdAt;
	protected $userStatus;  
	protected $companyName;

	protected $photoUrl;
	protected $whatIDo;
	protected $bio;

	//serialized data:
	protected $arrEducation;
	protected	$arrExperience;
	protected $arrLinks;
	protected $arrLocations;
	protected $arrSkills;
	



  public static function getByPk($id) {
    $user = new Models_User();

    $userInfo = data\Dataaccess_User::getByPk($id);
    
    if (! empty($userInfo)) {
      $record = $userInfo[0];
      $user->_fillData($record);
    } else {
      $user->id = $id;
    }
    
    return $user;
  }

  public static function getUserById($id) {
    $userInfo = array();    
    $users = data\Dataaccess_User::getUserById($id);
    
    if (! empty($users)) {
      foreach ($users as $item) {
        $userInfo[] = self::getByPk($item["ID"]);
      }
    }
    
    return $userInfo;
  }  




  public static function addNewEmail($email) {
    $newEmail = data\Dataaccess_User::addNewEmail($email);
    return $newEmail;
  }  

  public static function addNewUserEmail($userId, $emailId, $isDefault) {
    $newUserEmail = data\Dataaccess_User::addNewUserEmail($userId, $emailId, $isDefault);
    return $newUserEmail;
  }  

  public static function listCompaniesByUserId($userId) {
    $userCompanies = data\Dataaccess_User::listCompaniesByUserId($userId);
    return $userCompanies;
  }  

 public static function getFollowerFromUserId($followerId, $followingId){
 	$result = data\Dataaccess_User::getFollowerFromUserId($followerId, $followingId);
 	return $result;
 }


 public static function getAllFollowers($userId){
 	$result = data\Dataaccess_User::getAllFollowers($userId);
 	return $result;
 }

 public static function getAllFollowing($userId){
 	$result = data\Dataaccess_User::getAllFollowing($userId);
 	return $result;
 }



 public static function getFollowersCount($userId){
 	$result = data\Dataaccess_User::getFollowersCount($userId);
 	return $result;
 }

 public static function getFollowingCount($userId){
 	$result = data\Dataaccess_User::getFollowingCount($userId);
 	return $result;
 }


 public function addFollower($userProfileId, $userId){
 	$result = data\Dataaccess_User::addFollower($userProfileId, $userId);
 	return $result; 
 }

 public function removeFollower($userProfileId, $userId){
 	$result = data\Dataaccess_User::removeFollower($userProfileId, $userId);
 	return $result; 
 }



  public static function getUserByEmail($email) {
    $userInfo = array();    
    $users = data\Dataaccess_User::getUserByEmail($email);
    
    if (! empty($users)) {
      foreach ($users as $item) {
        $userInfo[] = self::getByPk($item["ID"]);
      }
    }
    
    return $userInfo;
  }  

  public static function getByEmail($email) {
    $userInfo = array();    
    $users = data\Dataaccess_User::getByEmail($email);
    
    if (! empty($users)) {
      foreach ($users as $item) {
        $userInfo[] = self::getByPk($item["ID"]);
      }
    }
    
    return $userInfo;
  }  

  public function save() {
    if ($this->dirty) {
      if ($this->loaded) {
        $saved = data\Dataaccess_User::update($this->id, $this->firstName, $this->lastName, $this->companyName, $this->address_1, 
        $this->address_2, $this->zip, $this->state, $this->country, $this->userStatus, $this->passwordHash,
        $this->photoUrl, $this->whatIDo, $this->bio, $this->arrEducation,
        $this->arrExperience, $this->arrLinks, $this->arrLocations, $this->arrSkills);
				return $this->id;
                                            
      } else {
        $saved = data\Dataaccess_User::insert($this->email, $this->passwordHash, $this->firstName, $this->lastName,
         $this->companyName, $this->address_1, $this->address_2, $this->zip, $this->state, $this->country,
          $this->userStatus,$this->photoUrl, $this->whatIDo, $this->bio);
                                            
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
      $this->email = $record['EMAIL'];
      $this->passwordHash = $record['PASSWORD'];
      $this->firstName = $record['FIRST_NAME'];
      $this->lastName = $record['LAST_NAME'];
      $this->address_1 = $record['ADDRESS_1'];
      $this->address_2 = $record['ADDRESS_2'];
      $this->zip = $record['ZIP'];
      $this->state = $record['STATE'];
      $this->country = $record['COUNTRY'];
      $this->createdAt = $record['DATE_CREATED'];
      $this->userStatus = $record['STATUS'];                                                      
      $this->companyName = $record['COMPANY_NAME'];                                                            

      $this->photoUrl = $record['PHOTO_URL'];                                                            
      $this->whatIDo = $record['WHAT_I_DO'];                                                            
      $this->bio = $record['BIO'];                                                            

      $this->arrEducation = $record['EDUCATION'];                                                            
      $this->arrExperience= $record['EXPERIENCE'];                                                            
      $this->arrLinks 		= $record['LINKS'];      
      $this->arrLocations	= $record['LOCATIONS'];                                                      
      $this->arrSkills 		= $record['SKILLS'];                                                                              

  }
}
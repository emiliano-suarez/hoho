<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Lostpassword extends Models_Base  {

  protected $id;
  protected $userId;
	protected $requestHash;
	protected $requestStatus;
	protected $requestTimeStamp;
	protected $requestEmail;


  public static function getByPk($id) {
    $user = new Models_Lostpassword();

    $userInfo = data\Dataaccess_Lostpassword::getByPk($id);
    
    if (! empty($userInfo)) {
      $record = $userInfo[0];
      $user->_fillData($record);
    } else {
      $user->id = $id;
    }
    
    return $user;
  }

  public static function getByEmail($email) {
    $user = new Models_Lostpassword();

    $userInfo = data\Dataaccess_Lostpassword::getByEmail($email);

    if (! empty($userInfo)) {
    	$user = self::getByPk($userInfo[0]["ID"]);
    } else {
      $user->requestEmail = $email;
    }
    return $user;
  }    

  public static function getByHash($email, $hash) {
    $user = new Models_Lostpassword();

    $userInfo = data\Dataaccess_Lostpassword::getByHash($email, $hash);

    if (! empty($userInfo)) {
    	$user = self::getByPk($userInfo[0]["ID"]);
    } else {
      $user->requestEmail = $email;
    }
    return $user;
  }    


  public function save() {
    if ($this->dirty) {
      if ($this->loaded) {
        $saved = data\Dataaccess_Lostpassword::update($this->id, $this->userId, $this->requestHash, $this->requestStatus, $this->requestTimeStamp, $this->requestEmail);

                                            
      } else {
        $saved = data\Dataaccess_Lostpassword::insert($this->userId, $this->requestHash, $this->requestStatus, $this->requestTimeStamp, $this->requestEmail);
                                            
        if ($saved) {
          $this->id = $saved;
          $saved = true;
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
      $this->userId = $record['USER_ID'];
      $this->requestHash = $record['REQUEST_HASH'];
      $this->requestStatus = $record['REQUEST_STATUS'];
      $this->requestTimeStamp = $record['REQUEST_TIMESTAMP'];
      $this->requestEmail = $record['EMAIL'];

  }
}
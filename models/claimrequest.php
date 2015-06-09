<?php
 
namespace hoho\models;

use hoho\dataaccess as data;

class Models_ClaimRequest extends Models_Base  {

  protected $id;
	protected $requestHash;
	protected $requestStatus;
	protected $requestTimeStamp;
	protected $requestEmail;
	protected $requestCompany;
	protected $investorId;
	protected $investorContactName;
	protected $userId;


  public static function getByPk($id) {
    $user = new Models_ClaimRequest();

    $userInfo = data\Dataaccess_ClaimRequest::getByPk($id);
    
    if (! empty($userInfo)) {
      $record = $userInfo[0];
      $user->_fillData($record);
    } else {
      $user->id = $id;
    }
    
    return $user;
  }

  public static function getByHash($email, $hash, $company) {
    $user = new Models_ClaimRequest();

    $userInfo = data\Dataaccess_ClaimRequest::getByHash($email, $hash, $company);

    if (! empty($userInfo)) {
    	$user = self::getByPk($userInfo[0]["ID"]);
    } else {
      $user->requestEmail = $email;
    }
    return $user;
  }    


  public static function getByEmail($email) {
    $user = new Models_ClaimRequest();

    $userInfo = data\Dataaccess_ClaimRequest::getByEmail($email);

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
        $saved = data\Dataaccess_ClaimRequest::update($this->id, $this->requestHash, $this->requestStatus, $this->requestTimeStamp, $this->requestEmail, $this->requestCompany,$this->investorId,$this->investorContactName,$this->userId);

                                            
      } else {
        $saved = data\Dataaccess_ClaimRequest::insert($this->requestHash, $this->requestStatus, $this->requestTimeStamp, $this->requestEmail, $this->requestCompany,$this->investorId,$this->investorContactName,$this->userId);
                                            
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
      $this->requestHash = $record['REQUEST_HASH'];
      $this->requestStatus = $record['REQUEST_STATUS'];
      $this->requestTimeStamp = $record['REQUEST_TIMESTAMP'];
      $this->requestEmail = $record['EMAIL'];
			$this->requestCompany = $record['COMPANY'];      
			$this->investorId = $record['INVESTOR_ID'];      
			$this->investorContactName = $record['INVESTOR_CONTACT_NAME'];      						
			$this->userId			= $record['USER_ID'];
  }
}
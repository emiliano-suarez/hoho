<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Messages extends Models_Base  {

  protected $id;
  protected $parentId;
  protected	$fromId;
  protected $toId;
  protected $subject;
  protected $messageBody;
  protected $messageTime;
  protected $fromName;
  protected $toName;
                             

  public static function getByPk($id) {
    $msg = new Models_Messages();

    $msgInfo = data\Dataaccess_Messages::getByPk($id);
    
    if (! empty($msgInfo)) {
      $record = $msgInfo[0];
      $msg->_fillData($record);
    } else {
      $msg->id = null;
    }
    
    return $msg;
  }



	public static function listAllByUserId($userId){
    $msgsList = array();
    
    $messages = data\Dataaccess_Messages::listAllByUserId($userId);

    if (! empty($messages)) {
      foreach ($messages as $message) {
        $msgsList[] = self::getByPk($message["ID"]);
      }
    }
    
    return $msgsList;
	
	}

  public function save() {
    if ($this->dirty) {
      if ($this->loaded) {    
    	  $saved = data\Dataaccess_Customer::update();
	    } else {
	      $saved = data\Dataaccess_Customer::store($this->parentId, $this->fromId, $this->toId, $this->subject, $this->messageBody);
   	  } 
   	} else {
      $saved = true;
    }
    return $saved;
  }

  
  private function _fillData($record) {
      $this->loaded = true;
      $this->id = $record['ID'];
      $this->parentId = $record['PARENT_ID'];
      $this->fromId = $record['FROM_ID'];
      $this->toId = $record['TO_ID'];
      $this->subject = $record['SUBJECT'];
      $this->messageBody = $record['MESSAGE'];
      $this->messageTime = $record['MESSAGE_TIMESTAMP'];                              
      $this->fromName		= $record['FROM_NAME'];
      $this->toName			= $record['TO_NAME'];
  
  }
}
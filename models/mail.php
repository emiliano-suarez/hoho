<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Mail extends Models_Base  {
  protected $id;
  protected $tag;
  protected $to;
  protected $from;
  protected $subject;
  protected $body;
  protected $startDate;
  protected $sendDate;
  protected $retryCount;
  protected $lastRetry;
  protected $status;
  protected $attachment;
  
  public function getByPk($id) {
    $email = new Models_Mail();

    $emailInfo = data\Dataaccess_MailStorage::getByPk($id);
    
    if (! empty($emailInfo)) {
      $record = $emailInfo[0];
      $email->_fillData($record);
    } else {
      $email->id = $id;
    }
    
    return $email;
  }

  public function save() {
    if ($this->dirty) {
      if ($this->loaded) {
        $saved = data\Dataaccess_MailStorage::update($this->id, $this->tag, $this->to, $this->from, $this->subject, $this->body, $this->startDate, 
                                                     $this->sendDate, $this->retryCount, $this->lastRetry, $this->status, $this->attachment);
      } else {
        $saved = data\Dataaccess_MailStorage::insert($this->tag, $this->to, $this->from, $this->subject, $this->body, $this->startDate, 
                                                     $this->sendDate, $this->retryCount, $this->lastRetry, "new", $this->attachment);
      }
    } else {
      $saved = true;
    }
    
    return $saved;
  }
  
  
  private function _fillData($record) {
    $this->loaded = true;
    $this->id = $record['MAIL_STORAGE_ID'];
    $this->tag = $record['MAIL_TAG'];
    $this->to = $record["MAIL_TO"];
    $this->from = $record["MAIL_FROM"];
    $this->subject = $record['MAIL_SUBJECT'];
    $this->body = $record['MAIL_BODY'];
    $this->startDate = $record['START_DATE'];
    $this->sendDate = $record['SEND_DATE'];
    $this->retryCount = $record['RETRY_COUNT'];
    $this->lastRetry = $record['LAST_RETRY'];
    $this->status = $record['STATUS'];
    $this->attachment = $record['MAIL_ATTACHMENT'];
    
  }
}

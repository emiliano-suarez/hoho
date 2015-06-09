<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_MailTemplate extends Models_Base  {
  protected $id;
  protected $subject;
  protected $body;
  protected $tag;
  
  public function getByPk($id) {
    $template = new Models_MailTemplate();

    $templateInfo = data\Dataaccess_MailTemplate::getByPk($id);
    
    if (! empty($templateInfo)) {
      $record = $templateInfo[0];
      $template->_fillData($record);
    } else {
      $template->id = $id;
    }
    
    return $template;
  }
  
  public function getByTag($tag) {
    $mailTemplate = data\Dataaccess_MailTemplate::getByTag($tag);
    
    if (! empty($mailTemplate)) {
      $template = self::getByPk($mailTemplate[0]["TEMPLATE_ID"]);
    } else {
      $template = new Models_MailTemplate();
      $template->tag = $tag;
    }
    
    return $template;
  }
  
  private function _fillData($record) {
    $this->loaded = true;
    $this->id = $record['TEMPLATE_ID'];
    $this->subject = $record['SUBJECT'];
    $this->body = $record['BODY'];
    $this->tag = $record['TAG'];
  }
  
}

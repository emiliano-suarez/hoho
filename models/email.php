<?php
namespace hoho\models;

use hoho\dataaccess as data;

class Models_Email extends Models_Base  {

    protected $id;
    protected $subject;
    protected $body;
    protected $tag;
    
    public static function getByPk($id) {
    
        $email = new Models_Email();
    
        $emailInfo = data\Dataaccess_Email::getByPk($id);

        if (! empty($emailInfo)) {
           $record = $emailInfo[0];
           $email->_fillData($record);
        } else {
          $email->id = $id;
        }
        
        return $email;
    }
    
    public static function getByTag($tag) {
    
        $email = new Models_Email();
        
        $emailInfo = data\Dataaccess_Email::getByTag($tag);
        
        if (! empty($emailInfo)) {
           $record = $emailInfo[0];
           $email->_fillData($record);
        } else {
          $email->tag = $tag;
        }
        
        return $email;
    }
    
    
    public static function getTags() {
        $tagInfo = data\Dataaccess_Email::getTags();
        $tags = array();        
        
        for($i=0; $i<count($tagInfo); $i++)
        {
            $tags[] = $tagInfo[$i]['TAG'];
        }
        
    
        return $tags;
     }
    
    
    public static function create($params) {
    
        $params['tag'] = trim($params['tag']);
    
        if (self::validateTag($params['tag'])) 
        {
            if (!(in_array($params['tag'], self::getTags()))) 
            {
                $value = data\Dataaccess_Email::create($params);
                return ("OK");
            }
            else
            {
                return("Tag already exists");
            }
        }
        else 
        {
            return("Invalid tag");
        }
    }
    
    
    public static function save($params) {
        $value = data\Dataaccess_Email::save($params);
        return $value;
    }
    
    
    public static function delete($params) {
        $value = data\Dataaccess_Email::delete($params);
        return $value;
    }
    
    
    
    public static function validateTag($tag) {
        if (preg_match('/\s/',$tag)) {
        return false;
        }    
        return true;
    }
    
    
    private function _fillData($record) {
    $this->id = $record['TEMPLATE_ID'];
    $this->subject = $record['SUBJECT'];
    $this->body = $record['BODY'];
    $this->tag = $record['TAG'];
    }
    

}
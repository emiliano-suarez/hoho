<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Messages
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				dm.id, dm.parent_id, dm.from_id, dm.to_id, dm.subject, dm.message, dm.message_timestamp,
      				u1.first_name as from_name,
      				u2.first_name as to_name
              FROM 
                direct_messages dm  JOIN users u1 ON dm.from_id=u1.id
                JOIN users u2 ON dm.to_id=u2.id
              WHERE
                dm.id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }


 
  public static function listAllByUserId($userId)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id
              FROM 
                direct_messages 
              WHERE
                from_id = ? OR to_id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $parameters->addParameter("INT", $userId);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }  

  

  public static function insert($parentId, $fromId, $toId, $subject, $msgBody) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO direct_messages (parent_id, from_id, to_id, subject, message)
              VALUES (?, ?,?,?,?);";

    $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $parentId);        
      $parameters->addParameter("INT", $fromId);    
      $parameters->addParameter("INT", $toId);      
      $parameters->addParameter("STRING", $subject);
      $parameters->addParameter("STRING", $msgBody);
      
    $value = $dbConnection->execute($sql, $parameters);

    if ($value) {
      return $dbConnection->getLastId();
    } else {
      return false;
    }
  }   
 
  
  
}
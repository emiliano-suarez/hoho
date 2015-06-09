<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Lostpassword
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, user_id, request_hash,request_status,request_timestamp,email
              FROM 
                user_password_change_request 
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  
  
  public static function getByHash($email, $hash)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                user_password_change_request  
              WHERE
                email = ? AND request_hash=? AND request_status='Pending'";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $email);
      $parameters->addParameter("STRING", $hash);      
  
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }

  public static function getByEmail($email)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                user_password_change_request  
              WHERE
                email = ? AND request_status='Pending'";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $email);
  
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }  
  

  public static function insert($userId, $requestHash, $requestStatus, $requestTimeStamp, $requestEmail) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO user_password_change_request (user_id, request_hash,request_status,request_timestamp,email)
              VALUES (?,?,?,?,?);";

    $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);    
      $parameters->addParameter("STRING", $requestHash);      
      $parameters->addParameter("STRING", $requestStatus);
      $parameters->addParameter("STRING", $requestTimeStamp);
      $parameters->addParameter("STRING", $requestEmail);      
    $value = $dbConnection->execute($sql, $parameters);

    if ($value) {
      return $dbConnection->getLastId();
    } else {
      return false;
    }
  }   
 

    
  public static function update($id, $userId, $requestHash, $requestStatus, $requestTimeStamp, $requestEmail) {

      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "UPDATE user_password_change_request
                SET 
                  user_id = ?,
                  request_hash = ?, 
                  request_status = ?, 
                  request_timestamp = ?, 
                  email = ?  
              WHERE id = ?";

      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);    
      $parameters->addParameter("STRING", $requestHash);      
      $parameters->addParameter("STRING", $requestStatus);
      $parameters->addParameter("STRING", $requestTimeStamp);
      $parameters->addParameter("STRING", $requestEmail);      
      $parameters->addParameter("INT", $id);

      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
  
  
}
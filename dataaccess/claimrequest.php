<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_ClaimRequest
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, request_hash,request_status,request_timestamp,email, company,investor_id,investor_contact_name,user_id 
              FROM 
                claim_profile_request 
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  
  
  public static function getByHash($email, $hash, $company)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                claim_profile_request  
              WHERE
                email = ? AND 
                request_hash=? AND 
                company=? AND
                request_status='Pending'";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $email);
      $parameters->addParameter("STRING", $hash);      
      $parameters->addParameter("STRING", $company);           
  
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }

  public static function getByEmail($email)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                claim_profile_request  
              WHERE
                email = ? AND request_status='Pending'";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $email);
  
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }  
  

  public static function insert($requestHash, $requestStatus, $requestTimeStamp, $requestEmail, $requestCompany, $investorId, $investorContactName, $userId) {
 
    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO claim_profile_request (request_hash,request_status,request_timestamp,email, company,investor_id,investor_contact_name,user_id)
              VALUES (?,?,?,?,?,?,?,?);";

    $parameters = new Fwk\dbParameters();

      $parameters->addParameter("STRING", $requestHash);      
      $parameters->addParameter("STRING", $requestStatus);
      $parameters->addParameter("STRING", $requestTimeStamp);
      $parameters->addParameter("STRING", $requestEmail);      
      $parameters->addParameter("STRING", $requestCompany);            
      $parameters->addParameter("INT", $investorId);
      $parameters->addParameter("STRING", $investorContactName);            
      $parameters->addParameter("INT", $userId);      
    $value = $dbConnection->execute($sql, $parameters);

    if ($value) {
      return $dbConnection->getLastId();
    } else {
      return false;
    }
  }   
     
  public static function update($id, $requestHash, $requestStatus, $requestTimeStamp, $requestEmail, $requestCompany, $investorId, $investorContactName, $userId) {

      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "UPDATE claim_profile_request
                SET 
                  request_hash = ?, 
                  request_status = ?, 
                  request_timestamp = ?, 
                  email = ?,
                  company=?,
                  investor_id=?,
                  investor_contact_name=?,
                  user_id =?
              WHERE id = ?";

      $parameters = new Fwk\dbParameters(); 
      $parameters->addParameter("STRING", $requestHash);      
      $parameters->addParameter("STRING", $requestStatus);
      $parameters->addParameter("STRING", $requestTimeStamp);
      $parameters->addParameter("STRING", $requestEmail);      
      $parameters->addParameter("STRING", $requestCompany);   
      $parameters->addParameter("INT", $investorId);
      $parameters->addParameter("STRING", $investorContactName);            
      $parameters->addParameter("INT", $userId);         
                     
      $parameters->addParameter("INT", $id);

      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
  
  
}
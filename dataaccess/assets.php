<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Assets
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, user_id,asset_type, asset_name, asset_values, company_id,asset_description, date_created
              FROM 
                assets 
              WHERE
                id = ? ";
  
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
                assets 
              WHERE
                user_id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }

  public static function listAllByCompanyId($companyId)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id
              FROM 
                assets 
              WHERE
                company_id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $companyId);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
    
  


  public static function insert($userId, $assetType, $assetName, $assetDescription, $assetValues, $companyId) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO assets (user_id,asset_type, asset_name, asset_description, asset_values, company_id)
              VALUES (?,?,?,?,?,?);";

    $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);    
      $parameters->addParameter("STRING", $assetType);
      $parameters->addParameter("STRING", $assetName);      
      $parameters->addParameter("STRING", $assetDescription);            
      $parameters->addParameter("STRING", $assetValues);
      $parameters->addParameter("INT", $companyId);          
    $value = $dbConnection->execute($sql, $parameters);

    if ($value) {
      return $dbConnection->getLastId();
    } else {
      return false;
    }
  }   
 

    
  public static function update($id, $userId, $assetType, $assetName, $assetDescription, $assetValues, $companyId) {

      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "UPDATE assets
                SET 
                  user_id=?,
                  asset_type=?, 
                  asset_name=?, 
                  asset_description=?,
                  asset_values=?,
                  company_id=?
              WHERE id = ?";

      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);    
      $parameters->addParameter("STRING", $assetType);      
      $parameters->addParameter("STRING", $assetName);
      $parameters->addParameter("STRING", $assetDescription);      
      $parameters->addParameter("STRING", $assetValues);    
      $parameters->addParameter("INT", $companyId);                                                                                 
      $parameters->addParameter("INT", $id);

      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
  
  
}

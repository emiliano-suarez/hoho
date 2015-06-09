<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class DataAccess_AdminSettings
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id, label, value
              FROM 
                admin_settings  
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }

  public static function listAll()
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                admin_settings";
  
      $parameters = new Fwk\dbParameters();
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  
  public static function update($id, $label, $value)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
      
      $sql = "UPDATE 
                admin_settings 
              SET
                label = ?,
                value = ?
              WHERE 
                id = ?;";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $label);
      $parameters->addParameter("STRING", $value);
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
}
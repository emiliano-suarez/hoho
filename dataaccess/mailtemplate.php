<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class DataAccess_MailTemplate
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                template_id, subject, body, tag
              FROM 
                mail_templates 
              WHERE
                template_id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  
  public static function getByTag($tag)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                template_id
              FROM 
                mail_templates  
              WHERE
                tag = ? ;";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $tag);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
}

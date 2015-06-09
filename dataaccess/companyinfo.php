<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_CompanyInfo
{
    public static function getByPk($id) {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                *
              FROM 
                company_info 
              WHERE
                id = ? ";

      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);

      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
    }

}

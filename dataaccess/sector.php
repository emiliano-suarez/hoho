<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Sector {

    public static function getAll() {
        $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
        $sql = "SELECT * FROM sectors;";

        $parameters = new Fwk\dbParameters();

        $value = $dbConnection->executeQuery($sql, $parameters);
      
        return $value;
    }

}

<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Email {

public static function getByPk($id) {
    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
  
    $sql = "SELECT * FROM mail_templates WHERE template_id=?;";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $id);

    $value = $dbConnection->executeQuery($sql, $parameters);
  
    return $value;
}


public static function getByTag($tag) {
    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
  
    $sql = "SELECT * FROM mail_templates WHERE tag=?;";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("STRING", $tag);

    $value = $dbConnection->executeQuery($sql, $parameters);
  
    return $value;
}


public static function getTags() {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
  
    $sql = "SELECT tag FROM mail_templates;";

    $parameters = new Fwk\dbParameters();

    $value = $dbConnection->executeQuery($sql, $parameters);
  
    return $value;
}
 
 
public static function create($params) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
  
    $sql = "INSERT INTO mail_templates (subject, body, tag) values (?,?,?);";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("STRING", $params['emailSubject']);
    $parameters->addParameter("STRING", $params['emailBody']);
    $parameters->addParameter("STRING", $params['tag']);

    $value = $dbConnection->execute($sql, $parameters);
  
    return $value;
}


public static function save ($params) {
    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
  
    $sql = "UPDATE mail_templates SET subject=?, body=? WHERE tag=?;";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("STRING", $params['emailSubject']);
    $parameters->addParameter("STRING", $params['emailBody']);
    $parameters->addParameter("STRING", $params['tagDropdown']);

    $value = $dbConnection->execute($sql, $parameters);
  
    return $value;
}


public static function delete ($params) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
  
    $sql = "DELETE FROM mail_templates WHERE tag=?;";
    
    foreach($params as $tag) {    
        $parameters = new Fwk\dbParameters();
        $parameters->addParameter("STRING", $tag);
        
        $value = $dbConnection->execute($sql, $parameters);
        }
  
    return $value;
    
}
  
}
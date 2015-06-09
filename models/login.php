<?php

namespace hoho\models;

use hoho\dataaccess as data;

//this is the model that calls to the dataacess for the admin validation
class Models_Login extends Models_Base  {

public static function isUserValid($params=null)
{   
  	if(!isset($_SESSION)) {
    	session_start();
    }
    $valid = data\DataAccess_Login::isValid($params);
    return $valid;
}

public static function getUserByEmail($email)
{   
    $valid = data\DataAccess_Login::getUserByEmail($email);
    return $valid;
}


public static function setLastLoginNow($username)
  {
     $value = data\DataAccess_Login::setLastLoginNow($username);
      return $value;
  }

public static function getAdminIdFromUserName($username){
     $value = data\DataAccess_Login::getAdminIdFromUserName($username);
     return $value;

 }

}
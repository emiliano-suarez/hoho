<?php

namespace hoho\fwk;

class Autoloader {

  public static function Loader($className) {

    $class = self::removeNamespace($className);

    if (! self::checkSpecialCases($class)) {
      $directories = explode("_", $class);
      $path = strtolower(implode("/", $directories));
      $path .= ".php";
      include($_SERVER["DOCUMENT_ROOT"]."/".$path);
    }
  }
  
  private static function removeNamespace($className) {
    $namespaceEnd = strpos($className, "\\");
    $class = $className;
    $i = 0;
    while ($namespaceEnd !== false) {
      $class = substr($class, ($namespaceEnd + 1));
      $namespaceEnd = strpos($class, "\\");
      $i++;
      if ($i > 5) throw new Exception('Invalid class name');
    }
    
    return $class;
  }
  
  private static function checkSpecialCases($className) {
    if ($className == "cache") {
      include($_SERVER["DOCUMENT_ROOT"].'/dataaccess/cacheconn.php');
      return true;
    }
    if ($className == "dbConnProvider") {
      include($_SERVER["DOCUMENT_ROOT"].'/dataaccess/dbconn.php');
      return true;
    }
  }
}

spl_autoload_register(__NAMESPACE__.'\Autoloader::Loader');

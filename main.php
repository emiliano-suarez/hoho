<?php

require "constants/constants.php";
require "fwk/router.php";
require "fwk/controller.php";
require "fwk/view.php";
require "fwk/response.php";
require "fwk/autoloader.php";

use hoho\fwk as Fwk;

try {
  $router = new Fwk\Router($_SERVER["REQUEST_URI"], $_SERVER["DOCUMENT_ROOT"].'/controllers', $_REQUEST);
  
  $file       = $router->controllerFile;
  $className  = $router->className;
  $method     = $router->action;
  $params     = $router->params;

  include($file);
  //TODO config to read parameters required to construct or run each class (like dependency injection)
  $response = new Fwk\response();
  $class = new $className($response);

  $result = $class->initialize();
  if ($result) {
    $class->$method($params);
  }
  $class->finalize();
  
  echo $response->render();
} catch (Exception $ex) {
  $response = new Fwk\response();
  $response->setResponseCode("500");
  $response->setHeader("Content-Type", "text/html; charset=utf-8");
  $response->setBody($ex->getMessage());
  echo $response->render();
}
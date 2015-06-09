<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\admin\lib as Lib;

class Controllers_main extends Controllers_AdminBase {

  public function index($params) {

    $viewName = "index";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho :: Home";

    
    
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
	$this->response->setHeader("X-Location", "/");
    $this->response->setBody($view->render());
  }
}
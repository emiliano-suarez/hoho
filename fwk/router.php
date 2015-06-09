<?php
namespace hoho\fwk;

class Router { 
  private $controllerFile;
  private $className;
  private $action;
  private $params;

  /*@Description: Parses the url to locate proper controller and method to handle the request
    Url Pattern: /controllerName/action?param1=name1&param2=name2
    @params: 
      $uri: Url browsed by the user
      $$controllersRoot: base directory for controllers
  */
  public function __construct($uri, $controllersRoot, $params) {
  
    $urlParts = parse_url($uri);
    $url = $urlParts['path'];

    //Handle particular case the page is /
    if ($url == "/") {
      $this->controllerFile = $controllersRoot."/main.php";
      $this->className = "hoho\\admin\\Controllers_main";
      $this->action = 'index';
      $this->params = $params;
      return;
    }
  
    if (substr($url,0,1) == '/') {
      $url = substr($url, 1);
    }

    $path = explode('/', $url);

    $controllerPath = $controllersRoot;
    $iCounter = 0;

    while ($iCounter < (count($path) - 2)) {
      $controllerPath .= '/'.$path[$iCounter];
      $iCounter++;
    }
    $this->controllerFile = $controllerPath."/".$path[$iCounter].".php";
    $this->className = "hoho\\admin\\Controllers_".$path[$iCounter];
    $this->action = $path[count($path) -1];
    if ($this->action == '') {
      $this->action = 'index';
    }
    $this->params = $params;
  }
  
  //Generic getter, may add code in here in case there are particular needs for the get
  public function __get($key) {
    return $this->$key;
  }
}

<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\helpers as Helpers;

class Controllers_Search extends Controllers_AdminBase {

  /**
  * @function: list
  * @goal: list all assets from user
  */

  public function search($params) {
	
    $viewName = "search/list";
    $view = new Fwk\view($viewName);
    $view->setMasterView('generic');
    $view->pageTitle = "hoho";

    if (isset($params['page'])) {
      $page = $params['page'];
    } else {
      $page = 1;
    }

	 switch ($page) {
			case 1:
						 $from = 0;
						 break;
		 default:
						 $from = ($page - 1)  * PAGINATION;
						 break;
		 }


    $urlModel = "/search?keyword={$params['keyword']}&page=%d";
    $paging = new Helpers\Helpers_Paging($page, $this->pageSize, $urlModel);


		#general, default search
		$arrSearch = array("from" => $from, "size" => PAGINATION, "query" => array("size" => 2, "query_string" => array ("query" => $params['keyword'])));
					
 	  $searchResults = Models\Models_Search::elastic_listAll($arrSearch, $paging, false);
 	  $json = json_decode($searchResults);

		$paging->setTotalResults($json->hits->total); 	  
 	  $view->totalResults = $json->hits->total;
 	  $view->resultsList  = $json->hits->hits;
 	  $view->keyword		  = $params['keyword'];
 	  $view->paging 			= $paging;
 	  
 	  
    $this->response->setResponseCode("200");
    $this->response->setHeader("Content-Type", "text/html; charset=utf-8");
    $this->response->setBody($view->render());
  }

}

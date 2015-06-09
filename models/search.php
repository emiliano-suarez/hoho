<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Search extends Models_Base  {

  protected $itemId;
  protected $itemName;
  protected $itemDescription;

  public static function getByPk($id) {
    $user = new Models_Search();

    $userInfo = data\Dataaccess_Search::getByPk($id);
    
    if (! empty($userInfo)) {
      $record = $userInfo[0];
      $user->_fillData($record);
    } else {
      $user->id = $id;
    }
    
    return $user;
  }


  public static function listAll($keyword, $paging, $filterActive) {
    $assets = data\Dataaccess_Search::listAll($keyword, $filterActive, $paging->page, $paging->pageSize);
    $paging->setTotalResults($assets["totalFound"]);    
    return $assets;
  }

  public static function elastic_listAll($arrObj, $paging, $filterActive) {
    $assets = data\Dataaccess_Search::elastic_listAll($arrObj, $filterActive, $paging->page, $paging->pageSize);
   /// $paging->setTotalResults($assets["totalFound"]);    
    return $assets;
  }


  private function _fillData($record) {
      $this->loaded = true;
      $this->itemId = $record['ID'];      
      $this->itemName = $record['COMPANY_NAME'];
      $this->itemDescription = $record['ONE_LINER'];

  }
}
<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Assets extends Models_Base  {

  protected $id;
  protected $userId;
  protected $assetType;
  protected $TypeName;
  protected $assetName;
  protected $assetDescription;
  protected $assetValues;
  protected $companyId;
  protected $ImgBig;
  protected $ImgSmall;
  protected $statusLabel;
  protected $dateCreated;

  public static function getByPk($id) {
    $user = new Models_Assets();

    $userInfo = data\Dataaccess_Assets::getByPk($id);
    
    if (! empty($userInfo)) {
      $record = $userInfo[0];
      $user->_fillData($record);
    } else {
      $user->id = $id;
    }
    
    return $user;
  }


  public static function listAllByCompanyId($companyId) {
    $assetsList = array();
    
    $assets = data\Dataaccess_Assets::listAllByCompanyId($companyId);

    if (! empty($assets)) {
      foreach ($assets as $asset) {
        $assetsList[] = self::getByPk($asset["ID"]);
      }
    }
    
    return $assetsList;
  }

  public static function listAllByUserId($userId) {
    $assetsList = array();
    
    $assets = data\Dataaccess_Assets::listAllByUserId($userId);

    if (! empty($assets)) {
      foreach ($assets as $asset) {
        $assetsList[] = self::getByPk($asset["ID"]);
      }
    }
    
    return $assetsList;
  }

  public function save() {
    if ($this->dirty) {
      if ($this->loaded) {
        $saved = data\Dataaccess_Assets::update($this->id, $this->userId, $this->assetType, $this->assetName,$this->assetDescription, $this->assetValues, $this->companyId);

                                            
      } else {
        $saved = data\Dataaccess_Assets::insert($this->userId, $this->assetType, $this->assetName,$this->assetDescription, $this->assetValues, $this->companyId);
                                            
        if ($saved) {
          $this->id = $saved;
          $saved = true;
        }
      }
    } else {
      $saved = true;
    }
    return $saved;
  }  
  private function _fillData($record) {
      $this->loaded = true;
      $this->id = $record['ID'];      
      $this->userId = $record['USER_ID'];
      $this->assetType = $record['ASSET_TYPE'];
      $this->assetName = $record['ASSET_NAME'];
      $this->assetDescription = $record['ASSET_DESCRIPTION'];
      $this->assetValues = $record['ASSET_VALUES'];
      $this->companyId	 = $record['COMPANY_ID'];
      $this->dateCreated = $record['DATE_CREATED'];

      $this->_setAssetTypeInfo();
      $this->_setSerializedValues();
  }

  private function _setAssetTypeInfo() {
    $assetType = '';
    $assetType = $assetType ? $assetType : $this->assetType;

    switch ($assetType) {
        case 'technology':
            $this->ImgBig = 'assets_icon_big1.jpg';
            $this->ImgSmall = 'assets_icon2.jpg';
            $this->TypeName = 'Technology';
            break;
        case 'data':
            $this->ImgBig = 'assets_icon_big2.jpg'; 
            $this->ImgSmall = 'assets_icon3.jpg';
            $this->TypeName = 'Data';
            break;
        case 'client':
            $this->ImgBig = 'assets_icon_big3.jpg';
            $this->ImgSmall = 'assets_icon5.jpg';
            $this->TypeName = 'Client Base';
            break;
        case 'user': //customer
            $this->ImgBig = 'assets_icon_big4.jpg';
            $this->ImgSmall = 'assets_icon6.jpg';
            $this->TypeName = 'Customer Base';
            break;
        case 'branding':
            $this->ImgBig = 'assets_icon_big7.jpg';
            $this->ImgSmall = 'assets_icon8.jpg';
            $this->TypeName = 'Branding';
            break;
        case 'team':
            $this->ImgBig = 'assets_icon_big5.jpg';
            $this->ImgSmall = 'assets_icon4.jpg';
            $this->TypeName = 'Team';
            break;
        case 'offices': 
            $this->ImgBig = 'assets_icon_big6.jpg';
            $this->ImgSmall = 'assets_icon7.jpg';
            $this->TypeName = 'Offices';
            break;
        case 'other':
            $this->ImgBig = 'assets_icon_big1.jpg';
            $this->ImgSmall = 'assets_icon9.jpg';
            $this->TypeName = 'Other';
            break;
    }
  }

  private function _setSerializedValues() {
    $assetData = unserialize($this->assetValues);

    switch ($assetData['status']) {
        case 'for_sale':
            $this->statusLabel = 'For Sale';
            break;
        case 'for_exchange':
            $this->statusLabel = 'For Exchange';
            break;
        case 'for_lease':
            $this->statusLabel = 'For Lease';
            break;
        default:
            $this->statusLabel = '';
            break;
    }
    
  }
}


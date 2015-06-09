<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_AdminSetting extends Models_Base  {
  protected $id;
  protected $label;
  protected $value;
  
  public static function getByPk($id) {
    $setting = new Models_AdminSetting();
    $settingInfo = data\Dataaccess_AdminSettings::getByPk($id);
    
    if (! empty($settingInfo)) {
      $record = $settingInfo[0];
      $setting->_fillData($record);
    } else {
      $setting->id = $id;
    }
    
    return $setting;
  }

  public static function listAll() {
    $settingsList = array();
    
    $settings = data\Dataaccess_AdminSettings::listAll();

    if (! empty($settings)) {
      foreach ($settings as $setting) {
        $settingsList[] = self::getByPk($setting["ID"]);
      }
    }
    
    return $settingsList;
  }
  
  public function save() {
    if ($this->dirty) {
      $saved = data\Dataaccess_AdminSettings::update($this->id, $this->label, $this->value);
    } else {
      $saved = true;
    }
    return $saved;
  }
  
  private function _fillData($record) {
      $this->loaded = true;
      $this->id = $record['ID'];
      $this->label = $record['LABEL'];
      $this->value = $record['VALUE'];
  }

}
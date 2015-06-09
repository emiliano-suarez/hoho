<?php

namespace hoho\models;

class Models_Base {
  protected $loaded = false;
  protected $dirty = false;

  public function __get($key) {
    return $this->$key;
  }
  
  public function __set($key, $value) {
    if ($key != 'loaded') {
      //TODO: Validate you can't set attributes which are not in the list.
      $this->$key = $value;
      $this->dirty = true;
    }
  }
}
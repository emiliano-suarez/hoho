<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_Sector extends Models_Base  {

    public static function getAll() {
        $sectors = data\Dataaccess_Sector::getAll();
        return $sectors;
    }
}

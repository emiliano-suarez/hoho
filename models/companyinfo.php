<?php

namespace hoho\models;

use hoho\dataaccess as data;

class Models_CompanyInfo extends Models_Base  {

    protected $id;

    public static function getByPk($id) {
        $profile = new Models_Company();

        $companyInfo = data\Dataaccess_Company::getByPk($id);
    
        if (! empty($companyInfo)) {
            $record = $companyInfo[0];
            $profile->_fillData($record);
        } else {
            $profile->id = $id;
        }
    
        return $profile;
    }

}

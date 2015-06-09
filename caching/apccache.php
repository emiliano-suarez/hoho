<?php
namespace hoho\caching;

class Caching_APCCache {
    var $iTtl = 600; // Time To Live
    var $enabled = false; // APC enabled?

    // constructor
    function __construct() {
        if (!extension_loaded('apc')) {
        	throw new \Exception('APC cache is not available.');
        }
    }

    // get data from memory
    function fetchData($sKey) {
        $bRes = false;
        $vData = apc_fetch($sKey, $bRes);
        return ($bRes) ? $vData : null;
    }

    // save data to memory
    function storeData($sKey, $vData) {
        return apc_store($sKey, $vData, $this->iTtl);
    }

    // delete data from memory
    function deleteData($sKey) {
        return (apc_exists($sKey)) ? apc_delete($sKey) : true;
    }
}

?>
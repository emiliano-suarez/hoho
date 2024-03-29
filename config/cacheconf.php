<?php
define("GLOBALS_SOURCE", 1);
define("APC_SOURCE", 2);
define("GLOBALS_APC", 3);
define("MEMCACHE_SOURCE", 4);
define("GLOBALS_MEMCACHE", 5);
define("APC_MEMCACHE", 6);
define("GLOBALS_APC_MEMCACHE", 7);


define("MEMCACHE_FARM_GENERAL", "general");
/*Configuration of memcache farms
Format:
$memcacheFarms = array(
  "FarmName1" => array("memcacheserver1name" => "memcacheserver1port", "memcacheserver2name" => "memcacheserver2port"),
  "FarmName2" => array("memcacheserver1name" => "memcacheserver1port", "memcacheserver2name" => "memcacheserver2port")
)
*/
static $memcacheFarms = array(
  "general" => array("127.0.0.1" => "11211")
);

static $cacheFamilies = array(
  /*"USER"       => array (
                    "source" => APC_MEMCACHE,
                    "ttl" => array(APC_SOURCE => 3600, MEMCACHE_SOURCE => 86400),
                    "farm" => MEMCACHE_FARM_GENERAL,
                    "flags" => array(MEMCACHE_COMPRESSED)
                ),*/
);
?>
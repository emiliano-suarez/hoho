<?php
namespace hoho\helpers;

use hoho\dataaccess as data;

class Helpers_User {
	
	function splitName($fullName){
	
		$arrName = explode(" ", $fullName);
	
		switch (count($arrName)){
			case 0:
				  return array('first' => '', 'last' => ''); 
				break;
			case 1:
					return array('first' => $arrName[0], 'last' => ''); 
				break;
			case 2:
					return array('first' => $arrName[0], 'last' => $arrName[1]); 			
				break;
			default:
					$first = $arrName[0];
					$last  = '';
					for ($x=1; $x< count($arrName); $x++){
						$last.= $arrName[$x] . ' ';
					}	
					return array('first' => $first, 'last' => $last); 			
				break;
		}
	
	}

}
<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_UserAuthorities {
		
	public static function getUserAuthorities($adminUserId) {
		$dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
  		
  		$sql = "SELECT DISTINCT(ga.authority) FROM admin_user_groups ug INNER JOIN admin_group_authorities ga ON ug.group = ga.group WHERE ug.admin_user_id = ?";
  		$parameters = new Fwk\dbParameters();
		$parameters->addParameter("INT", $adminUserId);
  
      	return $dbConnection->executeQuery($sql, $parameters);
	}
}
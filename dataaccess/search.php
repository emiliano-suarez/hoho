<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Search
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, company_name, one_liner,city ,sector,fundraising_current
              FROM 
                investors 
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }

	public static function elastic_listAll($objClass, $filterActive, $page, $pageSize){
		$url = ELASTIC_HOST . "/hoho/_search";

		$cURL = curl_init();
		curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cURL, CURLOPT_URL, $url);
		curl_setopt($cURL, CURLOPT_CUSTOMREQUEST, "POST"); 				
		curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Accept: application/json'
		));

		curl_setopt($cURL, CURLOPT_POSTFIELDS, json_encode($objClass,JSON_FORCE_OBJECT));		

		$response = curl_exec($cURL);
		return $response; 		
	}

  public static function listAll($keyword, $filterActive, $page, $pageSize)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT SQL_CALC_FOUND_ROWS 
      				id, company_name, one_liner,company_logo_url,city ,sector ,fundraising_current,employees,
      				ifnull(total_assets,0) total_assets
              FROM 
                investors i LEFT JOIN company_assets ca ON
                i.id = ca.company_id 
              WHERE
                company_name LIKE ? ";
      $sql.= " LIMIT ?, ?";                
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", '%'.$keyword.'%');      
      $parameters->addParameter("INT", ($pageSize * ($page - 1)));
      $parameters->addParameter("INT", $pageSize);
      
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;

  }
  
}
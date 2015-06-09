<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Founder
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, founder_name, founder_photo_url,what_i_do,bio_text,profile_taken  
              FROM 
                founders 
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  

  public static function getFounderById($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                founders  
              WHERE
                id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;

      
  }   
  
  public static function addUserFounder($userId, $founderId){
    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
    
    $sql = "INSERT INTO user_founder (user_id, founder_id) VALUES (?,?)";
    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);    
    $parameters->addParameter("INT", $founderId);        
    
  	$value = $dbConnection->execute($sql, $parameters);    

		if ($value){
				$sql = "UPDATE founders SET profile_taken=1 WHERE id=?";
			 $parameters = new Fwk\dbParameters();
			 $parameters->addParameter("INT", $founderId);        
			 $value = $dbConnection->execute($sql, $parameters);				
		}
		
		return $value;  
  
  }
  
  public static function getFounderByName($founderName)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                founders  
              WHERE
                founder_name LIKE ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", '%'.$founderName.'%');
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;

      
  }  
  

  
}
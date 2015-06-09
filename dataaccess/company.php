<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Company
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, original_id, fundraising_current,fundraising_past,company_logo_url, company_name,
      				one_liner, investor_names, city, productDescription,technology,specialties,
      				traction, founders, sector, main_industry, customers,advisors, incubators, press,
      				moreinfo,current_investors, attorneys, employees, contact_details,total_employees,date_created 
              FROM 
                investors 
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  
  public static function addUserCompany($userId, $companyProfileId, $reservePrice=""){

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO user_company (user_id,company_profile_id,reserve_price)
              VALUES (?,?,?);";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);
    $parameters->addParameter("INT", $companyProfileId);
    $parameters->addParameter("DOUBLE", $reservePrice);
      
    $value = $dbConnection->execute($sql, $parameters);
		return $value;
  }

  public static function getCompanyByUserIdCompanyId($userId, $companyId) {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                company_profile_id, reserve_price
              FROM
                user_company
              WHERE
                user_id = ?
                AND company_profile_id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $parameters->addParameter("INT", $companyId);

      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }

  public static function allCompaniesFromUserId($userId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                company_profile_id, reserve_price
              FROM 
                user_company  
              WHERE
              	user_id			 = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
			
			return $return;
  }
  
  public static function getCompanyFromUserId($userId, $companyId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                count(*) Total
              FROM 
                user_company  
              WHERE
              	user_id			 = ? AND
                company_profile_id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $parameters->addParameter("INT", $companyId);  
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }

  public static function getFollowerFromUserId($userId, $companyId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                count(*) Total
              FROM 
                follow_company  
              WHERE
              	follower_id			 = ? AND
                company_id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $parameters->addParameter("INT", $companyId);  
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }

  public static function addFollower($companyId, $userId) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO follow_company (follower_id,company_id)
              VALUES (?,?);";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);    
    $parameters->addParameter("INT", $companyId);                                                 
      
    $value = $dbConnection->execute($sql, $parameters);
		return $value;
		
  }   

  public static function removeFollower($companyId, $userId) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "DELETE FROM follow_company WHERE 
    				follower_id = ? AND
    				company_id = ? LIMIT 1;";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);    
    $parameters->addParameter("INT", $companyId);                                                 
      
    $value = $dbConnection->execute($sql, $parameters);
		return $value;
		
  }  

  public static function getCompanyFollowersById($companyId)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                u.id,u.first_name,u.last_name,u.photo_url,u.what_i_do   
              FROM 
                users u join follow_company cf on u.id=cf.follower_id   
              WHERE
                cf.company_id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $companyId);  
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;
  }  


  public static function getCompanyFoundersById($companyId)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                a.founder_name,a.founder_photo_url,a.bio_text  
              FROM 
                founders a join company_founder cf on a.id=cf.founder_id   
              WHERE
                cf.company_id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $companyId);  
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;
  }  

  public static function getCompanyFromFounderName($founderName)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                investors  
              WHERE
                founders LIKE ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", '%'.$founderName.'%');      
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;
  }  

  
  public static function getCompanyByName($companyName)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                investors  
              WHERE
                company_name = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $companyName);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;
  }  
  

  public static function insert($originalId, $companyName, $oneLiner, $city, $sector,$totalEmployees) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO investors (original_id,company_name, one_liner, city, sector, total_employees,date_created)
              VALUES (?, ?, ?, ?, ?, ?, now());";

    $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $originalId);    
      $parameters->addParameter("STRING", $companyName);      
      $parameters->addParameter("STRING", $oneLiner);
      $parameters->addParameter("STRING", $city);
      $parameters->addParameter("STRING", $sector);
      $parameters->addParameter("INT", $totalEmployees);
    $value = $dbConnection->execute($sql, $parameters);

    if ($value) {
      return $dbConnection->getLastId();
    } else {
      return false;
    }
  }   
 

    
  public static function update($id, $originalId, $fundCurrent, $fundPast, $logoUrl, 
                                $companyName, $oneLiner, $investorNames, $city, $productDescription, $technology,
                                $specialties, $traction, $founders, $sector,
                                $customers, $advisors, $incubators, $press, $moreInfo,$currentInvestors,
                                $attorneys,$employees,$contactDetails,$totalEmployees) {

      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "UPDATE investors
                SET
                    original_id = ?,
                    fundraising_current = ?,
                    fundraising_past = ?,
                    company_logo_url = ?,
                    company_name = ?,
                    one_liner = ?,
                    investor_names = ?,
                    city = ?,
                    productDescription = ?,
                    technology = ?,
                    specialties = ?,
                    traction = ?,
                    founders = ?,
                    sector = ?,
                    customers = ?,
                    advisors = ?,
                    incubators = ?,
                    press = ?,
                    moreinfo = ?,
                    current_investors = ?,
                    attorneys = ?,
                    employees = ?,
                    contact_details = ?,
                    total_employees = ?
              WHERE id = ?";

      $parameters = new Fwk\dbParameters();

      $parameters->addParameter("INT", $originalId);
      $parameters->addParameter("STRING", $fundCurrent);
      $parameters->addParameter("STRING", $fundPast);
      $parameters->addParameter("STRING", $logoUrl);
      $parameters->addParameter("STRING", $companyName);
      $parameters->addParameter("STRING", $oneLiner);
      $parameters->addParameter("STRING", $investorNames);
      $parameters->addParameter("STRING", $city);
      $parameters->addParameter("STRING", $productDescription);
      $parameters->addParameter("STRING", $technology);
      $parameters->addParameter("STRING", $specialties);
      $parameters->addParameter("STRING", $traction);
      $parameters->addParameter("STRING", $founders);
      $parameters->addParameter("STRING", $sector);
      $parameters->addParameter("STRING", $customers);
      $parameters->addParameter("STRING", $advisors);
      $parameters->addParameter("STRING", $incubators);
      $parameters->addParameter("STRING", $press);
      $parameters->addParameter("STRING", $moreInfo);
      $parameters->addParameter("STRING", $currentInvestors);
      $parameters->addParameter("STRING", $attorneys);
      $parameters->addParameter("STRING", $employees);
      $parameters->addParameter("STRING", $contactDetails);
      $parameters->addParameter("INT", $totalEmployees);
      $parameters->addParameter("INT", $id);

      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }

  public static function updateCompanyReservePrice($userId, $companyId, $reservePrice) {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "UPDATE user_company
                SET reserve_price = ?
              WHERE
                user_id = ?
                AND company_profile_id = ?";

      $parameters = new Fwk\dbParameters();

      $parameters->addParameter("DOUBLE", $reservePrice);
      $parameters->addParameter("INT", $userId);
      $parameters->addParameter("INT", $companyId);

      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
}

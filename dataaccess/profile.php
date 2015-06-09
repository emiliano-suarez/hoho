<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_Profile
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, original_id, fundraising_current,fundraising_past,company_logo_url, company_name,
      				one_liner, investor_names, city, productDescription,technology,specialties,
      				traction, founders, sector,customers,advisors, incubators, press,
      				moreinfo,current_investors, attorneys, employees, contact_details
              FROM 
                investors 
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  
  public static function addUserCompany($userId, $companyProfileId,$reservePrice=""){

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO user_company (user_id,company_profile_id,reserve_price)
              VALUES (?,?);";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);
    $parameters->addParameter("INT", $companyProfileId);
    $parameters->addParameter("DOUBLE", $reservePrice);
      
    $value = $dbConnection->execute($sql, $parameters);
		return $value;
  }
  
  public static function getCompanyByName($companyName)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                investors  
              WHERE
                company_name LIKE ?";
  
      $parameters = new Fwk\dbParameters();
     // $parameters->addParameter("STRING", $companyName);
      $parameters->addParameter("STRING", '%'.$companyName.'%');      
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
      
      return $return;

      
  }  
  

  public static function insert($email, $passwordHash, $firstName, $lastName, $companyName, $address_1, $address_2,$zip, $state, $country, $status
  ,$photoUrl,$whatIDo, $bio, $education, $experience, $links, $skills) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO users (email,password, first_name, last_name, company_name, address_1, address_2, zip,state,country, status,photo_url,what_i_do,bio)
              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

    $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $email);    
      $parameters->addParameter("STRING", $passwordHash);      
      $parameters->addParameter("STRING", $firstName);
      $parameters->addParameter("STRING", $lastName);
      $parameters->addParameter("STRING", $companyName);
      $parameters->addParameter("STRING", $address_1);
      $parameters->addParameter("STRING", $address_2);
      $parameters->addParameter("STRING", $zip);
      $parameters->addParameter("STRING", $state);
      $parameters->addParameter("STRING", $country);
      $parameters->addParameter("STRING", $status);                                    
      $parameters->addParameter("STRING", $photoUrl);                                    
      $parameters->addParameter("STRING", $whatIDo);                                    
      $parameters->addParameter("STRING", $bio);                                                      
      
    $value = $dbConnection->execute($sql, $parameters);

    if ($value) {
      return $dbConnection->getLastId();
    } else {
      return false;
    }
  }   
 

    
  public static function update($id, $firstName, $lastName, $companyName, $address_1, $address_2,$zip, $state, $country, $status, $password
    ,$photoUrl,$whatIDo, $bio, $education, $experience, $links,$location, $skills) {

      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "UPDATE users
                SET 
                  first_name = ?,
                  last_name = ?, 
                  company_name = ?, 
                  address_1 = ?, 
                  address_2 = ?,                   
                  zip = ?,                   
                  state = ?,                   
                  country = ?,                   
                  status= ?,
                  password=?,
                  photo_url=?,
                  what_i_do=?,
                  bio=?,
                  education=?,
                  experience=?,
                  links=?,
                  locations=?,
                  skills=?
              WHERE id = ?";

      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $firstName);
      $parameters->addParameter("STRING", $lastName);
      $parameters->addParameter("STRING", $companyName);
      $parameters->addParameter("STRING", $address_1);
      $parameters->addParameter("STRING", $address_2);
      $parameters->addParameter("STRING", $zip);
      $parameters->addParameter("STRING", $state);
      $parameters->addParameter("STRING", $country);
      $parameters->addParameter("STRING", $status);   
      $parameters->addParameter("STRING", $password);   
      $parameters->addParameter("STRING", $photoUrl);                                    
      $parameters->addParameter("STRING", $whatIDo);                                    
      $parameters->addParameter("STRING", $bio);   
      $parameters->addParameter("STRING", $education);   
      $parameters->addParameter("STRING", $experience);   
      $parameters->addParameter("STRING", $links);   
      $parameters->addParameter("STRING", $location);         
      $parameters->addParameter("STRING", $skills);                                                                              
      $parameters->addParameter("INT", $id);

      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
  
  
}

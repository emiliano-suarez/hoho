<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_User
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      				id, password, email,first_name, last_name, company_name,address_1, address_2, zip, state, 
      				country,date_created,status,photo_url,what_i_do,bio,
      				education, experience, links, locations, skills
              FROM 
                users 
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }

  public static function getUserById($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                  u.id
              FROM 
                  users u
              WHERE
                  u.id = ?; ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }  

  public static function getAllFollowing($userId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");  
      $sql = "SELECT 
                u.id, u.first_name,u.last_name,u.what_i_do,u.photo_url 
              FROM 
                follow_user fu JOIN users u ON fu.following_id = u.id 
              WHERE
              	fu.follower_id			 = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
			
			return $return;
  }  

  public static function getAllFollowers($userId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");  
      $sql = "SELECT 
                u.id, u.first_name,u.last_name,u.what_i_do,u.photo_url 
              FROM 
                follow_user fu JOIN users u ON fu.follower_id = u.id 
              WHERE
              	fu.following_id			 = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      $sql = "SELECT FOUND_ROWS() as total";
      $parameters = new Fwk\dbParameters();
      $totals = $dbConnection->executeQuery($sql, $parameters);
      
      $return = array("totalFound" => $totals[0]["TOTAL"], "results" => $value);
			
			return $return;
  }
	

  public static function getFollowerFromUserId($followerId, $followingId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                count(*) Total
              FROM 
                follow_user  
              WHERE
              	follower_id			 = ? AND
                following_id = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $followerId);
      $parameters->addParameter("INT", $followingId);  
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }

  public static function getFollowersCount($userId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                count(*) Total
              FROM 
                follow_user  
              WHERE
              	following_id			 = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }  


  public static function getFollowingCount($userId){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                count(*) Total
              FROM 
                follow_user  
              WHERE
              	follower_id			 = ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
      $value = $dbConnection->executeQuery($sql, $parameters);
      
      return $value;
  }  
  
  

  public static function addFollower($userProfileId, $userId) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "INSERT INTO follow_user (follower_id,following_id)
              VALUES (?,?);";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);    
    $parameters->addParameter("INT", $userProfileId);                                                 
      
    $value = $dbConnection->execute($sql, $parameters);
		return $value;
		
  }   

  public static function removeFollower($userProfileId, $userId) {

    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
    $sql = "DELETE FROM follow_user WHERE 
    				follower_id = ? AND
    				following_id = ? LIMIT 1;";

    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);    
    $parameters->addParameter("INT", $userProfileId);                                                 
      
    $value = $dbConnection->execute($sql, $parameters);
		return $value;
		
  }  


  public static function getUserByEmail($emailAddress)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                  u.id,u.first_name,u.last_name,u.password,ue.email_id 
              FROM 
                  users u
                  INNER JOIN user_emails ue ON ue.user_id = u.id
                  INNER JOIN emails e ON e.id = ue.email_id
              WHERE
                  e.email = ?; ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $emailAddress);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }  
  
  public static function listCompaniesByUserId($userId)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                uc.company_profile_id, i.company_name 
              FROM 
                users  u JOIN user_company uc on  u.id = uc.user_id JOIN investors i
                ON uc.company_profile_id = i.id
              WHERE
                u.id=?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $userId);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
    
  public static function getByEmail($email)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                users  
              WHERE
                email = ? AND status='Active'";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $email);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }  
  

  public static function insert($email, $passwordHash, $firstName, $lastName, $companyName, $address_1, $address_2,$zip, 
  $state, $country, $status,$photoUrl,$whatIDo, $bio) {

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
 
  public static function addNewEmail($email){
    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
    
    $sql = "INSERT INTO emails (email, confirmed) VALUES (?,1)";
    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("STRING", $email);    
    
  	$value = $dbConnection->execute($sql, $parameters);    
    if ($value) {
      return $dbConnection->getLastId();
    } else {
      return false;
    }

  }

  public static function addNewUserEmail($userId, $emailId, $isDefault){
    $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
    
    $sql = "INSERT INTO user_emails (user_id, email_id, is_default) VALUES (?,?,?)";
    $parameters = new Fwk\dbParameters();
    $parameters->addParameter("INT", $userId);    
    $parameters->addParameter("INT", $emailId);        
    $parameters->addParameter("INT", $isDefault);            
    
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

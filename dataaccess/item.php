<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class DataAccess_Item
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
      			id,name, description, varietal, vintage, origin,organic, price,
      			not_discountable, available_from_distributor, available_inventory,
      			color, body,on_tasting_machine, featured,available_for_web, vintner 
              FROM 
                wines
              WHERE
                id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }


    public static function getByDescription($name){
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                id
              FROM 
                wines 
              WHERE
                name LIKE ?";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", '%'.$name.'%');
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }


  
  public static function update($itemId, $itemName, $itemDescription, $varietal,
        	$vintage,$origin,$organic, $itemPrice, $availableFromDistributor,
         	$availableInventory, $itemColor, $itemBody, $itemFeatured, $availableForWeb, $vintner, $discountable) {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
      
      $sql = "UPDATE 
                wines 
              SET 
                 name = ?, 
                 description = ?,
                 varietal = ?,
                 vintage = ?,
                 origin = ?,
                 organic = ?,
                 price = ? ,
                 available_from_distributor= ?,
                 available_inventory= ?,
                 color = ?,
                 body= ?,
                 featured= ?,
                 available_for_web= ?,
                 vintner=? ,
                 not_discountable=? 
              WHERE
                 id = ?;";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $itemName);
      $parameters->addParameter("STRING", $itemDescription);
      $parameters->addParameter("STRING", $varietal);      
      $parameters->addParameter("STRING", $vintage);      
      $parameters->addParameter("STRING", $origin);            
      $parameters->addParameter("INT", $organic);                      
      $parameters->addParameter("DOUBLE", $itemPrice);            
      $parameters->addParameter("INT", $availableFromDistributor);            
      $parameters->addParameter("INT", $availableInventory);                  
      $parameters->addParameter("STRING", $itemColor);                        
      $parameters->addParameter("STRING", $itemBody);                              
      $parameters->addParameter("INT", $itemFeatured);                              
      $parameters->addParameter("INT", $availableForWeb);                          
      $parameters->addParameter("STRING", $vintner);                          
      $parameters->addParameter("INT", $discountable);          
      $parameters->addParameter("INT", $itemId);
  
      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }

  public static function delete($id)
  {
  	//error_log($id);
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
      
      $sql = "DELETE FROM k_product WHERE kp_id = ?;";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
}
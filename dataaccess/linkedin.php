<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class Dataaccess_LinkedIn
{
    public static function getTokenByEmailId($emailId) {
        $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");

        $sql = "SELECT 
                token, expiration_date
              FROM 
                email_linkedin_token
              WHERE
                email_id = ? ";

        $parameters = new Fwk\dbParameters();
        $parameters->addParameter("STRING", $emailId);

        $value = $dbConnection->executeQuery($sql, $parameters);

        return $value;
    }

    public static function insertToken($emailId, $token, $expirationDate) {
        $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
           
        $sql = "INSERT INTO email_linkedin_token
                    (email_id, token, expiration_date)
                VALUES (?, ?, ?);";

        $parameters = new Fwk\dbParameters();
        $parameters->addParameter("INT", $emailId);
        $parameters->addParameter("STRING", $token);
        $parameters->addParameter("INT", $expirationDate);

        $value = $dbConnection->execute($sql, $parameters);

        if ($value) {
            return $dbConnection->getLastId();
        } else {
            return false;
        }
    }

    public static function updateToken($emailId, $token, $expirationDate) {
        $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");

        $sql = "UPDATE email_linkedin_token
                    SET
                        token = ?,
                        expiration_date = ?
                WHERE
                    email_id = ?";

        $parameters = new Fwk\dbParameters();
        $parameters->addParameter("STRING", $token);
        $parameters->addParameter("INT", $expirationDate);
        $parameters->addParameter("INT", $emailId);

        $value = $dbConnection->execute($sql, $parameters);

        return $value;
    }
}

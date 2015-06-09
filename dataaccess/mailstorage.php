<?php
namespace hoho\dataaccess;
use hoho\fwk\dataaccess as Fwk;

class DataAccess_MailStorage
{
  public static function getByPk($id)
  {
      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_READ");
      
      $sql = "SELECT 
                mail_storage_id, mail_tag, mail_to, mail_from, mail_subject, mail_body, start_date,
                send_date, retry_count, last_retry, status,mail_attachment 
              FROM 
                mail_storage 
              WHERE
                mail_storage_id = ? ";
  
      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("INT", $id);
  
      $value = $dbConnection->executeQuery($sql, $parameters);

      return $value;
  }
  
  public static function insert($tag, $to, $from, $subject, $body, $startDate, $sendDate, $retryCount, $lastRetry, $status, $mail_attachment) {

      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "INSERT INTO mail_storage (mail_tag, mail_to, mail_from, mail_subject, mail_body, start_date, send_date, retry_count, last_retry, status,mail_attachment)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $tag);
      $parameters->addParameter("STRING", $to);
      $parameters->addParameter("STRING", $from);
      $parameters->addParameter("STRING", $subject);
      $parameters->addParameter("STRING", $body);
      $parameters->addParameter("STRING", $startDate);
      $parameters->addParameter("STRING", $sendDate);
      $parameters->addParameter("INT", $retryCount);
      $parameters->addParameter("STRING", $lastRetry);
      $parameters->addParameter("STRING", $status);
      $parameters->addParameter("STRING", $mail_attachment);
      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
  
  public static function update($id, $tag, $to, $from, $subject, $body, $startDate, $sendDate, $retryCount, $lastRetry, $status, $mail_attachment) {

      $dbConnection = Fwk\dbConnProvider::getConnection("SITE_WRITE");
       
      $sql = "UPDATE 
                mail_storage
              SET 
                mail_tag = ?, 
                mail_to = ?, 
                mail_from = ?, 
                mail_subject = ?, 
                mail_body = ?, 
                start_date = ?, 
                send_date = ?, 
                retry_count = ?, 
                last_retry = ?, 
                status = ?,
                mail_attachment = ?
              WHERE 
                mail_storage_id = ?";

      $parameters = new Fwk\dbParameters();
      $parameters->addParameter("STRING", $tag);
      $parameters->addParameter("STRING", $to);
      $parameters->addParameter("STRING", $from);
      $parameters->addParameter("STRING", $subject);
      $parameters->addParameter("TEXT", $body);
      $parameters->addParameter("STRING", $startDate);
      $parameters->addParameter("STRING", $sendDate);
      $parameters->addParameter("INT", $retryCount);
      $parameters->addParameter("STRING", $lastRetry);
      $parameters->addParameter("STRING", $status);
      $parameters->addParameter("STRING", $mail_attachment);      
      $parameters->addParameter("INT", $id);

      $value = $dbConnection->execute($sql, $parameters);

      return $value;
  }
}

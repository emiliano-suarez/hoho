CREATE TABLE `email_linkedin_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_id` int(10) NOT NULL,
  `token` varchar(250) DEFAULT NULL,
  `expiration_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-email_id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `company_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `founding_type` varchar(255) NOT NULL,
  `founding_date` int(11) DEFAULT NULL,
  `founding_ammount` DECIMAL(12,2),
  PRIMARY KEY (`id`),
  KEY `idx-company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

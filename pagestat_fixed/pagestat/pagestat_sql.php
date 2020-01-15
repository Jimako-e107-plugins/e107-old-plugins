CREATE TABLE `pagestat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `page` varchar(100) DEFAULT NULL,
  `cnt` bigint(20) NOT NULL DEFAULT '1',
	`item_id` int(10) NOT NULL ,
	`item_type` varchar(8) NOT NULL,    
  PRIMARY KEY (`id`),
  FULLTEXT KEY `page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
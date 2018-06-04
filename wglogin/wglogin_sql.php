CREATE TABLE IF NOT EXISTS `wglogin_users` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `expires_at` int(11) NOT NULL,
  `clan_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `wglogin_userclasses` (
  `clid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `name_i18n` varchar(50) NOT NULL,
  `userclass_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`clid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

INSERT INTO `wglogin_userclasses` (`clid`, `name`, `name_i18n`, `userclass_id`) VALUES
(1, 'commander', 'Командующий', 3),
(2, 'executive_officer', 'Заместитель командующего', 3),
(3, 'personnel_officer', 'Офицер штаба', 3),
(4, 'combat_officer', 'Командир подразделения', 5),
(5, 'intelligence_officer', 'Офицер разведки', 5),
(6, 'quartermaster', 'Офицер снабжения', 5),
(7, 'recruitment_officer', 'Офицер по кадрам', 5),
(8, 'junior_officer', 'Младший офицер', 5),
(9, 'private', 'Боец', 4),
(10, 'recruit', 'Новобранец', 4),
(11, 'reservist', 'Резервист', 4);"
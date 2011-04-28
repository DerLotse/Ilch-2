RENAME TABLE `ilchcms2x`.`ic1_modmanager_modules` TO `ilchcms2x`.`ic1_modules`;

UPDATE `ilchcms2x`.`ic1_modules` SET `core` = '0' WHERE `ic1_modules`.`folder` = 'welcome' AND `ic1_modules`.`core` =1 LIMIT 1 ;

CREATE TABLE IF NOT EXISTS `ic1_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder` varchar(255) NOT NULL,
  `core` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `ic1_themes` (`folder`, `core`, `active`) VALUES
('ilchcms', 1, 1);
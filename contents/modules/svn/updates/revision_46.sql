CREATE TABLE IF NOT EXISTS `ic1_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) NOT NULL,
  `config_key` varchar(32) NOT NULL,
  `category_name` varchar(32) NOT NULL,
  `config_description` text NOT NULL,
  `field_type` varchar(16) NOT NULL,
  `config_value` text NOT NULL,
  `field_options` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `ic1_config` (`id`, `group_name`, `config_key`, `category_name`, `config_description`, `field_type`, `config_value`, `field_options`) VALUES
(1, 'ilch', 'start_controller', 'Allgemeine Einstellungen', 'Welcher Controller soll als Startseite dienen?', 'select', 's:7:"welcome";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:16:"list_controllers";}'),
(2, 'ilch', 'default_backend_theme', 'Allgemeine Einstellungen', 'Welches Backend-Theme soll als Standard genutzt werden?', 'select', 's:7:"ilchcms";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:19:"list_backend_themes";}'),
(3, 'ilch', 'default_frontend_theme', 'Allgemeine Einstellungen', 'Welches Frontend-Theme soll als Standard genutzt werden?', 'select', 's:7:"ilchcms";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:20:"list_frontend_themes";}'),
(4, 'ilch', 'svn_version', '', '', 'hidden', '', '');

CREATE TABLE IF NOT EXISTS `ic1_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `core` int(2) NOT NULL,
  `active` int(2) NOT NULL,
  `name` varchar(32) NOT NULL,
  `version` decimal(11,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `ic1_modules` (`id`, `core`, `active`, `name`, `version`) VALUES
(1, 0, 1, 'welcome', '0.0001'),
(2, 1, 1, 'media', '1.0000'),
(3, 0, 1, 'blueprint', '1.0000'),
(4, 0, 1, 'svn', '1.0000');

CREATE TABLE IF NOT EXISTS `ic1_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(2) NOT NULL,
  `name` varchar(32) NOT NULL,
  `version` decimal(11,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `ic1_themes` (`id`, `active`, `name`, `version`) VALUES
(1, 1, 'ilchcms', '0.0001');
CREATE TABLE IF NOT EXISTS `ic1_modmanager_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder` varchar(255) NOT NULL,
  `core` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `ic1_modmanager_modules` (`folder`, `core`, `active`) VALUES
('welcome', 1, 1);

CREATE TABLE IF NOT EXISTS `ic1_svn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `revision` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
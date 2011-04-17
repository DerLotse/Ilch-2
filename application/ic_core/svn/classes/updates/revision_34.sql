CREATE TABLE IF NOT EXISTS `ic1_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `ic1_users` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@localhost', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'nutzer', 'nutzer@localhost', '408c04d625ffeb6ba875484778a658a2');
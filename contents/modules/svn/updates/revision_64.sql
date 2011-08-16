CREATE TABLE IF NOT EXISTS `$prefix_group_users` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$prefix_groups` (`group_id`, `group_parent_id`, `group_core`, `group_name`) VALUES (NULL, NULL, '1', 'ADMIN');

CREATE TABLE IF NOT EXISTS `$prefix_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_group` varchar(32) NOT NULL,
  `permission_key` varchar(32) NOT NULL,
  `permission_category` varchar(32) NOT NULL,
  `permission_description` text NOT NULL,
  `permission_value` int(11) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE  `$prefix_group_permissions` (
`group_id` INT NOT NULL ,
`permission_id` INT NOT NULL ,
PRIMARY KEY (  `group_id` ,  `permission_id` )
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE  `$prefix_group_config` (
`group_id` INT NOT NULL ,
`config_id` INT NOT NULL ,
PRIMARY KEY (  `group_id` ,  `config_id` )
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `$prefix_modules` (`module_id`, `module_directory`, `module_active`, `module_name`, `module_version`) VALUES (NULL, 'core_ilch', '1', 'permission', '1');
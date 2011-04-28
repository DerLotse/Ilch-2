CREATE TABLE `ilchcms2x`.`ic1_users` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT ,
`status` INT( 1 ) NOT NULL COMMENT '0 = Account creation is not complete; 1 = Approved; 2 = Locked',
`name` VARCHAR( 16 ) NOT NULL COMMENT 'User names have a maximum of 16 characters',
`email` VARCHAR( 64 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL COMMENT 'Passwords are md5 encrypted',
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM ;

CREATE TABLE `ilchcms2x`.`ic1_groups` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 32 ) NOT NULL ,
`master` INT( 1 ) NOT NULL COMMENT '1 = Group is assigned to the user after registration',
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM ;

CREATE TABLE `ilchcms2x`.`ic1_group_settings` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT ,
`group_id` INT( 8 ) NOT NULL ,
`setting_name` VARCHAR( 32 ) NOT NULL ,
`setting_value` TEXT NOT NULL ,
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM ;

CREATE TABLE `ilchcms2x`.`ic1_group_permissions` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT ,
`group_id` INT( 8 ) NOT NULL ,
`permission_name` VARCHAR( 32 ) NOT NULL ,
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM ;

CREATE TABLE `ilchcms2x`.`ic1_group_users` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT ,
`group_id` INT( 8 ) NOT NULL ,
`user_id` INT( 8 ) NOT NULL ,
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM ;

CREATE TABLE `ilchcms2x`.`ic1_settings` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 32 ) NOT NULL ,
`module` VARCHAR( 32 ) NOT NULL ,
`position` INT( 8 ) NOT NULL ,
`category` VARCHAR( 32 ) NOT NULL ,
`description` TEXT NOT NULL ,
`type` VARCHAR( 16 ) NOT NULL ,
`value` TEXT NOT NULL ,
`options` TEXT NOT NULL ,
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM ;

CREATE TABLE `ilchcms2x`.`ic1_permissions` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 32 ) NOT NULL ,
`module` VARCHAR( 32 ) NOT NULL ,
`position` INT( 8 ) NOT NULL ,
`category` VARCHAR( 32 ) NOT NULL ,
`description` INT NOT NULL ,
`value` INT NOT NULL ,
PRIMARY KEY ( `id` ) ,
INDEX ( `id` )
) ENGINE = MYISAM ;

INSERT INTO `ilchcms2x`.`ic1_settings` (`id`, `name`, `module`, `position`, `category`, `description`, `type`, `value`, `options`) VALUES (NULL, 'svn_revision', 'svn', '0', 'Subversion', 'Current SVN database version', 'hidden', '41', '');

DROP TABLE `ic1_svn`
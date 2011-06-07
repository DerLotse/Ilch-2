INSERT INTO `ilchcms2x`.`ic1_modules` (`id`, `core`, `active`, `name`, `version`) VALUES (NULL, '1', '1', 'auth', '0');
INSERT INTO `ilchcms2x`.`ic1_modules` (`id`, `core`, `active`, `name`, `version`) VALUES (NULL, '1', '1', 'userguide', '0');

INSERT INTO `ic1_config` (`group_name`, `config_key`, `category_name`, `config_description`, `field_type`, `config_value`, `field_options`) VALUES
('auth', 'hash_key', 'Usercontrol', '', 'input', 's:58:"Muss waehrend der Installation automatisch erstellt werden";', '');

CREATE TABLE IF NOT EXISTS `ic1_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` int(32) NOT NULL,
  `password` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM ;

CREATE TABLE `ilchcms2x`.`ic1_user_tokens` (
`id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT( 11 ) UNSIGNED NOT NULL ,
`user_agent` VARCHAR( 40 ) NOT NULL ,
`token` VARCHAR( 40 ) NOT NULL ,
`created` INT( 11 ) UNSIGNED NOT NULL ,
`expires` INT( 11 ) UNSIGNED NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE `ic1_user_tokens` CHANGE `user_agent` `user_agent` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `token` `token` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

ALTER TABLE `ic1_users` CHANGE `id` `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `name` `name` INT( 32 ) UNSIGNED NOT NULL ,
CHANGE `password` `password` INT( 100 ) UNSIGNED NOT NULL ;

ALTER TABLE `ic1_themes` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `active` `active` INT( 2 ) UNSIGNED NOT NULL ;

ALTER TABLE `ic1_modules` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `core` `core` INT( 2 ) UNSIGNED NOT NULL ,
CHANGE `active` `active` INT( 2 ) UNSIGNED NOT NULL ;

ALTER TABLE `ic1_config` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ;
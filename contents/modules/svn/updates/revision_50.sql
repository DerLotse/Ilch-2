UPDATE `ic1_modules` SET `active` = '0' WHERE `ic1_modules`.`name` = 'auth';

ALTER TABLE `ic1_users` CHANGE `name` `name` VARCHAR( 32 ) NOT NULL ,
CHANGE `password` `password` VARCHAR( 100 ) NOT NULL;

INSERT INTO `ic1_users` (`id`, `name`, `password`) VALUES (NULL, 'Admin', 'd236d09421c0d90c1154e2f454747e86cbb923dcfbcdc572afbac647850021fb');

ALTER TABLE `ic1_users` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `ic1_user_tokens` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `ic1_users` CHANGE `name` `name` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `password` `password` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

INSERT INTO `ic1_config` (`id`, `group_name`, `config_key`, `category_name`, `config_description`, `field_type`, `config_value`, `field_options`) VALUES (NULL, 'auth', 'token_expires', 'Usercontrol', 'Wie viele Stunden ist ein automatischer Login möglich?', 'input', 's:2:"48";', '');

INSERT INTO `ic1_config` (`id`, `group_name`, `config_key`, `category_name`, `config_description`, `field_type`, `config_value`, `field_options`) VALUES (NULL, 'cookie', 'salt', '', '', 'input', 's:58:"Muss waehrend der Installation automatisch erstellt werden";', '');
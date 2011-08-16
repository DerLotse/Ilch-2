CREATE TABLE `$prefix_user_confirmations` (
`confirmation_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` INT UNSIGNED NOT NULL ,
`confirmation_key` VARCHAR( 40 ) NOT NULL ,
`confirmation_type` VARCHAR( 10 ) NOT NULL ,
`confirmation_data` VARCHAR( 255 ) NOT NULL
) ENGINE = MYISAM ;

ALTER TABLE `$prefix_users` ADD `user_status` INT UNSIGNED NOT NULL AFTER `id`;

ALTER TABLE `$prefix_config` CHANGE `id` `config_id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `group_name` `config_group` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `category_name` `config_category` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `field_type` `config_field_type` VARCHAR( 16 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `field_options` `config_field_options` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

INSERT INTO `$prefix_config` (`config_group`, `config_key`, `config_category`, `config_description`, `config_field_type`, `config_value`, `config_field_options`) VALUES ('auth', 'register_activation', 'Usercontrol', 'Welche Schritte müssen nach der Registrierung eines neuen Benutzers erfolgen?', 'select_multiple', 'a:2:{s:18:"admin_confirmation";s:1:"1";s:18:"email_confirmation";s:1:"1";}', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:19:"list_register_types";}');

ALTER TABLE `$prefix_modules` CHANGE `id` `module_id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `core` `module_core` INT( 2 ) UNSIGNED NOT NULL ,
CHANGE `active` `module_active` INT( 2 ) UNSIGNED NOT NULL ,
CHANGE `name` `module_name` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `version` `module_version` DECIMAL( 11, 4 ) NOT NULL;

ALTER TABLE `$prefix_sessions` CHANGE `session_id` `session_id` VARCHAR( 24 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `last_active` `session_last_active` INT( 10 ) UNSIGNED NOT NULL ,
CHANGE `contents` `session_contents` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `$prefix_themes` CHANGE `id` `theme_id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `active` `theme_active` INT( 2 ) UNSIGNED NOT NULL ,
CHANGE `name` `theme_name` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `version` `theme_version` DECIMAL( 11, 4 ) NOT NULL;

ALTER TABLE `$prefix_users` CHANGE `id` `user_id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_status` `user_status` INT( 10 ) UNSIGNED NOT NULL ,
CHANGE `name` `user_login` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `password` `user_password` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `$prefix_user_tokens` CHANGE `id` `user_token_id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL ,
CHANGE `user_agent` `user_agent` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `token` `user_token_key` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE `created` `user_token_created` INT( 11 ) UNSIGNED NOT NULL ,
CHANGE `expires` `user_token_expires` INT( 11 ) UNSIGNED NOT NULL;

UPDATE `$prefix_config` SET `config_key` = 'user_token_expires' WHERE `$prefix_config`.`config_key` = 'token_expires';
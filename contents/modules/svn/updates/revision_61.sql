UPDATE `ic1_users` SET `user_status` = '1' WHERE `ic1_users`.`user_id` = 1;

CREATE TABLE `ic1_groups` (
`group_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`group_parent_id` INT UNSIGNED NULL ,
`group_core` INT UNSIGNED NOT NULL ,
`group_name` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL 
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `ic1_groups` (`group_id`, `group_parent_id`, `group_core`, `group_name`) VALUES (NULL, NULL, '1', 'SUPERADMIN');

INSERT INTO `ic1_modules` (`module_id`, `module_directory`, `module_active`, `module_name`, `module_version`) VALUES (NULL, NULL, '1', 'cache', '1');
UPDATE `$prefix_users` SET `user_status` = '1' WHERE `$prefix_users`.`user_id` = 1;

CREATE TABLE `$prefix_groups` (
`group_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`group_parent_id` INT UNSIGNED NULL ,
`group_core` INT UNSIGNED NOT NULL ,
`group_name` VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL 
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `$prefix_groups` (`group_id`, `group_parent_id`, `group_core`, `group_name`) VALUES (NULL, NULL, '1', 'SUPERADMIN');

INSERT INTO `$prefix_modules` (`module_id`, `module_directory`, `module_active`, `module_name`, `module_version`) VALUES (NULL, NULL, '1', 'cache', '1');
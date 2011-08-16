ALTER TABLE  `$prefix_group_users` ADD  `user_main_group` INT UNSIGNED NOT NULL;
INSERT INTO `$prefix_modules` (`module_id`, `module_directory`, `module_active`, `module_name`, `module_version`) VALUES (NULL, 'core_ilch', '1', 'group', '1');
UPDATE  `$prefix_groups` SET  `group_parent_id` =  '2' WHERE  `$prefix_groups`.`group_id` =1;
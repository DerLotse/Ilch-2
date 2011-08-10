ALTER TABLE  `ic1_group_users` ADD  `user_main_group` INT UNSIGNED NOT NULL;
INSERT INTO `ic1_modules` (`module_id`, `module_directory`, `module_active`, `module_name`, `module_version`) VALUES (NULL, 'core_ilch', '1', 'group', '1');
UPDATE  `ic1_groups` SET  `group_parent_id` =  '2' WHERE  `ic1_groups`.`group_id` =1;
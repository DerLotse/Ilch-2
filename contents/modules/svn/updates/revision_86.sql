TRUNCATE TABLE  `$prefix_modules`;

INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'ilch_basic', '2.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'ilch_controller', '2.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'ilch_group', '2.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'ilch_jquery', '2.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'ilch_jquery-ui', '2.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'ilch_media', '2.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'ilch_tinymce', '2.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'ilch_user', '2.00000000');

INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'kohana_auth', '2.30001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'kohana_cache', '2.30001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'kohana_codebench', '2.30001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'kohana_database', '2.30001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'kohana_image', '2.30001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'kohana_orm', '2.30001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'kohana_unittest', '2.30001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'kohana_userguide', '2.30001000');

INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'blueprint', '1.00001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'cache', '1.00001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('2', 'news', '1.00000000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'svn', '1.00001000');
INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_status`, `module_name`, `module_version`) VALUES ('1', 'welcome', '1.00000000');

UPDATE  `ilchcms2x`.`$prefix_config` SET  `config_value` =  's:7:"backend";' WHERE  `$prefix_config`.`config_key` = 'default_backend_theme' LIMIT 1 ;
UPDATE  `ilchcms2x`.`$prefix_config` SET  `config_value` =  's:8:"frontend";' WHERE  `$prefix_config`.`config_key` = 'default_frontend_theme' LIMIT 1 ;
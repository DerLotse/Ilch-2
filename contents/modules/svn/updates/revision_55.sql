ALTER TABLE `$prefix_modules` CHANGE `module_core` `module_directory` VARCHAR( 64 ) NULL;

UPDATE `$prefix_modules` SET `module_directory` = '' WHERE `$prefix_modules`.`module_name` = 'welcome';

UPDATE `$prefix_modules` SET `module_directory` = 'core_ilch' WHERE `$prefix_modules`.`module_name` = 'media';

UPDATE `$prefix_modules` SET `module_directory` = '' WHERE `$prefix_modules`.`module_name` = 'blueprint';

UPDATE `$prefix_modules` SET `module_directory` = '' WHERE `$prefix_modules`.`module_name` = 'svn';

UPDATE `$prefix_modules` SET `module_directory` = 'core_ilch' WHERE `$prefix_modules`.`module_name` = 'auth';

UPDATE `$prefix_modules` SET `module_directory` = 'core_kohana' WHERE `$prefix_modules`.`module_name` = 'userguide';
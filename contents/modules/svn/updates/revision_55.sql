ALTER TABLE `ic1_modules` CHANGE `module_core` `module_directory` VARCHAR( 64 ) NULL;

UPDATE `ic1_modules` SET `module_directory` = '' WHERE `ic1_modules`.`module_name` = 'welcome';

UPDATE `ic1_modules` SET `module_directory` = 'core_ilch' WHERE `ic1_modules`.`module_name` = 'media';

UPDATE `ic1_modules` SET `module_directory` = '' WHERE `ic1_modules`.`module_name` = 'blueprint';

UPDATE `ic1_modules` SET `module_directory` = '' WHERE `ic1_modules`.`module_name` = 'svn';

UPDATE `ic1_modules` SET `module_directory` = 'core_ilch' WHERE `ic1_modules`.`module_name` = 'auth';

UPDATE `ic1_modules` SET `module_directory` = 'core_kohana' WHERE `ic1_modules`.`module_name` = 'userguide';
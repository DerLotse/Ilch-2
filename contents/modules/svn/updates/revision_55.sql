ALTER TABLE `ic1_modules` CHANGE `module_core` `module_directory` VARCHAR( 64 ) NULL;

UPDATE `ilchcms2x`.`ic1_modules` SET `module_directory` = '' WHERE `ic1_modules`.`module_name` = 'welcome';

UPDATE `ilchcms2x`.`ic1_modules` SET `module_directory` = 'core_ilch' WHERE `ic1_modules`.`module_name` = 'media';

UPDATE `ilchcms2x`.`ic1_modules` SET `module_directory` = '' WHERE `ic1_modules`.`module_name` = 'blueprint';

UPDATE `ilchcms2x`.`ic1_modules` SET `module_directory` = '' WHERE `ic1_modules`.`module_name` = 'svn';

UPDATE `ilchcms2x`.`ic1_modules` SET `module_directory` = 'core_ilch' WHERE `ic1_modules`.`module_name` = 'auth';

UPDATE `ilchcms2x`.`ic1_modules` SET `module_directory` = 'core_kohana' WHERE `ic1_modules`.`module_name` = 'userguide';
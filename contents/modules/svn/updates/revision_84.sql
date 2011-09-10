ALTER TABLE  `$prefix_modules` DROP  `module_directory`;
ALTER TABLE  `$prefix_modules` CHANGE  `module_active`  `module_status` INT( 1 ) UNSIGNED NOT NULL;

ALTER TABLE  `$prefix_modules` ADD  `module_required` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
ADD  `module_expand` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
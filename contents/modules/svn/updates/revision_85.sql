TRUNCATE TABLE  `$prefix_modules`;

ALTER TABLE  `$prefix_modules` DROP  `module_required` ,
DROP  `module_expand` ;

ALTER TABLE  `$prefix_modules` CHANGE  `module_version`  `module_version` DECIMAL( 11, 8 ) NOT NULL

INSERT INTO `ilchcms2x`.`$prefix_modules` (`module_id`, `module_status`, `module_name`, `module_version`) VALUES (NULL, '1', 'ilch_basic', '1');
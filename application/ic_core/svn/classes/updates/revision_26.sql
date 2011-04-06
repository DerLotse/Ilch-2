CREATE TABLE  `ic1_sessions` (
    `session_id` VARCHAR( 24 ) NOT NULL,
    `last_active` INT UNSIGNED NOT NULL,
    `contents` TEXT NOT NULL,
    PRIMARY KEY ( `session_id` ),
    INDEX ( `last_active` )
) ENGINE = MYISAM ;

ALTER TABLE `ic1_themes` ADD `section` VARCHAR( 255 ) NOT NULL AFTER `folder`;

UPDATE `ilchcms2x`.`ic1_themes` SET `folder` = 'ic_frontend',
`section` = 'frontend' WHERE `ic1_themes`.`id` =1 AND `ic1_themes`.`folder` = 'ilchcms' AND `ic1_themes`.`section` = '' AND `ic1_themes`.`core` =1 LIMIT 1;

INSERT INTO `ilchcms2x`.`ic1_themes` (`folder` ,`section` ,`core` ,`active`)
VALUES ('ic_backend', 'backend', '1', '1');

INSERT INTO `ilchcms2x`.`ic1_modules` (`id` ,`folder` ,`core` ,`active`)
VALUES (NULL , 'widget', '1', '1');
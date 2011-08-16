ALTER TABLE  `$prefix_users` ADD  `user_nickname` VARCHAR( 32 ) NOT NULL;
ALTER TABLE  `$prefix_users` ADD  `user_email` VARCHAR( 124 ) NOT NULL AFTER `user_password`;
ALTER TABLE  `$prefix_group_config` ADD  `group_config_value` TEXT NOT NULL;
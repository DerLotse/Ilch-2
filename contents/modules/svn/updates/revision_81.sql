ALTER TABLE  `ic1_users` ADD  `user_nickname` VARCHAR( 32 ) NOT NULL;
ALTER TABLE  `ic1_users` ADD  `user_email` VARCHAR( 124 ) NOT NULL AFTER `user_password`;
ALTER TABLE  `ic1_group_config` ADD  `group_config_value` TEXT NOT NULL;
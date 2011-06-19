  CREATE TABLE  `ic1_sessions` (
      `session_id` VARCHAR( 24 ) NOT NULL,
      `last_active` INT UNSIGNED NOT NULL,
      `contents` TEXT NOT NULL,
      PRIMARY KEY ( `session_id` ),
      INDEX ( `last_active` )
  ) ENGINE = MYISAM ;

INSERT INTO `ilchcms2x`.`ic1_config` (`id`, `group_name`, `config_key`, `category_name`, `config_description`, `field_type`, `config_value`, `field_options`) VALUES (NULL, 'auth', 'hash_method', 'Usercontrol', 'Welche Verschlüsselung soll für die Passwörter benutzt werden.', 'input', 's:6:"sha256";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:17:"list_hash_methods";}');
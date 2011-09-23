--
-- Tabellenstruktur für Tabelle `$prefix_config`
--

CREATE TABLE `$prefix_config` (
  `config_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `config_group` varchar(32) NOT NULL,
  `config_key` varchar(32) NOT NULL,
  `config_category` varchar(32) NOT NULL,
  `config_description` text NOT NULL,
  `config_field_type` varchar(16) NOT NULL,
  `config_value` text NOT NULL,
  `config_field_options` text NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `$prefix_config`
--

INSERT INTO `$prefix_config` VALUES(1, 'ilch', 'start_controller', 'Allgemeine Einstellungen', 'Welcher Controller soll als Startseite dienen?', 'select', 's:7:"welcome";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:16:"list_controllers";}');
INSERT INTO `$prefix_config` VALUES(2, 'ilch', 'default_backend_theme', 'Allgemeine Einstellungen', 'Welches Backend-Theme soll als Standard genutzt werden?', 'select', 's:7:"backend";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:19:"list_backend_themes";}');
INSERT INTO `$prefix_config` VALUES(3, 'ilch', 'default_frontend_theme', 'Allgemeine Einstellungen', 'Welches Frontend-Theme soll als Standard genutzt werden?', 'select', 's:8:"frontend";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:20:"list_frontend_themes";}');
INSERT INTO `$prefix_config` VALUES(4, 'ilch', 'svn_version', '', '', 'hidden', 's:2:"83";', '');
INSERT INTO `$prefix_config` VALUES(5, 'auth', 'hash_key', 'Usercontrol', '', 'input', 's:58:"Muss waehrend der Installation automatisch erstellt werden";', '');
INSERT INTO `$prefix_config` VALUES(6, 'auth', 'user_token_expires', 'Usercontrol', 'Wie viele Stunden ist ein automatischer Login möglich?', 'input', 's:2:"48";', '');
INSERT INTO `$prefix_config` VALUES(7, 'cookie', 'salt', '', '', 'input', 's:58:"Muss waehrend der Installation automatisch erstellt werden";', '');
INSERT INTO `$prefix_config` VALUES(8, 'auth', 'hash_method', 'Usercontrol', 'Welche Verschlüsselung soll für die Passwörter benutzt werden.', 'input', 's:6:"sha256";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:17:"list_hash_methods";}');
INSERT INTO `$prefix_config` VALUES(9, 'auth', 'register_activation', 'Usercontrol', 'Welche Schritte müssen nach der Registrierung eines neuen Benutzers erfolgen?', 'select_multiple', 'a:2:{s:18:"admin_confirmation";s:1:"1";s:18:"email_confirmation";s:1:"1";}', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:19:"list_register_types";}');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_groups`
--

CREATE TABLE `$prefix_groups` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_parent_id` int(10) unsigned DEFAULT NULL,
  `group_core` int(10) unsigned NOT NULL,
  `group_name` varchar(32) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `$prefix_groups`
--

INSERT INTO `$prefix_groups` VALUES(1, 2, 1, 'SUPERADMIN');
INSERT INTO `$prefix_groups` VALUES(2, NULL, 1, 'ADMIN');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_group_config`
--

CREATE TABLE `$prefix_group_config` (
  `group_id` int(11) NOT NULL,
  `config_id` int(11) NOT NULL,
  `group_config_value` text NOT NULL,
  PRIMARY KEY (`group_id`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `$prefix_group_config`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_group_permissions`
--

CREATE TABLE `$prefix_group_permissions` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `$prefix_group_permissions`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_group_users`
--

CREATE TABLE `$prefix_group_users` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_main_group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `$prefix_group_users`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_modules`
--

CREATE TABLE `$prefix_modules` (
  `module_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module_status` int(1) unsigned NOT NULL,
  `module_name` varchar(32) NOT NULL,
  `module_version` decimal(11,8) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Daten für Tabelle `$prefix_modules`
--

INSERT INTO `$prefix_modules` VALUES(1, 1, 'ilch_basic', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(2, 1, 'ilch_controller', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(3, 1, 'ilch_group', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(4, 2, 'ilch_jquery', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(5, 2, 'ilch_jquery-ui', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(6, 1, 'ilch_media', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(7, 2, 'ilch_tinymce', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(8, 1, 'ilch_user', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(9, 2, 'kohana_auth', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(10, 1, 'kohana_cache', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(11, 2, 'kohana_codebench', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(12, 1, 'kohana_database', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(13, 2, 'kohana_image', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(14, 2, 'kohana_orm', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(15, 2, 'kohana_unittest', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(16, 1, 'kohana_userguide', 2.30001000);
INSERT INTO `$prefix_modules` VALUES(17, 1, 'blueprint', 1.00001000);
INSERT INTO `$prefix_modules` VALUES(18, 1, 'cache', 1.00001000);
INSERT INTO `$prefix_modules` VALUES(19, 2, 'news', 1.00000000);
INSERT INTO `$prefix_modules` VALUES(20, 1, 'svn', 1.00001000);
INSERT INTO `$prefix_modules` VALUES(21, 1, 'welcome', 1.00000000);
INSERT INTO `$prefix_modules` VALUES(22, 1, 'ilch_event', 2.00000000);
INSERT INTO `$prefix_modules` VALUES(23, 1, 'ilch_pagination', 3.00121000);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_permissions`
--

CREATE TABLE `$prefix_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_group` varchar(32) NOT NULL,
  `permission_key` varchar(32) NOT NULL,
  `permission_category` varchar(32) NOT NULL,
  `permission_description` text NOT NULL,
  `permission_value` int(11) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `$prefix_permissions`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_sessions`
--

CREATE TABLE `$prefix_sessions` (
  `session_id` varchar(24) NOT NULL,
  `session_last_active` int(10) unsigned NOT NULL,
  `session_contents` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_active` (`session_last_active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `$prefix_sessions`
--

INSERT INTO `$prefix_sessions` VALUES('4e7c29c7e640d5-64278095', 1316760008, 'YToxOntzOjExOiJsYXN0X2FjdGl2ZSI7aToxMzE2NzYwMDA4O30=');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_themes`
--

CREATE TABLE `$prefix_themes` (
  `theme_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theme_active` int(2) unsigned NOT NULL,
  `theme_name` varchar(32) NOT NULL,
  `theme_version` decimal(11,4) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `$prefix_themes`
--

INSERT INTO `$prefix_themes` VALUES(1, 1, 'ilchcms', 0.0001);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_users`
--

CREATE TABLE `$prefix_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_status` int(10) unsigned NOT NULL,
  `user_login` varchar(32) NOT NULL,
  `user_password` text NOT NULL,
  `user_email` varchar(124) NOT NULL,
  `user_nickname` varchar(32) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `$prefix_users`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_user_confirmations`
--

CREATE TABLE `$prefix_user_confirmations` (
  `confirmation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `confirmation_key` varchar(40) NOT NULL,
  `confirmation_type` varchar(10) NOT NULL,
  `confirmation_data` varchar(255) NOT NULL,
  PRIMARY KEY (`confirmation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `$prefix_user_confirmations`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_user_tokens`
--

CREATE TABLE `$prefix_user_tokens` (
  `user_token_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `user_token_key` varchar(40) NOT NULL,
  `user_token_created` int(11) unsigned NOT NULL,
  `user_token_expires` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `$prefix_user_tokens`
--


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

INSERT INTO `$prefix_config` (`config_id`, `config_group`, `config_key`, `config_category`, `config_description`, `config_field_type`, `config_value`, `config_field_options`) VALUES
(1, 'ilch', 'start_controller', 'Allgemeine Einstellungen', 'Welcher Controller soll als Startseite dienen?', 'select', 's:7:"welcome";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:16:"list_controllers";}'),
(2, 'ilch', 'default_backend_theme', 'Allgemeine Einstellungen', 'Welches Backend-Theme soll als Standard genutzt werden?', 'select', 's:24:"core_ilch_themes_backend";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:19:"list_backend_themes";}'),
(3, 'ilch', 'default_frontend_theme', 'Allgemeine Einstellungen', 'Welches Frontend-Theme soll als Standard genutzt werden?', 'select', 's:25:"core_ilch_themes_frontend";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:20:"list_frontend_themes";}'),
(4, 'ilch', 'svn_version', '', '', 'hidden', 's:2:"81";', ''),
(5, 'auth', 'hash_key', 'Usercontrol', '', 'input', 's:58:"Muss waehrend der Installation automatisch erstellt werden";', ''),
(6, 'auth', 'user_token_expires', 'Usercontrol', 'Wie viele Stunden ist ein automatischer Login möglich?', 'input', 's:2:"48";', ''),
(7, 'cookie', 'salt', '', '', 'input', 's:58:"Muss waehrend der Installation automatisch erstellt werden";', ''),
(8, 'auth', 'hash_method', 'Usercontrol', 'Welche Verschlüsselung soll für die Passwörter benutzt werden.', 'input', 's:6:"sha256";', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:17:"list_hash_methods";}'),
(9, 'auth', 'register_activation', 'Usercontrol', 'Welche Schritte müssen nach der Registrierung eines neuen Benutzers erfolgen?', 'select_multiple', 'a:2:{s:18:"admin_confirmation";s:1:"1";s:18:"email_confirmation";s:1:"1";}', 'a:2:{s:5:"class";s:4:"ilch";s:8:"function";s:19:"list_register_types";}');

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

INSERT INTO `$prefix_groups` (`group_id`, `group_parent_id`, `group_core`, `group_name`) VALUES
(1, 2, 1, 'SUPERADMIN'),
(2, NULL, 1, 'ADMIN');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_group_config`
--

CREATE TABLE `$prefix_group_config` (
  `group_id` int(11) NOT NULL,
  `config_id` int(11) NOT NULL,
  `group_config_value` TEXT NOT NULL,
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
  `module_directory` varchar(64) DEFAULT NULL,
  `module_active` int(2) unsigned NOT NULL,
  `module_name` varchar(32) NOT NULL,
  `module_version` decimal(11,4) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `$prefix_modules`
--

INSERT INTO `$prefix_modules` (`module_id`, `module_directory`, `module_active`, `module_name`, `module_version`) VALUES
(1, NULL, 1, 'welcome', 0.0001),
(2, 'core_ilch', 1, 'media', 1.0000),
(3, NULL, 1, 'blueprint', 1.0000),
(4, NULL, 1, 'svn', 1.0000),
(6, 'core_ilch', 0, 'auth', 0.0000),
(7, 'core_kohana', 1, 'userguide', 0.0000),
(8, 'core_ilch', 1, 'user', 1.0000),
(9, NULL, 1, 'cache', 1.0000),
(10, 'core_ilch', 1, 'permission', 1.0000),
(11, 'core_ilch', 1, 'group', 1.0000),
(12, 'core_ilch', 1, 'controller', 1.0000),
(13, 'core_ilch', 1, 'jquery-ui', 1.0000);

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

INSERT INTO `$prefix_themes` (`theme_id`, `theme_active`, `theme_name`, `theme_version`) VALUES
(1, 1, 'ilchcms', 0.0001);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `$prefix_users`
--

CREATE TABLE `$prefix_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_status` int(10) unsigned NOT NULL,
  `user_login` varchar(32) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_email` varchar(124) NOT NULL,
  `user_nickname` varchar(32) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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


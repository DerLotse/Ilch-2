<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Installation extends Controller_Template
{

    /**
     * @var string with default template
     */
    public $template = 'index';
    
    /**
     * @var Session
     */
    public $session;
    
    /**
     * @var string with the max step that can be access
     */
    public $max_active_step;
    
    /**
     * @var array with language options 
     */
    public $languages;
    
    /**
     * @var Model_Installation
     */
    public $model;

    /**
     * Run before Action
     */
    public function before()
    {
        parent::before();

        // Session
        $this->session = Session::instance();
        
        // Maximaler Schritt, der aufgerufen werden darf
        $this->max_active_step = $this->session->get('max_active_step', 0);

        // Sprache einstellen
        I18n::lang($this->request->param('language', $this->session->get('language', 'en')));

        // Standardwerte
        $this->template->act_step = (int) substr($this->request->action(), -1, 1);
        $this->template->title = __('Installation of Ilch Pluto') . ' :: ' . __('Step') . ' ' . ($this->template->act_step + 1);
        $this->template->content = '';
        $this->template->errors = array();

        // Installationsschritte
        $this->template->steps = array(
            'Language', 'License', 'Application directory', 'Check application', 'Database settings', 'Account settings', 'Finished'
        );

        // Sprachversionen
        $this->languages = array('en' => 'English', 'de' => 'Deutsch');

        // Model laden
        $this->model = Model::factory('installation');
    }

    /**
     * Step 1: Language
     */
    public function action_step0()
    {
        // Wenn Formular abgeschickt wurde
        if ($this->request->post())
        {
            // Sprache in der Session speichern
            $this->session->set('language', $this->request->post('language'));

            // Nächsten Schritt als aufrufbar markieren
            $this->session->set('max_active_step', 1);
            
            // Weiterleiten zu Schritt 2
            $this->request->redirect('installation/step1');
        }

        // Formular setzen
        $this->template->content = View::factory('installation/step0', array('languages' => $this->languages));
    }

    /**
     * Step 2: License
     */
    public function action_step1()
    {
        // Prüfen, ob Schritt gültig
        if ($this->max_active_step < 1)
                $this->request->redirect ('installation/step'.$this->max_active_step);
        
        // Regeln aufstellen
        $validation = Validation::factory($this->request->post())->rule('license', 'not_empty');

        // Prüfen, ob Regeln zutreffen
        if ($validation->check())
        {
            // Akzeptierung in der Session speichern
            $this->session->set('data_step1', $this->request->post());
            
            // Nächsten Schritt als aufrufbar markieren
            $this->session->set('max_active_step', 2);

            // Weiterleiten zu Schritt 3
            $this->request->redirect('installation/step2');
        }

        // Fehlermeldungen
        $this->template->errors = $validation->errors('validation');

        // Template
        $this->template->content = View::factory('installation/step1', array(
                    'data_step1' => ($this->request->post()) ? $this->request->post() : $this->session->get('data_step1')
                ));
    }

    /**
     * Step 3: Application-dir
     */
    public function action_step2()
    {
        // Prüfen, ob Schritt gültig
        if ($this->max_active_step < 2)
                $this->request->redirect ('installation/step'.$this->max_active_step);
        
        // Abrufen der möglichen Applikationsordner
        $directories = $this->model->application_directories();

        // Prüfen, ob Übertragung richtig
        if ($this->request->post())
        {
            // Übertragung richtig
            if (Arr::get($directories, $this->request->post('application_directory'), NULL))
            {
                // Ordner in Session speichern
                $this->session->set('data_step2', $this->request->post());

                // Nächsten Schritt als aufrufbar markieren
                $this->session->set('max_active_step', 3);
                
                // Weiterleiten zu Schritt 4
                $this->request->redirect('installation/step3');
            }
            else
            {
                // Fehler definieren
                $this->template->errors = array(__('Invalid application directory'));
            }
        }

        // Template
        $this->template->content = View::factory('installation/step2', array(
            'directories' => $directories,
            'data_step2' => ($this->request->post()) ? $this->request->post() : $this->session->get('data_step2')
        ));
    }

    /**
     * Check application
     */
    public function action_step3()
    {
        // Prüfen, ob Schritt gültig
        if ($this->max_active_step < 3)
                $this->request->redirect ('installation/step'.$this->max_active_step);
        
        // Wenn Formular abgeschickt wurde
        if ($this->request->post())
        {
            // Nächsten Schritt als aufrufbar markieren
            $this->session->set('max_active_step', 4);
            
            // Weiterleiten zu Schritt 5
            $this->request->redirect('installation/step4');
        }

        // Daten von Schritt 3 abrufen
        $data_step2 = $this->session->get('data_step2');
        
        // Template
        $this->template->content = View::factory('installation/step3', array(
                    'PDO' => $this->model->pdo_drivers(),
                    'APPPATH' => realpath(Arr::get($data_step2, 'application_directory')) . DIRSEPA,
                    'APPPATH_CLEAR' => Arr::get($data_step2, 'application_directory') . DIRSEPA
                ));
    }

    public function action_step4()
    {
        // Prüfen, ob Schritt gültig
        if ($this->max_active_step < 4)
                $this->request->redirect ('installation/step'.$this->max_active_step);
        
        // Check Database
        if ($this->request->post())
        {
            // Config Array
            $config = array(
                'type' => $this->request->post('database_driver'),
                'connection' => array(
                    'username' => $this->model->get_value($this->request->post(), 'database_user'),
                    'password' => $this->model->get_value($this->request->post(), 'database_password'),
                    'persistent' => FALSE
                ),
                'table_prefix' => $this->model->get_value($this->request->post(), 'database_prefix', ''),
                'charset' => 'utf8',
                'caching' => FALSE,
                'profiling' => FALSE
            );

            // MySQL Driver
            if ($this->request->post('database_driver') == 'mysql')
            {
                // Get Port
                $port = $this->model->get_value($this->request->post(), 'database_port', '', ':');

                // Set Config
                $config['connection'] = array(
                    'hostname' => $this->model->get_value($this->request->post(), 'database_host', 'localhost') . $port,
                    'database' => $this->model->get_value($this->request->post(), 'database_name')
                        ) + $config['connection'];
            }
            // PDO Driver
            else if ($this->request->post('database_driver') == 'pdo')
            {
                // If own PDO
                if ($this->request->post('pdo_driver') == 'own')
                {
                    $config['connection']['dsn'] = $this->request->post('database_own_dsn');
                }
                else
                {
                    // PDO driver
                    $driver = $this->request->post('pdo_driver');

                    // If oci PDO driver
                    if ($driver == 'oci')
                    {
                        // Database host
                        $host = $this->model->get_value($this->request->post(), 'database_host', 'dbname=//localhost', '//');

                        // Database name
                        $name = $this->model->get_value($this->request->post(), 'database_name', '/required', '/');

                        // Database port
                        $port = $this->model->get_value($this->request->post(), 'database_port', ':1521', ';port=');
                    }
                    else
                    {
                        // Default port
                        if ($driver == 'cubrid')
                        {
                            $port = 30000;
                        }
                        else if ($driver == 'pgsql')
                        {
                            $port = 5432;
                        }
                        else
                        {
                            $port = NULL;
                        }

                        // Database host
                        $host = $this->model->get_value($this->request->post(), 'database_host', 'host=localhost', 'host=');

                        // Database name
                        $name = $this->model->get_value($this->request->post(), 'database_name', ';dbname=required', ';dbname=');

                        // Database port
                        $port = $this->model->get_value($this->request->post(), 'database_port', (is_null($port)) ? '' : ';port=' . $port, ';port=');
                    }

                    // Database Config
                    $config['connection']['dsn'] = $driver . ':' . $host . $port . $name;
                }
            }
            // Invalid Driver
            else
            {
                $this->template->errors = array(__('Invalid database driver'));
            }

            if (!$this->template->errors)
            {
                try
                {
                    // Test database 
                    Database::instance(NULL, $config)->connect();

                    // Save data in Session
                    $this->session->set('database_config', $config);
                    $this->session->set('data_step4', $_POST);
                        
                    // Übernächsten Schritt als aufrufbar markieren
                    $this->session->set('max_active_step', 6);
                    
                    try
                    {
                        // Table already existis?
                        DB::select()->from('config')->execute();
                        
                        // Already installed
                        $this->template->errors = array(__('System already installed under the mentioned data').' '.HTML::anchor('installation/step6', __('ignore')));
                    }
                    catch (Exception $e)
                    {
	                    // Nächsten Schritt als aufrufbar markieren
	                    $this->session->set('max_active_step', 5);
                    	
                        // Redirect to step 6
                        $this->request->redirect('installation/step5');
                    }
                }
                catch (Exception $e)
                {
                    $this->template->errors = array(__('Can not connect to the database'), '---------------', $e, '---------------');
                }
            }
        }

        // Output data
        $data = array(
            'database_drivers' => array(),
            'pdo_drivers' => $this->model->pdo_drivers(),
            'data_step4' => ($this->request->post()) ? $this->request->post() : $this->session->get('data_step4')
        );

        // Enable Mysql
        if (function_exists('mysql_connect'))
            $data['database_drivers']['mysql'] = 'MySQL Driver';

        // Enable PDO
        if ($data['pdo_drivers'])
            $data['database_drivers']['pdo'] = 'PDO Driver';

        $this->template->content = View::factory('installation/step4', $data);
    }

    public function action_step5()
    {
        // Prüfen, ob Schritt gültig
        if ($this->max_active_step != 5)
                $this->request->redirect ('installation/step'.$this->max_active_step);
        
        // Regeln aufstellen
        $validation = Validation::factory($_POST)
                # Rules for hash method
                ->rule('hash_method', 'not_empty')
                # Rules for user login name
                ->rule('user_login', 'not_empty')
                ->rule('user_login', 'regex', array(':value', '/^[a-z0-9_.]++$/iD'))
                ->rule('user_login', 'min_length', array(':value', '3'))
                ->rule('user_login', 'max_length', array(':value', '32'))
                # Rules for user nickname
                ->rule('user_nickname', 'not_empty')
                ->rule('user_nickname', 'regex', array(':value', '/^[a-z0-9_.äöüÄÖÜß ]++$/iD'))
                ->rule('user_nickname', 'min_length', array(':value', '3'))
                ->rule('user_nickname', 'max_length', array(':value', '32'))
                # Rules for user email address
                ->rule('user_email', 'not_empty')
                ->rule('user_email', 'email')
                # Rules for user password
                ->rule('user_password', 'not_empty')
                ->rule('user_password_confirm', 'matches', array(':validation', 'user_password', ':field'));

        // Prüfen, ob Regeln zutreffen
        if ($validation->check())
        {
            // Daten in Session speichern
            $this->session->set('data_step5', $_POST);
            
            // Nächsten Schritt als aufrufbar markieren
            $this->session->set('max_active_step', 6);

            // Weiterleiten zu Schritt 7
            $this->request->redirect('installation/step6');
        }
    	
        // Fehlermeldungen
        $this->template->errors = $validation->errors('validation');
        
    	$this->template->content = View::factory('installation/step5', array(
    		'hash_algos' => $this->model->hash_algos(),
    		'data_step5' => ($_POST == TRUE) ? $_POST : $this->session->get('data_step5')
    	));
    }
    
    public function action_step6()
    {
        // Prüfen, ob Schritt gültig
        if ($this->max_active_step < 6)
                $this->request->redirect ('installation/step'.$this->max_active_step);
        
        // Applikations-Ordner
        $application = Arr::get($this->session->get('data_step2'), 'application_directory');
        
        // Datenbankkonfiguration anlegen
        if(!$this->model->create_config($application, 'database', $this->session->get('database_config')))
        {
            $this->template->errors = array(__('Can not create config file.'));
        }
        
        // Datenbankverbindung herstellen
        Database::instance(NULL, $this->session->get('database_config'))->connect();
        
        // Entsprechend, ob Einträge bereits vorhanden, diese importieren
        try
        {
        	// Table already existis?
            DB::select()->from('config')->execute();
                        
            // Already installed
            $this->template->content = View::factory('installation/re_configured');
        }
        catch (Exception $e)
        {
        	// Eingestellter prefix
        	$prefix = Arr::get($this->session->get('data_step4'), 'database_prefix');

			// Datenbank installieren
			$this->model->import_sql($prefix);
			
			// Nutzerdaten abfragen
			$data_step5 = $this->session->get('data_step5');
			
			// Auth hash key
			$auth_hash_key = (Arr::get($data_step5, 'hash_method', 'md5_ilch') != 'md5_ilch') ? $this->model->create_key() : '';
			
			// Hash Method deklarieren
			$hash_method = (Arr::get($data_step5, 'hash_method', 'md5_ilch') != 'md5_ilch') ? Arr::get($data_step5, 'hash_method') : 'md5';
			
			// Cookie salt
			$cookie_salt = $this->model->create_key();
			
			// Nutzerdaten zusammenfassen
			$user_data = array(
				'user_status' => 1,
				'user_login' => Arr::get($data_step5, 'user_login'),
				'user_password' => hash_hmac($hash_method, Arr::get($data_step5, 'user_password'), $auth_hash_key),
				'user_email' => Arr::get($data_step5, 'user_email'),
				'user_nickname' => Arr::get($data_step5, 'user_nickname')
			);
			
			// Nutzerdaten in Datenbank speichern
			list($last_insert_id) = DB::insert('users', array('user_status', 'user_login', 'user_password', 'user_email', 'user_nickname'))->values($user_data)->execute();
			
			// Nutzer in Gruppe eintragen
			DB::insert('group_users', array('group_id', 'user_id', 'user_main_group'))->values(array(1, $last_insert_id, 1))->execute();

			// Config ändern
			DB::update('config')->set(array('config_value' => serialize($auth_hash_key)))->where('config_group', '=', 'auth')->and_where('config_key', '=', 'hash_key')->execute();
			DB::update('config')->set(array('config_value' => serialize($cookie_salt)))->where('config_group', '=', 'cookie')->and_where('config_key', '=', 'salt')->execute();
			DB::update('config')->set(array('config_value' => serialize($hash_method)))->where('config_group', '=', 'auth')->and_where('config_key', '=', 'hash_method')->execute();

			// Template
			$this->template->content = View::factory('installation/configured');
			
			// Session löschen
			$this->session->destroy();
        }
    }
}
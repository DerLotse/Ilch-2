<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Default auth user token
 */
class Model_User_Token extends Model
{

    /**
     * Handles garbage collection and deleting of expired objects.
     *
     * @return  void
     */
    public function __construct()
    {
        if (mt_rand(1, 100) === 1) // @todo Kohana Standard - tut das wirklich not?
        {
            // Do garbage collection
            $this->delete_expired();
        }
    }

    /**
     * Deletes all expired tokens.
     *
     * @return  ORM
     */
    public function delete_expired()
    {
        // Delete all expired tokens
        return DB::delete('user_tokens')->where('user_token_expires', '<', time())->execute();
    }

    public function create($user_id)
    {
    	$config = Kohana::$config->load('auth');
    	
        // Daten sammeln
        $data = array(
            'user_id' => $user_id,
            'user_agent' => sha1(Request::$user_agent),
            'user_token_key' => $this->create_token(),
            'user_token_created' => time(),
            'user_token_expires' => time()+$config->user_token_expires*3600 // Aktuelle Zeit + Stunden * Sekunden pro Stunde
        );
        
        // Daten in Datenbank ablegen
        DB::insert('user_tokens', array_keys($data))->values(array_values($data))->execute();
        
        // Daten in Cookie ablegen
		Cookie::set('authautologin', $data['user_token_key'], $config->user_token_expires*3600);
    }
    
    public function get($token = NULL)
    {
        if ($token == NULL)
        {
            $token = Cookie::get('authautologin');
        }
        
        return DB::select()->from('user_tokens')->where('user_token_key', '=', $token)->as_object()->execute()->current();
    }
    
    public function delete($token = NULL)
    {
        if ($token == NULL)
        {
            $token = Cookie::get('authautologin');
            Cookie::delete('authautologin');
        }
                
        return DB::delete('user_tokens')->where('user_token_key', '=', $token)->execute();
    }

    protected function create_token()
    {
        return sha1(uniqid(Text::random('alnum', 32), TRUE));
    }
}
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
        return DB::delete('user_tokens')->where('expires', '<', time())->execute();
    }

    public function create($user_id)
    {
        // Daten sammeln
        $data = array(
            'user_id' => $user_id,
            'user_agent' => sha1(Request::$user_agent),
            'token' => $this->create_token(),
            'created' => time(),
            'expires' => time()+Kohana::config('auth.token_expires')*3600 // Aktuelle Zeit + Stunden * Sekunden pro Stunde
        );
        
        // Daten in Datenbank ablegen
        DB::insert('user_tokens', array_keys($data))->values(array_values($data))->execute();
        
        // Daten in Cookie ablegen
	Cookie::set('authautologin', $data['token'], Kohana::config('auth.token_expires')*3600);
    }
    
    public function get($token = NULL)
    {
        if ($token == NULL)
        {
            $token = Cookie::get('authautologin');
        }
        
        return DB::select()->from('user_tokens')->where('token', '=', $token)->as_object()->execute()->current();
    }
    
    public function delete($token = NULL)
    {
        if ($token == NULL)
        {
            $token = Cookie::get('authautologin');
            Cookie::delete('authautologin');
        }
                
        return DB::delete('user_tokens')->where('token', '=', $token)->execute();
    }

    protected function create_token()
    {
        return sha1(uniqid(Text::random('alnum', 32), TRUE));
    }
}
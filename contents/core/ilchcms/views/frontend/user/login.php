<?php

foreach($errors AS $error)
{
    echo '<ul class="error">';
    
    foreach($error AS $message)
    {
        echo '<li>'.$message.'</li>';
    }
    
    echo '</ul>';
}


echo Form::open('user/login');

echo Form::label('username', 'Username').'<br />';
echo Form::input('username', Arr::get($data, 'username'), array('class' => 'text')).'<br />';

echo Form::label('password', 'Password').'<br />';
echo Form::password('password', NULL, array('class' => 'text')).'<br />';

echo Form::hidden('redirect', Arr::get($data, 'redirect'));

echo Form::submit('submit', 'Submit');

echo Form::close();
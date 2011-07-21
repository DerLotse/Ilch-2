<?php

if ($logged_in === TRUE)
{
    echo 'Du bist eingeloggt.<br />';
    echo Html::anchor('user/logout', 'logout');
}
else
{
    echo Form::open('user/login');
    echo Form::label('username', 'Username');
    echo Form::input('username', NULL, array('class' => 'text', 'style' => 'width: 98%;'));
    echo Form::label('password', 'Password');
    echo Form::input('password', NULL, array('class' => 'text', 'style' => 'width: 98%;'));
    echo Form::submit('Submit', 'submit');
    echo Form::hidden('redirect', Url::site(Request::detect_uri()));
    echo Form::close();
}
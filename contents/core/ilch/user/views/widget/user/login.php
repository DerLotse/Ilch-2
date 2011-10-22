<?php

if ($logged_in === TRUE)
{
    echo 'Du bist eingeloggt.<br />';
    echo Html::anchor('user/logout', 'logout');
}
else
{
    echo Form::open('user/login');
    echo '<p>';
    echo Form::label('username', 'Username');
    echo Form::input('username', NULL, array('class' => 'text', 'style' => 'width: 98%;'));
    echo '</p><p>';
    echo Form::label('password', 'Password');
    echo Form::password('password', NULL, array('class' => 'text', 'style' => 'width: 98%;'));
    echo '</p><p>';
    echo Form::submit('Submit', 'submit');
    echo Form::hidden('redirect', Url::site(Request::detect_uri(), TRUE));
    echo '</p>';
    echo Form::close();
}
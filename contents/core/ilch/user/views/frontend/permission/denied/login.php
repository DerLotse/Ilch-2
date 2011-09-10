<h2>Keine Berechtigung</h2>
<ul class="error">
	<li>Bitte logge dich ein, um den gewünschten Inhalt zu sehen.</li>
</ul>

<?php

echo Form::open('user/login');

echo Form::label('username', 'Username').'<br />';
echo Form::input('username', NULL, array('class' => 'text')).'<br />';

echo Form::label('password', 'Password').'<br />';
echo Form::password('password', NULL, array('class' => 'text')).'<br />';

echo Form::hidden('redirect', Session::instance()->get_once('login_redirect', NULL));

echo Form::submit('submit', 'Submit');

echo Form::close();
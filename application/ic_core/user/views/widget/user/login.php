<p>
<?php 
if (User::login(array('email' => 'admin@localhost', 'password' => md5('admin'))) === FALSE)
{
    echo 'Fehler';
}
else
{
    echo 'Erfolg';
}
?>
</p>
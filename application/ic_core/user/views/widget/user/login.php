<p>
<?php 
if (User::login(array('name' => 'Flomavali', 'password' => md5('Flomavali'))) === FALSE)
{
    echo 'Fehler';
}
else
{
    echo 'Erfolg';
}
?>
</p>
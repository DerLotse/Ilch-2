<h1>Config-Table: Insert-Statement generator</h1>
<p>
    Mit diesem Formular kannst du dir ein Insert-Satement für die Tabelle
    "prefix_config" erstellen lassen. Dadurch ersparst du dir die Arbeit mit
    dem Serialize.
</p>
<p>
    Bei einigen Feldern ist es möglich ein Array einzugeben. Diese sind in etwa
    so aufzubauen:
</p>
<p>
    key1 => value1<br />
    key2 => value2<br />
    key3 => value3
</p>
<hr class="space" />
<h1>1. Formular ausfüllen</h1>
<?php

foreach($errors AS $error)
{
    echo '<ul class="error" id="statement">';
    
    foreach($error AS $message)
    {
        echo '<li>'.$message.'</li>';
    }
    
    echo '</ul>';
}


echo Form::open('backend/config/create#statement');

echo Form::label('group_name', 'group_name').'<br />';
echo Form::input('group_name', Arr::get($data, 'group_name'), array('class' => 'text')).'<br />';

echo Form::label('config_key', 'config_key').'<br />';
echo Form::input('config_key', Arr::get($data, 'config_key'), array('class' => 'text')).'<br />';

echo Form::label('category_name', 'category_name').'<br />';
echo Form::input('category_name', Arr::get($data, 'category_name'), array('class' => 'text')).'<br />';

echo Form::label('category_description', 'category_description').'<br />';
echo Form::input('category_description', Arr::get($data, 'category_description'), array('class' => 'text')).'<br />';

echo Form::label('field_type', 'field_type').'<br />';
echo Form::input('field_type', Arr::get($data, 'field_type'), array('class' => 'text')).'<br />';

echo Form::label('config_value', 'config_value').'<br />';
echo Form::textarea('config_value', Arr::get($data, 'config_value'), array('placeholder' => "string or array construct")).'<br />';

echo Form::label('field_options', 'field_options').'<br />';
echo Form::textarea('field_options', Arr::get($data, 'field_options'), array('placeholder' => "string or array construct - can be empty")).'<br />';

echo Form::submit('submit', 'Submit');

echo Form::close();
?>
<hr class="space" />
<hr class="space" />
<h2<?php if(count($errors) == 0) echo ' id="statement"'; ?>>2. SQL-Satement erhalten</h2>
<?php

echo Form::textarea('created', $created);
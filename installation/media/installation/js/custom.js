$(document).ready(function(){
    
    // Funktion zum vertikalen Zentrieren
    function vertical_align()
    {
        // Fensterhöhe
        var window_height = $(window).height();
        var content_height = $('#wrapper').height();

        // Padding von oben
        var padding_top = parseInt(window_height/2-content_height/2);
       
        // Höhe korregieren
        if (padding_top < 100) {
            padding_top = 100;
        }

        // CSS
        $('body').css({
            paddingTop: padding_top
        });
    }
    
    // Erster Aufruf, um Content in die Mitte zu bekommen
    vertical_align();
    
    // Bei Bildflächenänderung
    $(window).resize(function(){
        vertical_align();
    });
    
    // Bei Klick auf den Backward-Button
    $('input[name="backward"]').click(function(){
        $(location).attr('href', $(this).attr('step')); 
        return false;
    });
    
    // Verhalten der Verbindungsfelder für jede Datenbank
    $('select[name="database_driver"]').each(function()
    {
        // Wenn Datenbank
        if($(this).attr('name') == 'database_driver')
        {
            // Auf PDO prüfen
            if($(this).val() == 'pdo')
            {
                $('.pdo').show();
                
                // Felder bearbeiten
                pdo_fields();
            }
            else
            {
                $('.pdo').hide();
                
                // Felder bearbeiten
                mysql_fields();
            }
        }
    });
    
    $('select[name="database_driver"], select[name="pdo_driver"]').change(function()
    {
        // Wenn Datenbank geändert wurde
        if($(this).attr('name') == 'database_driver')
        {
            // Auf PDO prüfen
            if($(this).val() == 'pdo')
            {
                $('.pdo').show();
                
                // Felder bearbeiten
                pdo_fields();
            }
            else
            {
                $('.pdo').hide();
                
                // Felder bearbeiten
                mysql_fields()
            }
        }
        
        // Wenn PDO geändert wurde
        if($(this).attr('name') == 'pdo_driver')
        {
            pdo_fields();
        }
    });
    
    function pdo_fields()
    {
        if($('select[name="pdo_driver"]').val() == 'own')
        {
            $('.database_own_dsn').show();
            $('.database_host, .database_port, .database_name').hide();
        }
        else
        {
            mysql_fields();
        }
    }
    
    function mysql_fields()
    {
        $('.database_own_dsn').hide();
        $('.database_host, .database_port, .database_name').show();
    }
    
});
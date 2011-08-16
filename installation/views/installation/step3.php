<?php

defined('SYSPATH') or die('No direct script access.');

if (version_compare(PHP_VERSION, '5.3', '<'))
{
	// Clear out the cache to prevent errors. This typically happens on Windows/FastCGI.
	clearstatcache();
}
else
{
	// Clearing the realpath() cache is only possible PHP 5.3+
	clearstatcache(TRUE);
}

?>

<p>
        <?php echo __('step3_help'); ?>
</p>

<?php $failed = FALSE ?>

<table cellspacing="0">
        <tr>
                <th>PHP Version</th>
                <?php if (version_compare(PHP_VERSION, '5.2.3', '>=')): ?>
                        <td class="pass"><?php echo PHP_VERSION ?></td>
                <?php else: $failed = TRUE ?>
                        <td class="fail">Ilch requires PHP 5.2.3 or newer, this version is <?php echo PHP_VERSION ?>.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>Cache Directory</th>
                <?php if (is_dir($APPPATH) AND is_dir($APPPATH.'cache') AND is_writable($APPPATH.'cache')): ?>
                        <td class="pass"><?php echo $APPPATH_CLEAR.'cache'.DIRSEPA ?></td>
                <?php else: $failed = TRUE ?>
                        <?php $failed = TRUE; ?>
                        <td class="fail">The <code><?php echo $APPPATH_CLEAR.'cache'.DIRSEPA ?></code> directory is not writable.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>Logs Directory</th>
                <?php if (is_dir($APPPATH) AND is_dir($APPPATH.'logs') AND is_writable($APPPATH.'logs')): ?>
                        <td class="pass"><?php echo $APPPATH_CLEAR.'logs'.DIRSEPA ?></td>
                <?php else: $failed = TRUE ?>
                        <?php $failed = TRUE; ?>
                        <td class="fail">The <code><?php echo $APPPATH_CLEAR.'logs'.DIRSEPA ?></code> directory is not writable.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>Configuration Directory</th>
                <?php if (is_dir($APPPATH) AND is_dir($APPPATH.'config') AND is_writable($APPPATH.'config')): ?>
                        <td class="pass"><?php echo $APPPATH_CLEAR.'config'.DIRSEPA ?></td>
                <?php else: $failed = TRUE ?>
                        <?php $failed = TRUE; ?>
                        <td class="fail">The <code><?php echo $APPPATH_CLEAR.'config'.DIRSEPA ?></code> directory is not writable.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>MySQL or PDO Enabled</th>
                <?php if (function_exists('mysql_connect') === TRUE OR $PDO == TRUE): ?>
                        <td class="pass">Pass</td>
                <?php else: ?>
                        <?php $failed = TRUE; ?>
                        <td class="fail">No database support given</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>PCRE UTF-8</th>
                <?php if ( ! @preg_match('/^.$/u', 'ñ')): $failed = TRUE ?>
                        <td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with UTF-8 support.</td>
                <?php elseif ( ! @preg_match('/^\pL$/u', 'ñ')): $failed = TRUE ?>
                        <td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with Unicode property support.</td>
                <?php else: ?>
                        <td class="pass">Pass</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>SPL Enabled</th>
                <?php if (function_exists('spl_autoload_register')): ?>
                        <td class="pass">Pass</td>
                <?php else: $failed = TRUE ?>
                        <td class="fail">PHP <a href="http://www.php.net/spl">SPL</a> is either not loaded or not compiled in.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>Reflection Enabled</th>
                <?php if (class_exists('ReflectionClass')): ?>
                        <td class="pass">Pass</td>
                <?php else: $failed = TRUE ?>
                        <td class="fail">PHP <a href="http://www.php.net/reflection">reflection</a> is either not loaded or not compiled in.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>Filters Enabled</th>
                <?php if (function_exists('filter_list')): ?>
                        <td class="pass">Pass</td>
                <?php else: $failed = TRUE ?>
                        <td class="fail">The <a href="http://www.php.net/filter">filter</a> extension is either not loaded or not compiled in.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>Iconv Extension Loaded</th>
                <?php if (extension_loaded('iconv')): ?>
                        <td class="pass">Pass</td>
                <?php else: $failed = TRUE ?>
                        <td class="fail">The <a href="http://php.net/iconv">iconv</a> extension is not loaded.</td>
                <?php endif ?>
        </tr>
        <?php if (extension_loaded('mbstring')): ?>
        <tr>
                <th>Mbstring Not Overloaded</th>
                <?php if (ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING): $failed = TRUE ?>
                        <td class="fail">The <a href="http://php.net/mbstring">mbstring</a> extension is overloading PHP's native string functions.</td>
                <?php else: ?>
                        <td class="pass">Pass</td>
                <?php endif ?>
        </tr>
        <?php endif ?>
        <tr>
                <th>Character Type (CTYPE) Extension</th>
                <?php if ( ! function_exists('ctype_digit')): $failed = TRUE ?>
                        <td class="fail">The <a href="http://php.net/ctype">ctype</a> extension is not enabled.</td>
                <?php else: ?>
                        <td class="pass">Pass</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>URI Determination</th>
                <?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF']) OR isset($_SERVER['PATH_INFO'])): ?>
                        <td class="pass">Pass</td>
                <?php else: $failed = TRUE ?>
                        <td class="fail">Neither <code>$_SERVER['REQUEST_URI']</code>, <code>$_SERVER['PHP_SELF']</code>, or <code>$_SERVER['PATH_INFO']</code> is available.</td>
                <?php endif ?>
        </tr>
</table>

<h4><?php echo __('Optional tests'); ?></h3>

<p>
        <?php echo __('step3_help_optional'); ?>
</p>

<table cellspacing="0">
        <tr>
                <th>PECL HTTP Enabled</th>
                <?php if (extension_loaded('http')): ?>
                        <td class="pass">Pass</td>
                <?php else: ?>
                        <td class="fail">Ilch can use the <a href="http://php.net/http">http</a> extension for the Request_Client_External class.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>cURL Enabled</th>
                <?php if (extension_loaded('curl')): ?>
                        <td class="pass">Pass</td>
                <?php else: ?>
                        <td class="fail">Ilch can use the <a href="http://php.net/curl">cURL</a> extension for the Request_Client_External class.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>mcrypt Enabled</th>
                <?php if (extension_loaded('mcrypt')): ?>
                        <td class="pass">Pass</td>
                <?php else: ?>
                        <td class="fail">Ilch requires <a href="http://php.net/mcrypt">mcrypt</a> for the Encrypt class.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>GD Enabled</th>
                <?php if (function_exists('gd_info')): ?>
                        <td class="pass">Pass</td>
                <?php else: ?>
                        <td class="fail">Ilch requires <a href="http://php.net/gd">GD</a> v2 for the Image class.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>MySQL Enabled</th>
                <?php if (function_exists('mysql_connect')): ?>
                        <td class="pass">Pass</td>
                <?php else: ?>
                        <td class="fail">Ilch use the <a href="http://php.net/mysql">MySQL</a> extension to support MySQL databases.</td>
                <?php endif ?>
        </tr>
        <tr>
                <th>PDO Enabled</th>
                <?php if ($PDO == TRUE): ?>
                        <td class="pass">Pass</td>
                <?php else: ?>
                        <td class="fail">Ilch can use <a href="http://php.net/pdo">PDO</a> to support additional databases.</td>
                <?php endif ?>
        </tr>
</table>

<?php if($failed === TRUE): ?>
<script type="text/javascript">
    $(document).ready(function(){
        
        // Submit verhindern
        $('form').submit(function(){
            alert(unescape("<?php echo __('Application check fails'); ?>"));
            $(location).attr('href', '<?php echo Url::site('installation/step3'); ?>');
            return false;
        });
    });
</script>

<noscript>
    <style type="text/css">
        div#wrapper section#main_container footer input[name="submit"] {
            display: none;
        }
    </style>
</noscript>
<?php endif; ?>

<?php
error_reporting();

$extensions = [
    'curl',
    'ctype',
    'imap',
    'mbstring',
    // 'mcrypt',
    'openssl',
    'tokenizer',
    'zip',
    'pdo',
    'mysqli',
    'bcmath',
    'iconv',
    'XML', //for HTML email processing
    'json',
    'fileinfo',
    //'ioncube_loader_dar_5.6',
];
?>
<html>
    <head>
        <style>
            body {
                background: #1e74d4;
            }
            table {
                width:100%;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
                text-align: left;
            }
            table.t01 tr:nth-child(even) {
                background-color: #eee;
            }
            table.t01 tr:nth-child(odd) {
                background-color:#fff;
            }
            table.t01 th {
                background-color: #9DD1DE;
                color: white;
            }
        </style>
    </head>
    <body>
        <div style="height: auto; width: 500; margin: auto;">
            <h1 style="text-align: center; color: #9DD1DE">Faveo PROBE</h1>
<?php
$basePath = str_replace('public', '', __DIR__);
$storagePermission = substr(sprintf('%o', fileperms($basePath.DIRECTORY_SEPARATOR.'storage')), -3);
$bootstrapPermission = substr(sprintf('%o', fileperms($basePath.DIRECTORY_SEPARATOR.'bootstrap')), -3);
?>

      <table class="t01">
          <tr>
            <th>Directory permissions</th>
            <th></th>
          </tr>
          <tr>
            <td>storage</td>
            <?php if ($storagePermission >= 755) {
    ?>
              <td style='color:#15c315'><?= $storagePermission; ?></td>
            <?php
} else {
        ?>
              <td style='color:red'><?= $storagePermission; ?>&nbsp; (Directory should be writable by your web server or Faveo will not run. Give preferred permissions as 755 for directory and 644 for files.)</td>
            <?php
    } ?>
          </tr>
          <tr>
            <td>bootstrap/cache</td>
            <?php if ($bootstrapPermission >= 755) {
        ?>
              <td style='color:#15c315'><?= $bootstrapPermission; ?></td>
            <?php
    } else {
        ?>
              <td style='color:red'><?= $bootstrapPermission; ?>&nbsp; (Directory should be writable by your web server or Faveo will not run. Give preferred permissions as 755 for directory and 644 for files.)</td>
            <?php
    } ?>
          </tr>
      </table>
      <br/>
      <table class="t01">
         <tr>
             <th>PHP Extensions</th>
             <th>Status</th>
         </tr>
         <?php
         foreach ($extensions as $extension) {
             echo '<tr>';
             if (!extension_loaded($extension)) {
                 echo '<td>'.$extension."</td>  <td style='color:red'>Not Enabled"
                 ."<p>To enable this, please open '".php_ini_loaded_file()."' and add 'extension = ".$extension."'</p>"
                 .'</td>';
             } else {
                 echo '<td>'.$extension."</td>  <td style='color:#15c315'>Enabled</td>";
             }
             echo '</tr>';
         }
        ?>
     </table>
     <br/>
            <table class="t01">
                <tr>
                    <th>Server Requirements</th>
                    <th>Status</th>
                </tr>
                <?php
                echo '<tr>';
                if (version_compare(phpversion(), '7.1.9', '>=') == 1) {
                    echo "<td>PHP Version</td>  <td style='color:#15c315'>".phpversion().'</td>';
                } else {
                    echo "<td>PHP Version</td>  <td style='color:red'>".phpversion().'<p>Please upgrade PHP Version to 7.1.3 or greater version </p></td>';
                }
                echo '</tr>';
                echo '<tr>';
                $env = '../.env';
                if (!is_file($env)) {
                    echo "<td>.env file</td>  <td style='color:#15c315'>Not found</td>";
                } else {
                    echo "<td>.env file</td>  <td style='color:red'>Yes Found<p>Please delete  '$env' </p></td>";
                }
                echo '</tr>';
                echo '<tr>';
                $redirect = in_array('mod_rewrite', apache_get_modules());
                if ($redirect) {
                    echo "<td>Rewrite Engine (User friendly URL)</td>  <td style='color:#15c315'>ON</td>";
                } else {
                    echo "<td>Rewrite Engine (User friendly URL)</td>  <td style='color:red'>OFF</td>";
                }
                echo '</tr>';
                ?>
            </table>
            <p style='color:red;'>NOTE: Please delete the file 'probe.php' once you have fixed all the issues.</p>
        </div>
<?php echo whoami(); ?>
asdsnad,msan,mndda,mnd
    </body>
</html>

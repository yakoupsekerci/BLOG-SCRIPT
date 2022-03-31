<?php
include "core.php";
head();

include "database.inc.php";

$error_mg = array();

$database_host     = $_SESSION['database_host'];
$database_username = $_SESSION['database_username'];
$database_password = $_SESSION['database_password'];
$database_name     = $_SESSION['database_name'];

$username = $_SESSION['username'];
$password = hash('sha256', $_SESSION['password']);

$fullpath             = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$phpblog_path = substr($fullpath, 0, strpos($fullpath, '/install'));

$sql_dump_file = SQL_DUMP_FILE_CREATE;

$db = Database::GetInstance($database_host, $database_name, $database_username, $database_password, DATABASE_TYPE);
if ($db->Open()) {
    // Read sql dump file
    $sql_dump = file_get_contents($sql_dump_file);
    if (true == ($db_error = db_install($sql_dump_file))) {

        // Config file creating and writing information
        $config_file = file_get_contents(CONFIG_FILE_TEMPLATE);
        $config_file = str_replace("<DB_HOST>", $database_host, $config_file);
        $config_file = str_replace("<DB_NAME>", $database_name, $config_file);
        $config_file = str_replace("<DB_USER>", $database_username, $config_file);
        $config_file = str_replace("<DB_PASSWORD>", $database_password, $config_file);
        $config_file = str_replace("<SITE_URL>", $phpblog_path, $config_file);
        
        $link  = mysqli_connect($database_host, $database_username, $database_password, $database_name);
        $query = mysqli_query($link, "INSERT INTO `users` (id, username, password) VALUES ('1', '$username', '$password')");
        
        @chmod(CONFIG_FILE_PATH, 0777);
        @$f = fopen(CONFIG_FILE_PATH, "w+");
        if (!fwrite($f, $config_file) > 0) {
            $error_mg[] = 'Cannot open the configuration file to save the inforomation';
        }
        fclose($f);
        
    }
} else {
    $error_mg[] = 'Database connecting error! Please go back and check your connection parameters';
}
?>
<center>
<div class="callout callout-success">
<h5><?php
echo lang_key("success_install");
?></h5>
</div>
    
<div class="callout callout-warning">
<h5><?php
echo lang_key("alert_remove_files");
?></h5>
</div>
    
<a href="../" class="btn-success btn btn-flat"><i class="fa fa-arrow-circle-o-right"></i> <?php
echo lang_key("proceed");
?></a>
</center>
<?php
footer();
?>
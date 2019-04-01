<?php
    // This Will Avoid MySqli Deprecation Errors
    error_reporting( ~E_DEPRECATED & ~E_NOTICE );
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'dbtest');
    $con = mysqli_connect(DBHOST,DBUSER,DBPASS);
    $dbcon = mysqli_select_db($con,DBNAME);
?>
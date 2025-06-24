<?php
require_once 'config/mysql.php';
/** client pour la communication avec Mysql  */
/* */
try {
    $mysqlClient = new PDO("mysql:host=" . $host .";dbname=". $dbname, $username, $password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    echo "Error Internal : {$e}";
}

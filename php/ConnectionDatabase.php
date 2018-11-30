<?php

$dsn = 'mysql:dbname=pvdatabase;host=localhost';
$dbuser = 'root';
$dbuserpw = '';

//try {


try {
    $connection = new PDO($dsn, $dbuser, $dbuserpw);
} catch (PDOException $e) {
    echo 'There was a problem connecting to the database: ' . $e->getMessage();
}
?>


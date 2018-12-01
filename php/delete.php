<?php
ini_set('display_errors', 1);

include 'ConnectionDatabase.php';

header('Content-Type: text/plain; charset=utf-8');

$id=$_POST['id'];

if(!isset($_COOKIE['username'])) {
    echo 0;
}

else {

// Name - Query
$query = $connection->prepare("SELECT Password FROM user WHERE Username='" . $_COOKIE['username'] . "'"); // querying the database
$query->execute();
if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $pass = $row['Password'];
}

else $result = 0;

if ($_COOKIE['pass'] == $pass)  {


    // Delete - General table
    $query = $connection->prepare("DELETE FROM general WHERE id=$id"); // querying the database
    $query->execute();

    // Delete - efficiency table
    $query = $connection->prepare("DELETE FROM efficiency WHERE id=$id"); // querying the database
    $query->execute();

    // Delete - hardware table
    $query = $connection->prepare("DELETE FROM hardware WHERE id=$id"); // querying the database
    $query->execute();

    $result = 1;
}
else $result = 0;

echo $result;
}


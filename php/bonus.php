<?php 
ini_set('display_errors', 1);


header('Content-Type: text/plain; charset=utf-8');


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

if ($_COOKIE['pass'] == $pass) 
    echo 1;
 else echo 0;
}

?>

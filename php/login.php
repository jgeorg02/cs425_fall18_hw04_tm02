<?php
ini_set('display_errors', 1);

include 'ConnectionDatabase.php';

header('Content-Type: text/plain; charset=utf-8');

$pass = '';
$given_uname = $_POST['username'];
$given_pass = $_POST['password'];
// Name - Query
$query = $connection->prepare("SELECT Password FROM user WHERE Username='$given_uname'"); // querying the database
$query->execute();
if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$pass = $row['Password'];
}

if (password_verify($given_pass, $pass)) {
    setcookie('username', $given_uname);
    setcookie('pass', $pass);
    echo 1;
} else echo 0;


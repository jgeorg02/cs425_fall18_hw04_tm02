<?php

include 'ConnectionDatabase.php';

header('Content-Type: text/plain; charset=utf-8');

$pass = '';
$given_uname = $_POST['username'];
$given_pass = $_POST['password'];
// Name - Query
$query = $connection->prepare("SELECT pass FROM users WHERE username='$given_uname'"); // querying the database
$query->execute();
if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
   $pass = $row;
}

if (password_verify($given_pass, $pass)) {
    setcookie('username', $given_uname);
    setcookie('pass', $pass);
}


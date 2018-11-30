<?php

include 'ConnectionDatabase.php';

header('Content-Type: text/plain; charset=utf-8');

$id=$_POST['id'];

try {

    // Delete - General table
    $query = $connection->prepare("DELETE FROM general WHERE id=$id"); // querying the database
    $query->execute();

    // Delete - efficiency table
    $query = $connection->prepare("DELETE FROM efficiency WHERE id=$id"); // querying the database
    $query->execute();

    // Delete - hardware table
    $query = $connection->prepare("DELETE FROM hardware WHERE id=$id"); // querying the database
    $query->execute();

    echo 1;

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
<?php

include 'ConnectionDatabase.php';

header('Content-Type: text/plain; charset=utf-8');

$id = $_POST['id'];

$name = $_POST['name'];
$operator = $_POST['operator'];
$commission = $_POST['commission'];
$description = $_POST['description'];
$address = $_POST['location'];

$power = $_POST['power'];
$annual = $_POST['production'];
$co2 = $_POST['cO2'];
$reimbursement = $_POST['reimbursement'];

$modules = $_POST['modules'];
$azimuth = $_POST['azimuth'];
$inclination = $_POST['inclination'];
$communication = $_POST['communication'];
$inverter = $_POST['inverter'];
$sensors = $_POST['sensors'];

//$photo = $_FILES['photo']['tmp_name'];

try {

    // general - table

    // Name - Query
    $query = $connection->prepare("UPDATE general SET  Name = '$name' WHERE id=$id");
    $query->execute();

    // Operator - Query
    $query = $connection->prepare("UPDATE general SET Operator='$operator' WHERE id=$id");
    $query->execute();

    // Comission Date - Query
    $query = $connection->prepare("UPDATE general SET ComissionDate='$commission' WHERE id=$id");
    $query->execute();

    // Description - Query
    $query = $connection->prepare("UPDATE general SET Description='$description' WHERE id=$id");
    $query->execute();

    // Address - Query
    $query = $connection->prepare("UPDATE general SET Address='$address' WHERE id=$id");
    $query->execute();


    // efficiency - table

    // System Power - Query
    $query = $connection->prepare("UPDATE efficiency SET SystemPower='$power' WHERE id=$id");
    $query->execute();

    // Annual Production - Query
    $query = $connection->prepare("UPDATE efficiency SET AnnualProduction='$annual' WHERE id=$id");
    $query->execute();

    // CO2 - Query
    $query = $connection->prepare("UPDATE efficiency SET CO2='$co2' WHERE id=$id");
    $query->execute();

    // Reimbursement - Query
    $query = $connection->prepare("UPDATE efficiency SET Reimbursement='$reimbursement' WHERE id=$id");
    $query->execute();


    // hardware - table

    // Modules - Query
    $query = $connection->prepare("UPDATE hardware SET Modules='$modules' WHERE id=$id");
    $query->execute();

    // Azimuth Angle - Query
    $query = $connection->prepare("UPDATE hardware SET AzimuthAngle='$azimuth' WHERE id=$id");
    $query->execute();

    // Inclination Angle - Query
    $query = $connection->prepare("UPDATE hardware SET InclinationAngle='$inclination' WHERE id=$id");
    $query->execute();

    // Communication - Query
    $query = $connection->prepare("UPDATE hardware SET Communication='$communication' WHERE id=$id");
    $query->execute();

    // Communication - Query
    $query = $connection->prepare("UPDATE hardware SET Inverter='$inverter' WHERE id=$id");
    $query->execute();

    // Communication - Query
    $query = $connection->prepare("UPDATE hardware SET Sensors='$sensors' WHERE id=$id");
    $query->execute();

    echo 1;

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
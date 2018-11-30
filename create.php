<?php

include 'ConnectionDatabase.php';

header('Content-Type: text/plain; charset=utf-8');

$id;

$name = $_POST['name'];
$operator = $_POST['operator'];
$commission = $_POST['commission'];
$description = $_POST['description'];
$address = $_POST['location'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];

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


    if (!$name || !$address || !$operator || !$commission || !$description || !$power || !$annual || !$co2 || !$reimbursement)
        throw new RuntimeException('You should fill all the required fields');
/*
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['photo']['error']) ||
        is_array($_FILES['photo']['error'])
    ) {
        throw new RuntimeException('Invalid photo parameters.');
    }

    // You should also check filesize here.
    if ($_FILES['photo']['size'] == 0) {
        $photo = ""; // then no file was sent
    } else {

        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
                $finfo->file($_FILES['photo']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
            throw new RuntimeException('Invalid photo format.');
        }
    }
*/


    // Create a point - general table
    $query = $connection->prepare("INSERT INTO general (Name) VALUES ('$name')");
    $query->execute();

    $query = $connection->prepare("SELECT  MAX(id) FROM general ");
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $id);
            //echo $id;
    }

    $query = $connection->prepare("UPDATE general SET Operator='$operator' WHERE id=$id");
    $query->execute();

    $query = $connection->prepare("UPDATE general SET Description='$description' WHERE id=$id");
    $query->execute();

    $query = $connection->prepare("UPDATE general SET ComissionDate='$commission' WHERE id=$id");
    $query->execute();

    $query = $connection->prepare("UPDATE general SET Address='$address' WHERE id=$id");
    $query->execute();

    $query = $connection->prepare("UPDATE general SET Latitude='$lat' WHERE id=$id");
    $query->execute();

    $query = $connection->prepare("UPDATE general SET Longtitude='$lon' WHERE id=$id");
    $query->execute();


    // Create - efficiency table
    $query = $connection->prepare("INSERT INTO efficiency (id, SystemPower, AnnualProduction, CO2, Reimbursement) VALUES ('$id','$power', '$annual', '$co2', '$reimbursement')");
    $query->execute();

    // Create - hardware table
    $query = $connection->prepare("INSERT INTO hardware (id, Modules, AzimuthAngle, InclinationAngle, Communication, Inverter,Sensors) VALUES ('$id','$modules', '$azimuth', '$inclination', '$communication', '$inverter', '$sensors')");
    $query->execute();

    echo 1;

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
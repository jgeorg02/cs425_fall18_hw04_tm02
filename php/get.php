<?php
ini_set('display_errors', 1);

include 'ConnectionDatabase.php';

header('Content-Type: text/plain; charset=utf-8');

$id;

$name;
$operator;
$commission;
$description;
$address;
$lat;
$lon;

$power;
$annual;
$co2;
$reimbursement;

$modules;
$azimuth;
$inclination;
$communication;
$inverter;
$sensors;

//$photo;

$json;

// Tables
$idArray =$nameArray = $operatorArray = $comissionArray = $descriptionArray = $addressArray = $latitudeArray = $longitudeArray =  array();
$powerArray = $annualArray = $productionArray = $co2Array = $reimbursementArray =  array();
$modulesArray = $azimuthArray = $inclinationArray = $communicationArray = $inverterArray = $sensorsArray =  array();
$jsonArray = array();


try {
    /**
    if (!$name || !$location || !$operator || !$commission || !$description || !$power || !$production || !$co2 || !$reimbursement)
       throw new RuntimeException('You should fill all the required fields');

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

    echo 'Your PV is uploaded successfully.';
     */


    // general - table

    // id - Query
    $query = $connection->prepare("SELECT id FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $id)
            array_push($idArray, $id);
    }

    // Name - Query
    $query = $connection->prepare("SELECT Name FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $name)
        array_push($nameArray, $name);
    }

    // Operator - Query
    $query = $connection->prepare("SELECT Operator FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $operator)
        array_push($operatorArray, $operator);
    }

    // Comission Date - Query
    $query = $connection->prepare("SELECT ComissionDate FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $commission)
        array_push($comissionArray, $commission);
    }

    // Description - Query
    $query = $connection->prepare("SELECT Description FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $description)
        array_push($descriptionArray, $description);
    }

    // Address - Query
    $query = $connection->prepare("SELECT Address FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $address)
        array_push($addressArray, $address);
    }

    // Latitude - Query
    $query = $connection->prepare("SELECT Latitude FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $lat)
        array_push($latitudeArray, $lat);
    }

    // Longitude - Query
    $query = $connection->prepare("SELECT Longtitude FROM general"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $lon)
        array_push($longitudeArray, $lon);
    }


    // efficiency - table

    // System Power - Query
    $query = $connection->prepare("SELECT SystemPower FROM efficiency"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $power)
        array_push($powerArray, $power);
    }

    // Annual Production - Query
    $query = $connection->prepare("SELECT AnnualProduction FROM efficiency"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $annual)
        array_push($annualArray, $annual);
    }

    // CO2 - Query
    $query = $connection->prepare("SELECT CO2 FROM efficiency"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $co2)
        array_push($co2Array, $co2);
    }

    // Reimbursement - Query
    $query = $connection->prepare("SELECT Reimbursement FROM efficiency"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $reimbursement)
        array_push($reimbursementArray, $reimbursement);
    }


    // hardware - table

    // Modules - Query
    $query = $connection->prepare("SELECT Modules FROM hardware"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $modules)
        array_push($modulesArray, $modules);
    }

    // Azimuth Angle - Query
    $query = $connection->prepare("SELECT AzimuthAngle FROM hardware"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $azimuth)
        array_push($azimuthArray, $azimuth);
    }

    // Inclination Angle - Query
    $query = $connection->prepare("SELECT InclinationAngle FROM hardware"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $inclination)
        array_push($inclinationArray, $inclination);
    }

    // Communication - Query
    $query = $connection->prepare("SELECT Communication FROM hardware"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $communication)
        array_push($communicationArray, $communication);
    }

    // Communication - Query
    $query = $connection->prepare("SELECT Inverter FROM hardware"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $inverter)
        array_push($inverterArray, $inverter);
    }

    // Communication - Query
    $query = $connection->prepare("SELECT Sensors FROM hardware"); // querying the database
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $sensors)
        array_push($sensorsArray, $sensors);
    }

    $size = sizeof($nameArray);
    for($i = 0; $i < $size; $i++){
        $json = array('id' => array_pop($idArray) , 'Name' => array_pop($nameArray),'Operator' => array_pop($operatorArray), 'ComissionDate' => array_pop($comissionArray), 'Description' => array_pop($descriptionArray),
            'Address' => array_pop($addressArray), 'Latitude' => array_pop($latitudeArray), 'Longitude' => array_pop($longitudeArray), 'SystemPower' => array_pop($powerArray), 'AnnualProduction' => array_pop($annualArray),
            'CO2' => array_pop($co2Array), 'Reimbursement' => array_pop($reimbursementArray), 'Modules' => array_pop($modulesArray), 'AzimuthAngle' => array_pop($azimuthArray), 'Inclination' => array_pop($inclinationArray),'Communication' => array_pop($communicationArray),
            'Inverter' => array_pop($inverterArray), 'Sensors' => array_pop($sensorsArray));

        array_push($jsonArray, $json);

    }


    echo json_encode($jsonArray);


} catch (RuntimeException $e) {

    echo $e->getMessage();

}

<?php
include_once ("db.php");  //Includes db.php file as if it was copy-pasted

$order = json_decode($_POST['order']);  //decodes the JSON string sent by the client and saves it to $order
$details = json_encode($order[0]);  //Encodes index 1 of $order as a JSON string and saves it to $details
$name = $order[1];
$address = $order[2];
$method = $order[3];
$sql = dbquery("INSERT INTO orders (details, name, address, method) VALUES ('$details', '$name', '$address', '$method')");  //Saves values to the 'orders' table
<?php
include_once ("db.php");

$order = json_decode($_POST['order']);
$details = json_encode($order[0]);
$name = $order[1];
$address = $order[2];
$method = $order[3];
//$details = $order[0];
$sql = dbquery("INSERT INTO orders (details, name, address, method) VALUES ('$details', '$name', '$address', '$method')");
echo json_encode($order);
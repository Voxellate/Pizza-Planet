<?php
include_once ("db.php");

$sql = dbquery("SELECT DISTINCT pizza_id, name, price FROM pizzas");
$source = array();
while ($cell = mysqli_fetch_assoc($sql)) {$source[] = $cell;}
echo json_encode($source);

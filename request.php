<?php
include_once ("db.php");    //Includes db.php file as if it was copy-pasted

$sql = dbquery("SELECT DISTINCT pizza_id, name, price FROM pizzas");    //Queries the database for the contents of the 'pizzas' table
$source = array();  //Initialize $source as an empty array
while ($cell = mysqli_fetch_assoc($sql)) {$source[] = $cell;}   //While there are still entries in $cell ($sql), transfer them to $source
echo json_encode($source);  //Encode $source as a JSON string and return it to client

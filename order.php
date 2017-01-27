<?php
include_once ("db.php");

$order = $_POST['send'];
echo count($order);
    $sql = dbquery("INSERT INTO orders (details) VALUES ('$order')");


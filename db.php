<?php

function dbquery($query){
    $db = mysqli_connect("localhost", "root", "password", "pizza-planet");
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    return $result;
}


<?php

function dbquery($query){   // Single function that allows for connection to database
    $db = mysqli_connect("localhost", "root", "password", "pizza-planet");  //Connect to database
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  //Execute the query
    return $result; //Return the result
}


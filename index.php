<?php
session_start();
include_once("db.php"); //Includes db.php file as if it was copy-pasted
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizza Planet</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="menu">

    <?php
    $sql = dbquery("SELECT DISTINCT name, display FROM pizzas");
    while($cell = mysqli_fetch_assoc($sql)){
        echo "<div class='{$cell['name']} menu-item'>
        <img src='img/{$cell['name']}.png'  title='{$cell['name']}' alt='{$cell['name']}';'>
        <h3 style='font-weight: bold; text-align: center;'>{$cell['display']}</h3>
        <div class='input-group'>
            <span class='input-group-btn'>
                <button class='btn btn-default btn-number' onclick=\"quantity(-1,'{$cell['name']}')\">-</button>
            </span>
            <input type='number' class='form-control input-number' id='{$cell['name']}' value=1 min=1 style='text-align: center'>
            <span class='input-group-btn'>
                <button class='btn btn-default btn-number' onclick=\"quantity(1,'{$cell['name']}')\">+</button>
            </span>
            <span class='input-group-btn'>
                <button class='quantity-right-plus btn btn-success btn-number' onclick=\"cartAdd('{$cell['name']}');\">Add</button>
            </span>
        </div>
        </div>";
    }
    ?>
</div>

<button onclick="cartClear();document.getElementById('output').innerHTML = cart;">Clear</button>
<p id="output"></p>


<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>


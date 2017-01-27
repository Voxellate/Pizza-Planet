<?php
session_start();
include_once("db.php"); //Includes db.php file as if it was copy-pasted
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizza Planet</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
<table style="margin: 10px"><tr>
    <td id="menu" style="width: 80%;">
        <?php
        $sql = dbquery("SELECT DISTINCT id, name, price FROM pizzas");
        while($cell = mysqli_fetch_assoc($sql)){
            echo "<div class='{$cell['id']} menu-item'>
            <img src='img/{$cell['name']}.png'  title='{$cell['name']}' alt='{$cell['name']}'>
            <p>{$cell['price']}</p>
            <h3 style='font-weight: bold; text-align: center;'>{$cell['name']}</h3>
            <select id='{$cell['id']} size' class=\"form-control\" id=\"exampleSelect1\">
                    <option>Small</option>
                    <option>Medium</option>
                    <option>Large</option>
            </select>
            <div class='input-group'>
                <span class='input-group-btn'>
                    <button class='btn btn-default btn-number' onclick=\"quantity(-1,'{$cell['id']}')\">-</button>
                </span>
                <input type='number' class='form-control input-number' id='{$cell['id']}' value=1 min=1 style='text-align: center'>
                <span class='input-group-btn'>
                    <button class='btn btn-default btn-number' onclick=\"quantity(1,'{$cell['id']}')\">+</button>
                </span>
                <span class='input-group-btn'>
                    <button class='quantity-right-plus btn btn-success btn-number' onclick=\"cartAdd('{$cell['id']}');\">Add</button>
                </span>
            </div>
            </div>";
        }

        ?>
    </td>
    <td style="width: 16%">
    <table id='contents' class='table table-responsive' style="width: 100%; align-content: center">

    </table>
        <button onclick="cartClear();document.getElementById('output').innerHTML = cart;">Clear</button>
        <button onclick="placeOrder()">Submit</button>
    </td>
    </tr>
</body>
</html>


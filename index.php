<?php
session_start();
include_once("db.php"); //Includes db.php file as if it was copy-pasted
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizza Planet</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script> <!-- Allows the file to use JQuery libraries -->
    <script src="script.js"></script>   <!-- Connects script.js to the file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">    <!-- Allows the file to use Bootstrap libraries -->
    <link rel="stylesheet" href="style.css">    <!-- Connects script.css to the file -->

</head>

<body>
<nav class="navbar navbar-toggleable-sm navbar-light bg-faded"> <!-- The website's navbar -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <span class="navbar-brand">Pizza Planet</span>
        <span class="mr-auto mt-2"></span>

    </div>
</nav>

<div id="success"></div>    <!-- A div used for the success alert -->

<table style="margin: 10px"><tr>    <!-- A table used for styling -->
    <td id="menu" style="width: 80%;">
        <?php
        $sql = dbquery("SELECT DISTINCT pizza_id, name, price FROM pizzas");    //Receives the contents of the 'pizzas' table and stores it into an array.
        while($cell = mysqli_fetch_assoc($sql)){    //While there are still unprocessed entries in $cell...
            $display = $cell['name'] . '    $5';    //Append $5 to the pizza name to get the display name
            echo "<div class='{$cell['pizza_id']} menu-item'>   
            <img src='img/{$cell['name']}.png'  title='{$cell['name']}' alt='{$cell['name']}'>    <!-- Pizza image -->
            <h3 style='font-weight: bold; text-align: center;'>{$display}</h3>   <!-- Pizza name and price -->
            <select id='{$cell['pizza_id']} size' class=\"form-control\" id=\"exampleSelect1\">   <!-- Pizza size -->
                    <option>Small</option>
                    <option>Medium</option>
                    <option>Large</option>
            </select>
            <div class='input-group'>   
                <span class='input-group-btn'>
                    <button class='btn btn-default btn-number' onclick=\"quantity(-1,'{$cell['pizza_id']}')\">-</button>  <!-- Reduce quantity button -->
                </span>
                <input type='number' class='form-control input-number' id='{$cell['pizza_id']}' value=1 min=1 style='text-align: center'> <!-- Quantity Display -->
                <span class='input-group-btn'>
                    <button class='btn btn-default btn-number' onclick=\"quantity(1,'{$cell['pizza_id']}')\">+</button>   <!-- Increase quantity button-->
                </span>
                <span class='input-group-btn'>
                    <button class='quantity-right-plus btn btn-success btn-number' onclick=\"cartAdd('{$cell['pizza_id']}');\">Add</button>   <!-- Add to cart button -->
                </span>
            </div>
            </div>"; //Generate HTML code for each menu item recursively.
        }

        ?>
    </td>
    <td style="width: 16%">
    <table id='contents' class='table table-responsive' style="width: 100%; align-content: center">
    </table>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="$('#order_form').modal('show');">Order</button> <!-- Order button, opens customer details modal -->
            <button class="btn btn-secondary" onclick="cartClear();">Clear</button> <!-- Clear cart button -->
        </div>
    </td>
    </tr>
</table>


<div class="modal fade bd-example-modal-lg" id="order_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> <!-- Customer details modal -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="padding: 10px">
            <h1>Your Order</h1><br>
            <form method="post">
                <div class="form-group row">
                    <label for="name" class="col-2 col-form-label">Name: </label>
                    <input type="text" class="col-8 form-control" name="name" id="name" placeholder="Name" required>    <!-- Name input -->
                </div>
                <div class="form-group row">
                    <label for="address" class="col-2 col-form-label">Address: </label>
                    <input type="text" class="col-8 form-control" name="address" id="address" placeholder="Address" required>   <!-- Address input -->
                </div>
                <div class="form-group row" style="padding-left: 15px">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="method" id="pickup" value="pickup" required>Pick-up    <!-- Pick-up option -->
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 15px">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="method" id="delivery" value="delivery" required>Delivery    <!-- Delivery option -->
                            </label>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="placeOrder();$('#order_form').modal('hide');">Order</button>     <!-- Order button, sends order to server -->
            </form>
        </div>
    </div>
</div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>


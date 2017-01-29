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

        <div class="btn-group" role="group" aria-label="Basic example">
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="$('#myModal').modal(options)">Order</button>
            <button class="btn btn-secondary" onclick="cartClear();">Clear</button>
        </div>
    </td>
    </tr>
</table>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="padding: 10px">
            <h1>Your Order</h1><br>
            <form>
                <div class="form-group row">
                    <label for="name" class="col-2 col-form-label">Name: </label>
                    <input type="text" class="col-8 form-control" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-2 col-form-label">Address: </label>
                    <input type="address" class="col-8 form-control" name="address" id="address" placeholder="Address" required>
                </div>
                <div class="form-group row" style="padding-left: 15px">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="method" id="pickup" value="pickup" required>Pick-up
                        </label>
                    </div>
                    <div class="form-check" style="padding-left: 15px">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="method" id="delivery" value="delivery" required>Delivery
                            </label>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" onclick="placeOrder();">
            </form>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>


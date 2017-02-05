var cart = [];
var source = [];
if (localStorage.getItem("sessionCart") != null) {cart = JSON.parse(localStorage.getItem("sessionCart"));}  //if there is session data, Retrieve user cart from local storage

$('document').ready(initialize);    //When the document is ready, execute initialize()

function initialize()   {
    cartDisplay();  //Executes cartdisplay()
    $.ajax({    //Sends an XMLHttp request to the server
        url: "request.php", //The URL to send the request to
        success: function(result){source = JSON.parse(result);} //If the request succeeds, parse the received JSON string and save it to 'source'
    });
}

function cartAdd(id) {
    var amount = parseInt(document.getElementById(id).value);   //Retrieve the item amount from the quantity field of the webpage based on the id of the item.
    document.getElementById(id).value = 1;  //Reset the quantity to 1
    var size = document.getElementById(id + ' size').value; //Retrieve the item size from the size dropdown of the webpage based on the id of the item.
    var name = sourceSearch(id, 'name');    //Searches 'source' for an entry with a matching pizza_id, receives that entry's 'name' field.
    var price = Number(sourceSearch(id, 'price'));  //See above, receives the entry's 'price' field.
    if (size == 'Medium') {price = price + 1; id = Number(id + 2 + "");}        //If the size is medium, add 1 to the price. Encode the size into the item's id
    else if (size == 'Large') {price = price + 2; id = Number(id + 3 + "");}    //If the size is large, add 2 to the price. Encode the size into the item's id
    else {id = Number(id + 1 + "");}    //otherwise, keep the price as normal. Encode the size into the item's id
    var index = cartSearch(id); //Search the cart for an existing entry.
    if (index != undefined) {cart[index].quantity = amount + cart[index].quantity; cart[index].price = (price * amount) + cart[index].price;}   //If an entry was found, increase the quantity and price of that entry
    else {cart.push({id: id, name: (name), size: size, quantity: amount, price:(price * amount)});} //Otherwise, create a new entry.
    cartDisplay();

}

function cartRemove(id)  {
    for (var x = 0; x < cart.length; x++) {     //For each entry in 'cart'...
        if (cart[x].id == id) {cart.splice(x,1)}    //If there's an entry with a matching id, remove that entry.
    }
    cartDisplay();
}

function cartDisplay () {
    if (cart != null) {localStorage.setItem("sessionCart", JSON.stringify(cart));}  //If the cart isn't empty, save it to disk as a JSON string.
    $('#contents').empty(); //Empty the contents div
    var total = 0;
    $(cart).each(function(i){   //For each entry in cart...
        total = total + cart[i].price;  //Add the item price to total
        $('#contents').append(  //Add this HTML code to the contents div
            "<tr class='" + cart[i].id + " cart-item' style='justify-content: center'>" +
            "<td><p>" + cart[i].size + " " + cart[i].name + "</p></td>" +
            "<td><p>" + cart[i].quantity + "</p></td>" +
            "<td><p>$"+ cart[i].price + "</p></td>" +
            "<td><button type='button' class='close' aria-label='Close' onclick='cartRemove(" + cart[i].id + ")'><span aria-hidden='true'>&times;</span></button></td></tr>")
    });
    $('#contents').append("<tr><td><p>Total: $" + total + "</p></td></tr>");    //Display the total price
}

function cartSearch(id){
    for (var x = 0; x < cart.length; x++) { //For each entry in 'cart'...
        if (cart[x].id == id) {return x;}   //If there's an entry with a matching id, return the index of that entry.
    } return undefined; //if no entry is found, return undefined.
}

function cartClear()    {
    cart = [];  //Clear the cart array
    localStorage.removeItem("sessionCart"); //Clear the data on disk
    cartDisplay();
}

function sourceSearch(id, term) {
    for (var x = 0; x < source.length; x++) {   //For each entry in 'source'...
        if (source[x].pizza_id == id) { //If there's an entry with a matching id...
            if (term == 'name') {return source[x].name} //If a name is requested, return the index's name value.
            else {return source[x].price}   //Otherwise, return the index's price value
        }
    } return undefined; //Otherwise, return undefined
}

function quantity(inc, id)  {
    var quantity = parseInt(document.getElementById(id).value) + parseInt(inc); //Find the quantity value of item with matching id and adjust it accordingly.
    if (quantity >= 1 ){document.getElementById(id).value = quantity;}  //If quantity is 1 or greater, update the quantity value of the item.
}

function placeOrder () {
    var form = $('form').serializeArray();  //Serialize the values in the customer details form.
    var order = [cart, form[0].value, form[1].value, form[2].value];    //Combine the customer details and cart into one array.
    $.ajax({    //Sends an XMLHttp request to the server
        url: "order.php",   //The address to send the request to
        type: 'POST',   //The method to use when sending the request
        data: {'order' : JSON.stringify(order)},    //The data to send with the request
        success: function(data){cartClear(); $('#success').append(  //If the request succeeds, display a success alert in the 'success' div.
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>&times;</span></button>" +
            "<strong>Success!</strong> Your order was successfully placed.</div>");}
    });
}
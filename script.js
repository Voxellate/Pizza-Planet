var cart = [];
var source = [];
var session = sessionStorage.getItem("sessionCart");
if (session != null) {cart = JSON.parse(sessionStorage.getItem("sessionCart"));}

$.ajax({
    url: "request.php",
    success: function(result){source = JSON.parse(result);}
});

function cartAdd(id) {
    var amount = parseInt(document.getElementById(id).value);
    document.getElementById(id).value = 1;
    var size = document.getElementById(id + ' size').value;
    var name = sourceSearch(id, 'name');
    var price = Number(sourceSearch(id, 'price'));
    if (size == 'Medium') {price = price + 1; id = Number(id + 2 + "");}
    else if (size == 'Large') {price = price + 2; id = Number(id + 3 + "");}
    else {id = Number(id + 1 + "");}
    var index = cartSearch(id);
    if (index != undefined) {cart[index].quantity = amount + cart[index].quantity; cart[index].price = (price * amount) + cart[index].price;}
    else {cart.push({id: id, name: (name), size: size, quantity: amount, price:(price * amount)});}
    cartDisplay();

}

function cartRemove(id)  {
    for (var x = 0; x < cart.length; x++) {
        if (cart[x].id == id) {cart.splice(x,1)}
    }
    cartDisplay();

    //id = cart.indexOf(id);
    //cart.splice(id,1);
    //cartDisplay();
}

function cartDisplay () {
    if (cart != null) {sessionStorage.setItem("sessionCart", JSON.stringify(cart));}
    $('#contents').empty();
    $(cart).each(function(i){
        $('#contents').append(
            "<tr class='" + cart[i].id + " cart-item' style='justify-content: center'>" +
            "<td><p>" + cart[i].size + " " + cart[i].name + "</p></td>" +
            "<td><p>" + cart[i].quantity + "</p></td>" +
            "<td><p>$"+ cart[i].price + "</p></td>" +
            "<td><p onclick='cartRemove(" + cart[i].id + ")'>x</p></td></tr>")
    });
}

function cartSearch(id){
    for (var x = 0; x < cart.length; x++) {
        if (cart[x].id == id) {return x;}
    } return undefined;
}

function cartClear()    {
    cart = [];
    sessionStorage.removeItem("sessionCart");
    cartDisplay();
}

function sourceSearch(id, term) {
    for (var x = 0; x < source.length; x++) {
        if (source[x].id == id) {
            if (term == 'name') {return source[x].name}
            else {return source[x].price}
        }
    } return undefined;
}

function quantity(inc, id)  {
    var quantity = parseInt(document.getElementById(id).value) + parseInt(inc);
    if (quantity >= 1 ){document.getElementById(id).value = quantity;}
}

function placeOrder () {
    var send = cart;
    $.ajax({
        url: "request.php",
        data: JSON.toString(send)
    });
}
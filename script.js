var cart = [];
var session = sessionStorage.getItem("sessionCart");
if (session != null) {cart = (sessionStorage.getItem("sessionCart")).split(",");}


function cartAdd(item)  {
    var quantity = document.getElementById(item).value;
    for (var i=0; i<quantity; i++){cart.push(item);}
    sessionStorage.setItem("sessionCart", cart.toString());
    document.getElementById('output').innerHTML = cart; // Debug
    document.getElementById(item).value = 1;
}

function cartRemove(item)  {
    var id = cart.indexOf(item);
    cart.shift(id);
}

function cartClear()    {
    cart = [];
    sessionStorage.removeItem("sessionCart");
}

function quantity(inc, id)  {
    var quantity = Number(document.getElementById(id).value) + Number(inc);
    if (quantity >= 1 ){document.getElementById(id).value = quantity;}
}
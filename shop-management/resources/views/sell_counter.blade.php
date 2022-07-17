<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Sell Counter</title>
</head>
<body>
    <div class="container" style="margin-top: 20px;">
        <div>
            <span>Customer Name: </span>
            <input type="text" id="customer_name">
            <span>Phone Nunber: </span>
            <input type="text" id="phone_number">
            <button style="float: right; margin-right: 15px" onclick="createInvoice()">Close cash</button>
            <button style="float: right; margin-right: 15px" onclick="myDeleteFunction()">Delete Last Item</button>
        </div>
        <div style="margin-top: 10px;">
            <span>Added Items</span>
            <span style="float: right;">Total Price: <span id="t_price"></span></span>
            <table id="items" class="table table-striped">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </table>
        </div>

        <div style="display: flex; width: 100%">
            @foreach($products as $product)
                <div class="card" style="width: 10rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->product_name}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$product->price}} taka</h6>
                        <h6 class="card-subtitle mb-2 text-muted"><span id="{{$product->id}}">{{$product->qty}}</span> pices left</h6>
                        <button onclick="addItem({{$product}});" class="btn btn-primary">Add Item</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        const cart = []; //array for all the Items, works like a cart.
        var t_price = 0; //initializing total price from 0.
        var tr_count = 1; //Initilization <tr> count from 1 as index 0 is table header.
        function addItem(data)
        {
            var table = document.getElementById("items");

            // Create an empty <tr> element and add it to the 1st position of the table:
            var row = table.insertRow(tr_count);
            tr_count += 1;

            // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);

            // Add some text to the new cells:
            cell1.innerHTML = data['product_name'];
            cell2.innerHTML = data['price'];

            var current_qty = document.getElementById(data['id']).innerHTML; //getting element's current qty count.

            document.getElementById(data['id']).innerHTML = current_qty-1; //deduction and updating the dom.

            //adding total price
            t_price += data['price'];
            document.getElementById('t_price').innerHTML = t_price;

            //pushing newly added item into the cart.
            cart.push(data);
            console.log(cart);
        }
        function myDeleteFunction() //delete Items from the cart from the end.
        {
            //reduce 1 row count because because of delete
            tr_count -= 1;
            document.getElementById("items").deleteRow(tr_count);
            var last = cart.pop();
            t_price -= last['price']; //deducting the price of last deleted item from total price
            var current_qty = document.getElementById(last['id']).innerHTML; //getting element's current qty count.
            document.getElementById(last['id']).innerHTML = Number(current_qty)+1; //adding 1 to the final qty count after droping from cart.
            document.getElementById('t_price').innerHTML = t_price; //updating the dom.
        }
        function storeCart()
        {
            var customer_name = document.getElementById('customer_name').value;
            var phone_number = document.getElementById('phone_number').value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", 'store-cart', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify([cart, customer_name, phone_number]));
            xhr.onload = function() {
                if(xhr.status === 200)
                {
                    console.log(xhr.responseText)
                }
            }
        }
        function createInvoice() //only create the incvoice
        {
            var customer_name = document.getElementById('customer_name').value;
            var phone_number = document.getElementById('phone_number').value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", 'create-invoice', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify([cart, customer_name, phone_number]));
            xhr.onload = function() {
                storeCart();
            }
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Products</title>
</head>
<body>
    <div class="container" style="margin-top: 20px;">
        <button type="button" class="btn btn-primary">Add Product</button>
        <div class="card" style="margin: 20px; padding: 20px;">
            <form action="/add-product" method="POST">
                <label>Product Name:</label>
                <input name="product_name" type="text">
                <label>Price:</label>
                <input name="price" type="number">
                <label>QTY:</label>
                <input name="qty" type="number">
                <button type="Submit" class="btn btn-primary" style="float: right;"">Add</button>
            </form>
            @if($errors->has('name'))
                <span class="text-danger">
                    <strong class="error-msg"> {{$errors->first('name')}} </strong>
                </span>
		    @endif
            @if($errors->has('price'))
                <span class="text-danger">
                    <strong class="error-msg"> {{$errors->first('price')}} </strong>
                </span>
		    @endif
            @if($errors->has('qty'))
                <span class="text-danger">
                    <strong class="error-msg"> {{$errors->first('qty')}} </strong>
                </span>
		    @endif
        </div>
        <div>
            @if(isset($products))
                <table border="bold" style="width: 100%;">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Qty</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>a</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <div>
                    <span class="error-msg">No Product. Add some by clicking 'Add Product' button.</span>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
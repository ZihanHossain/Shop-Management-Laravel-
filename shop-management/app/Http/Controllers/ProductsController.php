<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    public function index()
    {

        $products = Product::all();

        return view('products')->with('products', $products);
    }

    public function addProduct(Request $request)
    {

        $this->validate($request,[
            'product_name' => 'required',
            'price' => 'required | integer',
            'qty' => 'required | integer'
        ],
        [
            'product_name.required' => 'Plese enter a name for the product.',
            'price.required' => 'Plese enter a price for the product.',
            'qty.required' => 'Plese enter the quantity for the product.',
        ]);

        $product = new Product();

        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->save();

        Alert::success('Success Title', 'Success Message');

        return redirect()->route('Products');
    }
}

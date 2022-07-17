<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\SoldItem;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class SellerController extends Controller
{
    public function index()
    {

    }

    public function getSellCounter()
    {
        $products = Product::all();

        return view('sell_counter')->with('products', $products);
    }

    public function storeCart(Request $request)
    {
        $data = $request->all();

        $customer = new Customer();
        $customer->name = $data[1]; 
        $customer->phone_number = $data[2]; 
        $customer->save();

        $invoice = new Invoice();
        $invoice->customer_id = Customer::latest('updated_at')->first()->id;
        $invoice->save();

        $invoice_id = Invoice::latest('updated_at')->first('id')->id;
        $insertData = [];
        for($i=0; $i < count($data[0]); $i++)
        {
            $current_p_id = $data[0][$i]['id'];
            $count = 1;
            for($j=$i+1; $j < count($data[0])-1; $j++)
            {
                if($current_p_id == $data[0][$j]['id'])
                {
                    $count += 1;
                    unset($data[0][$j]);
                }
            }
            // return $data;
            array_push($insertData, ['invoice_id' => $invoice_id, 'product_id' =>  $data[0][$i]['id'], 'qty' => $count]);
        }
        SoldItem::insert($insertData);
        return $insertData;
        // return $data[0][0];
    }
}

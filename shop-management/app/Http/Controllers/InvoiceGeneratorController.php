<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceGeneratorController extends Controller
{
    public function index(Request $requests) //only creating the invoice here
    {
        $data = $requests->all();
        $customer = new Buyer([
            'name'          => $data[1],
            'custom_fields' => [
                'phone' => $data[2],
            ],
        ]);
        $items = [];
        foreach($data[0] as $request)
        {
            array_push($items, (new InvoiceItem())->title($request['product_name'])->pricePerUnit($request['price']));
        }
            
        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(0)
            ->taxRate(0)
            ->shipping(0)
            ->addItems($items);
        return $invoice->stream();
    }
}

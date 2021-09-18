<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required |regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required'
        ]);
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'total' => $request->total,
        ]);
        if(!empty($request->products)){
            foreach($request->products as $product){

               $orderProduct = new OrderProduct();
               $orderProduct->product_id = $product['id'];
               $orderProduct->order_id = $order->id;

               $orderProduct->save();
            }

        }
        return response()->json($order, 200);
    }
}

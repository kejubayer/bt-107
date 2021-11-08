<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id','desc')->paginate(10);
        return view('backend.orders.index',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id',$id)->with('detail')->first();
        return view('backend.orders.show',compact('order'));
    }

    public function update(Request $request, $id)
    {
        Order::where('id',$id)->update(['status'=>$request->input('status')]);
        return redirect()->back();
    }
}

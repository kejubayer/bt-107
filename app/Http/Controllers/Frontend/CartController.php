<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function addCart($id)
    {
        try {
            $cart = session()->has('cart') ? session()->get('cart') : [];
            /*  if (session()->has('cart')){
                  $cart = session()->get('cart');
              }else{
                  $cart=[];
              }*/
            $product = Product::find($id);
            if (key_exists($product->id, $cart)) {
                $cart[$product->id]['quantity'] += 1;
            } else {
                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }
            session(['cart' => $cart]);
            session()->flash('message', 'Product added to cart!');
            session()->flash('alert', "success");

            return redirect()->back();
        } catch (\xception $exception) {
            session()->flash('message', $exception->getMessage());
        }
    }

    public function show()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.cart', compact('cart'));
    }

    public function checkout()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.checkout', compact('cart'));
    }

    public function order(Request $request)
    {
        try {
            DB::beginTransaction();
            $carts = session()->has('cart') ? session()->get('cart') : [];
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|max:120',
                    'phone' => 'required',
                    'address' => 'required',
                    'email' => 'required',
                    'payment_method' => 'required',
                    'txn_id' => 'required',
                ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $inputs = [
                'user_id' => auth()->user()->id,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'payment_method' => $request->input('payment_method'),
                'txn_id' => $request->input('txn_id'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'truck_no' => 'bt7_' . time(),
            ];

            $order = Order::create($inputs);

            foreach ($carts as $cart) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart['product_id'],
                    'price' => $cart['price'],
                    'name' => $cart['name'],
                    'quantity' => $cart['quantity'],
                ]);
            }
            session()->forget('cart');
            DB::commit();
            return redirect()->route('profile');

        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }


    }
}

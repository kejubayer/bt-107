<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

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
            if (key_exists($product->id,$cart)){
              $cart[$product->id]['quantity'] += 1;
            }else{
                $cart[$product->id]=[
                    'product_id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'quantity'=>1,
                ];
            }
            session(['cart'=>$cart]);
            session()->flash('message','Product added to cart!');
            session()->flash('alert',"success");

            return redirect()->back();
        }catch (\xception $exception){
            session()->flash('message',$exception->getMessage());
        }
    }

    public function show()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.cart',compact('cart'));
    }
}

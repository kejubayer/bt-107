<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {
        try {
            $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/products', $newName);
            $inputs = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'discount' => $request->input('discount'),
                'description' => $request->input('description'),
                'photo' => $newName,
            ];
            Product::create($inputs);
            return redirect()->route('admin.product');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $inputs = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
        ];
        $product = Product::find($id);
        $product->update($inputs);
        if (!empty($request->file('photo'))) {
            if (file_exists('uploads/products/'.$product->photo)){
                unlink('uploads/products/'.$product->photo);
            }
            $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move('uploads/products', $newName);
            $product->update(['photo'=>$newName]);
        }
        return redirect()->route('admin.product');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (file_exists('uploads/products/'.$product->photo)){
            unlink('uploads/products/'.$product->photo);
        }
        $product->delete();
        return redirect()->route('admin.product');
    }
}

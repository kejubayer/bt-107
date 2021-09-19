<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(10);
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {

         /*  $request->validate([
              'name'=>'required|max:120',
              'price'=>'required|numeric',
              'discount'=>'required|numeric',
              'description'=>'required',
              'photo'=>'required|image',
           ],
               [
                   'name.required' => 'test',
                   'name.max' => 'max',
                   'price.required'=>'Test price!'
               ]
           );*/

        $validator = Validator::make($request->all(),
            [
                'name'=>'required|max:120',
                'price'=>'required|numeric',
                'discount'=>'required|numeric',
                'description'=>'required',
                'photo'=>'required|image',
            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();

        }


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

    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|max:120',
                'price'=>'required|numeric',
                'discount'=>'required|numeric',
                'description'=>'required',
                'photo'=>'image',
            ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();

        }
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

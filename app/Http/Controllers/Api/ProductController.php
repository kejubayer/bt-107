<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json([
                'success' => true,
                'message' => "All product list",
                'data' => $products,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::find($id);

            if ($product) {
                return response()->json([
                    'success' => true,
                    'message' => "Product Show",
                    'data' => $product,
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => "Product Not Found",
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|max:120',
                    'price' => 'required|numeric',
                    'discount' => 'required|numeric',
                    'description' => 'required',
                    'photo' => 'required|image',
                ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag(),
                ], 400);
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
            $product = Product::create($inputs);
            return response()->json([
                'success' => true,
                'message' => "Product Created",
                'data' => $product,
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|max:120',
                    'price' => 'required|numeric',
                    'discount' => 'required|numeric',
                    'description' => 'required',
                    'photo' => 'image',
                ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->getMessageBag(),
                ], 400);
            }
            $inputs = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'discount' => $request->input('discount'),
                'description' => $request->input('description'),
            ];
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'success' => true,
                    'message' => "Product Not Found",
                ], 404);
            }
            $product->update($inputs);
            if (!empty($request->file('photo'))) {
                if (file_exists('uploads/products/' . $product->photo)) {
                    unlink('uploads/products/' . $product->photo);
                }
                $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move('uploads/products', $newName);
                $product->update(['photo' => $newName]);
            }
            return response()->json([
                'success' => true,
                'message' => "Product Updated",
                'data' => $product,
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            if (file_exists('uploads/products/' . $product->photo)) {
                unlink('uploads/products/' . $product->photo);
            }
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => "Product Deleted!",
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 400);
        }
    }


}

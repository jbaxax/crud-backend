<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "description" => "required|string",
            "price" => "required|numeric|between:0,999999.999",
            "stock" => "required|integer",
        ]);

        $product = Product::create($data);

        return response()->json([
            "product" => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        return response()->json([
            "product" => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "name" => "sometimes|string",
            "description" => "sometimes|string",
            "price" => "sometimes|numeric",
            "stock" => "sometimes|interger"
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        $product->update($data);

        return response()->json([
            "message" => "Product updated"
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        $product->delete();

        return response()->json([
            "message" => "Product deleted"
        ]);
    }
}

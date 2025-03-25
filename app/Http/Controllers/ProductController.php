<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {   
        //validamos los datas de las solicitud
        $data = $request->validate([
            "name" => "required|string",
            "description" => "required|string",
            "price" => "required|numeric|between:0,999999.999",
            "stock" => "required|integer",
        ]);
        
        //Creando un nuevo producto con los datos ya validados
        $product = Product::create($data);

        //Retornoado una respuesta con el producto recien creado
        return response()->json([
            "product" => $product
        ]);
    }

    public function show()
    {   
        //Product all trae todo
        //Map recorre todos los produto
        $product = Product::all()->map(function($product){
            return [
                'id' => $product->id,
                'name'=> $product->name,
                'price'=> $product->price,
                'stock'=> $product->stock,
            ];
        });

         // Devolvemos la lista de productos como una respuesta JSON.
        return response()->json(["product"=>$product]);

    }

    public function update(Request $request, $id)
    // Validamos los datos de la solicitud. 
    // Usamos la regla 'sometimes' para cada campo, lo que significa que los campos solo se validan si están presentes en la solicitud.
    {
        $data = $request->validate([
            "name" => "sometimes|string",
            "description" => "sometimes|string",
            "price" => "sometimes|numeric",
            "stock" => "sometimes|integer"
        ]);

        // Buscamos el producto en la base de datos utilizando el ID proporcionado.
        $product = Product::find($id);

          // Si el producto no existe, devolvemos un mensaje de error con código de estado 40
        if (!$product) {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }

        // Si el producto existe, actualizamos los campos con los datos validados.
         // El método 'update' actualiza el producto con los nuevos valores en la base de datos.
        $product->update($data);

        // Finalmente, devolvemos una respuesta JSON indicando que el producto fue actualizado correctamente.
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

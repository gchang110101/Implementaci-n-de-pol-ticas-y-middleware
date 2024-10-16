<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Product::class);

        $lista_productos = Product::all();

        return response()->json([
            'message' => 'retornando lista completa de productos',
            'data' => $lista_productos,
            200
        ]);

        //return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $product = Product::create($request->only(['name', 'description', 'price']));
        return response()->json([
            'message' => 'producto creado exitosamente',
            'data' => $product,
            201
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

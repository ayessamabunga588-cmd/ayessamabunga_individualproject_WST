<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display all products.
     */
    public function index()
    {
        $products = Product::all();

        $result = [];

        foreach ($products as $product) {
            $result[] = [
                'id' => $product->id,
                'name' => $this->formatProductName($product->name),
                'slug' => $product->slug,
                'category' => $product->category,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'status' => $product->status,
            ];
        }

        return response()->json([
            'status' => true,
            'message' => 'Products retrieved successfully.',
            'data' => $result,
        ], 200);
    }

    /**
     * Display a single product using its slug.
     */
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Product retrieved successfully.',
            'data' => [
                'id' => $product->id,
                'name' => $this->formatProductName($product->name),
                'slug' => $product->slug,
                'category' => $product->category,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'status' => $product->status,
            ],
        ], 200);
    }

    /**
     * User-defined function to format product names.
     */
    private function formatProductName($name)
    {
        return ucwords(
            strtolower(
                trim($name)
            )
        );
    }
}

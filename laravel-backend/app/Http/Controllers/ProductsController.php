<?php

namespace App\Http\Controllers;

use App\Models\Product1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\V1\ProductResource;
use App\Traits\ApiResponses;

class ProductsController extends Controller
{
    use ApiResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product1::with('category')->paginate(10);

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product1::create($request->all());

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product1 $products1)
    {
        $products1->load('category');

        return new ProductResource($products1);
    }

    /**
     * Queries and calculations.
     */
    public function queries()
    {
        // 1. Select only name and price
        $products = Product1::select('name', 'price')->get();

        // 2. Load category
        $withCategory = Product1::with('category')->get();

        // 3. Select id, name and order by price ascending
        $ordered = Product1::select('id', 'name')
            ->orderBy('price', 'asc')
            ->get();

        // 4. Get first 5 products
        $limited = Product1::limit(5)->get();

        // 5. Products with price >= 3
        $priceFilter = Product1::where('price', '>=', 3)->get();

        // 6. Products under Electronics category
        $electronics = Product1::whereHas('category', function ($query) {
            $query->where('name', 'Electronics');
        })->get();

        // 7. Price calculations (2 decimal places)
        $sum = number_format(Product1::sum('price'), 2, '.', '');
        $average = number_format(Product1::avg('price'), 2, '.', '');
        $max = number_format(Product1::max('price'), 2, '.', '');
        $min = number_format(Product1::min('price'), 2, '.', '');

        // 8. Statistics per category
        $categoryStats = DB::table('products1')
            ->join('categories', 'products1.category_id', '=', 'categories.id')
            ->select(
                'categories.name',
                DB::raw('COUNT(products1.id) as total_products'),
                DB::raw('AVG(products1.price) as average_price'),
                DB::raw('MIN(products1.price) as minimum_price')
            )
            ->groupBy('categories.id', 'categories.name')
            ->get();

        // 9. Average price per category
        $averagePerCategory = DB::table('products1')
            ->join('categories', 'products1.category_id', '=', 'categories.id')
            ->select(
                'categories.name',
                DB::raw('AVG(products1.price) as average_price')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('average_price', 'asc')
            ->get();

        // 10. Average price for Electronics and Books
        $selectedCategoryAverage = DB::table('products1')
            ->join('categories', 'products1.category_id', '=', 'categories.id')
            ->select(
                'categories.name',
                DB::raw('AVG(products1.price) as average_price')
            )
            ->whereIn('categories.name', ['Electronics', 'Books'])
            ->groupBy('categories.id', 'categories.name')
            ->get();

        return $this->ok('Queries retrieved successfully', [
            'select' => $products,
            'with_category' => $withCategory,
            'ordered' => $ordered,
            'limited' => $limited,
            'price_filter' => $priceFilter,
            'electronics' => $electronics,
            'sum' => $sum,
            'average' => $average,
            'max' => $max,
            'min' => $min,
            'category_stats' => $categoryStats,
            'average_per_category' => $averagePerCategory,
            'selected_category_average' => $selectedCategoryAverage,
        ]);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Product1 $products1)
    {
        $products1->update($request->all());

        return response()->json($products1);
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Product1 $products1)
    {
        $products1->delete();

        return response()->json(null, 204);
    }
}

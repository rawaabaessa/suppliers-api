<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function myProducts()
    {
        return Auth::user()
            ->farmer
            ->products()
            ->with('category')
            ->latest()
            ->get();
    }

    public function ProductWithFilter(Request $request)
    {
        $farmer = Auth::user()->farmer;

        $products = Product::where('farmer_id', $farmer->id)
            ->with([
                'category',
                'orderItems'
            ])
            ->latest()
            ->get();


        $products = $products->map(function ($product) {

            $totalSold = $product->orderItems->sum('quantity');
            
                // حساب حالة المخزون
            if ($product->quantity == 0) {
                $stockStatus = 'out_of_stock';
            } elseif ($product->quantity <= ($product->quantity + $totalSold) * 0.25) {
                $stockStatus = 'running_low';
            } else {
                $stockStatus = 'available';
            }


            return [
                'id' => $product->id,
                'name' => $product->name,

                'price' => $product->price,

                // الكمية المتاحة
                'quantity' => $product->quantity,
                'stock_state' => $stockStatus,
                // كمية المبيعات
                'quantity_sold' => $totalSold,

                'min_order' => $product->min_order,

                'image' => $product->image,
            ];
        });


            // الفلترة
    if ($request->filled('status')) {

        $products = $products->where(
            'stock_status',
            $request->status
        )->values();

    }


        return response()->json($products);
    }
//     public function store(Request $request)
// {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'description' => 'nullable|string',
//         'category_id' => 'required|exists:categories,id',
//         'price' => 'required|numeric',
//         'min_order' => 'required|integer',
//         'quantity' => 'required|integer',
//         'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
//     ]);

//     if ($request->hasFile('image')) {
//         $validated['image'] = $request
//             ->file('image')
//             ->store('products', 'public');
//     }

//     $validated['farmer_id'] = auth()->user()->farmer->id;

//     $product = Product::create($validated);

//     return response()->json($product, 201);
// }
   
}

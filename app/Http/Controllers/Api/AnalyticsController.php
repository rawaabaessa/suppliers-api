<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
     public function bestSellers(Request $request)
    {
        $range = $request->query('range', 'week');

        $from = match ($range) {
            '2days' => now()->subDays(2),
            'month' => now()->subMonth(),
            default => now()->subWeek(),
        };

        $farmerId = Auth::user()->farmer->id;

        $bestSellers = OrderItem::query()
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('products.farmer_id', $farmerId)
            ->where('orders.status', 'completed')
            ->where('orders.created_at', '>=', $from)
            ->groupBy('products.id', 'products.name')
            ->selectRaw('
                products.name,
                SUM(order_items.quantity) as sales
            ')
            ->orderByDesc('sales')
            ->orderBy('products.name')
            ->limit(9)
            ->get();

        return response()->json($bestSellers);
    }
    public function stats()
    {
        $farmerId = Auth::user()->farmer->id;

        return response()->json([
            'total_products' => Product::where('farmer_id', $farmerId)->count(),

            'low_stock' => Product::where('farmer_id', $farmerId)
                ->where('quantity', '<=', 10)
                ->where('quantity', '>', 0)
                ->count(),

            'out_of_stock' => Product::where('farmer_id', $farmerId)
                ->where('quantity', 0)
                ->count(),

            'shipping_orders' => Order::where('farmer_id', $farmerId)
                ->where('status', 'shipping')
                ->count(),
        ]);
    }
    public function financialPerformance()
    {
        $farmerId = Auth::user()->farmer->id;

        $sales = Order::query()
            ->selectRaw("
                TO_CHAR(created_at,'Mon') as month,
                SUM(total_price) as sales,
                EXTRACT(MONTH FROM created_at) as month_number
            ")
            ->where('farmer_id', $farmerId)
            ->where('status', 'completed')
            ->groupByRaw("month, month_number")
            ->orderBy('month_number')
            ->get()
            ->map(fn($item)=>[
                'month'=>$item->month,
                'sales'=>(float)$item->sales
            ]);

        return response()->json($sales);
    }
    public function orderStatus()
    {
        $farmerId = Auth::user()->farmer->id;

        $statuses = [
            'shipping' => '#8FE3D4',
            'completed' => '#98E8A3',
            'pending' => '#F8DA8D',
            'canceled' => '#8C1C1C',
        ];

        $result = [];

        foreach ($statuses as $status => $color) {

            $result[] = [

                'name' => ucfirst($status),

                'value' => Order::where('farmer_id', $farmerId)
                    ->where('status', $status)
                    ->count(),

                'color' => $color,
            ];
        }

        return response()->json($result);
    }
}

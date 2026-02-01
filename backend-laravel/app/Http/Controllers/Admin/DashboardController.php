<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TrendingProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {
        $startWeek = Carbon::now()->startOfWeek(); // Thứ 2
        $endWeek   = Carbon::now()->endOfWeek();   // Chủ nhật
        $startMonth = Carbon::now()->startOfMonth(); 
        $endMonth   = Carbon::now()->endOfMonth();   

        $weekSale = Order::where('order_status', 'Accepted')
            ->whereBetween('created_at', [$startWeek, $endWeek])
            ->count();

        $monthRevenue = Order::where('order_status', 'Accepted')
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->sum('subtotal_price');

        // Lấy dữ liệu theo ngày
        $orders = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_price) as revenue'),
                DB::raw('COUNT(DISTINCT user_id) as customers')
            )
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->where('order_status', 'Accepted')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Chuẩn hoá data cho chart
        $categories = [];
        $sales = [];
        $revenues = [];
        $customers = [];

        foreach ($orders as $order) {
            $categories[] = Carbon::parse($order->date)->toIso8601String();
            $sales[] = $order->total_orders;
            $revenues[] = (int)$order->revenue;
            $customers[] = $order->customers;
        }

        $topSelling = TrendingProduct::join('products', 'trending_products.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.image',
                'products.price',                
                'trending_products.score',                
            )
            ->limit(6)
            ->get();
        // dd($topSelling);
        return view('admin.pages.dashboard.index', compact(
            'weekSale',
            'monthRevenue',
            'categories',
            'sales',
            'revenues',
            'customers',
            'topSelling',
        ));
    }
}

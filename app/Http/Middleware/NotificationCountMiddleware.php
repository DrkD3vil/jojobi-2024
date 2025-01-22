<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use Carbon\Carbon;
class NotificationCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        // Get current date and date 7 days from now
        $currentDate = Carbon::now();
        $sevenDaysFromNow = Carbon::now()->addDays(7);

        $productsExpiringSoon = Product::whereBetween('expire_date', [$currentDate, $sevenDaysFromNow])
                                   ->whereDate('expire_date', '>', $currentDate)
                                   ->where('stock_quantity', '>', 0) // Skip out-of-stock products
                                   ->get(); // Products expiring in the next 7 days
        $todayExpiringProducts = Product::whereDate('expire_date', '=', $currentDate)
                                ->where('stock_quantity', '>', 0) // Skip out-of-stock products
                                ->get(); // Expiring today

        // Count of products expiring today
        $expiringTodayCount = Product::whereDate('expire_date', '=', $currentDate)
            ->where('stock_quantity', '>', 0)
            ->count();

        // Count of products expiring in the next 7 days
        $expiringSoonCount = Product::whereBetween('expire_date', [$currentDate, $sevenDaysFromNow])
            ->whereDate('expire_date', '>', $currentDate)
            ->where('stock_quantity', '>', 0)
            ->count();

        // Total notification count
        $notificationCount = $expiringTodayCount + $expiringSoonCount;

        // Share the notification count with all views
        view()->share([
            'notificationCount' => $notificationCount,
            'productsExpiringSoon' => $productsExpiringSoon,
            'todayExpiringProducts' => $todayExpiringProducts,
            
        ]);

        return $next($request);
    }
}


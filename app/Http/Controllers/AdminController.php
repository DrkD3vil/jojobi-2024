<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ProductSale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('adminBackend.adminLayout', compact('user'));
    }

    public function admindashboard()
    {
        $user = Auth::user();
        $today = Carbon::today();
        // Get current and previous month data
        $currentMonth = Carbon::now()->month;
        $previousMonth = Carbon::now()->subMonth()->month;
        // Last week
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
        // Get total sales from product_sale table for the last week
        $lastWeekSales = ProductSale::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->sum('total_sell_price'); // assuming 'total_amount' field for sales

        // Get total expenses from expense table for the last week
        $lastWeekExpenses = Expense::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->sum('amount'); // assuming 'amount' field for expenses
        // Calculate profit
        $lastWeekProfit = $lastWeekSales - $lastWeekExpenses;

        // Calculate percentage change in profit compared to the previous week
        $previousWeekStart = Carbon::now()->subWeeks(2)->startOfWeek();
        $previousWeekEnd = Carbon::now()->subWeeks(2)->endOfWeek();

        $previousWeekSales = ProductSale::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
            ->sum('total_sell_price');
        $previousWeekExpenses = Expense::whereBetween('created_at', [$previousWeekStart, $previousWeekEnd])
            ->sum('amount');

        $previousWeekProfit = $previousWeekSales - $previousWeekExpenses;

        $weekPercentageChange = $previousWeekProfit > 0 ? (($lastWeekProfit - $previousWeekProfit) / $previousWeekProfit) * 100 : 0;

        // End of Last Week Calculation
        $currentYear = Carbon::now()->year;

        // Calculate today's profit
        $todayProfit = ProductSale::whereDate('sale_date', $today)->sum('profit');

        // Calculate today's expense
        $todayExpense = Expense::whereDate('date', $today)->sum('amount');

        // Calculate today's net profit
        $netProfit = $todayProfit - $todayExpense;

        // Calculate percentage change
        $yesterdayProfit = ProductSale::whereDate('sale_date', $today->copy()->subDay())->sum('profit');
        $percentageChange = $this->calculatePercentageChange($todayProfit, $yesterdayProfit);

        // Calculate Net Profit change
        $yesterdayExpense = Expense::whereDate('date', $today->copy()->subDay())->sum('amount');
        $yesterdayNetProfit = $yesterdayProfit - $yesterdayExpense;
        $percentageNetProfitChange = $this->calculatePercentageChange($netProfit, $yesterdayNetProfit);

        // Calculate monthly data
        $currentMonthRevenue = $this->calculateRevenue($currentMonth);
        $currentMonthProfit = $this->calculateProfit($currentMonth);
        $currentMonthExpenses = $this->calculateExpenses($currentMonth);
        $netProfitForCurrentMonth = $this->calculateNetProfit($currentMonth);
        $currentMonthSalesCount = ProductSale::whereMonth('sale_date', $currentMonth)->count();
        $totalCustomersThisMonth = Customer::whereMonth('created_at', $currentMonth)->count();
        $totalProductSalesThisMonth = ProductSale::whereMonth('sale_date', $currentMonth)->sum('quantity');


        $previousMonthRevenue = $this->calculateRevenue($previousMonth);
        $percentageProfitGrowth = $this->calculatePercentageChange(
            $this->calculateProfit($currentMonth),
            $this->calculateProfit($previousMonth)
        );

        // Fetch sales category data by joining ProductSale and CartItem tables
        $salesCategoryData = ProductSale::join('cart_items', 'product_sales.cart_item_id', '=', 'cart_items.id')
            ->select('cart_items.category_name', DB::raw('SUM(product_sales.total_sell_price) as total_sales'))
            ->whereMonth('product_sales.sale_date', $currentMonth) // Filter by current month (optional)
            ->whereYear('product_sales.sale_date', $currentYear)  // Filter by current year (optional)
            ->groupBy('cart_items.category_name')
            ->get();

        // Convert the result to a format suitable for the frontend
        $salesCategoryData = $salesCategoryData->map(function ($item) {
            return [
                'categoryName' => $item->category_name,
                'categoryAmount' => $item->total_sales,
            ];
        });

        // Get the last 6 months
        $lastSixMonths = collect();
        for ($i = 5; $i >= 0; $i--) {
            $lastSixMonths->push(Carbon::now()->subMonths($i)->format('F Y'));
        }

        // Initialize arrays to hold sales data and months
        $months = [];
        $salesData = [];
        $months = $lastSixMonths;

        // Calculate sales data for each of the last 6 months
        foreach ($lastSixMonths as $month) {
            $totalSales = ProductSale::whereMonth('sale_date', Carbon::parse($month)->month)
                ->whereYear('sale_date', Carbon::parse($month)->year)
                ->sum('total_sell_price');
            $totalProfit = ProductSale::whereMonth('sale_date', Carbon::parse($month)->month)
                ->whereYear('sale_date', Carbon::parse($month)->year)
                ->sum('profit');
            $totalExpense = Expense::whereMonth('date', Carbon::parse($month)->month)
                ->whereYear('date', Carbon::parse($month)->year)
                ->sum('amount');
            // $categoriesData = ProductSale::select('categories.category_name')
            //     ->join('cart_items', 'product_sales.cart_item_id', '=', 'cart_items.id')
            //     ->join('categories', 'cart_items.category_name', '=', 'categories.category_name')
            //     ->whereMonth('product_sales.sale_date', Carbon::now()->month)  // Get sales for the current month
            //     ->groupBy('categories.category_name')  // Group by category_name to avoid duplicates
            //     ->get();


            $salesData[] = $totalSales;  // Ensure the salesData array is populated with numbers
            $earningData[] = $totalProfit;
            $expenseData[] = $totalExpense;
        }

        // Pass the data to the view
        $data = [
            'months' => $months,
            'salesData' => $salesData,
            'earningData' => $earningData,
            'expenseData' => $expenseData,
            'salesCategoryData' => $salesCategoryData,
        ];








        // Get the last 6 months for the chart
        $months = [];
        $salesData = [];
        $totalSalesAmount = 0;
        $salesCategoryData = [];

        // Get the last 6 months data
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('F Y'); // Month name and year

            $totalSales = ProductSale::whereMonth('sale_date', $date->month)
                ->whereYear('sale_date', $date->year)
                ->sum('total_sell_price');

            $salesData[] = $totalSales; // Add total sales data for this month
        }

        // Get the total sales for the current month
        $totalSalesAmount = ProductSale::whereMonth('sale_date', Carbon::now()->month)
            ->whereYear('sale_date', Carbon::now()->year)
            ->sum('total_sell_price');

        // Get category-wise sales data
        $salesCategoryData = ProductSale::join('cart_items', 'product_sales.cart_item_id', '=', 'cart_items.id')
            ->select('cart_items.category_name', DB::raw('SUM(product_sales.total_sell_price) as total_sales'))
            ->groupBy('cart_items.category_name')
            ->get();











        // Return the view with the required data
        return view(
            'adminBackend.adminDashboard',
            [
                'months' => $months,
                'salesData' => $salesData,
                'totalSalesAmount' => $totalSalesAmount,
                'salesCategoryData' => $salesCategoryData,
            ],
            compact(
                'todayProfit',
                'todayExpense',
                'percentageChange',
                'netProfit',
                'percentageNetProfitChange',
                'today',
                'user',
                'currentMonthRevenue',
                'currentMonthProfit',
                'currentMonthExpenses',
                'netProfitForCurrentMonth',
                'previousMonthRevenue',
                'percentageProfitGrowth',
                'currentMonthSalesCount',
                'totalCustomersThisMonth',
                'totalProductSalesThisMonth',
                'lastWeekProfit',
                'weekPercentageChange',
                'startOfLastWeek',
                'endOfLastWeek',
                'data',

            )
        );
    }

    // Sales OverView



    private function calculatePercentageChange($current, $previous)
    {
        if ($previous > 0) {
            return (($current - $previous) / $previous) * 100;
        }
        return 0;
    }

    /**
     * Calculate total revenue for a given month.
     */
    private function calculateRevenue($month)
    {
        return ProductSale::whereMonth('sale_date', $month)->sum('total_sell_price');
    }

    /**
     * Calculate total profit for a given month.
     */
    private function calculateProfit($month)
    {
        return ProductSale::whereMonth('sale_date', $month)->sum('profit');
    }

    /**
     * Calculate total expenses for a given month.
     */
    private function calculateExpenses($month)
    {
        return Expense::whereMonth('date', $month)->sum('amount');
    }

    /**
     * Calculate net profit (revenue - expenses) for a given month.
     */
    private function calculateNetProfit($month)
    {
        $profit = $this->calculateProfit($month);
        $expenses = $this->calculateExpenses($month);
        return $profit - $expenses;
    }

    public function getCategorySalesData()
{
    $categorySales = CartItem::select('categories.name as category_name', DB::raw('SUM(cart_items.quantity) as total_sales'))
        ->join('products', 'cart_items.product_id', '=', 'products.id') // Join cart_items with products
        ->join('categories', 'products.category_id', '=', 'categories.id') // Join products with categories
        ->groupBy('categories.name')
        ->orderByDesc('total_sales')
        ->get();

    if ($categorySales->isEmpty()) {
        return response()->json([
            'categories' => ['No Data Available'],
            'sales' => [0],
        ]);
    }

    return response()->json([
        'categories' => $categorySales->pluck('category_name'),
        'sales' => $categorySales->pluck('total_sales'),
    ]);
}


public function getSalesReport(Request $request)
{
    $user = Auth::user();

    // Validate date filters
    $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    // Build the query
    $query = Order::select(
        'cart_items.product_id',
        'products.name as product_name',
        DB::raw('SUM(cart_items.quantity) as total_quantity'),
        DB::raw('SUM(cart_items.quantity * cart_items.price) as total_sales'),
        DB::raw('SUM(cart_items.quantity * (cart_items.price - products.buy_price)) as total_profit'),
        DB::raw('COALESCE(SUM(transactions.customer_due), 0) as total_due'),
        DB::raw('COALESCE(SUM(transactions.customer_advance), 0) as total_advance'),
        DB::raw('COALESCE(SUM(transactions.total_amount), 0) as total_completed_payment') // Add this line
    )
    ->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
    ->join('cart_items', 'carts.cart_id', '=', 'cart_items.cart_id')
    ->join('products', 'cart_items.product_id', '=', 'products.id')
    ->leftJoin('transactions', 'orders.order_id', '=', 'transactions.order_id')
    ->groupBy('cart_items.product_id', 'products.name');

    // Apply date filters
    if ($request->filled('start_date')) {
        $query->whereDate('orders.created_at', '>=', $request->start_date)
              ->whereDate('transactions.transaction_date', '>=', $request->start_date);
    }
    if ($request->filled('end_date')) {
        $query->whereDate('orders.created_at', '<=', $request->end_date)
              ->whereDate('transactions.transaction_date', '<=', $request->end_date);
    }
    // $salesData = $query->get()->toArray();
    // Fetch sales data with pagination
    $salesData = $query->paginate(10);
    // dd($salesData);

    // Return the view with sales data
    return view('adminBackend.dashboard.sales_report', compact('salesData', 'user'));
}
}

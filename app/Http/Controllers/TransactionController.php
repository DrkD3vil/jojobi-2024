<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('order')->paginate(10);

        return view('adminBackend.transactions.index', compact('transactions'));
    }

    public function create($orderId)
    {
        $user = Auth::user();
        $order = Order::findOrFail($orderId);

        return view('adminBackend.transactions.create', compact('order', 'user'));
    }

    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Validate Request
        $request->validate([
            'payment_method' => 'required|string',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        // Create Transaction
        Transaction::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount_paid' => $request->amount_paid,
            'status' => 'completed', // Example status
        ]);

        // Update Order Status
        $order->update(['status' => 'completed']);

        return redirect()->route('transactions.index')->with('success', 'Transaction completed successfully.');
    }
}


// Example of transaction processing logic (store in a database)

// user_id
// product barcode
// product image
// product name
// category name
// quantity
// price
// subtotal price
// tax
// shipping cost
// discount 
// total price

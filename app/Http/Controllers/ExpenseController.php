<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    // Display the list of expenses
    public function index()
    {
        $user = Auth::user();
        $expenses = Expense::orderBy('date', 'desc')->get();
        return view('adminBackend.expenses.index', compact('expenses', 'user'));
    }

    // Show the form to create a new expense
    public function create()
    {
        $types = Expense::distinct()->pluck('type');
    $categories = Expense::distinct()->pluck('category');
        $user = Auth::user();

        return view('adminBackend.expenses.create', compact('user', 'types', 'categories'));
    }

    // Store a new expense in the database
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:10240'
        ]);

         // Handle image upload for shop_logos image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
    
            // Define the public backend_images path for shop_logos
            $shop_logosDirectory = public_path('baackend_images/expenses');
    
            // Ensure the directory exists
            if (!File::exists($shop_logosDirectory)) {
                File::makeDirectory($shop_logosDirectory, 0755, true); // Create the directory with permissions
            }
    
            // Move the file to the public backend_images folder
            $file->move($shop_logosDirectory, $filename);
    
            // Store the relative path in the database
            $imagePath = 'baackend_images/expenses/' . $filename;
        }
     

        Expense::create([
            'uuid' => Str::uuid(),
            'type' => $request->type,
            'amount' => $request->amount,
            'note' => $request->note,
            'date' => $request->date,
            'category' => $request->category,
            'user_id' => Auth::user()->id,
            'image' => $imagePath,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    public function suggest(Request $request)
{
    $query = $request->get('query');
    $typeOrCategory = $request->get('type_or_category'); // To differentiate between type and category
    
    if ($typeOrCategory == 'type') {
        // Suggest types
        $suggestions = Expense::where('type', 'like', "%{$query}%")
            ->distinct()
            ->pluck('type');
    } elseif ($typeOrCategory == 'category') {
        // Suggest categories
        $suggestions = Expense::where('category', 'like', "%{$query}%")
            ->distinct()
            ->pluck('category');
    } else {
        $suggestions = [];
    }

    return response()->json(['data' => $suggestions]);
}
}

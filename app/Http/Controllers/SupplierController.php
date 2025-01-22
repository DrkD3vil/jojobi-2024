<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $suppliers = Supplier::paginate(10);
        return view('adminBackend.suppliers.index', compact('suppliers', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('adminBackend.suppliers.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_barcode' => 'required|unique:suppliers',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'amount' => 'nullable|numeric|min:0',
            'paid' => 'nullable|numeric|min:0',
            'due' => 'nullable|numeric|min:0',
            'note' => 'nullable|string|max:1000',
        ]);
    
        $supplier = new Supplier($validated);
        $supplier->uuid = Str::uuid();
        $supplier->supplier_id = strtoupper(Str::random(10)); // Generate a unique supplier ID
        $supplier->status = $request->input('status', 'active');
        $supplier->created_by = Auth::user()->id;
        $supplier->save();
    
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $supplier = Supplier::where('uuid', $uuid)->firstOrFail();
        return view('adminBackend.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $supplier = Supplier::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'supplier_barcode' => 'required|unique:suppliers,supplier_barcode,' . $supplier->id,
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'amount' => 'nullable|numeric|min:0',
            'paid' => 'nullable|numeric|min:0',
            'due' => 'nullable|numeric|min:0',
        ]);

        $supplier->update($validated);
        $supplier->status = $request->input('status', 'active');
        $supplier->updated_by = Auth::user();
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $supplier = Supplier::where('uuid', $uuid)->firstOrFail();
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $supplier = Supplier::where('uuid', $uuid)->firstOrFail();
        return view('adminBackend.suppliers.show', compact('supplier'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\baackend_images;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view_category()
    {
        $user = Auth::user();
        $data = Category::paginate(10);
        return view('adminBackend.categories.category', compact('data', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Add Category
    // Add Category
    public function add_category(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_barcode' => 'required|string|max:255|unique:categories,category_barcode',
            'category_description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Image validation
        ]);
    
        try {
            // Create and save the category
            $category = new Category;
            $category->category_name = $request->category_name;
            $category->category_barcode = $request->category_barcode;
            $category->category_description = $request->category_description;
    
            // Handle image upload for category image
            if ($request->hasFile('category_image')) {
                $file = $request->file('category_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
    
                // Define the public baackend_images path for categories
                $categoryDirectory = public_path('baackend_images/categories');
    
                // Ensure the directory exists
                if (!File::exists($categoryDirectory)) {
                    File::makeDirectory($categoryDirectory, 0755, true); // Create the directory with permissions
                }
    
                // Move the file to the public baackend_images folder
                $file->move($categoryDirectory, $filename);
    
                // Store the relative path in the database
                $category->category_image = 'categories/' . $filename;
            }
    
            // Generate a scannable barcode image
            $generator = new BarcodeGeneratorPNG();
            $barcodeData = $category->category_barcode;
    
            // Generate barcode (Code 128 for scannable barcodes)
            $barcodeImage = $generator->getBarcode($barcodeData, BarcodeGeneratorPNG::TYPE_CODE_128);
    
            // Define the directory path for barcodes
            $barcodeDirectory = public_path('baackend_images/barcodes');
    
            // Ensure the directory exists
            if (!File::exists($barcodeDirectory)) {
                File::makeDirectory($barcodeDirectory, 0755, true); // Create the directory with permissions
            }
    
            // Save the barcode image to the baackend_images
            $barcodeFilename = time() . '_' . $category->category_barcode . '.png';
            $barcodePath = $barcodeDirectory . '/' . $barcodeFilename;
            file_put_contents($barcodePath, $barcodeImage); // Directly write the barcode image
    
            // Store the relative barcode path in the database
            $category->category_barcode_image = 'barcodes/' . $barcodeFilename;
    
            // Generate UUID and Unique Category ID
            $category->uuid = (string) Str::uuid();
            $category->categoryid = Category::generateUniqueIdentifier();
            $category->save();
    
            // Redirect with success message
            return redirect()->route('admin.category')->with('success', 'Category added successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error adding category: ' . $e->getMessage());
    
            // Redirect with error message
            return redirect()->back()->with('error', 'An error occurred while adding the category.');
        }
    }
    

    // Delete category
     
     public function delete_category($uuid)
    {
        // Find the category by UUID
        $data = Category::where('uuid', $uuid)->firstOrFail();

        // Delete the category
        $data->delete();

        // Redirect with success message
        return redirect('/view_category')->with('success', 'Category deleted successfully');
    }


    // Edit Category
    public function edit_category($uuid)
    {
        $user = Auth::user();
        $data = Category::where('uuid', $uuid)->firstOrFail();
        return view('adminBackend.categories.edit_category', compact('data', 'user'));
    }

  // Method to view a single category's details
  public function singleView_category($uuid)
  {
      // Fetch authenticated user
      $user = Auth::user();

      // Fetch the category by UUID
      $data = Category::where('uuid', $uuid)->firstOrFail();

      // Return view with category data and user
      return view('adminBackend.categories.single_content', compact('data', 'user'));
  }

    
    // Update Category

    public function update_category(Request $request, $uuid)
    {
        $data = Category::where('uuid', $uuid)->firstOrFail();
    
        // Validate the request
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_barcode' => 'required|string|max:255',
            'category_description' => 'nullable|string',
            'category_image' => 'nullable|image|max:10240', // Removed the mimes condition
        ]);
    
        // Check if the barcode is being updated
        $isBarcodeChanged = $data->category_barcode !== $validated['category_barcode'];
    
        // Update other fields
        $data->category_name = $validated['category_name'];
        $data->category_barcode = $validated['category_barcode'];
        $data->category_description = $validated['category_description'];
    
        // Handle image upload
        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
    
            // Check if the file is valid
            if (!$file->isValid()) {
                return back()->withErrors(['category_image' => 'The uploaded file is invalid.']);
            }
    
            // Delete old image if it exists
            if (!empty($data->category_image)) {
                $oldImagePath = public_path('baackend_images/' . $data->category_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Save new image
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('baackend_images/categories'), $filename);
    
            // Update image path
            $data->category_image = 'categories/' . $filename;
        }
    
        // Handle barcode update
        if ($isBarcodeChanged) {
            // Delete old barcode image if it exists
            if (!empty($data->category_barcode_image)) {
                $oldBarcodePath = public_path('baackend_images/' . $data->category_barcode_image);
                if (file_exists($oldBarcodePath)) {
                    unlink($oldBarcodePath);
                }
            }
    
            // Generate new barcode image
            $generator = new BarcodeGeneratorPNG();
            $barcodeImage = $generator->getBarcode($validated['category_barcode'], BarcodeGeneratorPNG::TYPE_CODE_128);
    
            // Define the directory path for barcodes
            $barcodeDirectory = public_path('baackend_images/barcodes');
    
            // Ensure the directory exists
            if (!File::exists($barcodeDirectory)) {
                File::makeDirectory($barcodeDirectory, 0755, true); // Create the directory with permissions
            }
    
            // Save the new barcode image
            $barcodeFilename = time() . '_' . $validated['category_barcode'] . '.png';
            $barcodePath = $barcodeDirectory . '/' . $barcodeFilename;
            file_put_contents($barcodePath, $barcodeImage);
    
            // Update the barcode image path
            $data->category_barcode_image = 'barcodes/' . $barcodeFilename;
        }
    
        // Save updated category
        $data->save();
    
        return redirect('/view_category')->with('success', 'Category updated successfully');
    }
    

    // Search Categories
    public function search_category(Request $request)
    {
        $user = Auth::user();
        $searchTerm = $request->input('search_term');
        $dateInput = $request->input('search_date');
        $query = Category::query();

        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('categoryid', 'like', '%' . $searchTerm . '%')
                    ->orWhere('category_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('category_barcode', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($dateInput) {
            try {
                // Parse the date using the format 'Y-m-d'
                $parsedDate = Carbon::createFromFormat('Y-m-d', $dateInput)->format('Y-m-d');
                $query->whereDate('created_at', $parsedDate);
            } catch (\Exception $e) {
                // Handle invalid date format
                return redirect()->back()->with('error', 'Invalid date format.');
            }
        }

        try {
            $data = $query->paginate(10);
        } catch (\Exception $e) {
            Log::error('Search query failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while performing the search. Please try again.');
        }

        return view('adminBackend.categories.category', compact('data', 'user'));
    }
    // PREVIEW CATEGORY
    public function previewCategoriesPDF()
    {
        $categories = Category::all();
        
        // Pass the categories to the PDF view with absolute image paths
        $categories->map(function ($category) {
            $category->barcode_image_path = public_path('baackend_images/' . $category->category_barcode_image);
            $category->image_path = public_path('baackend_images/' . $category->category_image);
            return $category;
        });
    
        // Load the view and pass the updated categories
        $pdf = PDF::loadView('adminBackend.categories.categories-pdf', compact('categories'));
    
        // Render the PDF in the browser
        return $pdf->stream('categories-preview.pdf');
    }
    
    
    

    // Export Categories
    public function downloadCategoriesPDF()
    {
        $categories = Category::all();
        
        // Pass the categories to the PDF view with absolute image paths
        $categories->map(function ($category) {
            $category->barcode_image_path = public_path('baackend_images/' . $category->category_barcode_image);
            $category->image_path = public_path('baackend_images/' . $category->category_image);
            return $category;
        });
    
        // Load the view and pass the updated categories
        $pdf = PDF::loadView('adminBackend.categories.categories-pdf', compact('categories'));
    
        // Download the PDF file with a specified name
        return $pdf->download('categories-list.pdf');
    }
    
}

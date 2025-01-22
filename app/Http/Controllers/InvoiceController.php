<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\ShopLogo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class InvoiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Fetch the first shop logo from the database
        $logo = ShopLogo::first();  // You can adjust this query as per your needs

        // Fetch all invoices, ordered by the latest one first
        $invoices = Invoice::latest()->paginate(10); // You can adjust the pagination to fit your needs
        
        return view('adminBackend.invoices.index', compact('invoices', 'user', 'logo'));
    }

    // Show invoice details along with QR code
    public function show($id)
    {
        try {
            $logo = ShopLogo::first(); 
            // Get the authenticated user
            $user = Auth::user();
            $userName = $user->name;

            // Find the invoice--
            $invoice = Invoice::findOrFail($id);
            $order = $invoice->order;
            $customerName = $order->customer->name;
            $customerPhone = $order->customer->phone;

            // Check that APP_URL is set in your .env file
            $url = url(route('invoice.pdf', $invoice->invoice_id));
            // $url = env('APP_URL') . route('invoice.pdf', $invoice->invoice_id);

            // Create a new QR code instance
            $qrCode = new QrCode($url);
            $writer = new PngWriter();

            // Generate the QR code as PNG and encode it in base64
            $result = $writer->write($qrCode);
            $qrCodeBase64 = base64_encode($result->getString());

            // Pass the QR code to the view as a base64 string
            return view('adminBackend.invoices.show', compact(
                'invoice',
                'order',
                'customerName',
                'customerPhone',
                'userName',
                'user',
                'qrCodeBase64',
                'logo'
            ));
        } catch (ModelNotFoundException $e) {
            // Handle case where the invoice is not found
            return redirect()->back()->with('error', 'Invoice not found.');
        } catch (\Exception $e) {
            // Catch other potential errors
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function generatePdf($invoice_id)
    {
        $logo = ShopLogo::first(); 
        $user = Auth::user();
        $userName = $user->name;

        // Fetch the invoice using the unique invoice_id (UUID)
        $invoice = Invoice::where('invoice_id', $invoice_id)->firstOrFail();
        $order = $invoice->order;
        $invoiceItems = $invoice->items;
        $customerName = $order->customer->name;
        $customerPhone = $order->customer->phone;

        // Generate the PDF using the Blade template
        $pdf = PDF::loadView('adminBackend.invoices.generate-pdf', compact(
            'invoice',
            'order',
            'invoiceItems',
            'userName',
            'customerName',
            'customerPhone',
            'logo'
        ));

        // Preview the PDF in the browser
        return $pdf->stream("invoice_{$invoice_id}.pdf");
    }


    public function invoiceprint($id)
    {
        try {
            $logo = ShopLogo::first(); 
            // Get the authenticated user
            $user = Auth::user();
            $userName = $user->name;
    
            // Find the invoice and load associated order (without loading 'items' relationship)
            $invoice = Invoice::findOrFail($id);
            $order = $invoice->order; // This loads the associated order
    
            if (!$order) {
                return redirect()->back()->with('error', 'Order not found.');
            }
    
            // Load the cart items related to the order
            $cartItems = $order->cartitems; // This fetches the related CartItem data
    
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'No items found for this order.');
            }
    
            // Customer details
            $customerName = $order->customer->name;
            $customerPhone = $order->customer->phone;

            // Check that APP_URL is set in your .env file
            $url = url(route('invoice.pdf', $invoice->invoice_id));
            // $url = env('APP_URL') . route('invoice.pdf', $invoice->invoice_id);

            // Create a new QR code instance
            $qrCode = new QrCode($url);
            $writer = new PngWriter();

            // Generate the QR code as PNG and encode it in base64
            $result = $writer->write($qrCode);
            $qrCodeBase64 = base64_encode($result->getString());

    
            // Return the view with data, including the cart items
            return view('adminBackend.invoices.invoice_print', compact(
                'invoice',
                'order',
                'customerName',
                'customerPhone',
                'userName',
                'cartItems',  // Pass the cart items to the view
                'logo',
                'qrCodeBase64'
            ));
        } catch (ModelNotFoundException $e) {
            // If invoice not found
            return redirect()->back()->with('error', 'Invoice not found.');
        } catch (\Exception $e) {
            // Other errors
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

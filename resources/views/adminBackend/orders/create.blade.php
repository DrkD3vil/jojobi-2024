@extends('adminBackend.adminLayout')


@section('content')
    <h1>Create Order</h1>

    <form action="{{ route('orders.store') }}" method="POST" style="max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px;">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="customer_id" style="display: block; margin-bottom: 5px;">Customer:</label>
            <select name="customer_id" id="customer_id" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="cart_id" style="display: block; margin-bottom: 5px;">Cart ID:</label>
            <input type="text" name="cart_id" id="cart_id" value="{{ $cart->cart_id }}" readonly style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background-color: #e9ecef;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="subtotal_price" style="display: block; margin-bottom: 5px;">Subtotal Price:</label>
            <input type="number" name="subtotal_price" id="subtotal_price" value="{{ $cart->subtotal_price }}" readonly style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background-color: #e9ecef;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="tax" style="display: block; margin-bottom: 5px;">Tax (%):</label>
            <input type="number" name="tax" id="tax" step="0.01" placeholder="Enter Tax Percentage" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="shipping_cost" style="display: block; margin-bottom: 5px;">Shipping Cost:</label>
            <input type="number" name="shipping_cost" id="shipping_cost" step="0.01" placeholder="Enter Shipping Cost" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="discount" style="display: block; margin-bottom: 5px;">Discount:</label>
            <input type="number" name="discount" id="discount" step="0.01" placeholder="Enter Discount Amount or Percentage" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <small style="color: gray;">Enter as a fixed amount or percentage (e.g., 10 for 10%).</small>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="total_price" style="display: block; margin-bottom: 5px;">Total Price:</label>
            <input type="number" name="total_price" id="total_price" value="{{ $cart->subtotal_price }}" readonly style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background-color: #e9ecef;">
        </div>

        <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
            Create Order
        </button>
        
    </form>
    {{-- <a href="{{ route('pos.add_more', $cart -> cart_id) }}" class="btn btn-primary">Add More</a> --}}


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const subtotalInput = document.getElementById('subtotal_price');
            const taxInput = document.getElementById('tax');
            const shippingInput = document.getElementById('shipping_cost');
            const discountInput = document.getElementById('discount');
            const totalPriceInput = document.getElementById('total_price');

            function calculateTotal() {
                const subtotal = parseFloat(subtotalInput.value) || 0;
                const tax = parseFloat(taxInput.value) || 0;
                const shippingCost = parseFloat(shippingInput.value) || 0;
                const discount = parseFloat(discountInput.value) || 0;

                // Calculate tax amount
                const taxAmount = (subtotal * tax) / 100;

                // Calculate total before discount
                let total = subtotal + taxAmount + shippingCost;

                // Apply discount
                if (discountInput.value.includes('%')) {
                    const discountPercentage = parseFloat(discountInput.value.replace('%', '')) || 0;
                    total -= (total * discountPercentage) / 100;
                } else {
                    total -= discount;
                }

                totalPriceInput.value = total.toFixed(2);
            }

            // Attach event listeners
            taxInput.addEventListener('input', calculateTotal);
            shippingInput.addEventListener('input', calculateTotal);
            discountInput.addEventListener('input', calculateTotal);
        });
    </script>
@endsection

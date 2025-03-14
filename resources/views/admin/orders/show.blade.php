<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <p class="text-bold">Order Details</p>
            </div>
            <div class="card-body">
                <hr />
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Order Number</td>
                            <td>{{ $order->order_number }}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @php
                                    $badgeClass = '';
                                    switch($order->status) {
                                        case 'pending':
                                            $badgeClass = 'badge-warning';
                                            break;
                                        case 'shipped':
                                            $badgeClass = 'badge-info';
                                            break;
                                        case 'delivered':
                                            $badgeClass = 'badge-success';
                                            break;
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-hover">
                    <thead class="table-primary">
                    <tr>
                        <th>S.No</th>
                        <th>Product</th>
                        <th>Price (₹)</th>
                        <th>Quantity</th>
                        <th>Total Amount (₹)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($orderedProducts) > 0)
                        @php $grandTotal = 0; @endphp
                        @foreach($orderedProducts as $index => $product)
                            @php
                                $quantity = $product->quantity;
                                $totalAmount = $product->price * $quantity;
                                $grandTotal += $totalAmount;
                            @endphp
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">{{ $product->product->name }}</td>
                                <td class="align-middle">{{ number_format($product->price, 2) }}</td>
                                <td class="align-middle">{{ $quantity }}</td>
                                <td class="align-middle">{{ number_format($totalAmount, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="table-secondary">
                            <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                            <td class="text-bold">₹{{ number_format($grandTotal, 2) }}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="text-center" colspan="5">No orders found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>


                <div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

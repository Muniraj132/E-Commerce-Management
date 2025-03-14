<x-sub-page-layout>
    <section style="min-height: 66vh" class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <!-- col end -->
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Your Orders</h5>
                            @if($orders->isEmpty())
                                <p class="text-center">You have no orders.</p>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Quantity</th>
                                            <th>Total(₹)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $grandTotal = 0;
                                        @endphp
                                        @foreach($orders as $key => $order)
                                            @php
                                                $grandTotal += $order->total_amount;
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $order->order_number ?? '' }}</td>
                                                <td class="align-middle">{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y h:i A') }}</td>
                                                <td>{{ $order->quantity }}</td>
                                               <td>{{  $order->total_amount}}</td>
                                              <td class="align-middle">
                                                    @php
                                                        $badgeClass = '';
                                                        switch($order->status) {
                                                            case 'pending':
                                                                $badgeClass = 'text-primary';
                                                                break;
                                                            case 'shipped':
                                                                $badgeClass = 'text-secondary';
                                                                break;
                                                            case 'delivered':
                                                                $badgeClass = 'text-success';
                                                                break;
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                                            <td><strong>{{ number_format($grandTotal, 2) }}</strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-sub-page-layout>

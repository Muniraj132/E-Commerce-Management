<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Orders') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <p class="text-bold" style="margin-bottom: 0">List Orders</p>

            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert" id="exportsuccess">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>S.No</th>
                            <th>Order Number</th>
                            <th>Username</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($orders->count() > 0)
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td class="align-middle">{{ $key+1 }}</td>
                                    <td class="align-middle">{{ $order->order_number }}</td>
                                    <td class="align-middle">{{ $order->user->name }}</td>
                                    <td class="align-middle">{{ $order->quantity }}</td>
                                    <td class="align-middle">
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
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y h:i A') }}</td>
                                    <td class="align-middle">{{ $order->total_amount }}</td>
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <td class="align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('admin.orders.show', $order->id) }}" type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                                &nbsp;&nbsp;<a href="{{ route('admin.orders.edit', $order->id)}}" type="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                &nbsp;<form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger m-0"><i class="fas fa-trash"></i></button>
                                                </form>

                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="7">Order not found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @if($orders->count() > 0)
                    <div class="d-flex justify-content-end">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Validate js Files -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

<script>
    // Add validation rules and messages
    $("#exportsuccess").removeAttr('style').delay(2000).fadeOut();
</script>

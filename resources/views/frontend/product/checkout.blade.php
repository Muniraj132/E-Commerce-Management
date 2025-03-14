<x-sub-page-layout>
<div class="container">
<div class="row mt-5">
  <div class="col-lg-6">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Checkout Details</h5>
              <form action="{{ route('checkout.store') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                      <label for="name" class="form-label">Name*</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">Email*</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="phone" class="form-label">Phone*</label>
                      <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone ?? '' }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="address" class="form-label">Address*</label>
                      <textarea class="form-control" id="address" name="address" required>{{ $customer->address ?? '' }}</textarea>
                  </div>
                  <div class="mb-3">
                      <label for="city" class="form-label">City*</label>
                      <input type="text" class="form-control" id="city" name="city" value="{{ $customer->city ?? '' }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="state" class="form-label">State*</label>
                      <input type="text" class="form-control" id="state" name="state" value="{{ $customer->state ?? '' }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="zip" class="form-label">Zip*</label>
                      <input type="text" class="form-control" id="zip" name="zip" value="{{ $customer->zip ?? '' }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="country" class="form-label">Country*</label>
                      <input type="text" class="form-control" id="country" name="country" value="{{ $customer->country ?? '' }}" required>
                  </div>
              <div class="mt-3">
                  <button type="submit" class="text-right btn btn-primary">Place Order</button>
                  <a href="{{ route('cart.view') }}" class="text-left btn btn-secondary">Back to Cart</a>
              </div>
              </form>
          </div>
      </div>
  </div>
  <div class="col-lg-6">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Your Cart</h5>
              @if($cartItems->isEmpty())
                  <p class="text-center">Your cart is empty.</p>
              @else
                  <table class="table table-hover">
                      <thead>
                          <tr>
                              <th>Product</th>
                              <th>Price(₹)</th>
                              <th>Quantity</th>
                              <th>Total(₹)</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $grandTotal = 0;
                          @endphp
                          @foreach($cartItems as $item)
                              @php
                                  $total = $item->price * $item->quantity;
                                  $grandTotal += $total;
                              @endphp
                              <tr>
                                  <td>{{ $item->product->name }}</td>
                                  <td>{{ number_format($item->price, 2) }}</td>
                                  <td>{{ $item->quantity }}</td>
                                  <td>{{ number_format($total, 2) }}</td>
                              </tr>
                          @endforeach
                          <tr>
                              <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                              <td><strong>{{ number_format($grandTotal, 2) }}</strong></td>
                          </tr>
                      </tbody>
                  </table>
              @endif
          </div>
      </div>
  </div>
</div>
</div>
</x-sub-page-layout>

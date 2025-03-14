<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Product') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <p class="text-bold">List Product</p>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                    </a>
                @endif
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert" id="exportsuccess">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert" id="exportsuccess">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Price (₹)</th>
                            <th>Image</th>
                            <th>Status</th>
                            @if(Auth::check() && Auth::user()->role === 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($products->count() > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td class="align-middle">{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                    <td class="align-middle">{{ $product->name }}</td>
                                    <td class="align-middle">{{ $product->price }}</td>
                                    <td class="align-middle">
                                        <img src="{{ asset($product->image) }}" alt="Product Image" width="50">
                                    </td>
                                    <td class="align-middle">
                                        @if($product->status === 'active')
                                            <span class="badge badge-primary">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.products.show', $product->id) }}" type="button" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                            &nbsp;&nbsp;<a href="{{ route('admin.products.edit', $product->id)}}" type="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            &nbsp;<form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Are you sure?')">
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
                                <td class="text-center" colspan="7">Product not found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @if($products->count() > 0)
                    <div class="d-flex justify-content-end">
                        {{ $products->links() }}
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
    // $(document).ready(function () {
        // Add validation rules and messages
        $("#exportsuccess").removeAttr('style').delay(2000).fadeOut();

    // });
</script>

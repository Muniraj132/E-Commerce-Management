<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <p class="text-bold">Product Details</p>
            </div>
            <div class="card-body">
                <hr />
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Category</td>
                            <td>{{ $product->category->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $product->status }}</td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{{ asset($product->image) }}" alt="Product Image" width="100">
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Back</a>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>

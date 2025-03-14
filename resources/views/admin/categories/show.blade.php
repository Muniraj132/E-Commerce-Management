<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Details') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <p class="text-bold">Category Details</p>
            </div>
            <div class="card-body">
                <hr />
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{{ asset($category->category_image) }}" alt="Category Image" width="100">
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $category->status }}</td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

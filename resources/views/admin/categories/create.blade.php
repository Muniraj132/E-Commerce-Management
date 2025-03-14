<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <p class="text-bold">Create Category</p>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" required class="form-control">
                        </div>
                         <div class="col-md-5">
                            <label for="category_image" class="form-label">Image</label>
                            <input type="file" name="category_image" required id="category_image" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

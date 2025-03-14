<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <p class="text-bold">Create Product</p>
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

                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" required class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" readonly name="slug" id="slug" required class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" required class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script>
          $(document).ready(function() {
            $("#name").keyup(function() {
                clearInput($(this).attr("id"));
            });
            $("#name").focusout(function() {
                clearInput($(this).attr("id"));
            });
        });
    </script>

</x-app-layout>

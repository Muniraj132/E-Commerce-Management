@extends('layouts.app')

@section('title', 'Edit User')

@section('contents')
<div class="container">
    <div id="viewMode">
        <!-- Display User Data in View Mode with Bootstrap styling -->
        <h2>User Details</h2>
        <div class="card">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role }}</p>
                <p><strong>Password:</strong> {{ $user->password }}</p>
            </div>
        </div>
        <button class="btn btn-primary mt-3" id="editButton">Edit</button>
    </div>

    <div id="editMode" style="display: none;">
        <!-- Edit User Data in Edit Mode -->
        <h2>Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-control">
                            <option value="admin" {{ ($user->role === 'admin') ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ ($user->role === 'user') ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $user->password }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" id="cancelEdit">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const viewMode = document.getElementById("viewMode");
        const editMode = document.getElementById("editMode");
        const editButton = document.getElementById("editButton");
        const cancelEditButton = document.getElementById("cancelEdit");

        // Toggle between view and edit modes
        editButton.addEventListener("click", function () {
            viewMode.style.display = "none";
            editMode.style.display = "block";
        });

        // Cancel editing and switch back to view mode
        cancelEditButton.addEventListener("click", function () {
            viewMode.style.display = "block";
            editMode.style.display = "none";
        });
    });
</script>
@endsection

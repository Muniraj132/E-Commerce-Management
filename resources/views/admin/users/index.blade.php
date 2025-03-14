<x-app-layout>
                            <x-slot name="header">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('List Users') }}
                                </h2>
                            </x-slot>

                            <div class="container">
                                <div class="card shadow-lg">
                                    <div class="card-header bg-primary text-white d-flex justify-content-between">
                                        <p class="text-bold" style="margin-bottom: 0">List Users</p>
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
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Email Verified At</th>
                                                    <th>Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($users->count() > 0)
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                                            <td class="align-middle">{{ $user->name }}</td>
                                                            <td class="align-middle">{{ $user->email }}</td>
                                                            <td class="align-middle">{{ $user->email_verified_at }}</td>
                                                            <td class="align-middle">{{ $user->role }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td class="text-center" colspan="5">No users found</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </x-app-layout>

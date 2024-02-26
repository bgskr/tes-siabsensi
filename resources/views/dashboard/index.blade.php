@extends('layouts.app')

@section('content')
    <div class="container pt-5 mx-auto">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center gap-3">
                <h1>User Management</h1>
                @if(auth()->user()->username)
                <div class="text-end">
                    <a href="{{ route('logout') }}" class="btn btn-danger m-2">Logout</a>
                </div>
                @endif
            </div>
            <div class="">
                @include('dashboard.create')
            </div>
        </div>
    </div>
    <div class="container d-flex my-5 mx-auto">
        <div class="card" style="width: 100%">
            <div class="card-body">
                <table class="table align-middle table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->str_roles->name != null ? $user->str_roles->name : ''}}</td>
                                <td class="text-center align-items-center">
                                    @include('dashboard.update', ['user' => $user])
                                    @include('dashboard.delete', ['user' => $user])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

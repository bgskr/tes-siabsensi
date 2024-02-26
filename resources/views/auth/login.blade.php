@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="width: 100vh;">
    <div class="row justify-content-center pt-5">
        <div class="col col-12">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email input -->
                        <div class="form-group">
                            <label for="form2Example1" class="form-label">Username</label>
                            <input type="text" id="form2Example1" name="username" class="form-control" autocomplete="off" />
                        </div>

                        <!-- Password input -->
                        <div class="form-group">
                            <label for="form2Example2" class="form-label">Password</label>
                            <input type="password" id="form2Example2" name="password" class="form-control" autocomplete="off" />
                        </div>

                        <!-- Submit button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('template.app')

@section('title', 'Login')

@section('breadcrumb')
    <li class="breadcrumb-item active font-size-14">Login</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            
            @if(session('error'))
                <div class="alert alert-danger font-size-14 rounded-0">{{ session('error') }}</div>
            @else
                <div class="alert alert-info font-size-14 font-weight-bold rounded-0">Silahkan masuk dengan akun anda</div>
            @endif

            <div class="card rounded-0">
                <div class="card-body">
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="font-size-14 form-label">Username</label>
                            <input type="text" class="form-control font-size-14 rounded-0" name="username" id="username" placeholder="Username" value="{{ old('username') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="font-size-14 form-label">Password</label>
                            <input type="password" class="form-control font-size-14 rounded-0" name="password" id="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-sm btn-danger rounded-0 font-size-14 font-weight-bold">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

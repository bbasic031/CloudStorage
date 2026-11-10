@extends('layouts.app')

@section('content')
<div class="mx-auto" style="max-width: 380px;">
    <h1 class="display-6 mb-3">Login</h1>
    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" name="username" value="{{ old('username') }}"
                   class="form-control @error('username') is-invalid @enderror" autofocus required>
            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Sign In</h2>

    @if(session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
                type="email"
                name="email"
                id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                required
                autofocus
            >
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                class="form-control @error('password') is-invalid @enderror"
                required
            >
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </form>
</div>
@endsection

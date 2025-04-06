@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('domain') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container py-4">
        <h1 class="mb-4">Welcome to Dashboard</h1>

        {{-- Domain Creation Form --}}
        <div class="card mb-4">
            <div class="card-header">Add New Domain</div>
            <div class="card-body">
                <form method="POST" action="{{ route('domains.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="domain" class="form-label">Domain Name</label>
                        <input type="text" class="form-control" id="domain" name="domain" placeholder="e.g. google.com"
                               value="{{ old('domain') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Domain</button>
                </form>
            </div>
        </div>

        {{-- Domains List --}}
        <div class="card">
            <div class="card-header">Your Domains</div>
            <div class="card-body">
                @if ($domains->isEmpty())
                    <p class="text-muted">You have no domains yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Domain</th>
                                <th>Added On</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($domains as $index => $domain)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $domain->domain }}</td>
                                    <td>{{ $domain->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

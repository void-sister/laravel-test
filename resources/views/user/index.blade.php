@extends('layouts.app')

@section('content')
<h1>Users</h1>

<div class="container my-5">
    @if ($errors->has('search'))
    <div class="alert alert-danger">
        <strong>Error:</strong> The search term must be at least 3 characters long.
    </div>
    @endif

    <form method="get" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control" name="search" placeholder="Search by Name or Email" value="{{ request()->get('search') }}">
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
            <tr>
                <th>
                    <a href="{{ route('users') }}?sort_by=id&sort_direction={{ request()->get('sort_direction') == 'asc' ? 'desc' : 'asc' }}">ID</a>
                </th>
                <th>
                    <a href="{{ route('users') }}?sort_by=name&sort_direction={{ request()->get('sort_direction') == 'asc' ? 'desc' : 'asc' }}">Name</a>
                </th>
                <th>
                    <a href="{{ route('users') }}?sort_by=email&sort_direction={{ request()->get('sort_direction') == 'asc' ? 'desc' : 'asc' }}">Email</a>
                </th>
                <th>Domains</th>
                <th class="text-center">
                    <a href="{{ route('users') }}?sort_by=plan_id&sort_direction={{ request()->get('sort_direction') == 'asc' ? 'desc' : 'asc' }}">Plan</a>
                </th>
                <th>
                    <a href="{{ route('users') }}?sort_by=created_at&sort_direction={{ request()->get('sort_direction') == 'asc' ? 'desc' : 'asc' }}">Registered At</a>
                </th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <ul class="mb-0 ps-3">
                        @foreach($user->domains as $domain)
                        <li>{{ $domain->domain }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-capitalize text-center">
                    {{ $user->plan->plan_name ?? '—' }}
                </td>
                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $user->is_admin ? 'Admin' : 'Regular User' }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

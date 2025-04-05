@extends('layouts.app')

@section('content')
<h1>Users</h1>

<div class="container my-5">
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Domains</th>
                <th>Plan</th>
                <th>Registered At</th>
            </tr>
            </thead>
            <tbody>
            @php
            use Illuminate\Support\Str;
            use Carbon\Carbon;

            $plans = ['basic', 'standard', 'premium', null];

            $dummyUsers = collect(range(1, 25))->map(function ($id) use ($plans) {
            return [
            'id' => $id,
            'name' => 'User ' . $id,
            'email' => 'user' . $id . '@example.com',
            'domains' => collect(range(1, rand(1, 3)))->map(function () {
            return Str::random(5) . '.com';
            }),
            'plan' => $plans[rand(0, 3)],
            'created_at' => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d H:i:s'),
            ];
            })->sortByDesc('created_at')->values();

            $currentPage = request()->get('page', 1);
            $perPage = 20;
            $paginated = new Illuminate\Pagination\LengthAwarePaginator(
            $dummyUsers->forPage($currentPage, $perPage),
            $dummyUsers->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
            );
            @endphp

            @foreach($paginated as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>
                    <ul class="mb-0 ps-3">
                        @foreach($user['domains'] as $domain)
                        <li>{{ $domain }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-capitalize text-center">
                    {{ $user['plan'] ?? '—' }}
                </td>
                <td>{{ $user['created_at'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $paginated->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

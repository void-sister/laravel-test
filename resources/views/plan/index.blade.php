@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">

        {{-- Plan 1 --}}
        <div class="col">
            <div class="card h-100 d-flex flex-column">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Basic Plan</h5>
                    <h6 class="card-subtitle mb-3 text-muted">$10/month</h6>
                    <ul class="list-unstyled flex-grow-1">
                        <li>✔ Feature One</li>
                        <li>✔ Feature Two</li>
                        <li>✔ Feature Three</li>
                    </ul>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary w-100">Buy</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Plan 2 --}}
        <div class="col">
            <div class="card h-100 d-flex flex-column">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Pro Plan</h5>
                    <h6 class="card-subtitle mb-3 text-muted">$25/month</h6>
                    <ul class="list-unstyled flex-grow-1">
                        <li>✔ Feature One</li>
                        <li>✔ Feature Two</li>
                        <li>✔ Feature Three</li>
                        <li>✔ Feature Four</li>
                    </ul>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary w-100">Buy</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Plan 3 --}}
        <div class="col">
            <div class="card h-100 d-flex flex-column">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Enterprise Plan</h5>
                    <h6 class="card-subtitle mb-3 text-muted">$50/month</h6>
                    <ul class="list-unstyled flex-grow-1">
                        <li>✔ Feature One</li>
                        <li>✔ Feature Two</li>
                    </ul>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary w-100">Buy</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

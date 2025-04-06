@extends('layouts.app')

@section('content')
<h1>Plans</h1>

<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($plans as $plan)
        <div class="col">
            <div class="card h-100 d-flex flex-column">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $plan->plan_name }}</h5>
                    <h6 class="card-subtitle mb-3 text-muted">${{ $plan->price }}/month</h6>
                    <ul class="list-unstyled flex-grow-1">
                        @foreach($plan->features as $key => $feature)
                            <li>✔ {{ $key }}: {{ format_truthy_value($feature) }}</li>
                        @endforeach
                    </ul>
                    <div class="mt-auto">
                        <form action="{{ route('plans.subscribe', $plan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100"
                                @if($currentUserPlanId == $plan->id) disabled @endif>
                                @if($currentUserPlanId == $plan->id)
                                    Current Plan
                                @else
                                    Buy
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

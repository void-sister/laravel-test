<?php

declare(strict_types=1);

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Services\Plan\PlanService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function __construct(
        protected PlanService $planService = new PlanService(),
    )
    {
    }

    /**
     * Display a listing of the plans.
     *
     * @return View
     */
    public function index(): View
    {
        $plans = $this->planService->getAll();
        $currentUserPlanId = $this->planService->getCurrentUserPlanId(Auth::user());

        return view('plan.index', compact('plans', 'currentUserPlanId'));
    }
}

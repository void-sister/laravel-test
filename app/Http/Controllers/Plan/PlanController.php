<?php

declare(strict_types=1);

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Services\Plan\PlanService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function __construct(
        protected PlanService $planService = new PlanService(),
        protected UserService $userService = new UserService(),
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
        /** @var User $user */
        $user = Auth::user();

        $plans = $this->planService->getAll();
        $userPlan = $this->planService->getUserPlan($user);
        $currentUserPlanId = $userPlan?->id;

        return view('plan.index', compact('plans', 'currentUserPlanId'));
    }

    public function subscribe(Request $request, Plan $plan): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->plan_id === $plan->id) {
            return redirect()->back()->with('message', 'You already have this plan.');
        }
        $this->userService->changePlan($user, $plan);

        return redirect()->back()->with('success', 'Plan updated successfully!');
    }
}

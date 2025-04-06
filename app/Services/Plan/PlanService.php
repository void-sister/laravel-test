<?php

namespace App\Services\Plan;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PlanService
{
    /**
     * Get all plans.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Plan::all();
    }

    /**
     * Get the user's plan.
     *
     * @param User $user
     * @return Plan|null
     */
    public function getUserPlan(User $user): ?Plan
    {
        return Plan::query()->where('id', $user->plan_id)->first();
    }
}
